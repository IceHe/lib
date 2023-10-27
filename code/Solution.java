package problem.easy.e0xx.e1.d230701.try2;

import java.util.Arrays;
import java.util.HashMap;
import java.util.Map;

// https://leetcode.cn/problems/two-sum/
public class Solution {

    // Constraints:
    // * 2 <= nums.length <= 10^4
    // * -10^9 <= nums[i] <= 10^9
    // * -10^9 <= target <= 10^9
    // * Only one valid answer exists.

    public int[] twoSum(int[] nums, int target) {
        Map<Integer, Integer> numToIndex = new HashMap<>();
        for (int i = 0; i < nums.length; i++) {
            if (numToIndex.containsKey(target - nums[i])) {
                return new int[]{numToIndex.get(target - nums[i]), i};
            }
            numToIndex.put(nums[i], i);
        }
        return new int[]{-1, -1};
    }

    public static void main(String[] args) {
        Solution solution = new Solution();

        System.out.println(Arrays.equals(solution.twoSum(new int[]{
                2, 7, 11, 15
        }, 9), new int[]{0, 1}));

        System.out.println(Arrays.equals(solution.twoSum(new int[]{
                3, 2, 4
        }, 6), new int[]{1, 2}));

        System.out.println(Arrays.equals(solution.twoSum(new int[]{
                3, 3
        }, 6), new int[]{0, 1}));

        System.out.println(Arrays.toString(solution.twoSum(new int[]{
                3, 3
        }, 6)));
    }
}
