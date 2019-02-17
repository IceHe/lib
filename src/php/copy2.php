<?php

// https://www.cnblogs.com/taijun/p/4208008.html

class Test {
    public $b = 1;
}

class Copy {
    public $a = 1;
    public $t;

    public function __construct($val) {
        $this->t = new Test();
    }
}

$x = new Copy(2);
$y = clone $x; // 深拷贝：但是对象中包含的对象没被 clone ……

$y->a = 2;
echo '$x->a = '.$x->a."\n";
echo '$y->a = '.$y->a."\n";
echo PHP_EOL;

// 纵然 $z 是深拷贝得来的，
// 但是 $z 和 $x, $y 都共享的对象 $t 没被深拷贝，
// 它们都是指向同一个对象的……

$y->t->b = 3;
echo '$x->t->b = '.$x->t->b."\n";
echo '$y->t->b = '.$y->t->b."\n";
echo PHP_EOL;
