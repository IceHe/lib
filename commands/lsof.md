# lsof

> list open files

## Options

- `-i [i]` Selects the listing of files any of whose Internet address matches the address specified in i .

## Usage

### Network Connection

An Internet address is specified in the form : ( Items in square brackets are optional. )

```bash
ls -i [46][protocol][@hostname|hostaddr][:service|port]
```

- **hostname** is an Internet host name.
    - Unless a specific IP version is specified, open network files associated with host names of all versions will be selected.
- **hostaddr** is a numeric Internet IPv4 address in dot form;
    - or an IPv6 numeric address in colon form, enclosed in brackets, if the UNIX dialect supports IPv6.
    - When an IP version is selected, only its numeric addresses may be specified.
- **service** is an /etc/services name. e.g., smtp or a list of them.
- **port** is a port number, or a list of them.

Here are some sample addresses:

- `-i6` IPv6 only
- `TCP:25` TCP and port 25
- `@1.2.3.4` - Internet IPv4 host address 1.2.3.4
- `@[3ffe:1ebc::1]:1234` - Internet IPv6 host address
    3ffe:1ebc::1, port 1234
- `UDP:who` - UDP who service port
- `TCP@lsof.itap:513` - TCP, port 513 and host name lsof.itap
- `tcp@foo:1-10,smtp,99` - TCP, ports 1 through 10,
    service name smtp, port 99, host name foo
- `tcp@bar:1-smtp` - TCP, ports 1 through smtp, host bar
- `:time` - either TCP, UDP or UDPLITE time service port

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
```

### Others

List all open files

```bash
lsof
# output e.g.
COMMAND    PID  USER   FD TYPE DEVICE SIZE/OFF    NODE NAME
loginwind  107 icehe  cwd  DIR    1,4     1056       2 /
loginwind  107 icehe  txt  REG    1,4  1259472 3456550 /System/Library/CoreServices/loginwindow.app/Contents/MacOS/loginwindow
loginwind  107 icehe  txt  REG    1,4 26771408 3812344 /usr/share/icu/icudt59l.dat
loginwind  107 icehe  txt  REG    1,4   115856 3600205 /System/Library/LoginPlugins/DisplayServices.loginPlugin/Contents/MacOS/DisplayServices
loginwind  107 icehe  txt  REG    1,4   114224 3600256 /System/Library/LoginPlugins/FSDisconnect.loginPlugin/Contents/MacOS/FSDisconnect
loginwind  107 icehe  txt  REG    1,4   236208 3903424 /private/var/db/timezone/tz/2018e.1.0/icutz/icutz44l.dat
……
```

FD is the File Descriptor number of the file or:

- **cwd** : current working directory;
- Lnn : library references (AIX);
- err : FD information error (see NAME column);
- jld : jail directory (FreeBSD);
- ltx : shared library text (code and data);
- Mxx : hex memory-mapped type number xx.
- m86 : DOS Merge mapped file;
- **mem** : memory-mapped file;
- **mmap** : memory-mapped device;
- **pd**  : parent directory;
- **rtd** : root directory;
- tr  : kernel trace file (OpenBSD);
- **txt** : program text (code and data);
- v86 : VP/ix mapped file;
- **NUMBER** : Represent the actual file descriptor.
    - The character after the number i.e. `1u`, represents the mode in which the file is opened.
        - **r** for read
        - **w** for write
        - **u** for read and write

TYPE – Specifies the type of the file. Some of the values of TYPEs are,

- REG : Regular File
- DIR : Directory
- FIFO : First In First Out
- CHR : Character special file

For a complete list of FD & TYPE, refer man lsof.

---

List processes which opened a specific file

```bash
lsof <path/to/file>
```

List opened files under a directory

```bash
lsof <path/to/directory>
```

List all open files by a specific process

```bash
lsof -p <process_id>
```

List files opened by a specific user

```bash
lsof -u <username>
```

FD – Represents the file descriptor. Some of the values of FDs are,

- cwd – Current Working Directory
- txt – Text file
- mem – Memory mapped file
- mmap – Memory mapped device
- NUMBER – Represent the actual file descriptor. The character after the number i.e ‘1u’, represents the mode in which the file is opened. r for read, w for write, u for read and write.

15 examples (better, more practical)

https://www.thegeekstuff.com/2012/08/lsof-command-examples/

10 examples

https://www.tecmint.com/10-lsof-command-examples-in-linux/
