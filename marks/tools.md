# 利器 - 软硬件推荐

> 推荐 macOS 和 iOS 的 apps 以及日常使用的电子产品。

- 适合自己的工具，才是最好的工具，所以本文仅供参考，自行尝试最重要。
- 笔者是工具控，目力之内看起来还有点用的工具都会折腾过一遍。
    - 过程中浪费了许多时间精力在很少派上用场甚至无用的工具上。
    - 善于发现生活中关键的效率瓶颈，再根据需求寻找或创造工具就足够了。
    - 因为折腾工具而忘记了把事做成的初心，实在是南辕北辙（笔者便是前车之鉴）。

字体格式的含义

- ~~删除线~~ 标识的一定是我现在不用的 Apps。

## 软件

主要介绍：macOS、[iOS](#iOS) 的 apps（下文 Apple 指代 macOS + iOS），还有少数几个 [Windows](#Windows) 的软件

App 选择原则

- 「常用」的工具才值得折腾，不常用的凑合着用就行了。
- 「实用」最重要，美观次之，价格别太贵就行。
- 「稳定」：不能时常引起系统崩溃，起码提升效率的收益得超过操作系统崩溃重启的损失。
- 「简洁易用」：满足实际的需求即可，不需要花哨、多余的功能。
    - 「开箱即用」是工具最好的状态。参考 KISS 和 SR 原则 ( keep it simple stupid & single responsibility ) 。
- 「设置项齐全」：可以根据自身习惯调整 App，让它用起来更顺手、省心。
    - 开箱即用虽好，但我也认同「为了极致高效或完成复杂工作的工具而提高复杂度」的理念，例如 IDE、PS
    - 软件设置项合理够用就行，不一定非要很齐全，例如设置好各常用功能的快捷键，以便快速调用，或者将流程变得更自动化，以节省时间精力。

笔者相关文章

- 《[Mac 效率指南](../mac/efficiency.md)》
- 《[Mac 快捷键](../mac/shortcuts.md)》

参考阅读

- [少数派](http://sspai.com/) - 高质量 App 推荐媒体，关于 iOS、Mac、硬件。
- [Best App](https://github.com/hzlzh/Best-App) - List in GitHub

### 常用

#### 网络

[Shawdowsocks](https://portal.shadowsocks.to/) <sup>Ladder</sup>

- 科学上网（番羽土啬）。
- 首选方案：Shadowsocks 服务 + Mac 的 [ShadowsocksX-NG](https://github.com/shadowsocks/ShadowsocksX-NG) + Chrome 的 proxy 插件 [SwitchyOmega](https://chrome.google.com/webstore/detail/proxy-switchyomega/padekgcemlokbadohgkifijomclgjgif?hl=en)
- 备选方案：[VPN](https://www.cup.com/staticip/?=panda) + [CHNRoute](https://github.com/fivesheep/chnroutes) + [Dnsmasq](http://www.thekelleys.org.uk/dnsmasq/doc.html)

[Chrome](https://www.google.com/chrome/) <sup>Universal</sup>

- 浏览器。
- 配合 [cVim](https://chrome.google.com/webstore/detail/cvim/ihlenndgcmojhcghmfjfneahoeklbjjh) 拓展，可在浏览器内 **使用 Vim 键位** 浏览网页、操作浏览器！键盘党神器。
    - 可惜它无法在页面未加载完毕的情况下使用 Vim 键位，不够（[Firefox](http://www.firefox.com.cn/) + [VimFX](https://github.com/akhodakivskiy/VimFx)）极致！
- 用 **Inspect Element**（审查元素）配合 **Postman** 等做 Web 开发、调试，比 Firefox 顺手。

#### 常用

[2Do](https://www.2doapp.com/) <sup>Powerful</sup>

- GTD 事务管理。
- 功能齐全、好用，用法可简可繁。快捷键完备！
- 推荐使用 iCloud Reminders 的 CalDAV 同步方式（支持 2Do 绝大部分特性，足以满足我的需求）；Dropbox 的同步方式虽然可以支持 2Do 的所有特性，可是需要翻墙才能同步数据，iPhone 需要长期开着 VPN 略显麻烦。所以为了稳定和省心，选择了前一种同步方式。

[Trello](https://trello.com/) <sup>Favorite</sup>

- 基于 Board 的事务管理。
- 使用 board 看板、list 列表、card 卡片等，组织事务；
- 使用 description 描述、comment 评论、attachment 附件等，跟踪记录事务内容；
- 根据 事务内容、label 标签、due date 截止期限等，考虑事务的优先次序。
- 我在现实管理工作项目的过程中，GitLab Issue Board 的应用，给我带来了很大的帮助。虽然那段时间很忙，但我还是有条不紊地推进了我和同事间的分工协作。自此迷上了使用 Board 的方式去管理事务。
- 类似的产品很多，Trello 是最简洁、好用、易上手的，这是我用它的关键原因。Slack 的服务被墙，在移动端访问不便（而 Trello 没被墙）；而国内的模仿者们则做得太复杂了，可能因为他们主攻 toB 的市场，不适合我这样的个人用户来使用，所以无爱。

**双拼输入方案** <sup>Favorite</sup>

- 高效，易学！比五笔容易掌握得多，对比全拼，输入效率显著提升，十分值得学习。
- 《[做少数派中的少数派：双拼输入快速入门](http://sspai.com/32809)》
- 《[选择输入法的哲学：兼论双拼的优缺点](http://sspai.com/33019)》

[1Password](https://agilebits.com/onepassword) <sup>Privacy</sup>

- 帐号密码管理，以及私人信息的加密存储。
- 用一（两）个主密码管理所有其它密码。可生成随机密码，可记录登录网站时用的帐号密码，可自动填写表单登录网站。
- 以前一直用不惯，觉得用浏览器自带的自动登录和 iCloud 的 [KeyChain Access](https://support.apple.com/kb/PH20093?locale=zh_CN) 来记录管理帐号和密码足矣，可是不便于保存一些私人信息。工作之后，经济独立，更加注意保护个人隐私和财产安全了，要管理的私人信息多而杂乱，所以不得不借助专用的工具。
- 其它选择
    - [KeyChain Access](https://support.apple.com/kb/PH20093?locale=zh_CN)：macOS & iOS 原生支持，方便免费。
    - [Dashlane](https://www.dashlane.com/)：好用，但贵。
    - [LastPass](https://lastpass.com/)：够用，免费。

[Outlook](https://outlook.live.com/owa/)

- 邮箱客户端，微软出品。
- 方便设置在邮箱服务器生效的邮件规则（因为公司邮箱用 Outlook 的服务）。
    - 自动处理，屏蔽干扰，提高邮件处理效率。
    - 将不同类型邮件归类到不同文件夹；
    - 将可以忽略的邮件标为已读；
    - 自动删除无用邮件。

#### 笔记

[MindNode](https://mindnode.com/) <sup>Flexible</sup>

- 思维导图，归纳总结笔记。
- 操作简便易上手，轻巧稳定。
- 我原来用 Markdown 线性列表来做记录、归纳、总结，但是这样的话，内容再组织实在不灵活，不如思维导图灵巧。

[Notes](https://support.apple.com/kb/PH22609?viewlocale=en_US&locale=en_JO) <sup>Simple</sup>

- Apple 自带的轻量级笔记应用。
- 用于收集灵感和想法，做书摘、读书笔记和日记。因为它启动迅速，使用稳定便捷，所以更常使用它而非 Evernote。

[Notion](https://www.notion.so/) <sup>Checklist</sup>

- 用作 **checklist**（检查清单）。
- 我只用它来复用自己的 checklist 模板。例如，每天的早上起床、晚上回住处要做的杂务流程，以及出行的行李清单等 checklist。（虽然功能强大，但操作不够便捷，数据同步不尽如人意）
- 原来我用 Evernote 来复用 checklist 模板，可是在 check 勾选、uncheck 反选复选框，以及浏览 checklist 的过程中，很容易唤起键盘，可以说相当烦人，而 Notion 则不会有这样的体验。

[Evernote](https://www.yinxiang.com/) <sup>Rec Offline, RIL</sup>

- 云笔记，第二大脑（知识管理）。
- 好记性不如烂笔头，而如今知识更新之快，纸笔已跟不上，于是笔记软件大放异彩。云端存储同步笔记（同时定期备份整个硬盘），有备份就不怕丢；便于检索，甚至搜索图片中的文字。总是死记硬背没有出路，不能被检索的知识毫无意义。
- 现在觉得值得离线记录的东西不多了，用 Google 搜索更便捷，而且还能获得更新更好的资料；值得沉淀的知识不断更新记录在博客就够了。
- 现在我主要将它作为 Read It Later（RIL）类 App 来用。
    - 用法：[剪藏](https://evernote.com/intl/zh-cn/webclipper/)、微博 [@我的印象笔记](http://weibo.com/u/2859258962)、微信分享给 **我的印象笔记**、[邮件收藏](https://help.evernote.com/hc/zh-cn/articles/209005347-%E5%A6%82%E4%BD%95%E4%BF%9D%E5%AD%98%E9%82%AE%E4%BB%B6%E8%87%B3Evernote) 等。
- 其它选择：
    - [~~有道云笔记~~](https://note.youdao.come)：Evernote 迁移到其它平台比较简单，但 [有道云笔记](https://note.youdao.come) 导出的笔记格式经过加密、无法通用，很难迁移到别的平台，所以不推荐使用
    - [为知笔记](http://www.wiz.cn/)、[Leanote](https://leanote.com/)、[Notion](https://www.notion.so) …

[~~nvALT~~](http://brettterpstra.com/projects/nvalt/) <sup>Casual</sup>

- macOS 上的草稿处理中心。随叫随到（快捷键齐备），迅速记录（操作简洁），检索便捷。
- 如果我用 Sublime Text 做一些随意的文字记录，要保留久一点都得保存成文件，难免在显眼的地方（例如桌面）看到一堆临时文件，过后的清理也麻烦，怕不小心删掉了别的有用的文件。
- 用 nvALT 的话，它会统一在暗处做文字记录的整理（除非导出文件），眼不见为净。

### 命令行

代码管理

[Git](https://git-scm.com/) <sup>Required</sup>

- 分布式代码版本管理系统（必学）。

编辑器

[Vim](http://www.vim.org/) <sup>God-like</sup>

- 编辑器之神（ Emacs 则是神的编辑器 ）。
- 服务器通常是 *nix 系统，vi* 是标配，而 Emacs 不常有。服务端开发和运维人员经常要在远程服务器编辑文本，遂 vi\* 是必备技能！
- 大的项目还是使用专用 IDE 进行编写更便捷靠谱。IDE 装个 plugin 也能以 Vim 的方式高效地操作，Vim 通用的键位可以让你少记很多必要的 IDE 快捷键。
- 在命令行之外，Sublime Text 原生支持 Vim 的基本操作，VS Code 插件支持 Vim 操作。
- Vim vs. Emacs! &nbsp;[What are the main differences between Vim and Emacs?**](https://www.quora.com/Text-Editors-What-are-the-main-differences-between-Vim-and-Emacs)》
- 其它：《[一年成为Emacs高手（像神一样使用编辑器）](https://github.com/redguardtoo/mastering-emacs-in-one-year-guide/blob/master/guide-zh.org)》
- 我的配置 [.vimrc](https://github.com/IceHe/mac-conf/blob/master/.vimrc)

[~~spf13-vim~~](http://vim.spf13.com/)

- 一整套 Vim 配置方案。
- 比起漫无休止地折腾配置，不如遵从实用主义：站在巨人的肩膀上，直接使用久经考验的的配置方案。
- 其实你用不上其中的很多功能，而且高配的 [MBP](#Smart) 用它竟然会卡顿！如果只是轻度使用 Vim，那么用熟之后，可以根据个人习惯只在配置文件 `.vimrc` 中简单地自定义一下就够了。

---

Shell

[Zsh](http://zsh.sourceforge.net/) <sup>Powerful</sup>

- 比 Bash 更强大、便捷、高效的 Shell！
- 配置 Zsh 比较复杂，可以使用 [oh-my-zsh](http://ohmyz.sh/) 等成熟的配置方案。
- [Fish](https://fishshell.com/) ( a shell for the 90s 😂 ) 虽然很好，但存在兼容性问题，有些 Bash 的指令需要改写才能运行在 Fish 上。尝试使用之后，还是更喜欢 Zsh。
- 参考：[Comparison of Command Shells - Wikipedia](https://en.wikipedia.org/wiki/Comparison_of_command_shells)
- 我的配置 [.zshrc](https://github.com/IceHe/mac-conf/blob/master/.zshrc)

[oh-my-zsh](http://ohmyz.sh/) <sup>Efficient</sup>

- 管理 Zsh 配置的开源框架，预打包了相关的主题、插件、配置。
- 配置过程傻瓜化，一条安装指令就能让你畅快地享受 Zsh 的强大与高效！
- 我的命令行提示符主题 [.sunrise_icehe](https://github.com/IceHe/mac-conf/blob/master/.config/zsh/sunrise_icehe.zsh-theme)

[tmux](https://tmux.github.io/) <sup>Powerful</sup>

- 终端多路复用软件，即命令行中的 「桌面、分屏工具」。
- 允许一个用户在一个终端窗口或一个远程终端会话中，使用多个终端会话。
- [screen](https://www.gnu.org/software/screen/manual/screen.html) 命令的替代方案，使用方法基本相同。
- 我的配置 [.tmux.conf](https://github.com/IceHe/mac-conf/blob/master/.tmux.conf)

---

包管理

[Homebrew](http://brew.sh/) <sup>Best</sup>

- macOS 的包管理器。`brew` 就如 `agt-get` 之于 Ubuntu，`yum` 之于 RedHat、CentOS 的存在。

[~~Homebrew Cask~~](http://caskroom.io/)

- 安装、更新 macOS Apps 的命令行工具。
- 用命令行的方式安装、更新 Mac Apps，其中还包括了许多第三方的 Apps。
- 可以不用忍受 AppStore 缓慢的下载速度，也不必再一一访问各个官网去下载第三方 Apps 了。
- 重装 macOS 时可以用 `brew cask install` 命令组成的脚本便捷地安装必要的 Apps。

[~~dotfiles~~](https://dotfiles.github.io/)

- 可供参考的 dotfiles 配置，还有 [我的 dotfiles](https://github.com/IceHe/macos-home-conf)。（[dotfiles 是什么？](http://www.jianshu.com/p/7UJapk)）

[tools/development](tools/development.include.md ':include')

[tools/core-apps](tools/core-apps.include.md ':include')

[tools/system-enhanced](tools/system-enhanced.include.md ':include')

[tools/app-candidates](tools/app-candidates.include.md ':include')

[tools/ios](tools/ios.include.md ':include')

[tools/chrome](tools/chrome.include.md ':include')

### Windows

- [TortoisGit](https://tortoisegit.org/) - 便捷好用的 Git GUI 工具。
- [Fiddler](http://www.telerik.com/fiddler) - [抓包工具](http://m.open-open.com/m/lib/view/1375954572906.html)。
- [EditPlus](https://www.editplus.com/) - 功能强大的文本编辑软件。
- [StrokesPlus](http://www.strokesplus.com/) - 强大的 [全局鼠标手势软件](http://bbs.kafan.cn/thread-1410275-1-1.html)。
- [Everything](https://www.voidtools.com/) - 强大的 [全局文件检索工具](http://xbeta.info/everything-search-tool.htm)（ [Q & A](http://my.oschina.net/alphajay/blog/79431?fromerr=k12K2L1s) ）。
- [Listary Pro](http://www.listary.com/) - 类似于 Everything，[各有优劣](http://www.iplaysoft.com/listary.html)。
- [AutoHotkey](https://autohotkey.com/) - [全局快捷键设置工具](http://xbeta.info/autohotkey-guide-2.htm)。
- 参考：[Windows常用软件推荐](http://wsgzao.github.io/post/windows/)

---

[tools/hardware](tools/hardware.include.md ':include')

---

[tools/life](tools/life.include.md ':include')

> 君子生非异也，善假于物也。
>
> **荀子**
