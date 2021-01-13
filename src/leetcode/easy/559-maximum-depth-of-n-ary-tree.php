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

//Recursion
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

// Iteration : using 2 stacks
//Runtime: 696 ms, faster than 33.33% of PHP online submissions for Maximum Depth of N-ary Tree.
//Memory Usage: 144.9 MB, less than 100.00% of PHP online submissions for Maximum Depth of N-ary Tree.

//class Solution {
//
//    /**
//     * @param Node $root
//     * @return Integer
//     */
//    function maxDepth($root) {
//        if ($root === null) {
//            return 0;
//        }
//
//        $depth = 0;
//
//        $stackA = [$root];
//        $stackB = [];
//
//        while (!empty($stackA) || !empty($stackB)) {
//
//            $depth++;
//            if (!empty($stackA)) {
//                while (!empty($stackA)) {
//                    $node = array_pop($stackA);
////                    foreach ($node['children'] ?? [] as $child) {
//                    foreach ($node->children as $child) {
//                        array_push($stackB, $child);
//                    }
//                }
//
//            } else if (!empty($stackB)) {
//                while (!empty($stackB)) {
//                    $node = array_pop($stackB);
////                    foreach ($node['children'] ?? [] as $child) {
//                    foreach ($node->children as $child) {
//                        array_push($stackA, $child);
//                    }
//                }
//            }
//        }
//
//        return $depth;
//    }
//}


//注意：跑的结果不稳定，有时就 1300ms 左右，有时就如下这么快……
//Runtime: 524 ms, faster than 100.00% of PHP online submissions for Maximum Depth of N-ary Tree.
//Memory Usage: 144.9 MB, less than 100.00% of PHP online submissions for Maximum Depth of N-ary Tree.

//class Solution {
//
//    /**
//     * @param Node $root
//     * @return Integer
//     */
//    function maxDepth($root) {
//        if ($root === null) {
//            return 0;
//        }
//
//        $depth = 0;
//
//        $stack = [$root];
//
//        while (!empty($stack)) {
//            $depth++;
//
//            $tmp = $stack;
//            $stack = [];
//            while (!empty($tmp)) {
//                $node = array_pop($tmp);
//                    foreach ($node['children'] ?? [] as $child) {
////                foreach ($node->children as $child) {
//                    array_push($stack, $child);
//                }
//            }
//        }
//
//        return $depth;
//    }
//}

//代码比较简洁
//Runtime: 936 ms, faster than 33.33% of PHP online submissions for Maximum Depth of N-ary Tree.
//Memory Usage: 145 MB, less than 100.00% of PHP online submissions for Maximum Depth of N-ary Tree.

//class Solution {
//
//    /**
//     * @param Node $root
//     * @return Integer
//     */
//    function maxDepth($root) {
//        if ($root === null) {
//            return 0;
//        }
//
//        $depth = 0;
//        $queue = [$root];
//
//        while (!empty($queue)) {
//            $depth++;
//            $len = count($queue);
//            for ($i = 0; $i < $len; $i++) {
////                foreach ($queue[$i]['children'] ?? [] as $child) {
//                foreach ($queue[$i]->children as $child) {
//                    array_push($queue, $child);
//                }
//            }
//            $queue = array_slice($queue, $len);
//        }
//
//        return $depth;
//    }
//}

//代码表意更明确一些，毕竟使用 queue，比上一个方法移动
//Runtime: 920 ms, faster than 33.33% of PHP online submissions for Maximum Depth of N-ary Tree.
//Memory Usage: 144.9 MB, less than 100.00% of PHP online submissions for Maximum Depth of N-ary Tree.

class Solution {

    /**
     * @param Node $root
     * @return Integer
     */
    function maxDepth($root) {
        if ($root === null) {
            return 0;
        }

        $depth = 0;
        $queue = [$root];

        while (!empty($queue)) {
            $depth++;

            $len = count($queue);
            for ($i = 0; $i < $len; $i++) {
                $node = array_shift($queue);
                foreach ($node['children'] ?? [] as $child) {
//                foreach ($node->children as $child) {
                    array_push($queue, $child);
                }
            }
        }

        return $depth;
    }
}

$jsonStr = '{"$id":"1","children":[{"$id":"2","children":[{"$id":"5","children":[],"val":5},{"$id":"6","children":[],"val":6}],"val":3},{"$id":"3","children":[],"val":2},{"$id":"4","children":[],"val":4}],"val":1}';
$ary = json_decode($jsonStr, true);
echo var_export($ary, true)."\n";
echo "\n";

$solution = new Solution();
echo var_export($solution->maxDepth($ary), true)."\n";
