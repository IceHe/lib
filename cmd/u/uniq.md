# uniq

> report or omit repeated lines

References

* `man uniq`

## Options

### Common

* `-c, --count` Prefix lines by the number of occurrences
* `-i, --ignore-case` Ignore differences in case when comparing

### Maybe

* `-d, --repeated` Only print duplicate lines, one for each group
* `-s, --skip-chars=N` Avoid comparing the first N characters
* `-u, --unique` Only print unique lines
* `-w, --check-chars=N` Compare no more than N characters in lines

### Seldom

* `-D, --all-repeated[=METHOD]` Print all duplicate lines groups can be delimited with an empty line METHOD={none\(default\),prepend,separate}
* `-f, --skip-fields=N` avoid comparing the first N fields
* `--group[=METHOD]` Show all items, separating groups with an empty line METHOD={separate\(default\),prepend,append,both}

## Usage

### Default

Sample

```bash
$ cat txt1
test 30
test 30
test 30
Hello 95
Hello 95
Hello 95
Hello 95
Linux 85
Linux 85
```

```bash
$ uniq txt1
test 30
Hello 95
Linux 85
```

### Count

```bash
$ uniq -c txt1
      3 test 30
      4 Hello 95
      2 Linux 85
```

### Ignore Case

Sample

```bash
$ cat txt2
Test 30
test 30
test 30
Hello 95
Hello 95
hello 95
hello 95
```

Default

```bash
$ uniq txt2
Test 30
test 30
Hello 95
hello 95
```

Ignore Case

```bash
$ uniq -i txt2
Test 30
Hello 95
```

### Repeated

Sample

```bash
$ cat txt3
test 30
Hello 95
Hello 95
Linux 85
Linux 85
Linux 85
```

```bash
$ uniq -d txt3
Hello 95
Linux 85
```

### Unique

```bash
$ uniq -u txt3
test 30
```

### Skip Chars

Sample

```bash
$ cat txt4
Apple
Apple
Application
Application
Station
Station
Section
Section
```

```bash
$ uniq -w3 txt4
Apple
Station
Section
```

### Check Chars

```bash
$ uniq -s4 txt4
Apple
Application
Station
```

### Sort & Uniq

Sample

```bash
$ cat txt5
Apple
Application
Application
Apple
```

```bash
$ uniq txt5
Apple
Application
Apple
```

```bash
$ sort txt5 | uniq
Apple
Application
```

