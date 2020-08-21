/**
 * staticObj, instanceObj, localObj 存在放在哪里?
 */
public class JhsdbTestCase {

    static class Test {
        static ObjectHolder staticObj = new ObjectHolder();
        ObjectHolder instanceObj = new ObjectHolder();

        void foo() {
            ObjectHolder instanceObj = new ObjectHolder();
            System.out.println("done"); // 这里设一个断点
        }
    }

    private static class ObjectHolder {
    }

    public static void main(String[] args) {
        Test test = new JhsdbTestCase.Test();
        test.foo();
    }
}
