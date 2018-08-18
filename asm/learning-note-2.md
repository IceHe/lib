# ASM 汇编语言 2

> ASM - Note: big / little-endian 大小端问题，通用寄存器，标志寄存器，段寄存器，DS 和 [address] ，CPU 提供的栈机制。

- Created on 2014-10
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 大小端问题

32bit 宽的数 0x12345678 在 Little-endian 模式 CPU 内存中的存放方式为

（假设从地址 0x4000 开始存放）

|地址|低|-|-|高|
|-|-|-|-|-|
|内存地址|0x4000|0x4001|0x4002|0x4003|
|存放内容|0x78|0x56|0x34|0x12|

而在 Big-endian 模式 CPU 内存中的存放方式则为

|地址|低|-|-|高|
|-|-|-|-|-|
|内存地址|0x4000|0x4001|0x4002|0x4003|
|存放内容|0x12|0x34|0x56|0x78|

联合体 union 的存放顺序是所有成员都从低地址开始存放。

## 8086 CPU 寄存器

有 14 个 16 位 [寄存器](http://baike.baidu.com/view/6159.htm)，按其用途可分为 4 类：

- [通用寄存器](http://baike.baidu.com/view/1418486.htm)
- 指令指针
- [标志寄存器](http://baike.baidu.com/view/1845107.htm)
- [段寄存器](http://baike.baidu.com/view/364403.htm)

[通用寄存器](http://baike.baidu.com/view/1418486.htm)

- 是那些你可以根据自己的意愿使用的寄存器，修改他们的值通常不会对 [计算机](http://baike.baidu.com/view/3314.htm) 的运行造成很大的影响。
- 有 8 个，又可以分成 2 组，一组是 [数据寄存器](http://baike.baidu.com/view/1547752.htm)（4 个），另一组是指针寄存器及 [变址](http://baike.baidu.com/view/420644.htm) 寄存器（4 个）

### 数据寄存器

[数据寄存器](http://baike.baidu.com/view/1547752.htm)

- AH & AL=AX (accumulator) [累加寄存器](http://baike.baidu.com/view/178151.htm)
    - 常用于运算；在乘除等 [指令](http://baike.baidu.com/view/178461.htm)中指定用来存放 [操作数](http://baike.baidu.com/view/420846.htm)，另外,所有的 [I/O指令](http://baike.baidu.com/view/2729050.htm)都使用这一寄存器与外界设备传送数据。
- BH & BL = BX (base) [基址](http://baike.baidu.com/view/105417.htm)[寄存器](http://baike.baidu.com/view/6159.htm)
    - 常用于地址索引
- CH & CL = CX (count) 计数[寄存器](http://baike.baidu.com/view/6159.htm)
    - 常用于计数；常用于保存计算值，如在 [移位指令](http://baike.baidu.com/view/1365206.htm)，循环（loop）和串处理指令中用作隐含的计数器
- DH & DL = DX (data) [数据寄存器](http://baike.baidu.com/view/1547752.htm)
    - 常用于数据传递

数据寄存器的特点

- 这 4 个 16 位的 [寄存器](http://baike.baidu.com/view/6159.htm) 可以分为
    - 高 8 位: AH, BH, CH, DH
    - 低 8 位：AL, BL, CL, DL
- 这 2 组 8 位 [寄存器](http://baike.baidu.com/view/6159.htm) 可以分别寻址，并单独使用

[指针](http://baike.baidu.com/view/159417.htm)[寄存器](http://baike.baidu.com/view/6159.htm) 和 [变址](http://baike.baidu.com/view/420644.htm) 寄存器，包括：

- SP（Stack Pointer）：[堆栈指针](http://baike.baidu.com/view/2081454.htm)，与SS配合使用，可指向目前的堆栈位置
- BP（Base Pointer）：[基址](http://baike.baidu.com/view/105417.htm) [指针](http://baike.baidu.com/view/159417.htm) [寄存器](http://baike.baidu.com/view/6159.htm)，可用作SS的一个相对基址位置
- SI（Source Index）：源 [变址](http://baike.baidu.com/view/420644.htm) [寄存器](http://baike.baidu.com/view/6159.htm)，可用来存放相对于DS段之源变址指针
- DI（Destination Index）：目的 [变址](http://baike.baidu.com/view/420644.htm) [寄存器](http://baike.baidu.com/view/6159.htm)，可用来存放相对于ES 段之目的变址 [指针](http://baike.baidu.com/view/159417.htm)。
- 这4个16位 [寄存器](http://baike.baidu.com/view/6159.htm) 只能按16位进行存取操作，主要用来形成 [操作数](http://baike.baidu.com/view/420846.htm) 的地址，用于 [堆栈](http://baike.baidu.com/view/93201.htm) 操作和 [变址](http://baike.baidu.com/view/420644.htm) 运算中计算操作数的 [有效地址](http://baike.baidu.com/view/1334477.htm)

### 指令指针 IP

- [指令](http://baike.baidu.com/view/178461.htm)指针IP是一个16位专用 [寄存器](http://baike.baidu.com/view/6159.htm)，它指向当前需要取出的指令 [字节](http://baike.baidu.com/view/60408.htm)
- 当BIU从 [内存](http://baike.baidu.com/view/1082.htm)中取出一个指令字 节后，IP就自动加(取出该字节的长度，如：BIU从内存中取出的是1个字节，IP就会自动加1，如果BIU从内存中取出的字节数长度为3，IP就自动加3)，指向下一个指令字节
- 注意，IP指向的是 [指令](http://baike.baidu.com/view/178461.htm)地址的段内地址 [偏移量](http://baike.baidu.com/view/1254177.htm)，又称 [偏移地址](http://baike.baidu.com/view/883224.htm) (Offset Address) 或 [有效地址](http://baike.baidu.com/view/1334477.htm)(EA，Effective Address)

### 标志寄存器

[标志寄存器](http://baike.baidu.com/view/1845107.htm)（Flags Register, FR）

- 又称 [程序状态字](http://baike.baidu.com/view/5499368.htm) (Program Status Word, PSW)
- 8086 有一个 16 位的标志性 [寄存器](http://baike.baidu.com/view/6159.htm) FR，在 FR 中有意义的有 9 位，其中 6 位是状态位，3 位是控制位

这是一个存放条件标志、控制 [标志寄存器](http://baike.baidu.com/view/1845107.htm)，主要用于反映处理器的状态和运算 [结果](http://baike.baidu.com/view/275137.htm)的某些特征及控制 [指令](http://baike.baidu.com/view/178461.htm)的执行

|编号|15|14|13|12|11|10|9|8|7|6|5|4|3|2|1|0|
|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|
|用途|-|-|-|-|OF|DF|IF|TF|SF|ZF|-|AF|-|PF|-|CF|

OF：溢出标志位OF用于反映有[符号](http://baike.baidu.com/view/115742.htm)数加减运算所得[结果](http://baike.baidu.com/view/275137.htm)是否溢出。如果运算[结果](http://baike.baidu.com/view/275137.htm)超过当前运算位数所能表示的范围，则称为溢出，OF的值被置为1，否则，OF的值被清为0。

DF：方向标志DF位用来决定在串操作[指令](http://baike.baidu.com/view/178461.htm)执行时有关指针[寄存器](http://baike.baidu.com/view/6159.htm)发生调整的方向。

IF：中断允许标志IF位用来决定CPU是否响应CPU外部的[可屏蔽中断](http://baike.baidu.com/view/3656313.htm)发出的[中断请求](http://baike.baidu.com/view/600250.htm)。但不管该标志为何值，CPU都必须响应CPU外部的不可屏蔽中断所发出的[中断请求](http://baike.baidu.com/view/600250.htm)，以及CPU内部产生的[中断请求](http://baike.baidu.com/view/600250.htm)。具体规定如下：

- 当IF=1时，CPU可以响应CPU外部的[可屏蔽中断](http://baike.baidu.com/view/3656313.htm)发出的[中断请求](http://baike.baidu.com/view/600250.htm)

- 当IF=0时，CPU不响应CPU外部的[可屏蔽中断](http://baike.baidu.com/view/3656313.htm)发出的中断请求。

TF：跟踪标志TF。该标志可用于[程序调试](http://baike.baidu.com/view/182316.htm)。TF标志没有专门的[指令](http://baike.baidu.com/view/178461.htm)来设置或清除。

- 如果TF=1，则CPU处于单步执行[指令](http://baike.baidu.com/view/178461.htm)的工作方式，此时每执行完一条指令，就显示CPU内各个[寄存器](http://baike.baidu.com/view/6159.htm)的当前值及CPU将要执行的下一条指令。
- 如果TF=0，则处于连续工作模式。

SF：[符号](http://baike.baidu.com/view/115742.htm)标志SF用来反映运算[结果](http://baike.baidu.com/view/275137.htm)的符号位，它与运算结果的最高位相同。在[微机系统](http://baike.baidu.com/view/2955084.htm)中，[有符号数](http://baike.baidu.com/view/1910414.htm)采用补码表示法，所以，SF也就反映运算[结果](http://baike.baidu.com/view/275137.htm)的正负号。

- 运算 [结果](http://baike.baidu.com/view/275137.htm)为非负数时，SF的值为0，否则其值为1。当运算 [结果](http://baike.baidu.com/view/275137.htm)没有产生溢出时，运算结果等于逻辑结果（即应该得到的正确的结果），此时SF表示的是逻辑结果的正负，
- 当运算结果产生溢出时，运算结果不等于逻辑结果，此时的SF值所表示的正负情况与逻辑结果相反，即：SF=0时，逻辑结果为负，SF=1时，逻辑结果为非负。

ZF：零标志ZF用来反映运算[结果](http://baike.baidu.com/view/275137.htm)是否为0。如果运算[结果](http://baike.baidu.com/view/275137.htm)为0，则其值为1，否则其值为0。在判断运算结果，是否为0时，可使用此标志位。

AF：( Assistant Carry Flag)下列情况下，[辅助进位标志](http://baike.baidu.com/view/1330728.htm)AF的值被置为1，否则其值为0：

- 在字操作时，发生低[字节](http://baike.baidu.com/view/60408.htm)向高字节进位或借位时
- 在[字节](http://baike.baidu.com/view/60408.htm)操作时，发生低4位向高4位进位或借位时。

PF：奇偶标志PF用于反映运算[结果](http://baike.baidu.com/view/275137.htm)中“1”的个数的奇偶性。如果“1”的个数为偶数，则PF的值为1，否则其值为0

CF：进位标志CF主要用来反映无[符号](http://baike.baidu.com/view/115742.htm)数运算是否产生进位或借位。如果运算[结果](http://baike.baidu.com/view/275137.htm)的最高位产生了一个进位或借位，那么，其值为1，否则其值为0

### 段寄存器

为了运用所有的[内存](http://baike.baidu.com/view/1082.htm)空间，8086设定了四个[段寄存器](http://baike.baidu.com/view/364403.htm)，专门用来保存[段地址](http://baike.baidu.com/view/883213.htm)：

CS（Code Segment）：[代码段](http://baike.baidu.com/view/1315853.htm)寄存器

DS（Data Segment）：数据[段寄存器](http://baike.baidu.com/view/364403.htm)

SS（Stack Segment）：[堆栈段](http://baike.baidu.com/view/76043.htm)[寄存器](http://baike.baidu.com/view/6159.htm)

ES（Extra Segment）：附加[段寄存器](http://baike.baidu.com/view/364403.htm)。

当一个程序要执行时，就要决定程序代码、数据和[堆栈](http://baike.baidu.com/view/93201.htm)各要用到[内存](http://baike.baidu.com/view/1082.htm)的哪些位置，通过设定[段寄存器](http://baike.baidu.com/view/364403.htm)CS，DS，SS 来指向这些起始位置。通常是将DS固定，而根据需要修改CS。

所以，程序可以在可[寻址空间](http://baike.baidu.com/view/2007755.htm)小于64K的情况下被写成任意大小。所以，程序和其数据组合起来的大小，限制在DS 所指的64K内，这就是COM文件不得大于64K的原因。8086以[内存](http://baike.baidu.com/view/1082.htm)作为战场，用[寄存器](http://baike.baidu.com/view/6159.htm)做为军事基地，以加速工作。

备注：由于所讲的是16位cpu(IP[寄存器](http://baike.baidu.com/view/6159.htm)的位数为16，即：[偏移地址](http://baike.baidu.com/view/883224.htm)为16位)2的16次幂就是64K，所以16位[段地址](http://baike.baidu.com/view/883213.htm)不能超过64K，超过64K会造成64K以上的地址找不到。
</div>

## 章三、寄存器

（内存访问）

### 3.1 内存中的存储

- 字单元word：即存放一个字型数据（在8086CPU中为16位，根据CPU的位数决定）的内存单元，
- 由位数/8个地址连续的内存单元组成。
- 起始地址位N的字单元简称为：N地址单元。

### 3.2 DS 和 [address]

DS

- DS是数据段寄存器，8086CPU不支持将数据直接送入段寄存器的操作，
- 所以只好通过一个寄存器中转，以写入。

[address]

- [address]，即是与CS：IP类似，DS存的是段地址，address指的是地址的偏移值。
- 用该方式获取的是从该地址起始的字型数据（非字节数据）。

### 3.7 CPU提供的栈机制

- 8086CPU的push和pop操作都是以字为单位进行的。

段寄存器

- 任意时刻，SS:SP指向栈顶元素。
- 8086CPU对栈上溢和下溢没有防范，需要编程者自己小心编码。

### 习题

问题 3.7 ~ 3.10 等的是拿来练手，熟悉汇编的。

只做问题 3.9：交换ax和bx中的值

![](https://img.icehe.xyz/Assembly%20Language%20-%20Note%202/d824691b0784a01c1ff478c8d0d0b94a.png)

![](https://img.icehe.xyz/Assembly%20Language%20-%20Note%202/08df8df77da5faf25658c48ee86cff40.png)

每当SS段寄存器被修改时，下一条指令也会紧跟着被执行！
