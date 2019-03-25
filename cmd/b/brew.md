# brew

> The missing package manager for macOS

## Description

TODO

## Options

TODO

## Usage

### Info

```bash
$ brew info elasticsearch
elasticsearch: stable 6.6.2, HEAD
Distributed search & analytics engine
https://www.elastic.co/products/elasticsearch
Not installed
From: https://github.com/Homebrew/homebrew-core/blob/master/Formula/elasticsearch.rb
==> Requirements
Required: java = 1.8 ✔
==> Options
--HEAD
        Install HEAD version
==> Caveats
Data:    /usr/local/var/lib/elasticsearch/elasticsearch_mac/
Logs:    /usr/local/var/log/elasticsearch/elasticsearch_mac.log
Plugins: /usr/local/var/elasticsearch/plugins/
Config:  /usr/local/etc/elasticsearch/

To have launchd start elasticsearch now and restart at login:
  brew services start elasticsearch
Or, if you don't want/need a background service you can just run:
  elasticsearch
==> Analytics
install: 12,738 (30 days), 32,401 (90 days), 117,322 (365 days)
install_on_request: 11,666 (30 days), 29,689 (90 days), 105,912 (365 days)
build_error: 0 (30 days)
```

### Search

```bash
$ brew search elasticsearch
==> Formulae
elasticsearch    elasticsearch@2.4    elasticsearch@5.6
```
