title: 某次 JavaScript 代码优化过程
date: 2015-02-20
updated: 2016-04-23
categories: [JavaScript]
tags: [JavaScript]
description: 优化某段使 id 为 blink 的 html 标签闪烁的代码。手段：用 jQuery 写法精简代码；避免重复使用选择器去获取标签和属性；改用布尔变量及“ ? &#58; ”表达式等压缩语句。
toc: false
---
目标功能：使id为blink的html标签闪烁。


我得到的原始程序：
```javascript
function blinklink() {
    if (!document.getElementById( 'blink').style.color) {
        document.getElementById( 'blink').style.color = "red" ;
    }
    if (document.getElementById( 'blink').style.color == "red" ) {
        document.getElementById( 'blink').style.color = "yellow" ;
    } else {
        document.getElementById( 'blink').style.color = "red" ;
    }
    timer = setTimeout( "blinklink()", 1000);
}

blinklink();
```


第一版修改：
```javascript
// 精简代码：使用 jQuery 写法
function blinklink() {
    if ($('#blink').css('color') == 'red'){
        $('#blink').css('color', 'white');
    } else {
        $('#blink').css('color', 'red');
    }
    timer = setTimeout('blinklink()', 1000);
}

blinklink();
```


第二版：
```javascript
// 改进定时执行的方法，是代码更容易理解
function blinklink() {
    if ($('#blink').css('color') == 'red'){
        $('#blink').css('color', 'white');
    } else {
        $('#blink').css('color', 'red');
    }
}

setInterval("blinklink();", 500);
// setInterval()：每个预设的毫秒数间隔后，执行指定函数。
// 之前这里竟然犯傻使用setTimeout()（在预设的毫秒数后，执行指定的语句）。
```


第三版：
```javascript
// 优化性能：用全局变量记录颜色值，避免每次都使用 jQuery 选择器去检索标签的属性
var color = 'red' ;
function change_color() {
    if (color == 'red'){
        color = 'white';
    } else {
        color = 'red';
    }
    return color;
}

setInterval("$('#blink').css('color', change_color);", 500);
```


第四版：
```javascript
// 精简代码：使用布尔变量
// 使用 “ ?: ” 表达式
var isRed = true;
function change_color(){
    isRed = !isRed;
    $('#blink').css('color' , isRed ? 'red' : 'white' );
}
setInterval('change_color();', 1000);
```


最终（第五）版：
```javascript
// 精简代码：压缩语句
var isRed = true;
function change_color(){
    $('#blink').css('color' , (isRed = !isRed) ? 'red' : 'white');
}
setInterval('change_color();', 750);
```

只剩下5行代码了！<br/>
即使是如此简单的地方，细想一下，
都可以有优化的空间，要勤于思考。

宽松自由的工作环境、不过于急迫的工作安排，
才能更好地避免“随意实现功能就算了”的想法，
好好地去想清楚，即使是一小段代码也要写好。
避免写出愚蠢的代码。
