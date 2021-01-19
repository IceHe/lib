package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class ShellSort {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before shell sorting");
            int[] intAry = SortUtils.genAndPrint10Ints();
            shellSort(intAry);
            System.out.println("After shell sorting");
            SortUtils.printInts(intAry);
            SortUtils.checkSortedInts(intAry);
            System.out.println();
        }
    }

    public static void shellSort(int[] intAry) {
        if (null == intAry) {
            return;
        }

        int increment = 1;
        while (increment < intAry.length) {
            increment = 3 * increment + 1;
        }

        do {
            increment = increment / 3;
            System.out.println("increment=" + increment);
            insertionSortInShellSort(intAry, increment);
        } while (increment > 1);
    }

    public static void insertionSortInShellSort(int[] intAry, int increment) {
        if (null == intAry || 0 == intAry.length || 1 == intAry.length) {
            return;
        }

        for (int startIdx = increment; startIdx < intAry.length; startIdx++) {
            for (int i = startIdx;
                    i >= increment && intAry[i - increment] > intAry[i];
                    i -= increment) {
                SortUtils.swap(intAry, i - increment, i);
            }
        }
    }
}
