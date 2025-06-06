<!-- # Library -->

# Notes

[Welcome](/life/welcome.md) to IceHe's web notes!

---

> 好记性不如烂博客

<!--

> Later equals never.
>
> —— LeBlanc's Law

-->

-   Here: [https://icehe.life](https://icehe.life)
-   Whoami: [IceHe's bio](/life/bio.md)

## Technology

### Reading

[IceHe's Reading List](https://book.douban.com/people/IceHeGZ/collect) @douban.com

> 短期太急躁，總想走捷徑快速見效；
> 長期沒耐心，小覷長期堅持的成長。

<!--

> 紙上得來終覺淺，絕知此事要躬行。
>
> —— 陆游《冬夜读书示子聿》

-->

Coding

-   [Refactoring](/book/refactoring.md)
    -   Improving the Design of Existing Code
-   [Design Patterns](/book/design-patterns.md)
    -   Elements of Reusable Object-Oriented Software
-   [Pragmatic Programmer](/book/pragmatic-programmer.md)
    -   Your journey to mastery - 2nd Edition
-   [Clean Agile](/book/clean-agile.md)
    -   Back to Basics
-   [The Zen of Python](https://www.python.org/dev/peps/pep-0020)
    -   PEP 20

<!-- todo some day

-   [Peopleware](/book/peopleware.md)
    -   Productive Projects and Teams
-   [The Manager's Path](/book/the-manager-s-path.md)
    -   A Guide for Tech Leaders Navigating Growth and Change
-   [Google Engineering Practices](/snip/tmp/google-eng-practices.md) (notes)
    -   How to do code review
    -   How to get through a code review

-->

Designing Data Intensive Applications - [TOC](/book/designing-data-intensive-applications-toc.md)

-   [Part I. Foundations of Data Systems](/book/designing-data-intensive-applications-p1.md)
    -   1\. **Reliable**, **Scalable**, and Maintainable Applications
    -   2\. **Data Models** and Query Languages
    -   3\. **Storage** and **Retrieval** / 4\. **Encoding** and Evolution
-   [Part II. Distributed Data](/book/designing-data-intensive-applications-p2.md)
    -   5\. **Replication** / 6\. **Partitioning** / 7\. **Transactions**
    -   8\. The Trouble with **Distributed Systems**
    -   9\. **Consistency** and **Consensus**
-   [Part III. Derived Data](/book/designing-data-intensive-applications-p3.md)
    -   10\. **Batch** Processing / 11\. **Stream** Processing / …

JVM - Java Virtual Machine - [TOC](/book/understand-jvm-toc.md)

-   [Part I & Part II. Automatic Memory Management](/book/understand-jvm-p1-n-p2.md)
-   [Part III. Execution Engine](/book/understand-jvm-p3.md) - _todo some day_
-   Part IV. Compile and Code Optimize

_Fundamentals of Software Architecture - [TOC](/book/fundamentals-of-software-architecture-toc.md)_

-   _[reading notes](/book/fundamentals-of-software-architecture.md)_ <!-- 这本书感觉一般 -->

<!-- todo some day

[TCP/IP Illustrated, Volume 1: The Protocols, 2nd Edition](/book/tcp-ip-illustrated-protocols-toc.md) - TOC

- [Part*  1](/book/tcp-ip-illustrated-protocols-p1.md)

xUnit Test Patterns: Refactoring Test Code - [douban.com](https://book.douban.com/subject/1859393/)

Others

- [Life Is Tough, But Wireshark Makes It Easy](/book/wireshark-makes-life-easy.md)
- [Java Concurrency in Practice](/book/java-concurrency-in-practice.md)
- [Linux Kernel Development](/book/linux-kernel-development.md)

-->

### Snippet

> 巨大的建築，總是由一木一石疊起來的，我們何妨做做這一木一石呢？我時常做些零碎事，就是為此。
>
> —— 鲁迅《致赖少麟》

Algorithm & Data Structure

-   [Solve programming problems](/snip/solve-programming-problem.md): notes, aka. cheat sheet.
-   [LeetCode](https://leetcode.cn/u/icehehzy/): 光说不练假把式。

Terminology

-   [Abbreviations](/snip/abbrs.md)
    -   usually related to coding (programming)
-   [Glossaries](/snip/glossaries.md)
    -   with intros to the common technology products

Message Queue

-   [kafka](/snip/mq/kafka.md) - _[digest](/snip/mq/kafka-digest.md)_
-   [RabbitMQ](/snip/mq/rabbit-mq.md)
-   [RocketMQ](/snip/mq/rocket-mq.md)
-   [ActiveMQ](/snip/mq/active-mq.md)
    <!-- -   [ZeroMQ](/snip/mq/zero-mq.md) - _todo some day_ -->
-   _[MemcacheQ](/snip/mq/mcq.md)_
-   _[Notes](/snip/mq/notes.md)_

Storage

-   **MySQL**: lessons
    [p1](/snip/mysql/45-practice-lectures-p1.md.md) /
    [p2](/snip/mysql/45-practice-lectures-p2.md.md) /
    [p3](/snip/mysql/45-practice-lectures-p3.md.md) /
    [commands](/cmd/m/mysql.md)

    -   robust SQL database server

-   **PostgreSQL**: [notes](/snip/postgresql/notes.md)
-   **Elasticsearch**: [usage](/snip/elasticsearch.md)
    -   for search and analysis
-   **Redis**:
    [basics](/snip/redis/basics.md) /
    [notes](/snip/redis/notes.md) /
    [key notes](/snip/redis/key-notes.md)
    -   in-memory data structure store as a database, cache and message broker
        <!-- basics: http://redis.io -->
        <!-- usage: https://redis.io/commands -->
-   **LSM Tree**: [intro](/snip/lsm-tree/lsm-tree.md)
    -   basic data structure of LevelDB & RocksDB
-   [Cache Patterns](/snip/cache-patterns.md)
    -   cache aside / read through / write through / write behind caching

Markdown

-   [Markdown Style Guide](/docsify/markdown/markdown-style-guide.md)
-   [MDL - Markdown Lint Tool](/docsify/markdown/lint/lint.md)

Web

-   [URL explained - The Fundamentals](https://ittavern.com/url-explained-the-fundamentals/)
-   [IP Address](/snip/network/ip.md)
-   [Network - Notes](/snip/network/notes.md)
-   [URL Encoding](/snip/web/url-encoding.md)
    aka. Percent Encoding
    -   a method to encode arbitrary data in a Uniform Resource Identifier (URI) using only the limited US-ASCII characters legal within a URI
-   [Base64 Encoding](/snip/web/base64-encoding.md)
    -   a group of binary-to-text encoding schemes that represent binary data in an ASCII string format
-   Simple HTTP service
    -   [init.d](/snip/init.d/init.d.md) with `php -S`
    -   [Nginx](/snip/nginx/nginx.md) via the configuration file
-   How to build my personal website?
    -   Powered by [docsify](/docsify/how-to-docsify.md)
-   How to estimate the required computing resources?
    -   [QPS to CPU Cores](/snip/web/qps-to-cpu-cores.md)

Programming Languages - at a glance

-   [PHP](/snip/lang/php/php.md)
    -   a popular general-purpose scripting language that is especially suited to web development
-   [AppleScript](/snip/lang/applescript/applescript.md)
    -   a scripting language that facilitates automated control over scriptable Mac applications
    -   [Control Evernote & macOS](/snip/lang/applescript/evernote-macos.md)
-   [Learn X in Y minutes](https://learnxinyminutes.com)

<!-- maybe some day

    -   _[Elixir](/snip/lang/elixir/elixir.md): a dynamic, functional language for building scalable and maintainable applications_
    -   _[Scala](/snip/lang/scala.md): combines object-oriented and functional programming in one concise, high-level language_
    -   _[Python](/snip/lang/python.md): a programming language that lets you work quickly and integrate systems more effectively_

-   [Kotlin](/snip/lang/kotlin/kotlin.md)
    -   a cross-platform, statically typed, general-purpose programming language with type inference
    -   [Basics](/snip/lang/kotlin/basics.md) / [Idioms](/snip/lang/kotlin/idioms.md) (todo) / [Compiler](/snip/lang/kotlin/compiler.md) / …
    -   Mocking for unit tests
        -   [MockK](/snip/lang/kotlin/mocking.md#MockK): mocking library for Kotlin
        -   [Mockito](/snip/lang/kotlin/mocking.md#Mockito): tasty mocking framework for unit tests in Java

Client-side

-   [Android](/snip/android/android.md)

    a mobile/desktop operating system based on a modified version of the Linux kernel and other open source software, designed primarily for touchscreen mobile devices such as smartphones and tablets

    -   [Intents and Intent Filters](/snip/android/intents-filters.md)
    -   [Intro to Activities](/snip/android/intro-to-activities.md)
    -   [Activity Lifecycle](/snip/android/activity-lifecycle.md)
    -   …

-->

Others

-   [Alpine Linux](/snip/docker/alpine/alpine.md)
    -   minimal OS Docker image
-   [Debug](/snip/debug/notes.md) experiences
-   [Regular Expression](/snip/regex.md)
    -   a sequence of characters that specifies a search pattern
-   [Kotlin + Spring Boot](/snip/tmp/kotlin-spring-boot.md) (doing)
-   _[ID Generator](/snip/tmp/id-generator.md)_
-   _[Memcached](/snip/tmp/memcached.md)_
-   _[Work Flow](/snip/tmp/work-flow.md)_
-   _[XXL-JOB](https://www.xuxueli.com/xxl-job/) - [github](https://github.com/xuxueli/xxl-job)_
-   _[Cache Line - False Sharing](https://www.cnblogs.com/cyfonly/p/5800758.html)_

### Efficiency

> 磨刀不誤砍柴工。

macOS

-   [Setup Guide](/mac/setup-guide.md) - 设置指南
-   [Efficiency Guide](/mac/efficiency-guide.md) - 效率指南
    -   [macOS shortcuts](/mac/shortcut/macos.md)
    -   [Sublime Text shortcuts](/mac/shortcut/sublime-text.md)
    -   [JetBrains IDE shortcuts](/mac/shortcut/jetbrains.md)
    -   [mac-conf](https://github.com/IceHe/mac-conf): my macOS configuration files
-   [JVM Options Optimization](/mac/jetbrains/vm-options.md)
    -   _e.g. for JetBrains IDE - IntelliJ IDEA_

Git

-   [Common Commands](/git/common-commands.md)
-   [Concepts & Theory](/git/concepts-n-theory.md)
-   [Docs Digest](/git/docs-digest.md)
-   [Commit Signature Verification](/git/commit-signature-verification.md)

### Command

Manual

-   [ab](/cmd/a/ab.md): Apache HTTP server benchmarking tool
-   [ag](/cmd/a/ag.md): The Silver Searcher. Like `ack`, but faster.
-   [awk](/cmd/a/awk.md): pattern-directed scanning and processing language
    -   [gawk](/cmd/a/awk.md): pattern scanning and processing language
-   [bash](/cmd/bash/bash.md): GNU Bourne-Again SHell
    -   [parameter](/cmd/bash/parameter.md): basic, expansion & substitution
    -   [shell variables](/cmd/bash/shell-variables.md): variables are set by the shell
-   [brew](/cmd/b/brew.md): the missing package manager for macOS
-   [bzip2](/cmd/b/bzip2.md): block-sorting file compressor
-   [cat](/cmd/c/cat.md): concatenate files & print on the standard output
-   [cd](/cmd/c/cd.md): change the current directory
-   [chgrp](/cmd/c/chgrp.md): change group ownership
-   [chmod](/cmd/c/chmod.md): change file mode bits
-   [chown](/cmd/c/chown.md): change file owner & group
-   [column](/cmd/c/column.md): columnate lists
-   [comm](/cmd/c/comm.md): compare two sorted files line by line
-   [cp](/cmd/c/cp.md): copy files & directories
-   [cpu](/cmd/c/cpu.md): show cpu info - _not a command_
-   [crontab](/cmd/c/crontab.md): time-based job scheduler
-   [curl](/cmd/c/curl.md): transfer data from or to a server
-   [cut](/cmd/c/cut.md): remove sections from each line of files
    -   common combo: `column | cut`
-   [date](/cmd/d/date.md): print or set the system date & time
-   [df](/cmd/d/df.md): report file system disk space usage - _display free space_
-   [diff](/cmd/d/diff.md): compare files line by line
    -   better choice: `comm`
-   [dig](/cmd/d/dig.md): DNS lookup utility
-   [docker](/cmd/d/docker.md): base command for the Docker CLI
-   [dstat](/cmd/d/dstat.md): versatile tool for generating system resource statistics
    -   [iftop](/cmd/i/iftop.md): display bandwidth usage on an interface by host
    -   [iostat](/cmd/i/iostat.md): statistics of CPU & IO for devices & partitions
    -   [vmstat](/cmd/v/vmstat.md): report virtual memory statistics
-   [du](/cmd/d/du.md): estimate file space usage - _disk usage_
-   [env](/cmd/e/env.md): run a program in a modified environment
-   [expect](/cmd/e/expect.md): interact with programs
-   [expr](/cmd/e/expr.md): evaluate expressions
-   [file](/cmd/f/file.md): determine file type
-   [find](/cmd/f/find.md): search for files in a directory hierarchy
-   [git](/cmd/g/git.md): the stupid content tracker
-   [gpg](/cmd/g/gpg.md): OpenPGP encryption and signing tool
-   [grep](/cmd/g/grep.md): print lines matching a pattern
    -   [zgrep](/cmd/z/zgrep.md): search possibly compressed files for a regular expression
-   [head](/cmd/h/head.md): output the first part of files
-   [htop](/cmd/h/htop.md): interactive process viewer
-   [ifconfig](/cmd/i/ifconfig.md): configure a network interface
-   [ip](/cmd/i/ip.md): show / manipulate routing, devices, policy routing & tunnels
-   [jobs](/cmd/j/jobs.md), bg, fg, disown, wait, …
    -   stop (suspend) the execution of processes & continue (resume) their execution at a later point
-   [join](/cmd/j/join.md): join lines of two files on a common field
-   [jq](/cmd/j/jq.md): command-line JSON processor
-   [kill](/cmd/k/kill.md): terminate or signal a process
    -   [killall](/cmd/k/killall.md): kill processes by name
-   [last](/cmd/l/last.md): show listing of last logged in users
-   [less](/cmd/l/less.md): provides \`more\` emulation plus extensive enhancements
    -   more: file perusal filter for paging through text one screenful at a time
-   [ln](/cmd/l/ln.md): make links between files
-   [locale](/cmd/l/locale.md): get locale-specific information
-   [ls](/cmd/l/ls.md): list directory contents
-   [lsof](/cmd/l/lsof.md): list open files
-   [man](/cmd/m/man.md): an interface to the on-line reference manuals
-   [mailx](/cmd/m/mailx.md): send mails on CentOS
-   _[msmtp](/cmd/m/msmtp.md): send mails on macOS - sth wrong?_
-   [mkdir](/cmd/m/mkdir.md): make directories
-   [mount](/cmd/m/mount.md): mount a filesystem
    -   [umount](/cmd/m/mount.md#umount): un-mount a filesystem
-   [mv](/cmd/m/mv.md): move (rename) files
-   [mvn](/cmd/m/mvn.md): a tool for building & managing any Java-based project
-   [mysql](/cmd/m/mysql.md): MySQL CLI tool - _not only a command_
-   [nc](/cmd/n/nc.md): TCP / UDP connect & listen
-   [netstat](/cmd/n/network-status.md): show network status
-   [nl](/cmd/n/nl.md): number lines of files
-   [nginx](/cmd/n/nginx.md): HTTP and reverse proxy server
-   [nohup](/cmd/n/nohup): invoke a utility immune to hangups
-   [nslookup](/cmd/n/nslookup.md): query Internet name servers interactively
-   [os](/cmd/o/os.md): show os info - _not a command_
-   [output](/cmd/o/output.md): redirect output - _not a command_
-   [passwd](/cmd/p/passwd.md): modify a user's password
-   [paste](/cmd/p/paste.md): merge lines of files
-   [perf](/cmd/p/perf.md): performance analysis tools for Linux
-   [php](/cmd/p/php.md): PHP Command Line Interface
-   [pidstat](/cmd/p/pidstat.md): report statistics for Linux tasks
-   [ping](/cmd/p/ping.md): send ICMP ECHO_REQUEST to network hosts
-   [python](/cmd/p/python.md): Python Command Line Interface
-   [ps](/cmd/p/ps.md): process status
-   [realpath](/cmd/r/realpath.md): print the resolved path
-   [redis-cli](/cmd/redis/redis-cli.md): Redis client
-   [redis-server](/cmd/redis/redis-server.md) & redis-sentinel: Redis server
-   [redis-dump](/cmd/redis/redis-dump.md) & redis-load: Backup & restore Redis data to and from JSON
-   [rm](/cmd/r/rm.md): remove files or directories
-   [rsync](/cmd/rsync/rsync.md): transfer files
-   [scp](/cmd/s/scp.md): secure copy - _remote file copy program_
-   [sed](/cmd/s/sed.md): stream editor for filtering & transforming text
-   [seq](/cmd/s/seq.md): print a sequence of numbers
-   [service](/cmd/s/service.md): run a System V init script
-   [sleep](/cmd/s/sleep.md): delay for a specified amount of time
-   [sort](/cmd/s/sort.md): sort lines of text files
-   [ssh](/cmd/s/ssh.md): OpenSSH Client - _remote login program_
-   [stat](/cmd/s/stat.md): display file or file system status
-   [su](/cmd/s/su.md): run a command with substitute user & group ID
-   [sudo](/cmd/s/sudo.md): execute a command as another user
-   _[sysctl](/cmd/s/sysctl.md): configure kernel parameters at runtime_
-   [systemctl](/cmd/s/systemctl.md): control systemd & service manager
-   [tac](/cmd/t/tac.md): concatenate and print files in reverse
-   [tail](/cmd/t/tail.md): output the last part of files
-   [tar](/cmd/t/tar.md): pack & compress
-   [tee](/cmd/t/tee.md): write to standard output & files
-   [terminal-notifier](/cmd/t/terminal-notifier): send macOS User Notifications
-   [time](/cmd/t/time.md): time command execution
-   [timeout](/cmd/t/timeout.md): run a command with a time limit
-   [tmux](/cmd/t/tmux.md): terminal multiplexer
-   [touch](/cmd/t/touch.md): change file access & modification times
-   [tr](/cmd/t/tr.md): translate or delete characters
-   _[ulimit](/cmd/u/ulimit.md): system resource limit to shell_
-   _[uname](/cmd/u/uname.md): print system information_
-   [uniq](/cmd/u/uniq.md): report or omit repeated lines
-   _[uptime](/cmd/u/uptime.md): show how long system has been running_
-   [vim](/cmd/v/vim.md): terminal text editor
-   [visudo](/cmd/v/visudo.md): edit the sudoers file
-   _[w](/cmd/w/w.md): show who is logged on & what they are doing_
-   [watch](/cmd/w/watch.md): execute a program periodically, showing output fullscreen
-   [wc](/cmd/w/wc.md): print newline, word, & byte counts for each file
-   [wget](/cmd/w/wget.md): network downloader
-   [whereis](/cmd/w/whereis.md) & [which](/cmd/w/which.md) & [whatis](/cmd/w/whatis.md): locate, show path & description
-   _[whoami](/cmd/w/whoami.md): print effective userid_
-   [xargs](/cmd/x/xargs.md): build and execute command lines from standard input
-   _[xxd](/cmd/x/xxd.md): make a hexdump or do the reverse_
-   _[yes](/cmd/y/yes.md): be repetitively affirmative_
-   [zsh](/cmd/z/zsh.md): one of shells
-   [Linux Abbreviations](/cmd/linux-abbrs.md)
-   _[CLI Notes](/cmd/notes.md) - todo some day_

Scene

-   **automate**: expect, yes
-   **connect**: curl, nc, ssh, telnet
-   **directory**: cp, find, ln, ls, mv
-   **disk**: df, du, duf
-   **monitor status**: dstat, htop, lsof, netstat, pidstat, ps, stat, top
-   **network detect**: dig, ifconfig, ip, netstat, nslookup, ping
-   **string display**: cat, head, less, tac, tail
-   **string process**:
    -   awk, column, comm, cut, grep,
    -   join, jq, paste, sed, sort,
    -   tr, uniq, wc, …
-   **transfer data**: ftp, nc, rsync, scp
-   **write file**: tee, `>`, `2>&1`
-   **notify**: terminal-notifier
-   **http benchmark**: ab, watch
-   **differ output**: comm, diff, vimdiff, watch
-   **run in background**: `^z`, bg, fg, nohup [CMD] &
-   ……

Shell

-   [Notes](/cmd/shell/notes.md): a bash script example
-   [Terminal Colors](/cmd/shell/terminal-colors.md)

_Batch 批处理_

-   _[Batch 批处理指令](/cmd/batch/commands.md)_
-   _[Batch 批处理中的特殊符号](/cmd/batch/dos-special-symbol.md)_
-   _[DOS Common Commands](/cmd/batch/dos-common-commands.md)_
-   _[DOS Environment Variables](/cmd/batch/dos-environment-variable.md)_

### Java

Basics

-   [Glossaries](/java/glossaries.md)
-   **Install**: [JDK](/java/install-jdk.md)
-   **IDE**: [IntelliJ IDEA](/java/intellij-idea.md) usage
-   **Code Style Guide**: [Alibaba](https://edu.aliyun.com/certification/cldt02) & [Google](https://google.github.io/styleguide/javaguide.html)
-   [Annotations](/java/annotations.md):
    Spring / Lombok / FastJson / Jackson / …
-   [Exceptions](/java/exceptions.md):
    exception class hierarchy / …
-   **Others**: [Notes](/java/notes.md)

Package Manager

-   [Maven](/java/maven.md): a software project management and comprehension tool
    -   Based on the concept of a **project object model** (POM), Maven can:
        -   manage a project's build,
        -   reporting _and_
        -   documentation from a central piece of information.
-   [Gradle](/java/gradle.md)
    -   From mobile apps to microservices, from small startups to big enterprises,
    -   Gradle helps teams build, automate and deliver better software, faster.

Benchmark, Stress Testing & Unit Testing

-   **Benchmark & Stress Testing**: [JMH](/java/jmh.md) - Java Microbenchmark Harness
-   **Unit testing & Integration testing**: [Spock](/java/spock.md) or JUnit
    -   [Groovy](/java/groovy.md): a multi-faceted language for the Java platform

Code Snippet

-   [CSV - Comma Separate Value](/java/code-snippet/csv.md)
-   [Excel](/java/code-snippet/excel.md)
-   [Elasticsearch](/java/code-snippet/elasticsearch.md)
-   [Executor](/java/code-snippet/executor.md)
-   [JSON](/java/code-snippet/json.md)
-   [LocalDateTime](/java/code-snippet/local-date-time.md)
-   [MyBatis and JDBC](/java/code-snippet/mybatis-n-jdbc.md)
-   [OSS - Object Storage Service](/java/code-snippet/oss.md)
-   [Spring Beans](/java/code-snippet/spring-beans.md)
-   [Spring ConstraintValidator](/java/code-snippet/spring-constraint-validator.md)
-   [Stream and Optional](/java/code-snippet/stream-n-optional.md)
-   [Task](/java/code-snippet/task.md)

Command Line Tool

-   [jar](/java/cmd/jar.md): archive tool
-   [java](/java/cmd/java.md): application launcher
-   [javac](/java/cmd/javac.md): compiler
-   [javap](/java/cmd/javap.md): class file disassembler
-   [jps](/java/cmd/jps.md): JVM process status - _list the instrumented JVMs on the target system_
-   [jcmd](/java/cmd/jcmd.md): send diagnostic command requests to a running JVM
-   [jhsdb](/java/cmd/jhsdb.md): HotSpot Debugger
    -   _attach to a Java process or launch a postmortem debugger to analyze the content of a core dump from a crashed JVM_
    -   _available after JDK 9_
-   _Seldom-used and deprecated_
    -   _[javadoc](/java/cmd/javadoc.md): API documentation generator_
    -   _[jstat](/java/cmd/jstat.md): monitor JVM statistics_
    -   _[jinfo](/java/cmd/jinfo.md): configuration info_ - _generate configuration info for a specified Java process_
    -   _[jmap](/java/cmd/jmap.md): memory map_ - _print details of a specified process_
    -   _~~[jhat](/java/cmd/jhat.md): Heap Analysis Tool~~_ - _only available in JDK 8 !_
    -   _[jstack](/java/cmd/jstack.md): stack trace_ - _print Java stack traces of Java threads for a specified Java process_

### JavaScript

Basics

-   [JavaScript](/js/js.md): aka. [ECMAScript](https://en.wikipedia.org/wiki/ECMAScript)
-   [Node.js](/js/nodejs.md): a JavaScript runtime built on Chrome's V8 JavaScript engine
    -   [API Documentation](/js/nodejs-api.md): for 16.X LTS version
-   [Promise](/js/basics/promise.md) object represents the eventual completion (or failure) of an asynchronous operation and its resulting value
    -   [async & await](/js/basics/async-n-await.md): to simplify the syntax necessary to consume promise-based APIs
    -   [states & fates](/js/basics/promise-states-n-fates.md): clarify the different adjectives surrounding promises
        -   **States**: { settled: [ fulfilled, rejected ] , unsettled: [ pending ] }
        -   **Fates**: [ resolved, unresolved ]
-   [Event Loop](/js/basics/event-loop.md): which the JavaScript concurrency model based on
-   **Tasks vs. Microtasks**:
    -   _[Using microtasks in JavaScript with queueMicrotask](https://developer.mozilla.org/en-US/docs/Web/API/HTML_DOM_API/Microtask_guide)_
    -   _[In depth: Microtasks and the JavaScript runtime environment](https://developer.mozilla.org/en-US/docs/Web/API/HTML_DOM_API/Microtask_guide/In_depth)_
-   HTML Living Standard: [html.spec.whatwg.org](https://html.spec.whatwg.org)

Code Snippet

-   [Base Encoding](/js/code-snippet/base64-encoding.md): encode, decode
-   [Environment](/js/code-snippet/environment.md): running under Node or browser-like environments
-   [Jest](/js/code-snippet/jest.md): for unit tests
-   [\*.d.ts](/js/code-snippet/d.ts.md) declaration files that functions as an interface to the components compiled in JavaScript
-   [debugger](/js/code-snippet/debugger.md) statement invokes any available debugging functionality, such as setting a breakpoint.
    -   [Pause code with breakpoints](/js/code-snippet/debugger.md#Pause-code-with-breakpoints) - Chrome DevTools
        -   DOM change, **XHR/Fetch**, event listener, **exception** and **function `debug(functionName)`**

Package Management

-   [npm](/js/package-management/npm.md): share and borrow packages
-   [yarn](/js/package-management/yarn.md): a package manager that doubles down as project manager
-   [pnpm](/js/package-management/pnpm.md): fast, disk space efficient package manager

NPM: the world's largest software registry

-   Configuring
    -   [package.json](/js/npm-configuring/package-json.md): a lot of the behavior described in this document is affected by the config settings described in [config](https://docs.npmjs.com/cli/v7/using-npm/config).
    -   [package-lock.json](/js/npm-configuring/package-lock-json.md): a manifestation of the manifest
    -   [folders](/js/npm-configuring/folders.md): folder structures used by npm
    -   [npm semver calculator](https://semver.npmjs.com/) & [Sematic Versioning](https://semver.org/) (external links)
        -   _[About semantic versioning - npm Docs](https://docs.npmjs.com/about-semantic-versioning)_
-   Using
    -   [registry](/js/npm-using/registry.md): The JavaScript package registry
    -   [scope](/js/npm-using/scope.md): scoped packages
    -   [scripts](/js/npm-using/scripts.md): How npm handles the "scripts" field
    -   [workspaces](/js/npm-using/workspaces.md): Working with workspaces
-   Command
    -   [npm](/js/npm-cmd/npm.md): javascript package manager
    -   [npm init](/js/npm-cmd/npm-init.md): create a `package.json` file
    -   [npm install](/js/npm-cmd/npm-install.md): install a package
    -   [npm link](/js/npm-cmd/npm-link.md): symlink a package folder
    -   [npm publish](/js/npm-cmd/npm-publish.md): publish a package
    -   [npm exec](/js/npm-cmd/npm-exec.md), `npx`: run a command from a local or remote npm package

TypeScript

-   [TypeScript Deep Dive](/js/typescript/typescript-deep-dive.md)
-   [TypeScript](/js/typescript/typescript.md): JavaScript with syntax for types
-   [tsc](/js/typescript/tsc.md): compiles the current project, with additional settings
-   [tsconfig.json](/js/typescript/tsconfig-json.md): specifies the root files and the compiler options required to compile the project
-   Handbook
    -   [Intro](/js/typescript/handbook/intro.md)
    -   [Basics](/js/typescript/handbook/basics.md)
    -   [Everyday Types](/js/typescript/handbook/everyday-types.md)
    -   [Narrowing](/js/typescript/handbook/narrowing.md)
    -   [More on Functions](/js/typescript/handbook/more-on-functions.md)
    -   [Object Types](/js/typescript/handbook/type-objects.md)
    -   [Type Manipulation](/js/typescript/handbook/type-manipulation.md)

[Package](/js/package/notes.md)

### ASM & CPP

Assembly

_[Prepare on Windows 7](/asm/prepare-on-windows-7.md)_

1. [register / cs / ip / CPU / memory](/asm/learning-note-1.md)
2. [endian / register / ds / [addr] / stack](/asm/learning-note-2.md)
3. [pseudo instruction / compile / link / debug / [bx] / loop / seg prefix / mem space](/asm/learning-note-3.md)
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
16. [Appendix: 汇编编译器对 jmp 的处理，地址计数器（AC），处理伪操作指令，栈传递参数，无溢出除法…](/asm/learning-note-16.md)

C++

-   [C++ Primer 5th](/cpp/primer-5th.md)
-   [C++ Interview Book](/cpp/interview-book.md)
-   [C++ Coding Standards](/cpp/code-standards.md)
-   [C++ Macros & Bit Operations](/cpp/macro-n-bit-operations.md)
-   Effective C++: [Part 1](/cpp/effective-cpp-reading-note-1.md) / [Part 2](/cpp/effective-cpp-reading-note-2.md) / [Part 3](/cpp/effective-cpp-reading-note-3.md) / [Part 4](/cpp/effective-cpp-reading-note-4.md)

### Auth\*

-   [OAuth 2](https://oauth.net/2/) - Open **Authorization**

    an open standard for access delegation, commonly used as a way for Internet users to grant websites or applications access to their information on other websites but without giving them the passwords

    -   [Resource Indicators for OAuth 2.0](https://www.rfc-editor.org/rfc/rfc8707.html) - RFC 8707
    -   [The OAuth 2.0 Authorization Framework: Bearer Token Usage](https://www.rfc-editor.org/rfc/rfc6750) - RFC 6750
    -   [CSRF Attack on OAuth 2.0](/auth/csrf-attack-on-oauth.md)
    -   _[OAuth 2 in Action - Book](/auth/oauth-2-in-action.md) <!-- todo -->_
    -   _[OAuth 2.0 实战课 - Geekbang](/auth/oauth-2.0-practical-course.md)_

-   OIDC (Open ID Connect)

    an interoperable authentication protocol based on the OAuth 2.0 family of specifications

    -   [OIDC Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
        -   OpenID Connect Core 1.0 incorporating errata set 1
        -   It defines the core OpenID Connect functionality:
            authentication built on top of OAuth 2.0 and the use of Claims to communicate information about the End-User.
        -   _It also describes the security and privacy considerations for using OpenID Connect._
    -   [PKCE](https://datatracker.ietf.org/doc/html/rfc7636): Proof Key for Code Exchange by OAuth Public Clients - RFC7636

## Life

Living

### Past

> 如果你要拥有你从未有过的东西，那么你必须去做你从未做过的事。

<!-- > -->
<!-- > —— 电影《流浪地球》导演郭帆 -->

<!--

> Get busy living or get busy dying.
>
> —— The Shawshank Redemption

-->

[Bio](/life/bio.md): **Backend** Experience & Education

-   **Silverhand**: Founding Team - Node.js
-   **YFD**: Zebra - Supply Chain - Java
-   **Alibaba Local Life**: 蜂鸟跑腿前台 - Java
-   **Alibaba Local Life**: 众包物流运营 & 数据组后台 - Java
-   **Weibo**: Video Platform - Java
-   **Weibo**: Mobile API - PHP
-   **Huawei**: Telecom Software Customization - Java Intern.
-   **SCUT**: Software Engineering - Bachelor

Timeline

-   After 2018
    -   [How to live](/life/principle/how-to-live.md)
    -   [2022 Feb ~ Apr: Best Gain Everyday](/life/timeline/best-gain-everyday.md)
        -   _from both technology practice and daily life_
    -   [2019 ~ 2021 on Weibo](https://weibo.com/icedes)
    -   [2018 Winter](/life/timeline/2018-winter.md)
    -   [2018 Spring ~ 2019 Autumn](/life/timeline/2018-spring-to-2019-autumn.md)
    -   [Moments](/life/timeline/moments.md) 回忆
-   2015 ~ 2017
    -   [2017 Summer ~ Winter](/life/timeline/2017-summer-2-winter.md)
    -   [2017 Spring](/life/timeline/2017-spring.md)
    -   [2016 Winter](/life/timeline/2016-winter.md)
    -   [2016 Fall](/life/timeline/2016-fall.md)
    -   [2016 Spring & Summer](/life/timeline/2016-summer.md)
    -   [Bye 2015](/life/timeline/2015-bye.md)
    -   [icehe.github.io](https://icehe.github.io): previous technology blog
-   Before 2015
    -   [QZone Index](/life/timeline/qzone-index.md) of the old posts

> 愚蠢，懒惰，贫穷，没有梦想。越活越畏畏缩缩，生怕别人发现自己尚未泯灭的野心，还有无能。

### Practice

> 博弈论：理性就是对你的各种东西设定一个优先级，并且能够贯彻执行这个优先级。

-   [How to Ask](/life/principle/how-to-ask.md): Prepare before asking
    -   [Avoid the stupid ways](https://github.com/tangx/Stop-Ask-Questions-The-Stupid-Ways/blob/master/README.md)
    -   JFGI: Just Fucking Google It
    -   RTFM: Read The Fucking Manual
    -   **Trade-off: Ask for help if stuck over 15 | 30 min.**
-   [How to Work](/life/principle/how-to-work.md): Working Standards
    -   请示工作说方案
    -   布置工作说标准
    -   汇报工作说结果
    -   总结工作说流程
    -   回顾工作说感受
-   [GTD Flow](/life/principle/gtd.md): Get Thing Done
-   [PDCA Cycle](/life/principle/pdca.md): Plan → Do → Check → Act or Adjust
-   [SMART principle](/life/principle/smart.md): Specific / Measurable / Achievable / Relevant / Time-based
-   [STAR principle](/life/principle/star.md): Situation → Target → Action → Result
-   [Deployment Checklist](/snip/tmp/deployment-checklist.md): avoid low-level mistakes
-   [How to Leave](/life/principle/how-to-leave.md):《解除劳动合同告知书》

### Read

> 写一部小说就像在黑夜里开车，你只能看到车灯照亮的部分，但是你却可以走完整个旅程。
>
> —— E.L. Doctorow

好文共赏

-   Bookmarks
    -   [Reading](/read/reading-bookmark.md)
    -   [Technology](/read/technology-bookmark.md)
-   [Cruel Reality](http://www.cracked.com/blog/6-harsh-truths-that-will-make-you-better-person/) - _[ZH ver.](http://mp.weixin.qq.com/s?__biz=MzA5MTM0NzIwNQ==&mid=2649760227&idx=2&sn=89fcbaf26cb56a21da2c4364fa3c9359)_ - _[digest](/read/cruel-reality.md)_
    -   Nice guy? I never give a shit.
-   [Life Meaning](https://www.zhihu.com/question/24561532/answer/28240920) - _[digest](/read/meaning.md)_
    -   因为活着，才去寻找意义。
-   [Happiness Course](https://zhuanlan.zhihu.com/p/19562678) - _[digest](/read/happiness-course.md)_
    -   如果你只有一个选择，它让你满意吗？
-   [Why Unhappy](https://zhuanlan.zhihu.com/p/19582894) - _[digest](/read/why-unhappy.md)_
    -   我，并不特别。
-   [Poet](https://zhuanlan.zhihu.com/p/19895904): 诗和远方 - _[digest](/read/poet.md)_
    -   眼前的苟且，也正是诗和远方。
-   [Teacher Said](https://www.zhihu.com/question/23721974/answer/25493813) - _[digest](/read/teacher-said.md)_
    -   我们用「我能做到什么」来判断和定位自己，而别人用「你已经做过什么」来判断和定位你。
    -   做正确的选择，而不是可以接受的选择。
-   Pessimist - _[digest](/read/pessimist.md)_
    -   It's the hardest part when memories remain.
-   [Anti-Fragile](/read/anti-fragile.md) - _[book](https://item.jd.com/11364406.html)_
    -   一只火鸡被屠夫喂养了 1000 天，每天都向其分析师证实，屠夫对火鸡的爱的「统计置信度与日俱增」。
-   [VicodinXYZ's Life Beliefs](/read/life-beliefs.md)
    -   决策的第一要务是给自己创造足够多的好选项。大多数决策失败来源于在几个都不够好的选择中反复纠结。
    -   **对于日常小决策，决策速度大于决策质量，不要拖**；对于重大而难逆转的大决策，要收集足够多信息尽量保证做对。
    -   **不是生活中的每一个问题都要解决，和问题共处是人生常态。把精力用在重要的事情上**。
-   [Sspai Time Management](/read/sspai-time-mgt.md)
    -   **更大的效率来自于重要事情上做得好，而不是在处处做得好，管理精力比管理时间更重要。**
    -   在考虑如何提高精力之前，我们得先解决导致精力被浪费的主要原因：**精力错位，也就是把最好的时间和状态，浪费在了低产出的任务上。**
    -   **「不做事」一定是最节省时间、最高效的做事方式**，学会「做重要的事」才是掌控时间的终极法门。
    -   提高自控力的一个小窍门是尽量避免在无谓的小事情上做决定。
    -   何谓「真正的休息」呢？不少人习惯将阅读网站和新闻当作一种休息，事实上研究表明，
        **认知活动（阅读文字、视频等）加重了工作需求产生消极情绪**，另一项研究则表明，
        **对于减少疲惫感，而且通过智能手机应用休息的效果差于与朋友或同事社交。**
-   [The Tyranny of Merit](/book/the-tyranny-of-merit.md)
    -   《“绩点”的暴政》
        成功者會認為他們的成功是靠自己的才能和努力，而與社會無關，既然成功是我自己的事，那失敗就是輸家自己的錯，這會製造出「才德的驕傲」（meritocratic hubris），對階梯下的人缺乏同理心，甚至不屑和輕蔑，因此更不會有對於共同體內同胞的相互責任。
-   [How to Be an Imperfectionist](/book/how-to-be-an-imperfectionist.md)
    -   The New Way to Self-Acceptance, Fearless Living, and Freedom from Perfectionism
    -   《如何成为不完美主义者》
        -   不那么在意问题本身，更在意在有问题存在的情况下能取得的进展。
        -   不那么在意行动正确与否，更在意是否在行动。
        -   不那么在意所谓时机，更在意任务本身。
    -   个人感受：很棒的书，解决了很多自己对于工作和生活的困惑以及心态问题；但说实话，不能应用到完美主义的职场中。
-   [The Complete Guide to Effective Reading](https://maartenvandoorn.medium.com/the-complete-guide-to-effective-reading-fc1835937757)
-   [Just-In-Case vs. Just-In-Time Learning](https://medium.com/hackernoon/just-in-case-vs-just-in-time-learning-c87f61d24360)

### Friend

> To be a better me.

<!--

> To be a better man.
>
> —— Better Man - _Robbie Williams song_

-->

-   **Jan Fan**:
    Pythonist / Tencent / Applied Mathematics PhD @ Sweden
-   **Johnson Zhang**:
    Sina Mobile / Didi / Meituan / … @ Beijing
-   [SF Zhou](http://sf-zhou.github.io/):
    ACMer / Microsoft / SenseTime / Weixin / High-Flyer Quant @Hangzhou
-   **Shiwey Yan**:
    Game Engine Developer / Tencent - Timi @ Shenzhen
-   [Toxic Johann](https://github.com/toxic-johann):
    Frontend / 360 / UC / Tencent / Tubi @ Beijing
-   [ME](/life/bio.md):
    Backend / Weibo / Alibaba / YFD / Silverhand / What's next? @ Beijing
-   …

---

<!-- ## Ending -->

> 靡不有初，鮮克有終。

<!-- > -->
<!-- > —— 《诗经·大雅·荡》 -->

<!--

> 埏埴以為器，當其無，有器之用。
>
> —— 老子《道德经·无之为用》

-->
