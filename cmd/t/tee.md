# tee

> Read from standard input and write to standard output and files

Synopsis

```bash
tee [OPTION]... [FILE]...
```

If a FILE is `-`, copy again to standard output

## Options

- `-a, --append` Append to the given FILEs, do not overwrite
- `-i, --ignore-interrupts` Ignore interrupt signals

## Usage

### Write

Save your input into files at the same time

```bash
tee file1 file2
```

### Append

Append to file

```bash
cat file1 | tee -a file2
```

### Differ \> and \>>

- `tee -a` : Write to both standard output and files
- `>`, `>>` : Only write to files!

```bash
cat file1 | tee -a file2
cat file1 | tee file2
# or ?
cat file1 > file2
cat file1 >> file2
```