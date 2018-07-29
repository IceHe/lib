title: PHP Note
---

[Mac 安裝 pecl ，安裝 php extension](blog.caesarchi.com/2012/03/mac-pecl-php-extension.html)
[Install PHP pear (要用pecl只要装pear)](http://www.cnblogs.com/bugY/archive/2012/07/06/2578972.html)

# PHP 判断某函数是否存在

function_exists($function_name)
判断一个全局函数是否存在
调用方法：$function_name($param)

method_exists($object, $function_name)
判断某对象是否存在某方法
调用方法：$object->$function_name($param)

（例）
$funcName = 'test_func';
method_exists($this, $funcName);
$this->$funcName($param);

# PHP 对象的属性使用非常规命名时的访问方法

object(SimpleXMLElement)[10]
  public 'source-url' => string 'file://C:\wamp\www\t_html_out.html' (length=34)
  public 'file-name' => string 't_html_out.html' (length=15)
  public 'attachment' => string 'true' (length=4)

如上文中PHP对象的属性名 source-url、file-name，
它们使用了非常规的命名，如属性名中带有减号 - 。

导致无法直接使用 $obj->source-url 的写法来访问！

此时，使用特殊的语法：$obj->{"source-url"} 来访问。

# Where is php.ini?

MacOS，brew 安装的php的 php.ini 文件在：
/usr/local/etc/php/版本号/php.ini

# PHP Comm Func

mock     a. 仿制的，模拟的

str_replace(src, dest, string)
urldecode(string)

trim(string, … )
Strip whitespace(or other characters) from the beginning and end of string
trim     修剪

strip_tags(string, … )
Strip HTML and PHP tag from a string
strip     剥去

addslashes(string)
Quote string with slashes
给字符串中的需要转义的字符加上反斜杠（转义符）
slash     削减，\反斜杠
quote     引用

ctype_type(string)
Check for numeric character(s)
Check if all of the characters in the provided string, text, are numerical.

ctype_alnum(stirng)
Check for alphanumeric character(s)
alphabet     字母表
alphanumerice     字母数字的

is_integer(var)
is_string(var)
is_array(var)

array_keys(array)
Return all the keys or a subset of the keys of an array

array_diff(array)

array_merge(array)
If the input arrays have the same string keys, then the later value for that key will overwrite the previous one. If, however, the arrays contain numeric keys, the later value will not overwrite the original value, but will be appended.

implode(string)
explode(string)

# Install PHPUnit - OS X

操作系统版本：Mac OS 10.10.4 (14E46)

http://gitlab.weibo.cn/mobile-api/mobile-api-v5-application/wikis/unit-test-instruction
unit test instruction:
PHPUnit生成代码覆盖率需要xdebug插件。所以需要安装该插件。

http://xdebug.org/docs/install
XDEBUG EXTENSION FOR PHP | DOCUMENTATION:
PECL Installation

http://blog.caesarchi.com/2012/03/mac-pecl-php-extension.html
Mac 安裝 pecl ，安裝 php extension:
wget http://pear.php.net/go-pear.phar
php -d detect_unicode=0 go-pear.phar

接著會顯示一些選項，如果都不需要可以直接輸入enter跳過， 最後會顯示資訊如下，
Would you like to alter php.ini </private/etc/php.ini>?
當然輸入Y，自動設定php.ini 之後結束安裝。

之後設定自己的PATH 環境變數，加入底下的路徑
export PATH=$PATH:/Users/$USER/pear/bin

然后按照《XDEBUG EXTENSION FOR PHP》教程（上文第二个链接）所说，输入以下指令安装XDEBUG
pecl install xdebug

发现提示错误：
Cannot find autoconf. Please check your autoconf installation and the
$PHP_AUTOCONF environment variable. Then, rerun this script.

因此根据要求安装 autoconf
brew install autoconf
再次执行
pecl install xdebug

安装成功后，显示结果的最后一行的用户提示如下：
You should add "zend_extension=/usr/lib/php/extensions/no-debug-non-zts-20121212/xdebug.so" to php.ini

然后在php.ini末尾添加如下两行：
; MY OWN CONFIG FOR XDEBUG
zend_extension=/usr/lib/php/extensions/no-debug-non-zts-20121212/xdebug.so

发现不知道php.ini文件在哪里，使用 php --ini 指令也无法确定位置
http://stackoverflyeow.com/questions/9343151/where-is-php-ini-in-mac-os-x-lion-thought-it-was-in-usr-local-php5-lib
根据以上StackOverflow该问题的第一个答案，了解到系统默认版本的php还没有php.ini
sudo cp /private/etc/php.ini.default /private/etc/php.ini

但是拷贝出来的文件没有写权限。
不一定按照以下指令执行，具体给那些角色赋予权限要看具体情况
sudo chmod a+w php.ini

然后就可以顺利编辑 php.ini 了。

然后根据《unit test instruction》教程（上文第一个链接）继续安装PHPUnit
根据以下内容操作无果……
“
v5代码目录下，包含了phpunit及其依赖包，可以直接执行该phpunit。
./vendor/phpunit/phpunit/phpunit --version
在tests目录下，执行
./vendor/phpunit/phpunit/phpunit src/
可以查看执行过程。 为了避免麻烦，也可以直接将./vendor/phpunit/phpunit/phpunit链接到/usr/bin目录下。
ln -s /data1/v5.weibo.cn/code/vendor/phpunit/phpunit/phpunit /usr/bin/
”

于是，根据《unit test instruction》教程原文，执行“自己通过composer安装phpunit”的步骤。
安装composer：
curl -sS https://getcomposer.org/installer | php
感觉资源十分不稳定，许多次执行指令后才成功安装，最好选择其它途径下载安装。

执行安装
chmod a+x composer.phar
php composer.phar install --dev
装完……命令行没有识别出phpunit命令，什么鬼！
感觉实际上没有装好！我快崩溃了……什么过时教程。

遭遇以上情况，使用brew进行安装
$ brew install phpunit
Error: No available formula for phpunit
Searching formulae...
Searching taps...
homebrew/php/phpunit-skeleton-generator             homebrew/php/phpunit

这时发现，以上输出的提示 homebrew/php/phpunit，于是使用指令
brew install homebrew/php/phpunit

# PHP Encoding Convert of File & Str 文件、字符串编码转换

http://www.veryhuo.com/a/view/41348.html

处理字符串时，需要字符编码转换，
碰到iconv转换失败的诡异问题。

因为iconv有bug ，碰到一些生僻字就会无法转换，
当然了配置第二个参数时，可以稍微弥补一下默认缺陷，
不至于无法转换是截断，用法如下：

iconv(“UTF-8″,”GB2312//IGNORE”,$data);
//IGNORE的意思是，碰到无法转换的字符，
//忽略失败，继续转换下面的内容。

可以用另一个转换函数（mb_convert_encoding），
此函数效率不高，另外可省略第三参数，
自动识别内容编码，最好别用，影响效率，
还需注意，mb_convert_encoding和iconv参数顺序不同。

mb_convert_encoding ( string $str , string $to_encoding [, mixed $from_encoding = mb_internal_encoding() ] )
http://php.net/manual/zh/function.mb-convert-encoding.php

# PHP Why 无法调用一个存在的库函数

当PHP的错误报告出现下文：
PHP Fatal error:  Call to undefined function mb_convert_encoding() in C:\Users\IceHe\script\y.php on line 4

解决方法：
例如上文中找不到的函数是 mb_convert_encoding。
我搞清楚了它所在的dll（动态链接库）名为php_mbstring.dll，
此文件在php安装目录（C:\php）下的文件夹ext中。

1.在php安装路径的根目录下，
     找到php.ini文件，如：c:/php/php.ini。
2.找到Dynamic Extensions的段落，在其中
     反注释 或 添加 以下这一句：
     extension=./ext/php_mbstring.dll
（即extension= path/php_mbstring.dll，路径加文件名）
3.命令行下，输入php /? 看看有没有载入成功。
     可能会显示：
Warning: PHP Startup: Unable to load dynamic library 'C:\php\php_mbstring.dll' -
The specified module could not be found.
in Unknown on line 0
Could not open input file: /?

4.重启apache等webserver
     即可使用原来找不到的函数~
     CLI（命令行/脚本）模式下则不需要。

# Concepts

SPL
Standard PHP Library

PHPUnit是PHP应用的单元测试框架的业界标准

PHP通过内置的FastCGI进程管理器(FPM)，可以非常高效地和轻量级的高性能Web服务器nginx进行通信。
nginx比Apache消耗更少的内存，能更好的处理并发请求，这在内存限制较多的虚拟主机环境中尤为重要。

Redis
是一个开源、支持网络、基于内存，的高性能Key-Value存储系统（cache and store）。使用ANSI C编写。
通常被称为数据结构服务器，因为值（value）可以是 字符串(String), 哈希(Map), 列表(list), 集合(sets) 和 有序集合(sorted sets)等类型。

Composer
新一代的PHP依赖管理工具，服务于 PHP 生态系统。
其中的很多理念都借鉴了 npm 和 Bundler。
它实际上包含了两个部分：Composer 和 Packagist

Composer 是一个命令行工具，帮你为项目自动安装所依赖的开发包。
它包含了一个依赖解析器，用来处理开发包之间复杂的依赖关系；
另外，它还包含了下载器、安装器等。

Packageist 是 Composer 的默认的开发包仓库。
可以将自己的安装包提交到 packagist，将来你在自己的 VCS （源码管理软件，比如 Github） 仓库中
新建了 tag 或更新了代码，packagist 都会自动构建一个新的开发包。
这就是 packagist 目前的运作方式，将来 packagist 将允许直接上传开发包。

XDebug
调试器是软件开发过程中非常重要的一个工具，通过它，可以跟踪代码的执行过程，查看堆栈信息。
XDebug是一个PHP调试器，可以集成在常见的IDE中，提供设置断点、 查看堆栈信息等功能，
还可以和PHPUnit、KCacheGrind等工具配合，执行代码覆盖率测试和性能调优。

依赖管理
如今有大量的PHP函数库、框架和组件可供选择，一个项目中可能会使用其中的若干——即项目的依赖。
到目前为止，PHP还没有有效的 项目依赖管理方案。即使你手工的管理它们，你还不得不处理其自动加载问题。

目前主要有两个PHP包管理系统：Composer和PEAR，哪个适合你？答案是两个都需要。
    管理单个项目的依赖时使用Composer
    管理整个系统的PHP依赖时使用PEAR

通常情况下，Composer包只在你项目中明确指定时才可用，而PEAR包在所有的PHP项目中可用。
尽管PEAR听起来似乎更简单，但是根据每个 项目制定方案可能更合适。

缓存
PHP自身效率很高，但是执行创建远程连接、加载文件等操作时容易出现瓶颈，
幸运的是，我们有很多工具来加速这部分操作，或减少 这些耗时操作的执行次数。

字节码缓存：在一个PHP文件被执行时，它先被编译为字节码(也称opcode)，然后这些字节码被执行。
如果文件没有修改，那么字节码也会保持不变， 这意味着编译这一步白白浪费了CPU资源。

对象缓存：如果在取得一些数据之后，把它们缓存在系统中，
在后续对这些数据的请求 中，就可以直接使用缓存中的对象（对象变化较少），
这么做可以很大地提升系统性能，减少服务器的负载。
使用最多的内存对象缓存系统是APCu和memcached。
APCu是很好的一个对象缓存方案，它提供了简单的API来让你把对象存储在内存中，
而且 配置和使用都非常容易，它的一个缺点是只能在本机使用。
Memcached则是另外一种方式，它是一个单独的服务，
可以通过网络访问，这 意味着可以在一个地方写入数据，然后在不同的系统中访问这份数据。

框架
框架抽象出底层通用的业务逻辑，给使用者了提供简单易用的接口。
不是所有的项目都需要框架，有时候原生的PHP就能满足需求，但需要框架时，有三种类型的框架可供选择：

1 微框架：仅是一个包装器(Wrapper)，尽量快地把HTTP请求路由到回调函数、控制器或方法上，
有些框架也会提供一些函数库，如基本的数据库 操作。微框架主要用于构建远程HTTP服务。

2 全能(Full-Stack)框架：在微框架的功能之上提供了更多的功能特性，如ORM，验证组件等。

3 组件框架：一组独立功能库的集合，多个基于组件的框架集合在一起，甚至可以用作微框架或者全能框架。

组件
如前所述，组件是另外一种创建、实现和发布开源代码的方式，当前社区存在很多组件库，最主要的两个：
    Packagist
    PEAR
这两个库都有用于安装和升级的命令行工具，已经在依赖管理部分讲述.

Master-Slave
It's a model of communication where one device or process has unidirectional control over one or more other devices. In some systems a master is elected from a group of eligible devices, with the other devices acting in the role of slaves.
In database replication, the master database is regarded as the authoritative source, and the slave databases are synchronized to it.

Abbr List
MC     memcache
Vendor     供应商
BDD     行为驱动开发

PHP 编码规范 - 过去未注意的部分
*（部门内使用，参考公认的标准，有参考价值）

控制结构的关键字后必须要有一个空格符，而调用方法或函数时则一定不能有。

纯PHP代码文件必须省略最后的 ?> 结束标签。

// 类声明范例
<?php
namespace Vendor\Package;

use FooClass;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class ClassName extends ParentClass implements
    \ArrayAccess,
    \Countable,
    \Serializable
{
    // constants, properties, methods
}

简单数组的新声明方式！
<?php
$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

// 自 PHP 5.4 起
$array = [
    "foo" => "bar",
    "bar" => "foo",
];
?>

From: www.laruence.com/manual/yaf.classes.html#yaf.class.application.props._app
_app
    Yaf_Application通过特殊的方式实现了单利模式, 此属性保存当前实例
# 单例模式 误为 单利模式
