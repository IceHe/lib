# Initialize Mac

How to initialize my Mac?

---

Reference: [macOS Setup Guide](http://sourabhbajaj.com/mac-setup)

Related articles on icehe.xyz ( my website ) :

- [Tools: 利器 - 软件 / 物件的推荐](/marks/tools/tools.md)
- [Efficiency: 效率指南](/mac/efficiency.md)
- [Shortcuts: 快捷键](/mac/shortcuts/shortcuts.md)

## Guidelines

-   **Based on macOS**

    Applicable macOS versions: Big Sur / Catalina / …

-   **Follow principles**

    - **KISS - Keep It Simple & Stupid** ( 简单原则 )

        Focus on the process and omit the extra descriptions.

        _E.g., apps' introductions & usages_
        _/ software technology / developer knowledge …_

    - **OOTB - Out Of The Box** ( 开箱即用 )

        Try to minimize the modification of the initial settings.

-   **For your reference** ( 仅供参考 )

    Assume that you are an experienced Mac user and a software developer.

---

- 尽可能在粗疏简略与巨细无遗之间找一个合适的平衡

    -   过于粗略 ——
        搞不明白如何操作, 无法快速完成配置
    -   过于详细 ——
        相关软件更新后, 配置路径/名称/方式等发生变化, 导致说明的内容失效

## Install or Restore macOS

References

- Apple Support

    - [如何创建可引导的 macOS 安装器](https://support.apple.com/zh-cn/HT201372)
    - [如何重新安装 macOS](https://support.apple.com/zh-cn/HT204904)

Steps

1. Search `macOS` in Mac App Store and download its installation

1. Create bootable installer ( U盘安装, 需要创建引导分区 )

    ```bash
    # e.g. macOS Big Sur
    sudo /Applications/Install\ macOS\ Big\ Sur.app/Contents/Resources/createinstallmedia \
        --volume /Volumes/Install\ macOS\ Big\ Sur
    ```

1.  Reboot from the installer

    -   Plan A: Reboot, press `⌘ + r`.
        If it doesn't work, try Plan B or C below.
    -   Plan B: Reboot, press `⌘ + ⌥ + r`, connect Wi-Fi
        and then wait for processing until rebooting again.
    -   Plan C: Reboot, press `⌥` for a few seconds
        and then select another disk which Mac reboot from.

1.  Install or restore

    - Option A: Just install. ( Recommended )
    - Option B: Restore from backups of `Time Machine`
    - Option C: Restore from `Disk Backup` by `Disk Utility`

Suggestion ( on 2020-12-10 )

-   如果用硬盘全量备份然后将数据还原到新机器上,
    假以时日, 系统中会留存越来越多用不着的东西;
    现在觉得重新配置新机器是更好的选择.

## Network Proxy

> If cannot download the required softwares,
have to configure the network proxy firstly.

1.  Get the proxy service

    - Option A: Buy one ( recommended )
    - Option B: Build your own

    Because the valid methods often change,
    recommend to search them on the Internet.

1.  Get the configurations from the proxy service

    _Optional configuration forms, e.g.:_

    - subscription URL ( recommended )
    - configuration file
    - server URLs
    - QR codes
    - _…_

1.  Import the configurations into the proxy plugin

    _Optional proxy plugins, e.g.:_

    - Surge
    - Trojan
    - TrojanX
    - _Trojan-Qt5_
    - _Shadowsocks_
    - _ShadowsocksX_
    - _ShadowsocksX-NG_
    - _ShadowsocksR_
    - _ClashX_
    - _Lantern_
    - _…_

1.  Visit google.com to validate the network

## Xcode

If encounter the error below while running your command,

```bash
# output
xcrun: error: invalid active developer path (/Library/Developer/CommandLineTools), missing xcrun at: /Library/Developer/CommandLineTools/usr/bin/xcrun
```

run the command:

```bash
xcode-select install
```

and then re-run yours again.

_Notice :_
_It doesn't work on Apple Silicon M1 Mac with macOS Big Sur. ( 2020-12-12 )_

## Homebrew

Homebrew is a [macOS package manager](https://brew.sh)
for installing and managing softwares on macOS.

1.  Install

    ```bash
    /usr/bin/ruby -e \
    "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
    ```

    If cannot install or install slowly, run the command:

    ```bash
    /bin/zsh -c \
    "$(curl -fsSL https://gitee.com/cunkai/HomebrewCN/raw/master/Homebrew.sh)"
    ```

    Reference:
    [Homebrew 国内如何自动安装 ( 国内地址 )](https://zhuanlan.zhihu.com/p/111014448)

    <!--     - Mac 下镜像飞速安装 Homebrew 教程 : https://zhuanlan.zhihu.com/p/90508170 -->

1.  Validate

    Show the version to check whether it is installed successfully or not:

    ```bash
    $ brew --version
    Homebrew 2.6.1-29-g2be340c
    Homebrew/homebrew-core (git revision 18d380e; last commit 2020-12-11)
    Homebrew/homebrew-cask (git revision 84d2f; last commit 2020-12-11)
    ```

1.  Accelarate

    If upgrade slowly, run the commands:

    ```bash
    # Homebrew
    git -C "$(brew --repo)" remote set-url \
        origin https://mirrors.ustc.edu.cn/brew.git

    # Homebrew Core
    git -C "$(brew --repo homebrew/core)" remote set-url \
        origin https://mirrors.ustc.edu.cn/homebrew-core.git

    # Homebrew Cask
    git -C "$(brew --repo homebrew/cask)" remote set-url \
        origin https://mirrors.ustc.edu.cn/homebrew-cask.git
    ```

    ```bash
    # Homebrew-bottles

    ## For BASH users :
    echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' \
        >> ~/.bash_profile && source ~/.bash_profile

    ## For ZSH users :
    echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' \
        >> ~/.zshrc && source ~/.zshrc
    ```

    Reference:
    [Homebrew (中国大陆) 有比较快的源 (mirror) 吗?](https://www.zhihu.com/question/31360766/answer/749386652)

1.  Update and upgrade

    Run the command:

    ```bash
    brew update && brew upgrade
    ```

    Usages:

    -   `brew update`:
        Fetch the newest version of Homebrew from GitHub using git.
    -   `brew upgrade`:
        Upgrade outdated, unpinned brews ( commands installed by Homebrew ).

## Homebrew-Cask

Homebrew-Cask extends Homebrew
and allows you to install large binary files via a command-line tool.

> Recommend to install Mac Apps via Homebrew-Cask

Available softwares on Homebrew-Cask:
[Homebrew Formulae](https://formulae.brew.sh/cask)

### Required

Install the required softwares via Homebrew-Cask

```bash
brew install --cask \
    appcleaner \
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
    sogouinput \
    sublime-text \
    ticktick \
    utools \
    visual-studio-code \
    wechat
```

_Notice : Have to search `sogou` in Spotlight to execute its installation then._

### Optional

Install the optional softwares via Homebrew-Cask

```bash
brew install --cask \
    charles \
    clion \
    docker \
    goland \
    iina \
    kindle \
    microsoft-office \
    mounty \
    thunder \
    virtualbox \
    wireshark
```

<!--

    desmume \
    keycastr \
    licecap \
    notion \
    phpstorm \
    renamer \

 -->

## Mac App Store

Some softwares are unavailable on Homebrew-Cask but available on Mac App Store.

### Required

Install the required softwares via Mac App Store

- 1Password
- Amphetamine
- Copy 'Em
- EasyRes
- EuDic 欧路词典 _( 相对于 "增强版" 而言, 属于 "免费版"  )_

<!-- - Trello -->

Others available on GitHub

-   [Amphetamine Enhancer](https://github.com/x74353/Amphetamine-Enhancer)
-   [TrojanX](https://github.com/JimLee1996/TrojanX/releases)
    _( [official homepage](https://github.com/JimLee1996/TrojanX) )_
-   [Trojan](https://trojan-gfw.github.io/trojan)
    _( [GitHub](https://github.com/trojan-gfw/trojan)_
    _/ [GitHub Wiki](https://github.com/trojan-gfw/trojan/wiki/Binary-&-Package-Distributions) )_

Others available on the official homepages

- [Copy 'Em Helper](https://apprywhere.com/ce-helper.html)
- [Logi Options](https://www.logitech.com.cn/zh-cn/product/options)

<!--

```bash
brew tap trojan-gfw/homebrew-trojan
brew install trojan
```

-->

### Optional

Install the optional softwares via Mac App Store

- Apple Configurator 2

Others available on official homepages

- [百度网盘](https://pan.baidu.com/pcloud/home)

## CLI Programs

CLI: Command Line Interface

> Recommend to install CLI programs via Homebrew

Although some softwares has been pre-installed in macOS,
their versions are often outdated.

So recommend to install and upgrade them via Homebrew again.

### What to Install

-   [autoconf](https://www.gnu.org/software/autoconf/autoconf.html):
    Produce shell scripts to automatically configure software source code packages

-   [cmake](https://cmake.org/):
    An cross-platform family of tools designed to build, test and package software

-   [coreutils](http://www.gnu.org/s/coreutils/):
    The basic file, shell and text manipulation utilities of the GNU operating system.

    Include many useful commands, see TOC of
    [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html).
    E.g., use
    [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html)
    to get absolute path to a file or directory

-   [curl](https://curl.haxx.se/):
    Transfer data with URLs.
    For HTTP debug & download files

-   [expect](https://linux.die.net/man/1/expect):
    Programmed dialogue with interactive programs.
    _I can write a script using expect for remote login._

-   [gawk](https://linux.die.net/man/1/gawk) ( awk ) :
    Pattern scanning and processing language.
    For text formatting & log analysis.

-   _[gradle](https://gradle.org/):_
    _A build automation tool focused on flexibility and performance._
    _For building Java & Groovy projects based on config file \*.gradle_

-   _[groovysdk](http://www.groovy-lang.org/):_
    _A multi-faceted language for the Java platform_
    _For Java unit-testing ( [Spock](http://spockframework.org/) )_
    _or Groovy projects._

    _Install **groovysdk** but ~~groovy~~ by Homebrew_
    _( see [Stack Overflow](https://stackoverflow.com/questions/41110256/how-do-i-tell-intellij-about-groovy-installed-with-brew-on-osx/41111852) ) ._
    _Add Groovy SDK to IntelliJ IDEA_
    _( ref [link](https://www.bonusbits.com/wiki/HowTo:Add_Groovy_SDK_to_IntelliJ_IDEA) ) ._

-   [git](https://git-scm.com/):
    A distributed version control system.
    For code management.

-   [jq](https://stedolan.github.io/jq/):
    A lightweight and flexible command-line JSON processor.
    For JSON formatting:

    - Basic filters
    - Builtin operators & functions
    - Advanced features…

-   [maven](https://maven.apache.org/):
    A software project management and comprehension tool.
    For Java project management based on config files `pom.xml`.

-   _[reattach-to-user-namespace](https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x):_
    _Reattach to the per-user bootstrap namespace_
    _in its "Background" session then exec the program with args._
    _For `tmux` to write and read system clipboard._

-   [ruby](https://www.ruby-lang.org/en/):
    Ruby programming language.
    Package Manger: `gem`.

-   [vim](https://www.vim.org/):
    A text editor in CLI.
    An alternate is `nvim`: [Neovim](https://neovim.io/).
    "The God of editors is Vim. The editor of Gods is Emacs."

-   [wget](https://www.gnu.org/software/wget/):
    Download files via HTTP/HTTPS、FTP/FTPS protocols.

- …

### Required

Install the required softwares via Homebrew

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

Install the optional softwares via Homebrew

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

JDK: [Java Development Kit](https://en.wikipedia.org/wiki/Java_Development_Kit)

1.  Download
    [JDK 8 binary installation package](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html)
    for macOs on the offical website

    _The recommended version is still stable **8** on 2021-01-01._

1.  Install

1.  Set the environment variable `JAVA_HOME`

    Append the command below to the file `~/.zshrc`:

    ```bash
    export JAVA_HOME=`/usr/libexec/java_home -v 8`
    ```

    - If `~/.zshrc` doesn't exists, create it.
    - If use `bash` instead of `zsh`, append to the file `~/.bashrc`.

    _For getting the path of JDK 8, run the command:_

    ```bash
    $ /usr/libexec/java_home -v 8
    /Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
    ```

    _The tilde symbol `~` equals the path of the current user's home directory._
    _E.g. `/Users/IceHe` on my Mac._

### IntelliJ IDEA

1.  Download the
    [latest Isntallation](https://www.jetbrains.com/idea/download/#section=mac)
    on the [offical website](https://www.jetbrains.com/idea/)

1.  Install

1.  Get the lincense

    You'd better [buy commercial license](https://www.jetbrains.com/idea/buy/#edition=commercial)
    or
    [offer free educational licence for students and teachers](https://sales.jetbrains.com/hc/en-gb/articles/207241195-Do-you-offer-free-educational-licenses-for-students-and-teachers-).

    _References :_
    _[Free Educational Licenses](https://www.jetbrains.com/community/education/#students)_
    _/ [学生授权申请方式 - 中文](https://sales.jetbrains.com/hc/zh-cn/articles/207154369-学生授权申请方式)_

1.  Set the lincense

1.  Synchronize the settings

    Recommend to [configure a settings repository](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository)
    to share the same settings accroos multiple JetBrains's accounts.

    1. `File` → `Manage IDE Settings` → `Settings Repository…`
    1. Input HTTPS URL of the settings Github repository.
    1. Input the Github access token.

    Reference: [Share settings through a settings repository](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository)

1. Install plugins

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

.dotfile ( TODO )

- github.com/icehe mac-conf
- git init ~
- git remote add origin …
- git pull

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

**Name and Email**

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

#### Sublime Text

TODO : record?

https://packagecontrol.io/packages/Sync%20Settings

#### SSH Key

**For GitHub, GitLab and etc.**

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
