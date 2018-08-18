# ASM 汇编语言 7

> ASM - Note: 以不同的寻址方式使用 call 指令。call 和 ret 的配合使用。mul 指令。模块化程序设计：显示字符串（指定位置、颜色）、解决除法溢出的问题、数值显示。

- Created on 2014-10
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章十、CALL和RET指令

### 10.1 ret和retf

- **ret**指令：**用栈中的数据**，**修改IP**的内容，从而实现**近转移**
- **retf**指令：用**栈**中的**数据**，修改**CS和IP**的内容，从而实现**远**转移

执行**ret**指令的两步操作：

- (IP) =  ((SS) * 16 + (SP))
- (SP) = (SP) + 2

相当于：**pop IP**

执行**retf**指令的四步操作：

- (IP) = ((SS) * 16 + (SP))
- (SP) = (SP) + 2
- (CS) = ((SS) * 16 + (SP))
- (SP) = (SP) + 2

相当于：

```nasm
pop ip
pop cs
```

### 10.2 call指令

CPU执行call指令时，进行两步操作：

- 将当前的 **“IP” 或者 “CS和IP同时”  压入栈**中
- 转移

call指令**不能实现短转移**。

它实现转移的方法与**jmp原理相同**。

### 10.3 依据位移进行转移的call指令

**call 标号**（将当前的IP压栈后，转到标号处执行指令）

使用该指令时，CPU进行如下操作：

```nasm
; (1)
(sp) = (sp) - 2
((ss) * 16 + (sp)) = (ip)

; (2)
(ip) = (ip) + 16位位移
```

- 16位位移 = 标号处的地址 - call**指令后的**第一个字节的地址
- 16位位移的范围：-32768~32767，用补码表示

它由编译程序在编译时算出。

相当于：pop IP

```nasm
jmp near ptr 标号
```

### 10.4 转移的（根据）目的地址在指令中的call指令

“**call far ptr 标号**”实现的是**段间转移**。

使用该指令时，CPU进行如下操作：

```nasm
; (1)
(sp) = (sp) - 2
((ss) * 16 + (sp)) = (**cs**)
(sp) = (sp) - 2
((ss) * 16 + (sp)) = (**ip**)

; (2)
(ip) = 标号所在段的段地址
(cs) = 标号所在段中的偏移地址
```

相当于：push cs

```nasm
push ip
jmp far ptr 标号
```

（以上的两个自然段，之后不会再记这么拖拉重复的笔记方式，要更精简一点）

### 10.5 转移地址在寄存器中的call指令

call 16位reg

相当于：

```nasm
push ip
jmp 16位reg
```

### 10.6 转移地址在内存中的call指令

> **call word ptr** 内存单元地址

相当于：

```nasm
push ip
jmp word ptr 内存单元地址
```

> **call dword ptr** 内存单元地址

相当于：

```nasm
push cs
push ip
jmp word ptr 内存单元地址
```

### 10.7 call 和 ret 的配合使用

**具有子程序的源程序的框架**如下：

```nasm
assume cs:code

code segment
main:   ...
        call sub1
        ...
        mov ax, 4c00h
        int 21h

sub1:   ...
        call sub2
        ...
        ret

sub2:   ...
        ret

code ends

end main
```

### 10.8 mul 指令

> **MUL 乘法指令**, 使用它时请注意：

两个相乘的数：都是8位的长度，或都是16位的。

- 如果是8位，一个默认放在AL中，另一个放在8位reg或内存byte字节单元中；
- 如果是16位，一个默认放在AX中，另一个放在16位reg或内存word字单元中。

乘积：

- 如果是8位乘法，结果默认放在AX中；

- 如果是16位乘法，结果的高位放在DX中， 低位放在AX中。

例：

```nasm
mul reg
mul 内存单元
mul byte ptr ds:[0]
mul word ptr [bx+si+8]
```

### 10.9 模块化程序设计

由call和ret支持

### 10.10 参数和结果传递的问题

### 10.11 批量数据的传递

### 10.12 寄存器冲突的问题

（这一节的书本内容不错，看原书方便，做笔记不便利。）

其本质：

- 用栈保存子程序要使用的寄存器。
- **先push该子程序要使用的寄存器的内容，用完后再pop回原寄存器处。**

例：

```nasm
;  保存子程序要使用的寄存器的原内容
capital: push cx
         push si

; 将以 '0' 为终结符的字符串的每个字符转换为大写
change:  mov cl, [si]
         mov ch, 0
         jcxz ok
         and byte ptr [si], 11011111b
         inc si
         jmp short change

; 恢复子程序使用过的寄存器的原内容
ok:      pop si
         pop cx

         ret
```

### 实验10 编写子程序

#### 1.显示字符串（指定位置、颜色）

- 功能：在指定的位置，用指定的颜色，显示一个用0结束的字符串。
- 参数：(dh)=行号 0~24，(dl)=列号 0~79，(cl)=颜色，ds:di指向字符串的首地址。
- 返回：无

