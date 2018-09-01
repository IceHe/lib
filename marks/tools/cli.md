# 命令行

## 代码管理

[Git](https://git-scm.com/) <sup>Required</sup>

- 分布式代码版本管理系统（必学）。

## 编辑器

[Vim](http://www.vim.org/) <sup>God-like</sup>

- 编辑器之神（ Emacs 则是神的编辑器 ）。
- 服务器通常是 *nix 系统，vi* 是标配，而 Emacs 不常有。服务端开发和运维人员经常要在远程服务器编辑文本，遂 vi\* 是必备技能！
- 大的项目还是使用专用 IDE 进行编写更便捷靠谱。IDE 装个 plugin 也能以 Vim 的方式高效地操作，Vim 通用的键位可以让你少记很多必要的 IDE 快捷键。
- 在命令行之外，Sublime Text 原生支持 Vim 的基本操作，VS Code 插件支持 Vim 操作。
- Vim vs. Emacs! &nbsp;[What are the main differences between Vim and Emacs?**](https://www.quora.com/Text-Editors-What-are-the-main-differences-between-Vim-and-Emacs)》
- 其它：《[一年成为Emacs高手（像神一样使用编辑器）](https://github.com/redguardtoo/mastering-emacs-in-one-year-guide/blob/master/guide-zh.org)》
- 我的配置 [.vimrc](https://github.com/IceHe/mac-conf/blob/master/.vimrc)

[SpaceVim](https://spacevim.org/) / [~~spf13-vim~~](http://vim.spf13.com/)

- 一整套 Vim 配置方案。
- 比起漫无休止地折腾配置，不如遵从实用主义：站在巨人的肩膀上，直接使用久经考验的的配置方案。
- 其实你用不上其中的很多功能，而且高配的 [MBP](#Smart) 用它竟然会卡顿！如果只是轻度使用 Vim，那么用熟之后，可以根据个人习惯只在配置文件 `.vimrc` 中简单地自定义一下就够了。

## Shell

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

## 包管理

[Homebrew](http://brew.sh/) <sup>Best</sup>

- macOS 的包管理器。`brew` 就如 `agt-get` 之于 Ubuntu，`yum` 之于 RedHat、CentOS 的存在。

[~~Homebrew Cask~~](http://caskroom.io/)

- 安装、更新 macOS Apps 的命令行工具。
- 用命令行的方式安装、更新 Mac Apps，其中还包括了许多第三方的 Apps。
- 可以不用忍受 AppStore 缓慢的下载速度，也不必再一一访问各个官网去下载第三方 Apps 了。
- 重装 macOS 时可以用 `brew cask install` 命令组成的脚本便捷地安装必要的 Apps。

[~~dotfiles~~](https://dotfiles.github.io/)

- 可供参考的 dotfiles 配置，还有 [我的 dotfiles](https://github.com/IceHe/macos-home-conf)。（[dotfiles 是什么？](http://www.jianshu.com/p/7UJapk)）
