# ASM 汇编语言 13

> 外中断。接口芯片和端口，可屏蔽中断、不可屏蔽中断。PC 机键盘的处理过程。编写 int 9 中断例程，并将其安装。

- Created on 2014-11
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章十五、外中断

### 15.1 接口芯片和端口

- 外设的输入不直接送入内存和CPU，而是送入相关的接口芯片的端口中；
- CPU向外设输出也不直接送入外设，也是送入端口中。

CPU还可以向外设输出控制命令。

CPU通过端口和外部设备进行联系。

### 15.2 外中断信息

例：外设输入到达时，相关芯片将向CPU发出相应的中断信息。

CPU在执行完当前指令后，可以检测到发送过来的中断信息，引发中断，处理外设输入。

**外中断源**，共有以下**两类**：

- 可屏蔽中断
- 不可屏蔽中断

#### 可屏蔽中断

即 CPU 可以不响应的外中断。

CPU**是否响应可屏蔽中断**，**取决于标志**寄存器中**IF位**。

- 若**IF = 1**，**可屏蔽中断可引发**CPU的中断过程；
- 若**IF = 0**，则**不响应**可屏蔽中断。

回忆**内中断引发过程**，

- 取中断类型码n
- 标志寄存器入栈，**IF=0**，TF=0；
- CS、IP入栈
- `(ip) = (n * 4), (cs) = (n * 4 + 2)`
- 然后转去执行中断处理程序（中断例程）。

可屏蔽中断所引发的中断过程，除第（1）步的实现与内中断有所不同外，其它与内中断的中断过程基本上相同。

之所以**第（2）步 IF 置为0**，在**进入中断处理程序后**，**禁止其它的可屏蔽中断**！

#### 不可屏蔽中断

**CPU必须响应的外中断**——检测到它的信息时，执行完当前指令后，立即响应。

对于**8086CPU**，**不可屏蔽中断**的**中断类型码固定为2！**

所以该中断过程中，不需要取中断类型码。

- 标志寄存器入栈，**IF=0**，TF=0；
- CS、IP入栈
- `(ip) = (8), (cs) = (0AH)`

### 15.3 PC机**键盘的处理过程**

PC机处理外设输入的基本方法：

#### 1. 键盘输入

键盘每个键相当于一个个开关，键盘有一个芯片对每个键的开关状态进行扫描。

- **按下**一个**键**，开关触发，芯片**产生**一个**扫描码**，扫描码说明按下的键在键盘上的位置。
- **扫描码**被送入主板上的**相关**接口芯片的寄存器中，该寄存器的**端口地址**为**60h**。
- **松开**一个**键**，其它类同上。

扫描码

- **按下按键**产生的扫描码，称为**通码**；
- **松开**按键产生的扫描码，称为**断码**。
- 扫描码**长度**为 **1 Byte**，通码第七位为0，断码的第7位为1。
- **断码 = 通码 + 80h**（部分键盘扫描码表见于文末）

#### 2. 引发 9 号中断

键盘的**输入到达60h端口**时，相关芯片就会向CPU **发出 int 9** 的 **可屏蔽中断** 信息。

此时若IF = 1，则响应中断。

#### 3. 执行 int 9 中断例程

**BIOS提供**了 **int 9** 中断例程，处理基本的键盘输入处理。

主要工作如下：

- 读出60h端口中的扫描码；
- a. 若是**字符键**的扫描码，则将对应的字符码（ASCII）送入内存中的**BIOS键盘缓冲区**。
- b. 若是控制键（如Ctrl）和切换键（如CapsLock）等的扫描码，
    - 则将其转为状态字节（用二进制位记录控制键和切换键的字节），写入内存中储存状态字节的单元。
- 对键盘系统进行相关的控制，如，向相关芯片发出应答信息。

BIOS键盘缓冲区，是系统启动后，BIOS用于存放 int 9 中断例程所接收的键盘输入的内存区，**可以存储15个键盘输入**。

- 除了接收扫描码外，**还要产生**和**扫描码对应**的**字符码**，
- **一个**键盘**输入**用 1 word（**2 Bytes**）存放，
- **高位**存放**扫描码**，**低位**存放**字符码**。

