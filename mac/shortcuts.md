title: Mac 快捷键
date: 2016-01-06
updated: 2018-04-17
categories: [Mac]
tags: [Mac]
description: macOS Shortcuts&#58; 我的 macOS 快捷键列表。
---------------------------

{% cq %}
天下武功，唯快不破。
{% endcq %}

## Simple & Less

- 正确的做法：
    - 选用符合直觉的好设计 —— 它们容易习惯，不容易被错误地使用。
        - 「开箱即用」默认的配置就能用得顺手，这是一个很高的标准。
    - 根据「二八法则」（帕累托法则）只做关键部分的改进，用更少的工具完成更多的事情。
        - 工具提供适当足够的设置选项，然后将工具配置得足够贴合个人的使用习惯。
            例如，尽量使用默认通用的快捷键；同时使用多个 IDE 和代码编辑器的话，尽量将快捷键配置得一样，增强快捷键的通用性，减轻记忆快捷键的负担，减少误用；建议尽量都使用 Vim 插件，统一以 Vim 方式进行操作，可以进一步减轻记忆负担，增加操作效率。


## Explanation

- Here are the Mac shortcuts:
    - the default ones that I use most frequently,
    - my custom ones.
    - I hide the default shortcuts that are seldom used.
- Meanings of Font Format:
    - The item with the superscript <sup>_custom_</sup>&nbsp; implies it might `be custom by me`.
    - _The italic item is `not frequently-used`.
- My Related Articles :
    - [利器 - 软硬件推荐](/tools)
    - [Mac Efficiency 效率指南](/mac/efficiency)
