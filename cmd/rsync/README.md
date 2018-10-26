# Rsync

rysnc

- On Linux

> a fast, versatile, remote (and local) file-copying tool

- On BSD

> faster, flexible replacement for rcp

rcp

> remote file copy

- Quickstart : http://transamrit.net/docs/rsync/
- Exit Codes : https://lxadm.com/Rsync_exit_codes

## Usage

- Put [rsyncd.conf](#rsyncdconf) in directory `/etc/`
- Usually put [rsyncd.secrets](#rsyncdsecrets) in directory `/etc/` on remote server
- Put [rsyncd.secrets](#rsyncdsecrets) in directory you like on local machine
- Run [rsync_to_somewhere.sh](#rsync2somewheresh) on local machine

## Files

### rsync2somewhere.sh

[commands/rsync/rsync2somewhere.sh](./rsync2somewhere.sh ':include :type=code bash')

### rsyncd.conf

[commands/rsync/rsyncd.conf](./rsyncd.conf ':include :type=code bash')

### rsyncd.secrets

[commands/rsync/rsyncd.secrets](./rsyncd.secrets ':include :type=code bash')

## Exit Codes

|Code|Meaning|
|:-|:-|
|0|Success|
|1|Syntax or usage error|
|2|Protocol incompatibility|
|3|Errors selecting input/output files, dirs|
|4|Requested  action not supported: an attempt was made to manipulate 64-bit files on a platform that cannot support them; or an option was specified that is supported by the client and not by the server.|
|5|Error starting client-server protocol|
|6|Daemon unable to append to log-file|
|10|Error in socket I/O|
|11|Error in file I/O|
|12|Error in rsync protocol data stream|
|13|Errors with program diagnostics|
|14|Error in IPC code|
|20|Received SIGUSR1 or SIGINT|
|21|Some error returned by waitpid()|
|22|Error allocating core memory buffers|
|23|Partial transfer due to error|
|24|Partial transfer due to vanished source files|
|25|The --max-delete limit stopped deletions|
|30|Timeout in data send/receive|
|35|Timeout waiting for daemon connection|
|127|You don't even have rsync binary installed on your system.|
|255|Sync just passed exit code from a command it used to connect - typically SSH|
