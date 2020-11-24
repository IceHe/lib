# Redis Basics ( from Juejin Book )

> **RE**mote **DI**ctionary **S**erver 远程字典服务

References

- 基本原理和方案设计
    - **Redis 深度历险 : 核心原理与应用实践** : https://juejin.im/book/5afc2e5f6fb9a07a9b362527
- Home Page : https://redis.io
    - Introduce : https://redis.io/topics/introduction
    - _Clients_ : https://redis.io/clients
    - Commands : https://redis.io/commands
    - Documentation : https://redis.io/documentation
    - _Download_ : https://redis.io/download
- Others
    - ZH Docs : http://redisdoc.com
    - 容量评估
        - **Redis 容量预估** - 极数云舟 : http://www.redis.cn/redis_memory/
        - Redis 容量评估模型 - 腾讯游戏学院 : https://gameinstitute.qq.com/community/detail/114987

## Basics : Data Structure

Reference

- 基础 : 万丈高楼平地起 —— Redis 基础数据结构 : https://juejin.cn/book/6844733724618129422/section/6844733724697985038

Data Structure

- string 字符串
- list 列表
- set 集合
- zset ( sorted set ) 有序集合
- hash 字典/哈希

### String

> 字符串

Redis 的字符串是 **动态字符串**,

- 是可以修改的字符串.
- **内部结构实现上类似于 Java 的 ArrayList**
    - 采用 **预分配冗余空间的方式来减少内存的频繁分配**
- 内部为当前字符串实际分配的空间 capacity 一般要高于实际字符串长度 len.
    - **当字符串长度小于 1M 时, 扩容都是加倍现有的空间,**
    - **如果超过 1M, 扩容时一次只会多扩 1M 的空间.**
    - 注意 : **字符串最大长度为 512M.**

![string-capacity.webp](_images/string-capacity.webp)

### List

> 列表

**Redis 的列表相当于 Java 语言里面的 LinkedList.**

- 注意 : 它 **是链表而不是数组**.
    - 这意味着 list 的插入和删除操作非常快, 时间复杂度为 O(1)
    - 但是索引定位很慢, 时间复杂度为 O(n) _( icehe : 不过范围查询还行 )_
- 当列表弹出了最后一个元素之后, 该数据结构自动被删除, 内存被回收.

![list-rpush-example.gif](_images/list-rpush-example.gif)

**Redis 的列表结构常用来做异步队列使用.**

- 将需要延后处理的任务结构体序列化成字符串塞进 Redis 的列表,
- 另一个线程从这个列表中轮询数据进行处理.

#### Queue

作为 队列 使用 : 右进左出

```bash
> rpush books python java golang
(integer) 3
> llen books
(integer) 3
> lpop books
"python"
> lpop books
"java"
> lpop books
"golang"
> lpop books
(nil)
```

#### Stack

作为 栈 使用 : 右进左出

```bash
> rpush books python java golang
(integer) 3
> rpop books
"golang"
> rpop books
"java"
> rpop books
"python"
> rpop books
(nil)
```

#### Slow Query

`lindex` _( list index )_ 相当于 Java 链表的 `get(int index)` 方法

- 它需要对链表进行遍历, 性能随着参数 index 增大而变差.

`ltrim` _( list trim )_ 和字面上的含义不太一样 _( 个人觉得它叫 `lretain ` ( 保留 ) 更合适, )_

- 参数 start_index 和 end_index 定义了一个区间,
    - 在这个区间内的值, ltrim 要保留, 区间之外统统砍掉.
- 可以通过 `ltrim` 来实现一个定长的链表, _这一点非常有用._
- index 可以为负数
    - index=-1 表示倒数第一个元素,
    - index=-2 表示倒数第二个元素.

#### Quicklist, Ziplist

![zip-list-simple-structure.webp](_images/quicklist-simple-structure.webp)

Redis 底层的存储结构不是一个简单的 linkedlist,

- 而是称之为 **快速链表 quicklist** 的一个结构.
- 首先在 **列表元素较少的情况下会使用一块连续的内存存储**, 这个结构是 **ziplist 即压缩列表**.
    - 它将所有的元素紧挨着一起存储, 分配的是一块连续的内存.
- 当 **数据量比较多的时候才会改成 quicklist 快速链表**.
    - 因为普通的链表需要的附加指针空间太大, 会比较浪费空间, 而且会加重内存的碎片化.
        - 例如, 这个列表里存的只是 int 类型的数据, 结构上还需要两个额外的指针 prev 和 next.
    - 所以 Redis **将链表和 ziplist 结合起来组成了 quicklist**!
        - 也就是 **将多个 ziplist 使用双向指针串起来使用**.
        - 这样 **既满足了快速的插入删除性能, 又不会出现太大的空间冗余**.

### Hash

**Redis 的字典相当于 Java 语言里面的 HashMap**,

- 它是无序字典.
- 内部实现结构上同 Java 的 HashMap 也是一致的, 同样的 **数组 + 链表二维结构**.
- **第一维 hash 的数组位置碰撞时, 就会将碰撞的元素使用链表串接起来**.

![hash-simple-structure.webp](_images/hash-simple-structure.webp)

#### Rehash

- 与 Java 不同的是, **Redis 的字典的值只能是字符串**,
- **rehash 方式** 也不一样,
    - 因为 Java 的 HashMap 在字典很大时, rehash 是个耗时的操作, 需要一次性全部 rehash.
    - Redis 为了高性能, 不能堵塞服务, 所以采用了 **渐进式 rehash 策略**.

![progressive-rehash-strategy.webp](_images/progressive-rehash-strategy.webp)

- 渐进式 rehash 会在 rehash 的同时, 保留新旧两个 hash 结构, 查询时会同时查询两个 hash 结构,
- 然后 **在后续的定时任务中以及 hash 操作指令中, 循序渐进地将旧 hash 的内容一点点迁移到新的 hash 结构中**.
- 当搬迁完成了, 就会使用新的 hash 结构取而代之.
- 当 hash 移除了最后一个元素之后, 该数据结构自动被删除, 内存被回收.

#### String vs. Hash

![hash-sets-example.gif](_images/hash-sets-example.gif)

- hash 结构也可以用来存储用户信息, 不同于字符串一次性需要全部序列化整个对象, **hash 可以对用户结构中的每个字段单独存储.
    - 这样当需要获取用户信息时 **可以进行部分获取**.
    - 而以 **整个字符串的形式去保存用户信息的话就只能一次性全部读取, 这样就会比较浪费网络流量**.
- hash 也有缺点, **hash 结构的存储消耗要高于单个字符串**,
    - 到底该使用 hash 还是字符串, 需要根据实际情况再三权衡.

在 Redis 存储结构体到底应该使用 hash 还是 string?

- Redis strings vs Redis hashes to represent JSON: efficiency? - StackOverflow : https://stackoverflow.com/questions/16375188/redis-strings-vs-redis-hashes-to-represent-json-efficiency

### Set

> 集合

**Redis 的集合相当于 Java 语言里面的 HashSet**,

- 它内部的键值对是无序的唯一的.
- 它的 **内部实现相当于一个特殊的字典, 字典中所有的 value 都是一个值 NULL**.

![set-simple-example.gif](_images/set-simple-example.gif)

### Zset

> 有序集合

**zset 可能是 Redis 提供的最为特色的数据结构**,

- _它也是在面试中面试官最爱问的数据结构._
- 它 **类似于 Java 的 SortedSet 和 HashMap 的结合体**,
    - **一方面它是一个 set, 保证了内部 value 的唯一性**,
    - **另一方面它可以给每个 value 赋予一个 score, 代表这个 value 的排序权重**.
- 它的内部实现用的是一种叫做「**跳跃列表**」的数据结构.
- zset 中最后一个 value 被移除后, 数据结构自动删除, 内存被回收.

![zset-simple-example.gif](_images/zset-simple-example.gif)

- _zset 可以用来存粉丝列表,_
    - _value 值是粉丝的用户 ID,_
    - _score 是关注时间._
    - _可以对粉丝列表按关注时间进行排序._
- _zset 还可以用来存储学生的成绩,_
    - _value 值是学生的 ID,_
    - _score 是他的考试成绩._
    - _可以对成绩按分数进行排序就可以得到他的名次._

#### Skiplist

> 跳跃表

- **zset 内部的排序功能是通过「跳跃列表」数据结构来实现的,
    - _它的结构非常特殊, 也比较复杂._
- 因为 **zset 要支持随机的插入和删除**, 所以它不好使用数组来表示.
- 因为 **zset 需要链表按照 score 值进行排序**,
    - 这意味着当有新元素需要插入时, 要定位到特定位置的插入点, 这样才可以继续保证链表是有序的.
    - 通常我们会通过二分查找来找到插入点, 但是二分查找的对象必须是数组, 只有数组才可以支持快速位置定位, 链表做不到

![normal-linked-list.webp](_images/normal-linked-list.webp)

- 跳跃列表就是类似于层级制,
    - 最下面一层所有的元素都会串起来.
    - 然后每隔几个元素挑选出一个代表来, 再将这几个代表使用另外一级指针串起来.
    - 然后在这些代表里再挑出二级代表, 再串起来.
    - 最终就形成了金字塔结构.

![skiplist-simple-structure-example.webp](_images/skiplist-simple-structure-example.webp)

- 「跳跃列表」之所以「跳跃」, 是因为内部的元素可能「身兼数职」,
    - 比如上图中间的这个元素, 同时处于 L0、L1 和 L2 层, 可以快速在不同层次之间进行「跳跃」.
    - 定位插入点时, 先在顶层进行定位, 然后下潜到下一级定位, 一直下潜到最底层找到合适的位置, 将新元素插进去.
