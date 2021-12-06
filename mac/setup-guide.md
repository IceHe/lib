# macOS Setup Guide - 设置指南

How to setup my Mac step by step?

---

Reference : [macOS Setup Guide - Sourabh Bajaj](http://sourabhbajaj.com/mac-setup)

Related : [macOS Efficiency Guide - 效率指南](/mac/efficiency-guide.md)

---

This guide has been recently used by the author on 2021/12/02

- macOS **Monterey** version **12.0.1**
- MacBook Pro 2021 with **M1 Pro** chip

## Guidelines

Follow the principles :

-   **KISS - Keep It Simple and Stupid / Short** - 简单原则

    Assume that you are an experienced Mac user and a software developer,
    so I can focus on the procedure and skip the unnecessary descriptions

    _e.g. the softwares' introductions, their usages and development knowledge_

-   **OOTB - Out Of The Box** - 开箱即用

    Try not to change the default settings

-   **FYI only - For Your Information only** - 仅供参考

## Install or Restore macOS

SKIP this step if I set up a new Mac or have already re-installed a new macOS

Follow the references : Apple Support

1. [在 Mac 上抹掉所有内容和设置](https://support.apple.com/zh-cn/HT212749) - optional
1. [如何创建可引导的 macOS 安装器](https://support.apple.com/zh-cn/HT201372)
1. [如何重新安装 macOS](https://support.apple.com/zh-cn/HT204904)

RECOMEND : 避免直接将备份数据还原到新系统中

因为每次将过去 Mac 的备份数据直接还原到新系统中都难免会产生冗余、无用甚至错误的数据；
随着时间推移，我们不仅需要越来越大的存储空间来保存它们，而且可能会产生难以解决的问题。
所以，为了适时淘汰这些可能存在问题的数据，建议每次迁移 Mac 时都尽量避免直接迁移旧数据。

## Network & Passwords

### Network & AppleID

First of all :

1.  Connect to Internet via Wi-Fi or Erthernet

1.  Sign in AppleID to synchronize the settings & iCloud data

    - or sign up if you don't have an AppleID

1.  Open [this guide](https://icehe.xyz/#/mac/setup-guide) on Mac so that I can continue the following steps

### Password Manager

The password manager makes it easier and safer for me to login other accounts

e.g. using [1Password](https://1password.com/)

1.  Install via Mac App Store

1.  Open and login the account on my.1password.com - recommended

    - or load the vaults on iCloud

Note : [List of password managers - Wikipedia](https://en.wikipedia.org/wiki/List_of_password_managers)

### Network Proxy

RECOMMEND to configure the network proxy for stable Internet connections in China mainland

so that I can continue the following steps more smoothly

#### GUI Proxy

GUI - Graphical User Interface

1.  Get the proxy service

    How to :

    - A. BUY - recommended
    - B. Build it myself

    Note : Because the valid methods to get a stable network proxy may change often,

    RECOMMEND to search the new methods on the Internet when I need

1.  Get the proxy configurations from the proxy service

    e.g. via subscription URL

    List of configuration methods :

    - A. subscription URL - recommended
    - B. configuration file
    - C. server URLs
    - D. QR codes
    - …

1.  Install the proxy plugin

    e.g. [ClashX Pro](https://github.com/Semporia/ClashX-Pro)

    List of proxy plugins :

    - A. [Clash](https://github.com/Dreamacro/clash)
    - B. [ClashX](https://github.com/yichengchen/clashX) : [releases](https://github.com/yichengchen/clashX/releases)
    - C. [ClashX Pro](https://github.com/Semporia/ClashX-Pro) : [releases](https://install.appcenter.ms/users/clashx/apps/clashx-pro/distribution_groups/public) - recommended
    - D. [Surge](https://nssurge.com/)
    - E. [Trojan](https://github.com/trojan-gfw/trojan)
    - F. ~~[TrojanX](https://github.com/JimLee1996/TrojanX)~~
    - G. ~~[Trojan-Qt5](https://github.com/Trojan-Qt5/Trojan-Qt5)~~
    - H. [Shadowsocks](https://github.com/shadowsocks)
    - I. ~~[ShadowsocksX](https://github.com/RobertYim/ShadowsocksX)~~
    - J. ~~[ShadowsocksX-NG](https://github.com/shadowsocks/ShadowsocksX-NG)~~
    - …

1.  Import the proxy configurations into the proxy plugin

    e.g. configure ClashX Pro via the subscription URL :

    1.  Open `ClashX Pro`
    1.  Menu Bar → `ClashX Pro`
        1. → `Config` → `Remote config` → `Manage` → `Add` → Enter the subscription URL → `OK`
        1. → `Config` → Select the new config I added - usually uncessary
        1. → `Set as system proxy`
        1. → `Dashboard` → `Setting` → Enable `Start at login`

1.  Check the Internet connection

    e.g. visit [google.com/ncr](https://google.com/ncr) on the browser

#### CLI Proxy

CLI - Command Line Interface

Configure the network proxy on CLI

1.  Get the proxy from the proxy plugin

    e.g. get it from ClashX Pro

    -   Menu Bar → `ClashX Pro` → `Copy shell command` :

        ```bash
        export https_proxy=http://127.0.0.1:7890 http_proxy=http://127.0.0.1:7890 all_proxy=socks5://127.0.0.1:7890
        ```

1.  Add the proxy on CLI

    e.g. add it in the Terminal tab temporarily

    -   A. Temporarily : Open `Terminal` → Paste the shell command above to execute

    -   B. All the time : Append the shell command above to the ZSH configuration file, e.g. `.zshrc`

        so that I can always use ZSH with the network proxy when ClashX Pro is running

1.  Check the Internet connection on CLI

    e.g. visit [google.com](https://google.com) in Terminal tab opened above :

    ```bash
    $ curl google.com

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

[Homebrew](https://brew.sh) is a software package management system that simplifies the installation of software on macOS

[Homebrew-Cask](https://formulae.brew.sh/cask/) extends Homebrew and allows me to install the large binary files via a command-line tool

I can search the available softwares I need on [Homebrew Formulae](https://formulae.brew.sh)

- CLI softwares : [Formula](https://formulae.brew.sh/formula/) - a listing of all packages available from the core tap
- GUI softwares : [Cask](https://formulae.brew.sh/cask) - a listing of all casks available from the cask tap

1.  Install

    How to :

    - A. [Homebrew - brew.sh](https://brew.sh) - official
    - B. [国内如何自动安装 - 知乎](https://zhuanlan.zhihu.com/p/111014448) - recommended

1.  Check

    ```bash
    $ brew --version
    # e.g.
    Homebrew 3.3.6
    Homebrew/homebrew-core (git revision 628aed8b9e1; last commit 2021-12-02)
    Homebrew/homebrew-cask (git revision 6c3d470278; last commit 2021-12-02)
    ```

1.  Speed up

    Reference : [Homebrew (中国大陆) 有比较快的源 (mirror) 吗? - 知乎](https://www.zhihu.com/question/31360766/answer/749386652)

1.  Update & upgrade - in the future

    ```bash
    brew update && brew upgrade
    ```
1.  PREPARE : Prevent Mac from automatically sleeping in a short time

    so that the installations WON'T be interrupted by auto-sleeping frequently

    e.g. let the display wait for a long time before turning off

    `System Preferences` → `Battery`

    -   `Battery`

        - Set `Turn display off after:` 30 min
        - Disable `Put hard disks to sleep when possible` - optional

    -   `Power Adapter`

        - Set `Turn display off after:` 30 min
        - Enable `Prevent your Mac from automatically sleeping when the display off` - optional

## Install CLI Softwares

CLI - Command Line Interface

RECOMMEND to install CLI programs via Homebrew

### Required

Install the required CLI softwares via Homebrew

e.g. for me

```bash
brew install \
    coreutils \
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

Note : The pre-installed softwares may be outdated e.g. `git`, so RECOMMEND to install them via Homebrew again

Note : Why I need these CLI softwares?

-   [coreutils](http://www.gnu.org/s/coreutils/) :
    The basic file, shell and text manipulation utilities of the GNU operating system

    It include many useful commands, see TOC of
    [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html)

    e.g. get the absolute path to a file or directory via [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html) command

-   `tmux` requires [`reattach-to-user-namespace`](https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x)
    to write and read the system clipboard

    `reattach-to-user-namespace` reattaches to the per-user bootstrap namespace in its "background" session and then execute the program with arguments

### Optional

Install the optional CLI softwares via Homebrew

e.g. for me

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

e.g. for me

-   First

    ```bash
    brew install --cask \
        google-chrome \
        karabiner-elements \
        keyboard-maestro \
        wechat
    ```

-   Auxiliary

    ```bash
    brew install --cask \
        appcleaner \
        bartender \
        imageoptim \
        iterm2 \
        itsycal \
        kindle \
        monitorcontrol \
        neteasemusic \
        numi \
        qq \
        qqmusic \
        snipaste \
        ticktick \
        visual-studio-code
    ```

RECOMMEND to execute the commands above in parallel in multiple Terminal tabs

NOTICE : The installations may REQUIRE me to enter Mac PASSWORD, e.g. `karabiner-elements`

#### Mac App Store

Install the required GUI softwares via Mac App Store

Note : The GUI softwares unavailable on Homebrew-Cask may be available on Mac App Store

- 1Password - _done above_
- Copy 'Em
- EasyRes
- EuDic 欧路词典 - _相对于 "增强版" 而言, 属于 "免费版"_

#### Websites

Install the required GUI softwares via the installations downloaded from the websites

Note : Some GUI softwares are only available on the websites

- [Copy 'Em Helper](https://apprywhere.com/ce-helper.html)
- [Logi Options](https://www.logitech.com.cn/zh-cn/product/options) - _TODO : Wait for Logi Option+ public release_
- [Sogou Input 搜狗输入法](https://pinyin.sogou.com/mac)
- [Sublime Text 3](https://www.sublimetext.com/3)

Note : `brew install --cask sublime-text` will install the latest version, but I still stick on version 3,

because I have already bought Sublime Text 3 and it still meets my requirements ( a lightweight editor for fast editing )

### Optional

Install the optional GUI softwares via Homebrew-Cask

-   Development

    ```bash
    brew install --cask \
        charles \
        docker \
        jetbrains-toolbox \
        postman \
        sequel-pro \
        tableplus \
        wireshark
    ```

-   Entertainment

    ```bash
    brew install --cask \
        iina \
        parallels \
        steam \
        thunder
    ```

-   Office

    ```bash
    brew install --cask \
        linear-linear \
        microsoft-office \
        notion \
        slack
    ```

RECOMMEND to execute the commands above in parallel in multiple Terminal tabs

NOTICE : The installations may REQUIRE me to enter Mac PASSWORD,

e.g. `microsoft-office`, `parallels`, `wireshark` and etc.

## CLI Preferences

### GitHub Keys

GitLab keys ditto

#### SSH Key

Using the SSH protocol, I can connect and authenticate to remote servers and services

- With SSH keys, I can connect to GitHub without supplying my username and personal access token at each visit

How to :

1.  Generate a SSH key pair

    Reference : [Generating a new SSH key and adding it to the ssh-agent - GitHub](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent)

1.  Get the SSH public key and add it to the GitHub account

    Reference : [Adding a new SSH key to your GitHub account - GitHub](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account)

#### GPG Key

SKIP this step if I don't need to sign git commits

Use GPG to sign tags and commits locally

- These tags or commits are marked as verified on GitHub so other people can be confident that the changes come from a trusted source

How to :

1.  Generate a GPG key pair

    Reference : [Generating a new GPG key - GitHub](https://docs.github.com/en/authentication/managing-commit-signature-verification/generating-a-new-gpg-key)

1.  Get the GPG pulic key

    Reference : [GPG Command Guide - icehe.xyz](/cmd/g/gpg.md)

1.  Add the GPG key to the GitHub account

    Reference : [Adding a new GPG key to your GitHub account - GitHub](https://docs.github.com/en/authentication/managing-commit-signature-verification/adding-a-new-gpg-key-to-your-github-account)

1.  Problem : gpg failed to sign the data

    ```bash
    $ git commit -m "troubleshooting"
    error: gpg failed to sign the data
    fatal: failed to write commit object
    ```

    Solution : `gpg` requires `pinentry-mac` on Mac

    ```bash
    brew install pinentry-mac
    ```

    Reference : [gpg failed to sign the data fatal: failed to write commit object](https://stackoverflow.com/questions/39494631/gpg-failed-to-sign-the-data-fatal-failed-to-write-commit-object-git-2-10-0)

### CLI Tools

#### Dotfiles

e.g. for me

```bash
cd ~
git init
git remote add origin git@github.com:IceHe/mac-conf.git
git pull origin master
git branch --set-upstream-to=origin/master master
```

#### Git

e.g. for me

1.  Synchronize the most of the settings via the global configuration files

    e.g. from the dotfiles downloaded above

    - `~/.gitconfig.sample`
    - `~/.gitignore`
    - `~/.gitignore_global`
    - …

1.  Initilize the global configuration file `~/.gitconfig`

    e.g. according to the sample file `~/.gitconfig.sample` from the dotfiles downloaded above

    ```bash
    cp .gitconfig .gitconfig.sample
    ```

1.  Configure the global user name & email

    ```bash
    git config --global user.name IceHe.xyz
    git config --global user.email icehe.xyz@qq.com
    ```

1.  Configure the global GPG signing key from the GitHub GPG key generated above

    ```bash
    git config --global user.signingkey [SIGNING_KEY]
    ```

1.  Check the global settings

    ```bash
    $ git config --global -l
    # e.g.
    core.ignorecase=false
    filter.lfs.required=true
    filter.lfs.clean=git-lfs clean -- %f
    filter.lfs.process=git-lfs filter-process
    filter.lfs.smudge=git-lfs smudge -- %f
    commit.gpgsign=true
    gpg.program=gpg
    http.sslverify=false
    pager.branch=false
    pull.rebase=true
    user.name=IceHe.xyz
    user.email=icehe.xyz@qq.com
    user.signingkey=[SIGNING_KEY]
    …
    ```

#### Oh My Zsh

1.  Install

    Reference : [Install oh-my-zsh now - ohmyz.sh](https://ohmyz.sh/#install)

1.  Synchronize the ZSH settings via the configuration file `~/.zshrc`

    e.g. from the dotfiles downloaded above

1.  Install the ZSH plugin `zsh-autosuggestion`

    ```bash
    git clone https://github.com/zsh-users/zsh-autosuggestions ${ZSH_CUSTOM:-~/.oh-my-zsh/custom}/plugins/zsh-autosuggestions
    ```

    Reference : [Installation - zsh-users/zsh-autosuggestions](https://github.com/zsh-users/zsh-autosuggestions/blob/master/INSTALL.md)

<!--

#### Neovim or Vim

Run the command below to link `~/.vimrc` to `~/.config/nvim/init.vim` :

e.g. for me

```bash
ln -s /Users/icehe/.vimrc /Users/icehe/.config/nvim/init.vim

# Trouble-shooting in Vim or Nvim
vim
:checkhealth
:help clipboard
```

-->

#### PlantUML

[PlantUML](http://plantuml.com/) requires [GraphViz](https://plantuml.com/zh/graphviz-dot) to write UML diagrams

```bash
brew install libtool
brew link libtool
brew install graphviz
brew link --overwrite graphviz
```

Note : The commands above fix the issues if I installed GraphViz via the `.dmg` package

I can specify the environment variable `GRAPHVIZ_DOT` to set the exact location of the GraphViz executable.
By default, the dot executable is expected :

- Firstly in : `/usr/local/bin/dot`
- Then in : `/usr/bin/dot`

## GUI Preferences

GUI - Graphical User Interface

### System

Open `System Preferences` at first

#### Battery

Note : Revert the settings changed above back to the default values

-   `Battery`

    - Set `Turn display off after:` 3 min
    - Enable `Put hard disks to sleep when possible`

-   `Power Adapter`

    - Set `Turn display off after:` 10 min
    - Disable `Prevent your Mac from automatically sleeping when the display off`

#### Dock

For all the softwares appeared on the Dock at the bottom of the desktop

- Right click the software icon → `Options` → Disable `Keep in Dock`

#### Dock & Menu Bar

`Dock & Menu Bar`

- Enable `Automatically hide and show the Dock`
- Disable `Show recent applications in Dock`

Note : Menu Bar DOES NOT have enough space for many software icons so I have to hide some of them

Some of the icons will still be visible in Control Center

`Wi-Fi`

- Disable `Show in the Menu Bar`

`Bluetooth`

- Disable `Show in the Menu Bar`

`Screnn Mirroring`

- Disable `Show in the Menu Bar`

`Display`

- Disable `Show in the Menu Bar`

`Sound`

- Enable `Show in the Menu Bar` → Select `always`

`Spotlight`

- Disable `Show in the Menu Bar`

`Siri`

- Disable `Show in the Menu Bar`

#### Keyboard

`Keyboard`

- Set `Key Repeat` fastest
- Set `Delay Until Repeat` the 3rd shortest i.e. 35 milliseconds

    Check :

    ```bash
    $ defaults read NSGlobalDomain InitialKeyRepeat
    35
    ```

- Enable `Use F1, F2, etc. keys as standard function keys`

`Text`

- Clear all `Replace With`
- Clear all checkboxes

`Shortcuts`

- Add `App Shortcuts`
    - `Google Chrome` → `Duplicate Tab` → `⇧ ⌘ D`
    - `iTerm` → `Toggle Full Screen` → `^ ⌘ F`

`Input Sources`

- Clear the unused input sources

#### Key Repeat

How to disable `Character Accents Popup` and enable `Key Repeat` :

1. Enable `Key Repeat` :

    ```bash
    defaults write -g ApplePressAndHoldEnabled -bool false
    ```

1. Reboot and Check

Reference : Search "macos keyboard cannot repeat" on Google

- [Choose Between the Character Accents Popup and Key Repeat When Holding Down a Key](https://infinitediaries.net/os-x-choose-between-the-character-accents-popup-and-key-repeat-when-holding-down-a-key)

#### Misson Control

- `Hot Corners…` → The bottom right corner → Replace `Quick Note` with `-`

#### Notification & Focus

- Disable the unncessary softwares' notifications on demand

#### Sharing

- Edit `Computer Name:` e.g. macbook-pro-ice

#### Trackpad

- Set `Tracking speed` fastest

### Softwares

#### Chrome

1.  Login the Google account

1.  Turn on `Sync` - automatically

    Chrome will usually request me to turn on `Sync` after logining

    MAY require the independent synchronization password

1.  Synchronize the extensions - automatically

    Chrome will do it in the background after I turning on `Sync`

    Do it manually if `Sync` does not work well

    `Chrome` Menu Bar → `Window` → `Extensions` → Sidebar on the left → `Open Chrome Web Store`

    -   [1Password](https://agilebits.com/browsers/welcome.html) : password manager
    -   [Proxy SwitchyOmega](https://chrome.google.com/webstore/detail/padekgcemlokbadohgkifijomclgjgif) : manage and switch between multiple proxies quickly & easily
    -   [Chrono Download](https://chrome.google.com/webstore/detail/chrono-download-manager/mciiogijehkdemklbdcbfkefimifhecn) : download and manage the web
    -   [OneTab](https://chrome.google.com/webstore/detail/onetab/chphlpgkkbolifaimnlloiipkdnihall) : reduce tab clutter
        If open too many tabs, stash them in OneTab to save memory space and visible screen area
    -   [uBlock Origin](https://chrome.google.com/webstore/detail/cjpalhdlnbpafiamejdnhcphjbkeiagm) : a lightweight AD blocker
    -   [Vimium](https://chrome.google.com/webstore/detail/vimium/dbepggeogbaibhgnhhndojpepiihcmeb) : provide keyboard shortcuts for navigation and control in the spirit of Vim
    -   [JSON Formatter](https://chrome.google.com/webstore/detail/bcjindcccaagfpapjjmafapmmgkkhgoa) : make JSON easy to read
    -   [Elasticsearch Head](https://chrome.google.com/webstore/detail/elasticsearch-head/ffmkiejjmecolpfloofpjologoblkegm) : containing the excellent ElasticSearch Head application

1.  Synchronize the extension `Proxy SwitchyOmega` settings - manually

    e.g. via the configuration file from another Mac

1.  Synchronize the extensions' keyboard shortcuts - automatically

    Do it manually if `Sync` does not work well

    -   Menu Bar → `Window` → `Extensions` → Sidebar on the left → `Keyboard shortcuts`

        -   1Password
            - `⇧ ⌘ X` Activate the extension
        -   Proxy SwitchyOmega
            - `^ ⌘ S` Activate the extension
        -   Chrono Download Manager
            - `⇧ ⌘ J` Activate the extension
        -   OneTab
            - `⇧ ⌘ O` Activate the extension
            - `⇧ ⌘ S` DiSplay / Show OneTab
            - `⇧ ⌘ C` Send the **C**urrent tab to OneTab
        -   Edit required shortcuts and Clear uncessary ones

#### Sogou Input

1. `System Preferences` → `Keyboard` → `Input Sources` → Add `搜狗拼音`

1. Clear the input methods except `ABC` and `搜狗拼音`

1. Switch the input source to `搜狗拼音`d

1. Menu Bar → `Input Source Menu` → `搜狗拼音` → `偏好设置` → `同步`

    1. → Login via the WeChat account
    1. → `配置同步` → `下载配置`

#### Karabiner-Elements

1.  Synchronize the settings - automatically

    via the configuration file `~/.config/karabiner/karabiner.json`

    e.g. from the dotfiles downloaded above

#### Keyboard Maestro

1.  Enter the license

    1. `Keyboard Maestro` → `Register Keyboard Maestro…`

    1. Enter `Email` and `License key`

1.  Synchronize the macros

    1.  `File` → `Start Syncing Macros…` → `Open Existing…`

    1.  Choose the configuration file `~/.config/Keyboard Maestro Macros.kmsync`

        e.g. from the dotfiles downloaded above

1.  `Preferences` → `General` → Enable `Launch Engine at Login`

#### Visual Studio Code

1.  Synchronize the settings via the built-in feature [Settings Sync](https://code.visualstudio.com/docs/editor/settings-sync)

    -   Sign in with GitHub

1.  Synchronize the extensions - automatically

    Do it manually if `Settings Sync` does not work well

    -   [markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint) :
        check Markdown style

    -   [Markdown Preview Enhanced](https://marketplace.visualstudio.com/items?itemName=shd101wyy.markdown-preview-enhanced) :
        support [PlatUML](http://plantuml.com) real-time rendering in the Markdown code blocks

    -   [PlantUML](https://marketplace.visualstudio.com/items?itemName=jebbs.plantuml) :
        support PlatUML real-time rendering in the files `\*.puml`

        - Note : It requires [GraphViz](https://plantuml.com/zh/graphviz-dot) to provide `dot` program as mentioned above

    -   [Vim](https://marketplace.visualstudio.com/items?itemName=vscodevim.vim) :
        the emulator for editing text like Vim

    -   …

#### Sublime Text

1.  Configure

    1.  Press the shortcut  `⌘ ,` to open `Preferences.sublime-settings` of the User
    1.  Edit the content as below :

        ```json
        {
            "ignored_packages": [],
            "tab_size": 4,
            "translate_tabs_to_spaces": true,
            "update_check": false,
            "vintage_use_clipboard": true
        }
        ```

1.  Install `Package Control`

    1. Press the shortcut `⇧ ⌘ P`
    1. Search `install`
    1. Select `Install Package Control` to install

1.  Install the package `Pretty JSON`

    1. Press the shortcut `⇧ ⌘ P`
    1. Search `install`
    1. Select `Package Control: Install Package`
    1. Search `Pretty JSON`
    1. Select `Pretty JSON` to install

1. Enter the license - optional

    1. `Help` → `Enter License`
    1. Enter the license key

<!-- 1. _Synchronize the settings via the plugin [Sync Settings - Package Control](https://packagecontrol.io/packages/Sync%20Settings) ( optional )_ -->

#### iTerm 2

1.  Synchronize the settings

    1. `Preferences` → `General` → `Preferences`
    1. Enable `Load preference from a custom folder or URL`
    1. Select the config folder _from the dotfiles downloaded above_
    1. Select Save changes `When Quitting`

1.  Enable the access to the system clipboard

    Do it manually if the synchronization does not work well

    1. `Preferences` → `General` → `Selection`
    1. Enable `Applications in terminal may access clipboard`

1.  Select the color theme

    1. `Preferences` → `Profiles` → `Colors` → `Color Presets`
    1. Select any color preset I like

#### Copy 'Em

-   `Sort Order` int the top right corner of the popup menu

    -   Select `Most Recently Used` or press `⌥ ⌘ R`

-   `Preferences` in the bottom left corner of the popup menu

    -   Enable `Launch at Login`

    -   `Window Appearance`

        -   Select `Midday`
        -   Set `Minimum Font Size` 15
        -   Select `Auto-Scroll to Last Selected After List Change`

    -   `Window Position` → `Open at Active Screen`

    -   `Search Field`

        -   Enable `Toggle Search Filters with ⌘ F`
        -   Eanble `Search Immediately After Each Keystroke`

    -   `Keyboard Shortcuts…`

        -   `Global Shortcuts`

            -   Set `Open window` to `⌥ V`
            -   Set `Paste current clipboard item as plain test` to `⇧ ⌘ V`

        -   `Local Shortcuts`

            -   Set `Switch to 'All' list` to `⇧ ⌘ A`

        -   Clear the other shortcuts

    -   Enbale `Get Titles of Web URLs`

    -   Enable `Reject Duplicates`

    -   `Auto-Delete Unstarred Items` → `Auto-Delete Oldest…`

        -   Store only the most recent `1000` unstarred items…

#### Snipaste

`Preferences…`

- `General`

    - Enable `Run on system startup`

- `Control` → `Global Hotkeys`

    - Set `Snip` to `^ ⌘ A`
    - Clear the other hotkeys

#### Bartender

`Preferences…`

-   `General`

    -   Startup : Enable `Launch Bartender at login`
    -   Bartender Bar : Enable `Use Bartender Bar to show hidden items`

#### Itsycal

`Preferences…`

-   `General`

    - Enable `Launch at login`
    - First day of week: `Monday`
    - Select the calendars on demand

-   `Appearance`

    -   `Menu Bar`

        - Datetime pattern `MM / dd  E  HH:mm:ss`
            - or `E, dd MMM HH:mm:ss`
            - or ` Y.MM.dd  E  HH:mm:ss `
        - Enable `Hide icon`

    -   `Calendar`

        - `Highlight`
            - Enable `Saturday` and `Sunday`
        - Enable `Show event dots`
            - Enable `Use colored dots`
        - Enable `Use event location`
        - Enable `Use calendar weeks`

`System Preferences`

- `Dock & Menu Bar` → `Clock` → Time Options: `Analog`

#### EuDic

`偏好设置`

-   `同步`

    - `登录…` → Login via QQ account

-   `通用`

    - `词典`
        - Enable `自动展开在线词典内容`
        - Enable `查词后自动加入生词本`

-   `取词`

    - Clear all checkboxes

-   `快捷键`

    - Clear all shortcuts

## Development

### Projects

Git clone the projects to the local machine

e.g. for me

```bash
cd ~/Documents
git clone git@github.com:IceHe/lib.git
```

### JDK

JDK - Java Development Kit

REQUIRED by Maven, Gradle, JetBrains IDEs and etc.

#### Install JDKs

RECOMMEND to install the JDKs of the common used version **11** and the latest LTS version **17**

LTS - Long-Term Support

-   A.  via Homebrew - recommended

    ```bash
    brew install openjdk@11
    java --version
    brew install openjdk
    java --version
    ```

-   B.  via SDKMAN!

    1.  Install SDKMAN!

        Reference : [Installation - SDKMAN!](https://sdkman.io/install)

    2.  Install JDK via SDKMAN!

        Reference : [JDKs - SDKMAN!](https://sdkman.io/jdks)

        ```bash
        sdk install java [VERSION]
        ```

-   C. via the installation downloaded from the websites

    Reference : [Java Downloads - Oracle](https://www.oracle.com/java/technologies/downloads/)

#### JAVA_HOME

Set the environment variable `JAVA_HOME` - automatically

e.g. via the dotfiles downloaded above

I can do it manually : append the command below to the ZSH configuration file `~/.zshrc` :

```bash
export JAVA_HOME=`/usr/libexec/java_home -v 17`
```

- If `~/.zshrc` doesn't exists, create it
- If use `bash` instead of `zsh`, append to the BASH configuration file `~/.bashrc`

Note : The tilde symbol `~` equals the path of the current user's home directory, e.g. for me `/Users/icehe`

Note : Get the path to JDK via `/usr/libexec/java_home`, e.g. JDK 8

```bash
$ /usr/libexec/java_home -v 1.8
/Library/Java/JavaVirtualMachines/zulu-8.jdk/Contents/Home
```

### JetBrains Toolbox

RECOMMEND to use JetBrains tools to develop

#### Install Tools

1.  Login the JetBrains account on [account.jetbrains.com/login](https://account.jetbrains.com/login)
1.  Open `JetBrains Toolbox` → Menu Bar → `JetBrains Toolbox` → `Settings` → `Log in` → `Approve` → Jump back to `JetBrains Toolbox` Menu
1.  Install the required tools

    e.g. for me

    - IntelliJ IDEA Ultimate
    - WebStorm
    - Android Studio
    - DataGrip
    - _CLion_
    - _GoLand_
    - ~~_PyCharm Professional Edition_~~
    - ~~_PhpStorm_~~

#### Plugins

RECOMMEND to use the JetBrains IDE plugins

e.g. for me

Common

-   [IdeaVim](https://plugins.jetbrains.com/plugin/164-ideavim) :
    Vim emulator - edit text like Vim
-   [Indent Rainbow](https://plugins.jetbrains.com/plugin/13308-indent-rainbow) :
    Colorize the indentation in front of the text
    alternating four different colors on each step
-   [Key Promoter X](https://plugins.jetbrains.com/plugin/index?xmlId=Key%20Promoter%20X) :
    Learn essential shortcuts while I'm working
-   [PlantUML integration](https://plugins.jetbrains.com/plugin/7017-plantuml-integration) :
    Draw UML graphs for docs by [PlantUML](http://plantuml.com/)
-   [Rainbow Brackets](https://plugins.jetbrains.com/plugin/10080-rainbow-brackets) :
    Code faster and smarter using code completions
    learned from millions of programs directly
-   [String Manipulation](https://plugins.jetbrains.com/plugin/2162-string-manipulation) :
    Case switching, sorting, filtering, incrementing,
    aligning to columns, grepping, escaping, encoding…
-   …

<!--

-   [Force Shortcuts](https://plugins.jetbrains.com/plugin/8357-force-shortcuts) :
    Forces the user to use keyboard shortcuts by blocking click action
    and displaying the keyboard shortcut in a popup.

-->

IntelliJ IDEA

-   [Lombok Plugin](https://plugins.jetbrains.com/plugin/6317-lombok-plugin) :
    Never write another getter or equals method again
    [Project Lombok](https://projectlombok.org/)
    is a java library that automatically plugs into the editor
    and build tools, spicing up your java.
    Early access to future java features such as val, and much more.
-   [Maven Helper](https://plugins.jetbrains.com/plugin/7179-maven-helper) :
    A must have plugin for working with Maven
-   [google-java-format](https://plugins.jetbrains.com/plugin/8527-google-java-format) :
    Reformats Java source code to comply with
    [Google Java Style](https://google.github.io/styleguide/javaguide.html)
-   [generateAllSetter](https://github.com/gejun123456/intellij-generateAllSetMethod)
-   …

### Java

#### IntelliJ IDEA

1.  Install

    -   A. via Jetbrains Toolbox - recommended
    -   B. via the installation downloaded from [the official website](https://www.jetbrains.com/idea/download/#section=mac)

        Note : I can choose the Community verion to skip entering the license

1.  Enter the license - optional

    SKIP if I install via JetBrains Toolbox - which has been logined the account with the related license

    RECOMMEND to [buy the commercial license](https://www.jetbrains.com/idea/buy/#edition=commercial)
    or [offer free educational licence for students and teachers](https://sales.jetbrains.com/hc/en-gb/articles/207241195-Do-you-offer-free-educational-licenses-for-students-and-teachers-)

    -   Menu Bar → `Help` → `Register…` → Enter the license

1.  Configure the network proxy - optional

    e.g. ClashX Pro

    `Peferences` → `Appearance & Behavior` → `System Settings` → `HTTP Proxy` → Select `Manual proxy configuration` → Select `SOCKS`

    1.  `Host name:` Enter `127.0.0.1`
    1.  `Port number:` Enter `7890`
    1.  `Check connection` → Enter `http://google.com` → `OK`
        - Prompt `Connection successful` if success

1.  Synchronize the settings - optional

    -   A. via IDE Settings Sync - recommended

        Reference : [Share settings through Settings Sync](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#IDE_settings_sync)

    -   B. via the settings repository

        Note : It can synchronize the same settings accross multiple JetBrains's accounts, but the settings DO NOT include the plugins

        Reference : [Share settings through a settings repository](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository)

        1. `File` → `Manage IDE Settings` → `Settings Repository…`
        1. Enter HTTPS URL to the settings GitHub repository
        1. Enter the GitHub personal access token from [github.com/settings/tokens](https://github.com/settings/tokens)
        1. Select `Overwrite Local` at the first synchronization

    -   C. via exporting and importing the configuration file

        Reference : [Export your settings](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#import-export-settings)

1.  Install the plugins - optional - automatically

    e.g. via IDE Settings Sync above

    As metioned above : "JetBrains Toolbox - Plugins"

1.  Set the font `Consolas` - optional - automatically

    e.g. via IDE Settings Sync above

    1.  Search on the Internet, download and install
    1.  `Preferences` → `Editor` → `Color Scheme` → `Color Scheme Font` → `Font`

1.  Set the color scheme `Solarized Light (Alternate)` - optional - automatically

    e.g. via IDE Settings Sync above

    1.  Download on the Internet :

        -   A. [Solarized_Light__Alternate_.icls](https://github.com/IceHe/lib/raw/master/mac/jetbrains/Solarized_Light__Alternate_.icls) or
        -   B. [Solarized_Light__Alternate_.jar](https://github.com/IceHe/lib/raw/master/mac/jetbrains/Solarized_Light__Alternate_.jar)

    1.  `Preferences` → `Editor` → `Color Scheme` → `Scheme` → `Import` → Select the file downloaded above

#### Maven

Reference : [Apache Maven](https://maven.apache.org/)

1.  Install `mvn` -

    ```bash
    brew install maven
    mvn -version
    ```

1.  Create / Update the Maven configuration file `~/.m2/settting.xml` - optional

    e.g. according to the sample file `~/.m2/settings_demo.xml`

    ```bash
    open ~/.m2/settting.xml
    ```

    Note : `open` file with the default editor

NOTICE : If I use the private Mac and the Maven configuration file MAY exists, please merge the existing content with the new content carefully

### JavaScript

#### Node.js

RECOMMEND to use the Node.js of the main version **16**

-   A. via Homebrew

    e.g. for me

    ```bash
    brew install node@16
    ```

-   B. via [Node Version Manager](https://github.com/nvm-sh/nvm) - recommended

    1.  Install [Node Version Manager](https://github.com/nvm-sh/nvm) - `nvm`

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

    1.  Configure the environment

        e.g. follow the PROMPT from the output of the command `brew install nvm` above

        1.  Create NVM's working directory if it doesn't exist :

            ```bash
            mkdir ~/.nvm
            ```

        1.  Append / Update the commands below to the ZSH configuration file `~/.zshrc` :

            ```bash
            export NVM_DIR="$HOME/.nvm"
            # Loads nvm
            [ -s "/opt/homebrew/opt/nvm/nvm.sh" ] && . "/opt/homebrew/opt/nvm/nvm.sh"
            # Loads nvm bash_completion
            [ -s "/opt/homebrew/opt/nvm/etc/bash_completion.d/nvm" ] && . "/opt/homebrew/opt/nvm/etc/bash_completion.d/nvm"
            ```

    1.  Install [Node.js](https://nodejs.org/en/) - `node`

        e.g. for me

        ```bash
        nvm install node
        node --version
        nvm install 16
        node use 16
        node --version
        node alias default 16
        ```

        Note : The latest main version is **17**

        Reference : [Usage - nvm](https://github.com/nvm-sh/nvm#usage)

    1.  Check the versions

        e.g. for me

        ```bash
        $ nvm --version
        0.39.0
        $ node --version
        v16.13.1
        ```

    1.  Upgrade - in the future

        e.g. for me

        ```bash
        nvm install node
        nvm install 16
        ```

#### pnpm

Install or upgrade

```bash
npm install -g pnpm
```

#### WebStorm

Refer to IntelliJ IDEA above

Troubleshooting - References :

- [How to make WebStorm format code according to eslint? - Stack Overflow](https://stackoverflow.com/questions/41735890/how-to-make-webstorm-format-code-according-to-eslint)

### Android

#### Gradle & Kotlin

e.g. via Homebrew

```bash
brew install \
    gradle \
    kotlin
```

#### Android Studio

Refer to IntelliJ IDEA above

The parts that are different from IntelliJ IDEA as below :

1.  Synchronize the settings - optional

    -   A. ~~via IDE Settings Sync~~ - NOT SUPPORTED by Android Studio!

    -   B. via the settings repository - recommended

    -   C. via exporting and importing the configuration file

1.  Install the plugins - manually

    As metioned above : "JetBrains Toolbox - Plugins"

Troubleshooting - References :

- ["Failed to install the following Android SDK packages as some licences have not been accepted" error](https://stackoverflow.com/questions/54273412/failed-to-install-the-following-android-sdk-packages-as-some-licences-have-not/61480578#61480578)
