package xyz.icehe.sort;

import java.util.concurrent.ThreadLocalRandom;

import xyz.icehe.utils.SortUtils;

public class QuickSort3WayRecursive {

    public static void main(String[] args) {
        for (int i = 0; i < 1; i++) {
            System.out.println("Before recursive quick sorting");
            //int[] intAry = SortUtils.genAndPrint10Ints();
            int[] intAry = new int[] {99, 19, 40, 72, 12, 9, 5, 22, 60, 4};
            quickSortRecursive(intAry);
            System.out.println("After recursive quick sorting");
            SortUtils.printInts(intAry);
            SortUtils.checkSortedInts(intAry);
            System.out.println();
        }
    }

    public static void quickSortRecursive(int[] intAry) {
        if (null == intAry) {
            return;
        }
        doQuickSortRecursive(intAry, 0, intAry.length - 1);
    }

    private static void doQuickSortRecursive(int[] intAry, int firstIdx, int lastIdx) {
        if (null == intAry
            || firstIdx < 0
            || firstIdx >= lastIdx
            || lastIdx >= intAry.length
        ) {
            return;
        }

        int pivotIdx = ThreadLocalRandom.current().nextInt(firstIdx, lastIdx + 1);
        int pivotVal = intAry[pivotIdx];

        System.out.println("firstIdx=" + firstIdx);
        System.out.println("lastIdx=" + lastIdx);
        System.out.println("pivotIdx=" + pivotIdx);
        System.out.println("pivotVal=" + pivotVal);
        SortUtils.swap(intAry, pivotIdx, lastIdx);

        int i = firstIdx;
        int j = firstIdx;
        int k = lastIdx;

        while (i < k) {
            if (intAry[i] < pivotVal) {
                SortUtils.swap(intAry, i, j++);
                i++;
            } else if (intAry[i] == pivotVal) {
                SortUtils.swap(intAry, i, --k);
            } else {
                i++;
            }
        }

        int m = 0;
        for (; m < k - j + 1; m++) {
            SortUtils.printInts(intAry);
            SortUtils.swap(intAry, j + 1 + m, k + m);
        }

        System.out.println("j=" + j);
        System.out.println("k=" + k);
        System.out.println("m=" + m);
        SortUtils.printInts(intAry);
        System.out.println();

        doQuickSortRecursive(intAry, firstIdx, j);
        doQuickSortRecursive(intAry, j + m, lastIdx);
    }
}
