package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class SelectionSort {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before selection sorting");
            int[] intAry = SortUtils.genAndPrint10Ints();
            selectionSort(intAry);
            System.out.println("After selection sorting");
            SortUtils.printInts(intAry);
            SortUtils.checkSortedInts(intAry);
            System.out.println();
        }
    }

    public static void selectionSort(int[] intAry) {
        if (null == intAry) {
            return;
        }

        for (int idx = 0; idx < intAry.length - 1; idx++) {
            int minValIdx = idx;
            for (int i = idx; i < intAry.length; i++) {
                if (intAry[i] < intAry[minValIdx]) {
                    minValIdx = i;
                }
            }
            if (minValIdx != idx) {
                SortUtils.swap(intAry, idx, minValIdx);
            }
        }
    }
}
