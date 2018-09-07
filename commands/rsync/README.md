# Rsync

rysnc

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

[cmds/rsync/rsync2somewhere.sh](../rsync/rsync2somewhere.sh ':include :type=code bash')

### rsyncd.conf

[cmds/rsync/rsyncd.conf](../rsync/rsyncd.conf ':include :type=code bash')

### rsyncd.secrets

[cmds/rsync/rsyncd.secrets](../rsync/rsyncd.secrets ':include :type=code bash')