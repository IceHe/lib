# ping

> send ICMP ECHO\_REQUEST to network hosts

References

* `man ping`

## Synopsis

```bash
ping  [-aAbBdDfhLnOqrRUvV46]
    [-c count] [-F flowlabel]
    [-i interval] [-I interface]
    [-l preload] [-m mark]
    [-M pmtud‐isc_option]
    [-N nodeinfo_option]
    [-w deadline] [-W timeout]
    [-p pattern] [-Q tos]
    [-s packetsize] [-S sndbuf]
    [-t ttl] [-T timestamp option]
    [hop ...] destination
```

## Options

* `-4` Use IPv4 only.
* `-6` Use IPv6 only.
* `-c count` Stop after sending count ECHO\_REQUEST packets.
  * With deadline option, ping waits for count ECHO\_REPLY packets, until the timeout expires.
* `-i interval` Wait interval seconds between sending each packet.
  * The default is to wait for one second between each packet normally, or not to wait in flood mode.
  * Only super-user may set interval to values less 0.2 seconds.
* `-t ttl` Set the IP Time to Live
* ……

More : see `man ping`

## Usage

### Default

```bash
ping <URL_or_IP>

# e.g.
$ ping icehe.xyz
PING icehe.coding.me (103.72.146.182) 56(84) bytes of data.
64 bytes from 103.72.146.182 (103.72.146.182): icmp_seq=1 ttl=46 time=39.7 ms
64 bytes from 103.72.146.182 (103.72.146.182): icmp_seq=2 ttl=46 time=39.7 ms
64 bytes from 103.72.146.182 (103.72.146.182): icmp_seq=3 ttl=46 time=39.6 ms
64 bytes from 103.72.146.182 (103.72.146.182): icmp_seq=4 ttl=46 time=39.6 ms
64 bytes from 103.72.146.182 (103.72.146.182): icmp_seq=5 ttl=46 time=39.7 ms
# Stopped by Ctrl + C
^C
--- icehe.coding.me ping statistics ---
5 packets transmitted, 5 received, 0% packet loss, time 4197ms
rtt min/avg/max/mdev = 39.627/39.694/39.747/0.132 ms
```

Host Unreachable

```bash
$ ping 192.168.0.202
PING 192.168.0.202 (192.168.0.202) 56(84) bytes of data.
From 192.168.0.197 icmp_seq=1 Destination Host Unreachable
From 192.168.0.197 icmp_seq=2 Destination Host Unreachable
From 192.168.0.197 icmp_seq=3 Destination Host Unreachable
From 192.168.0.197 icmp_seq=4 Destination Host Unreachable
From 192.168.0.197 icmp_seq=5 Destination Host Unreachable
From 192.168.0.197 icmp_seq=6 Destination Host Unreachable
^C
--- 192.168.0.202 ping statistics ---
7 packets transmitted, 0 received, +6 errors, 100% packet loss, time 6023ms
pipe 4
```

### Custom

Ping 3 times

```bash
ping -c <count> <url>

# e.g.
$ ping -c 3 icehe.xyz
PING icehe.coding.me (103.72.146.182) 56(84) bytes of data.
64 bytes from 103.72.146.182 (103.72.146.182): icmp_seq=1 ttl=46 time=39.7 ms
64 bytes from 103.72.146.182 (103.72.146.182): icmp_seq=2 ttl=46 time=39.6 ms
64 bytes from 103.72.146.182 (103.72.146.182): icmp_seq=3 ttl=46 time=39.6 ms

--- icehe.coding.me ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 2001ms
rtt min/avg/max/mdev = 39.652/39.682/39.735/0.233 ms
```

Interval 2 sec

```bash
ping -i <seconds> <url>
# e.g.
ping -i 2 icehe.xyz
```

TTL 255

```bash
ping -t <TTL> <url>
# e.g.
ping -t 255 icehe.xyz
```

