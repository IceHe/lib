# 2 Insertion

插入排序：类似冒泡排序，
但是从第二个开始“冒”，
（冒泡从底下开始冒）
且没有 swapped 标记
https://www.toptal.com/developers/sorting-algorithms/insertion-sort

properties :
    stable
    extra space : O(1)
    random : O(n^2) comparisons & swaps
    adaptive : when O(n) when nearly sorted
        (1 pass comparisons & a few swaps)
    very low overhead

nearly sorted : O(n) a little (a few swaps) more than 1 pass (comparisons)
reversed : O(n^2)

discussion :

1. It's the algorithm of choice either
    when the data is nearly sorted (compared with bubble sort)
    or when the problem size is small (low overhead).
2. It's often used as the recursive base case (when problem size is small)
    for higher overhead divide-and-conquer sorting algorithms,
    such as merge sort or quick sort.

``` pseudo code
a = [0 ~ n]
for i = 0 ~ n - 1
    for x = i + 1;  x > 0 && a[x - 1] > a [x]; --x
        swap(a, x - 1, x)
end
```

``` php
        function insertion_sort($a) {
            $len = count($a);
            for ($i = 0; $i < $len - 1; ++$i) {
                for ($x = $i + 1; $x > 0 && $a[$x - 1] > $a[$x]; --$x) {
                    swap($a, $x - 1, $x);
                }
            }

            return $a;
        }
```