title: Python3 快速入门
date: 2017-04-17
updated: 2017-04-23
noupdate: true
categories: [Python]
tags: [Python]
description: 目标：让有编程基础的人，通过简单参阅本文，即可快速上手使用 Python3 的基本特性。
---

- 内容：
    - 《[廖学峰的 Python 教程](http://www.liaoxuefeng.com/wiki/0014316089557264a6b348958f449949df42a6d3a2e542c000)》笔记的再整理；
    - 本文由一些简单的说明、Python3 代码及其运行结果组成。
- 定位：
    - 查阅自己的笔记来回忆遗忘的 Python3 用法（因为我不常用 Python）；
    - 让不会 Python3 但已经学会其它编程语言的人，在阅读本文后，可以简单上手使用它。
- 工具：
    - 笔记内容由 [Jupyter](http://jupyter.org/)（交互式的编程笔记）写就，以 Markdown 格式导出，并发布为本文。

# 基础

Python 代码文件后缀是 `*.py`

在 Python 代码文件首行的「文件编码声明」如下：


```python
# -*- coding: utf-8 -*-
```

## 注释


```python
# 单行注释
```


```python
# 以下是 多行字符的写法

'''多行字符串首行
严格来说 Python 没有专用的多行注释符。
不过可以利用「多行字符串」的写法，
来进行「多行代码的注释」。
多行字符串末尾'''
```




    '多行字符串首行\n严格来说 Python 没有专用的多行注释符。\n不过可以利用「多行字符串」的写法，\n来进行「多行代码的注释」。\n多行字符串末尾'



## 变量


```python
# 常量：命名全大写
PI = 3.1415926
PI
```




    3.1415926




```python
# 字符串
'字符串'
```




    '字符串'




```python
"\t转义\\字符串\n"
```




    '\t转义\\字符串\n'



## 运算


```python
# 与
True and False
```




    False




```python
# 或
True or False
```




    True




```python
# 非
not False
```




    True




```python
# 除法
10 / 3
```




    3.3333333333333335




```python
# 整除
10 // 3
```




    3




```python
# 取余
10 % 3
```




    1



## 简单的 IO


```python
# 输入
name = input()
```

    test_input



```python
# 输出
print(name)
```

    test_input



```python
lines = '''line0
line1
line2'''
print(lines)
```

    line0
    line1
    line2


# 字符串 str


```python
# 字符编码
ord('A')
```




    65




```python
# 中文字符编码
ord('中')
```




    20013




```python
# 转义字符串
'\u4e2d\u6587'
```




    '中文'




```python
# 编码转换
'ABC'.encode('ascii') # 输出的 `b'…'` 其中的 b 代表数据类型为 bytes
```




    b'ABC'




```python
# 中文编码转换
'中文'.encode('utf-8')
```




    b'\xe4\xb8\xad\xe6\x96\x87'




```python
'中文'.encode('GBK')
```




    b'\xd6\xd0\xce\xc4'




```python
'中文'.encode('ascii')
```


    ---------------------------------------------------------------------------

    UnicodeEncodeError                        Traceback (most recent call last)

    <ipython-input-56-b318511b2a75> in <module>()
    ----> 1 '中文'.encode('ascii')


    UnicodeEncodeError: 'ascii' codec can't encode characters in position 0-1: ordinal not in range(128)



```python
# 解码
b'ABC'.decode('utf-8')
```




    'ABC'




```python
# 中文解码
b'\xd6\xd0\xce\xc4'.decode('gbk')
```




    '中文'




```python
# 字符串长度
len('ABC')
```




    3




```python
# 中文字符串长度
len('中文')
```




    2




```python
# 中文字符串转码后的长度
len('中文'.encode('utf-8'))
```




    6



## 字符串输出格式化


```python
# %d 整数
'%2d-%02d' % (3, 5)
```




    ' 3-05'




```python
# %f 浮点数
'%.2f' % PI
```




    '3.14'




```python
# %s 字符串
'Age: %s' % 25
```




    'Age: 25'




```python
# %x 十六进制整数
'%x' % 43
```




    '2b'




```python
# 输出格式为 'xx.x%'
"%.1f%%" % 72
```




    '72.0%'




```python
# 字符串的单个字符替换
'abcba'.replace('a', 'A')
```




    'AbcbA'



# 列表 list


```python
# 列表 list
list1 = ['0', 'a1', '2b', '3c']
list1
```




    ['0', 'a1', '2b', '3c']




```python
# 列表长度
len(list1)
```




    4




```python
# 索引（下标）访问
list1[0]
```




    '0'




```python
list1[2]
```




    '2b'




```python
# 越界访问
list1[4]
```


    ---------------------------------------------------------------------------

    IndexError                                Traceback (most recent call last)

    <ipython-input-33-895f56fd4693> in <module>()
          1 ## 越界访问
    ----> 2 list1[4]


    IndexError: list index out of range



```python
# 负数索引访问
list1[-1]
```




    '3c'




```python
# 追加一个元素
list1.append('last_elem')
list1
```




    ['0', 'a1', '2b', '3c', 'last_elem']




```python
# 插入一个元素
list1.insert(1, 'insert_elem')
list1
```




    ['0', 'insert_elem', 'a1', '2b', '3c', 'last_elem']




```python
# 删除一个列表末尾的元素
list1.pop()
list1
```




    ['0', 'insert_elem', 'a1', '2b', '3c']




```python
# 删除一个指定位置的元素
list1.pop(1)
list1
```




    ['0', 'a1', '2b', '3c']




```python
# 替换一个指定位置的元素
list1[2] = '233'
list1
```




    ['0', 'a1', '233', '3c']




```python
# 元素类型混合的列表
mix_list = ['Apple', 1.1, True, 4]
mix_list
```




    ['Apple', 1.1, True, 4]




```python
# 列表嵌套
aList = [1, 2, 3]
bList = ['a', aList, 'c']
bList
```




    ['a', [1, 2, 3], 'c']




```python
# 列表排序
l1 = ['c', 'a', 'b']
l1.sort() # 字典序
l1
```




    ['a', 'b', 'c']



# 元组 tuple


```python
# 元组 tuple
t1 = (1, 2, 3)
t1
```




    (1, 2, 3)




```python
# 元组元素不可变
t1[1] = '0'
```


    ---------------------------------------------------------------------------

    TypeError                                 Traceback (most recent call last)

    <ipython-input-11-000b1c67bf12> in <module>()
          1 # 元组元素不可变
    ----> 2 t1[1] = '0'


    TypeError: 'tuple' object does not support item assignment



```python
# 单个元素的元组
t2 = (2) # 错误的声明方式
t2
```




    2




```python
t2 = (1,) # 正确的声明方式：`,` 逗号用于消除歧义
t2
```




    (1,)




```python
# “可变”的元组
t3 = ('a', 'b', ['A', 'B'])
t3
```




    ('a', 'b', ['A', 'B'])




```python
# 修改“可变”的元组：实际只是修改元组中的某个（可变的）列表而已
t3[2][0] = 'X'
t3[2][1] = 'Y'
t3
```




    ('a', 'b', ['X', 'Y'])



# 语句


```python
# 条件语句

age = 20

if age >= 18: # 不能忘了写冒号
    print('adult')
elif age>= 6: # 条件分支
    print('teenager')
else: # 最后的默认分支
    print('kid')
```

    adult



```python
# 循环语句

names = ['Apple', 'Boy', 'Cat']

for name in names: # for 循环
    print(name)
```

    Apple
    Boy
    Cat



```python
# 循环求和
sum = 0

for x in [1, 2, 3]:
    sum += x

sum
```




    6




```python
sum = 0
n = 99

while n > 0: # while 循环
    sum += n
    n = n - 2

sum
```




    2500




```python
# 整数列生成：range()
r = range(5)
r
```




    range(0, 5)




```python
#（将正数列）转换为列表：list()
list(r)
```




    [0, 1, 2, 3, 4]



# 字典 dict


```python
# 字典 dict
d1 = {'Alice': 95, 'Bob': 75, 'Cat': 85}
d1
```




    {'Alice': 95, 'Bob': 75, 'Cat': 85}




```python
# 添加元素（键值对 key-value pair）到字典
d1['Ice'] = 90
d1
```




    {'Alice': 95, 'Bob': 75, 'Cat': 85, 'Ice': 90}




```python
# 访问不存在的元素
d1['2B']
```


    ---------------------------------------------------------------------------

    KeyError                                  Traceback (most recent call last)

    <ipython-input-21-8e60e5923ffc> in <module>()
          1 # 访问不存在的元素
    ----> 2 d1['2B']


    KeyError: '2B'



```python
# 判断字典是否存在某个元素（键 key）
'Hero' in d1
```




    False




```python
# 字典某个元素不存在时，返回自定义的默认值
d1.get('Hero', -1)
```




    -1




```python
# 删除一个字典元素
d1.pop('Ice') # 这时会返回这个元素的值
```




    90



# 集合 set


```python
# 集合 set

# 集合是一个 key（键）的集合，不存储 value（值）
s1 = set([1, 2, 3]) # 传入的参数是列表，用于初始化
s1
```




    {1, 2, 3}




```python
# 没有重复的 key
s1 = set([1, 1, 1, 2, 2, 3, 3]) # 重复的 key 会被合并
s1
```




    {1, 2, 3}




```python
# 添加一个元素
s1.add(4)
s1
```




    {1, 2, 3, 4}




```python
# 无法重复添加相同的元素
s1.add(4)
s1
```




    {1, 2, 3, 4}




```python
# 删除一个元素
s1.remove(4)
s1
```




    {1, 2, 3}




```python
# 准备（集合运算）
s2 = set([2, 3, 4])
s2
```




    {2, 3, 4}




```python
# 集合的交集
s1 & s2
```




    {2, 3}




```python
# 集合的并集
s1 | s2
```




    {1, 2, 3, 4}



# 函数 function

## 内置函数 build-in


```python
# 绝对值
abs(-100)
```




    100




```python
# 最大值
max(1, 3, 2)
```




    3




```python
# 类型转换

## 整数
int('123')
```




    123




```python
int(1.23)
```




    1




```python
## 浮点数
float('12.3')
```




    12.3




```python
## 字符串
str(123)
```




    '123'




```python
## 布尔
bool(1)
```




    True




```python
bool('')
```




    False




```python
## 非零即 True
bool(-1)
```




    True



## 自定义函数


```python
# 自定义函数
def my_abs(x):
    if x >= 0:
        return x
    else:
        return -x

my_abs(-1)
```




    1




```python
# 语句「跳过」
pass
```


```python
## 什么也不做的函数
def nop():
    pass

nop()
```


```python
## 什么也不做的分支
if age >= 1:
    pass
else:
    # 缺少了 pass 的空分支会报错
```


      File "<ipython-input-52-597539bfdf28>", line 5
        # 缺少了 pass 的空分支会报错
                          ^
    SyntaxError: unexpected EOF while parsing




```python
# 函数参数的类型检查
def my_abs(x):
    #### 类型检查的语法 isinstance(…)
    if not isinstance(x, (int, float)):
        #### 报参数错误
        raise TypeError('bad oprand type')

    if x >= 0:
        return x
    else:
        return -x

my_abs('12')
```


    ---------------------------------------------------------------------------

    TypeError                                 Traceback (most recent call last)

    <ipython-input-53-01e3e9adef36> in <module>()
         11         return -x
         12
    ---> 13 my_abs('12')


    <ipython-input-53-01e3e9adef36> in my_abs(x)
          4     if not isinstance(x, (int, float)):
          5         #### 报参数错误
    ----> 6         raise TypeError('bad oprand type')
          7
          8     if x >= 0:


    TypeError: bad oprand type



```python
# 导入编程模块
import math # 导入 math 包，其中包含 `sin()` 与 `cos()` 函数
```


```python
# 多个返回值

def move(x, y, step, angle=0):
    nx = x + step * math.cos(angle)
    ny = y = step * math.sin(angle)
    return nx, ny

move(100, 100, 60, math.pi / 6) # 实际上返回值是元组
```




    (151.96152422706632, 29.999999999999996)




```python
# `x, y = …` 的赋值方式可以分别按序获得函数返回的元组中的各个元素
x, y = move(100, 100, 60, math.pi / 6)
x
```




    151.96152422706632




```python
y
```




    29.999999999999996



## 函数参数


```python
# 函数参数
def power(x, n): # 多个函数参数
    s = 1
    while n > 0:
        n -= 1
        s = s * x
    return s

power(2, 3)
```




    8




```python
# 缺失参数报错
power(2)
```


    ---------------------------------------------------------------------------

    TypeError                                 Traceback (most recent call last)

    <ipython-input-68-c11c9f54ebfc> in <module>()
          1 # 缺失参数报错
    ----> 2 power(2)


    TypeError: power() missing 1 required positional argument: 'n'


### 默认参数 default param


```python
# 默认参数 default param：也可以称为缺省参数

def power(x, n=2): # 必选参数必须在默认参数之前
    s = 1
    while n > 0:
        n -= 1
        s = s * x
    return s

power(2)
```




    4




```python
# 注意：默认参数的一个 bug（错用）
def add_end(L=[]):
    L.append('END')
    return L

add_end() # 1st output
```




    ['END']




```python
add_end() # 2nd
```




    ['END', 'END']




```python
add_end() # 3rd
```




    ['END', 'END', 'END']




```python
# 避免上述默认参数问题的方法
def add_end(L=None):
    if L is None:
        L = []
    L.append('END')
    return L

add_end() # 1st
```




    ['END']




```python
add_end() # 2nd 仍然正确
```




    ['END']



### 可变参数


```python
# 可变参数
def sum(nums): # 一般的函参写法（函参 = 函数参数）
    sum = 0
    for x in nums:
        sum += x
    return sum


sum([1, 2, 3])# 一般的函参调用方式：用列表作为函参
```




    6




```python
sum((1, 2, 3)) # 用元组作为函参
```




    6




```python
# 多函参的调用方式！
def sum(*nums):
    sum = 0
    for x in nums:
        sum += x
    return sum

sum(1, 2, 3) # 三个函参
```




    6




```python
sum(1, 2, 3, 4) # 四个函参
```




    10



### 关键字参数


```python
# 关键字参数

## 可变参数，将传入的函参组装成元组 tuple
## 关键字参数，则将它们组装成字典 dict
def person(name, age, **kw):
    print('name:', name, 'age:', age, 'others:', kw)

person('Ice', 24)
```

    name: Ice age: 24 others: {}



```python
person('IceHe', 25, city='Beijing')
```

    name: IceHe age: 25 others: {'city': 'Beijing'}



```python
person('IceHe', 25, city='Beijing', job='Engineer')
```

    name: IceHe age: 25 others: {'city': 'Beijing', 'job': 'Engineer'}



```python
# 限制关键字参数的名字
def person(name, age, *, city, job): # 简化写法！
    print(name, age, city, job)

person('Alice', '12', 'beijing', 'student') # 错误用法
```


    ---------------------------------------------------------------------------

    TypeError                                 Traceback (most recent call last)

    <ipython-input-88-e06e0578d736> in <module>()
          3     print(name, age, city, job)
          4
    ----> 5 person('Alice', '12', 'beijing', 'student') # Error


    TypeError: person() takes 2 positional arguments but 4 were given



```python
person('Alice', '12', city='beijing', job='student') # 正确用法
```

    Alice 12 beijing student


### 参数组合


```python
# 参数组合

## 参数定义的顺序必须是：必选参数、默认参数、可变参数、命名关键字参数和关键字参数。
def f1(a, b, c=0, *args, **kw):
    print('a =', a, 'b =', b, 'c =', c, 'args =', args, 'kw =', kw)

f1(1, 2, 3, 'a', 'b', x=99)
```

    a = 1 b = 2 c = 3 args = ('a', 'b') kw = {'x': 99}



```python
def f2(a, b, c=0, *, d, **kw):
    print('a =', a, 'b =', b, 'c =', c, 'd =', d, 'kw =', kw)

f2(1, 2, d=99, ext=None)
```

    a = 1 b = 2 c = 0 d = 99 kw = {'ext': None}



```python
# 通过 tuple 和 dict 也可以调用上述函数
args = (1, 2, 3, 4)
kw = {'d': 88, 'x': '#'}
f1(*args, **kw) ##### 不要漏掉 `*` 和 `**`
```

    a = 1 b = 2 c = 3 args = (4,) kw = {'d': 88, 'x': '#'}



```python
args = (1, 2, 3)
f2(*args, **kw)
```

    a = 1 b = 2 c = 3 d = 88 kw = {'x': '#'}


## 递归函数


```python
# 递归函数
def factorial(n):
    if n == 1:
        return 1
    return n * factorial(n - 1)

factorial(5)
```




    120




```python
# 递归嵌套过深导致栈溢出
factorial(1000)
```


    ---------------------------------------------------------------------------

    NameError                                 Traceback (most recent call last)

    <ipython-input-95-e1ef40be0628> in <module>()
          1 # 递归嵌套过深导致栈溢出
    ----> 2 factorial(1000)


    NameError: name 'factorial' is not defined



```python
# 尾递归（优化内存使用）
def factorial2(n, p=1):
    if n == 1:
        return p
    # （尾递归的）思路：将中间结果先计算出来，再返回去！就可以减少使用的栈空间（只用一个栈帧）
    return factorial2(n - 1, n * p)

# 虽然已经使用了尾递归的写法，可是 Python 编译器没有做相关优化，所以还是会栈溢出
factorial2(1000)
```


    ---------------------------------------------------------------------------

    RecursionError                            Traceback (most recent call last)

    <ipython-input-98-354f146d0995> in <module>()
          7
          8 # 虽然已经使用了尾递归的写法，可是 Python 编译器没有做相关优化，所以还是会栈溢出
    ----> 9 factorial2(1000)


    <ipython-input-98-354f146d0995> in factorial2(n, p)
          4         return p
          5     # （尾递归的）思路：将中间结果先计算出来，再返回去！就可以减少使用的栈空间（只用一个栈帧）
    ----> 6     return factorial2(n - 1, n * p)
          7
          8 # 虽然已经使用了尾递归的写法，可是 Python 编译器没有做相关优化，所以还是会栈溢出


    ... last 1 frames repeated, from the frame below ...


    <ipython-input-98-354f146d0995> in factorial2(n, p)
          4         return p
          5     # （尾递归的）思路：将中间结果先计算出来，再返回去！就可以减少使用的栈空间（只用一个栈帧）
    ----> 6     return factorial2(n - 1, n * p)
          7
          8 # 虽然已经使用了尾递归的写法，可是 Python 编译器没有做相关优化，所以还是会栈溢出


    RecursionError: maximum recursion depth exceeded in comparison



```python
# 教程中原来的尾递归写法（以上是我自己的写法）
def fact(n):
    return fact_iter(n, 1)

def fact_iter(n, p):
    if n == 1:
        return p
    return fact_iter(n - 1, n * p)
```

# 切片


```python
# 准备切片素材
L = ['Michael', 'Sarah', 'Tracy', 'Bob', 'Jack']
L
```




    ['Michael', 'Sarah', 'Tracy', 'Bob', 'Jack']




```python
# 取前 3 个元素
[L[0], L[1], L[2]] # 笨拙的写法
```




    ['Michael', 'Sarah', 'Tracy']




```python
# 快捷的写法：切片！
L[:3]
```




    ['Michael', 'Sarah', 'Tracy']




```python
# L[:3] 等价于以下写法
L[0:3]
```




    ['Michael', 'Sarah', 'Tracy']




```python
# 切片第一个参数「起始索引」！（参数由 `:` 分隔）
L[1:3] #  即从第几个元素开始切
```




    ['Sarah', 'Tracy']




```python
# 从倒数的索引开始切片
L[-2:]
```




    ['Bob', 'Jack']




```python
# 切片第二个参数「末尾索引」！
L[-2:-1] # 体会它与 `L[-2:]` 的区别：不包括末尾索引位置的那个元素！
```




    ['Bob']




```python
# 切片第三个参数「索引步长」！
L = list(range(10)) # 复习：整数列生成
L
```




    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]




```python
L[::2] # 每两个元素中取一个元素
```




    [0, 2, 4, 6, 8]




```python
L[::-2] # 负的步长 -> 倒序取元素！
```




    [9, 7, 5, 3, 1]




```python
# 复制列表
L[:]
```




    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]




