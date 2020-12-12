# file

determine file type

---

References

- `man file`

## Quickstart

```bash
file README.md  # Determine file type
# e.g. output
# README.md: exported SGML document, UTF-8 Unicode text
```

## Synopsis

```bash
file [-bchiklLNnprsvz0] [--apple]
     [--mime-encoding] [--mime-type]
     [-e testname] [-F separator]
     [-f namefile] [-m magicfiles] file ...
file -C [-m magicfiles]
file [--help]
```

## Options

- `-b, --brief` Do not prepend filenames to output lines (brief mode).
- `-i, --mime` Causes the file command to output mime type strings rather than the more traditional human readable ones.
    - Thus it may say ‘text/plain; charset=us-ascii’ rather than "ASCII text".
- _`-k, --keep-going`_ Don't stop at the first match, keep going.
    - Subsequent matches will be have the string ‘\012- ’ prepended.
    - (If you want a newline, see the -r option.)
- `-s, --special-files` Normally, file only attempts to read and determine the type of argument files which stat(2) reports are ordinary files.
    - This prevents problems, because reading special files may have peculiar consequences.
    - Specifying the -s option causes file to also read argument files which are block or character special files.
    - This is useful for determining the filesystem types of the data in raw disk partitions, which are block special files.
    - This option also causes file to disregard the file size as reported by stat(2) since on some systems it reports a zero size for raw disk partitions.

## Usage

### Default

```bash
$ file *
CNAME:          ASCII text, with no line terminators
LICENSE:        UTF-8 Unicode text, with very long lines
README.md:      UTF-8 Unicode text
_archived:      directory
index.html:     HTML document text, UTF-8 Unicode text
sample:         ASCII text
……
```

```bash
$ file /dev/sda*
file /dev/sda*
/dev/sda:  block special
/dev/sda1: block special
/dev/sda2: block special
/dev/sda3: block special
/dev/sda4: block special
/dev/sda5: block special
/dev/sda6: block special
/dev/sda7: block special
```

### MIME

`-i`

```bash
$ file * -i
CNAME:          regular file
LICENSE:        regular file
README.md:      regular file
_archived:      directory
index.html:     regular file
sample:         regular file
……
```

```bash
$ file /dev/sda* -i
/dev/sda:  inode/blockdevice; charset=binary
/dev/sda1: inode/blockdevice; charset=binary
/dev/sda2: inode/blockdevice; charset=binary
/dev/sda3: inode/blockdevice; charset=binary
/dev/sda4: inode/blockdevice; charset=binary
/dev/sda5: inode/blockdevice; charset=binary
/dev/sda6: inode/blockdevice; charset=binary
/dev/sda7: inode/blockdevice; charset=binary
```

### Special Files

```bash
$ file /dev/sda* -s
/dev/sda:  x86 boot sector; partition 1: ID=0x83, starthead 32, startsector 2048, 25165824 sectors; partition 2: ID=0x82, starthead 254, startsector 25167872, 16777216 sectors; partition 3: ID=0x83, active, starthead 254, startsector 41945088, 8388608 sectors; partition 4: ID=0x5, starthead 254, startsector 50333696, 535603200 sectors, code offset 0x63
/dev/sda1: Linux rev 1.0 ext4 filesystem data, UUID=5d08691f-fa8b-43ff-8ecb-89d4ea6e8c6e (needs journal recovery) (extents) (64bit) (large files) (huge files)
/dev/sda2: Linux/i386 swap file (new style), version 1 (4K pages), size 2097151 pages, no label, UUID=d767dba5-ea15-45ce-8c6c-4f3b0413f871
/dev/sda3: Linux rev 1.0 ext4 filesystem data, UUID=7ea27052-9818-4a8b-9e20-127078e95db1 (needs journal recovery) (extents) (64bit) (large files) (huge files)
/dev/sda4: x86 boot sector; partition 1: ID=0x83, starthead 254, startsector 4096, 16777216 sectors; partition 2: ID=0x5, starthead 254, startsector 16781312, 16779264 sectors, extended partition table, code offset 0x0
/dev/sda5: Linux rev 1.0 ext4 filesystem data, UUID=5d50e2ed-ca38-4c8d-9a1e-9fddb4c9cd83 (needs journal recovery) (extents) (64bit) (large files) (huge files)
/dev/sda6: Linux rev 1.0 ext4 filesystem data, UUID=f8b0c023-f575-4825-abb0-ab5543b350e6 (needs journal recovery) (extents) (64bit) (large files) (huge files)
/dev/sda7: Linux rev 1.0 ext4 filesystem data, UUID=ff588a96-da99-4bd8-9938-bf8d699e9eb8 (needs journal recovery) (extents) (64bit) (large files) (huge files)
```