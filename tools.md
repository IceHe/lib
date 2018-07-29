title: 利器 - 软硬件推荐
date: 2015-11-21
updated: 2018-04-19
categories: [mac]
tags: [mac]
description: tools&#58; 推荐 macos 和 ios 的 apps 以及日常使用的电子产品。
---

{% cq %}
君子生非异也，善假于物也。

__荀子__
{% endcq %}

## 说明

- __主要介绍 macOS、[iOS](#iOS) 的 Apps__（下文 Apple 指代 macOS + iOS）；提及一点 [Windows](#Windows)。
    - 适合自己的工具，才是最好的工具，所以本文仅供参考，自行尝试最重要。
    - 笔者是工具控，目力之内看起来还有点用的工具都会折腾过一遍。
        - 过程中浪费了许多时间精力在很少派上用场甚至无用的工具上。
        - 善于发现生活中关键的效率瓶颈，再根据需求寻找或创造工具就足够了。
        - 因为折腾工具而忘记了把事做成的初心，实在是南辕北辙（笔者便是前车之鉴）。
- __App 选择原则__
    - 「常用」的工具才值得折腾，不常用的凑合着用就行了。
    - 「实用」最重要，美观次之，价格别太贵就行。
    - 「稳定」：不能时常引起系统崩溃，起码提升效率的收益得超过操作系统崩溃重启的损失。
    - 「简洁易用」：满足实际的需求即可，不需要花哨、多余的功能。
        - 「开箱即用」是工具最好的状态。
        - 参考 KISS 和 SR 原则（keep it simple stupid & single responsibility）。
    - 「设置项齐全」：可以根据自身习惯调整 App，让它用起来更顺手、省心。
        - 开箱即用虽好，但也认同为了极致高效或完成复杂工作的工具提高复杂度，如 IDE、PS。
        - 不过设置项合理、足够就行，不一定非要很齐全。
        - 比如，设置好各常用功能的快捷键，以便调用；或将流程变得更自动化，以节省时间和精力。
- 笔者相关文章
    - 《[Mac 效率指南](/mac/efficiency)》
    - 《[Mac 快捷键](/mac/shortcuts)》
- 参考阅读
    - [__少数派__](http://sspai.com/) - 高质量 App 推荐媒体，关于 iOS、Mac、硬件。
    - [__Best App__](https://github.com/hzlzh/Best-App) - List in GitHub
- 字体格式的含义
    - ~~删除线~~ 标识的一定是我现在不用的 Apps。

---

## 软件

### 常用

- 网络访问
    - [__Shawdowsocks__](https://portal.shadowsocks.to/) <sup>Ladder</sup>
        - 首选的科学上网（番羽土啬）方案：
            Shadowsocks 服务 + Mac 的 [__ShadowsocksX-NG__](https://github.com/shadowsocks/ShadowsocksX-NG) + 浏览器的 proxy 类插件：
            如 Chrome 的 [__SwitchyOmega__](https://chrome.google.com/webstore/detail/proxy-switchyomega/padekgcemlokbadohgkifijomclgjgif?hl=en)；可用 [__Surge__](https://nssurge.com/) 替换 ShadowsocksX-NG。
        - 备选方案：[VPN](https://www.cup.com/staticip/?=panda) + [CHNRoute](https://github.com/fivesheep/chnroutes) + [Dnsmasq](http://www.thekelleys.org.uk/dnsmasq/doc.html)。
    - [__Chrome__](https://www.google.com/chrome/)
        - 配合 [__cVim__](https://chrome.google.com/webstore/detail/cvim/ihlenndgcmojhcghmfjfneahoeklbjjh) 拓展，可在浏览器内 __使用 Vim 键位__ 浏览网页、操作浏览器！键盘党神器。
            - 可惜它无法在页面未加载完毕的情况下使用 Vim 键位，不够（[Firefox](http://www.firefox.com.cn/) + [VimFX](https://github.com/akhodakivskiy/VimFx)）极致！
        - 用 __Inspect Element__（审查元素）配合 __Postman__ 等做 Web 开发、调试，比 Firefox 顺手。
- 常用
    - [__Trello__](https://trello.com/) <sup>Favorite</sup>
        基于 Board 的事务管理。
        - 使用 board 看板、list 列表、card 卡片等，组织事务；
        - 使用 description 描述、comment 评论、attachment 附件等，跟踪记录事务内容；
        - 根据 事务内容、label 标签、due date 截止期限等，考虑事务的优先次序。
        - 我在现实管理工作项目的过程中，GitLab Issue Board 的应用，给我带来了很大的帮助。虽然那段时间很忙，但我还是有条不紊地推进了我和同事间的分工协作。自此迷上了使用 Board 的方式去管理事务。
        - 类似的产品很多，Trello 是最简洁、好用、易上手的，这是我用它的关键原因。Slack 的服务被墙，在移动端访问不便（而 Trello 没被墙）；而国内的模仿者们则做得太复杂了，可能因为他们主攻 toB 的市场，不适合我这样的个人用户来使用，所以无爱。
    - [__2Do__](https://www.2doapp.com/) <sup>Powerful</sup>
        GTD 事务管理。
        - 功能齐全、好用，用法可简可繁。快捷键完备！
        - 推荐使用 iCloud Reminders 的 CalDAV 同步方式（支持 2Do 绝大部分特性，足以满足我的需求）；Dropbox 的同步方式虽然可以支持 2Do 的所有特性，可是需要翻墙才能同步数据，iPhone 需要长期开着 VPN 略显麻烦。所以为了稳定和省心，选择了前一种同步方式。
    - __双拼输入方案__ <sup>Favorite</sup>
        高效，易学！比五笔容易掌握得多，对比全拼，输入效率显著提升，十分值得学习。
        - 《[做少数派中的少数派：双拼输入快速入门](http://sspai.com/32809)》
        - 《[选择输入法的哲学：兼论双拼的优缺点](http://sspai.com/33019)》
    - [__1Password__](https://agilebits.com/onepassword) <sup>Privacy</sup>
        帐号密码管理，以及私人信息的加密存储。
        - 用一（两）个主密码管理所有其它密码。可生成随机密码，可记录登录网站时用的帐号密码，可自动填写表单登录网站。
        - 以前一直用不惯，觉得用浏览器自带的自动登录和 iCloud 的 [__KeyChain Access__](https://support.apple.com/kb/PH20093?locale=zh_CN) 来记录管理帐号和密码足矣，可是不便于保存一些私人信息。工作之后，经济独立，更加注意保护个人隐私和财产安全了，要管理的私人信息多而杂乱，所以不得不借助专用的工具。
        - 其它选择：
            - [__KeyChain Access__](https://support.apple.com/kb/PH20093?locale=zh_CN)：macOS & iOS 原生支持，方便免费。
            - [__Dashlane__](https://www.dashlane.com/)：好用，但贵。
            - [__LastPass__](https://lastpass.com/)：够用，免费。
    - [__Outlook__](https://outlook.live.com/owa/)
        邮箱客户端，微软出品。
        - 方便设置在邮箱服务器生效的邮件规则（因为公司邮箱用 Outlook 的服务）。
            自动处理，屏蔽干扰，提高邮件处理效率。
            - 将不同类型邮件归类到不同文件夹；
            - 将可以忽略的邮件标为已读；
            - 自动删除无用邮件。
- 笔记
    - [__MindNode__](https://mindnode.com/) <sup>Flexible</sup>
        思维导图，归纳总结笔记。
        - 操作简便易上手，轻巧稳定。
        - 我原来用 Markdown 线性列表来做记录、归纳、总结，但是这样的话，内容再组织实在不灵活，不如思维导图灵巧。
    - [__Notes__](https://support.apple.com/kb/PH22609?viewlocale=en_US&locale=en_JO) <sup>Simple</sup>
        Apple 自带的轻量级笔记应用。
        - 用于收集灵感和想法，做书摘、读书笔记和日记。因为它启动迅速，使用稳定便捷，所以更常使用它而非 Evernote。
    - [__~~nvALT~~__](http://brettterpstra.com/projects/nvalt/) <sup>Casual</sup>
        macOS 上的草稿处理中心。随叫随到（快捷键齐备），迅速记录（操作简洁），检索便捷。
        - 如果我用 Sublime Text 做一些随意的文字记录，要保留久一点都得保存成文件，难免在显眼的地方（例如桌面）看到一堆临时文件，过后的清理也麻烦，怕不小心删掉了别的有用的文件。
        - 用 nvALT 的话，它会统一在暗处做文字记录的整理（除非导出文件），眼不见为净。
    - [__Notion__](https://www.notion.so/) <sup>Checklist</sup>
        用作 __checklist__（检查清单）。
        - 我只用它来复用自己的 checklist 模板。例如，每天的早上起床、晚上回住处要做的杂务流程，以及出行的行李清单等 checklist。（虽然功能强大，但操作不够便捷，数据同步不尽如人意）
        - 原来我用 Evernote 来复用 checklist 模板，可是在 check 勾选、uncheck 反选复选框，以及浏览 checklist 的过程中，很容易唤起键盘，可以说相当烦人，而 Notion 则不会有这样的体验。
    - [__Evernote__](https://www.yinxiang.com/) <sup>Rec Offline, RIL</sup>
        云笔记，第二大脑（知识管理）。
        - 好记性不如烂笔头，而如今知识更新之快，纸笔已跟不上，于是笔记软件大放异彩。云端存储同步笔记（同时定期备份整个硬盘），有备份就不怕丢；便于检索，甚至搜索图片中的文字。总是死记硬背没有出路，不能被检索的知识毫无意义。
        - 现在觉得值得离线记录的东西不多了，用 Google 搜索更便捷，而且还能获得更新更好的资料；值得沉淀的知识不断更新记录在博客就够了。
        - 现在我主要将它作为 Read It Later（RIL）类 App 来用。
            - 用法：[__剪藏__](https://evernote.com/intl/zh-cn/webclipper/)、微博 [__@我的印象笔记__](http://weibo.com/u/2859258962)、微信分享给 __我的印象笔记__、[邮件收藏](https://help.evernote.com/hc/zh-cn/articles/209005347-%E5%A6%82%E4%BD%95%E4%BF%9D%E5%AD%98%E9%82%AE%E4%BB%B6%E8%87%B3Evernote) 等。
        <!-- - 从许多备选中选择了 Evernote，是因为它提供了最为开放的可编程 API，我可以写脚本定制进阶的笔记操作。 -->
        - 其它选择：
            - [__~~有道云笔记~~__](https://note.youdao.come)：Evernote 迁移到其它平台比较简单，但 [有道云笔记](https://note.youdao.come) 导出的笔记格式经过加密、无法通用，很难迁移到别的平台，所以不推荐使用
            - [__为知笔记__](http://www.wiz.cn/)、[__Leanote__](https://leanote.com/)、[__Notion__](https://www.notion.so) …

### 命令行

- 代码管理
    - [__Git__](https://git-scm.com/) <sup>Required</sup>
        分布式代码版本管理系统（必学）。
- 编辑器
    - [__Vim__](http://www.vim.org/) <sup>God-like</sup>
        编辑器之神（ Emacs 则是神的编辑器 ）。
        - 服务器通常是 *nix 系统，vi* 是标配，而 Emacs 不常有。服务端开发和运维人员经常要在远程服务器编辑文本，遂 vi\* 是必备技能！
        - 大的项目还是使用专用 IDE 进行编写更便捷靠谱。IDE 装个 plugin 也能以 Vim 的方式高效地操作，Vim 通用的键位可以让你少记很多必要的 IDE 快捷键。
        - 在命令行之外，Sublime Text 原生支持 Vim 的基本操作，VS Code 插件支持 Vim 操作。
        - Vim vs. Emacs! &nbsp;[What are the main differences between Vim and Emacs?__](https://www.quora.com/Text-Editors-What-are-the-main-differences-between-Vim-and-Emacs)》
        - 其它：《[一年成为Emacs高手（像神一样使用编辑器）](https://github.com/redguardtoo/mastering-emacs-in-one-year-guide/blob/master/guide-zh.org)》
        - 我的配置 [__.vimrc__](https://github.com/IceHe/macos-home-conf/blob/master/.vimrc)
    - [__~~spf13-vim~~__](http://vim.spf13.com/)
        一整套 Vim 配置方案。
        - 比起漫无休止地折腾配置，不如遵从实用主义：站在巨人的肩膀上，直接使用久经考验的的配置方案。
        - 其实你用不上其中的很多功能，而且高配的 [MBP](#Smart) 用它竟然会卡顿！如果只是轻度使用 Vim，那么用熟之后，可以根据个人习惯只在配置文件 `.vimrc` 中简单地自定义一下就够了。

---

- Shell
    - [__Zsh__](http://zsh.sourceforge.net/) <sup>Powerful</sup>
        比 Bash 更强大、便捷、高效的 Shell！
        - 配置 Zsh 比较复杂，可以使用 [__oh-my-zsh__](http://ohmyz.sh/) 等成熟的配置方案。
        - [__Fish__](https://fishshell.com/) ( a shell for the 90s 😂 ) 虽然很好，但存在兼容性问题，有些 Bash 的指令需要改写才能运行在 Fish 上。尝试使用之后，还是更喜欢 Zsh。
        - 参考：[Comparison of Command Shells - Wikipedia](https://en.wikipedia.org/wiki/Comparison_of_command_shells)
        - 我的配置 [__.zshrc__](https://github.com/IceHe/macos-home-conf/blob/master/.zshrc)
    - [__oh-my-zsh__](http://ohmyz.sh/) <sup>Efficient</sup>
        管理 Zsh 配置的开源框架，预打包了相关的主题、插件、配置。
        - 配置过程傻瓜化，一条安装指令就能让你畅快地享受 Zsh 的强大与高效！
        - 我的命令行提示符主题 [__.sunrise_icehe__](https://github.com/IceHe/macos-home-conf/blob/master/.config/zsh/sunrise_icehe.zsh-theme)
    - [__tmux__](https://tmux.github.io/) <sup>Powerful</sup>
        终端多路复用软件，即命令行中的 「桌面」、「分屏工具」。
        - 允许一个用户在一个终端窗口或一个远程终端会话中，使用多个终端会话。
        - [__screen__](https://www.gnu.org/software/screen/manual/screen.html) 命令的替代方案，使用方法基本相同。
        - 我的配置 [__.tmux.conf__](https://github.com/IceHe/macos-home-conf/blob/master/.tmux.conf)

---

- 包管理
    - [__Homebrew__](http://brew.sh/) <sup>Best</sup>
        macOS 的包管理器。`brew` 就如 `agt-get` 之于 Ubuntu，`yum` 之于 RedHat、CentOS 的存在。
    - [__~~Homebrew Cask~~__](http://caskroom.io/)
        安装、更新 macOS Apps 的命令行工具。
        - 用命令行的方式安装、更新 Mac Apps，其中还包括了许多第三方的 Apps。
        - 可以不用忍受 AppStore 缓慢的下载速度，也不必再一一访问各个官网去下载第三方 Apps 了。
        - 重装 macOS 时可以用 `brew cask install` 命令组成的脚本便捷地安装必要的 Apps。
    - [~~dotfiles~~](https://dotfiles.github.io/)
        可供参考的 dotfiles 配置，还有[我的 dotfiles](https://github.com/IceHe/macos-home-conf)。（[dotfiles 是什么？](http://www.jianshu.com/p/7UJapk)）

### 软件开发

- 常用
    - [__IntelliJ IDEA__](https://www.jetbrains.com/idea/) <sup>Master Piece</sup>
    - [__~~PhpStorm~~__](https://www.jetbrains.com/phpstorm/)
        PHP 的最佳 IDE。
        - 现阶段 PHP 类型推导做得最好的 IDE，稳定、崩溃少，功能完善，设置选项齐全。（我觉得）比 ZendStudio、Eclipse 好用多了。
        - 技术支持服务靠谱，客服答复迅速、解决方案有效
        - 配合 [__IdeaVim__](https://plugins.jetbrains.com/plugin/164?pr=idea) 插件可用 Vim 的方式进行操作，可以少记许多执行相同功能的 IDE 快捷键。
            - 我的配置 [__.ideavimrc__](https://github.com/IceHe/macos-home-conf/blob/master/.ideavimrc)
        - [__JetBrains__](https://www.jetbrains.com/products.html) 出品的其它优秀 IDE：[__PyCharm__](https://www.jetbrains.com/pycharm/)、[__WebStorm__](https://www.jetbrains.com/webstorm/)、[__CLion__](https://www.jetbrains.com/clion/)、[__GoLand__](https://www.jetbrains.com/go/) …
    - [__Sublime Text__](http://www.sublimetext.com/) <sup>Fastest</sup>
        代码编辑器。Vintage 模式，可用 Vim 键位进行操作。冷启动也快如闪电！
        - 候选：[__VS Code__](https://code.visualstudio.com/)，开源、持续且活跃的开发，更不必说本身有微软过硬的技术实力背书。
        - 我自定义的 [__keymap__](https://github.com/IceHe/macos-home-conf/blob/master/.config/sublime/Default%20(OSX).sublime-keymap)
        - 我安装的 [__plugins__](https://github.com/IceHe/macos-home-conf/blob/master/.config/sublime/Package%20Control.sublime-settings)
            - __Clickable URLs__：`⌘ ⌥ ↩` 打开光标当前位置的 URL。
            - __Compare Side-By-Side__：文本差异对比。
            - __CTags__：编程语言对象定位器。
            - __Git Gutter__：Git 变更差异（Diff）提示。
            - __HTML-CSS-JS Prettify__：HTML、CSS、JS 内容的格式化
            - __MarkdownEditing__：支持 Markdown 语法高亮和编辑特性。
            - __Package Control__：插件包管理器。
            - __Pretty JSON__：JSON 格式美化、最小化、有效性检查。
            - __TrailingSpaces__、__Trimmer__：去除多余的空格，包括每行内容后面的。
    - [__iTerm2__](https://www.iterm2.com/)
        macOS 下的终端仿真机。是系统默认自带的 Terminal 的最佳替代 App。
    - [__~~Dash~~__](https://kapeli.com/dash)
        查阅 API 参考文档、管理代码片段的工具。功能单一却精准。
- 网络
    - [__Charles__](https://www.charlesproxy.com/) <sup>Best</sup>
        网络封包分析（抓包）工具。如 Fiddler 之于 Windows。主要用于「应用层」的分析。
    - [__Postman__](http://www.getpostman.com/) <sup>Powerful</sup>
        APIs 开发、测试、归档的辅助工具。
        - Mac 的 HTTP 客户端。用于与 REST 服务交互，以助构建 API、HTTP 请求，检查来自服务器的响应。其它选择：[__~~Paw~~__](https://paw.cloud/)
    - [__~~Wireshark~~__](https://www.wireshark.org/) <sup>Powerful</sup>
        网络封包分析工具。比 Charles 强大得多，但是也复杂得多。主要用于「网络层」的分析。
        （并非运维人员，日常工作很少用得着。有益于深入理解学习计算机网络的知识。）
    - [__~~LaunchRocket~~__](https://github.com/jimbojsb/launchrocket)
        安装在 macOS 系统设置面板的 App，通过 `launchd` 管理各式 services。
        - 比使用命令行，更便于启动、终止 services 以及进行 root 授权。
- 数据
    - [__~~Squel Pro~~__](http://www.sequelpro.com/) <sup>Free</sup>
        管理 MySQL 数据库的 GUI 工具。
    - [__~~Transmit~~__](https://panic.com/transmit/)
        FTP 的 GUI 工具。
        （rsync 命令比 FTP 的效率高得多，用法也更丰富。一般情况下传输文件用 netcat 命令也够用。）
- 办公
    - [__Adobe Acrobat Reader DC__](https://get.adobe.com/cn/reader/)
        一般情况下，不使用额外的 __PDF 阅读软件__，Mac 系统自带的 Preview 就够用了。
        - 但在特殊情况下，需要用到 PDF 的一些高级特性，还是 Adobe 家的软件亲自处理更妥当，例如签证申请文件、合同、加密文件等。
    - [__~~Parallel Desktop~~__](http://www.parallels.com/landingpage/pd/general/?src=r&pd11) <sup>Best</sup>
        虚拟机软件。
        - 最适合用于安装 Windows。它将 Windows、Ubuntu 跟 macOS（几乎）无缝对接，使用流畅自然。（我现在完全脱离了 Windows 平台独占的软件，包括游戏，所以几乎用不着它。还有它的软件升级定价策略很不地道，跟重新买差别不大…）
        - 其它选择：[~~Virtual Box~~](https://www.virtualbox.org/)（适合装 Linux），[~~VMWare Fusion~~](http://www.vmware.com/products/fusion.html)（没用过）

### 快捷键

- [__Keyboard Maestro__](https://www.keyboardmaestro.com/main/) <sup>Geek , Best , Favorite</sup>
    高度自定义的效率工具，加速常用操作，甚至自动化。功能强大，用途甚广，限制你的只有你的想象力。
    - 替代用于 __快速启动、切换 Apps__ 的 [__~~Manico~~__](http://manico.im/) <sup>Great</sup>、[__~~Contexts~~__](https://contexts.co/) <sup>Simple</sup>。
        - 我是键盘党，以前用 Windows 时已经习惯用快捷键和鼠标手势迅速打开、切换程序，因此离不开这类工具。
    - 替代用于 __Apps 分屏__ 的 [__~~Moom~~__](https://manytricks.com/moom) <sup>Great</sup>、[__~~Spectacle~~__](https://www.spectacleapp.com/) <sup>Simple</sup>。
        用快捷键等触发分屏操作，按需快速摆放 App 窗口（移动、缩放）。
        - Moom 用久了我形成了固定的习惯，主要用全屏、左右各半、左右 3/5 和居中等少数几种布局，只需要设置几个快捷键来触发对应操作就够了。
        - 参考：《[说说 Mac 分屏的事(2) - Moom 的10个技巧](http://zhuanlan.zhihu.com/MacTips/20258341)》
    - 替代用于 __用缩写加速文本输入__ 的 [__~~TextExpander~~__](https://textexpander.com/) <sup>Great</sup>、[__~~aText~~__](https://www.trankynam.com/atext/) <sup>Simple</sup>。
        输入缩写时，根据用户的设定模板来自动拓展输入的文本，提升输入效率，特别是高频使用的词句。
    - 替代用于 __稳定便捷地切换同一 App 的多个子窗口__ 的 [__HyperSwitch__](https://bahoom.com/hyperswitch) <sup>Best</sup>。
        - 这类应用的出现，是因为在某些 Apps 下，无法用系统的 <code>⌘ \`</code> 来切换其下的各个子窗口。
        - 当然可以用触摸板三指下滑的手势或快捷键触发 App Expose，可以显示当前应用的所有窗口，然后点击选择进行窗口切换，但是不够快捷。
    - 可以替代用于 __剪贴板管理__ 的 [__ClipMenu__](http://www.clipmenu.com/) <sup>Simply , Favorite</sup>、[__~~Paste~~__](http://pasteapp.me/) <sup>Beauty</sup>。
        - 这类应用很多，Keyboard Maestro 在这方面还是做得不够好。
        - Paste 颜值高，可是配置选项不多，不如 ClipMenu 定制性强。ClipMenu 短小精悍，显示紧凑（可能你会觉得丑），快捷键调用方便，响应迅速。
        - 所以，剪贴板方面我还是选用了更合我口味的专用 App __ClipMenu__。
    - 可以替代或补充用于 __自动化流程__ 的 [__Automator__](https://developer.apple.com/library/content/documentation/AppleApplications/Conceptual/AutomatorConcepts/Automator.html) <sup>macOS built-in</sup>
        - 可以编写脚本，控制自动化的理过，调用命令脚本、控制 GUI，判断系统状态如网路、蓝牙、电源连接等…… 减少人工的重复操作。
        - 参考：《 [懒的前提是要足够高效： Mac 效率工具Keyboard Maestro 详解 - 少数派](https://sspai.com/post/28721) 》
- [__Karabiner-Elements__](https://pqrs.org/osx/karabiner/index.html) <sup>Geek , Best , Favorite</sup>
    强大、稳定的键位修改功能，预定义了大量奇巧的修改方案。键盘党神器！
    - 可自定义快捷键去启动、切换 App，打开文件和网址，快速输入关键词跳转到网站的搜索页，甚至运行 Shell 命令行。发挥想象力，配合上述的 Keyboard Maestro，还能做到更多的事。除了「键位修改」，其它繁杂的功能最好交给 Keyboard Maestro 或者 Shell 脚本来完成，用起来省心。
    - 我的配置 [__karabiner.json__](https://github.com/IceHe/macos-home-conf/blob/master/.config/karabiner/karabiner.json)
- __Karabiner Event-Viewer__
    键盘码查询。不用查表，直接击键，即得出对应的键盘码和按键组合等。
    - 是 Karabiner-Elements 附带 App，用于调试键位、快捷键组合。
- [__~~CheatSheet~~__](https://www.mediaatelier.com/CheatSheet/) <sup>Tips, for freshman</sup>
    快捷键快速提醒。长按 Command 键，显示当前程序的快捷键列表，方便快速入门 Mac 各处的快捷键。（新手专用）

### 系统增强

- [__Amphetamine__](https://itunes.apple.com/us/app/amphetamine/id937984704?mt=12)
    防止 Mac 休眠。
    - 原因：Mac 每次休眠后都会重启软件，导致软件丢失部分上下文，于是我无法在完全一样的环境下持续工作，一定程度上打断了工作，降低了效率。
    - 休眠（Sleep）：硬盘休眠。
        屏幕休眠（Display Sleep）：即关闭屏幕，连屏幕保护程序（Screen Saver）也不运作。
    - 其它选择：它比同类软件 [~~Caffine~~](https://itunes.apple.com/us/app/caffeine/id411246225?mt=12)、[__~~Owly~~__](https://itunes.apple.com/us/app/owly-display-sleep-prevention/id882812218?mt=12) 功能完备、好用；[~~InsomniaX~~](http://semaja2.net/projects/insomniaxinfo/) 没用过。
- [__Bartender__](https://www.macbartender.com/)
    收起或彻底隐藏毋需过多关注的菜单栏 App 图标。（我这个整洁癖、强迫症的福音）
    - 不推荐购买 [~~Vanilla~~](http://matthewpalmer.net/vanilla/)，使用简便，自然配置项有限，最主要因为功能的实现方法不合理以致有 bug，例如会遮蔽菜单栏的一些别的内容，又如某些图标不能符合预期地显示或隐藏。
- [__~~ClipMenu~~__](http://www.clipmenu.com/) <sup>Simple</sup>
    剪贴板管理。
    - 主要用于快速查询剪贴板的历史记录，并提取出需要的内容保存到当前的剪贴板中。
    - 支持 URL、纯文本、RTF、图片、文件等各种格式，包括剪贴历史的排序、内容的大小写转换、自定义文本的调用。
- [__Copied__](https://copiedapp.com/) <sup>Favorite, Searchable</sup>
    剪贴板管理。（2018-04 开始尝试用它替代 ClipMenu）
    - 不同于 ClipMenu 的简单，它拥有丰富完备的功能。
    - 剪贴板历史搜索：便于迅速查找内容，最常用！
    - 格式化模板：以纯文本、HTML 或 Markdown 格式输出，同时输出 URL 以及对应网页的标题等。
    - 匹配规则：纯数字、URL 链接等，分别保存到不同的列表，应用不同的格式化模板。
    - App 定制规则：来自不同 App 的内容，分别保存到不同的列表，应用不同的格式化模板。
    - Queue（队列）：先入先出地输出内容（平时默认：后入先出）。
    - 其它选择：[__Paste__](http://pasteapp.me/) 最好看！这类 App 层出不穷…
- [__PopClip__](http://pilotmoon.com/popclip/)
    快捷工具条。
    - 在选中文本是弹出，辅助操作的工具条，包括：搜索、查字典、剪切、复制、粘贴等。
    - TODO
- [__HyperSwitch__](https://bahoom.com/hyperswitch) <sup>Best</sup>
    稳定切换同一 App 下各子窗口。
    - HyperSwitcher 选择切换的窗口时，会显示各应用的缩略图。
    - 可以用 [Keyboard Maestro](/tools/#Shortcuts) 来实现同样的功能以替代它。
    - 相关 App：[~~HyperDock~~](https://bahoom.com/hyperdock/)
        窗口增强工具。光标停到 Dock 的 App 图标上，能快速预览该软件的所有窗口，点击切换到不同的窗口或桌面。还有快速调整窗口布局、大小、位置等的功能。
        - 用处还是不大，用 HyperSwitcher 切换子窗口时就能看到 App 下所有子窗口的预览图。
- [__KeyCastr__](https://github.com/keycastr/keycastr)
    键盘输入可视化：在显示屏上会显示你的键盘敲击动作，包括使用快捷键组合。
    - 主要用于展示你如何（用快捷键）高效地使用电脑。
- [__Itasycal__](https://www.mowglii.com/itsycal/) <sup>Simple</sup>
    菜单栏上的日历小工具。自定义日期时间显示的格式，方便查看月历和事件！
- [__Quick Look plugins__](https://github.com/sindresorhus/quick-look-plugins)
    增强 Finder 的文件预览（Preview）功能。
    - 在 Finder 浏览目录和文件时，选中文件，再按空格键，即可进行简单的预览。
    - 该插件提供各种类型文件的预览功能：快速预览各种格式的图片，包括 GIF；对各种不同编程语言的代码进行着色，便于查看… 详情查看其 [GitHub 仓库 README.md](https://github.com/sindresorhus/quick-look-plugins) 的说明。
- [__~~ShawdowsocksX~~__](http://macappstore.org/shadowsocksx/) <sup>No update</sup>
- [__ShawdowsocksX NG__](https://github.com/shadowsocks/ShadowsocksX-NG) <sup>Ladder</sup>
    ShadowsocksX 是在 Mac 上配合 Shadowsock 工作的软件。NG 是后人维护的版本。
- [__ShowyEdge__](https://pqrs.org/osx/ShowyEdge/index.html.en) <sup>Great</sup>
    输入法状态提示。
    - 显示一条样式可定制的色带在屏幕顶部，以提示正在使用什么输入法。在全屏使用 App 时，也能轻易区分输入法状态！
    - 就好像盲插 USB 接口可能要插三次才成功，感觉很糟糕。随时都能便捷地确认输入法所处的状态，可以减少多余的输入法切换操作和误输入后的回退操作。
    - 我输入英文只使用默认的「U.S.」input source，输入中文只使用「拼音输入法」，切换「中/英」输入只要直接切换输入法就好了。
        - 我不想只用「拼音输入法」，然后在一种输入法下进行中英输入切换。这时中英切换通常只需要用一个键 `⇧`、`^` 或 `⇪`，看似操作很方便，但也容易「误操作」，使用大量使用快捷键时就很不便，特别是在用 Vim 的方式进行编辑时，误操作几率非常高！
- [__Time Machine__](https://support.apple.com/en-hk/HT201250) <sup>Required</sup>
    macOS 自带的系统备份、恢复软件。
    - 要有忧患意识，不要等硬盘坏了、Mac 丢了，才追悔莫及。
- [__~~Time Out~~__](http://www.dejal.com/timeout/) <sup>Health , Protect Eyes!</sup>
    定时作息提醒工具。定时遮盖桌面的应用程序，提醒你离开电脑，去休息眼睛、活动身体。
    - 如人饮水，冷暖自知。自己多注意就好，要是实在不自觉，这个应用才有用武之地；其实真到了严重的程度，它也帮不到你了。
    - 其实我有一个个人的休息方式：因为我比较容易口渴，所以经常喝水；饮水量大就经常上洗手间，自然会多走动，不久坐。
- __Dictionary__ <sup>Great</sup>
    macOS 系统自带的字典应用，足够好用。
- [__EuDic Free__](http://www.eudic.net/eudic/mac_dictionary.aspx) <sup>Free, Great</sup>
    欧路词典，Mac 上最好用的第三方词典。
- [__Numi__](http://numi.io/) <sup>Great</sup>
    系统默认计算器的替代方案。
    - 单位换算好用啊！例如，您输入左边的内容，就能得到右边的结果：
        Input `1 day in sec` , print `86,400 s` .
        Input `547 day in year` , print `1 yr 6 mon. 2 day` .
- [__IINA Player__](https://lhc70000.github.io/iina/)
    视频播放软件。比 [~~MPlayerX~~](http://mplayerx.org)、[~~VLC~~](http://www.videolan.org/index.html) 都好用！
- [__网易云音乐__](http://music.163.com/) <sup>Joy</sup>
    网易云音乐，用音乐休闲放松，看大家的评论能得到许多共鸣和欢乐。
    - 由于音乐版权的原因，只能多下载几个 Apps 来听歌，如 [__QQMuscic__](https://y.qq.com/)、[__Xiami__](http://www.xiami.com/) 虾米。
- [__搜狗输入法__](https://pinyin.sogou.com/mac/)
    macOS 上功能最全的中文输入法。虽然不够让人满意，但却是最好的选择。
    - 许多功能常见诸于 Windows 上的输入法，但在 macOS 上就没有实现，搜狗已经很齐全了。
        （虽然弹窗比较烦人，不过毕竟通过设置还是能关掉）
    - 基本要求：
        - 双拼（小鹤）输入方案、云输入（词库）。
    - 智能英语输入模式：
        - 单词候选：可以当做单词拼写的提示。（我使用右 `⇧` 切换）
    - U 模式：
        （全拼状态下输入小写 u 启动，双拼则需输入大写 U）
        - 笔画输入：拆成横 h 竖 s 撇 p 捺 n 折 z，输入 `uhspn` 得到 `木` 字。
        - 拆分输入：林字拆成两个木，输入 `umumu` 得到 `林` 字。
        - 笔画拆分混输：笔画输入 + 拆分输入。
    - V 模式：
        （全拼状态下输入小写 v 启动，双拼则需输入大写 V）
        - 数字转换：
            - v + 整数数字：将数字转换成中文的大小写数字（例如：`2` → `二` | `贰`）。
                甚至 99 以内的罗马数字（例如：`12` → `XII`）。
            - v + 小数数字：将数字转换为对应的中文大小写金额。
        - 日期转换：
            - v + 日期：输入 `v2018.3.16` 得到 `2018年3月16日(星期五)`
        - 算式计算：
            - v + 算式：输入 `v2*3+4` 得到 `10`，
        - 函数计算：
            - 除了 `+ - * /` 运算之外，还支持一些比较复杂的运算，例如 `v2^3` → `8`。
                包括 ^ 乘方、! 阶乘、mod 取余、sqrt 开方、avg 平均值、var 方差、stdev 标准差、min 最小值、max 最大值、exp e为底的指数、ln e为底的对数、log 10为底的对数、sin 正弦、cos 余弦、tan 正切、arcsin 反正弦、arccos 反余弦、arctan 反正切 等。
        - 特殊符号入口：
            - 包括 v1 标点符号、v2 数字序号、v3 数学单位、v4 日文平假名、v5 日文片假名、v6 希腊/拉丁文、v7 俄文字母、v8 拼音/注音、v9 制表符 等。
    - 插入日期：
        - `rq` 日期 → `2018年03月24日`
        - `sj` 时间 → `2018年03月24日20:14:57`
        - `xq` 星期 → `2018年03月24日 星期六`

### 其它候选

- 连提及都没有价值的 Apps 在此就不一一列举了。
- 放在这里的有一些公认很好的 Apps，但我不常用甚至觉得鸡肋，且看我的理由。

---

- 系统增强
    - [__~~Alfred~~__](https://www.alfredapp.com/) <sup>据称键盘党的神兵利器</sup>、[__~~LaunchBar~~__](https://www.obdev.at/products/launchbar/index.html) <sup>Historic</sup>
        Spotlight 的增强版！关键字缩写的检索还是 Spotlight 精准；要用命令的话，我会在终端中操作，没有 Alfred 的用武之地；要启动程序的话，有 Manico 的支持足矣。
        - 很多人把它说得神乎其神，其实我并不觉得有大用。看看操作流程：先输入一些字符，Alfred 智能检索猜出你要做的事，如打开程序、文本，或者运行脚本等；然后，选一个选项执行。
        - __我更喜欢敲快捷键「一步到位」执行要做的操作！__ 例如，我借助 AppleScript、Python、Shell、Keyboard Maestro 和 Automator 等写好脚本、录制好一系列操作和控制流程，然后用快捷键激活它们就好了。
    - [__~~BetterTouchTool~~__](http://www.boastr.net/)
        为 Mac 的触摸板定制更多手势操作。iOS 版 App 还可以用来让 iPhone、iPad 设备化身为 Mac 的触摸板。现已是收费软件，但不贵。
        - 可是作为键盘党，自定义的快捷键足以让我驰骋 macOS，基本没机会用它。
    - [__~~Boom~~__](http://www.globaldelight.com/boom/index.php) <sup>极不推荐</sup>
        音效增强软件。可用于突破系统音量的上限，留意音量过大可能损坏 Mac 音箱。可有可无。
    - [__~~Contexts~~__](https://contexts.co/) <sup>Great</sup>
        App 窗口切换工具。操作行云流水，切换方面比 Manico 更优秀！但不能定制用于快速启动 App 的快捷键，因而被 Manico 替代。
    - [__~~CleanMyMac~~__](http://cleanmymac.com/) <sup>不推荐</sup>
        Mac 系统清理软件。macOS 本身已经够好用、省心，毋需过多维护，它只不过锦上添花，不客气地说，是画蛇添足、无关痛痒。
        - 帮助卸载一些顽固的软件还是有用的。
    - [__~~f.lux~~__](https://justgetflux.com/)
        根据所在地当时的日照，自动调整屏幕色温、亮度，减少蓝光对眼睛的刺激，以调整激素水平，保护正常睡眠节律。
        - 然而 macOS 和 iOS 的 Night Shift 已将其功能整合了（效果类似）。
    - [__~~HazeOver~~__](https://hazeover.com/) <sup>Focus</sup>
        便于让你瞬间定位到当前正在使用窗口。
        - 除当前激活的窗口，其它窗口都会显示阴影，让人更专注与当前窗口的工作。
        <span class="hidden">- 可惜经过长期使用，感觉可有可无，上述说法可能只有理论上的作用，可能只是心理安慰。</span>
    - [__~~iStat Menus~~__](https://bjango.com/mac/istatmenus/)
        显示软硬件状态（CPU、内存、网络、磁盘）的监控面板，支持顶部菜单栏部分自定义。
        - Mac 没异常时，知道这些信息真的有什么用吗？浪费菜单栏的空间和计算资源还让人分神。
    - [~~__iHosts__~~](https://itunes.apple.com/us/app/ihosts/id1102004240?mt=12)
        灵活管理 macOS 的 hosts 的方案。
        - 可惜通常情况下，hosts 并不需要复杂的管理；对于程序员来说，不如直接在 `.zshrc` 加上 `alias vh='vim hosts'` 一句剪短的配置，然后在命令行中输入 `vh` 指令打开 hosts 文件来进行修改，反而更直接省事。
    - [__~~Nozio~~__](http://noiz.io/) & etc
        白噪音应用。模拟大自然的声音，屏蔽其它噪音干扰，帮助保持专注，提高效率，放松睡眠。
        - 音乐听久了也累，有时戴个 [__3M 降噪海绵耳塞__](http://item.jd.com/10277731026.html)（便宜），纯粹安静地工作就很专注、舒服，其实毋需白噪音。
        - 可以的话，买 Bose 的 [QC 系列消噪耳机](https://www.bose.cn/zh_cn/products/headphones/noise_cancelling_headphones.html)，效果更佳。我买的是 [QC 20](https://www.bose.cn/zh_cn/products/headphones/earphones/quietcomfort-20i-acoustic-noise-cancelling-headphones.html#v=qc20_apple_black)。
    - [__~~Squirrel~~__](http://rime.im/)  <sup>Geek but 不推荐</sup>
        鼠须管输入法，稳定、流畅、开源，个人可定制性极高。是 Rime 中州韵输入法的 Mac 发行版。
        - 折腾一番后，个人定制出来的输入法，从界面到操作细节都能很好地贴合个人习惯。
        - 但是，词句齐全的成熟本地词库不多，缺失「云输入」在线匹配新词，__输入生词时诸多不便__，用久了我就不想再折腾了。所以使用几个月后，回归了我惯用的 [百度输入法](https://shurufa.baidu.com/)（我手机输入法用 [讯飞输入法](http://ime.voicecloud.cn/)）。
        - iFanr 爱范儿的推荐 《 [鼠须管，“神级”输入法](http://www.ifanr.com/156409) 》
        - 配置教程 《 [Rime 输入法 — 鼠须管（Squirrel）词库添加及配置](http://www.jianshu.com/p/cffc0ea094a7) 》
        - 我自定义的 [Rime 配置](https://github.com/IceHe/Rime)、 [Dictionaries 词库](https://github.com/IceHe/dictionaries)

### iOS

- 基础服务
    - __Safari__ <sup>Simple</sup>
        iOS 自带浏览器。足够好用。
    - [__Shadowsockrocket__](https://itunes.apple.com/us/app/shadowrocket/id932747118?mt=8) <sup>Favorite</sup>
        iOS 上配合 Shadowsocks 使用的科学上网（番羽土啬）利器。候选: [__~~Surge~~__](https://itunes.apple.com/us/app/surge-web-developer-tool-proxy/id1040100637?mt=8) <sup>Expensive</sup>
    - [__讯飞输入法__](http://www.xunfei.cn/) <sup>Favorite</sup>
        在用非手写输入的键盘时，竟然可以在键盘区滑动，这时可用手写方式输入！优秀的语音识别输入能力，准确率高，支持方言。
- 个人管理：事务、时间、习惯
    - [__2Do__](https://itunes.apple.com/us/app/2do-reminders-personal-planner/id303656546?mt=8) <sup>Powerful</sup>
        GTD 事务管理。( [Ref Above](#Common) )
    - [__BlockyTime__](http://www.anniapp.com/blockytime/index.html) <sup>Simple</sup>
        时间的记录统计工具，规划、督促、自省。
        A quicker time logger, let you never spend much time on tracking time.
    - [__HabitBull__](http://www.habitbull.com/)
        习惯养成，记录、统计、分析养成的情况。该领域有很多 App，好用的不多… 这个也不算最好的选择，需要自行挑选。
- 记录
    - [__MindNode__](https://mindnode.com/) <sup>Powerful</sup>
        思维导图。( [Ref Above](#Common) )
    - __Notes__ <sup>Simple</sup>
        iOS & macOS 自带的轻量级笔记应用，启动、编辑、同步迅速稳定，方便易用。
- 财务
    - [__网易有钱__](https://qian.163.com/) <sup>Simple</sup>
        简单方便的记账软件。可以自动同步银行储蓄卡、信用卡和支付宝账户的交易和余额数据，然后再给每笔收支调整分类和补充备注就行了，实在是方便。
        - 后来，我发现自己只需要知道自己各个账户的余额，以及总体的收支情况，所以就弃用「随手记」换用它。如果注重隐私信息的安全，请注意退避该 App。
        - 其它选择：[__随手记专业版__](http://www.feidee.com/money/) <sup>One fo the best</sup> ，我用得最顺手的记账软件。弃用理由见上文。
- 社交
    - __Mail__ <sup>Simple</sup>
        iOS 自带邮箱客户端，足够好用。
    - __QQMail__
        个人邮箱。
    - __Outlook__
        工作邮箱，主要用于设置邮箱服务器的邮件规则
        （分类不同邮件，某些邮件标为已读）
    - __WeChat__ <sup>Required for payment</sup>
        微信，主要用于支付、社交和碎片阅读（公众号）。
        - 能用微信小程序代替的 App 我都不下载。
            例如：大众点评、摩拜单车、嘀嘀出行、京东 等等。
    - [__TIM__](https://office.qq.com/) <sup>Simple</sup>
        手机上简洁版的 QQ，腾讯官方出品。
        - 去除了多余的娱乐功能，保证基本的进阶功能使用，方便工作，如音频视频通话等。
        - 不过还是得留着原版的 QQ，TIM 还不支持 QQ 的授权登录操作…
    - [__微信__](https://weixin.qq.com/)
- 阅读 & 学习
    - [__得到__](https://www.igetget.com/)
        「罗辑思维」团队推出的主打 __知识服务__ 的 App，在行走、饮食等琐碎时间里收听音频内容。
    - [__Kindle__](https://itunes.apple.com/us/app/kindle-read-books-ebooks-magazines/id302584613?mt=8)
        Amazon 的电子书资源是最全面、最丰富的，喜欢读书的话，没有太多其它的选择。
    - [__~~多看阅读~~__](http://www.duokan.com/)、[__~~微信读书~~__](https://weread.qq.com/)
        阅读软件。可导入 PDF，带云存储，操作流畅，阅读体验一流。
    - [__欧路词典 Pro__](http://www.eudic.net/eudic/mac_dictionary.aspx)
        英语词典。可使用在线有道词典，无广告！
    - [__~~扇贝英语~~__ 系列 Apps](http://www.shanbay.com/) <sup>English</sup>
        扇贝单词、扇贝炼句、扇贝听力、扇贝读书。工具不重要，最重要还是要坚持学习。
    - [__~~网易公开课~~__](http://open.163.com/)
        国内最好的公开课平台。
    - __Castro 2__
        泛用型博客客户端，收听个人播客自媒体，主要关于科技、技术、英语。
    - 不安装知乎、微博之类的资讯阅读类 Apps，要看书或者文章就用 Mac 或实体书看。
- 音乐 & 游戏 & 视频
    - [__网易云音乐__](http://music.163.com/) <sup>Favorite</sup>
        网易云音乐，音乐类软件的新标杆。能找到很多好歌单，冷门好歌，最喜欢看歌曲评论，分享感动和共鸣。
    - [__Bilibili__](http://www.bilibili.com/) <sup>Favorite</sup>
        现在看视频不带弹幕，就总觉得差点意思。
    - [__YouTube__](https://www.youtube.com/yt/devices/)、[__爱奇艺__](http://www.iqiyi.com/)、[__优酷__](http://youku.com/)、[__土豆__](http://mobile.tudou.com/)
    - [__虾米音乐__](http://www.xiami.com/)、[__QQ 音乐__](https://y.qq.com/)、[__豆瓣 FM__](https://douban.fm/)
- 安全
    - [__1Password__](https://1password.com/)
        密码管理。
    - ~~[__Authy__](https://www.authy.com/)~~
        两步验证器。提高安全意识，能开启两步验证的网络服务都开启，别嫌麻烦。
        - Authy 对比其它验证器的主要优点：可以多设备云同步、备份其中的 token 信息！
        - 备选：[~~Google Authenticator~~](https://itunes.apple.com/en/app/google-authenticator/id388497605?mt=8)。缺点：一旦卸载，其中的 token 信息就会丢失，需重新设置。
    - ~~__电话、短信的防骚扰助手、网页广告过滤器__~~
        利用 iOS 提供的接口协助过滤；一般没必要安装，注意隐私就好。如有必要再装。
- 生活
    - [__高德地图__](https://itunes.apple.com/cn/app/%E9%AB%98%E5%BE%B7%E5%9C%B0%E5%9B%BE-%E7%B2%BE%E5%87%86%E4%B8%93%E4%B8%9A%E7%9A%84%E6%89%8B%E6%9C%BA%E5%9C%B0%E5%9B%BE-%E8%87%AA%E9%A9%BE%E5%85%AC%E4%BA%A4%E9%AA%91%E8%A1%8C%E5%AF%BC%E8%88%AA/id461703208?mt=8)
        各个地图 App 当中，个人觉得这个最美观、顺手。备用：腾讯地图，可以离线使用。
    - [__支付宝__](https://mobile.alipay.com/index.htm)、[__滴滴出行__](http://www.xiaojukeji.com/index/index)、[__美团外卖__](http://waimai.meituan.com/)、[__饿了么__](https://www.ele.me/home/)、[__大众点评__](https://www.dianping.com/)
    - ~~__联系人信息同步助手__~~
        如 __QQ 同步助手__，一般没必要安装，微信等 App 也可以做到，不过它也有额外的用处。
        例如我喜欢将 iOS 系统的语言设为英语，但联系人当然还是用中文姓名保存的，此时联系人无法按照拼音顺序排列；需要 QQ 同步助手协助，给每个中文姓名的联系人填上拼音标注，才能按序显示了。

除了 iOS 自带且不能删除的 Apps，iPhone 里就几乎只有以上的少数的 Apps。

### Chrome 插件

有必要使用的浏览器插件不多。例如，[Greasemonkey](http://www.greasespot.net/)、Stylish 等就不建议折腾。

- [__1Password__](https://agilebits.com/onepassword) <sup>Pwd Security</sup>
管理帐号密码。
- [__cVim__](https://chrome.google.com/webstore/detail/cvim/ihlenndgcmojhcghmfjfneahoeklbjjh?hl=en) <sup>Powerful</sup>
    用 Vim 的键位去浏览、导航网页，减少使用鼠标的使用，键盘党神器！（~~[__Vimium__](https://chrome.google.com/webstore/detail/vimium/dbepggeogbaibhgnhhndojpepiihcmeb?hl=en)~~ <sup>备选</sup>）
    功能强大丰富，通过修改类似 `.vimrc` 的配置文件来设置功能（比较麻烦）。
    - 我的配置 [__.cvimrc__](https://github.com/IceHe/macos-home-conf/blob/master/.cvimrc)
- [__Chrono Download Manager__](https://chrome.google.com/webstore/detail/chrono-download-manager/mciiogijehkdemklbdcbfkefimifhecn)
    批量下载工具。多线下载，速度更快，功能更强，非 P2P 下载用它代替迅雷和浏览器自带的下载器。
    （一般情况下用浏览器默认的下载器就够了）
- [__Evernote Web Clipper__](https://evernote.com/intl/zh-cn/webclipper/) <sup>Offline Archived</sup>
    一键收藏各类网页图文，保存到 Evernote。
- [__JSON Formmater__](https://github.com/callumlocke/json-formatter) <sup>Web Development</sup>
    清晰明了地展示页面的 JSON 格式数据。
- [__One Tab__](https://www.one-tab.com/) <sup>Simple</sup>
    对标签页进行分组收纳等管理，避免标签页过多以致难以查找所需标签页，降低 Chrome 的内存消耗。
- [__SwithyOmega__](https://chrome.google.com/webstore/detail/proxy-switchyomega/padekgcemlokbadohgkifijomclgjgif?hl=en) <sup>Web Development</sup>
    「代理服务」配置工具，用于「科学上网」。
- [__uBlock__](https://www.ublock.org/) <sup>Simple</sup>
    快速轻量级的广告过滤器。我放弃了老牌的工具，如 ~~[Adblock Plus](https://adblockplus.org/zh_CN/) & [Adblock Plus Elem Hide Helper](https://adblockplus.org/zh_CN/elemhidehelper)~~。

### Windows

- [__TortoisGit__](https://tortoisegit.org/) - 便捷好用的 Git GUI 工具。
- [__Fiddler__](http://www.telerik.com/fiddler) - [抓包工具](http://m.open-open.com/m/lib/view/1375954572906.html)。
- [__EditPlus__](https://www.editplus.com/) - 功能强大的文本编辑软件。
- [__StrokesPlus__](http://www.strokesplus.com/) - 强大的 [全局鼠标手势软件](http://bbs.kafan.cn/thread-1410275-1-1.html)。
- [__Everything__](https://www.voidtools.com/) - 强大的 [全局文件检索工具](http://xbeta.info/everything-search-tool.htm)（ [Q & A](http://my.oschina.net/alphajay/blog/79431?fromerr=k12K2L1s) ）。
- [__Listary Pro__](http://www.listary.com/) - 类似于 Everything，[各有优劣](http://www.iplaysoft.com/listary.html)。
- [__AutoHotkey__](https://autohotkey.com/) - [全局快捷键设置工具](http://xbeta.info/autohotkey-guide-2.htm)。
- 参考：[Windows常用软件推荐](http://wsgzao.github.io/post/windows/)

---

## 硬件

会附带一些个人感受。

### 生产工具

- __便携电脑__：[MacBook Pro Retina 13-inch](http://www.apple.com/cn/shop/buy-mac/macbook-pro?product=MF841CH/A&step=config) <sup>Favorite</sup>
    i7 - 3.1 GHz / Mem 16 GB / SSD 512 GB。Unix-like，稳定、省心。Mac 是软件工程师的最佳工作平台！
- __显示器__：[DELL UltraSharp U2515Hx 25-inch](https://item.jd.com/1453819.html)
    2K（2560 * 1440）分辨率，窄边框，IPS 面板，LED-Lit（背光）。双显示器，竖起屏并排使用。
- __触控板__：[Magic Trackpad 2](http://www.apple.com/cn/shop/product/MJ2R2CH/A/magic-trackpad-2?fnode=55ff065819d666715b20a981bb6f5f6fea4670ea0305310e909e70f9db010fd3682e64118d0243109ebfec218056294be90dcd230d2da847d0fcd4a75b19ad6c9a0d3698c7ad96b873aa34184e1581ddf746c770f885a1c8e9a62f2985f320e2)
    Macbook 自带触摸板的手感已经足够好了。稍微嫌它们大了点，因为我向来将光标移动速度向来调到最高，基本一般幅度的滑动，光标就能到位，不需要太大的触控面积。
- __蓝牙键盘__：[Magic Keyboard](http://www.apple.com/cn/shop/product/MLA22CH/A/magic-keyboard?fnode=55ff065819d666715b20a981bb6f5f6fea4670ea0305310e909e70f9db010fd3682e64118d0243109ebfec218056294be90dcd230d2da847d0fcd4a75b19ad6c9a0d3698c7ad96b873aa34184e1581ddf746c770f885a1c8e9a62f2985f320e2) <sup>Favorite</sup>
    小巧轻便。Mac 的键盘布局紧凑合理，手用更小幅度的移动就能触及所有按键，省力。
    - 可能你会觉得敲起来手感「绵软」，但是作为「键盘党」的我，快捷键很多而且用得频繁，就觉得使用它很舒适、省力、安静。
    - [键程](http://baike.baidu.com/view/1748635.htm) 不会太长或太短，不需要用力按下，有舒适的反馈感（个人感觉），用久了手也不容易疲劳，特别是小指；而且敲击按键的声音小，不容易打扰到别人。
    - 使用蓝牙 4.0 无线连接，功耗低 —— 没有连接线，这点简直是洁癖和强迫症的福音；内置电池，Lightning 接口充电，一次充电能够续航三周以上，省心。
- __静电容键盘__：[PFU HHKB Professional JP](https://www.amazon.cn/PFU-Happy-Hacking-Keyboard-Professional-JP-%E6%97%A5%E6%9C%AC%E8%AA%9E%E9%85%8D%E5%88%97-%E5%A2%A8-USB%E3%82%AD%E3%83%BC%E3%83%9C%E3%83%BC%E3%83%89-%E9%9D%99%E9%9B%BB%E5%AE%B9%E9%87%8F%E7%84%A1%E6%8E%A5%E7%82%B9-N%E3%82%AD%E3%83%BC%E3%83%AD%E3%83%BC%E3%83%AB%E3%82%AA%E3%83%BC%E3%83%90%E3%83%BC-%E3%83%96%E3%83%A9%E3%83%83%E3%82%AF-PD-KB420B/dp/B001KWJTD6/ref=sr_1_2?ie=UTF8&qid=1494650201&sr=8-2&keywords=hhkb+jp)
    黑色，有刻印（按键上印有键位说明），日文键盘布局。
    - 果然还是按耐不住好奇心，买了一把机械键盘（严格来说静电容键盘不是机械键盘）来尝试。
    - 「[HHKB Pro 2](https://www.amazon.cn/PFU-Happy-Hacking-Keyboard-Professional2-%E5%A2%A8-%E7%84%A1%E5%88%BB%E5%8D%B0-%E8%8B%B1%E8%AA%9E%E9%85%8D%E5%88%97-USB%E3%82%AD%E3%83%BC%E3%83%9C%E3%83%BC%E3%83%89-%E9%9D%99%E9%9B%BB%E5%AE%B9%E9%87%8F%E7%84%A1%E6%8E%A5%E7%82%B9-UNIX%E9%85%8D%E5%88%97-WINDOWS-MAC%E4%B8%A1%E5%AF%BE%E5%BF%9C-%E3%83%96%E3%83%A9%E3%83%83%E3%82%AF-PD-KB400BN/dp/B000F8OECM/ref=sr_1_2?ie=UTF8&qid=1494650270&sr=8-2&keywords=hhkb)」系列 60 键 US 布局精简至极，看起来精致小巧、赏心悦目「逼格满满」啊！但是我这个快捷键党为了改键的需求，最终选择了按键更多、布局奇特的日本版。
    - 为了无痛切换 HHKB JP 和 Mac 键盘而同时修改两者的布局，其键位功能基本一致，并吸收了 60% 键盘的特点：如数字键 1 左侧的 Backquote 键换成了 Esc 键等。
    - 其它：觉得键盘还是该配 [__木质腕托__](https://search.jd.com/Search?keyword=%E6%9C%A8%E8%85%95%E6%89%98&enc=utf-8&wq=mu%E8%85%95%E6%89%98)，不然每天敲键盘的时间太长很累。还有该配 [__桌垫__](https://item.mi.com/1172700033.html)，不然我手臂瘦没有肉，手肘放在桌上感觉特别「搁」。
    - 配合 App __Karabiner-Elements__ 来同时使用两副键盘，分别启用不同的两套快捷键。

### 外置设备

- __便携 SSD__：[SAMSUNG Portable SSD T3 500GB](http://www.samsung.com/cn/memory-storage/pssd-mu-pt/MU-PT500BCN/)
    主要作为 MacBook Pro 的备份盘，备份和系统重装镜像恢复的速度飞快，就是有点奢侈…
- __拓展邬 & 底座__：[Sabrent USB 3 Universal Docking Station](https://www.amazon.cn/gp/product/B013WQWCEA/ref=oh_aui_detailpage_o01_s00?ie=UTF8&psc=1) - 连接、整齐
    - 接口够用
        - USB 3.0 接口 x 2，USB 2.0 接口 x 2，大功率 USB 充电专用接口 x 2，全是 Type-A 的；还有 Ethernet 接口、HDMI、音频 IO。
        - 外接备份硬盘、机械键盘，不用带 USB 充电口的插线板了；
        - 外接物理网口，不用 Ethernet 转 USB Type-A 的适配器了；
            （真是浪费了之前买 [Moshi USB 3.0 - 千兆以太网转接线](https://www.amazon.cn/%E7%94%B5%E8%84%91-it-%E5%8A%9E%E5%85%AC/dp/B00SIT3QE2/ref=sr_1_fkmr0_1?ie=UTF8&qid=1499445169&sr=8-1-fkmr0&keywords=Moshi+USB+3.0+%E8%87%B3%E4%BB%A5%E5%8D%83%E5%85%86%E5%A4%AA%E7%BD%91%E8%BD%AC%E6%8D%A2%E5%99%A8) …）
        - 音频输出不灵，耳机还是得插在笔记本电脑的机身上；
        - HDMI 接口连 2K 屏，帧率达不到 60 Hz 以致有卡顿（可能是传输线的带宽不够），只能用回 Thunderbolt 2 接口连外接显示屏。
    - 便于插拔
        - 现有的外接线头都插在笔记本电脑的左侧，电源、连显示屏的 Thunderbolt 2、连拓展邬的 USB 3.0，还有耳机插线。
        - 线头集中摆放，工位整洁多了；外接新设备，接口够用，接入也方便多了。
    - 可作底座
        - 可以当手机、平板、笔记本电脑的底座用（我的 MBP 不开盖，外接显示屏用）。
    - 性价比
        - 本来想买个用 Thunderbolt 2 接口接入的更好的拓展邬，但至少贵一倍，而且新款 MacBook Pro 支持的是更先进的兼容 USB Type-C 的 Thunderbolt 3 接口，所以我不想买 Thunderbolt 2 的，最后决定先买个便宜的将就着用。

### 移动设备

- __手机__：[iPhone](https://www.apple.com/cn/iphone/) <sup>Favorite</sup>
    - iOS 系统安全、稳定、流畅、省心。
    - GTD、阅读、笔记、通讯、记账… 随身的效率工具。
    - 日常主要使用的都是 Apple 的产品，配套使用效率更高。
    - 适应且喜欢 Apple 的软件生态（Apps），切换平台（Windows、Android）成本高，也没必要。
    - 尽量购买存储空间较大的版本，个人日常使用至少需要 64GB。
    - 相对于从 6 代开始的 Plus 大款 iPhone，更喜欢小款的，握持舒适、便携（如从裤袋取放）。
        - 除了大部头的书和高清视频，一般的阅读和视频在小屏上看也没差，大不了回头在 Mac 上看。
    - 我很喜欢 [Red Silicone Case](http://www.apple.com/cn/shop/product/MMW82FE/A/iphone-7-%E7%A1%85%E8%83%B6%E4%BF%9D%E6%8A%A4%E5%A3%B3-%E9%BB%91%E8%89%B2?fnode=99)（官方硅胶保护壳）的轻微磨砂质感，好看、舒适、不滑手。
    - 除非你想日后再倒卖出手，否则没必要贴膜，影响观感、手感和手势操作。
    - __其它__：~~iPhone Plus~~ <sup>_备用_</sup>
        - 续航不错，作为iPad 的替代品和备用手机，出门就可以不带充电宝了。
        - 屏幕尺寸合适，比小屏 iPhone 更适合阅读和看视频，又比 iPad Mini 更便携、方便单手操作，挤地铁公交的时候用也没问题，也是最适合玩手机游戏的尺寸。
        - [Turquoise Silicone Case](https://www.apple.com/cn/shop/product/MKXJ2FE/A/iphone-6-plus-6s-plus-%E7%A1%85%E8%83%B6%E4%BF%9D%E6%8A%A4%E5%A3%B3-%E7%82%AD%E7%81%B0%E8%89%B2?fnode=99)（宝石绿官方硅胶保护壳），一分钱一分货，用久了也能保持悦目的颜色。
        - ~~[Rose Gray Leather Case](https://www.apple.com/cn/shop/product/MKX92FE/A/iphone-6-plus-6s-plus-%E7%9A%AE%E9%9D%A9%E4%BF%9D%E6%8A%A4%E5%A3%B3-%E6%A3%95%E8%89%B2?fnode=99) 官方真皮保护壳易氧化变色，显脏，所以得买深色的。~~
- __手表__：[Apple Watch Sport](http://www.apple.com/cn/shop/buy-watch/apple-watch-sport/38-%E6%AF%AB%E7%B1%B3%E6%B7%B1%E7%A9%BA%E7%81%B0%E8%89%B2%E9%93%9D%E9%87%91%E5%B1%9E%E8%A1%A8%E5%A3%B3-%E9%BB%91%E8%89%B2%E8%BF%90%E5%8A%A8%E5%9E%8B%E8%A1%A8%E5%B8%A6?product=MJ2X2CH/A&step=detail)
    38mm Space Gray Aluminum Case with Black Sport Band ，iPhone、Mac 的辅助工具，健康助手。
    - 在 Mac 旁边，只要手上戴着手表并已解锁，唤醒 macOS 后它就会自动解锁，直接进入主界面。
    - 消息推送更私密，还可以使用语音识别输入内容，不用掏出手机就可以快速预览信息、回复。
    - 便于设置闹钟、计时、倒计时，倒计时可结合番茄工作法使用。
    - 便于查看日期时刻、天气，例如：之后每小时的降雨概率，便于决定是否带雨伞、骑行出门。
    - 可以控制手机的音频播放，不用掏出手机进行操作（其实通常使用耳机线控）。
    - 显示每日的运动清况，激励、提醒你保持运动的习惯（只是多走动，少坐电梯，也足够有益健康）。
    - 每久坐一段时间，它就会提醒您站起来活动一下。
    - 从实用性上说，运动款（Sport）就够用了，买标准款没必要。（究其原因是穷…）
- ~~__平板电脑__：[iPad](http://www.apple.com/cn/ipad)~~
    多用于阅读技术类书籍，看看动漫、电影、公开课。配合蓝牙键盘能够满足轻度使用，不用总是携带笔记本电脑回住处。还是因为用得少，也想身边的物品更精简，就给家里人用了（他们用大屏就不那么费眼力）。
- ~~__电子阅读器__：[Kindle Paperwhite](https://www.amazon.cn/Kindle-Paperwhite%E7%94%B5%E5%AD%90%E4%B9%A6%E9%98%85%E8%AF%BB%E5%99%A8-300-ppi%E7%94%B5%E5%AD%90%E5%A2%A8%E6%B0%B4%E8%A7%A6%E6%8E%A7%E5%B1%8F-%E5%86%85%E7%BD%AE%E9%98%85%E8%AF%BB%E7%81%AF-%E8%B6%85%E9%95%BF%E7%BB%AD%E8%88%AA/dp/B00QJDOLIO) E-reader~~ <sup>_Sold_</sup>
    需要长时间看书时，还得用 E-Ink 屏，保护视力。用惯手机阅读后，感觉这样更方便，就卖了…

### 音频输出

- __降噪耳机__（[Bose](https://www.bose.cn/zh_cn/index.html) 目前市面上最好的消噪耳机品牌）
    - [__Bose QC30__](https://www.bose.cn/zh_cn/products/headphones/earphones/quietcontrol-30.html#v=qc30_black) <sup>Favorite</sup>
        QuietControl 30 Wireless Headphones 无线蓝牙控噪耳机。
        - 特点：
            - 主动消噪，耳塞发出一种波与有规律的噪音相消；消噪后，自然就可以用更小的音量听清播放的音频；人声不能完全隔绝，不过会像是在水底听水面上的声音，感觉距离远了，声量小了许多；消噪程度可控，可调节到「完全消噪」和「关闭消噪」间的任意水平；完全消噪时，只要低音量地播放音乐或白噪音，就可以在很大程度上隔绝外部噪音。可以帮助我在嘈杂的办公室也能在静谧专注地做事。
            - 其它：线蓝牙连接，使用方便；颈戴式设计，便携；可同时连接多台设备，便捷地切换音源（我的 MBP 或 iPhone）：暂停当前音源的播放，然后让另一音源开始播放（或正在播放）。
        - 一些遗憾：
            - 续航时间 10h（官方宣称），比 QC20 的 16h 短 6h；
            - 充电时间 &gt;3h，比 QC20 的 2h 长；
            - 不能像 QC20 那样一键切换「完全消噪」、「输入外部声音」两个状态，略麻烦；
            - 外观挺丑，而且还容易戴歪，人称「狗圈」。
        - SONY 也进入了「消噪耳机」的市场，新出的产品音质很好，颈戴款的耳塞外观还行，比 Bose 的颈戴款好看，可是蓝牙不能同事连接多台设备。
    - ~~[__Bose QC20__](https://www.bose.com/en_us/products/headphones/earphones/quietcomfort-20i-acoustic-noise-cancelling-headphones.html#v=qc20_apple_white)~~ <sup>_备用_</sup>
        QuietComfort® 20 Acoustic Noise Cancelling®headphones — for Apple devices
        - 续航时间 16h，充电时间 2h；可「一键切换」是否隔绝周围环境的噪音。
- __便携无线蓝牙音箱__：[Sony SRS-X1-V](http://item.jd.com/10132928766.html) <sup>Favorite</sup>
    Bluetooth Wireless Speaker System (Purple)。不打扰别人情况下，尽量用蓝牙音箱来外放，更舒服自在。
    - 在安静环境下，用适度的音量外放合适的音乐或白噪声，容易让人产生沉浸式的专注体验。耳塞、耳机的音源很靠近耳朵，发出的声音太容易抢占人的注意力，沉浸体验不如外放设备。
    - 而且戴耳机、耳塞，多少会压迫侧颊、耳朵、头部，耳道有异物感，始终不是最舒适的状态。长时间戴耳机、耳塞，又不注意清洁设备和耳朵，有可能导致中耳炎，请注意保护听力。
    - 音效还不错（对比类似价位的同类产品）；续航持久；无线连接迅速；防水，可以在浴室使用。

### 护牙

- __电动牙刷__：[Philips Sonicare DiamondClean Sonic Electric Rechargeable Toothbrush](https://www.amazon.com/Philips-Sonicare-DiamondClean-Rechargeable-HX9332/dp/B0052JN7XG/ref=sr_1_1_a_it?ie=UTF8&qid=1468933357&sr=8-1&keywords=hx9332) <sup>Favorite</sup>
    Model HX9331/04 (White) 声波式电动牙刷。确实比手动刷干净多了！（[亚马逊中国](https://www.amazon.cn/Philips-%E9%A3%9E%E5%88%A9%E6%B5%A6-HX9332-04%E9%92%BB%E7%9F%B3%E4%BA%AE%E7%99%BD%E5%9E%8B%E5%A3%B0%E6%B3%A2%E9%9C%87%E5%8A%A8%E7%89%99%E5%88%B7/dp/B007ZY5GV2/ref=sr_1_6?ie=UTF8&qid=1468507397&sr=8-6&keywords=philips+diamondclean)）
    - [电动牙刷刷牙相比手动刷牙有什么优缺点？](https://www.zhihu.com/question/19825877/answer/15856166) 总结：
        - 电动比手动好，各种好（完爆）；
        - 旋转式的比声波式的刷得干净；
        - 声波式的比旋转式的磨损小；
        - 用电动牙刷的话使劲别太大。
    - 相关笔记 - [牙齿保健](/read/tooth.html)
- __冲牙器__（水牙线）：[Philips Sonicare Airfloss Ultra](https://www.amazon.com/Philips-Sonicare-HX8332-Airfloss-Ultra/dp/B01AVE8AAG/ref=sr_1_1_a_it?ie=UTF8&qid=1468933177&sr=8-1&keywords=hx8332)
    Model HX8332/11（[京东](http://item.jd.hk/1964052662.html)）。注意：用了一年半，感觉充一次电用不了几次就又没电了。
    - 总结：
        - [使用牙线有必要性吗？](https://www.zhihu.com/question/20842469/answer/44441538)
        - 牙齿与牙齿间的缝隙，牙线或冲牙器，才能弄干净；
        - 需要牙刷 + 牙线结合使用才能全面清洁牙齿。
        - [清理牙缝哪家强？两款水牙线的主观评测](https://zhuanlan.zhihu.com/p/20475312)
    - 争议：
        - [美国卫生署删除了“剔牙”“用牙线”的建议…](http://weibo.com/1878363622/E1OfvzJjo?from=page_1005051878363622_profile&wvr=6&mod=weibotime&type=comment#_rnd1471001024021)
        - [Flossing has no proven benefits, so U.S. health department stops recommending the practice](http://www.nydailynews.com/life-style/no-floss-u-s-health-department-article-1.2735915)
    - 相关笔记 - [牙齿保健](/read/tooth.html)

### 运动

- __羽球拍__：[Victor TK-ONIGIRI](http://www.victorsport.com.cn/product_data.php?id=bVjabyTqrMjj666zMjEk67dD4xSyq)
    - 喜欢进攻型羽毛球拍，重量 4U 比较轻便，手柄 G5 粗细刚好。
    - 以前打惯 3U 的球拍，一开始不适应，感觉它偏轻、没“手感”。挥拍扣杀时，感觉球拍不够重，惯性不够大，出力不足。但移动、挥拍、救球、回球来更快更灵活，省腕力，长时间打球省体力。
- __羽球鞋__：[Mizuno WAVE SMASH LO 白](https://item.taobao.com/item.htm?id=534360854337&_u=cuv5jet2aca)
    买一双高性价比的羽球鞋，是为了运动时更舒适灵活地移动，抗震性好，保护脚趾、脚掌、脚踝、膝盖。
    - 美津浓的鞋比尤尼克斯的更柔软舒适，特别对我这种经常跑动刹车的人来说没那么顶脚趾。
    - 旧：[__~~YONEX 65FT 白 JP 版~~__](https://item.taobao.com/item.htm?spm=a1z09.2.0.0.H4Rwq7&id=14324807794&_u=euv5jet879d) <sup>_已穿坏…_</sup>
- __运动服__：[YONEX 16201 训练服](https://item.taobao.com/item.htm?spm=a1z09.2.0.0.CoCGMf&id=37144559361&_u=puv5jet55e6) - 速干 <sup>Favorite</sup>
    最好 VC 面料，透汗、速干，便于清洗（个人汗量较大）；美观，除了运动，平时也可以穿。Under Armour 的也不错。
- 紧身上衣、紧身裤、运动长裤：冬天也能好好地保持运动

### 背包

- __大背包__：[Côte & Ciel Backpack](http://www.coteetciel.com/en-CN/isar-backpack-black-melange-laptop-bag) - 装电脑
    Isar Eco Yarn / Black Melange ，就是喜欢它特别的外观设计。
    - 即使是小号的包依然偏大，适合高大的人背；而且外形奇特，比较“挑人”，不容易搭配。
    - 只是个尼龙材质的包，但价格不便宜，建议先试背，询问亲朋好友的意见后，再购买。
- __轻便背包__（[小米学院休闲双肩包](https://item.mi.com/1171900021.html?cfrom=list)）
    要大小适中、便宜、轻便不累赘，用来放伞、水、纸巾这些不方便揣口袋、拎手里的杂物。
- __骑行背包__（[迪卡侬](https://detail.tmall.com/item.htm?spm=a1z10.4-b-s.w5003-14623109746.39.6z07wX&id=37930654463&scene=taobao_shop&skuId=3157441268509)）
    背着大背包出行，容易汗流浃背。骑行、跑步甚至日常出行，我都喜欢使用这个小巧轻便的透气户外背包。
- __好看的背包__：[Rains Msn Bag](https://www.rains.dk/collections/backpacks/products/msn-bag?variant=16742951681) <sup>_wish_</sup>
    坐飞机看到旁边妹子背的这款包很好看。也在考虑 [Backpack、Backpack Mini](https://www.rains.dk/collections/backpacks)。
    <!-- （[淘宝](https://world.taobao.com/item/532027551703.htm?spm=a312a.7700714.0.0.FOAJqC#detail)） -->

### 日用

- __带 USB 口的插线板__（[米家](http://www.mi.com/powerstrip/)）- 充电
    可以少用 USB 充电器，节省插位空间。
    配一个在公司的工位，再配一个在住处的床头，甚至出行时也随身带一个以备不时之需。
- __随身风扇__（[米家](https://item.mi.com/1162800007.html?cfrom=list)）- 纳凉
    连上充电宝、USB 的充电插头，即可使用；可拆卸，便携。
    一个常驻背包，用来出门是纳凉，一个插在放公司的小米插线板上用。
- __无限魔方__ - 减压、手癖 <sup>Favorite</sup>
    用新的「手癖」玩减压神器去代替其它不良手癖！例如，咬手指、敲桌子、抠鼻、抠耳朵、抠脚、抓脸、抓头发… 还有减压骰子、减压手柄、魔方骰子、指尖陀螺、减压笔等。（电商搜索关键词「减压神器）
- [__3M 子弹型耳塞__](https://item.jd.com/617192.html)、__眼罩__ - 安眠
    耳塞隔音，窗帘、床帘和眼罩遮光。
- __透气的慢跑鞋__（[Under Amour](https://www.underarmour.cn/p1285677-001.htm)） <sup>Favorite</sup>
    日常穿，轻便、柔软、透气、减震。
- __恒温电水壶__（[米家](https://www.mi.com/kettle/)）- 喝水
    多喝水，多喝温水。
- __伞具__
    - [__Topumbrella 渐变色折叠伞__](https://item.taobao.com/item.htm?spm=a1z09.2.0.0.CoCGMf&id=18427718268&_u=puv5jetf0a2) <sup>蓝~紫色</sup>
        轻便好看，直接推拉杆上连接伞骨的圆环便可开合，不用按按钮。
    - [__BENJAMIN 本傑明傘__](https://www.taobao.com/product/benjamin%E6%9C%AC%E5%82%91%E6%98%8E%E5%82%98.htm) <sup>_wish!_</sup>
        喜欢的款式：大洋之舞 和 深海鱼群。

<!--To Buy-->

<!--- [鞋拔 IKEA](http://www.ikea.com/cn/zh/catalog/products/50137128/)-->

<style type="text/css">
article .article-content ul li p:first-child {
    list-style: disc;
    text-align: match-parent;
    font-weight: bold;
}
</style>
