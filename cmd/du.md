# du

In Linux

> estimate file space usage

In BSD

> display disk usage statistics

## Optoins

- `-a, --all` Write counts for all files, not just directories
- `--apparent-size` Print apparent sizes, rather than disk usage
    - although the apparent size is usually smaller, it may be larger due to holes in ('sparse') files, internal fragmentation, indirect blocks, and the like
- `-B, --block-size=<SIZE>` Scale sized by SIZE before printing them
    - e.g., `-BM` print sizes in units of 1,048.576 bytes
    - see SIZE format below
- `-b, --bytes` equivalent to `--apparent-size --block-size=1`
- `-c, --total` produce a grand total
- `-d, --max-depth=N` Print the total for a directory (or file, with --all) only if it is N or fewer levels below the command line argement
    - `--max-depth=0` is the same as `--summarize`
- `-h, --human-readable` Print sizes in human readable format (e.g., 1K 234M 2G)
- `-m` like `--block-size=1M`
- `-s, --summarize` Display only a total for each argument
- `--si` like `-h`, but use powers of 1000 not 1024
- `-t, --threshold=<SIZE>` Excluede entries smaller than SIZE if positive, or entries greater than SIZE if negative
- `--time` Show time of the last modification of any file in the directory, or any of its subdirectories
- `--time=<WORD>` Show time as WORD instead of modification time:
    - atime, access, use, ctime or status
- `--time-style=<STYLE>` Show times using STYLE, which can be:
    - full-iso, long-iso, iso, or +FORMAT
    - FORMAT is interpreted like in `date`
- `-X, --exclude-form=<FILE>` Exclude files that match any pattern in FILE
- `--exlude=<PATTERN>` Exclude files that match PATTERN

## Usage

List size of current directory

```bash
du -hs
```

List files' size in current directory

```bash
du -hs *
# or (a little different)
du -h --max-depth=1
```

List files' size recursively in current directory

```bash
du -ah
```