- Reference :
    - [Mac 键盘快捷键](https://support.apple.com/zh-cn/HT201236) ( from Apple Supprot )

### Key Symbols

`` Power
`⌘` Command ( Cmd )
`⌥` Option | Alt
`^` Control | Ctrl
`⇧` Shift ( Shf )
`⇪` CapsLock
`⇥` Tab
`⎋` Escape ( Esc )
`↩` Return ( Ret ) | Enter
`凵` Space

`↑` Up
`↓` Down ( Dn )
`←` Left ( Lf )
`→` Right ( Rg )

`⌫` Delete ( Del ) | Backspace

`0~9` One of the digits 0 ~ 9
`a~z` One of the alphabet a ~ z

### Abbreviations

- Buttons
    `Cmd` Command
    `Ctrl` Control
    `Esc` Escape
    `Opt` Option
    `Ret` Return
    `Shf` Shift
    `Del` Delete
- Directions & Positions
    `Dn` Down
    `Lf` left
    `Rg` Right
    `Prev` Previous
    `Btm` Bottom
- Words
    `App` Application
    `Dir` Directory
    `Mv` Move
    `Rm` Remove
    `Str` String
    `Pf` Prefix
- Symbols
    `&` And
    `|` Or
- Others
    `aka` Also known as

### Examples

- Meaning of Font Style
    _Italic_ : I seldom use it .
    <sup>_custom_</sup> : Added | modified by myself .
- `⌘ ⌥ a` Manipulation
    Press "Cmd", "Opt" & "a" at the same time to do the manipulation .
- `A` Manipulation
- `⇧ A` Manipulation
    The capital letter "A" means pressing "Shf" & "a" at the same time !
- `⌘ 1` | `⌘ 2` Manipulation
    Press "⌘ 1" or "⌘ 2" to do the manipulation.
- `⌘ 1`, `⌘ 2` Manipulation
    Press "⌘ 1" then "⌘ 2" to do the manipulation.

## macOS

- Some are common & default in operating system.
- Some of the keys below can be modified in `System Preference → Keyboard`.
- Some are modified by Apps [Karabiner-Elements](#Karabiner-Elements) & [Keyboard Maestro](#Keyboard-Maestro).

### System

- Power
    `` Wake Up
    `⌘ ⌥ ` Sleep
    `^ ⇧ ` Display Sleep
    `⌘ ^ q` Lock Screen ( Display doesn't sleep )

    `^ ` Shut Down
    ( Then you can choose to Sleep or Restart in the prompt dialog box. )
    _`⌘ ^ ` Force Restart_
    _`⌘ ^ ⌥ ` Force Shutdown_

- Accessory
    `F1` Desktop <sup>_custom_</sup>
    `⌘ 凵` Spotlight
    _`⌥ ⇧ F` Search in All Files_ <sup>_custom_</sup>
    _`⌥ ⇧ ?` Show Help Menu_ <sup>_custom_</sup>

- Dock & Menubar & Sidebar
    `F12` Open Notification Center <sup>_custom_</sup>
    `^ F12` Do Not Disturb On/Off <sup>_custom_</sup>
    `⌘ ⌥ d` Dock Hiding On/Off

- Screenshot
    _`⌘ ⇧ 3` Capture Desktop_
    _`⌘ ⇧ 4` Capture the selected area_
    ( The screenshots are saved in `~/Desktop`. )

### Finder

- File
    `⌘ ↓` Open
    `⌘ d` Duplicate
    `⌘ e` Eject Disk

    _`⌘ l` New Alias for a file_
    _`⌘ r` to Origin File of Alias_

- Folder
    `⌘ ⇧ A` Application
    `⌘ ⇧ D` Desktop
    _`⌘ ⇧ F` All My Files_
    _`⌘ ⇧ G` to Folder_
    `⌘ ⇧ I` iCloud
    `⌘ ⇧ O` Documents
    `⌘ ⇧ R` AirDrop
    `⌘ ⌥ l` Downloads

    `⌘ ⇧ N` New Folder
    `⌘ ↑` to Parent Dir
    _`⌘ ^ ↑` Open Parent Dir in New Window_

    _`⌘ ⇧ C` Computer_
    _`⌘ ⇧ H` Home_
    _`⌘ ⇧ K` Network_
    _`⌘ ⇧ U` Utilities_

- View
    `凵` Quick Look
    `⌘ i` Get Info
    `⌘ ⇧ .` Show Hidden Files

    `⌘  1` View the files in way of Icon
    `⌘  2` View as a List
    `⌘  3` View as columns
    `⌘  4` View as a cover flow

    `⌘ ⇧ ⌫` Empty Trash
    _`⌘ ⇧ ⌥ ⌫` Empty Trash without Confirmation_

    _`⌘ ⇧ P` Show | Hide Preview_
    _`⌘ ⌥ p` Show | Hide Path Bar_
    _`⌘ ⌥ s` Show | Hide Sidebar_
    _`⌘ ⌥ t` Show | Hide Tool Bar_
    _`⌘ /` Show | Hide Status Bar_

### File & Edit

- File
    `⌘ n` New
    `⌘ o` Open
    `⌘ s` Save
    `⌘ p` Print
    `⌘ ⇧ S` Save as

- Edit
    `⌘ z` Undo
    `⌘ ⇧ Z` Redo

    `⌘ a` Select All
    `⌘ c` Copy
    _`⌘ ⌥ c` Copy Path_

    `⌘ v` Paste
    `⌘ ⌥ v` Move ( After `⌘ c` )

    `⌘ f` Search
    `⌘ g` Next Match
    `⌘ ⇧ G` Prev Match

    `⌥ ←` Prev Word
    `⌥ →` Next Word

    After text selection, then input:
    `⌘ b` Bold
    `⌘ u` Underline
    `⌘ i` Italic
    `⌘ +` Bigger | Zoom In
    `⌘ -` Smaller | Zoom Out

### Window & Tab

- Window
    <code>⌘ \`</code> Switch windows of the current App
    It's enhanced by App [HyperSwitch](https://bahoom.com/hyperswitch) | [Keyboard Maestro](#Keyboard-Maestro)

    `⌘ ^ f` Toggle Full Screen
    `⌘ ,` Preferences
    `⌘ q` Exit
    `⌘ w` Close

    `⌘ h` Hide
    `⌘ ⌥ h` Hide All Apps But the Front-most
    The manipulation `Hide` is much better than `Minimize` in macOS!
    So I prefer `Hide` to `Minimize`.

    _`⌘ m` Minimize to Dock_
    _`⌘ ⌥ m` Minimize All Windows of the Front-most App_

- Tab
    `⌘ r` Refresh
    `⌘ t` New Tab
    `⌘ 0~9` Select Tab
    ( If there are more than 9 tabs, `⌘ 9` will select the last one. )

    `^ ⇥` Next Tab
    `^ ⇧ ⇥` Prev Tab
    `⌘ ⇥` Next App
    `⌘ ⇧ ⇥` Prev App

    `⌘ [` Backward
    `⌘ ]` Forward

### Input Sources

- Select
    `⌥ 凵` Switch Input Sources <sup>custom</sup>
    `⌘ ^ 凵` Emoji & Symbols

    `⇪` Caps : Switch Chinese Input Source <sup>_custom_</sup>
    `⇧` Shf | `⎋` Esc : Press Shf or Esc to Switch English Input Source, when using Chinese input source <sup>_custom_</sup>
    ( for the convenience of the Vim users when using Chinese input sources. )

- Pinyin - Simplified (macOS built-in)
    `[` Page Up
    `]` Page Down
    `⇥` Sort By
    `0~9` Select
    _`^ ⇧ 凵` Trackpad Handwriting_

- Sogou Input <sup>__Now I use__</sup>
    Right `⇧` Switch to Smart English Input Mode (when using Chinese Input Mode)
    All else low-frequency shortcuts are disabled.

- ~~Baidu Input~~
    _`^ t` [ Simple | Traditional ] Chinese Characters_
    _`^ .` [ Chinese | English ] Punctuation Marks_
    _`⇧ 凵` [ 全角 | 半角 ] Punctuation Mark Types_
    _`^ p` [ 全拼 | 双拼 ] Chinese Input Modes_
    _`⌥ ⇧ B` Emoji & Symbols_
    _`⌥ ⇧ 凵` Add a space between Chinese & English_

### Emacs Mode

A few people know that it's supported in  by default in macOS.
They may work, if you append some modifier keys to them.

- Default
    `^ f` = `←`
    `^ b` = `→`
    `^ p` = `↑`
    `^ n` = `↓`
    `^ a` = `⌘ ←` Home
    `^ e` = `⌘ →` End

    `^ h` = `⌫` Del
    _`^ d` = `Fn ⌫` Forward Del_
    `^ k` Del to the End of the Line
    `^ t` Exchange the Charactors before & after the cursor
    `^ o` Insert a Blank Line `'\n'` after the cursor

    They are also enabled by `Zsh` ( in `.zshrc` ) and `Vim` ( in `.vimrc` ) in iTerm 2 ( Terminal ).

- Moreover modified by `Keyboard Maestro`
    `^ p` = `⌥ ←` Move to Prev Word <sup>_custom_</sup>
    `^ n` = `⌥ ←` Move to Next Word <sup>_custom_</sup>
    `^ w` = `⌥ ⌫` Del Preceding Word <sup>_custom_</sup>
    `^ u` = [ `^ a`, `^ k` ] Del the Whole Line <sup>_custom_</sup>
    `^ j` = `↩` Return <sup>_custom_</sup>

    These modifications can be supported in `Karabiner-Elements` too.

- Ref : [Keyboard Shortcuts ( Emacs ) for Editing Text Fields in OS X](http://jblevins.org/log/kbd)

### Activity Monitor

`⌘ ⌥ f` Filter Processes
`⌘ ⌥ q` Quit the selected Process

### Mail

`⌘ ^ s` <sup>_custom_</sup> | `⌘ ⇧ N` <sup>default</sup> Get All New Mail

`⌘ r` Reply
`⌘ ⇧ r` Reply All
`⌘ ⇧ f` Forward
`⌘ ⇧ L` Red Flag_
`⌘ ⌥ f` Mailbox Search

_`⌘ 1` Inbox_
_`⌘ 2` Sent_
_`⌘ 3` Drafts_

## Crazy Remappings

- What to do :
    - __Remap__ the key codes.
    - __Open or Switch__ to the specified __app or URL__.
- Supported by
    - [__Keyboard Maestro__](#Keyboard-Maestro)
    - [__Karabiner-Elements__](#Karabiner-Elements)

### [Keyboard Maestro](https://www.keyboardmaestro.com/main/)

- Global Macro
    _`⌘ ^ ⇧ O` Toggle All Micro_

- Search in Web
    `⌘ ^ ⇧ A` Amazon
    `⌘ ^ ⇧ B` Baidu
    `⌘ ^ ⇧ D` Douban
    `⌘ ^ ⇧ G` Google
    `⌘ ^ ⇧ J` JD.com
    `⌘ ^ ⇧ M` Tmall
    `⌘ ^ ⇧ T` Taobao
    `⌘ ^ ⇧ W` Weibo
    `⌘ ^ ⇧ Z` Zhihu

- Abbrs
    Regular : Type `|[a-zA-Z0-9]+` | `[a-zA-Z0-9]+|` → Extend | Rewrite …
    For examples :

    - Dates
        Type string `|hm`, it will be replaced by the time string `hh:mm`
        Type `|ymd`, replaced by `yy/MM/dd`
        `|d ` → `YYYYMMdd`
        `|d-` → `YYYY-MM-dd`
        `|d/` → `YYYY/MM/dd`
        `|d.` → `YYYY.MM.dd` …

    - Symbols
        `|up` → `↑`
        `|dn` → `↓`
        `|lf` → `←`
        `|rg` → `→`
        `|tab` → `⇥`
        `|shf` → `⇧`
        `|opt` → `⌥`
        `|cmd` → `⌘`
        `|ret` → `↩` …

    - Words
        `|http` → `HTTP`
        `|db` → `database`
        `|rm` → `remove`
        `desc|` → `description`
        `env|` → `environment` …

    - Commands
        `|vh` → `sudo vim /etc/hosts`
        `|vp` → `sudo vim /etc/php.ini`
        `|snr` → `sudo service nginx restart`
        `|spr` → `sudo service php-fpm restart` …

    - Links
        `|blog` → `https://icehe.me` …

    - Mails
        `|qm` → `666@qq.com` …

    - Numbers
        `|127` → `127.0.0.1` …

### [Karabiner-Elements](https://pqrs.org/osx/karabiner/index.html)

Changes not only the shortcuts but also the keyboard key-remappings!

- Quit
    `⌘ q, ⌘ q` Double tap `⌘ q` to send one real keystroke `⌘ q`

- Prefix Key `⌥ ⇥`
    It's used to prevent you from launching the unwanted App when pressing its shortcut by accident.
    Only when you pressed Pf Key at first and then the App shortcut, did it launch.

- Change Modifier-Key-Remapping
    `⌘` Rg Cmd →  `⎋` Esc
    `⇪` Caps → `^` Lf Ctrl
    `^` Lf Ctrl → `⇪` Caps

- Functional Keys
    `Functional Keys` → `F1` ~ `F12`
    `Fn + Functional Keys` → `Functional Keys`

- Input Sources ( abbr : IS )
    - `⇪` Caps ( current pos is Lf `^` ) → to Chinese Input Source
        How to implement:
        App `Karabiner-Elements` : `⇪` Caps → `F19`
        App `Keyboard Maestro` : `F19` → to Chinese IS ( [Ref](https://sspai.com/post/37962) )

    - `⇧` Shf | `⎋` Esc → English Input Source
        Press Shf or Esc alone to switch English IS, when using Chinese IS.
        ( for the convenience of the Vim users when using Chinese IS. )
        How to implement:
        App `Karabiner` : Press Lf Rg `⇧`, Rg `⌘`, `⎋` alone will trigger `F18`
        App `Keyboard Maestro` : `F18` → to US English IS

    - How to switch two input sources stably?
        ( I cannot find a stable method to switch IS if more than 2 ISs exist on macOS. )
        ( Stable : Your operation always work. <sup>>99%</sup> )
        There must be only two active ISs on macOS.
        Keyboard Maestro ( abbr : KM ) gets current input source via shell command `inputsource` ( [Ref](https://github.com/hnakamur/inputsource) ).

        For example, press `⇪` Caps ( current pos is Lf `^` ) :
        if result of command `inputsource` does not match `com.baidu.inputmethod.BaiduIM.pinyin`,
        KM will trigger keystroke `⌥ 凵` to switch to IS Baidu Input or else.

        Press `⇧` Shf or `⎋` Esc alone when using Chinese Input :
        if result of command `inputsource` does not matches `com.apple.keylayout.US`,
        KM will trigger keystroke `⌥ 凵` to switch to IS English Layout or else.

### App Switcher

- or else

#### Layout `凵`

- 0123 …
    `凵 1` iTerm2
    `凵 2` [2Do](#2Do)
    `凵 3` [Sublime Text](#Sublime-Text)
    `凵 4` Chrome
    `凵 5` Safari
    `凵 7` [Keyboard Maestro](#Keyboard-Maestro)
    `凵 8` [Karabiner-Elements](#Karabiner-Elements)

- asdf …
    `凵 asdfghjkl;` = `1234567890`

- Symbols
    <code>凵 \`</code> = <code>⇧ \`</code> = `~`
    `凵 -` = `⇧ -` = `_`
    `凵 =` = `⇧ =` = `+`
    `凵 [` = `⇧ [` = `{`
    `凵 ]` = `⇧ ]` = `}`
    `凵 \` = `⇧ \` = `|`
    `凵 '` = `⇧ '` = `"`

#### Layout `⌥` `⇧` `^`

- 1234 …
    <code>⌥ \`</code> [1Password](#1Password)
    `⌥ 1` [Trello](#Trello)
    `⌥ 2` System Preferences
    `⌥ 3` Notes

    `⌥ ⇧ 1` [Script Editor](#Script-Editor) ( AppleScript )

- qwer …
    `⌥ q` [QQ](#QQ)
    `⌥ w` WeChat
    `⌥ e` [Outlook](#Outlook) ~~[Mail](#Mail)~~
    `⌥ r` Preview
    _`⌥ t` Timeout_

    `⌥ i` Prompt the local IP address
    `⌥ p` Postman
    `⌥ \` [1Password](#1Password) ( Mini )

    _`⌥ ⇧ W` Word_
    _`⌥ ⇧ T` Thunder_
    _`⌥ ⇧ P` PowerPoint_
    `⌥ ⇧ E` Evernote
    _`^ ⌥ ⇧ E` Excel_
    _`⌥ ⇧ I` iTunes_

    _`^ ⌥ ⇧ T` Type String ( in clipboard ) inseted of Paste_

- asdf …
    `⌥ a` [Activity Monitor](#Activity-Monitor)
    `⌥ s` [PhpStorm](#PhpStorm)
    `⌥ d` EuDic
    `⌥ f` [Finder](#Finder)
    `⌥ g` GoLand

    `⌥ h` Photos
    `⌥ j` IntelliJ IDEA
    `⌥ k` Numi ( Calculator )
    `⌥ l` CLion
    `⌥ ;` Input the symbol `…`

    `⌥ ⇧ A` PyCharm
    `^ ⌥ ⇧ A` App Store
    _`⌥ ⇧ S` Share Safari Page to Notes_
    _`^ ⌥ ⇧ S` Sequel Pro ( MySQL )_
    `⌥ ⇧ D` Dictionary
    _`⌥ ⇧ F` Search in All Files_
    `⌥ ⇧ G` Acrobat Reader ( PDF )

    `⌥ ⇧ J` Eject the disks
    _`⌥ ⇧ K` Calculator_
    `⌥ ⇧ L` Do something when logging in

- zxcv …
    `⌥ x` Xiami Music
    `⌥ c` [Charles](#Charles)
    `⌥ v` [ClipMenu](#ClipMenu) - Clipboard History
    `⌥ n` [NeteaseMusic](#NeteaseMusic)
    `⌥ m` [MindNode](#MindNode) ( `b` for Brainstorm )

    _`⌥ ⇧ C` Copied_
    _`^ ⌥ ⇧ C` Calendar_
    `⌥ ⇧ V` [ClipMenu](#ClipMenu) - Snippets
    `^ ⌥ ⇧ V` [ClipMenu](#ClipMenu) - Main Menu

    `⌥ ⇧ M` Messages
    `^ ⌥ ⇧ M` Send Clipboard to iPhone by Messages
    _`⌥ ⇧ N` Numbers_

#### Layout `Fn`

- Arrange the windows
    Aka `Resize & Move` the windows. ( Frequently Used )
    These features can be supported by [Moom](https://manytricks.com/moom/) | [Spectacle](https://www.spectacleapp.com/) | [Keyboard maestro](#Keyboard-maestro).

    `Fn d` Lf 1/2
    `Fn f` Rg 1/2
    `Fn e` Lf 3/5
    `Fn r` Rg 3/5

    `Fn g` Fit to Desktop
    `Fn t` Fit to Center 1/2

    `Fn q` Top Lf 1/4
    `Fn w` Top Rg 1/4
    `Fn a` Btm Lf 1/4
    `Fn s` Btm Rg 1/4

- Direction Keys
    They're Vim-like.
    `Fn h` = `←` Lf
    `Fn j` = `↓` Dn
    `Fn k` = `↑` Up
    `Fn l` = `→` Rg

- Others
    `Fn u` = `⇪`

#### Layout `⎋`

- qwer …
    `⎋ q` [QQMail](https://mail.qq.com/)
    `⎋ w` [Weibo](https://weibo.com)
    `⎋ e` Official ERP
    `⎋ r` Redmine
    `⎋ t` GitLab Proj Tags

    `⎋ i` GitLab Proj Issue Board
    `⎋ o` GitLab Proj Contributors
    `⎋ p` [PHP.net](http://php.net/)
    `⎋ [` | `⎋ ]` GitLab Projs' Pipelines

- asdf …
    `⎋ a` GitLab Proj Branches
    `⎋ s` | `⎋ v` GitLab Projs' Repositories
    `⎋ d` | `⎋ f` GitLab Projs' Merge Requests
    `⎋ g` [Google](https://www.google.com/)

    `⎋ h` [GitHub](https://github.com/IceHe)
    `⎋ j` Jenkins
    `⎋ k` Kibana
    `⎋ l` [localhost:4000](http://127.0.0.1:4000/)

- zxcv …
    `⎋ z` GitLab User Profile
    `⎋ x` Open Link ( in clipboard ) in Safari
    `⎋ c` Open Link ( in clipboard ) in Chrome
    `⎋ b` [Baidu](https://www.baidu.com/)
    `⎋ n` GitLab Proj Issue List
    `⎋ m` [IceHe.me](https://icehe.me)

## System Assistant

### [1Password](https://1password.com/)

`⌘ \` Fill Login on current web page
`⌥ \` Show 1Password Mini

`⌘ e` Edit
`⌘ s` Save

### [Amphetamine](https://itunes.apple.com/us/app/amphetamine/id937984704?mt=12)

`⌥ F12` Mac Stays Awake
`^ ⌥ F12` Allow Mac to Sleep

### [CheatSheet](https://www.mediaatelier.com/CheatSheet/)

`Long Press ⌘` Show Tips

### [ClipMenu](http://www.clipmenu.com/)

`⌥ v` History
`⌥ ⇧ V` Snippets
`^ ⌥ ⇧ V` Main Menu

### [ShadowsocksX-NG](https://github.com/shadowsocks/ShadowsocksX-NG)

`^ ⌥ p` Toggle Proxy Mode: Auto PAC / Global
`^ ⌥ ⇧ S` Toggle Shadowsocks On / Off

### [TotalFinder](https://totalfinder.binaryage.com/)

`⌘ u` Toggle Dual Mode

## Development

### [PhpStorm](https://www.jetbrains.com/phpstorm/)

- References
    Quick Guide : `PhpStorm` → `Help` → `Keymap Reference`
    Advance Settings : `PhpStorm` → `Preferences…` → `Keymap`

- Refactor
    `^ ⌥ t` Refactor This
    `^ ⌥ o` Optimize Imports

    `⌘ ⌥ l` Reformat Code
    The rules for reformation can be modified in :
    `Preferences` → `Editor` → `Code Style` → Select the programming language.

    `⌘ ⌥ e` Rename `$variableName`, `ClassName`, `functionName` ( Auto rename other related code )
    `⌘ ⌥ n` Inline Variable
    `⌘ ⌥ v` Extract Variable
    `⌘ ⌥ m` Extract Method
    `⌘ ⌥ f` Extract Field
    `⌘ ⌥ c` Extract Constant
    _`F5` Copy File_
    _`F6` Move File_

- Code
    _`^ 凵` Auto Complete_

    `⌘ /` Line Comment
    _`⌘ ⌥ /` Block Comment_

    _`⌥ ↑` Extend Selection_
    _`⌥ ↓` Shrink Selection_

    `⌥ ↩` Show Intention Actions
    _`⌘ ⇧ ↩` Complete Current Statement_

    _`^ ⌥ h` Toggle Parameter Name_
    _`^ ⌘ g` Select All Occurrences_
    _`^ ⇧ I` Inspect Code_
    <!-- _`⌘ ⇧ V` Copy from History_ -->

- Debug
    `^ ⇧ B` Toggle Line BreakPoint
    `^ ⇧ E` Edit BreakPoint ( Break if conditional is true)
    `^ ⇧ V` View BreakPoints
    `^ ⇧ W` Add to Watches
    `^ ⌥ w` Add to Watches

    `^ ⇧ R` Run…
    `^ ⇧ A` Rerun
    `^ ⇧ D` Debug
    `^ ⇧ S` Stop

    `^ ⇧ I` Step Into
    `^ ⇧ O` Step Out

    `^ ⇧ N` Resume Program ( Next BreakPoint )
    `^ ⇧ J` Step Over ( Next Line )

- File
    `⌘ ⇧ C` Copy Path
    `^ ⌥ r` Copy Reference ( `File:Line` | `Class::method()` )
    _`⇧ ↩` Open in a new Editor Window_ ( in Project View)

- Find
    `⌘ f` Find
    `⌘ ⇧ F` Find in Paths
    `⌘ r` Replace
    `⌘ ⇧ R` Replace in Paths
    `⌘ g` Find Next
    `⌘ ⇧ G` Find Prev

    `^ ⌥ g` Toggle Regex
    _`^ ⌥ c` Toggle Case Sensitive_

    `^ g` Find Usage
    `⌘ o` Find Class
    `⌘ ⇧ O` Find File
    `⌘ ⌥ o` Find Symbols ( Class, Files, Methods, Functions )
    <!-- _`⇧, ⇧` Search (Everything) Everywhere_ -->

<!-- _`⌘ ⇧ A` Find Actions_ -->

- Navigate
    `F2` Next Highlighted Error
    `⇧ F2` Prev Highlighted Error
    `⌥ F1` Select current file or symbol in any view

    `⌘ j` Next Method
    `⌘ k` Prev Method

    `⌘ e` Recent Files
    `⌘ ⇧ E` Recently Edited Files

    `⌘ ⇧ T` Test Subject : Jump to Test for current file | Create Test for it
    _`⌘ u` Super Class or Interface_
    _`⌘ ↑` Navigation Bar_

    `⌘ 1~9` Jump to the specified Tool Window | Hide it
    `⌘ 1` Project
    _`⌘ 2` Favorites ( Projects, Bookmarks, Breakpoints )_
    `⌘ 3` Find
    `⌘ 4` Debug
    …
    _`⌘ 9` Version Control_

    `^ m` Toggle Bookmark
    `^ ⌥ m` View Bookmarks
    `^ ⌥ j` Next Bookmark
    `^ ⌥ k` Prev Bookmark

    `⌘ 6` Todo
    `⌘ 7` Structure

- VCS: History & Compare
    `^ ⌥ l` Local History -> Show History
    `^ ⌥ a` Git -> Annotate
    `^ ⌥ v` Git -> Compare with the Same Repository Version

    `^ ⌥ b` Git -> Compare with Branch …
    `^ ⌥ .` Git -> Compare with …
    `^ ⌥ c` Git -> Resolve Conflicts

    _`⌘ t` Update Porject from VCS_
    _`^ ⇧ C` Commit Project to VCS_
    _`⌘ ⌥ g` 'VCS' Operations Quick Popup_

- Tools
    `⌘ ^ h` Hide All Tool Windows
    _`^ ⌥ q` Terminal_
    _`^ ⌥ s` Test RESTful Web Service_

    `⌘ ⇧ ↑↓←→` Extend | Shrink Tool Window

#### [IdeaVim](https://plugins.jetbrains.com/plugin/164?pr=idea)

It is the best Vim-Emulator plugin for IDEs from [JetBrains](https://www.jetbrains.com/).
Its most keys are the same as Vim, so I just list my custom keys.
My config file [__.ideavimrc__](https://github.com/IceHe/macos-home-conf/blob/master/.ideavimrc)

- Ctags Like
    `^ ]` Find Declaration
    `^ t` Back from Declaration

- Tab
    `H` Prev Tab
    `L` Next Tab

    `,` Leader Key
    `,` `a` = `1gt`
    `,` `s` = `2gt`
    … d f g h j k …
    `,` `l` = `9gt`
    `,` `;` = `10gt`
    `,` `1` = `11gt`
    `,` `2` = `12gt`
    …
    `,` `9` = `19gt`
    `,` `0` = `20gt`

- Mimic Emacs in Insert Mode:
    `^ b` = `←`
    `^ f` = `→`
    `^ p` Forward Word
    `^ n` Backward Word

    `^ a` = `Home`
    `^ e` = `End`

    `^ k` Del to End of Line
    `^ u` Del to Head of Line
    `^ t` Exchange Chars ( Before & After Cursor )

- Vim-Surround
    `ds*` Delete Surround
    such as `ds'` `ds"` `ds[` `ds{` <code>ds\`</code> `dst` ( `t` for HTML Tag ) …

    `ys**` Add Surround :
    1st `*` for Postion ( Start or Stop )
    2rd `*` for Surround Char (or HTML Tag)
    such as `yse'` `ysW"` `ysfb[` `ysTh{` …

    `cs**` Change Surround
    1st `*` for Current Surround Char
    2rd `*` for New Surround Char
    such as `cs'"` `cs[{` `cst<p>`…

- Others
    `^ r` = `:redo<CR>` Redo
    `⇧ K` = `Jx` Join curren line and next line without breaking concated spacing

#### [JetBrains](https://www.jetbrains.com/)

The shortcuts in other IDEs from JetBrains are same as PhpStorm,
such as CLion , IntelliJ IDEA , RubyMine , PyCharm and so on.
All the shortcuts can be modified in `Preferences` → `Keymap`!

### [Sublime Text](https://www.sublimetext.com/)

- Cursor Position
    `^ i` Jump Forward
    `^ o` Jump Backword

- Find & Replace
    `⌘ f` Find
    `⌥ ↩` Find All
    `⌘ r` Find Files

    `⌘ ⌥ f` Replace
    `⌘ ⌥ e` Replace one by one
    `^ ⌥ ↩` Replace All

    `⌘ ⌥ r` Toggle Regular Expression
    `⌘ ⌥ c` Toggle Case Sensitive

- Selection
    `⌘ d` Expand Selection to Word
    `^ ⇧ M` Expand Selection to Brackets
    `⌘ ⇧ L` Split into Lines

<!-- _`^ l` Scroll to the Selection_ -->

<!--
- Bookmarks
    `⌘ F2` Toggle Bookmark
    `F2` Next Bookmark
    `⇧ F2` Prev Bookmark
    `⌘ ⇧ F2` Clear All Bookmarks
-->

- Layout
    `⌘ ⌥ 1~4` 1~4 Columns
    _`⌘ ⌥ 5` Grid_
    _`⌘ ⌥ ⇧ 2~3` 2~3 Rows_

- Command Palette…
    `⌘ p` Quick Open File
    `⌘ ⇧ P` Command Palette…
    `⌘ ⇧ C` Copy File Path
    `^ s` Trim Trailing Whitespace

- Sidebar
    `⌘ k` `⌘ b` Toggle Sidebar

### [Charles](https://www.charlesproxy.com/)

- Proxy
    `⌘ r` [ Start | Stop ] Recording
    _`⌘ t` Start | Stop Throttling_
    _`⌘ k` Enable | Disable Breakpoints_

    _`⌘ ⇧ t` Throttle Settings_
    _`⌘ ⇧ k` Breakpoint Settings_
    _`⌘ ⇧ p` macOS Proxy_

- Session
    `⌘ ⌫` Clear
    _`⌘ o` Open_
    _`⌘ n` New_
    _`⌘ s` Save Request_
    _`⌘ ⇧ s` Save As …_

<!-- `⌘ l` Error Log -->

- View
    `⌘ 1` Overview
    `⌘ 2` Request
    `⌘ 3` Response
    _`⌘ 0` Sequence_
    _`⌘ 9` Structure_
    _`⌘ ⇧ H` Focused Hosts_

<!--
    _`⌘ 4` Summary_
    _`⌘ 5` Chart_
    _`⌘ 6` Note_

    _`⌘ ⇧ V` Viewer Mappings_
-->

- Tools
    `⌘ ⇧ R` Repeat
    `⌘ ⇧ D` DNS Spoofing Settings <sup>_custom_</sup>
    `⌘ ⌥ m` Map Remote

    `⌘ m` Compose ( Modify )
    _`⌘ ⇧ M` Compose New_

    _`⌘ ⌥ l` Map Local_
    _`⌘ ⌥ d` No Caching_
    _`⌘ ⌥ c` Block Cookies_

    _`⌘ ⌥ r` Rewrite_
    _`⌘ ⌥ b` Black List_
    _`⌘ ⌥ w` White List_

    _`⌘ ⌥ i` Mirror_
    _`⌘ ⌥ a` Rewrite_

### Script Editor

`⌘ ⇧ O` Open Dictionary
`⌘ r` Run the script
`⌘ .` Stop the script

## CLI

### [iTerm2](https://www.iterm2.com/)

Due to the help from `tmux` and `Zsh`, I don't need much support from `iTerm` as follows.
`⌘ 0~9` Switch Tab

### [tmux](https://tmux.github.io/)

More details in [__Official Docs__](http://www.openbsd.org/cgi-bin/man.cgi/OpenBSD-current/man1/tmux.1?query=tmux&sec=1).
My config file [__.tmux.conf__](https://github.com/IceHe/macos-home-conf/blob/master/.tmux.conf)

`^ q` Prefix Key ( aka `Pf` )
The description `Pf, *` implies that tap `Pf` at first and then tap the key `*`.

`Pf, ⇧ ?` List Keys
`Pf, d` Detach Client
`Pf, c` New Window
`Pf, s` Reload config file `.tmux.conf`

`Pf, \` Split Window Horizontally
`Pf, -` Split Window Vertically

`Pf, ^ y` Resize Pane Lf
`Pf, ^ u` Resize Pane Dn
`Pf, ^ i` Resize Pane Up
`Pf, ^ o` Resize Pane Rg

`Pf, h` Select Lf Pane
`Pf, j` Select Dn Pane
`Pf, k` Select Up Pane
`Pf, l` Select Rg Pane

`Pf, ↑` Maximize Current Pane in New Window
`Pf, ↓` Put Current Pane back to its Parent Window

`Pf, [` Use Vim-like keys to copy str at Copy Mode

In Copy Mode:
`v` Begin Selection
`y` Copy Selection
`u` Copy Selection & Exit Copy Mode
`⇧ L` Copy Line ( & Exit Copy Mode )

### [Vim](http://www.vim.org/)

Only list the useful keys that I’m unfamiliar with here.
My config file [__.vimrc__](https://github.com/IceHe/macos-home-conf/blob/master/.vimrc)

- Mv Cursor
    _`^ o` | `^ i` [ Prev | Next ] Cursor Pos_
    `{` | `}` [ Prev | Next ] Blank Line

    `w` | `⇧ W` Head of Next [ Word / Str ]
    `e` | `⇧ E` Tail of Next [ Word / Str ]

    `b` | `⇧ B` Head of Prev [ Word / Str ]
    `ge` | `gE` Tail of Prev [ Word / Str ]

    `;` Repeat the last manipulation about `f` `t` `⇧ F` `⇧ T`
    `0` Head of Line
    `^` = `⇧ 6` Head of Line ( Non-Whitespace )
    `$` = `⇧ 4` End of Line

    `"` Switch to some Register
    _`-` Head of Prev Line_
    _`⇧ +` Head of Next Line_

<!--
- [EasyMotion](https://github.com/easymotion/vim-easymotion)

    It's a Vim plugin. [spf13-vim](http://vim.spf13.com/) makes it easier to use:

    1. In normal mode `,`, `,` ( Twice ) then input a cursor motion instruction,
        such as `w`, `e`, `b`, `f*`, `F*`, `t*`, `T*` or etc.
    2. The screen will display some keycues.
    3. If you input one of the keycues, then your cursor will get to the specified place.
-->

- Select Range
    `ciw` Del Word
    `caw` Del Word including the Following Spaces 凵

    `dw` Del until Head of Next Word
    `de` Del to End of Cur Word

    `ci*` Select & Manipulate the string surrounded by `*`.
    `ca*` Select & Manipulate the string surrounded by `*` including `*`.

- Column Edit Mode
    Example :
    1. In normal mode `^ v` then select a block area
    2. `⇧ I` then type some string to insert
    3. `⎋`, `⎋` ( Twice ) to apply the insertion at each line heading of the selected block area


- Command
    `.` Repeat Command

- Cp & Join
    `⇧ Y` Copy from the cursor to the end of line
    `⇧ K` Join curren line and next line without breaking

- Del
    `x` Del Char Forward ⌦
    _`⇧ X` Del Char Backward ⌫_

    `s` Del Char Forward & then Insert
    `⇧ S` Del Current Line & then Insert
    `⇧ C` Del to End of Line & then Insert
    `⇧ D` Del to End of Line

- Exchange
    `xp` Exchange the Current Char and the Next Char
    `ddp` Exchange the Current Line and the Next Line

- Lower or Upper Case
    `⇧ ~` Toggle Case & Mv Cursor to Next char
    `u` to Lowercase
    `⇧ U` to Uppercase

- Increase or Decrease Num
    In Normal Mode:
    `^ a` Increase Num
    `^ x` Decrease Num

- Macro
    `q a~z|A~Z` Start Recording Macro marked as `a~z|A~Z`
    `q` Stop Recording
    `@ a~z|A~Z` Play Macro marked as `a~z|A~Z`
    `@@` Repeat Macro that you last used

- Check Encoding Value
    `ga` Show ASCII of Char
    `g8` Goto UTF-8 of Char

- Open Path
    `gf` Open Path where cursor is

- Save & Quit
    `^ s` = `:w` Save ( valid in both Insert & Normal Mode )
    `⇧ ZZ` Save & Quit
    `⇧ ZQ` Quit without Saving

- CTags ( plugin )
    `^ ]` Find Declaration
    `^ t` Back from Declaration

- Mimic Emacs in Insert Mode
    `^ b` = `←`
    `^ f` = `→`
    `^ p` = `↑`
    `^ n` = `↓`

    `^ a` = `Home`
    `^ e` = `End`

    `^ k` Del to End of Line
    `^ u` Del to Head of Line
    `^ t` Exchange Chars ( Before & After Cursor )

- Window
    `^w`, `n` = `:new<CR>` New Horizontal Split ( editing new empty buffer )
    `^w`, `s` = `:split<CR>` Split Window Horizontally ( editing current buffer )
    `^w`, `v` = `:vsplit<CR>` Split Window Vertically ( editing current buffer )
    `^w`, `c` = `:close<CR>` Close Window
    `^w`, `o` = `:only<CR>` Close All Windows But only the Current

    `^w`, `w` Go to Next window
    `^w`, `p` Go to Prev window
    `^w`, `↑` Go to window Above
    `^w`, `↓` Go to window Below
    `^w`, `←` Go to window on Left
    `^w`, `→` Go to window on Right

- Tab
    `:tabedit [path/to/file]<CR>` Open Existing File in New Tab
    `,`, `t` = `:tabedit<space>`
    `:edit [path/to/file]<CR>` Open Existing File in Current Tab
    `,`, `e` = `:edit<space>`

    `:tabnew<CR>` Open New Empty Tab
    `:tabc<CR>` Close Current Tab
    `:tabo<CR>` Close all Other Tabs But only the Current

    `L` = `gt` = `:tabn<CR>` Next Tab
    `H` = `gT` = `:tabp<CR>` Prev Tab

    `,`, `a` = `1gt` to Tab 1
    `,`, `s` = `2gt` to Tab 2
    … d f g h j k …
    `,`, `l` = `9gt` to Tab 9
    `,`, `;` = `10gt` to Tab 10
    `,`, `1` = `11gt` to Tab 11
    `,`, `2` = `12gt` to Tab 12
    …
    `,`, `9` = `19gt` to Tab 19
    `,`, `0` = `20gt` to Tab 20

    `,`, `W` = `:tabm<space>-1<CR>` Move Tab Left
    `,`, `E` = `:tabm<space>+1<CR>` Move Tab Right

- Comment
    `,`, `;` = `^i;<Esc>` Comment `"`
    `,`, `'` = `^i"<Esc>` Comment `"`
    `,`, `#` = `^i#<Esc>` Comment `#`
    `,`, `/` = `^i//<Esc>` Comment `//`
    `,`, `?` = `^xx<Esc>` Revert Comment `//`
    `,`, `!` = `^i<!-- <Esc>$a --><Esc>` Comment `<!-- … -->`
    `,`, `>` = `^xxxxx$xxxx` Revert Comment `<!-- … -->`


- Search & Replace
    - `:%s/search_str/replace_str/gci`
        - `:` switch to Command Mode
        - `%` find __each occurence__ of `search_str`
        - `s` replace operation
        - `g` replace __globally__
        - `c` ask for __confirmation__
        - `i` __case insensitive__ , `I` case __sensitive__
    - `:'<,'>s/foo/bar/g`
        - `'<,'>` replace __within a visual selection__ (when compiled with +visual)
    - `:5,12$/foo/bar/g`
        - `5` , `12` start from line 5 to the line 12
    - `:.,$/foo/bar/g`
        - `.` , `$` start from the __current line__ to the __last line__
    - `:.,+2s/foo/bar/g`
        - `.` , `+2` start from the current line to the __next two lines__
    - `:'a,'bs/foo/bar/g`
        - `'a` , `'b` start from the __mark a__ to the __mark b__
    - `:g/^baz/s/foo/bar/g`
        - Change each 'foo' to 'bar' in __each line starting with 'baz'__
    - Ref : [__Search and replace__](http://vim.wikia.com/wiki/Search_and_replace) & [__Vim 字符串替换及小技巧__](http://xstarcd.github.io/wiki/vim/vim_replace_encodeing.html)


- Others
    `,`, `h` = `:set noh<CR>` Deactivate Highlighted
    `,`, `n` = `:set nu!<CR>` Toggle Absolute Line Number
    `,`, `r` = `:set rnu!<CR>` Toggle Relative Line Number


- [Vim Cheat Sheet](http://coolshell.cn//wp-content/uploads/2011/09/vim_cheat_sheet_for_programmers_print.png) - Image
- More details in [Official Docs](http://www.vim.org/docs.php).

### [Zsh](http://zsh.sourceforge.net/)

My config file [__.zshrc__](https://github.com/IceHe/macos-home-conf/blob/master/.zshrc)

- Emacs Mode
    `^ a` Mv Cursor to Head of Line
    `^ e` Mv Cursor to End of Line

    `^ w` Del Word
    `^ k` Del to End of Line
    `^ u` Del Line

    _`^ p` Backward Word
    _`^ n` Forward Word

    _`^ f` Mv Cursor Rg_ ( I use `Fn l` instead. )
    _`^ b` Mv Cursor Lf_ ( I use `Fn h` instead. )

    `^ h` Del Backward ⌫ ( I used to use `⌫`. )
    `^ d` Del Forward ⌦ ( seldom used )

    `^ l` Clear Screen

- Extra
    `^ _` Undo
    _`^ y` Yank_

    `⎋`, `h` Run Help for current Cmd
    _`⎋`, `'` Quote Line_

    _`⎋`, `q` Push Line_
    _`⎋`, `g` Get Line_

    `^ v` Edit Command Line in Vim
    `^ x`, `a` Expand Alias
    `^ x`, `^ v` Vi Cmd Mode
    `^ x`, `^ e` Edit Command Line in Vim
    _`^ x`, `^ b` Vi Macth Bracket_


- Aliases ( see in [.zshrc](https://github.com/IceHe/oh-my-zsh/blob/master/.zshrc) )
    such as :
    `alias d='docker'`
    `alias g='git'`
    `alias gco='git checkout'`
    `alias gd='git diff'`
    `alias gs='git status'`
    …
    `alias la='ls -hA'`
    `alias ll='ls -hl'`
    `alias lla='ls -hlA'`
    `alias v='nvim'`
    `alias vh='v /etc/hosts'`
    …
    `alias zl='cd ~/Documents'`
    …

- Ref : [oh-my-zsh](http://ohmyz.sh/) & [Official Docs](http://zsh.sourceforge.net/Doc/).

## Other Tools

### [2Do](https://www.2doapp.com/)

I don't want to list all its shortcuts, as there are so many…

`⌘ s` Sync

- View
    `⌘ 0` Inbox
    _`⌘ 1` All_
    `⌘ 2` Today
    _`⌘ 3` Starred_
    _`⌘ 4` Scheduled_
    _`⌘ 5` Done_

    _`⌘ ↑` Prev List_
    _`⌘ ↓` Next List_
    _`⌘ ⌥ ↑|↓` [ Collapse | Expand ] All Projects_
    _`⌘ ⇧ ↑|↓` [ Collapse | Expand ] All List Groups_

- Edit
    `0 ~ 3` Priority : None | Low | Medium | High
    `s` Star
    `^ s` Unstar

    `d` Due Date
    `e` Due Time
    `k` Schedule ( Start Date )

    `t` Start Today
    `^ t` Due Today
    `y` Start Yesterday

    `⌘ /` Dates
    `⌘ e` Notes

    `⌘ ^ ⇧ 1` Convert to a Task
    `⌘ ^ ⇧ 2` Convert to a Project
    `⌘ ^ ⇧ 3` Convert to a Checklist

    `⌘ l` Move to another list

    `⌘ .` Mark as Completed
    `⌥ ⌘ .` Mark as Not Completed

    `⌘ ;` Recurrence ( aka Repeat )
    `⌘ '` Alerts

<!--
    `l` Tag
    `⌘ r` Tags

    `^ ⌘ ↑|↓` Move Up | Down
-->

### [Chrome](https://www.google.com/chrome/browser/desktop/index.html)

- Usual
    `⌘ l` Edit Address Bar
    `⌘ d` Bookmarks
    `⌘ ⌥ B` Manage Bookmarks
    `⌘ y` Full History
    `⌘ ⇧ J` Downloads
    `⌘ ⇧ A` Extensions

- Development
    `⌘ ⌥ i` Inspect Elements
    `⌘ ⌥ j` JavaScript Console
    `⌘ ⌥ u` Page Source Code

- Extension
    `⌘ ⇧ E` Evernote Web Clipper
    `⌘ ⇧ O` Activate One Tab
    `⌘ ⇧ D` Display One Tab
    `⌘ ⇧ C` Send Current Tab to One Tab
    `⌘ ⇧ P` Activate SwitchyOmega

#### [cVim](https://chrome.google.com/webstore/detail/cvim/ihlenndgcmojhcghmfjfneahoeklbjjh?hl=en)

It is a Vim-Emulator extension in Firefox.
My config file [__.cvimrc__](https://github.com/IceHe/macos-home-conf/blob/master/.cvimrc)

- Link
    `f` Open Link in Current Tab
    `F` Open Link in New Tab
    `mf` Open Links in New Tabs

- Load
    `r` Refresh
    `R` Refresh ( including Cache )

- Navigate
    `z` = `H` Backward
    `b` = `L` Forward

    `gu` Go up one path in the URL
    `gU` Go to the base URL

    `[[` Prev Page
    `]]` Next Page

- Scroll
    - Vertical
        `gg` to Top
        `G` = _`ge`_ to Btm

        `j ` = `凵` Dn a Half Page
        `k ` = `⇧ 凵` Up a Half Page

        `d` Dn a Whole Page
        `q` Up a Whole Page

    - Horizontal
        `h` Lf
        `l` Rg

        _`!` to Most Lf_
        _`$` to Most Rg_

- Tab
    - Open Tab
        `t` New Tab
        `a` Select Tab
        `c` Copy URL of Current Tab to Clipboard
        `S` Duplicate Tab

        `v` Open URL in Clipboard in Current Tab
        `V` Open URL in Clipboard in New Tab

    - Move Tab
        `W` = `<` to Lf
        `E` = `>` to Rg

    - Close / Reopen Tab
        `x` Close Current Tab
        `X` Reopen Last Closed Tab

    - Switch Tab
        `w` = `J` to Prev
        `e` = `K` to Next
        _`gq` to First_
        _`gr` to Last_

        `1` → 1st Tab
        `2` → 2nd Tab
        `3` → 3rd Tab
        …
        `9` → 9th Tab
        `0` → 10th Tab
        `s1` → 11th Tab
        …
        `s0` → 20th Tab

    - Others
        _`gm` Mute / Unmute Tab_
        _`gp` Pin / Unpin Tab_

- Quick Start
    `D` chrome://download
    `ge` chrome://extensions
    `gS` cVim Settings
    `ga` Google
    `gb` Baidu
    `gd` Douban
    `gj` JD
    `gt` Taobao
    `gw` Weibo
    `gz` Zhihu

- Input Box
    `i` Input in First Input Box
    `I` Input in Last Input Box

    `^ n` Forward Word
    `^ p` Backward Word

    `^ h` Delete Char
    `^ k` Delete to End of Line

- Find
    `/` Find
    `?` Find Backword

    `n` Next Match
    `N` Prev Match

- Visual Mode
    `Z` Activaate Visual Mode
    `v` Start Selection
    `y` Copy Selection & Exit Visual Mode

    `h` ← Lf
    `j` ↓ Dn
    `k` ↑ Up
    `l` → Rg

    `w` Mv to Head of Next Word
    `b` Mv to Head of Prev Word

- Others
    `⎋` Cancel
    `Q` Help ( Manual )

### Dictionary

`⌘ ⇧ D` Look Up in Dictionary
`⌘ 0~9` Switch Dictionary

### [EuDict Free](https://www.eudic.net/eudic/mac_dictionary.aspx)

`⌘ R` 朗读当前单词

`⌥ 凵` Light Peek
__`⌘ ⇧ M` Look up Word that Mouse Cursor Hovers__
__`⌘ ⇧ L` Look up Selection__
__`⌘ ⇧ 2` Translate Selection__

### [MindNode](https://mindnode.com/)

- File
    `⌥ ↩` New Mind Map
    `⌥ →` Next Mind Map
    `⌥ ←` Prev Mind Map

- New
    `↩` Append New Sibling
    `⇧ ↩` Prepend New Sibling

    `⇥` New Child
    `⇧ ⇥` New Parent

- Edit
    `⌘ ↩` Edit Title ( Current )

    `⌘ ⇧ K` Note Popover
    `⌘ ⇧ T` Add / Rm Task ( Check Box )
    `⌘ ⇧ U` Toggle Task

    `⌘ k` Add Link
    `⌘ l` Add Connection ( to Another Node )

- Move
    `⌘ ↑` Move Above Sibling
    `⌘ ↓` Move Below Sibling
    `⌘ ⇧ D` Detach Node


- Fold
    `⌘ ⌥ ←` Fold Node
    `⌘ ⌥ →` Unfold Node
    `⌘ ⌥ ↑` Fold All Nodes
    `⌘ ⌥ ↓` Unfold All Nodes

- Select
    `⌘ ⌥ a` All Subnodes

### [NeteaseMusic](http://music.163.com/#/download)

`凵` Play | Pause
`⌘ →` Next
`⌘ ←` Prev
`⌘ ↑` Volume Up
`⌘ ↓` Volume Down

__`⌘ l` Dislike__
__`⌘ r` Show | Hide Lyrics__

### [Outlook](https://outlook.live.com/owa/)

- Usual
    `⌘ k` Send & Receive
    `⌘ r` Reply
    `⌘ ⇧ R` Reply All
    `⌘ j` Forward
    `⌘ ⇧ M` Move to Folder

- Edit
    `⌘ ⌥ R` Ribbon (Toggle Toolbar)
    `⌘ ⇧ V` Paste & Indent
    `^ ⌘ k` Hyperlink…

- Mark
    `⌘ ⇧ J` Mark as Junk
    `⌘ ⇧ T` Mark as Read
    `⌘ ⌥ t` Mark All as Read

- View
    `^ ⇧ [` Prev Pane
    `^ ⇧ ]` Next Pane

- Find
    `⌘ f` Find (current item)
    `⌘ ⌥ f` Advanced Find (current folder)
    `⌘ ⇧ F` Outlook Items

- Filter
    `⌘ ⇧ A` Has Attachment
    `⌘ ⇧ O` Unread
    `⌘ ⌥ o` Flagged

### [QQ](http://im.qq.com/macqq/)

`⌘ ^ a` Screenshot
`⌘ ^ r` Screen Recording
`⌘ ^ r` __Screen Text Recognize__ ( OCR : Optical Character Recognition )
Two functions above can be used after opening QQ (even if you exit QQ then).

`⌘ ↑` Select Prev Chat
`⌘ ↓` Select Next Chat
They can be used in WeChat as well.

`⌘ 1` Switch to Messages
`⌘ 2` Switch to Contacts
`⌘ 3` Switch to Applications

### [Trello](https://trello.com/)

`⇧ ?` Show Shortcuts Tips

`↑ ↓ ← →` Navigate Cards
`b` Select Board
`/` Search Cards
`f` Filter Menu
`x` Clear All Filters

`↩` Open Card
`⌘ ↩` Save Text
`⎋` Close Menu / Cancel Editing

`n` New Card
`c` Archive Card
`e` Quick Edit Card
`,` `.` `<` `>` Move Card ( to Adjacent List )

`d` Due Date
`t` Title
`l` Label
`;` Toggle Label Name

_`凵` Assign Self_
_`s` Subscribe_
_`m` Add/Rm Members_

_`@` Autocomplete Members_
_`#` Autocomplete Labels_
_`^` Autocomplete Position_