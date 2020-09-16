# jq

> Command-line JSON processor

References

* `man jq`

## Synopsis

```bash
jq [options...] filter [files...]
```

* `jq` can **transform JSON in various ways**, by selecting, iterating, reducing and otherwise mangling JSON documents.
  * _For instance, running the command `jq` `'map(.price) | add'` will take an array of JSON objects as input and return the sum of their "price" fields._
* `jq` can accept text input as well, but by default, `jq` reads a stream of JSON entities \(including numbers and other literals\) from `stdin`.
  * Whitespace is only needed to separate entities such as 1 and 2, and true and false.
  * _One or more files may be specified, in which case `jq` will read input from those instead._
* The `options` are described in the `INVOKING JQ` section; they mostly concern input and output formatting.
  * The `filter` is written in the jq language and specifies how to transform the input file or document.

**Filters**

* **A jq program is a "filter" : it takes an input, and produces an output.**
  * There are a lot of builtin filters for extracting a particular field of an object, or converting a number to a string, or various other standard tasks.
* Filters can be combined in various ways - you can pipe the output of one filter into another filter, or collect the output of a filter into an array.
* Some filters produce multiple results, for instance there's one that produces all the elements of its input array.
  * Piping that filter into a second runs the second filter for each element of the array.
  * Generally, things that would be done with loops and iteration in other languages are just done by gluing filters together in jq.
* It's important to remember that every filter has an input and an output.
  * Even literals like "hello" or 42 are filters - they take an input but always produce the same literal as output.
  * Operations that combine two filters, like addition, generally feed the same input to both and combine the results.
  * So, you can implement an averaging filter as add / length - feeding the input array both to the add filter and the length filter and then performing the division.
* _But that's getting ahead of ourselves._
  * :\) _Let's start with something simpler :_

## Options

> Invoking JQ

`jq` filters run on a stream of JSON data.

* The input to jq is parsed as a sequence of whitespace-separated JSON values which are passed through the provided filter one at a time.
* The output\(s\) of the filter are written to standard out, again as a sequence of whitespace-separated JSON data.

Note: it is important to mind the shell's quoting rules.

* As a general rule **it's best to always quote \(with single-quote characters\) the jq program**, as too many characters with special meaning to jq are also shell meta-characters.
* _For example, **`jq "foo"` will fail** on most Unix shells because that will be the same as `jq foo`, which will generally fail because **foo is not defined**._
* _When using the Windows command shell \(`cmd.exe`\) it's best to use double quotes around your jq program when given on the command-line \(instead of the `-f program-file` option\), but then double-quotes in the jq program need backslash escaping._

You can affect how jq reads and writes its input and output using some command-line options:

_`--version`_

* Output the jq version and exit with zero.

_`--seq`_

* _**Use the `application/json-seq` MIME type scheme for separating JSON texts in jq's input and output.**_
  * _This means that an ASCII RS \(record separator\) character is printed before each value on output and an ASCII LF \(line feed\) is printed after every output._
  * _Input JSON texts that fail to parse are ignored \(but warned about\), discarding all subsequent input until the next RS._
  * _This mode also parses the output of jq without the --seq option._

_`--stream`_

* _**Parse the input in streaming fashion, outputing arrays of path and leaf values** \(scalars and empty arrays or empty objects\)._
  * _For example, `"a"` becomes `[[],"a"]`, and `[[],"a",["b"]]` becomes `[[0],[]]`, `[[1],"a"]`, and `[[1,0],"b"]`._
  * _This is useful for processing very large inputs._
  * _Use this in conjunction with filtering and the reduce and `foreach` syntax to reduce large inputs incrementally._

_`--slurp/-s`_

* _Instead of running the filter for each JSON object in the input, **read the entire input stream into a large array and run the filter just once.**_

_`--raw-input/-R`_

* _**Don't parse the input as JSON.**_
  * _Instead, each line of text is passed to the filter as a string._
  * _If combined with `--slurp`, then the entire input is passed to the filter as a single long string._

_`--null-input/-n`_

* _**Don't read any input at all!**_
  * _Instead, the filter is run once using `null` as the input._
  * This is useful when using jq as a simple calculator or to construct JSON data from scratch.

`--compact-output / -c`

* By default, jq pretty-prints JSON output.
* Using this option will **result in more compact output** by instead putting each JSON object on a single line.

`--tab`

* **Use a tab for each indentation level instead of two spaces.**

**`--indent n`**

* **Use the given number of spaces \(no more than 8\) for indentation.**

`--color-output / -C` and `--monochrome-output / -M`

* By default, jq outputs colored JSON if writing to a terminal.
  * You can **force it to produce color even if writing to a pipe or a file using `-C`, and disable color with `-M`**.
* Colors can be configured with the `JQ_COLORS` environment variable \(see below\).

**`--ascii-output / -a`**

* jq usually outputs non-ASCII Unicode codepoints as UTF-8, even if the input specified them as escape sequences \(like "\u03bc"\).
  * Using this option, you can **force jq to produce pure ASCII output with every non-ASCII character replaced with the equivalent escape sequence.**

