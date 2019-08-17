# IceHe's Lib

> [Welcome](/blog/welcome.md) - What is my Lib? Why I build?

- Website : [icehe.xyz](https://icehe.xyz) - powered by [docsify](/_docsify/README.md)
- Author : [IceHe](/marks/bio.md) - [icehe.me@qq.com](mailto:icehe.me@qq.com)

## Tech

> Later equals never.
> —— LeBlanc

### Snips

Algorithms - Basic

- [README](/snips/README.md)

<!-- - [Sorting](/src/sort/README.md) : Insertion / Heap / Quick / … -->

Coding

- [Abbreviations](/snips/abbrs.md)
- [Cloud Utils](/snips/cloud/README.md) ( draft )
    - [MaxCompute](/snips/cloud/max-compute.md)
        <!-- ( 原 ODPS - Open Data Process Service ) -->
    <!-- - AnalyticDB -->
- [Glossary](/snips/glossary.md) ( draft )
- [Regular Expression](/snips/regex.md)
- [Work Flow](/snips/work-flow.md)

Docker

- [Intro](/snips/docker/README.md)
- [Alpine Linux](/snips/docker/alpine/README.md) : minimal OS image
- [Docker Compose](/snips/docker/compose.md)

Markdown

- [Style Guide](/snips/markdown/README.md)
- [Lint Tool : mdl](/snips/markdown/lint/README.md)

Storage - Usage

- [Elasticsearch](/snips/storage/elasticsearch.md)
- [MemcacheQ](/snips/storage/mcq.md)
- [MySQL](/snips/mysql/README.md)
- [Redis](/snips/redis/README.md)
- [Mongo](/snips/storage/mongo.md)

Storage - Basic

- [LSM Tree](/snips/lsm-tree/README.md) : Log-Structured Merge-Tree
    - _Data structure related to LevelDB / RockDB_

Web

- [IP Address](/snips/web/ip.md)
- [URL Encoding](/snips/web/url-encoding.md)
- [init.d : Simple HTTP Service](/snips/init.d/README.md) ( php -S )
- [Nginx : Simple HTTP Server](/snips/nginx/README.md)
- [How to docsify?](/_docsify/README.md)
- [How to mail on CentOS?](/cmd/m/mailx.md) mailx
    - [on macOS](/cmd/m/msmtp.md) : msmtp ( sth wrong? )
- [QPS to CPU Cores](/snips/web/qps-to-cpu-cores.md): estimation

Others

- [Go](/snips/go.md) ( draft )
- [Chrome](/snips/web/chrome.md) : clear cookie ( draft )

### Mac

> 君子性非异也，善假于物也。—— 荀子

- [Tools](/marks/tools/README.md) : 利器 - 软件 / 物件的推荐
    - [Software](/marks/tools/README#软件) : 软件
    - [Hardware](/marks/tools/hardware) : 硬件
    - [Life](/marks/tools/life) : 生活
- [Efficiency](/mac/efficiency.md) : 效率指南
- [Shortcuts](/mac/shortcuts/README.md) : 快捷键
- [Initialize](/mac/initialize.md) : 系统初始化

### Java

[Index](/java/README.md) ( Doing )

- [Hello World](/java/hello-java.md) ( draft )
- [Spock](/java/spock.md) : Unit Tests
- ……

### Git

- [Commands](/git/README.md)
- [Concepts & Theory](/git/concepts-n-theory.md)
- [Docs Digest](/git/docs-digest.md)

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
- [mount](/cmd/m/mount.md) : mount a filesystem
- [mv](/cmd/m/mv.md) : move (rename) files
- [mvn](/cmd/m/mvn.md) : a tool for building & managing any Java-based project
- [nc](/cmd/n/nc.md) : TCP / UDP connect & listen
- [netstat](/cmd/n/network-status.md) : show network status
- [nl](/cmd/n/nl.md) : number lines of files
- [nslookup](/cmd/n/nslookup.md) : query Internet name servers interactively
- [passwd](/cmd/p/passwd.md) : modify a user's password
- [paste](/cmd/p/paste.md) : merge lines of files
- [php](/cmd/p/php.md) : PHP Command Line Interface
- [pidstat](/cmd/p/pidstat.md) : report statistics for Linux tasks
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
- [vim](/cmd/v/vim.md) : terminal text editor
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

- [C++ Primer 5th](/cpp/primer-5th.md)
- [C++ Interview Book](/cpp/interview-book.md)
- [C++ Coding Standards](/cpp/code-standards.md)
- [C++ Macros & Bit Operations](/cpp/macro-n-bit-operations.md)
- Effective C++ : [P1](/cpp/effective-cpp-reading-note-1.md) / [P2](/cpp/effective-cpp-reading-note-2.md) / [P3](/cpp/effective-cpp-reading-note-3.md) / [P4](/cpp/effective-cpp-reading-note-4.md)

### ASM

[Prepare on Windows 7](/asm/prepare-on-windows-7.md)

1. [Register / CS / IP / CPU / Memory](/asm/learning-note-1.md)
2. [Endien / Register / DS / [addr] / Stack](/asm/learning-note-2.md)
3. [Pesudo Instruction / Compile / Link / Debug / [BX] / loop / Seg Prefix  / Mem Space](/asm/learning-note-3.md)
4. [Stack / Data / Code / 栈的段 / 多段程序 / 大小写转换 / Addressing / SI / DI](/asm/learning-note-4.md)
5. [bx / si / di / bp / Addressing / Division / dd / dup / Structural Data](/asm/learning-note-5.md)
6. [Jump / offset / jmp / jcxz / loop / dec / Bounds Checking](/asm/learning-note-6.md)
7. [call / ret / mul / Show Str (Pos, Color) / Division Overflow / Show Value](/asm/learning-note-7.md)
8. [Course Design : 公司数据以指定格式在屏幕上显示](/asm/learning-note-8.md)
9. [flag register / adc / sbb / cmp 检测比较结果的条件转移指令，DF 标识和串传送指令 / Tests](/asm/learning-note-9.md)
10. [internal interrupt / Interrupt Routine / Install 中断向量表 / 设置中断向量](/asm/learning-note-10.md)
11. [int instruction / Interrupt Routine / Tests](/asm/learning-note-11.md)
12. [Port IO / in / out / shl / shr / Visit CMOS RAM](/asm/learning-note-12.md)
13. [external interrupt / 接口芯片和端口，可屏蔽|不可屏蔽中断，PC 机键盘的处理过程 / Tests](/asm/learning-note-13.md)
14. [直接定址表 / Data / 地址标号 / 在其它段中，计算 sin(x) / Tests](/asm/learning-note-14.md)
15. [用 BIOS 进行键盘输入和磁盘读写 / Tests](/asm/learning-note-15.md)
16. [Appendix : 汇编编译器对jmp的处理，地址计数器（AC），处理伪操作指令，栈传递参数，无溢出除法…](/asm/learning-note-16.md)

### Scripts

AppleScript

- [AppleScript Quick Start](/scripts/applescript/quick-start.md)
- [AppleScript to Control Evernote / macOS](/scripts/applescript/evernote-macos.md)

Batch 批处理

- [Batch 批处理指令](/scripts/batch/commands.md)
- [Batch 批处理中的特殊符号](/scripts/batch/dos-special-symbol.md)
- [DOS Common Commands](/scripts/batch/dos-common-commands.md)
- [DOS Environment Variables](/scripts/batch/dos-environment-variable.md)

Others

- PHP : [Functions & Scripts](/scripts/php/README.md)
- Python 3 : [Quick Start](/scripts/python/quick-start.md)
- JavaScript : [Optimize some code](/scripts/javascript/optimize-some-code.md)

### Repos

Mine : [GitHub](https://github.com/IceHe) & [GitLab](https://gitlab.com/users/IceHe/projects)

- [lib](https://github.com/IceHe/lib) : library | wiki ( this website )
- [blog](https://github.com/IceHe/blog) : prev tech blog ( archived )
- [mac-conf](https://github.com/IceHe/mac-conf) : macOS config files ( @ home dir )
- [linux-conf](https://github.com/IceHe/linux-conf) : Linux config files ( @ home dir )
- [applescript](https://github.com/IceHe/applescript) : to manipulate macOS
- [phpcs-ruleset](https://github.com/IceHe/phpcs-ruleset) : ruleset for PHPCS 3.1.0

<!-- [GitHub DMCA](/_private/others/github-dmca.md) : Alert myself! -->

Recommendation

- [Art of Command Line](https://github.com/jlevy/the-art-of-command-line) : Master the command line, in one page.
- [Redis](https://github.com/antirez/redis) : An in-memory database that persists on disk.
- [docsify](https://github.com/docsifyjs/docsify) : 🃏 A magical documentation site generator.
    - The data model is key-value, but many different kind of values are supported: Strings, Lists, Sets, Sorted Sets, Hashes, HyperLogLogs, Bitmaps.

## Life

<!--

> 写一部小说就像在黑夜里开车，你只能看到车灯照亮的部分，但是你却可以走完整个旅程。
> —— E.L. Doctorow

-->

### Marks

> Get busy living or get busy dying.

- [Bio](/marks/bio.md) ：Skills / Exp / Edu
- [Favorites](/marks/favourites.md) : ACGMN
- [Technology Bookmarks](/marks/tech.md)
- [Reading Bookmarks](/marks/read.md)

<!--     - 饿了么北京物流众包运营 / 服务端 / Java -->
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
- [GTD](/snips/principles/gtd.md) : Get Thing Done - Flow Chart ( [actual](/snips/principles/gtd-actual.md) )

Newly

- [PDCA](/snips/principles/pdca.md) : Plan → Do → Check → Act ( Adjust )
- [AIDA](/snips/principles/aida.md) : Attention → Interest → Desire → Action
- _FERI : Fact → Emotion ( Feel ) → Reflect → Improve ( Temporary Solution )_

### Digest

好文共赏

- [Cruel Reality](http://www.cracked.com/blog/6-harsh-truths-that-will-make-you-better-person/)
    / [ZH ver.](http://mp.weixin.qq.com/s?__biz=MzA5MTM0NzIwNQ==&mid=2649760227&idx=2&sn=89fcbaf26cb56a21da2c4364fa3c9359)
    / [_digest_](/read/cruel-reality.md)
    - "Nice guy? I never give a shit."
- [Life Meaning](https://www.zhihu.com/question/24561532/answer/28240920)
    / [_digest_](/read/meaning.md)
    - 因为活着，才去寻找意义。
- [Happyness Course](https://zhuanlan.zhihu.com/p/19562678)
    / [_digest_](/read/happiness-course.md)
    - 如果你只有一个选择，它让你满意吗？
- [Why Unhappy](https://zhuanlan.zhihu.com/p/19582894)
    / [_digest_](/read/why-unhappy.md)
    - 我，并不特别。
- [Poet](https://zhuanlan.zhihu.com/p/19895904) : 诗和远方
    / [_digest_](/read/poet.md)
    - 眼前的苟且，也正是诗和远方。
- [Teacher Said](https://www.zhihu.com/question/23721974/answer/25493813)
    / [_digest_](/read/teacher-said.md)
    - 我们用「我能做到什么」来判断和定位自己，而别人用「你已经做过什么」来判断和定位你。
    - 做正确的选择，而不是可以接受的选择。
- [Pessimist](http://mp.weixin.qq.com/s?__biz=MzA5MjIzMzAwNg==&mid=233397081&idx=1&sn=836801a648013f925fca14de3572c45c&scene=1&srcid=0309TRipy9egTmxD0B51Q272#rd) / [_digest_](/read/pessimist.md)
    - It's the hardest part when memories remain.
- [Anti-Fragile](/read/anti-fragile.md)
    / [_book_](https://item.jd.com/11364406.html)

### Past

```quote
我没有一天不后悔。
并非受到惩罚才感到后悔。
回首往事，
那个愚钝的年轻笨蛋，
想跟他谈谈，
想要跟他讲道理，
想让他明白，
但是办不到。
那个少年早就不见了，
只剩下垂老的身躯，
我得接受现实。
```

<!--
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
-->

Timeline

<!-- - [2018 Winter](/past/2018-winter.md) moved temp -->

- [2017 Summer to Winter](/past/2017-summer-2-winter.md)
- [2017 Spring](/past/2017-spring.md)
- [2016 Winter](/past/2016-winter.md)
- [2016 Fall](/past/2016-fall.md)
- [2016 Spring & Summer](/past/2016-summer.md)
- [Bye 2015](/past/2015-bye.md)
- [Moments](/past/moments.md) : 回忆
- [Old Blog](/past/old-blog.md) : 旧博索引

Nonsense

- Time Mgt. : [Life Logs](/lifelogs/README.md) & [Log Format](/lifelogs/time-mgt.md)
- Way of Life : [Self Manual](/lifelogs/life-manual.md)

Previous Blog : 2015 ~ 2017

- [Tech Blog](https://icehe.me) : icehe.me
- [How to Build Blog](/blog/build.md) : 搭建博客
- [Blog Changlogs](/blog/changelog.md) : 折腾博客

### Friends

> To be a better man.

- [Jan Fan](http://janfan.cn/) : Good student / Little NLP / Tencent / Studying @ Finland
- [SF Zhou](http://sf-zhou.github.io/) : ACMer / Microsoft / SenseTime
- [Johnson](http://mrzys.coding.me/) : Pythoner & PHP / Sina Mobile
- [Toxic Johann](https://github.com/toxic-johann/toxic-johann.github.io/issues) : Front-end / 360 / UC / Tencent
- Me : A fool / Web Backend / Sina Weibo / Ele.me

### Work

> Don’t try, just do. Failure is not an option.
>
> Get it / Make it without reason.

## End

> 靡不有初，鲜克有终
