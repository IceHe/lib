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
class Solution {
    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function invertTree(?TreeNode $root): ?TreeNode {
        if ($root === null) {
            return null;
        }

        if ($root->left === null && $root->right === null) {
            return $root;
        }

        $tmpLeft = $root->left;
        $root->left = $root->right;
        $root->right = $tmpLeft;

        $this->invertTree($root->left);
        $this->invertTree($root->right);

        return $root;
    }
}

$treeAry = [4,2,7,1,3,6,9];
$treeNode = TreeNode::build($treeAry);
TreeNode::traverse($treeNode);

echo "-------------\n";

$solution = new Solution();
$solution->invertTree($treeNode);
TreeNode::traverse($treeNode);

