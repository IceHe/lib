# IP (WIP)

## Intranet

Subnet Mask & Wildcard

```bash
# 10.0.0.0 ~ 10.255.255.255
10.0.0.0/8
10.*.*.*

# 172.16.0.0 ~ 172.31.255.255
172.16.0.0/12

# 192.168.0.0 ~ 192.168.255.255
192.168.0.0/16
192.168.*.*
```

## Subnet Mask

|Class|Address|# of Hosts|Netmask (Binary)|Netmask (Decimal)|
|:-:|:-|:-|:-|:-|
|A|/8|16,777,216|11111111 00000000 00000000 00000000|255.0.0.0|
|B|/16|65,534|11111111 11111111 00000000 00000000|255.255.0.0|
|C|/24|256|11111111 11111111 11111111 00000000|255.255.255.0|

Reference

- https://www.iplocation.net/subnet-mask
- Explanation : https://learningnetwork.cisco.com/message/357793#357793

## 127.0.0.1

References

- https://www.pcmag.com/encyclopedia/term/57812/loopback-address
- localhost - Wikipedia : https://en.wikipedia.org/wiki/Localhost
- 百度百科 : https://baike.baidu.com/item/%E6%9C%AC%E5%9C%B0%E5%9B%9E%E7%8E%AF%E5%9C%B0%E5%9D%80

### Differ 127.0.0.1 from localhost

> Well, the most likely difference is that you still **have to do an actual lookup of `localhost` somewhere**.
>
> If you use `127.0.0.1`, then (intelligent) software will just **turn that directly into an IP address and use it**. Some implementations of gethostbyname will detect the dotted format (and presumably the equivalent IPv6 format) and not do a lookup at all.
>
> Otherwise, the name has to be resolved. And there's no guarantee that your hosts file will actually be used for that resolution (first, or at all) so localhost may become a totally different IP address.
>
> By that I mean that, on some systems, a local hosts file can be bypassed. The host.conf file controls this on Linux (and many other Unices).

Reference : https://stackoverflow.com/questions/7382602/what-is-the-difference-between-127-0-0-1-and-localhost

### Multicase & Broadcast

`255.255.255.255`

- 仅内网适用（因为 router 不会转发），仅用于主机配置