```nasm
assume cs:code, ds:data

data segment
        db 'Welcome to masm!',0
data ends

code segment

start:
        mov ax, data
        mov ds, ax      ; 数据段位置
        mov si, 0       ; 字符串首地址
        mov dh, 8       ; 行
        mov dl, 3       ; 列
        mov cl, 2       ; 颜色

        call show_str
        mov ax, 4c00h
        int 21h

show_str:
        ; 保存寄存器的数据
        push es
        push di
        push bx
        push ax

        ; 求出目的行的偏移量
        mov al, 0a0h
        mul dh
        mov bx, ax      ; bx 目标行的偏移量

        ; 求出目的列的偏移量
        mov al, 2
        mul dl
        mov di, ax      ; di 目标列的偏移量
        mov ax, 0b800h
        mov es, ax      ; es 显示区内存位置
        mov ah, cl      ; ah 另存颜色

s:      cmp byte ptr ds:[si], 0
        je e
        mov al, ds:[si]
        mov es:[bx][di], ax
        inc si
        inc di
        inc di
        jmp s

e:      ; 恢复寄存器的数据
        pop ax
        pop bx
        pop bp
        pop es
        ret

code ends

end start
```

参照了 [Note 6 实验 9](../asm/learning-note-6.md#实验9-根据材料编程)

Attachment 附件：[汇编语言第十章实验10.1.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%207/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E7%AB%A0%E5%AE%9E%E9%AA%8C10.1.asm)

#### 2.解决除法溢出的问题

- 功能

    - 进行不会产生溢出的除法运算
    - 被除数为dword型，除数为word型，结果为dword型。

- 参数

    - (ax)=dword型数据的 被除数的 低16位
    - (dx)= dword型数据的 被除数的高 16位
    - (cx)= word型 除数

- 返回

    - (dx)=结果的高16位
    - (ax)=结果的低16位
    - (cx)=余数

- 例如：1000/1 的8位除法 或 11000/1 的16位除法

    - 它们的商无法放入 al 或 ax 中，导致溢出。

- 解法：

```nasm
assume cs:code

code segment

start:
        ; 计算 10000/10
        mov ax, 4240h   ; 10000 = F4240H
        mov dx, 0fh
        mov cx, 0ah     ; 10 = 0AH

        call divdw
        mov ax, 4c00h
        int 21h

divdw:
        ; 保存寄存器的数据
        push bx

        ; X/N = int(H/N) * FFFFH + [rem(H/N) * FFFFH + L] / N
        ; X 是被除数，N 是除数，H 是被除数高位，L 是被除数低位；
        ; * FFFFH  是左移位，  int(x/n) 是商， rem(x/n)  是余数。

        push ax         ; 暂存被除数低位

        mov ax, dx      ; dx 被除数高位
        mov dx, 0
        div cx
        mov bx, ax      ; 暂存被除数高位被除的商
                        ; dx 被除数高位被除的余数

        pop ax          ; 恢复被除数低位
        div cx

        mov cx, dx      ; 余数放在指定位置  cx
        mov dx, bx      ; 恢复被除数高位被除的商

        ;  恢复寄存器的数据
        pop bx
        ret

code ends

end start
```

Attachment 附件：[汇编语言第十章实验10.2.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%207/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E7%AB%A0%E5%AE%9E%E9%AA%8C10.2.asm)
 </div>

#### 3.数值显示

- 功能：将word型数据转变成表示十进制数的字符串，字符串以0为结尾符。
- 参数： (ax)=word型数据，ds:si指向字符串的首地址。
- 返回：无
- 应用：
    - 编程，将数据12666以十进制的形式在屏幕的8行3列，用绿色显示出来。
    - 显示时，使用本次实验的第一个子程序 show_ptr（见上文）。

```nasm
assume cs:code

data segment
        db 10 dup (0)
data ends

code segment

start:
        ;  显示
        mov ax, 12666
        mov bx, data
        mov ds, bx
        mov si, 0
        call dtoc

        mov dh, 8
        mov dl, 3
        mov cl, 2
        mov si, 0
        call show_str

        mov ax, 4c00h
        int 21h

dtoc:
        ;  保存寄存器的数据
        push bx
        push cx
        push dx
        mov cx, 0

s3:     mov dx, 0
        mov bx, 10
        div bx
        add dx, 30h     ;  转换为 ASCII 码
        push dx         ;  暂存入栈

        inc cx          ;  统计要显示几个字符
        cmp ax, 0
        jne s3

ss3:    pop ds:[si]
        inc si
        loop ss3
        mov byte ptr ds:[si], 0 ;  写入字符串的结尾符

e3:     ;  恢复寄存器的数据
        pop dx
        pop cx
        pop bx
        ret

show_str:
        ;  保存寄存器的数据
        push es
        push di
        push bx
        push ax

        ;  求出目的行的偏移量
        mov al, 0a0h
        mul dh
        mov bx, ax      ;bx  目标行的偏移量

        ;  求出目的列的偏移量
        mov al, 2
        mul dl
        mov di, ax      ;di  目标列的偏移量

        mov ax, 0b800h
        mov es, ax      ;es  显示区内存位置

        mov ah, cl      ;ah  另存颜色

s2:     cmp byte ptr ds:[si], 0
        je e2
        mov al, ds:[si]
        mov es:[bx][di], ax
        inc si
        inc di
        inc di
        jmp s2

e2:     ;  恢复寄存器的数据
        pop ax
        pop bx
        pop bp
        pop es
        ret

code ends

end start
```

Attachment 附件：[汇编语言第十章实验10.3.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%207/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E7%AB%A0%E5%AE%9E%E9%AA%8C10.3.asm)
