import java.util.ArrayList;
import java.util.List;

/**
 * javac HeapOOM.java
 * java -Xms20m -Xmx20m -XX:+HeapDumpOnOutOfMemoryError HeapOOM > HeapOOM.out 2>&1
 */
public class HeapOOM {
    public static void main(String[] args) {
        List<OOMObject> list = new ArrayList<OOMObject>();

        while (true) {
            list.add(new OOMObject());
        }
    }

    static class OOMObject {}
}
