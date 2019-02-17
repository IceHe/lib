<?php

// https://leetcode.com/problems/n-ary-tree-postorder-traversal/

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
//Runtime: 628 ms, faster than 100.00% of PHP online submissions for N-ary Tree Postorder Traversal.
//Memory Usage: 145.2 MB, less than 100.00% of PHP online submissions for N-ary Tree Postorder Traversal.

//class Solution {
//
//    /**
//     * @param Node $root
//     * @return Integer[]
//     */
//    function postorder($root) {
//        if ($root === null) {
//            return [];
//        }
//
//        $track = [];
//        $this->doPostorder($root, $track);
//        return $track;
//    }
//
//    private function doPostorder(?Node $node, array &$track): void {
//        if ($node === null) {
//            return;
//        }
//
//        foreach ($node->children as $child) {
//            $this->doPostorder($child, $track);
//        }
//
//        $track[] = $node->val;
//    }
//}

//Iteration
//Runtime: 608 ms, faster than 100.00% of PHP online submissions for N-ary Tree Postorder Traversal.
//Memory Usage: 145 MB, less than 100.00% of PHP online submissions for N-ary Tree Postorder Traversal.

//class Solution {
//
//    /**
//     * @param Node $root
//     * @return Integer[]
//     */
//    function postorder($root) {
//        if ($root === null) {
//            return [];
//        }
//
//        $track = [];
//        $stack = [$root];
//
//        while (!empty($stack)) {
//            $peep = end($stack);
//            if (empty($peep->children)) {
//                array_pop($stack);
//                $track[] = $peep->val;
//            } else {
//                foreach (array_reverse($peep->children) as $child) {
//                    array_push($stack, $child);
//                }
//                $peep->children = null;
//            }
//        }
//
//        return $track;
//    }
//}

//Iteration2
//Runtime: 552 ms, faster than 100.00% of PHP online submissions for N-ary Tree Postorder Traversal.
//Memory Usage: 145 MB, less than 100.00% of PHP online submissions for N-ary Tree Postorder Traversal.

class Solution {

    /**
     * @param Node $root
     * @return Integer[]
     */
    function postorder($root) {
        if ($root === null) {
            return [];
        }

        $track = [];
        $stack = [$root];

        while (!empty($stack)) {
            $node = array_pop($stack);
//            if ($node === null) {
//                continue;
//            }

            $track[] = $node->val;
            foreach ($node->children as $child) {
                array_push($stack, $child);
            }
        }

        return array_reverse($track);
    }
}
