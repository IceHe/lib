import java.time.Duration;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

/**
 * 目标 : Test JConsole Monitoring Dead Lock
 * 运行 :
 * javac JConsoleMonitoringDeadLock.java
 * java -Xms100m -Xmx100m -XX:+UseSerialGC JConsoleMonitoringDeadLock
 */
public class JConsoleMonitoringDeadLock {

    public static void main(String[] args) throws Exception {
        LocalDateTime startedAt = LocalDateTime.now();
        System.out.println("started at " + startedAt);
        fillHeap(1000);
        LocalDateTime finishedAt = LocalDateTime.now();
        System.out.println("finished at " + finishedAt);
        System.out.println("duration = " + Duration.between(startedAt, finishedAt).toMillis() + " ms");
    }
}
