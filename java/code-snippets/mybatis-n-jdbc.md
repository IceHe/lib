# MyBatis

Reference

- MyBatis 3
    - https://mybatis.org/mybatis-3/zh/index.html
- MyBatis-Plus ( TO TRY )
    - https://mybatis.plus | https://mybatis.plus/en

## Generate

- generatorConfig.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE generatorConfiguration
        PUBLIC "-//mybatis.org//DTD MyBatis Generator Configuration 1.0//EN"
        "http://mybatis.org/dtd/mybatis-generator-config_1_0.dtd">

<generatorConfiguration>

    <properties resource="jdbc.properties"/>

    <context id="default" targetRuntime="MyBatis3" defaultModelType="flat">

        <!--格式化 XML 代码-->
        <property name="xmlFormatter" value="org.mybatis.generator.api.dom.DefaultXmlFormatter"/>

        <plugin type="org.mybatis.generator.plugins.RowBoundsPlugin"/>


        <!-- optional，旨在创建class时，对注释进行控制 -->
        <commentGenerator>
            <property name="addRemarkComments" value="true"/>
            <!--  关闭自动生成的注释  -->
            <property name="suppressAllComments" value="true"/>
            <property name="suppressDate" value="true"/>
        </commentGenerator>


        <!--jdbc的数据库连接：驱动类、链接地址、用户名、密码-->
        <jdbcConnection driverClass="${jdbc.driverClassName}"
                        connectionURL="${jdbc.service_url}" userId="${jdbc.service_username}"
                        password="${jdbc.service_password}"/>


        <!--
             默认false，把JDBC DECIMAL和NUMERIC类型解析为 Integer，
             为true时把JDBC DECIMAL和NUMERIC类型解析为java.math.BigDecimal
        -->
        <javaTypeResolver>
            <property name="forceBigDecimals" value="false"/>
            <property name="useJSR310Types" value="true"/>
        </javaTypeResolver>


        <!-- Model模型生成器,用来生成含有主键key的类，记录类 以及查询Example类
            targetPackage     指定生成的model生成所在的包名
            targetProject     指定在该项目下所在的路径
        -->
        <javaModelGenerator targetPackage="me.ele.lpd.fnpt.buyermall.repository.po"
                            targetProject="src/main/java">
            <!-- 是否允许子包，即targetPackage.schemaName.tableName -->
            <property name="enableSubPackages" value="false"/>
            <!-- 是否对model添加 构造函数 -->
            <property name="constructorBased" value="false"/>
            <!-- 是否对类CHAR类型的列的数据进行trim操作 -->
            <property name="trimStrings" value="true"/>
            <!-- 建立的Model对象是否不可改变  即生成的Model对象不会有setter方法，只有构造方法 -->
            <property name="immutable" value="false"/>
        </javaModelGenerator>


        <!--Mapper映射文件生成所在的目录 为每一个数据库的表生成对应的SqlMap文件 -->
        <sqlMapGenerator targetPackage="xyz.icehe.orm.mapper"
                         targetProject="src/main/java">
            <property name="enableSubPackages" value="false"/>
        </sqlMapGenerator>


        <!-- 客户端代码，生成易于使用的针对Model对象和XML配置文件 的代码
                type="ANNOTATEDMAPPER",生成Java Model 和基于注解的Mapper对象
                type="MIXEDMAPPER",生成基于注解的Java Model 和相应的Mapper对象
                type="XMLMAPPER",生成SQLMap XML文件和独立的Mapper接口
        -->
        <javaClientGenerator targetPackage="xyz.icehe.orm.mapper"
                             targetProject="src/main/java" type="XMLMAPPER">
            <property name="enableSubPackages" value="false"/>
        </javaClientGenerator>

        <table tableName="account" domainObjectName="AccountPO">
            <columnOverride column="role" javaType="java.lang.Integer"/>
            <columnOverride column="status" javaType="java.lang.Integer"/>
            <columnOverride column="is_deleted" javaType="java.lang.Integer"/>
        </table>

    </context>
