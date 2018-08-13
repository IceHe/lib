# ASM 汇编语言 11

> ASM - Note: int 指令，中断例程。实现 2*2456^2 。将一个全是字母，以 0 结尾的字符串，转化为大写。用 7ch 中断例程实现 loop 指令的功能。BIOS 和 DOS 所提供的中断例程，及其中断例程的安装过程及其应用。

- Created on 2014-11
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章十三、int 指令

本章介绍 由int指令引发的中断

### 13.1 int 指令

没有做除法，也可以直接使用 **int 0** 指令**引发除法溢出中断**。

**中断处理程序** —— 简称：**中断例程**

### 13.2 编写供应用程序调用的中断例程

#### 实例 1

> 实现 `2 * 2456^2`

使用中断处理程序实现平方

```nasm
assume cs:code

code segment

start:
     mov ax, cs
     mov ds, ax
     mov si, offset sqr

     mov ax, 0
     mov es, ax
     mov di, 200h

     mov cx, offset sqrend - offset sqr
     cld
     rep movsb

     mov ax, 0
     mov es, ax
     mov word ptr es:[4 * 7ch], 200h
     mov word ptr es:[4 * 7ch + 2], 0

     ;test sqr
     mov ax, 3456
     int 7ch
     add ax, ax
     adc dx, dx

     mov ax, 4c00h
     int 21h

sqr:
     mul ax
     iret

sqrend:
     nop

code ends

end start
```

### 实例 2

> 将一个全是字母，以0结尾的字符串，转化为大写。

把终端程序当作子程序来使用。

```nasm
assume cs:code, ds:data

data segment
     db 'conversion', 0
data ends

code segment

start:
     ;install int 7ch
     mov ax, cs
     mov ds, ax
     mov si, offset capital

     mov ax, 0
     mov es, ax
     mov di, 200h

     mov cx, offset cap_end - offset capital
     cld
     rep movsb

     ;set int 7ch
     mov word ptr es:[4 * 7ch], 200h
     mov word ptr es:[4 * 7ch + 2], 0

     ;test int 7ch
     mov ax, data
     mov ds, ax
     mov si, 0

     int 7ch

     mov ax, 4c00h
     int 21h

capital:
     ;暂存寄存器
     pushf
     push cx

     mov ch, 0

r0:
     mov cl, ds:[si]
     jcxz ok

     cmp cl, 61h
     jb next
     cmp cl, 7ah
     ja next

     and byte ptr ds:[si], 11011111b

next:
     inc si
     jmp r0

ok:
     ;恢复寄存器
     pop cx
     popf

     iret

cap_end:
     nop

code ends

end start
```

### 13.3 对int、iret 和 栈的深入理解

- 目的：用7ch**中断例程实现loop**指令的**功能**
- 实例：在屏幕中间显示80个感叹号“**！**”。

```nasm
assume cs:code

code segment

start:
     ;install
     mov ax, cs
     mov ds, ax
     mov si, offset lop

     mov ax, 0
     mov es, ax
     mov di, 200h

     mov cx, offset lop_end - offset lop
     cld
     rep movsb

     mov word ptr es:[4 * 7ch], 200h
     mov word ptr es:[4 * 7ch + 2], 0

     ;test
     mov ax, 0b800h
     mov es, ax
     mov di, 12 * 160

     mov bx, offset s - offset se
     mov cx, 80

s:
     mov byte ptr es:[di], '!'
     inc di
     inc di
     int 7ch
     ;loop s

se:
     nop

     mov ax, 4c00h
     int 21h

lop:
     dec cx     ;想想这句可置于jcxz后吗？
     jcxz ed

     ;暂存寄存器
     push bp

     mov bp, sp
     add ss:[bp + 2], bx

     ;恢复寄存器
     pop bp

ed:
     iret

lop_end:
     nop

code ends

end start
```

### 13.14 BIOS 和 DOS 所提供的中断例程

在系统板的ROM中存放着一套程序，称为 **BIOS**（基础输入输出系统）

主要包含以下几部分内容：

- 硬件系统的监测和初始化程序
- 外部中断（15章中详解）和内部中断的中断例程
- 用于对硬件设备进行I/O操作的中断例程
- 其它和硬件系统相关的中断例程

从OS（操作系统）的角度看，DOS的中断例程 就是 OS向coder提供的编程资源。

