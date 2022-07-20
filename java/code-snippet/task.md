# Task

---

## Task DB

```sql
create table if not exists task
(
    id bigint unsigned auto_increment comment '主键',
    parentId bigint unsigned default 0 not null comment '父任务ID',
    status int default 0 not null comment '任务状态: 0 处理中 1 处理成功 2 处理失败 3 待处理',
    type int default 0 not null comment '任务类型',
    param json null comment '任务参数',
    extra json null comment '拓展信息',
    dbctime datetime(3) default CURRENT_TIMESTAMP(3) null comment '创建时间',
    dbutime datetime(3) default CURRENT_TIMESTAMP(3) null on update CURRENT_TIMESTAMP(3) comment '更新时间',
    constraint `PRIMARY`
        unique (id)
)
comment '任务';

create index idx_parentId
    on task (parentId);
```

## TaskStatus

```java
package xyz.icehe.enums;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonValue;
import lombok.AccessLevel;
import lombok.AllArgsConstructor;
import lombok.Getter;

import java.util.Optional;
import java.util.stream.Stream;

/**
 * 任务状态
 *
 * @author icehe.life
 */
@Getter
@AllArgsConstructor(access = AccessLevel.PRIVATE)
public enum TaskStatusEnum {

    INVALID(-1, "无效值"),
    PROCESSING(0, "处理中"),
    SUCCEEDED(1, "处理成功"),
    FAILED(2, "处理失败"),
    TODO(3, "待处理"),
    ;

    private final int code;

    private final String desc;

    public static Optional<TaskStatusEnum> getByInt(int integer) {
        return Stream.of(values()).filter(value -> value.getCode() == integer).findFirst();
    }

    public static Optional<TaskStatusEnum> getByString(String name) {
        return Stream.of(values()).filter(value -> value.name().equals(name)).findFirst();
    }

    public static TaskStatusEnum getNullableByInt(int value) {
        return getByInt(value).orElse(INVALID);
    }

    @JsonCreator
    public static TaskStatusEnum getNullableByString(String name) {
        return getByString(name).orElse(INVALID);
    }

    @Override
    @JsonValue
    public String toString() {
        return this.name();
    }
}
```

## TaskService

```java
package xyz.icehe.service;

import xyz.icehe.data.Task;
import xyz.icehe.enums.TaskTypeEnum;

import java.util.List;
import java.util.Optional;

/**
 * 任务服务
 *
 * @author icehe.life
 */
public interface TaskService {

    /**
     * 根据任务类型, 抢占 ( 需要处理的 ) 任务
     *
     * <p>抢占: 查询需要处理的任务并上锁, 如果上锁成功, 则调用者可以处理返回的任务, 否则不会返回任务 ( 即调用者不需要处理任务 ) .
     */
    Optional<Task> preemptTaskByType(TaskTypeEnum taskType);

    /**
     * 根据任务ID, 获取任务
     */
    Optional<Task> getTaskById(long taskId);

    /**
     * 根据父任务ID, 获取任务列表
     */
    List<Task> getTasksByParentId(long parentTaskId);

    /**
     * 根据任务类型, 获取需要处理的任务
     */
    List<Task> getTodoTasksByType(TaskTypeEnum type);

    long createTask(Task task);

    void updateTaskExtra(long taskId, String extra);

    void markTaskAsProcessing(long taskId);

    void markTaskAsTodo(long taskId);

    void markTaskAsSuccess(long taskId);

    void markTaskAsFailure(long taskId);
}
```

