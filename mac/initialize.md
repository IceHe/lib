# Mac Initialize

- Based on macOS
- For Java developers

## Install

### Over the Wall

若所需软件无法下载，或者速度太慢，可能需要「番羽土啬」，方法如下

1. 连接网络
2. 打开「系统偏好设置」
3. 「网络」
4. 「高级…」
5. 「代理」
6. 勾选「自动代理配置」
7. 找到「URL:」文本框（在「代理配置文件」下面）
8. 填写 ~~`http://url/to/proxy.pac`~~（PAC 文件的网址 TODO）
9. 点击「好」

参考：[PAC](https://baike.baidu.com/item/PAC/16292100)（代理自动配置）- 百度百科

### Homebrew

[macOS 包管理器](https://brew.sh/)，用于安装 & 管理 macOS 的命令行工具以及 Apps ，命令为 `brew`

步骤

- 安装 Homebrew

```bash
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
```

- 查看版本（确认是否安装有误）

```bash
brew --version

# 输出（以当前最新版本为准）
# Homebrew 1.7.2
# Homebrew/homebrew-core (git revision 27f23; last commit 2018-08-24)
```

### JDK 8

安装 [Java Development Kit](https://en.wikipedia.org/wiki/Java_Development_Kit) 版本 8（ [历史](https://en.wikipedia.org/wiki/Java_version_history#Java_SE_8) ）

- 推荐：命令行安装（如下）
- 备选：官网下载使用「Mac OS X x64」版本的 [最新安装包](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html)

命令行安装步骤

- 配置软件源

```bash
brew tap caskroom/versions
```

- 安装 JDK 8
    - 注意：中途需要输入当前 macOS 登入用户的密码！
    - 若需最新版本 Java 10+ ，则用命令 `brew cask install java`

```bash
brew cask install java8
```

获取 JDK 路径

- 若是了解最新版本，则用命令 `/usr/libexec/java_home`

```bash
/usr/libexec/java_home -v 1.8

# 输出（以当前最新版本为准）
# /Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
```

配置环境变量 JAVA_HOME

- 在 ~/.bashrc 文件中（的合适位置）添加如下命令
    - 若文件 ~/.bashrc 不存在，则创建之
    - 若使用的 Shell 并非默认的 Bash ，而是 Zsh 则在 ~/.zshrc 文件中添加
        - 其它 Shell 操作类似

```bash
export JAVA_HOME=`/usr/libexec/java_home -v 1.8`
```

> 波浪号 `~`
>
> - 路径 `~/.bashrc` 中的 `~` 是命令行中「当前登入用户的用户根目录」的缩写
> - 在 macOS 中，用户根目录为 `/Users/[username]` 例如 `/Users/icehe`

### CLI

> 命令行

使用 `brew` 另行安装命令行工具

- 即使 macOS 已经预装了基本的命令行工具
- 但是它们只随着 OS 更新而更新，更新频率低，版本相对滞后

务必安装

```bash
brew install cmake coreutils curl except gawk git gradle groovysdk jq maven ruby vim wget
```

更新方法

- brew update ：更新 Homebrew 自身 & 软件源
- brew upgrade ：更新由 Homebrew 管理的软件

```bash
brew update && brew upgrade
```

若遭遇如下错误

```bash
# 输出
xcrun: error: invalid active developer path (/Library/Developer/CommandLineTools), missing xcrun at: /Library/Developer/CommandLineTools/usr/bin/xcrun
```

则尝试运行以下命令，然后重新执行之前的命令

```bash
xcode-select install
```

> 命令行工具列表 & 说明
>
> - [autoconf](https://www.gnu.org/software/autoconf/autoconf.html)
>     - produce shell scripts to automatically configure software source code packages
> - [cmake](https://cmake.org/)
>     - an cross-platform family of tools designed to build, test and package software
> - [coreutils](http://www.gnu.org/s/coreutils/)
>     - the basic file, shell and text manipulation utilities of the GNU operating system
>     - 包含许多实用命令，详见 [GNU Coreutils](https://www.gnu.org/software/coreutils/manual/coreutils.html) 的目录，例如 [realpath](http://man7.org/linux/man-pages/man1/realpath.1.html) 用于获取文件或目录的绝对路径
> - [curl](https://curl.haxx.se/)
>     - transfer data with URLs
>     - 常用于：HTTP 接口调试、文件下载
> - [except](https://linux.die.net/man/1/expect)
>     - programmed dialogue with interactive programs
>     - 基于它撰写脚本，可以与交互式程序进行应答
>     - 常用于：远程登录
> - [gawk](https://linux.die.net/man/1/gawk) ( awk )
>     - pattern scanning and processing language
>     - 常用于：文本格式化、日志分析
> - [git](https://git-scm.com/)
>     - 分布式代码版本管理系统
>     - 用于：配合 GitLab 管理代码
> - [gradle](https://gradle.org/)
>     - a build automation tool focused on flexibility and performance
>     - 常用于：基于 *.gradle 配置对 Java、Groovy 项目进行自动构建
> - [groovysdk](http://www.groovy-lang.org/)
>     - A multi-faceted language for the Java platform
>     - 常用于：单元测试（ [Spock](http://spockframework.org/) 框架 ）以及部分 Java 项目
>     - 注意：安装的是 Homebrew 的 groovysdk 包，而非 groovy 包，原因详见 [Stack Overflow](https://stackoverflow.com/questions/41110256/how-do-i-tell-intellij-about-groovy-installed-with-brew-on-osx/41111852)
>     - 附注：IntelliJ IDEA（ IDE ）如何给 Groovy 编写的项目添加 SDK 支持，参考 [链接](https://www.bonusbits.com/wiki/HowTo:Add_Groovy_SDK_to_IntelliJ_IDEA)
> - [jq](https://stedolan.github.io/jq/)
>     - a lightweight and flexible command-line JSON processor
>     - 常用于：JSON 的格式化、数据操作，例如「切片、过滤、map、改变结构」
> - [maven](https://maven.apache.org/)
>     - a software project management and comprehension tool
>     - 常用于：基于配置文件 pom.xml 对 Java 项目进行管理
> - [ruby](https://www.ruby-lang.org/en/)
>     - Ruby 编程语言
>     - 其包管理器 `gem` 常用于：运行某些软件的安装脚本
> - [vim](https://www.vim.org/)
>     - 「编辑器之神」Vim（ 与之对应的是「神的编辑器」Emacs ）
>     - 常用的命令行文本编辑器
>     - 备选：`nvim` 即 [Neovim](https://neovim.io/)
> - [wget](https://www.gnu.org/software/wget/)
>     - 通过 HTTP/HTTPS、FTP/FTPS 协议，下载文件

### IntelliJ IDEA

[官网](https://www.jetbrains.com/idea/) 下载 [最新版本](https://www.jetbrains.com/idea/download/#section=mac)

- 选择版本：**Ultimate**

获取软件使用许可

- 购买官方的 [License](https://www.jetbrains.com/idea/buy/#edition=commercial)（若财力允许，请支持正版）
- 或者：淘宝购买 License
- 或者：temp workaround - [Ref 1](http://idea.lanyus.com/) / [Ref 2](https://www.jianshu.com/p/f404994e2843)

安装插件

- [Maven Helper](https://plugins.jetbrains.com/plugin/7179-maven-helper)
- [Lombok Plugin](https://plugins.jetbrains.com/plugin/6317-lombok-plugin)

> [Project Lombok](https://projectlombok.org/)
>
> > It is a java library that automatically plugs into your editor and build tools, spicing up your java.
> >
> > Never write another getter or equals method again. Early access to future java features such as val, and much more.
>
> 可选插件
> - [PlantUML integration](https://plugins.jetbrains.com/plugin/7017-plantuml-integration)
>     - 不时需要绘制 UML 图，以便文档展示，通常使用 [PlatUML](http://plantuml.com/)
> - [IdeaVim](https://plugins.jetbrains.com/plugin/164-ideavim)
>     - 使用 Vim 的操作方式进行编辑，推荐 Vim 重度用户使用
>
> IDE 的取舍
>
> - 使用统一的 IDE 及其配置，便于协作
>     - 统一代码风格，统一代码格式化的规则
>     - 功能和操作方法基本一致，互相帮忙使用别人电脑时阻碍小
>     - 使用相同的工具，有利于传授积累相关经验
>     - ……

### Mac Apps

#### Common

即时通讯

- [Mac QQ](http://im.qq.com/macqq/)
- 手机客户端
    - 推荐：[TIM - 专注团队沟通协作](https://tim.qq.com/download.html)（官方精简版 QQ）
    - 备选：[Mobile QQ](http://im.qq.com/mobileqq/)（完整版）

邮箱

- Mail
    - macOS 自带邮箱客户端
- [Microsoft Outlook](https://products.office.com/zh-cn/outlook/email-and-calendar-software-microsoft-outlook?tab=tabs-1)（付费）
    - 使用 Outlook 客户端便于设置 Outlook 邮箱服务端的邮箱规则
        - 邮件数量较多，建议自行设置邮箱规则
        - 建议购买 [Office 365](https://products.office.com/zh-cn/compare-all-microsoft-office-products?tab=1) ，其中包含 Outlook 的服务

浏览器

- [Chrome](https://www.google.com/chrome/)

命令行终端

- [iTerm2](https://www.iterm2.com/)
    - 远比 macOS 自带的 Terminal 好用

文本编辑器

- [VS Code](https://code.visualstudio.com/)（推荐）
    - 易用、免费、开源
    - 胜任 [Markdown](https://docs.gitlab.com/ee/user/markdown.html) 编辑
        - [markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint) ：语法风格检测
        - [Markdown Preview Enhanced](https://marketplace.visualstudio.com/items?itemName=shd101wyy.markdown-preview-enhanced)
            - 支持 Markdown 代码块中 [PlatUML](http://plantuml.com/) 源码对应 UML 图的实时预览
    - 胜任 [PlatUML](http://plantuml.com/) 绘制
        - 需安装插件 : [PlantUML](https://marketplace.visualstudio.com/items?itemName=jebbs.plantuml)
    - 进阶：可使用 Vim 操作方式编辑文本
        - 需安装插件 : [Vim](https://marketplace.visualstudio.com/items?itemName=vscodevim.vim)
- [Sublime Text](https://www.sublimetext.com/)
    - 轻量易用，提供免费版
    - 冷启动快如闪电（是竞品中最快的）
    - 自带 Vintage 模式：可用 Vim 操作方式编辑文本

#### Recommended

Chrome 插件

- [OneTab](https://chrome.google.com/webstore/detail/onetab/chphlpgkkbolifaimnlloiipkdnihall) ：当打开的标签页过多时，可暂存到 OneTab 的列表中，节省内存、简洁展示
- [uBlock Origin](https://chrome.google.com/webstore/detail/cjpalhdlnbpafiamejdnhcphjbkeiagm) ：轻量级的广告过滤器
- [JSON Formatter](https://chrome.google.com/webstore/detail/bcjindcccaagfpapjjmafapmmgkkhgoa) ：JSON 数据的格式化展示
- [Proxy SwitchyOmega](https://chrome.google.com/webstore/detail/padekgcemlokbadohgkifijomclgjgif) ：方便快捷地管理、切换多个代理服务
- [cVim](https://chrome.google.com/webstore/detail/ihlenndgcmojhcghmfjfneahoeklbjjh)（ 进阶 ）：使用类似 Vim 的操作方式，浏览网页

剪贴板管理（多选一）

- 建议安装的原因
    - 复制粘贴时，经常需要在多个页面和 Apps 之间反复切换
    - 剪贴板管理工具可以减少不必要的重复操作，大大提高效率
- [Paste 2](https://pasteapp.me/)
    - 优点：简洁、美观、易用，可搜索剪贴板历史，而且可试用
    - 缺点：图形界面占用空间较大，信息展示效率不高
- [Copy'em Paste](http://apprywhere.com/copy-em-paste.html)
    - 定制化程度更高
- 略

英语词典

- 词典 Dictionary
    - macOS 默认自带，够用
- 二选一
    - [欧路词典](https://www.eudic.net/v4/en/app/eudic)（推荐）
    - [有道词典](https://itunes.apple.com/cn/app/you-dao-ci-dian/id491854842?mt=12)

API 开发环境

- [Postman](https://www.getpostman.com/)
    - 常用于：调试 & 测试 HTTP API
    - 可用 `curl` 命令行替代，但不如专用软件便捷

思维导图（多选一）

- [MindNote](https://mindnode.com/)（推荐）
- [XMind](https://www.xmind.net/)
- 略

参考 Mac :

- [Tools](marks/tools/README.md) : 利器 - 软件 / 物件的推荐
- [Efficiency](mac/efficiency.md) : 效率指南
- [Shortcuts](mac/shortcuts/README.md) : 快捷键

## Config

包括

- 本地 & 远端的开发环境配置

### Git

Git 配置 用户名 & 邮箱

- 用途：Git 根据 username 关联每次代码提交和提交它们的用户
    - 配置 Git 用户名 & 邮箱
    - `[邮箱]` 例如 icehe@gmail.com
    - `[邮件前缀]` 例如 icehe

```bash
git config --global user.name [邮箱前缀]
git config --global user.email [邮箱]

# 例如
# `git config --global user.name icehe`
# `git config --global user.email icehe@gmail.com`
```

查看设置（确认内容）

```bash
git config --global -l | grep user

# 输出（以您的设置为准）
# user.name=icehe
# user.email=icehe@gmail.com
```

### Git* Repo

为代码仓库添加 SSH 公钥（例如 GitHub / GitLab）

- 优点：无需本地记录账号密码或重复输入，即可执行拉取、推送代码等操作
- 生成 & 获取 SSH 密钥（ 公钥 + 私钥 ）

生成和添加的步骤

- 生成新的 SSH 密钥对

```bash
ssh-keygen -t rsa -C "[邮箱前缀]@gmail.com" -b 4096

# 例如
# `ssh-keygen -t rsa -C "icehe@gmail.com" -b 4096`
```

- ssh-keygen 的命令行会多次提示你进行输入，如下
    - Enter file in which to save the key (/Users/[用户名]/.ssh/id_rsa):
    - Enter passphrase (empty for no passphrase):
    - Enter same passphrase again:
- 都敲回车键「↩」即可（ 无需其它输入 ）
- 如果本地已存在默认 SSH 密钥对，命令行会提示

```bash
# 输出
/Users/[用户名]/.ssh/id_rsa already exists.
Overwrite (y/n)?
```

- 建议输入「y」，重新生成

- 将公钥复制到系统剪贴板

```bash
pbcopy < ~/.ssh/id_rsa.pub
```

- 进入个人 Settings 的 SSH Keys 页面 ( 自行查找 )
- 将剪贴板中的公钥信息，粘贴到「Key」文本输入框中（ Title 文本框将会被自动填充 ）
- 然后点击「Add key」即可

### Maven

Maven 配置

- 打开 Maven 配置文件模板 [~~settings.xml~~](todo/settings.xml)（TODO），**复制** 其内容
- 打开本地的配置文件，**粘贴覆盖** 原来的内容
    - `open` 命令：使用默认的文本编辑器打开
    - 注意：若使用私人设备办公，设备已存在有效的 Maven 配置，请谨慎地人工合并 settings.xml 的内容

```bash
open ~/.m2/settting.xml
```
