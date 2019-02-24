<?php

require_once('../_utils/tree-node.php');

// https://leetcode.com/problems/leaf-similar-trees/

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

//写完意识到不合理之处
//Runtime: 8 ms, faster than 100.00% of PHP online submissions for Leaf-Similar Trees.
//Memory Usage: 15 MB, less than 100.00% of PHP online submissions for Leaf-Similar Trees.

//class Solution {
//
//    /**
//     * @param TreeNode $root1
//     * @param TreeNode $root2
//     * @return Boolean
//     */
//    function leafSimilar($root1, $root2) {
//        $str1 = "";
//        $str2 = "";
//        $this->computeLeafStr($root1, $str1);
//        $this->computeLeafStr($root2, $str2);
//        return $str1 === $str2;
//    }
//
//    private function computeLeafStr(?TreeNode $node, string &$str): void {
//        if (!$node) {
//            return;
//        }
//
//        $this->computeLeafStr($node->left, $str);
//
//        if (!$node->left && !$node->right) {
//            $str .= $node->val;
//        }
//
//        $this->computeLeafStr($node->right, $str);
//    }
//}

//用数组存元素比较合理一点
//Runtime: 16 ms, faster than 100.00% of PHP online submissions for Leaf-Similar Trees.
//Memory Usage: 16.5 MB, less than 100.00% of PHP online submissions for Leaf-Similar Trees.

//class Solution {
//
//    /**
//     * @param TreeNode $root1
//     * @param TreeNode $root2
//     * @return Boolean
//     */
//    function leafSimilar($root1, $root2) {
//        $leaves1 = [];
//        $leaves2 = [];
//        $this->computeLeafStr($root1, $leaves1);
//        $this->computeLeafStr($root2, $leaves2);
//        return $leaves1 === $leaves2;
//    }
//
//    private function computeLeafStr(?TreeNode $node, array &$ary): void {
//        if (!$node) {
//            return;
//        }
//
//        $this->computeLeafStr($node->left, $ary);
//
//        if (!$node->left && !$node->right) {
//            $ary[] = $node->val;
//        }
//
//        $this->computeLeafStr($node->right, $ary);
//    }
//}

//最初方案的修正，发现其实还是只有最初的方案最快，但是正确性没有打到最确切的保证！
//Runtime: 16 ms, faster than 100.00% of PHP online submissions for Leaf-Similar Trees.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Leaf-Similar Trees.

//class Solution {
//
//    /**
//     * @param TreeNode $root1
//     * @param TreeNode $root2
//     * @return Boolean
//     */
//    function leafSimilar($root1, $root2) {
//        $str1 = "";
//        $str2 = "";
//        $this->computeLeafStr($root1, $str1);
//        $this->computeLeafStr($root2, $str2);
//        return $str1 === $str2;
//    }
//
//    private function computeLeafStr(?TreeNode $node, string &$str): void {
//        if (!$node) {
//            return;
//        }
//
//        $this->computeLeafStr($node->left, $str);
//
//        if (!$node->left && !$node->right) {
//            $str .= $node->val.',';
//        }
//
//        $this->computeLeafStr($node->right, $str);
//    }
//}

//看了别人的方案，了解到可以不用把所有叶子节点都先算出来，再全部一起对比……
//而是一个一个对比，省空间，也省时间！优雅呀
//Ref : https://leetcode.com/problems/leaf-similar-trees/discuss/152329/C%2B%2BJavaPython-O(logN)-Space


class Solution {

    /**
     * @param TreeNode $root1
     * @param TreeNode $root2
     * @return Boolean
     */
    function leafSimilar(?TreeNode $root1, ?TreeNode $root2) {
        $stack1 = [$root1];
        $stack2 = [$root2];

        while (!empty($stack1) && !empty($stack2)) {
            $leaf1Val = $this->extractNextLeafVal($stack1);
            $leaf2Val = $this->extractNextLeafVal($stack2);
            if ($leaf1Val !== $leaf2Val) {
                return false;
            }
        }

        return empty($stack1) && empty($stack2);
    }

    /**
     * @param array $stack
     * @return int|false
     */
    private function extractNextLeafVal(array &$stack) {
        while (true) {
            if (empty($stack)) {
                return false;
            }

            $peepNode = array_pop($stack);

            if ($peepNode === null) {
                continue;
            }

            if (!$peepNode->left && !$peepNode->right) {
                return $peepNode->val;
            }

            array_push($stack, $peepNode->left);
            array_push($stack, $peepNode->right);
        }
    }
}

//$root1 = TreeNode::build([3,5,1,6,2,9,8,null,null,7,4]);
//$root2 = TreeNode::build([3,5,1,6,7,4,2,null,null,null,null,null,null,9,8]);

$root1 = TreeNode::build([99,6,null,109,77,null,57,92,2,118,113]);
$root2 = TreeNode::build([87,75,null,118,12,null,null,65,2,113,92]);

TreeNode::traverse($root1);
TreeNode::traverse($root2);

//$solution = new Solution();
//echo ($solution->leafSimilar($root1, $root2) ? '1' : '0')."\n";
