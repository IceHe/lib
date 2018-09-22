# PHP 编程经验

## 八卦：最好的语言？

> PHP 是世界上最好的（编程）语言！
>
> __原始出处不详__

不少 PHP 的圈外人和新手不懂行，难免无法理解以至于误解这句流传甚广的话，甚至睥睨 PHP 并施以冷嘲热讽。

（如果一个程序员对计算机的技术和文化有足够的理解，应该耻于做这种「忽视场景，牵强对比各种编程语言优劣」的事来自找优越感。除非是一些特别的情况，可能他在「钓鱼」或者…… 见下文）

实际上「PHP 是世界上最好的语言」这句话已经成了一种梗，PHP 程序员经常以这种「自嘲」的方式表明身份。比如，我们也会戏称自己以「拍黄片」（Pai Huang Pian）为业。

- PHP 圈的八卦见闻：
    竟然有人嘲笑 PHP 的「继父」鸟哥 惠新宸（Laruence [@weibo](http://weibo.com/laruence)、[@GitHub](https://github.com/laruence)、[@Blog](http://www.laruence.com/)）竟然敢自称「亚洲第一程序员」（我真实碰过这么认为的朋友），其实这是一个以讹传讹的失实说法。鸟哥并没有这样自称，「亚一程」这只不过是中国 PHP 小圈子里的友人给他取得的一个绰号而已，是一个富于幽默感的戏称（爱称），也算是由「PHP 是最好的语言」引申出来的梗。毕竟鸟哥给 PHP 社区做出了如此巨大的贡献，旧的 PHP 项目只要换上 PHP7 的运行环境就能有惊人的性能提升（可另行搜索了解详情），然后当年的性能 KPI 就完成了…… 圈内用这样饶有趣味地方式来捧鸟哥，实在是再正常不过的事，哈哈。PHP7 出来已经挺久，现在也不常有人提起「亚一程」这个梗了。

## 访问变量

### 请求参数

PHP 可以从 `$_GET`、`$_POST` 等超全局变量中获取 HTTP Request 传来的参数。虽然这么做很便捷，但是在工程项目中，为了更 __统一、安全__ 地获取请求参数，还是会对它们再做一层封装。

例如，微博的 Mobile API（笔者所在部门的主项目）现在使用 `Request::get('param_name')` 的写法来获取单个请求参数。这里的 `Request` 是用于获取当前请求参数的全局单例类。

- 统一：一般情况下，没有必要区分请求的参数来自 `GET` 还是 `POST`。
- 安全：我们不能假定请求方一定传了所有用到的参数。
    - 如果用 `$_GET['key']` 这种简单的方式获取请求参数，可能会访问到数组中不存在的元素，导致程序异常退出，输出不该暴露给用户的错误信息。
        - 如果关闭所有异常报告，接口会返回空。
    - 为了避免报错，可以写成：__`$_GET['key'] ?? null`__
    - 但是如果每次获取参数都要写 `?? default_value` 的话就太麻烦，可以将这部分写到组件里。
        ``` php Request::get('key') 的简单实现
        class Request {
            public function get($key, $default = null) {
                return $_GET[$key] ?? $_POST[$key] ?? $default;
            }
            // …
        }
        ```

#### 其它考虑

可能需要封装一些额外的功能来简化工作。

- 防止修改：
    应该保留请求参数的一份原始值，让它们保持只读。
    - 不严谨的开发者，可能会贪图方便直接修改 `$_GET` `$_POST` 中的参数值，这时就找不回参数的原始值了。
    - 在处理请求的代码流程中，谁都能够去修改请求参数，容易导致不同场景下的上下文不一致，运行结果难以预料。
        一旦运行出错，只凭借代码出错位置和以及当时的变量内容等，很可能难以迅速定位问题和优雅地解决。
        可能只能从请求发出开始，单步断点调试代码，以调查代码在什么时候、什么地方把请求参数修改得（面目全非）不符合预期以致出错。
- 过滤敏感参数：
    不能随意传递给第三方的参数。
    - 例如，账户名、密码、手机号、认证身份的 token 等等；这些参数虽然敏感，但是正是用到了，才会被传递过来；通常传递前，都会先经过加密。
    - 毕竟当前代不是处理这些参数的最后一站，可能还要传递给第三方。使用者为了方便，可能会下意识将所有参数一股脑（如 `Request::all()`）传递出去。
    - 将敏感参数不小心传递给未被授权使用它们的第三方，违规且危险。所以，先从正常获取方式中过滤掉敏感参数，再提供其它方法去获取它们（如 `Request::getSesitiveInput('key')`），大大减少被误传的可能性。
- 修正参数错误：
    - 客户端快速迭代开发，如果不经过严谨地测试，容易造成许多小 bug。一些用户由于各种原因没有更新客户端，市场上残留这一些有 bug 的历史版本。有些 bug 与请求参数有关，这种各样，例如：参数改名，选传参数变必传参数，参数内容格式要求变更，一个参数拆分为多个参数等。
    - 通常只保留并维护一套 API 以供外部使用，毕竟不可能为了客户端的各种历史版本或其它调用方保留多套 API 运行在线上。
    - 这时就需要在获取请求参数前做好各种兼容处理了，如果有一个组件 `Request` 封装了这种处理，就方便多了。肮脏的兼容性代码统一隐藏到了组件中，眼不见为净，就不会因到处复制粘贴而污染到正常的处理代码，使代码产生不必要冗余。
- 修改参数值并保留原始值：
    - 可能还是需要 `Request::set('key', $value)` 这类操作，但直接修改 `$_GET` 和 `$_POST` 依然不合适。为了保留原始值可以这么做：
        ``` php
        class Request {
            protected $modifiedParams = [];

            public function set($key, $value) {
                $this->modifiedParams[$key] = $value;
            }

            public function get($key, $default = null) {
                return $this->modifiedParams[$key]
                    ?? $_GET[$key] ?? $_POST[$key] ?? $default;
            }
            // …
        }
        ```
- 其它可行的做法：
    - 封装对 `$_SERVER`、`$_COOKIE` 等与请求相关的超全局参数的获取与处理代码。
    - 封装那些命名唯一（不会被误操作）且业务相关的参数的通用处理。
        - 例如：加密、解密，参数格式检验，客户端版本判断，源 IP 获取。
    - 其实业界有许多可以参照的「最佳实践」（至少当前是最佳）获得启示。
        - 例如，各种久经考验的框架、组件：Zend、Symfony、Laravel ……

## 判断变量

起始说明：
`$a` 表示变量（一般变量、或数组元素）
`$v` 暗指它是一般的变量（不是数组）
`$ary` 暗指它是数组
`$ary[$k]` 代表通过 key 访问数组
`===` PHP 的全等比较符
`!==` PHP 的不全等比较符
=== 等价于（此处没有深灰背景色）
!== 不等价于（此处没有深灰背景色）

---

常用的三目运算符 `?:` 的表达式的缩写方法：

{% note success %}
`$a ? $a : $b` === `$a ?: $b`
{% endnote %}

但是 `$a ?: $b` !== `$a ?? $b`，
当然 `$ary[$k] ?: $b` !== `$ary[$k] ?? $b`。
看起来有点像，但是有着不同的含义与逻辑。
看起来应该不会用错，但实际使用就是可能会搞错，注意使用的场景。

---

`$v` 是一般变量时，以下替换才成立：

{% note success %}
`empty($v)` === `!$v`
{% endnote %}

引申：`empty($a) ? $b : $a` === `!$a ? $b : $a` === `$a ? $a : $b` === `$a ?: $b`。
可以直接用来快速简化 PHP 代码，不只对三目运算符 `?:` 有用，也对 `if … else` 的分支语句有用。

---

如果判断的是数组元素的话：

{% note success %}
`empty($ary[$k])` !== `!$ary[$k]`
{% endnote %}

原因是：

{% note success %}
`empty($a)` 包含了 `isset($a)` 的判断；而 `!` 只是单纯的取反操作。
{% endnote %}

即 `isset($a) && empty($a)` === `empty($a)`。
而 `isset($ary[$k]) && !$ary[$k]` !== `!$ary[$k]`。

所以，如果数组元素 `$ary[$k]` 不存在/未定义时，
使用 `empty($ary[$k])` 来判断其是否为空，PHP 不会报告错误；
而 `!$ary[$k]` 则会。

---

当 `$v` 为 `0` `''` `'0'` `[]` `null` `false` 等时，
{% note success %}
__`false` === `empty($v)` === `!$v`__
{% endnote %}

`isset()` 与 `is_null()`（逻辑和结果）相反
{% note success %}
__`isset($a)` === `!is_null($a)`__
{% endnote %}

### 代码实验

可以参考官方文档 [PHP Type Comparisons](http://www.php.net/manual/en/types.comparisons.php)。
但是它的表格依然有错，所以还是建议用以下的代码来进行实验。

``` php 简版
<?php
//error_reporting(~E_ALL);

$cases = [
    /* usual */
    null, '', [], [0],
    /* num */
    2, 1, 0, -1, '2', '1', '0', '-1',
    /* bool */
    true, false, 'true', 'false', 'str',
];

$exprs = [
    'is_null' => function ($v) { return is_null($v); },
    'isset' => function ($v) { return isset($v); },
    //'!isset' => function ($v) { return !isset($v); },
    'empty' => function ($v) { return empty($v); },
    //'!empty' => function ($v) { return !empty($v); },
    'boolval()' => function ($v) { return boolval($v); },
    // 'if' => function ($v) { if ($v) { return true; } return false; },
    // 'if(!)' => function ($v) { return !$v; },
    // 'is_array' => function ($v) { return is_array($v); },
    // 'is_string' => function ($v) { return is_string($v); },
    'intval()' => function ($v) { return intval($v); },
    '==1' => function ($v) { return ($v == 1); },
    "=='1'" => function ($v) { return ($v == '1'); },
    // '!=1' => function ($v) { return ($v != 1); },
    // 'strlen!=0' => function ($v) { return strlen($v) != 0; },
    // "=='true'" => function ($v) { if ($v == 'true') { return true; } return false; },
];

$lines = [];
foreach ($cases as $index => $case) {
    // 缩短展示变量的那一列的宽度
    $title = (is_array($case) ? '' : gettype($case))
        .' '.str_replace(["\n", ' '], '', var_export($case, true));

    // 统一前两列的宽度，对齐数据以便查看
    $line = [
        str_pad(''.$index, 2),
        str_pad(trim($title), 14),
    ];

    foreach ($exprs as $desc => $expr) {
        $line[] = $desc.' '.($expr($case) ? 1 : 0);
    }

    $lines[] = join(' | ', $line);
}
echo join("\n", $lines);
```
``` str 有冗余的输出
0  | NULL NULL      | is_null 1 | isset 0 | empty 1 | boolval() 0 | intval() 0 | ==1 0 | =='1' 0
1  | string ''      | is_null 0 | isset 1 | empty 1 | boolval() 0 | intval() 0 | ==1 0 | =='1' 0
2  | array()        | is_null 0 | isset 1 | empty 1 | boolval() 0 | intval() 0 | ==1 0 | =='1' 0
3  | array(0=>0,)   | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 1 | ==1 0 | =='1' 0
4  | integer 2      | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 1 | ==1 0 | =='1' 0
5  | integer 1      | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 1 | ==1 1 | =='1' 1
6  | integer 0      | is_null 0 | isset 1 | empty 1 | boolval() 0 | intval() 0 | ==1 0 | =='1' 0
7  | integer -1     | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 1 | ==1 0 | =='1' 0
8  | string '2'     | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 1 | ==1 0 | =='1' 0
9  | string '1'     | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 1 | ==1 1 | =='1' 1
10 | string '0'     | is_null 0 | isset 1 | empty 1 | boolval() 0 | intval() 0 | ==1 0 | =='1' 0
11 | string '-1'    | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 1 | ==1 0 | =='1' 0
12 | boolean true   | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 1 | ==1 1 | =='1' 1
13 | boolean false  | is_null 0 | isset 1 | empty 1 | boolval() 0 | intval() 0 | ==1 0 | =='1' 0
14 | string 'true'  | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 0 | ==1 0 | =='1' 0
15 | string 'false' | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 0 | ==1 0 | =='1' 0
16 | string 'str'   | is_null 0 | isset 1 | empty 0 | boolval() 1 | intval() 0 | ==1 0 | =='1' 0
```

---

``` php 改进版
<?php
//error_reporting(~E_ALL);

$cases = [
    /* usual */
    null, '', [], [0],
    /* num */
    2, 1, 0, -1, '2', '1', '0', '-1',
    /* bool */
    true, false, 'true', 'false', 'str',
];

$exprs = [
    'is_null' => function ($v) { return is_null($v); },
    'isset' => function ($v) { return isset($v); },
    //'!isset' => function ($v) { return !isset($v); },
    'empty' => function ($v) { return empty($v); },
    //'!empty' => function ($v) { return !empty($v); },
    'boolval()' => function ($v) { return boolval($v); },
    // 'if' => function ($v) { if ($v) { return true; } return false; },
    // 'if(!)' => function ($v) { return !$v; },
    // 'is_array' => function ($v) { return is_array($v); },
    // 'is_string' => function ($v) { return is_string($v); },
    'intval()' => function ($v) { return intval($v); },
    '==1' => function ($v) { return ($v == 1); },
    "=='1'" => function ($v) { return ($v == '1'); },
    // '!=1' => function ($v) { return ($v != 1); },
    // 'strlen!=0' => function ($v) { return strlen($v) != 0; },
    // "=='true'" => function ($v) { if ($v == 'true') { return true; } return false; },
];

// 设置表头
$header = array_keys($exprs);
array_unshift($header, 'n', 'cases');

$lines = [$header];
$maxTitleLen = 0;
foreach ($cases as $index => $case) {
    // 缩短展示变量的那一列的宽度
    $title = trim((is_array($case) ? '' : gettype($case)).' '.str_replace(["\n", ' '], '', var_export($case, true)));
    $maxTitleLen = ($len = strlen($title)) > $maxTitleLen ? $len : $maxTitleLen;

    $line = [''.$index, $title];
    foreach ($exprs as $expr) {
        $line[] = $expr($case) ? '1' : '0';
    }

    $lines[] = $line;
}

// 计算每一列的宽度
$colLens = [strlen(''.count($cases)), $maxTitleLen];
foreach (array_keys($exprs) as $desc) {
    $colLens[] = strlen($desc);
}

foreach ($lines as $k => $line) {
    foreach ($line as $index => $value) {
        // 统一每一列的宽度，对齐数据以便查看
        $line[$index] = str_pad($value, $colLens[$index]);
    }
    $lines[$k] = join(' | ', $line);
}
echo join("\n", $lines);
```
``` str 简洁的输出
n  | cases          | is_null | isset | empty | boolval() | intval() | ==1 | =='1'
0  | NULL NULL      | 1       | 0     | 1     | 0         | 0        | 0   | 0
1  | string ''      | 0       | 1     | 1     | 0         | 0        | 0   | 0
2  | array()        | 0       | 1     | 1     | 0         | 0        | 0   | 0
3  | array(0=>0,)   | 0       | 1     | 0     | 1         | 1        | 0   | 0
4  | integer 2      | 0       | 1     | 0     | 1         | 1        | 0   | 0
5  | integer 1      | 0       | 1     | 0     | 1         | 1        | 1   | 1
6  | integer 0      | 0       | 1     | 1     | 0         | 0        | 0   | 0
7  | integer -1     | 0       | 1     | 0     | 1         | 1        | 0   | 0
8  | string '2'     | 0       | 1     | 0     | 1         | 1        | 0   | 0
9  | string '1'     | 0       | 1     | 0     | 1         | 1        | 1   | 1
10 | string '0'     | 0       | 1     | 1     | 0         | 0        | 0   | 0
11 | string '-1'    | 0       | 1     | 0     | 1         | 1        | 0   | 0
12 | boolean true   | 0       | 1     | 0     | 1         | 1        | 1   | 1
13 | boolean false  | 0       | 1     | 1     | 0         | 0        | 0   | 0
14 | string 'true'  | 0       | 1     | 0     | 1         | 0        | 0   | 0
15 | string 'false' | 0       | 1     | 0     | 1         | 0        | 0   | 0
16 | string 'str'   | 0       | 1     | 0     | 1         | 0        | 0   | 0
```

以上代码的 [GitHub Gist](https://gist.github.com/IceHe/eb0a95647c7ed5b47fbf30ce85af34e6) 链接。

## 字符串操作

许多实现基本功能的函数都内置到了 PHP 中。
然而在我看来比较常用的一些功能函数在 Python 里需要 import 相关的模块才能用，略显不便。

参考 [php.net](http://php.net/)：[字符串函数](http://php.net/ref.strings) & [PCRE 函数](http://php.net/manual/en/ref.pcre.php)（Regex 正则）

挑常用的说一说。这里可以很明显感受到命名的不统一。

### 字符串前缀

判断一个字符串是否以另一字符串为前缀，有许多方法。

#### strpos

``` php
strpos($str, $prefix) === 0;
```

用 `===` 全等比较符而不是 `==` 等于号，原因如下：
如果 `strpos()` 返回 false，表示在 $str 中找不到 $prefix；
然而 `false == 0`，用 `==` 进行判断会造成错误。

`strpos` 可以用 `strstr`（在字符串中，查找第一个指定子字符串出现的位置）函数来代替。
`stripos` 和 `stristr` 等函数都忽略大小写进行查找。

#### substr

``` php
substr($str, 0, strlen('prefix')) == 'prefix';
```

代码长一点，但比起 `strpos` 这种 C 式的函数名，
`substr`（`substring`）更容易让人理解代码的内在含义。

``` php
substr($str, 0, 6) == 'prefix';
```

如果 `strlen('prefix')` 换成 `'prefix'` 字符串长度的具体数字，
看起来好像是减少代码冗余，但是容易出错。
这样不利于维护，容易改了内容 `'prefix'` 却忘记修改长度 `6`。
应该尽可能减少这种低级错误发生的可能性。

``` php
$prefix = 'prefix';
substr($str, 0, strlen($prefix)) == $prefix;
```

在避免代码冗余的情况下，减少出错的可能性：只修改 `'prefix'` 一处就行了。
如果用前文那种「硬编码」的写法，就要同时修改所有受变更影响的代码，才能避免出错。

#### preg_match

``` php
!preg_match('/^prefix/', $str);
```

说明：`preg_match()` 匹配成功返回 1，失败则返回 0，出现异常则返回 false。

比起函数名 `strpos` 和 `substr`，`preg_match` 的表意更不清晰了。
而且它还需要你简单了解「正则表达式」，以致需要查找资料、稍作思考才能看懂它。
这些地方毋需复杂精巧的计算机技术和编程技巧，还是尽可能写让人一眼就能看明白的代码。

### 字符串后缀

这个操作还是用 `substr` 比 `strpos` 方便，`preg_match` 等正则匹配方法依然不推荐。
因为 `substr(string $str, int $start[, int $length])` 的第二个参数可以为负数，
负数即表示可以从字符串的倒数第 `-$start` 个字符开始截取，
忽略可选参数 `$length` 即可截取至最后一个字符。

``` php
$suffix = 'suffix';
substr($str, -strlen($suffix)) == $suffix;
```

### 封装常用字符串操作

不但是 PHP，常见的编程语言都有许多 packages 包含你需要工具函数，可以直接引用。
建议根据项目的实际需求，将常用的工具函数进一步封装起来，以提高使用的便利性和代码可读性。

例如，以上提及到的对「字符串前缀、后缀」的判断，还有对「字符串是否包含制定子字符串」的判断等，
可以封装成位以下的函数：

``` php
function starts_with(string $haystack, string|array $prefix) {
    foreach ((array)$needles as $needle) {
        if ($needle != '' && strpos($haystack, $needle) === 0) {
            return true;
        }
    }
    return false;
}

function ends_with(string $str, string|array $suffix) {
    foreach ((array)$needles as $needle) {
        if ((string)$needle === substr($haystack, -strlen($needle))) {
            return true;
        }
    }
    return false;
}

function str_contains(string $str, string|array $needles) {
    foreach ((array)$needles as $needle) {
        if ($needle != '' && strpos($haystack, $needle) !== false) {
            return true;
        }
    }
    return false;
}
```

它们命名良好，表意明确；第二个参数支持数组，以匹配多个子字符串。

简单说明 `__urlencode()__` 和 `__rawurlencode()__`（以至 `*decode()`）的区别：
例如，空格 `' '` 一般会转换为加号 `'+'`，按照 [RFC 3986](http://www.faqs.org/rfcs/rfc3986.html) 则转换为 `'%20'`；
但是可是一些 URL 参数的内容也包含 `'+'`的话，这部分内容被 `urldecode()` 解码时就会被译为空格 `' '` 了……
所以，为了避免一些原始信息在转换的过程中出错，请注意诸如此类的特殊情况。

---

[__htmlentities()__](http://php.net/manual/en/function.htmlentities.php) ：将（所有具有对应 HTML 实体的）字符转换为 HTML 实体（entity 转义字符）
[__html_entity_decode()__](http://php.net/manual/en/function.html-entity-decode.php) ：将所有 HTML 实体转换为对应字符

[__htmlspecialchars()__](http://php.net/manual/en/function.htmlspecialchars.php) ：将特殊字符转换为 HTML 实体（如 `&` `"` `'` `<` `>`）
[__htmlspecialchars_decode()__](http://php.net/manual/en/function.htmlspecialchars-decode.php) ：将特殊的 HTML 实体转换回普通字符

[__get_html_translation_table()__](http://php.net/manual/en/function.get-html-translation-table.php) ：返回使用 `htmlspecialchars()` 和 `htmlentities()` 后的转换表

[__nl2br()__](http://php.net/manual/en/function.nl2br.php) ：在字符串所有新行（`\n` 或 `\r\n` 等）之前，插入 HTML 换行标记 `<br/>`
[__strip_tags()__](http://php.net/manual/en/function.strip-tags.php) ：从字符串中去除 HTML 和 PHP 标记（`tag`）

---

[__addslashes()__](http://php.net/manual/en/function.addslashes.php) ：使用反斜线引用字符串。因为 SQL 查询语句需要在某些字符前加反斜线 `\` 来进行转义
[__stripslashes()__](http://php.net/manual/en/function.stripslashes.php) ：反引用一个引用字符串

[__addcslashes()__](http://php.net/manual/en/function.addcslashes.php) ：以 C 语言风格使用反斜线转义字符串中的字符
[__stripcslashes()__](http://php.net/manual/en/function.stripcslashes.php) ：反引用一个使用 `addcslashes()` 转义的字符串

## 数组操作

毕竟 PHP 是主要用于 Web 的语言，最多的就是字符串的操作，还有数组的操作。
虽然 PHP 已经内置了不少的数组操作，但是在我看来，依然不够用。

参考 [php.net](http://php.net/)：[数组函数](http://php.net/manual/en/book.array.php)
参考 [Lavarel](https://laravel.com/docs/master)：[总览](https://laravel.com/docs/5.4/helpers#available-methods)、[数组工具函数](https://laravel.com/docs/master/helpers#arrays)

__array_fill*()__ 数组填充
__array_diff*()__ 数组差集
__array_intersect*()__ 数组交集

---

[__array_filter()__](http://php.net/manual/zh/function.array-filter.php) ：用回调函数过滤数组中的单元
[__array_flip()__](http://php.net/manual/zh/function.array-flip.php) ：交换数组中的键和值
[__array_chunk()__](http://php.net/manual/zh/function.array-chunk.php) ：将一个数组分割成多个
有些 API 不能一次处理超过一定量的数据，这时可以用它进行分组分批的处理。

### 用一列元素值作为新的键

[__array_column()__](http://php.net/manual/zh/function.array-column.php) ：返回数组中指定的一列
[__array_combine()__](http://php.net/manual/zh/function.array-combine.php) ： 创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值

``` php 用数组中的某一列作为新的键值
$ary = [
    ['id' => 'a', 'name' => 'IceHe.me'],
    ['id' => 'b', 'name' => 'King Kong'],
    ['id' => 'c', 'name' => 'Bob'],
];

array_combine(array_column($ary, 'id'), $ary);
```
``` str 产生的新数组
[
    "a" => [
        "id" => "a",
        "name" => "IceHe.me",
    ],
    "b" => [
        "id" => "b",
        "name" => "King Kong",
    ],
    "c" => [
        "id" => "c",
        "name" => "Bob",
    ],
]
```

### array_key_exists 与 isset

[__array_keys()__](http://php.net/manual/zh/function.array-keys.php) ：返回数组中部分的或所有的键名

[__array_key_exists()__](http://php.net/manual/zh/function.array-key-exists.php) ：检查数组里是否有指定的键名或索引
看起来 `array_key_exists('key', $ary)` 可以用 __`isset($ary['key'])`__ 这种更短的写法来替代它，但是它们是有区别的！

``` php isset 和 array_key_exists 的测试代码
$ary = [
    'a' => 'apple',
    'b' => null,
];

$keys = array_merge(array_keys($ary), ['c']);

$fns = [
    "isset(\$ary['{key}'])" => function ($ary, $key) {
        return isset($ary[$key]);
    },
    "array_key_exists('{key}', \$ary)" => function ($ary, $key) {
        return array_key_exists($key, $ary);
    },
];

foreach ($fns as $desc => $fn) {
    foreach ($keys as $key) {
        echo str_replace('{key}', $key, $desc).' == '.($fn($ary, $key) ?: 0)."\n";
    }
}
```
``` str 输出
isset($ary['a']) == 1
isset($ary['b']) == 0
isset($ary['c']) == 0
array_key_exists('a', $ary) == 1
array_key_exists('b', $ary) == 1
array_key_exists('c', $ary) == 0
```

如上述的 `$ary['b']`，如果数组中，一个键对应的值是 `null`（即它是一个数组的空元素），
这时键是存在的，`array_key_exists()` 为 `true`，但 `isset()` 则为 `false`。
只有键也不存在时，`array_key_exists()` 和`isset()` 才同时为 `false`。
判断一个数组元素是否完全不存在，应该用 `array_key_exists()`。

#### 性能浅探

但是它的性能不如 `isset()`，可以选择性能更好的 `isset() || array_key_exists()` 写法来判断。

``` php 性能测试
$ary = [
    'a' => 'apple',
    'b' => null,
];

$keys = array_merge(array_keys($ary), ['c']);

$fns = [
    "isset(\$ary['{key}'])" => function ($ary, $key) {
        return isset($ary[$key]);
    },
    "array_key_exists('{key}', \$ary)" => function ($ary, $key) {
        return array_key_exists($key, $ary);
    },
    "isset(\$ary['{key}']) || array_key_exists('{key}', \$ary)" => function ($ary, $key) {
        return isset($ary[$key]) || array_key_exists($key, $ary);
    },
];

$runTimes = 1000 * 1000;
echo "Benchmark ({$runTimes} runs):\n";

foreach ($fns as $desc => $fn) {
    foreach ($keys as $key) {
        $startTime = microtime(true);
        for ($i = 0; $i < $runTimes; ++$i) {
            $fn($ary, $key);
        }
        echo str_replace('{key}', $key, $desc).' : '.(microtime(true) - $startTime)." s\n";
    }
}
```
``` str 输出
Benchmark (1000000 runs):
isset($ary['a']) : 1.1532697677612 s
isset($ary['b']) : 1.1657729148865 s
isset($ary['c']) : 1.1589360237122 s
array_key_exists('a', $ary) : 1.8381969928741 s
array_key_exists('b', $ary) : 1.8328688144684 s
array_key_exists('c', $ary) : 1.8120148181915 s
isset($ary['a']) || array_key_exists('a', $ary) : 1.1722960472107 s
isset($ary['b']) || array_key_exists('b', $ary) : 1.7927839756012 s
isset($ary['c']) || array_key_exists('c', $ary) : 1.7765641212463 s
```

不过瓶颈通常在数据 IO 和网络传输方面，不在框架、函数、语言本身，特别是在 PHP7 发布后。
所以，通常情况下用 `isset()` 就够了，严谨的话直接用 `array_key_exists()` 即可。

---

array_merge
array_search
`array_map` `array_reduce`
array_filter
array_shift
array_unshift
array_chunk
array_flip
array_keys
array_values
array_replace
array_slice
compact
count
list
reset
`array_walk` 有时不如直接用循环？因为用 `array_map` 等，反而开销更大、代码更多…… 用得我蛮尴尬。
也内置了迭代器，可是我真的没见谁在用……

上文提到的 array_get()
还有 array_has()
array_flat() 数组扁平化
array_concat($ary1[, $ary2[, …]]) 数组拼接，这就不用各种遍历来拼数组了
array_pluck 等

## 其它

[__microtime()__](http://php.net/manual/zh/function.microtime.php) ：返回当前 Unix 时间戳和微秒数（实际单位其实还是秒）
`microtime(true)` 将秒和毫秒合并为一个浮点数的结果来返回，常用于性能测试

`var_dump($v1, $v2, …)` 常用于测试
`var_export(…, true)` 输出变量

<!--
> 4. __函数的返回值__，跟 C 语言一样，它的返回值并不一致。
>     - 例如，C 语言的一些关于字符数组的库函数，它们的返回类型是 int，因为 C 不可能依靠抛出异常来表示错误，只能给 int -1 这种值额外赋予特殊的含义，即发生错误，所以表达上并不够清晰和一致。（其实这并无大碍，毕竟 C 更接近硬件的机器码，不可能也没必要封装异常这种「高级特性」）
>     - PHP 是一种弱类型的语言，虽然也有「类」和「异常」，但是使用一些内建函数也并不抛出异常。例如 `strpos()`，它会返回字符串中的某种子字符串的出现位置，这个位置由非负的整数来表示，如果找不到就会返回布尔类型的 `false`。
>     - 这时如果要判断「某个子字符串没在一个字符串里出现」就得用表达式：
>         `false !== strpos('字符串', '子字符串')`。
>         - 基础说明：`!==` 是「不全等于」的比较操作符，比较的两个变量的数值及其类型要同时不一样时，表达式的结果才是 `true`；`!=` 是「不等于」的比较操作符，只要比较的两个变量的数值相等，表达式结果就是 `true`，如果它们的数值类型不同，就会对变量进行隐式的类型转换，然后再进行比较。正是因为弱类型语言的这一「隐式类型转换」的过程，许多对编程语言不熟悉、逻辑又不严谨的程序员，写出了 bug 频出的 PHP 代码。
>         - 如果这时误用了逻辑表达式 `false != strpos('字符串', '子字符串')` 来判断可就麻烦了：
>             子字符串出现在字符串的开头，`strpos()` 会返回整数 `0`，
>             然后 `0` 会转换成 `boolean` 布尔类型，值为 `false`，最终表达式同样也会返回 `true`，然而这是错误的判断结果。它跟 C 语言中的 `strpos()` 有着「异曲同工之错」，容易被不熟练的人误用。
-->

## 代码风格

### 操作符

<http://php.net/manual/en/language.operators.php>

优先级：
所以要加括号，简洁 VS 冗余显而易见 VS 适量

结合性：
（暂时我只有）简单、容易理解但不严谨的解释。
左结合：先计算操作符左边的内容，如 `>>` `>` `?` 等
右结合：先计算操作符右边的内容，如 `!` `=` `??` 等

操作符的优先级
老生常谈，我们必须要多加括号 () 以便阅读，一眼看出问题

## 清晰的逻辑

## 守卫原则

清晰易懂
if 后也把 else 写了，控制流程更清晰！（王垠的博文）

## 后记

- 虽然很多内容我自己都觉得很小儿科，纠结之中，我还是写完了本文。
- 无论是校园或是职场，学习、就职环境有良师益友非常重要。
    - 虽然说「师傅带进门，修行靠个人」，自学很重要。
    - 但是很多东西都是有最佳实践，没必要自行浪费时间去摸索，
        更应该站在巨人的肩膀上，做出进一步的改进。
    - 软件领域很喜欢开源、分享、教授等，也很强调自学的作用。
        但是我也觉得不够，没人带的话，会多走许多弯路。
        不是说不提倡自己走一走弯路，适当的弯路可以加深理解，自己摸索方法。
        但是自己苦苦追寻找不到答案的时候，你会不会还是希望一个良师益友能够点拨你，
        让你拨开云雾看青天。这是再幸福不过的事情了。
- 做社团也是这样，当年浪费了多少时间去「开会」、「头脑风暴」……
    可惜大多数人都头脑空空，又没有相关经验，没有被启发，不可能提出什么有用的见解。
    还不如先循规蹈矩，根据过去的最佳实践（策划书、执行经验）来执行，
    不要浪费那么多时间放在策划书上，这是不值得的，搞一次还行，再多就没有意思了。
    一开始，完美的策划书并没有那么重要，更重要的是领会计划和实践之间的巨大鸿沟。
    执行是需要比策划中更多的细节、更多的时间，沟通、调整、协调、执行。
    会写真是太年轻了，只不过纸上谈兵罢了。
