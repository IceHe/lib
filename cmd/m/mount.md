# mount

> mount a filesystem

## Quickstart

```bash
# Standard Form #

## Tell the kernel to attach the filesystem found on device
## (which is of type type) at the directory dir.
mount -t type device dir

# Common Options #

## Mount the filesystem read-only.
-r, --read-only
## A synonym is
-o ro

## Mount the filesystem read/write. ( default )
-w, --rw, --read-write
## A synonym is
-o rw
```

## Config Files

- /etc/fstab : filesystem table
- /etc/mtab : table of mounted filesystems
- /etc/mtab~ : lock file
- /etc/mtab.tmp : temporary file
- /etc/filesystems : a list of filesystem types to try

# umount

> unmount a filesystem

## Quickstart

```bash
# Unmount by name
umount -v /dev/sda1
## output
/dev/sda1 umounted

# Unmount by mountpoint ( directory )
umount -v /mnt/mymount/
## output
/tmp/diskboot.img umounted

# Common Options #

## Lazy unmount.
-l, --lazy
## Detach the filesystem from the filesystem hierarchy now,
##  and cleanup all references to the filesystem as soon as
##  it is not busy anymore. (Requires kernel 2.4.11 or later.)

# Troubleshooting #

## Failed to unmount
umount -v /mnt/mymount/
### output
/tmp/diskboot.img umounted

## Solution : Find who is using it
lsof | grep mymount
### output
bash   9341  francois  cwd   DIR   8,1   1024    2 /mnt/mymount
## OR
umount -lv /mnt/mymount/
```
