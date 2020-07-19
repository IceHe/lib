# TCP/IP Illustrated, Volume 1 : The Protocols, 2nd Edition ( TOC )

> **Table of Contents**

References

- Book "TCP/IP Illustrated, Volume 1 : The Protocols, 2nd Edition"
    - ZH Ver. :《 TCP/IP 详解卷一：协议 》

## 1. Introduction

- 1.1 Architectural Principles
    - 1.1.1 Packets, Connections, and Datagrams _( 分组, 连接, 数据报 )_
    - 1.1.2 The End-to-End Argument and Fate Sharing
    - 1.1.3 Error Control and Flow Control _( 差错控制, 流量控制 )_
- 1.2 Design and Implementation
    - 1.2.1 Layering _( 分层 )_
    - 1.2.2 Multiplexing, Demultiplexing, and Encapsulation in Layered Implementations _( 多路复用, 分解 … )_
- 1.3 The Architecture and Protocols of the TCP/IP Suite _( 族 )_
    - 1.3.1 The ARPANET Reference Model
    - 1.3.2 Multiplexing, Demultiplexing, and Encapsulation in TCP/IP
    - 1.3.3 Port Numbers
    - 1.3.4 Names, Addresses, and the DNS
- 1.4 Internets, Intranets, and Extranets _( Internet, 内联网, 外联网 )_
- 1.5 Designing Applications
    - 1.5.1 Client/Server
    - 1.5.2 Peer-to-Peer _( 对等 )_
    - 1.5.3 Application Programming Interfaces (APIs)
- 1.6 Standardization Process _( 标准化过程 )_
    - 1.6.1 Request for Comments (RFC)
    - 1.6.2 Other Standards
- 1.7 Implementations and Software Distributions
- _1.8 Attacks Involving the Internet Architecture_
- _1.9 Summary_
- _1.10 References_

## 2. The Internet Address Architecture

_( Internet 地址结构 )_

- _2.1 Introduction_
- 2.2 Expressing IP Addresses
- 2.3 Basic IP Address Structure
    - 2.3.1 Classful Addressing _( 分类寻址 )_
    - 2.3.2 Subnet Addressing _( 子网寻址 )_
    - 2.3.3 Subnet Masks _( 子网掩码 )_
    - 2.3.4 Variable-Length Subnet Masks (VLSM)
    - 2.3.5 Broadcast Addresses
    - 2.3.6 IPv6 Addresses and Interface Identifiers
- 2.4 CIDR and Aggregation
    - 2.4.1 Prefixes _( 前缀 )_
    - 2.4.2 Aggregation _( 聚合 )_
- 2.5 Special-Use Addresses
    - 2.5.1 Addressing IPv4/IPv6 Translators
    - 2.5.2 Multicast Addresses _( 组播地址 )_
    - 2.5.3 IPv4 Multicast Addresses
    - 2.5.4 IPv6 Multicast Addresses
    - 2.5.5 Anycast Addresses _( 任播地址 )_
- 2.6 Allocation
    - 2.6.1 Unicast _( 单播 )_
    - 2.6.2 Multicast _( 多播 )_
- 2.7 Unicast Address Assignment _( 单播地址分配 )_
    - 2.7.1 Single Provider _( 供应商 )_ / No Network / Single Address
    - 2.7.2 Single Provider / Single Network / Single Address
    - 2.7.3 Single Provider / Multiple Networks / Multiple Addresses
    - 2.7.4 Multiple Providers / Multiple Networks / Multiple Addresses (Multihoming)
- _2.8 Attacks Involving IP Addresses_
- _2.9 Summary_
- _2.10 References_

## 3. Link Layer

_( 链路层 )_

- _3.1 Introduction_
- 3.2 Ethernet and the IEEE 802 LAN/MAN Standards _( 以为网, 局域网, 城域网 )_
    - 3.2.1 The IEEE 802 LAN/MAN Standards
    - 3.2.2 The Ethernet Frame Format _( 以太网帧 )_
    - 3.2.3 802.1p/q: Virtual LANs and QoS Tagging _( Quality of Service 服务质量 )_
    - 3.2.4 802.1AX: Link Aggregation (Formerly 802.3ad) _( 链路聚合 )_
