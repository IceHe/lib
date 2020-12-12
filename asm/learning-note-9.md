# ASM 汇编语言 9

ASM - Note: 标志寄存器 OF、DF、IF、TF、SF、ZF、AF、PF、CF 及其符号值对应表。adc、sbb、cmp 指令，检测比较结果的条件转移指令 je、jne、jb、jnb、ja、jna。DF 标识和串传送指令，movsb、movsw、rep。pushf 与 popf。将以 0 结尾的字符串中的小写字母转变成大写。

---

- Created on 2014-11
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章十一、标志寄存器

CPU内部有一种特殊的寄存器，具有以下3个作用

- 存储相关指令的某些执行结果
- 为CPU执行相关指令提供行为依据
- 控制CPU的相关工作方式

flag：标志寄存器，16位，按位起作用。

|编号|15|14|13|12|11|10|9|8|7|6|5|4|3|2|1|0|
|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|
|用途|/|/|/|/|OF|DF|IF|TF|SF|ZF|/|AF|/|PF|/|CF|

空出的都是在8086CPU中没有被使用，不具有含义。

### 11.1 ZF 标志

Zero 零标志位：记录相关指令执行后，其结果是否为0。

- 若结果为0，则 zf = 1
- 若结果不为0，则 zf = 0

注意：8086CPU的指令集中，

- 有的指令的执行是影响标志寄存器的，它们大都是运算指令（逻辑或算术运算）。
- 有的则没有影响，如mov、push、pop等，它们大都是传送指令。

### 11.2 PF 标志

Parity 奇偶标志位：记录相关指令执行后，其结果的所有bit位中1的个数是否为偶数。

- 若1的个数为偶数，则 pf = 1
- 若为奇数，pf = 0

### 11.3 SF 标志

Sign 符号标志位：记录相关指令执行后，其结果是否为负。

- 若结果为负，则 SF = 1
- 若结果为正，则 SF = 0 。

### 11.4 CF 标志

Carry 进位标志位：一般情况下，在无符号数运算时，

记录运算结果的最高有效位向更高位的进位值（add），或从更高位的借位值（sub）。

### 11.5 OF 标志

Overflow 溢出标志：在进行有符号数运算时，若结果超过了及其所能表示的范围称为溢出。

- 若发生溢出，则 OF = 1
- 若没有，则 OF = 0

CF 和 OF 的区别：

- CF是对无符号数运算有意义的标志位；
- OF是对有符号数(同上)……

例子：

```nasm
mov al, 98
add al, 99 ; 即98+99
```

- 对于无符号数（8bits，0~255）没有进位，CF = 0 ；
- 对于有符号数（8bits，-128~127）有溢出，OF = 1 。

```nasm
mov al, 0F0H
add al, 88H
```

- 对于unsigned number，即是 240 + 136 ，有进位，CF = 1 ；
- 对于signed，有溢出，即是 -16 + (-120)，OF = 1 。

```nasm
mov al, 0F0H
add al, 78H
```

- 对于unsigned number，即是 240 + 120 ，有进位，CF = 1 ；
- 对于signed，有溢出，即是 -16 + 120 ，OF = 0 。

怎么查看标志寄存器请看见本文文末的11.12节

### 11.6 adc 指令：带进位加法指令，利用CF位上记录的进位值

- 指令格式：同add。
- 功能：operand1 = operand1 + operand2 + CF

adc 指令的用途解析：

加法分两步来进行：

- 低位相加；
- 高位相加再加上低位相加产生的进位值。

例子： 1EF000H + 201000H

- 因为操作数都超过了16位，无法将它完整放到一个16位大小的寄存器中，
- 无法通过add一次得到结果，所以——

```nasm
mov ax, 001EH    ;ax放高16位
mov bx, F000H    ;bx放低16位
add bx, 1000H    ;低位相加
adc ax, 0020H    ;高位相加，再加CF（即低位的进位值）
```

### 11.7 sbb 指令：带借位减法指令，利用CF位上记录的借位值

borrow借位。

- 指令格式：同sub。
- 功能：operand1 = operand1 - operand2 - CF

其用途和意义类似于adc！

### 11.8 cmp 指令：比较指令

功能相当于减法指令，只是不保存结果。

cmp指令执行后，根据计算结果来设置标志寄存器(主要是 zf 和 cf )。

- 格式：cmp oper1, oper2
- 例子：cmp ax, bx

|情况|(ax)-(bx)的结果|标志位情况|
|-|-|-|
|(ax) == (bx)|= 0|zf = 1|
|(ax) != (bx)|!= 0|zf != 0|
|(ax) < (bx)|< 0|cf = 1|
|(ax) <= (bx)|<= 0|cf = 1 or zf = 1|
|(ax) > (bx)|> 0|cf = 0 and zf = 0|
|(ax) >= (bx)|>= 0|cf = 0|

为什么判断(ax)和(bx)的大小关系，看的是 cf 标志位，而不是 sf 呢？

- 因为一般情况下 (ax) - (bx) < 0，即是(ax) < (bx)，sf = 1 ；
- 但是当涉及有符号数的对比时，如34 - (-96) = 130 发生了溢出，
- 结果82H，即-126！sf = 1，但是 (ax) > (bx)。

不过 sf 结合 of 还是可以判断(ax)和(bx)的大小关系的。

- sf = 0 and of = 0 —— (ax) >= (bx)
- sf = 1 and of = 0 —— (ax) <= (bx)
- sf = 0 and of = 1 —— (ax) <= (bx)
- sf = 1 and of = 1 —— (ax) >= (bx)

如果溢出，逻辑上的真正结果必然和实际结果“相反”！

### 11.9 检测比较结果的条件转移指令

条件转移指令通常和cmp相配合使用。

