# ASM 汇编语言 14

> ASM - Note: 直接定址表。数据标号、地址标号。在其它段中，使用数据标号。写子程序计算 sin(x)。实现子程序 setscreen，为显示输出提供指定功能。

- Created on 2014-11
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章十六、直接定址表

### 16.1 描述了单元长度的标号——数据标号

- 以下程序中，code、a、b、start、s（后面带冒号“:”）

都是地址标号，仅表示内存单元的地址。

```nasm
assume cs:code

code segment
a:     db 1, 2, 3, 4, 5, 6, 7, 8
b:     dw 0

start:
     mov si, offset a
     mov bx, offset b

     mov cx, 8

c0:
     mov al, cs:[si]
     mov ah, 0
     add cs:[bx], ax
     inc si
     loop c0
     mov ax, 4c00h
     int 21h

code ends

end start
```

- 另一种——数据标号

不但表示内存单元的地址，还表示其长度，

无论是byte/word/dword。

如以下程序中的a、b标号，后面没跟“:”冒号。

```nasm
assume cs:code

code segment
a     db 1, 2, 3, 4, 5, 6, 7, 8
b     dw 0

start:
     mov si, 0
     mov cx, 8

c0:
     mov al, cs:[si]
     mov ah, 0
     add b, ax
     inc si
     loop c0
     mov ax, 4c00h
     int 21h

code ends

end start
```

以上a、b这种标号的使用示例如下：

```nasm
mov ax, b     =     mov ax, cs:[8]
mov b, 2      =     mov word ptr cs:[8]
inc b         =     inc word ptr cs:[8]

mov al, a[si]     =     mov al, cs:0[si]
mov al, a[3]      =     mov al, cs:0[3]
```

这句会引发编译错误！—— mov al, b 或 mov b, al

### 检测点1.6

将a处的8个数据累加，结果存储到b处的双字中，补全程序。

```nasm
assume cs:code

code segment
a     dw 0fff1h, 0fff2h, 0fff3h, 0fff4h, 0fff5h, 0fff6h, 0fff7h, 0fff8h
b     dd 0

start:
     mov si, 0
     mov cx, 8

c0:
     mov ax, a:[si]
     ;下一句可简化为 add word ptr b, ax     add word ptr b[0], ax
     adc word ptr b[2], 0
     inc si
     inc si
     loop c0
     mov ax, 4c00h
     int 21h

code ends

end start
```

### 16.2 在其它段中，使用数据标号

地址标号（带冒号后缀）：

只能在代码段中使用，不能在其它段使用。

     >>assume的作用：

若想在代码段中直接用数据标号访问数据，

则需要用伪指令assume，

将标号所在的段和段寄存器联系起来。

否则编译时，无法确定标号的段地址在哪一个寄存器中。

（下文实例详细说明）

此种联系是编译器需要的，

但段寄存器实际上不一定会真的存放该段的地址。

还要用指令对段寄存器进行设置。

（例）

```nasm
assume cs:code, ds:data

data segment
     a db 1, 2, 3, 4, 5, 6, 7, 8
     b dw 0
data ends

code segment

start:
     mov ax, data
     mov ds, ax

     mov si, 0
     mov cx, 8

c0:
     mov al, a[si]
     mov ah, 0
     add b, ax

     inc si
     loop c0

     mov ax, 4c00h
     int 21h

code ends

end start
```

已有assume ..., ds:data

但是还要

```nasm
mov ax, data
mov ds, ax
```

然后以下就是assume ds:data对编译实际的影响：

mov al, a[si] 编译为 mov al, [si+0]

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2013/e8c800492bf9619ab7e61184592c770c.png)

add b, ax 编译为 add [8], ax

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2013/488a2b294983eb6c4dc88d71380790e8.png)

当删除以上源程序中assume ..., ds:data中的ds:data后，

用masm编译时，会产生错误，报错信息如下：

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%2013/18512c4d794b8a6c2c7ed46b68c9bcf7.png)

