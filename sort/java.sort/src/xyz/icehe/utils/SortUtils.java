package xyz.icehe.utils;

import java.util.Arrays;
import java.util.concurrent.ThreadLocalRandom;

public class SortUtils {

    private static final int MIN_INCLUSIVE = 0;
    private static final int MAX_EXCLUSIVE = 100;

    public static void swap(int[] intAry, int idxA, int idxB) {
        if (null == intAry
                || idxA == idxB
                || idxA < 0
                || idxB < 0
                || idxA >= intAry.length
                || idxB >= intAry.length) {
            return;
        }

        int temp = intAry[idxA];
        intAry[idxA] = intAry[idxB];
        intAry[idxB] = temp;
    }

    public static int[] genAndPrint10Ints() {
        int[] intAry = genInts(10, MIN_INCLUSIVE, MAX_EXCLUSIVE);
        printInts(intAry);
        return intAry;
    }

    public static int[] genInts(int len, int minInclusive, int maxExclusive) {
        if (len < 0 || minInclusive > maxExclusive) {
            return null;
        }

        int[] intAry = new int[len];
        for (int i = 0; i < intAry.length; i++) {
            intAry[i] = ThreadLocalRandom.current().nextInt(minInclusive, maxExclusive);
        }
        return intAry;
    }

    public static void printInts(int[] intAry) {
        System.out.println(Arrays.toString(intAry));
    }

    public static void checkSortedInts(int[] intAry) {
        if (isSortedInts(intAry)) {
            System.out.println("Sorted.");
        } else {
            System.out.println("Not sorted!");
            System.err.println("Not sorted!");
        }
    }

    public static boolean isSortedInts(int[] intAry) {
        if (null == intAry || 0 == intAry.length || 1 == intAry.length) {
            return true;
        }

        for (int i = 0; i < intAry.length - 1; i++) {
            if (intAry[i] > intAry[i + 1]) {
                return false;
            }
        }
        return true;
    }
}
