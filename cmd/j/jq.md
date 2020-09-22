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

**Filters**

- **A jq program is a "filter" : it takes an input, and produces an output.**
    - There are a lot of builtin filters for extracting a particular field of an object, or converting a number to a string, or various other standard tasks.
- Filters can be combined in various ways - you can pipe the output of one filter into another filter, or collect the output of a filter into an array.
- Some filters produce multiple results, for instance there's one that produces all the elements of its input array.
    - Piping that filter into a second runs the second filter for each element of the array.
    - Generally, things that would be done with loops and iteration in other languages are just done by gluing filters together in jq.
- It's important to remember that every filter has an input and an output.
    - Even literals like "hello" or 42 are filters - they take an input but always produce the same literal as output.
    - Operations that combine two filters, like addition, generally feed the same input to both and combine the results.
    - So, you can implement an averaging filter as add / length - feeding the input array both to the add filter and the length filter and then performing the division.
- _But that's getting ahead of ourselves._
    - :) _Let's start with something simpler :_

## Options

> Invoking JQ

`jq` filters run on a stream of JSON data.

- The input to jq is parsed as a sequence of whitespace-separated JSON values which are passed through the provided filter one at a time.
- The output(s) of the filter are written to standard out, again as a sequence of whitespace-separated JSON data.

Note: it is important to mind the shell's quoting rules.

- As a general rule **it's best to always quote (with single-quote characters) the jq program**, as too many characters with special meaning to jq are also shell meta-characters.
- _For example, **`jq "foo"` will fail** on most Unix shells because that will be the same as `jq foo`, which will generally fail because **foo is not defined**._
- _When using the Windows command shell (`cmd.exe`) it's best to use double quotes around your jq program when given on the command-line (instead of the `-f program-file` option), but then double-quotes in the jq program need backslash escaping._

You can affect how jq reads and writes its input and output using some command-line options:

_`--version`_

- Output the jq version and exit with zero.

_`--seq`_

- _**Use the `application/json-seq` MIME type scheme for separating JSON texts in jq's input and output.**_
    - _This means that an ASCII RS (record separator) character is printed before each value on output and an ASCII LF (line feed) is printed after every output._
    - _Input JSON texts that fail to parse are ignored (but warned about), discarding all subsequent input until the next RS._
    - _This mode also parses the output of jq without the --seq option._

_`--stream`_

- _**Parse the input in streaming fashion, outputing arrays of path and leaf values** (scalars and empty arrays or empty objects)._
    - _For example, `"a"` becomes `[[],"a"]`, and `[[],"a",["b"]]` becomes `[[0],[]]`, `[[1],"a"]`, and `[[1,0],"b"]`._
    - _This is useful for processing very large inputs._
    - _Use this in conjunction with filtering and the reduce and `foreach` syntax to reduce large inputs incrementally._

_`--slurp/-s`_

- _Instead of running the filter for each JSON object in the input, **read the entire input stream into a large array and run the filter just once.**_

_`--raw-input/-R`_

- _**Don't parse the input as JSON.**_
    - _Instead, each line of text is passed to the filter as a string._
    - _If combined with `--slurp`, then the entire input is passed to the filter as a single long string._

_`--null-input/-n`_

- _**Don't read any input at all!**_
    - _Instead, the filter is run once using `null` as the input._
    - This is useful when using jq as a simple calculator or to construct JSON data from scratch.

`--compact-output / -c`

- By default, jq pretty-prints JSON output.
- Using this option will **result in more compact output** by instead putting each JSON object on a single line.

`--tab`

- **Use a tab for each indentation level instead of two spaces.**

**`--indent n`**

- **Use the given number of spaces (no more than 8) for indentation.**

`--color-output / -C` and `--monochrome-output / -M`

- By default, jq outputs colored JSON if writing to a terminal.
    - You can **force it to produce color even if writing to a pipe or a file using `-C`, and disable color with `-M`**.
- Colors can be configured with the `JQ_COLORS` environment variable (see below).

**`--ascii-output / -a`**

- jq usually outputs non-ASCII Unicode codepoints as UTF-8, even if the input specified them as escape sequences (like "\u03bc").
    - Using this option, you can **force jq to produce pure ASCII output with every non-ASCII character replaced with the equivalent escape sequence.**

_`--unbuffered`_

- _**Flush the output after each JSON object is printed** (useful if you're piping a slow data source into jq and piping jq's output elsewhere)._

**`--sort-keys / -S`**

- Output the fields of each object with the keys in sorted order.

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

- With this option, if the filter's result is a string then it will be **written directly to standard output rather than being formatted as a JSON string with quotes.**
    - This can be useful for making jq filters talk to non-JSON-based systems.

`--join-output / -j`

- **Like `-r` but jq won't print a newline after each output.**

**`-f filename / --from-file filename`**

- **Read filter from the file rather than from a command line**, like awk's `-f` option.
    - You can also use '#' to make comments.

_`-Ldirectory / -L directory`_

- _**Prepend directory to the search list for modules.**_
    - _If this option is used then no builtin search list is used._
    - _See the section on modules below._

`-e / --exit-status`

- Sets the exit status of jq to 0 if the last output values was neither `false` nor `null`, 1 if the last output value was either `false` or `null`, or 4 if no valid result was ever produced.
    - Normally jq exits with 2 if there was any usage problem or system error, 3 if there was a jq program compile error, or 0 if the jq program ran.
- _Another way to set the exit status is with the `halt_error` builtin function._

**`--arg name value`**

- This option **passes a value to the jq program as a predefined variable.**
    - If you run jq with `--arg foo bar`, then `$foo` is available in the program and has the value `"bar"`.
    - Note that value will be treated as a string, so `--arg foo 123` will bind `$foo` to `"123"`.
- Named arguments are also available to the jq program as `$ARGS.named`.

**`--argjson name JSON-text`**

- This option **passes a JSON-encoded value to the jq program as a predefined variable.**
    - If you run jq with `--argjson foo 123`, then `$foo` is available in the program and has the value "123".

```bash
$ echo null | jq --arg foo '[]' '$foo'
"[]"
$ echo null | jq --argjson foo '[]' '$foo'
[]
```

_`--slurpfile variable-name filename`_

- _This option **reads all the JSON texts in the named file and binds an array of the parsed JSON values to the given global variable.**_
    - _If you run jq with `--argfile` foo bar, then `$foo` is available in the program and has an array whose elements correspond to the texts in the file named bar._

~~`--argfile variable-name filename`~~

- _Do not use. Use `--slurpfile` instead._
    - _(This option is like `--slurpfile`, but when the file has just one text, then that is used, else an array of texts is used as in `--slurpfile`.)_

`--args`

- **Remaining arguments are positional string arguments.**
    - These are available to the jq program as `$ARGS.positional[]`.

`--jsonargs`

- **Remaining arguments are positional JSON text arguments.**
    - These are available to the jq program as `$ARGS.positional[]`.

`--run-tests [filename]`

- **Runs the tests in the given file or standard input.**
    - This **must be the last option given** and does not honor all preceding options.
    - The input consists of comment lines, empty lines, and program lines followed by one input line, as many lines of output as are expected (one per output), and a terminating empty line.
    - Compilation failure tests start with a line containing only "%%FAIL", then a line containing the program to compile, then a line containing an error message to compare to the actual.
- Be warned that this option can change backwards-incompatibly.

## Basic Filters

### Identity `.`

The absolute simplest filter is `.` .

- This is a filter that takes its input and produces it unchanged as output.
    - That is, this is the **identity operator**.
- Since jq by default pretty-prints all output, this trivial program can be a useful way of formatting JSON output from, say, curl.

```bash
$ echo '{}' | jq '.'
{}
```

### Object Identifier-Index

`.foo, .foo.bar`

- The simplest useful filter is `.foo`.
    - When given a JSON object (aka dictionary or hash) as input, it produces the value at the key "foo", or null if there's none present.
- A filter of the form `.foo.bar` is equivalent to `.foo|.bar`.
- _This syntax only works for simple, identifier-like keys, that is, keys that are all made of alphanumeric characters and underscore, and which do not start with a digit._
- **If the key contains special characters**, you need to **surround it with double quotes** like this: `."foo$"`, or else `.["foo$"]`.
- For example `.["foo::bar"]` and `.["foo.bar"]` work while .foo::bar does not, and .foo.bar means .["foo"].["bar"].

```bash
# .foo
$ echo '{"foo": 42, "bar": "less interesting data"}' | jq '.foo'
42

# .cat
$ echo '{"foo": 42, "bar": "less interesting data"}' | jq '.cat'
null

# ."foo"
$ echo '{"foo": 42, "bar": "less interesting data"}' | jq '."foo"'
42

# .["foo"]
$ echo '{"foo": 42, "bar": "less interesting data"}' | jq '.["foo"]'
42
```

### Optional Object Identifier-Index

`.foo?`

- Just like `.foo`, but **does not output even an error when `.` is not an array or an object.**

```bash
# .foo?
$ echo '{"foo": 42, "bar": "less interesting data"}' | jq '.foo?'
42

# .cat?
$ echo '{"foo": 42, "bar": "less interesting data"}' | jq '.cat?'
null

# ."foo"?
$ echo '{"foo": 42, "bar": "less interesting data"}' | jq '."foo"?'
42

# .["foo"]?
$ echo '{"foo": 42, "bar": "less interesting data"}' | jq '.["foo"]?'
42

##############################
# Differ `.foo?` from `.foo` #
##############################

# .foo
$ echo '[1,2,3]' | jq '.foo'
# output error
jq: error (at <stdin>:1): Cannot index array with string "foo"

# .foo?
$ echo '[1,2,3]' | jq '.foo?'
# output nothing
```

### _Generic Object Index_

`.[<string>]`

- You can also look up fields of an object using syntax like `.["foo"]` (`.foo` above is a shorthand version of this, but only for identifier-like strings).

### Array Index

`.[2]`

- When the index value is an integer, **`.[<value>]` can index arrays.**
    - **Arrays are zero-based, so `.[2]` returns the third element**.
- Negative indices are allowed, with **`-1` referring to the last element**, `-2` referring to the next to last element, and so on.

```bash
# .[0]
$ echo '[{"name":"JSON", "good":true}, {"name":"XML", "good":false}]' | jq '.[0]'
{
  "name": "JSON",
  "good": true
}

# .[2]
$ echo '[{"name":"JSON", "good":true}, {"name":"XML", "good":false}]' | jq '.[2]'
null

# .[-2]
$ echo '[1,2,3]' | jq '.[-2]'
2
```

### Array/String Slice

`.[10:15]`

- The `.[10:15]` syntax can be used to **return a subarray of an array or substring of a string.**
    - The array returned by **`.[10:15]`** will be of **length 5, containing the elements from index 10 (inclusive) to index 15 (exclusive).**
    - **Either index may be negative** ( in which case it **counts backwards from the end of the array** ) , or omitted (in which case it refers to the start or end of the array).

```bash
# .[2:4]
$ echo '[0,1,2,3,4]' | jq '.[2:4]'
[
  2,
  3
]

# .[2:4]
$ echo '"01234"' | jq '.[2:4]'
"23"

# .[:2]
$ echo '[0,1,2,3,4]' | jq '.[:2]'
[
  0,
  1
]

# .[3:]
$ echo '[0,1,2,3,4]' | jq '.[3:]'
[
  3,
  4
]

# .[-2:]
$ echo '[0,1,2,3,4]' | jq '.[-2:]'
[
  3,
  4
]

# .[-2:-1]
$ echo '[0,1,2,3,4]' | jq '.[-2:-1]'
[
  3
]
```

### Array/Object Value Iterator

`.[]`

- If you use the .[index] syntax, but **omit the index entirely, it will return all of the elements of an array.**
    - _Running `.[]` with the input `[1,2,3]` will produce the numbers as three separate results, rather than as a single array._
- You can also use this on an object, and it will return all the values of the object.

```bash
# .[]
$ echo '[{"name":"JSON", "good":true}, {"name":"XML", "good":false}]' | jq '.[]'
{
  "name": "JSON",
  "good": true
}
{
  "name": "XML",
  "good": false
}

$ echo '[]' | jq '.[]'
# output nothing

$ echo '{"a":1, "b":2}' | jq '.[]'
1
2
```

### Optional Array/Object Value Iterator

`.[]?`

- Like `.[]`, but **no errors will be output if `.` is not an array or object.**

### Comma

