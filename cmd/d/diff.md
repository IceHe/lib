# diff

> compare files line by line

Synopsis

```bash
diff [OPTION]... FILES
```

## Options

- `-y, --side-by-side` output in two columns
- `-i, --ignore-case` ignore case differences in file contents
- `-E, --ignore-tab-expansion` ignore changes due to tab expansion
- `-Z, --ignore-trailing-space` ignore white space at line end
- `-b, --ignore-space-change` ignore changes in the amount of white space
- `-w, --ignore-all-space` ignore all white space
- `-B, --ignore-blank-lines` ignore changes where lines are all blank
- ……

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
$ diff file1 file2
1d0
< 1
3a3
> 4
```

### Side by Side

- `%<` lines from FILE1
- `%>` lines from FILE2

```bash
$ diff -y file1 file2
1      <
2        2
3        3
       > 4
```

### See Also

`vimdiff`

```bash
$ vimdiff file1 file2
```
