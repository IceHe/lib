# scp

secure copy (remote file copy program)

---

References

- `man scp`

## Synopsis

```bash
scp [-346BCpqrTv]
    [-c cipher]
    [-F ssh_config]
    [-i identity_file]
    [-J destination]
    [-l limit]
    [-o ssh_option]
    [-P port]
    [-S program]
    source ... target
```

## Description

**`scp` copies files between hosts on a network.**
**It uses `ssh` for data transfer,**
and uses the same authentication
and provides the same security as `ssh`.
`scp` will ask for passwords or passphrases
if they are needed for authentication.

The source and target may be specified as a local pathname,
a remote host with optional path in the form `[user@]host:[path]`,
or a URI in the form `scp://[user@]host[:port][/path]`.
Local file names can be made explicit using absolute or relative pathnames
to avoid scp treating file names containing `:` as host specifiers.

_When copying between two remote hosts,_
_if the URI format is used,_
_a port may only be specified on the target_
_if the `-3` option is used._

## Options

`-3`

Copies between two remote hosts are **transferred through the local host.**
_Without this option the data is copied directly between the two remote hosts._
_Note that this option disables the progress meter._

`-4`

Forces scp to **use IPv4 addresses only.**

`-6`

Forces scp to **use IPv6 addresses only.**

`-B`

Selects batch mode (prevents asking for passwords or passphrases).

**`-C`**

**Compression enable.**
_Passes the `-C` flag to `ssh` to enable compression._

`-c cipher`

Selects the cipher to use for encrypting the data transfer.
_This option is directly passed to `ssh`._

`-F ssh_config`

Specifies an alternative per-user configuration file for ssh.
_This option is directly passed to `ssh`._

`-i identity_file`

Selects the file from which the identity (private key)
for public key authentication is read.
_This option is directly passed to `ssh`._

`-J destination`

Connect to the target host by first making an scp connection
to the jump host described by destination
and then establishing a TCP forwarding to the ultimate destination from there.
Multiple jump hops may be specified separated by comma characters.
_This is a shortcut to specify a ProxyJump configuration directive._
_This option is directly passed to `ssh`._

`-l limit`

Limits the used bandwidth, specified in Kbit/s.

`-o ssh_option`

Can be used to pass options to ssh in the format used in `ssh_config`.
_This is useful for specifying options for which there is no separate scp command-line flag._
_For full details of the options listed below,_
_and their possible values, see `ssh_config`._

- _AddressFamily_
- _BatchMode_
- _BindAddress_
- _BindInterface_
- _CanonicalDomains_
- _CanonicalizeFallbackLocal_
- _CanonicalizeHostname_
- _CanonicalizeMaxDots_
- _CanonicalizePermittedCNAMEs_
- _CASignatureAlgorithms_
- _CertificateFile_
- _ChallengeResponseAuthentication_
- _CheckHostIP_
- _Ciphers_
- _Compression_
- _ConnectionAttempts_
- _ConnectTimeout_
- _ControlMaster_
- _ControlPath_
- _ControlPersist_
- _GlobalKnownHostsFile_
- _GSSAPIAuthentication_
- _GSSAPIDelegateCredentials_
- _HashKnownHosts_
- _Host_
- _HostbasedAuthentication_
- _HostbasedKeyTypes_
- _HostKeyAlgorithms_
- _HostKeyAlias_
- _Hostname_
- _IdentitiesOnly_
- _IdentityAgent_
- _IdentityFile_
- _IPQoS_
- _KbdInteractiveAuthentication_
- _KbdInteractiveDevices_
- _KexAlgorithms_
- _LogLevel_
- _MACs_
- _NoHostAuthenticationForLocalhost_
- _NumberOfPasswordPrompts_
- _PasswordAuthentication_
- _PKCS11Provider_
- _Port_
- _PreferredAuthentications_
- _ProxyCommand_
- _ProxyJump_
- _PubkeyAcceptedKeyTypes_
- _PubkeyAuthentication_
- _RekeyLimit_
- _SendEnv_
- _ServerAliveInterval_
- _ServerAliveCountMax_
- _SetEnv_
- _StrictHostKeyChecking_
- _TCPKeepAlive_
- _UpdateHostKeys_
- _User_
- _UserKnownHostsFile_
- _VerifyHostKeyDNS_

**`-P port`**

**Specifies the port to connect to on the remote host.**
_Note that this option is written with a capital `P`,_
_because `-p` is already reserved_
_for preserving the times and modes of the file._

**`-p`**

**Preserves modification times, access times, and modes**
from the original file.

**`-q`**

**Quiet mode**: disables the progress meter
as well as warning and diagnostic messages from `ssh`.

**`-r`**

**Recursively copy entire directories.**
Note that scp follows symbolic links encountered in the tree traversal.

`-S program`

Name of program to use for the encrypted connection.
_The program must understand `ssh` options._

`-T`

**Disable strict filename checking.**
By default when copying files
from a remote host to a local directory
`scp` checks that the received filenames match
those requested on the command-line
to prevent the remote end from sending unexpected or unwanted files.
_Because of differences_
_in how various operating systems and shells interpret filename wildcards,_
_these checks may cause wanted files to be rejected._
_This option disables these checks_
_at the expense of fully trusting that_
_the server will not send unexpected filenames._

**`-v`**

**Verbose mode.**
Causes scp and `ssh` to print debugging messages about their progress.  This is helpful in debugging connection, authentication, and configuration problems.

## Usage

TODO
