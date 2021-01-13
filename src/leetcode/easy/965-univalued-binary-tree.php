<?php

// https://leetcode.com/problems/univalued-binary-tree/

require_once('../_utils/tree-node.php');

//Runtime: 8 ms, faster than 100.00% of PHP online submissions for Univalued Binary Tree.
//Memory Usage: 14.8 MB, less than 100.00% of PHP online submissions for Univalued Binary Tree.

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

//class Solution
//{
//
//    /**
//     * @param TreeNode $root
//     * @return Boolean
//     */
//    function isUnivalTree($root)
//    {
//        if ($root === null) {
//            return false; // exception
//        }
//
//        $val = $root->val;
//
//        if ($root->left !== null) {
//            if ($root->left->val !== $val) {
//                return false;
//            }
//            if (!$this->isUnivalTree($root->left)) {
//                return false;
//            }
//        }
//
//        if ($root->right !== null) {
//            if ($root->right->val !== $val) {
//                return false;
//            }
//            if (!$this->isUnivalTree($root->right)) {
//                return false;
//            }
//        }
//
//        return true;
//    }
//}

// 慢一点，但是代码冗余度低
//Runtime: 12 ms, faster than 85.71% of PHP online submissions for Univalued Binary Tree.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Univalued Binary Tree.

class Solution {

    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isUnivalTree($root) {
        if ($root === null) {
            return false; // exception
        }

        $val = $root->val;

        return $this->matchNodeVal($root->left, $val)
            && $this->matchNodeVal($root->right, $val);
    }

    private function matchNodeVal($node, $val) {
        if ($node === null) {
            return true;
        }

        if ($node->val !== $val) {
            return false;
        }

        if (!$this->isUnivalTree($node)) {
            return false;
        }

        return true;
    }
}

// 更慢了，代码冗余度也高
//Runtime: 16 ms, faster than 42.86% of PHP online submissions for Univalued Binary Tree.
//Memory Usage: 14.8 MB, less than 100.00% of PHP online submissions for Univalued Binary Tree.

//class Solution {
//
//    /**
//     * @param TreeNode $root
//     * @return Boolean
//     */
//    function isUnivalTree($root) {
//        if ($root === null) {
//            return true; // edge case : 这种情况怎么判定
//        }
//
//        $val = $root->val;
//
//        $leftMatch = ($root->left === null
//            || ($root->left->val === $val
//                && $this->isUnivalTree($root->left)));
//
//        $rightMatch = ($root->right === null
//            || ($root->right->val === $val
//                && $this->isUnivalTree($root->right)));
//
//        return $leftMatch && $rightMatch;
//    }
//}

$t1 = TreeNode::build([1,1,1,1,1,null,1]);
$t2 = TreeNode::build([2,2,2,5,2]);

$solution = new Solution();
echo var_export($solution->isUnivalTree($t1), true)."\n";
echo var_export($solution->isUnivalTree($t2), true)."\n";
