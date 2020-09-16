# Java Data Structure

## ArrayList

Features

* ArrayList 继承了 AbstractList，实现了 List。
* 是一个 **数组队列**（实现？）
* 支持随机访问（RandomAccess）
* 非线程安全
  * 在多线程中可以选择Vector或者CopyOnWriteArrayList

References

* Java 集合系列03之 ArrayList详细介绍\(源码解析\)和使用示例 : [http://www.cnblogs.com/skywang12345/p/3308556.html](http://www.cnblogs.com/skywang12345/p/3308556.html)

### Fail-Fast

当某一个线程A通过iterator去遍历某集合的过程中，若该集合的内容被其他线程所改变了；那么线程A访问集合时，就会抛出ConcurrentModificationException异常，产生fail-fast事件。

## LinkedList

Features

* 是一个继承于 AbstractSequentialList 的双向链表。
  * 它也可以被当作堆栈、队列或双端队列进行操作。

## Vector

Features

* 特性和 ArrayList 类似，但是它是「线程安全」的。

