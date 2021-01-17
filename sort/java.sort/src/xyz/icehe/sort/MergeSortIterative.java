package xyz.icehe.sort;

import xyz.icehe.utils.SortUtils;

public class MergeSortIterative {

    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            System.out.println("Before iterative merge sorting");
            int[] intArray = SortUtils.genAndPrint10Ints();
            mergeSortIterative(intArray);
            System.out.println("After iterative merge sorting");
            SortUtils.printInts(intArray);
            SortUtils.checkSortedInts(intArray);
            System.out.println();
        }
    }

    public static void mergeSortIterative(int[] intAry) {
        if (null == intAry) {
            return;
        }

        int len = intAry.length;
        int increment = 2;
        while (increment < len) {
            increment *= 2;
            for (int i = 0; i < len; i += increment) {
                
            }
        }
    }

    private static void doMergeSortIterative(int[] intAry, int firstIdx, int lastIdx) {
        if (null == intAry
            || firstIdx < 0
            || lastIdx < 0
            || firstIdx >= intAry.length
            || lastIdx >= intAry.length
            || lastIdx <= firstIdx) {
            return;
        }

        int pivot = (firstIdx + lastIdx + 1) / 2;
        doMergeSortIterative(intAry, firstIdx, pivot - 1);
        doMergeSortIterative(intAry, pivot, lastIdx);

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
