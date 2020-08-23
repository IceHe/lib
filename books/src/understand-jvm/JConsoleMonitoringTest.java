import java.time.Duration;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

/**
 * 目标 : Test JConsole Monitoring
 * 运行 :
 * javac JConsoleMonitoringTest.java
 * java -Xms100m -Xmx100m -XX:+UseSerialGC JConsoleMonitoringTest
 */
public class JConsoleMonitoringTest {

    public static void fillHeap(int num) throws InterruptedException {
        List<OOMObject> list = new ArrayList<>();
        for (int i = 0; i < num; i++) {
            // 稍作延时, 令监视曲线的变化更加明显
            Thread.sleep(50);
            list.add(new OOMObject());
        }
        System.gc();
    }

    public static void main(String[] args) throws Exception {
        LocalDateTime startedAt = LocalDateTime.now();
        System.out.println("started at " + startedAt);
        fillHeap(1000);
        LocalDateTime finishedAt = LocalDateTime.now();
        System.out.println("finished at " + finishedAt);
        System.out.println("duration = " + Duration.between(startedAt, finishedAt).toMillis() + " ms");
    }

    /**
     * 内存占位符对象, 一个 OOMObject 大约占 64KB
     */
    static class OOMObject {
        public byte[] placeHolder = new byte[64 * 1024];
    }
}
