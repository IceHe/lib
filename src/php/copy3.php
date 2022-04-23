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

    // 使用魔术方法，把对象都进行深拷贝
    public function __clone() {
        $this->t = clone $this->t;
    }
}

$x = new Copy(2);
$y = clone $x; // 深拷贝

$y->a = 2;
echo '$x->a = '.$x->a."\n";
echo '$y->a = '.$y->a."\n";
echo PHP_EOL;

$y->t->b = 3;
echo '$x->t->b = '.$x->t->b."\n";
echo '$y->t->b = '.$y->t->b."\n";
echo PHP_EOL;
