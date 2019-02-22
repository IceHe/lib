<?php

require_once('../_utils/tree-node.php');

// https://leetcode.com/problems/increasing-order-search-tree/

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
    function increasingBST(TreeNode $root) {
        $ary = $this->dps($root);

        $len = count($ary);
        if ($len <= 0) {
            return null;
        }

        $root = new TreeNode($ary[0]);
        $prev = $root;

        for ($i = 1; $i < $len; $i++) {
            $cur = new TreeNode($ary[$i]);
            $prev->right = $cur;
            $prev = $cur;
        }

        return $root;
    }

    private function dps(?TreeNode $root): array {
        if ($root === null) {
            return [];
        }

        $ary = [];
        $this->traverseInOrder($root, $ary);
        return $ary;
    }

    private function traverseInOrder(?TreeNode $node, array &$ary): void {
        if ($node === null) {
            return;
        }

        $this->traverseInOrder($node->left, $ary);
        $ary[] = $node->val;
        $this->traverseInOrder($node->right, $ary);
    }
}

$treeAry = [5,3,6,2,4,null,8,1,null,null,null,7,9];
$root = TreeNode::build($treeAry);
TreeNode::traverse($root);
echo "\n";

$solution = new Solution();
$newRoot = $solution->increasingBST($root);
TreeNode::traverse($newRoot);
