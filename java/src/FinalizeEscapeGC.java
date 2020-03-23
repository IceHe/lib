/**
 * 代码演示两点:
 *
 * <ul>
 *   <li>1. 对象可以在 GC 时自我拯救
 *   <li>2. 这种自救的机会只有一次, 因为一个对象的 finalize() 方法最多只会被系统自动调用一次
 * </ul>
 */
public class FinalizeEscapeGC {

    public static FinalizeEscapeGC SAVE_HOOK = null;

    public static void main(String[] args) throws Throwable {
        SAVE_HOOK = new FinalizeEscapeGC();

        // 对象第一次成功拯救自己
        tiggerFinailizer();

        // 对象第二次无法被拯救
        tiggerFinailizer();
    }

    private static void tiggerFinailizer() throws Throwable {
        SAVE_HOOK = null;
        System.gc();
        // 因为 Finalizer 方法优先级很低, 所以暂停 0.5 秒以等待它
        Thread.sleep(500);
        if (SAVE_HOOK != null) {
            SAVE_HOOK.isAlive();
        } else {
            System.out.println("no, i am dead :(");
        }
    }

    public void isAlive() {
        System.out.println("yes, i am still alive :)");
    }

    @Override
    protected void finalize() throws Throwable {
        super.finalize();
        System.out.println("finalize method executed!");
        SAVE_HOOK = this;
    }
}
