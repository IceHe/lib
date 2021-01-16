# Sorting Algorithms

References

- [Sorting Algorithms](https://www.toptal.com/developers/sorting-algorithms)

List

- [x] Insertion Sort
- [ ] Selection Sort
- [ ] Bubble Sort
- [ ] Merge Sort
- [ ] Quick Sort
- [ ] Quick3 Sort
- [ ] Heap Sort
- [ ] Shell Sort
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
- Adaptive: O(n) time when nearly sorted
- Very low overhead

Pseudocode

```bash
for i = 2:n,
    for (k = i; k > 1 and a[k] < a[k-1]; k--)
        swap a[k,k-1]
    → invariant: a[1..i] is sorted
end
```