0040:17单元存储键盘状态字节，记录了控制键和切换键的状态，

其中各位记录的信息如下：

|bit|键位|置为1表示？|
|-|-|-|
|0|右shift|按下|
|1|左shift|按下|
|2|Ctrl|按下|
|3|Alt|按下|
|4|ScrollLock|Scroll指示灯亮|
|5|NumLock|小键盘输入的是数字|
|6|CapsLock|输入大写字母|
|7|Insert|处于删除状态（否则处于插入态）|

### 15.4 编写 int 9 中断例程

键盘输入处理过程：

- 键盘产生扫描码；
- 扫描码送入60h
- 引发int 9（可屏蔽中断）
- CPU执行 int 9 中断例程，处理输入

编程：

- 在屏幕中间**依次显示"a"~"z"，**并可以**让人看清**。
- 在显示过程中，**按下Esc**键后，**改变**显示的**颜色**。

```nasm
assume cs:code

stack segment
     db 128 dup (0)
stack ends

data segment
     dw 0, 0
data ends

code segment

start:
     mov ax, stack
     mov ss, ax
     mov sp, 128

     mov ax, data
     mov ds, ax

     mov ax, 0
     mov es, ax

     ;int 9 键盘输入处理的中断例程
     ;将它的入口地址保存在ds:0、ds:2单元中
     push es:[9 * 4]
     pop ds:[0]
     push es:[9 * 4 + 2]
     pop ds:[2]

     cli     ;以防在设置新的中断例程入口地址时，发生中断
             ;以致于产生错误

     mov word ptr es:[9 * 4], offset int9
     mov es:[9 * 4 + 2], cs
     sti     ;同上

     mov ax, 0b800h
     mov es, ax
     mov ah, 'a'

c0:
     mov es:[160 * 12 + 40 * 2], ah
     call delay
     inc ah
     cmp ah, 'z'
     jna c0

     mov ax, 0
     mov es, ax

     push ds:[0]
     pop es:[9 * 4]
     push ds:[2]
     pop es:[9 * 4 + 2]

     mov ax, 4c00h
     int 21h

delay:
     push ax
     push dx

     mov dx, 2
     mov ax, 0

c1:
     sub ax, 1
     sbb dx, 0
     cmp ax, 0
     jne c1
     cmp dx, 0
     jne c1

     pop dx
     pop ax

     ret

;新的 int 9 中断例程

int9:
     push ax
     push bx
     push es

     in al, 60h

     pushf
     pushf
     pop bx     ;bx is flag
     and bh, 11111100b
     push bx
     popf

     call dword ptr ds:[0]
     ;注意dword！
     ;这条指令已经把ds:[0]和ds:[2]两个字都传送过去了

     cmp al, 1
     jne int9ret

     mov ax, 0b800h
     mov es, ax
     inc byte ptr es:[160 * 12 + 40 * 2 + 1]
     ;将属性值加一，改变颜色

int9ret:
     pop es
     pop bx
     pop ax
     iret

code ends

end start
```

Attachment 附件：[汇编语言第十五章15.4例.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%2012/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%94%E7%AB%A015.4%E4%BE%8B.asm)
</div>

### 15.5 安装新的 int 9 中断例程

安装新的int 9，使得原有中断例程的功能得到拓展。

功能：在DOS下，按F1键后，改变当前屏幕的显示颜色，其它键照常。

```nasm
assume cs:code

stack segment
     db 128 dup (0)
stack ends

code segment

start:
     mov ax, stack
     mov ss, ax
     mov sp, 128

     push cs
     pop ds     ;新int 9的源码地址

     mov ax, 0
     mov es, ax     ;存放的目标地址

     mov si, offset int9
     mov di, 204h     ;预留前四字节，放原来的int9的入口地址
     mov cx, offset int9end - offset int9
     cld
     rep movsb

     ;将旧的int 9中断例程入口地址“偏移/段地址”暂存于0:200~0:203
     push es:[9 * 4]
     pop es:[200h]
     push es:[9 * 4 + 2]
     pop es:[202h]

     ;安全设置新的int 9入口地址
     cli
     mov word ptr es:[9 * 4], 204h
     mov word ptr es:[9 * 4 + 2], 0
     sti

     mov ax, 4c00h
     int 21h

int9:
     ;暂存寄存器
     push ax
     push bx
     push es

     in al, 60h

     pushf
     call dword ptr cs:[200h]     ;执行中断例程时，(CS)=0

     cmp al, 3bh
     jne int9ret

     mov ax, 0b800h
     mov es, ax
     mov bx, 1

     mov cx, 2000

r0:
     inc byte ptr es:[bx]
     add bx, 2
     loop r0

int9ret:
     ;恢复寄存器
     pop es
     pop bx
     pop ax
     iret

int9end:
     nop

code ends

end start
```

