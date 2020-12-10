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
- icehe.xyz _( my website )_
    - [Tools](/marks/tools/tools.md) : 利器 - 软件 / 物件的推荐
    - [Efficiency](/mac/efficiency.md) : 效率指南
    - [Shortcuts](/mac/shortcuts/shortcuts.md) : 快捷键

## macOS

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

4\. \* Restore from Backups of Time Machine _( Optional )_

- or Restore from Disk Backup by Disk Utility
- or Re-install macOS
- _( Suggestion : 如果用硬盘全量备份然后将数据还原到新机器上, 假以时日, 系统中会留存越来越多用不着的东西; 现在觉得重新配置新机器是更好的选择. 2020-12-10 )_

5\. \* Disable animations to Accelerate macOS _( Optional )_

- Mac 加速：干掉那些「炫酷」的动画 - 知乎 : https://zhuanlan.zhihu.com/p/20667030
- _( TODO : 观察还有哪些命令还有效果, 还有效果的命令就记录到本文; 如果基本没啥用了, 就直接删掉这一步吧 )_

## Network Proxy

If cannot download softwares, you need to configure network proxy ( in China Mainland )

1. Connect to network
2. Open **System Preferences**
3. **Network**
4. **Advanced…**
5. **Proxies**
6. Select **Automatic Proxy Configurattion**
7. Find "**URL:**" input box under "Proxy Configuration File"
8. Fill with ~~`http://url/to/proxy.pac`~~ ( URL to PAC file )
9. Click **OK**

_Reference : PAC - Proxy Auto Config :_ https://en.wikipedia.org/wiki/Proxy_auto-config

## Xcode

If encounter error below,

```bash
# 输出
xcrun: error: invalid active developer path (/Library/Developer/CommandLineTools), missing xcrun at: /Library/Developer/CommandLineTools/usr/bin/xcrun
```

Execute command below and then re-run commands above.

```bash
xcode-select install
```

## Homebrew

