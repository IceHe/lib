# Output

Redirect output ( not a command )

---

```bash
# 将 "标准错误输出" 重定向到 "标准输出"
command 2>&1
# e.g.
nohup icehe.sh > icehe.log 2>&1 &
# 解释 : 将 "标准错误输出" `2` 重定向到 "标准输出" `&1` ,
# "标准输出" `&1` 再被重定向输入到 icehe.log 文件中
```

- 0 - stdin : standard input 标准输入
- 1 - stdout : standard output 标准输出
- 2 - stderr : standard error 标准错误输出
