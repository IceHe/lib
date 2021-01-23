# Initialize Mac

How to initialize my Mac?

---

Reference: [macOS Setup Guide](http://sourabhbajaj.com/mac-setup)

<!--  -->

The related article on icehe.xyz ( my website ): [Efficiency: 效率指南](/mac/efficiency.md)

## Guidelines

**Based on macOS**

- Applicable macOS versions: Big Sur / Catalina / …

**Follow principles**

- **KISS: Keep It Simple and Stupid** ( 简单原则 )

    Focus on the process and omit the unnecessary descriptions

    _E.g., apps' introductions & usages_
    _/ software technology / developer knowledge …_

- **OOTB: Out Of The Box** ( 开箱即用 )

    Try to minimize the modification of the initial settings

**For your reference** ( 仅供参考 )

- Assume that you are an experienced Mac user and a software developer

---

尽可能在粗疏简略与巨细无遗之间寻找一个合适的平衡

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

1. Create the bootable installer ( U盘安装, 需要创建引导分区 )

    ```bash
    # e.g. macOS Big Sur
    sudo /Applications/Install\ macOS\ Big\ Sur.app/Contents/Resources/createinstallmedia \
        --volume /Volumes/Install\ macOS\ Big\ Sur
    ```

1.  Reboot from the installer

    -   Plan A: Reboot, press `⌘ + r`
        If it doesn't work, try Plan B or C below
    -   Plan B: Reboot, press `⌘ + ⌥ + r`, connect Wi-Fi
        and then wait for processing until rebooting again
    -   Plan C: Reboot, press `⌥` for a few seconds
        and then select another disk which Mac reboot from

1.  Install or restore

    - Option A: Just install. ( Recommended )
    - Option B: Restore from backups of `Time Machine`
    - Option C: Restore from `Disk Backup` by `Disk Utility`

Suggestion ( on 2020-12-10 )

-   如果用硬盘全量备份然后将数据还原到新的设备上,
    假以时日, 系统中会留存越来越多用不着的东西;
    现在觉得完全重新配置新的设备是更好的选择

## Network Proxy

> If cannot download the required softwares,
> have to configure the network proxy firstly

1.  Get the proxy service

    - Option A: Buy one ( recommended )
    - Option B: Build your own

    Because the valid methods often change,
    recommend to search them on the Internet

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

and then re-run yours again

_Notice:_
_It doesn't work on Apple Silicon M1 Mac with macOS Big Sur. ( 2020-12-12 )_

## Homebrew

Homebrew is a [macOS package manager](https://brew.sh)
for installing and managing softwares on macOS

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

    _For M1 Mac:_
    _[在 M1 芯片 Mac 上使用 Homebrew](https://sspai.com/post/63935)_

    <!--     - Mac 下镜像飞速安装 Homebrew 教程: https://zhuanlan.zhihu.com/p/90508170 -->

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

    #  The 3 commands above don't work on M1 Mac.
    ```

    ```bash
    # Homebrew-bottles

    ## For ZSH users:
    echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' \
        >> ~/.zshrc && source ~/.zshrc

    ## For BASH users:
    echo 'export HOMEBREW_BOTTLE_DOMAIN=https://mirrors.ustc.edu.cn/homebrew-bottles' \
        >> ~/.bash_profile && source ~/.bash_profile
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
        Fetch the newest version of Homebrew from GitHub using git
    -   `brew upgrade`:
        Upgrade outdated, unpinned brews ( the commands installed by Homebrew )

## Homebrew-Cask

Homebrew-Cask extends Homebrew
and allows you to install large binary files via a command-line tool

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

_Notice: Have to search `sogou` in Spotlight to execute its installation then._

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

Some softwares are unavailable on Homebrew-Cask but available on Mac App Store

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
their versions are often outdated

So recommend to install and upgrade them via Homebrew again

### What to Install

-   [autoconf](https://www.gnu.org/software/autoconf/autoconf.html):
    Produce shell scripts to automatically configure software source code packages

-   [cmake](https://cmake.org/):
    An cross-platform family of tools designed to build, test and package software

-   [coreutils](http://www.gnu.org/s/coreutils/):
    The basic file, shell and text manipulation utilities of the GNU operating system

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
    _I can write a script using expect for remote login_

-   [gawk](https://linux.die.net/man/1/gawk) ( awk ):
    Pattern scanning and processing language.
    For text formatting & log analysis

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
    For code management

-   [jq](https://stedolan.github.io/jq/):
    A lightweight and flexible command-line JSON processor.
    For JSON formatting:

    - Basic filters
    - Builtin operators & functions
    - Advanced features…

-   [maven](https://maven.apache.org/):
    A software project management and comprehension tool.
    For Java project management based on config files `pom.xml`

-   _[reattach-to-user-namespace](https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x):_
    _Reattach to the per-user bootstrap namespace_
    _in its "Background" session then exec the program with args._
    _For `tmux` to write and read system clipboard._

-   [ruby](https://www.ruby-lang.org/en/):
    Ruby programming language.
    Package Manger: `gem`

-   [vim](https://www.vim.org/):
    A text editor in CLI.
    An alternate is `nvim`: [Neovim](https://neovim.io/).
    "The God of editors is Vim. The editor of Gods is Emacs."

-   [wget](https://www.gnu.org/software/wget/):
    Download files via HTTP/HTTPS、FTP/FTPS protocols

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

    The recommended version is still **8** on 2021-01-01

1.  Install

1.  Set the environment variable `JAVA_HOME`

    Append the command below to the file `~/.zshrc`:

    ```bash
    export JAVA_HOME=`/usr/libexec/java_home -v 8`
    ```

    - If `~/.zshrc` doesn't exists, create it
    - If use `bash` instead of `zsh`, append to the file `~/.bashrc`

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
    [offer free educational licence for students and teachers](https://sales.jetbrains.com/hc/en-gb/articles/207241195-Do-you-offer-free-educational-licenses-for-students-and-teachers-)

    _References:_
    _[Free Educational Licenses](https://www.jetbrains.com/community/education/#students)_
    _/ [学生授权申请方式](https://sales.jetbrains.com/hc/zh-cn/articles/207154369-学生授权申请方式)_

1.  Set the lincense

1.  Synchronize the settings

    Recommend to [configure a settings repository](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository)
    for sharing the same settings accroos multiple JetBrains's accounts

    _But it allows to synchronize any configurable components_
    _except for the list of enabled and disabled plugins._

    1. `File` → `Manage IDE Settings` → `Settings Repository…`
    1. Input HTTPS URL of the settings Github repository
    1. Input the Github access token

    _Reference ( including other alternatives ) :_
    _[Share settings through a settings repository](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository)_

1.  Install plugins

    -   [Force Shortcuts](https://plugins.jetbrains.com/plugin/8357-force-shortcuts):
        Forces the user to use keyboard shortcuts by blocking click action
        <!-- and displaying the keyboard shortcut in a popup. -->
    -   [google-java-format](https://plugins.jetbrains.com/plugin/8527-google-java-format):
        Reformats Java source code to comply with
        [Google Java Style](https://google.github.io/styleguide/javaguide.html)
    -   [GsonFormatPlus](https://plugins.jetbrains.com/plugin/14949-gsonformatplus):
        Generate POJO according to JSON
    -   [IdeaVim](https://plugins.jetbrains.com/plugin/164-ideavim):
        Vim emulator - edit text like Vim
    -   [Indent Rainbow](https://plugins.jetbrains.com/plugin/13308-indent-rainbow):
        Colorize the indentation in front of your text
        alternating four different colors on each step
    -   [Key Promoter X](https://plugins.jetbrains.com/plugin/index?xmlId=Key%20Promoter%20X):
        Learn essential shortcuts while you are working
    -   [Lombok Plugin](https://plugins.jetbrains.com/plugin/6317-lombok-plugin):
        Never write another getter or equals method again
        <!-- [Project Lombok](https://projectlombok.org/) -->
        <!-- is a java library that automatically plugs into your editor -->
        <!-- and build tools, spicing up your java. -->
        <!-- _Early access to future java features such as val, and much more._ -->
    -   [Maven Helper](https://plugins.jetbrains.com/plugin/7179-maven-helper):
        A must have plugin for working with Maven
    -   [PlantUML integration](https://plugins.jetbrains.com/plugin/7017-plantuml-integration):
        Draw UML graphs for docs by [PlantUML](http://plantuml.com/)
    -   [Rainbow Brackets](https://plugins.jetbrains.com/plugin/10080-rainbow-brackets):
        Code faster and smarter using code completions
        learned from millions of programs directly
    -   [String Manipulation](https://plugins.jetbrains.com/plugin/2162-string-manipulation):
        Case switching, sorting, filtering, incrementing,
        aligning to columns, grepping, escaping, encoding…
    -   [TabNumberIndicator](https://plugins.jetbrains.com/plugin/9962-tabnumberindicator):
        Display the tab number indicator
        before the opened file name int editor tabs
    -   _[AceJump](https://plugins.jetbrains.com/plugin/7086-acejump):_
        _( trying )_
        _Quickly navigate the caret to any position visible in the editor_
    -   _[CheckStyle-IDEA](https://plugins.jetbrains.com/plugin/1065-checkstyle-idea):_
        _( trying )_
        _Scan of Java files with CheckStyle from within IDEA_
    -   _[Codota AI Autocomplete for Java and JavaScript](https://plugins.jetbrains.com/plugin/7638-codota-ai-autocomplete-for-java-and-javascript)_
        _( trying )_
    -   _[Grep Console](https://plugins.jetbrains.com/plugin/7125-grep-console):_
        _( trying )_
        _Grep, tail, filter, highlight... everything you need for a console_
        _( not supporting terminals )_
    -   _[JRebel and XRebel for IntelliJ](https://plugins.jetbrains.com/plugin/4441-jrebel-and-xrebel-for-intellij):_
        _( to try )_
        _Allow developers to reload code changes instantly_

    References:

    - [21 Best IntelliJ Plugins for 2019 (100% Free)](https://blog.codota.com/21-best-intellij-plugins-for-2019-100-free)
    - [IntelliJ IDEA best plugins](https://www.vojtechruzicka.com/idea-best-plugins)

1.  Set the font `Consolas`

    1.  Download on the Internet
    1.  Update the preference:
        `Preferences` → `Editor` → `Color Scheme` → `Color Scheme Font` → `Font`

### Maven

1.  Copy the content of the Maven configuration file template

    _Search it on the Internet_

1.  Open and overwrite the local Maven config file `~/.m2/settting.xml`

    ```bash
    open ~/.m2/settting.xml
    ```

    _`open`: open file with default editor_

_Notice:_
_If use your own private devices & Maven configuration files exists,_
_please merge the content of configurations carefully._

## Preferences

Include the development configurations on local and remote machines

### System

#### Dock

- Enable `Automatically hide and show the Dock`
- Disable `Animate opening applications`
- Disable all apps `Options` → `Keep in Dock`

#### Keyboard

`Keyboard` Tab

- Set `Delay Until Repeat` max
- Set `Key Repeat` max

`Text` Tab

- Clear all `Replace With`
- Clear the checkboxes:
    - `Correct spelling automatically`
    - `Capitalize words automatically`
    - `Add period with double-space`
    - `Use smart quotes and dashes`
    - …

`Shortcuts` Tab

- Add the apps' shortcuts
    - `All Applications` → `Show Help menu` ⌥⇧/
    - `Google Chrome` → `Extensions` ⇧⌘A
    - `iTerm` → `Toggle Full Screen` ^⌘F

`Input Sources` Tab

- Remove the useless input sources

<!--

#### Key Repeat

How to enable:

1. Run the command:

    ```bash
    defaults write -g ApplePressAndHoldEnabled -bool false
    ```

1. Reboot and validate

References: Search "macos mojave keyboard cannot repeat" on Google

- [Problem with key repeat - Apple Community](https://discussions.apple.com/thread/8068772)
- [OS X – Choose Between the Character Accents Popup and Key Repeat When Holding Down a Key](https://infinitediaries.net/os-x-choose-between-the-character-accents-popup-and-key-repeat-when-holding-down-a-key)

-->

#### Others

iCloud

1. Login
1. Enable necessary services

Trackpad

- Set `Tracking speed` Max

Notification

- Disable useless Apps notifications on demand

Users & Groups

- Configure `Login Items` ( 开机启动程序 )

### Apps

#### 1Password

1.  Re-install in Mac App Store
1.  Login the 1Password account
    or unlock the vaults from the cloud drive.
    _E.g. iCloud_

#### Chrome

1.  Login the Google account
1.  Turn on `Sync` _( require the independent synchronization password )_
1.  Install the extensions:
    -   [1Password](https://agilebits.com/browsers/welcome.html): Password Manager
    -   [OneTab](https://chrome.google.com/webstore/detail/onetab/chphlpgkkbolifaimnlloiipkdnihall): Reduce tab clutter
        If open too many tabs, stash them in OneTab to save memory space and visible screen area
    -   [uBlock Origin](https://chrome.google.com/webstore/detail/cjpalhdlnbpafiamejdnhcphjbkeiagm): A lightweight AD blocker
    -   [JSON Formatter](https://chrome.google.com/webstore/detail/bcjindcccaagfpapjjmafapmmgkkhgoa): Make JSON easy to read
    -   [Proxy SwitchyOmega](https://chrome.google.com/webstore/detail/padekgcemlokbadohgkifijomclgjgif): Manage and switch between multiple proxies quickly & easily
    -   [Vimium](https://chrome.google.com/webstore/detail/vimium/dbepggeogbaibhgnhhndojpepiihcmeb): Provide keyboard shortcuts for navigation and control in the spirit of Vim
    -   [Elasticsearch Head](https://chrome.google.com/webstore/detail/elasticsearch-head/ffmkiejjmecolpfloofpjologoblkegm): Containing the excellent ElasticSearch Head application
    -   _[Tampermonkey](https://chrome.google.com/webstore/detail/tampermonkey/dhdgffkkebhmkfjojejmpbldmpobfkfo): The most popular userscript manager. It's used to run so called userscripts._

#### dotfiles

E.g. for me below

```bash
cd ~
git init

# Recommend to pull via HTTPS at the first time
git remote add origin https://github.com/IceHe/mac-conf.git
git pull origin master

# Pull via SSH after the first time
# ( Require local Git SSH key, so configure it later )
git remote set-url origin git@github.com:IceHe/lib.git
git pull
```

#### Sogou Input

1. Login via the WeChat acount
1. Add `Sogou Input` in `System Preferences` → `Keyboard` → `Input Sources`

#### Karabiner-Elements

- Synchronize the settings via the configuration file
    `~/.config/karabiner/karabiner.json` in dotfiles above

#### Keyboard Maestro

1.  Set the license
    1. `Keyboard Maestro` → `Register Keyboard Maestro…`
    1. Input Username and Password
1.  Synchronize the macros
    1.  `File` → `Start Syncing Macros…` → `Open Existing…`
    1.  Select the configuration file
        `~/.config/Keyboard\ Maestro\ Macros.kmsync` in dotfiles

#### Visual Studio Code

1.  Synchronize the settings via the built-in feature
    [Settings Sync](https://code.visualstudio.com/docs/editor/settings-sync)

    1.  Select the entry `Turn On Settings Sync…`

        _in the `Manage` gear menu at the bottom of the `Activity Bar`_

    1.  Sign in with GitHub

        _The browser will open so that you can sign in to your GitHub account_

        _After signing in, `Settings Sync` will be turned on_
        _and continue to synchronize the preferences automatically_
        _in the background_

    1.  Select all settings to synchronize

    1.  Replace local settings

        _If already synchronized from a machine_
        _and turning on sync from another machine,_
        _the dialog `Merge or Replace` will show 3 choices:_

        -   _`Merge`:_
            _Merge local settings with remote settings from the cloud_
        -   _`Replace Local`:_
            _Overwrite local settings with remote settings from the cloud_
        -   _`Merge Manually…`:_
            _Open `Merges` view where you can merge settings one by one._

        Select `Replace Local`

1.  Install the extensions

    -   [markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint): Check Markdown style
    -   [Markdown Preview Enhanced](https://marketplace.visualstudio.com/items?itemName=shd101wyy.markdown-preview-enhanced)
        ( [PlatUML](http://plantuml.com) real-time rendering in Markdown code blocks )
    -   [PlantUML](https://marketplace.visualstudio.com/items?itemName=jebbs.plantuml): Support [PlatUML](http://plantuml.com/) _( *.puml file )_
    -   [Vim](https://marketplace.visualstudio.com/items?itemName=vscodevim.vim): Vim emulator - edit text like Vim

#### Sublime Text

Synchronize the settings via the plugin
[Sync Settings - Package Control](https://packagecontrol.io/packages/Sync%20Settings)

1.  Run `Package Control: Install Package` command, and looks for
    [Sync Settings](https://packagecontrol.io/packages/Sync%20Settings)
1.  Run `Sync Settings: Edit User Settings`
1.  **if** Do you already have a gist?
    1.  Copy `gist id` and put it in the configuration file
        ( `https://gist.github.com/<username>/<gist id>` )
        ( `gist_id` property )
    1.  Run `Sync Settings: Download` command to retrieve your backup
1. **else**
    1.  Create an access token in
        [GitHub](https://github.com/settings/tokens/new) with gist scope checked
    1.  Put the token in the the configuration file ( `access_token` property )
    1.  Run `Sync Settings: Create and Upload` command

    Configuration file format:

    ```json
    {
        "access_token": "xxxxxxxxxxxxxxxxxxxxxxxxx",
        "gist_id": "xxxxxxxxxxxxxxxxxxxxxxxxx"
    }
    ```

#### iTerm 2

Synchronize the settings

1. `Preferences` → `General` → `Preferences`
1. Enable `Load preference from a custom folder or URL`
1. Select the config folder
1. Enable `Save changes to folder when quits`

#### Copy 'Em

`Preferences`

- Enable `Launch at Login`
- `Window Appearance`
    - Select `Midday`
    - Select `Show Text Colors`
    - Set `Maximum Font Size` **20**
    - Set `Minimum Font Size` **15**
- `Window Position` → `Open at Active Screen`
- `Search Field`
    - Enable `Toggle Search Filters with ⌘F`
    - Eanble `Search Immediately After Each Keystroke`
- `Keyboard Shortcuts…`
    - `Global Shortcuts`
        - Set `Copy and start new item` **⇧⌘S**
        - Set `Open window` **⌥V**
        - Set `Paste current clipboard item as plain test` **⇧⌘V**
    - `Local Shortcuts`
        - Set `Switch to 'All' list` **⌘A**
- Enbale `Get Titles of Web URLs`
- Enable `Reject Duplicates`

#### Snipaste

`Preferences…`

- `Control` → `Global Hotkeys`
    - Set `Snip` **^⌘A**
    - Clear all other hotkeys

#### Itsycal

`Preference…`

- `General`
    - Enable `Launch at login`
- `Appearance`
    - `Menu Bar`
        - Datetime pattern ` Y.MM.dd  E  HH:mm:ss `
        - Enable `Hide icon`
    - `Calendar`
        - `Highlight`
            - Enable `Saturday` and `Sunday`
        - Enable `Show event dots`
            - Enable `Use colored dots`
        - Enable `Use event location`
        - Enable `Use calendar weeks`

#### Amphetamine

`Prefereces`

- `General` → `Launchand Wake Behavior`
    - Enable all checkboxes
- `Sessions` → `Non-trigger Sessions`
    - Enable all checkboxes
    - `Default Duration` → `Indefinitely`
- `Appearance` → `Menu Bar Image` → `Coffee Cup`

#### EuDic 欧路词典

Login via the QQ account

#### ImageOptim

`Preferences`

- `General` → Set all checkboxes
- `Quality` → Set all **50%** ( JPEG, PNG, GIF and so on )

### CLI

#### Oh-My-Zsh

1. Install

    ```bash
    # via curl
    sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

    # via wget
    sh -c "$(wget https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh -O -)"
    ```

    Reference:
    [Install oh-my-zsh now - ohmyz.sh](https://ohmyz.sh/#install)

1.  Synchronize the settings via the configuration file
    `~/.zshrc` in dotfiles above

#### Neovim

Run the command below to link `~/.vimrc` to `~/.config/nvim/init.vim`:

```bash
ln -s /Users/[USERNAME]/.vimrc /Users/[USERNAME]/.config/nvim/init.vim
# e.g.
ln -s /Users/IceHe/.vimrc /Users/IceHe/.config/nvim/init.vim

# Trouble-shooting in Vim or Nvim
:checkhealth
:help clipboard
```

_Or `nvim` maybe cannot write or read the system clipboard._

Reference:
[Global system clipboard (yank, paste) stopped working · Issue #7945 · neovim/neovim · GitHub](https://github.com/neovim/neovim/issues/7945)

#### Git

Synchronize the settings via the configuration files from dotfiles. _E.g.:_

- `~/.gitconfig`
- `~/.gitignore`
- `~/.gitignore_global`
- …

Configure via the commands. E.g. Name and Email:

1. Set

    ```bash
    git config --global user.name [USERNAME]
    git config --global user.email [EMAIL]

    # e.g.
    git config --global user.name icehe
    git config --global user.email icehe.me@qq.com
    ```

1. Validate

    ```bash
    $ git config --global -l | grep user
    user.name=icehe
    user.email=icehe@gmail.com
    ```

#### SSH Key

Add the SSH public SSH key on Mac to the accounts of the git services.
_E.g.: GitHub, GitLab_

-   Advantage:
    No longer need to enter the username and password on the trusted devices
-    Reference:
    [GitLab and SSH keys](https://docs.gitlab.com/ee/ssh/README.html)

Steps

1.  Generate the SSH key pair

    1. Generate

        ```bash
        ssh-keygen -t rsa -C "[EMAIL]" -b 4096

        # e.g.
        ssh-keygen -t rsa -C "icehe.me@qq.com" -b 4096
        ```

    1.  `ssh-keygen` will request the user input as follow

        1. `Enter file in which to save the key (/Users/[USERNAME]/.ssh/id_rsa):`
        1. `Enter passphrase (empty for no passphrase):`
        1. `Enter same passphrase again:`

    1.  You can just press the Enter `↩` key to skip them above

        If a local SSH key pair exists, the command prompt will notify as below

        ```bash
        # output
        /Users/[USERNAME]/.ssh/id_rsa already exists.
        Overwrite (y/n)?
        ```

        You can input `y` to re-generate

    Reference:
    [Generating a new SSH key pair - GitLab](https://docs.gitlab.com/ee/ssh/README.html#generating-a-new-ssh-key-pair)

1.  Add the SSH key to the accounts of the git services

    _E.g. GitLab_

    1.  Copy the **public key** to the clipboard

        ```bash
        pbcopy < ~/.ssh/id_rsa.pub
        ```

    1.  Visit the `Settings → SSH Keys` webpage
        _( Find it yourself. )_

    1.  Paste the **public key** into the `Key` input box
        _( The `Title` input box will be auto-filled. )_

    1.  Click `Add key`

    1.  Validate

    Reference:
    [Adding an SSH key to your GitLab account - GitLab](https://docs.gitlab.com/ee/ssh/README.html#adding-an-ssh-key-to-your-gitlab-account)
