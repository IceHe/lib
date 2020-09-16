# ASM 汇编语言 15

> ASM - Note: 使用 BIOS 进行键盘输入和磁盘读写。中断例程对键盘输入的处理。使用 int 16h 中断例程读取键盘缓冲区。字符串的输入。应用 int 13h 中断例程对磁盘进行读写。编写包含多个功能子程序的中断例程。

* Created on 2014-11
* 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章十七、使用BIOS进行键盘输入和磁盘读写

* 键盘输入：最基本的输入
* 磁盘：最常用的储存设备
* BIOS：为以上两种外设提供了最基本的中断例程

### 17.1 int 9 中断例程对键盘输入的处理

* 一般键盘输入，在CPU执行完int 9中断例程后，都放到键盘缓冲区中。
* 键盘缓冲区有16个字单元，可以存储15个按键的扫描码和对应的ASCII码。
* 键盘缓冲区使用环形队列结构管理的内存区。

int 9 中断例程对键盘输入的处理方法：

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2014/Evernote%20Camera%20Roll%2020150117%20171602.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2014/Evernote%20Camera%20Roll%2020150117%20171602.png)

### 17.2 使用 int 16h 中断例程读取键盘缓冲区

BIOS 提供了 int 16h 中断例程，它包含功能：

* 从键盘缓冲区中读取一个键盘输入，功能编号为0。

示例

```text
mov ah, 0
int 16h
```

结果：

* \(ah\)=扫描码，\(al\)=ASCII码。

功能：

* 检测键盘缓冲区是否有数据；
* 没有则重复第一步
* 读取缓冲区第一个字单元的键盘输入；
* 将读取的扫描码送入ah，ASCII码送入al；
* 将已读取的键盘输入从缓冲区中删除。

具体例子，请看原书P303

* 可见，BIOS的int 9 和 int 16h中断例程是一对相互配合的程序。
* int 9 向缓冲区写，int 16h 从缓冲区读，但调用时机不同。
* int 9 在键按下时，它就写入；int 16h 则是被应用程序调用时，它才去读。

编程：接收用户的键盘输入，输入r，将屏幕字符设置为红色；

* g 则设为绿色； b 则设为蓝色。

源码：

```text
assume cs:code

code segment

start:
     mov ah, 0
     int 16h

     mov ah, 1     cmp al, 'r'
     je red
     cmp al, 'g'
     je green
     cmp al, 'b'
     je blue
     jmp short sret

red:
     shl ah, 1

green:
     shl ah, 1blue:
     mov bx, 0b800h
     mov es, bx
     mov bx, 1

     mov cx, 2000

c0:
     and byte ptr es:[bx], 11111000b
     or es:[bx], ah
     inc bx
     inc bx
     loop c0

sret:
     mov ax, 4c00h
     int 21h

code ends

end start
```

### 17.3 字符串的输入

最基本的字符串输入程序，需具备以下功能：

* 在输入的同时需要显示这个字符串；
* 一般在输入回车符后，字符串输入结束；
* 能够删除已经输入的字符。

编程：实现以上3个基本功能，参数如下——

* \(dh\)、\(dl\)=字符串在屏幕上显示的行、列位置；
* ds:si指向字符串的储存空间，字符串以0为结束符。

实现思路：详看原书P304~305

处理过程：

* 调用int 16h 读取键盘输入
* 若是字符，入栈，显示栈中所有字符；继续执行第一步；
* 若是退格键，一个字符出栈，显示栈中所有字符；继续执行第二步；
* 若是Enter键，向栈压入0，返回。

源码：

* 其中子程序charstack的子程序的参数说明：
* \(ah\)=功能号，0表示入栈，1表示出栈，2表示显示；
* ds:si指向字符栈空间；
* 入栈：\(al\)=入栈字符；
* 出站：\(al\)=出栈返回的字符；
* 显示：\(dh\)、\(dl\)=字符串在屏幕上显示的行、列位置。

