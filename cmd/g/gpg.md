# gpg

OpenPGP encryption and signing tool

---

References

-   `man gpg`
-   [Managing commit signature verification - GitHub Docs](https://docs.github.com/en/authentication/managing-commit-signature-verification)

## Quickstart

```bash
# List the long form of the GPG keys
# for which you have both a public and private key.
gpg --list-secret-keys --keyid-format=long
# e.g. output. `XXXXXXXXXXXXXXX` is GPG Key ID.
/Users/username/.gnupg/pubring.kbx
-------------------------------
sec   ed25519/XXXXXXXXXXXXXXX 2021-10-01 [SC] [expires: 2023-10-01]
      2A31A4963DACA04D03F27829XXXXXXXXXXXXXXX
uid                 [ultimate] Ice He <icehe@silverhand.io>
ssb   cv25519/YYYYYYYYYYYYYYY 2021-10-01 [E] [expires: 2023-10-01]

# Common : Generate a new key pair using the current default parameters.
gpg --generate-key
# or
gpg --gen-key

# Generate a new key pair with dialogs for all options.
gpg --full-generate-key
# or
gpg --full-gen-key

# Either export all keys from all keyrings,
# with --armor to mail those keys.
gpg --armor --export [GPG-Key-ID]

# Remove key from the secret keyring.
 gpg --delete-secret-keys [GPG-Key-ID]
```

## Usage

### Gen New Key Pair

```bash
$ gpg --generate-key
gpg (GnuPG) 2.3.2; Copyright (C) 2021 Free Software Foundation, Inc.
This is free software: you are free to change and redistribute it.
There is NO WARRANTY, to the extent permitted by law.

Note: Use "gpg --full-generate-key" for a full featured key generation dialog.

GnuPG needs to construct a user ID to identify your key.

Real name: Test
Name must be at least 5 characters long
Real name: TestGen
Email address: test-gen@gmail.com
You selected this USER-ID:
    "TestGen <test-gen@gmail.com>"

Change (N)ame, (E)mail, or (O)kay/(Q)uit? o
We need to generate a lot of random bytes. It is a good idea to perform
some other action (type on the keyboard, move the mouse, utilize the
disks) during the prime generation; this gives the random number
generator a better chance to gain enough entropy.
We need to generate a lot of random bytes. It is a good idea to perform
some other action (type on the keyboard, move the mouse, utilize the
disks) during the prime generation; this gives the random number
generator a better chance to gain enough entropy.
gpg: key ED9624E8763D90E3 marked as ultimately trusted
gpg: revocation certificate stored as '/Users/icehe/.gnupg/openpgp-revocs.d/BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB.rev'
public and secret key created and signed.

pub   ed25519 2021-10-02 [SC] [expires: 2023-10-02]
      BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB
uid                      TestGen <test-gen@gmail.com>
sub   cv25519 2021-10-02 [E] [expires: 2023-10-02]
```

### List Existing Keys

```bash
$ gpg --list-secret-keys --keyid-format=long
/Users/username/.gnupg/pubring.kbx
-------------------------------
sec   ed25519/XXXXXXXXXXXXXXX 2021-10-01 [SC] [expires: 2023-10-01]
      2A31A4963DACA04D03F27829XXXXXXXXXXXXXXX
uid                 [ultimate] Ice He <icehe@silverhand.io>
ssb   cv25519/YYYYYYYYYYYYYYY 2021-10-01 [E] [expires: 2023-10-01]

sec   ed25519/ZZZZZZZZZZZZZZZ 2021-10-01 [SC] [expires: 2023-10-01]
      D153D5F43C903D0045FEE740ZZZZZZZZZZZZZZZ
uid                 [ultimate] IceHe <icehe.xyz@qq.com>
ssb   cv25519/AAAAAAAAAAAAAAA 2021-10-01 [E] [expires: 2023-10-01]

sec   ed25519/ED9624E8763D90E3 2021-10-02 [SC] [expires: 2023-10-02]
      2D392510603ECEDCCF9AB4DBED9624E8763D90E3
uid                 [ultimate] TestGen <test-gen@gmail.com>
ssb   cv25519/638524AD23ED6E6B 2021-10-02 [E] [expires: 2023-10-02]
```

-   `XXXXXXXXXXXXXXX` above is a GPG key ID.

### Export Key

```bash
gpg --armor --export ED9624E8763D90E3
-----BEGIN PGP PUBLIC KEY BLOCK-----

mDMEYU5ZlxYJKwYBBAHaRw8BAQdAM6H2dTviCUk4xVlO7wHkiNfBU9zSAjtpF5d+
Ip1aHLi0HFRlc3RHZW4gPHRlc3QtZ2VuQGdtYWlsLmNvbT6ImgQTFgoAQhYhBC05
JRBgPs7cz5q02+2WJOh2PZDjBQJhTlmXAhsDBQkDwmcABQsJCAcCAyICAQYVCgkI
CwIEFgIDAQIeBwIXgAAKCRDtliTodj2Q4xkQAQAAzEtFpGp4JrXTaM+hOG0afS6L
wiQoXsgC+SlhhBqYKQEAhUPMBcRzPS8C9Gj5HuBeTbH6qhr+aBays11HnolIzwO4
OARhTlmXEgorBgEEAZdVAQUBAQdAHnWlLr+kd+Ov8/7jTuBds1q8WQltUoMXd1LP
wNvlNVcDAQgHiH4EGBYKACYWIQQtOSUQYD7O3M+atNvtliTodj2Q4wUCYU5ZlwIb
SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
eeKCpfdLvwD9EtTyyQ4pg2BRyUujT+4t+6nT3pW1mP7MfHjy9pyBlAw=
=JOmN
-----END PGP PUBLIC KEY BLOCK-----
```

### Delete Key

```bash
$ gpg --delete-keys ED9624E8763D90E3
gpg (GnuPG) 2.3.2; Copyright (C) 2021 Free Software Foundation, Inc.
This is free software: you are free to change and redistribute it.
There is NO WARRANTY, to the extent permitted by law.

gpg: there is a secret key for public key "ED9624E8763D90E3"!
gpg: use option "--delete-secret-keys" to delete it first.

$ gpg --delete-secret-keys ED9624E8763D90E3
gpg (GnuPG) 2.3.2; Copyright (C) 2021 Free Software Foundation, Inc.
This is free software: you are free to change and redistribute it.
There is NO WARRANTY, to the extent permitted by law.


sec  ed25519/ED9624E8763D90E3 2021-09-24 TestGen <test-gen@gmail.com>

Delete this key from the keyring? (y/N) y
This is a secret key! - really delete? (y/N) y
```
