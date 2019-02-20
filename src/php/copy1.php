<?php

// https://www.cnblogs.com/taijun/p/4208008.html

// 深拷贝 & 浅拷贝
// - 深拷贝：赋值时，完全复制
//     - 修改其中一个时，不影响另一个的值
// - 浅拷贝：赋值时，引用赋值，等于取了一个别名
//     - 修改新变量时，会影响原来对象的值！

/**
 * Variable Copy
 * - 普通对象都是深拷贝
 */
$x = 1;
$y = $x; // 深拷贝

$y = 2;
echo $x."\n";
echo $y."\n";
echo PHP_EOL;

/**
 * Class Copy
 * - 对象的一般赋值都是浅拷贝
 */
class Copy {
    public $i = 1;
}

$a = new Copy();
$b = $a; // 浅拷贝
//$b = &$a; // 浅拷贝，等价于上一行
//$b = clone $a; // 深拷贝

$b->i = 2;

echo $a->i."\n";
echo $b->i."\n";
echo PHP_EOL;
// PHP 5.6 : TODO
// PHP 7 : 2, 2
