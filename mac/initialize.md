# Mac Initialize

- Based on macOS
- For Java developers
- Follow principles :
    - `KISS : keep it simple & stupid` 简单原则
    - `OOTB : out of the box` 开箱即用

References

- macOS Setup Guide : http://sourabhbajaj.com/mac-setup
- Apple Support
    - 如何创建可引导的 macOS 安装器 : https://support.apple.com/zh-cn/HT201372
    - 如何重新安装 macOS : https://support.apple.com/zh-cn/HT204904

## Install

### macOS

1\. Search `macOS` in Mac App Store and Download macOS Installation

- _Reference : 如何创建可引导的 macOS 安装器 - Apple Support :_ https://support.apple.com/zh-cn/HT201372

2\. Create bootable installer for macOS ( 创建引导分区，即U盘安装 )

```bash
# e.g. macOS Big Sur
sudo /Applications/Install\ macOS\ Big\ Sur.app/Contents/Resources/createinstallmedia \
    --volume /Volumes/Install\ macOS\ Big\ Sur
```

3\. \* Reboot, press `⌘ + r`

- or Reboot, press `⌘ + ⌥ + r`
    - Connect wifi, wait for processing until reboot
- or Reboot, press `⌥` for a few seconds
    - Reboot from different disk you selected
- _Reference : 如何重新安装 macOS - Apple Support :_ https://support.apple.com/zh-cn/HT204904

4\. \* Restore from backups of Time Machine _( Optional )_

- or Restore from Disk Backup by Disk Utility
- or Re-install macOS

5\. \* Disable animations to accelerate macOS _( Optional )_

- Mac 加速：干掉那些「炫酷」的动画 - 知乎 : https://zhuanlan.zhihu.com/p/20667030

### Network Proxy

If cannot download softwares you need, you need to over the Great Fire Wall ( in China Main Land )

1. Connect to network
2. Open **System Preferences**
3. **Network**
4. **Advanced…**
5. **Proxies**
6. Select **Automatic Proxy Configurattion**
7. Find "**URL:**" input box under "Proxy Configuration File"
8. Fill with ~~`http://url/to/proxy.pac`~~ ( URL to PAC file )
9. Click **OK**