- 3.3 Full Duplex, Power Save, Autonegotiation, and 802.1X Flow Control _( 全双工, 省电, 自动协商, … )_
    - 3.3.1 Duplex Mismatch _( 双工不匹配 )_
    - 3.3.2 Wake-on LAN (WoL), Power Saving, and Magic Packets _( 局域网唤醒, …, 魔术分组 )_
    - 3.3.3 Link-Layer Flow Control _( 链路层流量控制 )_
- 3.4 Bridges and Switches _( 网桥, 交换机 )_
    - 3.4.1 Spanning Tree Protocol (STP) _( 生成树协议 )_
    - 3.4.2 802.1ak: Multiple Registration Protocol (MRP) _( 多注册协议 )_
- 3.5 Wireless LANs—IEEE 802.11(Wi-Fi) _( 无线局域网 )_
    - 3.5.1 802.11 Frames _( 帧 )_
    - 3.5.2 Power Save Mode and the Time Sync Function (TSF) _( …, 时间同步功能 )_
    - 3.5.3 802.11 Media Access Control _( 介质访问控制 )_
    - 3.5.4 Physical-Layer Details: Rates, Channels, and Frequencies _( 物理层的细节 : …, 信道, … )_
    - 3.5.5 Wi-Fi Security
    - 3.5.6 Wi-Fi Mesh (802.11s) _( 网状网 )_
- 3.6 Point-to-Point Protocol (PPP) _( 点到点协议 )_
    - 3.6.1 Link Control Protocol (LCP) _( 链路控制协议 )_
    - 3.6.2 Multilink PPP (MP) _( 多链路 PPP )_
    - 3.6.3 Compression Control Protocol (CCP) _( 压缩控制协议 )_
    - 3.6.4 PPP Authentication
    - 3.6.5 Network Control Protocols (NCPs) _( 网络控制协议 )_
    - 3.6.6 Header Compression _( 头部压缩 )_
    - 3.6.7 Example
- 3.7 Loopback _( 环回 )_
- 3.8 MTU and Path MTU
- 3.9 Tunneling Basics _( 隧道 … )_
- 3.9.1 Unidirectional Links _( 单向链路 )_
- _3.10 Attacks on the Link Layer_
- _3.11 Summary_
- _3.12 References_

## 4. ARP: Address Resolution Protocol

_( 地址解析协议 )_

- _4.1 Introduction_
- 4.2 An Example
    - 4.2.1 Direct Delivery and ARP _( 直接交付 … )_
- 4.3 ARP Cache
- 4.4 ARP Frame Format
- 4.5 ARP Examples
    - 4.5.1 Normal Example _( 正常的例子 )_
    - 4.5.2 ARP Request to a Nonexistent Host
- 4.6 ARP Cache Timeout _( 缓存超时 )_
- 4.7 Proxy ARP
- 4.8 Gratuitous ARP and Address Conflict Detection (ACD) _( 免费 ARP, 地址冲突检测 )_
- 4.9 The arp Command
- 4.10 Using ARP to Set an Embedded Device’s IPv4 Address
- _4.11 Attacks Involving ARP_
- _4.12 Summary_
- _4.13 References_

## 5. The Internet Protocol (IP)

- _5.1 Introduction_
- 5.2 IPv4 and IPv6 Headers
    - 5.2.1 IP Header Fields _( 头部字段 )_
    - 5.2.2 The Internet Checksum _( … 检验和 )_
    - 5.2.3 DS Field and ECN ( Formerly Called the ToS Byte or IPv6 Traffic Class )
    - 5.2.4 IP Options _( … 选项 )_
- 5.3 IPv6 Extension Headers
    - 5.3.1 IPv6 Options
    - 5.3.2 Routing Header _( 路由头部 )_
    - 5.3.3 Fragment Header _( 分片头部 )_
- 5.4 IP Forwarding _( … 转发 )_
    - 5.4.1 Forwarding Table _( 转发表 )_
    - 5.4.2 IP Forwarding Actions _( 转发行动 )_
    - 5.4.3 Examples
    - 5.4.4 Discussion
- 5.5 Mobile IP
    - 5.5.1 The Basic Model: Bidirectional Tunneling _( 双向隧道 )_
    - 5.5.2 Route Optimization (RO) _( 路由优化 )_
    - 5.5.3 Discussion
