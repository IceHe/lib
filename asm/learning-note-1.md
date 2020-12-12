# ASM 汇编语言 1

ASM Note : 寄存器，段寄存器，CS 和 IP，修改 CS、IP 的指令，查看 CPU 和内存。

---

- Created on 2014-10
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章一、基础知识

1.3 汇编语言的组成

- 汇编指令：机器码的助记符
- 伪指令：没有对应的机器码，由编译器执行，计算机并不执行
- 其它符号：如 +、-、*、/ 等，由编译器识别，没有对应的机器码

1.7 CPU 对储存器的读写

- 总线从逻辑上分 3 类：地址线、数据线、控制线

## 章二、寄存器

2.2 字在寄存器中的存储

- 低字节：权越小，越低。个位的数字的权是 1，十位的权是 2，百位的权是 4，如此类推
- 高字节：权比较大的位（该位的数字代表的分量较大），即为高字节
- 与此相关的是——大小端、网络字节序

2.3

- 指令的两个操作对象的位数应该一致

2.9 段寄存器

- 8086 CPU 有四个段寄存器：CS、DS、SS、ES。

2.10 CS 和 IP

- CS 为代码段（code segment?）寄存器， IP 为指令指针（instruction ptr?）寄存器。
- 任意时刻 CPU 将 CS:IP 指向的内容当作指令执行。

2.11 修改 CS、IP 的指令

- jmp 指令：jmp 段地址:偏移地址 —— jmp 2AE3:3

8086 CPU 的工作过程

- 从 CS:IP 指向的内存单位读取指令，读取的指令进入指令缓存器
- IP指向下一条指令
- 执行指令。（转到第一步，重复这个过程）

Chapter 2 实验 1 查看 CPU 和内存，用机器指令和汇编指令编程

- Debug 是 DOS、Windows 都提供的实模式（8086 方式）程序的调试工具。
- 它可以查看 CPU 各种寄存器的内容、内存的情况和在机器码级跟踪程序的运行。

## 使用 debug.exe

[准备 Windows7 下的汇编工具 debug.exe](prepare-on-windows-7.md)

### 指令

- R 查看、改变 CPU 寄存器的内容
- D 查看内存中的内容
- E 改写内存中的内容
- U 将内存中的机器指令翻译成汇编指令
- T 执行一条（CS:IP 指向的）机器指令
- A 以汇编指令的格式，在内存中写入一条机器指令
- G 跳转执行到指定的内存位置
- P 程序执行到最后一步，必须使用的指令

### 寄存器

- 通用寄存器：ax,bx,cx,dx
- 段寄存器：ds,es,ss,cs
- 偏移地址寄存器：sp.ip,bp,si,di
- 标志寄存器：flag

### 基本操作实践

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/4bc20fd901206044a792ae37d5ccd1b3.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/8274851476c413d426e343e69e8e5187.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/17ee180333575eb889d093caeb72a845.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/706f7ccda236318f3be58b20c32a521d.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/55b18e7e228e351d59ab509d2d91d089.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/565deced8c0a4ce33c0b5eb86a066b28.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/1ee20fb40a66fb58acb5ba8312ac301d.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/a04b37ec53451fff31c98c59b1ee0343.png)

## 实验

### 任务一

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/bac5af4d74353db662a06aaf11cbe162.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/3c1fa34129c318f8ef086ac0725b126a.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/6b62a7dc51f24ad3ee0932c29fade4fc.png)

![img](https://img.icehe.xyz/Assembly%20Language%20-%20Note%201/386bad5a0f13c43e209df53c0b81298f.png)

### 任务二

计算 2 的 8 次方。
(在内存 2000:0 开始写该程序）

```nasm
mov ax, 1
add ax, ax
add ax, ax
add ax, ax
```

或者

```nasm
mov ax, 1
add ax, ax
jmp 2000:3
```

- 暂时的知识不足以写出循环控制语句！

结论

- 内存 FFF00H ~ FFFFFH 为 ROM 区,内容可读但不可写。
- 8086 的显存地址空间是 A0000H ～ BFFFFH, 其中 B8000H ～ BFFFFH 为 80*25 彩色字符模式显示缓冲区，当向这个地址空间写入数据时，这些数据会立即出现在显示器上
