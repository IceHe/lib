# ASM 汇编语言 5

> ASM - Note: reg 寄存器，sreg 段寄存器。bx，si，di 和 bp。汇编语言中数据位置的表达，寻址方式。除法指令，伪指令 dd，dup 操作符。寻址方式对结构化数据的访问。

- Created on 2014-10
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章八、数据处理的两个基本问题

- 处理的数据在什么地方？
- 要处理的数据有多长？

reg寄存器：

- ax、bx、cx、dx，
- ah、al、bh、bl、ch、cl、dh、dl，
- sp、bp、si、di。

sreg（segment register）段寄存器：

- ds、ss、cs、es

reg、sreg 详见 [Note 2](../asm/learning-note-2.md)

### 8.1 bx，si，di 和 bp

- 8086CPU中，只有这4个寄存器可以用在”[...]“中来进行内存单元的寻址。
- 在 [...] 中，这4个寄存器可以单个出现，或**只能以4种组合出现**：
    - bx + si、bx + di、bp + si 和 bp + di。
- 只要在 [...] 中**使用寄存器bp**，而指令中**没有显性地给出段地址**，**段地址就默认在ss中**。

### 8.2 机器指令处理的数据在什么地方

绝大部分的**机器指令**都是进行**数据处理的指令**，大致可**分为 3 类：读取、写入、运算**。

机器指令不关心数据的值，而关心指令执行前一刻，它要处理的数据的位置。

**数据**可以**在** 3 个地方：**CPU内部、内存、端口**（端口以后详述）。

### 8.3 汇编语言中数据位置的表达

立即数（idata）

- 即是，直接包含在机器指令中的数据（执行前在CPU的指令缓冲器中）。
- 例： 1     2000h     00010000b     ‘abc’

寄存器：ax、ss

段地址（SA）和 偏移地址（EA）

- 例：[0]     [bx]     [bx+si]     [bp+di+8]

### 8.4 寻址方式

详见 [Note 2](../asm/learning-note-4.md) 7.5 开始的地方

### 8.5 指令要处理的数据有多长

8086CPU的指令，可以处理两种尺寸的数据，byte和word。

机器指令中，要指明是 字操作 或 字节操作。

汇编语言判断操作数据长度的办法如下：

- 通过寄存器名指明：

    ```nasm
    mov bx, ds:[0] ; bx寄存器是两字节的，字操作
    mov al, 1      ; al寄存器是一字节的，字节操作
    ```

- 没有寄存器名的情况下，用操作符 “ **X ptr **”指明内存单元的长度，在汇编指令中，**X可以为word或byte**。

    ```nasm
    mov word ptr ds:[0], 1
    inc byte ptr ds:[0]
    add byte ptr [bx], 8
    ```

- 其它

    - 有些指令默认了访问的是word字单元还是byte字节单元。
    - push [1000h] 操作的是word字单元，因为**push指令只进行word字操作**

### 8.7 div指令：除法指令。

- 除数：有8位和16位两种，在一个reg或内存单位中。

- 被除数：默认 **只放在AX** 或 **放在DX和AX **中。

        - 如果**除数为8位，则被除数为16位**，且默认**在AX中**存放；
        - 如果**除数为16位，则被除数为32位**，且在DX和AX中存放，**DX放高16位，AX放低16位**。

- 计算结果：

    - 如果**除数为8位**，则**AL存储**除法操作的**商**，**AH存储**除法操作的**余数**；
    - 如果除数**为16位**，则**AX**存储除法操作的**商**，**DX**存储除法操作的**余数**。
    - 例：100001 除以 100—— 因为被除数大于65535=2^16，那么除数100要用16位来存：

        ```nasm
        mov dx, 1
        mov ax, 86a1h ; dx * 10000H + ax = 186A1H = 10001
        mov bx, 100
        div bx        ; div 指令跟着的只有一个参数，是除数
        ```

### 8.8 伪指令 dd

- db 定义byte字节型数据。
- dw 定义word字型数据。
- **dd 定义dword双字型数据。（double word）**

### 8.9 dup操作符

在汇编语言中，**dup**同**db，dw，dd**等一样，也是**由编译器识别处理的符号**。

例：

```nasm
db 3 dup (0)       ; 定义3个字节，每个都是0，相当于 db 0, 0, 0
db 3 dup (0, 1, 2) ; 定义9个字节，它们是0, 1, 2, 0, 1, 2, 0, 1, 2。
```

n为重复的次数

```nasm
db  n  dup ;（重复的byte型data）
dw  n  dup ;（重复的word型data）
dd  n  dup ;（重复的dword型data）
```

### 实验7 寻址方式在结构化数据访问中的应用

题目要求请看原书：

```nasm
assume cs:code, ds:data

data segment
        db '1975', '1976', '1977', '1978', '1979', '1980', '1981', '1982', '1983'
        db '1984', '1985', '1986', '1987', '1988', '1989', '1990', '1991', '1992'
        db '1993', '1994', '1995'
        ;  以上是表示年的个字符串

        dd 16, 22, 382, 1356, 2390, 8000, 16000, 24486, 50065, 97479, 140417, 197514
        dd 345980, 590827, 803530, 1183000, 1843000, 2759000, 3753000, 4649000, 5937000
        ;  以上是表示年公司总收入的  dword 型数据

        dw 3, 7, 9, 13, 28, 38, 130, 220, 476, 778, 1001, 1442, 2258, 2793, 4037, 5635, 8226
        dw 11542, 14430, 15257, 17800
        ;  以上是表示年公司雇员人数的个  word 数据
data ends

table segment
        db 21 dup ('year summ ne ?? ')
table ends

code segment
start:  mov ax, data
        mov ds, ax

        mov ax, table
        mov es, ax

        mov bx, 0
        mov di, 0
        mov si, 0
        mov cx, 21

s:      mov ax, ds:[bx]
        mov es:[di], ax
        mov ax, ds:2[bx]
        mov es:2[di], ax

        mov ax, ds:84[bx]
        mov es:5[di], ax
        mov ax, ds:86[bx]
        mov es:7[di], ax

        mov ax, ds:168[si]
        mov es:10[di], ax

        mov ax, es:5[di]
        mov dx, es:7[di]
        div word ptr es:10[di]
        mov es:13[di], ax

        add bx, 4
        add di, 16
        inc si
        inc si

        loop s

        mov ax, 4c00h
        int 21h
code ends

end start
```

Attachment 附件：[汇编语言第八章实验7.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%205/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%85%AB%E7%AB%A0%E5%AE%9E%E9%AA%8C7.asm)
