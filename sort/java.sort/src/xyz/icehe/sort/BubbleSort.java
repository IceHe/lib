package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class BubbleSort {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before bubble sorting");
            int[] intAry = SortUtils.genAndPrint10Ints();
            bubbleSort(intAry);
            System.out.println("After bubble sorting");
            SortUtils.printInts(intAry);
            SortUtils.checkSortedInts(intAry);
            System.out.println();
        }
    }

    public static void bubbleSort(int[] intAry) {
        if (null == intAry) {
            return;
        }

        for (int times = 1; times < intAry.length; times++) {
            boolean isSorted = true;
            for (int i = intAry.length - 1; i >= times; i--) {
                if (intAry[i - 1] > intAry[i]) {
                    SortUtils.swap(intAry, i - 1, i);
                    isSorted = false;
                }
            }
            if (isSorted) {
                break;
            }
        }
    }
}
