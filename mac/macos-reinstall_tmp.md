# Re-install macOS

TODO : Merge into `initilize.md`

- create bootable installer for macOS（创建引导分区，即U盘安装）
    - ref: <https://support.apple.com/en-us/HT201372>
- reboot, press `⌘ + r`
    - or reboot, press `⌘ + ⌥ + r`
        - connect wifi, wait for processing until reboot
    - or reboot, press `⌥` for a few seconds
        - reboot from different disk you selected
- restore from backups of Time Machine
    - or restore from Disk Backup by Disk Utility
    - or re-install macOS

how to re-intall on 2018-06-12

- TODO: 创建引导分区（U盘安装器）
- reboot, press `⌘ + ⌥ + r`
- restore from backups of Time Machine
    - failed
- re-install macOS

## System Preferences

iCloud

- login
- enable some services

Keyboard

- set `Delay Until Repeat` max
- set `Key Repeat` max
- clear `Text`

Trackpad

- set `Tracking speed` max
- disable `More gestures -> Notification center`

Dock

- set `Auto Hide`
- remove useless apps from Dock

Notification

- disable useless apps on demand
    - follow principles:
        - `kiss : keep it simple & stupid` 简单原则
        - `ootb : out of the box` 开箱即用

Users & Groups

- set `Login Items` (开机启动程序)
    - or change preferences of apps

## Apps

ShadowsocksX-NG

- get configs from your Shadowsocks service
    - mine: <https://portal.shadowsocks.to>
- re-config by scanning QR Code

Chrome

- login Google
- open <chrome://apps/>
- remove Postman (useless apps)

Sogou Input

- login by WeChat
- ShowyEdge : show color bar
- configure in `System Preferences`
    - remove useless input sources
    - add Sogou Input

Karabiner-Elements

- Simple Modifications
    - Caps Lock `⇪` -> Left Ctrl `^`
    - Left Ctrl `^` -> Caps Lock `⇪`
    - Right Cmd `⌘` -> Esc `⎋`
- Function Keys
    - from Media Control to Function Keys (F1 ~ F12)

Keyboard Maestro

- set license

Bartender 3

- set license
- re-config

2Do

- re-download
- set username + password

euDic

- re-download
- login by QQ

Itsycal

- re-config
    - ` Y.MM.dd  E  HH:mm:ss `

iTerm 2

- set config path
- restart app

JetBrains : IntelliJ IDEA / GoLand / CLion

- set license
- TODO: re-config / recover configs?

<!-- Outlook -->

<!-- - login Microsoft Account -->
<!-- - add Email -->
<!--     - Sina: <http://it.sina.com.cn/?page_id=1342> -->

VS Code

- execute `defaults write com.microsoft.VSCode ApplePressAndHoldEnabled -bool false`
- restart app

## bash

```bash
# install brew <https://brew.sh/>
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"

# install neccessary tools
brew install \
coreutil fzf nvim safe-rm tmux
```

```bash
# Fix tmux
# ( Ref : https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x )
brew install reattach-to-user-namespace
```

## todo

tmux 通过 brew install tmux 安装，但无法使用