`,`

- **If two filters are separated by a comma, then the same input will be fed into both and the two filters' output value streams will be concatenated in order** :
    - first, all of the outputs produced by the left expression,
    - and then all of the outputs produced by the right.
- For instance, filter `.foo`, `.bar`, produces both the "foo" fields and "bar" fields as separate outputs.

```bash
# .foo, .bar
$ echo '{"foo": 42, "bar": "something else", "baz": true}' | jq '.foo, .bar'
42
"something else"

# .user, .projects[]
$ echo '{"user":"stedolan", "projects": ["jq", "wikiflow"]}' | jq '.user, .projects[]'
"stedolan"
"jq"
"wikiflow"

# .[4, 2]
$ echo '[0,1,2,3,4]' | jq '.[4, 2]'
4
2
```

### Pipe

`|`

- The `|` operator **combines two filters by feeding the output(s) of the one on the left into the input of the one on the right.**
    - It's pretty much the same **as the Unix shell's pipe**, if you're used to that.
- If the one on the left produces multiple results, the one on the right will be run for each of those results.
    - So, the expression `.[] | .foo` retrieves the "foo" field of each element of the input array.
- _Note that `.a.b.c` is the same as `.a | .b | .c`._
- _Note too that `.` is the input value at the particular stage in a "pipeline", specifically: where the `.` expression appears._
    - _Thus `.a | . | .b` is the same as `.a.b`, as the `.` in the middle refers to whatever value `.a` produced._

```bash
echo '[{"name":"JSON", "good":true}, {"name":"XML", "good":false}]' | jq '.[] | .name'
"JSON"
"XML"
```

### Parenthesis

`()`

- Parenthesis work as a **grouping operator just as in any typical programming language.**

```bash
# (. + 2) * 5
$ echo 1 | jq '(. + 2) * 5'
15

# .[2] | (. + 2) * 5
$ echo '[0,1,2]' | jq '.[2] | (. + 2) * 5'
20
```

## Types and Values

- jq supports the same set of datatypes as JSON - **numbers, strings, booleans, arrays, objects** (which in JSON-speak are hashes with only string keys), **and "null"**.
- Booleans, null, strings and numbers are written the same way as in javascript.
    - Just like everything else in jq, these simple values take an input and produce an output - 42 is a valid jq expression that takes an input, ignores it, and returns 42 instead.

### Array construction

`[]`

- As in JSON, `[]` is used to construct arrays, as in `[1,2,3]`.
    - The elements of the arrays can be any jq expression, including a pipeline.
    - All of the results produced by all of the expressions are collected into one big array.
    - You can use it to construct an array out of a known quantity of values (as in `[.foo, .bar, .baz]`) or to "collect" all the results of a filter into an array (as in `[.items[].name]`)
- Once you understand the `,` operator, you can look at jq's array syntax in a different light :
    - the expression `[1,2,3]` is not using a built-in syntax for comma-separated arrays, but is instead applying the `[]` operator (collect results) to the expression `1,2,3` (which produces three different results).
- If you have a filter `X` that produces **four results, then the expression `[X]` will produce a single result**, an array of four elements.

```bash
# .foo, .baz, .bar
$ echo '{"foo":123,"bar":true,"baz":"icehe"}' | jq '.foo, .baz, .bar'
123
"icehe"
true

# [.foo, .baz, .bar]
$ echo '{"foo":123,"bar":true,"baz":"icehe"}' | jq '[.foo, .baz, .bar]'
[
  123,
  "icehe",
  true
]
```

```bash
# .items
$ echo '{"items":[{"name":"app"},{"name":"boy"}]}' | jq '.items'
[
  {
    "name": "app"
  },
  {
    "name": "boy"
  }
]

# .items[]
$ echo '{"items":[{"name":"app"},{"name":"boy"}]}' | jq '.items[]'
{
  "name": "app"
}
{
  "name": "boy"
}

# .items[.name]
$ echo '{"items":[{"name":"app"},{"name":"boy"}]}' | jq '.items[.name]'
jq: error (at <stdin>:1): Cannot index array with null

# .items[].name
$ echo '{"items":[{"name":"app"},{"name":"boy"}]}' | jq '.items[].name'
"app"
"boy"

# [.items[].name]
$ echo '{"items":[{"name":"app"},{"name":"boy"}]}' | jq '[.items[].name]'
[
  "app",
  "boy"
]

# [.owner, .items[].name]
$ echo '{"owner":"cat","items":[{"name":"app"},{"name":"boy"}]}' | jq '[.owner, .items[].name]'
# output
[
  "cat",
  "app",
  "boy"
]

# [.[] * 2]
$ echo '[1,2,3]' | jq '[.[] * 2]'
[
  2,
  4,
  6
]
```

### Object Construction

`{}`

- Like JSON, `{}` is for **constructing objects (aka dictionaries or hashes)**, as in: `{"a": 42, "b": 17}`.
    - If the keys are "identifier-like", then the quotes can be left off, as in `{a:42, b:17}`.
    - **Keys generated by expressions need to be parenthesized**, e.g., `{("a"+"b"):59}`.
