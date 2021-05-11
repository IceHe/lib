# Executor

References

- https://blog.csdn.net/chzphoenix/article/details/78968075
- Java并发编程：线程池的使用 - Matrix海子 - 博客园 : https://www.cnblogs.com/dolphin0520/p/3932921.html
- https://blog.csdn.net/wqh8522/article/details/79224290

## Default ThreadPoolTaskExcecutor

```java
package xyz.icehe.service;

import java.util.concurrent.ThreadPoolExecutor;

import lombok.extern.slf4j.Slf4j;
import org.springframework.context.annotation.*;
import org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor;

/**
 * 标记类
 *
 * <p>在本类所处包之内的（包括子包）所有的 @Service 均会自动初始化为 Bean
 *
 * <p>另外，此类在META-INF/spring.factories中定义
 *
 * @author icehe.xyz
 * @since 2020/11/06
 */
@Slf4j
@Configuration
@ComponentScan
public class IceHeServiceAutoConfiguration {

    /**
     * 默认的线程池任务执行器
     *
     * @return {@link ThreadPoolTaskExecutor}
     * @see <a href="https://blog.csdn.net/chzphoenix/article/details/78968075">
     * java中四种线程池及poolSize、corePoolSize、maximumPoolSize
     * </a>
     */
    @Bean
    public ThreadPoolTaskExecutor defaultThreadPool() {

        ThreadPoolTaskExecutor executor = new ThreadPoolTaskExecutor();

        executor.setCorePoolSize(1);
        executor.setMaxPoolSize(2);
        executor.setQueueCapacity(1);

        // 线程名称前缀
        executor.setThreadNamePrefix("defaultThreadPool_");

        // 线程空闲后的最大存活时间 (系统默认 60 sec, 通常不必设置)
        executor.setKeepAliveSeconds(60);

        // Policy : 当 pool 已经达到 max size 的时候, task 被拒绝, 这时如何处理新任务?
        // CallerRunsPolicy : 不在新线程中执行任务，而是由调用者所在的线程来执行
        executor.setRejectedExecutionHandler(new ThreadPoolExecutor.CallerRunsPolicy());

        // 初始化
        executor.initialize();

        return executor;
    }
}

```

## Async Execute

```java
defaultExecutor.execute(() -> {
    // do something
    System.out.println("async executed");
});

```

## Future Submit

References : JFGI

```java
import org.apache.commons.lang3.concurrent.ConcurrentUtils;
ConcurrentUtils.constantFuture(Collections.emptyMap());

Future<String> stringFuture = executor.submit(() -> {
    String stringResult = "foobar";
    return stringResult;
});
String stringResult;
try {
    //stringResult = stringFuture.get();
    long timeout = 2000L;
    stringResult = stringFuture.get(timeout, TimeUnit.MILLISECONDS);
} catch (TimeoutException e) {
    stringResult = "TimeoutException";
} catch (InterruptedException e) {
    stringResult = "InterruptedException";
} catch (ExecutionException e) {
    stringResult = "ExecutionException";
}

```
