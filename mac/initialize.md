# Mac Initialize

- Based on macOS
- Follow principles
    - KISS - Keep It Simple & Stupid ( 简单原则 )
    - OOTB - Out Of The Box ( 开箱即用 )
- _配置过程的说明, 尽可能在粗略与详实之间找一个合适的平衡_
    - _过于粗略 —— 无法快速完成配置, 甚至搞不明白如何配置_
    - _过于详实 —— 软件更新后, 配置路径/名称/方式变了, 说明失效_

Reference

- macOS Setup Guide : http://sourabhbajaj.com/mac-setup

Related

- icehe.xyz ( my website )
    - [Tools](/marks/tools/tools.md) : 利器 - 软件 / 物件的推荐
    - [Efficiency](/mac/efficiency.md) : 效率指南
    - [Shortcuts](/mac/shortcuts/shortcuts.md) : 快捷键

## Install macOS

References

- Apple Support
    - 如何创建可引导的 macOS 安装器 : https://support.apple.com/zh-cn/HT201372
    - 如何重新安装 macOS : https://support.apple.com/zh-cn/HT204904

1\. Search `macOS` in Mac App Store and download the macOS installation

2\. Create bootable installer for macOS ( U盘安装, 需要创建引导分区 )

```bash
# e.g. macOS Big Sur
sudo /Applications/Install\ macOS\ Big\ Sur.app/Contents/Resources/createinstallmedia \
    --volume /Volumes/Install\ macOS\ Big\ Sur
```

3\. Reboot, press `⌘ + r`

- or Reboot, press `⌘ + ⌥ + r`
    - Connect wifi and wait for processing until reboot
- or Reboot, press `⌥` for a few seconds
    - Reboot from different disk you selected

4A\. Just install macOS _( Recommended )_

- omitted…

### Restore from Backup

4B\. \* Restore from backups of Time Machine _( Optional )_

- or Restore from Disk Backup by Disk Utility

Suggestion on 2020-12-10

- 如果用硬盘全量备份然后将数据还原到新机器上, 假以时日, 系统中会留存越来越多用不着的东西; 现在觉得重新配置新机器是更好的选择.

## Network Proxy

> First thing first!

If you cannot download softwares, you may need to configure network proxy ( in China mainland ).

FYI - For Your Information ( 仅供参考, 请自行配置 )

1. Connect to network
2. Open `System Preferences` → `Network` → `Advanced…` → `Proxies`
3. Enable `Automatic Proxy Configurattion`
4. Find `URL:` input-box under `Proxy Configuration File`
5. Fill with ~~`http://url/to/proxy.pac`~~ ( URL to PAC file )
    - _You could search a latest valid PAC file URL by yourself on the Internet._
6. Click `OK`

_Reference : PAC - Proxy Auto Config :_ https://en.wikipedia.org/wiki/Proxy_auto-config

## Xcode

If encounter error below,

```bash
# output
xcrun: error: invalid active developer path (/Library/Developer/CommandLineTools), missing xcrun at: /Library/Developer/CommandLineTools/usr/bin/xcrun
```

Execute command below and then re-run your command again.

```bash
xcode-select install
```

_Notice : It doesn't work on macOS Big Sur on Mac with Apple Silicon M1. ( 2020-12-12 )_

## Homebrew