- 跳跃列表 **采取一个随机策略来决定新元素可以兼职到第几层**.
    - **首先 L0 层肯定是 100% 了, L1 层只有 50% 的概率, L2 层只有 25% 的概率, L3 层只有 12.5% 的概率, 一直随机到最顶层 L31 层**.
    - _绝大多数元素都过不了几层, 只有极少数元素可以深入到顶层. 列表中的元素越多, 能够深入的层次就越深, 能进入到顶层的概率就会越大._

### General Principles

> 容器型数据结构的通用规则

list / hash / set / zset 这 4 种数据结构是 **容器型数据结构**, 共享下面两条通用规则 :

- 1\. **create if not exists**
    - **如果容器不存在, 那就创建一个, 再进行操作.**
    - _比如 rpush 操作刚开始是没有列表的, Redis 就会自动创建一个, 然后再 rpush 进去新元素._
- 2\. **drop if no elements**
    - **如果容器里元素没有了, 那么立即删除元素, 释放内存**.
    - _这意味着 lpop 操作到最后一个元素, 列表就消失了._

### Expiration

> 过期时间

Redis 所有的数据结构都可以设置过期时间, 时间到了, Redis 会自动删除相应的对象.

- **过期是以对象为单位**!
    - 例如, **一个 hash 结构的过期是整个 hash 对象的过期, 而不是其中的某个子 key**!
- 小心 string 的过期时间被移除!
    - 例如, **如果一个字符串已经设置了过期时间, 然后你调用了 set 方法修改了它, 它的过期时间会消失!**

```bash
$ redis-server &
$ redis-cli
127.0.0.1:6379> set foo bar
OK
127.0.0.1:6379> expire foo 600
(integer) 1
127.0.0.1:6379> ttl foo
(integer) 596
127.0.0.1:6379> set foo ice
OK
127.0.0.1:6379> ttl foo
(integer) -1
127.0.0.1:6379>
```

## Usage 1 : Distributed Lock

> 应用 1 : 分布式锁

Reference

- 应用 1 : 千帆竞发 —— 分布式锁 : https://juejin.cn/book/6844733724618129422/section/6844733724702015495

_分布式应用进行逻辑处理时经常会遇到并发问题._

- _比如, 一个操作要修改用户的状态, 修改状态需要先读出用户的状态, 在内存里进行修改, 改完了再存回去._
- _如果这样的操作同时进行了, 就会出现并发问题, 因为 读取和保存状态这两个操作不是原子的._

**原子操作** : **不会被线程调度机制打断的操作**

- 这种 **操作一旦开始, 就一直运行到结束, 中间不会有任何 context switch 线程切换**.

![concurrent-read-n-write-confliction-exmaple.webp](_images/concurrent-read-n-write-confliction-exmaple.webp)

_这时就要使用分布式锁来限制程序的并发执行._

### Distributed Lock

- _分布式锁本质上要实现的目标就是在 Redis 里面占一个 "茅坑" , 当别的进程也要来占时, 发现已经有人蹲在那里了, 就只好放弃或者稍后再试._
- 占坑一般是使用 `setnx` ( set if not exists ) 指令, 只允许被一个客户端占坑. 先来先占, 用完了, 再调用 `del` 指令释放茅坑.

```bash
# 这里的冒号 : 就是一个普通的字符, 没特别含义, 它可以是任意其它字符, 不要误解
> setnx lock:codehole true
OK

# ... do something critical ...
> del lock:codehole
(integer) 1
```

- 但是有个问题, **如果逻辑执行到中间出现异常了, 可能会导致 del 指令没有被调用**,
    - 这样 **就会陷入死锁, 锁永远得不到释放.**
- 于是在拿到锁之后, 再给锁加上一个过期时间,
    - 比如 5s, 这样 **即使中间出现异常也可以保证 5 秒之后锁会自动释放**.

```bash
> setnx lock:codehole true
OK
> expire lock:codehole 5

# ... do something critical ...

> del lock:codehole
(integer) 1
```

- 但是以上逻辑还有问题.
    - **如果在 `setnx` 和 `expire` 之间服务器进程突然挂掉了, 可能是因为机器掉电或者是被人为杀掉的**,
    - **就会导致 `expire` 得不到执行, 也会造成死锁.**
- 这种问题的 **根源就在于 `setnx` 和 `expire` 是两条指令而不是原子指令.
    - 如果这两条指令可以一起执行就不会出现问题.
- 也许你会想到用 Redis 事务来解决. 但是这里不行,
    - 因为 `expire` 是依赖于 `setnx` 的执行结果的,
    - **如果 setnx 没抢到锁, expire 是不应该执行的.**
- 事务里没有 if-else 分支逻辑,
    - **事务的特点是一口气执行, 要么全部执行要么一个都不执行.
- 最终 Redis 2.8 版本中作者 **加入了 set 指令的扩展参数, 使得 setnx 和 expire 指令可以一起执行**, 彻底解决了分布式锁的乱象.
    - _( icehe : 虽然以上问题, 现在已经得到基本的解决, 但是还是该好好理解记住这些历史经验 )_

```bash
> set lock:codehole true ex 5 nx
OK
# ... do something critical ...
> del lock:codehole
```

### Timeout

> 超时

- Redis 的分布式锁不能解决超时问题,
    - **如果在加锁和释放锁之间的逻辑执行的太长, 以至于超出了锁的超时限制, 就会出现问题!**
    - 因为这时 **第一个线程持有的锁过期了, 临界区的逻辑还没有执行完,**
        - 这时 **第二个线程就提前重新持有了这把锁, 导致临界区代码不能得到严格的串行执行.**
- 为了避免这个问题, **Redis 分布式锁不要用于较长时间的任务!**
    - **如果真的偶尔出现了, 数据出现的小波错乱可能需要人工介入解决.**

```python
tag = random.nextint()  # 随机数
if redis.set(key, tag, nx=True, ex=5):
    do_something()
    redis.delifequals(key, tag)  # 假想的 delifequals 指令
```

- 有一个稍微安全一点的方案是 :
    - **为 set 指令的 value 参数设置为一个随机数, 释放锁时先匹配随机数是否一致, 然后再删除 key,**
        - 这是 **为了确保当前线程占有的锁不会被其它线程释放, 除非这个锁是过期了被服务器自动释放的.**
    - 但是匹配 value 和删除 key 不是一个原子操作, Redis 也没有提供类似于 `delifequals` 这样的指令,
        - 这就需要使用 Lua 脚本来处理了, 因为 **Lua 脚本可以保证连续多个指令的原子性执行.**

```lua
# delifequals
if redis.call("get",KEYS[1]) == ARGV[1] then
    return redis.call("del",KEYS[1])
else
    return 0
end
```

- 但是这也不是一个完美的方案, 它只是相对安全一点,
    - 因为如果真的超时了, 当前线程的逻辑没有执行完, 其它线程也会乘虚而入.

### Reenterability

> 可重入性

- **可重入性** 是指 **线程在持有锁的情况下再次请求加锁, 如果一个锁支持同一个线程的多次加锁, 那么这个锁就是可重入的.**
    - 比如 Java 语言里有个 ReentrantLock 就是可重入锁.
- Redis 分布式锁如果要支持可重入, **需要对客户端的 set 方法进行包装, 使用线程的 Threadlocal 变量存储当前持有锁的计数.**

```python
# -*- coding: utf-8
import redis
import threading


locks = threading.local()
locks.redis = {}

def key_for(user_id):
    return "account_{}".format(user_id)

def _lock(client, key):
    return bool(client.set(key, True, nx=True, ex=5))

def _unlock(client, key):
    client.delete(key)

def lock(client, user_id):
    key = key_for(user_id)
    if key in locks.redis:
        locks.redis[key] += 1
        return True
    ok = _lock(client, key)
    if not ok:
        return False
    locks.redis[key] = 1
    return True

def unlock(client, user_id):
    key = key_for(user_id)
    if key in locks.redis:
        locks.redis[key] -= 1
        if locks.redis[key] <= 0:
            del locks.redis[key]
            self._unlock(key)
        return True
    return False

client = redis.StrictRedis()
print "lock", lock(client, "codehole")
print "lock", lock(client, "codehole")
print "unlock", unlock(client, "codehole")
print "unlock", unlock(client, "codehole")
```

- 以上还不是可重入锁的全部, **精确一点还需要考虑内存锁计数的过期时间, 代码复杂度将会继续升高.**
    - 所以 **不推荐使用可重入锁!**
    - 它 **加重了客户端的复杂性, 在编写业务方法时注意在逻辑结构上进行调整完全可以不使用可重入锁.**

## Usage 2 : Delayed Queue

> 应用 2 : 延时队列

Reference

- 应用 2 : 缓兵之计 —— 延时队列 : https://juejin.cn/book/6844733724618129422/section/6844733724702015496

平时习惯于使用 Rabbitmq 和 Kafka 作为消息队列中间件, 来给应用程序之间增加异步消息传递功能. 这两个中间件都是专业的消息队列中间件, 特性之多超出了大多数人的理解能力.

- _使用过_ RabbitMQ _的就知道它使用起来有多复杂,_
    - 发消息之前要创建 Exchange, 再创建 Queue, 还要将 Queue 和 Exchange 通过某种规则绑定起来,
    - 发消息的时候要指定 routing-key, 还要控制头部信息.
- _消费者在消费消息之前也要进行上面一系列的繁琐过程._
    - _但是绝大多数情况下, 虽然消息队列只有一组消费者, 但还是需要经历上面这些繁琐的过程._
- _有了 Redis, 它就可以让我们解脱出来, 对于那些只有一组消费者的消息队列, 使用 Redis 就可以非常轻松的搞定._
    - **Redis 的消息队列不是专业的消息队列, 它没有非常多的高级特性, 没有 ack 保证,**
    - **如果对消息的可靠性有着极致的追求, 那么它就不适合使用.**