|指令|含义|检测相关标志位|
|-|-|-|
|je|== 等于则转移|zf = 1|
|jne|!= 不等于则..|zf = 0|
|jb|< 低于则..|cf = 1|
|jnb|>= 不低于..|cf = 0|
|ja|> 高于..|cf = 0 and zf = 0|
|jna|<= 不高于..|cf = 1 or zf = 0|

- e —— equal
- b —— below
- a —— above

在使用这些跳转指令前，先用不用cmp指令，由我们决定。

例子：

编程统计data段中，数值大于8的字节的个数，用ax保存统计结果。

```nasm
assume cs:code, ds:data

data segment

        db 0, 2, 1, 4, 7, 3, 5, 9, 6, 8, 10, 12, 15, 14, 13, 11

data ends

code segment

start:  mov ax, data
        mov ds, ax
        mov bx, 0

        mov ax, 0
        mov cx, 16

s:      cmp byte ptr [bx], 8
        jna next
        inc ax

next:   inc bx
        loop s

        mov ax, 4c00h
        int 21h

code ends

end start
```

### 11.10 DF 标识 和 串传送指令

DF ：方向标志位。

它在串处理指令中，控制每次操作后si、di是增是减。

串传送指令： movsb、movsw —— moving string byte / word

movsb (无参数)

功能：相当于以下几步操作。

```nasm
- ((es) * 16 + (di)) = ((ds) * 16 + (si))
- 若df = 0，则 (si) = (si) + 1
                  (di) = (di) + 1
     若df = 1，则 (si) = (si) - 1
                  (di) = (di) - 1
```

用汇编语言描述则是：

```nasm
mov es:[di], byte ptr ds:[si]     ;8086CPU并不支持这样的指令，这里仅仅为描述
if df = 0     inc si     inc di
if df = 1     dec si     dec di
```

movsw (无参数)

功能 用汇编语言描述则是：

```nasm
mov es:[di], word ptr ds:[si]     ;8086CPU并不支持这样的指令，这里仅仅为描述
if df = 0     add si, 2     add di, 2
if df = 1     sub si, 2     sub di, 2
```

一般 movsb / movsw 都和 rep 配合使用：

```nasm
rep movsb
rep movsw
```

用汇编描述就是：

```nasm
s:   movsb
     loop s

s:   movsw
     loop s
```

rep 指令的作用：

根据cx的值，重复执行后面的串传送指令。

然后可以根据flag寄存器的 df 标志，决定传送方向：

- df = 0     从前向后 传送
- df = 1     相反
- cld 指令 —— clear df    ： 将 标志寄存器的df位 ， 置为0。
- std 指令 —— set df      ：将标志寄存器的df位，置为 1。

原书P233（2）编程：

用串传送指令，将F000H段的最后16个字符复制到data段中。

```nasm
assume cs:code

data segment
            db 16 dup (0)
data ends

code segment

start:       mov ax, 0f000h
             mov ds, ax
             mov si, 0ffffh

             mov ax, data
             mov es, ax
             mov di, 15

             std
             mov cx, 16
             rep movsb

             mov ax, 4c00h
             int 21h
code ends

end start
```

### 11.11 pushf 和 popf

- pushf 指令：将标志寄存器的值压栈。
- popf  指令：从栈中弹出数据，送入标志寄存器中。

### 11.12 标志寄存器在Debug中的表示

用debug.exe查看当前标志寄存器的标志位值？

用R指令，得到的信息右下角： NV   UP   EI   PL   NZ   NA   PO   NC

这些符号代表的就是标志寄存器里常用标志位的值。

标志位寄存器，符号值对应表

|标志|值为1的标记|值为0的标记|
|-|-|-|
|溢出标志OF(Over flow flag)|OV|overflow|NV|
|方向标志DF(Direction flag)|DN|down|UP|
|中断标志IF(Interrupt flag)|EI|DI|/|
|符号标志SF(Sign flag)|NG|negative|PL positive|
|零标志ZF(Zero flag)|ZR|zero|NZ not zero|
|辅助标志AF(Auxiliary carry flag)|AC|assist|NA|
|奇偶标志PF(Parity flag)|PE even|PO odd|/|
|进位标志CF(Carry flag)|CY carry|NC not carry|/|

### 实验 11 编写子程序

- 名称：letterc
- 功能：将以0结尾的字符串中的小写字母转变成大写字母。
- 参数：ds:si指向字符串首地址。
- 源码：

```nasm
assume cs:code, ds:data

data segment
     db "Beginner's All-purpose Symbolic Instruction Code.", 0
data ends

code segment

;letterc: 将以 0 结尾的字符串中的小写字母转换成大写
;参数：    ds:di 指向字符串首地址
;返回：    无

letterc:
     ;暂存寄存器
     pushf
     push ax

     mov ah, 0     ;!!!错误，jcxz测试的是cx是否为0！

     r0:
          mov al, ds:[di]     ;!!!错误，jcxz测试的是cx是否为0！
          jcxz ok

          ;ascii: 61h - a, 7ah - z
          cmp al, 61h
          jb next
          cmp al, 7ah
          ja next

          and byte ptr ds:[di], 11011111b

     next:
          inc di
          jmp r0
     ok:

     ;恢复寄存器
     popf
     pop ax

     ret

start:
     mov ax, data
     mov ds, ax
     mov si, 0

     call letterc

     mov ax, 4c00h
     int 21h

code ends

end start
```

Attachment 附件：[汇编语言第十一章实验9.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%208/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%80%E7%AB%A0%E5%AE%9E%E9%AA%8C9.asm)

实验asm中有错：

- jcxz测试的是cx是否为0！
- 实验代码中，ah/al应改为ch/cl！
