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
- Quick3 Sort
- Heap Sort
- 基数排序

Todos

- [ ] Study
    - [x] Insertion Sort
    - [x] Selection Sort
    - [x] Bubble Sort
    - [x] Shell Sort
    - [ ] Merge Sort
    - [ ] Quick Sort
    - [ ] Quick3 Sort
    - [ ] Heap Sort
    - [ ] 基数排序
- [ ] Review
    - [ ] Insertion Sort
    - [ ] Selection Sort
    - [ ] **Bubble Sort !**
    - [ ] **Shell Sort !!!**
    - [ ] **Merge Sort !!**
    - [ ] Quick Sort
    - [ ] Quick3 Sort
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

```baash
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