Homebrew is a [macOS package manager](https://brew.sh) for installing & managing softwares on macOS

1\. Install

```bash
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
```

- If cannot install or install slowly, try the command below :
    - **Homebrew 国内如何自动安装 ( 国内地址 )** : https://zhuanlan.zhihu.com/p/111014448

<!--     - Mac 下镜像飞速安装 Homebrew 教程 : https://zhuanlan.zhihu.com/p/90508170 -->

```bash
/bin/zsh -c "$(curl -fsSL https://gitee.com/cunkai/HomebrewCN/raw/master/Homebrew.sh)"
```

2\. Validate

- Show version to check whether it is installed successfully or not.

```bash
$ brew --version
Homebrew 2.6.1-29-g2be340c
Homebrew/homebrew-core (git revision 18d380e; last commit 2020-12-11)
Homebrew/homebrew-cask (git revision 84d2f; last commit 2020-12-11)
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
```

```bash
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

- 1Password
- Amphetamine
- Copy 'Em
- EasyRes
- Trello

Available on GitHub

- Amphetamine Enhancer : https://github.com/x74353/Amphetamine-Enhancer
- TrojanX : https://github.com/JimLee1996/TrojanX/releases
    - Its official homepage : https://github.com/JimLee1996/TrojanX
- _or Trojan :_ https://trojan-gfw.github.io/trojan
    - _GitHub :_ https://github.com/trojan-gfw/trojan
    - _GitHub Wiki :_ https://github.com/trojan-gfw/trojan/wiki/Binary-&-Package-Distributions

Available on official homepages

- Copy 'Em Helper : https://apprywhere.com/ce-helper.html
- Logi Options : https://www.logitech.com.cn/zh-cn/product/options

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
    datagrip \
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

> Some optional softwares below are unabled to be installed by Homebrew-Cask.

Available in App Store

- Apple Configurator 2

Available on official homepages

- 百度网盘 : https://pan.baidu.com/pcloud/home

## CLI Tools

> CLI - Command Line Interface

Install CLI tools by command `brew`

- Although some softwares has been pre-installed in macOS, their versions are often outdated.
- You should install & update them by yourself.

> What to Install
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
> - [gawk](https://linux.die.net/man/1/gawk) ( awk )
>     - Pattern scanning and processing language
>     - For text formatting & log analysis
> - _[gradle](https://gradle.org/)_
>     - A build automation tool focused on flexibility and performance
>     - For building Java & Groovy projects based on config file *.gradle
> - _[groovysdk](http://www.groovy-lang.org/)_
>     - A multi-faceted language for the Java platform
>     - For Java unit-testing ( [Spock](http://spockframework.org/) ) or Groovy projects
>     - Notice : Install **groovysdk** but ~~groovy~~ by Homebrew ( see [Stack Overflow](https://stackoverflow.com/questions/41110256/how-do-i-tell-intellij-about-groovy-installed-with-brew-on-osx/41111852) )
>     - More : Add Groovy SDK to IntelliJ IDEA ( ref [link](https://www.bonusbits.com/wiki/HowTo:Add_Groovy_SDK_to_IntelliJ_IDEA) )
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
> - [reattach-to-user-namespace](https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x)
>     - Reattach to the per-user bootstrap namespace in its "Background" session then exec the program with args.
>     - For `tmux` to write and read system clipboard.
> - [ruby](https://www.ruby-lang.org/en/)
>     - Ruby programming language
>     - Package Manger : `gem`
> - [vim](https://www.vim.org/)
>     - The God of editors - Vim / the editor of Gods - Emacs
>     - text editor in CLI
>     - optional : `nvim` aka. [Neovim](https://neovim.io/)
> - [wget](https://www.gnu.org/software/wget/)
>     - Download files via HTTP/HTTPS、FTP/FTPS protocols.
> - …

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
    reattach-to-user-namespace \
    safe-rm \
    tmux \
    vim \
    wget
```

### Optional

```bash
brew install \
    autoconf \
    automake \
    cmake \
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

## Java Development

### JDK

1\. Install [Java Development Kit](https://en.wikipedia.org/wiki/Java_Development_Kit) version 8

- Download the [binary installation package](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html) of macOS x64 from offical website

2\. Get JDK path

- For latest version, execute `/usr/libexec/java_home`

```bash
$ /usr/libexec/java_home -v 1.8
/Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
```

3\. Set environment variable `JAVA_HOME`

- Append the command line below to config file `~/.bashrc`
    - If `~/.bashrc` doesn't exists, create it.
    - If use other shell such as `zsh`, append to `~/.zshrc`

```bash
export JAVA_HOME=`/usr/libexec/java_home -v 1.8`
```

> `~` tilde symbol
>
> - In the path `~/.bashrc`, `~` means current user's home directory
> - In macOS, it's `/Users/[USERNAME]` such as `/Users/IceHe`

### IntelliJ IDEA

1\. Download [latest Isntallation](https://www.jetbrains.com/idea/download/#section=mac) from [offical website](https://www.jetbrains.com/idea/)

- Version choices :
    - **Ultimate** : Fully Functional
    - **Community** : Free

2\. Get and set Lincense

- Get license
    - You'd better [buy commercial license](https://www.jetbrains.com/idea/buy/#edition=commercial).
    - Or [offer free educational licence for students and teachers](https://sales.jetbrains.com/hc/en-gb/articles/207241195-Do-you-offer-free-educational-licenses-for-students-and-teachers-).
        - Free Educational Licenses : https://www.jetbrains.com/community/education/#students
        - 学生授权申请方式 - 中文 : https://sales.jetbrains.com/hc/zh-cn/articles/207154369-学生授权申请方式
- Set license _( omitted… )_

3\. Sync settings

- Share settings through a settings repository : https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository
    - `File` → `Manage IDE Settings` → `Settings Repository…`
        - 1\. Input HTTPS URL of the settings Github repository.
        - 2\. Input the Github access token.

3\. Install plugins

- [AceJump](https://plugins.jetbrains.com/plugin/7086-acejump) _( trying )_
- [CheckStyle-IDEA](https://plugins.jetbrains.com/plugin/1065-checkstyle-idea) _( trying )_
- [Codota AI Autocomplete for Java and JavaScript](https://plugins.jetbrains.com/plugin/7638-codota-ai-autocomplete-for-java-and-javascript) _( trying )_
- [Force Shortcuts](https://plugins.jetbrains.com/plugin/8357-force-shortcuts)
- [google-java-format](https://plugins.jetbrains.com/plugin/8527-google-java-format) : _Reformats Java source code to comply with Google Java Style._
    - [Google Java Style Guide](https://google.github.io/styleguide/javaguide.html)
    - [GitHub - google/google-java-format](https://github.com/google/google-java-format)
- [Grep Console](https://pluginjjs.jetbrains.com/plugin/7125-grep-console) _( trying )_
- [GsonFormat](https://plugins.jetbrains.com/plugin/7654-gsonformat) : _Generate POJO according to JSON_
- [IdeaVim](https://plugins.jetbrains.com/plugin/164-ideavim) : _Vim emulator - edit text like Vim_
- [Indent Rainbow](https://plugins.jetbrains.com/plugin/13308-indent-rainbow) _( trying )_
- [JRebel and XRebel for IntelliJ](https://plugins.jetbrains.com/plugin/4441-jrebel-and-xrebel-for-intellij) _( to try )_
- [Key Promoter X](https://plugins.jetbrains.com/plugin/index?xmlId=Key%20Promoter%20X)
- [Lombok Plugin](https://plugins.jetbrains.com/plugin/6317-lombok-plugin)
    - [Project Lombok](https://projectlombok.org/)
        - _It is a java library that automatically plugs into your editor and build tools, spicing up your java._
        - _Never write another getter or equals method again. Early access to future java features such as val, and much more._
- [Maven Helper](https://plugins.jetbrains.com/plugin/7179-maven-helper)
- [PlantUML](https://plugins.jetbrains.com/plugin/7017-plantuml-integration) : _Draw UML graphs for docs by [PlantUML](http://plantuml.com/)_
- [Rainbow Brackets](https://plugins.jetbrains.com/plugin/10080-rainbow-brackets) _( trying )_
- [String Manipulation](https://plugins.jetbrains.com/plugin/2162-string-manipulation)
- [TabNumberIndicator](https://plugins.jetbrains.com/plugin/9962-tabnumberindicator)

4\. Set Font `Consolas`

- Download Font
- Update Preference
    - `Preferences` → `Editor` → `Color Scheme` → `Color Scheme Font` → `Font`

_References_

- https://blog.codota.com/21-best-intellij-plugins-for-2019-100-free
- https://www.vojtechruzicka.com/idea-best-plugins

### Maven

1. Copy the content of the Maven configuration file template.
    - _You can find it on the Internet._
2. Open and overwrite the local Maven config file `~/.m2/settting.xml`.
    - `open` : open file with default editor

```bash
open ~/.m2/settting.xml
```

Notice :

- If use your own private devices & Maven configuration files exists, please merge the content of configurations carefully.

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

## Preferences

Include

- Development configurations on local & remote machines

### System

Key Repeat

- Enable
    - 1\. Run command `defaults write -g ApplePressAndHoldEnabled -bool false`
    - 2\. Reboot & check
- References
    - Search Google : "macos mojave keyboard cannot repeat"
        - Problem with key repeat - Apple Community : https://discussions.apple.com/thread/8068772
        - OS X – Choose Between the Character Accents Popup and Key Repeat When Holding Down a Key : https://infinitediaries.net/os-x-choose-between-the-character-accents-popup-and-key-repeat-when-holding-down-a-key/

iCloud

- Login
- Enable necessary services

Dock

- Enable `Automatically hide and show the Dock`
- Disable `Animate opening applications`
- Disable all Apps `Options` → `Keep in Dock`
- 通过终端命令调整 Dock 栏的隐藏速度｜一日一技 · Mac - 少数派 : https://sspai.com/post/33366

```bash
defaults write com.apple.dock autohide-delay -int 0
killall Dock
```

Keyboard

- `Keyboard` Tab
    - Set `Delay Until Repeat` Max
    - Set `Key Repeat` Max
- `Text` Tab
    - Clear all "Replace With"
    - Clear all checkboxes
        - Correct spelling automatically
        - Capitalize words automatically
        - Add period with double-space
        - Use smart quotes and dashes
        - ……
- `Shortcuts` Tab
    - Add App shortcuts
        - `All Applications` → `Show Help menu` ⌥⇧/
        - `Google Chrome` → `Extensions` ⇧⌘A
        - `iTerm` → `Toggle Full Screen` ^⌘F
- `Input Sources` Tab
    - Remove the useless input sources

Trackpad

- Set `Tracking speed` Max

Notification

- Disable useless Apps notifications on demand

Users & Groups

- Configure `Login Items` (开机启动程序)

Disable animations to accelerate macOS _( Optional )_

- Mac 加速：干掉那些「炫酷」的动画 - 知乎 : https://zhuanlan.zhihu.com/p/20667030
- _( TODO : 观察还有哪些命令还有效果, 还有效果的命令就记录到本文; 如果基本没啥用了, 就直接删掉这一步吧 )_

### Apps

1Password

- _Re-install in App Store_ _( maybe )_
- Unlock iCloud vaults

TrojanX

- Get the config content from the Shadowsocks service
- Import Server URLs from pasteboard

Chrome

- Login
- Turn on `Sync`
- Install extensions
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

Sogou Input

- Login via WeChat
- Add Sogou Input in `System Preferences` → `Keyboard` → `Input Sources`

Karabiner-Elements

- Simple modifications
    - Caps Lock `⇪` -> Left Ctrl `^`
    - Left Ctrl `^` -> Caps Lock `⇪`
- Sync preferences via the config file
    - ommitted…

Keyboard Maestro

- Set license
    - `Keyboard Maestro` → `Register Keyboard Maestro…`
    - Input Username and Password
- Sync macros
    - `File` → `Start Syncing Macros…` → `Open Existing…`
    - Select the config file

Visual Studio Code

- Sync settings
    - https://code.visualstudio.com/docs/editor/settings-sync
- Install extensions
    - [markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint) : Check Markdown style
    - [Markdown Preview Enhanced](https://marketplace.visualstudio.com/items?itemName=shd101wyy.markdown-preview-enhanced)
        - [PlatUML](http://plantuml.com) real-time rendering in Markdown code blocks
    - [PlantUML](https://marketplace.visualstudio.com/items?itemName=jebbs.plantuml) : Support [PlatUML](http://plantuml.com/) _( *.puml file )_
    - [Vim](https://marketplace.visualstudio.com/items?itemName=vscodevim.vim) : Vim emulator - edit text like Vim

iTerm 2

- Sync Settings
    - 1\. `Preferences` → `General` → `Preferences`
    - 2\. Enable `Load preference from a custom folder or URL`
    - 3\. Select the config folder
    - 4\. Enable `Save changes to folder when quits`

Copy 'Em

- `Preferences`
    - Enable `Launch at Login`
    - `Window Appearance`
        - Select `Midday`
        - Select `Show Text Colors`
        - Set `Maximum Font Size` 20
        - Set `Minimum Font Size` 15
    - `Window Position` → `Open at Active Screen`
    - `Search Field`
        - Enable `Toggle Search Filters with ⌘F`
        - Eanble `Search Immediately After Each Keystroke`
    - `Keyboard Shortcuts…`
        - `Global Shortcuts`
            - Set `Copy and start new item` ⇧⌘S
            - Set `Open window` ⌥V
            - Set `Paste current clipboard item as plain test` ⇧⌘V
        - `Local Shortcuts`
            - Set `Switch to 'All' list` ⌘A
    - Enbale `Get Titles of Web URLs`
    - Enable `Reject Duplicates`

Snipaste

- `Preferences…`
    - `General` → `Configuration Storage Path`
        - Select the config file
    - `Control` → `Global Hotkeys`
        - Set `Snip` to ^ + ⌘ + A
        - Clear all other hotkeys

Itsycal

- Preference…
    - General
        - Enable `Launch at login`
    - Appearance
        - Menu Bar
            - Datetime pattern ` Y.MM.dd  E  HH:mm:ss `
            - Enable `Hide icon`
        - Calendar
            - Highlight
                - Enable `Saturday` and `Sunday`
            - Enable `Show event dots`
                - Enable `Use colored dots`
            - Enable `Use event location`
            - Enable `Use calendar weeks`

Amphetamine

- `Prefereces`
    - `General` → `Launchand Wake Behavior`
        - Enable all checkboxes
    - `Sessions` → `Non-trigger Sessions`
        - Enable all checkboxes
        - `Default Duration` → `Indefinitely`
    - `Appearance` → `Menu Bar Image` → `Coffee Cup`

EuDic ( 欧路词典 )

- Login via QQ

ImageOptim

- `Preferences`
    - `General` → Set all checkboxes
    - `Quality` → Set all 50% ( JPEG, PNG, GIF and so on )

Microsoft Office

- Login

### CLI

#### Oh-My-Zsh

TODO

https://ohmyz.sh

#### Neovim

- Link `~/.vimrc` to `~/.config/nvim/init.vim` ( run command as follow )
    - Or `nvim` maybe cannot write or read the system clipboard.
    - Global system clipboard (yank, paste) stopped working · Issue #7945 · neovim/neovim · GitHub : https://github.com/neovim/neovim/issues/7945

```bash
ln -s /Users/[USERNAME]/.vimrc /Users/[USERNAME]/.config/nvim/init.vim
# e.g.
ln -s /Users/IceHe/.vimrc /Users/IceHe/.config/nvim/init.vim

# Trouble
# In vim or nvim
:checkhealth
:help clipboard
```

#### Git

> Name and Email

1\. Set username & email

- `[EMAIL]` e.g. icehe@gmail.com
- `[USERNAME]` e.g. IceHe

```bash
git config --global user.name [USERNAME]
git config --global user.email [EMAIL]

# e.g.
git config --global user.name icehe
git config --global user.email icehe@gmail.com
```

2\. Validate

```bash
$ git config --global -l | grep user
user.name=icehe
user.email=icehe@gmail.com
```

#### SSH Key

> For GitHub, GitLab and etc.

1\. Add SSH public SSH key for accounts

- Advantage : No longer need to enter username & password on trusted devices ( before operations )

2\. Generate SSH key

- Generate new SSH key pair

```bash
ssh-keygen -t rsa -C "[EMAIL]" -b 4096

# e.g.
ssh-keygen -t rsa -C "icehe.me@qq.com" -b 4096
```

- `ssh-keygen` will request user input as follow
    - Enter file in which to save the key (/Users/[USERNAME]/.ssh/id_rsa):
    - Enter passphrase (empty for no passphrase):
    - Enter same passphrase again:
- You can just Press the Enter ↩ Key
- If a local SSH key pair exists, command prompt will display

```bash
# outpu
/Users/[USERNAME]/.ssh/id_rsa already exists.
Overwrite (y/n)?
```

- Input `y` to re-generate

3\. Add SSH key on GitLab

- Copy **public key** to clipboard

```bash
pbcopy < ~/.ssh/id_rsa.pub
```

- Enter `Settings` webpage and then `SSH Keys` page ( find it yourself )
- Paste **public key** to input box `Key` ( `Title` input box will be auto-filled )
- Click `Add key`
