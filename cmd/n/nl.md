# nl

> number lines of files

## Synopsis

```bash
nl [OPTION]... [FILE]...
```

- Write each FILE to standard output, with line numbers added.
- With no FILE, or when FILE is `-`, read standard input.

## Options

By default, selects `-v1 -i1 -l1 -sTAB -w6 -nrn -hn -bt -fn`.

### All Options

- `-b, --body-numbering=STYLE` use STYLE for numbering body lines
- `-d, --section-delimiter=CC` use CC for separating logical pages
- `-f, --footer-numbering=STYLE` use STYLE for numbering footer lines
- `-h, --header-numbering=STYLE` use STYLE for numbering header lines
- `-i, --line-increment=NUMBER` line number increment at each line
- `-l, --join-blank-lines=NUMBER` group of NUMBER empty lines counted as one
- `-n, --number-format=FORMAT` insert line numbers according to FORMAT
- `-p, --no-renumber` do not reset line numbers at logical pages
- `-s, --number-separator=STRING` add STRING after (possible) line number
- `-v, --starting-line-number=NUMBER` first line number on each logical page
- `-w, --number-width=NUMBER` use NUMBER columns for line numbers

### Style

- `a` number all lines
- `t` number only nonempty lines
- `n` number no lines
- `pBRE` number only lines that contain a match for the basic regular expression (BRE)

### Format

- `ln` left justified, no leading zeros
- `rn` right justified, no leading zeros
- `rz` right justified, leading zeros

## Usage

Sample

```bash
$ cat input1
abhishek
divyam
chitransh
naveen
harsh
```

### Default

```bash
$ nl input1
     1  abhishek
     2  divyam
     3  chitransh
     4  naveen
     5  harsh
```

### Body Number

Style : number no lines `-b n`

```bash
$ nl -bn input1
       abhishek
       divyam
       chitransh
       naveen
       harsh
```

### Number Increment

```bash
$ nl -i2 input1
     1  abhishek
     3  divyam
     5  chitransh
     7  naveen
     9  harsh
```

### Number Separator

```bash
$ nl -s: input1
     1:abhishek
     2:divyam
     3:chitransh
     4:naveen
     5:harsh
$ nl -s': ' input1
     1: abhishek
     2: divyam
     3: chitransh
     4: naveen
     5: harsh
```

### Number Width

```bash
$ nl -w1 input1
1       abhishek
2       divyam
3       chitransh
4       naveen
5       harsh
```

### Number Format

```bash
$ nl -nln input1
1       abhishek
2       divyam
3       chitransh
4       naveen
5       harsh

$ nl -nrn input1
     1  abhishek
     2  divyam
     3  chitransh
     4  naveen
     5  harsh

$ nl -nrz input1
000001  abhishek
000002  divyam
000003  chitransh
000004  naveen
000005  harsh
```
