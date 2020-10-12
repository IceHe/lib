# Bash Script Notes

## Example 1

Prepare

- on macOS

```bash
brew install terminal-notifier
```

File : example1.sh

```bash
#!/bin/bash

echo

echo ===========START===========
date +"%Y-%m-%d %H:%M:%S %a"
echo

# 切换 Working Directory
cd /path/to/scripts

echo PWD:
pwd
echo

# 补全 $PATH , 以便使用本地用户安装的命令
PATH=$PATH:/usr/local/bin

echo PATH:
echo $PATH
echo

terminal_notifier_title="定时脚本"
cookie_from_file=`cat cookie.txt`

format_with_millis='+%s000'

datetime_from_cmd="date -v -7d"
datetime_to_cmd="date -v +8H"

datetime_from=$($datetime_from_cmd $format_with_millis)
datetime_to=$($datetime_to_cmd $format_with_millis)

echo datetime_from:
echo $datetime_from $($datetime_from_cmd +"%Y-%m-%d %H:%M:%S %a")
echo datetime_to:
echo $datetime_to $($datetime_to_cmd +"%Y-%m-%d %H:%M:%S %a")
echo

query_param='{
    "datetime_from": datetime_from_xxx,
    "datetime_to": datetime_to_xxx
}'

query_param=`echo $query_param | sed "s/datetime_from_xxx/$datetime_from/" | sed "s/datetime_to_xxx/$datetime_to/"`

#echo QUERY PARAMS:
#echo $query_param | jq
#echo

ids=`curl -s \
--location --request POST 'https://icehe.xyz/api/querySomething' \
--header 'content-type: application/json;charset=UTF-8' \
--data-raw "$query_param" \
| jq '[.data.items[].id]'`

update_param="{
    \"id\": $ids
}"

if [ "$ids" != "[]" ]; then

    echo RECHECK PARAMS:
    echo $update_param | jq
    echo

    result=`curl -s \
    --location --request POST 'https://icehe.xyz/api/doSomething' \
    --header 'content-type: application/json;charset=UTF-8' \
    --header "$cookie_from_file" \
    --data-raw "$update_param"`

    result_msg=`echo $result | jq '.message | if . == null then "" else . end' | sed 's/^"//' | sed 's/"$//'`

    if [ "$result_msg" = "未登录" ]; then

        echo RESULT_MSG: $result_msg
        echo

        msg="Cookie 过期!"
        echo NOTIFY:
        echo $msg
        terminal-notifier \
            -title "$terminal_notifier_title" \
            -message "$msg" -ignoreDnD -group 1
        echo

    elif [ -n "$result_msg" ]; then

        echo RESULT_MSG: $result_msg
        echo

        msg="异常: $result_msg"
        echo NOTIFY:
        echo $msg
        terminal-notifier \
            -title "$terminal_notifier_title" \
            -message "$msg" -ignoreDnD -group 1
        echo

    fi

    echo RESULT:
    echo $result | jq
    echo

else
    echo RESULT:
    echo Nothing wrong.
    echo
fi

date +"%Y-%m-%d %H:%M:%S %a"
echo ============FIN============
echo

```

Edit Crontab

`crontab -e`

```bash
* * * * * cd /path/to/scripts && bash example1.sh | tee -a example1.log

```
