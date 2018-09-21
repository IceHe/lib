# 3 Selection

选择排序：先不交换，先对比，最后再交换（交换开销小）
https://www.toptal.com/developers/sorting-algorithms/selection-sort

- （quadratic：二次方程式）
- （O : upper bound）
- （Ω : lower bound）
- （Θ : the combination of the above two. 趋近于）

explain : https://softwareengineering.stackexchange.com/questions/158569/please-explain-the-statement-that-the-function-anb-belongs-to-on2-and-%CE%98n

properties :
    not stable
        extra space : O(1)
    random : Θ(n^2) comparisons & Θ(n) swaps
        (minimize the number of swaps)
    not adaptive

discussion :
    It should never be used. It doesn't adapt to the data in any way,
    (run in lock step（这里不够理解，因为不能分治然后并行计算？）)
    so its runtime is always quadratic. (Furthermore it isn't stable!)

``` pseudo code
a = [0 ~ n]
for i = 0 ~ n - 1
    pos = i
    for x = i + 1 ~ n
        if a[pos] > a[x]
            pos = x
    if pos != i
        swap(a, pos, i)
```

``` php
        function selection_sort($a) {
            $len = count($a);
            for ($i = 0; $i < $len - 1; ++$i) {
                $pos = $i;

                for ($x = $i + 1; $x < $len; ++$x) {
                    if ($a[$pos] > $a[$x]) {
                        $pos = $x;
                    }
                }

                if ($pos != $i) {
                    swap($a, $pos, $i);
                }
            }

            return $a;
        }
```