Attachment 附件：[汇编语言第十五章15.5例.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%2012/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%94%E7%AB%A015.5%E4%BE%8B.asm)
</div>

### 实验 15 安装新的 int 9 中断例程

功能：

- 在DOS下，按下“A”键后，除非不再松开，
- 如果松开，就显示满屏幕的“A”；
- 其它键照常处理。

提示：

- 按下一个键产生的扫描码为通码，
- 松开时产生的是断码，
- 断码 = 通码 + 30h

```nasm
assume cs:code

code segment

start:
     mov ax, 0     ;无法将idata直接push到stack中
     mov es, ax
     mov di, 204h

     ;0:200~203存储原有 int 9 中断例程的入口地址
     push es:[9 * 4]
     pop es:[200h]

     push es:[9 * 4 + 2]
     pop es:[202h]

     ;install the new int 9 routine
     push cs
     pop ds
     mov si, offset fill_a

     mov cx, offset f_a_end - offset fill_a
     cld
     rep movsb

     ;避免设置新中断程序中途，
     ;可屏蔽中断导致入口地址的设置不正确
     cli
     mov word ptr es:[9 * 4], 204h
     mov word ptr es:[9 * 4 + 2], 0
     sti
     mov ax, 4c00h
     int 21h

fill_a:
     ;暂存寄存器
     push ax
     push cx
     push di
     push es

     in al, 60h

     pushf
     call dword ptr cs:[200h]

     cmp al, 9eh     ;A的断码
     jne ok

     mov ax, 0b800h
     mov es, ax
     mov di, 0

     mov al, 'A'
     mov cx, 2000

c0:
     mov byte ptr es:[di], al
     inc di
     inc di
     loop c0

ok:
     ;恢复寄存器
     pop es
     pop di
     pop cx
     pop ax

     iret

f_a_end:
     nop

code ends

end start
```

