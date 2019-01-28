#!/bin/bash

start=$(date +%s)

step=25

# 60,000,000 keys
#for i in {1000..7000..20}; do # why cannot
for i in `seq 1000 $step 1075`; do
    beg=`expr $i + 1`
    end=`expr $i + $step`
    # TODO: 不能这么写，每个 php 进程不同，不同 process 重新调用 redis-cli 命令，会重新建一个连接，可用的端口可能用完！
    cmd="php redis-hmset.php $beg $end | tee -a hmset-cmds-$beg-$end"
    echo $cmd
    eval $cmd &
done

wait

finish=$(date +%s)
spend=$(expr $finish - $start)
echo "cost: $spend sec"
