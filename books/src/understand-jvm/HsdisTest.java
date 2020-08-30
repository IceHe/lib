/**
 * javac HsdisTest.java
 * java -XX:+UnlockDiagnosticVMOptions -XX:+PrintAssembly -Xcomp -XX:CompileCommand=dontinline,HsdisTest.sum -XX:CompileCommand=compileonly,HsdisTest.sum HsdisTest | tee -a HsdisTest.out
 */
public class HsdisTest {
    int a = 1;
    static int b = 2;

    public int sum(int c) {
        return a + b + c;
    }

    public static void main(String[] args) {
        new HsdisTest().sum(3);
    }
}
