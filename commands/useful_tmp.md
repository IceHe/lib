# Useful

统计每秒访问量

`grep 'interface_name' localhost_access_log |awk '{print $5}' |sort |uniq -c |sort -n -r |head -n 20`

用root身份执行最后一个命令

`sudo !!`

在当前文件夹下开启一个简易http服务器，可以用于临时分享文件

`python -m SimpleHTTPServer`

把最后一次执行命令的foo替换成bar后执行

`^foo^bar`

开启编辑器，用来编辑一个复杂命令并执行

`ctrl-x e`

插入最近命令的参数，每按一次向前移动一个参数

`'ALT+.' or '<ESC> .'`

开启一个简易计时器

`time read`

less版tail -f，按ctrl+c可以暂停输入，shift+F继续输入。

`less +F file`

把上一个命令存为sh文件

`echo "!!" > foo.sh`

输出文件中start_pattern到stop_pattern中间的部分

`awk '/start_pattern/,/stop_pattern/' file.txt`

为特别复杂的语句添加label，以后可以在ctrl+R时直接搜索label

`some_very_long_and_complex_command # label`

删除非.foo,.bar.baz的文件

`rm !(*.foo|*.bar|*.baz)`

去掉重复行（不需要排序）

`awk '!x[$0]++' file`

grep时去掉grep本身

`ps aux |grep [p]rocess-name`

输出文件的10-20行

`sed -n '10,20p' file`

显示当前正在使用网络的连接。

`ss -p`

用finder打开当前文件夹（mac）。

`open .`

显示当前文件夹下最大的10个文件/文件夹。

`du -s * |sort -n |tail`

把file2的权限更新到与file1一致.

`chmod --reference file1 file2`

同ctrl+x e

`fc`

显示进程树

`ps awwfux |less -S`

执行command，如果5s后没有结束就kill它。

`timeout 5s COMMAND`

对比当前和10秒后进程打开文件的情况（同理可对比其它命令）

`diff <(lsof -p 1234) <(sleep 10; lsof -p 1234)`

重复执行上一个命令直到执行成功

`util !!;do :;done`

在某种文件类型中搜索关键字

`find . -name "*.[ch]" -exec grep -i -H "search pharse" {} \;`

查看哪个进程占用了80端口

`lsof -i tcp:80`

删除1，3列

`awk '{$1=$3=""}1' file`

显示行号

`nl`

切换到上一个命令最后一个参数指向的目录（:t是文件）

`cd !$:h`

计算299秒是多少分钟

`bc <<< 'obase=60;299'`
