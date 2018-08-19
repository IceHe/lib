## Docs Abstract

### Abbreviations

- `abbr` abbreviation
- `addr` address
- `auto` automatically
- `cmd` command
- `config` configuration
- `cur` current
- `del` delete
- `desc` description
- `diff` difference
- `dir` directory
- `dirs` directories
- `docs` documentations
- `info` information
- `msg` message
- `mv` move
- `num` number
- `obj` object
- `opt` option
- `proj` project
- `repo` repository
- `rm` remove
- `var` variable

### Setup & Config

[help](http://git-scm.com/docs/git-help)

- Display help info.
- `--all` | `-a` All available cmds.

[config](http://git-scm.com/docs/git-config)

- Get and set repo or global opts.
- `git config name [value]`
- `--list` | `-l` List all config vars.
- `--edit` | `-e` Modify config file.
- `--unset` Rm matching key.
- `--local` Write opts to repo `.git/config` .
- `--global` ... to global `~/.gitconfig`
- `--system` ... to system-wide `$(prefix)/etc/gitconfig`

### Create & Get Proj

[init](http://git-scm.com/docs/git-init)

- Create an empty Git repo or reinitialize an existing one.
- `--bare` 创建裸仓库。裸仓库在 Git 服务器上，纯粹为了共享使用，没有 working dir，其目录一般以 .git 结尾。

[clone](http://git-scm.com/docs/git-clone) `<repo> [<dir>]`

- Clone a repo into a new dir.
- `--branch <branch_name>` | `-b <branch_name>`

### Snapshot

<!--- `HEAD` The latest version of cur branch. (Need improving)-->

[add](http://git-scm.com/docs/git-add) `<pathspec>`

- Add file contents to the index.
- `--all` | `-A`
- `--update` | `-u` __Update the file modified in the working tree!__

[status](http://git-scm.com/docs/git-status)

- Show the working tree status.
- `--short` | `-s` Show in short-format.

[diff](http://git-scm.com/docs/git-diff) `[options] [<commit>] [--] [<path>…]`

- Show changes between commits, commit and working tree, etc.
- `--minimal` Spend extra time to make sure the smallest possible diff is produced.
- `--patience` Generate a diff using the "patience diff" algorithm.
- `--histogram` Generate a diff using the "histogram diff" algorithm.

[commit](http://git-scm.com/docs/git-commit)

- Record changes to the repo.
- `--all` | `-a` Auto stage files that have been modified and deleted, but not untracked ones.
- `--message=<msg>` | `-m <msg>` Use given <msg> as the commit msg.
- `--amend` Replace tip of cur branch by creating a new commit.

[reset](http://git-scm.com/docs/git-reset) `[<mode>] [<commit>]`

- Reset cur HEAD to the specified state. Modes:
- `--soft` Does not touch the index file or the working tree at all (but resets the head to &lt;commit&gt;).
- `--mixed` Resets the index but not the working tree.
- `--hard` Resets the index and working tree.
- `--merge`, `--keep` ...

[rm](http://git-scm.com/docs/git-rm) `<file> …`

- Remove files from the working tree and from the index.
- `-r` Allow recursive removal.
- `--cached` Remove paths only from the index.

[mv](http://git-scm.com/docs/git-mv) `<source> <destination>`

- Move or rename a file, dir or a symlink.

### Branch & Merge

[branch](http://git-scm.com/docs/git-branch) `[<option>] <branch_name>`

- List, create, or del branches.
- `--delete` | `-d`
- `--force` | `-f`
- `-D` Shortcut for `--delete --force`
- `--move` | `-m` Move / Rename.
- `-M` Shortcut for `--move --force`
- `--all` | `-a`

[checkout](http://git-scm.com/docs/git-checkout) `<commit>`

- Switch branches or restore working tree files.
- `<commit>` can be a branch, a commit(id), a tag or a file path.
- `[-b|-B] <new_branch> [<start_point>]` Create a new branch.
- `-B` ... , if the branch already exists, reset it to `<start_point>`
- `<start_point>` The name of a commit at which to start the new branch. Defaults to HEAD.
- `git checkout [--] <file_path>` Dangerous! 撤销对工作区修改；这个命令是以最新的存储时间节点（add和commit）为参照，拷贝原来版本的文件覆盖工作区对应文件。除非确实不要那个文件中的修改了，否则不要使用这个命令！

[merge](http://git-scm.com/docs/git-merge) `<commit>`

- Join two or more development histories together.
- `<commit>` can be a branch name, a commit id or a tag id.

[log](http://git-scm.com/docs/git-log) `[<options>] [<revision range>] [[--] <path>…]`

- Show Commit logs.
- `-L <start>,<end>:<file>`
- `<start>` & `<end>` can be line num, `/regex/` or `+offset | -offset` (line num) .
- `-L :<funcname>:<file>`
- `[--] <path>…` Show commits related to specified paths in brief.
- `-p` Show diff between each commits.
- `--stat` Generate a diffstat.
- `--name-status` Show only names and status of changed files.
- `--abbrev-commit` show only a partial prefix of the full 40-byte hexadecimal object name.
- `--graph` Draw a text-based graphical representation of the commit history on the left hand side of the output.

[stash](http://git-scm.com/docs/git-stash)

- Stash the changes in a dirty working dir away.
- `git stash` = `git stash save`
- `list` List stashes you have.
- `show [<stash>]` Show the changes recorded in specific stash.
- `pop [<stash>]` Rm a single stashed state from the stash list and apply it on top of the cur working tree state.
- `<stash>` e.g. `stash@{<revision>}ster +10 ~0 -0 !`
- 在这段提示的地方，你可以看到几个东西：
    - master 代表目前工作目录是 master 分支，也是 Git 的预设分支名称。
    - “红色”的数字都代表 Untracked (未追踪)

[tag](http://git-scm.com/docs/git-tag) `[-f] [-m <msg>] <tag_name> [<commit> | <object>]`

- Create, list, del or verify a tag obj signed with GPG
- `--annotated` | `-a` Annotated tag, needs a message（创建 tag）
- `--force` | `-f` Replace an existing tag with the given name (instead of failing).
- `--message=<msg>` | `-m <msg>` Use the given tag msg (instead of prompting).
- Add a tag reference in refs/tags/, unless `-d` and `-l` (to del or list tags).

[mergetool](http://git-scm.com/docs/git-mergetool) ...

### Share & Update

[fetch](http://git-scm.com/docs/git-fetch) `[<options>] [<repo>]`

- Download objs and refs from another repo.
- `--all` Fetch all remotes.
- `--prune` | `-p` Before fetching, __remove any remote-tracking references that no longer exist on the remote__.

[pull](http://git-scm.com/docs/git-pull) `[<options>] [<repo>]`

- Fetch from and integrate with another repo or a local branch.
- In its default mode, `git pull` is shorthand for `git fetch` followed by `git merge FETCH_HEAD`.

[push](http://git-scm.com/docs/git-push) `[<repo>]`

- Update remote refs along with associated objs.
- `--all` Push all branches.

[remote](http://git-scm.com/docs/git-remote)

- Manage set of tracked repos.
- `add [-t <branch>] <name> <url>`
- `rename <old> <new>`
- `remove <name>` | `rm <name>`
- `show`, `set-url` ...

[submodule](http://git-scm.com/docs/git-submodule)

- Initialize, update or inspect submodules.

### Inspect & Compare

[show](http://git-scm.com/docs/git-show)

- Show various types of objs.

[shortlog](http://git-scm.com/docs/git-shortlog) `[<options>] [<revision range>] [[\--] <path>…]`

- Summarize git log output.
- `--summary` | `-s` Suppress commit desc and provide a commit count summary only.
- `--email` | `-e` Show the email addr of each author.

[log](http://git-scm.com/docs/git-log), [diff](http://git-scm.com/docs/git-diff) &nbsp; *See above.*

[describe](http://git-scm.com/docs/git-describe) ...

### Patch

[revert](http://git-scm.com/docs/git-revert) `<commit>…`

- Revert some existing commits.
- `git revert --continue` Continue the operation in progress using the info `.git/sequencer`. Can be used to continue after resolving conflicts in a failed cherry-pick or revert.
- `git revert --quit` Clear the sequencer state after a failed cherry-pick or revert.
- `git revert --abort` Cancel the operation and return to the pre-sequence state.

[rebase](http://git-scm.com/docs/git-rebase) `[<upstream> [<branch>]]`

- Forward-port local commits to the updated upstream head.
- `<upstream>` Upstream branch to compare against. May be any valid commit, not just an existing branch name. Defaults to the configured upstream for the cur
- `<branch>` Working branch; defaults to HEAD.
- `--interactive` | `-i` Make a list of the commits which are about to be rebased. Let the user edit that list before rebasing.
- `git rebase --continue` Restart the rebasing process after having resolved a merge conflict.
- `git rebase --abort` Abort the rebase operation and reset HEAD to the original branch.

[cherry-pick](http://git-scm.com/docs/git-cherry-pick) `<commit>…`

- Apply the changes introduced by some existing commits.
- `-edit` | `-e` Edit the commit msg prior to committing.
- `--no-commit` | `-n` Apply the changes without making any commit.
- `git cherry-pick --continue` Continue the operation in progress using the info in `.git/sequencer`. Can be used to continue after resolving conflicts in a failed cherry-pick or revert.
- `git cherry-pick --quit` Forget about the cur operation in progress. Can be used to clear the sequencer state after a failed cherry-pick or revert.
- `git cherry-pick --abort` Cancel the operation and return to the pre-sequence state.

[diff](http://git-scm.com/docs/git-diff) &nbsp; *See above.*

[apply](http://git-scm.com/docs/git-apply) ...

### Debug

[bisect](http://git-scm.com/docs/git-bisect) `<subcommand> <options>`

- Use binary search to find the commit that introduced a bug.
- Subcommands: `start`, `good`, `bad`, `reset` ...

[blame](http://git-scm.com/docs/git-blame) `<file>`

- Show what revision and author last modified each line of a file.
- `-b` Show blank SHA-1 for boundary commits. This can also be controlled via the `blame.blankboundary` config opt.
- `-l` Show long rev (Default: off).
- `-t` Show raw timestamp (Default: off).
- `-L <start>,<end>` `-L :<funcname>` Annotate only the given line range. May be specified multiple times. Overlapping ranges are allowed.
- `<start>` and `<end>` are optional. `-L <start>` or `-L <start>,` spans from `<start>` to end of file. `-L ,<end>` spans from start of file to `<end>`.
- `-M` Detect moved or copied lines within a file.
- `-C` In addition to -M, detect lines moved or copied from other files that were modified in the same commit.

[grep](http://git-scm.com/docs/git-grep) `<pattern>`

- Print lines matching a pattern.
- `--cached` Instead of searching tracked files in the working tree, search blobs registered in the index file.
- `--no-index` Search files in the current directory that is not managed by Git.
- `--untracked` In addition to searching in the tracked files in the working tree, search also in untracked files.
- `--fixed-strings` | `-F` Use fixed strings for patterns (don't interpret pattern as a regex).
- `--ignore-case` | `-i` Ignore case diff between the patterns and the files.
- `--line-number` | `-n` Prefix the line num to matching lines.

### Administration

[reflog](http://git-scm.com/docs/git-reflog)

- Manage reflog info.
- `--all` Process the reflogs of all references.

[clean](http://git-scm.com/docs/git-clean), [gc](http://git-scm.com/docs/git-gc), [fsck](http://git-scm.com/docs/git-fsck), [filter-branch](http://git-scm.com/docs/git-filter-branch), [instaweb](http://git-scm.com/docs/git-instaweb), [archive](http://git-scm.com/docs/git-archive), [bundle](http://git-scm.com/docs/git-bundle) ...

### Email

[am](http://git-scm.com/docs/git-am), [apply](http://git-scm.com/docs/git-apply), [format-patch](http://git-scm.com/docs/git-format-patch), [send-email](http://git-scm.com/docs/git-send-email), [request-pull](http://git-scm.com/docs/git-request-pull) ...

### External Systems

[svn](http://git-scm.com/docs/git-svn), [fast-import](http://git-scm.com/docs/git-fast-import) ...

### Server Admin

[daemon](http://git-scm.com/docs/git-daemon), [update-server-info](http://git-scm.com/docs/git-update-server-info) ...

### Plumbing Cmds

[ls-files](http://git-scm.com/docs/git-ls-files)

- Show info about files in the index and the working tree.
- `--cached` | `-c` Show cached files in the output (default).
- `--delete` | `-d` ... deleted ...
- `--modified` | `-m` ... modified ...
- `--others` | `-o` ... others ...
- `--ignored` | `-i` ... ignored ...
- `--stage` | `-i` ... stage ...
- `--unmerged` | `-u` ... unmerged ...

[cat-file](http://git-scm.com/docs/git-cat-file), [commit-tree](http://git-scm.com/docs/git-commit-tree), [count-objects](http://git-scm.com/docs/git-count-objects), [diff-index](http://git-scm.com/docs/git-diff-index), [for-each-ref](http://git-scm.com/docs/git-for-each-ref), [hash-object](http://git-scm.com/docs/git-hash-object), [merge-base](http://git-scm.com/docs/git-merge-base), [read-tree](http://git-scm.com/docs/git-read-tree), [rev-list](http://git-scm.com/docs/git-rev-list), [rev-parse](http://git-scm.com/docs/git-rev-parse), [show-ref](http://git-scm.com/docs/git-show-ref), [symbolic-ref](http://git-scm.com/docs/git-symbolic-ref), [update-index](http://git-scm.com/docs/git-update-index), [update-ref](http://git-scm.com/docs/git-update-ref), [verify-pack](http://git-scm.com/docs/git-verify-pack), [write-tree](http://git-scm.com/docs/git-write-tree) ...

### .gitignore

[.gitignore](https://git-scm.com/docs/gitignore)

A file specifies intentionally untracked files that Git should ignore. Files already tracked are not affected.

Gitignore **patterns** from multiple **sources**, with the following order of precedence, from highest to lowest:

- From cmd line.
- File `.gitignore` specifies files all developers will want to ignore
- File `$GIT_DIR/info/exclude` specifies files that are just useful to a particular repo
- e.g., auxiliary files are specific to one user’s workflow.
- The file specified by config var `core.excludesFile` in the user’s file `~/.gitconfig`.
- For ignoring some files in all situations. e.g., backup or temporary files generated by editors.

Pattern Format

- A line starting with `#` serves as a **comment**.
- An optional prefix `!` which **negates** the pattern.
- A pattern which ends with a slash `/` will only find a match with a dir e.g. `foo/` will match a dir foo and paths underneath it.
- A leading slash `/` matches the beginning of the pathname. For example, `/*.c` matches "cat-file.c" but not "mozilla-sha1/sha1.c".
- `*` asterisk wildcard (通配符).
- ...
