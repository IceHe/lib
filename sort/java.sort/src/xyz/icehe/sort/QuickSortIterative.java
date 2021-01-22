package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class QuickSortIterative {

    public static void main(String[] args) {
        for (int i = 0; i < 1; i++) {
            System.out.println("Before iterative quick sorting");
            int[] intAry = SortUtils.genAndPrint10Ints();
            quickSortIterative(intAry);
            System.out.println("After iterative quick sorting");
            SortUtils.printInts(intAry);
            SortUtils.checkSortedInts(intAry);
            System.out.println();
        }
    }

    public static void quickSortIterative(int[] intAry) {
        if (null == intAry || intAry.length < 2) {
            return;
        }

        int len = intAry.length;

        int increment = 1;
        while (increment < len) {
            increment *= 2;
        }

        while (increment > 1) {
            for (int i = 0; i + 1 < len; i += increment) {
                int pivotIdx = (i + increment) / 2;
                int pivotVal = intAry[pivotIdx];
                System.out.println("pivotIdx=" + pivotIdx);
                System.out.println("pivotVal=" + pivotVal);
                SortUtils.swap(intAry, i, pivotIdx);
                int k = i;
                for (int j = i + 1; j < i + increment && j < len; j++) {
                    if (intAry[j] < pivotVal) {
                        SortUtils.swap(intAry, j, ++k);
                    }
                }
                SortUtils.swap(intAry, i, k);
            }
            SortUtils.printInts(intAry);
            increment /= 2;
        }
    }
}
