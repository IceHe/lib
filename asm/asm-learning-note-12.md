# ASM 汇编语言 12

> ASM - Note: 端口的读写，in / out 指令。shl 和 shr 指令。CMOS RAM 芯片，其中存储的时间信息。访问 CMOS RAM。

- Created on 2014-11
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章十四、端口

PC系统中，和CPU通过总线项链的芯片除存储器外，还有：

- 各种接口卡（如，网卡、显卡）上的接口芯片，它们控制接口卡进行工作
- 主板上的接口芯片，CPU通过它们对部分外设进行访问
- 其它芯片，用来存储相关的系统信息，或进行相关的IO处理

这些芯片中，都有一组可以由CPU读写的寄存器。

物理上它们在不同芯片中，但在以下两点上相同：

- 都和CPU的总线相连，当然这种连接是通过它们所在的芯片进行的
- CPU对它们进行读写时，都通过控制线向它们所在的芯片发出端口读写命令

可见，CPU将这些寄存器当作端口，
对其统一编址，建立统一的地址端口空间。

CPU可直接读写以下3个地方的数据：

- CPU内部的寄存器
- 内存单元
- 端口

### 14.1 端口的读写

- PC系统中，CPU最多可以定位**64K**个不同的**端口**，**0~65535**

- 对**端口**的**读写指令**只有两条：**in**、**out**

- 而无push、pop、mov等指令

**访问**端口：

```nasm
in al, 60
```

- CPU通过地址线将地址信息60h发出
- CPU通过控制线发出端口读命令，选中端口所在的芯片，并通知它，将要从中读取数据
- 端口所在的芯片将60h端口中的数据通过数据线送入CPU

**写入**端口：

```nasm
out 20h, al
```

类同上一条

### 14.2 CMOS  RAM 芯片

CMOS  RAM 芯片 一般**简称 CMOS**。特征如下：

- 包含一个实时钟，和一个128个存储单元的RAM存储器。
    - 早期计算机为64Bytes
- 靠电池供电，关机后其内部实时钟仍可正常工作，RAM中的信息不丢失。
- 128个字节的RAM中，内部实时钟占用0~0dh单元来保存时间，
    - 其余大部分单元用于保存系统配置信息，供系统启动时BIOS程序读取。
    - BIOS也提供了相关程序，使开机时可配置CMOS  RAM中的系统信息。
- 该芯片内部有两个端口，地址分别为70h、71h。通过它们读写CMOS RAM。
- 70h为地址端口，存放要访问的CMOS RAM单元的地址；
    - 71h为数据端口，存放从选定的CMOS RAM单元中读取的数据。
    - 如读取CMOS的2号存储单元：
        - a. 将 2 送入端口 70h
        - b. 从端口 71h 读 2 号单元的内容

### 检测点 14.1

编程：读取CMOS RAM的2号单元的内容 / 将0写入该单元

```nasm
assume cs:code

code segment

start:
     ;read CMOS RAM unit2
     mov al, 2
     out 70h, al
     in al, 71h

     ;write unit2
     mov al, 2
     out 70h, al
     mov al, 0
     out 71h, al

;in/out指令，好像只能凭借al寄存器来做参数中转

     ;test operator's result
     mov al, 2
     out 70h, al
     in al, 71h

     ;大概是CMOS的2单元一直在变     ;从 71h 读到 al 的数据并不是预想中的 0
     mov ax, 4c00h
     int 21h

code ends

end start
```

### 14.3 shl 和 shr 指令

它们是**逻辑移位指令
shl** —— **逻辑左移**：

- 将一个寄存器或内存单元中的数据向**左移**位
- 将**最后移出**的一**位写入CF**中
- **低位**用**0补充**

指令：

```nasm
mov al, 10000001b
shl al, 1     ;左移一位
```

**shr** —— 逻辑右移：

- 将一个寄存器或内存单元中的数据向 **右移** 位
- 将 **最后移出** 的 **一位写入CF** 中
- **高位** 用 **0补充**

### 检测点 14.2

计算 (ax) = (ax) * 10

- 第一版

```nasm
assume cs:code

code segment

start:
     mov ax, 2
     shl ax, 1; ax * 2
     mov bx, ax

;shl/shr指令，若用立即数作为参数时，

;立即数必须为1（每次仅允许移一位！）

     shl ax, 1     ; ax * 4
     shl ax, 1     ; ax * 8
     add ax, bx
     mov ax, 4c00h
     int 21h

code ends

end start
```

- 第二版

