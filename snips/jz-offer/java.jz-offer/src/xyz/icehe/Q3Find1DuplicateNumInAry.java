package xyz.icehe;

import xyz.icehe.utils.CommonUtils;

public class Q3Find1DuplicateNumInAry {
    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            int[] tenInts = CommonUtils.genInts(10, 0, 10);
            CommonUtils.printInts(tenInts);
            int duplicateNum = find1DuplicateNumInAry(tenInts);
            System.out.println("duplicateNum=" + duplicateNum);
        }
    }

    public static int find1DuplicateNumInAry(int[] intAry) {
        if (null == intAry || 0 == intAry.length) {
            return -3;
        }
        int len = intAry.length;
        for (int i = 0; i < len; i++) {
            int val = intAry[i];
            if (val < 0 || val >= len) {
                return -2;
            }
            if (i == val) {
                continue;
            }
            if (val == intAry[val]) {
                return val;
            }
            CommonUtils.swap(intAry, i, val);
        }
        return -1;
    }

    public static int find1DuplicateNumInAry2(int[] intAry) {
        if (null == intAry || 0 == intAry.length) {
            return -3;
        }

        // 循环拆分, 方便理解
        int len = intAry.length;
        for (int j : intAry) {
            // 最初写成 <= 0, 太弱智了…
            if (j < 0 || j >= len) {
                return -2;
            }
        }

        for (int i = 0; i < len; i++) {
            int val = intAry[i];
            // 最初忘记 "跳过" 了, 通过测试才发现…
            if (i == val) {
                continue;
            }
            if (val == intAry[val]) {
                return val;
            }
            CommonUtils.swap(intAry, i, val);
        }
        return -1;
    }
}
