# Executor

References

-   Java 并发编程：线程池的使用 - Matrix 海子 - 博客园 : https://www.cnblogs.com/dolphin0520/p/3932921.html
-   https://blog.csdn.net/wqh8522/article/details/79224290

## ThreadPoolTaskExecutor

```java

import org.springframework.core.task.TaskRejectedException;
import org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor;

import java.util.concurrent.ThreadPoolExecutor;
import java.util.stream.IntStream;

/**
 * @link https://blog.csdn.net/wangmx1993328/article/details/80582803
 * @link https://www.cnblogs.com/dolphin0520/p/3932921.html
 * @see Thread 线程
 * @see Runnable 无返回值、不抛异常的任务
 * @see java.util.concurrent.Callable 可返回值、可抛异常的任务
 * @see java.util.concurrent.Executor Runnable 的执行器
 * @see java.util.concurrent.ExecutorService Executor 的拓展，增加了提交和关闭任务的方法
 * @see java.util.concurrent.ScheduledExecutorService ExecutorService 的拓展，支持定时或周期任务
 * @see java.util.concurrent.ThreadFactory Thread 的工厂
 * @see java.util.concurrent.Executors ExecutorService 的静态工厂 (工具类)
 * <p>(还可创建 ScheduledExecutorService 等，可获取 defaultThreadFactory，可封装 Callable)
 * @see org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor 线程池，旨在提高线程资源的利用率
 * @see java.util.concurrent.ThreadPoolExecutor#execute 线程池执行任务具体策略 (详见源码及其注释，在此简述) ：
 * <p>1. 核心线程池未满时，创建核心线程处理任务（完成任务后，核心线程会继续存活等待新任务（也可以设置核心线程跟非核心线程一样，空闲一段时间后会被终止））；
 * <p>2. 核心线程池满 且没有空闲的核心线程时，新任务将暂存到任务队列中（线程空闲时，从队列中获取任务来执行）；
 * <p>3. 任务队列满 但线程池未满时，创建非核心线程处理新任务（非核心线程如果在完成一个任务后空闲时长超过 keepAliveTime 就会被终止）；
 * <p>4. 任务队列满 且线程池也满时，根据线程池饱和策略处理新任务（默认策略：丢弃新任务，并抛出异常）。
 * <p>NOTE: 后提交的任务比先提交的任务更早执行的其中一种情况：没有空闲的核心线程时，先提交的任务进入队列，然后队列满了，而后提交的任务此时则能被新创建的非核心线程直接执行。
 */
public class ThreadPoolTaskExecutorExample {
    public static void main(String[] args) {
        ThreadPoolTaskExecutor taskExecutor = new ThreadPoolTaskExecutor();
        /**
         * 最多保持多少个核心线程
         * 默认值：{@link org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor#corePoolSize}
         */
        final int corePoolSize = 2;
        taskExecutor.setCorePoolSize(corePoolSize);
        // taskExecutor.setPrestartAllCoreThreads(true); // 可以设置提前创建核心线程

        /**
         * 最多保持多少个线程：corePoolSize <= maxPoolSize
         * 默认值：{@link org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor#maxPoolSize}
         */
        final int maxPoolSize = 4;
        taskExecutor.setMaxPoolSize(maxPoolSize);

        /**
         * (通常指非核心) 线程空闲多久后会被终止 (terminated)
         * 默认值：{@link org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor#keepAliveSeconds}
         */
        final int keepAliveSeconds = 2;
        taskExecutor.setKeepAliveSeconds(keepAliveSeconds);
        // taskExecutor.setAllowCoreThreadTimeOut(true); // 可以设置让核心线程也在空闲一段时间后终止！

        /**
         * 暂存等待执行的任务的队列容量
         * 默认值：{@link org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor#queueCapacity}
         */
        final int queueCapacity = 4;
        taskExecutor.setQueueCapacity(queueCapacity); // WARN: 测试值

        /** 新创建的线程名称的前缀 */
        taskExecutor.setThreadNamePrefix("customThreadPool_");

        /**
         * 线程池饱和策略：当所有线程都在执行任务且任务队列已满，这时如何处理被拒绝的新任务？
         * 默认值：{@link org.springframework.scheduling.concurrent.ExecutorConfigurationSupport#rejectedExecutionHandler}
         */
        taskExecutor.setRejectedExecutionHandler(new ThreadPoolExecutor.AbortPolicy()); // 默认策略：抛出异常
        // taskExecutor.setRejectedExecutionHandler(new ThreadPoolExecutor.CallerRunsPolicy()); // 改由调用者所在的线程来执行
        // taskExecutor.setRejectedExecutionHandler(new ThreadPoolExecutor.DiscardPolicy()); // 直接丢弃，不抛异常
        // taskExecutor.setRejectedExecutionHandler(new ThreadPoolExecutor.DiscardOldestPolicy()); // 任务队列丢弃最老的任务，然后加入新任务

        /**
         * 关闭线程池时，等到正在执行和队列中的任务完成后再关闭
         * NOTE：关闭线程池时，不会接受新任务。
         * 默认值：{@link org.springframework.scheduling.concurrent.ExecutorConfigurationSupport#waitForTasksToCompleteOnShutdown}
         */
        taskExecutor.setWaitForTasksToCompleteOnShutdown(true);
        /**
         * 关闭线程池时，等正在执行和队列中的任务完成再关闭的最长时间，超过会强行关闭
         * 默认值：{@link org.springframework.scheduling.concurrent.ExecutorConfigurationSupport#awaitTerminationMillis}
         */
        final int awaitTerminationSeconds = 2;
        taskExecutor.setAwaitTerminationSeconds(awaitTerminationSeconds); // WARN: 测试值

        taskExecutor.initialize();

        System.out.println("TEST 线程池刚创建时没任何线程，直到有任务要执行");
        System.out.printf("taskExecutor.getPoolSize() = %s%n", taskExecutor.getPoolSize());
        System.out.println();

        System.out.println("TEST 线程池执行任务的策略");
        System.out.println("TEST A. 核心池未满时，创建核心线程");
        System.out.println("TEST B. 核心池满时，新任务进入队列");
        System.out.println("TEST C. 任务队列满时，创建非核心线程处理任务");
        System.out.println("TEST D. 任务队列满时，如果线程池也满，则触发线程池饱和策略 —— 拒绝新任务，并抛出异常");
        System.out.println();
        final int taskConsumedMillis = 1000;
        IntStream.range(1, maxPoolSize + queueCapacity + 1 + 1).forEach(i -> {
            try {
                taskExecutor.submit(() -> {
                    if (i <= corePoolSize) {
                        System.out.printf("TASK %s: TESTING A. 核心池未满时，创建核心线程%n", i);
                    } else if (i <= corePoolSize + queueCapacity) {
                        System.out.printf("TASK %s: TESTING B. 核心池满时，新任务进入队列%n", i);
                    } else if (i <= maxPoolSize + queueCapacity) {
                        if (i == corePoolSize + queueCapacity + 1)
                            System.out.println("NOTE: 后提交的任务比先提交的任务更早执行的其中一种情况：没有空闲的核心线程时，先提交的任务进入队列，然后队列满了，而后提交的任务此时则能被新创建的非核心线程直接执行。");
                        System.out.printf("TASK %s: TESTING C. 任务队列满时，创建非核心线程处理任务%n", i);
                    }
                    System.out.printf("TASK %s: run for %s ms%n", i, taskConsumedMillis);
                    System.out.printf("TASK %s: taskExecutor.getPoolSize() = %s%n", i, taskExecutor.getPoolSize());
                    System.out.printf("TASK %s: taskExecutor.getQueueSize() = %s%n", i, taskExecutor.getQueueSize());
                    sleep(taskConsumedMillis);
                });
            } catch (TaskRejectedException e) {
                System.out.printf("TASK %s: TESTING D. 任务队列满时，如果线程池也满，则触发线程池饱和策略 —— 拒绝新任务，并抛出异常%n", i);
                e.printStackTrace();
            }
            sleep(10);
        });
        sleep(taskConsumedMillis * 2);
        System.out.println();

        System.out.println("TEST 空闲一段时间后，非核心线程会被终止");
        System.out.printf("taskExecutor.getPoolSize() = %s%n", taskExecutor.getPoolSize());
        sleepAndPrint(keepAliveSeconds * 1000);
        System.out.printf("taskExecutor.getPoolSize() = %s%n", taskExecutor.getPoolSize());
        System.out.println();

        System.out.println("TEST 关闭线程池：如果还有未完成的任务，等待任务完成再关闭，如果超过终止等待时间，任务还没完成，直接关闭");
        taskExecutor.submit(() -> {
            int consumedMillis = awaitTerminationSeconds * 1000 + 500;
            System.out.printf("TASK: run for %s ms%n", consumedMillis);
            sleep(consumedMillis);
        });
        taskExecutor.shutdown();
    }

    public static void sleep(int millis) {
        try {
            Thread.sleep(millis);
        } catch (InterruptedException ignored) {}
    }

    public static void sleepAndPrint(int millis) {
        System.out.printf("Thread.sleep(%s);%n", millis);
        sleep(millis);
    }
}

```
