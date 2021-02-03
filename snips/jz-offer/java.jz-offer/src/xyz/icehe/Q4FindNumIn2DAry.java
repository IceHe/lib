package xyz.icehe;

import com.sun.tools.javac.util.Pair;
import xyz.icehe.utils.CommonUtils;

public class Q4FindNumIn2DAry {
    public static void main(String[] args) {
        int[][] ary2d = new int[][] {
            {1, 2, 8, 9},
            {2, 4, 9, 12},
            {4, 7, 10, 13},
            {6, 8, 11, 15}
        };
        for (int[] ints : ary2d) {
            CommonUtils.printInts(ints);
        }
        Pair<Integer, Integer> coordinate = existsNumIn2dAry(ary2d, 0);
        System.out.println("0 @ " + coordinate);
        coordinate = existsNumIn2dAry(ary2d, 1);
        System.out.println("1 @ " + coordinate);
        coordinate = existsNumIn2dAry(ary2d, 7);
        System.out.println("7 @ " + coordinate);
        coordinate = existsNumIn2dAry(ary2d, 15);
        System.out.println("15 @ " + coordinate);
        coordinate = existsNumIn2dAry(ary2d, 16);
        System.out.println("16 @ " + coordinate);
    }

    private static Pair<Integer, Integer> existsNumIn2dAry(int[][] ary2d, int targetVal) {
        if (null == ary2d
            || ary2d.length == 0
            || ary2d[0].length == 0) {
            return Pair.of(-1, -1);
        }

        int rowCnt = ary2d[0].length;
        int colCnt = ary2d.length;

        int row = 0;
        int col = colCnt - 1;
        while (row < rowCnt && col >= 0) {
            int val = ary2d[row][col];
            if (val == targetVal) {
                return Pair.of(row, col);
            } else if (val > targetVal) {
                col--;
            } else { // (val < targetVal)
                row++;
            }
            System.out.println(Pair.of(row, col));
        }

        return Pair.of(-1, -1);
    }
}
