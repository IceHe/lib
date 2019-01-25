<?php

function reverseListIter(?ListNode &$head): ListNode {
}

function reverseListRecur(?ListNode $head): ListNode {
}

$list = newList(10);
printList($list);
printList(reverseListIter($list));

//$list = newList(10);
//printList($list);
//printList(reverseListRecur($list));
