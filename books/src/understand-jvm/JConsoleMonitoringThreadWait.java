import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.time.Duration;
import java.time.LocalDateTime;

/**
 * 目标 : Test JConsole Monitoring Dead Lock
 * 运行 :
 * javac JConsoleMonitoringDeadLock.java
 * java -Xms100m -Xmx100m -XX:+UseSerialGC JConsoleMonitoringDeadLock
 */
public class JConsoleMonitoringThreadWait {

    /**
     * 线程死循环演示
     */
    public static void createBusyThread() {
        Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                while (true) { // Line 21
                    ;
                }
            }
        }, "testBusyThread");
        thread.start();
    }

    /**
     * 线程锁等待演示
     */
    public static void createLockThread(final Object lock) {
        Runnable target;
        Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                synchronized (lock) {
                    try {
                        lock.wait();
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            }
        }, "testLockThread");
        thread.start();
    }

    public static void main(String[] args) throws Exception {
        Thread.sleep(5000L);

        LocalDateTime startedAt = LocalDateTime.now();
        System.out.println("started at " + startedAt);

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        br.readLine();
        createBusyThread();
        Object obj = new Object();
        createLockThread(obj);

        LocalDateTime finishedAt = LocalDateTime.now();
        System.out.println("finished at " + finishedAt);
        System.out.println("duration = " + Duration.between(startedAt, finishedAt).toMillis() + " ms");
    }
}
