package xyz.icehe.sort;

import java.util.SortedSet;
import java.util.concurrent.ThreadLocalRandom;

import xyz.icehe.utils.SortUtils;

public class QuickSortRecursive1 {

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
        if (null == intAry) {
            return;
        }

        int pivotIdx = ThreadLocalRandom.current().nextInt(firstIdx, lastIdx + 1);
        SortUtils.swap(intAry, firstIdx, pivotIdx);
    }
}
