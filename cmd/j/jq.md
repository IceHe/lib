# jq

> Command-line JSON processor

References

- `man jq`

## Synopsis

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
