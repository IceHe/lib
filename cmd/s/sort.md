# sort

> sort lines of text files

Reference

- `man sort`
- GNU Coreutils : https://www.gnu.org/software/coreutils/manual/html_node/sort-invocation.html

## Options

### Ordering

Common

- `-b, --ignore-leading-blanks` Ignore leading blanks
- `-f, --ignore-case` Fold lower case to upper case characters
- `-n, --numeric-sort` Compare according to sTring numerical value
- `-h, --human-numeric-sort` Compare human readable numbers (e.g., 2K 1G)
- `-r, --reverse` Reverse the result of comparisons
- `-R, --random-sort` Sort by random hash of keys
- `-M, --month-sort` Compare (unknown) < 'JAN' < ... < 'DEC'

Seldom

- `-d, --dictionary-order` Consider only blanks and alphanumeric characters
- `-g, --general-numeric-sort` _Compare according to general numerical value_
- `-i, --ignore-nonprinting` Consider only printable characters
- `--random-source=FILE` _Get random bytes from FILE_
- `--sort=WORD` _Sort according to WORD: general-numeric -g, human-numeric -h, month -M, numeric -n, random -R, version -V_
- `-V, --version-sort` Natural sort of (version) numbers within text

### Others

Common

- `-c, --check, --check=diagnose-first` Check for sorted input; do not sort
- `-k, --key=KEYDEF` Sort via a key; KEYDEF gives location and type
- `-o, --output=FILE` Write result to FILE instead of standard output
- `-u, --unique` With `-c`, check for strict ordering; without `-c`, output only the first of an equal run

Seldom

- `-C, --check=quiet, --check=silent` Like `-c`, but do not report first bad line
- `--compress-program=PROG` Compress temporaries with PROG; decompress them with PROG -d
- `-m, --merge` Merge already sorted files; do not sort
- `-s, --stable` Stabilize sort by disabling last-resort comparison
- `-S, --buffer-size=SIZE` Use SIZE for main memory buffer
- `-t, --field-separator=SEP` Use SEP instead of non-blank to blank transition
- `--parallel=N` Change the number of sorts run concurrently to N

## Usage

### Default

Sample

```bash
$ cat input1
abhishek
divyam
chitransh
naveen
harsh
```

Sort

```bash
$ sort input1
abhishek
chitransh
divyam
harsh
naveen
```

### Output to File

```bash
sort -o <output_file> <input_file>
# e.g.
sort -o output1 input1
```

### Reverse Order

```bash
$ sort -r input1
naveen
harsh
divyam
chitransh
abhishek
```

### Numeric

Sample

```bash
$ cat input2
50
39
15
89
200
9
```

Default Sort

```bash
$ sort input3
```

Sort **Numerically**

```bash
$ sort -n input2
9
15
39
50
89
200
```

Sort **Numerically** in **Reverse Order**

```bash
$ sort -nr input2
200
89
50
39
15
9
```

### Human Numeric

Sample

```bash
$ df -h | head -11 | sed 1d
/dev/sda3       3.9G  821M  2.8G  23% /
devtmpfs        7.8G     0  7.8G   0% /dev
tmpfs           7.8G     0  7.8G   0% /dev/shm
tmpfs           7.8G  735M  7.1G  10% /run
tmpfs           7.8G     0  7.8G   0% /sys/fs/cgroup
/dev/sda1        12G  5.4G  5.7G  49% /usr
/dev/sda5       7.8G   37M  7.3G   1% /tmp
/dev/sda6       7.8G  1.9G  5.6G  25% /var
/dev/sda7       236G   94G  131G  42% /data0
tmpfs           1.6G     0  1.6G   0% /run/user/60422
```

Sort by **Column** 3 **Human-Numerically** in **Reverse Order**

- Human readable numbers : e.g. **999, 2K, 3M, 1G**

```bash
$ df -h | head -11 | sed 1d | sort -k3hr
/dev/sda7       236G   94G  131G  42% /data0
/dev/sda1        12G  5.4G  5.7G  49% /usr
/dev/sda6       7.8G  1.9G  5.6G  25% /var
/dev/sda3       3.9G  821M  2.8G  23% /
tmpfs           7.8G  735M  7.1G  10% /run
/dev/sda5       7.8G   37M  7.3G   1% /tmp
devtmpfs        7.8G     0  7.8G   0% /dev
tmpfs           1.6G     0  1.6G   0% /run/user/60422
tmpfs           7.8G     0  7.8G   0% /dev/shm
tmpfs           7.8G     0  7.8G   0% /sys/fs/cgroup
```

