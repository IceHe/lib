# iftop

display bandwidth usage on an interface by host

---

- It listens to network traffic on a named interface, or on the first interface it can find which looks like an external interface if none is specified, and displays a table of current bandwidth usage by pairs of hosts.
- It must be run with sufficient permissions to monitor all network traffic on the interface.
- See `man iftop` for more.
    - Option `-B` : Display bandwidth rates in **bytes/sec** rather than **bits/sec**.
    - ……
- Recommend to use [`dstat`](/cmd/d/dstat.md).

References

- `man iftop`