- 5.6 Host Processing of IP Datagrams
    - 5.6.1 Host Models
    - 5.6.2 Address Selection
- _5.7 Attacks Involving IP_
- _5.8 Summary_
- _5.9 References_

## 6. System Configuration: DHCP and Autoconfiguration

_( 系统配置 : DHCP 于自助配置 )_

- _6.1 Introduction_
- 6.2 Dynamic Host Configuration Protocol (DHCP) _( 动态主机配置协议 )_
    - 6.2.1 Address Pools and Leases _( 地址池 )_
    - 6.2.2 DHCP and BOOTP Message Format
    - 6.2.3 DHCP and BOOTP Options
    - 6.2.4 DHCP Protocol Operation
    - 6.2.5 DHCPv6
    - 6.2.6 Using DHCP with Relays _( 中继 )_
    - 6.2.7 DHCP Authentication
    - 6.2.8 Reconfigure Extension
    - 6.2.9 Rapid Commit _( 快速确认 )_
    - 6.2.10 Location Information (LCI and LoST)
    - 6.2.11 Mobility and Handoff Information (MoS and ANDSF)
    - 6.2.12 DHCP Snooping _( 嗅探 )_
- 6.3 Stateless Address Autoconfiguration (SLAAC) _( 无状态地址自动配置 )_
    - 6.3.1 Dynamic Configuration of IPv4 Link-Local Addresses
    - 6.3.2 IPv6 SLAAC for Link-Local Addresses _( 链路本地地址? )_
- 6.4 DHCP and DNS Interaction
- 6.5 PPP over Ethernet (PPPoE)
- _6.6 Attacks Involving System Configuration_
- _6.7 Summary_
- _6.8 References_

## 7. Firewalls and Network Address Translation (NAT)

_( 防火墙与网络地址转换 )_

- _7.1 Introduction_
- 7.2 Firewalls _( 防火墙 )_
    - 7.2.1 Packet-Filtering Firewalls _( 包过滤防火墙 )_
    - 7.2.2 Proxy Firewalls _( 代理防火墙 )_
- 7.3 Network Address Translation (NAT) _( 网络地址转换 )_
    - 7.3.1 Traditional NAT: Basic NAT and NAPT
    - 7.3.2 Address and Port Translation Behavior
    - 7.3.3 Filtering Behavior
    - 7.3.4 Servers behind NATs
    - 7.3.5 Hairpinning and NAT Loopback _( 发夹, … 环回 )_
    - 7.3.6 NAT Editors
    - 7.3.7 Service Provider NAT (SPNAT) and Service Provider IPv6 Transition
- 7.4 NAT Traversal _( … 穿越 )_
    - 7.4.1 Pinholes and Hole Punching _( 针孔, 打孔 )_
    - 7.4.2 UNilateral Self-Address Fixing (UNSAF) _( 单边的自地址确认 )_
    - 7.4.3 Session Traversal Utilities for NAT (STUN) _( NAT 的会话穿越工具 )_
    - 7.4.4 Traversal Using Relays around NAT (TURN) _( 利用 NAT 中继的穿越 )_
    - 7.4.5 Interactive Connectivity Establishment (ICE)
- 7.5 Configuring Packet-Filtering Firewalls and NATs
    - 7.5.1 Firewall Rules
    - 7.5.2 NAT Rules
    - 7.5.3 Direct Interaction with NATs and Firewalls: UPnP, NAT-PMP, and PCP
- 7.6 NAT for IPv4/IPv6 Coexistence and Transition _( … 共存与过渡 )_
    - 7.6.1 Dual-Stack Lite (DS-Lite) _( 双栈协议精简版 )_
    - 7.6.2 IPv4/IPv6 Translation Using NATs and ALGs
- _7.7 Attacks Involving Firewalls and NATs_
- _7.8 Summary_
- _7.9 References_

## 8. ICMPv4 and ICMPv6: Internet Control Message Protocol

_( … : Internet 控制报文协议 )_

- _8.1 Introduction_
    - 8.1.1 Encapsulation in IPv4 and IPv6 _( 封装 … )_
