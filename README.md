# IceHe's Lib

> [Welcome](/_lru/blog/welcome.md) - What is my Lib? Why I build?

- Website : [icehe.xyz](https://icehe.xyz) - powered by [docsify](/_docsify/README.md)
- Author : [IceHe](/_lru/marks/bio.md) - [icehe.me@qq.com](mailto:icehe.me@qq.com)

## Tech

> Get busy living or get busy dying.

### Snips

<!-- Algorithms ( Basic ) -->

<!-- - [Sorting](/src/sort/README.md) : Insertion / Heap / Quick / … -->

Coding

- [Abbreviations](/snips/abbrs.md)
- [Cloud Utils](/snips/cloud.md) ( draft )
- [Glossary](/snips/glossary.md) ( draft )
- [Regular Expression](/snips/regex.md)
- [Work Flow](/snips/work-flow.md)

Data Process

- [MaxCompute](/snips/data-process/max-compute.md) ( 原 ODPS - Open Data Process Service )

<!-- - Apache [Hive](/snips/data-process/hive.md) : from FaceBook -->

Docker

- [Intro](/snips/docker/README.md)
- [Alpine Linux](/snips/docker/alpine/README.md) : minimal OS image
- [Docker Compose](/snips/docker/compose.md)

Languages

- [Go](/snips/go.md)
- [Java](/snips/java/README.md)

Markdown

- [Style Guide](/snips/markdown/README.md)
- [Lint Tool : mdl](/snips/markdown/lint/README.md)

Storage - theory

- [LSM Tree](/snips/lsm-tree/README.md) : Log-Structured Merge-Tree
    - _Data structure related to LevelDB / RockDB_

Storage - usage

- [MemcacheQ](/snips/mcq.md)
- [MySQL](/snips/mysql/README.md)
- [Redis](/snips/redis/README.md)
- [Mongo](/snips/mongo.md)

Web

- [IP Address](/snips/web/ip.md)
- [URL Encoding](/snips/web/url-encoding.md)
- [init.d : Simple HTTP Service](/snips/init.d/README.md) ( php -S )
- [Nginx : Simple HTTP Server](/snips/nginx/README.md)
- [How to docsify?](/_docsify/README.md)
- [How to mail on CentOS?](/cmd/m/mailx.md) mailx
    - [on macOS](/cmd/m/msmtp.md) : msmtp ( draft / sth wrong? )
- [Chrome](/snips/web/chrome.md) : clear cookie ( draft )

### Mac

> 君子性非异也，善假于物也。—— 荀子

- [Tools](/_lru/marks/tools/README.md) : 利器 - 软件 / 物件的推荐
- [Efficiency](/_lru/mac/efficiency.md) : 效率指南
- [Shortcuts](/_lru/mac/shortcuts/README.md) : 快捷键
- [Initialize](/_lru/mac/initialize.md) : 系统初始化

### Git

- [Commands](/_lru/git/README.md)
- [Concepts & Theory](/_lru/git/concepts-n-theory.md)
- [Docs Digest](/_lru/git/docs-digest.md)

### Cmd

> Commands & CLI ( Command-Line Interface )

[Index](/cmd/README.md)

<!-- ( too long so moved to _cmd/README.md ) -->

- [awk](/cmd/a/awk.md) : pattern scanning and processing language
- [bash](/cmd/bash/README.md) : GNU Bourne-Again SHell
    - [parameter](/cmd/bash/parameter.md) : basic, expansion & substitution
    - [shell variables](/cmd/bash/shell-variables.md) : variables are set by the shell
- [brew](/cmd/b/brew.md) : the missing package manager for macOS
- [bzip2](/cmd/b/bzip2.md) : block-sorting file compressor
- [cat](/cmd/c/cat.md) : concatenate files & print on the standard output
- [cd](/cmd/c/cd.md) : change the current directory
- [chgrp](/cmd/c/chgrp.md): change group ownership
- [chmod](/cmd/c/chmod.md) : change file mode bits
- [chown](/cmd/c/chown.md) : change file owner & group
- [column](/cmd/c/column.md) : columnate lists
- [comm](/cmd/c/comm.md) : compare two sorted files line by line
- [cp](/cmd/c/cp.md) : copy files & directories
- [cron](/cmd/c/cron.md) : time-based job scheduler
- [curl](/cmd/c/curl.md) : transfer data from or to a server
- [cut](/cmd/c/cut.md) : remove sections from each line of files
- [date](/cmd/d/date.md) : print or set the system date & time
- [df](/cmd/d/df.md) : report file system disk space usage
- _[diff](/cmd/d/diff.md) : compare files line by line_
- [dig](/cmd/d/dig.md) : DNS lookup utility
- [dstat](/cmd/d/dstat.md) : versatile tool for generating system resource statistics
    - [iftop](/cmd/i/iftop.md) : display bandwidth usage on an interface by host
    - [iostat](/cmd/i/iostat.md) : statistics of CPU & IO for devices & partitions
    - [vmstat](/cmd/v/vmstat.md) : report virtual memory statistics
- [du](/cmd/d/du.md) : estimate file space usage
- [env](/cmd/e/env.md) : run a program in a modified environment
- [expect](/cmd/e/expect.md) : interact with programs
- [expr](/cmd/e/expr.md) : evaluate expressions
- [file](/cmd/f/file.md) : determine file type
- [find](/cmd/f/find.md) : search for files in a directory hierarchy
- [git](/cmd/g/git.md) : the stupid content tracker
- [grep](/cmd/g/grep.md) : print lines matching a pattern
    - [zgrep](/cmd/z/zgrep.md) : search possibly compressed files for a regular expression
- [head](/cmd/h/head.md) : output the first part of files
- [htop](/cmd/h/htop.md) : interactive process viewer
- [ifconfig](/cmd/i/ifconfig.md) : configure a network interface
- [ip](/cmd/i/ip.md) : show / manipulate routing, devices, policy routing & tunnels
- [jobs](/cmd/j/jobs.md), bg, fg, disown, wait, …
    - stop (suspend) the execution of processes & continue (resume) their execution at a later point
- [join](/cmd/j/join.md) : join lines of two files on a common field
- [kill](/cmd/k/kill.md) : terminate or signal a process
- [killall](/cmd/k/killall.md) : kill processes by name
- [last](/cmd/l/last.md) : show listing of last logged in users
- [less](/cmd/l/less.md) : provides \`more\` emulation plus extensive enhancements
    - more : file perusal filter for paging through text one screenful at a time
- [ln](/cmd/l/ln.md) : make links between files
- [locale](/cmd/l/locale.md) : get locale-specific information
- [ls](/cmd/l/ls.md) : list directory contents
- [lsof](/cmd/l/lsof.md) : list open files
- [man](/cmd/m/man.md) : an interface to the on-line reference manuals
- [mkdir](/cmd/m/mkdir.md) : make directories
- [mv](/cmd/m/mv.md) : move (rename) files
- [mvn](/cmd/m/mvn.md) : Java Package Management
- [nc](/cmd/n/nc.md) : TCP / UDP connect & listen
- [netstat](/cmd/n/network-status.md) : show network status
- [nl](/cmd/n/nl.md) : number lines of files
- [nslookup](/cmd/n/nslookup.md) : query Internet name servers interactively
- [passwd](/cmd/p/passwd.md) : modify a user's password
- [paste](/cmd/p/paste.md) : merge lines of files
- [php](/cmd/p/php.md) : PHP Command Line Interface
- [ping](/cmd/p/ping.md) : send ICMP ECHO_REQUEST to network hosts
- [python](/cmd/p/python.md) : Python Command Line Interface
- [ps](/cmd/p/ps.md) : process status
- [realpath](/cmd/r/realpath.md) : print the resolved path
- [redis-cli](/cmd/redis/redis-cli.md) : Redis client
- [redis-server](/cmd/redis/redis-server.md) ( & redis-sentinel ) : Redis server
- [redis-dump](/cmd/redis/redis-dump.md) ( & redis-load ) : Backup & restore Redis data to and from JSON
- [rm](/cmd/r/rm.md) : remove files or directories
- [rsync](/cmd/rsync/README.md) : transfer files
- [scp](/cmd/s/scp.md) : secure copy (remote file copy program)
- [sed](/cmd/s/sed.md) : stream editor for filtering & transforming text
- [seq](/cmd/s/seq.md) : print a sequence of numbers
- [service](/cmd/s/service.md) : run a System V init script
- [sleep](/cmd/s/sleep.md) : delay for a specified amount of time
- [sort](/cmd/s/sort.md) : sort lines of text files
- [ssh](/cmd/s/ssh.md) : OpenSSH Client (remote login program) (TODO)
- [stat](/cmd/s/stat.md) : display file or file system status
- [su](/cmd/s/su.md) : run a command with substitute user & group ID
- [sudo](/cmd/s/sudo.md) : execute a command as another user
- [sysctl](/cmd/s/sysctl.md) : configure kernel parameters at runtime
- [systemctl](/cmd/s/systemctl.md) : control systemd & service manager
- [tail](/cmd/t/tail.md) : output the last part of files
- [tar](/cmd/t/tar.md) : pack & compress
- [tee](/cmd/t/tee.md) : write to standard output & files
- [telnet](/cmd/t/telnet.md) : user interface to the TELNET protocol (TODO)
- [timeout](/cmd/t/timeout.md) : run a command with a time limit
- [tmux](/cmd/t/tmux.md) : terminal multiplexer
- [touch](/cmd/t/touch.md) : change file access & modification times
- [tr](/cmd/t/tr.md) : translate or delete characters
- [ulimit](/cmd/u/ulimit.md) : system resource limit to shell
- [uname](/cmd/u/uname.md) : print system information
- [uniq](/cmd/u/uniq.md) : report or omit repeated lines
- [uptime](/cmd/u/uptime.md) : show how long system has been running
- [vim](/cmd/v/vim.md) : terminal editor
- [visudo](/cmd/v/visudo.md) : edit the sudoers file
- [w](/cmd/w/w.md) : show who is logged on & what they are doing
- [wc](/cmd/w/wc.md) : print newline, word, & byte counts for each file
- [wget](/cmd/w/wget.md) : network downloader
- [whereis](/cmd/w/whereis.md) & [which](/cmd/w/which.md) & [whatis](/cmd/w/whatis.md) : locate, show path & description
- [whoami](/cmd/w/whoami.md) : print effective userid
- [xargs](/cmd/x/xargs.md) : build and execute command lines from standard input
- [zsh](/cmd/z/zsh.md) : one of shells

> 巨大的建筑，总是由一木一石叠起来的，我们何妨做做这一木一石呢？我时常做些零碎事，就是为此。
> —— 鲁迅

### C++

- [C++ Primer 5th](/_lru/cpp/primer-5th.md)
- [C++ Interview Book](/_lru/cpp/interview-book.md)
- [C++ Coding Standards](/_lru/cpp/code-standards.md)
- [C++ Macros & Bit Operations](/_lru/cpp/macro-n-bit-operations.md)
- Effective C++ : [P1](/_lru/cpp/effective-cpp-reading-note-1.md) / [P2](/_lru/cpp/effective-cpp-reading-note-2.md) / [P3](/_lru/cpp/effective-cpp-reading-note-3.md) / [P4](/_lru/cpp/effective-cpp-reading-note-4.md)

### ASM

[Prepare on Windows 7](/_lru/asm/prepare-on-windows-7.md)

1. [Register / CS / IP / CPU / Memory](/_lru/asm/learning-note-1.md)
2. [Endien / Register / DS / [addr] / Stack](/_lru/asm/learning-note-2.md)
3. [Pesudo Instruction / Compile / Link / Debug / [BX] / loop / Seg Prefix  / Mem Space](/_lru/asm/learning-note-3.md)
4. [Stack / Data / Code / 栈的段 / 多段程序 / 大小写转换 / Addressing / SI / DI](/_lru/asm/learning-note-4.md)
5. [bx / si / di / bp / Addressing / Division / dd / dup / Structural Data](/_lru/asm/learning-note-5.md)
6. [Jump / offset / jmp / jcxz / loop / dec / Bounds Checking](/_lru/asm/learning-note-6.md)
7. [call / ret / mul / Show Str (Pos, Color) / Division Overflow / Show Value](/_lru/asm/learning-note-7.md)
8. [Course Design : 公司数据以指定格式在屏幕上显示](/_lru/asm/learning-note-8.md)
9. [flag register / adc / sbb / cmp 检测比较结果的条件转移指令，DF 标识和串传送指令 / Tests](/_lru/asm/learning-note-9.md)
10. [internal interrupt / Interrupt Routine / Install 中断向量表 / 设置中断向量](/_lru/asm/learning-note-10.md)
11. [int instruction / Interrupt Routine / Tests](/_lru/asm/learning-note-11.md)
12. [Port IO / in / out / shl / shr / Visit CMOS RAM](/_lru/asm/learning-note-12.md)
13. [external interrupt / 接口芯片和端口，可屏蔽|不可屏蔽中断，PC 机键盘的处理过程 / Tests](/_lru/asm/learning-note-13.md)
14. [直接定址表 / Data / 地址标号 / 在其它段中，计算 sin(x) / Tests](/_lru/asm/learning-note-14.md)
15. [用 BIOS 进行键盘输入和磁盘读写 / Tests](/_lru/asm/learning-note-15.md)
16. [Appendix : 汇编编译器对jmp的处理，地址计数器（AC），处理伪操作指令，栈传递参数，无溢出除法…](/_lru/asm/learning-note-16.md)

### Scripts

AppleScript

- [AppleScript Quick Start](/_lru/scripts/applescript/quick-start.md)
- [AppleScript to Control Evernote / macOS](/_lru/scripts/applescript/evernote-macos.md)

Batch 批处理

- [Batch 批处理指令](/_lru/scripts/batch/cmd.md)
- [Batch 批处理中的特殊符号](/_lru/scripts/batch/dos-special-symbol.md)
- [DOS Common Commands](/_lru/scripts/batch/dos-common-commands.md)
- [DOS Environment Variables](/_lru/scripts/batch/dos-environment-variable.md)

Others

- PHP : [Functions & Scripts](/_lru/scripts/php/README.md)
- Python 3 : [Quick Start](/_lru/scripts/python/quick-start.md)
- JavaScript : [Optimize some code](/_lru/scripts/javascript/optimize-some-code.md)

### Repos

[GitHub](https://github.com/IceHe) & [GitLab](https://gitlab.com/users/IceHe/projects)

- [lib](https://github.com/IceHe/lib) : library | wiki ( this website )
- [blog](https://github.com/IceHe/blog) : prev tech blog ( archived )
- [mac-conf](https://github.com/IceHe/mac-conf) : macOS config files ( @ home dir )
- [linux-conf](https://github.com/IceHe/linux-conf) : Linux config files ( @ home dir )
- [applescript](https://github.com/IceHe/applescript) : to manipulate macOS
- [phpcs-ruleset](https://github.com/IceHe/phpcs-ruleset) : ruleset for PHPCS 3.1.0

<!-- [GitHub DMCA](/_private/others/github-dmca.md) : Alert myself! -->

## Life

<!--

> 写一部小说就像在黑夜里开车，你只能看到车灯照亮的部分，但是你却可以走完整个旅程。
> —— E.L. Doctorow

-->

<!-- > What is your dream? -->

### Marks

> Don’t try, just do. Failure is not an option.

- [Bio](/_lru/marks/bio.md) ：Skills / Exp / Edu
- [Favorites](/_lru/marks/favourites.md) : ACGMN
- [Technology Bookmarks](/_lru/marks/tech.md)
- [Reading Bookmarks](/_lru/marks/read.md)

<!--     - 微博视频平台 / 服务端 / Java -->
<!--     - 微博移动应用服务 / 服务端 / PHP -->
<!--     - 华南理工 / 软件工程 / 本科 -->

### Principles

> 博弈论：理性就是对你的各种东西设定一个优先级，并且能够贯彻执行这个优先级。

- [What Why How](/snips/principles/what-why-how.md)
- [How to Ask](/snips/principles/how-to-ask.md) JFGI & RTFM
    - JFGI : Just Fucking Google It
    - RTFM : Read The Fucking Manual
- [SMART](/snips/principles/smart.md) : Specific / Measurable / Achievable / Relevant / Time-based
- [STAR](/snips/principles/star.md) : Situation → Target → Action → Result
- [SWOT](/snips/principles/swot.md) : Strengths / Weakness / Oppertunities / Threats

Newly

- [PDCA](/snips/principles/pdca.md) : Plan → Do → Check → Act ( Adjust )
- [AIDA](/snips/principles/aida.md) : Attention → Interest → Desire → Action
- _FERI : Fact → Emotion ( Feel ) → Reflect → Improve ( Solution )_

### Digest

好文共赏

- [Cruel Reality](http://www.cracked.com/blog/6-harsh-truths-that-will-make-you-better-person/)
    / [ZH ver.](http://mp.weixin.qq.com/s?__biz=MzA5MTM0NzIwNQ==&mid=2649760227&idx=2&sn=89fcbaf26cb56a21da2c4364fa3c9359)
    / [_digest_](/_lru/read/cruel-reality.md)
    - "Nice guy? I never give a shit."
- [Life Meaning](https://www.zhihu.com/question/24561532/answer/28240920)
    / [_digest_](/_lru/read/meaning.md)
    - 因为活着，才去寻找意义。
- [Happyness Course](https://zhuanlan.zhihu.com/p/19562678)
    / [_digest_](/_lru/read/happiness-course.md)
    - 如果你只有一个选择，它让你满意吗？
- [Why Unhappy](https://zhuanlan.zhihu.com/p/19582894)
    / [_digest_](/_lru/read/why-unhappy.md)
    - 我，并不特别。
- [Poet](https://zhuanlan.zhihu.com/p/19895904) : 诗和远方
    / [_digest_](/_lru/read/poet.md)
    - 眼前的苟且，也正是诗和远方。
- [Teacher Said](https://www.zhihu.com/question/23721974/answer/25493813)
    / [_digest_](/_lru/read/teacher-said.md)
    - 我们用「我能做到什么」来判断和定位自己，而别人用「你已经做过什么」来判断和定位你。
    - 做正确的选择，而不是可以接受的选择。
- [Pessimist](http://mp.weixin.qq.com/s?__biz=MzA5MjIzMzAwNg==&mid=233397081&idx=1&sn=836801a648013f925fca14de3572c45c&scene=1&srcid=0309TRipy9egTmxD0B51Q272#rd) / [_digest_](/_lru/read/pessimist.md)
    - It's the hardest part when memories remain.
- [Anti-Fragile](/_lru/read/anti-fragile.md)
    / [_book_](https://item.jd.com/11364406.html)

### Past

> 我没有一天不后悔。<br/>
> 并非受到惩罚才感到后悔。<br/>
> 回首往事，<br/>
> 那个愚钝的年轻笨蛋，<br/>
> 想跟他谈谈，<br/>
> 想要跟他讲道理，<br/>
> 想让他明白，<br/>
> 但是办不到。<br/>
> 那个少年早就不见了，<br/>
> 只剩下垂老的身躯，<br/>
> 我得接受现实。<br/>

Timeline

<!-- - [2018 Winter](/_lru/past/2018-winter.md) moved temp -->

- [2017 Summer to Winter](/_lru/past/2017-summer-2-winter.md)
- [2017 Spring](/_lru/past/2017-spring.md)
- [2016 Winter](/_lru/past/2016-winter.md)
- [2016 Fall](/_lru/past/2016-fall.md)
- [2016 Spring & Summer](/_lru/past/2016-summer.md)
- [Bye 2015](/_lru/past/2015-bye.md)
- [Moments](/_lru/past/moments.md) : 回忆
- [Old Blog](/_lru/past/old-blog.md) : 旧博索引

Nonsense

- Time Mgt. : [Life Logs](/_lru/lifelogs/README.md) & [Log Format](/_lru/lifelogs/time-mgt.md)
- Way of Life : [Self Manual](/_lru/lifelogs/life-manual.md)

Previous Blog : 2015 ~ 2017

- [Tech Blog](https://icehe.me) : icehe.me
- [How to Build Blog](/_lru/blog/build-blog.md) : 搭建博客
- [Blog Changlogs](/_lru/blog/blog-changelog.md) : 折腾博客

### Friends

> To be a better man.

- [Jan Fan](http://janfan.cn/) : Good student / Little NLP / Tencent / Studying @ Finland
- [SF Zhou](http://sf-zhou.github.io/) : ACMer / Microsoft / SenseTime
- [Johnson](http://mrzys.coding.me/) : Pythoner & PHP / Sina Mobile
- [Toxic Johann](https://github.com/toxic-johann/toxic-johann.github.io/issues) : Front-end / 360 / UC / Tencent
- Me : A fool / Web Backend / Sina Weibo / Ele.me

## Ending

> 靡不有初，鲜克有终
