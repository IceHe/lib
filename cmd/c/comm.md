# comm

common

compare two sorted files line by line

---

References

- `man comm`

## Quickstart

```bash
comm file1 file2        # Compare file1 with file2
comm -12 file1 file2    # Print lines in both file1 & file2
comm -23 file1 file2    # Lines unique to file1
comm -13 file1 file2    # Lines unique to file2
```

## Options

### Column

Meanings of Column N to FILE N

- Column 1 contains lines unique to FILE1.
- Column 2 contains lines unique to FILE2.
- Column 3 contains lines common to both files.

How to use options `-1, -2, -3` ?

- `-1` suppress column 1 (lines unique to FILE1)
- `-2` suppress column 2 (lines unique to FILE2)
- `-3` suppress column 3 (lines that appear in both files)
- With no options, produce three-column output.

### Others

- `--check-order` check that the input is correctly sorted, even if all input lines are pairable
- `--nocheck-order` do not check that the input is correctly sorted
- `--output-delimiter=STR` separate columns with STR

## Usage

Sample

```bash
$ cat file1
1
2
3

$ cat file2
2
3
4
```

### Default

```bash
$ comm file1 file2
# column : 1 , 2 , 3
1
                2
                3
        4
```

### Column N

#### Suppress Column 1

Print only lines present in both file1 and file2.

```bash
$ comm -1 file1 file2
        2
        3
4
```

#### Suppress Column 2

Print lines in file2 not in file1, and vice versa.

```bash
$ comm -2 file1 file2
1
        2
        3
```

#### Suppress Column 3

Print lines in file1 not in file2, and vice versa.

```bash
$ comm -3 file1 file2
1
        4
```

### Trim Leading Whitespace

```bash
comm -3 file1 file2 | sed 's/^\s*//g'
1
4
```

### Set

#### Intersection

```bash
$ comm -12 file1 file2
2
3
```

#### Difference Set

##### File1 - File2

```bash
$ comm -23 file1 file2
1
```

##### File2 - File1

```bash
$ comm -13 file1 file2
4
```
