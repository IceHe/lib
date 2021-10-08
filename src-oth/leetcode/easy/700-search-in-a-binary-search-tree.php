<?php

// https://leetcode.com/problems/invert-binary-tree/

require_once('../_utils/tree-node.php');

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

//Runtime: 40 ms, faster than 60.00% of PHP online submissions for Search in a Binary Search Tree.
//Memory Usage: 17.1 MB, less than 100.00% of PHP online submissions for Search in a Binary Search Tree.

//class Solution {
//
//    /**
//     * @param TreeNode $root
//     * @param Integer $val
//     * @return TreeNode
//     */
//    function searchBST(?TreeNode $root, int $val): ?TreeNode {
//        if ($root === null) {
//            return null;
//        }
//
//        if ($root->val === $val) {
//            return $root;
//        } else if ($root->val > $val) {
//            return $this->searchBST($root->left, $val);
//        } else { // ($root->val < $val)
//            return $this->searchBST($root->right, $val);
//        }
//    }
//}

class Solution {

    /**
     * @param TreeNode $root
     * @param Integer $val
     * @return TreeNode
     */
    function searchBST(?TreeNode $root, int $val): ?TreeNode {
        if ($root === null) {
            return null;
        }

        if ($root->val === $val) {
            return $root;
        } else if ($root->val > $val) {
            return $this->searchBST($root->left, $val);
        } else { // ($root->val < $val)
            return $this->searchBST($root->right, $val);
        }
    }
}

$root = [4,2,7,1,3];
$val = 2;

//$root = [18,2,22,null,null,null,63,null,84,null,null];
//$val = 63;

$root = TreeNode::build($root, true);
TreeNode::traverse($root);

echo "-------------\n";

$solution = new Solution();
$result = $solution->searchBST($root, $val);
TreeNode::traverse($result);