- 8.2 ICMP Messages
    - 8.2.1 ICMPv4 Messages
    - 8.2.2 ICMPv6 Messages
    - 8.2.3 Processing of ICMP Messages
- 8.3 ICMP Error Messages _( 差错报文 )_
    - 8.3.1 Extended ICMP and Multipart Messages _( …, 多部报文 )_
    - 8.3.2 Destination Unreachable (ICMPv4 Type 3, ICMPv6 Type 1) and Packet Too Big (ICMPv6 Type 2) _( 目的地不可达, 数据报太大 )_
    - 8.3.3 Redirect (ICMPv4 Type 5, ICMPv6 Type 137) _( 重定向 )_
    - 8.3.4 ICMP Time Exceeded (ICMPv4 Type 11, ICMPv6 Type 3) _( 超时 )_
    - 8.3.5 Parameter Problem (ICMPv4 Type 12, ICMPv6 Type 4)
- 8.4 ICMP Query / Informational Messages _( … / 信息类报文 )_
    - 8.4.1 Echo Request / Reply (ping) (ICMPv4 Types 0/8, ICMPv6 Types 129/128) _( 回显请求 / 应答 )_
    - 8.4.2 Router Discovery: Router Solicitation and Advertisement (ICMPv4 Types 9, 10) _( 路由器发现 : 路由器请求, 通告 )_
    - 8.4.3 Home Agent Address Discovery Request / Reply (ICMPv6 Types 144/145) _( 本地代理地址发现请求 / … )_
    - 8.4.4 Mobile Prefix Solicitation / Advertisement (ICMPv6 Types 146/147) _( 移动前缀请求 / … )_
    - 8.4.5 Mobile IPv6 Fast Handover Messages (ICMPv6 Type 154) _( … 快速切换报文 )_
    - 8.4.6 Multicast Listener Query / Report / Done (ICMPv6 Types 130/131/132) _( 组播真挺查询 / 报告 / 完成 )_
    - 8.4.7 Version 2 Multicast Listener Discovery (MLDv2) (ICMPv6 Type 143) _( 版本 2 组播侦听发现 )_
    - 8.4.8 Multicast Router Discovery (MRD) (IGMP Types 48/49/50, ICMPv6 Types 151/152/153) _( 组播路由器发现 )_
- 8.5 Neighbor Discovery in IPv6 _( 邻居发现 )_
    - 8.5.1 ICMPv6 Router Solicitation _( 恳求/教唆/诱惑 )_ and Advertisement (ICMPv6 Types 133, 134)
    - 8.5.2 ICMPv6 Neighbor Solicitation and Advertisement (IMCPv6 Types 135, 136)
    - 8.5.3 ICMPv6 Inverse Neighbor Discovery Solicitation / Advertisement (ICMPv6 Types 141/142) _( 反向邻居发现请求 / … )_
    - 8.5.4 Neighbor Unreachability Detection (NUD) _( 邻居不可达检测 )_
    - 8.5.5 Secure Neighbor Discovery (SEND)
    - 8.5.6 ICMPv6 Neighbor Discovery (ND) Options
- 8.6 Translating ICMPv4 and ICMPv6 _( 转换 … )_
    - 8.6.1 Translating ICMPv4 to ICMPv6
    - 8.6.2 Translating ICMPv6 to ICMPv4
- _8.7 Attacks Involving ICMP_
- _8.8 Summary_
- _8.9 References_

## 9. Broadcasting and Local Multicasting (IGMP and MLD)

_( 广播与本地组播 )_

- _9.1 Introduction_
- 9.2 Broadcasting _( 广播 )_
    - 9.2.1 Using Broadcast Addresses
    - 9.2.2 Sending Broadcast Datagrams
- 9.3 Multicasting _( 组播 )_
    - 9.3.1 Converting IP Multicast Addresses to 802 MAC/Ethernet Addresses
    - 9.3.2 Examples
    - 9.3.3 Sending Multicast Datagrams
    - 9.3.4 Receiving Multicast Datagrams
    - 9.3.5 Host Address Filtering
