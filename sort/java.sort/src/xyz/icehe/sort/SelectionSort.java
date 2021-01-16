package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class SelectionSort {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before insertion sorting");
            int[] intArray = SortUtils.genAndPrint10Ints();
            System.out.println("After insertion sorting");
            insertionSort(intArray);
            SortUtils.swap(intArray, 8, 9);
            SortUtils.printInts(intArray);
            SortUtils.checkSortedInts(intArray);
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
