package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class InsertionSort {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before insertion sorting");
            int[] intAry = SortUtils.genAndPrint10Ints();
            insertionSort(intAry);
            System.out.println("After insertion sorting");
            SortUtils.printInts(intAry);
            SortUtils.checkSortedInts(intAry);
            System.out.println();
        }
    }

    public static void insertionSort(int[] intAry) {
        if (null == intAry) {
            return;
        }

        for (int times = 1; times < intAry.length; times++) {
            for (int i = times; i > 0 && intAry[i - 1] > intAry[i]; i--) {
                SortUtils.swap(intAry, i - 1, i);
            }
        }
    }
}
