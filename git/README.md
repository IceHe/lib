# Git 常用操作

> Common Git Commands : 我的 Git 笔记，日常工作曾使用的指令组合。

Omit the unusual commands at my work.

- 笔者不时得用上但常忘记的指令
- 提要：`HEAD` 代表的是最近的一次提交

## References 参考

- Git SCM ( official site ) : http://git-scm.com/
- Git Book ( official guide ) : http://git-scm.com/book/en/v2 ( 细致全面 )
    - 中文版 : http://git-scm.com/book/zh/v2
- Git Reference ( official docs ) : http://git-scm.com/docs
- 猴子都能懂的 Git 入门 : http://backlogtool.com/git-guide/en/ ( 深入浅出 )
    - 中文版 : http://backlogtool.com/git-guide/cn/
- 闯过这 54 关，点亮你的 Git 技能树 : https://segmentfault.com/a/1190000004222489?utm_source=Weibo&utm_medium=shareLink&utm_campaign=socialShare
    - 实用主义, 在具体的工作场景下学习如何使用
- 廖学峰的官方网站 - Git 教程 : http://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000 ( 快速上手 )
- 30 天精通 Git 版本控管 : https://github.com/doggy8088/Learn-Git-in-30-days/ ( 深入理解 )
- GIT和SVN之间的五个基本区别 : http://www.oschina.net/news/12542/git-and-svn
    - 英文出处 : http://boxysystems.com/index.php/5-fundamental-differences-between-git-svn/

## Frequent 常用

凭印象简单罗列出以下个人常用命令，仅供参考

```bash
git config

    --global
    -e | --edit
    -l | --list

git init

git clone

git remote add NAME URL

git pull

    [<remote_name>:<branch_name>]

git fetch

    # fetch from all remotes
    --all
    # append to .git/FETCH_HEAD instead of overwriting
    -a | --append
    # force overwrite of local branch
    -f | --force
    # prune remote-tracking branches no longer on remote
    -p | --prune
    # fetch all tags & associated objects
    -t | --tags

git status

    -b | --branch
    -s | --short

git diff

    --cached
    --word-diff
    # compare to the past of the past
    HEAD^

git add
git rm
git mv

    -A | --all
    -f | --force
    -u | --updated

git commit

    -m <commit_msg>
    # add all
    -a
    # fix | append
    --amend
    --cached

git push

    # set upstream for git pull/status
    -u | --set-upstream

git stash

    pop
    list
    drop <stack_id>
    clear all

git branch

    # list all
    -a | --all
    # delete
    -d | --delete
    # force to delete
    -D

git checkout

    # switch to
    [<branch_name>]
    # back to the past
    [<path/to/file|dir>]
    # new branch
    -b <branch_name>

git log

    --decorate
    --graph
    --oneline
    --stat

git reflog

git show COMMIT_ID1 COMMIT_ID2 …

git reset

    --hard
    - [<commit_id>]

git clean

    -f | --force
    # remove whole directories
    -d

git cherry-pick COMMIT_ID1 COMMIT_ID2 …

git rebase

    -i | --interactive
    --continue
    --abort
```

## Check 检查

Commit 提交

- `git status -s` 查看仓库状态（以短格式）
- `git diff` 查看 working tree 与 index file 的差别
- `git diff --cached` 查看 index file 与 commit 的差别
- `git diff HEAD` 查看 working tree 和 commit 的差别
- `git log --oneline` 查看提交日志（以短格式）
- `git log -p -2` - `-p` 用来显示每次提交的内容差异；加上 `-2` 以便仅显示最近两次提交
- `git reflog` 最近的 Git 操作历史
- `git show <commit_id1> <commit_id2> …` 查看某些 commit 的变更内容

File 文件

- `git blame -C <file_path>` 查出错误代码的最后的编辑者
- `git blame -L -C [开始行数],[结束行数] <filename>`
    - 查看某文件每行代码的变更历史，包括 commit id，作者，时间，行号
- 加上 option `-C` Git 会分析正在标注的文件，并且尝试找出文件中从别的地方复制过来的代码片段的原始出处
- Git 不会显式地记录文件的重命名，而会记录快照，然后在事后尝试计算出重命名的动作
- 这其中有一个很有意思的特性就是你可以让 Git 找出所有的代码移动

Text 文本

- `git grep "search_text"` 在 Git 仓库中，查找代码片段

## Index 索引

- `git add <file_path>` 将需要提交的文件加入暂存区
- `git rm --cached <file_path>` 删除文件在 Git 中的索引，但保留原件！
    - `--cached` = `--staged`
- `git commit -m "commit_msg"` 提交修改，并添加描述
- `git commit -am "commit_msg"` 自动将被修改、删除的文件（不包括未加入索引的文件）加入暂存区，并提交

```git
git log --pretty="%H" --author="authorname" | while read commit_hash; do git show --oneline --name-only $commit_hash | tail -n+2; done | sort | uniq
```