### By Column

Sample

```bash
$ cat input3
manager  5000
director 4000
employee 6000
peon     450
clerk    900
guard    3000
```

Default Sort

```bash
$ sort input3
clerk    900
director 4000
employee 6000
guard    3000
manager  5000
peon     450
```

Sort by **Column** 2

```bash
$ sort -k2 input3
# same as
# - `sort -k 2`
# - `sort --key=2`
guard    3000
director 4000
peon     450
manager  5000
employee 6000
clerk    900
```

Sort by **Column** 2 **Numerically**

```bash
$ sort -k2n input3
# same as
# - `sort -nk2 input3`
# - `sort -nk 2 input3`
# - `sort -k 2n input3`
# - `sort -k2 -n input3`
# - `sort -k 2 -n input3`
# but not
# - `sort -kn2 input3`
# - `sort -kn 2 input3`
peon     450
clerk    900
guard    3000
director 4000
manager  5000
employee 6000
```

### Ignore Case

Sample

```bash
$ cat upper-lower-case
banana
Banana
Apple
apple
```

Default sort

```bash
$ sort upper-lower-case
apple
Apple
banana
Banana
```

**Ignore-Case** Sort

```bash
$ sort -f upper-lower-case
Apple
apple
Banana
banana
```

#### Stable

**Ignore-Case Stable** Sort

```bash
$ sort -fs upper-lower-case
Apple
apple
banana
Banana
```

### Remove Duplicates

Sample

```bash
$ cat input5
Audi
BMW
Cadillac
BMW
Dodge
```

```bash
$ sort -u input5
Audi
BMW
Cadillac
Dodge
```

### Merge Files

Default Sort

```bash
$ sort input1 input3
abhishek
chitransh
clerk    900
director 4000
divyam
employee 6000
guard    3000
harsh
manager  5000
naveen
peon     450
```

**Merge already sorted files**; do not sort!

```bash
$ sort -m input1 input3
# Wrong output!
# Because the input files have not been sorted.
abhishek
divyam
chitransh
manager  5000
director 4000
employee 6000
naveen
harsh
peon     450
clerk    900
guard    3000
```

### No Leading Blanks

Sample

```bash
$ cat leading-blanks
 zzz
apple
   banana
  cat
```

On CentOS 7

- Option `-t` doesn't work!?

On macOS

- Default Sort

```bash
$ sort leading-blanks
   banana
  cat
 zzz
apple
```

- Sort without **Leading Blanks**

```bash
$ sort -b leading-blanks
apple
   banana
  cat
 zzz
```

### Dictionary Order

Sample

```bash
$ cat dictionary
%5f
 3e
@1d
!8c
&2b
(9a
```

On CentOS 7

- Option `-d` doesn't work!?

On macOS

- Default Sort

```bash
$ sort dictionary
 3e
!8c
%5f
&2b
(9a
@1d
```

- Sort in **Dictionary Order**

```bash
$ sort -d dictionary
 3e
@1d
&2b
%5f
!8c
(9a
```

### Ignore Nonprinting Chars

Sample

```bash
$ cat nonprinting-chars
^Md
^Vb
^Cc
^Za
```

On CentOS 7

- Option `-d` doesn't work!?

On macOS

- Default Sort

```bash
$ sort nonprinting-chars
c
d
b
a
```

- Sort without **Nonpriting Characters**

```bash
$ sort -i nonprinting-chars
a
b
c
d
```

### Check Sorted

Sample

```bash
$ cat input4
Audi
Cadillac
BMW
Dodge
```

Check : whether sorted or not?

- Note that If there is no output then the file is considered to be already sorted.

```bash
$ sort -c input4
sort: input4:3: disorder: BMW
```

### Months

Sample

```bash
$ cat months
September
February
January
August
March
```

Sort by **Month**

```bash
$ sort -M months
January
February
March
August
September
```
