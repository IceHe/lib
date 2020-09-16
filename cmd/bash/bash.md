# Bash ( draft )

TODOs

- Compound Commands ( Control Structure )
- Built-in Function
- Built-in Commands
- Special Characters?
- ……

## Tips

Append `.` to shell variable `$PATH` :

- How to
    - Append `.` to file `/etc/paths`.
    - Or append `export PATH=".:$PATH"` to file `.bashrc` ( or `.zshrc` )

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
