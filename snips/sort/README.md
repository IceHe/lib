# Sorting Algorithm (draft)

## Action

PHP

- [Tool Functions](/snips/sort/tools.php)
- [Bubble](/snips/sort/bubble.php)
- [Selection](/snips/sort/selection.php)
- [Insertion](/snips/sort/insert.php)
- [Merge](/snips/sort/merge.php)

## Plan

完成实现

- 先写伪代码，理清思路
- 是不是应该先用纸写实现
- 用 PHP 写实现
- 第二次重写复习时用另一种语言
    - C++ / Java ?

进行对比

- 时间复杂度
    - `O(n*n)` 或者 `O(n*log(n))`
- 空间复杂度
    - replace in place
- 是否稳定
    - quick sort 不稳定
- 使用的情况
    - insertion 最常用
    - bubble 最差？
    - 接近有序的数组，用谁最好
- 适用规模
    - 小于多少个元素，哪个排序是最好的
    - 大于多少个元素，哪个排序是最好的
- 其它……

## Todos

> Kinds * Implementations

Kinds

- Bubble
- Insert
- Selective
- Merge
- Quicksort
    - 两路
    - 三路
    - ……
- Heap Sort
- 基数排序

Implementations

- PHP : draft - 理清思路
- C : optional (recommended)
- C++ : optional (necessary?)
- Java : optional
- Template : C++ / Java ?