### Asynchronous Message Queue

> 异步消息队列

Redis 的 list 数据结构常用来作为异步消息队列使用,

- 使用 `rpush` / `lpush` 操作入队列,
- 使用 `lpop` 和 `rpop` 来出队列.

![list-as-async-mq.webp](_images/list-as-async-mq.webp)

```bash
> rpush notify-queue apple banana pear
(integer) 3
> llen notify-queue
(integer) 3
> lpop notify-queue
"apple"
> llen notify-queue
(integer) 2
> lpop notify-queue
"banana"
> llen notify-queue
(integer) 1
> lpop notify-queue
"pear"
> llen notify-queue
(integer) 0
> lpop notify-queue
(nil)
```

### _队列空了怎么办?_

_处理完了再接着获取消息, 再进行处理. 如此循环往复, 这便是作为队列消费者的客户端的生命周期._

可是如果队列空了, 客户端就会陷入 pop 的死循环, 不停地 pop, 没有数据, 接着再 pop, 又没有数据. 这就是浪费生命的空轮询.

空轮询不但拉高了客户端的 CPU, redis 的 QPS 也会被拉高, 如果这样空轮询的客户端有几十个, Redis 的慢查询可能会显著增多.

**通常使用 sleep 来解决这个问题, 让线程睡一会, 睡个 1s 钟就可以了. 不但客户端的 CPU 能降下来, Redis 的 QPS 也降下来了.**

### Queue Delay Time

用上面睡眠的办法可以解决问题.

- 但是有个小问题, 那就是 **睡眠会导致消息的延迟增大.**
    - 如果只有 1 个消费者, 那么这个延迟就是 1s.
    - 如果有多个消费者, 这个延迟会有所下降, 因为每个消费者的睡觉时间是岔开来的.
- **有没有什么办法能显著降低延迟呢?** 你当然可以很快想到 :
    - A. 那就把睡觉的时间缩短点. 这种方式当然可以,
        - 不过有没有更好的解决方案呢?
    - B. 当然也有, 那就是 **`blpop` / `brpop`**.
        - 这两个 **指令的前缀字符 b 代表的是 blocking, 也就是阻塞读.**
- **阻塞读在队列没有数据的时候, 会立即进入休眠状态, 一旦数据到来, 则立刻醒过来.**
    - 消息的延迟几乎为零.
    - 用 `blpop` / `brpop` 替代前面的 `lpop` / `rpop` , 就完美解决了上面的问题.

### 空闲连接自动断开

上面的方案并非完美, 还有 **空闲连接** 的问题需要解决.

- **如果线程一直阻塞在哪里, Redis 的客户端连接就成了闲置连接,**
    - **闲置过久, 服务器一般会主动断开连接, 减少闲置资源占用.**
- **这时 `blpop` / `brpop` 会抛出异常来.**
    - 所以, 必须注意捕获异常, 还要重试.

所以编写客户端消费者的时候要小心, 注意捕获异常, 还要重试.

### 锁冲突处理

客户端在处理分布式锁请求时, **加锁没加成功怎么办?** 一般有 3 种策略来处理加锁失败 :

- A. **直接抛出异常, 通知用户稍后重试**
- B. **sleep 一会再重试**
- C. **将请求转移至延时队列, 过一会再试**

A. 直接抛出特定类型的异常

- 这种方式比较适合由用户直接发起的请求,
    - 用户看到错误对话框后, 会先阅读对话框的内容, 再点击重试, 这样就可以起到人工延时的效果.
    - 如果考虑到用户体验, 可以由前端的代码替代用户自己来进行延时重试控制.
    - 它本质上是 **对当前请求的放弃, 由用户决定是否重新发起新的请求.**

B. Sleep

- sleep 会阻塞当前的消息处理线程, 会导致队列的后续消息处理出现延迟.
    - **如果碰撞的比较频繁或者队列里消息比较多, sleep 可能并不合适.**
    - **如果因为个别死锁的 key 导致加锁不成功, 线程会彻底堵死, 导致后续消息永远得不到及时处理.**

C. 延时队列

- 这种方式 **比较适合异步消息处理**,
    - **将当前冲突的请求扔到另一个队列延后处理以避开冲突.**

### Implementation of Delayed Queue

> 延时队列的实现

- 延时队列可以通过 Redis 的 zset ( 有序列表 ) 来实现.
    - **将消息序列化成一个字符串作为 zset 的 value, 到期处理时间作为 score,**
    - 然后用 **多个线程轮询 zset 获取到期的任务进行处理,**
    - **多个线程是为了保障可用性, 万一挂了一个线程还有其它线程可以继续处理.**
    - 因为有多个线程, 所以 **需要考虑并发争抢任务, 确保任务不能被多次执行.**
- Redis 的 **`zrem` 方法是多线程多进程争抢任务的关键, 它的返回值决定了当前实例有没有抢到任务,
    - 因为 loop 方法可能会被多个线程、多个进程调用, 同一个任务可能会被多个进程线程抢到, 通过 zrem 来决定唯一的属主.
    - 同时, 要注意一定要对 `handle_msg` 进行异常捕获, 避免因为个别任务处理问题导致循环异常退出.

进一步优化

- 上面的算法中同一个任务可能会被多个进程取到之后再使用 zrem 进行争抢, 那些没抢到的进程都是白取了一次任务, 这是浪费.
    - 可以考虑 **使用 lua scripting 来原子化地执行这个逻辑, 将 zrangebyscore 和 zrem 一同挪到服务器端进行原子化操作**,
    - 这样多个进程之间争抢任务时就不会出现这种浪费了.

## Usage 3 : Bitmap

> 应用 3 : 节衣缩食 —— 位图

- 有一些 bool 型数据需要存取, 比如用户一年的签到记录, 签了是 1, 没签是 0, 要记录 365 天.
    - _如果使用普通的 key / value, 每个用户要记录 365 个, 当用户上亿的时候, 需要的存储空间是惊人的._
- 为了解决这个问题, **Redis 提供了位图数据结构**,
    - _这样每天的签到记录只占据一个位, 365 天就是 365 个位, 46 个字节 ( 一个稍长一点的字符串 ) 就可以完全容纳下, 这就大大节约了存储空间._
- **位图 就是普通的字符串, 也就是 byte 数组.**
    - 可以使用普通的 `get` / `set` 直接获取和设置整个位图的内容,
    - 也可以使用位图操作 `getbit` / `setbit` 等将 byte 数组看成「位数组」来处理.
- 当要统计月活的时候, 因为需要去重, 需要使用 set 来记录所有活跃用户的 id, 这非常浪费内存.
    - 这时就可以考虑使用位图来标记用户的活跃状态.
    - _每个用户会都在这个位图的一个确定位置上, 0 表示不活跃, 1 表示活跃._
    - _然后到月底遍历一次位图就可以得到月度活跃用户数._
    - 不过这个方法也是有条件的, 那就是 userid 是整数连续的, 并且活跃占比较高, 否则可能得不偿失.

### Basic Usage

Redis 的 **位数组是自动扩展的**,

- 如果设置了某个偏移位置超出了现有的内容范围, 就会自动将位数组进行零扩充.
- _此处不赘述, 详见自行查询_

零存整取

```bash
127.0.0.1:6379> setbit s 1 1
(integer) 0
127.0.0.1:6379> setbit s 2 1
(integer) 0
127.0.0.1:6379> setbit s 4 1
(integer) 0
127.0.0.1:6379> setbit s 9 1
(integer) 0
127.0.0.1:6379> setbit s 10 1
(integer) 0
127.0.0.1:6379> setbit s 13 1
(integer) 0
127.0.0.1:6379> setbit s 15 1
(integer) 0
127.0.0.1:6379> get s
"he"
```

零存零取

```bash
127.0.0.1:6379> setbit w 1 1
(integer) 0
127.0.0.1:6379> setbit w 2 1
(integer) 0
127.0.0.1:6379> setbit w 4 1
(integer) 0
127.0.0.1:6379> getbit w 1  # 获取某个具体位置的值 0/1
(integer) 1
127.0.0.1:6379> getbit w 2
(integer) 1
127.0.0.1:6379> getbit w 4
(integer) 1
127.0.0.1:6379> getbit w 5
(integer) 0
```

整存零取

```bash
127.0.0.1:6379> set w h  # 整存
(integer) 0
127.0.0.1:6379> getbit w 1
(integer) 1
127.0.0.1:6379> getbit w 2
(integer) 1
127.0.0.1:6379> getbit w 4
(integer) 1
127.0.0.1:6379> getbit w 5
(integer) 0
```

### 统计与查找

Redis 提供了指令

- 位图统计 `bitcount`
- 位图查找 `bitpos`
- `bitcount` 统计指定位置范围内 1 的个数
- `bitpos` 用来查找指定范围内出现的第一个 0 或 1

比如,

- 可以通过 `bitcount` 统计用户一共签到了多少天,
- 通过 `bitpos` 指令查找用户从哪一天开始第一次签到.
- 如果指定了范围参数 `[start, end]` ,
    - 就可以统计在某个时间范围内用户签到了多少天,
    - 用户自某天以后的哪天开始签到.
- 遗憾的是 start 和 end 参数是字节索引, 也就是说指定的位范围必须是 8 的倍数, 而不能任意指定.
    - _这很奇怪, 一般人表示不是很能理解 Antirez 为什么要这样设计._
    - _因为这个设计, 无法直接计算某个月内用户签到了多少天,_
    - _而必须要将这个月所覆盖的字节内容全部取出来 ( `getrange` 可以取出字符串的子串 )_
    - _然后在内存里进行统计, 这个非常繁琐._

