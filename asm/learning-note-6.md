# ASM 汇编语言 6

> ASM - Note: 转移指令的原理。操作符 offset。以不同寻址方式使用 jmp 指令。jcxz 有条件转移，loop 循环，dec 等指令。编译器对转移位移的超界检测。在屏幕中间显示绿色、绿底红色、白底蓝色的字符串。

- Created on 2014-10
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章九、转移指令的原理

**可以修改IP，或同时修改CS和IP**的指令统称为**转移指令。**

8086CPU的**转移行为**有以下几类：

- 只修改IP时，称为段内转移。如，**jmp ax**。
- 同时修改CS和IP时，称为段间转移。如，**jmp 1000:0**。

由于转移指令对IP的修改范围不同，段内转移又分为：

- **短转移**：**IP的修改范围为-128~127**。
- **近转移**：IP的修改范围为**-32768~32767**。（2的15次方=32768）

8086CPU的**转移指令**分为以下几类：

- 无条件转移指令 （如：jmp）
- 条件转移指令
- 循环指令（如：loop）
- 过程
- 中断

### 9.1 操作符offset

**offset**是由编译器处理的符号，功能是**取得标号的偏移地址**。如：

start: mov ax, offset start

extra：**nop** **指令**

**nop** 指令即“ **空指令** ”，在x86的CPU中机器码为0x90(144)。

- 执行到NOP指令时， **CPU什么也不做** ，
- 仅仅当做一个指令执行过去并继续执行NOP后面的一条指令。
- 所以NOP指令自然也会 **占用执行一个指令的CPU时间片** ，其 **机器码占 1 byte** 。
- 常用于程序延时或精确计时，不过在较快的CPU上不明显。

主要作用：

- **字节** 填充 **对齐**
- 精确 **延时和计时**
- 破解程序的call验证
- **等待** 其他设备执行完毕
- **清除** 由上一个算术逻辑指令设置的 **flag位**
- **辅助jmp、call** 等指令

### 9.2 jmp 指令

它需要给出两种信息：

- 转移的目的地址；

- 转移的距离（段间转移、段内短转移、段内近转移）。

### 9.3 依据位移进行转移的jmp指令

CPU执行 **jmp short** 指令的时候，并不需要转移的目的地址，而是 **要转移的位移** ，

就是执行此指令时的ip，到所要转移到的指令的内存地址的距离。

例：`jmp short start`

段内短转移：`jmp short 标号`（跳转到标号处执行指令）

功能为：( IP ) = ( IP ) + 8 位位移

- 8位位移 = 标号处的地址 - jmp short  **指令后** 的第一个字节的地址；（ 标号，即如，之前常用start ）
- short指明此处的位移为8位位移
- 8位位移范围：-128~127；用补码表示。
- 8位位移由编译程序在编译时算出。

**段内近转移** ： **jmp near ptr**  **标号** （跳转到标号处执行指令）

功能为：（IP）=（IP）+ 16 位位移

- 特征类同上
- 范围为-32768~32767，…

### 9.4 转移的目的地址在指令中的jmp指令

**（CS）** = 标号所在段的 **段地址**

**（IP）** = 标号所在段的 **偏移地址**

**far ptr** 指明 **用标号的段地址和偏移地址修改CS和IP** 。例：

```
-u
...
00BD:0005  **EB** 03           JMP     0008          ; jmp short 标号，用相对位移
00BD:0006  **EA** 0B01BD0B     JMP     0BBD:010B     ; jmp far ptr 标号，用内存地址
... ; 上一条指令的 低地址存偏移地址，高地址存段地址
```

### 9.5 转移地址在寄存器中的jmp指令

- 格式： **jmp 16位reg**
- 功能：（IP） = （16位reg），根据16位reg **修改IP寄存器** （reg） **的内容**
- 例子：jmp ax
- 含义：mov IP, ax

### 9.6 转移地址在内存中的jmp指令

有两种类型：

- **（1）jmp word ptr 内存单元地址（段内转移）**
    - 内存单元地址处，存放着一个word，是转移的目的偏移地址。
    - 例：jmp word ptr ds:[0]
- **（2）jmp dword ptr 内存单元地址（段间转移）**
    - 内存单元地址处，存放着一个dword（两个word），
    - 低地址存偏移地址，高地址存段地址。

### 检测点9.1

- 要使jmp指令之后，CS:IP指向程序的第一条指令，该在data段定义什么数据

```nasm
assume cs:code

data segment
    db 0  ; 在测试时，此处是078A:0000
data ends

code segment
start:  mov ax, data   // 在测试时，此处是078**B**:0010 = 078A:0000，因为078BH * 10H = 078AH * 10H + 10H
        mov ds, ax
        mov bx, 0
        jmp word ptr  1[bx]
        mov ax, 4c00h
        int 21h
code ends

end start
```

