# bzip2

> a block-sorting file compressor

## Options

- `-d | --decompress` Force decompression.
- `-z | --compress` The complement to `-d` **forces compression**, regardless of the invocation name.

## Usage

### Compress

```bash
bzip2 -z <file_path>
```

e.g.

```bash
$ bzip2 -z index.html
index.html.bz2
```

### Decompress

- Files which were not created by bzip2 will be detected and ignored, and a warning issued.

```bash
bzip2 -d <file_path>.bz2
# or
bunzip2 <file_path>.bz2
```

e.g.

```bash
$ bzip2 -d index.html.bz2
index.html
```

`bzip2` guesses filename as follows

- from : original compressed file
- to : decompressed file

|From|To|
|:-|:-|
|filename.bz2|filename|
|filename.bz|filename|
|filename.tbz2|filename.tar|
|filename.tbz|filename.tar|
|anyothername|anyothername.out|