t.asm(14)是这一句：mov al, a[si]

编译程序不知道标号在哪里了！

当然可将以下语句移到 code segment（段）中，

就可顺利编译，但原理必须明白！：

     a db 1, 2, 3, 4, 5, 6, 7, 8

     b dw 0

标号可以作为数据来定义！

```nasm
data segment

     a db 1, 2, 3, 4, 5, 6, 7, 8

     b dw 0

     c dw a, b     ;相当于 c dw offset a, offset b

     d dd a, b     ;相当于 d dw offset a, seg a, offset b, seg b

data ends
```

### 16.3 直接定址表

根据我的理解，就像数组。

实例如下：

```nasm
assume cs:code

code segment

start:
     mov ax, 2bh
     call showbyte

     mov ax, 4c00h
     int 21h

showbyte:
     jmp short show
     table db '0123456890ABCDEF'     ;字符表

show:
     push bx
     push cx
     push es

     mov ah, al;
     mov cl, 4
     shr ah, cl     ;ah得到原al的高4位
     and al, 00001111b     ;al得到原al的低4位

     mov bl, ah
     mov bh, 0
     mov ah, table[bx]

     mov bx, 0b800h
     mov es, bx
     mov es:[160 * 12 + 40 * 2], ah

     mov bl, al
     mov bh, 0
     mov al, table[bx]

     mov es:[160 * 12 + 40 * 2 + 2], al

     pop es
     pop cx
     pop bx
     ret

code ends

end start
```

在以上程序中，我们在（1byte大小的）数值 0~15

和 字符 “0” ~ “F”（16进制表示法）之间建立的映射关系为：

以数值N为table表中的偏移，可以找到对应字符。

利用表，建立两个数据集之间的一种映射关系，

根据给出的数据，得到另一数据集对应的数据，目的是：

- 为了算法的清晰和简洁；

- 加快运算速度；

- 使程序易于扩充。

编程：写一个子程序，计算sin(x)，

- x属于{0, 30, 60, 90, 120, 150, 180}集合（单位：度）。
- 如，sin(30)结果显示为“0.5”。

```nasm
assume cs:code

code segment

start:
     mov al, 255
     call showsin

     mov ax, 4c00h
     int 21h

showsin:
     jmp short show
     ;字符串偏移地址表
     table dw s0, s30, s60, s90, s120, s150, s180
     s0          db '0', 0
     s30          db '0.5', 0
     s60          db '0.866', 0
     s90          db '1', 0
     s120     db '0,866', 0
     s150     db '0.5', 0
     s180     db '0', 0

show:
     push bx
     push es
     push si

     mov bx, 0b800h
     mov es, bx

     ;以下用“角度值/30”作为table的偏移，
     ;取得对应字符串的偏移地址，置于bx中
     mov ah, 0
     mov bl, 30
     div bl
     mov bl, al     ;高字节ah存余，低字节al存商
     mov bh, 0
     add bx, bx     ;偏移地址为word型，以bx * 2以对应地址
     mov bx, table[bx]

     ;以下显示sin(x)对应的字符串
     mov si, 160 * 12 + 40 * 2

shows:
     mov ah, cs:[bx]
     cmp ah, 0
     je ok

     mov es:[si], ah
     inc bx
     inc si
     inc si
     jmp short shows

ok:
     pop si
     pop es
     pop bx
     ret

code ends

end start
```

角度值没有检测，可能超范围（0~180），真实编程需要检测。

Attachment 附件：[汇编语言第十六章16.3例.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%2013/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%85%AD%E7%AB%A016.3%E4%BE%8B.asm)

### 16.4 程序入口地址的直接定址表

可以在直接定址表中存储子程序的地址，

从而方便地实现不同子程序的调用。

编程：实现一个子程序setscreen，为显示输出提供如下功能：

- 清屏；
- 设置前景色；
- 设置背景色；
- 向上滚动一行。

