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
- The `options` are described in the INVOKING JQ section; they mostly concern input and output formatting.
    - The filter is written in the jq language and specifies how to transform the input file or document.

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
