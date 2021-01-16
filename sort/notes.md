# Sorting Algorithms

References

- [Sorting Algorithms](https://www.toptal.com/developers/sorting-algorithms)

Index

- [x] Insertion Sort
- [x] Selection Sort
- [x] Bubble Sort
- [ ] Shell Sort
- [ ] Merge Sort
- [ ] Quick Sort
- [ ] Quick3 Sort
- [ ] Heap Sort
- [ ] 基数排序

Step

- 伪代码实现: 理清思路
- 纸笔实现: 提高思维的严谨度
- 代码实现
- 对比各个排序算法: 得出特征和优缺点
- 时间/空间复杂度、是否稳定、适用场景

Propeties

- 时间复杂度
    - `O(n*n)` 或者 `O(n*log(n))`
- 空间复杂度
    - replace in place : 不适用额外的存储空间
- _是否稳定_
    - quick sort 不稳定
- _适用的场景_
    - insertion 最常用的？
    - bubble 最差？
    - 接近有序的数组，用谁最好？
- _适用规模_
    - 小于多少个元素，哪个排序是最好的
    - 大于多少个元素，哪个排序是最好的

## Insertion Sort

Reference: [Insertion Sort](https://www.toptal.com/developers/sorting-algorithms/insertion-sort)

Properties

- Stable
- O(1) extra space
- O(n^2) comparisons and swaps
- **Adaptive: O(n) time when nearly sorted**
- Very low overhead

Pseudocode

```bash
for i = 2:n,
    for (k = i; k > 1 and a[k] < a[k-1]; k--)
        swap a[k,k-1]
    → invariant: a[1..i] is sorted
end
```

## Selection Sort

Reference: [Selection Sort](https://www.toptal.com/developers/sorting-algorithms/selection-sort)

Properties

- **Not stable?**
- O(1) extra space
- Θ(n^2) comparisons
- **Θ(n) swaps**
- **Not adaptive**: _always Θ(n^2) comparisons_

Pseudocode

```bash
for i = 1:n,
    k = i
    for j = i+1:n, if a[j] < a[k], k = j
    → invariant: a[k] smallest of a[i..n]
    swap a[i,k]
    → invariant: a[1..i] in final position
end
```

Others

- Why not stable? I think:
    - If alway swap a[i, k], it's not stable.
    - If swap a[i, k] only when i != k, it's stable.

## Bubble Sort

Reference: [Bubble Sort](https://www.toptal.com/developers/sorting-algorithms/bubble-sort)

Properties

- Stable
- O(1) extra space
- O(n^2) comparisons and swaps
- **Adaptive**: O(n) when nearly sorted

Pseudocode

```bash
for i = 1:n,
    swapped = false
    for j = n:i+1,
        if a[j] < a[j-1],
            swap a[j,j-1]
            swapped = true
    → invariant: a[1..i] in final position
    break if not swapped
end
```

Others

-   In the case of nearly sorted data,
    bubble sort takes O(n) time,
    but requires at least 2 passes through the data
    (whereas insertion sort requires something more like 1 pass).

## Shell Sort

Reference: [Shell Sort](https://www.toptal.com/developers/sorting-algorithms)

Properties

Pseudocode

```baash

```

## Todo Sort

Reference: [Sort]()

Properties

Pseudocode

```baash

```

## Todo Sort

Reference: [Sort]()

Properties

Pseudocode

```baash

```
