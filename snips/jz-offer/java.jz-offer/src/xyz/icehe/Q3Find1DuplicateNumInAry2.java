package xyz.icehe;

import xyz.icehe.utils.CommonUtils;

/**
 * TODO: 做得太烂了, 需要重做
 */
public class Q3Find1DuplicateNumInAry2 {
    public static void main(String[] args) {
        for (int i = 0; i < 10; i++) {
            int[] tenInts = CommonUtils.genInts(10, 0, 10);
            CommonUtils.printInts(tenInts);
            int duplicateNum = find1DuplicateNumInAry(tenInts);
            System.out.println("duplicateNum=" + duplicateNum);
        }
    }

    public static int find1DuplicateNumInAry(int[] intAry) {
        if (null == intAry || intAry.length <= 0) {
            return -3;
        }

        int len = intAry.length;
        for (int j : intAry) {
            if (j < 0 || j >= len) {
                return -2;
            }
        }

        int start = 0;
        int end = len - 1;
        while (start <= end) {
            // 避免溢出的平均数计算方式
            int pivot = ((end - start) >> 1) + start;
            int cntA = 0;
            //int cntB = 0;
            for (int j : intAry) {
                if (start <= j && j <= pivot) {
                    cntA++;
                //} else {
                //    cntB++;
                }
            }
            // 疏漏
            if (start == end) {
                if (cntA > 1) {
                    return start;
                } else {
                    break;
                }
            }
            if (cntA > pivot - start + 1) {
                end = pivot;
            //} else if (cntB > end - pivot + 1) {
            //    start = pivot + 1;
            } else {
                start = pivot + 1;
            }
        }

        return -1;
    }
}