- 要使jmp指令之后，CS:IP指向程序的第一条指令，该在MOV [BX]和MOV 2[BX]处补全些什么。

```nasm
assume cs:code

data segment
    dd 12345678H
data ends

code segment
start:  mov ax, data
        mov ds, ax
        mov bx, 0
        mov word ptr [bx], 0
        mov word ptr 2[bx], cs
        jmp dword ptr ds:[0]

        mov ax, 4c00h
        int 21h
code ends

end start
```

### 检测点9.2

补全程序（补全位置为s标号紧接着的四行），利用jcxz指令，实现在内存2000H段中寻找第一个值为0的字节。

```nasm
assume cs:code

code segment

start:  mov ax, 2000H
        mov ds, ax
        mov bx, 0

s:      mov ch, 0
        mov cl, [bx]
        jcxz ok
        inc bx
        jmp short s

ok:     mov dx, bx
        mov ax, 4c00h
        int 21h
code ends

end start
```

### 9.7 jcxz指令： 有条件转移指令。

**所有有条件转移指令，都是短转移** ，在对应的机器码中包含转移的位移，而不是目的地址。对IP的修改范围都是-128~127。

- 指令格式： **jcxz 标号**
- 功能： **当（cx）= 0时** ， **（IP）=（IP）+ 8位位移。**
- 其它：类同jmp short。

### 9.8 loop指令：循环指令，所有的循环指令都是短转移，

其它说明类同上。

- 指令格式：loop 标号
- 功能：
    - `（cx）=（cx）- 1`
    - 当（cx）!= 0时，（IP）=（IP）+ 8位位移。
- 其它：类同 jmp short。

**dec指令** ：与inc指令相反，dec bx功能为 **(bx) = (bx) - 1**

### 检测点9.3

补全程序（加粗的那一行），

利用loop指令， 实现在内存2000H段中寻找第一个值为0的字节。

```nasm
assume cs:code
code segment

start:  mov ax, 2000H
        mov ds, ax
        mov bx, 0

s:      mov ch, 0
        mov cl, [bx]
        inc cx
        inc bx
        loop s

ok:     dec bx
        mov dx, bx
        mov ax, 4c00h
        int 21h
code ends

end start
```

### 9.9 根据位移进行转移的意义

因为这样做，程序无论放在内存哪里，都可以根据相对位移去执行jmp；

一旦写死了跳转地址，那么程序就必须放在指定位置才能正常执行了！

### 9.10  编译器对转移位移的超界检测

根据位移进行转移的指令，它们转移范围有限制，如-128~127。

如果源程序中出现了转移范围超界的问题，编译器会报错。例：

```nasm
start:  jmp short s
          db 128 dup (0)
s:       mov ax, 0ffffh
```

### 实验8 分析一个奇怪的程序

```nasm
assume cs:code

code segment
        mov ax, 4c00h
        int 21h

start:  mov ax, 0

s:      nop
        nop
        mov di, offset s
        mov si, offset s2
        mov ax, cs:[si]
        mov cs:[di], ax

s0:     jmp short s

s1:     mov ax, 0
        int 21h
        mov ax, 0

s2:     jmp short s1 ; jmp short使用的是 相对位移 。二进制编码为：EBF6。F6 表示 -10 的位移。
        nop          ; 当上一句指令 被拷贝到标号s处时，意义就不同了，变成了跳到cs:[0]处了！
code ends            ; 8位位移 = 标号处的地址 - jmp short 指令后的第一个字节的地址
end start
```

### 实验9 根据材料编程

材料比较繁多，最好阅读原书题目。可以增进知识。（后来，下文增加原书材料的相片）

任务：在屏幕中间分别显示绿色、绿底红色、白底蓝色的字符串‘welcome to masm!’。

```nasm
assume cs:code, ds:data, ss:stack

data segment
     db 'welcome to masm!'
     db 27h, 42h, 01h, 13 dup (0)
data ends

stack segment
     dw 8 dup (0)
stack ends

code segment
start: mov ax, stack
       mov ss, ax
       mov sp, 16

       mov ax, data
       mov ds, ax

       mov ax, 0b800h
       mov es, ax

       mov bx, 6e0h ;1760bytes
       mov si, 0
       mov cx, 3

s:     push cx
       mov di, 0
       mov bp, 0
       mov cx, 16

s0:    mov al, ds:[bp]
       mov es:40h[di][bx], al
       mov al, ds:10h[si]
       mov es:41h[di][bx], al

       inc di
       inc di
       inc bp
       loop s0

       pop cx
       add bx, 0a0h
       inc si
       loop s

       mov ax, 4c00h
       int 21h
code ends

end start
```

Attachment 附件：[汇编语言第九章实验9.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%206/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E4%B9%9D%E7%AB%A0%E5%AE%9E%E9%AA%8C9.asm)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%206/Picture.jpeg)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%206/Picture.jpeg)
