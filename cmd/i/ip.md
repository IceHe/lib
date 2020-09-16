# ip

> show / manipulate routing, devices, policy routing and tunnels

References

- `man ip`

## Quickstart

```bash
ip addr # List IP addrs assigned to all network interfaces
ip addr show eth0   # List IP addrs assigned to eth0
ip route            # Show table routes
```

## Usage

Common

```bash
$ ip addr
1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000
    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
    inet 127.0.0.1/8 scope host lo
       valid_lft forever preferred_lft forever
2: eth0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc mq state UP group default qlen 1000
    link/ether a4:dc:be:0e:11:bc brd ff:ff:ff:ff:ff:ff
    inet 10.77.120.249/24 brd 10.77.120.255 scope global eth0
       valid_lft forever preferred_lft forever
3: eth1: <BROADCAST,MULTICAST> mtu 1500 qdisc noop state DOWN group default qlen 1000
    link/ether a4:dc:be:0e:11:bd brd ff:ff:ff:ff:ff:ff
4: docker0: <NO-CARRIER,BROADCAST,MULTICAST,UP> mtu 1500 qdisc noqueue state DOWN group default
    link/ether 02:42:1a:6d:37:03 brd ff:ff:ff:ff:ff:ff
    inet 172.17.0.1/16 scope global docker0
       valid_lft forever preferred_lft forever
14679: veth8cb8fa9@if14678: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc noqueue master br-d2430f586d51 state UP group default
    link/ether 46:a5:ff:13:64:d2 brd ff:ff:ff:ff:ff:ff link-netnsid 0
15781: veth454c6b7@if15780: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc noqueue master br-d2430f586d51 state UP group default
    link/ether 7e:60:e9:af:4c:d0 brd ff:ff:ff:ff:ff:ff link-netnsid 1
14305: br-d2430f586d51: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc noqueue state UP group default
    link/ether 02:42:a7:63:b2:46 brd ff:ff:ff:ff:ff:ff
    inet 172.18.0.1/16 brd 172.18.255.255 scope global br-d2430f586d51
       valid_lft forever preferred_lft forever
```

Show eth0

```bash
$ ip addr show eth0
2: eth0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc mq state UP group default qlen 1000
    link/ether a4:dc:be:0e:11:bc brd ff:ff:ff:ff:ff:ff
    inet 10.77.120.249/24 brd 10.77.120.255 scope global eth0
       valid_lft forever preferred_lft forever
```

## Synopsis

```bash
ip [ OPTIONS ] OBJECT { COMMAND | help }
```

```bash
ip [ -force ] -batch filename
```

Ojbects

```bash
OBJECT := { link | address | addrlabel |
        route | rule | neigh | ntable |
        tunnel | tuntap | maddress |
        mroute | mrule | monitor |
        xfrm | netns | l2tp |
        tcp_metrics | token | macsec }
```

Options

```bash
OPTIONS := { -V[ersion] | -h[uman-readable] |
        -s[tatistics] | -d[etails] |
        -r[esolve] | -iec |
        -f[amily] { inet | inet6 | ipx | dnet | link } |
        -4 | -6 | -I | -D | -B | -0 |
        -l[oops] { maximum-addr-flush-attempts } |
        -o[neline] | -rc[vbuf] [size] |
        -t[imestamp] | -ts[hort] |
        -n[etns] name | -a[ll] | -c[olor] }
```

- More : see `man ip`

## Objects

|Object|Description|
|:-|:-|
|**address**|protocol (IP or IPv6) address on a device.|
|addrlabel|label configuration for protocol address selection.|
|l2tp|tunnel ethernet over IP (L2TPv3).|
|link|network device.|
|maddress|multicast address.|
|monitor|watch for netlink messages.|
|mroute|multicast routing cache entry.|
|mrule|rule in multicast routing policy database.|
|neighbour|manage ARP or NDISC cache entries.|
|netns|manage network namespaces.|
|ntable|manage the neighbor cache's operation.|
|route|routing table entry.|
|rule|rule in routing policy database.|
|tcp_metrics<br/>/tcpmetrics|manage TCP Metrics|
|token|manage tokenized interface identifiers.|
|tunnel|tunnel over IP.|
|tuntap|manage TUN/TAP devices.|
|xfrm|manage IPSec policies.|
