title: Shell - Note
---

脚本首行     `#!/bin/bash`
（表示使用该路径的程序来执行该文件）

全局变量

$HOME     用户目录路径
$PATH     寻找命令用的所有目录路径

$#     参数个数
$@     与$#相同，但使用时加引号，并在引号中返回每个参数
$0     参数1（脚本名）
$1     参数2
$n     ……（n代表第几个参数）

$$     脚本的进程号
$?     前一指令的退出码
$-     显示Shell使用的当前选项，与set命令功能相同

赋值

``` sh
var_name=     # 赋空值
var_name=number
var_name="string with whitespace"
```

访问变量

`$var_name`
"\$var_name=$var_name"
（“\”为转义符，消除“$”访问变量的含义）

条件语句

“ [ ” 是布尔判断命令
“ ] ” 仅是为了配对而产生

``` sh
if [ expr0 ]
then
     #statement0
elif [ expr1 ]
     #statement1
else
     #statement2
fi

# test 等同于 “ [ ”，同为布尔判断命令
if test -f testDemo.sh     # 等同于下一行
if [ -f Demo.sh ]
```

条件判断

``` sh
# 算术比较
var1 -eq var2     # 等于
… -nq …     # 不等于
-gt     # 大于
-ge     # 大于等于
-lt     # 小于
-le     # 小于等于
!expr     # 取反

# 文件比较
-e file     # 文件存在，返回True
-d dir     # 文件存在，且为目录存在...
-f file     # 文件存在，且为普通文件…
-c file     # 文件存在，且为字符型特殊文件...
-b file     # 文件存在，且为块特殊文件...

-r file     # 文件可读
-w file     # 文件可写
-x file     # 文件可执行
-s file     # 文件大小不为0

# 字符串比较
str1 == str2
str1 != str1
-n str     # 字符串不为空
-z str     # 字符串不为空串（NULL）
```

脚本退出

`exit n     # n 是退出码`

循环语句

for语句

``` sh
for variable in values
do
     # statement
done
```

while语句

``` sh
while condition
do
     # statement
done
```

until语句
（与while相反，直到condition为True时停止）

``` sh
until condition
do
     # statement
done
```

break语句

跳出while等的循环

continue语句

结束此次循环，开始下一循环

分支语句

case 语句

``` sh
case variable in
    pattern [ | pattern] ...) statements;;
    pattern [ | pattern] ...) statements;;
    ...
esac
```

&& 与 || 操作符

作用与C++一样，
即短路与、短路或。

语句块

被 {  } 包围。


函数

``` sh
# 函数名前面的function关键字，可加可不加！
[ function ] function_name()
{
     # statement
}

# 调用
function_name
# 带参数调用
function_name $0 $1 $2 ...
```

: 操作符

其实就是Shell内置的true，
速度比true快。

eval命令

eval [arg ...]
将字符串当做Shell命令执行。

expr命令

手工命令行Shell计数器

``` sh
#!/bin/bash
# 获取字符串的长度
expr length "http://www.jellythink.com"

#截取子串
expr substr "http://www.jellythink.com" 12 21

#整数运算
var=`expr 10 / 2`
echo $var
var=$(expr 10 \* 2)
echo $var
```

在上面的脚本中，使用了反引号(“)，使用了该引号，就可以使expr的执行结果赋值给var变量，当然了，我们在脚本中也看到了$()来替换反引号的用法，这都是可以的。

由于*号在Shell有特殊意义，我们需要加上转义字符\。

printf命令

带有格式化功能的echo。例：
``` sh
printf "%s\n" http://www.jellythink.com
printf "%c + %s = %s\n" 1 10 11
```

return命令

函数返回。若无指定，
则返回函数中最后一个命令的退出码。

set命令

显示系统中已存在的Shell变量。

shift命令

shift命令把所有参数变量左移一个位置，
使$2变成$1，$3变成$2，以此类推；
而2占领1的位置之后，原来$1的值就会被丢弃。

在扫描处理脚本程序的时候，经常要用到shift命令。
如果你的脚本命令程序需要10个或10个以上的参数，
就需要使用shift命令来访问第十个及其后面的参数。

trap命令

暂时没看懂……以后再尝试理解

unset命令

从环境中删除变量或函数，
但不能删除Shell本身定义的只读变量。

命令执行结果的保存

x=$(date)
echo $x

反引号也可以完成相同的工作，
但更建议使用 $( … )
使得输出结果以字符串形式展现。

算术拓展

 $(( … ))

expr命令可以完成简单的算术运算。
但是这个命令执行起来是非常的慢，
因为它需要调用一个新的shell来处理expr命令。

参数拓展

i=0
echo $i_JellyThink     # 无法得出想要的$i
echo ${i}_JellyThink     # 此时改写成${i}

数组

``` sh
# 定义
ary_name=(val1 val2 val3 …)

# 访问单个元素
${ary_name[n]}

# 获取所有元素
${ary_name[@]}

# 获取元素个数
${#ary_name[@]}
# 或者
${#ary_name[*]}

echo语句

# 显示普通字符串
echo It is a test.
# 此句与上一句结果一痒
echo "It is a test."

# 换行显示
# 选项 -e  开启转义
echo -e "Another line! \n"

# 不换行显示
echo -e "No new line! \c"
echo "New line?"
# 结果
No new line! New line?

# 显示命令执行结果
echo `date`
# 结果
Thu Jul 24 10:08:46 CST 2014

# 原样输出字符串，不进行转义或取变量
# 方法：使用单引号（单双引号区别雷同PHP）
echo ‘$name \"'
# 结果
$name \"
```
