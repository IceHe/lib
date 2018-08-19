### 系统增强

[Amphetamine](https://itunes.apple.com/us/app/amphetamine/id937984704?mt=12)

- 防止 Mac 休眠。
- 原因：Mac 每次休眠后都会重启软件，导致软件丢失部分上下文，于是我无法在完全一样的环境下持续工作，一定程度上打断了工作，降低了效率。
- 休眠（Sleep）：硬盘休眠。
    屏幕休眠（Display Sleep）：即关闭屏幕，连屏幕保护程序（Screen Saver）也不运作。
- 其它选择：它比同类软件 [~~Caffine~~](https://itunes.apple.com/us/app/caffeine/id411246225?mt=12)、[~~Owly~~](https://itunes.apple.com/us/app/owly-display-sleep-prevention/id882812218?mt=12) 功能完备、好用；[~~InsomniaX~~](http://semaja2.net/projects/insomniaxinfo/) 没用过。

[Bartender](https://www.macbartender.com/)

- 收起或彻底隐藏毋需过多关注的菜单栏 App 图标。（我这个整洁癖、强迫症的福音）
- 不推荐购买 [~~Vanilla~~](http://matthewpalmer.net/vanilla/)，使用简便，自然配置项有限，最主要因为功能的实现方法不合理以致有 bug，例如会遮蔽菜单栏的一些别的内容，又如某些图标不能符合预期地显示或隐藏。

[~~ClipMenu~~](http://www.clipmenu.com/) <sup>Simple</sup>

- 剪贴板管理。
- 主要用于快速查询剪贴板的历史记录，并提取出需要的内容保存到当前的剪贴板中。
- 支持 URL、纯文本、RTF、图片、文件等各种格式，包括剪贴历史的排序、内容的大小写转换、自定义文本的调用。

[Copied](https://copiedapp.com/) <sup>Favorite, Searchable</sup>

- 剪贴板管理。（2018-04 开始尝试用它替代 ClipMenu）
- 不同于 ClipMenu 的简单，它拥有丰富完备的功能。
- 剪贴板历史搜索：便于迅速查找内容，最常用！
- 格式化模板：以纯文本、HTML 或 Markdown 格式输出，同时输出 URL 以及对应网页的标题等。
- 匹配规则：纯数字、URL 链接等，分别保存到不同的列表，应用不同的格式化模板。
- App 定制规则：来自不同 App 的内容，分别保存到不同的列表，应用不同的格式化模板。
- Queue（队列）：先入先出地输出内容（平时默认：后入先出）。
- 其它选择：[Paste](http://pasteapp.me/) 最好看！这类 App 层出不穷…

[PopClip](http://pilotmoon.com/popclip/)

- 快捷工具条。
- 在选中文本是弹出，辅助操作的工具条，包括：搜索、查字典、剪切、复制、粘贴等。

[HyperSwitch](https://bahoom.com/hyperswitch) <sup>Best</sup>

- 稳定切换同一 App 下各子窗口。
- HyperSwitcher 选择切换的窗口时，会显示各应用的缩略图。
- 可以用 [Keyboard Maestro](#Shortcuts) 来实现同样的功能以替代它。
- 相关 App：[~~HyperDock~~](https://bahoom.com/hyperdock/)
    窗口增强工具。光标停到 Dock 的 App 图标上，能快速预览该软件的所有窗口，点击切换到不同的窗口或桌面。还有快速调整窗口布局、大小、位置等的功能。
    - 用处还是不大，用 HyperSwitcher 切换子窗口时就能看到 App 下所有子窗口的预览图。

[KeyCastr](https://github.com/keycastr/keycastr)

- 键盘输入可视化：在显示屏上会显示你的键盘敲击动作，包括使用快捷键组合。
- 主要用于展示你如何（用快捷键）高效地使用电脑。

[Itasycal](https://www.mowglii.com/itsycal/) <sup>Simple</sup>

- 菜单栏上的日历小工具。自定义日期时间显示的格式，方便查看月历和事件！

[Quick Look plugins](https://github.com/sindresorhus/quick-look-plugins)

- 增强 Finder 的文件预览（Preview）功能。
- 在 Finder 浏览目录和文件时，选中文件，再按空格键，即可进行简单的预览。
- 该插件提供各种类型文件的预览功能：快速预览各种格式的图片，包括 GIF；对各种不同编程语言的代码进行着色，便于查看… 详情查看其 [GitHub 仓库 README.md](https://github.com/sindresorhus/quick-look-plugins) 的说明。

[~~ShawdowsocksX~~](http://macappstore.org/shadowsocksx/) <sup>No update</sup>

[ShawdowsocksX NG](https://github.com/shadowsocks/ShadowsocksX-NG) <sup>Ladder</sup>

- ShadowsocksX 是在 Mac 上配合 Shadowsock 工作的软件。NG 是后人维护的版本。

[ShowyEdge](https://pqrs.org/osx/ShowyEdge/index.html.en) <sup>Great</sup>

- 输入法状态提示。
- 显示一条样式可定制的色带在屏幕顶部，以提示正在使用什么输入法。在全屏使用 App 时，也能轻易区分输入法状态！
- 就好像盲插 USB 接口可能要插三次才成功，感觉很糟糕。随时都能便捷地确认输入法所处的状态，可以减少多余的输入法切换操作和误输入后的回退操作。
- 我输入英文只使用默认的「U.S.」input source，输入中文只使用「拼音输入法」，切换「中/英」输入只要直接切换输入法就好了。
    - 我不想只用「拼音输入法」，然后在一种输入法下进行中英输入切换。这时中英切换通常只需要用一个键 `⇧`、`^` 或 `⇪`，看似操作很方便，但也容易「误操作」，使用大量使用快捷键时就很不便，特别是在用 Vim 的方式进行编辑时，误操作几率非常高！

[Time Machine](https://support.apple.com/en-hk/HT201250) <sup>Required</sup>

- macOS 自带的系统备份、恢复软件。
- 要有忧患意识，不要等硬盘坏了、Mac 丢了，才追悔莫及。

[~~Time Out~~](http://www.dejal.com/timeout/) <sup>Health , Protect Eyes!</sup>

- 定时作息提醒工具。定时遮盖桌面的应用程序，提醒你离开电脑，去休息眼睛、活动身体。
- 如人饮水，冷暖自知。自己多注意就好，要是实在不自觉，这个应用才有用武之地；其实真到了严重的程度，它也帮不到你了。
- 其实我有一个个人的休息方式：因为我比较容易口渴，所以经常喝水；饮水量大就经常上洗手间，自然会多走动，不久坐。

**Dictionary** <sup>Great</sup>

- macOS 系统自带的字典应用，足够好用。

[EuDic Free](http://www.eudic.net/eudic/mac_dictionary.aspx) <sup>Free, Great</sup>

- 欧路词典，Mac 上最好用的第三方词典。

[Numi](http://numi.io/) <sup>Great</sup>

- 系统默认计算器的替代方案。
- 单位换算好用啊！例如，您输入左边的内容，就能得到右边的结果：
    Input `1 day in sec` , print `86,400 s` .
    Input `547 day in year` , print `1 yr 6 mon. 2 day` .

[IINA Player](https://lhc70000.github.io/iina/)

- 视频播放软件。比 [~~MPlayerX~~](http://mplayerx.org)、[~~VLC~~](http://www.videolan.org/index.html) 都好用！

[网易云音乐](http://music.163.com/) <sup>Joy</sup>

- 网易云音乐，用音乐休闲放松，看大家的评论能得到许多共鸣和欢乐。
- 由于音乐版权的原因，只能多下载几个 Apps 来听歌，如 [QQMuscic](https://y.qq.com/)、[Xiami](http://www.xiami.com/) 虾米。

[搜狗输入法](https://pinyin.sogou.com/mac/)

- macOS 上功能最全的中文输入法。虽然不够让人满意，但却是最好的选择。
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
