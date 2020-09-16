# dig

> DNS lookup utility

References

- `man dig`

## Quickstart

```bash
dig icehe.xyz           # Lookup DNS info of a domain (?)
dig +short icehe.xyz    # Only show IPs & CNAMEs (?)
```

## Synopsis

```bash
dig [@server] [-b address] [-c class]
    [-f filename] [-k filename] [-m] [-p port#]
    [-q name] [-t type] [-x addr] [-y [hmac:]name:key]
    [-4] [-6] [name] [type] [class] [queryopt...]
```

```bash
dig [global-queryopt...] [query...]
```

Options & More : see `man dig`

## Description

- `dig` (**domain information groper**) is a flexible tool for interrogating DNS name servers.
- It performs DNS lookups and displays the answers that are returned from the name server(s) that were queried.
- Most DNS administrators use dig to troubleshoot DNS problems because of its flexibility, ease of use and clarity of output.
- Other lookup tools tend to have less functionality than `dig`.

## Query Options

- `+[no]short` Provide a terse answer.
    - The default is to print the answer in a verbose form.
- `+[no]trace` Toggle tracing of the delegation path from the root name servers for the name being looked up.
    - Tracing is disabled by default.
    - When tracing is enabled, dig makes iterative queries to resolve the name being looked up.
    - It will follow referrals from the root servers, showing the answer from each server that was used to resolve the lookup.
    - `+dnssec` is also set when +trace is set to better emulate the default queries from a nameserver.
- ……

## Usage

