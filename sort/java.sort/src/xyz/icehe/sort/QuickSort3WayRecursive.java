package xyz.icehe.sort;

import java.util.concurrent.ThreadLocalRandom;

import xyz.icehe.utils.SortUtils;

public class QuickSort3WayRecursive {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before recursive quick sorting");
            int[] intAry = SortUtils.genAndPrint10Ints();
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
            || lastIdx >= intAry.length) {
            return;
        }

        int pivotIdx = ThreadLocalRandom.current().nextInt(firstIdx, lastIdx + 1);
        SortUtils.swap(intAry, firstIdx, pivotIdx);

        int lfIdx = firstIdx - 1;
        int rgIdx = lastIdx;
        do {
            int pivotVal = intAry[lastIdx];
            while (intAry[++lfIdx] < pivotVal) { ; }
            while (rgIdx > 0 && intAry[--rgIdx] > pivotVal) { ; }
            SortUtils.swap(intAry, lfIdx, rgIdx);
        } while (lfIdx < rgIdx);
        SortUtils.swap(intAry, lfIdx, rgIdx);

        int newPivotIdx = lfIdx;
        SortUtils.swap(intAry, newPivotIdx, lastIdx);

        doQuickSortRecursive(intAry, firstIdx, newPivotIdx - 1);
        doQuickSortRecursive(intAry, newPivotIdx + 1, lastIdx);
    }
}