- The value can be any expression (although you may need to wrap it in parentheses if it's a complicated one), which gets applied to the {} expression's input (remember, all filters have an input and an output).

```bash
# {foo: .bar}
$ echo '{"bar":42, "baz":43}' | jq '{foo: .bar}'
{
  "foo": 42
}
```

- You can use this to **select particular fields of an object** :
    - if the input is an object with "user", "title", "id", and "content" fields and you just want "user" and "title".
    - Because that is so common, there's a **shortcut syntax for it: `{user, title}`.**

```bash
# {user, title}
$ echo '{"id":1,"user":"icehe","title":"vegetable","content":"nothing"}' | jq '{user, title}'
{
  "user": "icehe",
  "title": "vegetable"
}
```

- If one of the expressions **produces multiple results**, multiple dictionaries will be produced.

```bash
# {user, title: .titles[]}
$ echo '{"user":"stedolan","titles":["JQ Primer", "More JQ"]}' | jq '{user, title: .titles[]}'
{
  "user": "stedolan",
  "title": "JQ Primer"
}
{
  "user": "stedolan",
  "title": "More JQ"
}
```

- **Putting parentheses around the key means it will be evaluated as an expression**.

```bash
# {(.user): .titles}
$ echo '{"user":"stedolan","titles":["JQ Primer", "More JQ"]}' | jq '{(.user): .titles}'
{
  "stedolan": [
    "JQ Primer",
    "More JQ"
  ]
}

# {(.user): .titles[]}
$ echo '{"user":"stedolan","titles":["JQ Primer", "More JQ"]}' | jq '{(.user): .titles[]}'
{
  "stedolan": "JQ Primer"
}
{
  "stedolan": "More JQ"
}
```

### Recursive Descent

`..`

- **Recursively descends `.`, producing every value.**
    - This is the same as the **zero-argument `recurse` builtin** (see below).
    - This is intended to resemble the XPath `//` operator.
    - Note that `..a` does not work; use `..|.a` instead.
    - In the example below we use `..|.a?` to find all the values of object keys "a" in any object found "below" `.`.
- _This is particularly useful in conjunction with `path(EXP)` (also see below) and the `?` operator._

```bash
# ..
$ echo '[[{"a":1}]]' | jq '..'
[
  [
    {
      "a": 1
    }
  ]
]
[
  {
    "a": 1
  }
]
{
  "a": 1
}
1

# ..a
$ echo '[[{"a":1}]]' | jq '..a'
# output error
jq: error: syntax error, unexpected IDENT, expecting $end (Unix shell quoting issues?) at <top-level>, line 1:
..a
jq: 1 compile error

# ..|.a
$ echo '[[{"a":1}]]' | jq '..|.a'
# output error
jq: error (at <stdin>:1): Cannot index array with string "a"

# ..|.a?
$ echo '[[{"a":1}]]' | jq '..|.a?'
1
```

## Builtin Operators and Functions

- Some jq operator (for instance, `+`) do different things depending on the type of their arguments (arrays, numbers, etc.).
    - However, jq never does implicit type conversions.
    - If you try to add a string to an object you'll get an error message and no result.

### Addition

`+`

The operator `+` **takes two filters, applies them both to the same input, and adds the results together.**

- What "adding" means depends on the types involved:
    - **Numbers** are added by **normal arithmetic.**
    - **Arrays** are added by being **concatenated into a larger array.**
    - **Strings** are added by being **joined into a larger string.**
    - **Objects** are added by merging, that is, **inserting all the key-value pairs from both objects into a single combined object.**
        - If both objects contain a value for the **same key, the object on the right of the `+` wins.**
        - (For recursive merge use the `*` operator.)
    - `null` can be added to any value, and returns the other value unchanged.

```bash
# .a + 2
$ echo '{"a": 1}' | jq '.a + 2'
3

# .a + 2.2
$ echo '{"a": 1.1}' | jq '.a + 2.2'
3.3000000000000003

# .a + .b
$ echo '{"a": [1, 2], "b": [3, 4]}' | jq '.a + .b'
[
  1,
  2,
  3,
  4
]

# .a + [5, 6]
$ echo '{"a": [1, 2], "b": [3, 4]}' | jq '.a + [5, 6]'
[
  1,
  2,
  5,
  6
]

# .a + .b
$ echo '{"a": "foo", "b": "bar"}' | jq '.a + .b'
"foobar"

# .a + "ple"
$ echo '{"a": "app"}' | jq '.a + "ple"'
"appple"

# .a + .b
$ echo '{"a": {"h": "haha", "k":"cool"}, "b": {"k":"kiss"}}' | jq '.a + .b'
{
  "h": "haha",
  "k": "kiss"
}

# .a + null
$ echo '{"a": 1}' | jq '.a + null'
1
```

### Subtraction

`-`

- As well as **normal arithmetic subtraction on numbers**, the `-` operator can be **used on arrays to remove all occurrences of the second array's elements from the first array.**

```bash
# .a - 1
$ echo '{"a": 3}' | jq '.a - 1'
2

# 4 - .a
$ echo '{"a": 3}' | jq '4 - .a'
1

# . - ["a", "b"]
$ echo '["a", "b", "c"]' | jq '. - ["a", "b"]'
[
  "c"
]

# ["a", "b", "c"] - .
$ echo '["a", "b"]' | jq '["a", "b", "c"] - .'
[
  "c"
]

# ["a"] - .
$ echo '["a", "b"]' | jq '["a"] - .'
[]
```

### Multiplication, Division, Modulo

`*`, `/`, and `%`

- These infix operators behave as expected when given two numbers.
    - Division by zero raises an error.
    - `x % y` computes x modulo y.
- **Multiplying a string by a number** produces **the concatenation of that string that many times.**
    - `"x" * 0` produces `null`.
- **Dividing a string by another splits the first using the second as separators**.
- **Multiplying two objects** will **merge them recursively** :
    - this works like addition but if both objects contain a value for the same key, and the values are objects, the two are merged with the same strategy.

```bash
# 10 / . * 3
$ echo 5 | jq '10 / . * 3'
6

# . % 5
echo 7 | jq '. % 5'
2

# . / ", "
$ echo 'a, b,c,d, e' | jq '. / ", "'
# output error
parse error: Invalid numeric literal at line 1, column 2

# . / ", "
$ echo '"a, b,c,d, e"' | jq '. / ", "'
[
  "a",
  "b,c,d",
  "e"
]

# {"k": {"a": 1, "b": 2}} * {"k": {"a": 0,"c": 3}}
$ echo null | jq '{"k": {"a": 1, "b": 2}} * {"k": {"a": 0,"c": 3}}'
{
  "k": {
    "a": 0,
    "b": 2,
    "c": 3
  }
}

# {"a": 1, "b": 2} * {"a": 0,"c": 3}
$ echo null | jq '{"a": 1, "b": 2} * {"a": 0,"c": 3}'
{
  "a": 0,
  "b": 2,
  "c": 3
}

# .[] | (6 / .)
$ echo '[2, 0, -3]' | jq '.[] | (6 / .)'
3
jq: error (at <stdin>:1): number (6) and number (0) cannot be divided because the divisor is zero

# .[] | (6 / .)?
$ echo '[2, 0, -3]' | jq '.[] | (6 / .)?'
3
-2

# [.[] | (6 / .)?]
$ echo '[2, 0, -3]' | jq '[.[] | (6 / .)?]'
[
  3,
  -2
]
```

### Length

`length`

- The builtin function `length` gets the length of various different types of value:
    - The length of a string is the number of Unicode codepoints it contains (which will be the same as its JSON-encoded length in bytes if it's pure ASCII).
    - The length of an array is the number of elements.
    - The length of an object is the number of key-value pairs.
    - The length of null is zero.

```bash
# [.[] | length]
$ echo '[[1,2], "string", {"a":2}, null]' | jq '[.[] | length]'
[
  2,
  6,
  1,
  0
]
```

### UTF8 Byte Length

`utf8bytelength`

- The builtin function `utf8bytelength` outputs the **number of bytes used to encode a string in UTF-8.**

```bash
$ echo '"\u03bc"'
"μ"

# . | utf8bytelength
$ echo '"\u03bc"' | jq '. | utf8bytelength'
2
```

### Keys and Keys Unsorted

`keys`, `keys_unsorted`

- The builtin function `keys`, when **given an object, returns its keys in an array.**
- The keys are **sorted "alphabetically", by unicode codepoint order.**
    - This is not an order that makes particular sense in any particular language, but you can count on it being the same for any two objects with the same set of keys, regardless of locale settings.
- When `keys` is given an array, it returns the valid indices for that array: the integers from 0 to `length-1`.
- The `keys_unsorted` function is just like keys, but if the input is an object then the keys will not be sorted, instead the keys will roughly be in insertion order.

```bash
# keys
$ echo '{"app": 3, "boy": 5, "apple": 1}' | jq 'keys'
[
  "app",
  "apple",
  "boy"
]

# keys_unsorted
$ echo '{"app": 3, "boy": 5, "apple": 1}' | jq 'keys_unsorted'
[
  "app",
  "boy",
  "apple"
]

# keys
$ echo '[3, 5, 1]' | jq 'keys'
[
  0,
  1,
  2
]
```

### Has Key

`has(key)`

- The builtin function `has` **returns whether the input object has the <u>given key</u>, or the input array has an element at the <u>given index</u>.**
- `has($key)` has the same effect as checking whether `$key` is a member of the array returned by keys, although has will be faster.

```bash
# has("foo")
$ echo '{"foo": 42}' | jq 'has("foo")'
true

# [.[] | has("foo")]
$ echo '[{"foo": 42}, {}]' | jq '[.[] | has("foo")]'
[
  true,
  false
]

# map(has("foo"))
$ echo '[{"foo": 42}, {}]' | jq 'map(has("foo"))'
[
  true,
  false
]

# map(has(2))
$ echo '[[0, 1], ["a", "b", "c"]]' | jq 'map(has(2))'
[
  false,
  true
]

# map(has(1))
$ echo '[[0, 1], ["a", "b", "c"]]' | jq 'map(has(1))'
[
  true,
  true
]


# map(has(3))
$ echo '[[0, 1], ["a", "b", "c"]]' | jq 'map(has(3))'
[
  false,
  false
]
```

### In

`in`

- The builtin function `in` **returns whether or not the input key is in the given object, or the input <u>index</u> corresponds to an element in the given array.**
    - It is, essentially, an inversed version of `has`.

```bash
# [.[] | in({"foo": 42})]
$ echo '["foo", "bar"]' | jq '[.[] | in({"foo": 42})]'
[
  true,
  false
]

# map(in([0, 1]))
$ echo '[0, 2]' | jq 'map(in([0, 1]))'
[
  true,
  false
]
```

### Map and Map Values

`map(x)`, `map_values(x)`

- For any filter `x`, `map(x)` will **run that filter for each element of the input array, and return the outputs in a new array.**
    - `map(.+1)` will increment each element of an array of numbers.
- Similarly, `map_values(x)` will run that filter for each element, but it will return an object when an object is passed.
- `map(x)` is equivalent to `[.[] | x]`.
    - In fact, this is how it's defined. Similarly, `map_values(x)` is defined as `.[] |= x`.

```bash
# map(. * 2)
$ echo '[1, 2, 3]' | jq 'map(. * 2)'
[
  2,
  4,
  6
]

# map(. + 5)
$ echo '{"a": 1, "b": 2, "c": 3}' | jq 'map(. + 5)'
[
  6,
  7,
  8
]

# map_values(. + 5)
$ echo '{"a": 1, "b": 2, "c": 3}' | jq 'map_values(. + 5)'
{
  "a": 6,
  "b": 7,
  "c": 8
}
```

### Path

`path(path_expression)`

- **Outputs array representations of the given path expression** in `.`.
    - The outputs are arrays of strings (object keys) and/or numbers (array indices).
- Path expressions are jq expressions like `.a`, but also `.[]`.
    - There are two types of path expressions : ones that can match exactly, and ones that cannot.
    - For example, `.a.b.c` is an exact match path expression, while `.a[].b` is not.
- `path(exact_path_expression)` will produce the array representation of the path expression even if it does not exist in `.`, if `.` is `null` or an array or an object.
- `path(pattern)` will produce array representations of the paths matching `pattern` if the paths exist in `.`.
- Note that the path expressions are not different from normal expressions.
    - The expression `path(..|select(type=="boolean"))` outputs all the paths to boolean values in `.`, and only those paths.

```bash
# path(.a[0].b)
$ echo null | jq 'path(.a[0].b)'
[
  "a",
  0,
  "b"
]

# path(..)
$ echo '{"a":{"b":1}}' | jq 'path(..)'
[]
[
  "a"
]
[
  "a",
  "b"
]

# path(..|select(type=="object"))
$ echo '{"a":{"b": true, "c": "cat"}}' | jq 'path(..|select(type=="object"))'
[]
[
  "a"
]

# path(..|select(type=="boolean"))
$ echo '{"a":{"b": true, "c": "cat"}}' | jq 'path(..|select(type=="boolean"))'
[
  "a",
  "b"
]

# path(..|select(type=="string"))
$ echo '{"a":{"b": true, "c": "cat"}}' | jq 'path(..|select(type=="string"))'
[
  "a",
  "c"
]
```

### Del

`del(path_expression)`

- The builtin function `del` **removes a key and its corresponding value from an object.**

```bash
# del(.foo)
$ echo '{"foo": 42, "bar": 9001, "baz": 42}' | jq 'del(.foo)'
{
  "bar": 9001,
  "baz": 42
}

# del(.[1, 2])
$ echo '["foo", "bar", "baz"]' | jq 'del(.[1, 2])'
[
  "foo"
]
```

### Get Path

`getpath(PATHS)`

- The builtin function `getpath` **outputs the values in `.` found at each path in `PATHS`.**

```bash
# getpath(["a", "b"])
$ echo null | jq 'getpath(["a", "b"])'
null

# getpath(["a", "b"], ["a", "c", "d"])
$ echo '{"a":{"b":2, "c": {"d": 4}}}' | jq 'getpath(["a", "b"], ["a", "c", "d"])'
2
4
```

### Set Path

`setpath(PATHS; VALUE)`

- The builtin function `setpath` **sets the `PATHS` in `.` to `VALUE`.**

```bash
# setpath(["a", "b"]; 1)
$ echo null | jq 'setpath(["a", "b"]; 1)'
{
  "a": {
    "b": 1
  }
}

# setpath(["a", "b"]; 1)
$ echo '{"a": {"b": 0}}' | jq 'setpath(["a", "b"]; 1)'
{
  "a": {
    "b": 1
  }
}

# setpath([0, "a"]; 1)
$ echo null | jq 'setpath([0, "a"]; 1)'
[
  {
    "a": 1
  }
]

# setpath([1, "a"]; 1)
$ echo null | jq 'setpath([1, "a"]; 1)'
[
  null,
  {
    "a": 1
  }
]
```

### Del Paths

`delpaths(PATHS)`

- The builtin function `delpaths` **sets the `PATHS` in `.`.**
    - `PATHS` must be an array of paths, where each path is an array of strings and numbers.

```bash
# delpaths(["a", "b"];)
$ echo '{"a":{"b":1},"x":{"y":2}}' | jq 'delpaths(["a", "b"];)'
jq: error: syntax error, unexpected ')' (Unix shell quoting issues?) at <top-level>, line 1:
delpaths(["a", "b"];)
jq: 1 compile error

# delpaths([["a", "b"]])
$ echo '{"a":{"b":1},"x":{"y":2}}' | jq 'delpaths([["a", "b"]])'
{
  "a": {},
  "x": {
    "y": 2
  }
}
```

### Entries

`to_entries`, `from_entries`, `with_entries`

- These functions **convert between an object and an array of key-value pairs.**
    - If **`to_entries` is passed an object, then for each `k:v` entry in the input, the output array includes `{"key": k, "value": v}`.**
    - **`from_entries` does the opposite conversion**,
    - and **`with_entries(foo)` is a shorthand for `to_entries | map(foo) | from_entries`**, useful for doing some operation to all keys and values of an object.
    - `from_entries` accepts key, Key, name, Name, value and Value as keys.

```bash
# to_entries
$ echo '{"a": 1, "b": 2}' | jq 'to_entries'
[
  {
    "key": "a",
    "value": 1
  },
  {
    "key": "b",
    "value": 2
  }
]

# from_entries
$ echo '[{"key":"a", "value":1}, {"key":"b", "value":2}]' | jq 'from_entries'
{
  "a": 1,
  "b": 2
}

# with_entries(.key |= "KEY_" + .)
$ echo '{"a": 1, "b": 2}' | jq 'with_entries(.key |= "KEY_" + .)'
{
  "KEY_a": 1,
  "KEY_b": 2
}

# with_entries(.value |= . + 2)
$ echo '{"a": 1, "b": 2}' | jq 'with_entries(.value |= . + 2)'
{
  "a": 3,
  "b": 4
}
```

### Select

`select(boolean_expression)`

- The function `select(foo)` produces its input unchanged if `foo` returns true for that input, and produces no output otherwise.
    - It's useful for filtering lists: `[1,2,3] | map(select(. >= 2))` will give you `[2,3]`.

```bash
# map(select(. >= 3))
$ echo '[1,5,3,0,7]' | jq 'map(select(. >= 3))'
[
  5,
  3,
  7
]

# map(select(.val < 2))
$ echo '[{"id": "first", "val": 1}, {"id": "second", "val": 2}]' | jq 'map(select(.val < 2))'
[
  {
    "id": "first",
    "val": 1
  }
]
```

### Built-in Select

`arrays`, `objects`, `iterables`, `booleans`, `numbers`, `normals`, `finites`, `strings`, `nulls`, `values`, `scalars`

- These built-ins select only inputs that are arrays, objects, iterables (arrays or objects), booleans, numbers, normal numbers, finite numbers, strings, null, non-null values, and non-iterables, respectively.

```bash
# .[] | arrays
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | arrays'
[]

# .[] | objects
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | objects'
{}

# .[] | iterables
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | iterables'
[]
{}

# .[] | booleans
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | booleans'
true
false

# .[] | numbers
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | numbers'
1

# .[] | normals
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | normals'
1

# .[] | finites
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | finites'
1

# .[] | strings
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | strings'
"foo"

# .[] | nulls
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | nulls'
null

# .[] | values
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | values'
[]
{}
1
"foo"
true
false

# .[] | scalars
$ echo '[[],{},1,"foo",null,true,false]' | jq '.[] | scalars'
1
"foo"
null
true
false
```

### Empty

`empty`

- `empty` returns no results.
    - None at all.
    - Not even null.
- It's useful on occasion.
    - You'll know if you need it :)

```bash
# 1, empty, 2
$ echo null | jq '1, empty, 2'
1
2

# [1, 2, empty, 3]
$ echo null | jq '[1, 2, empty, 3]'
[
  1,
  2,
  3
]
```

### Error Message

`error(message)`

- **Produces an error**, just like `.a` applied to values other than null and objects would, but with the given message as the error's value.
    - Errors can be caught with try/catch; see below.

```bash
# error("some exception")
$ echo null | jq 'error("some exception")'
jq: error (at <stdin>:1): some exception

# try error("some exception") catch .
$ echo null | jq 'try error("some exception") catch .'
"some exception"
```

### Halt

`halt`

- **Stops the jq program with no further outputs.**
    - jq will exit with exit status `0`.

`halt_error`, `halt_error(exit_code)`

- **Stops the jq program with no further outputs.**
    - The input will be printed on `stderr` as raw output (i.e., strings will not have double quotes) with no decoration, not even a newline.
- The given `exit_code` (defaulting to `5`) will be jq's exit status.
- For example, `"Error: somthing went wrong\n"|halt_error(1)`.

### _Location_

`$__loc__`

- Produces an object with a "file" key and a "line" key, with the filename and line number where `$__loc__` occurs, as values.

```bash
# WRONG
# try error("\($__loc__\)") catch .
$ echo null | jq 'try error("\($__loc__\)") catch .'
jq: error: syntax error, unexpected INVALID_CHARACTER (Unix shell quoting issues?) at <top-level>, line 1:
try error("\($__loc__\)") catch .
jq: 1 compile error

# WRONG
# try error("($__loc__)") catch .
$ echo null | jq 'try error("($__loc__)") catch .'
"($__loc__)"

# CORRECT
# try error("\($__loc__)") catch .
$ echo null | jq 'try error("\($__loc__)") catch .'
"{\"file\":\"<top-level>\",\"line\":1}"
```

- _( icehe : 用得不太明白 )_

### Paths

`paths`, `paths(node_filter)`, _`leaf_paths`_

- **`paths` outputs the paths to all the elements in its input** (except it does not output the empty list, representing `. itself).`
- **`paths(f)` outputs the paths to any values for which f is true.**
    - That is, `paths(numbers)` outputs the paths to all numeric values.
- _`leaf_paths` is an alias of `paths(scalars)`;_
    - _`leaf_paths` is deprecated and will be removed in the next major release._

```bash
# paths
$ echo '[1, [[], {"a": 2}]]' | jq 'paths'
[
  0
]
[
  1
]
[
  1,
  0
]
[
  1,
  1
]
[
  1,
  1,
  "a"
]

# paths(scalars)
$ echo '[1,[[],{"a":2}]]' | jq 'paths(scalars)'
[
  0
]
[
  1,
  1,
  "a"
]
```

### Add

`add`

- The **filter `add` takes as input an array, and produces as output the elements of the array added together.**
    - This might mean **summed, concatenated or merged depending on the types of the elements of the input array - the rules are the same as those for the `+` operator** (described above).
- If the input is an empty array, add returns null.

```bash
# add
$ echo '["a","b","c"]' | jq 'add'
"abc"

$ echo '[1, 2, 3]' | jq 'add'
6

$ echo '[]' | jq 'add'
null

$ echo '[1, 2, "c"]' | jq 'add'
# throw error
jq: error (at <stdin>:1): number (3) and string ("c") cannot be added
```

### Any

`any`, `any(condition)`, `any(generator; condition)`

- **The filter `any` takes as input an array of boolean values, and produces `true` as output if any of the elements of the array are `true`.**
- If **the input is an empty array, `any` returns `false`.**
- The **`any(condition)` form applies the given condition to the elements of the input array.**
- The **`any(generator; condition)` form applies the given condition to all the outputs of the given generator.**

```bash
# any
$ echo '[true, false]' | jq 'any'
true

$ echo '[false, false]' | jq 'any'
false

$ echo '[]' | jq 'any'
false

# any(. > 3)
$ echo '[1, 2, 3]' | jq 'any(. > 3)'
false

# any(. > 2)
$ echo '[1, 2, 3]' | jq 'any(. > 2)'
true

# _( icehe : 以下两个例子不知道用得对不对… )_

# any((.[] | . * 2); . > 6)
$ echo '[1, 2, 3]' | jq 'any((.[] | . * 2); . > 6)'
false

# any((.[] | . * 2); . > 5)
$ echo '[1, 2, 3]' | jq 'any((.[] | . * 2); . > 5)'
true
```

### All

`all`, `all(condition)`, `all(generator; condition)`

- **The filter `all` takes as input an array of boolean values, and produces true as output if all of the elements of the array are true.**
- The **`all(condition)` form applies the given condition to the elements of the input array.**
- The **`all(generator; condition)` form applies the given condition to all the outputs of the given generator.**
    - If **the input is an empty array, all returns `true`.**

```bash
# all
$ echo '[true, false]' | jq 'all'
false

$ echo '[true, true]' | jq 'all'
true

$ echo '[]' | jq 'all'
true

# all(. <= 2)
$ echo '[1, 2, 3]' | jq 'all(. <= 2)'
false

# all(. <= 3)
$ echo '[1, 2, 3]' | jq 'all(. <= 3)'
true

# _( icehe : 以下两个例子不知道用得对不对… )_

# all((.[] | . * 2); . <= 5)
$ echo '[1, 2, 3]' | jq 'all((.[] | . * 2); . <= 5)'
false

# all((.[] | . * 2); . <= 6)
$ echo '[1, 2, 3]' | jq 'all((.[] | . * 2); . <= 6)'
true
```

### Flatten

`flatten`, `flatten(depth)`

- The **filter `flatten` takes as input an array of nested arrays, and produces a flat array in which all arrays inside the original array have been recursively replaced by their values.**
    - You can pass an argument to it to specify how many levels of nesting to flatten.
- `flatten(2)` is like `flatten`, but going only up to two levels deep.

```bash
# flatten
$ echo '[1, [2], [[3]]]' | jq 'flatten'
[
  1,
  2,
  3
]

# flatten(1)
$ echo '[1, [2], [[3]]]' | jq 'flatten(1)'
[
  1,
  2,
  [
    3
  ]
]

# flatten
$ echo '[[]]' | jq 'flatten'
[]

# flatten
$ echo '[{"foo": "bar"}, [{"ice": "he"}]]' | jq 'flatten'
[
  {
    "foo": "bar"
  },
  {
    "ice": "he"
  }
]
```

### Range

`range(upto)`, `range(from;upto)`, `range(from;upto;by)`

- The function **`range` produces a range of numbers.**
    - `range(4;10)` produces 6 numbers, from 4 (inclusive) to 10 (exclusive).
    - The numbers are **produced as separate outputs.**
    - Use **`[range(4;10)]` to get a range as an array.**
- **The one argument form generates numbers from 0 to the given number**, with an increment of 1.
- **The two argument form generates numbers from from to upto** with an increment of 1.
- **The three argument form generates numbers from to upto with an increment of by.**

```bash
# range(1;3)
$ echo null | jq 'range(1;3)'
1
2

# [range(1;3)]
$ echo null | jq '[range(1;3)]'
[
  1,
  2
]

# [range(3)]
$ echo null | jq '[range(3)]'
[
  0,
  1,
  2
]

# [range(0;10;3)]
$ echo null | jq '[range(0;10;3)]'
[
  0,
  3,
  6,
  9
]

# [range(0;10;-1)]
$ echo null | jq '[range(0;10;-1)]'
[]

# [range(0;-5;-1)]
$ echo null | jq '[range(0;-5;-1)]'
[
  0,
  -1,
  -2,
  -3,
  -4
]
```

### Floor

`floor`

- The function **`floor` returns the floor of its numeric input.**

```bash
# floor
$ echo '3.14159' | jq 'floor'
3

# ceil
$ echo '3.14159' | jq 'ceil'
4
```

### Sqrt

`sqrt`

- The function **`sqrt` returns the square root of its numeric input.**

```bash
# sqrt
$ echo '9' | jq 'sqrt'
3

$ echo '2' | jq 'sqrt'
1.4142135623730951

$ echo '-3' | jq 'sqrt'
null
```

### To Number

`tonumber`

- The   function **`tonumber` parses its input as a number.**
    - It will **convert correctly-formatted strings to their numeric equivalent, leave numbers alone, and give an error on all other input.**

```bash
# map(tonumber)
$ echo '[1, "2"]' | jq 'map(tonumber)'
[
  1,
  2
]

# map(tonumber)
$ echo '[null, 1, "2"]' | jq 'map(tonumber)'
jq: error (at <stdin>:1): null (null) cannot be parsed as a number

# map(tonumber?)
$ echo '[null, 1, "2"]' | jq 'map(tonumber?)'
[
  1,
  2
]
```

### To String

`tostring`

- The function **`tostring` prints its input as a string.**
    - **Strings are left unchanged, and all other values are JSON-encoded.**

```bash
# map(tostring)
$ echo '[null, 1, "2", [3]]' | jq 'map(tostring)'
[
  "null",
  "1",
  "2",
  "[3]"
]
```

### Type

`type`

- The function **`type` returns the type of its argument as a string**, which is one of null, boolean, number, string, array or object.

```bash
# map(type)
$ echo '[0, 3.14, false, [], {}, null, "hello"]' | jq 'map(type)'
[
  "number",
  "number",
  "boolean",
  "array",
  "object",
  "null",
  "string"
]
```

### Infinite

`infinite`, `nan`, `isinfinite`, `isnan`, `isfinite`, `isnormal`

- Some arithmetic operations can **yield infinities and "not a number" (NaN)** values.
    - The **`isinfinite` builtin returns true if its input is infinite.**
    - The **`isnan` builtin returns true if its input is a NaN.**
    - The **`infinite` builtin returns a positive infinite value.**
    - The **`nan` builtin returns a NaN.**
    - The **`isnormal` builtin returns true if its input is a normal number.**
- Note that division by zero raises an error.
- Currently most arithmetic operations operating on infinities, NaNs, and sub-normals do not raise errors.

```bash
# .[] | (infinite * .) < 0
$ echo '[-1, 1]' | jq '.[] | (infinite * .) < 0'
true
false

# [infinite, nan] | type
$ echo null | jq '[infinite, nan] | type'
"array"

# infinite, nan | type
$ echo null | jq 'infinite, nan | type'
"number"
"number"

# infinite, nan | isinfinite
$ echo null | jq 'infinite, nan | isinfinite'
true
false

# infinite, nan | isnan
$ echo null | jq 'infinite, nan | isnan'
false
true

# infinite, nan | isnormal
$ echo null | jq 'infinite, nan | isnormal'
false
false
```

### Sort By

`sort`, `sort_by(path_expression)`

- The **`sort` functions sorts its input, which must be an array.**
- Values are sorted in the following order:
    - null
    - false
    - true
    - numbers
    - strings, in alphabetical order (by unicode codepoint value)
    - arrays, in lexical order
    - objects
- The ordering for objects is a little complex :
    - first they're compared by comparing their sets of keys (as arrays in sorted order),
    - and if their keys are equal then the values are compared key by key.
- `sort` may be used to sort by a particular field of an object, or by applying any jq filter.
- `sort_by(foo)` compares two elements by comparing the result of foo on each element.

```bash
# sort
$ echo '[8,3,null,6]' | jq 'sort'
[
  null,
  3,
  6,
  8
]

# sort_by(.foo)
$ echo '[{"foo":2, "bar":8}, {"foo":1, "bar":100}, {"foo":3, "bar":99}]' | jq 'sort_by(.foo)'
[
  {
    "foo": 1,
    "bar": 100
  },
  {
    "foo": 2,
    "bar": 8
  },
  {
    "foo": 3,
    "bar": 99
  }
]
```

### Group By

`group_by(path_expression)`

- **`group_by(.foo)` takes as input an array, groups the elements having the same `.foo` field into separate arrays, and produces all of these arrays as elements of a larger array, sorted by the value of the `.foo` field.**
- Any jq expression, not just a field access, may be used in place of `.foo`.
    - The sorting order is the same as described in the sort function above.

```bash
# group_by(.foo)
$ echo '[{"foo":1, "bar":6}, {"foo":3, "bar":77}, {"foo":1, "bar":888}]' | jq 'group_by(.foo)'
[
  [
    {
      "foo": 1,
      "bar": 6
    },
    {
      "foo": 1,
      "bar": 888
    }
  ],
  [
    {
      "foo": 3,
      "bar": 77
    }
  ]
]

# group_by(.foo)[] | [{foo: .[0].foo, bar: map(.bar)}]
echo '[{"foo":"a", "bar":50}, {"foo":"b", "bar":99}, {"foo":"a", "bar":100}]' | jq 'group_by(.foo) | .[] | [{foo: .[0].foo, bar:.[].bar}]'
# same as
echo '[{"foo":"a", "bar":50}, {"foo":"b", "bar":99}, {"foo":"a", "bar":100}]' | jq 'group_by(.foo)[] | [{foo: .[0].foo, bar: map(.bar)}]'
[
  {
    "foo": "a",
    "bar": [
      50,
      100
    ]
  }
]
[
  {
    "foo": "b",
    "bar": [
      99
    ]
  }
]
```

### Min and Max

`min`, `max`, `min_by(path_exp)`, `max_by(path_exp)`

- **Find the minimum or maximum element of the input array.**
- The `min_by(path_exp)` and `max_by(path_exp)` functions allow you to specify a particular field or property to examine, e.g. `min_by(.foo)` finds the object with the smallest `foo` field.

```bash
# min
$ echo '[5,4,2,7]' | jq 'min'
2

# max_by(.bar)
$ echo '[{"foo":1, "bar":14}, {"foo":2, "bar":3}]' | jq 'max_by(.bar)'
{
  "foo": 1,
  "bar": 14
}
```

### Uniq By

`unique`, `unique_by(path_exp)`

- The `unique` function **takes as input an array and produces an array of the same elements, in sorted order, with duplicates removed.**
- The `unique_by(path_exp)` function will keep only one element for each value obtained by applying the argument.
    - Think of it as making an array by taking one element out of every group produced by group.

```bash
# unique
$ echo '[1,2,5,3,5,3,1,3]' | jq 'unique'
[
  1,
  2,
  3,
  5
]

# unique_by(.foo)
$ echo '[{"foo": 1, "bar": 2}, {"foo": 1, "bar": 3}, {"foo": 4, "bar": 5}]' | jq 'unique_by(.foo)'
[
  {
    "foo": 1,
    "bar": 2
  },
  {
    "foo": 4,
    "bar": 5
  }
]

# unique_by(length)
$ echo '["chunky", "bacon", "kitten", "cicada", "asparagus"]' | jq 'unique_by(length)'
[
  "bacon",
  "chunky",
  "asparagus"
]
```

### Reverse

`reverse`

- This function **reverses an array.**

```bash
# reverse
$ echo '[1,2,3,4]' | jq 'reverse'
[
  4,
  3,
  2,
  1
]
```

### Contains

`contains(element)`

- The filter `contains(b)` will **produce true if b is completely contained within the input.**
    - A **string** B is contained in a string A if B is a **substring** of A.
    - An **array** B is contained in an array A if all elements in B are contained in  any  element  in  A.
    - An **object**  B is contained in object A if all of the values in B are **contained in the value in A with the same key**.
    - All other types are assumed to be contained in each other if they are equal.

```bash
# contains("bar")
$ echo '"foobar"' | jq 'contains("bar")'
true

# contains(["baz", "bar"])
$ echo '["foobar", "foobaz", "blarp"]' | jq 'contains(["baz", "bar"])'
true
# _( icehe : 这个结果, 出乎我的意料, 我没准备理解… )_

# contains(["bazz", "bar"])
$ echo '["foobar", "foobaz", "blarp"]' | jq 'contains(["bazz", "bar"])'
false

# contains({foo: 12, bar: [{barp: 12}]})
$ echo '{"foo": 12, "bar":[1,2,{"barp":12, "blip":13}]}' | jq 'contains({foo: 12, bar: [{barp: 12}]})'
true

# contains({foo: 12, bar: [{barp: 15}]})
$ echo '{"foo": 12, "bar":[1,2,{"barp":12, "blip":13}]}' | jq 'contains({foo: 12, bar: [{barp: 15}]})'
false
```

### Indices

`indices(s)`

- Outputs an **array containing the indices in `.` where `s` occurs.**
    - The input may be an array, in which case if s is an array then the indices output will be those where all elements in `.` match those of `s`.

```bash
# indices(", ")
$ echo '"a,b, cd, efg, hijk"' | jq 'indices(", ")'
[
  3,
  7,
  12
]

# indices(1)
$ echo '[0,1,2,1,3,1,4]' | jq 'indices(1)'
[
  1,
  3,
  5
]

#  indices([1,2])
$ echo '[0,1,2,3,1,4,2,5,1,2,6,7]' | jq 'indices([1,2])'
[
  1,
  8
]
```

### Index and Reverse Index

`index(s)`, `rindex(s)`

- Outputs the **index of the first (`index`) or last (`rindex`) occurrence of `s` in the input.**

```bash
# index(", ")
$ echo '"a,b, cd, efg, hijk"' | jq 'index(", ")'
3

# rindex(", ")
$ echo '"a,b, cd, efg, hijk"' | jq 'rindex(", ")'
12
```

### Inside

`inside`

- The filter `inside(b)` will produce true **if the input is completely contained within `b`.**
    - It is, essentially, an **inversed version of `contains`.**

```bash
# inside("foobar")
$ echo '"bar"' | jq 'inside("foobar")'
true

# inside(["foobar", "foobaz", "blarp"])
$ echo '["baz", "bar"]' | jq 'inside(["foobar", "foobaz", "blarp"])'
true

# inside(["foobar", "foobaz", "blarp"])
$ echo '["bazzzzz", "bar"]' | jq 'inside(["foobar", "foobaz", "blarp"])'
false

# inside({"foo": 12, "bar":[1,2,{"barp":12, "blip":13}]})
$ echo '{"foo": 12, "bar": [{"barp": 12}]}' | jq 'inside({"foo": 12, "bar":[1,2,{"barp":12, "blip":13}]})'
true

# inside({"foo": 12, "bar":[1,2,{"barp":12, "blip":13}]})
$ echo '{"foo": 12, "bar": [{"barp": 15}]}' | jq 'inside({"foo": 12, "bar":[1,2,{"barp":12, "blip":13}]})'
false

```

### Starts With

`startswith(str)`

- Outputs true **if `.` starts with the given string argument.**

```bash
# map(startswith("foo"))
$ echo '["fo", "foo", "barfoo", "foobar", "barfoob"]' | jq 'map(startswith("foo"))'
[
  false,
  true,
  false,
  true,
  false
]
```

### Ends With

`endswith(str)`

- Outputs true **if `.` ends with the given string argument.**

```bash
# map(endswith("foo"))
$ echo '["foobar", "barfoo"]' | jq 'map(endswith("foo"))'
[
  false,
  true
]
```

### Combinations

`combinations`, `combinations(n)`

- Outputs **all combinations of the elements of the arrays in the input array.**
    - If given an argument `n`, it outputs **all  combinations of `n` repetitions of the input array.**

```bash
# combinations
$ echo '[[1,2], [3, 4]]' | jq 'combinations'
[
  1,
  3
]
[
  1,
  4
]
[
  2,
  3
]
[
  2,
  4
]

# combinations(2)
$ echo '[0,1]' | jq 'combinations(2)'
[
  0,
  0
]
[
  0,
  1
]
[
  1,
  0
]
[
  1,
  1
]

```

### Left Trim

`ltrimstr(str)`

- Outputs its input with the **given prefix string removed, if it starts with it.**

```bash
# map(ltrimstr("foo"))
$ echo '["fo", "foo", "barfoo", "foobar", "afoo"]' | jq 'map(ltrimstr("foo"))'
[
  "fo",
  "",
  "barfoo",
  "bar",
  "afoo"
]
```

### Right Trim

`rtrimstr(str)`

- Outputs its input with the **given suffix string removed, if it ends with it.**

```bash
# map(rtrimstr("foo"))
$ echo '["fo", "foo", "barfoo", "foobar", "foob"]' | jq 'map(rtrimstr("foo"))'
[
  "fo",
  "",
  "bar",
  "foobar",
  "foob"
]
```

### Explode

`explode`

- **Converts an input string into an array of the string's codepoint numbers.**

```bash
# explode
$ echo '"foobar"' | jq 'explode'
[
  102,
  111,
  111,
  98,
  97,
  114
]
```

### Implode

`implode`

- The **inverse of `explode`.**

```bash
# implode
$ echo '[65, 66, 67]' | jq 'implode'
"ABC"
```

### Split

`split(str)`

- **Splits an input string on the separator argument.**

```bash
# split(", ")
$ echo '"a, b,c,d, e, "' | jq 'split(", ")'
[
  "a",
  "b,c,d",
  "e",
  ""
]
```

### Join

`join(str)`

- **Joins  the  array  of  elements  given  as input, using the argument as separator.**
    - It is the **inverse of `split`** :
        - that is, running `split("foo") | join("foo")` over any input string returns said input string.
- Numbers and booleans in the input are converted to strings.
    - Null values are treated as empty strings.
    - Arrays and objects in the input are not supported.

```bash
# join(", ")
$ echo '["a","b,c,d","e"]' | jq 'join(", ")'
"a, b,c,d, e"

# join(" ")
$ echo '["a",1,2.3,true,null,false]' | jq 'join(" ")'
"a 1 2.3 true  false"
```

### ASCII Downcase and Upcase

`ascii_downcase`, `ascii_upcase`

- **Emit a copy of the input string with its alphabetic characters (a-z and A-Z) converted to the specified case.**

```bash
# ascii_upcase
$ echo '"cat"' | jq 'ascii_upcase'
"CAT"

# ascii_downcase
$ echo '"ICE"' | jq 'ascii_downcase'
"ice"
```

### While

`while(cond; update)`

- The `while(cond; update)` function allows you to **repeatedly apply an update to `.` until `cond` is false.**
- Note  that  `while(cond; update)` is internally defined as a recursive jq function.
    - Recursive calls within while will not consume additional memory if update produces at most one output for each input.
    - See advanced topics below.

```bash
# while(. < 100; . * 2)
$ echo '1' | jq 'while(.<100; .*2)'
1
2
4
8
16
32
64
```

### Until

`until(cond; next)`

- The `until(cond; next)` function allows you to **repeatedly apply the expression next, initially to . then to its own output, until cond is true.**
    - For example, this can be used to implement a factorial function (see below).
- Note  that  `until(cond; next)` is internally defined as a recursive jq function.
    - Recursive calls within until() will not consume additional memory if next produces at most one output for each input.
    - See advanced topics below.

```bash
# [., 1] | until(.[0] < 1; [.[0] - 1, .[1] * .[0]]) | .[1]
$ echo '4' | jq '[., 1] | until(.[0] < 1; [.[0] - 1, .[1] * .[0]]) | .[1]'
24
```

### Recurse

`recurse(f)`, `recurse`, `recurse(f; condition),` ~~`recurse_down`~~

- The `recurse(f)` function allows you to **search through a recursive structure, and extract interesting data from all levels.**
- Suppose your input represents a filesystem :

```json
{"name": "/", "children": [
    {"name": "/bin", "children": [
    {"name": "/bin/ls", "children": []},
    {"name": "/bin/sh", "children": []}]},
    {"name": "/home", "children": [
    {"name": "/home/stephen", "children": [
        {"name": "/home/stephen/jq", "children": []}]}]}]}
```

- Now suppose you want to extract all of the filenames present.
    - You need to retrieve `.name`, `.children[].name`, `.children[].children[].name`, and so on.
    - You can do this with:

```bash
# recurse(.children[]) | .name
$ echo '{"name": "/", "children": [
    {"name": "/bin", "children": [
    {"name": "/bin/ls", "children": []},
    {"name": "/bin/sh", "children": []}]},
    {"name": "/home", "children": [
    {"name": "/home/stephen", "children": [
        {"name": "/home/stephen/jq", "children": []}]}]}]}' \
    | jq 'recurse(.children[]) | .name'
# output
"/"
"/bin"
"/bin/ls"
"/bin/sh"
"/home"
"/home/stephen"
"/home/stephen/jq"
```

- When called without an argument, `recurse` is equivalent to `recurse(.[]?)`.
- `recurse(f)` is identical to `recurse(f; . != null)` and can be used without concerns about recursion depth.
- `recurse(f; condition)` is a generator which begins by emitting `.` and then emits in turn `.|f`, `.|f|f`, `.|f|f|f`, ... so long as  the computed  value  satisfies  the  condition.
    - For  example, to generate all the integers, at least in principle, one could write `recurse(.+1; true)`.
- ~~For legacy reasons, `recurse_down` exists as an alias to calling recurse without arguments.~~
    - This alias is  considered  deprecated and will be removed in the next major release.
- The `recursive` calls in recurse will not consume additional memory whenever f produces at most a single output for each input.

```bash
# recurse(.foo[])
$ echo '{"foo":[{"foo": []}, {"foo":[{"foo":[]}]}]}' | jq 'recurse(.foo[])'
{
  "foo": [
    {
      "foo": []
    },
    {
      "foo": [
        {
          "foo": []
        }
      ]
    }
  ]
}
{
  "foo": []
}
{
  "foo": [
    {
      "foo": []
    }
  ]
}
{
  "foo": []
}

# recurse(. * .; . < 20)
$ echo '2' | jq 'recurse(. * .; . < 20)'
2
4
16
```

### Walk

`walk(f)`

- The  `walk(f)`  function  **applies  `f` recursively to every component of the input entity.**
    - When an array is encountered, f is first applied to its elements and then to the array itself; when an object is encountered, f is first applied to all the  values  and then to the object.
    - In practice, f will usually test the type of its input, as illustrated in the following examples.
    - The first example highlights the usefulness of processing the elements of an array of arrays before processing the array itself.
    - The second example shows how all the keys of all the objects within the input can be considered for alteration.

```bash
# walk(if type == "array" then sort else . end)
$ echo '[[4, 1, 7], [8, 5, 2], [3, 6, 9], "a"]' | jq 'walk(if type == "array" then sort else . end)'
[
  "a",
  [
    1,
    4,
    7
  ],
  [
    2,
    5,
    8
  ],
  [
    3,
    6,
    9
  ]
]

# walk(if type == "object" then with_entries(.key |= sub("^_+"; "")) else . end)
$ echo '[ { "_a": { "__b": 2 } } ]' | jq 'walk(if type == "object" then with_entries(.key |= sub("^_+"; "")) else . end)'
[
  {
    "a": {
      "b": 2
    }
  }
]
```

### Env

`$ENV`, `env`

- `$ENV` is an object representing the environment variables as set when the jq program started.
    - `env` **outputs an object representing jq's current environment.**
- At the moment there is no builtin for setting environment variables.

```bash
# $ENV.PAGER
$ echo null | jq '$ENV.PAGER'
"less"

# env.PAGER
$ echo null | jq 'env.PAGER'
"less"
```

### Tranpose

`transpose`

- Transpose a possibly jagged matrix (an array of arrays).
    - Rows are padded with nulls so the result is always rectangular.

```bash
# transpose
$ echo '[[1], [2,3]]' | jq 'transpose'
[
  [
    1,
    2
  ],
  [
    null,
    3
  ]
]
```

### Binary Search

`bsearch(x)`

- `bsearch(x)`  conducts  a  binary  search  for  x in the input array.
    - If the input is sorted and contains x, then bsearch(x) will return its index in the array; otherwise, if the array is sorted, it will return (-1 - ix) where ix is an insertion point  such that  the  array  would  still  be sorted after the insertion of x at ix.
    - If the array is not sorted, bsearch(x) will return an integer that is probably of no interest.

```bash
# bsearch(4)
$ echo '[1,2,3]' | jq 'bsearch(4)'
-4

# bsearch(4) as $ix | if $ix < 0 then .[-(1+$ix)] = 4 else . end
$ echo '[1,2,3]' | jq 'bsearch(4) as $ix | if $ix < 0 then .[-(1+$ix)] = 4 else . end'
[
  1,
  2,
  3,
  4
]
```

### String Interpolation

`\(foo)`

- Inside a string, you can **put an expression inside parens after a backslash.**
    - Whatever the expression returns  will  be  interpolated into the string.

```bash
# \(.) \(.+1)
$ echo '42' | jq '"The input was \(.), while is one less than \(.+1)"'
"The input was 42, while is one less than 43"
```

### Convert to/From JSON

- The  `tojson`  and  `fromjson` builtins **dump values as JSON texts or parse JSON texts into values, respectively.**
    - The `tojson` builtin differs from `tostring` in that tostring returns strings unmodified, while `tojson` encodes strings as JSON strings.

```bash
# map(tostring)
$ echo '[1, "foo", ["foo"]]' | jq 'map(tostring)'
[
  "1",
  "foo",
  "[\"foo\"]"
]

# map(tojson)
$ echo '[1, "foo", ["foo"]]' | jq 'map(tojson)'
[
  "1",
  "\"foo\"",
  "[\"foo\"]"
]

# map(tojson|fromjson)
$ echo '[1, "foo", ["foo"]]' | jq 'map(tojson|fromjson)'
[
  1,
  "foo",
  [
    "foo"
  ]
]
```

### Format Strings and Escaping

- The `@foo` syntax is used to **format and escape strings**, which is useful for building URLs, documents in a language like  HTML  or XML, and so forth.
- @foo can be used as a filter on its own, the possible escapings are:
    - **`@text` : Calls `tostring`, see that function for details.**
    - **`@json` : Serializes the input as JSON.**
    - **`@html` : Applies  HTML/XML  escaping**,  by  mapping  the  characters  `<>&'"` to their entity equivalents `&lt;`, `&gt;`, `&amp;`, `&apos;`, `&quot;`.
    - **`@uri` : Applies percent-encoding**, by mapping all reserved URI characters to a `%XX` sequence.
    - `@csv` : The input must be an array, and it is rendered as CSV with double quotes for strings, and quotes escaped by  repetition.
    - `@tsv` : The input must be an array, and it is rendered as **TSV (tab-separated values)**.
        - Each input array will be printed as a single line.
        - Fields are separated by a single tab (ascii 0x09).
        - Input characters line-feed  (ascii  0x0a),  carriage-return (ascii  0x0d),  tab  (ascii  0x09)  and backslash (ascii 0x5c) will be output as escape sequences `\n`, `\r`, `\t`, `\\` respectively.
    - `@sh` : The input is escaped suitable for use in a command-line for a POSIX shell.
        - If the input is an array, the output will  be a series of space-separated strings.
    - **`@base64` : The input is converted to base64 as specified by RFC 4648.**
    - **`@base64d` : The inverse of @base64, input is decoded as specified by RFC 4648.**
        - Note: If the decoded string is not UTF-8, the results are undefined.
- This syntax can be combined with string interpolation in a useful way.
    - You can follow a `@foo` token with a string  literal.
    - The contents  of  the  string  literal  will  not  be  escaped.
    - However, all interpolations made inside that string literal will be escaped.
    - For instance, `@uri "https://www.google.com/search?q=\(.search)"`
        - will produce the following output for the input `{"search":"what is jq?"}` : `"https://www.google.com/search?q=what%20is%20jq%3F"`

```bash
# @uri "https://www.google.com/search?q=\(.search)"
$ echo '{"search":"what is jq?"}' | jq '@uri "https://www.google.com/search?q=\(.search)"'
"https://www.google.com/search?q=what%20is%20jq%3F"
```

- Note that the slashes, question mark, etc. in the URL are not escaped, as they were part of the string literal.

```bash
# @html
$ echo '"This works if x < y"' | jq '@html'
"This works if x &lt; y"

# @base64
$ echo '"This is a message"' | jq '@base64'
"VGhpcyBpcyBhIG1lc3NhZ2U="

# @base64d
$ echo '"VGhpcyBpcyBhIG1lc3NhZ2U="' | jq '@base64d'
"This is a message"
```

<!--

```bash
# 这个示例没有实验成功, 可能因为 zsh 么?
jq '@sh "echo \(.)"'
    "O'Hara's Ale"
=> "echo 'O'\\''Hara'\\''s Ale'"
```

-->

### Dates

jq provides some basic date handling functionality, with some high-level and low-level builtins.

- In all  cases  these  builtins deal exclusively with time in UTC.

`fromdateiso8601`

- **Parses  datetimes  in  the  ISO  8601  format  to  a  number  of  seconds  since  the Unix epoch (1970-01-01T00:00:00Z).**

`todateiso8601`

- The inverse of `fromdateiso8601`.

`fromdate`

- **Parses datetime strings.**
    - Currently `fromdate` only supports ISO 8601 datetime strings, but in the future  it will attempt to parse datetime strings in more formats.

`todate`

- An **alias for `todateiso8601`.**

`now`

- Outputs the **current time, in seconds since the Unix epoch.**

Low-level  jq  interfaces to the C-library time functions are also provided :

- `strptime`, `strftime`, `strflocaltime`, `mktime`, `gmtime`, and `localtime`.
- Refer to your host operating system's documentation for the format strings used by `strptime` and `strftime`.
- Note: these are not necessarily stable interfaces in jq, particularly as to their localization functionality.

`gmtime`

- **Consumes a number of seconds since the Unix epoch and outputs a "broken down time" representation of Greenwhich Meridian time as an array of numbers representing (in this order) :**
    - the year,
    - the month **(zero-based)**,
    - the day of the month **(one-based)**,
    - the  hour  of  the day,
    - the minute of the hour,
    - the second of the minute,
    - the day of the week,
    - and the day of the year -- all one-based unless otherwise stated.
- The day of the week number may be wrong on some systems for dates  before  March 1st 1900, or after December 31 2099.

`localtime`

- **Works like the `gmtime` builtin**, but **using the local timezone setting.**

`mktime`

- **Consumes "broken down time" representations of time output by `gmtime` and `strptime`.**

`strptime(fmt)`

- **Parses input strings matching the fmt argument.**
    - The output is in the "broken down time" representation consumed by `gmtime` and output by `mktime`.

`strftime(fmt)`

- **Formats a time (GMT) with the given format.**

`strflocaltime`

- **Work like `strftime`**,  but  **using  the  local timezone setting.**

The  format  strings for `strptime` and `strftime` are described in typical C library documentation.

- The format string for ISO 8601 datetime is `"%Y-%m-%dT%H:%M:%SZ"`.

jq may not support some or all of this date functionality on some systems.

- In particular, the `%u` and `%j` specifiers  for  `strptime(fmt)` are not supported on macOS.

```bash
# now
$ echo null | jq 'now'
1600762696.01708

# fromdate
$ echo '"2015-03-05T23:51:47Z"' | jq 'fromdate'
1425599507

# strptime("%Y-%m-%dT%H:%M:%SZ")
$ echo '"2015-03-05T23:51:47Z"' | jq 'strptime("%Y-%m-%dT%H:%M:%SZ")'
[
  2015,
  2,
  5,
  23,
  51,
  47,
  4,
  63
]

# strptime("%Y-%m-%d") | mktime
$ echo '"2020-09-22"' | jq 'strptime("%Y-%m-%d") | mktime'
1600732800

# strptime("%Y-%m-%dT%H:%M:%SZ") | mktime
$ echo '"2015-03-05T23:51:47Z"' | jq 'strptime("%Y-%m-%dT%H:%M:%SZ") | mktime'
1425599507

# mktime
$ echo '[1970,1,8,12,23,56,0,0]' | jq 'mktime'
3327836

# mktime | strftime("%Y-%m-%dT%H:%M:%SZ")
$ echo '[1970,1,8,12,23,56,0,0]' | jq 'mktime | strftime("%Y-%m-%dT%H:%M:%SZ")'
"1970-02-08T12:23:56Z"

```

### SQL-Style Operators

jq provides a few SQL-style operators.

`INDEX(stream; index_expression)`

- **Produces  an  object whose keys are computed by the given index expression applied to each value from the given stream.**

```bash
# map(INDEX(.; "id"))
$ echo '[1,2,3]' | jq 'map(INDEX(.; "id"))'
# same as below
$ echo '[1,2,3]' | jq 'map(INDEX("id"))'
[
  {
    "id": 1
  },
  {
    "id": 2
  },
  {
    "id": 3
  }
]

# map(INDEX(.; .id))
$ echo '[{"id":1, "name": "app"}, {"id": 2, "name": "ice"}, {"id": 3, "name":"cat"}]' | jq 'map(INDEX(.; .id))'
[
  {
    "1": {
      "id": 1,
      "name": "app"
    }
  },
  {
    "2": {
      "id": 2,
      "name": "ice"
    }
  },
  {
    "3": {
      "id": 3,
      "name": "cat"
    }
  }
]
```

`JOIN($idx; stream; idx_expr; join_expr)`

- **Joins the values from the given stream to the given index.**
    - The index's keys are computed  by  applying  the given  index  expression  to each value from the given stream.
    - An array of the value in the stream and the corresponding value from the index is fed to the given join expression to produce each result.
- _References_
    - https://stackoverflow.com/questions/44856098/using-sql-style-join-operator-with-jq
    - _( icehe : 没搞懂 JOIN 的用法… )_

`JOIN($idx; stream; idx_expr)`

- Same as `JOIN($idx; stream; idx_expr; .)`.

`JOIN($idx; idx_expr)`

- This builtin joins the input `.` to the given index, applying the given index expression to `.` to compute  the  index  key.
    - The join operation is as described above.

```bash
# JOIN(.; .)
$ echo '[0,1,2]' | jq 'JOIN(.; .)'
[
  [
    0,
    0
  ],
  [
    1,
    1
  ],
  [
    2,
    2
  ]
]

# JOIN(.; . + 1)
$ echo '[0,1,2]' | jq 'JOIN(.; . + 1)'
[
  [
    0,
    1
  ],
  [
    1,
    2
  ],
  [
    2,
    null
  ]
]
```

`IN(s)`

- **Outputs true if `.` appears in the given stream, otherwise it outputs false.**

`IN(source; s)`

- **Outputs true if any value in the source stream appears in the second stream, otherwise it outputs false.**

```bash
# map(IN(1,2))
$ echo '[1,2,3]' | jq 'map(IN(1,2))'
[
  true,
  true,
  false
]

# map(IN(. + 1; 1,2))
$ echo '[1,2,3]' | jq 'map(IN(. + 1; 1,2))'
[
  true,
  false,
  false
]
```

### Builtins

- Returns  a list of all builtin functions in the format `name/arity`.
    - Since functions with the same name but different arities are considered separate functions, `all/0`, `all/1`, and `all/2` would all be present in the list.

## Conditionals and Comparisons

### Equal and Unequal

`==`, `!=`

- The expression 'a == b' will **produce 'true' if the result of a and b are equal (that is, if they represent equivalent JSON documents)**  and 'false' otherwise.
    - In particular, **strings are never considered equal to numbers.**
    - If you're coming from Javascript, jq's `==` is like Javascript's `===` -- **considering values equal only when they have the same type as well as the same value.**
- `!=` is "not equal", and 'a != b' returns the opposite value of 'a == b'

```bash
# .[] == 1
$ echo '[1, 1.0, "1", "ice"]' | jq '.[] == 1'
true
true
false
false

# map(2 == .)
$ echo '[1, 2, "2"]' | jq 'map(2 == .)'
[
  false,
  true,
  false
]

# map("2" == .)
$ echo '[1, 2, "2"]' | jq 'map("2" == .)'
[
  false,
  false,
  true
]

# map("true" != .)
$ echo '[null, true, "true"]' | jq 'map("true" != .)'
[
  true,
  true,
  false
]
```

### if-then-else

- `if A then B else C end` will act the same as `B` if `A` produces a value other than false or null, but act the same as `C`  otherwise.
- Checking  for false or null is a simpler notion of "truthiness" than is found in Javascript or Python, but it means that you'll sometimes have to be more explicit about the condition you want :
    - you can't test whether, e.g. a string is empty using `if  .name then A else B end`, you'll need something more like **`if (.name | length) > 0 then A else B end`** instead.
- If  the  condition  `A`  produces  multiple results, then `B` is evaluated once for each result that is not false or null, and `C` is evaluated once for each false or null.
- More cases can be added to an if using `elif A then B` syntax.

```bash
# if . == 0 then "yes" else "no" end
$ echo '0' | jq 'if . == 0 then "yes" else "no" end'
"yes"

# if . == 0 then "yes" else "no" end
$ echo '2' | jq 'if . == 0 then "yes" else "no" end'
"no"

# if . == 0 then "zero" elif . == 1 then "one" else "others" end
$ echo '0' | jq 'if . == 0 then "zero" elif . == 1 then "one" else "others" end'
"zero"

$ echo '1' | jq 'if . == 0 then "zero" elif . == 1 then "one" else "others" end'
"one"

$ echo '2' | jq 'if . == 0 then "zero" elif . == 1 then "one" else "others" end'
"others"
```

### gt, gte, lte, lt

`>`, `>=`, `<=`, `<`

- The comparison operators `>`, `>=`, `<=`, `<` return **whether their left argument is greater than, greater than or equal to,  less  than or equal to or less than their right argument (respectively).**
- The ordering is the same as that described for sort, above.

```bash
# . < 5
$ echo '2' | jq '. < 5'
true

```

### and, or, not

`and`, `or`, `not`

- jq  supports  the  **normal Boolean operators** `and` / `or` / `not`.
    - They have the same standard of truth as if expressions - **false and null are considered "false values", and anything else is a "true value".**
- If an operand of one of these operators produces multiple results, the operator itself will produce a result for each input.
- `not` is in fact a builtin function rather than an operator, so it is called as a filter to which things can be piped rather than with special syntax, as in `.foo and .bar | not`.
- These  three only produce the values "true" and "false", and so are only useful for genuine Boolean operations, rather than the common Perl/Python/Ruby idiom of "value_that_may_be_null or default".
    - If you want to use this form of "or", picking between two values rather than evaluating a condition, see the "//" operator below.

```bash
# 42 and "a string"
$ echo null | jq '42 and "a string"'
true

# (true, false) or false
$ echo null | jq '(true, false) or false'
true
false

# (true, false) and (true, false)
$ echo null | jq '(true, false) and (true, false)'
true
false
false
# ( icehe : ??? 不理解这个输出… )

# (true, true) and (true, false)
$ echo null | jq '(true, true) and (true, false)'
true
false
true
false

# (true, false) | not
$ echo null | jq '(true, false) | not'
false
true
```

### Alternative operator

`//`

- A  filter of the form `a // b` **produces the same results as a, if a produces results other than false and null.**
    - Otherwise, `a // b` produces the same results as b.
- This is **useful for providing defaults** :
    - `.foo // 1` will evaluate to 1 if there's no `.foo` element in the input.
    - It's  similar  to how `or` is sometimes used in Python (jq's `or` operator is reserved for strictly Boolean operations).

```bash
# .foo // 42
$ echo '{"foo": 19}' | jq '.foo // 42'
19

# .foo // 42
$ echo '{}' | jq '.foo // 42'
42
```

### try-catch

- Errors can be caught by using `try EXP catch EXP`.
    - The **first expression is executed, and if it fails then the second is executed with the error message.**
    - The output of the handler, if any, is output as if it had been the output of the expression to try.
- The **`try EXP` form uses `empty` as the exception handler.**

```bash
# try .a catch ".a is not an object"
$ echo '{"a": 1}' | jq 'try .a catch ".a is not an object"'
1

# try .a catch ".a is not an object"
$ echo '{}' | jq 'try .a catch ".a is not an object"'
null

# .[] | try .a
$ echo '[{}, true, {"a": 1}]' | jq '.[] | try .a'
null
1

# try error("some exception") catch .
$ echo 'true' | jq 'try error("some exception") catch .'
"some exception"
```

### Breaking out of control structures

- A convenient use of try/catch is to break out of control structures like `reduce`, `foreach`, `while`, and so on.
- For example:

```bash
# Repeat an expression until it raises "break" as an
# error, then stop repeating without re-raising the error.
# But if the error caught is not "break" then re-raise it.
try repeat(exp) catch .=="break" then empty else error;
```

jq has a syntax for named lexical labels to "break" or "go (back) to":

```bash
label $out | ... break $out ...
```

- The `break $label_name` expression will cause the program to to act as though the nearest (to the left) `label $label_name` produced empty.
- The relationship between the `break` and corresponding `label` is lexical: the label has to be "visible" from the break.
- To break out of a reduce, for example:

```bash
label $out | reduce .[] as $item (null; if .==false then break $out else ... end)
```

The following jq program produces a syntax error:

```bash
break $out
```

- because no label `$out` is visible.

### Error Suppression / Optional Operator

`?`

- The **`?` operator, used as `EXP?`, is shorthand for `try EXP`.**

```bash
# .[] | .a?
$ echo '[{}, true, {"a":1}]' | jq '.[] | .a?'
null
1

# map(.a?)
$ echo '[{}, true, {"a":1}]' | jq 'map(.a?)'
[
  null,
  1
]
```

## Regular Expressions ( PCRE )

jq  uses  the  Oniguruma regular expression library, as do php, ruby, TextMate, Sublime Text, etc, so the description here will focus on jq specifics.

The jq regex filters are defined so that they can be used using one of these patterns:

```bash
STRING | FILTER( REGEX )
STRING | FILTER( REGEX; FLAGS )
STRING | FILTER( [REGEX] )
STRING | FILTER( [REGEX, FLAGS] )
```

where :

- `*` STRING, REGEX and FLAGS are jq strings and subject to jq string interpolation;
- `*` REGEX,  after  string  interpolation, should be a valid PCRE regex;
- `*` FILTER is one of `test`, `match`, or `capture`, as described below.

FLAGS is a string consisting of one of more of the supported flags:

- `g` - Global search (find all matches, not just the first)
- `i` - Case insensitive search
- `m` - Multi line mode ('.' will match newlines)
- `n` - Ignore empty matches
- `p` - Both s and m modes are enabled
- `s` - Single line mode ('^' -> '\A', '$' -> '\Z')
- `l` - Find longest possible matches
- `x` - Extended regex format (ignore whitespace and comments)

To match whitespace in an x pattern use an escape such as `\s`, e.g.

- `test( "a\sb", "x" )`

Note that certain flags may also be specified within REGEX, e.g.

- `jq -n '("test", "TEst", "teST", "TEST") | test( "(?i)te(?-i)st" )'`

evaluates to: true, true, false, false.

### test

`test(val)`, `test(regex; flags)`

- **Like `match`, but does not return match objects, only `true` or `false`** for whether or not the regex matches the input.

```bash
# test("foo")
$ echo '"foo"' | jq 'test("foo")'
true

# .[] | test("a b c # Both spaces and comments are ignored."; "ix")
$ echo '["xabcd", "ABC"]' | jq '.[] | test("a b c # Both spaces and comments are ignored."; "ix")'
true
true
```

### match

`match(val)`, `match(regex; flags)`

- `match` **outputs an object for each match it finds.**
    - Matches have the following fields:
        - `offset` - offset in UTF-8 codepoints from the beginning of the input
        - `length` - length in UTF-8 codepoints of the match
        - `string` - the string that it matched
        - `captures` - an array of objects representing capturing groups.
    - Capturing group objects have the following fields:
        - `offset` - offset in UTF-8 codepoints from the beginning of the input
        - `length` - length in UTF-8 codepoints of this capturing group
        - `string` - the string that was captured
        - `name` - the name of the capturing group (or null if it was unnamed)
    - Capturing groups that **did not match anything return an offset of -1**

```bash
# match("(abc)+"; "g")
$ echo '"abc abc"' | jq 'match("(abc)+"; "g")'
{
  "offset": 0,
  "length": 3,
  "string": "abc",
  "captures": [
    {
      "offset": 0,
      "length": 3,
      "string": "abc",
      "name": null
    }
  ]
}
{
  "offset": 4,
  "length": 3,
  "string": "abc",
  "captures": [
    {
      "offset": 4,
      "length": 3,
      "string": "abc",
      "name": null
    }
  ]
}

# match("foo")
$ echo '"foo bar foo"' | jq 'match("foo")'
{
  "offset": 0,
  "length": 3,
  "string": "foo",
  "captures": []
}

# match(["foo", "ig"])
$ echo '"foo bar FOO"' | jq 'match(["foo", "ig"])'
{
  "offset": 0,
  "length": 3,
  "string": "foo",
  "captures": []
}
{
  "offset": 8,
  "length": 3,
  "string": "FOO",
  "captures": []
}

# match("foo (?<bar123>bar)? foo"; "ig")
$ echo '"foo bar foo foo  foo"' | jq 'match("foo (?<bar123>bar)? foo"; "ig")'
{
  "offset": 0,
  "length": 11,
  "string": "foo bar foo",
  "captures": [
    {
      "offset": 4,
      "length": 3,
      "string": "bar",
      "name": "bar123"
    }
  ]
}
{
  "offset": 12,
  "length": 8,
  "string": "foo  foo",
  "captures": [
    {
      "offset": -1,
      "string": null,
      "length": 0,
      "name": "bar123"
    }
  ]
}

# match("foo (bar)? foo"; "ig")
$ echo '"foo bar foo foo  foo"' | jq 'match("foo (bar)? foo"; "ig")'
{
  "offset": 0,
  "length": 11,
  "string": "foo bar foo",
  "captures": [
    {
      "offset": 4,
      "length": 3,
      "string": "bar",
      "name": null
    }
  ]
}
{
  "offset": 12,
  "length": 8,
  "string": "foo  foo",
  "captures": [
    {
      "offset": -1,
      "string": null,
      "length": 0,
      "name": null
    }
  ]
}

# [match("a|b"; "g")] | length
$ echo '"abc"' | jq '[match("a|b"; "g")] | length'
2
```

### capture

`capture(val)`, `capture(regex; flags)`

- **Collects  the  named  captures in a JSON object, with the name of each capture as the key**, and the matched string as the corresponding value.

```bash
# capture("(?<a>[a-z]+)-(?<n>[0-9]+)")
$ echo '"xyzzy-14"' | jq 'capture("(?<a>[a-z]+)-(?<n>[0-9]+)")'
{
  "a": "xyzzy",
  "n": "14"
}
```

### scan

`scan(regex)`, `scan(regex; flags)`

- Emit a stream of the non-overlapping substrings of the input that match the regex in accordance with the  flags,  if  any  have been  specified.
    - If  there is no match, the stream is empty.
    - To capture all the matches for each input string, use the idiom `[ expr ]`, e.g. `[ scan(regex) ]`.

```bash
# [scan("\\d")]
$ echo '"1a2bc3"' | jq '[scan("\\d")]'
[
  "1",
  "2",
  "3"
]
```

### split and splits

`split(regex; flags)`

- For backwards compatibility, **`split` splits on a string, not a regex.**

`splits(regex)`, `splits(regex; flags)`

- These **provide the same results as their `split` counterparts, but as a stream instead of an array.**

```bash
# split("[a-zA-Z]+"; "g")
$ echo '"1A2BC3"' | jq 'split("[a-zA-Z]+"; "g")'
[
  "1",
  "2",
  "3"
]

# [splits("[a-zA-Z]+"; "g")]
$ echo '"1A2BC3"' | jq '[splits("[a-zA-Z]+"; "g")]'
[
  "1",
  "2",
  "3"
]
```

### sub and gsub

`sub(regex; tostring)`, `sub(regex; string; flags)`

- **Emit the string obtained by replacing the first match of regex in the input string with `tostring`, after interpolation.**
    - `tostring` should  be  a  jq  string, and may contain references to named captures.
    - The named captures are, in effect, presented as a JSON object (as constructed by `capture`) to `tostring`, so a reference to a captured variable named "x" would take the form: "(.x)".

`gsub(regex; string)`, `gsub(regex; string; flags)`

- `gsub` is like `sub` but all the non-overlapping occurrences of the regex are replaced by the string, after interpolation.

```bash
# sub("[a-zA-Z]+"; " ")
$ echo '"1A2BC3"' | jq 'sub("[a-zA-Z]+"; " ")'
"1 2BC3"

# gsub("[a-zA-Z]+"; " ")
$ echo '"1A2BC3"' | jq 'gsub("[a-zA-Z]+"; " ")'
"1 2 3"
```

## Advanced Features

TODO

## Others

### Math

jq currently only has **IEEE754 double-precision (64-bit) floating point number support**.

- Besides simple arithmetic operators such as `+`, jq also has most standard math functions from the C math library.
    - C math functions that take a single input argument (e.g., `sin()`) are available as zero-argument jq functions.
    - C math functions that take two input arguments (e.g., `pow()`) are available as two-argument jq functions that ignore `.`.
    - C math functions that take three input arguments are available as three-argument jq functions that ignore `.`.
- Availability of standard math functions depends on the availability of the corresponding math functions in your operating system and C math library.
    - Unavailable math functions will be defined but will raise an error.
- One-input C math functions :
    - `acos acosh asin asinh atan atanh cbrt ceil cos cosh erf erfc exp exp10 exp2 expm1 fabs floor gamma j0 j1 lgamma log log10 log1p log2 logb nearbyint pow10 rint round significand sin sinh sqrt tan tanh tgamma trunc y0 y1`
- Two-input C math functions :
    - `atan2 copysign drem fdim fmax fmin fmod frexp hypot jn ldexp modf nextafter nexttoward pow remain der scalb scalbln yn`
- Three-input C math functions :
    - `fma`
- See your system's manual for more information on each of these.

_( icehe : 还算用得上, 至少得知道能做这些操作 )_

- **Common Functions** : `ceil fabs floor round pow`

### _I/O_

_( icehe : 看起来用不着 )_

- At this time jq has minimal support for I/O, mostly in the form of control over when inputs are read.
    - Two builtins functions are provided for this, `input` and `inputs`, that read from the same sources (e.g., `stdin`, files named on the command-line) as jq itself.
    - These two builtins, and jq's own reading actions, can be interleaved with each other.
- Two builtins provide minimal output capabilities, `debug`, and `stderr`.
    - (Recall that a jq program's output values are always output as JSON texts on stdout.)
    - The debug builtin can have application-specific behavior, such as for executables that use the libjq C API but aren't the jq executable itself.
    - The stderr builtin outputs its input in raw mode to stder with no additional decoration, not even a newline.
- Most jq builtins are referentially transparent, and yield constant and repeatable value streams when applied to constant inputs.
    - This is not true of I/O builtins.

`input`

- Outputs one new input.

**`inputs`**

- Outputs all remaining inputs, one by one.
- This is primarily useful for reductions over a program's inputs.

_`debug`_

- Causes a debug message based on the input value to be produced.
    - The jq executable wraps the input value with `["DEBUG:", <input-value>]` and prints that and a newline on stderr, compactly.
    - _This may change in the future._

_`stderr`_

- Prints its input in raw and compact mode to stderr with no additional decoration, not even a newline.

`input_filename`

- Returns the name of the file whose input is currently being filtered.
    - Note that this will not work well unless jq is running in a UTF-8 locale.

`input_line_number`

- Returns the line number of the input currently being filtered.

### _Streaming_

_( icehe : 有点迷糊, 看不太懂 )_

- With the `--stream` option jq can parse input texts in a streaming fashion, allowing jq programs to start processing large JSON texts immediately rather than after the parse completes.
    - If you have a single JSON text that is 1GB in size, streaming it will allow you to process it much more quickly.
- _However, streaming isn't easy to deal with as the jq program will have `[<path>, <leaf-value>]` (and a few other forms) as inputs._
- _Several builtins are provided to make handling streams easier._
- _The examples below use the streamed form of `[0,[1]]`, which is `[[0],0],[[1,0],1],[[1,0]],[[1]]`._
- Streaming forms include `[<path>, <leaf-value>]` (to indicate any scalar value, empty array, or empty object), and `[<path>]` (to indicate the end of an array or object).
    - Future versions of jq run with `--stream` and `-seq` may output additional forms such as `["error message"]` when an input text fails to parse.

`truncate_stream(stream_expression)`

- Consumes a number as input and truncates the corresponding number of path elements from the left of the outputs of the given streaming expression.

```bash
$ echo '[ [[0],1],[[1,0],2],[[1,0]],[[1]] ]' | jq
[
  [
    [
      0
    ],
    1
  ],
  [
    [
      1,
      0
    ],
    2
  ],
  [
    [
      1,
      0
    ]
  ],
  [
    [
      1
    ]
  ]
]

# [1|truncate_stream([[0],1],[[1,0],2],[[1,0]],[[1]])]
$ echo null | jq '[1|truncate_stream([[0],1],[[1,0],2],[[1,0]],[[1]])]'
[
  [
    [
      0
    ],
    2
  ],
  [
    [
      0
    ]
  ]
]
```

`fromstream(stream_expression)`

- Outputs values corresponding to the stream expression's outputs.

```bash
# fromstream(1|truncate_stream([[0],1],[[1,0],2],[[1,0]],[[1]]))
$ echo null | jq 'fromstream(1|truncate_stream([[0],1],[[1,0],2],[[1,0]],[[1]]))'
[
  2
]
# ( icehe : 这个例子没看懂… )
```

`tostream`

- The tostream builtin outputs the streamed form of its input.

```bash
# . as $dot|fromstream($dot|tostream)|.==$dot
$ echo '[0,[1,{"a":1},{"b":2}]]' | jq '. as $dot|fromstream($dot|tostream)|.==$dot'
true
# ( icehe : 这个例子至少看懂, 但是还是不懂 tostream 的操作… )
```

<!--

### _Modules_

_( icehe : 感觉这个 modules 没什么用 )_

jq has a library/module system. Modules are files whose names end in `.jq`.

- Modules imported by a program are searched for in a default search path (see below).
    - The `import` and `include` directives allow the importer to alter this path.
- Paths in the a search path are subject to various substitutions.
- For paths starting with "~/", the user's home directory is substituted for "~".
- For paths starting with "$ORIGIN/", the path of the jq executable is substituted for "$ORIGIN".
- For paths starting with "./" or paths that are ".", the path of the including file is substituted for ".".
    - For top-level programs given on the command-line, the current directory is used.
- Import directives can optionally specify a search path to which the default is appended.
- The default search path is the search path given to the `-L` command-line option, else `["~/.jq", "$ORIGIN/../lib/jq", "$ORIGIN/../lib"]`.
- Null and empty string path elements terminate search path processing.
- A dependency with relative path "foo/bar" would be searched for in "foo/bar.jq" and "foo/bar/bar.jq" in the given search path.
    - This is intended to allow modules to be placed in a directory along with, for example, version control files, README files, and so on, but also to allow for single-file modules.
- Consecutive components with the same name are not allowed to avoid ambiguities (e.g., "foo/foo").
- For example, with `-L$HOME/.jq` a module foo can be found in `$HOME/.jq/foo.jq` and `$HOME/.jq/foo/foo.jq`.
- If "$HOME/.jq" is a file, it is sourced into the main program.

`import RelativePathString as NAME [<metadata>];`

- Imports a module found at the given path relative to a directory in a search path.
    - A ".jq" suffix will be added to the relative path string.
    - The module's symbols are prefixed with "NAME::".
- The optional metadata must be a constant jq expression.
    - It should be an object with keys like "homepage" and so on.
    - At this time jq only uses the "search" key/value of the metadata.
    - The metadata is also made available to users via the `modulemeta` builtin.
- The "search" key in the metadata, if present, should have a string or array value (array of strings);
    - this is the search path to be prefixed to the top-level search path.

`include RelativePathString [<metadata>];`

- Imports a module found at the given path relative to a directory in a search path as if it were included in place.
    - A ".jq" suffix will be added to the relative path string.
    - The module's symbols are imported into the caller's namespace as if the module's content had been included directly.
- The optional metadata must be a constant jq expression.
    - It should be an object with keys like "homepage" and so on.
    - At this time jq only uses the "search" key/value of the metadata.
    - The metadata is also made available to users via the `modulemeta` builtin.

`import RelativePathString as $NAME [<metadata>];`

- Imports a JSON file found at the given path relative to a directory in a search path.
    - A ".json" suffix will be added to the relative path string.
    - The file's data will be available as `$NAME::NAME`.
- The optional metadata must be a constant jq expression.
    - It should be an object with keys like "homepage" and so on.
    - At this time jq only uses the "search" key/value of the metadata.
    - The metadata is also made available to users via the `modulemeta` builtin.
- The "search" key in the metadata, if present, should have a string or array value (array of strings);
    - this is the search path to be prefixed to the top-level search path.

`module <metadata>;`

- This directive is entirely optional.
    - It's not required for proper operation.
    - It serves only the purpose of providing metadata that can be read with the modulemeta builtin.
- The metadata must be a constant jq expression.
    - It should be an object with keys like "homepage".
    - At this time jq doesn't use this metadata, but it is made available to users via the modulemeta builtin.

`modulemeta`

- Takes a module name as input and outputs the module's metadata as an object, with the module's imports (including metadata) as an array value for the "deps" key.
- Programs can use this to query a module's metadata, which they could then use to, for example, search for, download, and install missing dependencies.

-->

### _Colors_

_( icehe : 调整配色, 还算有点用 )_

To configure alternative colors just set the `JQ_COLORS` environment variable to colon-delimited list of partial terminal escape sequences like `"1;31"`, in this order:

- 1\. color for null
- 2\. color for false
- 3\. color for true
- 4\. color for numbers
- 5\. color for strings
- 6\. color for arrays
- 7\. color for objects

The default color scheme is the same as setting `"JQ_COLORS=1;30:0;39:0;39:0;39:0;32:1;39:1;39"`.

This is not a manual for VT100/ANSI escapes.

- However, each of these color specifications should consist of two numbers separated by a semi-colon, where the first number is one of these:
    - 1\. bright
    - 2\. dim
    - 4\. underscore
    - 5\. blink
    - 7\. reverse
    - 8\. hidden
- and the second is one of these:
    - 30\. black
    - 31\. red
    - 32\. green
    - 33\. yellow
    - 34\. blue
    - 35\. magenta
    - 36\. cyan
    - 37\. white

## ASSIGNMENT

TODO

## Usage

### Sort Keys

```bash
# --sort-keys
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
