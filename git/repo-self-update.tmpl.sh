#!/bin/bash

# Author : IceHe
# Email : icehe.xyz@qq.com
# Website : https://icehe.life

echo "
================================================================================
START: $(date)"

#echo '
#>> export PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"'
#export PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"

echo '
>> export'
export

echo '
>> cd /path/to/repo && pwd'
cd /path/to/repo && pwd

echo '
>> git stash && git stash clear'
git stash && git stash clear

echo '
>> git checkout master'
git checkout master

echo '
>> git fetch -apv'
git fetch -apv

echo '
>> git pull
'
git pull

echo "
FINISH: $(date)
================================================================================
"
