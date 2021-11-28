# macOS Setup Guide : 设置指南

How to setup my Mac step by step?

---

Documentation Version : BETA ( tesing )

Reference : [macOS Setup Guide - Sourabh Bajaj](http://sourabhbajaj.com/mac-setup)

Related : [macOS Efficiency Guide : 效率指南](/mac/efficiency-guide.md)

---

**Based on macOS**

- The author used this guide recently on macOS version : **Monterey** - 12.0.1

## Guidelines

Follow the principles :

-   **KISS : Keep It Simple and Stupid / Short** ( 简单原则 )

    Assume that you are an experienced Mac user and a software developer,
    so I can focus on the procedure and skip the unnecessary descriptions,  _e.g. Apps' introductions & usages and development knowledge_

-   **OOTB : Out Of The Box** ( 开箱即用 )

    Try not to change the default settings.

-   **FYI only : For Your Information only** ( 仅供参考 )

## Install or Restore macOS

> **SKIP** this step when you set up a new Mac.

References : Apple Support

- [如何创建可引导的 macOS 安装器](https://support.apple.com/zh-cn/HT201372)
- [如何重新安装 macOS](https://support.apple.com/zh-cn/HT204904)

NOTE : 避免直接将备份数据还原到新系统中！

因为每次将过去的备份数据直接还原到新系统中都难免会产生并留下冗余、无用甚至错误的数据；
随着时间推移，不但需要越来越大的存储空间来保存它们，而且会持续积累错误，产生疑难问题。
所以，为了适时淘汰这些持续累积的问题数据，建议每次迁移设备的数据都尽量避免直接迁移。

## Network & AppleID

First of all :

1.  **Turn on Mac**

1.  **Connect to Internet** via Wi-Fi or Erthernet

1.  **Sign in AppleID** to synchronize the settings & iCloud data

    - or Sign up if you don't have AppleID

1.  Open this guide on Mac ( optional )

    Visit [icehe.xyz/#/mac/setup-guide](https://icehe.xyz/#/mac/setup-guide) so that you can continue the following steps

## Password Manager

The password manager makes it easier and safer for you to login other accounts

> **SKIP** this step when you don't need it

e.g. [1Password](https://1password.com/)

1.  **Install** via Mac App Store

1.  **Login** the account on [my.1password.com](https://my.1password.com) ( recommended )

    - or Load the vaults on iCloud

Others : [List of password managers](https://en.wikipedia.org/wiki/List_of_password_managers)

## Network Proxy

> RECOMMEND to configure the network proxy for stable and faster Internet connections in China mainland.

1.  **Get the proxy service**

    How to :

    - A. **BUY** / RENT ( recommended )
    - B. Build it yourself

    NOTE :
    Because the valid methods for stable Internet connection may change often,
    RECOMMEND to search them on the Internet when you need.

1.  **Get the proxy configurations** from the proxy service

    List of configuration methods :

    - **A. Subscription URL** ( recommended )
    - B. Configuration file
    - C. Server URLs
    - D. QR codes
    - …

1.  **Install the proxy plugin**

    List of proxy plugins :

    - A. [Clash](https://github.com/Dreamacro/clash)
    - B. [ClashX](https://github.com/yichengchen/clashX) - [releases](https://github.com/yichengchen/clashX/releases)
    - **C. [ClashX Pro](https://github.com/Semporia/ClashX-Pro) - [releases](https://install.appcenter.ms/users/clashx/apps/clashx-pro/distribution_groups/public)** ( recommended )
    - D. [Surge](https://nssurge.com/)
    - E. [Trojan](https://github.com/trojan-gfw/trojan)
    - F. ~~[TrojanX](https://github.com/JimLee1996/TrojanX)~~ _- latest release on 2020.11.21_
    - G. ~~[Trojan-Qt5](https://github.com/Trojan-Qt5/Trojan-Qt5)~~ _- removed due to regulationn_
    - H. [Shadowsocks](https://github.com/shadowsocks)
    - I. ~~[ShadowsocksX](https://github.com/RobertYim/ShadowsocksX)~~ _- archived read-only_
    - J. ~~[ShadowsocksX-NG](https://github.com/shadowsocks/ShadowsocksX-NG)~~ _- latest release on 2019.11.13_
    - …

1.  **Import the proxy configurations** into the proxy plugin

    e.g. configure ClashX Pro via the subscription URL :

    1.  Menubar → `ClashX Pro` → `Config` → `Remote config` → `Manage` → `Add` subscription URL
    1.  Menubar → `ClashX Pro` → `Config` → Select new configuration ( may not need )
    1.  Menubar → `ClashX Pro` → `Set as system proxy`

1.  **Check Internet connection**

    Visit [google.com/ncr](https://google.com/ncr) on the browser
    <!-- ( **GUI** - Graphical User Interface ) -->

1.  **Configure network proxy on CLI** - Command Line Interface

    e.g. ClashX Pro

    1.  Menubar → `ClashX Pro` → `Set as system proxy`
    1.  Menubar → `ClashX Pro` → `Copy shell command` :
        ```bash
        export https_proxy=http://127.0.0.1:7890 http_proxy=http://127.0.0.1:7890 all_proxy=socks5://127.0.0.1:7890
        ```
    1.  Open `Terminal` → Paste shell command → Execute
    1.  Execute `curl google.com` to check Internet connection
        ```bash
        # Success
        <HTML><HEAD><meta http-equiv="content-type" content="text/html;charset=utf-8">
        <TITLE>301 Moved</TITLE></HEAD><BODY>
        <H1>301 Moved</H1>
        The document has moved
        <A HREF="http://www.google.com/">here</A>.
        </BODY></HTML>

        # Failure
        curl: (56) Recv failure: Connection reset by peer
        ```

## Homebrew

[Homebrew](https://brew.sh) is a macOS package manager
for installing and managing softwares

1.  **Install**

    How to :

    - A. [Homebrew - brew.sh](https://brew.sh) ( official )
    - B. [国内如何自动安装 - 知乎](https://zhuanlan.zhihu.com/p/111014448) ( recommended )
    - C. [在 M1 芯片 Mac 上使用 Homebrew - 少数派](https://sspai.com/post/63935) ( compatible )

1.  **Check**

    ```bash
    $ brew --version
    # e.g.
    Homebrew 3.3.5
    Homebrew/homebrew-core (git revision 8be0d8cc6d4; last commit 2021-11-24)
    Homebrew/homebrew-cask (git revision 2f292faf97; last commit 2021-11-24)
    ```

1.  **Speed up**

    Reference : [Homebrew (中国大陆) 有比较快的源 (mirror) 吗? - 知乎](https://www.zhihu.com/question/31360766/answer/749386652)

1.  Update and Upgrade ( in the future )

    ```bash
    brew update && brew upgrade
    ```

NOTE : You can search available softwares you need on [Homebrew Formulae](https://formulae.brew.sh).

## Homebrew Cask

Homebrew-Cask extends Homebrew and allows you to install the large binary files via a command-line tool.

RECOMMEND to install Apps via Homebrew-Cask

### Required

Install the required Apps via Homebrew-Cask

```bash
brew install --cask \
    google-chrome \
    iterm2 \
    itsycal \
    karabiner-elements \
    keyboard-maestro \
    numi \
    snipaste \
    ticktick \
    visual-studio-code \
    wechat
```

NOTICE : The installations may REQUIRE you to input PASSWORD,
e.g. `karabiner-elements`, `microsoft-office`, `parallels`, `wireshark` and etc.

### Optional

Install the optional Apps via Homebrew-Cask

```bash
brew install --cask \
    appcleaner \
    bartender \
    charles \
    docker \
    iina \
    imageoptim \
    jetbrains-toolbox \
    kindle \
    linear \
    microsoft-office \
    monitorcontrol \
    neteasemusic \
    notion \
    parallels \
    postman \
    qqmusic \
    sequel-pro \
    slack \
    tableplus \
    thunder \
    wireshark
```

TODO: Do it IN PARALLEL?

## Mac App Store

The Apps unavailable on Homebrew-Cask may be available on Mac App Store.

**Required**

Install the required softwares via Mac App Store

- 1Password ( Done )
- Copy 'Em
- EasyRes
- EuDic 欧路词典 _( 相对于 "增强版" 而言, 属于 "免费版"  )_

Others available on their official websites

- [Copy 'Em Helper](https://apprywhere.com/ce-helper.html)
- [Logi Options](https://www.logitech.com.cn/zh-cn/product/options) - TODO : Wait for the Logi Option+ public release
- [Sogou Input 搜狗输入法](https://pinyin.sogou.com/mac)
- [Sublime Text 3](https://www.sublimetext.com/3)

NOTE : `brew install --cask sublime-text` will install the latest version, but I still stick on version 3 ( that I have already bought and it meets my requirements ) and don't want to pay for the new version.

**Optional**

- none

## CLI Programs

CLI - Command Line Interface

RECOMMEND to install CLI programs via Homebrew

### Required

Install the required CLI programs via Homebrew

```bash
brew install \
    coreutils \
    curl \
    git \
    fzf \
    gpg \
    jq \
    nvim \
    reattach-to-user-namespace \
    safe-rm \
    tmux \
    vim \
    wget
```

-   [coreutils](http://www.gnu.org/s/coreutils/) :
    The basic file, shell and text manipulation utilities of the GNU operating system

    Include many useful commands, see TOC of
    [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html).

    e.g., use [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html)
    to get absolute path to a file or directory.

-   [reattach-to-user-namespace](https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x) :
    For `tmux` to write and read system clipboard

    Reattach to the per-user bootstrap namespace in its "Background" session then exec the program with args.

NOTE : The pre-installed softwares may be outdated.

RECOMMEND to install and upgrade them via Homebrew again.

### Optional

Install the optional softwares via Homebrew

```bash
brew install \
    elasticsearch \
    mysql@5.7 \
    mysql \
    nginx \
    node \
    postgresql \
    python \
    redis \
    ruby
```

TODO : Install `node ` via `nvm`

## GitHub Settings

### GPG Key

Use GPG to sign tags and commits locally.

- These tags or commits are marked as verified on GitHub so other people can be confident that the changes come from a trusted source.

How to :

1.  Generate the GPG key pair

    Reference : [Generating a new GPG key - GitHub](https://docs.github.com/en/authentication/managing-commit-signature-verification/generating-a-new-gpg-key)

1.  Get the GPG pulic key

    Reference : [cmd/g/gpg - icehe.xyz](/cmd/g/gpg.md)

1.  Add the GPG key to the GitHub/GitLab/etc. accounts

    Reference : [Adding a new GPG key to your GitHub account - GitHub](https://docs.github.com/en/authentication/managing-commit-signature-verification/adding-a-new-gpg-key-to-your-github-account)

### SSH Key

Using the SSH protocol, you can connect and authenticate to remote servers and services.

- With SSH keys, you can connect to GitHub without supplying your username and personal access token at each visit.

How to :

1.  Generate the SSH key pair

    Reference : [Generating a new SSH key and adding it to the ssh-agent - GitHub](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent)

1.  Get the SSH public key and Add it to the GitHub/GitLab/etc. accounts

    Reference : [Adding a new SSH key to your GitHub account - GitHub](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account)

## CLI Settings

### Dotfiles

e.g. for me :

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

Synchronize the settings via the configuration files from the dotfiles above.
e.g. :

- `~/.gitconfig`
- `~/.gitignore`
- `~/.gitignore_global`
- …

Or configure git via commands.
e.g. for me :

1. Add the common configurations

    ```bash
    git config --global user.name IceHe.xyz
    git config --global user.email icehe.me@qq.com
    ```

2. Add the GPG configurations

    ```bash
    git config --global user.signingkey [SIGNING_KEY]
    git config --global commit.gpgsign true
    ```

3. Check the configurations

    ```bash
    $ git config --global -l | grep user
    # e.g.
    user.name=IceHe.xyz
    user.email=icehe@qq.com
    user.signingkey=[SIGNING_KEY]
    commit.gpgsign=true
    gpg.program=gpg
    …
    ```

### PlantUML

Require [GraphViz](https://plantuml.com/zh/graphviz-dot)

```bash
brew install libtool
brew link libtool
brew install graphviz
brew link --overwrite graphviz
```

NOTE : This could fix issues if you have installed GraphViz as `.dmg` package.

By default, the dot executable is expected :

- Firstly in : `/usr/local/bin/dot`
- Then in : `/usr/bin/dot`

You can also specify the environment variable `GRAPHVIZ_DOT` to set the exact location of the GraphViz executable.

## Java Development

### JDK

JDK - Java Development Kit

1.  Download [JDK 8 binary installation package](https://www.oracle.com/hk/java/technologies/javase/javase-jdk8-downloads.html)
    for macOS on the offical website

    RECOMMEND to install the version **8** ( until 2021-01-01 ) .

    _Optional installation : [SDKMAN!](https://sdkman.io)_

1.  Install

1.  Set the environment variable `JAVA_HOME`

    Append the command below to the file `~/.zshrc` :

    ```bash
    export JAVA_HOME=`/usr/libexec/java_home -v 8`
    ```

    - If `~/.zshrc` doesn't exists, create it.
    - If use `bash` instead of `zsh`, append to the file `~/.bashrc`.

NOTE : The tilde symbol `~` equals the path of the current user's home directory.
e.g. for me `/Users/IceHe`.

e.g. get the path of JDK 8 :

```bash
$ /usr/libexec/java_home -v 1.8
# e.g.
/Library/Java/JavaVirtualMachines/zulu-8.jdk/Contents/Home
```

### IntelliJ IDEA

1.  Download the [latest Isntallation](https://www.jetbrains.com/idea/download/#section=mac) on the [offical website](https://www.jetbrains.com/idea/)

    You can choose the Community verion to skip setting the license.

1.  Install

1.  Get and set the lincense

    You'd better [buy commercial license](https://www.jetbrains.com/idea/buy/#edition=commercial)
    or [offer free educational licence for students and teachers](https://sales.jetbrains.com/hc/en-gb/articles/207241195-Do-you-offer-free-educational-licenses-for-students-and-teachers-).

    Reference : [Free Educational Licenses](https://www.jetbrains.com/community/education/#students) / [学生授权申请方式](https://sales.jetbrains.com/hc/zh-cn/articles/207154369-学生授权申请方式)

1.  Synchronize the settings

    RECOMMEND to [configure a settings repository](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository)
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
        Colorize the indentation in front of the text
        alternating four different colors on each step
    -   [Key Promoter X](https://plugins.jetbrains.com/plugin/index?xmlId=Key%20Promoter%20X) :
        Learn essential shortcuts while you are working
    -   [Lombok Plugin](https://plugins.jetbrains.com/plugin/6317-lombok-plugin) :
        Never write another getter or equals method again
        <!-- [Project Lombok](https://projectlombok.org/) -->
        <!-- is a java library that automatically plugs into the editor -->
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

    Search it on the Internet

1.  Open and overwrite the local Maven config file `~/.m2/settting.xml`

    ```bash
    open ~/.m2/settting.xml
    ```

    NOTE : `open` file with default editor

NOTICE : If use your own private devices & Maven configuration files exists, please merge the content of configurations carefully.

## Preferences

Include the development configurations on local and remote machines

### System

#### Bottom Dock

- Disable all apps `Options` → `Keep in Dock`

#### Dock & Menu Bar

- Enable `Automatically hide and show the Dock`
- Disable `Show recent applications in Dock`

#### Keyboard

`Keyboard` Tab

- Set `Delay Until Repeat` max
- Set `Key Repeat` max
- Enable `Use F1, F2, etc. keys as standard function keys`

`Text` Tab

- Clear all `Replace With`
- Clear the checkboxes

`Shortcuts` Tab

- Add/Update `App Shortcuts`
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

1. Reboot and Check

    References : Search "macos keyboard cannot repeat" on Google

    - _[Problem with key repeat - Apple Community](https://discussions.apple.com/thread/8068772)_
    - _[OS X – Choose Between the Character Accents Popup and Key Repeat When Holding Down a Key](https://infinitediaries.net/os-x-choose-between-the-character-accents-popup-and-key-repeat-when-holding-down-a-key)_

#### Others

Trackpad

- Set `Tracking speed` Max

Notification

- Disable the useless Apps notifications on demand

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

TODO: The last step may be unnecessary, because the settings can be synchorized via the Google account.

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

1. Set the license ( optional )

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
    - Set `Minimum Font Size` 15
    - Select `Auto-Scroll to Last Selected After List Change`
- `Window Position` → `Open at Active Screen`
- `Search Field`
    - Enable `Toggle Search Filters with ⌘ F`
    - Eanble `Search Immediately After Each Keystroke`
- `Keyboard Shortcuts…`
    - `Global Shortcuts`
        - Set `Open window` ⌥ V
        - Set `Paste current clipboard item as plain test` ⇧ ⌘ V
    - `Local Shortcuts`
        - Set `Switch to 'All' list` ⇧ ⌘ A
- Enbale `Get Titles of Web URLs`
- Enable `Reject Duplicates`
- `Auto-Delete Unstarred Items` → `Auto-Delete Oldest…`
    - Store only the most recent `1000` unstarred items…

#### Snipaste

`Preferences…`

- `General`
    - Enable `Run on system startup`
- `Control` → `Global Hotkeys`
    - Set `Snip` ^ ⌘ A
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
- `Quality` → Set all 50% ( JPEG, PNG, GIF and so on )

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