- 9.4 The Internet Group Management Protocol (IGMP) and Multicast Listener Discovery Protocol (MLD)
    - 9.4.1 IGMP and MLD Processing by Group Members (“Group Member Part”)
    - 9.4.2 IGMP and MLD Processing by Multicast Routers (“Multicast Router Part”)
    - 9.4.3 Examples
    - 9.4.4 Lightweight IGMPv3 and MLDv2
    - 9.4.5 IGMP and MLD Robustness _( 健壮性 )_
    - 9.4.6 IGMP and MLD Counters and Variables
    - 9.4.7 IGMP and MLD Snooping _( … 嗅探 )_
- _9.5 Attacks Involving IGMP and MLD_
- _9.6 Summary_
- _9.7 References_

## 10. User Datagram Protocol (UDP) and IP Fragmentation

_( 用户数据报协议与 IP 分片 )_

- _10.1 Introduction_
- 10.2 UDP Header
- 10.3 UDP Checksum
- 10.4 Examples
- 10.5 UDP and IPv6
    - 10.5.1 Teredo: Tunneling IPv6 through IPv4 Networks
- 10.6 UDP-Lite
- 10.7 IP Fragmentation _( IP 分片 )_
    - 10.7.1 Example: UDP/IPv4 Fragmentation
    - 10.7.2 Reassembly Timeout _( 重组超时 )_
- 10.8 Path MTU Discovery with UDP
    - 10.8.1 Example
- 10.9 Interaction between IP Fragmentation and ARP/ND
- 10.10 Maximum UDP Datagram Size
    - 10.10.1 Implementation Limitations
    - 10.10.2 Datagram Truncation _( 数据报截断 )_
- 10.11 UDP Server Design
    - 10.11.1 IP Addresses and UDP Port Numbers
    - 10.11.2 Restricting Local IP Addresses
    - 10.11.3 Using Multiple Addresses
    - 10.11.4 Restricting Foreign IP Address
    - 10.11.5 Using Multiple Servers per Port
    - 10.11.6 Spanning Address Families: IPv4 and IPv6
    - 10.11.7 Lack of Flow and Congestion Control _( … 流量与拥塞控制 )_
- 10.12 Translating UDP/IPv4 and UDP/IPv6 Datagrams
- 10.13 UDP in the Internet
- _10.14 Attacks Involving UDP and IP Fragmentation_
- _10.15 Summary_
- _10.16 References_

## 11. Name Resolution and the Domain Name System (DNS)

 _( 名称解析与域名系统 )_

- _11.1 Introduction_
- 11.2 The DNS Name Space _( … 命名空间 )_
    - 11.2.1 DNS Naming Syntax _( … 命名语法 )_
- 11.3 Name Servers and Zones
- 11.4 Caching
- 11.5 The DNS Protocol
    - 11.5.1 DNS Message Format
    - 11.5.2 The DNS Extension Format (EDNS0)
    - 11.5.3 UDP or TCP
    - 11.5.4 Question (Query) and Zone Section _( 区域区段 )_ Format
    - 11.5.5 Answer, Authority _( 授权 )_, and Additional Information Section Formats
    - 11.5.6 Resource Record Types _( 资源记录类型 )_
    - 11.5.7 Dynamic Updates (DNS UPDATE) _( 动态更新 )_
    - 11.5.8 Zone Transfers and DNS NOTIFY _( 区域传输与 DNS 通知 )_
- 11.6 Sort Lists, Round-Robin, and Split DNS _( 排序列表, 轮询, 分离 DNS )_
- 11.7 Open DNS Servers and DynDNS _( 开放 DNS … )_
- 11.8 Transparency and Extensibility _( 透明度, 拓展性 )_
- 11.9 Translating DNS from IPv4 to IPv6 (DNS64)
- 11.10 LLMNR and mDNS
- 11.11 LDAP
- _11.12 Attacks on the DNS_
- _11.13 Summary_
- _11.14 References_

## 12. TCP: The Transmission Control Protocol (Preliminaries)

- _12.1 Introduction_
    - 12.1.1 ARQ and Retransmission _( … 重传 )_
    - 12.1.2 Windows of Packets and Sliding Windows _( 分组窗口, 滑动窗口 )_
    - 12.1.3 Variable Windows: Flow Control and Congestion Control _( 可变窗口 : 流量控制, 拥塞控制 )_
    - 12.1.4 Setting the Retransmission Timeout _( … 重传时间 )_