```python
L.copy() # 另一种复制方法
```




    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]




```python
# 元组切片
tuple(range(10))[:3]
```




    (0, 1, 2)




```python
# 字符串切片
'ABCDEFG'[:3]
```




    'ABC'




```python
'ABCDEFG'[::3]
```




    'ADG'



# 迭代 iterate


```python
# 迭代

d = {'a': 1, 'b': 2, 'c': 3}

for k in d: # 单个参数只能获取到元组的键（key）
    print(k)
```

    a
    b
    c



```python
for k, v in d: # 两个参数也不能正确地分别获取到元组的键值对（key 和 value）
    print(k, v)
```


    ---------------------------------------------------------------------------

    ValueError                                Traceback (most recent call last)

    <ipython-input-131-106ecdc04604> in <module>()
    ----> 1 for k, v in d: # 两个参数也不能正确地分别获取到元组的键值对（key 和 value）
          2     print(k, v)


    ValueError: not enough values to unpack (expected 2, got 1)



```python
# 直接获取元组的 value 的写法：`*.values()`
for v in d.values():
    print(v)
```

    1
    2
    3



```python
# 正确获取元组的 key => value 的写法：`*.items()`
for k, v in d.items():
    print(k, '=>', v)
```

    a => 1
    b => 2
    c => 3