_bitcount 指令和 bitpos 指令 示例 :_

```bash
127.0.0.1:6379> set w hello
OK

127.0.0.1:6379> bitcount w
(integer) 21

# 第一个字符中 1 的位数
127.0.0.1:6379> bitcount w 0 0
(integer) 3

# 前两个字符中 1 的位数
127.0.0.1:6379> bitcount w 0 1
(integer) 7

# 第一个 0 位
127.0.0.1:6379> bitpos w 0
(integer) 0

# 第一个 1 位
127.0.0.1:6379> bitpos w 1
(integer) 1

# 从第二个字符算起, 第一个 1 位
127.0.0.1:6379> bitpos w 1 1 1
(integer) 9

# 从第三个字符算起, 第一个 1 位
127.0.0.1:6379> bitpos w 1 2 2
(integer) 17
```

### _魔术指令 bitfield_

- 前文设置 `setbit` 和获取 `getbit` 指定位的值都是单个位的,
    - 如果要一次操作多个位, 就必须使用管道来处理.
- _不过 Redis 的 3.2 版本以后新增了功能强大的指令 `bitfield`,_
    - 有了这条指令, 不用管道也可以一次进行多个位的操作.
- `bitfield` 有三个子指令, 分别是 `get` / `set` / `incrby`,
    - 它们都可以对指定位片段进行读写, 但是最多只能处理 64 个连续的位,
    - 如果超过 64 位, 就得使用多个子指令, bitfield 可以一次执行多个子指令.
- ……

多次执行

```bash
127.0.0.1:6379> set w hello
OK
# 从第一个位开始取 4 个位, 结果是无符号数 (u)
127.0.0.1:6379> bitfield w get u4 0
(integer) 6

# 从第三个位开始取 3 个位, 结果是无符号数 (u)
127.0.0.1:6379> bitfield w get u3 2
(integer) 5

# 从第一个位开始取 4 个位, 结果是有符号数 (i)
127.0.0.1:6379> bitfield w get i4 0
1) (integer) 6

# 从第三个位开始取 3 个位, 结果是有符号数 (i)
127.0.0.1:6379> bitfield w get i3 2
1) (integer) -3
```

不使用 pipeline 的情况下, 一次性执行

```bash
127.0.0.1:6379> bitfield w get u4 0 get u3 2 get i4 0 get i3 2
1) (integer) 6
2) (integer) 5
3) (integer) 6
4) (integer) -3
```

……

后文内容较少使用, 暂略 ( TODO )

- 饱和截断 SAT
- 失败不执行 FAIL

## Usage 4 : HyperLogLog

Reference

- 应用 4 : 四两拨千斤 —— HyperLogLog : https://juejin.cn/book/6844733724618129422/section/6844733724706209805

思考一个常见的业务问题 : 如果开发维护一个大型的网站, 我们需要网站每个网页每天的 UV 数据, 然后计划开发这个统计模块, 如何实现?

- 如果统计 PV 那非常好办, 给每个网页一个独立的 Redis 计数器就可以了, 这个计数器的 key 后缀加上当天的日期.
    - _这样来一个请求, incrby 一次, 最终就可以统计出所有的 PV 数据._
- 但是 UV 不一样, 它要去重, 同一个用户一天之内的多次访问请求只能计数一次.
    - _这就要求每一个网页请求都需要带上用户的 ID, 无论是登陆用户还是未登陆用户都需要一个唯一 ID 来标识._

也许可以使用一个简单的方案

- 为每一个页面一个独立的 set 集合来存储所有当天访问过此页面的用户 ID.
- 当一个请求过来时, 我们使用 sadd 将用户 ID 塞进去就可以了.
- 通过 scard 可以取出这个集合的大小, 这个数字就是这个页面的 UV 数据. 没错, 这是一个非常简单的方案.

但是, 如果你的页面访问量非常大,

- 比如一个爆款页面几千万的 UV, 你需要一个很大的 set 集合来统计, 这就非常浪费空间.
- 如果这样的页面很多, 那所需要的存储空间是惊人的.
- 为这样一个去重功能就耗费这样多的存储空间, 值得么?
- 其实老板需要的数据又不需要太精确, 105w 和 106w 这两个数字对于老板们来说并没有多大区别.

_那么, 有没有更好的解决方案呢?_

- Redis 提供了 **HyperLogLog 数据结构, 用来解决统计问题.**
    - HyperLogLog **提供不精确的去重计数方案, 虽然不精确但是也不是非常不精确, 标准误差是 0.81%**,
    - 这样的精确度已经可以满足上面的 UV 统计需求了.

### How to Use

HyperLogLog 提供了两个指令

- **`pfadd` 增加计数**
    - _跟 set 集合的 `sadd` 用法一样, 来一个用户 ID, 就将用户 ID 塞进去就是._
- **`pfcount` 获取计数**
    - _跟 `scard` 用法是一样, 直接获取计数值._

_PF 是 HyperLogLog 这个数据结构的发明人 Philippe Flajolet 的首字母缩写._

_测试部分不赘述, 详见原文_

### pfmerge 适合什么场景

HyperLogLog 除了上面的 `pfadd` 和 `pfcount` 之外, 还提供了第三个指令

- **`pfmerge` 用于将多个 pf 计数值累加在一起形成一个新的 pf 值.**

_比如, 在网站中我们有两个内容差不多的页面, 运营说需要这两个页面的数据进行合并. 其中页面的 UV 访问量也需要合并, 那这个时候 `pfmerge` 就可以派上用场了._

### Precautions

> 注意事项

使用 HyperLogLog 这个数据结构的内存成本较高

- 它需要占据一定 12k 的存储空间, 所以它不适合统计单个用户相关的数据.
- 如果你的用户上亿, 可以算算, 这个空间成本是非常惊人的.
- 但是相比 set 存储方案, HyperLogLog 所使用的空间那真是可以使用千斤对比四两来形容了.

不过你也不必过于担心, 因为 **Redis 对 HyperLogLog 的存储进行了优化**,

- **在计数比较小时, 它的存储空间采用稀疏矩阵存储, 空间占用很小,**
- **仅仅在计数慢慢变大, 稀疏矩阵占用空间渐渐超过了阈值时才会一次性转变成稠密矩阵, 才会占用 12k 的空间.**

原理比较复杂, 难以理解, 详见原文

## Usage 5 : Bloom Filter

Reference

- 应用 5 : 层峦叠嶂 —— 布隆过滤器 : https://juejin.cn/book/6844733724618129422/section/6844733724706209806

![bloom-filter-intro.gif](_images/bloom-filter-intro.gif)

_使用 HyperLogLog 数据结构来进行估数, 它非常有价值, 可以解决很多精确度不高的统计需求._

_但是如果想知道某一个值是不是已经在 HyperLogLog 结构里面了, 它就无能为力了, 它只提供了 `pfadd` 和 `pfcount` 方法, 没有提供 ~~`pfcontains`~~ 这种方法._

比如, 在使用新闻客户端看新闻时, 它会给我们不停地推荐新的内容, 它 **每次推荐时要去重, 去掉那些已经看过的内容.**

- _问题 :_
    - _新闻客户端推荐系统如何实现推送去重的? _
- 直接的解法 :
    - 做法 : 服务器记录了用户看过的所有历史记录, 当推荐系统推荐新闻时会从每个用户的历史记录里进行筛选, 过滤掉那些已经存在的记录.
    - 缺点 : 当用户量很大, 每个用户看过的新闻又很多的情况下, 这种方式, 推荐系统的去重工作在性能上很难跟上

实际上,

- 如果历史记录存储在关系数据库里, 去重就需要频繁地对数据库进行 exists 查询,
- 当系统并发量很高时, 数据库是很难扛住压力的.

然后考虑引入缓存,

- 但是将大量的历史记录全部缓存起来, 浪费大量存储空间.
- 而且这个存储空间是随着时间线性增长, 撑不住长期的积累.
- 但是不缓存的话, 性能又跟不上.

**布隆过滤器 ( Bloom Filter )** 就是 **专门用来解决去重问题的**.

- 它在起到去重的同时, 在空间上还能节省 90% 以上,
- 只是稍微有那么点不精确, 也就是有一定的误判概率.
- _( icehe : 需要花时间计算这个紧凑的数据结构, 用计算时间换存储空间 )_

### What is Bloom Filter?

布隆过滤器 **可以理解为一个不怎么精确的 set 结构**,

- **使用 contains 方法判断某个对象是否存在时, 可能会误判.**
- 但是布隆过滤器也不是特别不精确,
    - **只要参数设置的合理, 它的精确度可以控制的相对足够精确, 只会有很小的误判概率.**

特点

- **当布隆过滤器说某个值存在时, 这个值可能不存在;**
- **当它说不存在时, 那就肯定不存在.**

套在上面的使用场景中,

- 布隆过滤器能准确过滤掉那些已经看过的内容,
- 那些没有看过的新内容, 它也会过滤掉极小一部分 ( 误判 ) ,
- 但是绝大多数新内容它都能准确识别.

就可以完全保证推荐给用户的内容都是无重复的.

Redis 官方提供的布隆过滤器功能

- **Redis 4.0 版本才开始有**
- **作为一个插件加载到 Redis Server 中**

### Basic Usage

布隆过滤器有两个基本指令

- `bf.add` 添加一个元素
    - `bf.madd` 添加多个元素
- `bf.exists` 查询一个元素是否存在
    - `bf.mexists` 查询多个元素是否存在

它们的用法和 set 集合的 `sadd` 和 `sismember` 差不多.

_准确率的测试, 在此不赘述, 详见原文_

### Precaustions

> 注意事项

布隆过滤器的 **initial_size**

