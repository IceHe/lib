# Table of Contents

[Welcome!](/blog/welcome.md) Here is my "Library".

---

> Later equals never.

<!-- > —— LeBlanc's Law -->

- This site: [icehe.xyz](https://icehe.xyz) - powered by [docsify](/_docsify/how-to-docsify.md)
- Backup site: [lib.icehe.xyz](https://lib.icehe.xyz) - powered by [GitBook](https://www.gitbook.com/)
-   Author: [IceHe](/marks/bio.md) - [icehe.me@qq.com](mailto:icehe.me@qq.com)

## Tech

### Books

> 紙上得來終覺淺，絕知此事要躬行。

<!-- > 纸上得来终觉浅，绝知此事要躬行。 -->
<!-- > —— 陆游《冬夜读书示子聿》 -->

- [Books Ever Read - Douban](https://book.douban.com/people/IceHeGZ/collect)

Coding

- [Refactoring](/books/refactoring.md)
- [Design Patterns](/books/design-patterns.md)
- [Pragmatic Programmer](/books/pragmatic-programmer.md)
    - _The Pragmatic Programmer: your journey to mastery ( 2nd Edition )_
- [Clean Agile: Back to Basics](/books/clean-agile.md)

JVM - Java Virtual Machine - [TOC](/books/understand-jvm-toc.md)

- [Part I & Part II. Automatic Memory Management](/books/understand-jvm-p1-n-p2.md)
- [Part III. Execution Engine](/books/understand-jvm-p3.md) _( todo )_
- Part IV. Compile and Code Optimize _( todo )_

Designing Data Intensive Applications - [TOC](/books/designing-data-intensive-applications-toc.md)

- [Part I. Foundations of Data Systems](/books/designing-data-intensive-applications-p1.md)
    - 1\. **Reliable**, **Scalable**, and Maintainable Applications
    - 2\. **Data Models** and Query Languages
    - 3\. **Storage** and **Retrieval** / 4\. **Encoding** and Evolution
- [Part II. Distributed Data](/books/designing-data-intensive-applications-p2.md)
    - 5\. **Replication** / 6\. **Partitioning** / 7\. **Transactions**
    - 8\. The Trouble with **Distributed Systems**
    - 9\. **Consistency** and **Consensus**
- [Part III. Derived Data](/books/designing-data-intensive-applications-p3.md)
    - 10\. **Batch** Processing / 11\. **Stream** Processing / …

Todos

- [Java Concurrency in Pratice](/books/java-concurrency-in-pratice.md) _( todo )_
- [Linux Kernel](/books/linux.md) _( to take notes )_

<!-- - [JZ Offer](/books/jz-offer.md) -->

<!--

Tools

- Wireshark
    - _[Life Is Tough, But Wireshark Makes It Easy](/books/wireshark-makes-life-easy.md) ( todo )_
    - _[The Art of Network Analysis Using Wireshark](/books/wireshark-the-art-of-network-analysis.md) ( todo )_

-->

<!-- _* [TCP/IP Illustrated, Volume 1: The Protocols, 2nd Edition](/books/tcp-ip-illustracted-protocols-toc.md) - TOC_ -->
<!--  -->
<!-- - _* [Part 1](/books/tcp-ip-illustracted-protocols-p1.md) ( todo )_ -->

### Snips

> 巨大的建築，總是由一木一石疊起來的，我們何妨做做這一木一石呢？我時常做些零碎事，就是為此。

<!-- > 巨大的建筑，总是由一木一石叠起来的，我们何妨做做这一木一石呢？我时常做些零碎事，就是为此。 -->
<!-- > —— 鲁迅《致赖少麟》 -->

Docker

- [Commands](/snips/docker/docker-commands.md)
- [Alpine Linux](/snips/docker/alpine/alpine.md): minimal OS image

Storage

- LSM Tree: [Intro](/snips/lsm-tree/lsm-tree.md)
    - _basic data structure of LevelDB & RocksDB_
- Elasticsearch: [Usage](/snips/elasticsearch.md)
    - _for search and analysis_
- MySQL: [Usage](/snips/mysql/usage.md)
    - _robust SQL database server_
- Redis: [Basics](/snips/redis/basics.md) / [Usage](/snips/redis/usage.md) / [Notes](/snips/redis/notes.md)
    - _in-memory data structure store as a database, cache and message broker_
    <!-- basics: http://redis.io -->
    <!-- usage: https://redis.io/commands -->

<!--

- ES
- Basics: https://www.elastic.co ( todo )
    - What is Elasticsearch: https://www.elastic.co/guide/en/elasticsearch/reference/current/elasticsearch-intro.html
- MySQL
- Basics: https://www.mysql.com ( todo )
    - https://dev.mysql.com/doc
    - https://dev.mysql.com/doc/refman/8.0/en/introduction.html

-->

Web

- [IP Address](/snips/network/ip.md)
- [Network Notes](/snips/network/notes.md)
- [URL Encoding](/snips/web/url-encoding.md)
- Simple HTTP service:
    - [init.d](/snips/init.d/init.d.md) with `php -S`
    - [Nginx](/snips/nginx/nginx.md) via the configuration file
- How to build the personal website?
    - Powered by [docsify](/_docsify/how-to-docsify.md)
- How to estimate the required computing resources?
    - [QPS to CPU Cores](/snips/web/qps-to-cpu-cores.md)

Writing

- [Abbreviations](/snips/abbrs.md)
- [Glossaries](/snips/glossaries.md) _with intros to the common technology products_
- [Markdown Style Guide](/snips/markdown/markdown-style-guide.md)
- [Markdown Lint Tool: mdl](/snips/markdown/lint/lint.md)
- [Regular Expression](/snips/regex.md)

_Todos / Drafts / Others_

- _[Go](/snips/tmp/go.md)_
- _[Work Flow](/snips/tmp/work-flow.md)_
- _[Memcached](/snips/tmp/memcached.md)_
- _[Mongo](/snips/tmp/mongo.md)_
- _[ID Generator](/snips/tmp/id-generator.md)_

<!--

Algorithms

- [Sorting](/src/sort/notes.md): Insertion / Heap / Quick / …

-->

<!--

Infrastructre _( todo )_

- [Service Mesh](/snips/infrastructure/service-mesh.md)
- [Envoy](/snips/infrastructure/envoy.md)
- [Istio](/snips/infrastructure/service-mesh/istio.md)
- Thrift
- Nginx
- OpenResty
- Kubernetes
- E2E and etc.: E2E / 压力测试 / 全链路压测 / 流量构造 / 流量染色 / 数据工场平台
- Gatling
- APM / 监控告警系统
- Prometheus
- Thanos
- Sky Walking
- ELK
- Mock 平台
- CI/CD
- Jenkins
- GitHub Action
- Travis CI

-->

### MQs

Message Queues

- [kafka](/message-queues/kafka.md) ( [digest](/message-queues/kafka-digest.md) )
- [RabbitMQ](/message-queues/rabbit-mq.md)
- [RocketMQ](/message-queues/rocket-mq.md) ( todo )
- [ActiveMQ](/message-queues/active-mq.md)
- [ZeroMQ](/message-queues/zero-mq.md) ( todo )
- _[MemcacheQ](/message-queues/mcq.md)_
- _[Notes](/message-queues/notes.md)_

### Mac

> 埏埴以為器，當其無，有器之用。

<!-- > —— 老子《道德经·无之为用》 -->

- [Efficiency](/mac/efficiency.md) _( 效率指南 )_
    - [macOS shortcuts](/mac/shortcuts/macos.md)
    - [Sublime Text shortcuts](/mac/shortcuts/sublime-text.md)
    - [JetBrains shortcuts](/mac/shortcuts/jetbrains.md)
- [Initialize](/mac/initialize-mac.md) _( 系统初始化 )_
- [JVM Options Optimaization](/mac/jetbrains/README.md)
    - _e.g. for JetBrains IDE - IntelliJ IDEA_

### Git

- [Common Commands](/git/common-commands.md)
- [Concepts & Theory](/git/concepts-n-theory.md)
- [Docs Digest](/git/docs-digest.md)

### Java

Basics

- [Glossaries](/java/glossaries.md)
- [Install JDK](/java/install-jdk.md)
- Package Manager: [Maven](/java/maven.md) & Gradle
- Code Style Guide: [Alibaba](https://edu.aliyun.com/certification/cldt02) & [Google](https://google.github.io/styleguide/javaguide.html)

Coding

- [Notes](/java/notes.md)
- [Snippets](/java/code-snippets/notes.md)
- [Spock](/java/spock.md): unit tests ( or JUnit )
    - [Groovy](/java/groovy.md): a multi-faceted language for the Java platform
- [IDE - IntelliJ IDEA](/java/intellij-idea.md): usage / …
- [Exceptions](/java/exceptions.md): exception class hierarchy / …
- [Annotations](/java/annotations.md): Spring / Lombok / FastJson / Jackson / …

Benchmark & Stress Testing

- [JMH](/java/jmh.md): Java Microbenchmark Harness ( todo )

Command Line Tools

- [jar](/java/cmd/jar.md): archive tool
- [java](/java/cmd/java.md): application launcher
- [javac](/java/cmd/javac.md): compiler
- [javap](/java/cmd/javap.md): class file disassembler
- [jps](/java/cmd/jps.md): JVM process status - _list the instrumented JVMs on the target system_
- [jcmd](/java/cmd/jcmd.md): send diagnostic command requests to a running JVM
- [jhsdb](/java/cmd/jhsdb.md): HotSpot Debugger
    - _attach to a Java process or launch a postmortem debugger to analyze the content of a core dump from a crashed JVM_
    - _available after JDK 9_
- _Seldom-used and deprecated_
    - _[javadoc](/java/cmd/javadoc.md): API documentation generator_
    - _[jstat](/java/cmd/jstat.md): monitor JVM statistics_
    - _[jinfo](/java/cmd/jinfo.md): configuration info_ - _generate configuration info for a specified Java process_
    - _[jmap](/java/cmd/jmap.md): memory map_ - _print details of a specified process_
    - _~~[jhat](/java/cmd/jhat.md): Heap Analysis Tool~~_ - _only available in JDK 8 !_
    - _[jstack](/java/cmd/jstack.md): stack trace_ - _print Java stack traces of Java threads for a specified Java process_

### CMDs

Commands

- [ab](/cmd/a/ab.md): Apache HTTP server benchmarking tool
- [awk](/cmd/a/awk.md): pattern-directed scanning and processing language
    - [gawk](/cmd/a/awk.md): pattern scanning and processing language ( todo )
- [bash](/cmd/bash/bash.md): GNU Bourne-Again SHell ( draft )
    - [parameter](/cmd/bash/parameter.md): basic, expansion & substitution
    - [shell variables](/cmd/bash/shell-variables.md): variables are set by the shell
- [brew](/cmd/b/brew.md): the missing package manager for macOS
- [bzip2](/cmd/b/bzip2.md): block-sorting file compressor
- [cat](/cmd/c/cat.md): concatenate files & print on the standard output
- [cd](/cmd/c/cd.md): change the current directory
- [chgrp](/cmd/c/chgrp.md): change group ownership
- [chmod](/cmd/c/chmod.md): change file mode bits
- [chown](/cmd/c/chown.md): change file owner & group
- [column](/cmd/c/column.md): columnate lists
- [comm](/cmd/c/comm.md): compare two sorted files line by line
- [cp](/cmd/c/cp.md): copy files & directories
- [crontab](/cmd/c/crontab.md): time-based job scheduler
- [curl](/cmd/c/curl.md): transfer data from or to a server
- [cut](/cmd/c/cut.md): remove sections from each line of files
    - common combo: `column | cut`
- [date](/cmd/d/date.md): print or set the system date & time
- [df](/cmd/d/df.md): report file system disk space usage ( display free space )
- [diff](/cmd/d/diff.md): compare files line by line
    - better choice: `comm`
- [dig](/cmd/d/dig.md): DNS lookup utility
- [dstat](/cmd/d/dstat.md): versatile tool for generating system resource statistics
    - [iftop](/cmd/i/iftop.md): display bandwidth usage on an interface by host
    - [iostat](/cmd/i/iostat.md): statistics of CPU & IO for devices & partitions
    - [vmstat](/cmd/v/vmstat.md): report virtual memory statistics
- [du](/cmd/d/du.md): estimate file space usage ( disk usage )
- [env](/cmd/e/env.md): run a program in a modified environment
- [expect](/cmd/e/expect.md): interact with programs
- [expr](/cmd/e/expr.md): evaluate expressions
- [file](/cmd/f/file.md): determine file type
- [find](/cmd/f/find.md): search for files in a directory hierarchy
- [git](/cmd/g/git.md): the stupid content tracker
- [grep](/cmd/g/grep.md): print lines matching a pattern
    - [zgrep](/cmd/z/zgrep.md): search possibly compressed files for a regular expression
- [head](/cmd/h/head.md): output the first part of files
- [htop](/cmd/h/htop.md): interactive process viewer
- [ifconfig](/cmd/i/ifconfig.md): configure a network interface
- [ip](/cmd/i/ip.md): show / manipulate routing, devices, policy routing & tunnels
- [jobs](/cmd/j/jobs.md), bg, fg, disown, wait, …
    - stop (suspend) the execution of processes & continue (resume) their execution at a later point
- [join](/cmd/j/join.md): join lines of two files on a common field
- [jq](/cmd/j/jq.md): command-line JSON processor
- [kill](/cmd/k/kill.md): terminate or signal a process
    - [killall](/cmd/k/killall.md): kill processes by name
- [last](/cmd/l/last.md): show listing of last logged in users
- [less](/cmd/l/less.md): provides \`more\` emulation plus extensive enhancements
    - more: file perusal filter for paging through text one screenful at a time
- [ln](/cmd/l/ln.md): make links between files
- [locale](/cmd/l/locale.md): get locale-specific information
- [ls](/cmd/l/ls.md): list directory contents
- [lsof](/cmd/l/lsof.md): list open files
- [man](/cmd/m/man.md): an interface to the on-line reference manuals
- [mailx](/cmd/m/mailx.md): send mails on CentOS
- _[msmtp](/cmd/m/msmtp.md): send mails on macOS( sth wrong? )_
- [mkdir](/cmd/m/mkdir.md): make directories
- [mount](/cmd/m/mount.md): mount a filesystem
    - [umount](/cmd/m/mount.md#umount): un-mount a filesystem
- [mv](/cmd/m/mv.md): move (rename) files
- [mvn](/cmd/m/mvn.md): a tool for building & managing any Java-based project
- [nc](/cmd/n/nc.md): TCP / UDP connect & listen
- [netstat](/cmd/n/network-status.md): show network status
- [nl](/cmd/n/nl.md): number lines of files
- [nslookup](/cmd/n/nslookup.md): query Internet name servers interactively
- [passwd](/cmd/p/passwd.md): modify a user's password
- [paste](/cmd/p/paste.md): merge lines of files
- [perf](/cmd/p/perf.md): performance analysis tools for Linux ( todo )
- [php](/cmd/p/php.md): PHP Command Line Interface
- [pidstat](/cmd/p/pidstat.md): report statistics for Linux tasks
- [ping](/cmd/p/ping.md): send ICMP ECHO_REQUEST to network hosts
- [python](/cmd/p/python.md): Python Command Line Interface
- [ps](/cmd/p/ps.md): process status
- [realpath](/cmd/r/realpath.md): print the resolved path
- [redis-cli](/cmd/redis/redis-cli.md): Redis client
- [redis-server](/cmd/redis/redis-server.md) ( & redis-sentinel ): Redis server
- [redis-dump](/cmd/redis/redis-dump.md) ( & redis-load ): Backup & restore Redis data to and from JSON
- [rm](/cmd/r/rm.md): remove files or directories
- [rsync](/cmd/rsync/rsync.md): transfer files
- [scp](/cmd/s/scp.md): secure copy (remote file copy program)
- [sed](/cmd/s/sed.md): stream editor for filtering & transforming text
- [seq](/cmd/s/seq.md): print a sequence of numbers
- [service](/cmd/s/service.md): run a System V init script
- [sleep](/cmd/s/sleep.md): delay for a specified amount of time
- [sort](/cmd/s/sort.md): sort lines of text files
- [ssh](/cmd/s/ssh.md): OpenSSH Client (remote login program) ( todo )
- [stat](/cmd/s/stat.md): display file or file system status
- [su](/cmd/s/su.md): run a command with substitute user & group ID
- [sudo](/cmd/s/sudo.md): execute a command as another user
- _[sysctl](/cmd/s/sysctl.md): configure kernel parameters at runtime_
- [systemctl](/cmd/s/systemctl.md): control systemd & service manager
- [tac](/cmd/t/tac.md): concatenate and print files in reverse
- [tail](/cmd/t/tail.md): output the last part of files
- [tar](/cmd/t/tar.md): pack & compress
- [tee](/cmd/t/tee.md): write to standard output & files
- [telnet](/cmd/t/telnet.md): user interface to the TELNET protocol ( todo )
- [terminal-notifier](/cmd/t/terminal-notifier): send macOS User Notifications
- [timeout](/cmd/t/timeout.md): run a command with a time limit
- [tmux](/cmd/t/tmux.md): terminal multiplexer
- [touch](/cmd/t/touch.md): change file access & modification times
- [tr](/cmd/t/tr.md): translate or delete characters
- _[ulimit](/cmd/u/ulimit.md): system resource limit to shell_
- _[uname](/cmd/u/uname.md): print system information_
- [uniq](/cmd/u/uniq.md): report or omit repeated lines
- _[uptime](/cmd/u/uptime.md): show how long system has been running_
- [vim](/cmd/v/vim.md): terminal text editor
- [visudo](/cmd/v/visudo.md): edit the sudoers file
- _[w](/cmd/w/w.md): show who is logged on & what they are doing_
- [watch](/cmd/w/watch.md):  execute a program periodically, showing output fullscreen
- [wc](/cmd/w/wc.md): print newline, word, & byte counts for each file
- [wget](/cmd/w/wget.md): network downloader
- [whereis](/cmd/w/whereis.md) & [which](/cmd/w/which.md) & [whatis](/cmd/w/whatis.md): locate, show path & description
- _[whoami](/cmd/w/whoami.md): print effective userid_
- [xargs](/cmd/x/xargs.md): build and execute command lines from standard input
- _[xxd](/cmd/x/xxd.md): make a hexdump or do the reverse_
- [zsh](/cmd/z/zsh.md): one of shells
- _[CLI Notes](/cmd/notes.md) ( draft )_

Scenes

- __connect__: curl, nc, ssh, telnet
- __directory__: cp, find, ln, ls, mv
- __disk__: df, du
- __monitor status__: dstat, htop, lsof, netstat, pidstat, ps, stat, top
- __network detect__: dig, ifconfig, ip, netstat, nslookup, ping
- __string display__: cat, head, less, tac, tail
- __string process__:
    - awk, column, comm, cut, grep,
    - join, jq, paste, sed, sort,
    - tr, uniq, wc, …
- __transfer data__: ftp, nc, rsync, scp
- __write file__: tee, `>`, `2>&1`
- __notify__: terminal-notifier
- __http benchmark__: ab, watch
- __differ output__: comm, diff, vimdiff, watch
- ……

### C++

- [C++ Primer 5th](/cpp/primer-5th.md)
- [C++ Interview Book](/cpp/interview-book.md)
- [C++ Coding Standards](/cpp/code-standards.md)
- [C++ Macros & Bit Operations](/cpp/macro-n-bit-operations.md)
- Effective C++: [Part 1](/cpp/effective-cpp-reading-note-1.md) / [Part 2](/cpp/effective-cpp-reading-note-2.md) / [Part 3](/cpp/effective-cpp-reading-note-3.md) / [Part 4](/cpp/effective-cpp-reading-note-4.md)

### ASM

Assembly

_[Prepare on Windows 7](/asm/prepare-on-windows-7.md)_

1. [register / cs / ip / CPU / memory](/asm/learning-note-1.md)
2. [endien / register / ds / [addr] / stack](/asm/learning-note-2.md)
3. [pesudo instruction / compile / link / debug / [bx] / loop / seg prefix  / mem space](/asm/learning-note-3.md)
4. [stack / data / code / 栈的段 / 多段程序 / 大小写转换 / addressing / si / di](/asm/learning-note-4.md)
5. [bx / si / di / bp / addressing / division / dd / dup / Structural Data](/asm/learning-note-5.md)
6. [jump / offset / jmp / jcxz / loop / dec / bounds checking](/asm/learning-note-6.md)
7. [call / ret / mul / show str (pos, color) / division overflow / show value](/asm/learning-note-7.md)
8. [course design: 公司数据以指定格式在屏幕上显示](/asm/learning-note-8.md)
9. [flag register / adc / sbb / cmp 检测比较结果的条件转移指令，DF 标识和串传送指令 / Tests](/asm/learning-note-9.md)
10. [internal interrupt / interrupt routine / install 中断向量表 / 设置中断向量](/asm/learning-note-10.md)
11. [int instruction / Interrupt Routine / tests](/asm/learning-note-11.md)
12. [port IO / in / out / shl / shr / visit CMOS RAM](/asm/learning-note-12.md)
13. [external interrupt / 接口芯片和端口，可屏蔽|不可屏蔽中断，PC 机键盘的处理过程 / tests](/asm/learning-note-13.md)
14. [直接定址表 / data / 地址标号 / 在其它段中，计算 sin(x) / tests](/asm/learning-note-14.md)
15. [用 BIOS 进行键盘输入和磁盘读写 / tests](/asm/learning-note-15.md)
16. [Appendix: 汇编编译器对jmp的处理，地址计数器（AC），处理伪操作指令，栈传递参数，无溢出除法…](/asm/learning-note-16.md)

### Scripts

Shell

- [Notes](/scripts/shell/notes.md): a bash script example
- [Terminal Colors](/scripts/shell/terminal-colors.md)

_Batch 批处理_

- _[Batch 批处理指令](/scripts/batch/commands.md)_
- _[Batch 批处理中的特殊符号](/scripts/batch/dos-special-symbol.md)_
- _[DOS Common Commands](/scripts/batch/dos-common-commands.md)_
- _[DOS Environment Variables](/scripts/batch/dos-environment-variable.md)_

_Others_

- _AppleScript_
    - _[Quick Start](/scripts/applescript/quick-start.md)_
    - _[Control Evernote & macOS](/scripts/applescript/evernote-macos.md)_
- _PHP: [functions & scripts](/scripts/php/php.md)_
- _Python 3: [quick start](/scripts/python/quick-start.md)_
- _JavaScript: [optimize some code](/scripts/javascript/optimize-some-code.md)_

### Repos

Mine: [GitHub](https://github.com/IceHe) & [GitLab](https://gitlab.com/users/IceHe/projects)

- [lib](https://github.com/IceHe/lib): personal library | wiki ( this website )
- [mac-conf](https://github.com/IceHe/mac-conf): macOS configuration files

<!-- [GitHub DMCA](/path/to/github-dmca.md): Alert myself! -->

Recommendation

- [Art of Command Line](https://github.com/jlevy/the-art-of-command-line): master the command line, in one page
- [Redis](https://github.com/antirez/redis): an in-memory database that persists on disk

## Life

### Marks

> Get busy living or get busy dying.

<!-- > —— The Shawshank Redemption -->

- [Bio](/marks/bio.md): Skills / Exprience / Education
    - **SCUT**: Software Engineering | Bachelor _( C++ )_
    - **Huawei**: Telecom Software Customization | Intern. _( Java )_
    - **Sina Weibo**: Mobile API _( PHP )_ → Video Platform | Back-End _( Java )_
    - **Alibaba Local Life**: 众包物流运营 & 数据组后台 → 蜂鸟跑腿前台 | Back-End _( Java )_
- [Technology Bookmarks](/marks/tech.md)
- [Reading Bookmarks](/marks/read.md)

### Principles

> 博弈论：理性就是对你的各种东西设定一个优先级，并且能够贯彻执行这个优先级。

- [How to Ask](/snips/principles/how-to-ask.md)
    - JFGI: Just Fucking Google It
    - RTFM: Read The Fucking Manual
- [GTD](/snips/principles/gtd.md) Flow: Get Thing Done
- [PDCA](/snips/principles/pdca.md) Cycle: Plan → Do → Check → Act ( Adjust )
- [SMART](/snips/principles/smart.md) Principle: Specific / Measurable / Achievable / Relevant / Time-based
- [STAR](/snips/principles/star.md) Principle: Situation → Target → Action → Result
- [SWOT](/snips/principles/swot.md) Analysis: Strengths / Weakness / Oppertunities / Threats
- [What Why How](/snips/principles/what-why-how.md)

### Digest

> 写一部小说就像在黑夜里开车, 你只能看到车灯照亮的部分，但是你却可以走完整个旅程。

<!-- > —— E.L. Doctorow -->

好文共赏

- [Cruel Reality](http://www.cracked.com/blog/6-harsh-truths-that-will-make-you-better-person/) _/ [ZH ver.](http://mp.weixin.qq.com/s?__biz=MzA5MTM0NzIwNQ==&mid=2649760227&idx=2&sn=89fcbaf26cb56a21da2c4364fa3c9359) / [digest](/read/cruel-reality.md)_
    - "Nice guy? I never give a shit."
- [Life Meaning](https://www.zhihu.com/question/24561532/answer/28240920) _/ [digest](/read/meaning.md)_
    - "因为活着，才去寻找意义。"
- [Happyness Course](https://zhuanlan.zhihu.com/p/19562678) _/ [digest](/read/happiness-course.md)_
    - "如果你只有一个选择，它让你满意吗？"
- [Why Unhappy](https://zhuanlan.zhihu.com/p/19582894) _/ [digest](/read/why-unhappy.md)_
    - "我，并不特别。"
- [Poet](https://zhuanlan.zhihu.com/p/19895904): 诗和远方 _/ [digest](/read/poet.md)_
    - "眼前的苟且，也正是诗和远方。"
- [Teacher Said](https://www.zhihu.com/question/23721974/answer/25493813) _/ [digest](/read/teacher-said.md)_
    - "我们用「我能做到什么」来判断和定位自己，而别人用「你已经做过什么」来判断和定位你。"
    - "做正确的选择，而不是可以接受的选择。"
- [Pessimist](http://mp.weixin.qq.com/s?__biz=MzA5MjIzMzAwNg==&mid=233397081&idx=1&sn=836801a648013f925fca14de3572c45c&scene=1&srcid=0309TRipy9egTmxD0B51Q272#rd) _/ [digest](/read/pessimist.md)_
    - "It's the hardest part when memories remain."
- [Anti-Fragile](/read/anti-fragile.md) _/ [book](https://item.jd.com/11364406.html)_
    - "一只火鸡被屠夫喂养了 1000 天，每天都向其分析师证实，屠夫对火鸡的爱的「统计置信度与日俱增」。"

Read on 2020

-   _[VicodinXYZ's Life Beliefs](/read/life-beliefs.md)_
    -   "决策的第一要务是给自己创造足够多的好选项. 大多数决策失败来源于在几个都不够好的选择中反复纠结"
    -   "**对于日常小决策, 决策速度大于决策质量, 不要拖;**
        对于重大而难逆转的大决策, 要收集足够多信息尽量保证做对"
    -   "**不是生活中的每一个问题都要解决, 和问题共处是人生常态.**
        **把精力用在重要的事情上**"
-   _[Sspai Time Management](/read/sspai-time-mgt.md)_
    -   "提高自控力的一个小窍门是尽量避免在无谓的小事情上做决定。"
    -   "**更大的效率来自于重要事情上做得好，而不是在处处做得好，**
        **管理精力比管理时间更重要。**"
    -   "在考虑如何提高精力之前，我们得先解决导致精力被浪费的主要原因：
        **精力错位，也就是把最好的时间和状态，浪费在了低产出的任务上。**"
    -   "道理很简单，**「不做事」一定是最节省时间、最高效的做事方式，**
        **学会「做重要的事」才是掌控时间的终极法门。**"
    -   "何谓「真正的休息」呢？不少人习惯将阅读网站和新闻当作一种休息，
        事实上研究表明，**认知活动（阅读文字、视频等）加重了工作需求产生消极情绪**，
        另一项研究则表明，**对于减少疲惫感，而且通过智能手机应用休息的效果差于与朋友或同事社交。**"

### Past

> 如果你要拥有你从未有过的东西，那么你必须去做你从未做过的事。

<!-- > —— 电影《流浪地球》导演郭帆 -->

Timeline

- [2019 ~ 2021 on Weibo](https://weibo.com/icedes)
- [2018 Winter](/past/2018-winter.md)
- [2018 Spring ~ 2019 Autumn](/past/2018-spring-to-2019-autumn.md)
- [2017 Summer ~ Winter](/past/2017-summer-2-winter.md)
- [2017 Spring](/past/2017-spring.md)
- [2016 Winter](/past/2016-winter.md)
- [2016 Fall](/past/2016-fall.md)
- [2016 Spring & Summer](/past/2016-summer.md)
- [Bye 2015](/past/2015-bye.md)
- [Moments](/past/moments.md): 回忆
- [Old Blog](/past/old-blog.md): 旧博索引

Nonsense

- Time Management: [Life Logs](/lifelogs/archived/time-mgt-log.md) & [Log Format](/lifelogs/archived/time-mgt.md) _( until 2016.10 )_
- Way of Life: [Self Manual](/lifelogs/archived/life-manual.md) _( until 2017 )_
- [Routine](/lifelogs/archived/routine.md) & [TBC](/lifelogs/archived/tbc.md) _( 2019 ~ 2020.04 )_
- ~~[Rehabilitation](/lifelogs/rehabilitation.md) _( since 2020-12-14 )_~~
- [Simple Rehabilitation](/lifelogs/simple-rehabilitation.md) _( since 2021-01-13 )_

Previous Blog: 2015 ~ 2017

- [Tech Blog](https://icehe.me): icehe.me
- [How to Build Blog](/blog/build.md): 搭建博客
- [Blog Changlogs](/blog/changelog.md): 折腾博客

<details>
<summary>少不更事</summary>
<blockquote>
我没有一天不后悔。<br/>
并非受到惩罚才感到后悔。<br/>
回首往事，<br/>
那个愚钝的年轻笨蛋，<br/>
想跟他谈谈，<br/>
想要跟他讲道理，<br/>
想让他明白，<br/>
但是办不到。<br/>
那个少年早就不见了，<br/>
只剩下垂老的身躯，<br/>
我得接受现实。<br/>
</blockquote>
</details>

> 愚蠢，懒惰，贫穷，没有梦想。越活越畏畏缩缩，生怕别人发现自己尚未泯灭的野心，还有无能。

### Friends

> To be a better man.

<!-- > —— Better Man _( Robbie Williams song )_ -->

-   Jan Fan: PhD in Applied Mathematics / Python / Tencent / Study @ Sweden
-   Johnson Zhang: Past Roommate / Python / Sina Mobile / Didi @ Beijing
-   [SF Zhou](http://sf-zhou.github.io/): ACMer / C++ / Microsoft / SenseTime / Weixin @ Guangzhou
-   Shiwey Yan: Game Developer / C++ / Tencent - QQ Speed @ Shenzhen
-   [Toxic Johann](https://github.com/toxic-johann/toxic-johann.github.io/issues): Zhixin Schoolmate / Front-end / 360 / UC / Tencent / Tubi @ Beijing
-   [IceHe](https://icehe.xyz) ( myself ): A fool / Java Backend / Sina Weibo / Alibaba Local Life @ Beijing
- …

### Work

> Don’t try, just do. Failure is not an option.

<!-- > —— Elon Musk -->

<!-- > Get it / Make it without reason. -->

- 请示工作说方案
- 布置工作说标准
- 汇报工作说结果
- 总结工作说流程
- 回顾工作说感受

## End

> 靡不有初，鮮克有終。

<!-- 靡不有初，鲜克有终。 -->
<!-- > —— 《诗经·大雅·荡》 -->
