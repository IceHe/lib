# Basic

References

- https://hit-alibaba.github.io/interview/basic/network/HTTP.html

## BGP

**Border Gateway Protocol**

- BGP 是外部网关协议（指的是局域网间的路由？）
    - 适用 TCP 协议传输
- OSPF、RIP 是内部网关协议（局域网内的路由？）

## MTU & MSS

- 以太网最大的 MTU 为 1500B（加上以外网协议头部为 1518B）
- MTU = MSS + 20B（IP包头）+ 20B（TCP包头）