DNS Records : see [nslookup](/cmd/n/nslookup.md#Records)

### Default

```bash
$ dig weibo.com

; <<>> DiG 9.9.4-RedHat-9.9.4-18.el7 <<>> weibo.com
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 38359
;; flags: qr rd ra; QUERY: 1, ANSWER: 2, AUTHORITY: 6, ADDITIONAL: 7

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;weibo.com.                     IN      A

;; ANSWER SECTION:
weibo.com.              59      IN      A       123.125.104.26
weibo.com.              59      IN      A       123.125.104.197

;; AUTHORITY SECTION:
weibo.com.              86409   IN      NS      ns1.sina.com.cn.
weibo.com.              86409   IN      NS      ns4.sina.com.cn.
weibo.com.              86409   IN      NS      ns3.sina.com.
weibo.com.              86409   IN      NS      ns3.sina.com.cn.
weibo.com.              86409   IN      NS      ns4.sina.com.
weibo.com.              86409   IN      NS      ns2.sina.com.cn.

;; ADDITIONAL SECTION:
ns1.sina.com.cn.        55674   IN      A       202.106.184.166
ns2.sina.com.cn.        55674   IN      A       61.172.201.254
ns3.sina.com.           55678   IN      A       61.172.201.254
ns3.sina.com.cn.        55663   IN      A       123.125.29.99
ns4.sina.com.           55678   IN      A       123.125.29.99
ns4.sina.com.cn.        55675   IN      A       121.14.1.22

;; Query time: 0 msec
;; SERVER: 10.13.8.25#53(10.13.8.25)
;; WHEN: Wed Nov 07 20:51:47 CST 2018
;; MSG SIZE  rcvd: 290
```

- QUESTION SECTION : 提问，查询的域名
- ANSWER SECTION  : 答案，查询到的域名对应的 IP
- AUTHORITY SECTION : 直接提供这个域名解析的 DNS 服务器，不包括更高级 DNS 服务器
- ADDITIONAL SECTION : 直接提供解析的服务器的 IP 地址

最后是一些统计信息，其中 SERVER 指的是直接为你服务的本地 DNS 服务器的 IP。

### Short

```bash
$ dig +short weibo.com
123.125.104.197
123.125.104.26
```

### Trace

```bash
$ dig +trace baidu.com

; <<>> DiG 9.9.4-RedHat-9.9.4-18.el7 <<>> +trace baidu.com
;; global options: +cmd
.           518410  IN  NS  f.root-servers.net.
.           518410  IN  NS  g.root-servers.net.
.           518410  IN  NS  k.root-servers.net.
.           518410  IN  NS  d.root-servers.net.
.           518410  IN  NS  b.root-servers.net.
.           518410  IN  NS  l.root-servers.net.
.           518410  IN  NS  j.root-servers.net.
.           518410  IN  NS  i.root-servers.net.
.           518410  IN  NS  c.root-servers.net.
.           518410  IN  NS  a.root-servers.net.
.           518410  IN  NS  m.root-servers.net.
.           518410  IN  NS  h.root-servers.net.
.           518410  IN  NS  e.root-servers.net.
.           518410  IN  RRSIG   NS 8 0 518400 20181120050000 20181107040000 2134 . Np3RvppFEuYVNCJJIPBVV0MEWJf5BYaWh3cW85bg2RmXkkgSgkRSQG+H xL228jJONP/kIn/HJfr8kjufCMatXUTxFz2OVw5GQvemO32pBoIiywCm B+PO4lBDv4kMnmjm/GZ+sREJQ9Pq5/1kY0CKEPxfA+LkPPHSmnL6uOfr jatf1G8adJT7jpImoIfFg5y9CRlnU2RIQD5Xb1117o9HLUXS74osaHln 3d7s6/bxhPUdEkJSLfLBD2KbUOmFFd1uHJt/cywJClviRKgxjEySvMTZ 8ydBPSARLRlVi3NxHnvjDKxNcRP3kExSg5RRMhHG1lOhL025R2QisuBM VJQBJw==
;; Received 1097 bytes from 10.13.8.25#53(10.13.8.25) in 354 ms

com.            172800  IN  NS  a.gtld-servers.net.
com.            172800  IN  NS  b.gtld-servers.net.
com.            172800  IN  NS  c.gtld-servers.net.
com.            172800  IN  NS  d.gtld-servers.net.
com.            172800  IN  NS  e.gtld-servers.net.
com.            172800  IN  NS  f.gtld-servers.net.
com.            172800  IN  NS  g.gtld-servers.net.
com.            172800  IN  NS  h.gtld-servers.net.
com.            172800  IN  NS  i.gtld-servers.net.
com.            172800  IN  NS  j.gtld-servers.net.
com.            172800  IN  NS  k.gtld-servers.net.
com.            172800  IN  NS  l.gtld-servers.net.
com.            172800  IN  NS  m.gtld-servers.net.
com.            86400   IN  DS  30909 8 2 E2D3C916F6DEEAC73294E8268FB5885044A833FC5459588F4A9184CF C41A5766
com.            86400   IN  RRSIG   DS 8 1 86400 20181120050000 20181107040000 2134 . Er9lNB5rWnxE+9U1xUQO0k1dUzYl8qRohZF9FCXhg8mvd6F50q6w4peu 9ASYfAyu4ead4pY01pd83GEYK3iJRbTQq16hDgib5TESxna1xfvb+uJU xvM7gY3rAQYQM99b0InOdfAV50TkSUxW8WAT+kxKw6oDuazW44x8nKYW QgBP8EHbcPo60IG0kwajHnTpDR9yi8+/sPgJImMXPv7seJB7ZwXRBRBq 3F88ZE2o6jsEo7qMVkOQisD/u4cheZSqVTJ4IlVyPMPm3794U2L2TlQv sAXpVCGyrnGdgWgKJXK9rkamb2sxcBa6YnICeuz0r8t+P81QHto8DIOw zha/7g==
;; Received 1169 bytes from 199.7.91.13#53(d.root-servers.net) in 1234 ms

baidu.com.      172800  IN  NS  dns.baidu.com.
baidu.com.      172800  IN  NS  ns2.baidu.com.
baidu.com.      172800  IN  NS  ns3.baidu.com.
baidu.com.      172800  IN  NS  ns4.baidu.com.
baidu.com.      172800  IN  NS  ns7.baidu.com.
CK0POJMG874LJREF7EFN8430QVIT8BSM.com. 86400 IN NSEC3 1 1 0 - CK0Q1GIN43N1ARRC9OSM6QPQR81H5M9A NS SOA RRSIG DNSKEY NSEC3PARAM
CK0POJMG874LJREF7EFN8430QVIT8BSM.com. 86400 IN RRSIG NSEC3 8 2 86400 20181112054214 20181105043214 37490 com. VtU+mR9c9/KMSBR8+8jD4tBuYVI02LgCM0l6ajfg0IFDAqgk4pvkQeeu PUolFBvqUhq/skdRtlUSE2SLBl7NqXFu2gzeW+BGQ7qeW/H/C3S2xQfY y+vrQvZXtTGTDRSQ7iKbs+p60HkpC6yW1yO5ZkbB53GLVRmjQDGCRm0i STM=
HPVV2B5N85O7HJJRB7690IB5UVF9O9UA.com. 86400 IN NSEC3 1 1 0 - HPVVP23QUO0FP9R0A04URSICJPESKO9J NS DS RRSIG
HPVV2B5N85O7HJJRB7690IB5UVF9O9UA.com. 86400 IN RRSIG NSEC3 8 2 86400 20181114061505 20181107050505 37490 com. MfshCtX0e/9dTG4aADLEO/qU2mDpHP0/PLuP+FwCvmXMq7SszE3Uqd9i EcM3MeBJDwWSu1tx8pOtUrtB+ME+5hvnosY5lqEdKqkfHtWamITT8125 WSP2cu6UQuxaV5BlB4iLptz6TcW4fpIv3LIWwuiXUQreun61keWPu1Fv uh8=
;; Received 693 bytes from 192.52.178.30#53(k.gtld-servers.net) in 281 ms

baidu.com.      600 IN  A   220.181.57.216
baidu.com.      600 IN  A   123.125.115.110
baidu.com.      86400   IN  NS  ns2.baidu.com.
baidu.com.      86400   IN  NS  ns4.baidu.com.
baidu.com.      86400   IN  NS  ns7.baidu.com.
baidu.com.      86400   IN  NS  ns3.baidu.com.
baidu.com.      86400   IN  NS  dns.baidu.com.
;; Received 240 bytes from 220.181.37.10#53(ns3.baidu.com) in 2 ms

```
