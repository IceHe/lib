# 1 Bubble

冒泡排序：从最底往上冒
（含义都搞不清，不可能写对，亲身经验）
（adaptive : 适合的？不够理解这个单词的含义）
https://www.toptal.com/developers/sorting-algorithms/bubble-sort

properties :
    stable
    extra space : O(1)
    random : O(n^2) comparisons & swaps
    adaptive : when O(n) when nearly sorted
        (2 pass : 1 pass comparisons & a few swaps, 1 more pass comparisons)

discussion : It has slightly higher overhead than insertion sort!
    In the case of nearly sorted data, bubble sort takes O(n) time,
    but require at least 2 passes through the data
    (whereas insertion sort requires something more like 1 pass).

``` pseudo code
a [ 0 ~ n ]
// 循环不能改成 1~n 要兼容长度1的数组
for i = 0 ~ n - 1
    //swapped = false
    for x = n ~ i + 1
         if a [x - 1] > a [x]
            swap (a, x - 1, x)
            //swapped = true
    if !swapped
        break
end
```

``` php
function bubble_sort($a) {
    $len = count($a);
    for ($i = 0; $i < $len; ++$i) {
        for ($x = $len - 1; $x > $i; --$x) {
            if ($a[$x - 1] > $a[$x]) {
                swap($a, $x - 1, $x);
                $swapped = true;
            }
        }

        if (!($swapped ?? false)) {
            break;
        }
    }

    return $a;
}
```
