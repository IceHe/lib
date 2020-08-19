/**
 * javac New2OldGenDynamicStd2.java
 * java -XX:+UseSerialGC -verbose:gc -Xms20M -Xmx20M -Xmn10M -XX:+PrintGCDetails -XX:SurvivorRatio=8 -XX:MaxTenuringThreshold=15 -XX:+PrintTenuringDistribution New2OldGenDynamicStd2 > New2OldGenDynamicStd2.out 2>&1
 */
public class New2OldGenDynamicStd2 {

    private static final int _1MB = 1024 * 1024;

    public static void main(String[] args) {
        byte[] allocation1, allocation2, allocation3, allocation4;
        // allocation1 + allocation2 大于 survivor 空间的一半
        // ( icehe : 使用原书的值 _1MB / 4 时无法复现, 因为字节数组实际占用了比声明更多的内存吗? )
        allocation1 = new byte[_1MB / 6];
        // allocation2 = new byte[_1MB / 6];
        allocation3 = new byte[4 * _1MB];
        allocation4 = new byte[4 * _1MB];
        allocation4 = null;
        allocation4 = new byte[4 * _1MB];
    }
}
