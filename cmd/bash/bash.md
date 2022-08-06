# Bash

todo

-   Compound Commands ( Control Structure )
-   Built-in Function
-   Built-in Commands
-   Special Characters?
-   ……

## Tips

Append `.` to shell variable `$PATH` :

-   How to
    -   Append `.` to file `/etc/paths`.
    -   Or append `export PATH=".:$PATH"` to file `.bashrc` ( or `.zshrc` )

## Usage

### exist?

```bash
#判断文件是否存在
# 好像 $testFile 不能使用 `~`
if [[ ! -f "$testFile" ]]; then
    echo "文件不存在"
else
    echo "文件存在"
fi
```

### script mode

Reference: [set -e, -u, -o, -x pipefail](https://gist.github.com/vncsna/64825d5609c146e80de8b1fd623011ca)

-   The `set -e` option instructs bash to immediately exit if any command has a non-zero exit status.

-   `set -o pipefail` setting prevents errors in a pipeline from being masked.

    -   If any command in a pipeline fails, that return code will be used as the return code of the whole pipeline.
    -   By default, the pipeline's return code is that of the last command even if it succeeds.

todo