- 估计的过大, 会浪费存储空间,
- 估计的过小, 就会影响准确率,

用户在使用之前

- 一定要 **尽可能地精确估计好元素数量,**
- 还需要 **加上一定的冗余空间以避免实际元素可能会意外高出估计值很多.**

布隆过滤器的 error_rate 越小, 需要的存储空间就越大, 对于不需要过于精确的场合, error_rate 设置稍大一点也无伤大雅.

- _比如, 在新闻去重上而言, 误判率高一点只会让小部分文章不能让合适的人看到, 文章的整体阅读量不会因为这点误判率就带来巨大的改变._

### Working Principles

![bloom-filter-data-structure-simple-example.webp](_images/bloom-filter-data-structure-simple-example.webp)

- **每个布隆过滤器对应到 Redis 的数据结构里面就是一个大型的位数组和几个不一样的无偏 hash 函数.**
    - 所谓无偏就是能够把元素的 hash 值算得比较均匀.
- **向布隆过滤器中添加 key 时, 会使用多个 hash 函数对 key 进行 hash,**
    - **算得一个整数索引值然后对位数组长度进行取模运算得到一个位置,**
    - **每个 hash 函数都会算得一个不同的位置. 再把位数组的这几个位置都置为 1 就完成了 add 操作.**
- 向布隆过滤器询问 key 是否存在时, 跟 add 一样,
    - 也会 **把 hash 的几个位置都算出来, 看看位数组中这几个位置是否都为 1,**
        - **只要有一个位为 0, 那么说明布隆过滤器中这个 key 不存在.**
        - **如果都是 1, 这并不能说明这个 key 就一定存在, 只是极有可能存在,**
            - 因为这些位被置为 1 可能是因为其它的 key 存在所致.
    - 如果这个位数组比较稀疏, 判断正确的概率就会很大, 如果这个位数组比较拥挤, 判断正确的概率就会降低.
    - _具体的概率计算公式比较复杂, 感兴趣可以阅读扩展阅读, 在此不赘述_
- **使用时不要让实际元素远大于初始化大小,**
    - **当实际元素开始超出初始化大小时, 应该对布隆过滤器进行重建**,
        - **重新分配一个 size 更大的过滤器, 再将所有的历史元素批量 add 进去.**
        - ( 这要求在其它的存储器中记录所有的历史元素 )
    - 因为 error_rate 不会因为数量超出就急剧增加, 这就给我们重建过滤器提供了较为宽松的时间.

布隆过滤器的原理涉及到较为复杂的数学知识, 感兴趣可以阅读文章继续深入了解内部原理 :

- 【原】布隆过滤器 (Bloom Filter) 详解 : https://www.cnblogs.com/allensun/archive/2011/02/16/1956532.html

### _Estimate Space Occupation_

_公式推导过程, 在此不赘述, 详情自行查询_

布隆过滤器有两个参数

- 预计元素的数量 n
- 错误率 f

公式根据这两个输入得到两个输出

- 位数组的长度 l _( 也就是需要的存储空间大小 (bit) )_
- hash 函数的最佳数量 k

hash 函数的数量也会直接影响到错误率, 最佳的数量会有最低的错误率.

```bash
k = 0.7 * ( l / n )     # 约等于
f = 0.6185 ^ ( l / n )  # ^ 表示次方计算, 即 math.pow
```

_从公式中可以看出_

- 位数组相对越长 ( l / n )
    - 错误率 f 越低
    - hash 函数需要的最佳数量也越多, 影响计算效率
- 当一个元素平均需要 1 个字节 ( 8 bit ) 的指纹空间时 ( l / n = 8 ) ,
    - 错误率大约为 2%
- 错误率为 10%
    - 一个元素需要的平均指纹空间为 4.792 个 bit, 大约为 5bit
- 错误率为 1%
    - 一个元素需要的平均指纹空间为 9.585 个 bit, 大约为 10bit
- 错误率为 0.1%
    - 一个元素需要的平均指纹空间为 14.377 个 bit, 大约为 15bit

如果一个元素需要占据 15 个 bit, 那相对 set 集合的空间优势是不是就没有那么明显了?

- _需要明确的是, set 中会存储每个元素的内容, 而布隆过滤器仅仅存储元素的指纹._
- 元素的内容大小就是字符串的长度, 它一般会有多个字节, 甚至是几十个上百个字节,
    - 每个元素本身还需要一个指针被 set 集合来引用, 这个指针又会占去 4 个字节或 8 个字节, 取决于系统是 32bit 还是 64bit.
- 而指纹空间只有接近 2 个字节, 所以布隆过滤器的空间优势还是非常明显的.

有现成的网站已经支持计算空间占用的功能了, 只要把参数输进去, 就可以直接看到结果

- 例如, 布隆计算器 : https://krisives.github.io/bloom-calculator

### 实际元素超出时, 误判率会怎样变化

当实际元素超出预计元素时, 错误率会有多大变化? _它会急剧上升么, 还是平缓地上升_

这就需要另外一个公式, 引入参数 t 表示 实际元素跟预计元素的比率

```bash
# 极限近似, k 是 hash 函数的最佳数量
f = ( 1 - 0.5 ^ t ) ^ k
```

- 当 t 增大时, 错误率 f 也会跟着增大
- 分别选择错误率为 10%, 1%, 0.1% 的 k 值, 画出它的曲线进行直观观察

![bloom-filter-fault-tolerance-rate-graph.webp](_images/bloom-filter-fault-tolerance-rate-graph.webp)

- 纵轴 : 错误率
- 横轴 : 实际元素跟预计元素的比率

_从这个图中可以看出曲线还是比较陡峭的_

- 错误率为 10% 时, 比率比为 2 时, 错误率就会升至接近 40%, _这个就比较危险了_
- 错误率为 1% 时, 比率比为 2 时, 错误率升至 15%, _也挺可怕的_
- 错误率为 0.1%, 比率比为 2 时, 错误率升至 5%, _也比较悬了_

### 非 Redis 4.0 如何用上布隆过滤器?

_此处暂略, 详见原文_

### 布隆过滤器的其它应用

在爬虫系统中, 需要对 URL 进行去重, 已经爬过的网页就可以不用爬了.

- 但是 URL 太多了, 几千万几个亿, 如果用一个集合装下这些 URL 地址那是非常浪费空间的.
- 这时候就可以考虑使用布隆过滤器.
- 它可以大幅降低去重存储消耗, 只不过也会使得爬虫系统错过少量的页面.

布隆过滤器在 NoSQL 数据库领域使用非常广泛,

- 平时用到的 HBase、Cassandra 还有 LevelDB、RocksDB 内部都有布隆过滤器结构, 布隆过滤器可以显著降低数据库的 IO 请求数量.
- **当用户来查询某个 row 时, 可以先通过内存中的布隆过滤器过滤掉大量不存在的 row 请求, 然后再去磁盘进行查询.**

邮箱系统的垃圾邮件过滤功能也普遍用到了布隆过滤器,

- 因为用了这个过滤器, 所以平时也会遇到某些正常的邮件被放进了垃圾邮件目录中, 这个就是误判所致, 概率很低.

## Usage 6 : Simple Limiter

> 简单限流器

Reference

- 应用 6 : 断尾求生 —— 简单限流 : https://juejin.cn/book/6844733724618129422/section/6844733724706209800

场景 : 当系统的处理能力有限时, **阻止计划外的请求继续对系统施压**, _这是一个需要重视的问题._

除了控制流量, 限流还有一个应用目的是用于控制用户行为, 避免垃圾请求.

- _比如在 UGC 社区, 用户的发帖、回复、点赞等行为都要严格受控,_
    - _一般要严格限定某行为在规定时间内允许的次数, 超过了次数那就是非法行为._
- _对非法行为, 业务必须规定适当的惩处策略._

### 实现简单限流策略

**系统要限定用户的某个行为在指定的时间里只能允许发生 N 次,** _如何使用 Redis 的数据结构来实现这个限流的功能?_

先定义这个接口

```python
# 指定用户 user_id 的某个行为 action_key 在特定的时间内 period 只允许发生一定的次数 max_count
def is_action_allowed(user_id, action_key, period, max_count):
    return True

# 调用这个接口 , 60 秒内只允许最多回复 5 个帖子
can_reply = is_action_allowed("icehe", "reply", 60, 5)
if can_reply:
    do_reply()
else:
    raise ActionThresholdOverflow()
```

### Solution

> 解决方案

限流需求中存在一个滑动时间窗口,

- zset 数据结构可以使用 score 值来圈出时间窗口.
- 而且只需要保留这个时间窗口, 窗口之外的数据都可以删掉.
- 那么 zset 的 value 只需要保证唯一性即可
    - _用 uuid 会比较浪费空间,_ 使用 毫秒时间戳 即可.

![zset-limiter.webp](_images/zset-limiter.webp)

- 用一个 zset 结构记录用户的行为历史, 每一个行为都会作为 zset 中的一个 key 保存下来.
    - 同一个用户同一种行为用一个 zset 记录.
- 为节省内存, 只需要保留时间窗口内的行为记录,
    - 同时如果用户是冷用户, 滑动时间窗口内的行为是空记录, 那么这个 zset 就可以从内存中移除, 不再占用空间.
- 通过统计滑动窗口内的行为数量与阈值 max_count 进行比较就可以得出当前的行为是否允许.

### Implementation

用代码表示如下 :

- _( icehe : O(n) 线性的空间复杂度, 与行为数量成正比 )_

