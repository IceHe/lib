# ASM 汇编语言 4

> ASM - Note: 使用栈，将数据、代码、栈放入不同的段，编写并调试具有多个段的程序，以字符形式给出数据，大小写转换问题，\[idata\] 直接寻址，\[bx\] 间接寻址，\[bx + idata\] 相对寻址，SI 和 DI 寄存器。

* Created on 2014-10
* 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章六、包含多个段的程序

程序取得所需空间的方法：

* 在加载程序的时候为程序分配。
* 在执行过程中向系统申请。（本教材不讨论该方法）

### 6.1 在代码段中使用数据

```text
assume cs:code
code segment
          data
          ...
start:  program
          ...
code ends
end start
```

末尾指定程序入口 —— 加载者从程序的可执行文件的描述信息中读到程序的入口地址。

* 指令 `dw 0123h, 0456h, ..., 0987h`
* `dw` 的含义：定义字型数据，即 define word

```text
assume cs:code
code segment
     dw 0123h, 0456h, ..., 0987h
     ...
code ends
end
```

这些数据现在存储于 CS:0~CS:x，以 cs 为基址，偏移得到。

### 6.2 在代码段中使用栈

* 可以使用dw 0, 0, 0, ..., 0的方式，开辟内存空间，
* 然后可以用来存放数据，可以作为栈使用。

```text
assume cs:code

code segment
    dw 0123h, 0456h, ..., 0987h ;（8个字数据）
    dw 0,0,0, ... , 0 ;（16个字数据）
st: mov ax, cs
    mov ss, ax
    mov sp, 30h ;（前面dw使用了24words，共48bytes，即30H bytes）
    ; 这样栈就出现了~
    ...
code ends

end st
```

### 6.3 将数据、代码、栈放入不同的段

把数据、代码、栈等放到一个段：

* 程序显得杂乱
* 如果它们所需的空间超过64KB（8086CPU的限制），就不能放到一个段里面了。

通过定义数据来获取内存空间，定义多个段：

```text
assume cs:code, ds:data, ss:stack

data segment
    dw 0123h, 0456h, ..., 0987h
data ends

stack segment
    dw 0,0,0, ... , 0
stack ends

code segment
start:  mov ax, stack ...
        mov ax, data
        ...
code ends

end start
```

### 实验6 编写、调试具有多个段的程序

Attachment 附件：[实验题5 \(5\).asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%204/%E5%AE%9E%E9%AA%8C%E9%A2%985%285%29.asm)

```text
db 1, 2, 3, 4, 5, ... ; define byte
dw 1ah, 2bh, 3ch, ... ; define word
```

Attachment 附件：[实验题5 \(6\).asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%204/%E5%AE%9E%E9%AA%8C%E9%A2%985%286%29.asm)

* 例：mov ax, \[bx + 200\] 等于 mov ax, \[si +200\] 以及 mov ax, \[di +200\]。

## 章七、更灵活的定位内存地址的方法

### 7.1 and 和 or 指令

* and指令：逻辑与，按位进行与运算。
* or指令：逻辑或，....。

```text
mov al, 01100011B
and al, 00111011B ; 后缀B代表这是二进制串
or  al, 00111011B
```

### 7.2 ASCII

### 7.3 以字符形式给出的数据

可以在汇编程序中，用 'xxxx' 的方式指明数据是以字符的形式给出的，

编译器将把它们转化为相对应的ASCII码。例：

```text
data segment
     db 'unIX'
     db 'foRK'
data ends

code segment
start:
     mov al, 'a'
     mov bl, 'b'
     ...
code ends

end start
```

### 7.4 大小写转换问题

| 字母 | 16进制 | 10进制 | 二进制 |
| :--- | :--- | :--- | :--- |
| A | 41 | 65 | 01000001 |
| … |  |  |  |
| Z | 5A | 90 | 01011010 |
| a | 61 | 97 | 01100001 |
| … |  |  |  |
| z | 7A | 122 | 01111010 |

看得出来大写字母的编码比小写字母小了

* 10000B，即十进制的32，十六进制的20H。

那么大写字母转换成小写字母可以：

```text
mov [bx], 'A'
or [bx], 00100000B
```

那么小写字母转换成大写字母可以：

```text
mov [bx], 'a'
and [bx], 11011111B
```

* \[idata\] 直接寻址
* \[bx\] 间接寻址

### 7.5 \[bx + idata\] 相对寻址

可以用\[bx\]指明一个内存单位，还有更为灵活的方式：

* \[bx + idata\] 。例如，\[bx + 200\]，或 \[200 + bx\]。

### 7.6 用 \[bx + idata\] 的方式进行数组的处理

### 7.7 SI 和 DI（寄存器）

* si和di是8086CPU中和bx功能相近的寄存器，
* si和di不能够分成两个8位寄存器来使用，但bx可以分为bl和bh。

