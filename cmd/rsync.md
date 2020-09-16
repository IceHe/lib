# Rsync

`rsync`

* On Linux

> a fast, versatile, remote \(and local\) file-copying tool

* On BSD

> faster, flexible replacement for rcp

`rcp`

> remote file copy

* Quickstart : [http://transamrit.net/docs/rsync/](http://transamrit.net/docs/rsync/)
* Rsync cheatsheet : [https://devhints.io/rsync](https://devhints.io/rsync)
* Exit Codes : [https://lxadm.com/Rsync\_exit\_codes](https://lxadm.com/Rsync_exit_codes)
* **Explaination** : [https://explainshell.com/explain?cmd=rsync+-chavzP+--stats+user%40remote.host%3A%2Fpath%2Fto%2Fcopy+%2Fpath%2Fto%2Flocal%2Fstorage](https://explainshell.com/explain?cmd=rsync+-chavzP+--stats+user%40remote.host%3A%2Fpath%2Fto%2Fcopy+%2Fpath%2Fto%2Flocal%2Fstorage)

```bash
rsync -chavzP --stats user@remote.host:/path/to/copy /path/to/local/storage
```

References

* `man rsync`

## Usage

* Put [rsyncd.conf](rsync.md#rsyncdconf) in directory `/etc/`
* Usually put [rsyncd.secrets](rsync.md#rsyncdsecrets) in directory `/etc/` on remote server
* Put [rsyncd.secrets](rsync.md#rsyncdsecrets) in directory you like on local machine
* Run [rsync\_to\_somewhere.sh](rsync.md#rsync2somewheresh) on local machine

## Files

### rsync2somewhere.sh

[rsync2somewhere.sh](https://github.com/IceHe/lib/tree/4e6b7c73229e0e23ff9d6acf7f2ba61d9dacec30/cmd/rsync/rsync2somewhere.sh)

### rsyncd.conf

[rsyncd.conf](https://github.com/IceHe/lib/tree/4e6b7c73229e0e23ff9d6acf7f2ba61d9dacec30/cmd/rsync/rsyncd.conf)

### rsyncd.secrets

[rsyncd.secrets](https://github.com/IceHe/lib/tree/4e6b7c73229e0e23ff9d6acf7f2ba61d9dacec30/cmd/rsync/rsyncd.secrets)

## Exit Codes

| Code | Meaning |
| :--- | :--- |
| 0 | Success |
| 1 | Syntax or usage error |
| 2 | Protocol incompatibility |
| 3 | Errors selecting input/output files, dirs |
| 4 | Requested  action not supported: an attempt was made to manipulate 64-bit files on a platform that cannot support them; or an option was specified that is supported by the client and not by the server. |
| 5 | Error starting client-server protocol |
| 6 | Daemon unable to append to log-file |
| 10 | Error in socket I/O |
| 11 | Error in file I/O |
| 12 | Error in rsync protocol data stream |
| 13 | Errors with program diagnostics |
| 14 | Error in IPC code |
| 20 | Received SIGUSR1 or SIGINT |
| 21 | Some error returned by waitpid\(\) |
| 22 | Error allocating core memory buffers |
| 23 | Partial transfer due to error |
| 24 | Partial transfer due to vanished source files |
| 25 | The --max-delete limit stopped deletions |
| 30 | Timeout in data send/receive |
| 35 | Timeout waiting for daemon connection |
| 127 | You don't even have rsync binary installed on your system. |
| 255 | Sync just passed exit code from a command it used to connect - typically SSH |

