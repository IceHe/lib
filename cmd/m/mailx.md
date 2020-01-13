# How to mail on CentOS

References

- Centos 配置mailx使用外部smtp发送邮件 : https://blog.csdn.net/qq_25551295/article/details/51803942

## mailx

> send and receive Internet mail

Options

- `-a file` Attach the given file to the message.
- `-s subject` Specify subject on command line
    - only the first argument after the `-s` flag is used as a subject;
    - be careful to quote subjects containing spaces.
- `-t` The message to be sent is expected to contain a message header with `To:`, `Cc:`, or `Bcc:` fields  giving  its recipients.
    - Recipients specified on the command line are ignored.

See `man mailx` for more

## Install

```bash
yum install mailx
```

## Config

Open

```bash
vim /etc/mail.rc
```

Append

- Replace PASSWORD with your real password
- Replace icehe.me@qq.com with your real email address

```bash
set from="icehe.me@qq.com"  # 邮箱
set smtp=smtp.qq.com        # SMTP 服务器
set smtp-auth=login         # 登录行为
set smtp-auth-user=icehe.me@qq.com  # 用户名
set smtp-auth-password=PASSWORD     # 密码
```

## Send

```bash
# e.g.
echo "CONTENT" | mail -s "SUBJECT" 290841032@qq.com,fenggongweiye@163.com
# or replace `mail` with `mailx`
```
