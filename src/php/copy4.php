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
// 使用序列化来进行「深拷贝」，那就可以省得要写 __clone 了……
$y = serialize($x);
$y = unserialize($y);

$y->a = 2;
echo '$x->a = '.$x->a."\n";
echo '$y->a = '.$y->a."\n";
echo PHP_EOL;

$y->t->b = 3;
echo '$x->t->b = '.$x->t->b."\n";
echo '$y->t->b = '.$y->t->b."\n";
echo PHP_EOL;
