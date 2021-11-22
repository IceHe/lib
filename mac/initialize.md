# Initialize Mac

How to initialize my Mac?

---

Reference : [macOS Setup Guide](http://sourabhbajaj.com/mac-setup)

Related on icehe.xyz : [Efficiency : 效率指南](/mac/efficiency.md)

## Guidelines

**Based on macOS**

- Applicable macOS version : Big Sur

**Follow principles**

- **KISS : Keep It Simple and Stupid** ( 简单原则 )

    Focus on the process and omit the unnecessary descriptions.

    _e.g., apps' introductions & usages_
    _/ software technology / developer knowledge …_

- **OOTB : Out Of The Box** ( 开箱即用 )

    Try to minimize the modification of the initial settings.

**For your reference** ( 仅供参考 )

- Assume that you are an experienced Mac user and a software developer.

## Install or Restore macOS

References

- Apple Support

    - [如何创建可引导的 macOS 安装器](https://support.apple.com/zh-cn/HT201372)
    - [如何重新安装 macOS](https://support.apple.com/zh-cn/HT204904)

Suggestion

-   如果全量备份然后将数据还原到设备上,
    假以时日, 会留存越来越多用不着的东西;

    随着时间推移, 不得不购置容量越来越大的硬盘,
    所以无论新老设备, 个人推荐 **直接重装 / 重新配置**.

## Network Proxy

> If cannot download the required softwares,
> have to configure the network proxy firstly

1.  Get the proxy service

    - Option A : **Buy** one ( recommended )
    - _Option B : Build your own_

    Because the valid methods often change,
    recommend to search them on the Internet.

1.  Get the configurations from the proxy service

    _Optional configuration forms :_

    - **subscription URL** ( recommended )
    - configuration file
    - server URLs
    - QR codes
    - _…_

1.  Import the configurations into the proxy plugin

    _Optional proxy plugins :_

    - [Surge](https://nssurge.com/)
    - [Clash](https://github.com/Dreamacro/clash)
        - [ClashX](https://github.com/yichengchen/clashX) - [releases](https://github.com/yichengchen/clashX/releases)
    - [Trojan](https://github.com/trojan-gfw/trojan)
        - ~~[TrojanX](https://github.com/JimLee1996/TrojanX)~~ _- latest release on 2020.11.21_
        - ~~[Trojan-Qt5](https://github.com/Trojan-Qt5/Trojan-Qt5)~~ _- removed due to regulationn_
    - [Shadowsocks](https://github.com/shadowsocks)
        - ~~[ShadowsocksX](https://github.com/RobertYim/ShadowsocksX)~~ _- archived read-only_
        - ~~[ShadowsocksX-NG](https://github.com/shadowsocks/ShadowsocksX-NG)~~ _- latest release on 2019.11.13_
    - …

1.  Visit [google.com](https://www.google.com/ncr) to validate the network

## Homebrew

[Homebrew](https://brew.sh) is a macOS package manager
for installing and managing softwares on macOS

1.  Install

    -   Plan A : [Homebrew homepage - brew.sh](https://brew.sh)

        _If cannot install or install slowly, try Plan B._

    -   Plan B : [Homebrew 国内如何自动安装 ( 国内地址 ) - 知乎](https://zhuanlan.zhihu.com/p/111014448)

    -   Plan C : [在 M1 芯片 Mac 上使用 Homebrew - 少数派](https://sspai.com/post/63935) ( 2021-01-24 )

1.  Validate

    ```bash
    $ brew --version
    # e.g.
    Homebrew 2.6.1-29-g2be340c
    Homebrew/homebrew-core (git revision 18d380e; last commit 2020-12-11)
    Homebrew/homebrew-cask (git revision 84d2f; last commit 2020-12-11)
    ```

1.  Accelarate

    Reference : [Homebrew (中国大陆) 有比较快的源 (mirror) 吗? - 知乎](https://www.zhihu.com/question/31360766/answer/749386652)

1.  Update and upgrade

    ```bash
    brew update && brew upgrade
    ```

## Homebrew-Cask

Homebrew-Cask extends Homebrew
and allows you to install large binary files via a command-line tool.

> Recommend to install Mac Apps via Homebrew-Cask

Available softwares on Homebrew-Cask : [Homebrew Formulae](https://formulae.brew.sh/cask)

### Required

Install the required softwares via Homebrew-Cask

```bash
brew install --cask \
    google-chrome \
    intellij-idea \
    iterm2 \
    itsycal \
    karabiner-elements \
    keyboard-maestro \
    neteasemusic \
    numi \
    qqmusic \
    snipaste \
    ticktick \
    visual-studio-code \
    wechat
```

_Notice : `sogouinput` above is just a installation_
_and you have to execute it individually._

### Optional

Install the optional softwares via Homebrew-Cask

```bash
brew install --cask \
    appcleaner \
    charles \
    clashx \
    docker \
    iina \
    imageoptim \
    kindle \
    linear \
    microsoft-office \
    notion \
    postman \
    sequel-pro \
    tableplus \
    thunder \
    slack \
    wireshark
```

## Mac App Store

Some softwares are unavailable on Homebrew-Cask
but available on Mac App Store.

**Required**

Install the required softwares via Mac App Store

- 1Password
- Amphetamine
- Copy 'Em
- EasyRes
- EuDic 欧路词典 _( 相对于 "增强版" 而言, 属于 "免费版"  )_

Others available on GitHub

- [Amphetamine Enhancer](https://github.com/x74353/Amphetamine-Enhancer)

Others available on the official homepages

- [Copy 'Em Helper](https://apprywhere.com/ce-helper.html)
- [Logi Options](https://www.logitech.com.cn/zh-cn/product/options)
- [Sogou Input 搜狗输入法](https://pinyin.sogou.com/mac)
- [Sublime Text 3](https://www.sublimetext.com/3)
    - _`brew install --cask sublime-text` will install the latest version 4, but I still stick on version 3 ( that I have already bought ) and don't want to subscribe version 4 …_

## CLI Programs

CLI : Command Line Interface

> Recommend to install CLI programs via Homebrew

_Although some softwares has been pre-installed in macOS,_
_their versions are often outdated._

_So recommend to install and upgrade them via Homebrew again._

### Required

Install the required softwares via Homebrew

```bash
brew install \
    coreutils \
    curl \
    git \
    fzf \
    jq \
    nginx \
    node \
    nvim \
    reattach-to-user-namespace \
    safe-rm \
    tmux \
    vim \
    wget
```

<!--

-   [coreutils](http://www.gnu.org/s/coreutils/) :
    _The basic file, shell and text manipulation utilities_
    _of the GNU operating system._

    _Include many useful commands, see TOC of [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html)._

    E.g., use [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html) to get absolute path to a file or directory.

-   [reattach-to-user-namespace](https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x) :
    For `tmux` to write and read system clipboard.

    _Reattach to the per-user bootstrap namespace_
    _in its "Background" session then exec the program with args._

-->

### Optional

Install the optional softwares via Homebrew

```bash
brew install \
    elasticsearch \
    mysql@5.7 \
    mysql \
    python \
    redis \
    ruby
```

## CLI Settings

### 1Password

1. Login the 1Password account or unlock the vaults from the cloud. _E.g. iCloud._

_For logining the git services, such as GitHub, GitLab, Coding._

### SSH Key

Add the public SSH key on Mac to the accounts of the git services.

_Advantage : No longer need to enter the username and password on the trusted devices._

Steps

1.  Generate the SSH key pair

    Reference : [Generating a new SSH key pair - GitLab](https://docs.gitlab.com/ee/ssh/README.html#generating-a-new-ssh-key-pair)

1.  Add the SSH key to the accounts of the git services

    Reference : [Adding an SSH key to your GitLab account - GitLab](https://docs.gitlab.com/ee/ssh/README.html#adding-an-ssh-key-to-your-gitlab-account)

### Dotfiles

_E.g. for me :_

```bash
cd ~
git init
git remote add origin git@github.com:IceHe/mac-conf.git
git pull origin master
git branch --set-upstream-to=origin/master master
```

### Oh My Zsh

1. Install

    Reference : [Install oh-my-zsh now - ohmyz.sh](https://ohmyz.sh/#install)

1.  Synchronize the settings

    via the configuration file `~/.zshrc` from the dotfiles above.

<!--

### Neovim

Run the command below to link `~/.vimrc` to `~/.config/nvim/init.vim` :

```bash
ln -s /Users/[USERNAME]/.vimrc /Users/[USERNAME]/.config/nvim/init.vim
# e.g.
ln -s /Users/IceHe/.vimrc /Users/IceHe/.config/nvim/init.vim

# Trouble-shooting in Vim or Nvim
:checkhealth
:help clipboard
```

_Or `nvim` maybe cannot write or read the system clipboard._

Reference :
[Global system clipboard (yank, paste) stopped working · Issue #7945 · neovim/neovim · GitHub](https://github.com/neovim/neovim/issues/7945)

-->

### Git

Synchronize the settings via the configuration files from the dotfiles above. _E.g. :_

- `~/.gitconfig`
- `~/.gitignore`
- `~/.gitignore_global`
- …

Or configure via the commands. E.g. Name and Email :

```bash
# e.g.
# common configs
git config --global user.name IceHe
git config --global user.email icehe.me@qq.com
# gpg configs ( testing )
git config --global user.signingkey [SIGNING_KEY]
git config --global commit.gpgsign true
# show configs
git config --global -l | grep user
# output
user.name=IceHe
user.email=icehe@gmail.com
```

### PlantUML

Require installed [GraphViz](https://plantuml.com/zh/graphviz-dot)

```bash
brew install libtool
brew link libtool
brew install graphviz
brew link --overwrite graphviz
```

_( This could fix issues if you have installed GraphViz as .dmg package. )_

_By default, the dot executable is expected :_

- _Firstly in : `/usr/local/bin/dot`_
- _Then in : `/usr/bin/dot`_

_You can also specify the environment variable `GRAPHVIZ_DOT` to set the exact location of your GraphViz executable._

## Java Development

### JDK

JDK - Java Development Kit

1.  Download [JDK 8 binary installation package](https://www.oracle.com/hk/java/technologies/javase/javase-jdk8-downloads.html)
    for macOs on the offical website

    _The recommended version is still **8**. ( 2021-01-01 )_

    _( Optional installation : [SDKMAN!](https://sdkman.io) )_

1.  Install

1.  Set the environment variable `JAVA_HOME`

    Append the command below to the file `~/.zshrc` :

    ```bash
    export JAVA_HOME=`/usr/libexec/java_home -v 8`
    ```

    - If `~/.zshrc` doesn't exists, create it.
    - If use `bash` instead of `zsh`, append to the file `~/.bashrc`.

    _The tilde symbol `~` equals the path of the current user's home directory._
    _E.g. `/Users/IceHe` on my Mac._

    _For getting the path of JDK 8, run the command :_

    ```bash
    $ /usr/libexec/java_home -v 8
    # e.g.
    /Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
    ```

### IntelliJ IDEA

1.  Download the [latest Isntallation](https://www.jetbrains.com/idea/download/#section=mac) on the [offical website](https://www.jetbrains.com/idea/)

    You can choose the Community verion to skip setting the license.

1.  Install

1.  Get and set the lincense

    You'd better [buy commercial license](https://www.jetbrains.com/idea/buy/#edition=commercial)
    or [offer free educational licence for students and teachers](https://sales.jetbrains.com/hc/en-gb/articles/207241195-Do-you-offer-free-educational-licenses-for-students-and-teachers-).

    _References : [Free Educational Licenses](https://www.jetbrains.com/community/education/#students) / [学生授权申请方式](https://sales.jetbrains.com/hc/zh-cn/articles/207154369-学生授权申请方式)_

1.  Synchronize the settings

    Recommend to [configure a settings repository](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository)
    for sharing the same settings accroos multiple JetBrains's accounts.

    1. `File` → `Manage IDE Settings` → `Settings Repository…`
    1. Input HTTPS URL of the settings Github repository
    1. Input the Github access token

    But you cannot synchronize the plugins in this way. So the next step is to…

1.  Install plugins

    -   [Force Shortcuts](https://plugins.jetbrains.com/plugin/8357-force-shortcuts) :
        Forces the user to use keyboard shortcuts by blocking click action
        <!-- and displaying the keyboard shortcut in a popup. -->
    -   [google-java-format](https://plugins.jetbrains.com/plugin/8527-google-java-format) :
        Reformats Java source code to comply with
        [Google Java Style](https://google.github.io/styleguide/javaguide.html)
    -   [GsonFormatPlus](https://plugins.jetbrains.com/plugin/14949-gsonformatplus) :
        Generate POJO according to JSON
    -   [IdeaVim](https://plugins.jetbrains.com/plugin/164-ideavim) :
        Vim emulator - edit text like Vim
    -   [Indent Rainbow](https://plugins.jetbrains.com/plugin/13308-indent-rainbow) :
        Colorize the indentation in front of your text
        alternating four different colors on each step
    -   [Key Promoter X](https://plugins.jetbrains.com/plugin/index?xmlId=Key%20Promoter%20X) :
        Learn essential shortcuts while you are working
    -   [Lombok Plugin](https://plugins.jetbrains.com/plugin/6317-lombok-plugin) :
        Never write another getter or equals method again
        <!-- [Project Lombok](https://projectlombok.org/) -->
        <!-- is a java library that automatically plugs into your editor -->
        <!-- and build tools, spicing up your java. -->
        <!-- _Early access to future java features such as val, and much more._ -->
    -   [Maven Helper](https://plugins.jetbrains.com/plugin/7179-maven-helper) :
        A must have plugin for working with Maven
    -   [PlantUML integration](https://plugins.jetbrains.com/plugin/7017-plantuml-integration) :
        Draw UML graphs for docs by [PlantUML](http://plantuml.com/)
    -   [Rainbow Brackets](https://plugins.jetbrains.com/plugin/10080-rainbow-brackets) :
        Code faster and smarter using code completions
        learned from millions of programs directly
    -   [String Manipulation](https://plugins.jetbrains.com/plugin/2162-string-manipulation) :
        Case switching, sorting, filtering, incrementing,
        aligning to columns, grepping, escaping, encoding…

1.  Set the font `Consolas`

    1.  Download on the Internet
    1.  Update the preference :
        `Preferences` → `Editor` → `Color Scheme` → `Color Scheme Font` → `Font`

1.  Set the color scheme `Solarized Light (Alternate)`

    1.  Download on the Internet
        -   [Solarized_Light__Alternate_.icls](https://github.com/IceHe/lib/raw/master/mac/jetbrains/Solarized_Light__Alternate_.icls) or
            [Solarized_Light__Alternate_.jar](https://github.com/IceHe/lib/raw/master/mac/jetbrains/Solarized_Light__Alternate_.jar)
    1.  Update the preference :
        `Preferences` → `Editor` → `Color Scheme` → `Scheme` → `Import` → Select

### Maven

1.  Install [Apache Maven](https://maven.apache.org/) ( `mvn` )

    ```bash
    brew install maven
    ```

1.  Copy the content of the Maven configuration file template

    _Search it on the Internet_

1.  Open and overwrite the local Maven config file `~/.m2/settting.xml`

    ```bash
    open ~/.m2/settting.xml
    ```

    _`open` : open file with default editor_

_Notice :_
_If use your own private devices & Maven configuration files exists,_
_please merge the content of configurations carefully._

## Preferences

Include the development configurations on local and remote machines

### System

#### Dock

- Disable all apps `Options` → `Keep in Dock`

#### Keyboard

`Keyboard` Tab

- Set `Delay Until Repeat` max
- Set `Key Repeat` max

`Text` Tab

- Clear all `Replace With`
- Clear the checkboxes

`Shortcuts` Tab

- Add the apps' shortcuts
    - `All Applications` → `Show Help menu` ⌥ ⇧ /
    - `Google Chrome` → `Duplicate Tab` ⇧ ⌘ D
    - `iTerm` → `Toggle Full Screen` ⇧ ⌘ F

`Input Sources` Tab

- Remove the useless input sources

#### Key Repeat

How to enable :

1. Run the command :

    ```bash
    defaults write -g ApplePressAndHoldEnabled -bool false
    ```

1. Reboot and validate

_References : Search "macos keyboard cannot repeat" on Google_

- _[Problem with key repeat - Apple Community](https://discussions.apple.com/thread/8068772)_
- _[OS X – Choose Between the Character Accents Popup and Key Repeat When Holding Down a Key](https://infinitediaries.net/os-x-choose-between-the-character-accents-popup-and-key-repeat-when-holding-down-a-key)_

#### Others

Trackpad

- Set `Tracking speed` Max

Notification

- Disable useless Apps notifications on demand

### Apps

#### Chrome

1.  Login the Google account
1.  Turn on `Sync`
    _( require the independent synchronization password )_
1.  Synchronize the extensions automatically
    _( do it manually if `Sync` does not finish in time )_
    -   [1Password](https://agilebits.com/browsers/welcome.html) : Password manager
    -   [Proxy SwitchyOmega](https://chrome.google.com/webstore/detail/padekgcemlokbadohgkifijomclgjgif) : Manage and switch between multiple proxies quickly & easily
    -   [Chrono Download](https://chrome.google.com/webstore/detail/chrono-download-manager/mciiogijehkdemklbdcbfkefimifhecn) : Download and manage the web
    -   [OneTab](https://chrome.google.com/webstore/detail/onetab/chphlpgkkbolifaimnlloiipkdnihall) : Reduce tab clutter
        If open too many tabs, stash them in OneTab to save memory space and visible screen area
    -   [uBlock Origin](https://chrome.google.com/webstore/detail/cjpalhdlnbpafiamejdnhcphjbkeiagm) : A lightweight AD blocker
    -   [Vimium](https://chrome.google.com/webstore/detail/vimium/dbepggeogbaibhgnhhndojpepiihcmeb) : Provide keyboard shortcuts for navigation and control in the spirit of Vim
    -   [JSON Formatter](https://chrome.google.com/webstore/detail/bcjindcccaagfpapjjmafapmmgkkhgoa) : Make JSON easy to read
    -   [Elasticsearch Head](https://chrome.google.com/webstore/detail/elasticsearch-head/ffmkiejjmecolpfloofpjologoblkegm) : Containing the excellent ElasticSearch Head application
1.  Synchronize the settings of the plugin `Proxy SwitchyOmega`
    via the configuration file from another device
1.  Change keyboard shortcuts from extensions :
    `Extensions` → `Keyboard shortcuts`
    - 1Password :
        - `⇧ ⌘ X` Activate the extension
    - Proxy SwitchyOmega :
        - `^ ⌘ S` Activate the extension
    - Chrono Download Manager :
        - `⇧ ⌘ J` Activate the extension
    - OneTab :
        - `⇧ ⌘ O` Activate the extension
        - `⇧ ⌘ S` Di**S**play/**S**how OneTab
        - `⇧ ⌘ C` Send the **C**urrent tab to OneTab
    - Edit required shortcuts  and remove uncessary ones

#### Sogou Input

1. Login via the WeChat acount
1. Add `Sogou Input` in `System Preferences` → `Keyboard` → `Input Sources`

#### Karabiner-Elements

1. Synchronize the settings via the configuration file
    `~/.config/karabiner/karabiner.json` from the dotfiles above

#### Keyboard Maestro

1.  Set the license
    1. `Keyboard Maestro` → `Register Keyboard Maestro…`
    1. Input Username and Password
1.  Synchronize the macros
    1.  `File` → `Start Syncing Macros…` → `Open Existing…`
    1.  Select the configuration file
        `~/.config/Keyboard\ Maestro\ Macros.kmsync`
        from the dotfiles above

#### Visual Studio Code

1.  Synchronize the settings via the built-in feature [Settings Sync](https://code.visualstudio.com/docs/editor/settings-sync)
1.  Synchronize the extensions automatically
    _( do it manually if `Settings Sync` does not finish in time )_
    -   [markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint) : Check Markdown style
    -   [Markdown Preview Enhanced](https://marketplace.visualstudio.com/items?itemName=shd101wyy.markdown-preview-enhanced)
        ( [PlatUML](http://plantuml.com) real-time rendering in Markdown code blocks )
    -   [PlantUML](https://marketplace.visualstudio.com/items?itemName=jebbs.plantuml) : Support [PlatUML](http://plantuml.com/) _( *.puml file )_
        - _Trouble Shooting : require [GraphViz](https://plantuml.com/zh/graphviz-dot) ( provices `dot` program )_
    -   [Vim](https://marketplace.visualstudio.com/items?itemName=vscodevim.vim) : Vim emulator - edit text like Vim

#### Sublime Text

1. update user settings as below :

    ```json
    {
        "ignored_packages":
        [
        ],
        "tab_size": 4,
        "translate_tabs_to_spaces": true,
        "update_check": false,
        "vintage_use_clipboard": true
    }
    ```

1. Install plugin `Pretty JSON`

1. _Set the license if you have one ( optional )_

    1. _`Help` → `Enter License`_
    1. _Input the license key_

<!-- 1. _Synchronize the settings via the plugin [Sync Settings - Package Control](https://packagecontrol.io/packages/Sync%20Settings) ( optional )_ -->

#### iTerm 2

Synchronize the settings

1. `Preferences` → `General` → `Preferences`
1. Enable `Load preference from a custom folder or URL`
1. Select the config folder
1. Enable `Save changes to folder when quits`

Copy and paste _( if cannot synchronize this setting, configure it manually )_

1. `Preferences` → `General` → `Selection`
1. Enable `Applications in terminal may access clipboard`

#### Copy 'Em

`Preferences`

- Enable `Launch at Login`
- `Sort Order`
    - Select `Most Recently Used` or Press ⌥ ⌘ R
- `Window Appearance`
    - Select `Midday`
    - Set `Minimum Font Size` **15**
    - Select `Auto-Scroll to Last Selected After List Change`
- `Window Position` → `Open at Active Screen`
- `Search Field`
    - Enable `Toggle Search Filters with ⌘ F`
    - Eanble `Search Immediately After Each Keystroke`
- `Keyboard Shortcuts…`
    - `Global Shortcuts`
        - Set `Open window` **⌥ V**
        - Set `Paste current clipboard item as plain test` **⇧ ⌘ V**
    - `Local Shortcuts`
        - Set `Switch to 'All' list` **⇧ ⌘ A**
- Enbale `Get Titles of Web URLs`
- Enable `Reject Duplicates`
- `Auto-Delete Unstarred Items` → `Auto-Delete Oldest…`
    - Store only the most recent `1000` unstarred items…

#### Snipaste

`Preferences…`

- `General`
    - Enable `Run on system startup`
- `Control` → `Global Hotkeys`
    - Set `Snip` **^ ⌘ A**
    - Clear all other hotkeys

#### Itsycal

`Preference…`

- `General`
    - Enable `Launch at login`
- `Appearance`
    - `Menu Bar`
        - Datetime pattern `MM / dd  E  HH:mm:ss`
            - or `E, dd MMM HH:mm:ss`
            - or ` Y.MM.dd  E  HH:mm:ss `
        - Enable `Hide icon`
    - `Calendar`
        - `Highlight`
            - Enable `Saturday` and `Sunday`
        - Enable `Show event dots`
            - Enable `Use colored dots`
        - Enable `Use event location`
        - Enable `Use calendar weeks`

<!--

#### Amphetamine

`Prefereces`

- `General` → `Launchand Wake Behavior`
    - Enable all checkboxes
- `Sessions` → `Non-trigger Sessions`
    - Enable all checkboxes
    - `Default Duration` → `Indefinitely`
- `Appearance` → `Menu Bar Image` → `Coffee Cup`

#### ImageOptim

`Preferences`

- `General` → Set all checkboxes
- `Quality` → Set all **50%** ( JPEG, PNG, GIF and so on )

-->

---

## JavaScript Development

CLI

```bash
brew install node
```

### WebStorm

References

- [How to make WebStorm format code according to eslint? - Stack Overflow](https://stackoverflow.com/questions/41735890/how-to-make-webstorm-format-code-according-to-eslint)

TODO

## Kotlin Android Development

CLI

```bash
brew install \
    kotlin \
    gradle
```

### AndroidStudio

TODO
