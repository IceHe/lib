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

//最初的写法
//Runtime: 44 ms, faster than 100.00% of PHP online submissions for Increasing Order Search Tree.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Increasing Order Search Tree.

//class Solution {
//
//    /**
//     * @param TreeNode $root
//     * @return TreeNode
//     */
//    function increasingBST(TreeNode $root) {
//        $ary = $this->dps($root);
//
//        $len = count($ary);
//        if ($len <= 0) {
//            return null;
//        }
//
//        $root = new TreeNode($ary[0]);
//        $prev = $root;
//
//        for ($i = 1; $i < $len; $i++) {
//            $cur = new TreeNode($ary[$i]);
//            $prev->right = $cur;
//            $prev = $cur;
//        }
//
//        return $root;
//    }
//
//    private function dps(?TreeNode $root): array {
//        if ($root === null) {
//            return [];
//        }
//
//        $ary = [];
//        $this->traverseInOrder($root, $ary);
//        return $ary;
//    }
//
//    private function traverseInOrder(?TreeNode $node, array &$ary): void {
//        if ($node === null) {
//            return;
//        }
//
//        $this->traverseInOrder($node->left, $ary);
//        $ary[] = $node->val;
//        $this->traverseInOrder($node->right, $ary);
//    }
//}

//减少了中间函数
//Runtime: 56 ms, faster than 100.00% of PHP online submissions for Increasing Order Search Tree.
//Memory Usage: 16.6 MB, less than 100.00% of PHP online submissions for Increasing Order Search Tree.

//class Solution {
//
//    /**
//     * @param TreeNode $root
//     * @return TreeNode
//     */
//    function increasingBST(TreeNode $root) {
//        $ary = [];
//        $this->treeToArray($root, $ary);
//
//        $len = count($ary);
//        if ($len <= 0) {
//            return null;
//        }
//
//        $root = new TreeNode($ary[0]);
//        $prev = $root;
//
//        for ($i = 1; $i < $len; $i++) {
//            $cur = new TreeNode($ary[$i]);
//            $prev->right = $cur;
//            $prev = $cur;
//        }
//
//        return $root;
//    }
//
//    private function treeToArray(?TreeNode $node, array &$ary): void {
//        if ($node === null) {
//            return;
//        }
//
//        $this->treeToArray($node->left, $ary);
//        $ary[] = $node->val;
//        $this->treeToArray($node->right, $ary);
//    }
//}

//用一个假的根节点，让代码更简洁
//Runtime: 44 ms, faster than 100.00% of PHP online submissions for Increasing Order Search Tree.
//Memory Usage: 16.8 MB, less than 100.00% of PHP online submissions for Increasing Order Search Tree.

//class Solution {
//
//    /**
//     * @param TreeNode $root
//     * @return TreeNode
//     */
//    function increasingBST(TreeNode $root) {
//        $ary = [];
//        $this->treeToArray($root, $ary);
//
//        $len = count($ary);
//        if ($len <= 0) {
//            return null;
//        }
//
//        $tmpRoot = new TreeNode(0);
//        $cur = $tmpRoot;
//
//        for ($i = 0; $i < $len; $i++) {
//            $cur->right = new TreeNode($ary[$i]);
//            $cur = $cur->right;
//        }
//
//        return $tmpRoot->right;
//    }
//
//    private function treeToArray(?TreeNode $node, array &$ary): void {
//        if ($node === null) {
//            return;
//        }
//
//        $this->treeToArray($node->left, $ary);
//        $ary[] = $node->val;
//        $this->treeToArray($node->right, $ary);
//    }
//}

//一边遍历一边构造
//Runtime: 40 ms, faster than 100.00% of PHP online submissions for Increasing Order Search Tree.
//Memory Usage: 16.6 MB, less than 100.00% of PHP online submissions for Increasing Order Search Tree.

//class Solution {
//
//    /**
//     * @param TreeNode $root
//     * @return TreeNode
//     */
//    function increasingBST(TreeNode $root) {
//        $newRoot = new TreeNode(-1);
//        $this->rebuildTree($root, $newRoot);
//        return $newRoot;
//    }
//
//    private function rebuildTree(?TreeNode $node, ?TreeNode $destNode): ?TreeNode {
//        if ($node === null || $node->val === null || $destNode === null) {
//            return $destNode;
//        }
//
//        $destNode = $this->rebuildTree($node->left, $destNode);
//
//        if ($destNode->val === -1) {
//            $destNode->val = $node->val;
//        } else {
//            $newNode = new TreeNode($node->val);
//            $destNode->right = $newNode;
//            $destNode = $newNode;
//        }
//
//        return $this->rebuildTree($node->right, $destNode);
//    }
//}

//一边遍历一边构造
//用一个假的根节点，让代码更简洁
//Runtime: 44 ms, faster than 100.00% of PHP online submissions for Increasing Order Search Tree.
//Memory Usage: 16.6 MB, less than 100.00% of PHP online submissions for Increasing Order Search Tree.

//class Solution {
//
//    /**
//     * @param TreeNode $root
//     * @return TreeNode
//     */
//    function increasingBST(TreeNode $root) {
//        $fakeRoot = new TreeNode(0);
//        $this->rebuildTree($root, $fakeRoot);
//        return $fakeRoot->right;
//    }
//
//    private function rebuildTree(?TreeNode $node, ?TreeNode $destNode): ?TreeNode {
//        if ($node === null || $node->val === null || $destNode === null) {
//            return $destNode;
//        }
//
//        $destNode = $this->rebuildTree($node->left, $destNode);
//
//        $destNode->right = new TreeNode($node->val);
//        $destNode = $destNode->right;
//
//        return $this->rebuildTree($node->right, $destNode);
//    }
//}

//复用原来的节点！前缀遍历
//Runtime: 44 ms, faster than 100.00% of PHP online submissions for Increasing Order Search Tree.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Increasing Order Search Tree.

class Solution {

    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function increasingBST(TreeNode $root) {
        $fakeRoot = new TreeNode(0);
        $this->rebuildTree($root, $fakeRoot);
        return $fakeRoot->right;
    }

    private function rebuildTree(?TreeNode $node, TreeNode $parent): ?TreeNode {
        if (!$node) {
            return $parent;
        }

        $parent = $this->rebuildTree($node->left, $parent);

        $parent->right = $node;
        $node->left = null;

        $parent = $node;

        return $this->rebuildTree($node->right, $parent);
    }
}

$treeAry = [5,3,6,2,4,null,8,1,null,null,null,7,9];
$root = TreeNode::build($treeAry);
TreeNode::traverse($root);
echo "\n";

$solution = new Solution();
$newRoot = $solution->increasingBST($root);
TreeNode::traverse($newRoot);