- **BIOS和DOS** 在所提供的 **中断例程** 中提供了许多实现了程序员在 **编程时所需功能的子程序**。
- 可以用 **int 指令** 可 **直接调用** 它们。

和硬件设备相关的DOS中断例程中，一般都调用了BIOS的中断例程。

### 13.5 BIOS 和 DOS 中断例程的安装过程

- 开机，CPU加电，初始化(CS)=0FFFFH，(IP)=0。
- 自动从**FFFF:0**单元执行程序，此处有一条跳转指令，
- 然后将**跳转**到**BIOS中**的**硬件系统检测**和**初始化程序**。
- 初始化程序建立BIOS所支持的中断变量，即将**BIOS**提供的**中断例程的入口地址登记**在中断向量表中。
    > 注意：对于BIOS所提供的中断例程，只需将入口地址登记入中断向量表即可，因为它们具体程序已被固化在ROM中，在内存中一直存在。
- 硬件系统检测和初始化完成后，调用 **int 19h** 进行**操作系统**的**引导**。
- 自此计算机交给操作系统控制。
- DOS启动后，除完成其它工作外，还将它所提供的中断例程装入内存，并建立相应的中断向量。

### 13.6 BIOS 中断例程应用（例子）

**int 10h 中断例程是 BIOS 提供的**，其中**包含**多个和**屏幕输出相关**的**子程序**。

一般，供程序员调用的中断例程往往包括多个子程序，其内部用传递进来的**参数决定执行哪个子程序**。

**都用 ah** 来传递**内部子程序**的**编号**。

```nasm
assume cs:code

code segment

start:
     ;指使用 int 10h 中断例程的2号子程序——
     ;置光标
     **mov ah, 2**

     mov bh, 0     ;第0页，bh：页号
     mov dh, 5     ;第5行，dh：行号
     mov dl, 12     ;第12列，dl：列号

     **int 10h **    ;调用10h号中断例程

     ;int 10h 9号子程序——
     ;在光标位置显示字符
     **mov ah, 9**

     mov al, 'a'     ;al：显示的字符
     mov bl, 7     ;bl：颜色属性
     mov bh, 0     ;bh：第0页
     mov cx, 3     ;cx：字符重复个数

     **int 10h**

     mov ax, 4c00h
     int 21h

code ends

end start
```

显示缓冲区分为8页，每页4KB，显示器可以显示任一页内容。

一般，显示第0页，即是内存B8000H~B8F9FH的内容。

关于显示缓冲区，详细参考：[Note 6](../asm/asm-learning-note-6.md) 文末的图

### 13.7 DOS 中断例程的应用

**int 21h 中断例程是 DOS 提供的**，其中包含了供程序员编程时调用的子程序。

之前的程序一直以以下语句结尾：

```nasm
mov ax, 4c00h
int 21h
```

使用的是 **int 21h 中断例程**的 **4ch 号子程序**，

**功能**为 **程序返回**，可提供返回值作为参数。

```nasm
mov ah, 4ch     ;4ch号子程序，功能：程序返回
mov al, 0     ;al——返回值
int 21h
```

int 21h 的 9 号子程序　——　在光标位置显示字符串

```nasm
ds:dx　;指向字符串，要显示的字符串需用“$”作为结束符
mov ah, 9
int 21h
```

完整程序

```nasm
assume cs:code

data segment
     db 'Welcome to masm!', '$'
data ends

code segment

start:
     mov ah, 2     ;置光标
     mov bh, 0     ;第0页
     mov dh, 5     ;第5行
     mov dl, 12     ;第12列
     int 10h

     mov ax, data
     mov ds, ax
     mov dx, 0
     mov ah, 9
     int 21h

     mov ax, 4c00h
     int 21h

code ends

end start
```

### 实验 13 编写、应用中断例程

#### Part 1

- 编写并安装 int 7ch中断例程，
    - 功能为显示一个用0结束的字符串，
    - 中断例程安装在0:200处。
- 参数：
    - (dh)=行号，(dl)=列号，
    - (cl)=颜色，ds:si指向字符串首地址

