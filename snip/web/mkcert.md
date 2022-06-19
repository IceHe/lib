# mkcert

A simple zero-config tool to make locally trusted development certificates with any names you'd like.

---

References:

- [FiloSottile/mkcert: A simple zero-config tool to make locally trusted development certificates with any names you'd like.](https://github.com/FiloSottile/mkcert)
- _[在前端本地环境配置 HTTPS 证书](https://segmentfault.com/a/1190000023154948) (not good)_

## Install

```bash
brew install mkcert
mkcert -install
```

## Setup

```bash
# e.g. under home directory
mkcert local.icehe
mkcert localhost 127.0.0.1 ::1
```

## Configure on HTTP server

It depends.

TODO
