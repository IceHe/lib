# Storage

## ACID CAP

Concepts : http://www.mongodb.org.cn/tutorial/2.html

- ACID
- BASE
- CAP
- NoSQL

## Column Family

HBase 中为什么要有 Column Family？

> HBase本身的设计目标是支持稀疏表，而稀疏表通常会有很多列，但是每一行有值的列又比较少。
>
> 如果不使用Column Family的概念，那么有两种设计方案：
>
> 1. 把所有列的数据放在一个文件中（也就是传统的按行存储）。那么当我们想要访问少数几个列的数据时，需要遍历每一行，读取整个表的数据，这样子是很低效的。
> 2. 把每个列的数据单独分开存在一个文件中（按列存储）。那么当我们想要访问少数几个列的数据时，只需要读取对应的文件，不用读取整个表的数据，读取效率很高。然而，由于稀疏表通常会有很多列，这会导致文件数量特别多，这本身会影响文件系统的效率。
>
> 而Column Family的提出就是为了在上面两种方案中做一个折中。HBase中将一个Column Family中的列存在一起，而不同Column Family的数据则分开。
>
> 由于在HBase中Column Family的数量通常很小，同时HBase建议把经常一起访问的比较类似的列放在同一个Column Family中，这样就可以在访问少数几个列时，只读取尽量少的数据。

Reference

- 百度知道 :  https://zhidao.baidu.com/question/873748003465757012.html

感想：

- 对一个概念准确地下定义还算简单一点
- 但是要通俗易懂、直击本质地说明它存在的理由却很不容易
