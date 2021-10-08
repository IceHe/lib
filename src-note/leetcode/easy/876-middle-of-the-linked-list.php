<?php

// https://leetcode.com/problems/middle-of-the-linked-list/

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

//Runtime: 16 ms, faster than 100.00% of PHP online submissions for Middle of the Linked List.
//Memory Usage: 15 MB, less than 100.00% of PHP online submissions for Middle of the Linked List.

//class Solution {
//
//    /**
//     * @param ListNode $head
//     * @return ListNode
//     */
//    function middleNode($head) {
//        $fastPtr = $head;
//        $slowPtr = $head;
//
//        while ($fastPtr) {
//            $fastPtr = $fastPtr->next;
//            if (!$fastPtr) {
//                return $slowPtr;
//            }
//
//            $fastPtr = $fastPtr->next;
//            $slowPtr = $slowPtr->next;
//        }
//
//        return $slowPtr;
//    }
//}

//更简洁的写法

class Solution {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function middleNode($head) {
        $fastPtr = $head;
        $slowPtr = $head;

        while ($fastPtr && $fastPtr->next) {
            $fastPtr = $fastPtr->next->next;
            $slowPtr = $slowPtr->next;
        }

        return $slowPtr;
    }
}

