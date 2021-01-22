package xyz.icehe.sort;

import java.util.Stack;
import java.util.concurrent.ThreadLocalRandom;

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
        Stack<Integer> stack = new Stack<>();
        stack.push(0);
        stack.push(len - 1);

        while (!stack.isEmpty()) {
            int lastIdx = stack.pop();
            int firstIdx = stack.pop();
            if (firstIdx >= lastIdx) {
                continue;
            }

            int pivotIdx = ThreadLocalRandom.current().nextInt(firstIdx, lastIdx + 1);
            int pivotVal = intAry[pivotIdx];

            //System.out.println("firstIdx=" + firstIdx);
            //System.out.println("lastIdx=" + lastIdx);
            //System.out.println("pivotIdx=" + pivotIdx);
            //System.out.println("pivotVal=" + pivotVal);
            
            SortUtils.swap(intAry, firstIdx, pivotIdx);
            int k = firstIdx;
            for (int j = firstIdx + 1; j <= lastIdx; j++) {
                if (intAry[j] < pivotVal) {
                    SortUtils.swap(intAry, j, ++k);
                }
            }
            SortUtils.swap(intAry, firstIdx, k);
            SortUtils.printInts(intAry);

            stack.push(firstIdx);
            stack.push(k - 1);
            stack.push(k + 1);
            stack.push(lastIdx);
        }
    }
}
