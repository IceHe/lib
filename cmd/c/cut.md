# cut

> remove sections from each line of files

Synopsis

```bash
cut OPTION... [FILE]...
```

With no FILE, or when FILE is -, read standard input.

## Options

- `-b, --bytes=LIST` Select only these bytes
- `-c, --characters=LIST` Select only these characters
- `-d, --delimiter=DELIM` Use DELIM instead of TAB for field delimiter
- `-f, --fields=LIST` Select only these fields; also print any line that contains no delimiter character, unless the -s option is specified
- `-n` With `-b`: Don't split multibyte characters
- `--complement` Complement the set of selected bytes, characters or fields
- `-s, --only-delimited` Do not print lines not containing delimiters
- `--output-delimiter=STRING` use STRING as the output delimiter the default is to use the input delimiter

LIST

- Use one, and only one of `-b`, `-c` or `-f`.
- Each LIST is made up of one range, or many ranges separated by commas.
- Selected input is written in the same order that it is read, and is written exactly once.

Each range is one of:

- `N` N'th byte, character or field, counted from 1
- `N-` From N'th byte, character or field, to end of line
- `N-M` From N'th to M'th (included) byte, character or field
- `-M` From first to M'th (included) byte, character or field

## Usage