入口参数说明如下：

- a. 用ah寄存器传递功能号：
    - 0表示以上功能（1）清屏，
    - 1表示（2），2表示（3），3表示（4）。
- b. 对于功能（2）、（3），用al传递颜色值，
    - (al)属于{0, 1, 2, 3, 4, 5, 6, 7}范围。

下面是实现思路：

- 清屏：将屏幕字符设置为空格；
- 前景色：设置屏幕字符属性字节的第0、1、2位；
- 背景色：设置屏幕字符属性字节的第4、5、6位；
- 向上滚一行：依次将第n + 1行复制到第n行处，最后一行置空。

源代码：

```nasm
assume cs:code

code segment

start:
     mov ah, 3
     mov al, 3
     call setscreen

     mov ax, 4c00h
     int 21h

setscreen:
     jmp short set
     table dw sub1, sub2, sub3, sub4

set:
     push bx

     cmp ah, 3
     ja sret

     mov bl, ah
     mov bh, 0
     add bx, bx

     call word ptr table[bx]     ;调用对应的功能子程序

sret:
     pop bx
     ret

sub1:
     push bx
     push cx
     push es

     mov bx, 0b800h
     mov es, bx
     mov bx, 0

     mov cx, 2000

sub1c0:
     mov byte ptr es:[bx], ' '
     inc bx
     inc bx
     loop sub1c0

     pop es
     pop cx
     pop bx
     ret

sub2:
     push bx
     push cx
     push es

     mov bx, 0b800h
     mov es, bx
     mov bx, 1

     mov cx, 2000

sub2c0:
     and byte ptr es:[bx], 11111000b
     or es:[bx], al
     inc bx
     inc bx
     loop sub2c0

     pop es
     pop cx
     pop bx
     ret

sub3:
     push bx
     push cx
     push es

     mov cl, 4
     shl al, cl

     mov bx, 0b800h
     mov es, bx
     mov bx, 1

     mov cx, 2000

sub3c0:
     and byte ptr es:[bx], 10001111b
     or es:[bx], al
     inc bx
     inc bx
     loop sub3c0

     pop es
     pop cx
     pop bx
     ret

sub4:
     push cx
     push ds
     push si
     push es
     push di

     mov si, 0b800h
     mov ds, si
     mov es, si

     mov si, 160
     mov di, 0
     cld

     mov cx, 24

sub4c0:
     push cx

     mov cx, 160
     rep movsb

     pop cx
     loop sub4c0

     mov cx, 80
     mov si, 0

sub4c1:
     mov byte ptr es:[160 * 24 + si], ' '
     inc si
     inc si
     loop sub4c1

     pop di
     pop es
     pop si
     pop ds
     pop cx
     ret

code ends

end start
```

Attachment 附件：[汇编语言第十六章16.4例.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%2013/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%85%AD%E7%AB%A016.4%E4%BE%8B.asm)

### 实验 16 编写包含多个功能子程序的中断例程

功能：安装一个新的int 7ch 中断例程，为显示输出提供如下功能子程序：

- 清屏；
- 设置前景色；
- 设置背景色；
- 向上滚动一行。

入口参数说明如下：

- 用ah寄存器传递功能号：0表示清屏，
    - 1表示设置前景色，2表示设置背景色，
    - 3表示向上滚动一行；
- 对于2、3号功能，用al传送颜色值，
    - (al)属于{0,1,2,3,4,5,6,7}

代码：

