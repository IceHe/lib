# Plan

## Initial Stage

Kinds x ( Pseudo , PHP )

- 伪代码实现：理清思路
- 纸笔实现：提高思维的严谨度
- PHP 实现：简单快捷
    - 验证结果
- 记笔记：简单即可

## Complete Stages

完整过程

- 先写伪代码（理清思路）
- 第一次应该先用纸写实现（把事做准 - 提高思维的严谨度）
- 用 PHP 写简单的实现
- 对比各个排序算法，得出特征和优缺点
    - 时间/空间复杂度、是否稳定、适用场景
- 第二次复习时，用另一种语言重写
    - 隔一段时间，“淡忘”之后再重写，用以加深印象
        - 提高知识在大脑中的「提取强度」
    - C / C++ / Java / Python ?

### Propeties

性质 ( or feature 特征 ? )

- 时间复杂度
    - `O(n*n)` 或者 `O(n*log(n))`
- 空间复杂度
    - replace in place : 不适用额外的存储空间
- 是否稳定
    - quick sort 不稳定
- 适用的场景
    - insertion 最常用的？
    - bubble 最差？
    - 接近有序的数组，用谁最好？
- 适用规模
    - 小于多少个元素，哪个排序是最好的
    - 大于多少个元素，哪个排序是最好的
- ……

---

# Tasks

Kinds x Language

- Language : Programming Language Implementations

## Kinds

- Bubble
- Insert
- Selective
- Merge
- Quicksort
    - 两路
    - 三路
- Heap Sort
- 基数排序

## Language

- Pseudo-code : 理清思路
- PHP : draft / 简单实现
    - 用 PHP 完成实现很便捷、迅速（简直首选）
- C : optional (recommended : 在学)
- C++ : optional (necessary? : 重温)
- Java : optional (necessary? : 巩固)
- Template : C++ / Java (unnecessary? : 暂无必要用模板类实现)

TODO