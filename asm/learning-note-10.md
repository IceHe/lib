# ASM 汇编语言 10

> ASM - Note: 内中断，中断处理程序，中断向量表，中断过程。安装、设置中断向量，单步中断。编写 0 号中断的处理程序。

- Created on 2014-11
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章十二、内中断

中断：CPU不再接着（刚执行完的指令）向下执行

### 12.1 内中断的产生

当8086 CPU发生以下情况时，将产生马上处理的中断信息：

`int` 右边数字为中断类型码：

- 除法错误（执行div时产生溢出） - 0
- 单步执行 - 1
- 执行into指令 - 4
- 执行int指令 - 该指令的格式为 int n
    - 指令中n为byte型立即数，是提供给CPU的中断类型码

### 12.2 中断处理程序

根据中断类型码，定位相应中断处理程序

### 12.3 中断向量表

中断向量表，存储**256个**中断处理程序的 **入口地址**（CS:IP）

- 它在内存中存放，对于8086PC机，**放在内存地址0处**
- 在0000:0000~0000:03FF，CS、IP地址分别都是dword，共占4B

### 12.4 中断过程：

- 从中断信息中，取得**中断类型码 N**
- **标志寄存器**的值**入栈**，pushf
    - 因为中断过程中要改变标志寄存器的值，要先将其保存在栈中
- 将标志寄存器的第8位 **TF** 和 第9位 **IF** 的值 设**置为 0**
    - TF = 0， IF = 0（目的日后详述）
- **CS** 的内容 **入栈**，push cs
- **IP** 的内容 **入栈**，push ip
- 设置中断处理程序的入口地址

```nasm
IP = (中断类型码 * 4)     ; 用地址为 中断类型码 * 4 的内存内容 设置IP
CS = (中断类型码 * 4 + 2) ; 类上
```

然后执行中断处理程序

### 12.5 中断处理程序 使用 iret 指令返回

**iret** 功能：

```nasm
pop ip
pop cs
popf
```

### 12.6 除法错误中断的处理

### 12.7 编程处理 0 号（除法错误）中断

### 12.8 安装

### 12.9 do1

### 12.10设置中断向量

```nasm
assume cs:code

code segment

start:
     mov ax, cs
     mov ds, ax
     mov si, offset do0

     mov ax, 0
     mov es, ax
     mov di, 200h
     ;0000:0000~0000:03FF 为中断向量表
     ;而0200~02FF还不被其它程序包括OS等使用
     ;可以安全使用

     **;传输长度
     mov cx, offset do0end - offset do0
     cld     ;设置传输方向为正
     rep movsb     ;安装程序**

     ;设置中断向量表
     mov ax, 0
     mov es, ax
     **mov word ptr es:[0 * 4], 200h     ;ip
     mov word ptr es:[0 * 4 + 2], 0     ;cs**

     mov ax, 4c00h
     int 21h

do0:
     jmp short do0start
     db 'Overflow!'

do0start:
     ;指向上面定义的那串字符
     mov ax, cs
     mov ds, ax
     mov si, 202h

     ;指向显示空间的中间位置
     mov ax, 0b800h
     mov es, ax
     mov di, 12 * 160 + 36 * 2

     mov cx, 9

s:
     mov al, [si]
     mov es:[di], al
     inc si
     add di, 2
     loop s
     mov ax, 4c00h
     int 21h

do0end:
     nop

code ends

end start
```

Attachment 附件：[汇编语言第十二章安装关于除法溢出的中断程序的实例.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%209/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%8C%E7%AB%A0%E5%AE%89%E8%A3%85%E5%85%B3%E4%BA%8E%E9%99%A4%E6%B3%95%E6%BA%A2%E5%87%BA%E7%9A%84%E4%B8%AD%E6%96%AD%E7%A8%8B%E5%BA%8F%E7%9A%84%E5%AE%9E%E4%BE%8B.asm)

### 12.11 单步中断

使 **TF = 1**，**CPU**将工作于 **单步中断** 方式下，执行完这条指令后，就引发单步中断

当然，**进入中断**处理**程序前**，设**置TF = 0**，避免在中断处理程序执行中发生单步中断

### 12.12 响应中断的特殊情况

在执行完**向 ss** 寄存器**传送数据的指令后**，即便**发生中断**，CPU**也不会响应**

主要原因：

- ss:sp 联合指向栈顶，而对它们的设置应该连续完成。
- 因为假如**设置完ss后**被中断，需要压栈保存数据，
- 此时**后续设置sp的语句没有执行**，于是**中断处理保存了错误的sp**。
- 中断恢复后，会导致**sp没有指向正确的栈顶**！
- 所以**设置sp的语句**，**紧跟设置ss的语句！**

### 实验12 编写0号中断的处理程序

编写0号中断的处理程序，使得在出发溢出发生时，在屏幕中间显示字符串“divide error！”，然后返回到DOS。

类同12.10小节下的程序

```nasm
assume cs:code

code segment

start:
     mov ax, cs     ;cs 曾错写为 offset do
     mov ds, ax
     mov si, offset do     ;offset do 曾错写为 0

     mov ax, 0
     mov es, ax
     mov di, 200h

     mov cx, offset do_end - offset do
     cld
     rep movsb

     mov word ptr es:[0 * 4], 200h     ;ip
     mov word ptr es:[0 * 4 + 2], 0     ;cs

     mov ax, 1000
     mov bh, 1
     div bh

     mov ax, 4c00h
     int 21h

do:
     mov ax, 0
     mov ds, ax
     mov si, 200h + offset msg - offset do

     mov ax, 0b800h
     mov es, ax
     mov di, 12 * 160 + 2 * (40 - (offset do_end - offset msg) / 2)

     mov cx, offset do_end - offset msg

s:
     mov al, ds:[si]
     mov es:[di], al
     inc si
     add di, 2
     loop s

     mov ax, 4c00h
     int 21h

msg:
     db "divide error!"     ;13字

do_end:
     nop

code ends

end start
```

后记：

1. 趁着对12.10小节的中断处理程序的安装程序还有印象时，重写的。不够独立。
2. 竟然对照12.10小节的程序来debug！不能容忍有下次！

Attachment 附件：[汇编语言第十二章实验10.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%209/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%8C%E7%AB%A0%E5%AE%9E%E9%AA%8C10.asm)