_`--unbuffered`_

* _**Flush the output after each JSON object is printed** \(useful if you're piping a slow data source into jq and piping jq's output elsewhere\)._

**`--sort-keys / -S`**

* Output the fields of each object with the keys in sorted order.

```bash
$ echo '{
    "b": "ice",
    "c": "bad",
    "a": "he"
}' | jq --sort-keys

# output
{
  "a": "he",
  "b": "ice",
  "c": "bad"
}
```

**`--raw-output / -r`**

* With this option, if the filter's result is a string then it will be **written directly to standard output rather than being formatted as a JSON string with quotes.**
  * This can be useful for making jq filters talk to non-JSON-based systems.

`--join-output / -j`

* **Like `-r` but jq won't print a newline after each output.**

**`-f filename / --from-file filename`**

* **Read filter from the file rather than from a command line**, like awk's `-f` option.
  * You can also use '\#' to make comments.

_`-Ldirectory / -L directory`_

* _**Prepend directory to the search list for modules.**_
  * _If this option is used then no builtin search list is used._
  * _See the section on modules below._

`-e / --exit-status`

* Sets the exit status of jq to 0 if the last output values was neither `false` nor `null`, 1 if the last output value was either `false` or `null`, or 4 if no valid result was ever produced.
  * Normally jq exits with 2 if there was any usage problem or system error, 3 if there was a jq program compile error, or 0 if the jq program ran.
* _Another way to set the exit status is with the `halt_error` builtin function._

**`--arg name value`**

* This option **passes a value to the jq program as a predefined variable.**
  * If you run jq with `--arg foo bar`, then `$foo` is available in the program and has the value `"bar"`.
  * Note that value will be treated as a string, so `--arg foo 123` will bind `$foo` to `"123"`.
* Named arguments are also available to the jq program as `$ARGS.named`.

**`--argjson name JSON-text`**

* This option **passes a JSON-encoded value to the jq program as a predefined variable.**
  * If you run jq with `--argjson foo 123`, then `$foo` is available in the program and has the value "123".

```bash
$ echo '{}' | jq --arg foo '[]' '$foo'
"[]"
$ echo '{}' | jq --argjson foo '[]' '$foo'
[]
```

_`--slurpfile variable-name filename`_

* _This option **reads all the JSON texts in the named file and binds an array of the parsed JSON values to the given global variable.**_
  * _If you run jq with `--argfile` foo bar, then `$foo` is available in the program and has an array whose elements correspond to the texts in the file named bar._

~~`--argfile variable-name filename`~~

* _Do not use. Use `--slurpfile` instead._
  * _\(This option is like `--slurpfile`, but when the file has just one text, then that is used, else an array of texts is used as in `--slurpfile`.\)_

`--args`

* **Remaining arguments are positional string arguments.**
  * These are available to the jq program as `$ARGS.positional[]`.

`--jsonargs`

* **Remaining arguments are positional JSON text arguments.**
  * These are available to the jq program as `$ARGS.positional[]`.

`--run-tests [filename]`

* **Runs the tests in the given file or standard input.**
  * This **must be the last option given** and does not honor all preceding options.
  * The input consists of comment lines, empty lines, and program lines followed by one input line, as many lines of output as are expected \(one per output\), and a terminating empty line.
  * Compilation failure tests start with a line containing only "%%FAIL", then a line containing the program to compile, then a line containing an error message to compare to the actual.
* Be warned that this option can change backwards-incompatibly.

## Basic Filters

### Identity `.`

The absolute simplest filter is `.` .

* This is a filter that takes its input and produces it unchanged as output.
  * That is, this is the **identity operator**.
  * Since jq by default pretty-prints all output, this trivial program can be a useful way of formatting JSON output from, say, curl.

```bash
$ echo '{}' | jq '.'
{}
```

### Object Identifier-Index `.foo, .foo.bar`

The simplest useful filter is .foo. When given a JSON object \(aka dictionary or hash\) as input, it produces the value at the key "foo", or null if there's none present.

A filter of the form .foo.bar is equivalent to .foo\|.bar.

This syntax only works for simple, identifier-like keys, that is, keys that are all made of alphanumeric characters and underscore, and which do not start with a digit.

If the key contains special characters, you need to surround it with double quotes like this: ."foo$", or else .\["foo$"\].

For example .\["foo::bar"\] and .\["foo.bar"\] work while .foo::bar does not, and .foo.bar means .\["foo"\].\["bar"\].

jq '.foo' {"foo": 42, "bar": "less interesting data"} =&gt; 42

jq '.foo' {"notfoo": true, "alsonotfoo": false} =&gt; null

jq '.\["foo"\]' {"foo": 42} =&gt; 42

## Usage

### Sort Keys

```bash
$ echo '{
    "b": "ice",
    "c": "bad",
    "a": "he"
}' | jq --sort-keys

# output
{
  "a": "he",
  "b": "ice",
  "c": "bad"
}
```

### Example 1

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

