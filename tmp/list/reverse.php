<?php

function reverseList(?ListNode &$head): ListNode {
    if ($head == null || $head->next == null) {
        return $head;
    }

    $newHead = reverseList($head->next);
    $head->next->next = $head;
    $head->next = null;
    return $newHead;
}

function reverseList2(?ListNode $head): ListNode {
    if ($head == null) {
        return null;
    }

    $prev = $head;
    $cur = $head->next;
    $next = null;

    while ($cur) {
        $next = $cur->next;
        $cur->next = $prev;

        $prev = $cur;
        $cur = $next;
    }

    $head->next = null;
    return $prev;
}


$list = newList(10);
printList($list);
printList(reverseList($list));

$list = newList(10);
printList($list);
printList(reverseList2($list));