- 12.2 Introduction to TCP
    - 12.2.1 The TCP Service Model
    - 12.2.2 Reliability in TCP
- 12.3 TCP Header and Encapsulation
- 12.4 Summary
- 12.5 References

## 13. TCP Connection Management

- _13.1 Introduction_
- 13.2 TCP Connection Establishment and Termination
    - 13.2.1 TCP Half-Close _( 半关闭 )_
    - 13.2.2 Simultaneous Open and Close _( 同时打开与关闭 )_
    - 13.2.3 Initial Sequence Number (ISN) _( 初始序列号 )_
    - 13.2.4 Example
    - 13.2.5 Timeout of Connection Establishment _( 连接建立超时 )_
    - 13.2.6 Connections and Translators _( 连接与转换器 )_
- 13.3 TCP Options
    - 13.3.1 Maximum Segment Size (MSS) Option _( 最大段大小 … )_
    - 13.3.2 Selective Acknowledgment (SACK) Options _( 选择确认 … )_
    - 13.3.3 Window Scale (WSCALE or WSOPT) Option _( 窗口缩放 … )_
    - 13.3.4 Timestamps Option and Protection against Wrapped Sequence Numbers (PAWS) _( … 防回绕序列号 )_
    - 13.3.5 User Timeout (UTO) Option
    - 13.3.6 Authentication Option (TCP-AO)
- 13.4 Path MTU Discovery with TCP
    - 13.4.1 Example
- 13.5 TCP State Transitions _( 状态转换 )_
    - 13.5.1 TCP State Transition Diagram _( … 状态转换图 )_
    - 13.5.2 TIME_WAIT (2MSL Wait) State
    - 13.5.3 Quiet Time Concept _( 静默时间 … )_
    - 13.5.4 FIN_WAIT_2 State
    - 13.5.5 Simultaneous _( 同时的 )_ Open and Close Transitions
- 13.6 Reset Segments _( 重置报文段 )_
    - 13.6.1 Connection Request to Nonexistent Port _( 针对不存在端口的连接请求 )_
    - 13.6.2 Aborting a Connection _( 中止一条连接 )_
    - 13.6.3 Half-Open Connections _( 半开连接 )_
    - 13.6.4 TIME-WAIT Assassination (TWA) _( 时间等待错误 )_
- 13.7 TCP Server Operation
    - 13.7.1 TCP Port Numbers _( … 端口号 )_
    - 13.7.2 Restricting Local IP Addresses _( 限制本地 IP 地址 )_
    - 13.7.3 Restricting Foreign Endpoints _( 限制外地节点 )_
    - 13.7.4 Incoming Connection Queue _( 进入连接队列 )_
- _13.8 Attacks Involving TCP Connection Management_
- _13.9 Summary_
- _13.10 References_

## 14. TCP Timeout and Retransmission

- _14.1 Introduction_
- 14.2 Simple Timeout and Retransmission Example
- 14.3 Setting the Retransmission Timeout (RTO) _( … 重传超时 )_
    - 14.3.1 The Classic Method
    - 14.3.2 The Standard Method
    - 14.3.3 The Linux Method
    - 14.3.4 RTT Estimator Behaviors _( RTT 估计器 )_
    - 14.3.5 RTTM Robustness to Loss and Reordering _( … 丢包, 失序 )_
- 14.4 Timer-Based Retransmission _( 基于计时器的重传 )_
    - 14.4.1 Example
- 14.5 Fast Retransmit _( 快速重传 )_
    - 14.5.1 Example
- 14.6 Retransmission with Selective Acknowledgments _( 带选择确认的重传 )_
    - 14.6.1 SACK Receiver Behavior _( … 接收端 … )_
    - 14.6.2 SACK Sender Behavior _( … 发送端 … )_
    - 14.6.3 Example
- 14.7 Spurious Timeouts and Retransmissions _( 伪超时与重传 )_
    - 14.7.1 Duplicate SACK (DSACK) Extension
    - 14.7.2 The Eifel Detection Algorithm
    - 14.7.3 Forward-RTO Recovery (F-RTO) _( 前移 RTO 恢复 )_
    - 14.7.4 The Eifel Response Algorithm
- 14.8 Packet Reordering and Duplication _( 包失序与包重复 )_
    - 14.8.1 Reordering _( 失序 )_
    - 14.8.2 Duplication _( 重复 )_
