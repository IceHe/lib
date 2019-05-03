# du

On Linux

> estimate file space usage

On BSD

> display **disk usage** statistics

## Quickstart

```bash
du -hs      # Print size of current working directory (cwd)
du -hs *    # Print sizes of files/dirs in cwd
du -ah      # Print all sizes of files/dirs recursively in cwd

# -h, --human-readable  : In human-readable format
# -s, --summarize       : Only a total for each argument
# -a, --all : Write counts for all files, not just dirs
```

## Usage

List size of current directory

```bash
$ du -hs
 58M    .
```

List files' size in current directory

```bash
$ du -hs *
# or (a little different)
$ du -h --max-depth=1
# output
4.0K    CNAME
 52K    LICENSE
 12K    README.md
6.0M    _archived
1.2M    _docsify
184K    asm
260K    cmd
8.0K    commands
108K    cpp
 44K    git
 16K    index.html
 12K    index.raw.html
200K    mac
1.6M    marks
140K    scripts
9.7M    snips
```

List files' size recursively in current directory

```bash
du -ah

# e.g.
$ du -ah | head
4.0K    ./_docsify/_navbar.md
4.0K    ./_docsify/deploy/nginx/docsify.conf
4.0K    ./_docsify/deploy/nginx
4.0K    ./_docsify/deploy/service/docsify
4.0K    ./_docsify/deploy/service
8.0K    ./_docsify/deploy
8.0K    ./_docsify/resources/__unpkg.com_docsify-pagination_dist_docsify-pagination.min.js
152K    ./_docsify/resources/__unpkg.com_gitalk_dist_gitalk.min.js
4.0K    ./_docsify/resources/__unpkg.com_prismjs_components_prism-http.min.js
4.0K    ./_docsify/resources/__unpkg.com_prismjs_components_prism-php.min.j
```

## Optoins

### Common

- `-a, --all` Write counts for all files, not just directories
- `-b, --bytes` equivalent to `--apparent-size --block-size=1`
- `-c, --total` Produce a grand total
- `-d, --max-depth=N` Print the total for a directory (or file, with `--all`) only if it is N or fewer levels below the command line argement
    - `--max-depth=0` is the same as `--summarize`
- `-h, --human-readable` Print sizes in human readable format (e.g., 1K 234M 2G)
- `-s, --summarize` Display only a total for each argument
- `--si` like `-h`, but use powers of 1000 not 1024
- `--time` Show time of the last modification of any file in the directory, or any of its subdirectories

### Seldom

- `--apparent-size` Print apparent sizes, rather than disk usage
    - Although the apparent size is usually smaller, it may be larger due to holes in ('sparse') files, internal fragmentation, indirect blocks, and the like
- `-B, --block-size=<SIZE>` Scale sized by SIZE before printing them
    - e.g., `-BM` print sizes in units of 1,048.576 bytes
    - See SIZE format below
- `-m` like `--block-size=1M`
- `-t, --threshold=<SIZE>` Excluede entries smaller than SIZE if positive, or entries greater than SIZE if negative
- `--time=<WORD>` Show time as WORD instead of modification time:
    - atime, access, use, ctime or status
- `--time-style=<STYLE>` Show times using STYLE, which can be:
    - full-iso, long-iso, iso, or +FORMAT
    - FORMAT is interpreted like in `date`
- `-X, --exclude-form=<FILE>` Exclude files that match any pattern in FILE
- `--exlude=<PATTERN>` Exclude files that match PATTERN
