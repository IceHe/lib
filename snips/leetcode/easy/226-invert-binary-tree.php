<?php

// https://leetcode.com/problems/invert-binary-tree/

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

class TreeNode {
    public $val = null;
    public $left = null;
    public $right = null;
    function __construct($value) { $this->val = $value; }

    // TODO
    static function build(array $ary): ?TreeNode {
        $len = count($ary);
        if ($len === 0) {
            return null;
        }

    }
}

$treeAry = [4,2,7,1,3,6,9];


