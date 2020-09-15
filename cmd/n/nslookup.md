# nslookup

> query Internet name servers interactively

References

- `man nslookup`

Synopsis

```bash
nslookup [-option] [name | -] [server]
```

Options

- See `man nslookup`

## Usage

### A (default)

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

### MX

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

### CNAME

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

## Records

References

- Wikipedia : https://en.wikipedia.org/wiki/List_of_DNS_record_types
- DNS Record Viewer : http://dns-record-viewer.online-domain-tools.com/
- _bluehost_ : https://my.bluehost.com/hosting/help/508

|Record|Description|
|:-|:-|
|CNAME|别名，用于将多个域名绑定到同一个IP地址上|
|A|将域名或者子域名转换为一个32位的IP地址，也可以存储其他有价值的信息|
|MX|将域名绑定到邮件服务器上|

### A

Address record

- The record A specifies IP address (IPv4) for given host.
- A records are used for conversion of domain names to corresponding IP addresses.

### AAAA

IPv6 address record

- The record AAAA (also quad-A record) specifies IPv6 address for given host.
- So it works the same way as the A record and the difference is the type of IP address.

### CNAME

Canonical Name record

- The CNAME record specifies a domain name that has to be queried in order to resolve the original DNS query.
- Therefore CNAME records are used for creating aliases of domain names.
- CNAME records are truly useful when we want to alias our domain to an external domain.
- In other cases we can remove CNAME records and replace them with A records and even decrease performance overhead.
- 个人经验：用于设置子域名

### MX

Mail exchanger record

- Maps a domain name to a list of message transfer agents for that domain
    - The MX resource record specifies a mail exchange server for a DNS domain name.
    - The information is used by Simple Mail Transfer Protocol (SMTP) to route emails to proper hosts.
    - Typically, there are more than one mail exchange server for a DNS domain and each of them have set priority.

### NS

Name server record

- Delegates a DNS zone to use the given authoritative name servers
    - A **DNS zone** is any distinct, contiguous portion of the domain name space in the Domain Name System (DNS) for which administrative responsibility has been delegated to a single manager.
    - An **authoritative name server** is a name server that gives answers in response to questions asked about names in a DNS zone.

### TXT

Text record

- Originally for arbitrary human-readable text in a DNS record.
- Since the early 1990s, however, this record more often carries machine-readable data, such as specified by RFC 1464, opportunistic encryption, Sender Policy Framework, DKIM, DMARC, DNS-SD, etc.

### SRV

Service locator

- Generalized service location record, used for newer protocols instead of creating protocol-specific records such as MX.
    - An SRV (Service) record points one domain to another domain name using a specific destination port.
    - SRV records allow specific services, such as VOIP or IM, to be be directed to a separate location.
