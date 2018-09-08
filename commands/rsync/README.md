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

[commands/rsync/rsync2somewhere.sh](./rsync2somewhere.sh ':include :type=code bash')

### rsyncd.conf

[commands/rsync/rsyncd.conf](./rsyncd.conf ':include :type=code bash')

### rsyncd.secrets

[commands/rsync/rsyncd.secrets](./rsyncd.secrets ':include :type=code bash')
