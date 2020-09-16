# last

> last, lastb - show list

References

* `man last`

## Quickstart

```bash
last -10    # List last 10 logged in users
last -10 -w # Display full user & domain names
```

## Intro

`last`

* Last searches back through the file /var/log/wtmp \(or the file designated by the -f flag\) and displays **a list of all users logged in \(and out\)** since that file was created.

`lastb`

* Lastb is the same as last, except that by default it shows a log of the file `/var/log/btmp`, which **contains all the bad login attempts**.

## Options

* `-f file` Tells last to use a specific file instead of

  `/var/log/wtmp`.

* `-num` or This is a count telling last how many lines to show.
* `-n num` The same.
* `-t YYYYMMDDHHMMSS` Display the state of logins as of the specified time.
  * This is useful, e.g., to determine easily who was logged in at a particular time -- specify that time with `-t` and look for "still logged in".
* `-w` Display full user and domain names in the output.

## Usage

### Default

on Linux

```bash
someone1 pts/2        10.222.0.11    Sat Dec 29 14:21   still logged in
another2 pts/1        10.233.0.2     Sat Dec 29 14:21   still logged in
another2 pts/0        10.233.0.2     Sat Dec 29 14:04   still logged in
another2 pts/0        10.233.0.2     Sat Dec 29 11:20 - 11:23  (00:02)
someone1 pts/0        10.222.77.1    Wed Dec 26 22:58 - 02:40  (03:41)
angela5 pts/2        10.222.78.2     Tue Dec 25 21:12 - 22:12  (01:00)
……

wtmp begins Fri Aug 18 12:00:53 2017
```

on macOS

```bash
# on macOS
$ last
icehe  ttys006                   Thu Dec 27 16:13   still logged in
icehe  ttys000                   Wed Dec 26 21:29   still logged in
icehe  console                   Wed Dec 26 21:04   still logged in
reboot    ~                         Wed Dec 26 21:04
shutdown  ~                         Wed Dec 26 21:02
icehe  ttys021                   Wed Dec 26 12:10 - 12:10  (00:00)
……

wtmp begins Thu Nov 30 10:29
```

```bash
$ lastb

btmp begins Tue Dec 18 15:30:00 2018
```

### Number

```bash
$ last -2
# same as
$ last -n 2
# or
$ last -n2
icehe pts/12       10.2.3.4     Thu Jan 10 15:42   still logged in
icehe pts/12       10.2.3.4     Thu Jan 10 14:40 - 15:41  (01:01)
```

### Full Output

* If username is too long, please use option `-w`.

```bash
$ last
icehe-xy pts/12       10.2.3.4     Thu Jan 10 15:42   still logged in
icehe-xy pts/12       10.2.3.4     Thu Jan 10 14:40 - 15:41  (01:01)
icehe-xy pts/12       10.2.3.4     Fri Jan  4 20:20 - 14:07 (5+17:46)
……
```

```bash
$ last -w
icehe-xyz pts/12       10.2.3.4     Thu Jan 10 15:42   still logged in
icehe-xyz pts/12       10.2.3.4     Thu Jan 10 14:40 - 15:41  (01:01)
icehe-xyz pts/12       10.2.3.4     Fri Jan  4 20:20 - 14:07 (5+17:46)
……
```

