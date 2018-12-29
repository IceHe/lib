# last

> last, lastb - show listing of last logged in users

## Options

## Usage

- on Linux

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

- on macOS (local)

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