- 列出某个作者所有修改过的文件 ( Reference : http://stackoverflow.com/questions/6349139/can-i-get-git-to-tell-me-all-the-files-one-user-has-modified )

## Back 反悔

### File 文件

- `git checkout <file_path>` 将已被修改的文件恢复到上一次提交的状态
- `git checkout <commit_id> <file_path>` 将已被修改的文件恢复到指定版本的状态
- `git reset` 取消所有文件的暂存状态（staged，即等待被 commit 的状态）
- `git reset HEAD <file_path>` 取消该文件的暂存状态
- `git reset <commit_id> <file_path>` 取消该文件的暂存状态，将其 HEAD 指针移到指定 commit_id 的版本

### Commit 提交

遗漏了部分需要提交的变更后，将其补充到上一个提交

- `git commit --amend` 上一次提交的内容有误，对其进行补充或更正

错误合并后，返回合并前的状态

- `git reset --hard ORIG_HEAD` 成功合并后反悔，回到合并前的状态
- `git reset --soft HEAD^` 取消上一次提交，但保留提交后的修改
- `git reset --hard HEAD^` 取消上一次提交，不保留提交后的修改

选取部分有用的变更，应用到另一分支上

- `git cherry-pick <commit_id1> <commit_id2> …` 将 ( 另一分支的 ) 某些 commit 的修改，应用到当前的分支来
- 当某个分支将要被删除，但其中某些 commit 的修改是有用的，于是将其单独取出来
    - `git cherry-pick <commit_id> -e` 提交前，需要重新编辑其提交说明
    - `git cherry-pick <commit_id> -n` 执行 cherry-pick 操作，只为套用该 commit 修改，但不会自动提交。以便在进行一些其它修改后，再一并提交

变更已经被提交到远端服务器后，回滚该变更：

- `git revert <commit_id1> <commit_id2> …` 撤销某些 commit 的修改 ( 以新建 commit 的方式 ). 一般在需要撤销的 commit 已经被 push 到远端服务器时, 需要这么做

不慎 revert 了某次 commit 后，又反悔了，想恢复原来的状态，取消刚才的操作：

```git
git reflog                 # 查看 revert 操作的前的 commit 的 id
git checkout <commit_id>   # 恢复到 revert 前的 commit 的状态。
```

## Branch 分支

- `git branch` 查看分支
- `git branch <branch_name>` 新建分支
- `git checkout -b <branch_name>` 新建分支，并切换到该分支
- `git checkout <branch_name>` 切换分支
- `git merge <branch_name>` 将另一分支 <branch_name> 导入到当前分支
- `git merge --squash <branch_name>` 把另一分支的所有提交合并成一个提交，并导入到当前分支
- `git fetch -p` 删除远程不存在的分支
- `git branch --merged | egrep -v "(^\*|master|dev)" | xargs git branch -d`
    删除所有已经合并到主干的本地分支 ( Ref : http://stackoverflow.com/questions/6127328/how-can-i-delete-all-git-branches-which-have-been-merged )
- 删除 master 之外的其它分支

```bash
$ git checkout master
$ git branch | sed 1d | xargs git branch -d
```

删除远程分支

```git
# 查看本地分支
git branch

# 查看全部分支 (包括远程分支)
git branch -a

# 本地删除
git branch -D <branch_name>
# e.g.
git branch -D backup

# 远程删除
git push origin --delete <branch_name>
# e.g.
git push origin --delete backup
```

## Config 配置

- `git config user.name "IceHe"` 设置用户名
- `git config user.email "icehe.me@qq.com"` 设置邮箱

认证方式

- 推荐：Git 配置 SSH Keys 或 GPG Keys，提交拉取代码免登录，既安全又方便
- 登录：记录账号密码
    - `git credential.helper osxkeychain` 长久储存密码，不用每次输入（macOS）
    - `git config credential.helper store` 长久储存密码，不用每次输入（非 macOS）
    - `git config --unset credential.helper` 密码更改后，重新设定

其它

- `git config --global pager.branch false` 将 `git branch` 的内容输出到 stdout

## Pull & Push

- `git pull faraway another:master`
    将远端 faraway 仓库的 another 分支，拉到本地 master 分支
- `git push faraway master:another`
    从本地的 master 分支，推送到远端的 faraway 的仓库的 another 分支
- _`git config http.postBuffer 524288000`
    当更新的内容较多时，Git 的缓存区可能不够用，可能导致 `git push` 失败，需用该指令增加缓存空间。_

## Rebase 变基

- `git rebase <branch_name>` 变基的操作可能会发生 “冲突” 等意外状况
- `git rebase --continue` 修复 “冲突” 等意外后，执行它以继续变基操作
- `git rebase --abort` 假如情况弄得一团糟，需要中途中止变基操作时，运行该指令

## Tag 标签

- `git tag -a <tag_name> -m "<tag_message>"` 创建标签
- `git push origin <tag_name>` 推送本地标签
- `git push origin --tags` 推送所有本地标签

## Aliases 别名

- My Zsh Aliases of Git : mac-conf/.config/zsh/git.zsh : https://github.com/IceHe/mac-conf/raw/master/.config/zsh/git.zsh
    - Based on oh-my-zsh plugin git : https://github.com/robbyrussell/oh-my-zsh/blob/master/plugins/git/git.plugin.zsh
