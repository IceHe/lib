<?php

// https://leetcode.com/problems/n-ary-tree-preorder-traversal/

/*
// Definition for a Node.
class Node {
    public $val;
    public $children;

    @param Integer $val
    @param list<Node> $children
    function __construct($val, $children) {
        $this->val = $val;
        $this->children = $children;
    }
}
*/

//Runtime: 724 ms, faster than 100.00% of PHP online submissions for N-ary Tree Preorder Traversal.
//Memory Usage: 144.8 MB, less than 100.00% of PHP online submissions for N-ary Tree Preorder Traversal.

class Solution {

    /**
     * @param Node $root
     * @return Integer[]
     */
    function preorder($root) {
        if ($root === null) {
            return [];
        }

        $track = [];
        $this->doPreorder($root, $track);
        return $track;
    }

    private function doPreorder(?Node $root, array &$track) {
        if ($root === null) {
            return;
        }

        $track[] = $root->val;

        foreach ($root->children as $child) {
            $this->doPreorder($child, $track);
        }
    }
}