</generatorConfiguration>

```

- jdbc.properties

```java
jdbc.driverClassName=com.mysql.jdbc.Driver
jdbc.service_url=jdbc:mysql://10.234.56.78:9000/db_name?characterEncoding=UTF-8&useSSL=false
jdbc.service_username=username
jdbc.service_password=password
jdbc.service_initialSize=8
jdbc.service_minIdle=8
jdbc.service_maxActive=16

```

## Handwrite

### ConfigMapper.java

```java
package xyz.icehe.orm.mapper;

import xyz.icehe.enums.ConfigState;
import xyz.icehe.condition.ConfigCondition;
import xyz.icehe.orm.po.ConfigPO;
import org.apache.ibatis.annotations.Param;
import org.apache.ibatis.session.RowBounds;
import org.springframework.stereotype.Component;

import java.util.EnumSet;
import java.util.List;
import java.util.Set;

/**
 * 配置 Persistent Object 的 Mapper
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Component
public interface ConfigMapper {

    /**
     * 插入配置
     *
     * @param record 配置
     * @return 插入的数据行数
     */
    int insert(ConfigPO record);

    /**
     * 批量插入配置
     *
     * @param configs 配置列表
     * @return 插入的数据行数
     */
    int batchInsert(@Param("configs") List<ConfigPO> configs);

    /**
     * 删除配置
     *
     * @param id 配置记录 ID
     * @return 删除的数据行数
     */
    int deleteById(Long id);

    /**
     * 更新配置
     *
     * @param record {@link ConfigPO}
     * @return 更新的数据行数
     */
    int update(ConfigPO record);

    /**
     * 批量更新配置的状态
     *
     * @param ids ID 集合
     * @param fromStates 允许从哪些状态
     * @param toState 修改到哪个状态
     * @return 更新的数据行数
     */
    int batchUpdateStates(
            @Param("ids") Set<Long> ids,
            @Param("fromStates") EnumSet<ConfigState> fromStates,
            @Param("toState") ConfigState toState);

    /**
     * 根据配置 ID 集合, 将配置标识为 "已被删除" 的状态
     *
     * @param ids 配置 ID 集合
     * @return 更新的数据行数
     */
    int markDeletedByIds(@Param("ids") Set<Long> ids);

    /**
     * 获取配置的数量
     *
     * @param conditions {@link ConfigCondition}
     * @return 配置的数量
     */
    int countByConditions(ConfigCondition conditions);

    /**
     * 获取配置 (不分页)
     *
     * @param conditions {@link ConfigCondition}
     * @return {@link ConfigPO} {@link List} 按创建时间倒序排列
     */
    List<ConfigPO> selectByConditions(ConfigCondition conditions);

    /**
     * 获取配置 (分页查询)
     *
     * @param conditions {@link ConfigCondition}
     * @param rowBounds {@link RowBounds} 行限制：包括查询偏移量、获取行数
     * @return {@link ConfigPO} {@link List} 按创建时间倒序排列
     */
    List<ConfigPO> selectByConditions(ConfigCondition conditions, RowBounds rowBounds);
}