```java
package xyz.icehe.service.impl;

import lombok.extern.slf4j.Slf4j;
import org.apache.commons.collections4.CollectionUtils;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import xyz.icehe.enums.TaskStatusEnum;
import xyz.icehe.data.Task;
import xyz.icehe.enums.TaskTypeEnum;
import xyz.icehe.service.TaskService;
import xyz.icehe.storage.TaskStorage;
import xyz.icehe.exception.TaskStatusUpdateException;
import xyz.icehe.util.JsonUtil;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;
import java.util.stream.Stream;

/**
 * @author icehe.life
 */
@Slf4j
@Service
public class TaskServiceImpl implements TaskService {

    @Autowired
    private TaskStorage taskStorage;

    @Override
    public Optional<Task> preemptTaskByType(TaskTypeEnum taskType) {
        final String methodName = "getTodoTaskByType";

        List<Task> todoTasks = getTodoTasksByType(taskType);
        if (CollectionUtils.isEmpty(todoTasks)) {
            log.info("{}, 找不到需要处理的任务", methodName);
            return Optional.empty();
        }

        Optional<Task> lockedTaskOpt = tryToLockOneOfTodoTasks(todoTasks);
        if (!lockedTaskOpt.isPresent()) {
            return Optional.empty();
        }

        Task lockedTask = lockedTaskOpt.get();
        if (!requireAllPreconditionTasksSuccess(lockedTask)) {
            return Optional.empty();
        }

        return Optional.of(lockedTask);
    }

    /**
     * 根据需要执行的任务列表, 尝试锁定并获取其中一个可以执行的任务
     */
    private Optional<Task> tryToLockOneOfTodoTasks(List<Task> todoTasks) {
        final String methodName = "tryToLockOneOfTodoTasks";

        /*
         * 按顺序逐个对任务上锁 ( 即将任务从 "待处理" 状态改为 "处理中" 状态 ) :
         * 如果对某个任务上锁成功, 则选定该项任务 ( 然后停止对其它任务上锁 ) ,
         * 否则继续对其它任务上锁, 直到没有需要处理的任务.
         */
        Task lockedTask = null;
        for (Task task : todoTasks) {
            try {
                markTaskAsProcessing(task.getId());
                log.info("{}, 成功锁定需要处理的任务, taskId={}", methodName, task.getId());
                return Optional.of(task);

            } catch (TaskStatusUpdateException e) {
                /*
                 * pass through
                 *
                 * 因为可能另一个同时运行的线程抢到了这个任务 ( 即它成功将这个任务更新为 "处理中" 的状态 ) ,
                 * 那么本线程就没抢到这个任务 ( 即不是本线程将这个任务更新为 "处理中" 的状态 ) ,
                 * 这时抛出 TaskStatusUpdateException 异常属于正常情况, 请忽略.
                 */
            }
        }

        log.warn("{}, 锁定不到需要处理的任务", methodName);
        return Optional.empty();
    }

    /**
     * 当前置任务全部成功时, 本任务才可以被处理
     */
    private boolean requireAllPreconditionTasksSuccess(@NotNull Task task) {
        final String methodName = "requireAllPreconditionTasksSuccess";

        long parentTaskId = task.getParentId();
        long taskId = task.getId();
        TaskTypeEnum taskType = task.getType();

        if (parentTaskId <= 0 || taskId <= 0 || null == taskType) {
            String errMsg = String.format("%s, wrong task=%s", methodName, JsonUtil.writeValue(task));
            log.error(errMsg);
            throw new RuntimeException(errMsg);
        }

        List<TaskTypeEnum> preconditionTaskTypes = taskType.getPreconditionTaskTypes();
        if (CollectionUtils.isEmpty(preconditionTaskTypes)) {
            // 因为没有前置任务的约束, 所以直接允许本任务被处理
            return true;
        }

        List<Task> tasks = getTasksByParentId(parentTaskId);
        List<Task> preconditionTasks = tasks.stream()
                .filter(siblingTask -> preconditionTaskTypes.contains(siblingTask.getType()))
                .collect(Collectors.toList());
        if (preconditionTasks.stream().allMatch(t -> t.getStatus() == TaskStatusEnum.FAILED)) {
            // 重置为 "已失败" 状态, 避免重新被处理
            markTaskAsFailure(taskId);

            String errMsg = String.format("%s, 因前置任务全部失败而终止, task=%s", methodName, JsonUtil.writeValue(task));
            log.error(errMsg);
            return false;
        }

        if (!preconditionTasks.stream().allMatch(t -> t.getStatus() == TaskStatusEnum.SUCCEEDED)) {
            // 重置为 "待处理" 状态, 以便重新被处理
            markTaskAsTodo(taskId);

            String errMsg = String.format("%s, 前置任务还未全部成功, 本任务暂不可以执行, preconditionTasks=%s",
                    methodName, JsonUtil.writeValue(preconditionTasks));
            log.info(errMsg);
            return false;
        }

        log.info("{}, 前置任务全部成功, 本任务可以执行, tasks={}", methodName, JsonUtil.writeValue(tasks));
        return true;
    }

    @Override
    public Optional<Task> getTaskById(long taskId) {
        return taskStorage.getById(taskId);
    }

    @Override
    public List<Task> getTasksByParentId(long parentTaskId) {
        Task parentTask = taskStorage.getById(parentTaskId)
                .orElseThrow(() -> new RuntimeException("task not found, taskId=" + parentTaskId));
        List<Task> childTasks = taskStorage.getByParentId(parentTaskId);
        return Stream.concat(Stream.of(parentTask), childTasks.stream()).collect(Collectors.toList());
    }

    @Override
    public List<Task> getTodoTasksByType(TaskTypeEnum type) {
        return taskStorage.getByStatusAndType(TaskStatusEnum.TODO, type);
    }

    @Override
    public long createTask(Task task) {
        return taskStorage.create(task);
    }

    @Override
    public void updateTaskExtra(long taskId, String extra) {
        boolean success = taskStorage.updateExtra(taskId, extra);
        if (!success) {
            throw new TaskStatusUpdateException(String.format("无法更新任务 %s 的拓展信息置为: %s", taskId, extra));
        }
    }

    @Override
    public void markTaskAsProcessing(long taskId) {
        TaskStatusEnum fromStatus = TaskStatusEnum.TODO;
        TaskStatusEnum toStatus = TaskStatusEnum.PROCESSING;
        updateTaskStatus(taskId, fromStatus, toStatus);
    }

    @Override
    public void markTaskAsTodo(long taskId) {
        TaskStatusEnum fromStatus = TaskStatusEnum.PROCESSING;
        TaskStatusEnum toStatus = TaskStatusEnum.TODO;
        updateTaskStatus(taskId, fromStatus, toStatus);
    }

    @Override
    public void markTaskAsSuccess(long taskId) {
        TaskStatusEnum fromStatus = TaskStatusEnum.PROCESSING;
        TaskStatusEnum toStatus = TaskStatusEnum.SUCCEEDED;
        updateTaskStatus(taskId, fromStatus, toStatus);
    }

    private void updateTaskStatus(
            long taskId,
            TaskStatusEnum fromStatus,
            TaskStatusEnum toStatus
    ) {
        boolean success = taskStorage.updateStatus(taskId, fromStatus, toStatus);
        if (!success) {
            throw new TaskStatusUpdateException(String.format("无法将任务 %s 置为 %s 状态", taskId, toStatus));
        }
    }

    @Override
    public void markTaskAsFailure(long taskId) {
        TaskStatusEnum toStatus = TaskStatusEnum.FAILED;
        boolean success = taskStorage.updateStatus(taskId, toStatus);
        if (!success) {
            throw new TaskStatusUpdateException(String.format("无法将任务 %s 置为 %s 状态", taskId, toStatus));
        }
    }
}
```

