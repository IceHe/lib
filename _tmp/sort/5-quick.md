# 5 Quick

快速排序：取中轴值，把小于它（大致地）放到数组左边，大于它的放到右边，
然后将中轴值放中间，然后递归调用，作伴
https://www.toptal.com/developers/sorting-algorithms/quick-sort

properties :
    not stable

``` pseudo code 1 (easiest)
a = [0 ~ n]
sort (a, 0, n)

sort (a, beg, end)
    if (beg >= end)
        return a

    swap(a, beg, rand(beg ~ end))
    k = beg

    for i = beg + 1 ~ end
        if (a[i] < a[beg])
            swap(a, i, ++k)（这里 即是最后 k 还是 <= end，所以没问题）

    swap(a, beg, k)

    sort(a, beg, k - 1)
    sort(a, k + 1, end)
```

``` php 1 (easiest)
        function quick_sort($a) {
            $len = count($a);

            function q(&$a, $l, $r) {
                if ($l >= $r) {
                    return $a;
                }

                swap($a, $l, mt_rand($l, $r));

                $k = $l;

                for ($i = $l + 1; $i <= $r; ++$i) {
                    if ($a[$i] < $a[$l]) {
                        swap($a, $i, ++$k);
                    }
                }

                swap($a, $l, $k);

                q($a, $l, $k - 1);
                q($a, $k + 1, $r);

                return $a;
            }

            $a = q($a, 0, $len - 1);

            return $a;
        }
```

``` pseudo code 2 (improved)
a [0 ~ n]
sort(a, 0, n-1)

sort(a, beg, end)
    if (beg == end)
        return

    swap(a, beg, rand(beg, end))

    i = beg + 1
    x = end

    while (i <= x)
        while(i <= end && a[i] <= a[beg]) ++i
        while(x > beg && a[x] > a[beg]) --x
        if (i < x) swap(a, i, x)

    swap(a, beg, x)

    sort(a, beg, x - 1)
    sort(a, x + 1, end)
```