```

### ConfigMapper.xml

```java
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE mapper PUBLIC "-//mybatis.org//DTD Mapper 3.0//EN" "http://mybatis.org/dtd/mybatis-3-mapper.dtd">
<mapper namespace="xyz.icehe.orm.mapper.ConfigMapper">

    <resultMap id="BaseResultMap" type="xyz.icehe.orm.po.ConfigPO">
        <constructor>
            <idArg column="id" javaType="java.lang.Long" jdbcType="BIGINT"/>
            <arg column="name" javaType="java.lang.String" jdbcType="VARCHAR"/>
            <arg column="start_time" javaType="java.time.LocalDateTime" jdbcType="TIMESTAMP"/>
            <arg column="end_time" javaType="java.time.LocalDateTime" jdbcType="TIMESTAMP"/>
            <arg column="state" javaType="java.lang.Integer" jdbcType="INTEGER"/>
            <arg column="is_deleted" javaType="java.lang.Boolean" jdbcType="INTEGER"/>
            <arg column="created_at" javaType="java.time.LocalDateTime" jdbcType="TIMESTAMP"/>
            <arg column="updated_at" javaType="java.time.LocalDateTime" jdbcType="TIMESTAMP"/>
        </constructor>
    </resultMap>

    <sql id="TableName">
        optimal_rider_config
    </sql>

    <sql id="BaseColumnList">
        id,
        name,
        start_time,
        end_time,
        state,
        is_deleted,
        created_at,
        updated_at
    </sql>

    <sql id="InsertColumnList">
        name,
        start_time,
        end_time,
        state,
    </sql>

    <sql id="WhereConditions">
        <where>
            <if test="ids != null and !ids.isEmpty()">
                and id in
                <foreach collection="ids" item="id" separator="," open="(" close=")">
                    #{id}
                </foreach>
            </if>
            <if test="name != null">
                and name like "%"#{name}"%"
            </if>
            <if test="startTimes != null and !startTimes.isEmpty()">
                and start_time in
                <foreach collection="startTimes" item="startTime" separator="," open="(" close=")">
                    #{startTime}
                </foreach>
            </if>
            <if test="period != null">
                <if test="period.startTime != null">
                    and start_time <![CDATA[ >= ]]> #{period.startTime}
                </if>
                <if test="period.endTime != null">
                    and end_time <![CDATA[ <= ]]> #{period.endTime}
                </if>
            </if>
            <if test="periodIncluded != null">
                <if test="periodIncluded.startTime != null">
                    and start_time <![CDATA[ <= ]]> #{periodIncluded.startTime}
                </if>
                <if test="periodIncluded.endTime != null">
                    and end_time <![CDATA[ >= ]]> #{periodIncluded.endTime}
                </if>
            </if>
            <if test="states != null and !states.isEmpty()">
                and state in
                <foreach collection="states" item="state" separator="," open="(" close=")">
                    #{state.code}
                </foreach>
            </if>
            <if test="isDeleted != null">
                and is_deleted = #{isDeleted,jdbcType=INTEGER}
            </if>
            <if test="createdAtDateFrom != null">
                and created_at <![CDATA[ >= ]]> CONCAT(#{createdAtDateFrom}, ' 00:00:00')
            </if>
            <if test="createdAtDateTo != null">
                and created_at <![CDATA[ <= ]]> CONCAT(#{createdAtDateTo}, ' 23:59:59')
            </if>
        </where>
    </sql>

    <insert id="insert" parameterType="xyz.icehe.orm.entity.ConfigDO">

        <selectKey keyProperty="id" order="AFTER" resultType="java.lang.Long">
            SELECT LAST_INSERT_ID()
        </selectKey>

        insert into
        <include refid="TableName"/>
        <trim prefix="(" suffix=")" suffixOverrides=",">
            <include refid="InsertColumnList"/>
        </trim>
        <trim prefix="values (" suffix=")" suffixOverrides=",">
            #{name},
            #{startTime},
            #{endTime},
            #{state}
        </trim>
    </insert>

    <insert id="batchInsert">
        insert into
        <include refid="TableName"/>
        <trim prefix="(" suffix=")" suffixOverrides=",">
            <include refid="InsertColumnList"/>
        </trim>
        values
        <foreach collection="configs" item="config" separator=",">
            <trim prefix="(" suffix=")" suffixOverrides=",">
                #{config.name},
                #{config.startTime},
                #{config.endTime},
                #{config.state},
            </trim>
        </foreach>
    </insert>

    <delete id="deleteById" parameterType="java.lang.Long">
        delete from
        <include refid="TableName"/>
        where id = #{id}
    </delete>

    <update id="update"
            parameterType="xyz.icehe.orm.entity.ConfigDO">
        update
        <include refid="TableName"/>
        <set>
            <if test="name != null">
                name = #{name},
            </if>
            <if test="startTime != null">
                start_time = #{startTime},
            </if>
            <if test="endTime != null">
                end_time = #{endTime},
            </if>
            <if test="state != null">
                state = #{state},
            </if>
            <if test="isDeleted != null">
                is_deleted = #{isDeleted},
            </if>
        </set>
        where id = #{id}
    </update>

    <insert id="batchUpdateStates">
        update
        <include refid="TableName"/>
        <set>
            state = #{toState.code}
        </set>
        <where>
            is_deleted = 0
            and id in
            <foreach collection="ids" item="id" open="(" close=")" separator=",">
                #{id}
            </foreach>
            and state in
            <foreach collection="fromStates" item="fromState" open="(" close=")" separator=",">
                #{fromState.code}
            </foreach>
        </where>
    </insert>

    <update id="markDeletedByIds">
        update
        <include refid="TableName"/>
        set is_deleted = 1
        <where>
            is_deleted = 0
            and id in
            <foreach collection="ids" item="id" separator="," open="(" close=")">
                #{id}
            </foreach>
        </where>
    </update>

    <select id="countByConditions"
            parameterType="xyz.icehe.orm.condition.ConfigCondition"
            resultType="java.lang.Integer">
        select count(*)
        from
        <include refid="TableName"/>
        <include refid="WhereConditions"/>
    </select>

    <select id="selectByConditions"
            parameterType="xyz.icehe.orm.condition.ConfigCondition"
            resultMap="BaseResultMap">
        select
        <include refid="BaseColumnList"/>
        from
        <include refid="TableName"/>
        <include refid="WhereConditions"/>
        order by id desc, type desc
    </select>
</mapper>

```

### ConfigPO.java

```java
package xyz.icehe.orm.po;

import java.time.LocalDateTime;

import com.alibaba.fastjson.annotation.JSONType;

import com.fasterxml.jackson.databind.PropertyNamingStrategy;
import com.fasterxml.jackson.databind.annotation.JsonNaming;
import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;
import xyz.icehe.enums.ConfigState;

/**
 * 配置 Persistent Object
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
@JsonNaming(PropertyNamingStrategy.SnakeCaseStrategy.class)
@JSONType(naming = com.alibaba.fastjson.PropertyNamingStrategy.SnakeCase)
public class ConfigPO {

    /**
     * 配置ID
     */
    private Long id;

    /**
     * 姓名
     */
    private String name;

    /**
     * 生效周期的起始时间 ( 时间部分应为: "00:00:00" )
     */
    private LocalDateTime startTime;

    /**
     * 生效周期的结束时间 ( 时间部分应为: "23:59:59" )
     */
    private LocalDateTime endTime;

    /**
     * 配置状态
     *
     * @see ConfigState
     */
    private Integer state;

    /**
     * 是否已被删除
     */
    private Boolean isDeleted;

    /**
     * 创建时间
     */
    private LocalDateTime createdAt;

    /**
     * 修改时间
     */
    private LocalDateTime updatedAt;
}

```

### ConfigReposity.java

```java
package xyz.icehe.orm.repository;

import java.util.EnumSet;
import java.util.List;
import java.util.Set;

import lombok.NonNull;
import lombok.extern.slf4j.Slf4j;
import xyz.icehe.enums.ConfigState;
import xyz.icehe.condition.ConfigCondition;
import xyz.icehe.orm.po.ConfigPO;
import xyz.icehe.orm.mapper.ConfigMapper;
import org.apache.ibatis.session.RowBounds;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;
import org.springframework.util.CollectionUtils;

/**
 * 配置的存储仓库
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Slf4j
@Repository
public class ConfigRepository {

    @Autowired
    private ConfigMapper configMapper;

    /**
     * 插入配置
     */
    public void insert(ConfigPO configPO) throws Exception {
        if (configMapper.insert(configPO) == 0) {
            String errorMsg =
                String.format("ConfigRepository.insert failed, configPO=%s", configPO);
            log.error(errorMsg);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 批量插入配置
     */
    public void batchInsert(List<ConfigPO> configDos) throws Exception {
        if (CollectionUtils.isEmpty(configDos)) {
            log.warn("OptimalRiderConfigRepository.batchInsert, configDos={}", configDos);
            return;
        }
        if (configMapper.batchInsert(configDos) == 0) {
            String errorMsg = String.format("cannot insert rider config records, configDos=%s", configDos);
            log.error(errorMsg);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 根据 ID, 删除配置
     */
    public void deleteById(Long id) throws Exception {
        if (configMapper.deleteById(id) == 0) {
            String errorMsg = String.format("ConfigRepository.deleteById failed, id=%s", id);
            log.error(errorMsg);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 根据 ID, 更新配置
     */
    public void update(ConfigPO configPO) throws Exception {
        if (configMapper.update(configPO) == 0) {
            String errorMsg = String.format("ConfigRepository.update failed, configPO=%s", configPO);
            log.error(errorMsg);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 根据 ID 和状态, 批量更新配置的状态
     *
     * @param ids        ID 集合
     * @param fromStates 允许从哪些状态
     * @param toState    修改到哪个状态
     * @throws Exception
     */
    public void batchUpdateStates(@NonNull Set<Long> ids, EnumSet<ConfigState> fromStates, ConfigState toState)
        throws Exception {

        if (CollectionUtils.isEmpty(ids)) {
            return;
        }
        int effectedRowCount = configMapper.batchUpdateStates(ids, fromStates, toState);
        if (effectedRowCount != ids.size()) {
            log.warn(String.format("存在更新失败的配置, 可能该更新违反了约束条件, ids=%s, fromStates=%s, toState=%s",
                ids, fromStates, toState));
            throw new Exception("更新操作失败, 请重新查询以确认结果, 根据实际情况重试");
        }
    }

    /**
     * 根据配置 ID 集合, 将配置标识为 "已被删除" 的状态
     */
    public void markDeletedByIds(Set<Long> ids) throws Exception {
        if (CollectionUtils.isEmpty(ids)) {
            return;
        }
        try {
            configMapper.markDeletedByIds(ids);
        } catch (Exception e) {
            String errorMsg = String.format("ConfigRepository.markDeletedByIds failed, ids=%s", ids);
            log.error(errorMsg, e);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 列举配置 (不分页)
     *
     * @param conditions {@link ConfigCondition}
     * @return {@link ConfigPO} {@link List} 按照 ID (近似于创建时间) 倒序排列
     */
    public List<ConfigPO> listByConditions(ConfigCondition conditions) {
        return configMapper.selectByConditions(conditions);
    }

    /**
     * 列举配置 (分页查询)
     *
     * @param conditions {@link ConfigCondition}
     * @param rowBounds  {@link RowBounds} 行限制：包括查询偏移量、获取行数
     * @return {@link ConfigPO} {@link List} 按照 ID (近似于创建时间) 倒序排列
     */
    public List<ConfigPO> listByConditions(
        ConfigCondition conditions, RowBounds rowBounds) {
        return configMapper.selectByConditions(conditions, rowBounds);
    }

    /**
     * 获取符合条件的第一个配置
     *
     * @param conditions {@link ConfigCondition}
     * @return {@link ConfigPO} {@link List} 按照 ID (近似于创建时间) 倒序排列, 获取 ID 最大的第一个
     */
    public ConfigPO getFirstByConditions(ConfigCondition conditions) {
        List<ConfigPO> configDos = configMapper.selectByConditions(conditions, new RowBounds(0, 1));
        return CollectionUtils.isEmpty(configDos) ? null : configDos.get(0);
    }

    /**
     * 获取配置的数量
     *
     * @param conditions {@link ConfigCondition}
     * @return 配置的数量
     */
    public int countByConditions(ConfigCondition conditions) {
        return configMapper.countByConditions(conditions);
    }
}

```

### ConfigCondition.java

```java
package xyz.icehe.condition;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.EnumSet;
import java.util.Set;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;
import xyz.icehe.enums.ConfigState;

/**
 * 配置的查询条件
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class ConfigCondition {

    /**
     * 配置ID集合
     */
    private Set<Long> ids;

    /**
     * 姓名
     */
    private String name;

    /**
     * 生效周期的 起始时间 集合
     */
    private Set<LocalDateTime> startTimes;

    /**
     * 生效周期: 起始时间 & 结束时间; 扩大时间范围后, 可查出多个生效周期的数据
     */
    private OptimalRiderPeriodDTO period;

    /**
     * 配置的状态
     */
    @Builder.Default
    private Set<ConfigState> states = EnumSet.of(ConfigState.APPROVED);

    /**
     * 是否已被(软)删除
     */
    @Builder.Default
    private Boolean isDeleted = false;

    /**
     * 创建时间的 查询范围的 起始日期 (闭区间)
     */
    private LocalDate createdAtDateFrom;

    /**
     * 创建时间的 查询范围的 结束日期 (闭区间)
     */
    private LocalDate createdAtDateTo;
}

```

### ConfigState.java

```java
package xyz.icehe.enums;

import java.util.EnumSet;
import java.util.Set;
import java.util.stream.Stream;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonValue;
import com.google.common.collect.ImmutableSet;
import lombok.AccessLevel;
import lombok.AllArgsConstructor;
import lombok.Getter;

/**
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Getter
@AllArgsConstructor(access = AccessLevel.PRIVATE)
public enum ConfigState {

    /**
     * 配置的状态
     */
    NOT_APPLIED(0, "未申请"),
    APPLIED(1, "待培训"),
    REJECTED(2, "审核驳回"),
    APPROVED(3, "审核通过"),
    EXPIRE_REJECTED(7, "超时未审核通过，自动驳回"),
    ;

    /**
     * 驳回状态的集合
     */
    private static final Set<ConfigState> REJECTED_STATES =
        ImmutableSet.of(REJECTED, EXPIRE_REJECTED);

    /**
     * 不可修改 (正常情况下) 的状态的集合
     */
    private static final Set<ConfigState> UNMODIFIABLE_STATES =
        ImmutableSet.of(REJECTED, EXPIRE_REJECTED);

    /**
     * 可修改的状态的集合
     */
    private static final Set<ConfigState> MODIFIABLE_STATES =
        ImmutableSet.of(NOT_APPLIED, APPLIED, APPROVED);

    /**
     * 码值
     */
    private final Integer code;

    /**
     * 说明
     */
    private final String desc;

    /**
     * 将码值转换为枚举常量
     */
    @JsonCreator
    public static ConfigState codeOf(Integer code) {
        return Stream.of(values()).filter(it -> it.equalsCode(code)).findFirst().orElse(null);
    }

    /**
     * 将名称转换为枚举常量
     */
    @JsonCreator
    public static ConfigState nameOf(String name) {
        return Stream.of(values()).filter(it -> it.name().equals(name)).findFirst().orElse(null);
    }

    /**
     * 全状态的集合
     */
    public static EnumSet<ConfigState> allStates() {
        return EnumSet.allOf(ConfigState.class);
    }

    /**
     * 除 "审核通过" 状态之外的集合
     */
    public static EnumSet<ConfigState> nonApprovedStates() {
        return EnumSet.complementOf(EnumSet.of(ConfigState.APPROVED));
    }

    /**
     * 驳回状态的集合
     */
    public static EnumSet<ConfigState> rejectedStates() {
        return EnumSet.copyOf(REJECTED_STATES);
    }

    /**
     * 驳回状态之外的集合
     */
    public static EnumSet<ConfigState> nonRejectedStates() {
        return EnumSet.complementOf(EnumSet.copyOf(REJECTED_STATES));
    }

    /**
     * 不可修改 (正常情况下) 的状态的集合
     */
    public static EnumSet<ConfigState> unmodifiableStates() {
        return EnumSet.copyOf(UNMODIFIABLE_STATES);
    }

    /**
     * 可修改的状态的集合
     */
    public static EnumSet<ConfigState> modifiableStates() {
        return EnumSet.copyOf(MODIFIABLE_STATES);
    }

    /**
     * 判断处理状态 (码值) 是否相等
     */
    public boolean equalsCode(Integer value) {
        return getCode().equals(value);
    }

    /**
     * 是否属于一种驳回状态
     */
    public boolean isRejection() {
        return REJECTED_STATES.contains(this);
    }

    /**
     * 获取码值
     *
     * @return
     */
    @JsonValue
    public Integer getCode() {
        return code;
    }
}

```

## PageHelper

Reference

- https://pagehelper.github.io/docs
- 在系统中发现了多个分页插件, 请检查系统配置 : https://www.cnblogs.com/imdeveloper/p/13529827.html

### Utils

```java
package xyz.icehe.utils;

import java.util.List;

import com.github.pagehelper.*;
import lombok.experimental.UtilityClass;
import lombok.extern.slf4j.Slf4j;

/**
 * PageHelper 的工具集
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Slf4j
@UtilityClass
public class PageHelperUtils {

    /**
     * 根据页码和每页数据条数, 获取翻页结果
     *
     * @param <T>
     * @param pageIndex
     * @param pageSize
     * @param iSelect
     * @return
     */
    public <T> Page<T> getPage(Integer pageIndex, Integer pageSize, ISelect iSelect) {
        return getPage(pageIndex, pageSize, iSelect, true);
    }

    /**
     * 根据偏移量和限制数量, 获取分页结果
     *
     * @param <T>
     * @param offset
     * @param limit
     * @param iSelect
     * @return
     */
    public <T> Page<T> getOffsetPage(Integer offset, Integer limit, ISelect iSelect) {
        return getOffsetPage(offset, limit, iSelect, true);
    }

    /**
     * 根据页码和每页数据条数, 获取翻页结果列表
     *
     * @param pageIndex
     * @param pageSize
     * @param iSelect
     * @param <T>
     * @return
     */
    public <T> List<T> getList(Integer pageIndex, Integer pageSize, ISelect iSelect) {
        return (List<T>)getPage(pageIndex, pageSize, iSelect, false);
    }

    /**
     * 根据偏移量和限制数量, 获取分页结果
     *
     * @param offset
     * @param limit
     * @param iSelect
     * @param <T>
     * @return
     */
    public <T> List<T> getOffsetList(Integer offset, Integer limit, ISelect iSelect) {
        return (List<T>)getOffsetPage(offset, limit, iSelect, false);
    }

    /**
     * 根据页码和每页数据条数, 获取翻页结果
     *
     * @param <T>
     * @param pageIndex
     * @param pageSize
     * @param iSelect
     * @param needCount
     * @return
     */
    private <T> Page<T> getPage(Integer pageIndex, Integer pageSize, ISelect iSelect, boolean needCount) {
        if (null == pageIndex || null == pageSize || pageIndex <= 0 || pageSize <= 0) {
            log.error("PageUtils.getPage failed, invalid page condition, pageIndex={}, pageSize={}",
                pageIndex, pageSize);
            return new Page<>();
        }

        Page<T> page = PageHelper.startPage(pageIndex, pageSize, needCount).doSelectPage(iSelect);
        if (null == page) {
            return new Page<>();
        }
        return page;
    }

    /**
     * 根据偏移量和限制数量, 获取分页结果
     *
     * @param <T>
     * @param offset
     * @param limit
     * @param iSelect
     * @param needCount
     * @return
     */
    private <T> Page<T> getOffsetPage(Integer offset, Integer limit, ISelect iSelect, boolean needCount) {
        if (null == offset || null == limit || offset < 0 || limit <= 0) {
            log.error("PageUtils.getOffsetPage failed, invalid offset condition, offset={}, limit={}",
                offset, limit);
            return new Page<>();
        }

        Page<T> page = PageHelper.offsetPage(offset, limit, needCount).doSelectPage(iSelect);
        if (null == page) {
            return new Page<>();
        }
        return page;
    }
}

```

### RecordRepository

```java
package xyz.icehe.repository;

import java.time.LocalDateTime;

import com.github.pagehelper.Page;
import lombok.NonNull;
import lombok.extern.slf4j.Slf4j;
import xyz.icehe.utils.JsonUtil;
import xyz.icehe.utils.PageHelperUtils;
import xyz.icehe.orm.condition.RecordCondition;
import xyz.icehe.orm.mapper.RecordMapper;
import xyz.icehe.orm.po.RecordExample;
import xyz.icehe.orm.po.RecordExample.Criteria;
import xyz.icehe.orm.po.RecordPO;
import org.apache.commons.collections.CollectionUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

/**
 * 记录的仓库
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Slf4j
@Repository
public class RecordRepository {

    @Autowired
    private RecordMapper recordMapper;

    /**
     * 添加记录
     *
     * @param recordPO
     */
    public void insert(RecordPO recordPO) {
        if (null == recordPO) {
            return;
        }
        try {
            recordMapper.insertSelective(recordPO);
        } catch (Exception e) {
            log.error("RecordRepository.insert.recordMapper.insertSelective failed, recordPO={}",
                JsonUtil.toJsonString(recordPO));
        }
    }

    /**
     * 根据查询条件, 获取记录的分页结果
     *
     * @param condition
     * @return
     */
    public Page<RecordPO> getRecordPage(RecordCondition condition) throws Exception {
        if (null == condition) {
            return new Page<>();
        }

        RecordExample example = buildExampleByCondition(condition);
        example.setOrderByClause("id DESC");
        try {
            // 如果 DB 表中的有 text 类型的字段, 需要使用 *WithBLOBs 的获取方法
            Page<RecordPO> recordLogs = PageHelperUtils.getPage(
                condition.getPageIndex(), condition.getPageSize(),
                () -> recordMapper.selectByExampleWithBLOBs(example));
            if (CollectionUtils.isEmpty(recordLogs)) {
                return new Page<>();
            }
            return recordLogs;
        } catch (Exception e) {
            log.error(
                "RecordRepository.getRecords.recordMapper.selectByExample failed, condition={}, example={}",
                JsonUtil.toJsonString(condition), JsonUtil.toJsonString(example), e);
            throw new Exception("RecordRepository.getRecords failed", e);
        }
    }

    /**
     * 根据查询条件, 获取接口请求日志记录的数量
     *
     * @param condition
     * @return
     */
    public Integer countRecord(RecordCondition condition) throws Exception {
        if (null == condition) {
            return 0;
        }

        RecordExample example = buildExampleByCondition(condition);
        try {
            long count = recordMapper.countByExample(example);
            return (int)count;
        } catch (Exception e) {
            log.error(
                "RecordRepository.countRecord.recordMapper.countByExample failed, condition={}, example={}",
                JsonUtil.toJsonString(condition), JsonUtil.toJsonString(example), e);
            throw new Exception("RecordRepository.countRecord failed", e);
        }
    }

    private RecordExample buildExampleByCondition(@NonNull RecordCondition query) {
        RecordExample example = new RecordExample();
        Criteria criteria = example.createCriteria();

        Long id = query.getId();
        if (null != id && id >= 0) {
            criteria.andDevIdEqualTo(id);
        }

        LocalDateTime createdAtFromInclusive = query.getCreatedAtFromInclusive();
        if (null != createdAtFromInclusive) {
            criteria.andCreatedAtGreaterThanOrEqualTo(createdAtFromInclusive);
        }

        LocalDateTime createdAtToExclusive = query.getCreatedAtToExclusive();
        if (null != createdAtToExclusive) {
            criteria.andCreatedAtLessThan(createdAtToExclusive);
        }

        return example;
    }
}

```

# JDBC

## Query Count

```java
String sql = "SELECT count(*) FROM ? …";
int count = jdbcInfo.getJdbcTemplate().queryForInt(sql, params);

```
