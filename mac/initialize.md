# Mac Initialize

- Based on macOS
- For Java developers
- Follow principles:
    - `kiss : keep it simple & stupid` 简单原则
    - `ootb : out of the box` 开箱即用

## Install

### macOS

Create bootable installer for macOS（创建引导分区，即U盘安装）

- Reference : https://support.apple.com/en-us/HT201372

Reboot, press `⌘ + r`

- or Reboot, press `⌘ + ⌥ + r`
    - Connect wifi, wait for processing until reboot
- or Reboot, press `⌥` for a few seconds
    - Reboot from different disk you selected

Restore from backups of Time Machine

- or Restore from Disk Backup by Disk Utility
- or Re-install macOS

### Over the Wall

若所需软件无法下载，或者速度太慢，可能需要「番羽土啬」，方法如下

1. 连接网络
2. 打开「系统偏好设置」
3. 「网络」
4. 「高级…」
5. 「代理」
6. 勾选「自动代理配置」
7. 找到「URL:」文本框（在「代理配置文件」下面）
8. 填写 ~~`http://url/to/proxy.pac`~~（PAC 文件的网址 TODO）
9. 点击「好」

Ref : [PAC](https://baike.baidu.com/item/PAC/16292100)（代理自动配置）- 百度百科

### Homebrew

[macOS 包管理器](https://brew.sh/)，用于安装 & 管理 macOS 的命令行工具以及 Apps ，命令为 `brew`

Steps

- Install Homebrew

```bash
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
```

- Show version ( check if installed successfully or not ? )

```bash
$ brew --version
# output e.g.
Homebrew 1.7.2
Homebrew/homebrew-core (git revision 27f23; last commit 2018-08-24)
```

### JDK 8

Install [Java Development Kit](https://en.wikipedia.org/wiki/Java_Development_Kit) version 8 ( [History](https://en.wikipedia.org/wiki/Java_version_history#Java_SE_8) )

- Recommended ：Install via commands as follow
- Alternative : Download [binary installation package](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html) of Mac OS X x64 from offical website

Steps

- Tap a formula repository ( 配置软件源 )

```bash
brew tap caskroom/versions
```

- Install JDK 8
    - Notice : require to input macOS user password
    - For latest version, execute `brew cask install java`

```bash
brew cask install java8
```

Get JDK Path

- For latest version, execute `/usr/libexec/java_home`

```bash
$ /usr/libexec/java_home -v 1.8
# output e.g.
/Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
```

Environment Variable `JAVA_HOME`

- Append the command line below to config file `~/.bashrc`
    - If ~/.bashrc doesn't exists, create it.
    - If use other shell such as `zsh`, append to `~/.zshrc`

```bash
export JAVA_HOME=`/usr/libexec/java_home -v 1.8`
```

> `~` tilde ( 波浪号 )
>
> - In the path `~/.bashrc`, `~` means current user's home directory
> - In macOS, it's `/Users/[USERNAME]` such as `/Users/IceHe`

### CLI

> Command Line Interface

Install other commands by command `brew`

- 即使 macOS 已经预装了基本的命令行工具
- 但是它们只随着 OS 更新而更新，更新频率低，版本相对滞后

What to Install ( recommended )

```bash
brew install \
    cmake coreutils curl except gawk git gradle groovysdk \
    fzf jq maven nvim ruby safe-rm tmux vim wget
```

```bash
# Tips: Fix `tmux`
# ( Ref : https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x )
brew install reattach-to-user-namespace
```

How to Update

- brew update ：
    - Fetch the newest version of Homebrew from GitHub using git.
- brew upgrade ：
    - Upgrade outdated, unpinned brews ( commands installed by Homebrew ).

```bash
brew update && brew upgrade
```

If encounter error below,

```bash
# 输出
xcrun: error: invalid active developer path (/Library/Developer/CommandLineTools), missing xcrun at: /Library/Developer/CommandLineTools/usr/bin/xcrun
```

Execute command below and then re-run commands above.

```bash
xcode-select install
```

> Command List & Description
>
> - [autoconf](https://www.gnu.org/software/autoconf/autoconf.html)
>     - produce shell scripts to automatically configure software source code packages
> - [cmake](https://cmake.org/)
>     - an cross-platform family of tools designed to build, test and package software
> - [coreutils](http://www.gnu.org/s/coreutils/)
>     - the basic file, shell and text manipulation utilities of the GNU operating system
>     - include many useful commands, see TOC of [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html). e.g., use [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html) to get absolute path to a file or directory
> - [curl](https://curl.haxx.se/)
>     - transfer data with URLs
>     - for HTTP debug & download files
> - [expect](https://linux.die.net/man/1/expect)
>     - programmed dialogue with interactive programs
>     - I write a script using expect for remote login
> - [gawk](https://linux.die.net/man/1/gawk) ( awk )
>     - pattern scanning and processing language
>     - for text formatting & log analysis
> - [git](https://git-scm.com/)
>     - a distributed version control system
>     - for code management
> - [gradle](https://gradle.org/)
>     - a build automation tool focused on flexibility and performance
>     - for building Java & Groovy projects based on config file *.gradle
> - [groovysdk](http://www.groovy-lang.org/)
>     - a multi-faceted language for the Java platform
>     - for Java unit-testing ( [Spock](http://spockframework.org/) ) or Groovy projects
>     - Notice : Install **groovysdk** but ~~groovy~~ by Homebrew ( see [Stack Overflow](https://stackoverflow.com/questions/41110256/how-do-i-tell-intellij-about-groovy-installed-with-brew-on-osx/41111852) )
>     - More : Add Groovy SDK to IntelliJ IDEA ( ref [link](https://www.bonusbits.com/wiki/HowTo:Add_Groovy_SDK_to_IntelliJ_IDEA) )
> - [jq](https://stedolan.github.io/jq/)
>     - a lightweight and flexible command-line JSON processor
>     - for JSON formatting
>         - basic filters
>         - builtin operators & functions
>         - advanced features…
> - [maven](https://maven.apache.org/)
>     - a software project management and comprehension tool
>     - for Java project management based on config files - pom.xml
> - [ruby](https://www.ruby-lang.org/en/)
>     - Ruby programming language
>     - Package Manger : `gem`
> - [vim](https://www.vim.org/)
>     - the God of editors - Vim / the editor of Gods - Emacs
>     - text editor in CLI
>     - optional : `nvim` aka. [Neovim](https://neovim.io/)
> - [wget](https://www.gnu.org/software/wget/)
>     - Download files via HTTP/HTTPS、FTP/FTPS protocols.

### IntelliJ IDEA

Download [latest isntallation](https://www.jetbrains.com/idea/download/#section=mac) from [offical website](https://www.jetbrains.com/idea/)

- Choose version : **Ultimate**

Get lincense

- Buy offical [license](https://www.jetbrains.com/idea/buy/#edition=commercial)
- or buy a license on Taobao
- or temp workaround - [Ref 1](http://idea.lanyus.com/) / [Ref 2](https://www.jianshu.com/p/f404994e2843)

Intsll plugins

- [Maven Helper](https://plugins.jetbrains.com/plugin/7179-maven-helper)
- [Lombok Plugin](https://plugins.jetbrains.com/plugin/6317-lombok-plugin)

> [Project Lombok](https://projectlombok.org/)
>
> > It is a java library that automatically plugs into your editor and build tools, spicing up your java.
> >
> > Never write another getter or equals method again. Early access to future java features such as val, and much more.
>
> Optional plugins
> - [PlantUML integration](https://plugins.jetbrains.com/plugin/7017-plantuml-integration)
>     - Draw UML graphs for docs by [PlatUML](http://plantuml.com/)
> - [IdeaVim](https://plugins.jetbrains.com/plugin/164-ideavim)
>     - Vim emulator - edit text like Vim
>
> IDE for team
>
> - Use the same IDE for better collaboration in a team
>     - Uniform code format for all developers in a team
>     - Easy to learn IDE developing experience accumulated by other teammates
>     - Teammates are easy to use others' development environment (IDE)
>     - ……

### Mac Apps

#### Common

Instant Messaging

- [Mac QQ](http://im.qq.com/macqq/)
- Mobile Client
    - Recommended : [TIM](https://tim.qq.com/download.html) ( official QQ as well )
        - Focus on comunication & teamwork
    - Alternative : [Mobile QQ](http://im.qq.com/mobileqq/)

Email

- Mail
    - macOS builtin mail client
- [Microsoft Outlook](https://products.office.com/zh-cn/outlook/email-and-calendar-software-microsoft-outlook?tab=tabs-1) ( recommend to purchase )
    - Better rules for too many emails
    - [Office 365](https://products.office.com/zh-cn/compare-all-microsoft-office-products?tab=1) license ( include Outlook, Word, Excel, PPT & etc. )

Browser

- [Chrome](https://www.google.com/chrome/)

Terminal Emulator

- [iTerm2](https://www.iterm2.com/)
    - Better than macOS builtin Terminal

Code Editor

- [VS Code](https://code.visualstudio.com/) ( recommended )
    - Easy to use, free, open source
    - Support [Markdown](https://docs.gitlab.com/ee/user/markdown.html) ( *.md file )
        - Check Markdown style
            - [markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint) plugin
        - Support [PlatUML](http://plantuml.com/) real-time rendering in Markdown code blocks
            - [Markdown Preview Enhanced](https://marketplace.visualstudio.com/items?itemName=shd101wyy.markdown-preview-enhanced) plugin
    - Support [PlatUML](http://plantuml.com/) ( *.puml file )
        - [PlantUML](https://marketplace.visualstudio.com/items?itemName=jebbs.plantuml) plugin
    - Advanced : Vim emulator - edit text like Vim
        - [Vim](https://marketplace.visualstudio.com/items?itemName=vscodevim.vim) plugin
- [Sublime Text](https://www.sublimetext.com/)
    - Lightweight, easy to use, free
    - Its cold boot is the fastest. ( compared to VS Code, Atom & etc. )
    - Builtin **Vintage** Mode : edit text like Vim

#### Recommended

Chrome plugins

- [OneTab](https://chrome.google.com/webstore/detail/onetab/chphlpgkkbolifaimnlloiipkdnihall) : Reduce tab clutter
    - 当打开的标签页过多时，可暂存到 OneTab 的列表中，节省内存、简洁展示
- [uBlock Origin](https://chrome.google.com/webstore/detail/cjpalhdlnbpafiamejdnhcphjbkeiagm) : A lightweight AD blocker
- [JSON Formatter](https://chrome.google.com/webstore/detail/bcjindcccaagfpapjjmafapmmgkkhgoa) : Make JSON easy to read
- [Proxy SwitchyOmega](https://chrome.google.com/webstore/detail/padekgcemlokbadohgkifijomclgjgif) : Manage and switch between multiple proxies quickly & easily
- [cVim](https://chrome.google.com/webstore/detail/ihlenndgcmojhcghmfjfneahoeklbjjh) ( advanced ) : Add Vim-like key-bindings to Chrome for faster operations

Clipboard Management

- Reasons for installation
    - 复制粘贴时，经常需要在多个页面和 Apps 之间反复切换
    - 剪贴板管理工具可以减少不必要的重复操作，大大提高效率
- [Paste 2](https://pasteapp.me/)
    - Advantages : Simple, pretty, easy to use, able to search copied content
    - Disadvantages : 图形界面占用空间较大，信息展示效率不高
- [Copy'em Paste](http://apprywhere.com/copy-em-paste.html)
    - More configurations
- …

Dictionary

- 词典 Dictionary
    - macOS builtin, enough
- Alternative
    - EuDic : [欧路词典](https://www.eudic.net/v4/en/app/eudic) ( recommended )
    - Youdao Dict : [有道词典](https://itunes.apple.com/cn/app/you-dao-ci-dian/id491854842?mt=12)

HTTP API Debug

- [Postman](https://www.getpostman.com/)
    - for HTTP API debug & test

Mind Mapping

- [MindNote](https://mindnode.com/) ( recommended )
- [XMind](https://www.xmind.net/)
- …

Mac references :

- [Tools](marks/tools/README.md) : 利器 - 软件 / 物件的推荐
- [Efficiency](mac/efficiency.md) : 效率指南
- [Shortcuts](mac/shortcuts/README.md) : 快捷键

## Config

Include

- Development configurations on local & remote machines

### System Preferences

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

Users & Groups

- set `Login Items` (开机启动程序)
    - or change preferences of apps

### Apps

1Password

- re-install in App Store

ShadowsocksX-NG

- get configs from your Shadowsocks service
    - mine: <https://portal.shadowsocks.to>
- re-config by scanning QR Code

Chrome

- login Google
- open <chrome://apps/>

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

2Do

- re-download
- set username + password

EuDic

- re-download
- login by QQ

Itsycal

- re-config
    - ` Y.MM.dd  E  HH:mm:ss `

iTerm 2

- set config path
- restart app

JetBrains : IntelliJ IDEA / GoLand / CLion

- set license (login)

Outlook

- login Microsoft Account

VS Code

- execute `defaults write com.microsoft.VSCode ApplePressAndHoldEnabled -bool false`
- restart app

### Git

Git username & email

- `[EMAIL]` e.g. icehe@gmail.com
- `[USERNAME]` e.g. IceHe

```bash
git config --global user.name [USERNAME]
git config --global user.email [EMAIL]

# e.g.
git config --global user.name icehe
git config --global user.email icehe@gmail.com
```

Check

```bash
$ git config --global -l | grep user

# output e.g.
user.name=icehe
user.email=icehe@gmail.com
```

### Git* Repo

为代码仓库添加 SSH 公钥（例如 GitHub / GitLab）

- 优点：无需本地记录账号密码或重复输入，即可执行拉取、推送代码等操作
- 生成 & 获取 SSH 密钥（ 公钥 + 私钥 ）

生成和添加的步骤

- 生成新的 SSH 密钥对

```bash
ssh-keygen -t rsa -C "[邮箱前缀]@gmail.com" -b 4096

# 例如
# `ssh-keygen -t rsa -C "icehe@gmail.com" -b 4096`
```

- ssh-keygen 的命令行会多次提示你进行输入，如下
    - Enter file in which to save the key (/Users/[用户名]/.ssh/id_rsa):
    - Enter passphrase (empty for no passphrase):
    - Enter same passphrase again:
- 都敲回车键「↩」即可（ 无需其它输入 ）
- 如果本地已存在默认 SSH 密钥对，命令行会提示

```bash
# 输出
/Users/[用户名]/.ssh/id_rsa already exists.
Overwrite (y/n)?
```

- 建议输入「y」，重新生成
- 将公钥复制到系统剪贴板

```bash
pbcopy < ~/.ssh/id_rsa.pub
```

- 进入个人 Settings 的 SSH Keys 页面 ( 自行查找 )
- 将剪贴板中的公钥信息，粘贴到「Key」文本输入框中（ Title 文本框将会被自动填充 ）
- 然后点击「Add key」即可

### Maven

Configurations

- 打开 Maven 配置文件模板 [~~settings.xml~~](todo/settings.xml)（TODO），**复制** 其内容
- 打开本地的配置文件，**粘贴覆盖** 原来的内容
    - `open` 命令：使用默认的文本编辑器打开
    - 注意：若使用私人设备办公，设备已存在有效的 Maven 配置，请谨慎地人工合并 settings.xml 的内容

```bash
open ~/.m2/settting.xml
```