Ref : [PAC](https://en.wikipedia.org/wiki/Proxy_auto-config) - Proxy Auto Config - Wikipedia

### Homebrew

`brew` [macOS package manager](https://brew.sh/) for installing & managing softwares on macOS

1\. Install

```bash
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
```

- If install slowly, please try :
    - Mac 下镜像飞速安装 Homebrew 教程 : https://zhuanlan.zhihu.com/p/90508170

2\. Validate

- Show version to check if installed successfully or not.

```bash
$ brew --version
Homebrew 1.7.2
Homebrew/homebrew-core (git revision 27f23; last commit 2018-08-24)
```

3\. Accelarate

- If upgrade slowly, please try :
    - Homebrew (中国大陆) 有比较快的源 (mirror) 吗? https://www.zhihu.com/question/31360766/answer/749386652

```bash
# Homebrew
git -C "$(brew --repo)" remote set-url origin https://mirrors.ustc.edu.cn/brew.git

# Homebrew Core
git -C "$(brew --repo homebrew/core)" remote set-url origin https://mirrors.ustc.edu.cn/homebrew-core.git

# Homebrew Cask
git -C "$(brew --repo homebrew/cask)" remote set-url origin https://mirrors.ustc.edu.cn/homebrew-cask.git

# Homebrew-bottles
## For BASH users :
echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' >> ~/.bash_profile
source ~/.bash_profile

## For ZSH users :
echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' >> ~/.zshrc
source ~/.zshrc
```

### Homebrew-Cask

Install Mac Apps by Homebrew-Cask

- Homebrew-Cask extends Homebrew and allows you to install large binary files via a command-line tool.
- Notice : I have to install ShadowsocksX-NG ( for over Great-Fire_Wall ) at first in China mainland, or fail to download some installions.
- Available Softwares : https://formulae.brew.sh/cask

#### Required Softwares

Required ( for me )

```bash
brew cask install \
    appcleaner \
    eudic \
    google-chrome \
    hyperswitch \
    intellij-idea \
    iterm2 \
    itsycal \
    karabiner-elements \
    keyboard-maestro \
    neteasemusic \
    numi \
    imageoptim \
    postman \
    qq \
    qqmusic \
    sequel-pro \
    snipaste \
    sublime-text \
    ticktick \
    visual-studio-code \
    wechat
```

Required but cannot install by `brew cask install` ( via Mac App Store )

- Available in App Store
    - Amphetamine
    - Copy 'Em
    - EasyRes
    - Trello
- Available on GitHub
    - Amphetamine Enhancer
        - Download : https://github.com/x74353/Amphetamine-Enhancer
    - TrojanX : https://github.com/JimLee1996/TrojanX
        - Download : https://github.com/JimLee1996/TrojanX/releases

<!--

_Trojan_

- _Official_ : https://trojan-gfw.github.io/trojan/
    - _GitHub_ : https://github.com/trojan-gfw/trojan
    - _GitHub Wiki_ : https://github.com/trojan-gfw/trojan/wiki/Binary-&-Package-Distributions

```bash
brew tap trojan-gfw/homebrew-trojan
brew install trojan
```

-->

#### Optional Softwares

Optional ( for me )

```bash
brew cask install \
    charles \
    clion \
    datagrip \
    docker \
    desmume \
    flash-player \
    goland \
    iina \
    kindle \
    keycastr \
    microsoft-office \
    mounty \
    notion \
    phpstorm \
    popclip \
    renamer \
    thunder \
    time-out \
    utools \
    virtualbox \
    wireshark
```

Optional and Unable to install by `brew cask install`

- Apple Configurator 2
- Kantu
- 百度网盘
- 虾米音乐
- 酷我音乐

For quick-look ( preview ) in Finder

```bash
brew cask install \
    qlcolorcode \
    qlimagesize \
    qlmarkdown \
    qlprettypatch \
    qlstephen \
    quicklook-csv \
    webpquicklook
```

### Command Line Interface

Install other commands by command `brew`

- Although some softwares has been pre-installed in macOS, their versions are often outdated.
- You should install & update them by yourself.

What to Install?

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
> - _[gawk](https://linux.die.net/man/1/gawk) ( awk )_
>     - pattern scanning and processing language
>     - for text formatting & log analysis
> - [git](https://git-scm.com/)
>     - a distributed version control system
>     - for code management
> - _[gradle](https://gradle.org/)_
>     - a build automation tool focused on flexibility and performance
>     - for building Java & Groovy projects based on config file *.gradle
> - _[groovysdk](http://www.groovy-lang.org/)_
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

#### Required Tools

```bash
brew install \
    coreutils \
    curl \
    git \
    fzf \
    jq \
    maven \
    nginx \
    nvim \
    safe-rm \
    tmux \
    vim \
    wget
```

```bash
# Tips: Fix `tmux`
# ( Ref : https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x )
brew install reattach-to-user-namespace
```

#### Optional Tools

```bash
brew install \
    autoconf \
    automake \
    cmake \
    composer \
    elasticsearch@5.6 \
    elasticsearch \
    expect \
    gawk \
    gradle \
    groovysdk \
    mysql@5.6 \
    mysql@5.7 \
    mysql \
    node \
    python \
    rabbitmq \
    redis \
    ruby \
    sqlite \
    telnet \
    watch
```

#### Update and Upgrade

```bash
brew update && brew upgrade
```

`brew update`

- Fetch the newest version of Homebrew from GitHub using git.

`brew upgrade`

- Upgrade outdated, unpinned brews ( commands installed by Homebrew ).

#### FAQ

##### Require Xcode

If encounter error below,

```bash
# 输出
xcrun: error: invalid active developer path (/Library/Developer/CommandLineTools), missing xcrun at: /Library/Developer/CommandLineTools/usr/bin/xcrun
```

Execute command below and then re-run commands above.

```bash
xcode-select install
```

##### Neovim Clipboard

> Cannot i/o system clipboard

Troubleshooting for myself

- First, link `~/.vimrc` to `~/.config/nvim/init.vim` ( run command as follow ) .

```bash
ln -s /Users/[username]/.vimrc /Users/[username]/.config/nvim/init.vim
```

Or try _( reference )_

- Global system clipboard (yank, paste) stopped working · Issue #7945 · neovim/neovim · GitHub : https://github.com/neovim/neovim/issues/7945

```bash
# vim
:checkhealth
:help clipboard
```

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

- [VS Code](https://code.visualstudio.com/) ( Recommended )
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
    - If open too many tabs, you can stash them in OneTab to save memory space & visible screen area
- [uBlock Origin](https://chrome.google.com/webstore/detail/cjpalhdlnbpafiamejdnhcphjbkeiagm) : A lightweight AD blocker
- [JSON Formatter](https://chrome.google.com/webstore/detail/bcjindcccaagfpapjjmafapmmgkkhgoa) : Make JSON easy to read
- [Proxy SwitchyOmega](https://chrome.google.com/webstore/detail/padekgcemlokbadohgkifijomclgjgif) : Manage and switch between multiple proxies quickly & easily
- ~~[cVim](https://chrome.google.com/webstore/detail/ihlenndgcmojhcghmfjfneahoeklbjjh) ( advanced ) : Add Vim-like key-bindings to Chrome for faster operations~~
    - ~~How to Use~~ : https://droidrant.com/using-cvim
    - ~~Source Code~~ : https://github.com/1995eaton/chromium-vim

Clipboard Management

- Reasons for installation
    - You often switch Apps when you are copying and pasting.
    - Clipboard management apps reduces unnecessary manipulatioin, raise efficiency & boost productivity.
- [Copy'em Paste](http://apprywhere.com/copy-em-paste.html)
    - More configurations
- [Paste 2](https://pasteapp.me/)
    - Advantages : Simple, pretty, easy to use, able to search copied content.
    - Disadvantages : It takes up too much screen space.
- …

Dictionary

- Dictionary 词典
    - macOS builtin, enough
- Alternative
    - EuDic : [欧路词典](https://www.eudic.net/v4/en/app/eudic) ( Recommended )
    - Youdao Dict : [有道词典](https://itunes.apple.com/cn/app/you-dao-ci-dian/id491854842?mt=12)

HTTP API Debug

- [Postman](https://www.getpostman.com/)
    - for HTTP API debug & test

Mind Mapping

- [MindNote](https://mindnode.com/) ( Recommended )
- [XMind](https://www.xmind.net/)
- …

Mac references :

- [Tools](/marks/tools/tools.md) : 利器 - 软件 / 物件的推荐
- [Efficiency](/mac/efficiency.md) : 效率指南
- [Shortcuts](/mac/shortcuts/shortcuts.md) : 快捷键

### Java Development

#### JDK 8

Install [Java Development Kit](https://en.wikipedia.org/wiki/Java_Development_Kit) version 8 ( [History](https://en.wikipedia.org/wiki/Java_version_history#Java_SE_8) )

- Recommended ：Install via commands as follow
- Alternative : Download [binary installation package](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html) of Mac OS X x64 from offical website

Steps

- Install JDK 8
    - Notice : require to input macOS user password
    - For latest version, execute `brew cask install java`

```bash
brew cask install adoptopenjdk8
```

Get JDK Path

- For latest version, execute `/usr/libexec/java_home`

```bash
$ /usr/libexec/java_home -v 1.8
/Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
```

Environment Variable `JAVA_HOME`

- Append the command line below to config file `~/.bashrc`
    - If ~/.bashrc doesn't exists, create it.
    - If use other shell such as `zsh`, append to `~/.zshrc`

```bash
export JAVA_HOME=`/usr/libexec/java_home -v 1.8`
```

> `~` tilde symbol
>
> - In the path `~/.bashrc`, `~` means current user's home directory
> - In macOS, it's `/Users/[USERNAME]` such as `/Users/IceHe`

#### IntelliJ IDEA

Download [latest isntallation](https://www.jetbrains.com/idea/download/#section=mac) from [offical website](https://www.jetbrains.com/idea/)

- Choose version : **Ultimate**

Get lincense

- Buy offical [license](https://www.jetbrains.com/idea/buy/#edition=commercial)
- or buy a license on Taobao
- or temp workaround - [Ref 1](http://idea.lanyus.com/) / [Ref 2](https://www.jianshu.com/p/f404994e2843)

Intsll plugins

- [**Maven Helper**](https://plugins.jetbrains.com/plugin/7179-maven-helper)
- [**Lombok Plugin**](https://plugins.jetbrains.com/plugin/6317-lombok-plugin)
- [String Manipulation](https://plugins.jetbrains.com/plugin/2162-string-manipulation)
- [GsonFormat](https://plugins.jetbrains.com/plugin/7654-gsonformat)
    - Generate POJO according to JSON.
- [google-java-format](https://plugins.jetbrains.com/plugin/8527-google-java-format) ( related below )
    - [Google Java Style Guide](https://google.github.io/styleguide/javaguide.html)
    - [GitHub - google/google-java-format](https://github.com/google/google-java-format)
        - Reformats Java source code to comply with Google Java Style.

> [Project Lombok](https://projectlombok.org/)
>
> > It is a java library that automatically plugs into your editor and build tools, spicing up your java.
> >
> > Never write another getter or equals method again. Early access to future java features such as val, and much more
>
> Optional plugins
>
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

## Configure

Include

- Development configurations on local & remote machines

### Key Repeat

References

- Search Google : macos mojave keyboard cannot repeat
    - Problem with key repeat - Apple Community : https://discussions.apple.com/thread/8068772
        - OS X – Choose Between the Character Accents Popup and Key Repeat When Holding Down a Key : https://infinitediaries.net/os-x-choose-between-the-character-accents-popup-and-key-repeat-when-holding-down-a-key/

Solution

1\. Run command below

```bash
defaults write -g ApplePressAndHoldEnabled -bool false
```

2\. Reboot & test

### System Preferences

iCloud

- Login
- Enable some services

Keyboard

- Set `Delay Until Repeat` max
- Set `Key Repeat` max
- Clear `Text`

Trackpad

- Set `Tracking speed` max
- Disable `More gestures -> Notification center`

Dock

- Set `Auto Hide`
- Remove useless apps from Dock
- 通过终端命令调整 Dock 栏的隐藏速度｜一日一技 · Mac - 少数派 : https://sspai.com/post/33366

```bash
defaults write com.apple.dock autohide-delay -int 0
killall Dock
```

Notification

- Disable useless apps on demand

Users & Groups

- Set `Login Items` (开机启动程序)
    - Or change preferences of apps

### Apps

1Password

- Re-install in App Store

TrojanX

- Get configs from your Shadowsocks service
- Re-config by scanning QR Code

Chrome

- Login Google
- Open [chrome://apps](chrome://apps/)

Sogou Input

- Login by WeChat
- Configure in `System Preferences`
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

- Set license

EuDic

- Re-download
- Login by QQ

Itsycal

- Re-config
    - ` Y.MM.dd  E  HH:mm:ss `

iTerm 2

- Set config path
- Restart app

JetBrains

- Login or set license

_Microsoft Office_

- Login

VS Code

- Execute `defaults write com.microsoft.VSCode ApplePressAndHoldEnabled -bool false`
- Restart app

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
user.name=icehe
user.email=icehe@gmail.com
```

### Git* Repo

Add SSH public SSH key for accounts ( e.g., GitHub & GitLab )

- Advantage : No longer need to enter username & password on trusted devices ( before operations )

Steps to Generate & Add SSH key

- Generate new SSH key pair ( include public & private key pairs )

```bash
ssh-keygen -t rsa -C "<email>" -b 4096

# e.g.
ssh-keygen -t rsa -C "icehe@gmail.com" -b 4096
```

- `ssh-keygen` will request user input as follow
    - Enter file in which to save the key (/Users/\<username\>/.ssh/id_rsa):
    - Enter passphrase (empty for no passphrase):
    - Enter same passphrase again:
- Press the Enter ↩ key
- If a local SSH key pair exists, command prompt will display

```bash
# outpu
/Users/<username>/.ssh/id_rsa already exists.
Overwrite (y/n)?
```

- Input **y** to re-generate
- Copy **public key** to clipboard

```bash
pbcopy < ~/.ssh/id_rsa.pub
```

- Enter **Settings** webpage and then **SSH Keys** page ( find it yourself )
- Paste **public key** to input box **Key** ( **Title** input box will be auto-filled )
- Click **Add key**

### Maven

Configurations

- Open Maven configuration file template ~~settings.xml~~ ( not exist now ) .
- Copy its content
- Open local Maven configuration file
- Overlay paste original content
    - `open` : open file with default editor
    - Notic : If you use your own private devices & Maven configuration files exists, please merge content of configurations carefully.

```bash
open ~/.m2/settting.xml
```

## TODO

- [ ] remove vscode config files from proj mac-config
- [ ] add vscode configs sync in initialize.md
    - https://code.visualstudio.com/docs/editor/settings-sync
- [ ] add intellij-idea configs sync in initialize.md
- [ ] install jdk via binary installation
    - [ ] remove jdk installation via homebrew
- [ ] Sync configs
    - Amphetamine
    - Copy'Em
    - ImageOptim
    - Snipaste
