# DOS 常用指令

> DOS Commands: help, cmd\_name /?, type, attrib, xcopy, netstat, reg, assoc, ftype, find, findstr, sort, comp, fc

其它资料：《[DOS Command Index](http://web.csulb.edu/~murdock/dosindex.html)》

from百度知道：[dos命令大全](http://zhidao.baidu.com/link?url=W-fctrXkMTDtJeS8cY8I2h4uVYN3zhTVsTW-CI6v6vAMQVdrZwp5Khq1dRSgcQYAdUDi_DqMboh_pfQ5-QxzgK)  
**help     显示有哪些指令cmd\_name /?     查询指令用法**  
  
dir     显示当前目录的文件及文件夹的列表cd     .     ..     /     等md/rd     mkdir / rmdir**chdir     显示当前目录的名称或更改当前目录tree     显示目录树结构  
  
type     显示文本文件的内容attrib     显示或更改文件属性ren     重命名**copy     复制**xcopy     复制文件以及目录树**move     移动replace     替换**erase     删除一个或多个文件**del     删除**deltree     删除文件夹及其子文件夹与文件**  
  
format     格式化chkdsk     检查磁盘并显示状态报告vol     显示硬盘卷标，以及serial号码compact     显示或修改NTFS分区上压缩文件fsutil     显示或设置文件系统的设置  
  
ipconfig     电脑的ip设置ping     测试是否联通net cmd\_name     获取某指令的具体帮助**netstat     查看tcp/ip连接状态，如端口**nbtstat     得到远程主机的NETBIOS信息，比如用户名、所属的工作组、网卡的MAC地址等     tracert     查看你的主机到目标地址，经过的路径pathping     类同上，可得到一些上一指令不能显示的信息**ftp     ftp命令行模式**arp     操作ARP缓存，-a显示，-d删除一条，-s添加一条nslookup     排除dns的工具，另查。  
  
**WMIC**     WMIC扩展WMI（Windows Management Instrumentation，Windows管理规范） ，提供了从命令行接口和批命令脚本执行系统管理的支持。**SC**     显示、设置服务。与“服务控制器”和已安装设备进行通讯。SC 是用于与服务控制管理器和服务进行通信的命令行程序。shutdown     -s关机，-r重启，-a放弃关机，-t倒数秒数。其它自行详查。  
**date     /t     显示或修改当前时间time     /t     显示或修改当前时间reg     修改注册列表**at     计划任务。已不推荐使用！请使用过下一条！schtasks     计划任务。另查**assoc     显示或修改文件拓展名的关联类型ftype     显示或修改用于文件拓展名关联的文件类型**（例）ASSOC .pl=PerlScript  
 FTYPE PerlScript=perl.exe %1 %\*  
  
**cls     清空屏幕cmd     启动命令行新实例prompt     改变命令行的（交互）提示，如默认显示的 C:/Users/IceHe&gt;** color     调整命令行的前景、背景颜色title     设置cmd窗口的标题ver     显示系统版本  
  
**find     /v     查找内容findstr     查找内容！更强大！sort     /r /+n     排序comp     比较两个或两组文件的内容fc     比较两个或两组文件，并显示它们之间的差别**

