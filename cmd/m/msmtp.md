# How to mail on macOS

FIXME: something wrong

---

References

- Mac OS X 下用命令行发送邮件 : https://my.oschina.net/uhziel/blog/186683
- msmtp - documentation : https://marlam.de/msmtp/documentation

## msmtp

**An SMTP client**

See `man msmtp` for more

---

### Install

```bash
brew install msmtp
```

### Config

Create file `~/.mailrc` & append configs to it as below

```bash
set sendmail=/usr/local/bin/msmtp
```

Create file `~/.msmtprc` & append configs to it as below

- Replace PASSWORD with your real password
- Replace icehe.xyz@qq.com with your real email address

```bash
# Use an external SMTP server with insecure authentication.
# (manually choose an insecure authentication method.)
# Note that the password contains blanks.

defaults

####################################################################
# A sample configuration using QQMail
####################################################################

# account name is "qqmail".
# You can select this account by using "-a qqmail" in your command line.
account qqmail
host smtp.qq.com
tls on
tls_certcheck off
port 465
auth login
from icehe.xyz@qq.com
user icehe.xyz@qq.com
password PASSWORD

# If you don't use any "-a" parameter in your command line,
# the default account "qqmail" will be used.
account default: qqmail
```

### Send

```bash
# e.g.
echo "CONTENT" | mailx -s "SUBJECT" 290841032@qq.com,fenggongweiye@163.com
```

```bash
mail -s
# or
mail
```
