# brew

> The missing package manager for macOS

## Description

TODO

Synopsis

```bash
brew --version
brew command [--verbose|-v] [options] [formula] ...
```

## Options

TODO

## Usage

### Help

```bash
$ brew --help
Example usage:
  brew search [TEXT|/REGEX/]
  brew info [FORMULA...]
  brew install FORMULA...
  brew update
  brew upgrade [FORMULA...]
  brew uninstall FORMULA...
  brew list [FORMULA...]

Troubleshooting:
  brew config
  brew doctor
  brew install --verbose --debug FORMULA

Contributing:
  brew create [URL [--no-fetch]]
  brew edit [FORMULA...]

Further help:
  brew commands
  brew help [COMMAND]
  man brew
  https://docs.brew.sh
```

### Commands

```bash
$ brew commands
Built-in commands
--cache           help              style
--cellar          home              switch
--env             info              tap
--prefix          install           tap-info
--repository      leaves            tap-pin
--version         link              tap-unpin
analytics         list              uninstall
cask              log               unlink
cat               migrate           unpack
cleanup           missing           unpin
command           options           untap
commands          outdated          update
config            pin               update-report
deps              postinstall       update-reset
desc              readall           upgrade
diy               reinstall         uses
doctor            search            vendor-install
fetch             sh
gist-logs         shellenv

Built-in developer commands
audit             irb               ruby
bottle            linkage           tap-new
bump-formula-pr   man               test
create            mirror            tests
edit              prof              update-test
extract           pull              vendor-gems
formula           release-notes

External commands
aspell-dictionaries
postgresql-upgrade-database
services

```

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