```python
# 字符串迭代
for c in 'ABC':
    print(c)
```

    A
    B
    C


## 对象可否迭代 Iterable


```python
# 判断对象是否可迭代？
from collections import Iterable # 只导入特定包中的需要用到的特定对象

isinstance('abc', Iterable)
```




    True




```python
isinstance([1, 2, 3], Iterable)
```




    True




```python
isinstance(123, Iterable)
```




    False




```python
# `enumerate()` 函数，将列表变成 key-value pair
for i, v in enumerate(['A', 'B', 'C']):
    print(i, '=>', v)
```

    0 => A
    1 => B
    2 => C



```python
# 同时引用两个变量
for x, y in [(1, 1), (2, 4), (3, 9)]:
    print(x, '=>', y)
```

    1 => 1
    2 => 4
    3 => 9


# 列表生成式 range


```python
# 列表生成式
r = range(1, 11)
r
```




    range(1, 11)




```python
list(r) # 然后用 `list()` 转换为真正的列表
```




    [0, 1, 2, 3, 4]




```python
# 如何获得列表 [1*1, 2*2, …, n*n]

## 笨拙的写法
L = []
for x in range(1, 11):
    L.append(x * x)

L
```




    [1, 4, 9, 16, 25, 36, 49, 64, 81, 100]




