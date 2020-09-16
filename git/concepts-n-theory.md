# Concepts n Theory

Git 中的部分概念、指令的简要笔记。

## Commit ID

* Git 对象 id 是透过内容进行 SHA1 哈希后的结果，所以很长。
* 在 Git 标示 “绝对名称” 时，可以用前面几个字符代替，最少不可低于 4 个字符。
* 也就是说 4 ~ 40 个字符长度的 “绝对名称” 都是可以用的。

## Refname

“参照名称” 简单来说就是 Git 对象的一个 “指针”，用来指向特定 Git 对象，所以可以把 “参照名称” 想像成 Git 对象绝对名称的别名 （Alias），用来帮助记忆。

`HEAD` 代表最新版本，tag 标签名称，这些都是 “参照名称”，总之就是为了让你好记而已。

* 不过当你输入参照名称的 “简称” 时，预设 Git 会依照以下顺序搜寻适当的参照名称，
* 只要找到对应的文件，就会立刻回传该文件内容的“对象绝对名称”：
* `.git/<参照简称>`
* `.git/refs/<参照简称>`
* `.git/refs/tags/<参照简称;标签名称>`
* `.git/refs/heads/<参照简称;本地分支名称>`
* `.git/refs/remotes/<参照简称>`
* `.git/refs/remotes/<参照简称;远端分支名称>/HEAD`

Git 参照名称又有区分“一般参照”与“符号参照”，两者的用途一模一样，只在于内容不太一样。

“符号参照” 会指向另一个 “一般参照”，而 “一般参照” 则是指向一个 Git 物件的 “绝对名称”。

### Differ ^ and ~

相对名称表示法 ^ 与 ~ 的差异

* 关于 ~ 的意义，代表“第一个上层 commit 对象”的意思。
* 关于 ^ 代表的意思则是“拥有多个上层 commit 对象时，要代表第几个第一代的上层对象”。
* 如果有一个“参照名称”为 C，若要找到它的第一个上层 commit 对象，可以有以下表达方式：
  * `C^` , `C^1` , `C~` , `C~1`
* 如果要找到它的第二个上层 commit 对象（在没有合并的状况下），有以下表达方式：
  * `C^^` , `C^1^1` , `C~2` , `C~~` , `C~1~1`
* 但不能用 C^2 来表达“第二个上层 commit 物件”！
  * 原因是在没有合并的情况下，这个 C 只有一个上层对象而已，只能用 C^2 代表 “上一层对象的第二个上层对象”。

