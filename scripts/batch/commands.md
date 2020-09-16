# Batch 批处理指令

> Batch Commands: echo, pause, nul, goto, call, choice, start, setlocal, endlocal, setx, pushd, popd, for /d /r /l /f, if, set。

**Better Ref**: 《[Windows批处理\(cmd/bat\)常用命令小结](https://wsgzao.github.io/post/windows-batch/)》todo  
  
**bat资料from：**网页[**简明bat教程**](http://andylin02.iteye.com/blog/420598)本地[.bat批处理命令简明教程](evernote:///view/7264256/s33/0c948d72-4b32-4638-a112-ed24499339ab/0c948d72-4b32-4638-a112-ed24499339ab/)  
简便句式cmd0 **&&** cmd\_suc **\|\|** cmd\_failedcmd0指令成功，则执行cmd\_suc，否则执行cmd\_failed。（例）call php x.php && echo suc. \|\| echo failed!  
  
**rem**     注释。（算是一条指令）可以作为空指令使用~**::**     注释。（纯粹的注释）  
**@**     不显示当前行的指令  
**echo on/off**     回显开关  
**echo.**     显示空行（注意：指令最后带一个英文句号！）  
**pause**     暂停执行，会显示 “按任意键退出”pause**&gt;nul**     将**显示的内容重定向到nul**，即不显示“按任意键退出”  
**nul** 的官方解释是 "**空设备**"**&lt;nul     回车但不换行&gt;nul**     是**屏蔽命令的输出**内容  
**goto** tag     跳转到标签位:tag     冒号后面跟着标签号  
**call** bat\_file\_path     调用另一个批处理文件  
**start**     调用外部程序  
**choice** /c ync /d default\_choice /l limit\_time     提示用户输入字符，再据此决定下一步操作。  
**%n**     调用.bat时的第n个参数，n为1~9（只能有9个）**shift**     偏移位置去获取其它参数在批处理文件中  
**pushd     保存当前路径popd     恢复上一个路径mklink     添加符号连接或硬连接path     显示或\(暂时\)改变\(局部的\)环境变量pathsetx     \(长期\)设置环境变量**  
**setlocal     在批处理文件中，开始将运行环境局部化endlocal     在批处理文件中结束对本地环境特征的修改**  
**exit     退出exit %exitCode%     退出cmd.exe时，设置exitCode                                   为%exitCode%exit /b %ret%     退出并设置.bat文件的errorlevel                         （错误返回码）为%ret%**  
**&gt;     FOR语句  
for /d /r /l /f    即dir/recursive/file 等**  
FOR {%variable\|%%variable} in \(set\) do command \[CommandLineOptions\]%variable 指定一个单一字母可替换的参数。  
 \(set\) 指定一个或一组文件。可以使用通配符。  
 command 指定对每个文件执行的命令。  
  
FOR /R \[\[drive:\]path\] %variable IN \(set\) DO command \[CommandLineOptions\]检查以 \[drive:\]path 为根的目录树，指向每个目录中的FOR 语句。如果在 /R 后没有指定目录，则使用当前目录。如果集仅为一个单点\(.\)字符，则枚举该目录树。  
  
FOR /L %variable IN \(start,step,end\) DO command \[command-param\]  
FOR /F \["options"\] %variable IN **\(file-set\)** DO command     //注意：圆括号内的参数 **没**带**引号**！FOR /F \["options"\] %variable IN **\("string"\)** DO command     //注意：圆括号内的参数 带**双引号**！FOR /F \["options"\] %variable IN **\('command'\)** DO command     //注意：圆括号内的参数 带**单**引号！  
**options中的设置：**eol=c - 指一个行注释字符的结尾\(就一个\)     如eol=;     即每个以分号开头的行将被忽略skip=n - 指在文件开始时忽略的行数。delims=xxx - 指分隔符集。这个替换了空格和跳格键的默认分隔符集。tokens=x,y,m-n,k\* - 指每行的哪一个符号被传递到每个迭代     如for /f "tokens=1,3 %%i ……     获取每行的第1、第3个     如for /f "tokens=2-4 %%i ……     获取每行的第2至第4个     如for /f "tokens=2\* %%i ……     第二个赋值给%%i，剩下的都赋值给%%jusebackq - 未查  
**%%i变量的加强拓展：%cname:~0,1%     获取cname中的第0字符，到第1个字符结束**~I - 删除任何引号\("\)，扩充 %I%~fI - 将 %I 扩充到一个完全合格的路径名%~dI - 仅将 %I 扩充到一个驱动器号%~pI - 仅将 %I 扩充到一个路径%~nI - 仅将 %I 扩充到一个文件名%~xI - 仅将 %I 扩充到一个文件扩展名%~sI - 扩充的路径只含有短名%~aI - 将 %I 扩充到文件的文件属性%~tI - 将 %I 扩充到文件的最讨厌这话期/时间%~zI - 将 %I 扩充到文件的大小%~$PATH:I - 查找列在路径环境变量的目录，并将 %I 扩充到找到的第一个完全合格的名称。如果环境变量未被定义，或者没有找到文件，此组合键会扩充空字符串  
**可以组合修饰符**来得到多重结果:%~dpI - 仅将 %I 扩充到一个驱动器号和路径%~nxI - 仅将 %I 扩充到一个文件名和扩展名%~fsI - 仅将 %I 扩充到一个带有短名的完整路径名%~dp$PATH:i - 查找列在路径环境变量的目录，并将 %I 扩充到找到的第一个驱动器号和路径。%~ftzaI - 将 %I 扩充到类似输出线路的 DIR  
**（例）文件夹遍历**setlocal enabledelayedexpansion  
 FOR /R d: %%i IN \(.\) DO \(  
      set dd=%%i  
      set "dd=!dd:~0,-1!"  
      echo !dd!  
 \)  
其中，感叹号其实就是变量百分号\(%\)的强化版。之所以要用!而不用%，是因为在for循环中，当一个变量被多次赋值时，%dd%所获取的仅仅是dd第一次被赋予的值；要想刷新dd的值，就必须首先通过命令"setlocal enabledelayedexpansion"来开启延迟变量开关，然后用!dd!来获取dd的值。  
  
**&gt;     IF 语句**简便用的句式：if %var == val cmd1 && cmd2条件语句，true则执行cmd1，否则执行 cmd2。  
**1.比较字符串**set /p PW=Please input password:  
 if **%PW%==str** \(  
      echo YES!  
 \) ELSE \(  
      echo NO!  
 \)  
**2.比较数字**if not **%num1% LSS %num2%** \(     ...\) else if ...\(     ...\) else\(     ...\)  
**比较运算符：**  
 EQU - 等于  
 NEQ - 不等于  
 LSS - 小于  
 LEQ - 小于或等于  
 GTR - 大于  
 GEQ - 大于或等于  
**3.检测变量是否被定义**set var=xxxxx  
 if **defined var**\( ... \)  
**4.判断返回值（ERRORLEVEL）**if **errorlevel n** \( ... \)  
多组if errorlevel语句，要根据返回码n从大到小排，其原因类似于try...catch语句中的catch规则，具体自行详查。  
批处理中的返回值一般表示了上个命令的执行结果\(成功/失败/等\)每个命令执行完毕后返回值，都会做相应的更改。一般返回值为0表示成功,1表示失败。  
一些第三方的返回值比较特殊，如Choice、Tmos.exe、Cmos.exe，自行详查。  
  
if errorlevel n     条件功能：是否为返回码n。                         多组if errorlevel语句，根据返回码n从大到小排。                         因为其执行类似于switch。if exist file\_path     是否存在某文件  
  
**&gt;     SET 语句  
set     显示、设置、去掉windows的环境变量**  
1.给变量**赋值**     set str=something2.**等待**用户**输入**数据     set /p name=请输入你的名字：3.**计算**     set /a num=\(6\*2\)^2  
**算式中的计算符：**\(\)     分组! ~ -         一元运算符\* / %       算数运算符+ -           算数运算符&lt;&lt; &gt;&gt;     逻辑移位&             按位“与”^             按位“异”\|              按位“或”= \*= /= %= += -=       赋值&= ^= \|= &lt;&lt;= &gt;&gt;=     移位,               表达式分隔符：     set /a支持多行表达式并列，比如set /a num1=1+1,num2+1+2,num3=1+3     并且set /a不需要扩展变量，比如set /a num=%num2%+%num3%          与set /a num=num2+num3等价

