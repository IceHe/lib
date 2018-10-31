# sort

> sort lines of text files

## Options

### Ordering

- `-b, --ignore-leading-blanks` Ignore leading blanks
- `-d, --dictionary-order` Consider only blanks and alphanumeric characters
- `-f, --ignore-case` Fold lower case to upper case characters
- `-g, --general-numeric-sort` Compare according to general numerical value
- `-i, --ignore-nonprinting` Consider only printable characters
- `-M, --month-sort` Compare (unknown) < 'JAN' < ... < 'DEC'
- `-h, --human-numeric-sort` compare human readable numbers (e.g., 2K 1G)
- `-n, --numeric-sort` Compare according to string numerical value
- `-R, --random-sort` Sort by random hash of keys
- `--random-source=FILE` Get random bytes from FILE
- `-r, --reverse` Reverse the result of comparisons
- `--sort=WORD` Sort according to WORD: general-numeric -g, human-numeric -h, month -M, numeric -n, random -R, version -V
- `-V, --version-sort` Natural sort of (version) numbers within text

### Others

- `-c, --check, --check=diagnose-first` Check for sorted input; do not sort
- `-C, --check=quiet, --check=silent` Like `-c`, but do not report first bad line
- `--compress-program=PROG` Compress temporaries with PROG; decompress them with PROG -d
- `-k, --key=KEYDEF` Sort via a key; KEYDEF gives location and type
- `-m, --merge` Merge already sorted files; do not sort
- `-o, --output=FILE` Write result to FILE instead of standard output
- `-s, --stable` Stabilize sort by disabling last-resort comparison
- `-t, --field-separator=SEP` Use SEP instead of non-blank to blank transition
- `--parallel=N` Change the number of sorts run concurrently to N
- `-u, --unique` With `-c`, check for strict ordering; without `-c`, output only the first of an equal run

## Usage

```bash
```
