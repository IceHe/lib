/**
 * javac JavaVMStackOOM.java
 * java JavaVMStackOOM -Xss2M > JavaVMStackOOM.output 2>&1
 */
public class JavaVMStackOOM {

    private void dontStop() {
        while (true) {}
    }

    public void stackLeakByThread() {
        while (true) {
            Thread thread = new Thread(new Runnable() {
                @Override
                public void run() {
                    dontStop();
                }
            });
            thread.start();
        }
    }

    public static void main(String[] args) {
        JavaVMStackOOM oom = new JavaVMStackOOM();
        oom.stackLeakByThread();
    }
}
