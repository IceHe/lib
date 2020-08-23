import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.time.Duration;
import java.time.LocalDateTime;

/**
 * 目标 : Test JConsole Monitoring Dead Lock
 * 运行 :
 * javac JConsoleMonitoringDeadLock.java
 * java JConsoleMonitoringDeadLock
 */
public class JConsoleMonitoringDeadLock {

    /**
     * 线程死锁等待演示
     */
    static class SynAddRunnable implements Runnable {
        int a,b;

        public SynAddRunnable(int a, int b) {
            this.a = a;
            this.b = b;
        }

        @Override
        public void run() {
            synchronized (Integer.valueOf(a)) {
                synchronized (Integer.valueOf(b)) {
                    System.out.println(a + b);
                }
            }
        }
    }

    public static void main(String[] args) throws Exception {
        Thread.sleep(10000L);

        LocalDateTime startedAt = LocalDateTime.now();
        System.out.println("started at " + startedAt);

        for (int i = 0; i < 100; i++) {
            new Thread(new SynAddRunnable(1, 2)).start();
            new Thread(new SynAddRunnable(2, 1)).start();
        }

        LocalDateTime finishedAt = LocalDateTime.now();
        System.out.println("finished at " + finishedAt);
        System.out.println("duration = " + Duration.between(startedAt, finishedAt).toMillis() + " ms");
    }
}