```python
# coding: utf8

import time
import redis

client = redis.StrictRedis()

def is_action_allowed(user_id, action_key, period, max_count):
    key = 'hist:%s:%s' % (user_id, action_key)
    now_ts = int(time.time() * 1000)  # 毫秒时间戳
    with client.pipeline() as pipe:  # client 是 StrictRedis 实例
        # 记录行为
        pipe.zadd(key, now_ts, now_ts)  # value 和 score 都使用毫秒时间戳
        # 移除时间窗口之前的行为记录, 剩下的都是时间窗口内的
        pipe.zremrangebyscore(key, 0, now_ts - period * 1000)
        # 获取窗口内的行为数量
        pipe.zcard(key)
        # 设置 zset 过期时间, 避免冷用户持续占用内存
        # 过期时间应该等于时间窗口的长度, 再多宽限 1s
        pipe.expire(key, period + 1)
        # 批量执行
        _, _, current_count, _ = pipe.execute()
    # 比较数量是否超标
    return current_count <= max_count

for i in range(20):
    print is_action_allowed("laoqian", "reply", 60, 5)
```

```java
public class SimpleRateLimiter {

  private Jedis jedis;

  public SimpleRateLimiter(Jedis jedis) {
    this.jedis = jedis;
  }

  public boolean isActionAllowed(String userId, String actionKey, int period, int maxCount) {
    String key = String.format("hist:%s:%s", userId, actionKey);
    long nowTs = System.currentTimeMillis();
    Pipeline pipe = jedis.pipelined();
    pipe.multi();
    pipe.zadd(key, nowTs, "" + nowTs);
    pipe.zremrangeByScore(key, 0, nowTs - period * 1000);
    Response<Long> count = pipe.zcard(key);
    pipe.expire(key, period + 1);
    pipe.exec();
    pipe.close();
    return count.get() <= maxCount;
  }

  public static void main(String[] args) {
    Jedis jedis = new Jedis();
    SimpleRateLimiter limiter = new SimpleRateLimiter(jedis);
    for(int i=0;i<20;i++) {
      System.out.println(limiter.isActionAllowed("laoqian", "reply", 60, 5));
    }
  }
}
```

## Usage 7 : Funnel Limiter

> 漏斗限流器

### Solution

> 解决方案

漏斗限流是最常用的限流方法之一, _顾名思义, 这个算法的灵感源于漏斗 ( funnel ) 的结构._

![funnel.webp](_images/funnel.webp)

- _漏斗的容量是有限的, 如果将漏嘴堵住, 然后一直往里面灌水, 它就会变满, 直至再也装不进去._
- _如果将漏嘴放开, 水就会往下流, 流走一部分之后, 就又可以继续往里面灌水._
- _如果漏嘴流水的速率大于灌水的速率, 那么漏斗永远都装不满._
- _如果漏嘴流水速率小于灌水的速率, 那么一旦漏斗满了, 灌水就需要暂停并等待漏斗腾空._

所以

- **漏斗的剩余空间** 就代表着 **当前行为可以持续进行的数量**,
- **漏嘴的流水速率** 代表着 **系统允许该行为的最大频率**.

### Implementation

使用代码来描述单机漏斗算法 :

_( icehe : 这个应用很有趣! 上次看过之后已经, 忘掉了… 有空得实现一下. )_

```python
# coding: utf8

import time

class Funnel(object):

    def __init__(self, capacity, leaking_rate):
        # 漏斗容量
        self.capacity = capacity
        # 漏嘴流水速率
        self.leaking_rate = leaking_rate
        # 漏斗剩余空间
        self.left_quota = capacity
        # 上一次漏水时间
        self.leaking_ts = time.time()

    def make_space(self):
        now_ts = time.time()
        # 距离上一次漏水过去了多久
        delta_ts = now_ts - self.leaking_ts
        # 又可以腾出不少空间了
        delta_quota = delta_ts * self.leaking_rate
        # 腾的空间太少, 那就等下次再继续j
        if delta_quota < 1:
            return
        # 增加剩余空间
        self.left_quota += delta_quota
        # 记录漏水时间
        self.leaking_ts = now_ts
        # 剩余空间不得高于容量
        if self.left_quota > self.capacity:
            self.left_quota = self.capacity

    def watering(self, quota):
        self.make_space()
        # 判断剩余空间是否足够
        if self.left_quota >= quota:
            self.left_quota -= quota
            return True
        return False

# 所有的漏斗
funnels = {}

# capacity  漏斗容量
# leaking_rate 漏嘴流水速率 quota/s
def is_action_allowed(
    user_id, action_key, capacity, leaking_rate):
    key = '%s:%s' % (user_id, action_key)
    funnel = funnels.get(key)
    if not funnel:
        funnel = Funnel(capacity, leaking_rate)
        funnels[key] = funnel
    return funnel.watering(1)

for i in range(20):
    print is_action_allowed('laoqian', 'reply', 15, 0.5)
```

```java
public class FunnelRateLimiter {

  static class Funnel {
    int capacity;
    float leakingRate;
    int leftQuota;
    long leakingTs;

    public Funnel(int capacity, float leakingRate) {
      this.capacity = capacity;
      this.leakingRate = leakingRate;
      this.leftQuota = capacity;
      this.leakingTs = System.currentTimeMillis();
    }

    void makeSpace() {
      long nowTs = System.currentTimeMillis();
      long deltaTs = nowTs - leakingTs;
      int deltaQuota = (int) (deltaTs * leakingRate);
      if (deltaQuota < 0) { // 间隔时间太长, 整数数字过大溢出
        this.leftQuota = capacity;
        this.leakingTs = nowTs;
        return;
      }
      if (deltaQuota < 1) { // 腾出空间太小, 最小单位是1
        return;
      }
      this.leftQuota += deltaQuota;
      this.leakingTs = nowTs;
      if (this.leftQuota > this.capacity) {
        this.leftQuota = this.capacity;
      }
    }

    boolean watering(int quota) {
      makeSpace();
      if (this.leftQuota >= quota) {
        this.leftQuota -= quota;
        return true;
      }
      return false;
    }
  }

  private Map<String, Funnel> funnels = new HashMap<>();

  public boolean isActionAllowed(String userId, String actionKey, int capacity, float leakingRate) {
    String key = String.format("%s:%s", userId, actionKey);
    Funnel funnel = funnels.get(key);
    if (funnel == null) {
      funnel = new Funnel(capacity, leakingRate);
      funnels.put(key, funnel);
    }
    return funnel.watering(1); // 需要1个quota
  }
}
```

Funnel 对象的 make_space 方法是漏斗算法的核心,

- 其在每次灌水前都会被调用以触发漏水, 给漏斗腾出空间来.
- 能腾出多少空间取决于过去了多久以及流水的速率.
- **Funnel 对象占据的空间大小不再和行为的频率成正比, 它的空间占用是一个常量!**
    - _( icehe : O(n) 线性的空间复杂度, 跟限流对象的数量成正比 )_

分布式的漏斗算法该如何实现? 能不能使用 Redis 的基础数据结构来搞定?

- 观察 Funnel 对象的几个字段,
    - 发现可以将 Funnel 对象的内容按字段存储到一个 hash 结构中,
    - 灌水的时候将 hash 结构的字段取出来进行逻辑运算后,
    - 再将新值回填到 hash 结构中就完成了一次行为频度的检测.
- 但是有个问题, 无法保证整个过程的原子性.
    - 从 hash 结构中取值, 然后在内存里运算, 再回填到 hash 结构,
    - 这三个过程无法原子化, 意味着需要进行适当的加锁控制.
    - 而一旦加锁, 就意味着会有加锁失败, 加锁失败就需要选择重试或者放弃.
- 如果重试的话, 就会导致性能下降. 如果放弃的话, 就会影响用户体验.
    - 同时, 代码的复杂度也跟着升高很多.

这是个艰难的选择, 该如何解决这个问题呢? 可以使用 Redis-Cell 解决!

### Redis-Cell

Redis 4.0 提供了一个 **限流模块 redis-cell**.

- 该模块 **使用 "漏斗算法", 并提供了原子的限流指令**!

该模块 **只有 1 条指令 `cl.throttle`**, _参数和返回值都略显复杂_

```bash
> cl.throttle icehe:reply 15 30 60 1
                  ▲       ▲  ▲  ▲  ▲
                  |       |  |  |  └───── need 1 quota (可选参数, 默认值也是1)
                  |       |  └──┴─────── 30 operations / 60 seconds 这是漏水速率
                  |       └───────────── 15 capacity 这是漏斗容量
                  └─────────────────── key laoqian
```

以上指令的意思是

- 允许「用户 icehe 的回复行为」的频率为每 60s 最多 30 次 ( 漏水速率 ) ,
- 漏斗的初始容量为 15, _也就是说一开始可以连续回复 15 个帖子, 然后才开始受漏水速率的影响._

_指令中漏水速率变成了 2 个参数, 替代了之前的单个浮点数._

- 用两个参数相除的结果来表达漏水速率相对单个浮点数要更加直观一些.

```bash
> cl.throttle laoqian:reply 15 30 60
1) (integer) 0   # 0 表示允许, 1 表示拒绝
2) (integer) 15  # 漏斗容量 capacity
3) (integer) 14  # 漏斗剩余空间 left_quota
4) (integer) -1  # 如果拒绝了, 需要多长时间后再试 ( 漏斗有空间了, 单位秒 )
5) (integer) 2   # 多长时间后, 漏斗完全空出来 ( left_quota==capacity, 单位秒 )
```

## Usage 8 : GeoHash

Reference

- 应用 8 : 近水楼台 —— GeoHash : https://juejin.cn/book/6844733724618129422/section/6844733724710404103

Redis 在 **3.2 版本以后增加了地理位置 GEO 模块**, 意味着可以使用 Redis 来实现摩拜单车「附近的 Mobike」、美团和饿了么「附近的餐馆」这样的功能了.

### 用 DB 来算附近的人

