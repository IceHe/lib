package xyz.icehe.sort;

import java.util.concurrent.ThreadLocalRandom;

import xyz.icehe.utils.SortUtils;

public class QuickSortRecursiveSimple {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before simple recursive quick sorting");
            int[] intAry = SortUtils.genAndPrint10Ints();
            quickSortRecursive(intAry);
            System.out.println("After simple recursive quick sorting");
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
        SortUtils.swap(intAry, firstIdx, pivotIdx);

        int k = firstIdx;
        for (int i = firstIdx + 1; i <= lastIdx; i++) {
            if (intAry[i] < pivotVal) {
                SortUtils.swap(intAry, i, ++k);
            }
        }

        int newPivotIdx = k;
        SortUtils.swap(intAry, firstIdx, newPivotIdx);
        doQuickSortRecursive(intAry, firstIdx, newPivotIdx - 1);
        doQuickSortRecursive(intAry, newPivotIdx + 1, lastIdx);
    }
}
