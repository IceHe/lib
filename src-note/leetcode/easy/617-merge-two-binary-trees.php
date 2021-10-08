<?php

// https://leetcode.com/problems/merge-two-binary-trees/

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
     * @param TreeNode $t1
     * @param TreeNode $t2
     * @return TreeNode
     */
    function mergeTrees($t1, $t2) {
        if ($t1 === null && $t2 === null) {
            return null;
        }

        $node = new TreeNode(($t1->val ?? 0) + ($t2->val ?? 0));

        $node->left = $this->mergeTrees($t1->left ?? null, $t2->left ?? null);
        $node->right = $this->mergeTrees($t1->right ?? null, $t2->right ?? null);

        return $node;
    }
}

class Solution2 {

    /**
     * @param TreeNode $t1
     * @param TreeNode $t2
     * @return TreeNode
     */
    function mergeTrees($t1, $t2) {
        if ($t1 === null) {
            return $t2;
        }
        if ($t2 === null) {
            return $t1;
        }

        $t1->val = ($t1->val ?? 0) + ($t2->val ?? 0);

        $t1->left = $this->mergeTrees($t1->left ?? null, $t2->left ?? null);
        $t1->right = $this->mergeTrees($t1->right ?? null, $t2->right ?? null);

        return $t1;
    }
}

$t1 = TreeNode::build([1,3,2,5]);
$t2 = TreeNode::build([2,1,3,null,4,null,7]);

TreeNode::traverse($t1);
echo "----------\n";
TreeNode::traverse($t2);
echo "----------\n";

$solution = new Solution();
$result = $solution->mergeTrees($t1, $t2);
TreeNode::traverse($result);
echo "----------\n";

$solution2 = new Solution2();
$result2 = $solution2->mergeTrees($t1, $t2);
TreeNode::traverse($result2);
echo "----------\n";
