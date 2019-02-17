<?php

// 引用 bug

$ary = [1, 2, 3];

foreach ($ary as &$v) {

}

foreach ($ary as $v) {

}

var_dump($ary); // [1, 2, 2]
// why?
