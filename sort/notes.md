# Sorting Algorithms

References

- [Sorting Algorithms](https://www.toptal.com/developers/sorting-algorithms)

Index

- Insertion Sort
- Selection Sort
- Bubble Sort
- Shell Sort
- Merge Sort
- Quick Sort
- Quick Sort 3 Way
- Heap Sort
- 基数排序

Todos

- [ ] Study
    - [x] Insertion Sort
    - [x] Selection Sort
    - [x] Bubble Sort
    - [x] Shell Sort
    - [x] Merge Sort
    - [ ] Quick Sort
    - [ ] Quick Sort 3 Way
    - [ ] Heap Sort
    - [ ] 基数排序
- [ ] Review
    - [ ] Insertion Sort
    - [ ] Selection Sort
    - [ ] **Bubble Sort !**
    - [ ] **Shell Sort !!!**
    - [ ] **Merge Sort Recursive !**
    - [ ] **Merge Sort Iterative !!!**
    - [ ] Quick Sort
    - [ ] Quick Sort 3 Way
    - [ ] Heap Sort
    - [ ] 基数排序

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

- Not stable
- O(1) extra space
- **O(n^3/2) time**
- **Adaptive: O(n·lg(n)) time when nearly sorted**

Pseudocode

```bash
h = 1
while h < n, h = 3*h + 1
while h > 0,
    h = h / 3
    for k = 1:h, insertion sort a[k:h:n]
    → invariant: each h-sub-array is sorted
end
```

_( icehe : 这个伪码不太好理, 最好看实现 )_

Others

-   **Shell sort is based on insertion sort**

-   The worse-case time complexity of shell sort
    depends on the increment sequence.

    For the increments 1 4 13 40 121…,
    which is what is used here, the time complexity is O(n^3/2).

    For other increments,
    time complexity is known to be O(n^4/3) and even O(n·lg2(n)).

    Neither tight upper bounds on time complexity
    nor the best increment sequence are known.

## Merge Sort

Reference: [Merge Sort](https://www.toptal.com/developers/sorting-algorithms/merge-sort)

Properties

- Stable
- **Θ(n) extra space for arrays**
- Θ(lg(n)) extra space for linked lists
- **Θ(n·lg(n)) time**
- Not adaptive
- **Does not require random access to data**

Pseudocode

```bash
# split in half
m = n / 2

# recursive sorts
sort a[1..m]
sort a[m+1..n]

# merge sorted sub-arrays using temp array
b = copy of a[1..m]
i = 1, j = m+1, k = 1
while i <= m and j <= n,
    a[k++] = (a[j] < b[i]) ? a[j++] : b[i++]
    → invariant: a[1..k] in final position
while i <= m,
    a[k++] = b[i++]
    → invariant: a[1..k] in final position
```

Others

-   It makes between 0.5lg(n) and lg(n) comparisons per element,
    and between lg(n) and 1.5lg(n) swaps per element.
    _( icehe: 数学常识快忘光了 )_

## Quick Sort

Reference: [Quick Sort](https://www.toptal.com/developers/sorting-algorithms/quick-sort)

Properties

Pseudocode

```baash

```

## Quick Sort 3 Way

Reference: [Quick Sort 3 Way](https://www.toptal.com/developers/sorting-algorithms/quick-sort-3-way)

Properties

Pseudocode

```baash

```

## Heap Sort

Reference: [Heap Sort](https://www.toptal.com/developers/sorting-algorithms/heap-sort)

Properties

Pseudocode

```baash

```
