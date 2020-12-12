# join

join lines of two files on a common field

---

References

- `man join`

## Synopsis

```bash
join [OPTION]... FILE1 FILE2
```

## Options

- `-a FILENUM` also print unpairable lines from file FILENUM, where FILENUM is 1 or 2, corresponding to FILE1 or FILE2
- `-e EMPTY` replace missing input fields with EMPTY
- `-i, --ignore-case` ignore differences in case when comparing fields
- `-j FIELD` equivalent to '-1 FIELD -2 FIELD'
- `-o FORMAT` obey FORMAT while constructing output line
- `-t CHAR` use CHAR as input and output field separator
- `-v FILENUM` like -a FILENUM, but suppress joined output lines
- `-1 FIELD` join on this FIELD of file 1
- `-2 FIELD` join on this FIELD of file 2
- `--check-order` check that the input is correctly sorted, even if all input lines are pairable
- `--nocheck-order` do not check that the input is correctly sorted
- `--header` treat the first line in each file as field headers, print them without trying to pair them
- `-z, --zero-terminated` end lines with 0 byte, not newline

## Usage

Reference : https://shapeshed.com/unix-join/

### Default

Sample 1

```bash
$ cat foodtypes
1 Protein
2 Carbohydrate
3 Fat

$ cat foods
1 Cheese
2 Potato
3 Butter
```

Join

```bash
$ join foodtypes foods
1 Protein Cheese
2 Carbohydrate Potato
3 Fat Butter
```

### Join by Sepcified Fields

Sample 2

```bash
$ cat wine
Red Beaunes France
White Reisling Germany
Red Riocha Spain

$ cat reviews
Beaunes Great!
Reisling Terrible!
Riocha Meh
```

Joined by Sepcified fields

```bash
$ join -1 2 -2 1 wine reviews
Beaunes Red France Great!
Reisling White Germany Terrible!
Riocha Red Spain Meh
```

### Sort Before Joining

Sample 3

```bash
$ cat wine
White Reisling Germany
Red Riocha Spain
Red Beaunes France

$ cat reviews
Riocha Meh
Beaunes Great!
Reisling Terrible!
```

Wrong

```bash
$ join -1 2 -2 1 wine reviews
join: wine:3: is not sorted: Red Beaunes France
join: reviews:2: is not sorted: Beaunes Great!
Riocha Red Spain Meh
Beaunes Red France Great!
```

Correct

```bash
$ join -1 2 -2 1 <(sort -k 2 wine) <(sort reviews)
Beaunes Red France Great!
Reisling White Germany Terrible!
Riocha Red Spain Meh
```

### Sepcify Separator

Sample 4

- An example is a [CSV](https://en.wikipedia.org/wiki/Comma-separated_values) file where the separator is `,`.

```bash
$ cat names.csv
1,John Smith,London
2,Arthur Dent, Newcastle
3,Sophie Smith,London

$ cat transactions.csv
£1234,Deposit,John Smith
£4534,Withdrawal,Arthur Dent
£4675,Deposit,Sophie Smith
```

Specify Separator

```bash
$ join -1 2 -2 3 -t , names.csv transactions.csv
John Smith,1,London,£1234,Deposit
Arthur Dent,2, Newcastle,£4534,Withdrawal
Sophie Smith,3,London,£4675,Deposit
```

### Output Format

Use Sample 4 above

```bash
$ join -1 2 -2 3 -t , -o 1.1,1.2,1.3,2.2,2.1 names.csv transactions.csv
1,John Smith,London,Deposit,£1234
2,Arthur Dent, Newcastle,Withdrawal,£4534
3,Sophie Smith,London,Deposit,£4675
```
