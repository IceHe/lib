# epoll

References

- Kqueue与epoll机制 : https://www.cnblogs.com/FG123/p/5256553.html

## Block

basic

- block (sleep)
- wakeup

producer events

- buf full
- buf not full

consumer events

- buf empty
- buf not empty

```bash
select(streams[]) {
    for s in streams {
        if s has data {
            read until unavailable
        }
    }
}
```

select / poll

- 返回值是就绪的 fd 个数
- 需要遍历作为参数传入的 fd 列表，来判断哪个就绪了（效率很低）

## Thundering Herd Problem

> 惊群效应

- Linux惊群效应详解（最详细的了吧）: https://blog.csdn.net/lyztyycode/article/details/78648798
