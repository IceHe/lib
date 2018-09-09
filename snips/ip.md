# IP

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
