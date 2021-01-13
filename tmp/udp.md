# UDP

## Features

Features

- 无连接
    - 不支持多播和广播（意味着什么？）

Advantages

- 无需建连
- 无状态
- 头部比 TCP 小
    - UDP 8B
    - TCP 20B

缺点

- 非可靠
    - 不保证到达
    - 不保证顺序
    - 不保证只到达一次（网络中可能被复制）

Applicable Scene 适用场景

- 实时性比较强，只要拿到最近的数据，迟到的旧数据就没用。

## Message

```bash
<src_port> <dest_port>
<length> <check_sum>
<body…>
```