- 14.9 Destination Metrics _( 目的度量 )_
- 14.10 Repacketization _( 重新组包 )_
- _14.11 Attacks Involving TCP Retransmission_
- _14.12 Summary_
- _14.13 References_

## 15. TCP Data Flow and Window Management

_( TCP 数据流与窗口控制 )_

- _15.1 Introduction_
- 15.2 Interactive Communication _( 交互式通信 )_
- 15.3 Delayed Acknowledgments _( 延时确认 )_
- 15.4 Nagle Algorithm
    - 15.4.1 Delayed ACK and Nagle Algorithm Interaction
    - 15.4.2 Disabling the Nagle Algorithm
- 15.5 Flow Control and Window Management
    - 15.5.1 Sliding Windows _( 滑动窗口 )_
    - 15.5.2 Zero Windows and the TCP Persist Timer _( 零窗口, TCP 持续计时器 )_
    - 15.5.3 Silly Window Syndrome (SWS) _( 糊涂窗口综合征 )_
    - 15.5.4 Large Buffers and Auto-Tuning _( 大容量缓存与自动调优 )_
- 15.6 Urgent Mechanism _( 紧急机制 )_
    - 15.6.1 Example
- _15.7 Attacks Involving Window Management_
- _15.8 Summary_
- _15.9 References_

## 16. TCP Congestion Control

_( TCP 拥塞控制 )_

- _16.1 Introduction_
    - 16.1.1 Detection of Congestion in TCP _( 拥塞检测 … )_
    - 16.1.2 Slowing Down a TCP Sender _( 减缓 TCP 发送 )_
- 16.2 The Classic Algorithms
    - 16.2.1 Slow Start _( 慢启动 )_
    - 16.2.2 Congestion Avoidance _( 拥塞避免 )_
    - 16.2.3 Selecting between Slow Start and Congestion Avoidance
    - 16.2.4 Tahoe, Reno, and Fast Recovery _( … 快速恢复 )_
    - 16.2.5 Standard TCP
- 16.3 Evolution of the Standard Algorithms
    - 16.3.1 NewReno
    - 16.3.2 TCP Congestion Control with SACK _( 从用选择确认机制的 TCP 拥塞控制 )_
    - 16.3.3 Forward Acknowledgment (FACK) and Rate Halving _( 转发确认, 速率减半 )_
    - 16.3.4 Limited Transmit _( 限制传输 )_
    - 16.3.5 Congestion Window Validation (CWV) _( 拥塞窗口校验 )_
- 16.4 Handling Spurious RTOs—the Eifel Response Algorithm _( 伪 RTO 处理 … )_
- 16.5 An Extended Example
    - 16.5.1 Slow Start Behavior
    - 16.5.2 Sender Pause and Local Congestion (Event 1) _( 发送暂停, 本地拥塞 )_
    - 16.5.3 Stretch ACKs and Recovery from Local Congestion _( 延伸 ACk, 本地拥塞恢复 )_
    - 16.5.4 Fast Retransmission and SACK Recovery (Event 2) _( 快速重传, SACK 恢复 )_
    - 16.5.5 Additional Local Congestion and Fast Retransmit Events
    - 16.5.6 Timeouts, Retransmissions, and Undoing cwnd Changes _( …, …, 撤销 cwnd 修改 )_
    - 16.5.7 Connection Completion _( 链接结束 )_
- 16.6 Sharing Congestion State
- 16.7 TCP Friendliness _( … 友好性 )_
- 16.8 TCP in High-Speed Environments
    - 16.8.1 HighSpeed TCP (HSTCP) and Limited Slow Start
    - 16.8.2 Binary Increase Congestion Control (BIC and CUBIC) _( 二进制增长拥塞控制 )_
- 16.9 Delay-Based Congestion Control _( 基于延迟的拥塞控制 )_
    - 16.9.1 Vegas
    - 16.9.2 FAST
    - 16.9.3 TCP Westwood and Westwood+
    - 16.9.4 Compound TCP _( 复合的 … )_
- 16.10 Buffer Bloat _( 缓存区膨胀 )_
- 16.11 Active Queue Management and ECN _( 积极队列 … )_
- _16.12 Attacks Involving TCP Congestion Control_
- _16.13 Summary_
- _16.14 References_

