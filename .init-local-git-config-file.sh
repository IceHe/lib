#!/bin/bash

# Initilize (Overwrite) the local Git configuration file
echo '[commit]
    # https://docs.github.com/en/authentication/managing-commit-signature-verification/signing-commits
	gpgsign = false
[core]
	repositoryformatversion = 0
	bare = false
	logallrefupdates = true
	ignorecase = true
	precomposeunicode = true
[submodule]
	active = .
[remote "origin"]
	url = git@github.com:IceHe/lib.git
	url = git@gitlab.com:IceHe/lib.git
	url = git@e.coding.net:IceHe/lib.git
	fetch = +refs/heads/*:refs/remotes/origin/*
[branch "master"]
	remote = origin
	merge = refs/heads/master
[user]
    # https://git-scm.com/docs/git-config#Documentation/git-config.txt-username
	name = IceHe.xyz
	email = icehe.xyz@qq.com
' > ./.git/config
# View the local Git configuration file
less ./.git/config

