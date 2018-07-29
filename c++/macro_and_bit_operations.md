title: C++ 宏定义与位操作
date: 2017-05-07
updated: 2017-05-07
noupdate: true
categories: [C++]
tags: [C++]
description: Macro & Bit Operations&#58; 思考题与知识点。
---

- 提醒：不过多赘述「宏」以及本文相关的其它 C++ 基础知识，不明之处暂请自行 Google。

## 宏定义

即 __Macro__。

### Print

Print Expr & Result
便捷地打印程序输出：变量或表达式，以及计算结果。

- __重复__ `cout << variable << endl;` __这种用于打印程序输出的代码实在麻烦，但不得不写，__
    __所以，为了更便捷地打印程序输出，写了一些辅助的「宏」。__
    ``` c++
    #define v(x) cout << '\t' << #x << "  =  " << (x) << endl;
    ```
    - 关键：用宏定义的展开，减少代码量。
    - `#x` 的语法可以获取 `x` 所代表的变量或表达式的具体内容。
    - `(x)` 中的括号不能去掉！否则可能会得出意想不到的错误结果。
        - 提示：在程序的预处理阶段，会展开代码中「宏定义」，即对「宏名」进行简单的字符串替换，详情自行 Google。



- 打印工具的宏定义
    ``` c++ print_tools.h
    // 说明："CPP_TEST" 为本 Demo 项目名
    #ifndef CPP_TEST_PRINT_TOOLS_H
    #define CPP_TEST_PRINT_TOOLS_H

    using std::cout;
    using std::endl;

    // 打印字符串
    #define l(str) cout << str << endl;

    // 打印变量或表达式，及其结果
    #define v(x) cout << '\t' << #x << "  =  " << (x) << endl;

    // 打印一个空行（分隔不同的程序输出）
    #define el cout << endl;

    #endif //CPP_TEST_PRINT_TOOLS_H
    ```
    - 说明：这种声明是为了避免项目重复引入该头文件（即 `#include "print_tools.h"` ）时，重复定义其中的内容。
    ``` c++ 作用：防止重复定义
    #ifndef CPP_TEST_PRINT_TOOLS_H
    #define CPP_TEST_PRINT_TOOLS_H
    // …
    #endif //CPP_TEST_PRINT_TOOLS_H
    ```
- 演示打印工具
    ``` c++ main.cpp
    #include <iostream>
    #include "print_tools.h" // 引入上述的宏
    //using namespace std; // 不将整个 std 引入，因为其中很多东西都用不上。

    /* 后文的样例中，需要额外引入的「库和对象」放这 */
    #include <map>
    using std::map;
    // …

    /* 宏定义 */
    #define MAX(a, b) ((abs((a) - (b)) == (a) - (b)) ? (a) : (b))
    // …

    /* 「函数前置声明」放这 */
    bool isIncr(int *ary, int count);
    // …

    int main() {
        /* 运行的「测试代码」放这 */
        l("test")
        int x = 1;
        int y = -1;
        v(x)
        v(x >> 31)
        v(y)
        v(y >> 31)
        el

        l("MAX")
        v(MAX(10, 20))
        v(MAX(-10, -20))
        el

        l("用一个递归算法，判断一个数组中的值，是否递增？")
        int ary = new int[5]{1, 4, 5, 9, 7};
        v(isIncr(ary, 5))
        delete []ary;
        ary = new int[5]{1, 4, 5, 7, 9};
        v(isIncr(ary, 5))
        delete []ary;
        el

        //…

        return 0;
    }

    /* 「函数定义」放这 */
    bool isIncr(int *ary, int count); {
        return count == 1
            || (count != 0
                && ary[count - 2] <= ary[count - 1]
                && isIncr(ary, --count));
    }
    // …
    ```
    ``` str 输出
    test
        x  =  1
        x >> 31  =  0
        y  =  -1
        y >> 31  =  -1

    MAX
        MAX(10, 20)  =  20
        MAX(-10, -20)  =  -10

    用一个递归算法，判断一个数组中的值，是否递增？
        isIncr(ary, 5)  =  0
        isIncr(ary, 5)  =  1

    …
    ```
