# Initialize Mac

How to initialize my Mac?

---

Reference: [macOS Setup Guide](http://sourabhbajaj.com/mac-setup)

Related on icehe.xyz: [Efficiency: 效率指南](/mac/efficiency.md)

## Guidelines

**Based on macOS**

- Applicable macOS version: Big Sur

**Follow principles**

- **KISS: Keep It Simple and Stupid** ( 简单原则 )

    Focus on the process and omit the unnecessary descriptions

    _e.g., apps' introductions & usages_
    _/ software technology / developer knowledge …_

- **OOTB: Out Of The Box** ( 开箱即用 )

    Try to minimize the modification of the initial settings

**For your reference** ( 仅供参考 )

- Assume that you are an experienced Mac user and a software developer

## Install or Restore macOS

References

- Apple Support

    - [如何创建可引导的 macOS 安装器](https://support.apple.com/zh-cn/HT201372)
    - [如何重新安装 macOS](https://support.apple.com/zh-cn/HT204904)

Suggestion

-   如果用硬盘全量备份然后将数据还原到新的设备上,
    假以时日, 系统中会留存越来越多用不着的东西;

    随着时间推移, 不得不购置容量越来越大的内置和备份硬盘,
    所以无论新老设备, 个人推荐 **直接重装然后重新配置**.

## Network Proxy

> If cannot download the required softwares,
> have to configure the network proxy firstly

1.  Get the proxy service

    - Option A: **Buy** one ( recommended )
    - _Option B: Build your own_

    Because the valid methods often change,
    recommend to search them on the Internet

1.  Get the configurations from the proxy service

    _Optional configuration forms:_

    - **subscription URL** ( recommended )
    - configuration file
    - server URLs
    - QR codes
    - _…_

1.  Import the configurations into the proxy plugin

    _Optional proxy plugins:_

    - Surge
    - Trojan
    - TrojanX
    - Trojan-Qt5
        ( works on M1 Mac. 2021-01-24 )
    - Shadowsocks
    - ShadowsocksX
    - ShadowsocksX-NG
    - …

1.  Visit google.com to validate the network

## Homebrew

Homebrew is a [macOS package manager](https://brew.sh)
for installing and managing softwares on macOS

1.  Install

    -   Plan A: [Homebrew homepage - brew.sh](https://brew.sh)

        _If cannot install or install slowly, try Plan B._

    -   Plan B: [Homebrew 国内如何自动安装 ( 国内地址 )](https://zhuanlan.zhihu.com/p/111014448)

    -   Plan C: [在 M1 芯片 Mac 上使用 Homebrew](https://sspai.com/post/63935) 2021-01-24

1.  Validate

    ```bash
    $ brew --version
    # e.g.
    Homebrew 2.6.1-29-g2be340c
    Homebrew/homebrew-core (git revision 18d380e; last commit 2020-12-11)
    Homebrew/homebrew-cask (git revision 84d2f; last commit 2020-12-11)
    ```

1.  Accelarate

    Reference: [Homebrew (中国大陆) 有比较快的源 (mirror) 吗?](https://www.zhihu.com/question/31360766/answer/749386652)

1.  Update and upgrade

    ```bash
    brew update && brew upgrade
    ```

## Homebrew-Cask

Homebrew-Cask extends Homebrew
and allows you to install large binary files via a command-line tool

> Recommend to install Mac Apps via Homebrew-Cask

Available softwares on Homebrew-Cask: [Homebrew Formulae](https://formulae.brew.sh/cask)

### Required

Install the required softwares via Homebrew-Cask

```bash
brew install --cask \
    google-chrome \
    intellij-idea \
    iterm2 \
    karabiner-elements \
    keyboard-maestro \
    neteasemusic \
    numi \
    imageoptim \
    postman \
    qqmusic \
    snipaste \
    sogouinput \
    sublime-text \
    ticktick \
    visual-studio-code \
    wechat
```

_Notice: `sogouinput` above is just a installation_
_and you have to execute it individually._

### Optional

Install the optional softwares via Homebrew-Cask

```bash
brew install --cask \
    appcleaner \
    charles \
    clion \
    docker \
    goland \
    iina \
    kindle \
    microsoft-office \
    sequel-pro \
    wireshark
```

## Mac App Store

Some softwares are unavailable on Homebrew-Cask
but available on Mac App Store

**Required**

Install the required softwares via Mac App Store

- 1Password
- Amphetamine
- Copy 'Em
- EasyRes
- EuDic 欧路词典 _( 相对于 "增强版" 而言, 属于 "免费版"  )_

Others available on GitHub

-   [Amphetamine Enhancer](https://github.com/x74353/Amphetamine-Enhancer)

Others available on the official homepages

- [Copy 'Em Helper](https://apprywhere.com/ce-helper.html)
- [Logi Options](https://www.logitech.com.cn/zh-cn/product/options)

**Optional**

- skipped

## CLI Programs

CLI: Command Line Interface

> Recommend to install CLI programs via Homebrew

Although some softwares has been pre-installed in macOS,
their versions are often outdated

So recommend to install and upgrade them via Homebrew again

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

-   [coreutils](http://www.gnu.org/s/coreutils/):
    The basic file, shell and text manipulation utilities
    of the GNU operating system

    Include many useful commands, see TOC of [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html).

    E.g., use [`realpath`](http://man7.org/linux/man-pages/man1/realpath.1.html) to get absolute path to a file or directory

-   [reattach-to-user-namespace](https://superuser.com/questions/397076/tmux-exits-with-exited-on-mac-os-x):
    For `tmux` to write and read system clipboard.

    Reattach to the per-user bootstrap namespace
    in its "Background" session then exec the program with args.

-   [vim](https://www.vim.org/): a text editor in cli. An alternate is `nvim` - [neovim](https://neovim.io/).

### Optional

Install the optional softwares via Homebrew

```bash
brew install \
    elasticsearch \
    mysql@5.7 \
    mysql \
    node \
    python \
    redis \
    ruby
```

## Java Development

### JDK

JDK - Java Development Kit

1.  Download
    [JDK 8 binary installation package](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html)
    for macOs on the offical website

    The recommended version is still **8**. 2021-01-01

1.  Install

1.  Set the environment variable `JAVA_HOME`

    Append the command below to the file `~/.zshrc`:

    ```bash
    export JAVA_HOME=`/usr/libexec/java_home -v 8`
    ```

    - If `~/.zshrc` doesn't exists, create it
    - If use `bash` instead of `zsh`, append to the file `~/.bashrc`

    _The tilde symbol `~` equals the path of the current user's home directory._
    _E.g. `/Users/IceHe` on my Mac._

    _For getting the path of JDK 8, run the command:_

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
    or [offer free educational licence for students and teachers](https://sales.jetbrains.com/hc/en-gb/articles/207241195-Do-you-offer-free-educational-licenses-for-students-and-teachers-)

    _References: [Free Educational Licenses](https://www.jetbrains.com/community/education/#students) / [学生授权申请方式](https://sales.jetbrains.com/hc/zh-cn/articles/207154369-学生授权申请方式)_

1.  Synchronize the settings

    Recommend to [configure a settings repository](https://www.jetbrains.com/help/idea/sharing-your-ide-settings.html#settings-repository)
    for sharing the same settings accroos multiple JetBrains's accounts

    1. `File` → `Manage IDE Settings` → `Settings Repository…`
    1. Input HTTPS URL of the settings Github repository
    1. Input the Github access token

    _But cannot synchronize the plugins in this way. So the next step is to…_

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

Trackpad

- Set `Tracking speed` Max

Notification

- Disable useless Apps notifications on demand

Users & Groups

- Configure `Login Items` ( 开机启动程序 )

### Apps

#### 1Password

1. Login the 1Password account or unlock the vaults from the cloud. _E.g. iCloud_

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

_E.g. I run the commands below:_

```bash
cd ~
git init

# Recommend to pull via HTTPS at the first time
git remote add origin https://github.com/IceHe/mac-conf.git
git pull origin master

# Pull via SSH after the first time
# ( Require local Git SSH key, so configure it later )
git remote set-url origin git@github.com:IceHe/mac-conf.git
git pull
```

#### Sogou Input

1. Login via the WeChat acount
1. Add `Sogou Input` in `System Preferences` → `Keyboard` → `Input Sources`

#### Karabiner-Elements

1. Synchronize the settings via the configuration file
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

1.  Synchronize the settings via the built-in feature [Settings Sync](https://code.visualstudio.com/docs/editor/settings-sync)

1.  Install the extensions

    -   [markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint): Check Markdown style
    -   [Markdown Preview Enhanced](https://marketplace.visualstudio.com/items?itemName=shd101wyy.markdown-preview-enhanced)
        ( [PlatUML](http://plantuml.com) real-time rendering in Markdown code blocks )
    -   [PlantUML](https://marketplace.visualstudio.com/items?itemName=jebbs.plantuml): Support [PlatUML](http://plantuml.com/) _( *.puml file )_
    -   [Vim](https://marketplace.visualstudio.com/items?itemName=vscodevim.vim): Vim emulator - edit text like Vim

#### Sublime Text

1. Synchronize the settings via the plugin [Sync Settings - Package Control](https://packagecontrol.io/packages/Sync%20Settings)

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
    - Set `Minimum Font Size` **15**
    - Select `Auto-Scroll to Last Selected After List Change`
- `Window Position` → `Open at Active Screen`
- `Search Field`
    - Enable `Toggle Search Filters with ⌘F`
    - Eanble `Search Immediately After Each Keystroke`
- `Keyboard Shortcuts…`
    - `Global Shortcuts`
        - Set `Open window` **⌥V**
        - Set `Paste current clipboard item as plain test` **⇧⌘V**
    - `Local Shortcuts`
        - Set `Switch to 'All' list` **⇧⌘A**
- Enbale `Get Titles of Web URLs`
- Enable `Reject Duplicates`
- `Auto-Delete Unstarred Items` → `Auto-Delete Oldest…`
    - Store only the most recent `1000` unstarred items…

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

- Login via the QQ account

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
    git config --global user.name IceHe
    git config --global user.email icehe.me@qq.com
    ```

1. Validate

    ```bash
    $ git config --global -l | grep user
    user.name=IceHe
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
