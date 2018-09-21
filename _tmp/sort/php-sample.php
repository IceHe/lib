<?php
/**
 * This file is part of the project Sora.
 *
 * Copyright (c) 2016 Weibo. All Rights Reserved.
 */

/**
 * class IndexController
 *
 * @author overtrue <zhengchao3@staff.weibo.com>
 */
class IndexController extends BaseController
{
    public $skipLogin = true;

    public function handle()
    {
        function quick_sort($a) {
            $len = count($a);

            for ($seg = 1; $seg < $len; $seg += $seg) {
                $t = $a;

                for ($first = 0; $first < $len; $first += $seg * 2) {
                    $beg1 = $first;
                    $end1 = $first + $seg - 1;

                    $beg2 = $first + $seg;
                    $end2 = $first + $seg + $seg - 1;

                    $k = $first;

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
                }

                show_ary($a);
            }

            return $a;
        }

        function rand_ary($len = 8) {
            for ($i = 0; $i < $len; ++$i) {
                $ary[] = mt_rand(0, 100);
            }
            return $ary ?? [];
        }

        function rev_ary($len = 8) {
            for ($i = $len; $i > 0; --$i) {
                $ary[] = $i;
            }
            return $ary ?? [];
        }

        function swap(&$ary, $a, $b) {
            if ($a == $b) {
                return;
            }

            $ary[$a] = $ary[$a] ^ $ary[$b];
            $ary[$b] = $ary[$a] ^ $ary[$b];
            $ary[$a] = $ary[$a] ^ $ary[$b];
        }

        function show_ary($ary, $html = false) {
            static $i = 0;
            echo str_pad($i++, 2, ' ').' :  '.join(' , ', $ary).($html ? '<br/>' : "\n");
        }

        function line($html = false, $sep = ' ') {
            echo str_repeat($sep, 55).($html ? '<br/>' : "\n");
        }

//        $a = rand_ary();
        $a = rev_ary(8);

        show_ary($a);
        line(0, '-');

        $r = quick_sort($a);

        line(0, '-');
        show_ary($r);

        return '';
    }
}