- 进阶可参考《[宏定义的黑魔法 - 宏菜鸟起飞手册](https://onevcat.com/2014/01/black-magic-in-macro/)》

### 数值的大小关系

判断两个数值的大小关系。

``` c++ 以宏定义的方式实现
#define MAX(a, b) (abs((a) - (b)) == ((a) - (b)) ? (a) : (b))
```

### 数值的 sign

判断 signed（有符号）类型的数值的 sign（正负符号）。

``` c++ 以宏定义的方式实现
#define IS_UNSIGNED(a) (a >= 0 && ~a >= 0)
```

### unsigned 数值类型

判断数值类型是否有符号（signed），即是否区分正负。

``` c++ 以宏定义的方式实现
#define IS_UNSIGNED_TYPE(type) ((type)0 - 1 > 0)
```

- 各种语言的数值类型基本都实现了正负值的区分（signed），
    所以只使用 `unsigned` 来标识少数无符号的数值类型，而很少出现 `signed` 这种说法。

### int 变量的 bytes

当前运行环境下（与 CPU 和 OS 有关），一个 int（整型）数值类型变量所占用的 bytes（字节数）。

``` c++ 以宏定义的方式实现
`#define SIZE_OF(value) ((char*)(&value + 1) - (char*)&value)`
```

### 宏定义语法 `##`

`##` 用于连接前后两段代码。
``` c++ 宏定义
#define CONCAT_CODE(a, b) (a##e##b)
```
``` c++ 测试代码
v(CONCAT_CODE(2, 3))
```
``` str 输出
CONCAT_CODE(2, 3)  =  2000
```
- 解释：
    因为 `CONCAT_CODE(2, 3)` 将代码 `2`、`e`、`3` 连接成 `2e3`，
    等于 int `2 * pow(10, 3)` = `2 * 1000` = `2000`。

---

## 位操作

即 __Bit Operations__，对数值（用二进制表示）的 bit（比特位）进行直接操作。

### int 整型数值

__整型__，表示整数的数值类型。

- 下文中，进行位操作的变量的类型，主要为 int 等表示整数的数值类型。
    暂不包括浮点数，`float`、`double`、`long`。
- int 可描述的数值范围：
    - 32 位（bits）操作系统（OS）下，占用 4 bytes
        `-2^32` ~ `2^32 - 1`（此处 `2^32` 表示 2 的 32 次方）
    - 64 位操作系统下，占用 8 bytes
        `-2^64` ~ `2^64 - 1`
    - __下文中，默认运行环境为 32 位的操作系统__。
- 数值表示方式：
    - `0x4F` 中的 `0x` 表示该数值在以 16 进制进行展示；
    - `'0010'B` 中的 `B` 表示该数值在以 2 进制进行展示。
    - 注意：C / C++ 中，不支持直接以 2 进制的形式声明数值；
        如有需要，通常以 16 进制的形式声明和表示二进制数值（bits）。
- 以 16 进制展示数值：
    - `0x 00 00 00 00` = int `0`
    - `0x 00 00 00 01` = int `+1`
    - `0x FF FF FF FF` = int `-1`
- 下文默认你知晓「在底层如何以二进制比特位来储存和表示整型数值，特别是『负数』。」
    - 负数：以二进制方式进行储存和表示时，最高位（最左）的 bit 是 1。
    - int `0` 在物理层面使用了 `0x 00 00 00 00` 这个数值来表示，
        所以，int 等整数数值类型，所能描述的正数的范围被比负数范围小 1。

### 移位求积

- 快速求 int 2 的 3 次方
    每左移一位，数值增大 2 倍（除非溢出）
    ``` c++
    2 << 3
    ```
- 快速求 int x 的 7 倍
    ``` c++
    (x << 3) - x
    ```

### 2 的幂

判断 int 数值是否为 2 的若干次幂（即 2 的 n 次方）。

数值在计算机中通常都以 0 和 1 的二进制形式存储着，
其实关键在于，这个问题等价于判断一个整数的二进制形式是否「有且只有一位 bit 为 1」。

``` c++ 测试代码
int x = 1024;
v(x)
v(std::bitset<12>(x))
v(!(x & (x - 1)))
x = 513;
v(x)
v(std::bitset<12>(x))
v(!(x & (x - 1)))
```

思路：`x - 1` 等价于「二进制表示的整数 `x`，从最后（右）一位 1 开始（包括这个 1）的所有 bit 都取反」，
那么 `x & (x - 1)` 就是去除 `x` 二进制表示中的最后一个为 1 的 bit；
如果去除最后一位 1 后 `x` 变成了 0 了，它就是 2 的若干次幂。

``` str 输出
判断一个 int 是否为 2 的若干次幂
	x  =  1024
	std::bitset<12>(x)  =  010000000000
	!(x & (x - 1))  =  1
	x  =  513
	std::bitset<12>(x)  =  001000000001
	!(x & (x - 1))  =  0
```

### 求负数

以位操作的方式，__求 int x 的负数__。
``` c++
// `~` 是「按位取反」的操作符
-x = ~x + 1
-x = ~(x - 1)
```
- 不详述推导过程，只提供简单的记忆方式：
    - 假设现在的运行环境是 8 位的操作系统，
        - `'00 00 00 00'B` = int `0`
        - `'00 00 00 01'B` = int `+1`
        - `'11 11 11 11'B` = int `-1`
    - 对以上三个数值进行通过简单的观察和推算，就能得出上面提供的公式。

### 求平均值

求两个 int 数值的平均值
- 一般求法
    ``` c++
    (x + y) / 2
    ```
    缺点：如果 `x + y` 的数值超出 int 可描述的数值范围（即溢出），会得出错误的结果。
- 位操作的求法
    ``` c++
    (x & y) + ((x ^ y) >> 1)
    ```
    提示：从二进制角度来说，
    - `(x & y)` 等于「所有为 `1` 的 bit（比特位）相加的结果除以二」；
    - `(x ^ y) >> 1` 等于「将 `x`、`y` 两数相加等于 `1` 的 bit（一个为 `0` 另一个为 `1`）除以二」。

### 求绝对值

以位操作的方式，__求 int x 的绝对值__。
「求负数」的延伸。以下为思路：

- sign（符号位）的计算：
    x < 0 时，`x >> 31` = `-1`
    x >= 0 时，`x >> 31` = `0`
    - `>>` 右移操作，最高位（最左）用原最高位的数值进行补位：
        原最高位为 1，右移后，新的最高位补 1，
        原最高位为 0，右移后，新的最高位补 0。
- 数值取反：
    `~x` = `-1 ^ x` = `0xFFFFFFFF ^ x`
    - 代入求负数的公式: `-x` = `~x + 1` = `(-1 ^ x) + 1`
        - 注意：`^` `>>` 等位操作符的优先级低于 `+` `-`，
            所以，书写时不能漏掉括号，以免算式出错。
- 补充条件:
    `x` = `0 ^ x`（进一步观察得到的，可能需要灵感）
- 观察规律：
    x < 0 时，`abs(x)` = `-x` = `(-1 ^ x) + 1` = `(-1 ^ x) - (-1)`
    x >= 0 时，`abs(x)` = `x` = `0 ^ x` = `(0 ^ x) - (0)`
- 得到启示：
    `abs(x)` = `((x >> 31) ^ x) - (x >> 31)`
- 解法：
    ``` c++ 函数声明
    int myAbs(int x) {
        int mask = x >> 31;
        return (mask ^ x) - mask;
    }
    ```
    ``` c++ 测试代码
    v(myAbs(0))
    v(myAbs(1))
    v(myAbs(-1))
    v(myAbs(17))
    v(myAbs(-29))
    ```
    ``` str 输出
    myAbs(0)  =  0
    myAbs(1)  =  1
    myAbs(-1)  =  1
    myAbs(17)  =  17
    myAbs(-29)  =  29
    ```

### 多少个 bit 为 1

数值变量的二进制表示中，__有多少个 bit（比特位）为 1__。

- 说明：暂时想到的方法，还是需要用到循环（复杂度 `o(n)`）。
- 提示：为 `1` 的 bit 分布稀疏时，如何快速求解（减少代码所需循环次数）！
- 基础知识：将一个 int 变量（二进制表示中，从左到右数）__最后一个为 `1` 的 bit 设置为 `0`__：
    ``` c++
    b & (b - 1)
    ```
- 解法：
    ``` c++ 函数声明
    int countBit(int x) {
        int cnt = 0;
        while (x != 0) {
            ++cnt;
            x &= x - 1;
        }
        return cnt;
    }
    ```
    ``` c++ 测试代码
    v(countBit(46)) // int 46 == '0101110'B
    v(countBit(21)) // int 37 == '0010101'B
    ```
    ``` str 输出
    countBit(46)  =  4
    countBit(21)  =  3
    ```

### 相邻 bit 不同时为 1

n 位的二进制数字串，有多少个子串不存在相邻的 bit 同时为 1。

思路：
`n == 1` 时，有 `0` 和 `1` 两种符合条件的可能情况；
`n == 2` 时，则有 `00`、`01` 和 `10` 三种可能；
`n == 3` 时，则有 `000`、`001`、`010`、`100`、`101` 五种可能…
根据归纳法，我们发现它类似于斐波那契数列。

``` c++ 函数声明
int separate1(unsigned int n) {
//    switch(n) {
//        case 1:
//            return 2;
//        case 2:
//            return 3;
//        default:
//            return separate1(n - 2) + separate1(n - 1);
//    }

    // 压缩
    return 1 == n ? 2 :
           2 == n ? 3 :
           separate1(n - 2) + separate1(n - 1);
}
```
``` c++ 测试代码
l("n 位的二进制数字串，有多少个子串不存在相邻的 bit 同时为 1")
v(separate1(1))
v(separate1(2))
v(separate1(3))
v(separate1(4))
```
``` str 输出
n 位的二进制数字串，有多少个子串不存在相邻的 bit 同时为 1
	separate1(1)  =  2
	separate1(2)  =  3
	separate1(3)  =  5
	separate1(4)  =  8
```

### 不用 `/` 的除法

不用除号完成除法。（利用位操作和加减法，甚至乘法）

``` c++ 函数声明：方法 1 - 除法的直式计算（这里没有用到 * 乘号）
int div1(int x, int y) {
    if (y == 0) {
        return 0; // should error
    }

    if (x < y) {
        return 0;
    }

    int c = y;
    int k = 0;
    for (; x >= c; c <<= 1, ++k) {
        if (x - c < y) {
            return 1 << k;
        }
    }

    return div2(x - (c >> 1), y) + (1 << (k - 1));
}
```

除法的直式计算，就是我们国内小学教育教的那种除法算法，即是平时用草稿手写进行的那种除法计算。
以上方法，并不便于进行详细解释。所以，简单地说，可以这么理解：
我们平时进行的是十进制的直式除法计算，这里只是在二进制下进行这一过程。

``` c++ 函数声明：方法 2 - 稍加改进方法 1
int div2(const int x, const int y) {
    int leftNum = x;
    int result = 0;
    while (leftNum >= y) {
        int multi = 1;
        while (multi * y <= (leftNum >> 1)) {
            multi <<= 1;
        } // multi * y 大于剩余数的一半时，终止
        result += multi;
        leftNum -= multi * y;
    }
    return result;
}
```

``` c++ 测试代码
l("不用除号实现除法")
v(div1(1112, 12))
v(div2(1112, 12))
```
``` str 输出
不用除号实现除法
	div1(1112, 12)  =  92
	div2(1112, 12)  =  92
```

### 不用 `+` 的加法

不用加号完成加法。

思路：在二进制下，对两个数的相加为 1 的 bit，用「`^` 异或」来求和；
对两个数相加为 0 并进位 1 的 bit，先进行「`&` 按位与」操作，然后「`<< 1` 进位」，然后再求和。

``` c++ 函数声明：方法 1 - 递归
int add1(int x, int y) {
//    if (0 == y) {
//        return x;
//    }
//
//    int tmpSum = x ^ y;       // 求和
//    int carry = (x & y) << 1; // 进位
//    return add(tmpSum, carry);

    // 缩写
    return 0 == y ? x : add1(x ^ y, (x & y) << 1);
}
```

``` c++ 函数声明：方法 2 - 迭代
int add2(int x, int y) {
    int sum = 0;
    while (y != 0) {
        sum = x ^ y;
        y = (x & y) << 1;
        x = sum;
    }
    return sum;
}
```

``` c++ 测试代码
l("不用加号实现加法")
v(add1(98, 103))
v(add1(10, 6))
v(add2(98, 103))
v(add2(10, 6))
```
``` str 输出
不用加号实现加法
	add1(98, 103)  =  201
	add1(10, 6)  =  16
	add2(98, 103)  =  201
	add2(10, 6)  =  16
```

### 不用 `*` 的乘法

不用乘号完成乘法。

思路：跟上文说的「不用 `/` 做除法」的思路类似，也是参考小学的时候学的「写草稿计算乘积」的算法。

基础：顺着上文 [「2 的幂」](2-的幂) 小节的思路，可以知道
得出一个 int 整数 __最后一个为 `1` 的 bit 所代表的数值__：
``` c++ 两个公式等价
b & ~(b - 1)
b & (-b)
```

``` c++ 函数声明
// 需要额外引用的工具库
#include <map>
using std::map;
using std::string;

int multiply(int x, int y) {
    bool neg = (y < 0);
    if (neg) {
        y = -y;
    }

    map<int, int> bitMap;
    for (int i = 0; i < 32; ++i) {
        bitMap[1 << i] = i;
    }

    int product = 0;
    while (y > 0) {
        // `被乘数 * 乘数` 找出乘数在二进制下的最后一位 1 在第 n 位
        int shiftBits = bitMap[y & ~(y - 1)];
        // 叠加被乘数自身被左移 n 位的值（即乘以 2 的次方）
        product += (x << shiftBits);
        // 去掉乘数在二进制下的最后一位为 1 的 bit！
        y &= (y - 1);
    }

    if (neg) {
        product = -product;
    }
    return product;
}
```
``` c++ 测试代码
l("不用乘号实现乘法")
v(multiply(10, 6))
v(multiply(29, 7))
```
``` str 输出
不用乘号实现乘法
	multiply(10, 6)  =  60
	multiply(29, 7)  =  203
```

### 大小端

判断内存以什么字节序储存数据：Big Endian or Little Endian 大小端？

- 简要说明大小端的区别（字节序）：
    - 内存 `0x4000` ~ `0x4003` 的低地址在左，高地址在右
        - 内存地址：从低到高（从左到右）。
    - 数据 `0x 12 34 56 78` 高字节在左，低字节在右！
        - 字节高低：从高到低（从左到右）。
    - __大端：从左到右__ 存放数据（操作系统常用顺序）
        - 高字节，从 __低地址__ 开始放。
    - __小端：从右到左__ 存放数据（网络传输常用顺序）
        - 高字节，从 __高地址__ 开始放。
    - 详情参考：[详解大端模式和小端模式](http://blog.csdn.net/ce123_zhouwei/article/details/6971544)
- 解法：
    ``` c++ 函数声明
    bool isLittleEndian() {
        unsigned short data = 0x1122;
        return 0x22 == *((unsigned char*)&data);
    }
    ```
    ``` c++ 测试代码
    v(isLittleEndian()) // 运行在 MBP 的 macOS 上。
    ```
    ``` str 输出
    isLittleEndian()  =  1
    ```

### 数值交换

交换两个变量的数值。

``` c++ 函数声明：方法 0 - 借助临时变量
void swap0(int &x, int &y) {
    int tmp = x;
    x = y;
    y = x;
}
```

__现在要求：在不使用第三个变量的情况下，实现两个变量的数值交换。__

``` c++ 函数声明：方法 1 - 加减法
void swap1(int &x, iny &y) {
    x = x + y;  //  原理：
    y = x - y;  //  = (x + y) - y = x
    x = x - y;  //  = (x + y) - x = y
}
```

利用「加减」来交换变量的方法已经很巧妙了，
可是当 x + y 的值超出 int 能表示的数值范围（溢出）时，会出错。

``` c++ 函数声明：方法 2 - 位操作
void swap2(int &x, int &y) {
    //  因为 x ^ x = 0，0 ^ x = x 且 x ^ y ^ z = x ^ z ^ y（交换率）
    x = x ^ y;  //  所以：
    y = x ^ y;  //  = (x ^ y) ^ y = x ^ (y ^ y) = x ^ 0 = x
    x = x ^ y;  //  = (x ^ y) ^ x = (x ^ x) ^ y = 0 ^ y = y
}
```

利用更精妙的「位操作」方法，可以完美解决这个问题！
而且还特别好记，因为每一步都是 `x ^ y`。

``` c++ 测试代码
x = 12;
y = 34;
l("initial state")
v(x)
v(y)
swap0(x, y);
l("after swap0()")
v(x)
v(y)
swap1(x, y);
l("after swap1()")
v(x)
v(y)
swap2(x, y);
l("after swap2()")
v(x)
v(y)
```
``` str 输出
initial state
	x  =  12
	y  =  34
after swap0()
	x  =  34
	y  =  12
after swap1()
	x  =  12
	y  =  34
after swap2()
	x  =  34
	y  =  12
```

但是我们必须要知道：在其它语言里，有更直接的变量交换方法。

``` Python 在 Python 中变量的方法
x = 12
y = 34
x, y = y, x // 一定程度上解放了脑力
print(x, y)
```
``` str 输出
34 12
```

## 后记

- 程序源文件附件：
    - [CMakeLists.txt](http://7vzp67.com1.z0.glb.clouddn.com/cpp_macro_and_bit_op/CMakeLists.txt)
    - [print_tools.h](http://7vzp67.com1.z0.glb.clouddn.com/cpp_macro_and_bit_op/print_tools.h)
    - [main.cpp](http://7vzp67.com1.z0.glb.clouddn.com/cpp_macro_and_bit_op/main.cpp)
- 发到七牛云存储之后，才想起来用 [GitHubGist](https://gist.github.com/) 更方便:
    - [cpp_macro_and_bit_operations](https://gist.github.com/IceHe/470075dae8b329dbfec5e226ed4b4ee8)。
- 重做这些老题目，需要不到一整天的时间；但是将这些解答输出成本文，却需要超过一天。
- 于是，我面临这样一个纠结的问题：从个人角度来看，到底值不值得将它们写成博文？
    - 其实，在写本文之前、思考解题的过程中，我已经写了足以让自己理解、可用于复习的相关笔记和代码。
    - 如果要写这样一篇博文，当然要以「别人也能看得懂」为标准来认真地写，写得足够条理清晰。这样一来，就比写个人笔记更费神费时得多了。
    - 当然，写作的过程中，我复习了相关的知识点，再一次理清了自己的思路，增进了理解（还给他人分享了经验）。
    - 但是，我与其付出整整一天的时间和精力去复习总结这些内容，好像还不如继续深入学习其它知识。
- 我纠结了。根据以往经验，我倾向于认为：不值得这么做。
    - 至少不应该急着写。应该隔一段时间，遗忘曲线下行之后再写，可以更好地增进记忆效果了。
- 这次就算了。接下来，我要试着一直学下去，先不写总结归纳的文章，看学习效果是不是更好。
    - 吐槽：这种「自学」方面的实验，本来学生时代就该做了。如果当年一早搞清楚怎样的学习方法更适合自己，然后又快又好地进步，或许现在就不会活得那么窘迫了。
    （提醒自己：不要再埋怨了，不要埋怨，不要埋怨……）