```nasm
;安装int 7ch中断例程

assume cs:code

code segment

start:
     ;install int 7ch
     push cs
     pop ds
     mov si, offset set_screen

     mov ax, 0
     mov es, ax
     mov di, 200h

     mov cx, offset s_s_end - offset set_screen
     cld
     rep movsb

     cli
     mov word ptr es:[7ch * 4], 200h
     mov word ptr es:[7ch * 4 + 2], 0
     sti
     mov ax, 4c00h
     int 21h

set_screen:
     jmp short sel_sub

table:
     dw offset sub0 - offset set_screen + 200h, offset sub1 - offset set_screen + 200h, offset sub2 - offset set_screen + 200h, offset sub3 - offset set_screen + 200h

sel_sub:
     cmp ah, 3
     ja end_sub

     push bx
     push es

     mov bx, 0
     mov es, bx

     mov bh, 0
     mov bl, ah
     add bx, bx     ;千万记得将bx加倍！
                    ;以对应table中储存子程序入口地址的偏移量

cal_add:
     call word ptr es:[bx][offset table - offset set_screen + 200h]

end_sub:
     pop es
     pop bx
     iret

sub0:
     push bx
     push cx
     push es

     mov bx, 0b800h
     mov es, bx
     mov bx, 0

     mov cx, 25 * 80

sub0c0:
     mov byte ptr es:[bx], ' '
     inc bx
     inc bx
     loop sub0c0

     pop es
     pop cx
     pop bx
     ret

sub1:
     cmp al, 7     ;对于输入的(al)颜色参数，
     ja sub1_ok     ;第一种处理方式，检测范围
     push bx
     push cx
     push es

     mov bx, 0b800h
     mov es, bx
     mov bx, 1

     mov cx, 25 * 80

sub1c0:
     and byte ptr es:[bx], 11111000b
     or byte ptr es:[bx], al
     inc bx
     inc bx
     loop sub1c0

     pop es
     pop cx
     pop bx

sub1_ok:
     ret

sub2:
     push bx
     push cx
     push es

     and al, 00000111b     ;对于输入的(al)颜色参数，
                              ;第二种处理方式，清除超过范围的部分
     mov cl, 4
     shl al, cl

     mov bx, 0b800h
     mov es, bx
     mov bx, 1

     mov cx, 25 * 80

sub2c0:
     and byte ptr es:[bx], 10001111b
     or byte ptr es:[bx], al
     inc bx
     inc bx
     loop sub2c0

     pop es
     pop cx
     pop bx
     ret

sub3:
     push bx
     push cx
     push ds
     push es

     mov bx, 0b80ah     ;之前错写成0b8a0h了！仔细领悟一下！
          ;之所以偏移的行数过多，因为ds:[bx] = ds * 16 + bx！
     mov ds, bx
     mov bx, 0b800h
     mov es, bx
     mov bx, 0

     mov cx, 24 * 80

sub3c0:
     push ds:[bx]
     pop es:[bx]
     inc bx
     inc bx
     loop sub3c0

     mov cx, 80

sub3c1:
     mov byte ptr es:[bx], ' '
     inc bx
     inc bx
     loop sub3c1

     pop es
     pop ds
     pop cx
     pop bx
     ret

s_s_end:
     nop

code ends

end start
```

Attachment 附件：[汇编语言第十六章实验16.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%2013/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%85%AD%E7%AB%A0%E5%AE%9E%E9%AA%8C16.asm)

```nasm
;测试程序

assume cs:code

code segment

start:
     ;test
     mov ah, 0
     ;mov al, 3
     int 7ch
     mov ax, 4c00h
     int 21h

code ends

end start
```

Attachment 附件：[汇编语言第十六章实验16测试程序.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%2013/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%85%AD%E7%AB%A0%E5%AE%9E%E9%AA%8C16%E6%B5%8B%E8%AF%95%E7%A8%8B%E5%BA%8F.asm)

```nasm
;sub3的更优写法：

sub3:
     push cx
     push di
     push ds
     push es
     push si

     mov si, 0b800h
     mov ds, si
     mov es, si

     mov si, 160
     mov di, 0

     mov cx, 24 * 160
     cli
     rep movsb

     mov cx, 80

sub3c1:
     mov byte ptr es:[di], ' '
     inc di
     inc di
     loop sub3c1

     pop si
     pop es
     pop ds
     pop di
     pop cx
     ret
```