## 17. TCP Keepalive

- _17.1 Introduction_
- 17.2 Description
    - 17.2.1 Keepalive Examples _( 保活 … )_
- _17.3 Attacks Involving TCP Keepalives_
- _17.4 Summary_
- _17.5 References_

## 18. Security: EAP, IPsec, TLS, DNSSEC, and DKIM

- _18.1 Introduction_
- 18.2 Basic Principles of Information Security
- 18.3 Threats to Network Communication
- 18.4 Basic Cryptography _( 加密 )_ and Security Mechanisms
    - 18.4.1 Cryptosystems _( 密码系统 )_
    - 18.4.2 Rivest, Shamir, and Adleman (RSA) Public Key Cryptography _( … 公钥密码算法 )_
    - 18.4.3 Diffie-Hellman-Merkle Key Agreement (aka Diffie-Hellman or DH) _( … 密码协商协议 )_
    - 18.4.4 Signcryption and Elliptic Curve Cryptography (ECC) _( 签密, 椭圆曲线密码 )_
    - 18.4.5 Key Derivation and Perfect Forward Secrecy (PFS) _( 密码派生, 完全正向保密 )_
    - 18.4.6 Pseudorandom Numbers, Generators, and Function Families _( 伪随机数, …, 函数族 )_
    - 18.4.7 Nonces and Salt _( 随机数与混淆值 )_
    - 18.4.8 Cryptographic Hash Functions and Message Digests _( 加密散列函数, 信息摘要 )_
    - 18.4.9 Message Authentication Codes (MACs, HMAC, CMAC, and GMAC) _( 消息认证码 )_
    - 18.4.10 Cryptographic Suites and Cipher Suites _( 加密套件, 密码套件 )_
- 18.5 Certificates, Certificate Authorities (CAs), and PKIs _( 整数, 整数颁发机构, 公钥基础设施 )_
    - 18.5.1 Public Key Certificates, Certificate Authorities, and X.509 _( 公钥证书, …, … )_
    - 18.5.2 Validating and Revoking Certificates _( 验证, 撤销证书 )_
    - 18.5.3 Attribute Certificates _( 属性证书 )_
- 18.6 TCP/IP Security Protocols and Layering _( 安全协议, … )_
- 18.7 Network Access Control: 802.1X, 802.1AE, EAP, and PANA _( 网络访问控制 )_
    - 18.7.1 EAP Methods and Key Derivation _( … 密码派生 )_
    - 18.7.2 The EAP Re-authentication Protocol (ERP) _( … 重新认证协议 )_
    - 18.7.3 Protocol for Carrying Authentication for Network Access (PANA) _( 网络接入认证信息承载协议 )_
- 18.8 Layer 3 IP Security (IPsec)
    - 18.8.1 Internet Key Exchange (IKEv2) Protocol _( … 密钥交换协议 )_
    - 18.8.2 Authentication Header (AH) _( 认证头部 )_
    - 18.8.3 Encapsulating Security Payload (ESP) _( 封装安全负载 )_
    - 18.8.4 Multicast _( 组播 )_
    - 18.8.5 L2TP/IPsec
    - 18.8.6 IPsec NAT Traversal _( … 穿越 )_
    - 18.8.7 Example
- 18.9 Transport Layer Security (TLS and DTLS) _( 传输层安全 )_
    - 18.9.1 TLS 1.2
    - 18.9.2 TLS with Datagrams (DTLS)
- 18.10 DNS Security (DNSSEC)
    - 18.10.1 DNSSEC Resource Records _( … 资源记录 )_
    - 18.10.2 DNSSEC Operation _( … 运行 )_
    - 18.10.3 Transaction Authentication (TSIG, TKEY, and SIG(0)) _( 事务认证 )_
    - 18.10.4 DNSSEC with DNS64
- 18.11 DomainKeys Identified Mail (DKIM) _( 域名密钥识别邮件 )_
    - 18.11.1 DKIM Signatures
    - 18.11.2 Example
- _18.12 Attacks on Security Protocols_
- _18.13 Summary_
- _18.14 References_

## Ending

- Glossary of Acronyms
- Index