```nasm
assume cs:code

data segment
     db 'Welcome to masm!', 0
data ends

code segment

start:
     ;install
     mov ax, cs
     mov ds, ax
     mov si, offset show_str

     mov ax, 0
     mov es, ax
     mov di, 200h

     mov cx, offset show_end - offset show_str
     cld
     rep movsb

     mov word ptr es:[4 * 7ch], 200h
     mov word ptr es:[4 * 7ch + 2], 0

     ;test
     mov dh, 10     ;row
     mov dl, 10  ;col
     mov cl, 15     ;color

     mov ax, data
     mov ds, ax
     mov si, 0

     int 7ch
     mov ax, 4c00h
     int 21h

show_str:
     ;暂存寄存器
     push ax
     push di
     push es

     mov ax, 0b800h
     mov es, ax

     mov al, 80 * 2
     mul dh
     add al, dl     ;ax + dl * 2
     adc ah, 0
     add al, dl
     adc ah, 0

     mov di, ax

     mov ch, cl

r0:
     cmp byte ptr ds:[si], 0
     je ok

     mov cl, ds:[si]     ;此时 ch & cl = color & char
     mov es:[di], cx     ;此时 es:[di] 内存 为 char & color
     ;在寄存器cx中，低字节的char，放在了内存的低地址中
     ;即8086CPU是小端模式的

     inc     si
     inc di
     inc di
     jmp r0

ok:
     ;恢复寄存器
     pop es
     pop di
     pop ax

     iret

show_end:
     nop

code ends

end start
```

Attachment 附件：[汇编语言第十三章实验13 (1).asm](http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2010/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%89%E7%AB%A0%E5%AE%9E%E9%AA%8C13%20%281%29.asm)

#### Part 2

- 编写并安装 int 7ch 中断例程，功能为完成loop指令的功能
- 参数：(cx)=循环次数 (bx)=位移
- 实现：在屏幕中间显示80个 “**！**”感叹号。

```nasm
assume cs:code

code segment

start:
     ;install
     mov ax, cs
     mov ds, ax
     mov si, offset lop

     mov ax, 0
     mov es, ax
     mov di, 200h

     mov cx, offset lop_end - offset lop
     cld
     rep movsb

     mov word ptr es:[4 * 7ch], 200h
     mov word ptr es:[4 * 7ch + 2], 0

     ;test
     mov ax, 0b800h
     mov es, ax
     mov di, 12 * 160

     mov bx, offset r0 - offset r0_end
     mov cx, 80

r0:
     mov byte ptr es:[di], '!'
     inc di
     inc di
     int 7ch

r0_end:
     nop

     mov ax, 4c00h
     int 21h

lop:
     dec cx
     jcxz ok

     push ax
     push bp

     ;因为sp不是基址寄存器之一，
     ;不能靠直接写ss:[sp]来操作它
     ;才让sp传值给bp，用ss:[bp + n]……

     mov bp, sp
     mov ax, ss:4[bp]
     add ax, bx
     mov ss:4[bp], ax

     pop bp
     pop ax

ok:
     iret

lop_end:
     nop

code ends

end start
```

Attachment 附件：[汇编语言第十三章实验13 (2).asm](http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2010/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%89%E7%AB%A0%E5%AE%9E%E9%AA%8C13%20%282%29.asm)

#### Part 3

下面的程序，分别在屏幕的第 2、4、6、8 行，显示4句英文诗，补全程序：

```nasm
assume cs:code

code segment

s1:     db 'Good,better,bset,', '$'
s2:     db 'Never let it rest,', '$'
s3:     db 'Till good is better,', '$'
s4: db 'And better,best.', '$'
s:     dw offset s1, offset s2, offset s3, offset s4
row:     db 2, 4, 6, 8

start:
     mov ax, cs
     mov ds, ax
     mov bx, offset s
     mov si, offset row
     mov cx, 4

ok:
     ;int 10h中断例程的2号子程序，置光标
     ;bh：页号
     ;dh：行号
     ;dl：列号
     mov dh, **ds:[si]**
     mov dl, 0
     mov ah, 2
     int 10h

     ;int 21h的9号子程序，在光标位置显示字符串
     ;ds:dx 指向字符串，要显示的字符串需用“$”作为结束符
     mov dx, **ds:[bx]**
     mov ah, 9
     int 21h

     inc si
     add bx, 2

     loop ok

     mov ax, 4c00h
     int 21h

code ends

end start
```

Attachment 附件：[汇编语言第十三章实验13 (3).asm](http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2010/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%89%E7%AB%A0%E5%AE%9E%E9%AA%8C13%20%283%29.asm)
