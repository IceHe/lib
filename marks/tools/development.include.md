### 软件开发

> 常用

[IntelliJ IDEA](https://www.jetbrains.com/idea/) <sup>Master Piece</sup>

[~~PhpStorm~~](https://www.jetbrains.com/phpstorm/)

- PHP 的最佳 IDE。
- 现阶段 PHP 类型推导做得最好的 IDE，稳定、崩溃少，功能完善，设置选项齐全。（我觉得）比 ZendStudio、Eclipse 好用多了。
- 技术支持服务靠谱，客服答复迅速、解决方案有效
- 配合 [IdeaVim](https://plugins.jetbrains.com/plugin/164?pr=idea) 插件可用 Vim 的方式进行操作，可以少记许多执行相同功能的 IDE 快捷键。
    - 我的配置 [.ideavimrc](https://github.com/IceHe/mac-conf/blob/master/.ideavimrc)
- [JetBrains](https://www.jetbrains.com/products.html) 出品的其它优秀 IDE：[PyCharm](https://www.jetbrains.com/pycharm/)、[WebStorm](https://www.jetbrains.com/webstorm/)、[CLion](https://www.jetbrains.com/clion/)、[GoLand](https://www.jetbrains.com/go/) …

[VS Code](https://code.visualstudio.com/) <sup>开箱即用</sup>

- 开源、持续且活跃的开发，更不必说本身有微软过硬的技术实力背书。

<!-- - 我自定义的 [configs]() -->
<!-- - 我安装的 [plugins]() -->

[Sublime Text](http://www.sublimetext.com/) <sup>Fastest</sup>

- 代码编辑器。Vintage 模式，可用 Vim 键位进行操作。冷启动也快如闪电！
- 我自定义的 [keymap](https://github.com/IceHe/mac-conf/blob/master/.config/sublime/)
- 我安装的 [plugins](https://github.com/IceHe/mac-conf/blob/master/.config/sublime/Package%20Control.sublime-settings)
    - **Clickable URLs**：`⌘ ⌥ ↩` 打开光标当前位置的 URL。
    - **Compare Side-By-Side**：文本差异对比。
    - **CTags**：编程语言对象定位器。
    - **Git Gutter**：Git 变更差异（Diff）提示。
    - **HTML-CSS-JS Prettify**：HTML、CSS、JS 内容的格式化
    - **MarkdownEditing**：支持 Markdown 语法高亮和编辑特性。
    - **Package Control**：插件包管理器。
    - **Pretty JSON**：JSON 格式美化、最小化、有效性检查。
    - **TrailingSpaces**、**Trimmer**：去除多余的空格，包括每行内容后面的。

[iTerm2](https://www.iterm2.com/)

- macOS 下的终端仿真机。是系统默认自带的 Terminal 的最佳替代 App。

[~~Dash~~](https://kapeli.com/dash)

- 查阅 API 参考文档、管理代码片段的工具。功能单一却精准。

> 网络

[Charles](https://www.charlesproxy.com/) <sup>Best</sup>

- 网络封包分析（抓包）工具。如 Fiddler 之于 Windows。主要用于「应用层」的分析。

[Postman](http://www.getpostman.com/) <sup>Powerful</sup>

- APIs 开发、测试、归档的辅助工具。
- Mac 的 HTTP 客户端。用于与 REST 服务交互，以助构建 API、HTTP 请求，检查来自服务器的响应。其它选择：[~~Paw~~](https://paw.cloud/)

[~~Wireshark~~](https://www.wireshark.org/) <sup>Powerful</sup>

- 网络封包分析工具。比 Charles 强大得多，但是也复杂得多。主要用于「网络层」的分析。
- （并非运维人员，日常工作很少用得着。有益于深入理解学习计算机网络的知识。）

[~~LaunchRocket~~](https://github.com/jimbojsb/launchrocket)

- 安装在 macOS 系统设置面板的 App，通过 `launchd` 管理各式 services。
- 比使用命令行，更便于启动、终止 services 以及进行 root 授权。

> 数据

[Squel Pro](http://www.sequelpro.com/) <sup>Free</sup>

- 管理 MySQL 数据库的 GUI 工具。

[~~Transmit~~](https://panic.com/transmit/)

- FTP 的 GUI 工具。
- （rsync 命令比 FTP 的效率高得多，用法也更丰富。一般情况下传输文件用 netcat 命令也够用。）

> 办公

[Adobe Acrobat Reader DC](https://get.adobe.com/cn/reader/)

- 一般情况下，不使用额外的 **PDF 阅读软件**，Mac 系统自带的 Preview 就够用了。
- 但在特殊情况下，需要用到 PDF 的一些高级特性，还是 Adobe 家的软件亲自处理更妥当，例如签证申请文件、合同、加密文件等。

[~~Parallel Desktop~~](http://www.parallels.com/landingpage/pd/general/?src=r&pd11) <sup>Best</sup>

- 虚拟机软件。
- 最适合用于安装 Windows。它将 Windows、Ubuntu 跟 macOS（几乎）无缝对接，使用流畅自然。（我现在完全脱离了 Windows 平台独占的软件，包括游戏，所以几乎用不着它。还有它的软件升级定价策略很不地道，跟重新买差别不大…）
- 其它选择：[~~Virtual Box~~](https://www.virtualbox.org/)（适合装 Linux），[~~VMWare Fusion~~](http://www.vmware.com/products/fusion.html)（没用过）
