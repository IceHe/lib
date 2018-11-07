# nslookup

> query Internet name servers interactively

## Options

## Usage

### A Record (default)

```bash
$ nslookup weibo.com
Server:         10.13.8.25
Address:        10.13.8.25#53

Non-authoritative answer:
Name:   weibo.com
Address: 123.125.104.197
Name:   weibo.com
Address: 123.125.104.26
```

### MX Record

```bash
$ nslookup -type=mx weibo.com
Server:         10.13.8.25
Address:        10.13.8.25#53

Non-authoritative answer:
weibo.com       mail exchanger = 10 mx.sina.net.

Authoritative answers can be found from:
weibo.com       nameserver = ns3.sina.com.
weibo.com       nameserver = ns1.sina.com.cn.
weibo.com       nameserver = ns2.sina.com.cn.
weibo.com       nameserver = ns4.sina.com.
weibo.com       nameserver = ns3.sina.com.cn.
weibo.com       nameserver = ns4.sina.com.cn.
mx.sina.net     internet address = 202.108.37.31
ns1.sina.com.cn internet address = 202.106.184.166
ns2.sina.com.cn internet address = 61.172.201.254
ns3.sina.com    internet address = 61.172.201.254
ns3.sina.com.cn internet address = 123.125.29.99
ns4.sina.com    internet address = 123.125.29.99
ns4.sina.com.cn internet address = 121.14.1.22
```

### CNAME Record

```bash
$ nslookup -type=cname weibo.com
Server:         10.13.8.25
Address:        10.13.8.25#53

Non-authoritative answer:
*** Can't find weibo.com: No answer

Authoritative answers can be found from:
weibo.com
        origin = ns1.sina.com.cn
        mail addr = zhihao.staff.sina.com.cn
        serial = 1
        refresh = 28800
        retry = 7200
        expire = 604800
        minimum = 600
```

### Interactive

```bash
$ nslookup
> baidu.com
Server:         10.13.8.25
Address:        10.13.8.25#53

Non-authoritative answer:
Name:   baidu.com
Address: 123.125.115.110
Name:   baidu.com
Address: 220.181.57.216
> sspai.com
Server:         10.13.8.25
Address:        10.13.8.25#53

Non-authoritative answer:
Name:   sspai.com
Address: 119.23.141.248
>
```

Ref : https://blog.csdn.net/mal327/article/details/6401407
