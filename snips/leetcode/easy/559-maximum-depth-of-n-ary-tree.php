<?php

// https://leetcode.com/problems/maximum-depth-of-n-ary-tree/

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

//Runtime: 1300 ms, faster than 33.33% of PHP online submissions for Maximum Depth of N-ary Tree.
//Memory Usage: 145.1 MB, less than 100.00% of PHP online submissions for Maximum Depth of N-ary Tree.

//class Solution {
//    /**
//     * @param Node $root
//     * @return Integer
//     */
//    function maxDepth($root) {
//        return $this->computeMaxDepth($root, 0);
//    }
//
//    private function computeMaxDepth($root, $depth) {
//        if ($root === null) {
//            return $depth;
//        }
//
////        if (empty($root['children'])) {
//        if (empty($root->children)) {
//            return $depth + 1;
//        }
//
//        $currentMaxDepth = 0;
////        foreach ($root['children'] as $child) {
//        foreach ($root->children as $child) {
//            $tmpMaxDepth = $this->computeMaxDepth($child, $depth + 1);
//            if ($currentMaxDepth < $tmpMaxDepth) {
//                $currentMaxDepth = $tmpMaxDepth;
//            }
//        }
//
//        return $currentMaxDepth;
//    }
//}

class Solution {

    /**
     * @param Node $root
     * @return Integer
     */
    function maxDepth($root) {
        return $this->computeMaxDepth($root, 0);
    }

    private function computeMaxDepth($root, $depth) {
        if ($root === null) {
            return $depth;
        }

//        if (empty($root['children'])) {
        if (empty($root->children)) {
            return $depth + 1;
        }

        $currentMaxDepth = 0;
//        foreach ($root['children'] as $child) {
        foreach ($root->children as $child) {
            $tmpMaxDepth = $this->computeMaxDepth($child, $depth + 1);
            if ($currentMaxDepth < $tmpMaxDepth) {
                $currentMaxDepth = $tmpMaxDepth;
            }
        }

        return $currentMaxDepth;
    }
}


$jsonStr = '{"$id":"1","children":[{"$id":"2","children":[{"$id":"5","children":[],"val":5},{"$id":"6","children":[],"val":6}],"val":3},{"$id":"3","children":[],"val":2},{"$id":"4","children":[],"val":4}],"val":1}';
$ary = json_decode($jsonStr, true);
echo var_export($ary, true)."\n";
echo "\n";

$solution = new Solution();
echo var_export($solution->maxDepth($ary), true)."\n";
