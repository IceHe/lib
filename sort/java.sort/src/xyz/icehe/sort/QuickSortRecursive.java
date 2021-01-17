package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class QuickSortRecursive {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before recursive quick sorting");
            int[] intArray = SortUtils.genAndPrint10Ints();
            quickSortRecursive(intArray);
            System.out.println("After recursive quick sorting");
            SortUtils.printInts(intArray);
            SortUtils.checkSortedInts(intArray);
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

        int pivot = (firstIdx + lastIdx + 1) / 2;
        doQuickSortRecursive(intAry, firstIdx, pivot - 1);
        doQuickSortRecursive(intAry, pivot, lastIdx);

        int[] tmpIntAry = new int[lastIdx - firstIdx + 1];

        int i = 0;
        int j = firstIdx;
        int k = pivot;
        do {
            if (intAry[j] <= intAry[k]) {
                tmpIntAry[i] = intAry[j];
                j++;
            } else {
                tmpIntAry[i] = intAry[k];
                k++;
            }
            i++;
        } while (j < pivot && k < lastIdx + 1);

        while (j < pivot) {
            tmpIntAry[i++] = intAry[j++];
        }

        while (k < lastIdx + 1) {
            tmpIntAry[i++] = intAry[k++];
        }

        // Replace with built-in function
        //for (int idx = 0; idx < tmpIntAry.length; idx++) {
        //    intAry[idx + firstIdx] = tmpIntAry[idx];
        //}
        System.arraycopy(tmpIntAry, 0, intAry, firstIdx, tmpIntAry.length);
    }
}
