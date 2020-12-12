# passwd

> - Linux : update user's authentication tokens
> - BSD : modify a user's password

References

- `man passwd`
- Linux 管理员修改和查看普通用户密码 - 简书 : https://www.jianshu.com/p/a0a7645a2c2e

Synopsis

```bash
passwd [-k] [-l] [-u [-f]] [-d] [-e]
    [-n mindays] [-x maxdays] [-w warndays]
    [-i inactivedays] [-S] [--stdin] [username]
```

Others

- Linux-PAM : Pluggable Authentication Modules for Linux : http://www.linux-pam.org/

## Options

- `-k, --keep` The option -k is used to indicate that the update should only be for expired authentication tokens  (passwords);
    - the  user wishes to keep their non-expired tokens as before.
- `--stdin` This option is used to indicate that passwd should read the new password from standard input, which can be a pipe.
- `-f, --force` Force the specified operation.

Available to root only

- `-l, --lock` This option is used to lock the password of specified account.
    - The locking is performed by rendering the encrypted password into an invalid string (by prefixing the encrypted  string  with  an  !).
    - Note  that  the account is not fully locked - the user can still log in by other means of authentication such as the ssh public key authentication. 关闭
    - Use chage -E 0 user command instead for full account locking.
- `-u, --unlock` This is the reverse of the -l option - it will unlock the account password by removing the ! prefix. 恢复
    - By default passwd will refuse to create a passwordless account (it will not unlock an account that has only "!" as a password).
    - The force option -f will override this protection.
- `-d, --delete` This is a quick way to delete a password for an account.
    - It will set the named  account  passwordless.
- `-e, --expire` This  is  a  quick  way to expire a password for an account.
    - The user will be forced to change the password during the next login attempt.
- `-n, --minimum DAYS` This will set the minimum password lifetime, in days, if the user's account supports password lifetimes.
- `-x, --maximum DAYS` This will set the maximum password lifetime, in days, if the user's account supports password lifetimes.
- `-w, --warning DAYS` This will set the number of days in advance the user will begin receiving warnings that her password will  expire,  if  the user's account supports password lifetimes.
- `-i, --inactive DAYS` This will set the number of days which will pass before an expired password for this account will be taken to mean that the account is inactive and should be disabled, if the user's account supports password lifetimes. 关闭密码认证 (无需输入密码)
- **`-S, --status`** This will output a short information about the status of the password for a given account.

## Usage

### Change Password

User root change password of normal user.

```bash
$ sudo passwd <NORMAL_USERNAME>

# e.g.
$ sudo passwd icehe
Enter new UNIX password:   # 输入新密码，输入的密码无回显
Retype new UNIX password:  # 确认密码
passwd: password updated successfully
```

### Show Brief Info

```bash
# e.g.
$ passwd -S root
root LK 1969-12-31 0 99999 7 -1 (Alternate authentication scheme in use.)

$ passwd -S icehe
passwd: Unknown user name 'icehe'.
```

## See Also

References

- passwd 命令 : http://man.linuxde.net/passwd

> 与用户、组账户信息相关的文件

存放用户信息：

```bash
/etc/passwd
/etc/shadow
```

存放组信息：

```bash
/etc/group
/etc/gshadow
```

用户信息文件分析（每项用:隔开）

```bash
# e.g.
jack:X:503:504:::/home/jack/:/bin/bash
```

- `jack` 用户名
- `X` 口令/密码
- `503` 用户 id（0 代表root, 普通新建用户从 500 开始）
- `504` 所在组
- `:` 描述
- `/home/jack/` 用户主目录
- `/bin/bash` 用户缺省 Shell

组信息文件分析

```bash
jack:$!$:???:13801:0:99999:7:*:*:
```

- `jack` 组名
- `$!$` 被加密的口令
- `13801` 创建日期与今天相隔的天数
- `0` 口令最短位数
- `99999` 用户口令
- `7` 到 7 天时提醒
- `*` 禁用天数
- `*` 过期天数