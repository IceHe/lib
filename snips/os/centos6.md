# CentOS 6

## Locale

* for Chinese : zh\_CN

### CLI

References

* centos6.5版本改系统语言成中文简体 - CSDN博客 : [https://blog.csdn.net/zk673820543/article/details/50190355](https://blog.csdn.net/zk673820543/article/details/50190355)

Solution

* List available locales

```bash
$ locale -a
```

* Modify i18n  config file

```bash
$ vim /etc/sysconfig/i18n

# Refer below modifications
LANG="zh_CN.utf8"
SYSFONT="latarcyrheb-sun16"
```

### Vim

References

* Centos 中 vim 中文乱码有关问题 - 开源中国 : [https://my.oschina.net/bobwei/blog/798238](https://my.oschina.net/bobwei/blog/798238)

Append configs below to `/etc/vimrc`

```bash
set fileencodings=ucs-bom,utf-8,gbk,gb2312,cp936,gb18030,big5,latin-1
set encoding=utf-8
set termencoding=utf-8
set fileencoding=utf-8
```

