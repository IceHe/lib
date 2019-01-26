#!/usr/local/bin/php -q
<?php

// error_reporting(~E_ALL);

function microtimeFloat() {
    list($usec, $sec) = explode(' ', microtime());
    return ((float)$usec + (float)$sec);
}

function statTime($funcs = [], $params = [], $times = 100 * 10000/*万*/) {
    foreach ((array) $funcs as $index => $func) {
        $time = microtimeFloat();
        for ($i = 0; $i < $times; ++$i) {
            $func($params);
        }
        echo "time[{$index}]=[".(microtimeFloat() - $time)."]\n";
    }
}
const A = '1007343817.1111681197.1005343850.1152759471.1337040644. 1722883092.1407492652.1630937482.1639733600.1732611115';

// echo '1007343817,1111681197,1005343850,1152759471,1337040644,1722883092,1407492652,1630937482,1639733600,1732611115';
// exit();

statTime([function ($params) {
    return in_array($params[0], [
        '1007343817', // 曹国伟 (新浪CEO)
        '1111681197', // 来去之间 (微博CEO)
        '1005343850', // 郑伟 (微博 副总裁)
        '1152759471', // 老王 (Feed PM)
        '1337040644', // 陈天 (微博移动 老大)
        '1722883092', // 胡波 (开发 Leader)
        '1407492652', // 朱陶 (开发 Leader)
        '1630937482', // 孙瑞 (客户端)
        '1639733600', // 康金山 (微博直播)
        '1732611115', // 田月 (UG)
    ]);
}, function ($params) {
    return false !== strpos(implode(',', [
        '1007343817', // 曹国伟 (新浪CEO)
        '1111681197', // 来去之间 (微博CEO)
        '1005343850', // 郑伟 (微博 副总裁)
        '1152759471', // 老王 (Feed PM)
        '1337040644', // 陈天 (微博移动 老大)
        '1722883092', // 胡波 (开发 Leader)
        '1407492652', // 朱陶 (开发 Leader)
        '1630937482', // 孙瑞 (客户端)
        '1639733600', // 康金山 (微博直播)
        '1732611115', // 田月 (UG)
    ]), $params[0]);
}, function ($params) {
    return false !== strpos(
        '1007343817,'. // 曹国伟 (新浪CEO)
        '1111681197,'. // 来去之间 (微博CEO)
        '1005343850,'. // 郑伟 (微博 副总裁)
        '1152759471,'. // 老王 (Feed PM)
        '1337040644,'. // 陈天 (微博移动 老大)
        '1722883092,'. // 胡波 (开发 Leader)
        '1407492652,'. // 朱陶 (开发 Leader)
        '1630937482,'. // 孙瑞 (客户端)
        '1639733600,'. // 康金山 (微博直播)
        '1732611115,'  // 田月 (UG)
    , $params[0]);
}, function ($params) {
    return false !== strpos(A, $params[0]);
}], ['1722883092']);