```python
## 便捷的写法：列表生成式！
[x * x for x in range(1, 11)]
```




    [1, 4, 9, 16, 25, 36, 49, 64, 81, 100]




```python
# 多重循环（一般很少用到三重甚至三重以上的循环）
[m + n for m in 'ABC' for n in 'XYZ']
```




    ['AX', 'AY', 'AZ', 'BX', 'BY', 'BZ', 'CX', 'CY', 'CZ']




```python
[x * y for x in range(1, 4) for y in range(1, 4)]
```




    [1, 2, 3, 2, 4, 6, 3, 6, 9]



## 列表生成式的应用


```python
# 例子：列出目录文件
import os # 导入 os 包（模块），用途暂略

[d for d in os.listdir('.')]
```




    ['.ipynb_checkpoints', 'Fabonacci.ipynb', 'python3.ipynb']




```python
# 多个参数的列表生成式
d = {'x': 'A', 'y': 'B', 'z': 'C'}

[k + '=' + v for k, v in d.items()]
```




    ['x=A', 'y=B', 'z=C']




```python
# 例子：字符串转换为小写
strs = ['Hello', 'World', 'IBM', 'Apple']
[s.lower() for s in strs]
```




    ['hello', 'world', 'ibm', 'apple']



# 生成器 generator


