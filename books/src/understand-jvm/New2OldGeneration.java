/**
 * javac New2OldGeneration.java
 * java -XX:+UseSerialGC -verbose:gc -Xms20M -Xmx20M -Xmn10M -XX:+PrintGCDetails -XX:SurvivorRatio=8 -XX:MaxTenuringThreshold=1 New2OldGeneration > New2OldGenerationAtAge1.out 2>&1
 * java -XX:+UseSerialGC -verbose:gc -Xms20M -Xmx20M -Xmn10M -XX:+PrintGCDetails -XX:SurvivorRatio=8 -XX:MaxTenuringThreshold=15 New2OldGeneration > New2OldGenerationAtAge15.out 2>&1
 */
public class New2OldGeneration {

    private static final int _1MB = 1024 * 1024;

    public static void main(String[] args) {
        byte[] allocation1, allocation2, allocation3;
        // 什么时候进入老年代取决于 `-XX:MaxTenuringThreshold` 的设置
        allocation1 = new byte[_1MB / 8];
        allocation2 = new byte[4 * _1MB];
        allocation3 = new byte[4 * _1MB];
        allocation3 = null;
        allocation3 = new byte[4 * _1MB];
    }
}
