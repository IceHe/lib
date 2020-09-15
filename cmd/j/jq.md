# jq

> Command-line JSON processor

References

- `man jq`

## Synopsis

```bash
jq [options...] filter [files...]
```

- `jq` can **transform JSON in various ways**, by selecting, iterating, reducing and otherwise mangling JSON documents.
    - _For instance, running the command `jq` `'map(.price) | add'` will take an array of JSON objects as input and return the sum of their "price" fields._
- `jq` can accept text input as well, but by default, `jq` reads a stream of JSON entities (including numbers and other literals) from `stdin`.
    - Whitespace is only needed to separate entities such as 1 and 2, and true and false.
    - _One or more files may be specified, in which case `jq` will read input from those instead._
- The `options` are described in the `INVOKING JQ` section; they mostly concern input and output formatting.
    - The `filter` is written in the jq language and specifies how to transform the input file or document.

## Filters

- **A jq program is a "filter" : it takes an input, and produces an output.**
    - There are a lot of builtin filters for extracting a particular field of an object, or converting a number to a string, or various other standard tasks.
- Filters can be combined in various ways - you can pipe the output of one filter  into  another  filter, or collect the output of a filter into an array.
- Some filters produce multiple results, for instance there's one that produces all the elements of its input array.
    - Piping that filter into a second runs the second filter for each element of  the  array.
    - Generally, things  that  would  be  done  with  loops and iteration in other languages are just done by gluing filters together in jq.
- It's important to remember that every filter has an input and an output.
    - Even literals like "hello"  or  42 are filters - they take an input but always produce the same literal as output.
    - Operations that combine two filters, like addition, generally feed the same input to both and combine the results.
    - So, you  can  implement  an  averaging  filter as add / length - feeding the input array both to the add filter and the length filter and then performing the division.
- _But that's getting ahead of ourselves._
    - :) _Let's start with something simpler :_

## Invoking JQ

`jq` filters run on a stream of JSON data.

- The input to jq is parsed as a  sequence  of  whitespace-separated JSON  values  which  are  passed through the provided filter one at a time.
- The output(s) of the filter are written to standard out, again as a sequence of whitespace-separated JSON data.

Note: it is important to mind the shell's quoting rules.

- As a general rule it's best to always quote  (with single-quote  characters)  the jq program, as too many characters with special meaning to jq are also shell meta-characters.
- For example, jq "foo" will fail on most Unix shells because that will be the  same  as  jq foo,  which  will generally fail because foo is not defined.
- When using the Windows command shell (cmd.exe) it's best to use double quotes around your jq program when given on the command-line  (instead  of  the  -f program-file option), but then double-quotes in the jq program need backslash escaping.

You can affect how jq reads and writes its input and output using some command-line options:

`--version`

- Output the jq version and exit with zero.

--seq:

           Use  the application/json-seq MIME type scheme for separating JSON texts in jq's input and output. This
           means that an ASCII RS (record separator) character is printed before each value on output and an ASCII
           LF  (line  feed)  is  printed  after every output. Input JSON texts that fail to parse are ignored (but
           warned about), discarding all subsequent input until the next RS. This mode also parses the  output  of
           jq without the --seq option.

## Options

## Usage

```bash
$ echo '{
    "ver": "1.0",
    "soa": {
        "req": null
    },
    "result": "{\\n\\t\"errno\":0,\\n\\t\"errmsg\":\"success\",\\n\\t\"data\":{\\n\\t\\t\"pageTotal\":0,\\n\\t\\t\"pageIndex\":1,\\n\\t\\t\"pageSize\":10,\\n\\t\\t\"itemTotal\":0,\\n\\t\\t\"items\":[]}}",
    "type": null,
    "ex": null
}' | jq '.result' | sed 's/^"//g' | sed 's/"$//g' | php -r 'echo stripcslashes(readline());' | jq

# output
{
  "errno": 0,
  "errmsg": "success",
  "data": {
    "pageTotal": 0,
    "pageIndex": 1,
    "pageSize": 10,
    "itemTotal": 0,
    "items": []
  }
}
```