地图元素的位置数据使用二维的经纬度表示,

- 经度范围 (-180, 180], 纬度范围 (-90, 90],
- 纬度正负以赤道为界, 北正南负,
- 经度正负以本初子午线 (英国格林尼治天文台) 为界, 东正西负.

_比如掘金办公室在望京 SOHO, 它的经纬度坐标是 (116.48105, 39.996794), 都是正数, 因为中国位于东北半球._

当两个元素的距离不是很远时, 可以直接使用勾股定理就能算得元素之间的距离.

- 我们平时使用的「附近的人」的功能, 元素距离都不是很大, 勾股定理算距离足矣.
- 不过需要注意的是, 经纬度坐标的密度不一样 ( 地球是一个椭圆 ) ,
    - 勾股定律计算平方差时之后再求和时, 需要按一定的系数比加权求和,
    - 如果不求精确的话, 也可以不必加权.

问题 : 经度总共 360 度, 维度总共只有 180 度, 为什么距离密度不是 2:1 ?

- 现在, 如果要计算「附近的人」, 也就是给定一个元素的坐标, 然后计算这个坐标附近的其它元素, 按照距离进行排序, 该如何下手?

![estimate-geographic-distance.webp](_images/estimate-geographic-distance.webp)

_如果现在元素的经纬度坐标使用关系数据库 (元素 id, 经度 x, 纬度 y) 存储, 你该如何计算?_

- _首先, 不可能通过遍历来计算所有的元素和目标元素的距离然后再进行排序,_
    - _这个计算量太大了, 性能指标肯定无法满足._
- 一般的方法都是 **通过矩形区域来限定元素的数量, 然后对区域内的元素进行全量距离计算再排序**.
    - _这样可以明显减少计算量._
- 如何划分矩形区域呢?
    - **可以指定一个半径 r, 使用一条 SQL 就可以圈出来.**
    - **当用户对筛出来的结果不满意, 那就扩大半径继续筛选.**

```sql
select id from positions where x0 - r < x < x0 + r and y0 - r < y < y0 + r;
```

- **为了满足高性能的矩形区域算法, 数据表需要在经纬度坐标加上双向复合索引 (x, y)**, 这样可以最大优化查询性能.
    - _( icehe : "双向复合索引" 是啥? )_
- 但是数据库查询性能毕竟有限, 如果「附近的人」查询请求非常多, 在高并发场合, 这可能并不是一个很好的方案.

### GeoHash 算法

**业界比较通用的 地理位置距离排序算法是 GeoHash 算法**, _Redis 也使用 GeoHash 算法._

- GeoHash 算法将二维的经纬度数据映射到一维的整数,
    - 这样所有的元素都将在挂载到一条线上, 距离靠近的二维坐标映射到一维后的点之间距离也会很接近.
    - _当我们想要计算「附近的人时」, 首先将目标位置映射到这条线上, 然后在这个一维的线上获取附近的点就行了._
- 那这个映射算法具体是怎样的呢?
    - **将整个地球看成一个二维平面, 然后划分成了一系列正方形的方格**, 就好比围棋棋盘.
    - **所有的地图元素坐标都将放置于唯一的方格中**. 方格越小, 坐标越精确.
    - **然后对这些方格进行整数编码, 越是靠近的方格编码越是接近.**
    - 那如何编码呢? 一个最简单的方案就是切蛋糕法.
        - **设想一个正方形的蛋糕摆在你面前, 二刀下去均分分成四块小正方形,**
            - 这四个小正方形可以 **分别标记为 00,01,10,11 四个二进制整数.**
        - 然后 **对每一个小正方形继续用二刀法切割一下, 这时每个小小正方形就可以使用 4bit 的二进制整数予以表示.**
        - 然后继续切下去, 正方形就会越来越小, 二进制整数也会越来越长, 精确度就会越来越高.

![geohash-animation.gif](_images/geohash-animation.gif)

- **上面的例子中使用的是二刀法,**
    - **真实算法中还会有很多其它刀法**, 最终编码出来的整数数字也都不一样.
- 编码之后, 每个地图元素的坐标都将变成一个整数,
    - 通过这个整数可以还原出元素的坐标, 整数越长, 还原出来的坐标值的损失程度就越小.
    - 对于「附近的人」这个功能而言, 损失的一点精确度可以忽略不计.
- GeoHash 算法会 **继续对这个整数做一次 base32 编码 ( 0-9,a-z 去掉 a,i,l,o 四个字母 ) 变成一个字符串.**
    - 在 Redis 里面, **经纬度使用 52 位的整数进行编码, 放进了 zset 里面,**
        - **zset 的 value 是元素的 key** _( 例如, "三里屯SOHO" )_ ,
        - **score 是 GeoHash 的 52 位整数值.**
    - **zset 的 score 虽然是浮点数, 但是对于 52 位的整数值, 它可以无损存储.**
- Redis 进行 Geo 查询时, **GeoHash 的内部结构实际上只是一个 zset ( skiplist )** .
    - **通过 zset 的 score 范围查询就可以得到坐标附近的其它元素,**
        - _( 实际情况要复杂一些, 不过这样理解足够了)_
    - 通过将 score 还原成坐标值就可以得到元素的原始坐标.

### Redis 的 Geo 指令基本使用

_使用时, 务必记住 : 它只是一个普通的 zset 结构._

增加位置 `geoadd`

- 入参为 集合名称, 以及由 经度、纬度、位置名称 组成的三元组
- 可以加入多个三元组

```bash
127.0.0.1:6379> geoadd company 116.48105 39.996794 juejin
(integer) 1
127.0.0.1:6379> geoadd company 116.514203 39.905409 ireader
(integer) 1
127.0.0.1:6379> geoadd company 116.489033 40.007669 meituan
(integer) 1
127.0.0.1:6379> geoadd company 116.562108 39.787602 jd 116.334255 40.027400 xiaomi
(integer) 2
```

删除位置 `zrem`

- Redis 没有直接提供 geo 删除指令
    - 因为 geo 存储结构上使用的是 zset,
    - 意味着可以使用 zset 相关的指令来操作 geo 数据,
    - 所以 **删除直接使用 `zrem` 指令** 即可.

位置间的距离

- `geodist` 计算两个元素之间的距离
    - 入参为 集合名称, 以及 2 个位置名称和距离单位.

```bash
127.0.0.1:6379> geodist company juejin ireader km
"10.5501"
127.0.0.1:6379> geodist company juejin meituan km
"1.3878"
127.0.0.1:6379> geodist company juejin jd km
"24.2739"
127.0.0.1:6379> geodist company juejin xiaomi km
"12.9606"
127.0.0.1:6379> geodist company juejin juejin km
"0.0000"
```

获取元素位置 `geopos`

- 可以获取集合中任意元素的经纬度坐标,
- 可以一次获取多个.

```bash
127.0.0.1:6379> geopos company juejin
1) 1) "116.48104995489120483"
   2) "39.99679348858259686"
127.0.0.1:6379> geopos company ireader
1) 1) "116.5142020583152771"
   2) "39.90540918662494363"
127.0.0.1:6379> geopos company juejin ireader
1) 1) "116.48104995489120483"
   2) "39.99679348858259686"
2) 1) "116.5142020583152771"
   2) "39.90540918662494363"
```

- 观察到获取的经纬度坐标和 geoadd 进去的坐标有轻微的误差,
    - 原因是 geohash 对二维坐标进行的一维映射是有损的, 通过映射再还原回来的值会出现较小的差别.
    - 对于「附近的人」这种功能来说, 这点误差根本不是事.

获取元素的 hash 值 `geohash`

- 可以 **获取元素的经纬度编码字符串, 它是 base32 编码.**
- 可以 **使用这个编码值去 http://geohash.org 中进行直接定位, 它是 geohash 的标准编码值.**

查询附近的位置 `georadiusbymember`

- _最为关键的指令, 它的参数非常复杂._

```bash
# 范围 20 公里以内最多 3 个元素按距离正排, 它不会排除自身
127.0.0.1:6379> georadiusbymember company ireader 20 km count 3 asc
1) "ireader"
2) "juejin"
3) "meituan"

# 范围 20 公里以内最多 3 个元素按距离倒排
127.0.0.1:6379> georadiusbymember company ireader 20 km count 3 desc
1) "jd"
2) "meituan"
3) "juejin"

# 三个可选参数 withcoord withdist withhash 用来携带附加参数
# withdist 很有用, 它可以用来显示距离
127.0.0.1:6379> georadiusbymember company ireader 20 km withcoord withdist withhash count 3 asc
1) 1) "ireader"
   2) "0.0000"
   3) (integer) 4069886008361398
   4) 1) "116.5142020583152771"
      2) "39.90540918662494363"
2) 1) "juejin"
   2) "10.5501"
   3) (integer) 4069887154388167
   4) 1) "116.48104995489120483"
      2) "39.99679348858259686"
3) 1) "meituan"
   2) "11.5748"
   3) (integer) 4069887179083478
   4) 1) "116.48903220891952515"
      2) "40.00766997707732031"
```

根据坐标值来查询附近的位置 `georadius`

- _除了 georadiusbymember 指令根据元素查询附近的元素,_
    - Redis 还提供了根据坐标值来查询附近的元素, 这个指令更加有用,
    - _它可以根据用户的定位来计算「附近的车」, 「附近的餐馆」等._
    - **参数和 georadiusbymember 基本一致, 除了将目标元素改成经纬度坐标值.**

```bash
127.0.0.1:6379> georadius company 116.514202 39.905409 20 km withdist count 3 asc
1) 1) "ireader"
   2) "0.0000"
2) 1) "juejin"
   2) "10.5501"
3) 1) "meituan"
   2) "11.5748"
```

### Precautions

