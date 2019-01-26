/**
 * This file is 'main.cpp'.
 */

#include <iostream>
//using namespace std; // 不将整个 std 引入，因为其中很多东西都用不上。

#include "print_tools.h"

#include <map>
using std::map;
using std::string;

using std::bitset;

/**
 * Exercises
 */
#define MAX(a, b) ((abs((a) - (b)) == (a) - (b)) ? (a) : (b))
#define IS_UNSIGNED(x) ((x) >= 0 && ~(x) >= 0)
#define IS_UNSIGNED_TYPE(type) ((type)0 - 1 > 0)
#define SIZE_OF(value) ((char*)(&value + 1) - (char*)(&value))
#define CONCAT_CODE(a, b) (a##e##b)

int myAbs(int);
int countBit1(int);
int separate1(unsigned int);
int div1(int, int);
int div2(const int, const int);
int add1(int, int);
int add2(int, int);
int multiply(int, int);
void swap0(int&, int&);
void swap1(int&, int&);
void swap2(int&, int&);
bool isLittleEndian();

int main() {
    l("test");
    int x = 1;
    int y = -1;
    v(x);
    v(x >> 31);
    v(x << 31);
    v(y);
    v(y >> 31);
    el;

    l("MAX");
    v(MAX(10, 20))
    v(MAX(-10, -20))
    el

    l("IS_UNSIGNED")
    unsigned int uix = 9;
    v(IS_UNSIGNED(uix))
    v(IS_UNSIGNED(-10))
    el

    l("IS_UNSIGNED_TYPE")
    v(IS_UNSIGNED_TYPE(unsigned int))
    v(IS_UNSIGNED_TYPE(int))
    el

    l("SIZE_OF")
    long lx = -1;
    x = -1;
    v(SIZE_OF(uix))
    v(SIZE_OF(lx))
    v(SIZE_OF(x))
    el

    l("使用 ## 语法")
    v(CONCAT_CODE(2, 3))

    l("快速计算 x 的 3 次方")
    v(2 << 3)
    l("快速计算 x * 7")
    v((2 << 3) -2)
    el

    l("判断一个 int 是否为 2 的若干次幂")
    x = 1024;
    v(x)
    v(bitset<12>(x))
    v(!(x & (x - 1)))
    x = 513;
    v(x)
    v(bitset<12>(x))
    v(!(x & (x - 1)))
    el

    l("int 求负数")
    l("\t公式：`x = ~(x - 1)`")
    l("\t公式变形：`-x = ~x + 1`")
    v(y)
    v(~x + 1)
    v(~(x - 1))
    y = -6;
    v(~y + 1)
    v(~(y - 1))
    el

    l("求平均值")
    l("\t`(x + y) / 2` 可能会溢出")
    x = 4;
    y = 6;
    v(x)
    v(y)
    v((x & y) + ((x ^ y) >> 1))
    el

    l("整型求绝对值")
    l("\t1. 取反等式: ~x = -1^x = 0xFFFFFFFF^x")
    l("\t2. 代入求负公式得出: -x = (-1 ^ x) + 1")
    l("\t3. 不变的等式: x = 0 ^ x")
    l("\t4. 其它分析：")
    l("\t\tx < 0 时，x >> 31 = -1")
    l("\t\tx >= 0 时，x >> 31 = 0")
    l("\t5. 分情况分析：")
    l("\t\tx < 0 时，abs(x) = -x = (-1 ^ x) + 1 = (-1 ^ x) - (-1)")
    l("\t\tx >= 0 时，abs(x) = x = 0 ^ x = (0 ^ x) - 0")
    l("\t6. 得出方法：")
    l("\t\tabs(x) = ((x >> 31) ^ x) - (x >> 31)")
    v(myAbs(0))
    v(myAbs(1))
    v(myAbs(-1))
    v(myAbs(17))
    v(myAbs(-29))
    el

    l("快速求出整型变量中有多少个二进制位为 1")
    l("\tint 21 = b'0010101'")
    l("\tint 46 = b'0101110'")
    v(countBit1(21))
    v(countBit1(46))
    el

    l("n 位的二进制数字串，有多少个子串不存在相邻的 bit 同时为 1")
    v(separate1(1))
    v(separate1(2))
    v(separate1(3))
    v(separate1(4))
    el

    l("不用除号实现除法")
    v(div1(1112, 12))
    v(div2(1112, 12))
    el

    l("不用加号实现加法")
    v(add1(98, 103))
    v(add1(10, 6))
    v(add2(98, 103))
    v(add2(10, 6))
    el

    l("不用乘号实现乘法")
    v(multiply(10, 6))
    v(multiply(29, 7))
    el

    l("大小端问题")
    v(isLittleEndian())
    el

    l("不使用第三个变量，来实现两个变量的数值交换！")
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
    el

    return 0;
}

int myAbs(int x) {
    int y = (x >> 31);
    return (y ^ x) - y;
//    return (x >> 31) ^ x + (x >> 31);
}

int countBit1(int x) {
    int cnt = 0;
    while (x != 0) {
        ++cnt;
        x &= x - 1;
    }
    return cnt;
}

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

int div1(int x, int y) {
    if (y == 0) {
        return 0; // error
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

//    c >>= 1;
//    return div2(x - c, y) + (1 << c);
    return div1(x - (c >> 1), y) + (1 << (k - 1));
}

int div2(const int x, const int y) {
    int leftNum = x;
    int result = 0;
    while (leftNum >= y) {
        int multi = 1;
        while (multi * y <= (leftNum >> 1)) {
            multi <<= 1;
        } // multi * y 大于剩余数的一半时，终止
        result += multi;
        leftNum -= y * multi;
    }
    return result;
}

int add1(int x, int y) {
//    if (0 == y) {
//        return x;
//    }
//
//    int tmpSum = x ^ y;       // 部分位求和
//    int carry = (x & y) << 1; // 进位
//    return add(tmpSum, carry);

    // 缩写
    return 0 == y ? x : add1(x ^ y, (x & y) << 1);
}

int add2(int x, int y) {
    int sum = 0;
    while (y != 0) {
        sum = x ^ y;
        y = (x & y) << 1;
        x = sum;
    }
    return sum;
}

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
//        int shiftBits = bitMap[y ^ (y - 1)]; // Wrong!
        int shiftBits = bitMap[y & ~(y - 1)];
        product += (x << shiftBits);
        y &= (y - 1);
    }

    if (neg) {
        product = -product;
    }
    return product;
}

bool isLittleEndian() {
    unsigned short usData = 0x1122;
//    unsigned char* ptr = (unsigned char*)&usData;
//    return 0x11 == *ptr;
    return 0x22 == *((unsigned char*)&usData);
}

void swap0(int &x, int &y) {
    int tmp = x;
    x = y;
    y = tmp;
}

void swap1(int &x, int &y) {
    x = x + y;
    y = x - y;
    x = x - y;
}

void swap2(int &x, int &y) {
    x = x ^ y;
    y = x ^ y;
    x = x ^ y;
}
