# ASM 汇编语言 8

> ASM - Note: 将第八章的实验 7 的公司数据按照（原书的）图示 10.2 的格式，在屏幕上显示出来。汇编语言第十章课程设计 1。

* Created on 2014-10
* 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 课程设计 1

* 任务：将第八章的实验7的公司数据按照（原书的）图示10.2的格式，在屏幕上显示出来。
* 参照：[Note 5 实验7](learning-note-5.md#实验7-寻址方式在结构化数据访问中的应用)

因为程序要显示的数据有些已经大于65535（16位word型能存的最大数），所以要编写一个新的数据转化为字符串的程序，dtoc的改进版，

即 [Note 7 第十章实验 10.3 的数字显示](learning-note-7.md#_3数值显示)

* 功能：
  * 将dword型数据转变成为表示十进制数的字符串，字符串以0为结尾符。
* 参数：
  * \(ax\)=dword 型数据的低16位
  * \(dx\)=dword 型数据的高16位
  * ds:si 指向字符串的首地址
* 返回：无

```text
assume cs:code

data segment
        db 10 dup (0)
data ends

code segment

start:
        ;  显示
        mov ax, 614eh
        mov dx, 0bch

        mov bx, data
        mov ds, bx
        mov si, 0
        call dtoc32

        mov dh, 8
        mov dl, 3
        mov cl, 2
        mov si, 0
        call show_str

        mov ax, 4c00h
        int 21h

dtoc32:
        ;  保存寄存器的数据
        push cx
        push dx
        push di
        mov di, 0

s3:     mov cx, 10
        call divdw              ;  调用无溢出除法
        add cx, 30h             ;  转换为 ASCII 码
        push cx         ;  暂存入栈

        inc di          ;  统计要显示几个字符
        cmp ax, 0
        jne s3

        mov cx, di

ss3:pop ds:[si]
        inc si
        loop ss3

        mov byte ptr ds:[si], 0 ;  写入字符串的结尾符

e3:     ;  恢复寄存器的数据
        pop di
        pop dx
        pop cx
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

        ;  计算 /10
        mov ax, 4240h   ;10000 = F4240H
        mov dx, 0fh
        mov cx, 0ah     ;10 = 0AH
        call divdw

        mov ax, 4c00h
        int 21h

divdw:
        ;  保存寄存器的数据
        push bx

        ; X/N = int(H/N) * FFFFH + [rem(H/N) * FFFFH + L] / N
        ; X  是被除数，  N 是除数， H 是被除数高位，  L 是被除数低位；
        ; * FFFFH  是左移位，  int(x/n) 是商， rem(x/n)  是余数。

        push ax ;  暂存被除数低位

        mov ax, dx      ; dx  被除数高位
        mov dx, 0
        div cx
        mov bx, ax      ;  暂存被除数高位被除的商
                        ; dx  被除数高位被除的余数

        pop ax          ;  恢复被除数低位
        div cx

        push dx         ;  暂存最后的余数
        mov dx, bx      ;  恢复被除数高位被除的商
        pop cx          ;  余数放在指定位置  cx

        ;  恢复寄存器的数据
        pop bx
        ret

code ends

end start
```

Attachment 附件：[&gt;汇编语言第十章实验10.3改进版.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%207%20extra/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E7%AB%A0%E5%AE%9E%E9%AA%8C10.3%E6%94%B9%E8%BF%9B%E7%89%88.asm) &lt;/div&gt;

完整的解法：

```text
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

sbuf segment
    db 10 dup (0)
sbuf ends

emp_row segment
        db 80 dup (' ')
emp_row ends

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

        ;  数据间的间隔设为
        mov al, 0
        mov es:4[di], al
        mov es:9[di], al
        mov es:12[di], al
        mov es:16[di], al

        add bx, 4
        add di, 16
        inc si
        inc si

        loop s

        ;  刷新整个显示区域
        mov ax, 0b800h
        mov ds, ax
        mov di, 0
        mov cx, 80 * 24

x:      mov byte ptr ds:[di], ' '
        mov byte ptr ds:[di+1], 0

        inc di
        inc di
        loop x

        mov ax, es
        mov ds, ax
        mov dx, 0
        mov cx, 21

s0:     push cx         ;  暂存循环计数
        ;mov cl, 7h     ;  设置默认字体样式：黑底白字
        mov cl, 42h     ;  为方便查看，改为更鲜艳的颜色

        ;  求出目的行的偏移量
        mov al, 10h
        mul dl
        mov di, ax      ; bx  目标行的偏移量

        push dx         ; 保存寄存器

        ;  显示年份
        mov dh, dl      ;  行
        mov dl, 0       ;  列
        mov si, di
        call show_str

        ;  以下两行是：重点中的重点！很隐蔽的错误，我找了很久才发现……
        ;  要想想怎么避免这种错误。

        pop dx  ;  这句和下面那句都不能删掉！注意看，前四行修改了  dx ！
        push dx ;  因为之后四行要用到原来的  dx，但又修改了dx ，必须先恢复，再压栈一次！

        ;  显示收入
        mov bh, dl      ;  行
        mov bl, 12      ;  列
        mov dx, ds:7[di]
        mov ax, ds:5[di]
        call show_block32

        pop dx ; 恢复寄存器

        ;  显示雇员数
        mov bh, dl      ;  行
        mov bl, 24      ;  列
        mov ax, ds:10[di]
        call show_block16

        ;  显示收入
        mov bh, dl      ;  行
        mov bl, 36      ;  列
        mov ax, ds:13[di]
        call show_block16

        inc dx
        pop cx          ;  恢复循环计数
        loop s0

        mov ax, 4c00h
        int 21h

; 参数: (ax)=dword  型数据的低位，
;       (dx)=dword  型数据的高位，
;       (bh)=  行号 0~24 ，  (bl)= 列号 0~79  ，
;       (cl)=  颜色， ds:di 指向字符串的首地址。
; 返回: 无

show_block32:
        ;  保存寄存器的数据
        push dx
        push ds
        push si

        ;  要显示的 dword 型数据已经放在  dx （高位）， ax （低位）中
        push cx
        mov cx, sbuf
        mov ds, cx
        mov si, 0
        call dtoc32
        pop cx

        ;  要显示的颜色已经放在  cl
        ;  显示的位置放在  bx 中， bh  放行， bl 放列
        mov dh, bh
        mov dl, bl
        mov si, 0
        call show_str

        ;  恢复寄存器的数据
        pop si
        pop ds
        pop dx
        ret

; 参数：(ax)=dword  型数据的低位
;      (dx)=dword  型数据的高位
;      ds:si  指向字符串的首地址
; 返回：无

dtoc32:
        ;  保存寄存器的数据
        push cx
        push di

        mov di, 0

s32:    mov cx, 10      ;  设置除数
        call divdw      ;  调用无溢出除法
        add cx, 30h     ;  转换为 ASCII 码
        push cx         ;  暂存入栈

        inc di          ;  统计要显示几个字符
        cmp dx, 0
        jne s32
        cmp ax, 0
        jne s32

        mov cx, di

ss32:   pop ds:[si]
        inc si
        loop ss32

        mov byte ptr ds:[si], 0 ;  写入字符串的结尾符

        ;  恢复寄存器的数据
        pop di
        pop cx
        ret

; 参数： (ax)=word  型数据， (bh)= 行号  0~24 ， (bl)=  列号 0~79 ，
;       (cl)=  颜色， ds:di 指向字符串的首地址。
; 返回：无

show_block16:
        ;  保存寄存器的数据
        push dx
        push ds
        push si

        ;  要显示的 word 型数据已经放在  ax
        push cx ;cx  已存放颜色的数据，所以暂存
        mov cx, sbuf
        mov ds, cx
        mov si, 0
        call dtoc
        pop cx  ;  恢复 cx 原有数据

        ;  要显示的颜色已经放在  cl
        ;  显示的位置放在  bx 中， bh  放行， bl 放列
        mov dh, bh
        mov dl, bl
        mov si, 0
        call show_str

        ;  恢复寄存器的数据
        pop si
        pop ds
        pop dx
        ret

; 参数： (ax)=word  型数据， ds:si 指向字符串的首地址。
; 返回：无

dtoc:   ;  保存寄存器的数据
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

; 参数：(dh)=  行号 0~24 ，  (dl)= 列号 0~79  ， (cl)= 颜色，  ds:di 指向字符串的首地址。
; 返回：无

show_str:
        ;  保存寄存器的数据
        push es
        push di
        push bx
        push ax

        ;  因为 dos 自动刷新，会产生新行，刷掉顶端的一两行结果，所以最好
        ;  将显示区下移一行
        add dh, 1

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
        pop di
        pop es
        ret

; 参数：(ax)=dword  型数据的被除数的低位
;      (dx)=dword  型数据的被除数的高位
;      (cx)=word  型除数
; 返回： (dx)=  结果的高位
;      (ax)=  结果的低位
;      (cx)=  余数

divdw:
        ;  保存寄存器的数据
        push bx

        ;X/N = int(H/N) * FFFFH + [rem(H/N) * FFFFH + L] / N
        ;X  是被除数，  N 是除数， H 是被除数高位，  L 是被除数低位；
        ; * FFFFH  是左移位，  int(x/n) 是商， rem(x/n)  是余数。

        push ax ;  暂存被除数低位

        mov ax, dx      ; dx  被除数高位
        mov dx, 0
        div cx
        mov bx, ax      ;  暂存被除数高位被除的商
                        ; dx  被除数高位被除的余数

        pop ax          ;  恢复被除数低位
        div cx

        push dx         ;  暂存最后的余数
        mov dx, bx      ;  恢复被除数高位被除的商
        pop cx          ;  余数放在指定位置  cx

        ;  恢复寄存器的数据
        pop bx
        ret

code ends

end start
```

Attachment 附件：[汇编语言第十章课程设计1.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%207%20extra/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E7%AB%A0%E8%AF%BE%E7%A8%8B%E8%AE%BE%E8%AE%A11.asm)

