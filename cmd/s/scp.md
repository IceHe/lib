# scp

> secure copy \(remote file copy program\)

References

* `man scp`

## Synopsis

```bash
scp [-1246BCpqrv] [-c cipher]
    [-F ssh_config] [-i identity_file]
    [-l limit] [-o ssh_option]
    [-P port] [-S program]
    [[user@]host1:] file1 ...
    [[user@]host2:]file2
```

scp copies files between hosts on a network.

* It uses ssh for data transfer, and uses the same authentication and provides the same security as ssh.
* _Unlike rcp, scp will ask for passwords or passphrases if they are needed for authentication._
* When copying a source file to a target file which already exists, scp will replace the contents of the target file \(keeping the inode\).
* If the target file does not yet exist, an empty file with the target file name is created, then filled with the source file contents.

## Options

```text
 -4      Forces scp to use IPv4 addresses only.

 -6      Forces scp to use IPv6 addresses only.

 -B      Selects batch mode (prevents asking for passwords or passphrases).

 -C      Compression enable.  Passes the -C flag to ssh(1) to enable compression.

 -c cipher
         Selects the cipher to use for encrypting the data transfer.  This option is directly passed to ssh(1).

 -F ssh_config
         Specifies an alternative per-user configuration file for ssh.  This option is directly passed to ssh(1).

 -i identity_file
         Selects the file from which the identity (private key) for public key authentication is read.  This option is directly passed to ssh(1).

 -l limit
         Limits the used bandwidth, specified in Kbit/s.

 -P port
         Specifies the port to connect to on the remote host.  Note that this option is written with a capital 'P', because -p is already reserved for
         preserving the times and modes of the file in rcp(1).

 -p      Preserves modification times, access times, and modes from the original file.

 -q      Quiet mode: disables the progress meter as well as warning and diagnostic messages from ssh(1).

 -r      Recursively copy entire directories.  Note that scp follows symbolic links encountered in the tree traversal.

 -S program
         Name of program to use for the encrypted connection.  The program must understand ssh(1) options.

 -v      Verbose mode.  Causes scp and ssh(1) to print debugging messages about their progress.  This is helpful in debugging connection, authentica-
         tion, and configuration problems.
```

## Usage

```bash
scp -r [HOST_OR_IP]@[/path/to/send/] [/path/to/local]
```

