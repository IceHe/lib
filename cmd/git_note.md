title: Git 总结
date: 2016-02-15
updated: 2018-05-07
categories: [Git]
tags: [Git]
description: Git Note&#58; 我的 Git 笔记，日常工作曾使用的指令组合。
-----------------

- Omit the unusual commands at my work.

## References

- [Git SCM](http://git-scm.com/) —— Official Site
- [Git Book](http://git-scm.com/book/en/v2) - Official Guide 细致全面（[简体中文版](http://git-scm.com/book/zh/v2)）
- [Git Reference](http://git-scm.com/docs) - Official Docs
- [猴子都能懂的 Git 入门](http://backlogtool.com/git-guide/en/) - 深入浅出（[中文版](http://backlogtool.com/git-guide/cn/)）
- [闯过这 54 关，点亮你的 Git 技能树](https://segmentfault.com/a/1190000004222489?utm_source=Weibo&utm_medium=shareLink&utm_campaign=socialShare) - 实用主义。在具体的工作场景下学习如何使用
- [廖学峰的官方网站：Git 教程](http://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000) - 快速上手
- [30 天精通 Git 版本控管](https://github.com/doggy8088/Learn-Git-in-30-days/) - 深入理解
- [GIT和SVN之间的五个基本区别](http://www.oschina.net/news/12542/git-and-svn) - [英文出处](http://boxysystems.com/index.php/5-fundamental-differences-between-git-svn/)

## Memo

笔者不时得用上但常忘记的指令。
提要：`HEAD` 代表的是最近的一次提交（ [Refname](#Refname) ）。

### Frequent 频繁

凭印象简单罗列出以下个人常用命令，仅供参考。

`git status`
`git diff` : `--cached` , `HEAD^` compare to the past of the past , `--word-diff`
`git pull` : `[remote_name:branch_name]`
`git add` ( `git rm` , `git mv` ) : `-u` the updated , `-A` all
`git commit` : `--amend` fix | append , `-m` commit msg , `-a` add all
`git push`

`git stash` : `pop` , `list` , `drop [stack_id]` , `clear` all

`git log` : `--stat`
`git reflog`
`git reset` : `--hard` , `[commit_id]`
`git rebase` : `-i` , `--continue` , `--abort`

`git checkout` : `[branch_name]` switch to , `[path/to/file|dir]` back to the past , `-b [branch_name]` new branch
`git branch` : `-a` list all , `-d` delete | `-D` force to delete
`git cherry-pick [commit_id]`

`git remote add [name] [url]`
`git config` : `-e` edit , `--list`

### Check 检查

- Commit 提交
    - `git status -s` 查看仓库状态（以短格式）。
    - `git reflog` 最近的 Git 操作历史。
    - `git log --oneline` 查看提交日志（以短格式）。
    - `git log -p -2` - `-p` 用来显示每次提交的内容差异；加上 `-2` 以便仅显示最近两次提交。
    - \-\-\-
    - `git diff` 查看 working tree 与 index file 的差别。
    - `git diff --cached` 查看 index file 与 commit 的差别。
    - `git diff HEAD` 查看 working tree 和 commit 的差别。
- File 文件
    - `git blame -C <file_path>` 查出错误代码的最后的编辑者。
    - `git blame -L -C [开始行数],[结束行数] <filename>`
        查看某文件每行代码的变更历史，包括 commit id，作者，时间，行号。
    - \-\-\-
    - 加上 option `-C` Git 会分析正在标注的文件，并且尝试找出文件中从别的地方复制过来的代码片段的原始出处。
    - Git 不会显式地记录文件的重命名，而会记录快照，然后在事后尝试计算出重命名的动作。
    - 这其中有一个很有意思的特性就是你可以让 Git 找出所有的代码移动。
- Text 文本
    - `git grep "search_text"` 在 Git 仓库中，查找代码片段。

### Index 索引

- `git add <file_path>` 将需要提交的文件加入暂存区。
- \-\-\-
- `git rm --cached <file_path>` 删除文件在 Git 中的索引，但保留原件！
- `--staged` = `--cached`
- \-\-\-
- `git commit -m "commit_desc"` 提交修改，并添加描述。
- `git commit -am "commit_desc"` 自动将被修改、删除的文件（不包括未加入索引的文件）加入暂存区，并提交。
- \-\-\-
- `git log --pretty="%H" --author="authorname" | while read commit_hash; do git show --oneline --name-only $commit_hash | tail -n+2; done | sort | uniq`
    列出某个作者所有修改过的文件 ( [Ref](http://stackoverflow.com/questions/6349139/can-i-get-git-to-tell-me-all-the-files-one-user-has-modified) )。

### Back 反悔

- File 文件
    - `git checkout <file_path>` 将已被修改的文件恢复到上一次提交的状态。
    - `git checkout <commit_id> <file_path>` 将已被修改的文件恢复到指定版本的状态。
    - \-\-\-
    - `git reset` 取消所有文件的暂存状态（staged，即等待被 commit 的状态）。
    - `git reset HEAD <file_path>` 取消该文件的暂存状态。
    - `git reset <commit_id> <file_path>` 取消该文件的暂存状态，将其 HEAD 指针移到指定 commit_id 的版本。
- Commit 提交
    1. 遗漏了部分需要提交的变更后，将其补充到上一个提交：
        - `git commit --amend` 上一次提交的内容有误，对其进行补充或更正。
    2. 错误合并后，返回合并前的状态：
        - `git reset --hard ORIG_HEAD` 成功合并后反悔，回到合并前的状态。
        - `git reset --soft HEAD^` 取消上一次提交，但保留提交后的修改。
        - `git reset --hard HEAD^` 取消上一次提交，不保留提交后的修改。
            另一种方式：（未经笔者验证过）
            ``` sh
            $ git checkout <merge 操作时所在的分支>
            $ git reset --hard <merge 前的版本号（其 commit_id）>
            ```
    3. 选取部分有用的变更，应用到另一分支上：
        - `git cherry-pick <commit_id>` 将另一分支的某一个 commit 的修改，应用到当前的分支来。
        - 当某个分支将要被删除，但其中某些 commit 的修改是有用的，于是将其单独取出来。
            - `git cherry-pick <commit_id> -e` 提交前，需要重新编辑其提交说明。
            - `git cherry-pick <commit_id> -n` 执行 cherry-pick 操作，只为套用该 commit 修改，但不会自动提交。以便在进行一些其它修改后，再一并提交。
    4. 变更已经被提交到远端服务器后，回滚该变更：
        - `git revert commit_id` 撤销某个 commit 的修改（以新建一个提交的方式）。一般在需要撤销的 commit 已经被 push 到远端服务器时，需要这么做。
    5. 不慎 revert 了某次 commit 后，又反悔了，想恢复原来的状态，取消刚才的操作：
        ``` sh
        $ git reflog                  # 查看 revert 操作的前的 commit 的 id
        $ git checkout <commit_id>   # 恢复到 revert 前的 commit 的状态。
        ```

### Branch 分支

- `git branch` 查看分支。
- `git branch <branch_name>` 新建分支。
- \-\-\-
- `git checkout -b <branch_name>` 新建分支，并切换到该分支。
- `git checkout <branch_name>` 切换分支。
- \-\-\-
- _`git merge <branch_name>` 将另一分支 <branch_name> 导入到当前分支。_
- _`git merge --squash <branch_name>` 把另一分支的所有提交合并成一个提交，并导入到当前分支。_
- \-\-\-
- `git fetch -p` 删除远程不存在的分支。
- `git branch --merged | egrep -v "(^\*|master|dev)" | xargs git branch -d` 删除所有已经合并到主干的本地分支 ( [Ref](http://stackoverflow.com/questions/6127328/how-can-i-delete-all-git-branches-which-have-been-merged) )

### Config 配置

- `git config user.name "icehe"` 设置用户名。
- `git config user.email "x@icehe.me"` 设置邮箱。
- \-\-\-
- `git credential.helper osxkeychain` 长久储存密码，不用每次输入（macOS）。
- `git config credential.helper store` 长久储存密码，不用每次输入（非 macOS）。
- `git config --unset credential.helper` 密码更改后，重新设定。
- 最后，还是建议为 Git 配置 SSH Keys 或 GPG Keys，提交拉取代码免登录，既安全又方便。

### Pull & Push

- `git pull faraway another:master` 将远端 faraway 仓库的 another 分支，拉到本地 master 分支。
- `git push faraway master:another` 从本地的 master 分支，推送到远端的 faraway 的仓库的 another 分支。
- \-\-\-
- _`git config http.postBuffer 524288000` 当更新的内容较多时，Git 的缓存区可能不够用，可能导致 `git push` 失败，需用该指令增加缓存空间。_

### Rebase 变基

- `git rebase <branch_name>` 变基的操作可能会发生 “冲突” 等意外状况。
- `git rebase --continue` 修复 “冲突” 等意外后，执行它以继续变基操作。
- `git rebase --abort` 假如情况弄得一团糟，需要中途中止变基操作时，运行该指令。

### Tag 标签

- `git tag -a <tag_name> -m "<tag_message>"` 创建标签
- `git push origin <tag_name>` 推送本地标签
- `git push origin --tags` 推送所有本地标签

## Short Docs

### Abbreviations

- `abbr` abbreviation
- `addr` address
- `auto` automatically
- \-\-\-
- `cmd` command
- `config` configuration
- `cur` current
- \-\-\-
- `del` delete
- `desc` description
- `diff` difference
- `dir` directory
- `dirs` directories
- `docs` documentations
- \-\-\-
- `info` information
- `msg` message
- `mv` move
- `num` number
- \-\-\-
- `obj` object
- `opt` option
- `proj` project
- \-\-\-
- `repo` repository
- `rm` remove
- `var` variable

### Setup & Config

- [help](http://git-scm.com/docs/git-help)
    Display help info.
    - `--all` | `-a` All available cmds.
- [config](http://git-scm.com/docs/git-config)
    Get and set repo or global opts.
    - `git config name [value]`
    - \-\-\-
    - `--list` | `-l` List all config vars.
    - `--edit` | `-e` Modify config file.
    - `--unset` Rm matching key.
    - \-\-\-
    - `--local` Write opts to repo `.git/config` .
    - `--global` ... to global `~/.gitconfig`
    - `--system` ... to system-wide `$(prefix)/etc/gitconfig`

### Create & Get Proj

- [init](http://git-scm.com/docs/git-init)
    Create an empty Git repo or reinitialize an existing one.
    - `--bare` 创建裸仓库。裸仓库在 Git 服务器上，纯粹为了共享使用，没有 working dir，其目录一般以 .git 结尾。
- [clone](http://git-scm.com/docs/git-clone) `<repo> [<dir>]`
    Clone a repo into a new dir.
    - `--branch <branch_name>` | `-b <branch_name>`

### Snapshot

<!--- `HEAD` The latest version of cur branch. (Need improving)-->
- [add](http://git-scm.com/docs/git-add) `<pathspec>`
    Add file contents to the index.
    - `--all` | `-A`
    - `--update` | `-u` __Update the file modified in the working tree!__

- [status](http://git-scm.com/docs/git-status)
    Show the working tree status.
    - `--short` | `-s` Show in short-format.
- [diff](http://git-scm.com/docs/git-diff) `[options] [<commit>] [--] [<path>…]`
    Show changes between commits, commit and working tree, etc.
    - `--minimal` Spend extra time to make sure the smallest possible diff is produced.
    - `--patience` Generate a diff using the "patience diff" algorithm.
    - `--histogram` Generate a diff using the "histogram diff" algorithm.
- [commit](http://git-scm.com/docs/git-commit)
    Record changes to the repo.
    - `--all` | `-a` Auto stage files that have been modified and deleted, but not untracked ones.
    - `--message=<msg>` | `-m <msg>` Use given <msg> as the commit msg.
    - `--amend` Replace tip of cur branch by creating a new commit.
- [reset](http://git-scm.com/docs/git-reset) `[<mode>] [<commit>]`
    Reset cur HEAD to the specified state.
    Modes:
    - `--soft` Does not touch the index file or the working tree at all (but resets the head to &lt;commit&gt;).
    - `--mixed` Resets the index but not the working tree.
    - `--hard` Resets the index and working tree.
    - `--merge`, `--keep` ...
- [rm](http://git-scm.com/docs/git-rm) `<file> …`
    Remove files from the working tree and from the index.
    - `-r` Allow recursive removal.
    - `--cached` Remove paths only from the index.
- [mv](http://git-scm.com/docs/git-mv) `<source> <destination>`
    - Move or rename a file, dir or a symlink.

### Branch & Merge

- [branch](http://git-scm.com/docs/git-branch) `[<option>] <branch_name>`
    List, create, or del branches.
    - `--delete` | `-d`
    - `--force` | `-f`
    - `-D` Shortcut for `--delete --force`
    - \-\-\-
    - `--move` | `-m` Move / Rename.
    - `-M` Shortcut for `--move --force`
    - \-\-\-
    - `--all` | `-a`
- [checkout](http://git-scm.com/docs/git-checkout) `<commit>`
    Switch branches or restore working tree files.
    - `<commit>` can be a branch, a commit(id), a tag or a file path.
    - \-\-\-
    - `[-b|-B] <new_branch> [<start_point>]` Create a new branch.
    - `-B` ... , if the branch already exists, reset it to `<start_point>`
    - `<start_point>` The name of a commit at which to start the new branch. Defaults to HEAD.
    - \-\-\-
    - `git checkout [--] <file_path>` Dangerous! 撤销对工作区修改；这个命令是以最新的存储时间节点（add和commit）为参照，拷贝原来版本的文件覆盖工作区对应文件。除非确实不要那个文件中的修改了，否则不要使用这个命令！
- [merge](http://git-scm.com/docs/git-merge) `<commit>`
    Join two or more development histories together.
    - `<commit>` can be a branch name, a commit id or a tag id.
- [log](http://git-scm.com/docs/git-log) `[<options>] [<revision range>] [[--] <path>…]`
    Show Commit logs.
    - `-L <start>,<end>:<file>`
    - `<start>` & `<end>` can be line num, `/regex/` or `+offset | -offset` (line num) .
    - `-L :<funcname>:<file>`
    - `[--] <path>…` Show commits related to specified paths in brief.
    - \-\-\-
    - `-p` Show diff between each commits.
    - `--stat` Generate a diffstat.
    - `--name-status` Show only names and status of changed files.
    - `--abbrev-commit` show only a partial prefix of the full 40-byte hexadecimal object name.
    - `--graph` Draw a text-based graphical representation of the commit history on the left hand side of the output.
- [stash](http://git-scm.com/docs/git-stash)
    Stash the changes in a dirty working dir away.
    - `git stash` = `git stash save`
    - \-\-\-
    - `list` List stashes you have.
    - `show [<stash>]` Show the changes recorded in specific stash.
    - `pop [<stash>]` Rm a single stashed state from the stash list and apply it on top of the cur working tree state.
    - \-\-\-
    - `<stash>` e.g. `stash@{<revision>}ster +10 ~0 -0 !`
    - 在这段提示的地方，你可以看到几个东西：
        master 代表目前工作目录是 master 分支，也是 Git 的预设分支名称。
        “红色”的数字都代表 Untracked (未追踪)
- [tag](http://git-scm.com/docs/git-tag) `[-f] [-m <msg>] <tag_name> [<commit> | <object>]`
    Create, list, del or verify a tag obj signed with GPG
    - `--annotated` | `-a` Annotated tag, needs a message（创建 tag）
    - `--force` | `-f` Replace an existing tag with the given name (instead of failing).
    - `--message=<msg>` | `-m <msg>` Use the given tag msg (instead of prompting).
    Add a tag reference in refs/tags/, unless `-d` and `-l` (to del or list tags).
- [mergetool](http://git-scm.com/docs/git-mergetool) ...

### Share & Update

- [fetch](http://git-scm.com/docs/git-fetch) `[<options>] [<repo>]`
    Download objs and refs from another repo.
    - `--all` Fetch all remotes.
    - `--prune` | `-p` Before fetching, __remove any remote-tracking references that no longer exist on the remote__.
- [pull](http://git-scm.com/docs/git-pull) `[<options>] [<repo>]`
    Fetch from and integrate with another repo or a local branch.
    In its default mode, `git pull` is shorthand for `git fetch` followed by `git merge FETCH_HEAD`.
- [push](http://git-scm.com/docs/git-push) `[<repo>]`
    Update remote refs along with associated objs.
    - `--all` Push all branches.
- [remote](http://git-scm.com/docs/git-remote)
    Manage set of tracked repos.
    - `add [-t <branch>] <name> <url>`
    - `rename <old> <new>`
    - `remove <name>` | `rm <name>`
    - `show`, `set-url` ...
- [submodule](http://git-scm.com/docs/git-submodule)
    Initialize, update or inspect submodules.

### Inspect & Compare

- [show](http://git-scm.com/docs/git-show)
    Show various types of objs.
- [shortlog](http://git-scm.com/docs/git-shortlog) `[<options>] [<revision range>] [[\--] <path>…]`
    Summarize git log output.
    - `--summary` | `-s` Suppress commit desc and provide a commit count summary only.
    - `--email` | `-e` Show the email addr of each author.
- [log](http://git-scm.com/docs/git-log), [diff](http://git-scm.com/docs/git-diff) &nbsp; *See above.*
- [describe](http://git-scm.com/docs/git-describe) ...

### Patch

- [revert](http://git-scm.com/docs/git-revert) `<commit>…`
    Revert some existing commits.
    - `git revert --continue` Continue the operation in progress using the info `.git/sequencer`. Can be used to continue after resolving conflicts in a failed cherry-pick or revert.
    - `git revert --quit` Clear the sequencer state after a failed cherry-pick or revert.
    - `git revert --abort` Cancel the operation and return to the pre-sequence state.
- [rebase](http://git-scm.com/docs/git-rebase) `[<upstream> [<branch>]]`
    Forward-port local commits to the updated upstream head.
    - `<upstream>` Upstream branch to compare against. May be any valid commit, not just an existing branch name. Defaults to the configured upstream for the cur
    - `<branch>` Working branch; defaults to HEAD.
    - `--interactive` | `-i` Make a list of the commits which are about to be rebased. Let the user edit that list before rebasing.
    - \-\-\-
    - `git rebase --continue` Restart the rebasing process after having resolved a merge conflict.
    - `git rebase --abort` Abort the rebase operation and reset HEAD to the original branch.
- [cherry-pick](http://git-scm.com/docs/git-cherry-pick) `<commit>…`
    Apply the changes introduced by some existing commits.
    - `-edit` | `-e` Edit the commit msg prior to committing.
    - `--no-commit` | `-n` Apply the changes without making any commit.
    - \-\-\-
    - `git cherry-pick --continue` Continue the operation in progress using the info in `.git/sequencer`. Can be used to continue after resolving conflicts in a failed cherry-pick or revert.
    - `git cherry-pick --quit` Forget about the cur operation in progress. Can be used to clear the sequencer state after a failed cherry-pick or revert.
    - `git cherry-pick --abort` Cancel the operation and return to the pre-sequence state.
- [diff](http://git-scm.com/docs/git-diff) &nbsp; *See above.*
- [apply](http://git-scm.com/docs/git-apply) ...

### Debug

- [bisect](http://git-scm.com/docs/git-bisect) `<subcommand> <options>`
    Use binary search to find the commit that introduced a bug.
    Subcommands: `start`, `good`, `bad`, `reset` ...
- [blame](http://git-scm.com/docs/git-blame) `<file>`
    Show what revision and author last modified each line of a file.
    - `-b` Show blank SHA-1 for boundary commits. This can also be controlled via the `blame.blankboundary` config opt.
    - `-l` Show long rev (Default: off).
    - `-t` Show raw timestamp (Default: off).
    - \-\-\-
    - `-L <start>,<end>` `-L :<funcname>` Annotate only the given line range. May be specified multiple times. Overlapping ranges are allowed.
    - `<start>` and `<end>` are optional. `-L <start>` or `-L <start>,` spans from `<start>` to end of file. `-L ,<end>` spans from start of file to `<end>`.
    - \-\-\-
    `-M` Detect moved or copied lines within a file.
    `-C` In addition to -M, detect lines moved or copied from other files that were modified in the same commit.
- [grep](http://git-scm.com/docs/git-grep) `<pattern>`
    Print lines matching a pattern.
    - `--cached` Instead of searching tracked files in the working tree, search blobs registered in the index file.
    - `--no-index` Search files in the current directory that is not managed by Git.
    - `--untracked` In addition to searching in the tracked files in the working tree, search also in untracked files.
    - \-\-\-
    - `--fixed-strings` | `-F` Use fixed strings for patterns (don't interpret pattern as a regex).
    - `--ignore-case` | `-i` Ignore case diff between the patterns and the files.
    - `--line-number` | `-n` Prefix the line num to matching lines.

### Administration

- [reflog](http://git-scm.com/docs/git-reflog)
    Manage reflog info.
    - `--all` Process the reflogs of all references.
- [clean](http://git-scm.com/docs/git-clean), [gc](http://git-scm.com/docs/git-gc), [fsck](http://git-scm.com/docs/git-fsck), [filter-branch](http://git-scm.com/docs/git-filter-branch), [instaweb](http://git-scm.com/docs/git-instaweb), [archive](http://git-scm.com/docs/git-archive), [bundle](http://git-scm.com/docs/git-bundle) ...

### Email

- [am](http://git-scm.com/docs/git-am), [apply](http://git-scm.com/docs/git-apply), [format-patch](http://git-scm.com/docs/git-format-patch), [send-email](http://git-scm.com/docs/git-send-email), [request-pull](http://git-scm.com/docs/git-request-pull) ...

### External Systems

- [svn](http://git-scm.com/docs/git-svn), [fast-import](http://git-scm.com/docs/git-fast-import) ...

### Server Admin

- [daemon](http://git-scm.com/docs/git-daemon), [update-server-info](http://git-scm.com/docs/git-update-server-info) ...

### Plumbing Cmds

- [ls-files](http://git-scm.com/docs/git-ls-files)
    Show info about files in the index and the working tree.
    - `--cached` | `-c` Show cached files in the output (default).
    - `--delete` | `-d` ... deleted ...
    - `--modified` | `-m` ... modified ...
    - `--others` | `-o` ... others ...
    - `--ignored` | `-i` ... ignored ...
    - `--stage` | `-i` ... stage ...
    - `--unmerged` | `-u` ... unmerged ...
- [cat-file](http://git-scm.com/docs/git-cat-file), [commit-tree](http://git-scm.com/docs/git-commit-tree), [count-objects](http://git-scm.com/docs/git-count-objects), [diff-index](http://git-scm.com/docs/git-diff-index), [for-each-ref](http://git-scm.com/docs/git-for-each-ref), [hash-object](http://git-scm.com/docs/git-hash-object), [merge-base](http://git-scm.com/docs/git-merge-base), [read-tree](http://git-scm.com/docs/git-read-tree), [rev-list](http://git-scm.com/docs/git-rev-list), [rev-parse](http://git-scm.com/docs/git-rev-parse), [show-ref](http://git-scm.com/docs/git-show-ref), [symbolic-ref](http://git-scm.com/docs/git-symbolic-ref), [update-index](http://git-scm.com/docs/git-update-index), [update-ref](http://git-scm.com/docs/git-update-ref), [verify-pack](http://git-scm.com/docs/git-verify-pack), [write-tree](http://git-scm.com/docs/git-write-tree) ...

### [.gitignore](https://git-scm.com/docs/gitignore)

- A file specifies intentionally untracked files that Git should ignore. Files already tracked are not affected.
- Gitignore **patterns** from multiple **sources**, with the following order of precedence, from highest to lowest:
    - From cmd line.
    - File `.gitignore` specifies files all developers will want to ignore
    - File `$GIT_DIR/info/exclude` specifies files that are just useful to a particular repo
    e.g., auxiliary files are specific to one user’s workflow.
    - The file specified by config var `core.excludesFile` in the user’s file `~/.gitconfig`.
    For ignoring some files in all situations. e.g., backup or temporary files generated by editors.
- **Pattern Format**
    - A line starting with `#` serves as a **comment**.
    - An optional prefix `!` which **negates** the pattern.
    - A pattern which ends with a slash `/` will only find a match with a dir e.g. `foo/` will match a dir foo and paths underneath it.
    - A leading slash `/` matches the beginning of the pathname. For example, `/*.c` matches "cat-file.c" but not "mozilla-sha1/sha1.c".
    - `*` asterisk wildcard (通配符).
    - ...

## Concepts

- Git 中的部分概念、指令的简要笔记。

### **Commit ID**

- Git 对象 id 是透过内容进行 SHA1 哈希后的结果，所以很长。
- 在 Git 标示 “绝对名称” 时，可以用前面几个字符代替，最少不可低于 4 个字符。
- 也就是说 4 ~ 40 个字符长度的 “绝对名称” 都是可以用的。

### **Refname**

- “参照名称” 简单来说就是 Git 对象的一个 “指针”，用来指向特定 Git 对象，所以可以把 “参照名称” 想像成 Git 对象绝对名称的别名 （Alias），用来帮助记忆。
- `HEAD` 代表最新版本，tag 标签名称，这些都是 “参照名称”，总之就是为了让你好记而已。
    不过当你输入参照名称的 “简称” 时，预设 Git 会依照以下顺序搜寻适当的参照名称，
    只要找到对应的文件，就会立刻回传该文件内容的“对象绝对名称”：
    - `.git/<参照简称>`
    - `.git/refs/<参照简称>`
    - `.git/refs/tags/<参照简称;标签名称>`
    - `.git/refs/heads/<参照简称;本地分支名称>`
    - `.git/refs/remotes/<参照简称>`
    - `.git/refs/remotes/<参照简称;远端分支名称>/HEAD`
- Git 参照名称又有区分“一般参照”与“符号参照”，两者的用途一模一样，只在于内容不太一样。
- “符号参照” 会指向另一个 “一般参照”，而 “一般参照” 则是指向一个 Git 物件的 “绝对名称”。

#### Differ ^ and ~

**相对名称表示法 ^ 与 ~ 的差异**
- 关于 ~ 的意义，代表“第一个上层 commit 对象”的意思。
- 关于 ^ 代表的意思则是“拥有多个上层 commit 对象时，要代表第几个第一代的上层对象”。
- 如果有一个“参照名称”为 C，若要找到它的第一个上层 commit 对象，可以有以下表达方式：
    `C^` , `C^1` , `C~` , `C~1`
- 如果要找到它的第二个上层 commit 对象（在没有合并的状况下），有以下表达方式：
    `C^^` , `C^1^1` , `C~2` , `C~~` , `C~1~1`
- 但不能用 C^2 来表达“第二个上层 commit 物件”！
    原因是在没有合并的情况下，这个 C 只有一个上层对象而已，只能用 C^2 代表 “上一层对象的第二个上层对象”。

![Git Refname with ~ and ^](http://7vzp68.com1.z0.glb.clouddn.com/git%2Fgit_refname_relationship_00.jpg)

- 上述概念比较抽象，透过图解更清晰易懂。
- 如上图所示，想找到 C 这个 commit 对象的相对路径下的其它 commit 对象（上层对象），
    由于 C 这个 commit 对象有三个上层对象，这代表这个 commit 对象是透过合并而被建立的，
    那么要透过“相对名称”找到每一个路径，就必须搭配组合 ^ 与 ~ 的使用技巧，才能定位到每个想开启的版本。

### **File Statuses**

- “索引” 的目的主要用来纪录 “有哪些文件即将要被提交到下一个 commit 版本中”。
- 换句话说，如果你想要提交一个版本到 Git 仓库，那么你一定要先更新索引状态，变更才会被提交出去。
    `Index` 索引
    `Cache` 缓存
    `Directory cache` 目录缓存
    `Current directory cache` 当前目录缓存
    `Staging area` 等待被 commit 的地方
    `Staged files` 等待被 commit 的文件

![Git File Statuses](http://7vzp68.com1.z0.glb.clouddn.com/git%2Fgit_file_status_00.jpg)

`untracked` 未追踪的，代表尚未被加入 Git 仓库的文件状态
`unmodified` 未修改的，代表文件第一次被加入，或是文件内容与 HEAD 内容一致的状态
`modified` 已修改的，代表文件已经被修改过，或是文件内容与 HEAD 内容不一致的状态
`staged` 等待被 commit 的，代表下次执行 git commit 会将这些文件全部送入仓库

### **Objects**

![Git Objects Relationship](http://7vzp68.com1.z0.glb.clouddn.com/git%2Fgit_objects_sample_00.jpg)

- **blob 对象**
    就是工作目录中某个文件的 "内容"，且只有内容而已，当你执行 git add 指令的同时，这些新增文件的内容就会立刻被写入成为 blob 对象，文件名则是对象内容的哈希运算结果，没有任何其它信息，像是文件时间、原本的文件名或文件的其它信息，都会储存在其它类型的对象里（也就是 tree 文件）。
- **tree 对象**
    这类文件会储存特定目录下的所有信息，包含该目录下的文件名、对应的 blob 对象名称、文件连结（symbolic link）或其他 tree 对象等等。由于 tree 对象可以包含其它 tree 物件，所以浏览 tree 对象的方式其实就跟文件系统中的“文件夹”没两样。简单来说，tree 对象这就是在特定版本下某个文件夹的快照（Snapshot）。
- **commit 对象**
    用来记录有那些 tree 对象包含在版本中，一个 commit 对象代表着 Git 的一次提交，记录着特定提交版本有哪些 tree 对象、以及版本提交的时间、纪录信息等等，通常还会记录上一层的 commit 对象名称只有第一次 commit 的版本没有上层 commit 对象名称。
- **tag 对象**
    是一个容器，通常用来关联特定一个 commit 对象（也可以关联到特定 blob、tree 对象），并额外储存一些额外的参考信息（metadata），例如: tag 名称。使用 tag 对象最常见的情况是替特定一个版本的 commit 对象标示一个易懂的名称，可能是代表某个特定发行的版本，或是拥有某个特殊意义的版本。）
### **Cmd Prompt**
- 命令行提示符中，位于路径后面的 Git 相关提示：`[master +10 ~0 -0 !]`
    *PS:  具体显示效果根据命令行配置而不同。*
- 在这段提示的地方，可以看到几个东西：
    - `master` 代表目前工作目录是 master 分支，也是 Git 的预设分支名称。
    - “红色” 的数字都代表 Untracked（未追踪）的文件，也就是这些修改都不会进入版本库。
    - `+10` 代表有 10 个 “新增” 的文件。
    - `~0` 代表有 0 个 “修改” 的文件。
    - `-0` 代表有 0 个 “删除” 的文件。

### **Reset Mode**

除了默认的 mixed 模式，还有 soft 和 hard 模式。欲了解受各模式影响的部分，请参照下面的表格。

| 模式名称 | HEAD的位置 | 索引   | 工作树 |
| -----    | -------    | ----   | ----   |
| soft     | 修改       | 不修改 | 不修改 |
| mixed    | 修改       | 修改   | 不修改 |
| hard     | 修改       | 修改   | 修改   |

- 只取消提交（soft）。
- 复原修改过的索引的状态（mixed）。
- 彻底取消最近的提交（hard）。

### **credential.helper**

- Git 拥有一个凭证系统来处理密码储存的事，避免用户总是需要重复输入密码。
    - `git config credential.helper <options>`
- Options as follow:
    - 默认所有都不缓存。 每一次连接都会询问你的用户名和密码。
    - `cache` 模式会将凭证存放在内存中一段时间。密码永远不会被存储在磁盘中，会在15分钟后从内存中清除。
    - `store` 模式会将凭证用明文的形式存放在磁盘中，并且永不过期。这意味着除非你修改了你在 Git 服务器上的密码，否则你永远不需要再次输入你的凭证信息。这种方式的缺点是你的密码是用明文的方式存放在你的 home 目录下。
    - `osxkeychain` 模式，需要你使用的是 Mac。它会将凭证缓存到你系统用户的钥匙串中。它将凭证存放在磁盘中，且永不过期，但会被加密，其加密方式与存放 HTTPS 凭证以及 Safari 的自动填写的方式是相同的。
    - 如果使用的是 Windows，可以安装一个叫做 “winstore” 的辅助工具。这和上面说的 “osxkeychain” 十分类似，但是是使用 Windows Credential Store 来控制敏感信息。可以在 https://gitcredentialstore.codeplex.com 下载。

### **Rebase Example**

![Git Merge Result](http://7vzp68.com1.z0.glb.clouddn.com/git%2Fgit_merge_result_00.png)

- 整合分支最容易的方法是 merge 命令。它会把两个分支的最新快照（C3 和 C4）以及二者最近的共同祖先（C2）进行三方合并，合并的结果是生成一个新的快照（并提交）。

![Git Rebase Result](http://7vzp68.com1.z0.glb.clouddn.com/git%2Fgit_rebase_result_00.png)

- “变基”（rebase）的方法：可以提取在 C4 中引入的补丁和修改，然后在 C3 的基础上再应用一次。
- 使用 rebase 命令将提交到某一分支上的所有修改都移至另一分支上，就好像“重新播放”一样。
- 上图的操作指令是:
    ``` sh
    $ git checkout experiment
    $ git rebase master
    ```
- 原理是首先找到这两个分支（即当前分支 experiment、变基操作的目标基底分支 master）的最近共同祖先 C2，
    然后对比当前分支相对于该祖先的历次提交，提取相应的修改并存为临时文件，
    然后将当前分支指向目标基底 C3, 最后以此将之前另存为临时文件的修改依序应用。
- 现在回到 master 分支，进行一次快进合并，结果如下图。
    ``` sh
    $ git checkout master
    $ git merge experiment
    ```

![Git Merge After Rebasing](http://7vzp68.com1.z0.glb.clouddn.com/git%2Fgit_merge_after_rebase_00.png)

- 此时，C4' 指向的快照就和上面使用 merge 命令的例子中 C5 指向的快照一模一样了。
    两种整合方法的最终结果没有任何区别，但是变基使得提交历史更加整洁。
- 在查看一个经过变基的分支的历史记录时会发现，尽管实际的开发工作是并行的，
    但它们看上去就像是先后串行的一样，提交历史是一条直线没有分叉。
- \-\-\-
- 一般这样做是为了确保在向远程分支推送时能保持提交历史的整洁，如向某个别人维护的项目贡献代码时。
- 在这种情况下，首先在自己的分支里进行开发，当开发完成时你需要先将你的代码变基到 origin/master 上，然后再向主项目提交修改。这样的话，该项目的维护者就不再需要进行整合工作，只需要快进合并便可。
- \-\-\-
- 请注意，无论是通过变基，还是通过三方合并，整合的最终结果所指向的快照始终是一样的，只不过提交历史不同罢了。
- 变基是将一系列提交按照原有次序依次应用到另一分支上，而合并是把最终结果合在一起。
- \-\-\-
- 总的原则是，只对尚未推送或分享给别人的本地修改执行变基操作清理历史，从不对已推送至别处的提交执行变基操作，这样，你才能享受到两种方式（变基VS合并）带来的便利。
- 更多的变基例子参考 [Git 分支 - 变基](http://git-scm.com/book/en/v2/Git-Branching-Rebasing)。

### [**Hook**](http://git-scm.com/book/zh/v2/%E8%87%AA%E5%AE%9A%E4%B9%89-Git-Git-%E9%92%A9%E5%AD%90)

- 钩子，暂略。

## [**Zsh Aliases**](https://github.com/IceHe/oh-my-zsh/blob/master/plugins/git/git.plugin.zsh)

- All details : <https://github.com/IceHe/oh-my-zsh/blob/master/plugins/git/git.plugin.zsh>

```sh
alias g='git'

alias ga='git add'
alias gaa='git add --all'

alias gb='git branch'
alias gba='git branch -a'

alias gbl='git blame -b -w'

alias gc='git commit -v'
alias gc!='git commit -v --amend'
alias gca!='git commit -v -a --amend'
alias gcm='git commit -m'
alias gcam='git commit -a -m'

alias gcf='git config'
alias gcfl='git config -l'
alias gce='git config -e'

alias gcl='git clone --recursive'

alias gco='git checkout'
alias gcom'git checkout master'
alias gcb='git checkout -b'

alias gcp='git cherry-pick'

alias gd='git diff'
alias gdc='git diff --cached'
alias gdw='git diff --word-diff'

alias gg='git gui citool'
alias gga='git gui citool --amend'

alias ggr='git grep'

alias gk='\gitk --all --branches'
alias gke='\gitk --all $(git log -g --pretty=format:%h)'

alias gl='git pull'

alias glog='git log --oneline --decorate --graph'

alias gp='git push'

alias grm='git remote'
alias grma='git remote add'

alias gr='git reset HEAD'
alias grh='git reset HEAD --hard'

alias grb='git rebase'
alias grba='git rebase --abort'
alias grbc='git rebase --continue'
alias grbi='git rebase -i'

alias gs='git status -sb'

alias gst='git stash'
alias gsd='git stash drop'
alias gsl='git stash list'
alias gsp='git stash pop'
```