```python
# 生成器 generator

## 对比「列表生成器」
L = [x * x for x in range(10)]
L
```




    [0, 1, 4, 9, 16, 25, 36, 49, 64, 81]




```python
## 「生成器」只在有需要时，才会计算下一个需要获取的值！
g = (x * x for x in range(10)) # Lazy Calculation
g
```




    <generator object <genexpr> at 0x102e98360>




```python
next(g) # 1st
```




    0




```python
next(g) # 2nd
```




    1




```python
next(g) # 3rd
```




    4




```python
# 用循环语句从生成器获取值（因为用 `next(generator)` 不够方便）
for n in g:
    print(n)
```

    9
    16
    25
    36
    49
    64
    81



```python
# 例子：斐波拉契数列
def fibonacci(max):
    n, a, b = 0, 0, 1
    while n < max:
        print(b)
        a, b = b, a + b
        n += 1
    return 'done'

fibonacci(7)
```

    1
    1
    2
    3
    5
    8
    13





    'done'



- 说明：多变量赋值语句

    `a, b = b, a + b`

    等价于

```
t = (b , a + b)
a = t[0]
b = t[1]
```

## yield


```python
# yield

def odd():
    print('step 1')
    yield 1 # yield 是相对于 return 的存在
    print('step 2')
    yield 3
    print('step 3')
    yield 5
```


```python
o = odd()

next(o) # 1st
```

    step 1





    1




```python
next(o) # 2nd
```

    step 2





    3




```python
next(o) # 3rd
```

    step 3





    5




```python
next(o) # error：StopIteration
```


    ---------------------------------------------------------------------------

    StopIteration                             Traceback (most recent call last)

    <ipython-input-176-97e97a5e3d6b> in <module>()
    ----> 1 next(o) # error：StopIteration


    StopIteration:



