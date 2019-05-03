# chmod

> change file mode bits

## Quickstart

```bash
chmod 777 file          # Grant all access permissions
chmod ugo+a file
chmod ugo+rwx file
chmod -R u+x,go-w dir   # Compound operations
```

## Details

### Modes

`chmod` changes the file mode bits of each given file according to **mode**, which can be:

- a symbolic representation of changes to make
- an octal number representing the bit pattern for the new mode bits

The format of a symbolic mode is `[ugoa...][[+-=][perms...]...]` where perms is:

- either **zero or more letters** from the set `rwxXst`
- or **a single letter** from the set `ugo`

Multiple symbolic modes can be given, separated by commas.

### Users

A combination of the letters `ugoa` controls which users' access to the file will be changed:

- `u` : the user who owns it
- `g` : other users in the file's group
- `o` : other users not in the file's group
- `a` : all users

If none of these are given, the effect is as if a were given, but bits that are set in the umask are not affected.

### Operators

- `+` causes the selected file mode bits to be added to the existing file mode bits of each file;
- `-` causes them to be removed;
- `=` causes them to be added and causes unmentioned bits to be removed except that a directory's unmentioned set user and group ID bits are not affected.

### Access

#### Letters

The letters `rwxXst` select file mode bits for the affected users:

- `r` : read
- `w` : write
- `x` : execute (or search for directories)
- `X` : execute/search **only if the file is a directory or already has execute permission for some user**
- `s` : set user or group ID on execution
- `t` : restricted deletion flag or sticky bit

Instead of one or more of these letters, you can specify exactly one of the letters `ugo`:

- `u` : permissions granted to the user who owns the file
- `g` : permissions granted to other users who are members of the file's group
- `o` : permissions granted to users that are in neither of the two preceding categories

#### Numeric

A numeric mode is from one to four octal digits ( `0-7` ), derived by adding up the bits with values:

- `4` : read
- `2` : write
- `1` : execute

Omitted digits are assumed to be leading zeros.

Meanings of N-th Digit

- 1st - **deletion** : selects the set user ID `4` and set group ID `2` and restricted deletion or sticky `1` attributes.
- 2nd - **owner** : selects permissions for the user who owns the file: read `4`, write `2`, and eecute `1`;
- 3rd - **group** : selects permissions for other users in the file's group, with the same values;
- 4th - **others** : for other users** not in the file's group, with the same values.

### Restricted Deletion

> Restricted Deletion Flag or Sticky Bit

- The restricted deletion flag or sticky bit is a single bit, whose interpretation depends on the file type.
- For directories, it **prevents unprivileged users from removing or renaming** a file in the directory unless they own the file or the directory;
    - this is called the restricted deletion flag for the directory,
    - and is commonly found on world-writable directories like `/tmp`.
- _For regular files on some older systems, the bit saves the program's text image on the swap device so it will load more quickly when run; this is called the sticky bit._

### Symbolic Link

- `chmod` **never changes the permissions of symbolic links**; the chmod system call cannot change their permissions.
- This is not a problem since the permissions of symbolic links are never used.
- However, for each symbolic link listed on the command line, chmod changes the permissions of the pointed-to file.
- In contrast, chmod ignores symbolic links encountered during recursive directory traversals.

## Usage

### Synopsis

```bash
chmod [OPTION]... MODE[,MODE]... FILE...
chmod [OPTION]... OCTAL-MODE FILE...
chmod [OPTION]... --reference=RFILE FILE...

# e.g.
chmod -R ug+wx,o-r logs/
chmod 660 rsync_pass
chmod --reference=.rsa_public rsync_pass
```

### All Access

Make everyone available

- user : owner, group, other
- access : read, write, executable

```bash
chmod ugo+a <file>
# same as
chmod ugo+rwx <file>
# same as
chmod 777 <file>
```

### Directory & Recursive

```bash
chmod -R <user><operator><access> <directory>
# e.g.
chmod -R a+r logs/
chmod -R o+r,o-x logs/
```

## Options

Common

- `-R, --recursive` change files & directories recursively
- `--reference=RFILE` use RFILE's owner and group rather than specifying OWNER:GROUP values

Ouput

- `-c, --changes` like verbose but report only when a change is made
- `-f, --silent, --quiet` suppress most error messages
- `-v, --verbose` output a diagnostic for every file processed

Wrong Operation Prevention

- `--preserve-root` **fail to operate recursively on '/'**
- `--no-preserve-root` do not treat '/' specially ( **default** )
