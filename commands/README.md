# Commands

Recommended Guide

- [The Art of Command Line](https://github.com/jlevy/the-art-of-command-line/blob/master/README.md) / [中文版](https://github.com/jlevy/the-art-of-command-line/blob/master/README-zh.md)

Mine

- [Home/CLI](README.md#cli)

Manual

- `man` is an interface to the on-line reference manuals

```bash
man [command]

# `man bash`
```

## Temporary

`crontab`

```bash
alias crontab="VIM_CRONTAB=true crontab"
```

`tree` ( mock ) : list directory content

```bash
find [directory_path] | sed -e "s/[^-][^\/]*\//  |/g" -e "s/|\([^ ]\)/|── \1/"
```

`npm` install globally

```bash
# NPM Install globally
npm i docsify-cli -g
```

`ps`

> process status

```bash
ps -ef
ps aux
```

`service`

```bash
service [serv_name] [start|stop|status|restart]

# `service nginx restart`
```

`systemctl`

```bash
systemctl [start|stop|reload|restart] [serv_name]

# `systemctl restart nginx`
```