```python
# 对 StopIteration 的错误捕获

g = fibonacci(6)

while True:
    try:
        x = next(g)
        print('g:', x)
    except StopIteration as e:
        print('Generator return value:', e.value)
        break
```

    1
    1
    2
    3
    5
    8



    ---------------------------------------------------------------------------

    TypeError                                 Traceback (most recent call last)

    <ipython-input-177-1ce57457c858> in <module>()
          5 while True:
          6     try:
    ----> 7         x = next(g)
          8         print('g:', x)
          9     except StopIteration as e:


    TypeError: 'str' object is not an iterator


## 生成器的应用


```python
# 例子：杨辉三角

def triangles():
    yield [1]

    L = [1, 1]
    yield L

    cnt = 2
    while True:
        tmpL = [1]
        i = 1
        while i < cnt:
            tmpL.append(L[i - 1] + L[i])
            i += 1
        tmpL.append(1)
        L = tmpL
        cnt += 1
        yield tmpL

n = 0
for t in triangles():
    print(t)
    n += 1
    if n == 10:
        break
```

    [1]
    [1, 1]
    [1, 2, 1]
    [1, 3, 3, 1]
    [1, 4, 6, 4, 1]
    [1, 5, 10, 10, 5, 1]
    [1, 6, 15, 20, 15, 6, 1]
    [1, 7, 21, 35, 35, 21, 7, 1]
    [1, 8, 28, 56, 70, 56, 28, 8, 1]
    [1, 9, 36, 84, 126, 126, 84, 36, 9, 1]


# 迭代器 Iterator

- 可以用 for 遍历的数据类型
    - 集合数据类型：list, tuple, dict, set, str
    - generator：生成器和带 yield 的 generator function


```python
# 判断可否迭代
from collections import Iterable

isinstance([], Iterable)
```




    True




```python
isinstance({}, Iterable)
```




    True




```python
isinstance('abc', Iterable)
```




    True




```python
isinstance((x for x in range(10)), Iterable)
```




    True




```python
isinstance(100, Iterable)
```




    False



- 生成器可以用 `next()` 不断调用并返回下一个值，直到最后抛出 StopIteration
- 可以被 `next()` 调用，不断返回下一个值的对象称为迭代器


```python
# 判断是否是一个 Iterator
from collections import Iterator

isinstance((x for x in range(10)), Iterator)
```




    True




```python
isinstance([], Iterator)
```




    False




```python
isinstance({}, Iterator)
```




    False




```python
isinstance('abc', Iterator)
```




    False




```python
# list, dict, str 等是 Iterable 但不是 Iterator 的对象可以通过 `iter()` 获得一个对应 Iterator 的对象
for x in list(range(1, 6)):
    print(x)
```

    1
    2
    3
    4
    5



```python
# 以下代码等价于以上代码
it = iter(list(range(1, 6)))

while True:
    try:
        print(next(it))
    except StopIteration:
        break
```

    1
    2
    3
    4
    5


# 高阶函数


```python
# 函数对象
abs
```




    <function abs>




```python
# 将函数签名赋值给变量
f = abs
f
```




    <function abs>




```python
# 用函数签名调用函数
f(-10)
```




    10




```python
# 简单的高阶函数
def add(x, y, f):
    return f(x) + f(y)

add(-5, 6, f)
```




    11



## map & reduce

### map


```python
# Python 内建 `map()` & `reduce()`
def f(x):
    return x * x

# map
m = map(f, range(1, 10))
m
```




    <map at 0x102e402e8>




```python
list(m)
```




    [1, 4, 9, 16, 25, 36, 49, 64, 81]




```python
# 以上的 map 写法等价于以下的循环写法
L = []

for x in range(1, 10):
    L.append(f(x))

L
```




    [1, 4, 9, 16, 25, 36, 49, 64, 81]




```python
list(map(str, range(1, 10)))
```




    ['1', '2', '3', '4', '5', '6', '7', '8', '9']



### reduce


```python
# reduce
from functools import reduce

def add(x, y):
    return x + y

reduce(add, list(range(1, 10))[::2]) # [1, 3, 5, 7, 9]
```




    25




```python
# reduce 的应用：将字符串 str 转换为整数 int
def fn(x, y):
    return x * 10 + y

def char2num(ch):
    return {'0': 0, '1': 1, '2': 2, '3': 3, '4': 4, '5': 5, '6': 6, '7': 7, '8': 8, '9': 9}[ch]

reduce(fn, map(char2num, '13579'))
```




    13579




```python
# 以上代码可以整理起来
def s2i(s):
    def fn(x, y):
        return x * 10 + y
    def char2num(ch):
        return {'0': 0, '1': 1, '2': 2, '3': 3, '4': 4, '5': 5, '6': 6, '7': 7, '8': 8, '9': 9}[ch]
    return reduce(fn, map(char2num, s))

s2i('24680')
```




    24680



### 组合应用

利用 `map()` 函数，把用户输入的不规范的英文名字，变为首字母大写，其他小写的规范名字。

输入：['adam', 'LISA', 'barT']

输出：['Adam', 'Lisa', 'Bart']