Attachment 附件：[汇编语言第十五章实验15.asm](https://att.icehe.xyz//Assembly%20Language%20-%20Note%2012/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%94%E7%AB%A0%E5%AE%9E%E9%AA%8C15.asm)

### 8086CPU指令系统总结

若想了解详情，自行查阅相关指令手册。

提供以下几大类指令：

#### 数据传输指令

如，mov、push、pop、pushf、popf、xchg 等。

实现寄存器、内存等之间的**单个数据传送**。

**XCHG交换**指令：

- 两个寄存器，寄存器和内存变量之间内容的交换指令，
- 两个操作数的**数据类型要相同**，
- 可以是一个**字节**，也可以是一个**字**，也可以是**双字**。

#### 算术运算指令

如，add、sub、adc、sbb、inc、dec、cmp、imul、idiv、mul、div、aaa等。

执行**结果影响标志寄存器**。

**aaa - **ASCII Adjust After Addition，**非压缩、非组合的BCD码调整指令**；

- AAA指令将AL调整为一个非压缩BCD格式的数字，
- AL是两个非压缩BCD数字相加后的结果；

如果AL(3~0位)大于9或辅助进位AF=1，则

- AH=AH+01H
- AL=AL+06H

且置AF和CF为1 否则

- 置AF和CF为零
- AL(7~4位)=0

`imul`

- **imul 有符号乘法**，将被乘数与乘数均作为有符号数。
- mul 无符号乘法，将被乘数及乘数均作为无符号数。

`idiv` 同理

#### 逻辑指令

如，and、or、not、xor、test、shl、shr、rol、ror、rcl、rcr 等。

- **除了 not** 外，其它指令的结果 **影响标志寄存器**。
- **test** 指令，将两操作数作**与and**运算，仅**修改标志位**，**不回送结果**。
- **sal** / **sar** 指令，Shift Arithmetic Left / Right，
    - 算术左/右移，执行时将操作数看成带符号数进行移位；
    - 算术右移时，最高位保持不变；算术左移和逻辑左移一致。
- **rol / ror** 指令，Rotate Left / Right ，**左/右循环移位**。
- **rcl / rcr** 指令，Rotate Left / Right **Through Carry**，
    - 带进位左/右循环移位，以右移为例：
    - **标志位CF移入**操作数**最高位**，操作数**最低位进入**标志位**CF**。

#### 转移指令

可以**修改**IP，或同时修改**CS和IP**的指令。

分以下几类：

- **无条件转移**指令，如jmp
- **条件转移**指令：如jcxz、je、jne、jb、jnb、ja、jna等
- **循环**指令：如loop
- **过程**，如call、ret、retf
- **中断**，如int、iret

#### 处理控制指令

对标志寄存器，或其它处理机状态进行设置。

如cld / std、cli / sti、nop、clc / stc、**cmc、****hlt、wait、esc、lock**等。

- cmc (CoMplement Carry) **进位位求反**指令：
    - 执行操作后 CF=!CF 即 CF=1
    - 执行CMC操作后 CF=0；反之相反。
- wait/fwait 同步FPU与CPU：停止CPU的运行，直到FPU完成当前操作码。
- hlt (halt) ：停止，无操作数。
    - 使程序**停止**运行，处理器进入暂停状态，不执行任何操作，不影响标志。
    - 当复位（外语：RESET）线上有复位信号、CPU响应非屏蔽中断、
    - CPU响应可屏蔽中断3种情况之一时，CPU脱离暂停状态，
    - 执行HLT的下一条指令。
- esc，指令助记符，交权给外部协处理器。（意义暂不明晰）
- lock（意义暂不明晰）

#### 串处理指令

对内存中的**批量数据**进行**处理**。

- 如 movsb、movsw、**cmps、scas、lods、stos** 等。

若要使用它们方便进行批量数据处理，则需要**与rep、repe、repne**等**前缀指令配合**使用。

**repe / repne**，即是 repeat **equal** / repeat **not equal**，意思是：**相等时重复 / 不相等时重复**。

键盘扫描码（部分）

|键位|通码|断码|备注|
|-|-|-|-|-|
|ESC|01H|81H|/|
|!1|02H|82H|/|
|@2|03H|83H|/|
|\#3|04H|84H|/|
|$4|05H|85H|/|
|%5|06H|86H|/|
|^6|07H|87H|/|
|&7|08H|88H|/|
|*8|09H|89H|/|
|(9|0AH|8AH|/|
|)0|0BH|8BH|/|
|_-|0CH|8CH|/|
|+=|0DH|8DH|/|
|ERASE 0EH|8EH|/|
|TAB|0FH|8FH|/|
|Q|10H|90H|/|
|W|11H|91H|/|
|E|12H|92H|/|
|R|13H|93H|/|
|T|14H|94H|/|
|Y|15H|95H|/|
|U|16H|96H|/|
|I|17H|97H|/|
|O|18H|98H|/|
|P|19H|99H|/|
|{[|1AH|9AH|/|
|}]|1BH|9BH|/|
|ENTER|1CH|9CH|/|
|L_CTRL|1DH|9DH|左CTRL|
|A|1EH|9EH|/|
|S|1FH|9FH|/|
|D|20H|A0H|/|
|F|21H|A1H|/|
|G|22H|A2H|/|
|H|23H|A3H|/|
|J|24H|A4H|/|
|K|25H|A5H|/|
|L|26H|A6H|/|
|:;|27H|A7H|/|
|"'|28H|A8H|/|
|~`|29H|A9H|/|
|L_SHIFT|2AH|AAH|左SHIFT|
|\\|2BH|ABH|/|
|Z|2CH|ACH|/|
|X|2DH|ADH|/|
|C|2EH|AEH|/|
|V|2FH|AFH|/|
|B|30H|B0H|/|
|N|31H|B1H|/|
|M|32H|B2H|/|
|<,|33H|B3H|/|
|>.|34H|B4H|/|
|?/|35H|B5H|/|