## TaskStorage

```java
package xyz.icehe.storage;

import xyz.icehe.common.enums.TaskStatusEnum;
import xyz.icehe.enums.TaskTypeEnum;
import xyz.icehe.data.Task;

import java.util.List;
import java.util.Map;
import java.util.Optional;
import java.util.Set;

/**
 * 任务的存取
 *
 * @author icehe.life
 */
public interface TaskStorage {

    /**
     * 创建任务
     */
    long create(Task task);

    /**
     * 根据ID列表, 删除任务
     */
    int deleteByIds(List<Long> ids);

    /**
     * 根据ID列表, 更新任务的拓展信息
     */
    boolean updateExtra(long taskId, String extra);

    /**
     * 更新任务状态
     */
    boolean updateStatus(long id, TaskStatusEnum status);

    /**
     * 更新任务状态: 从特定状态更新为另一指定状态 ( 简单的乐观锁 )
     */
    boolean updateStatus(long id, TaskStatusEnum fromStatus, TaskStatusEnum toStatus);

    /**
     * 根据ID游标, 批量获取任务ID
     */
    List<Long> scanIdsByCursorId(
            long cursorIdExclusive,
            int pageSize);

    /**
     * 根据ID游标和时间范围, 批量获取任务ID
     */
    List<Long> scanIdsByIdAndCreatedTimeRange(
            long cursorIdExclusive,
            long startMillisInclusive,
            long endMillisExclusive,
            int pageSize);

    /**
     * 根据ID, 获取任务
     */
    Optional<Task> getById(long id);

    /**
     * 根据ID列表, 批量获取任务
     */
    Map<Long, Task> getByIds(List<Long> ids);

    /**
     * 根据父任务ID, 批量获取任务
     */
    List<Task> getByParentId(long parentId);

    /**
     * 根据状态, 全量获取任务
     */
    List<Task> getByStatus(TaskStatusEnum status);

    /**
     * 根据状态集合, 全量获取任务
     */
    List<Task> getByStatuses(Set<TaskStatusEnum> statuses);

    /**
     * 根据状态集合和最早的创建时间, 全量获取任务
     */
    List<Task> getByStatusesAndEarliestCreatedTime(Set<TaskStatusEnum> statuses, long earliestCreatedTime);

    /**
     * 根据状态和类型, 全量获取任务
     */
    List<Task> getByStatusAndType(TaskStatusEnum status, TaskTypeEnum type);
}
```