```python
def formatStr(s):
    return s[0].upper() +  s[1:].lower()

list(map(formatStr, ['adam', 'LISA', 'barT']))
```




    ['Adam', 'Lisa', 'Bart']



编写一个 `prod()` 函数，可以接受一个 list 并利用 reduce() 求积。

（Python 提供的 `sum()` 函数可以接受一个 list 并求和）


```python
from functools import reduce

def prod(nums):
    def product(x, y):
        return x * y
    return reduce(product, nums)

prod(list(range(1, 5)))
```




    24



编写一个 `str2float()` 函数，把字符串 '123.456' 转换成浮点数 123.456。


```python
from functools import reduce

def str2float(s):
    def char2num(ch):
        return {'0': 0, '1': 1, '2': 2, '3': 3, '4': 4, '5': 5, '6': 6, '7': 7, '8': 8, '9': 9}[ch]

    def toDecimal(s):
        def x10(x, y):
            return x * 10 + y
        return reduce(x10, map(char2num, s))

    result = list(map(toDecimal, s.split('.')))

    while result[1] > 1:
        result[1] /= 10

    return result[0] + result[1]

str2float('123.456')
```




    123.456



## filter


```python
def isOdd(n):
    return n % 2 == 1

list(filter(isOdd, [1, 2, 4, 5, 6, 9, 10, 15]))
```




    [1, 5, 9, 15]




```python
def notEmpty(s):
    return s and s.strip()

list(filter(notEmpty, ['A', '', 'B', None, 'C', '  ']))
```




    ['A', 'B', 'C']



用 filter 求素数


```python
# 埃氏筛法：http://baike.baidu.com/item/%E5%9F%83%E6%8B%89%E6%89%98%E8%89%B2%E5%B0%BC%E7%AD%9B%E9%80%89%E6%B3%95

def oddIter():
    n = 1
    while True:
        n = n + 2
        yield n

def notDivisible(n):
    return lambda x: x % n > 0

def primes():
    yield 2
    it = oddIter() # 初始序列
    while True:
        n = next(it) # 返回序列的第一个数
        yield n
        it = filter(notDivisible(n), it)

for n in primes():
    if n < 100:
        print(n)
    else:
        break
```

    2
    3
    5
    7
    11
    13
    17
    19
    23
    29
    31
    37
    41
    43
    47
    53
    59
    61
    67
    71
    73
    79
    83
    89
    97


回数是指从左向右读和从右向左读都是一样的数，例如12321，909。

请利用filter()滤掉非回数：


```python
def isPalindrome(n):
    ns = str(n) # ns -> num_str
    while ns is not '':
        if ns[0] is not ns[-1]:
            return False
        ns = ns[1:-1]
    return True

list(filter(isPalindrome, range(1, 1000)))
```




    [1,
     2,
     3,
     4,
     5,
     6,
     7,
     8,
     9,
     11,
     22,
     33,
     44,
     55,
     66,
     77,
     88,
     99,
     101,
     111,
     121,
     131,
     141,
     151,
     161,
     171,
     181,
     191,
     202,
     212,
     222,
     232,
     242,
     252,
     262,
     272,
     282,
     292,
     303,
     313,
     323,
     333,
     343,
     353,
     363,
     373,
     383,
     393,
     404,
     414,
     424,
     434,
     444,
     454,
     464,
     474,
     484,
     494,
     505,
     515,
     525,
     535,
     545,
     555,
     565,
     575,
     585,
     595,
     606,
     616,
     626,
     636,
     646,
     656,
     666,
     676,
     686,
     696,
     707,
     717,
     727,
     737,
     747,
     757,
     767,
     777,
     787,
     797,
     808,
     818,
     828,
     838,
     848,
     858,
     868,
     878,
     888,
     898,
     909,
     919,
     929,
     939,
     949,
     959,
     969,
     979,
     989,
     999]



## sortd


```python
sorted([36, 5, -12, 9, -21])
```




    [-21, -12, 5, 9, 36]




```python
sorted([36, 5, -12, 9, -21], key=abs) # 高阶函数，自定义排序
```




    [5, 9, -12, -21, 36]




```python
sorted(['bob', 'about', 'Zoo', 'Credit']) # 字典序
```




    ['Credit', 'Zoo', 'about', 'bob']




```python
sorted(['bob', 'about', 'Zoo', 'Credit'], key=str.lower) # 忽略大小写
```




    ['about', 'bob', 'Credit', 'Zoo']




```python
sorted(['bob', 'about', 'Zoo', 'Credit'], key=str.lower, reverse=True) # 倒序
```




    ['Zoo', 'Credit', 'bob', 'about']



假设我们用一组 tuple 表示学生名字和成绩：

请用 sorted() 对其分别按名字排序：


```python
L = [('Bob', 75), ('Adam', 92), ('Bart', 66), ('Lisa', 88)]

def byName(t):
    return t[0]

sorted(L, key=byName)
```




    [('Adam', 92), ('Bart', 66), ('Bob', 75), ('Lisa', 88)]



再按成绩从高到低排序：


```python
def byScore(t):
    return t[1]

sorted(L, key=byScore, reverse=True)
```




    [('Adam', 92), ('Lisa', 88), ('Bob', 75), ('Bart', 66)]



# 函数式编程（其它）

##  函数作为返回值


