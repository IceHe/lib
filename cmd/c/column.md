# column

> columnate lists

References

* `man column`

## Quickstart

```bash
column -s ':' -t -o '|' file
# -s ':' : Split by ':'
# -t     : Create a table
# -o '|' : Use '|' as table delimiters

# e.g.
sed 's/#.*//' /etc/group | column -s ':' -t -o '|'
```

## Synopsis

```bash
column [options] file...
```

* The column utility formats its input into multiple columns.
* Rows are filled before columns.
* Input is taken from file or, by default, from standard input.
* Empty lines are ignored.

## Options

* `-c, --columns width` Output is formatted to a width specified as number of characters.
* `-t, --table` Determine the number of columns the input contains and create a table.
  * Columns are delimited  with  whitespace, by default, or with the characters supplied using the separator.
  * Table output is useful for pretty-printing.
* `-s, --separator separators` Specify possible table delimiters \(default is whitespace\).
* `-o, --output-separator separators` Specify table output delimiter \(default is two whitespaces\).
* `-x, --fillrows` Fill columns before filling rows.

## Usage

### Table

* Original content

```bash
$ cat /etc/fstab

#
# /etc/fstab
# Created by anaconda on Wed Apr 25 07:48:47 2018
#
# Accessible filesystems, by reference, are maintained under '/dev/disk'
# See man pages fstab(5), findfs(8), mount(8) and/or blkid(8) for more info
#
UUID=7ea27052-9818-4a8b-9e20-127078e95db1 /                       ext4    defaults        1 1
UUID=5d50e2ed-ca38-4c8d-9a1e-9fddb4c9cd83 /tmp                    ext4    defaults        1 2
UUID=5d08691f-fa8b-43ff-8ecb-89d4ea6e8c6e /usr                    ext4    defaults        1 2
UUID=f8b0c023-f575-4825-abb0-ab5543b350e6 /var                    ext4    defaults        1 2
UUID=d767dba5-ea15-45ce-8c6c-4f3b0413f871 swap                    swap    defaults        0 0
UUID=ff588a96-da99-4bd8-9938-bf8d699e9eb8  /data0                  ext4    defaults        0 0
```

* After `sed`

```bash
$ sed 's/#.*//' /etc/fstab








UUID=7ea27052-9818-4a8b-9e20-127078e95db1 /                       ext4    defaults        1 1
UUID=5d50e2ed-ca38-4c8d-9a1e-9fddb4c9cd83 /tmp                    ext4    defaults        1 2
UUID=5d08691f-fa8b-43ff-8ecb-89d4ea6e8c6e /usr                    ext4    defaults        1 2
UUID=f8b0c023-f575-4825-abb0-ab5543b350e6 /var                    ext4    defaults        1 2
UUID=d767dba5-ea15-45ce-8c6c-4f3b0413f871 swap                    swap    defaults        0 0
UUID=ff588a96-da99-4bd8-9938-bf8d699e9eb8  /data0                  ext4    defaults        0 0
```

* After `sed` \| `column`

```bash
$ sed 's/#.*//' /etc/fstab | column -t
UUID=7ea27052-9818-4a8b-9e20-127078e95db1  /       ext4  defaults  1  1
UUID=5d50e2ed-ca38-4c8d-9a1e-9fddb4c9cd83  /tmp    ext4  defaults  1  2
UUID=5d08691f-fa8b-43ff-8ecb-89d4ea6e8c6e  /usr    ext4  defaults  1  2
UUID=f8b0c023-f575-4825-abb0-ab5543b350e6  /var    ext4  defaults  1  2
UUID=d767dba5-ea15-45ce-8c6c-4f3b0413f871  swap    swap  defaults  0  0
UUID=ff588a96-da99-4bd8-9938-bf8d699e9eb8  /data0  ext4  defaults  0  0
```

### Separator

Sample

```bash
$ cat sample
1.2.3
.4.5.
6..7
8.9.
..10.
.11.
12...
```

```bash
column -s '.' -t sample
1   2   3
    4   5
6       7
8   9
        10
    11
12
```

### Output Separator

```bash
$ column -o ', ' -s '.' -t file
1 , 2 , 3
  , 4 , 5 ,
6 ,   , 7
8 , 9 ,
  ,   , 10,
  , 11,
12,   ,   ,
```

```bash
$ sed 's/#.*//' /etc/fstab | column -t -o ' | '
UUID=7ea27052-9818-4a8b-9e20-127078e95db1 | /      | ext4 | defaults | 1 | 1
UUID=5d50e2ed-ca38-4c8d-9a1e-9fddb4c9cd83 | /tmp   | ext4 | defaults | 1 | 2
UUID=5d08691f-fa8b-43ff-8ecb-89d4ea6e8c6e | /usr   | ext4 | defaults | 1 | 2
UUID=f8b0c023-f575-4825-abb0-ab5543b350e6 | /var   | ext4 | defaults | 1 | 2
UUID=d767dba5-ea15-45ce-8c6c-4f3b0413f871 | swap   | swap | defaults | 0 | 0
UUID=ff588a96-da99-4bd8-9938-bf8d699e9eb8 | /data0 | ext4 | defaults | 0 | 0
```

