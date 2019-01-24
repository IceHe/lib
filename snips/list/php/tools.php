<?php

require_once("../../sort/php/tools.php");

class ListNode {
    public $val;
    public $next;

    public function __construct($val, $next) {
        $this->val = $val;
        $this->next = $next;
    }
}

function printList(Listnode $head): void {
    if ($head == null) {
        line("null");
        return;
    }

    $cur = $head;
    while ($cur) {
        echo $cur->val . ", ";
        $cur = $cur->next;
    }
    line("null");
}

function newList(int $len = 10): ListNode {
//    $ary = rndAry($len);
    $head = null;
    $next = null;
    for ($i = 0; $i < $len; ++$i) {
        $head = new ListNode($len - $i, $next);
        $next = $head;
    }
    return $head;
}