```python
def lazySum(*args):
    def sum():
        ax = 0
        for n in args:
            ax += n
        return ax
    return sum

f = lazySum(1, 3, 5, 7, 9)
f
```




    <function __main__.lazySum.<locals>.sum>




```python
f()
```




    25




```python
f1 = lazySum(1, 3, 5, 7, 9)
f2 = lazySum(1, 3, 5, 7, 9)

f1 == f2
```




    False



## 闭包


```python
# 错误示范
def count():
    fs = []
    for i in range(1, 4):
        def f():
            return i * i
        fs.append(f)
    return fs

f1, f2, f3 = count()

f1()
```




    9




```python
f2()
```




    9




```python
f3()
```




    9




```python
# 正确用法
def count():
    def f(j):
        def g():
            return j * j
        return g
    fs = []
    for i in range(1, 4):
        fs.append(f(i))
    return fs

# 返回闭包时牢记的一点就是：返回函数不要引用任何循环变量，或者后续会发生变化的变量。如果一定要引用循环变量怎么办？
# 方法是再创建一个函数，用该函数的参数绑定循环变量当前的值，无论该循环变量后续如何更改，已绑定到函数参数的值不变。

f1, f2, f3 = count()

f1()
```




    1




```python
f2()
```




    4




```python
f3()
```




    9




```python
# 正确用法
def count():
    def f(j):
        def g():
            return j * j
        return g
    fs = []
    for i in range(1, 4):
        fs.append(f(i))
    return fs

f1, f2, f3 = count()

f1()
```




    1



## 匿名函数


```python
list(map(lambda x: x * x, range(1, 10)))
```




    [1, 4, 9, 16, 25, 36, 49, 64, 81]




```python
def f(x):
    return x * x

# 等价于

lambda x: x * x
```




    <function __main__.<lambda>>



## 装饰器


```python
def now():
    print('2017-04-22')

f = now
f()
```

    2017-04-22



```python
# 获取函数的名字
now.__name__
```




    'now'




```python
f.__name__
```




    'now'



增强now()函数的功能，比如，在函数调用前后自动打印日志，但又不希望修改now()函数的定义，

这种在代码运行期间动态增加功能的方式，称之为“装饰器”（Decorator）。

本质上，decorator就是一个返回函数的高阶函数。所以，我们要定义一个能打印日志的decorator


```python
def log(func):
    def wrapper(*args, **kw):
        print('call %s():' % func.__name__)
        return func(*args, **kw)
    return wrapper

@log
def now():
    print('2017-04-22')

now()
```

    call now():
    2017-04-22


以上包装器的写法，等价于以下代码


```python
now = log(now)
```

---


```python
def log(text):
    def decorator(func):
        def wrapper(*args, **kw):
            print('%s %s():' % (text, func.__name__))
            return func(*args, **kw)
        return wrapper
    return decorator

@log('execute')
def now():
    print('2017-04-22')

now()
```

    execute now():
    2017-04-22


以上包装器的写法，等价于以下代码


```python
now = log('execute')(now)
```

---

但是以上的写法有个缺点


```python
now.__name__ # 函数名字就成了 wrapper，而不是原来的 now
```




    'wrapper'




```python
# 用 functools.wraps(func) 来修正
import functools

def log(func):
    @functools.wraps(func)
    def wrapper(*args, **kw):
        print('call %s():' % func.__name__)
        return func(*args, **kw)
    return wrapper

@log
def now():
    print('2017-04-22')

now()
```

    call now():
    2017-04-22


## 偏函数


```python
int('12345')
```




    12345




```python
int('12345', base=8) # 8 进制转 10 进制
```




    5349




```python
int('AE', 16) # 16 进制转 10 进制
```




    174




```python
def int2(x, base=2):
    return int(x, base)

int2('1000000')
```




    64




```python
int2('1010101')
```




    85



以上 int2() 声明的代码与一下代码等价


```python
int2 = functools.partial(int, base=2)

int2('10010')
```




    18



又相当于


```python
kw = {'base': 2}
int('10010', **kw)
```




    18



---


```python
max2 = functools.partial(max, 10)

max2(5, 6, 7)
```




    10



以上代码相当于


```python
args = (10, 5, 6, 7)
max(*args)
```




    10



# 模块


```python
import sys

def test():
    args = sys.argv
    if len(args) == 1:
        print('Hello, world!')
    elif len(args) == 2:
        print('Hello, %s!' % args[1])
    else:
        print('Too many arguments!')
    print(args)

test()
```

    Too many arguments!
    ['/usr/local/lib/python3.6/site-packages/ipykernel/__main__.py', '-f', '/Users/IceHe/Library/Jupyter/runtime/kernel-f9ae0017-3106-4f62-8484-4df0beb75b9d.json']



```python
__name__
```




    '__main__'




```python
__doc__
```




    'Automatically created module for IPython interactive environment'



# 最后

- 参考《[廖学峰的 Python 教程](http://www.liaoxuefeng.com/wiki/0014316089557264a6b348958f449949df42a6d3a2e542c000)》
- 直接访问原教程，学习后续的部分 《[使用模块](http://www.liaoxuefeng.com/wiki/0014316089557264a6b348958f449949df42a6d3a2e542c000/001431845183474e20ee7e7828b47f7b7607f2dc1e90dbb000)》
