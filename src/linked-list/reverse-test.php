<?php

require_once("./utils.php");

function reverseListRecur(?ListNode $head): ListNode {

}

function reverseListIter(?ListNode &$head): ListNode {

}

$list = newList(10);
printList($list);
printList(reverseListRecur($list));

$list = newList(10);
printList($list);
printList(reverseListIter($list));
