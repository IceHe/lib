# OS

References

* 知乎 : [https://zhuanlan.zhihu.com/p/23755202](https://zhuanlan.zhihu.com/p/23755202)
* 小土刀 : [https://wdxtub.com/interview/14520847747820.html](https://wdxtub.com/interview/14520847747820.html)

## 内存段页管理

Ref : [https://blog.csdn.net/wangrunmin/article/details/7967293](https://blog.csdn.net/wangrunmin/article/details/7967293)

## 虚拟内存

* 系统内存大小是有限的，引入中间层虚拟内存
  * 每个进程有独立的虚拟地址空间，进程访问的为虚拟地址
  * 虚拟地址可映射到物理地址，使得进程可以访问物理内存中内容
* 优点
  * 每个进程都有各自互不干涉的进程地址空间，进程隔离
  * 程序运行的地址确定，不需要每次切换到进程时重定位
  * 内存使用效率高

## 页面置换算法

* FIFO
* OPT : 最优，理想化的算法
* LRU : Least Recently Used 最近最少使用

## IPC

交互方式

* 管道 : 单向
* 共享内存 : 最快
* 信号量 : （通常只用来当）锁机制，能传递的信息太少
* 信号 : 通知进程/线程某个事件已发生
* 消息队列 : 链表，消息内容长度相对没那么受限
* socket : 也可以用在不同机器间通信（废话）

## 逻辑地址/物理地址/虚拟内存

* TLB : Translation Lookaside Buffer 转译缓冲区（实现虚拟地址到物理地址的转换）
* 被加载到内存的部分称为 Resident Set : OS 不会一次性将进程的所有数据都加载到物理内存
  * 如果进程发现所需的数据不在 Resident Set，需要从硬盘读取，那就 page faults
  * OS 需要花费大量时间在这个上面的现象称为 threshing（颠簸）

## 作业调度算法

* FIFO \(FCFS\)
* JSF \(JRSF\)（怎么知道一个作业消耗的时间？）
* Priority : 可能让低优先级作业饿死
* Round-Robin \(RR\) : 设定一个固定时间片来轮转
* 多级队列（要看教科书来了解了）
* 多级反馈队列（要看教科书来了解了）

## 磁盘调度

* FCFS
* SSTF : 跟 JSF 类似，最短寻道时间优先（也存在饿死的问题）
* Scan : 单向，成为电梯算法
* 往返 Scan : 来回扫描

