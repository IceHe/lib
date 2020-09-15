# paste

> merge lines of files

References

- `man paste`

## Synopsis

```bash
paste [OPTION]... [FILE]...
```

- Write lines consisting of the sequentially corresponding lines from each FILE, separated by TABs, to standard output.
- With no FILE, or when FILE is `-`, read standard input.

## Options

- `-d, --delimiters=LIST` reuse characters from LIST instead of TABs
- `-s, --serial` paste one file at a time instead of in parallel

## Usage

Sample

```bash
$ cat file1
1
2
3

$ cat file2
China
US
UK

$ cat file3
Asia
North America
Europe
```

### Default

```bash
$ paste file1 file2 file3
1       China   Asia
2       US      North America
3       UK      Europe
```

### Serial

```bash
$ paste -s file1 file2 file3
1       2       3
China   US      UK
Asia    North America   Europe
```

### Delimiter

#### Single

```bash
$ paste -d : file1 file2 file3
1:China:Asia
2:US:North America
3:UK:Europe

$ paste -d'|' file1 file2 file3
1|China|Asia
2|US|North America
3|UK|Europe
```

#### Multiple

```bash
$ paste -d':|' file1 file2 file3
1:China|Asia
2:US|North America
3:UK|Europe

$ paste -d':|' file1 file2 file3 file1
1:China|Asia:1
2:US|North America:2
3:UK|Europe:3

$ paste -d':||' file1 file2 file3 file1
1:China|Asia|1
2:US|North America|2
3:UK|Europe|3
```
