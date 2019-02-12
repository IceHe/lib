<?php

require_once("./utils.php");

function reverseListRecur(?ListNode $head): ListNode {
    if ($head === null || $head->next === null) {
        return $head;
    }

    $newHead = reverseListRecur($head->next);
    $head->next->next = $head;
    $head->next = null;

    return $newHead;
}

function reverseListIter(?ListNode &$head): ListNode {
    if ($head === null || $head->next === null) {
        return $head;
    }

    $prev = $head;
    $cur = $head->next;
    $next = null;

    $head->next = null;

    while ($cur) {
        $next = $cur->next;
        $cur->next = $prev;

        $prev = $cur;
        $cur = $next;
    }

    return $prev;
}

$list = newList(10);
printList($list);
printList(reverseListRecur($list));

$list = newList(10);
printList($list);
printList(reverseListIter($list));
