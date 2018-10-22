# tee

> Read from standard input and write to standard output and files

```bash
tee [OPTION]... [FILE]...
```

## Options

- `-a, --append` Append to the given FILEs, do not overwrite
- `-i, --ignore-interrupts` Ignore interrupt signals

If a FILE is `-`, copy again to standard output

## Usage

Save your input into files at the same time

```bash
tee file1 file2
```

Append to file

```bash
cat file1 | tee -a file2
```

Differ?

- `tee -a` : Write to both standard output and files
- `>`, `>>` : Only write to files!

```bash
cat file1 | tee -a file2
cat file1 | tee file2
# or?
cat file1 > file2
cat file1 >> file2
```