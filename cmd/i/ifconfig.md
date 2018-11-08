# ifconfig

> configure a network interface

Reference : http://man.linuxde.net/ifconfig

## Usage

### Default

```bash
$ ifconfig
br-d2430f586d51: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 172.18.0.1  netmask 255.255.0.0  broadcast 172.18.255.255
        ether 02:42:a7:63:b2:46  txqueuelen 0  (Ethernet)
        RX packets 0  bytes 0 (0.0 B)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 0  bytes 0 (0.0 B)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

docker0: flags=4099<UP,BROADCAST,MULTICAST>  mtu 1500
        inet 172.17.0.1  netmask 255.255.0.0  broadcast 0.0.0.0
        ether 02:42:1a:6d:37:03  txqueuelen 0  (Ethernet)
        RX packets 2889820582  bytes 396571365166 (369.3 GiB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 2326893965  bytes 1733842037661 (1.5 TiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 10.77.120.249  netmask 255.255.255.0  broadcast 10.77.120.255
        ether a4:dc:be:0e:11:bc  txqueuelen 1000  (Ethernet)
        RX packets 4521001875  bytes 2482722642422 (2.2 TiB)
        RX errors 0  dropped 1  overruns 0  frame 0
        TX packets 4693784378  bytes 807574166904 (752.1 GiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0
        device memory 0x96c00000-96cfffff

lo: flags=73<UP,LOOPBACK,RUNNING>  mtu 65536
        inet 127.0.0.1  netmask 255.0.0.0
        loop  txqueuelen 1000  (Local Loopback)
        RX packets 21821399  bytes 1526075529 (1.4 GiB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 21821399  bytes 1526075529 (1.4 GiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

veth454c6b7: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        ether 7e:60:e9:af:4c:d0  txqueuelen 0  (Ethernet)
        RX packets 34618931  bytes 3811584944 (3.5 GiB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 23833086  bytes 29888867229 (27.8 GiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

veth8cb8fa9: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        ether 46:a5:ff:13:64:d2  txqueuelen 0  (Ethernet)
        RX packets 5478  bytes 1961588 (1.8 MiB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 7430  bytes 39069447 (37.2 MiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0
```

### Show eth0

```bash
$ ifconfig eth0
eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 10.77.120.249  netmask 255.255.255.0  broadcast 10.77.120.255
        ether a4:dc:be:0e:11:bc  txqueuelen 1000  (Ethernet)
        RX packets 4521010864  bytes 2482723479238 (2.2 TiB)
        RX errors 0  dropped 1  overruns 0  frame 0
        TX packets 4693797291  bytes 807575307414 (752.1 GiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0
        device memory 0x96c00000-96cfffff
```

### ON / OFF

```bash
# ON
$ ifconfig eth0 up
# OFF
$ ifconfig eth0 down
```

#### ARP

```bash
# 开启网卡 eth0 的 ARP 协议
ifconfig eth0 arp
# 关闭网卡 eth0 的 ARP 协议
ifconfig eth0 -arp
```

### MTU

Max Transmission Unit : 最大传输单元

```bash
# 设置能通过的最大数据包大小为 1500 bytes
ifconfig eth0 mtu 1500
```

## Synopsis

Ifconfig  is used to configure the kernel-resident network interfaces.

```bash
ifconfig [-v] [-a] [-s] [interface]
ifconfig [-v] interface [aftype] options | address ...
```

NOTE

- This program is obsolete!
- For replacement check ip addr and ip link.
- For statistics use ip -s link.

## Options

- `-a` Display all interfaces which are currently available, even if down
- `-s` Display a short list (like netstat -i)
- `-v` Be more verbose for some error conditions
- `interface` The name of the interface.
    - This is usually a driver name followed by a unit number, for example **eth0 for the first Ethernet interface**.
    - If your kernel supports alias interfaces, you can specify them with **eth0:0 for the first alias of eth0**.
    - You can use them to assign a second address.
    - To delete an alias interface use `ifconfig eth0:0 down`.
    - Note: for every scope (i.e. same net with address/netmask combination) all aliases are deleted, if you delete the first (primary).
- **`up`** This flag causes the interface to be **activated**.
    - It is implicitly specified if an address is assigned to the interface.
- **`down`** This flag causes the driver for this interface to be **shut down**.
- `[-]arp` Enable or disable the use of the ARP protocol on this interface.
- `mtu N` This parameter sets the Maximum Transfer Unit (MTU) of an interface.
- `add addr/prefixlen` Add an IPv6 address to an interface.
- `del addr/prefixlen` Remove an IPv6 address from an interface.
- ……

More : see `man ifconfig`
