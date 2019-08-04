# less

> opposite of more

## Quickstart

```bash
less +F file    # Like `tail -f`

# e.g. use less to view text
grep pattern file | less

# TODO
DOING ? 2019-08-04
```

## Descriptions

### more

more : file perusal filter for crt viewing

- A filter for paging through text one screenful at a time
- Users should realize that `less` provides `more` emulation plus extensive enhancements.
- Recommend to use [`less`](/cmd/l/less.md).

### Intro

- Less is a program similar to more, but which **allows backward movement** in the file as well as forward movement.
- Also, less **does not have to read the entire input file before starting**, so with large input files it starts up faster than text editors like vi.

## Options

Most options may be changed :

- either on the command line,
- or from within less by using the - or -- command

It will take effect after repainting

### Percent

Default : `-m, --long-prompt` **with percent into the file**

- `-m, --long-prompt` Causes  less  to  prompt verbosely (like more), with the percent into the file.
    - By default, less prompts with a colon.
- `-M, --LONG-PROMPT` Causes less to prompt even more verbosely than more.

### Line Numbers

Default : `-n, --line-numbers` **without line numbers**

- `-n, --line-numbers` Suppresses line numbers.
    - The default (to use line numbers) may cause less to run more slowly in some cases, especially with a very large input file.
    - Suppressing line numbers with the -n option will avoid this problem.
    - Using line numbers means: the line number will be displayed in the verbose prompt and in the = command, and the v command will pass the current line number to the editor (see also the discussion of LESSEDIT in PROMPTS below).
- `-N, --LINE-NUMBERS` Causes a line number to be displayed at the beginning of each line in the display.

### Case

Default : `-i, --ignore-case` **case sensitive**

- `-i, --ignore-case` Causes searches to ignore case; that is, uppercase and lowercase  are  considered  identical.
    - This  option  is ignored  if  any uppercase letters appear in the search pattern; in other words, if a pattern contains uppercase letters, then that search does not ignore case.
- `-I, --IGNORE-CASE` Like -i, but searches ignore case even if the pattern contains uppercase letters.

## Usage

### Default

Case sensitive

```bash
less <file_path>
```

### Recommended

With **percent** into the file

```bash
less -M <file_path>
```

With **line numbers** & **percent** into the file

```bash
less -MN <file_path>
```

## Commands

> Interactive Commands

### Move

- `j, ^N, …` Forward one line
- `k, ^P, …` Backward one line
- `f, ^F, w, …` Forward one window
- `b, ^B, z, …` Backward one window
- `d, ^D` Forward one half-window
- `u, ^U` Backward one half-window

#### tail -f

- `F` **Forward forever; like `tail -f`** !

```bash
# Active @ CLI
less +F <file>
# Press interrupt ( Ctrl + C ) to abort
```

### Search

- `/pattern` Search forward for (N-th) matching line
- `?pattern` Search backward for (N-th) matching line
- `n` Repeat previous search (for N-th occurrence)
- `N` Repeat previous search in reverse direction

### Jump

- `g, <, …` Go to first line
- `G, >, …` Go to last line
- `m<letter>` Mark the current position with \<letter\>
- `'<letter>` Go to a previously marked position
- `''` Go to the previous position