# passwd

> - Linux : update user's authentication tokens
> - BSD : modify a user's password

References

- https://www.jianshu.com/p/a0a7645a2c2e

Synopsis

```bash
passwd [-k] [-l] [-u [-f]] [-d] [-e]
    [-n mindays] [-x maxdays] [-w warndays]
    [-i inactivedays] [-S] [--stdin] [username]
```

## Options

## Usage

### Change Password

User root change password of normal user.

```bash
sudo passwd <NORMAL_USERNAME>
# e.g.
sudo passwd icehe
```
