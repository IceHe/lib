# sed

> stream editor for filtering and transforming text

## Synopsis

```bash
sed [OPTION]... {script-only-if-no-other-script} [input-file]...
```

- If no `-e, --expression` or `-f, --file` option is given, then the first non-option argument is taken as the sed script to interpret.
- All remaining arguments are names of input files;
    - if no input files are specified, then the standard input is read.

## Options

- `-n, --quiet, --silent` suppress automatic printing of pattern space
- `-e script, --expression=script` add the script to the commands to be executed
- `-f script-file, --file=script-file` add the contents of script-file to the commands to be executed
- `--follow-symlinks` follow symlinks when processing in place
- **`-i[SUFFIX], --in-place[=SUFFIX]` edit files in place** (makes backup if SUFFIX supplied)
- `-c, --copy` use copy instead of rename when shuffling files in -i mode
- `-b, --binary` does nothing; for compatibility with WIN32/CYGWIN/MSDOS/EMX ( open files in binary mode (CR+LFs are not  treated specially))
- `-l N, --line-length=N` specify the desired line-wrap length for the `l' command
- `--posix` disable all GNU extensions.
- `-r, --regexp-extended` use extended regular expressions in the script.
- `-s, --separate` consider files as separate rather than as a single continuous long stream.
- `-u, --unbuffered` load minimal amounts of data from the input files and flush the output buffers more often
- `-z, --null-data` separate lines by NUL characters

## Commands

### Zero-address

## Usage