```text
assume cs:code

stack segment
     db 64 dup (0)
stack ends

code segment

start:
     mov ax, stack
     mov ds, ax
     mov si, 0     ;ds:si指向charstack的字符栈空间
     mov dh, 0     ;显示在第0行
     mov dl, 0     ;显示在第0列
     call getstr

     mov ax, 4c00h
     int 21h

getstr:
     push ax

getstrs:
     ;获取键盘输入
     mov ah, 0
     int 16h

     cmp al, 20h
     jb not_char     ;ASCII码小于20h，说明不是字符

     mov ah, 0     ;调用charstack的0号子程序
     call charstack     ;字符入栈
     mov ah, 2     ;调用charstack的2号子程序
     call charstack     ;显示栈中的字符

     jmp getstrs

not_char:
     cmp ah, 0eh     ;退格键的扫描码
     je backspace
     cmp ah, 1ch     ;回车键的扫描码
     je enter_btn

     jmp getstrs

backspace:
     mov ah, 1     ;调用charstack的1号子程序
     call charstack     ;字符出栈
     mov ah, 2     ;类同上
     call charstack     ;显示栈中的字符

     jmp getstrs

enter_btn:
     mov al, 0
     mov ah, 0
     call charstack     ;0入栈
     mov ah, 2
     call charstack     ;显示栈中字符

     pop ax
     ret

charstack:
     jmp short  charstart
table     dw charpush, charpop, charshow
top          dw 0     ;栈顶

charstart:
     push bx
     push dx
     push di
     push es

     cmp ah, 2
     ja sret

     mov bh, 0
     mov bl, ah
     add bx, bx     jmp word ptr table[bx]

charpush:
     mov bx, top
     mov ds:[si][bx], al      inc top
     jmp sret

charpop:
     cmp top, 0
     je sret

     dec top
     mov bx, top
     mov al, ds:[si][bx]
     jmp sret

charshow:
     mov bx, 0b800h
     mov es, bx

     mov ah, 0
     mov al, 160
     mul dh     ;dh：显示在第几行
     mov di, ax

     add dl, dl     ;dl：显示在第几列
     mov dh, 0
     add di, dx     ;di：对应的显示缓冲区的偏移量

     mov bx, 0

charshows:
     cmp bx, top
     jne not_empty
     mov byte ptr es:[di], ' '
     jmp sret

not_empty:
     mov al, ds:[si][bx]
     mov es:[di], al
     mov byte ptr es:[di + 2], ' '     ;设置下一个显示位为空
     inc bx
     inc di
     inc di
     jmp charshows

sret:
     pop es
     pop di
     pop dx
     pop bx
     ret

code ends

end start
```

Attachment 附件：[汇编语言第十七章17.3例.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%2014/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%83%E7%AB%A017.3%E4%BE%8B.asm)

### 17.4 应用 int 13h 中断例程对磁盘进行读写

以3.5英寸软盘为例讲解（无法测试，只能做简单的笔记）。

3.5英寸软盘：`2面 * 80磁道 * 18扇区 * 512字节 = 1440KB ≈ 1.44MB`

int 13h 入口参数：

\(ah\)=int 13h的功能号

2：读扇区；3：写扇区

\(al\)=读/写的扇区数

\(ch\)=磁道号

\(cl\)=扇区号

\(dh\)=磁头号（对于软盘即面号,因为一个面用一个磁头来读写）

\(dl\)=驱动器号 软驱从0开始，0：软驱A，1：软驱B；

* 硬盘从80h开始，80h：硬盘C，81h：硬盘D

es:bx 指向接受从扇区读入数据的内存区。

返回参数：

* 操作成功：\(ah\)=0，\(al\)=读/写的扇区数
* 操作失败：\(ah\)=出错代码

### 实验17 编写包含多个功能子程序的中断例程

以3.5英寸软盘为对象编写（无法测试，只能简单描述题目）。

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2014/1714006dae86aabe425b8e38249e2398.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2014/05dedeb0e9cfc789488adb730e26db81.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2014/e77389b70bb8aac0a6fe5832c80ec166.png)

### 课程设计2

\(完成并不现实：因为当前使用电脑CPU为64位，而非16位的8086CPU，即使编写的汇编程序也无法测试\)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2014/e8dc941688cdf6097fa9a4cbd36cb199.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2014/ce9f20b2811d6aa5cdb98795b5d636d9.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2014/28a66282bd49010054d7c45bdf8e9087.png)

