import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.time.Duration;
import java.time.LocalDateTime;

/**
 * 目标 : Test JConsole Monitoring Thread-Wait
 * 运行 :
 * javac JConsoleMonitoringThreadWait.java
 * java JConsoleMonitoringThreadWait
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
        Thread.sleep(10000L);

        LocalDateTime startedAt = LocalDateTime.now();
        System.out.println("started at " + startedAt);

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        br.readLine();
        createBusyThread();

        br.readLine();
        Object obj = new Object();
        createLockThread(obj);

        LocalDateTime finishedAt = LocalDateTime.now();
        System.out.println("finished at " + finishedAt);
        System.out.println("duration = " + Duration.between(startedAt, finishedAt).toMillis() + " ms");
    }
}
