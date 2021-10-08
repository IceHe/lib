package easy.e463;

// https://leetcode.com/problems/island-perimeter

//Runtime: 54 ms, faster than 90.08% of Java online submissions for Island Perimeter.
//Memory Usage: 60.7 MB, less than 40.52% of Java online submissions for Island Perimeter.

class Solution {
    public int islandPerimeter(int[][] grid) {
        int width = grid.length;
        int height = grid[0].length;

        int perimeter = 0;
        for (int x = 0; x < width; x++) {
            for (int y = 0; y < height; y++) {
                if (grid[x][y] == 0) { // should != 1
                    continue;
                }

                // left
                if (x == 0 || grid[x - 1][y] == 0) {
                    perimeter++;
                }
                // top
                if (y == 0 || grid[x][y - 1] == 0) {
                    perimeter++;
                }
                // right
                if (x == width - 1 || grid[x + 1][y] == 0) {
                    perimeter++;
                }
                // bottom
                if (y == height - 1 || grid[x][y + 1] == 0) {
                    perimeter++;
                }
            }
        }

        return perimeter;
    }

    public static void main(String[] args) {
        int[][] grid = new int[][]{
                {0,1,0,0},
                {1,1,1,0},
                {0,1,0,0},
                {1,1,0,0},
        };

        System.out.println((new Solution()).islandPerimeter(grid));
    }
}

