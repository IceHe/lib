# lsof

> list open files

References

* `man lsof`
* 15 Linux lsof Command Examples \(Identify Open Files\) : [https://www.thegeekstuff.com/2012/08/lsof-command-examples/](https://www.thegeekstuff.com/2012/08/lsof-command-examples/)

## Quickstart

```bash
# Default
lsof            # List all open files

# Port
lsof -i:port    # List processes which used a specified port
## e.g.
lsof -i:3000        # specified port 3000
lsof -i:3000-4000   # port range from 3000 to 4000

# File
lsof file       # List processes which opened specified file
lsof dir        # List processes which opened specified dir

# Directory
lsof +D dir     # List opened files under a specified dir

# Process
lsof -p pid     # List files opened by a specified process
lsof -c cmd_pf  # List files opened by a process executing a command
                #   that begins with 'cmd_pf' (command prefix)
## e.g.
lsof -p 541
lsof -p dockerd
lsof -p `pidof dockerd`
lsof -c nginx

# User
lsof -u username    # List files opened by a specified user

# Combine selection
# -a : causes list selection options to be ANDed
## e.g.
lsof -a -u icehe -c vim
sudo lsof -a -u root -c rsyslogd
```

## Options

* `-i [i]` Selects the listing of files any of whose Internet address matches the address specified in i.
* `-t` Specifies that lsof should produce terse output with process identifiers only and no header.
  * e.g., so that the output may be piped to `kill`.
  * `-t` selects the -w option.
* `+|-w` Enables \(+\) or disables \(-\) the suppression of warning messages.
* `-a` Causes list selections options to be ANDed.
  * e.g., specifying -a, -U, and -ufoo produces a listing of only

     UNIX socket files that belong to processes owned by user "foo".

## Usage

### Network Connection

An Internet address is specified in the form : \( Items in square brackets "\[\]" are optional. \)

```bash
ls -i [46][protocol][@hostname|hostaddr][:service|port]
```

* **hostname** is an Internet host name.
  * Unless a specific IP version is specified, open network files associated with host names of all versions will be selected.
* **hostaddr** is a numeric Internet IPv4 address in dot form;
  * or an IPv6 numeric address in colon form, enclosed in brackets, if the UNIX dialect supports IPv6.
  * When an IP version is selected, only its numeric addresses may be specified.
* **service** is an /etc/services name. e.g., smtp or a list of them.
* **port** is a port number, or a list of them.

Here are some sample addresses:

* `-i6` : IPv6 only
* `TCP:25` : TCP and port 25
* `@1.2.3.4` : Internet IPv4 host address 1.2.3.4
* `@[3ffe:1ebc::1]:1234` : Internet IPv6 host address

    3ffe:1ebc::1, port 1234

* `UDP:who` - UDP who service port
* `TCP@lsof.itap:513` : TCP, port 513 and host name lsof.itap
* `tcp@foo:1-10,smtp,99` : TCP, ports 1 through 10,

    service name smtp, port 99, host name foo

* `tcp@bar:1-smtp` : TCP, ports 1 through smtp, host bar
* `:time` : Either TCP, UDP or UDPLITE time service port

List all network connections

```bash
# all
lsof -i

# only IPv4
lsof -i4

# only IPv6
lsof -i6

# TCP
lsof -i tcp

# UDP
lsof -i udp

# TCP Range
$ lsof -i:3000-4000
COMMAND   PID  USER FD  TYPE             DEVICE SIZE/OFF NODE NAME
nginx   66394 icehe 12u IPv4 0x851262b2d39c6f85      0t0  TCP *:hbci (LISTEN)
nginx   66394 icehe 13u IPv4 0x851262b2d39c78e5      0t0  TCP *:terabase (LISTEN)
nginx   66410 icehe 12u IPv4 0x851262b2d39c6f85      0t0  TCP *:hbci (LISTEN)
nginx   66410 icehe 13u IPv4 0x851262b2d39c78e5      0t0  TCP *:terabase (LISTEN)
```

### File

List processes which opened a specified file

```bash
lsof <path/to/file>

# e.g.
$ lsof /etc/localtime
COMMAND   PID   USER  FD   TYPE DEVICE SIZE/OFF   NODE NAME
java    10097  icehe mem    REG    8,1      388 263109 /etc/../usr/share/zoneinfo/Asia/Shanghai
```

### Directory

List opened files under a directory

```bash
lsof +D <path/to/directory>

# e.g.
$ lsof +D /etc
lsof +D /etc
COMMAND   PID USER   FD   TYPE DEVICE SIZE/OFF NODE NAME
systemd-u 546 root  mem    REG    8,3  6345977  455 /etc/udev/hwdb.bin
systemd-u 546 root   11r   REG    8,3  6345977  455 /etc/udev/hwdb.bin
……
```

### Process

List files opened by a specified process

```bash
lsof -p <process_id>

# e.g.
$ pidof dockerd
12037

$ lsof -p `pidof dockerd`
COMMAND   PID USER  FD  TYPE DEVICE SIZE/OFF      NODE NAME
dockerd 12037 root cwd   DIR    8,1     4096      5705 /usr/home/icehe
dockerd 12037 root rtd   DIR    8,3     4096         2 /
dockerd 12037 root txt   REG    8,1 39941680    531592 /usr/bin/dockerd
dockerd 12037 root mem-  REG    8,7    65536  12451859 /data0/docker-1.13.1-fs/volumes/metadata.db
dockerd 12037 root   0u  CHR  136,0      0t0         3 /dev/pts/0 (deleted)
……
```

List files opened by processes executing a command that begins with 'command\_prefix'

```bash
lsof -c <command_prefix>

# e.g.
$ lsof -c java
COMMAND   PID  USER  FD TYPE DEVICE SIZE/OFF      NODE NAME
java    10097 icehe cwd  DIR   0,36     4096 516503227 /zookeeper-3.4.13
java    10097 icehe rtd  DIR   0,36     4096 516503173 /
java    10097 icehe txt  REG    8,7     6240  13380993 /usr/lib/jvm/java-1.8-openjdk/jre/bin/java
java    10097 icehe mem  REG    8,7           13381075 /usr/lib/jvm/java-1.8-openjdk/jre/lib/jsse.jar (stat: No such file or directory)
……
```

### User

List files opened by a specified user

```bash
lsof -u <username>

# e.g.
$ lsof -u icehe
COMMAND   PID  USER  FD TYPE DEVICE SIZE/OFF      NODE NAME
sshd    10843 icehe cwd  DIR    8,3     4096         2 /
sshd    10843 icehe rtd  DIR    8,3     4096         2 /
sshd    10843 icehe txt  REG    8,1  2904586      5273 /usr/local/sbin/sshd
sshd    10843 icehe DEL  REG    0,4          502158159 /dev/zero
sshd    10843 icehe mem  REG    8,1    37152    142746 /usr/lib64/libnss_sss.so.2
……
```

### Kill Process

Kill all process that belongs to a particular user

```bash
kill `lsof -t -u <username>`

# e.g.
$ lsof -t -u icehe
10843
10844
11178
11179
12805
12806

$ kill -9 `lsof -t -u icehe`
```

### Combine Selection

List files:

* opened by a specified user
* based on processes executing a command that begins with 'command\_prefix'

```bash
lsof -u <username> -c <command_prefix> -a

# e.g.
$ lsof -u icehe -c java -a
COMMAND   PID  USER  FD TYPE DEVICE SIZE/OFF      NODE NAME
java    10097 icehe cwd  DIR   0,36     4096 516503227 /zookeeper-3.4.13
java    10097 icehe rtd  DIR   0,36     4096 516503173 /
java    10097 icehe txt  REG    8,7     6240  13380993 /usr/lib/jvm/java-1.8-openjdk/jre/bin/java
……
```

List files:

* opened by a specified user
* TCP connections
* based on process names starting with

```bash
lsof -u <username> -i <TCP|UDP> -c <process_name_prefix> -a

# e.g.
$ lsof -u root -i TCP -c java -a
COMMAND   PID USER FD  TYPE    DEVICE SIZE/OFF NODE NAME
java    11879 root  8u IPv4 521506573      0t0  TCP localhost:42649 (LISTEN)
java    11879 root 18u IPv4 521499336      0t0  TCP localhost:42649->localhost:36218 (ESTABLISHED)
java    12017 root  6u IPv4 521510870      0t0  TCP localhost:36218->localhost:42649 (ESTABLISHED)
……
```

## Display

List all open files

```bash
$ lsof
COMMAND    PID  USER   FD TYPE DEVICE SIZE/OFF    NODE NAME
init       1    root  cwd  DIR    8,1     4096      2 /
init       1    root  txt  REG    8,1   124704 917562 /sbin/init
init       1    root   0u  CHR    1,3      0t0   4369 /dev/null
init       1    root   1u  CHR    1,3      0t0   4369 /dev/null
init       1    root   2u  CHR    1,3      0t0   4369 /dev/null
init       1    root   3r FIFO    0,8      0t0   6323 pipe
……
loginwind  107 icehe  cwd  DIR    1,4     1056       2 /
loginwind  107 icehe  txt  REG    1,4 26771408 3812344 /usr/share/icu/icudt59l.dat
……
```

### File Descriptions

FD is the File Descriptor number of the file or:

* **cwd** : current working directory;
* Lnn : library references \(AIX\);
* err : FD information error \(see NAME column\);
* jld : jail directory \(FreeBSD\);
* ltx : shared library text \(code and data\);
* Mxx : hex memory-mapped type number xx.
* m86 : DOS Merge mapped file;
* **mem** : memory-mapped file;
* **mmap** : memory-mapped device;
* **pd**  : parent directory;
* **rtd** : root directory;
* tr  : kernel trace file \(OpenBSD\);
* **txt** : program text \(code and data\);
* v86 : VP/ix mapped file;
* **NUMBER** : Represent the actual file descriptor.
  * The character after the number i.e. `1u`, represents the mode in which the file is opened.
    * **r** for read
    * **w** for write
    * **u** for read and write

TYPE – Specifies the type of the file. Some of the values of TYPEs are,

* REG : Regular File
* DIR : Directory
* FIFO : First In First Out
* CHR : Character special file

For a complete list of FD & TYPE, refer man lsof.