```nasm
assume cs:code

code segment

start:
     mov ax, 2
     shl ax, 1     ; ax * 2
     mov bx, ax

     ;当移位数大于1时，要先将移位数置于CL中，然后再用CL移位。
     ;可以使用8位立即数指定范围从1到31的移位次数

     mov cl, 2
     shl ax, cl     ; ax * 8
     add ax, bx
     mov ax, 4c00h
     int 21h

code ends

end start
```

### 14.4 CMOS RAM 中存储的时间信息

**CMOS RAM存着**当前的时间：

- **年、月、日、时、分、秒**。

- **信息**的**长度**均为 **1 Byte**。

- **存放单元**为：**秒0 分2 时4 日7 月8 年9**

这些数据**以BCD码**的方式**存放。
BCD码**：

以4位二进制数，表示十进制数码的编码方式，如下：

- 0-0000，1-0001，2-0010，3-0011，4-0100，

- 5-0101，6-0110，7-0111，8-1000，9-1001。

1 Byte 可表示 2个BCD码，如 0001 0100b 表示 14。

- 以上为BCD码中的8421版本，其它详情请看 [百度百科](http://baike.baidu.com/link?url=jh2w0DfroFs6zztCYEmXpxVTIAWmpHaF7cJ6lWWxXLCniVWaxFs_tbJ_HwAMHl2_dOorIxg8MwsTTgJCg8xs7_)

在屏幕中间显示当前‘分钟’：

```nasm
assume cs:code

code segment

start:
     mov al, 2     ;如上文，单元2 存放着‘分钟’信息
     out 70h, al
     in al, 71h
     mov ah, al

     mov cl, 4
     shr ah, cl         ;右移4位，取高四位

     and al, 00001111b  ;保留低四位
     add ah, 30h        ;+30h 转换为对应数字的ascii
     add al, 30h

     mov bx, 0b800h     ;输出到屏幕
     mov ds, bx

     mov byte ptr ds:[160 * 12 + 40 * 2], ah
     mov byte ptr ds:[160 * 12 + 40 * 2 + 2], al
     mov ax, 4c00h
     int 21h

code ends

end start
```

### 实验14 访问CMOS RAM

编程：以“年/月/日 时:分:秒”的格式，显示当前的日期、时间。

注意：CMOS RAM 中存储着系统的配置信息，除了保存时间信息的单元外，不要向其它单元写内容，否则将引起一些系统错误。

![](http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2011/tmp.png)

```nasm
assume cs:code

time_pos segment
     db 9, 8, 7, 4, 2, 0
time_pos ends

;上一个段不满 16 Bytes (8 Words)
;新起的段也只从 下一个 16Bytes * n 的内存位置开始（见上图）
;16Bytes * n 即 10h * n
time_delimiter segment
     db '/', '/', ' ', ':', ':', '$'
time_delimiter ends

time_str segment
     db 18 dup (0)
time_str ends

code segment

start:
     mov ax, time_pos
     mov ds, ax
     mov si, 0
     mov ax, time_str
     mov es, ax
     mov di, 0
     mov cx, 6

circle:
     ;暂存寄存器
     push cx

     ;从端口获取当前时间
     mov al, ds:[si]
     out 70h, al
     in al, 71h

     ;切分当前时间的CBD码，存到不同的存储单元中
     push cx
     mov ah, al
     mov cl, 4
     shr ah, cl
     and al, 00001111b
     pop cx

     ;将BCD码转换为，对应数字的ASCII码
     add ah, 30h
     add al, 30h

     ;将时间拼接成字符串，暂存到指定内存中
     mov es:[di], ah
     inc di

     ;es:[di]访问的是段time_str
     mov es:[di], al
     inc di

     ;ds:16[si]访问的是段time_delimiter
     mov bl, ds:16[si];为什么idata（直接数/常量）偏移量是16而非6？

     ;答：段time_str只用db指令声明了6Bytes的数据，
     ;     但紧邻的段time_delimiter并非从上一个段
     ;     time_str的第7字节开始的，而是从下一个
     ;     16Bytes * n的内存位置开始的！

     mov byte ptr es:[di], bl
     inc di
     inc si
     loop circle

     ;locate cursor
     mov bh, 0     ;第0页
     mov dh, 12     ;第12行
     mov dl, 30     ;第30列
     mov ah, 2     ;设置光标位置，int 10h的2号子程序
     int 10h

     ;print time_str
     mov ax, time_str
     mov ds, ax
     mov dx, 0     ;ds:dx指向字符串，'$'作为结束符
     mov ah, 9     ;在光标位置处显示字符串，int 21h的9号子程序

     mov ax, 4c00h
     int 21h

code ends

end start
```

Attachment 附件：[汇编语言第十四章实验14.asm](http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2011/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%9B%9B%E7%AB%A0%E5%AE%9E%E9%AA%8C14.asm)