```java
package xyz.icehe.storage.db;

import com.google.common.collect.ImmutableList;
import org.apache.commons.collections4.CollectionUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.jdbc.core.RowMapper;
import org.springframework.jdbc.core.namedparam.MapSqlParameterSource;
import org.springframework.jdbc.core.namedparam.SqlParameterSource;
import org.springframework.jdbc.support.GeneratedKeyHolder;
import org.springframework.jdbc.support.KeyHolder;
import org.springframework.stereotype.Repository;
import xyz.icehe.common.db.DbClient;
import xyz.icehe.data.Task;
import xyz.icehe.enums.TaskStatusEnum;
import xyz.icehe.enums.TaskTypeEnum;
import xyz.icehe.storage.TaskStorage;
import xyz.icehe.util.TimeUtil;

import java.sql.Timestamp;
import java.util.Collections;
import java.util.List;
import java.util.Map;
import java.util.Optional;
import java.util.Set;
import java.util.function.Function;
import java.util.stream.Collectors;

/**
 * @author icehe.life
 */
@Repository
public class DbTaskStorage implements TaskStorage {

    public static final String TABLE_NAME = "task";

    public static final String ALL_FIELDS = ImmutableList.<String>builder()
            .add("id")
            .add("parentId")
            .add("status")
            .add("type")
            .add("param")
            .add("extra")
            .add("dbctime")
            .add("dbutime")
            .build().stream()
            .map(field -> "`" + field + "`")
            .collect(Collectors.joining(", "));

    @Autowired
    @Qualifier("task.DbClient")
    private DbClient dbClient;

    private static final RowMapper<Task> ROW_MAPPER = ((rs, i) -> {
        Task task = new Task()
                .setId(rs.getLong("id"))
                .setParentId(rs.getLong("parentId"))
                .setStatus(TaskStatusEnum.findNullableByInt(rs.getInt("status")))
                .setType(TaskTypeEnum.findNullableByInt(rs.getInt("type")))
                .setParam(rs.getString("param"))
                .setExtra(rs.getString("extra"))
                .setCreatedTime(rs.getTimestamp("dbctime").getTime())
                .setUpdatedTime(rs.getTimestamp("dbutime").getTime());
        return task;
    });

    @Override
    public long create(Task task) {
        String sql = "INSERT INTO `" + TABLE_NAME + "` " +
                "SET `parentId` = :parentId" +
                ", `status` = :status" +
                ", `type` = :type" +
                ", `param` = :param" +
                ", `extra` = :extra";

        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("parentId", task.getParentId())
                .addValue("status", task.getStatus().toInt())
                .addValue("type", task.getType().toInt())
                .addValue("param", task.getParam())
                .addValue("extra", task.getExtra());

        KeyHolder keyHolder = new GeneratedKeyHolder();
        dbClient.update(sql, source, keyHolder);
        return keyHolder.getKey().longValue();
    }

    @Override
    public int deleteByIds(List<Long> ids) {
        final String sql = "DELETE FROM `" + TABLE_NAME + "` WHERE `id` in (:ids) ";
        SqlParameterSource source = new MapSqlParameterSource("ids", ids);
        return dbClient.update(sql, source);
    }

    @Override
    public boolean updateExtra(long id, String extra) {
        String sql = "UPDATE `" + TABLE_NAME + "` SET `extra` = :extra WHERE `id` = :id";
        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("extra", extra)
                .addValue("id", id);
        return dbClient.update(sql, source) > 0;
    }

    @Override
    public boolean updateStatus(long id, TaskStatusEnum toStatus) {
        String sql = "UPDATE `" + TABLE_NAME + "` SET `status` = :status WHERE `id` = :id";
        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("status", toStatus.toInt())
                .addValue("id", id);
        return dbClient.update(sql, source) > 0;
    }

    @Override
    public boolean updateStatus(long id, TaskStatusEnum fromStatus, TaskStatusEnum toStatus) {
        String sql = "UPDATE `" + TABLE_NAME + "` " +
                "SET `status` = :toStatus " +
                "WHERE `id` = :id " +
                "AND `status` = :fromStatus ";
        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("id", id)
                .addValue("fromStatus", fromStatus.toInt())
                .addValue("toStatus", toStatus.toInt());
        return dbClient.update(sql, source) > 0;
    }

    @Override
    public List<Long> scanIdsByCursorId(long cursorIdExclusive, int pageSize) {
        final String sql = "SELECT `id` " +
                "FROM `" + TABLE_NAME + "` " +
                "WHERE id > :cursorId " +
                "ORDER BY ID ASC " +
                "LIMIT :limit ";
        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("cursorId", cursorIdExclusive)
                .addValue("limit", pageSize);
        return dbClient.queryForList(sql, source, Long.class);
    }

    @Override
    public List<Long> scanIdsByIdAndCreatedTimeRange(
            long cursorIdExclusive,
            long startMillisInclusive,
            long endMillisExclusive,
            int pageSize
    ) {
        final String sql = "SELECT `id` " +
                "FROM `" + TABLE_NAME + "` " +
                "WHERE id > :cursorId " +
                "AND dbctime >= :startMillis " +
                "AND dbctime < :endMillis " +
                "ORDER BY ID ASC " +
                "LIMIT :limit ";
        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("cursorId", cursorIdExclusive)
                .addValue("startMillis", TimeUtil.fromMillis(startMillisInclusive))
                .addValue("endMillis", TimeUtil.fromMillis(endMillisExclusive))
                .addValue("limit", pageSize);
        return dbClient.queryForList(sql, source, Long.class);
    }

    @Override
    public Optional<Task> getById(long id) {
        String sql = "select " + ALL_FIELDS + " from `" + TABLE_NAME + "` where `id` = :id";
        SqlParameterSource source = new MapSqlParameterSource().addValue("id", id);
        Task task = dbClient.queryForObject(sql, source, ROW_MAPPER);
        return Optional.ofNullable(task);
    }

    @Override
    public Map<Long, Task> getByIds(List<Long> ids) {
        if (CollectionUtils.isEmpty(ids)) {
            return Collections.emptyMap();
        }
        String sql = "select " + ALL_FIELDS + " from `" + TABLE_NAME + "` where `id` in (:ids)";
        SqlParameterSource source = new MapSqlParameterSource().addValue("ids", ids);
        List<Task> tasks = dbClient.query(sql, source, ROW_MAPPER);
        return tasks.stream().collect(Collectors.toMap(Task::getId, Function.identity()));
    }

    @Override
    public List<Task> getByParentId(long parentId) {
        String sql = "select " + ALL_FIELDS + " from `" + TABLE_NAME + "` where `parentId` = :parentId";
        SqlParameterSource source = new MapSqlParameterSource().addValue("parentId", parentId);
        List<Task> weightFileImportTasks = dbClient.query(sql, source, ROW_MAPPER);
        return weightFileImportTasks;
    }

    @Override
    public List<Task> getByStatus(TaskStatusEnum status) {
        String sql = "select " + ALL_FIELDS + " from `" + TABLE_NAME + "` where `status` = :status";
        MapSqlParameterSource source = new MapSqlParameterSource().addValue("status", status.toInt());
        List<Task> weightFileImportTasks = dbClient.query(sql, source, ROW_MAPPER);
        return weightFileImportTasks;
    }

    @Override
    public List<Task> getByStatuses(Set<TaskStatusEnum> statuses) {
        String sql = "select " + ALL_FIELDS + " from `" + TABLE_NAME + "` where `status` in (:statuses)";
        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("statuses", statuses.stream().map(TaskStatusEnum::toInt).collect(Collectors.toSet()));
        List<Task> weightFileImportTasks = dbClient.query(sql, source, ROW_MAPPER);
        return weightFileImportTasks;
    }

    @Override
    public List<Task> getByStatusesAndEarliestCreatedTime(Set<TaskStatusEnum> statuses, long earliestCreatedTime) {
        String sql = "select " + ALL_FIELDS + " from `" + TABLE_NAME + "` where `dbutime` >= :earliestCreatedTime and `status` in (:statuses)";
        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("earliestCreatedTime", new Timestamp(earliestCreatedTime))
                .addValue("statuses", statuses.stream().map(TaskStatusEnum::toInt).collect(Collectors.toSet()));
        List<Task> weightFileImportTasks = dbClient.query(sql, source, ROW_MAPPER);
        return weightFileImportTasks;
    }

    @Override
    public List<Task> getByStatusAndType(TaskStatusEnum status, TaskTypeEnum type) {
        String sql = "select " + ALL_FIELDS + " from `" + TABLE_NAME + "` where `status` = :status and `type` = :type";
        SqlParameterSource source = new MapSqlParameterSource()
                .addValue("status", status.toInt())
                .addValue("type", type.toInt());
        List<Task> weightFileImportTasks = dbClient.query(sql, source, ROW_MAPPER);
        return weightFileImportTasks;
    }
}
```
