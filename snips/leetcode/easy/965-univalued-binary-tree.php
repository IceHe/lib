<?php

// https://leetcode.com/problems/univalued-binary-tree/

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
     * @return Boolean
     */
    function isUnivalTree($root) {

    }
}

$t1 = TreeNode::build([1,1,1,1,1,null,1]);
$t2 = TreeNode::build([2,2,2,5,2]);

$solution = new Solution();
echo $solution->isUnivalTree($t1)."\n";
echo $solution->isUnivalTree($t2)."\n";