Homebrew is a [macOS package manager](https://brew.sh/) for installing & managing softwares on macOS

1\. Install

```bash
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
```

- If install slowly, try :
    - Mac 下镜像飞速安装 Homebrew 教程 : https://zhuanlan.zhihu.com/p/90508170

2\. Validate

- Show version to check whether installed successfully or not.

```bash
$ brew --version
Homebrew 1.7.2
Homebrew/homebrew-core (git revision 27f23; last commit 2018-08-24)
```

3\. Accelarate

- If upgrade slowly, try :
    - Homebrew (中国大陆) 有比较快的源 (mirror) 吗? https://www.zhihu.com/question/31360766/answer/749386652

```bash
# Homebrew
git -C "$(brew --repo)" remote set-url origin https://mirrors.ustc.edu.cn/brew.git

# Homebrew Core
git -C "$(brew --repo homebrew/core)" remote set-url origin https://mirrors.ustc.edu.cn/homebrew-core.git

# Homebrew Cask
git -C "$(brew --repo homebrew/cask)" remote set-url origin https://mirrors.ustc.edu.cn/homebrew-cask.git

# Homebrew-bottles
# For BASH users :
echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' >> ~/.bash_profile
source ~/.bash_profile

# For ZSH users :
echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' >> ~/.zshrc
source ~/.zshrc
```

4\. Update & Upgrade in the future

- Execute command below

```bash
brew update && brew upgrade
```

- `brew update` : Fetch the newest version of Homebrew from GitHub using git.
- `brew upgrade` : Upgrade outdated, unpinned brews ( commands installed by Homebrew ).

## Homebrew-Cask

Install Mac Apps by Homebrew-Cask

- Homebrew-Cask extends Homebrew and allows you to install large binary files via a command-line tool.
- Notice : I have to install ShadowsocksX-NG ( for over Great-Fire_Wall ) at first in China mainland, or fail to download some installions.
- Available Softwares : https://formulae.brew.sh/cask

### Required

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
    utools \
    visual-studio-code \
    wechat
```

> Some required softwares below are unabled to be installed by Homebrew-Cask.

Available in App Store

- Amphetamine
- Copy 'Em
- EasyRes
- Trello

Available on GitHub

- Amphetamine Enhancer
    - Download : https://github.com/x74353/Amphetamine-Enhancer
- TrojanX : https://github.com/JimLee1996/TrojanX
    - Download : https://github.com/JimLee1996/TrojanX/releases
    - _or Trojan :_ https://trojan-gfw.github.io/trojan
        - _GitHub :_ https://github.com/trojan-gfw/trojan
        - _GitHub Wiki :_ https://github.com/trojan-gfw/trojan/wiki/Binary-&-Package-Distributions

<!--

```bash
brew tap trojan-gfw/homebrew-trojan
brew install trojan
```

-->

### Optional

Optional ( for me )

```bash
brew cask install \
    charles \
    clion \
    docker \
    desmume \
    goland \
    iina \
    keycastr \
    kindle \
    microsoft-office \
    mounty \
    notion \
    phpstorm \
    renamer \
    thunder \
    virtualbox \
    wireshark
```

<!--

Backup on 2020-12-10

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

-->

> Some optional softwares below are unabled to be installed by Homebrew-Cask.

- _Apple Configurator 2_
- _Kantu_
- _百度网盘_
- _虾米音乐_
- _酷我音乐_

For quick-look ( preview ) in Finder

- _( TODO : 一个个安装, 确定哪些需要安装, 哪些又可用? )_

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

<!--

开发者无法验证,

    qlimagesize \

-->

## CLI Tools

> CLI - Command Line Interface

Install CLI tools by command `brew`

- Although some softwares has been pre-installed in macOS, their versions are often outdated.
- You should install & update them by yourself.

<!--

What to Install?

> Command List & Description
>
> - [autoconf](https://www.gnu.org/software/autoconf/autoconf.html)
>     - Produce shell scripts to automatically configure software source code packages
> - [cmake](https://cmake.org/)
>     - An cross-platform family of tools designed to build, test and package software
> - [coreutils](http://www.gnu.org/s/coreutils/)
>     - The basic file, shell and text manipulation utilities of the GNU operating system
>     - Include many useful commands, see TOC of [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html). e.g., use [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html) to get absolute path to a file or directory
> - [curl](https://curl.haxx.se/)
>     - Transfer data with URLs
>     - For HTTP debug & download files
> - [expect](https://linux.die.net/man/1/expect)
>     - Programmed dialogue with interactive programs
>     - I write a script using expect for remote login
> - _[gawk](https://linux.die.net/man/1/gawk) ( awk )_
>     - Pattern scanning and processing language
>     - For text formatting & log analysis
> - [git](https://git-scm.com/)
>     - A distributed version control system
>     - For code management
> - [jq](https://stedolan.github.io/jq/)
>     - A lightweight and flexible command-line JSON processor
>     - For JSON formatting
>         - Basic filters
>         - Builtin operators & functions
>         - Advanced features…
> - [maven](https://maven.apache.org/)
>     - A software project management and comprehension tool
>     - For Java project management based on config files - pom.xml
> - [ruby](https://www.ruby-lang.org/en/)
>     - Ruby programming language
>     - Package Manger : `gem`
> - [vim](https://www.vim.org/)
>     - The God of editors - Vim / the editor of Gods - Emacs
>     - text editor in CLI
>     - optional : `nvim` aka. [Neovim](https://neovim.io/)
> - [wget](https://www.gnu.org/software/wget/)
>     - Download files via HTTP/HTTPS、FTP/FTPS protocols.

-->

<!--

Backup on 2020-12-10

> Command List & Description
>
> - [autoconf](https://www.gnu.org/software/autoconf/autoconf.html)
>     - Produce shell scripts to automatically configure software source code packages
> - [cmake](https://cmake.org/)
>     - An cross-platform family of tools designed to build, test and package software
> - [coreutils](http://www.gnu.org/s/coreutils/)
>     - The basic file, shell and text manipulation utilities of the GNU operating system
>     - Include many useful commands, see TOC of [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html). e.g., use [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html) to get absolute path to a file or directory
> - [curl](https://curl.haxx.se/)
>     - Transfer data with URLs
>     - For HTTP debug & download files
> - [expect](https://linux.die.net/man/1/expect)
>     - Programmed dialogue with interactive programs
>     - I write a script using expect for remote login
> - _[gawk](https://linux.die.net/man/1/gawk) ( awk )_
>     - Pattern scanning and processing language
>     - For text formatting & log analysis
> - [git](https://git-scm.com/)
>     - A distributed version control system
>     - For code management
> - _[gradle](https://gradle.org/)_
>     - A build automation tool focused on flexibility and performance
>     - For building Java & Groovy projects based on config file *.gradle
> - _[groovysdk](http://www.groovy-lang.org/)_
>     - A multi-faceted language for the Java platform
>     - For Java unit-testing ( [Spock](http://spockframework.org/) ) or Groovy projects
>     - Notice : Install **groovysdk** but ~~groovy~~ by Homebrew ( see [Stack Overflow](https://stackoverflow.com/questions/41110256/how-do-i-tell-intellij-about-groovy-installed-with-brew-on-osx/41111852) )
>     - More : Add Groovy SDK to IntelliJ IDEA ( ref [link](https://www.bonusbits.com/wiki/HowTo:Add_Groovy_SDK_to_IntelliJ_IDEA) )
> - [jq](https://stedolan.github.io/jq/)
>     - A lightweight and flexible command-line JSON processor
>     - For JSON formatting
>         - Basic filters
>         - Builtin operators & functions
>         - Advanced features…
> - [maven](https://maven.apache.org/)
>     - A software project management and comprehension tool
>     - For Java project management based on config files - pom.xml
> - [ruby](https://www.ruby-lang.org/en/)
>     - Ruby programming language
>     - Package Manger : `gem`
> - [vim](https://www.vim.org/)
>     - The God of editors - Vim / the editor of Gods - Emacs
>     - Text editor in CLI
>     - Optional : `nvim` aka. [Neovim](https://neovim.io/)
> - [wget](https://www.gnu.org/software/wget/)
>     - Download files via HTTP/HTTPS、FTP/FTPS protocols.

-->

### Required

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

### Optional

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

### _\*Neovim Clipboard_

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

## Java Development

### JDK

1\. Install [Java Development Kit](https://en.wikipedia.org/wiki/Java_Development_Kit) version 8

- Download the [binary installation package](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html) of macOS x64 from offical website

2\. Get JDK Path

- For latest version, execute `/usr/libexec/java_home`

```bash
$ /usr/libexec/java_home -v 1.8
/Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
```

3\. Set Environment Variable `JAVA_HOME`

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

### IntelliJ IDEA

1\. Download [Latest Isntallation](https://www.jetbrains.com/idea/download/#section=mac) from [offical website](https://www.jetbrains.com/idea/)

- Version choices :
    - **Ultimate** : Fully Functional
    - **Community** : Free

2\. Get Lincense

- You'd better [buy commercial license](https://www.jetbrains.com/idea/buy/#edition=commercial).
- Or [offer free educational licence for students and teachers](https://sales.jetbrains.com/hc/en-gb/articles/207241195-Do-you-offer-free-educational-licenses-for-students-and-teachers-).
    - Free Educational Licenses : https://www.jetbrains.com/community/education/#students
    - 学生授权申请方式 - 中文 : https://sales.jetbrains.com/hc/zh-cn/articles/207154369-学生授权申请方式

3\. Sync Settings

- `File` → `Manage IDE Settings` → `Settings Repository…`
    - Firstly, input HTTPS URL of the settings Github repository.
    - Secondly, input the Github access token.
- _Reference : Share settings through a settings repository :_ https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository

3\. Install Plugins

- [AceJump](https://plugins.jetbrains.com/plugin/7086-acejump) _( trying )_
- [CheckStyle-IDEA](https://plugins.jetbrains.com/plugin/1065-checkstyle-idea) _( trying )_
- [Codota AI Autocomplete for Java and JavaScript](https://plugins.jetbrains.com/plugin/7638-codota-ai-autocomplete-for-java-and-javascript) _( trying )_
- [Force Shortcuts](https://plugins.jetbrains.com/plugin/8357-force-shortcuts)
- [google-java-format](https://plugins.jetbrains.com/plugin/8527-google-java-format)
    - [Google Java Style Guide](https://google.github.io/styleguide/javaguide.html)
    - [GitHub - google/google-java-format](https://github.com/google/google-java-format)
        - _Reformats Java source code to comply with Google Java Style._
- [Grep Console](https://pluginjjs.jetbrains.com/plugin/7125-grep-console) _( trying )_
- [GsonFormat](https://plugins.jetbrains.com/plugin/7654-gsonformat) _( Generate POJO according to JSON )_
- [IdeaVim](https://plugins.jetbrains.com/plugin/164-ideavim)
    - _Vim emulator - edit text like Vim_
- [Indent Rainbow](https://plugins.jetbrains.com/plugin/13308-indent-rainbow) _( trying )_
- [Key Promoter X](https://plugins.jetbrains.com/plugin/index?xmlId=Key%20Promoter%20X)
- [Lombok Plugin](https://plugins.jetbrains.com/plugin/6317-lombok-plugin)
    - [Project Lombok](https://projectlombok.org/)
        - _It is a java library that automatically plugs into your editor and build tools, spicing up your java._
        - _Never write another getter or equals method again. Early access to future java features such as val, and much more._
- [Maven Helper](https://plugins.jetbrains.com/plugin/7179-maven-helper)
- [PlantUML](https://plugins.jetbrains.com/plugin/7017-plantuml-integration)
    - _Draw UML graphs for docs by [PlantUML](http://plantuml.com/)_
- [Rainbow Brackets](https://plugins.jetbrains.com/plugin/10080-rainbow-brackets) _( trying )_
- [String Manipulation](https://plugins.jetbrains.com/plugin/2162-string-manipulation)
- [TabNumberIndicator](https://plugins.jetbrains.com/plugin/9962-tabnumberindicator)

_References_

- https://blog.codota.com/21-best-intellij-plugins-for-2019-100-free
- https://www.vojtechruzicka.com/idea-best-plugins

<!--

> IDE for team
>
> - Use the same IDE for better collaboration in a team
>     - Uniform code format for all developers in a team
>     - Easy to learn IDE developing experience accumulated by other teammates
>     - Teammates are easy to use others' development environment (IDE)
>     - ……

-->

## Plugins


### Chrome

- [1Password](https://agilebits.com/browsers/welcome.html) : Password Manager
- [OneTab](https://chrome.google.com/webstore/detail/onetab/chphlpgkkbolifaimnlloiipkdnihall) : Reduce tab clutter
    - If open too many tabs, you can stash them in OneTab to save memory space & visible screen area
- [uBlock Origin](https://chrome.google.com/webstore/detail/cjpalhdlnbpafiamejdnhcphjbkeiagm) : A lightweight AD blocker
- [JSON Formatter](https://chrome.google.com/webstore/detail/bcjindcccaagfpapjjmafapmmgkkhgoa) : Make JSON easy to read
- [Proxy SwitchyOmega](https://chrome.google.com/webstore/detail/padekgcemlokbadohgkifijomclgjgif) : Manage and switch between multiple proxies quickly & easily
- [Vimium](https://chrome.google.com/webstore/detail/vimium/dbepggeogbaibhgnhhndojpepiihcmeb) : Provide keyboard shortcuts for navigation and control in the spirit of Vim.
- [Elasticsearch Head](https://chrome.google.com/webstore/detail/elasticsearch-head/ffmkiejjmecolpfloofpjologoblkegm) : Containing the excellent ElasticSearch Head application.
- _[Tampermonkey](https://chrome.google.com/webstore/detail/tampermonkey/dhdgffkkebhmkfjojejmpbldmpobfkfo) : The most popular userscript manager. It's used to run so called userscripts._

<!--

- ~~[cVim](https://chrome.google.com/webstore/detail/ihlenndgcmojhcghmfjfneahoeklbjjh) ( advanced ) : Add Vim-like key-bindings to Chrome for faster operations~~
    - ~~How to Use~~ : https://droidrant.com/using-cvim
    - ~~Source Code~~ : https://github.com/1995eaton/chromium-vim

-->

### Visual Studio Code

- [markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint) : Check Markdown style
- [Markdown Preview Enhanced](https://marketplace.visualstudio.com/items?itemName=shd101wyy.markdown-preview-enhanced)
    - [PlatUML](http://plantuml.com) real-time rendering in Markdown code blocks
- [PlantUML](https://marketplace.visualstudio.com/items?itemName=jebbs.plantuml) : Support [PlatUML](http://plantuml.com/) _( *.puml file )_
- [Vim](https://marketplace.visualstudio.com/items?itemName=vscodevim.vim) : Vim emulator - edit text like Vim

<!--

## Mac Apps

References :

- [Tools](/marks/tools/tools.md) : 利器 - 软件 / 物件的推荐
- [Efficiency](/mac/efficiency.md) : 效率指南
- [Shortcuts](/mac/shortcuts/shortcuts.md) : 快捷键

### Common

Instant Messaging

- [Mac QQ](http://im.qq.com/macqq/)

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

- [VS Code](https://code.visualstudio.com/) _( Powerful )_
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
- [Sublime Text](https://www.sublimetext.com/) _( Lightweight & Fastest )_
    - Lightweight, easy to use, free
    - Its cold boot is the fastest. ( compared to VS Code, Atom & etc. )
    - Builtin **Vintage** Mode : edit text like Vim

### Recommended

Clipboard Management

- [Copy'em Paste](http://apprywhere.com/copy-em-paste.html)
    - More configurations
- [Paste 2](https://pasteapp.me/)
    - Advantages : Simple, pretty, easy to use, able to search copied content.
    - Disadvantages : It takes up too much screen space.
- …
- Reasons for installation
    - You often switch Apps when you are copying and pasting.
    - Clipboard management apps reduces unnecessary manipulatioin, raise efficiency & boost productivity.

Dictionary

- Dictionary 词典
    - macOS builtin, enough
- [EuDic](https://www.eudic.net/v4/en/app/eudic) 欧路词典
- [Youdao Dict](https://itunes.apple.com/cn/app/you-dao-ci-dian/id491854842?mt=12) 有道词典

HTTP API Debug

- [Postman](https://www.getpostman.com/)
    - for HTTP API debug & test

Mind Mapping

- [MindNote](https://mindnode.com/) ( Recommended )
- [XMind](https://www.xmind.net/)
- …

-->

# Configure

Include

- Development configurations on local & remote machines

## Key Repeat

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

## System Preferences

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

## Apps

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

## Git

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

## Git* Repo

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

## Maven

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

# TODO

- [ ] vs code
    - [ ] remove vscode config files from proj mac-config
    - [ ] add vscode configs sync in initialize.md
        - https://code.visualstudio.com/docs/editor/settings-sync
- [ ] add intellij-idea configs sync in initialize.md
- [ ] Sync configs
    - [ ] Amphetamine : 详细写清楚配置的过程
    - [ ] Copy'Em : 详细写清楚配置的过程
    - [ ] ImageOptim : 详细记录配置的参数 ( 用默认配置其实也行? 对啊 )
    - [ ] Snipaste : 添加了配置文件
- [ ] consolas font
