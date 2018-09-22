# 4 Merge

归并排序：分治。
递归版，相对容易写代码和描述；
迭代版，难写一点（有时脑子转不过来），
但是内存消耗少，通常都用迭代版的方法。
https://www.toptal.com/developers/sorting-algorithms/merge-sort

properties :
    stable
    Θ(n) extra space for array
    Θ(log(n)) extra space for linked lists
    random : Θ(n*lg(n)) time
            worst O(n^2) time
            (0.5 ~ 1)*lg(n) per element comparison（我终于想明白了！）
            (1 ~ 1.5)*lg(n) per element comparison（不相等时才赋值？）
    not adaptive
    does not require random access to data

discussion :
    It's very predictable.
    It's the algorithm of choice for a variety of situations :
        when stability is required,
        when sorting linked lists,
        and when random access is much more expensive than sequential access
        (for example, external sorting on tape)

``` pseudo code
a = [0 ~ n]
sort (a , 0 , n - 1)

sort (a , beg , end):
    if beg == end
        return a

    pivot = (beg + end) / 2

    sort (a , beg , pivot)
    sort (a , pivot + 1 , end)

    tmp = a

    i = beg
    x = pivot
    k = beg

    while i <= pivot && x <= end
        a[k++] = (tmp[i] <= tmp[x])
            ? tmp[i++]
            : tmp[x++]

    while k <= end
        a[k++] = (i > pivot)
            ? tmp[x++]
            : tmp[i++]

    return a
```

``` php
        function merge_sort($a) {
            $len = count($a);
            if ($len <= 1) {
                return $a;
            }

            $pivot = intval($len / 2);
            $b = merge_sort(array_slice($a, 0, $pivot));
            $c = merge_sort(array_slice($a, $pivot, $len - $pivot));

            $i = 0;
            $j = 0;
            $k = 0;

            while ($i < $pivot && $j < $len - $pivot) {
                $a[$k++] = ($b[$i] <= $c[$j]) ? $b[$i++] : $c[$j++];
            }

            while ($k < $len) {
                $a[$k++] = ($i >= $pivot) ? $c[$j++] : $b[$i++];
            }

            return $a;
        }
```

``` PHP mock C++ recursive
        function merge_sort($a) {
            function m(&$a, $beg, $end) {
                if ($beg >= $end) {
                    return $a;
                }

                $mid = intval(($beg + $end) / 2);

                m($a, $beg, $mid);
                m($a, $mid + 1, $end);

                $t = $a;

                $i = $beg;
                $j = $mid + 1;
                $k = $beg;

                while ($i <= $mid && $j <= $end) {
                    $a[$k++] = ($t[$i] <= $t[$j])
                        ? $t[$i++]
                        : $t[$j++];
                }

                while ($k <= $end) {
                    $a[$k++] = ($i > $mid)
                        ? $t[$j++]
                        : $t[$i++];
                }
            }
```

``` PHP mock C++ iterative
        function merge_sort($a) {
            $len = count($a);

            for ($seg = 1; $seg < $len; $seg += $seg) {
                $t = $a;

                for ($beg = 0; $beg < $len; $beg += $seg * 2) {
                    $beg1 = $beg;
                    $end1 = $beg + $seg - 1;

                    $beg2 = $beg + $seg;
                    $end2 = $beg + $seg + $seg - 1;

                    $k = $beg;

                    while ($beg1 <= $end1 && $beg2 <= $end2) {
                        $a[$k++] = ($t[$beg1] <= $t[$beg2])
                            ? $t[$beg1++]
                            : $t[$beg2++];
                    }

                    while ($k <= $end2) {
                        $a[$k++] = ($beg1 > $end1)
                            ? $t[$beg2++]
                            : $t[$beg1++];
                    }

                    show_ary($a);
                }
            }

            return $a;
        }

```

``` c++
todo
```