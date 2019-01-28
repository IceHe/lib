# RESP

> Redis Serialization Protocol

References

- 原理 2：交头接耳 —— 通信协议 : https://juejin.im/book/5afc2e5f6fb9a07a9b362527/section/5afc39496fb9a07ab458d0f1

Redis 协议将传输的结构数据分为 5 种最小单元类型，单元结束时统一加上回车换行符号\r\n。

- 单行字符串 以 `+` 符号开头。
- 多行字符串 以 `$` 符号开头，后跟字符串长度。
- 整数值 以 `:` 符号开头，后跟整数的字符串形式。
- 错误消息 以 `-` 符号开头。
- 数组 以 `*` 号开头，后跟数组的长度。
