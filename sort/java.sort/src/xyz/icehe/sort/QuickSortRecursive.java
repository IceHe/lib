package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class QuickSortRecursive {

    public static void main(String[] args) {
        for (int i = 0; i < 1; i++) {
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
            || lastIdx < 0
            || lastIdx <= firstIdx
            || lastIdx >= intAry.length) {
            return;
        }

        int pivot = (firstIdx + lastIdx) / 2;
        doQuickSortRecursive(intAry, firstIdx, pivot);
        doQuickSortRecursive(intAry, pivot + 1, lastIdx);
        SortUtils.printInts(intAry);

        SortUtils.swap(intAry, pivot, lastIdx);
        int lfIdx = firstIdx;
        int rgIdx = lastIdx - 1;
        while (lfIdx < rgIdx) {
            while (intAry[lfIdx] < intAry[lastIdx]) {
                lfIdx++;
            }
            while (rgIdx > 0 && intAry[rgIdx] > intAry[lastIdx]) {
                rgIdx--;
            }
            SortUtils.swap(intAry, lfIdx, rgIdx);
        }
        SortUtils.swap(intAry, lfIdx, lastIdx);
    }
}