- 在一个地图应用中, 车的数据、餐馆的数据、人的数据可能会有百万千万条,
    - 如果使用 Redis 的 Geo 数据结构, 它们将全部放在一个 zset 集合中.
- 在 Redis 的 **集群环境中, 集合可能会从一个节点迁移到另一个节点,**
    - **如果单个 key 的数据过大, 会对集群的迁移工作造成较大的影响,**
    - **在集群环境中单个 key 对应的数据量不宜超过 1M,**
        - **否则会导致集群迁移出现卡顿现象, 影响线上服务的正常运行.**
- 所以, **建议 Geo 的数据使用单独的 Redis 实例部署, 不使用集群环境!**
    - **如果数据量过亿甚至更大, 就需要对 Geo 数据进行拆分,**
        - 按国家拆分、按省拆分, 按市拆分, 在人口特大城市甚至可以按区拆分.
    - _这样就可以显著降低单个 zset 集合的大小._

## Usage 8 : Scan

Reference

- 应用 9 : 大海捞针 —— Scan : https://juejin.cn/book/6844733724618129422/section/6844733724710404110

_在平时线上 Redis 维护工作中, 有时候需要从 Redis 实例成千上万的 key 中找出特定前缀的 key 列表来手动处理数据, 可能是修改它的值, 也可能是删除 key._

_这里就有一个问题, 如何从海量的 key 中找出满足特定前缀的 key 列表来?_

```bash
127.0.0.1:6379> set codehole1 a
OK
127.0.0.1:6379> set codehole2 b
OK
127.0.0.1:6379> set codehole3 c
OK
127.0.0.1:6379> set code1hole a
OK
127.0.0.1:6379> set code2hole b
OK
127.0.0.1:6379> set code3hole b
OK
127.0.0.1:6379> keys *
1) "codehole1"
2) "code3hole"
3) "codehole3"
4) "code2hole"
5) "codehole2"
6) "code1hole"
127.0.0.1:6379> keys codehole*
1) "codehole1"
2) "codehole3"
3) "codehole2"
127.0.0.1:6379> keys code*hole
1) "code3hole"
2) "code2hole"
3) "code1hole"
```

**指令 `keys` 列出所有满足特定正则字符串规则的 key**.

使用非常简单, 提供一个简单的正则字符串即可, 但是有很明显的两个缺点 :

- 1\. **没有 offset、limit 参数, 一次性吐出所有满足条件的 key,**
    - _万一实例中有几百 w 个 key 满足条件, 当看到满屏的字符串刷的没有尽头时, 你就知道难受了._
- 2\. **keys 算法是遍历算法, 复杂度是 O(n),**
    - **如果实例中有千万级以上的 key, 这个指令就会导致 Redis 服务卡顿, 所有读写 Redis 的其它的指令都会被延后甚至会超时报错,**
    - **因为 Redis 是单线程程序, 顺序执行所有指令, 其它指令必须等到当前的 keys 指令执行完了才可以继续.**

Redis 为了解决这个问题, 它在 2.8 版本中加入了指令 `scan`, 相比 `keys` 具备有以下特点 :

- 1\. _复杂度虽然也是 O(n), 但是它是_ **通过游标分步进行的, 不会阻塞线程**;
- 2\. **提供 limit 参数, 可以控制每次返回结果的最大条数**,
    - limit 只是一个 hint, 返回的结果可多可少;
- 3\. _同 keys 一样, 它也_ **提供模式匹配功能**;
- 4\. 服务器 **不需要为游标保存状态**,
    - **游标的唯一状态就是 scan 返回给客户端的游标整数**;
- 5\. 注意! **返回的结果可能会有重复, 需要客户端去重复**;
- 6\. **遍历的过程中如果有数据修改, 改动后的数据能不能遍历到是不确定的**;
- 7\. **单次返回的结果是空的并不意味着遍历结束, 而要看返回的游标值是否为零**;

### Basic Usage

> 基础使用

测试 : 在使用之前, 往 Redis 里插入 10000 条数据

```python
import redis

client = redis.StrictRedis()
for i in range(10000):
    client.set("key%d" % i, i)
```

`scan` 提供了三个参数

- 1\. `cursor` 整数值
- 2\. `key` 的正则模式
- 3\. 遍历的 `limit` hint

`scan` 查询过程

- **第一次遍历时, cursor 值为 0,**
- 然后 **将返回结果中第一个整数值作为下一次遍历的 cursor.**
- 一直 **遍历到返回的 cursor 值为 0 时结束.**

```bash
127.0.0.1:6379> scan 0 match key99* count 1000
1) "13976"
2)  1) "key9911"
    2) "key9974"
    3) "key9994"
    4) "key9910"
    5) "key9907"
    6) "key9989"
    7) "key9971"
    8) "key99"
    9) "key9966"
   10) "key992"
   11) "key9903"
   12) "key9905"
127.0.0.1:6379> scan 13976 match key99* count 1000
1) "1996"
2)  1) "key9982"
    2) "key9997"
    3) "key9963"
    4) "key996"
    5) "key9912"
    6) "key9999"
    7) "key9921"
    8) "key994"
    9) "key9956"
   10) "key9919"
127.0.0.1:6379> scan 1996 match key99* count 1000
1) "12594"
2) 1) "key9939"
   2) "key9941"
   3) "key9967"
   4) "key9938"
   5) "key9906"
   6) "key999"
   7) "key9909"
   8) "key9933"
   9) "key9992"
......
127.0.0.1:6379> scan 11687 match key99* count 1000
1) "0"
2)  1) "key9969"
    2) "key998"
    3) "key9986"
    4) "key9968"
    5) "key9965"
    6) "key9990"
    7) "key9915"
    8) "key9928"
    9) "key9908"
   10) "key9929"
   11) "key9944"
```

- 从上面的过程可以看到虽然提供的 limit 是 1000, 但是返回的结果只有 10 个左右.
    - 因为 **limit 不是限定返回结果的数量, 而是限定服务器单次遍历的字典槽位数量 ( 约等于 )** .
    - 如果将 limit 设置为 10, 但是 **返回结果可能为空, 只要游标值不为 0, 意味着遍历还没结束.**

```bash
127.0.0.1:6379> scan 0 match key99* count 10
1) "3072"
2) (empty list or set)
```

### Dictionary Structure

> 字典的结构

**在 Redis 中的所有 key 都存储在一个很大的字典中**,

- 这个字典的结构 **跟 Java 中的 HashMap 一样**,
    - 是 **一维数组 + 二维链表结构**,
    - **第一维数组的大小总是 2 ^ n** _( n >= 0 )_ ,
    - **扩容一次数组大小空间加倍**, 也就是 n++.

![dictionary-simple-structure.webp](_images/dictionary-simple-structure.webp)

- **`scan` 指令返回的游标 cursor 就是 <u>第一维数组的位置索引</u>**,
    - 将 **这个位置索引称为 槽 ( slot )**.
    - 如果不考虑字典的扩容缩容, 直接按数组下标挨个遍历就行了.
- **limit 参数表示需要遍历的槽位数**,
    - 之所以返回的结果可能多可能少, 是因为不是所有的槽位上都会挂接链表, 有些槽位可能是空的,
    - 还有些槽位上挂接的链表上的元素可能会有多个.
- **每一次遍历都会将 limit 数量的槽位上挂接的所有链表元素进行模式匹配过滤后, 一次性返回** 给客户端.

### Scan Traverse Sequence

> scan 遍历顺序

scan 不是从第一维数组的第 0 位一直遍历到末尾, 而是 **采用了 高位进位加法来 遍历**.

- 之所以使用这样特殊的方式进行遍历, 是 **考虑到字典的扩容和缩容时避免槽位的遍历重复和遗漏**.

用动画演示一下普通加法和高位进位加法的区别 :

![high-carry-addition-example.gif](_images/high-carry-addition-example.gif)

### Dictionary Expansion

> 字典扩容

Java 中的 HashMap 有 **扩容** 的概念,

- 当 loadFactor 达到阈值时, 需要重新分配一个新的 2 倍大小的数组,
- 然后将所有的元素全部 rehash 挂到新的数组下面.

rehash 就是将元素的 hash 值对数组长度进行取模运算,

- 因为长度变了, 所以每个元素挂接的槽位可能也发生了变化.
- 又因为数组的长度是 2^n 次方, 所以取模运算等价于位与操作.

```bash
a mod 8  = a & (  8 - 1 ) = a & 7
a mod 16 = a & ( 16 - 1 ) = a & 15
a mod 32 = a & ( 32 - 1 ) = a & 31
```

- 7, 15, 31 之所谓被称为字典的 mask 值, **mask 的作用就是保留 hash 值的低位, 高位都被设置为 0**.

_接下来看看 rehash 前后元素槽位的变化._

- _假设当前的字典的数组长度由 8 位扩容到 16 位, 那么 3 号槽位 011 将会被 rehash 到 3 号槽位和 11 号槽位,_
    - _也就是说该槽位链表中大约有一半的元素还是 3 号槽位, 其它的元素会放到 11 号槽位,_
    - _11 这个数字的二进制是 1011, 就是对 3 的二进制 011 增加了一个高位 1._

![dictionary-rehash-example.webp](_images/dictionary-rehash-example.webp)

- _抽象一点说, 假设开始槽位的二进制数是 xxx,_
    - _那么该槽位中的元素将被 rehash 到 0xxx 和 1xxx ( xxx+8 ) 中._
- _如果字典长度由 16 位扩容到 32 位,_
    - _那么对于二进制槽位 xxxx 中的元素将被 rehash 到 0xxxx 和 1xxxx ( xxxx+16 ) 中._

### Traverse Sequence Before and After Rehashing

> 对比扩容所有前后的遍历顺序