![Git Refname with ~ and ^](https://img.icehe.xyz/git%2Fgit_refname_relationship_00.jpg)

* 上述概念比较抽象，透过图解更清晰易懂。
* 如上图所示，想找到 C 这个 commit 对象的相对路径下的其它 commit 对象（上层对象），
  * 由于 C 这个 commit 对象有三个上层对象，这代表这个 commit 对象是透过合并而被建立的，
  * 那么要透过“相对名称”找到每一个路径，就必须搭配组合 ^ 与 ~ 的使用技巧，才能定位到每个想开启的版本。

## File Statuses

“索引” 的目的主要用来纪录 “有哪些文件即将要被提交到下一个 commit 版本中”。

换句话说，如果你想要提交一个版本到 Git 仓库，那么你一定要先更新索引状态，变更才会被提交出去。

* `Index` 索引
* `Cache` 缓存
* `Directory cache` 目录缓存
* `Current directory cache` 当前目录缓存
* `Staging area` 等待被 commit 的地方
* `Staged files` 等待被 commit 的文件

![Git File Statuses](https://img.icehe.xyz/git%2Fgit_file_status_00.jpg)

* `untracked` 未追踪的，代表尚未被加入 Git 仓库的文件状态
* `unmodified` 未修改的，代表文件第一次被加入，或是文件内容与 HEAD 内容一致的状态
* `modified` 已修改的，代表文件已经被修改过，或是文件内容与 HEAD 内容不一致的状态
* `staged` 等待被 commit 的，代表下次执行 git commit 会将这些文件全部送入仓库

## Objects

![Git Objects Relationship](https://img.icehe.xyz/git%2Fgit_objects_sample_00.jpg)

blob 对象

* 就是工作目录中某个文件的 "内容"，且只有内容而已，当你执行 git add 指令的同时，这些新增文件的内容就会立刻被写入成为 blob 对象，文件名则是对象内容的哈希运算结果，没有任何其它信息，像是文件时间、原本的文件名或文件的其它信息，都会储存在其它类型的对象里（也就是 tree 文件）。

tree 对象

* 这类文件会储存特定目录下的所有信息，包含该目录下的文件名、对应的 blob 对象名称、文件连结（symbolic link）或其他 tree 对象等等。由于 tree 对象可以包含其它 tree 物件，所以浏览 tree 对象的方式其实就跟文件系统中的“文件夹”没两样。简单来说，tree 对象这就是在特定版本下某个文件夹的快照（Snapshot）。

commit 对象

* 用来记录有那些 tree 对象包含在版本中，一个 commit 对象代表着 Git 的一次提交，记录着特定提交版本有哪些 tree 对象、以及版本提交的时间、纪录信息等等，通常还会记录上一层的 commit 对象名称只有第一次 commit 的版本没有上层 commit 对象名称。

tag 对象

* 是一个容器，通常用来关联特定一个 commit 对象（也可以关联到特定 blob、tree 对象），并额外储存一些额外的参考信息（metadata），例如: tag 名称。使用 tag 对象最常见的情况是替特定一个版本的 commit 对象标示一个易懂的名称，可能是代表某个特定发行的版本，或是拥有某个特殊意义的版本。）

## Cmd Prompt

* 命令行提示符中，位于路径后面的 Git 相关提示：`[master +10 ~0 -0 !]`
  * _PS:  具体显示效果根据命令行配置而不同。_
* 在这段提示的地方，可以看到几个东西：
  * `master` 代表目前工作目录是 master 分支，也是 Git 的预设分支名称。
  * “红色” 的数字都代表 Untracked（未追踪）的文件，也就是这些修改都不会进入版本库。
  * `+10` 代表有 10 个 “新增” 的文件。
  * `~0` 代表有 0 个 “修改” 的文件。
  * `-0` 代表有 0 个 “删除” 的文件。

## Reset Mode

除了默认的 mixed 模式，还有 soft 和 hard 模式。欲了解受各模式影响的部分，请参照下面的表格。

| 模式名称 | HEAD的位置 | 索引 | 工作树 |
| :--- | :--- | :--- | :--- |
| soft | 修改 | 不修改 | 不修改 |
| mixed | 修改 | 修改 | 不修改 |
| hard | 修改 | 修改 | 修改 |

* 只取消提交（soft）。
* 复原修改过的索引的状态（mixed）。
* 彻底取消最近的提交（hard）。

## credential.helper

* Git 拥有一个凭证系统来处理密码储存的事，避免用户总是需要重复输入密码。
  * `git config credential.helper <options>`
* Options as follow:
  * 默认所有都不缓存。 每一次连接都会询问你的用户名和密码。
  * `cache` 模式会将凭证存放在内存中一段时间。密码永远不会被存储在磁盘中，会在15分钟后从内存中清除。
  * `store` 模式会将凭证用明文的形式存放在磁盘中，并且永不过期。这意味着除非你修改了你在 Git 服务器上的密码，否则你永远不需要再次输入你的凭证信息。这种方式的缺点是你的密码是用明文的方式存放在你的 home 目录下。
  * `osxkeychain` 模式，需要你使用的是 Mac。它会将凭证缓存到你系统用户的钥匙串中。它将凭证存放在磁盘中，且永不过期，但会被加密，其加密方式与存放 HTTPS 凭证以及 Safari 的自动填写的方式是相同的。
  * 如果使用的是 Windows，可以安装一个叫做 “winstore” 的辅助工具。这和上面说的 “osxkeychain” 十分类似，但是是使用 Windows Credential Store 来控制敏感信息。可以在 [https://gitcredentialstore.codeplex.com](https://gitcredentialstore.codeplex.com) 下载。

## Rebase Example

![Git Merge Result](https://img.icehe.xyz/git%2Fgit_merge_result_00.png)

* 整合分支最容易的方法是 merge 命令。它会把两个分支的最新快照（C3 和 C4）以及二者最近的共同祖先（C2）进行三方合并，合并的结果是生成一个新的快照（并提交）。

![Git Rebase Result](https://img.icehe.xyz/git%2Fgit_rebase_result_00.png)

* “变基”（rebase）的方法：可以提取在 C4 中引入的补丁和修改，然后在 C3 的基础上再应用一次。
* 使用 rebase 命令将提交到某一分支上的所有修改都移至另一分支上，就好像“重新播放”一样。
* 上图的操作指令是:

  ```bash
    $ git checkout experiment
    $ git rebase master
  ```

* 原理是首先找到这两个分支（即当前分支 experiment、变基操作的目标基底分支 master）的最近共同祖先 C2，
  * 然后对比当前分支相对于该祖先的历次提交，提取相应的修改并存为临时文件，
  * 然后将当前分支指向目标基底 C3, 最后以此将之前另存为临时文件的修改依序应用。
* 现在回到 master 分支，进行一次快进合并，结果如下图。

  ```bash
    $ git checkout master
    $ git merge experiment
  ```

![Git Merge After Rebasing](https://img.icehe.xyz/git%2Fgit_merge_after_rebase_00.png)

* 此时，C4' 指向的快照就和上面使用 merge 命令的例子中 C5 指向的快照一模一样了。
  * 两种整合方法的最终结果没有任何区别，但是变基使得提交历史更加整洁。
* 在查看一个经过变基的分支的历史记录时会发现，尽管实际的开发工作是并行的，
  * 但它们看上去就像是先后串行的一样，提交历史是一条直线没有分叉。
* 一般这样做是为了确保在向远程分支推送时能保持提交历史的整洁，如向某个别人维护的项目贡献代码时。
* 在这种情况下，首先在自己的分支里进行开发，当开发完成时你需要先将你的代码变基到 origin/master 上，然后再向主项目提交修改。这样的话，该项目的维护者就不再需要进行整合工作，只需要快进合并便可。
* 请注意，无论是通过变基，还是通过三方合并，整合的最终结果所指向的快照始终是一样的，只不过提交历史不同罢了。
* 变基是将一系列提交按照原有次序依次应用到另一分支上，而合并是把最终结果合在一起。
* 总的原则是，只对尚未推送或分享给别人的本地修改执行变基操作清理历史，从不对已推送至别处的提交执行变基操作，这样，你才能享受到两种方式（变基VS合并）带来的便利。
* 更多的变基例子参考 [Git 分支 - 变基](http://git-scm.com/book/en/v2/Git-Branching-Rebasing)。

## Hook

[Hook](http://git-scm.com/book/zh/v2/%E8%87%AA%E5%AE%9A%E4%B9%89-Git-Git-%E9%92%A9%E5%AD%90)

* 钩子，暂略

