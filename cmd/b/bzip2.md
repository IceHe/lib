# bzip2

> - bzip2, bunzip2 - a block-sorting file compressor
> - bzcat - decompresses files to stdout
> - bzip2recover - recovers data from damaged bzip2 files

References

- `man bzip2`

## Quickstart

```bash
bzip2 -z file       # Compress
bzip2 -d file.bz2   # Decompress
bunzip2 file.bz2
```

## Options

- `-k, --keep` Keep (don't delete) input files during compression or decompression
- `-d, --decompress` Force decompression
- `-z, --compress` The complement to `-d` **forces compression**, regardless of the invocation name
- `-c, --stdout` Compress or decompress to standard output ( for pipe )

## Details

Decompress

- Files which were not created by bzip2 will be detected and ignored, and a warning issued.

`bzip2` guesses filename as follows

- from : original compressed file
- to : decompressed file

|From|To|
|:-|:-|
|file.bz2|file|
|file.bz|file|
|file.tbz2|file.tar|
|file.tbz|file.tar|
|anyothername|anyothername.out|
