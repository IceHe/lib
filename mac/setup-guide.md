# macOS Setup Guide : 设置指南

How to setup my Mac step by step?

---

Reference : [macOS Setup Guide - Sourabh Bajaj](http://sourabhbajaj.com/mac-setup)

Related : [macOS Efficiency Guide : 效率指南](/mac/efficiency-guide.md)

---

**Based on macOS**

- The guide has been recently used on 2021-11-30
    - Mac version : Macbook Pro 2021 with M1 Pro
    - macOS version : **Monterey - 12.0.1** on

## Guidelines

Follow the principles :

-   **KISS - Keep It Simple and Stupid / Short** - 简单原则

    Assume that you are an experienced Mac user and a software developer,
    so I can focus on the procedure and skip the unnecessary descriptions

    _e.g. the softwares' introductions & usages and development knowledge_

-   **OOTB - Out Of The Box** - 开箱即用

    Try not to change the default settings

-   **FYI only - For Your Information only** - 仅供参考

## Install or Restore macOS

> **SKIP** this step when you set up a new Mac or have already re-installed macOS

References : Apple Support

1. [在 Mac 上抹掉所有内容和设置](https://support.apple.com/zh-cn/HT212749) - optional
1. [如何创建可引导的 macOS 安装器](https://support.apple.com/zh-cn/HT201372)
1. [如何重新安装 macOS](https://support.apple.com/zh-cn/HT204904)

NOTE : 避免直接将备份数据还原到新系统中！

因为每次将过去 Mac 的备份数据直接还原到新系统中都难免会产生并留下冗余、无用甚至错误的数据；
随着时间推移，不但需要越来越大的存储空间来保存它们，而且会持续积累错误甚至产生疑难问题。
所以，为了适时淘汰这些持续累积的可能存在问题的数据，建议每次迁移 Mac 时都尽量避免直接迁移数据。

## Network and Passwords

### Network & AppleID

First of all :

1.  **Turn on Mac**

1.  **Connect to Internet** via Wi-Fi or Erthernet

1.  **Sign in AppleID** to synchronize the settings & iCloud data

    - or Sign up if you don't have AppleID

1.  **Open this guide** on Mac - optional

    Visit [icehe.xyz/#/mac/setup-guide](https://icehe.xyz/#/mac/setup-guide) so that you can continue the following steps

### Password Manager

The password manager makes it easier and safer for you to login other accounts

e.g. [1Password](https://1password.com/)

1.  **Install** via Mac App Store

1.  **Login** the account on [my.1password.com](https://my.1password.com) - recommended

    - or **Load** the vaults on iCloud

_Related : [List of password managers](https://en.wikipedia.org/wiki/List_of_password_managers)_

### Network Proxy

RECOMMEND to configure the network proxy for stable and faster Internet connections in China mainland

1.  **Get the proxy service**

    How to :

    - A. **BUY** / RENT - recommended
    - B. Build it yourself

    NOTE :
    Because the valid methods for stable Internet connection may change often,
    RECOMMEND to search them on the Internet when you need

1.  **Get the proxy configurations** from the proxy service

    List of configuration methods :

    - **A. Subscription URL** - recommended
    - B. Configuration file
    - C. Server URLs
    - D. QR codes
    - …

1.  **Install the proxy plugin**

    List of proxy plugins :

    - A. [Clash](https://github.com/Dreamacro/clash)
    - B. [ClashX](https://github.com/yichengchen/clashX) - [releases](https://github.com/yichengchen/clashX/releases)
    - **C. [ClashX Pro](https://github.com/Semporia/ClashX-Pro) - [releases](https://install.appcenter.ms/users/clashx/apps/clashx-pro/distribution_groups/public)** - recommended
    - D. [Surge](https://nssurge.com/)
    - E. [Trojan](https://github.com/trojan-gfw/trojan)
    - F. ~~[TrojanX](https://github.com/JimLee1996/TrojanX)~~
    - G. ~~[Trojan-Qt5](https://github.com/Trojan-Qt5/Trojan-Qt5)~~
    - H. [Shadowsocks](https://github.com/shadowsocks)
    - I. ~~[ShadowsocksX](https://github.com/RobertYim/ShadowsocksX)~~
    - J. ~~[ShadowsocksX-NG](https://github.com/shadowsocks/ShadowsocksX-NG)~~
    - …

1.  **Import the proxy configurations** into the proxy plugin

    e.g. configure ClashX Pro via the subscription URL :

    1.  Menubar → `ClashX Pro` → `Config` → `Remote config` → `Manage` → `Add` subscription URL
    1.  Menubar → `ClashX Pro` → `Config` → Select the new config you added - usually uncessary
    1.  Menubar → `ClashX Pro` → `Set as system proxy`
    1.  Menubar → `ClashX Pro` → `Dashboard` → `Setting` → Enable `Start at login` - recommended

1.  **Check Internet connection**

    Visit [google.com/ncr](https://google.com/ncr) on the browser

1.  **Configure network proxy on CLI** - Command Line Interface

    e.g. ClashX Pro

    1.  Menubar → `ClashX Pro` → `Copy shell command` :
        ```bash
        export https_proxy=http://127.0.0.1:7890 http_proxy=http://127.0.0.1:7890 all_proxy=socks5://127.0.0.1:7890
        ```
    1.  Open `Terminal` → Paste shell command → Execute
    1.  Execute `curl google.com` to check Internet connection,
        e.g.
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

## Homebrew & Homebrew-Cask

[Homebrew](https://brew.sh) is a macOS package manager
for installing and managing softwares

[Homebrew-Cask](https://formulae.brew.sh/cask/) extends Homebrew and allows you to install the large binary files via a command-line tool

NOTE : You can search available softwares you need on [Homebrew Formulae](https://formulae.brew.sh)

- CLI softwares : [Formula](https://formulae.brew.sh/formula/) - a listing of all packages available from the **core** tap
- GUI softwares : [Cask](https://formulae.brew.sh/cask) - a listing of all casks available from the **cask** tap

1.  **Install**

    How to :

    - A. [Homebrew - brew.sh](https://brew.sh) - official
    - B. [国内如何自动安装 - 知乎](https://zhuanlan.zhihu.com/p/111014448) - recommended
    - C. [在 M1 芯片 Mac 上使用 Homebrew - 少数派](https://sspai.com/post/63935) - compatible

1.  **Check**

    ```bash
    $ brew -v
    # or
    $ brew --version
    # e.g.
    Homebrew 3.3.5
    Homebrew/homebrew-core (git revision 8be0d8cc6d4; last commit 2021-11-24)
    Homebrew/homebrew-cask (git revision 2f292faf97; last commit 2021-11-24)
    ```

1.  **Speed up**

    Reference : [Homebrew (中国大陆) 有比较快的源 (mirror) 吗? - 知乎](https://www.zhihu.com/question/31360766/answer/749386652)

1.  **Update and Upgrade** - in the future

    ```bash
    brew update && brew upgrade
    ```

## Install CLI Softwares

CLI - Command Line Interface

RECOMMEND to install CLI programs via Homebrew

### Required

Install the required CLI softwares via Homebrew

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

brew install libtool \
    && brew link libtool \
    && brew install graphviz \
    && brew link --overwrite graphviz
```

NOTE : The pre-installed softwares may be outdated,
so RECOMMEND to install and upgrade them via Homebrew again

---

NOTE : Why I need them ?

-   [coreutils](http://www.gnu.org/s/coreutils/) :
    The basic file, shell and text manipulation utilities of the GNU operating system

    Include many useful commands, see TOC of
    [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html).

    e.g. use [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html)
    to get absolute path to a file or directory.

-   `tmux` requires [reattach-to-user-namespace](https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x)
    to write and read the system clipboard

    Reattach to the per-user bootstrap namespace in its "Background" session then execute the program with arguments.

-   PlantUML require [GraphViz](https://plantuml.com/zh/graphviz-dot)
    to write UML diagrams

    ```bash
    brew install libtool
    brew link libtool
    brew install graphviz
    brew link --overwrite graphviz
    ```

    NOTE : This could fix issues if you have installed GraphViz as `.dmg` package

    You can specify the environment variable `GRAPHVIZ_DOT` to set the exact location of the GraphViz executable.
    By default, the dot executable is expected :

    - Firstly in : `/usr/local/bin/dot`
    - Then in : `/usr/bin/dot`

### Optional

Install the optional CLI softwares via Homebrew

#### Node.js

1.  **Install [Node Version Manager](https://github.com/nvm-sh/nvm)** - `nvm`

    ```bash
    $ brew install nvm

    # e.g. output
    ==> Downloading https://mirrors.ustc.edu.cn/homebrew-bottles/nvm-0.39.0.all.bottle.tar.gz
    Already downloaded: /Users/icehe/Library/Caches/Homebrew/downloads/4dc7eceb4921b8909c081af037518450c6e85151603a6f51695bf17bab3081f5--nvm-0.39.0.all.bottle.tar.gz
    ==> Reinstalling nvm
    ==> Pouring nvm-0.39.0.all.bottle.tar.gz
    ==> Caveats
    Please note that upstream has asked us to make explicit managing
    nvm via Homebrew is unsupported by them and you should check any
    problems against the standard nvm install method prior to reporting.

    You should create NVM's working directory if it doesn't exist:

    mkdir ~/.nvm

    Add the following to ~/.zshrc or your desired shell
    configuration file:

    export NVM_DIR="$HOME/.nvm"
    [ -s "/opt/homebrew/opt/nvm/nvm.sh" ] && . "/opt/homebrew/opt/nvm/nvm.sh"  # This loads nvm
    [ -s "/opt/homebrew/opt/nvm/etc/bash_completion.d/nvm" ] && . "/opt/homebrew/opt/nvm/etc/bash_completion.d/nvm"  # This loads nvm bash_completion

    You can set $NVM_DIR to any location, but leaving it unchanged from
    /opt/homebrew/opt/nvm will destroy any nvm-installed Node installations
    upon upgrade/reinstall.

    Type `nvm help` for further information.
    ```

    Reference : [Installing and Updating - nvm](https://github.com/nvm-sh/nvm#installing-and-updating)

1.  **Preapre** the environment

    e.g. follow the PROMPT from the `brew install nvm` output above

    1.  Create NVM's working directory if it doesn't exist :

        ```bash
        mkdir ~/.nvm
        ```

    1.  Just execute the following commands for now - recommended

        _or Add the following commands to `~/.zshrc` or your desired shell configuration file :_

        ```bash
        export NVM_DIR="$HOME/.nvm"
        # Loads nvm
        [ -s "/opt/homebrew/opt/nvm/nvm.sh" ] && . "/opt/homebrew/opt/nvm/nvm.sh"
        # Loads nvm bash_completion
        [ -s "/opt/homebrew/opt/nvm/etc/bash_completion.d/nvm" ] && . "/opt/homebrew/opt/nvm/etc/bash_completion.d/nvm"
        ```

1.  **Install [Node.js](https://nodejs.org/en/)** - `node`, e.g.

    ```bash
    nvm install node
    node -v
    nvm install 16
    ```

    RECOMMEND to install the Node.js of version **16** ( on 2021-11-30 )

    Reference : [Usage - nvm](https://github.com/nvm-sh/nvm#usage)

1.  **Check** the versions, e.g.

    ```bash
    $ nvm -v
    0.39.0
    $ node -v
    v16.13.0
    ```

#### JDK

JDK - Java Development Kit

1.  **Install JDK** via [SDKMAN!](https://sdkman.io)

    _or Download the installation from the official website : [Java Downloads - Oracle](https://www.oracle.com/java/technologies/downloads/)_

    RECOMMEND to install the JDK of version **8** ( on 2021-01-01 )

    1.  Install SDKMAN!

        Reference : [Installation - SDKMAN!](https://sdkman.io/install)

    2.  Install JDK via SDKMAN!

        Reference : [JDKs - SDKMAN!](https://sdkman.io/jdks)

1.  **Set the environment variable `JAVA_HOME`**

    Append the command below to the file `~/.zshrc` :

    ```bash
    export JAVA_HOME=`/usr/libexec/java_home -v 8`
    ```

    - If `~/.zshrc` doesn't exists, create it
    - If use `bash` instead of `zsh`, append to the file `~/.bashrc`

    NOTE : The tilde symbol `~` equals the path of the current user's home directory
    e.g. for me `/Users/icehe`

    e.g. get the path of JDK 8 :

    ```bash
    $ /usr/libexec/java_home -v 1.8
    # e.g.
    /Library/Java/JavaVirtualMachines/zulu-8.jdk/Contents/Home
    ```

#### Others

```bash
brew install \
    elasticsearch \
    mysql@5.7 \
    mysql \
    nginx \
    php \
    postgresql \
    python \
    redis \
    ruby
```

## Install GUI Softwares

GUI - Graphical User Interface

RECOMMEND to install the GUI softwares via Homebrew-Cask

### Required

#### Homebrew-Cask

Install the required GUI softwares via Homebrew-Cask

```bash
brew install --cask \
    google-chrome \
    karabiner-elements \
    keyboard-maestro
```

NOTICE : The installations may REQUIRE you to input PASSWORD,
e.g. `karabiner-elements`

#### Mac App Store

Install the required GUI softwares via Mac App Store

Note : The GUI softwares unavailable on Homebrew-Cask may be available on Mac App Store

- 1Password - _done above_
- Copy 'Em
- EasyRes
- EuDic 欧路词典 - _相对于 "增强版" 而言, 属于 "免费版"_

#### Websites

Note : Some GUI softwares are only available on the websites

- [Copy 'Em Helper](https://apprywhere.com/ce-helper.html)
- [Logi Options](https://www.logitech.com.cn/zh-cn/product/options) - _TODO : Wait for Logi Option+ public release_
- [Sogou Input 搜狗输入法](https://pinyin.sogou.com/mac)
- [Sublime Text 3](https://www.sublimetext.com/3)

NOTE : `brew install --cask sublime-text` will install the latest version, but I still stick on version 3.
Because I have already bought Sublime Text 3 and it meets my requirements, I don't want to pay for the new version.

### Optional

Install the optional GUI softwares via Homebrew-Cask

-   Auxiliary

    ```bash
    brew install --cask \
        appcleaner \
        bartender \
        imageoptim \
        itsycal \
        monitorcontrol \
        numi \
        qq \
        snipaste \
        ticktick \
        wechat
    ```

-   Personal

-   Entertainment

    ```bash
    brew install --cask \
        iina \
        kindle \
        neteasemusic \
        parallels \
        qqmusic \
        steam \
        thunder
    ```

-   Development

    ```bash
    brew install --cask \
        charles \
        docker \
        iterm2 \
        jetbrains-toolbox \
        postman \
        sequel-pro \
        tableplus \
        visual-studio-code \
        wireshark
    ```

-   Office

    ```bash
    brew install --cask \
        linear \
        microsoft-office \
        notion \
        slack
    ```

NOTICE : The installations may REQUIRE you to input PASSWORD,
e.g. `microsoft-office`, `parallels`, `wireshark` and etc.

## CLI Preferences

### GitHub Keys

GitLab keys ditto

#### SSH Key

Using the SSH protocol, you can connect and authenticate to remote servers and services

- With SSH keys, you can connect to GitHub without supplying your username and personal access token at each visit

How to :

1.  **Generate** the SSH key pair

    Reference : [Generating a new SSH key and adding it to the ssh-agent - GitHub](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent)

1.  **Get** the SSH public key and
    **Add** it to the GitHub accounts

    Reference : [Adding a new SSH key to your GitHub account - GitHub](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account)

#### GPG Key

Use GPG to sign tags and commits locally

- These tags or commits are marked as verified on GitHub so other people can be confident that the changes come from a trusted source

How to :

1.  **Generate** the GPG key pair

    Reference : [Generating a new GPG key - GitHub](https://docs.github.com/en/authentication/managing-commit-signature-verification/generating-a-new-gpg-key)

1.  **Get** the GPG pulic key

    Reference : [cmd/g/gpg - icehe.xyz](/cmd/g/gpg.md)

1.  **Add** the GPG key to the GitHub accounts

    Reference : [Adding a new GPG key to your GitHub account - GitHub](https://docs.github.com/en/authentication/managing-commit-signature-verification/adding-a-new-gpg-key-to-your-github-account)

### Dotfiles

e.g. for the author

```bash
cd ~
git init
git remote add origin git@github.com:IceHe/mac-conf.git
git pull origin master
git branch --set-upstream-to=origin/master master
```

#### Git

How to configure :

-   A. Synchronize the settings via the configuration files from the dotfiles above - recommended

    e.g.

    - `~/.gitconfig`
    - `~/.gitignore`
    - `~/.gitignore_global`
    - …

-   B. Or execute the commands

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
        $ git config --global -l
        # e.g.
        user.name=IceHe.xyz
        user.email=icehe@qq.com
        user.signingkey=[SIGNING_KEY]
        commit.gpgsign=true
        gpg.program=gpg
        …
        ```

#### Oh My Zsh

1.  **Install**

    Reference : [Install oh-my-zsh now - ohmyz.sh](https://ohmyz.sh/#install)

1.  **Synchronize** the settings

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

## GUI Preferences

GUI - Graphical User Interface

Include the development configurations on local and remote machines

### System

#### Dock at the bottom

- Disable all softwares `Options` → `Keep in Dock`

#### Dock & Menu Bar

- Enable `Automatically hide and show the Dock`
- Disable `Show recent applications in Dock`

#### Keyboard

-   `Keyboard` Tab

    - Set `Delay Until Repeat` max
    - Set `Key Repeat` max
    - Enable `Use F1, F2, etc. keys as standard function keys`

-   `Text` Tab

    - Clear all `Replace With`
    - Clear all checkboxes

-   `Shortcuts` Tab

    - Add/Update `App Shortcuts`
        - `All Applications` → `Show Help menu` ⌥ ⇧ /
        - `Google Chrome` → `Duplicate Tab` ⇧ ⌘ D
        - `iTerm` → `Toggle Full Screen` ⇧ ⌘ F

-   `Input Sources` Tab

    - Remove the useless input sources

#### Trackpad

- Set `Tracking speed` Max

#### Notification

- Disable the useless softwares notifications on demand

#### Key Repeat

How to enable :

1. Execute the command :

    ```bash
    defaults write -g ApplePressAndHoldEnabled -bool false
    ```

1. Reboot and Check

    References : Search "macos keyboard cannot repeat" on Google

    - [Problem with key repeat - Apple Community](https://discussions.apple.com/thread/8068772)
    - [OS X – Choose Between the Character Accents Popup and Key Repeat When Holding Down a Key](https://infinitediaries.net/os-x-choose-between-the-character-accents-popup-and-key-repeat-when-holding-down-a-key)

### Softwares

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
    `~/.config/karabiner/karabiner.json` from the dotfiles - done above

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

TODO ?

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

1. **Set the license** - optional

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

## Development

### Java

#### IntelliJ IDEA

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

#### Maven

1.  Install [Apache Maven](https://maven.apache.org/) - `mvn`

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

### JavaScript

CLI

```bash
brew install node
```

#### CLI

1. install nvm
1. install node via nvm
1. project

#### WebStorm

TODO : Synchroize the preferences with the GitHub repository

References

- [How to make WebStorm format code according to eslint? - Stack Overflow](https://stackoverflow.com/questions/41735890/how-to-make-webstorm-format-code-according-to-eslint)

### Android - Kotlin

CLI

```bash
brew install \
    kotlin \
    gradle
```

#### AndroidStudio

TODO : Synchroize with the GitHub repository
