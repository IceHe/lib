# ASM 汇编语言 3

ASM - Note: 汇编指令，伪指令，segment … ends，end，assume，编译和连接，执行过程的跟踪，单步调试，[BX] 和 loop 指令，Debug 程序的各种命令，段前缀，一段安全的空间。

---

- Created on 2014-10
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

## 章四、第一个程序

### 4.2 源程序

- 汇编指令：有对应机器码的指令，可以被译为机器指令，被CPU执行。
- 伪指令：没有对应机器码的指令，是由编译器来执行的指令，编译器根据它来进行相关编译工作。

```nasm
assume cs:codesg
codesg segment
     mov ax, 0123H
     ...
     add ax, bx
     int 21H
codesg ends
end
```

`segment ... ends` 成对使用，用于定义一个段

- 一个汇编程序，由多个段组成。
- 这些段，用于存放代码、数据、或当作栈空间使用。

`end` 汇编程序的结束标记。

- 编译程序碰到伪指令end就会停止对源程序的编译。

```nasm
xxx segment
     ...
xxx ends
```

`assume` 含义为：“假设”

- 假设某一段寄存器和程序中某一个用 `segment...ends` 定义的段相关联。

### 4.4 编译源文件

后缀：`.asm`

下载 MASM5.0 汇编编译器

- http://download.pchome.net/development/linetools/down-9028-1.html

编译过程中，我们提供源程序文件，最多可以得到3个输出：

- 目标文件 .obj
- 列表文件 .lst
- 交叉引用文件 .crf

（后两个是中间结果，在汇编语言课程中，不讨论它们）

### 4.5 连接

- 使用微软的 Overlay Linker 3.60 连接器
- 连接过程中，需要目标文件 .obj、库文件 .lib（可能没有），
- 产生 exe，还有中间结果映像文件 .map。

### 4.6 以简化的方式进行编译和连接

输入以下指令，进行编译、连接、运行：

```bash
masm path\to\src_file_name;
link path\to\obj_file_name;
exe_name
```

**重点**：masm、link指令后面加上分号 `;` 就可以跳过中间输入参数的过程

### 4.8 谁将 exe 中的 program 装载入内存并使它运行？

- 任何通用的操作系统，都要提供一个称为**shell**（外壳）的程序，用户使用此程序来操作计算机系统进行工作
- DOS中有一个程序 **command.com**，称为**命令解释器**，就是**DOS的Shell程序**。

用户要执行一个程序：

- command.com根据输入的文件名找到exe；
- 将exe中的program加载入memory；
- 设置CS:IP（两个寄存器）指向程序的入口；
- command.com停止运行，CPU运行被调用的程序；
- 运行结束后，返回到command中，等待用户再次输入。

### 4.9 程序执行过程的跟踪

- debug.exe可以将程序加载入内存，设置CS:IP指向程序的入口，
- 但并不放弃对CPU的控制，所以可以单步执行程序，查看每条指令的执行结果。
- 单步的时候，使用T指令，
- 但到了最后一条指令 int 21时，使用P指令。（暂时不要理会that's why）
- Q指令：退出debug.exe。

## 章五、[BX]和loop指令

[offset]

- [offset]——指一个内存单元的地址，
- 段地址在DS（data segment）段寄存器中，偏移量是"[ ]"中的数字，
- 地址实际是 `DS * 16 + offset`，即 `DS * 10H + offset` ，
- 即DS内的数（16进制）左移一位再与offset相加。

pos & ax

- (pos) 表示一个寄存器或一个内存单元中的内容。
- (ax) 表示ax中的内容，(al）表示al里的内容。

`( )` 中的元素有三种：

- 寄存器名
- 段寄存器名
- 内存单元物理地址（一个 20bits 的数据）

`( )` 所表示的数据有两种类型：

- 字节
- 字

属于哪一种类型由寄存器名或具体的运算决定。

约定 **idata** 表示 **常量**。

mov ax, [idata] 就代表 mov ax, [3]... 等。

### 5.2 loop指令

```nasm
    mov ax, 2
    mov cx, 11
s:  add ax, ax
    loop s ; s是标号
    ...
```

- 标号，在汇编语言中，代表一个地址（标识了一个地址）。
- CPU执行 **loop** s，要进行两步操作：
    - a. (cx) = (cx) - 1
    - b. 判断(cx) 的值，不为0，则转至标号s所标识的地址处执行，即add ax, ax。
        - 若为 0，则执行吓一跳指令，即loop s之后的指令。

### 5.3 在Debug中跟踪用loop指令实现的循环程序

大于9FFFH（最后一位H，表示该数为16进制数）的十六进制数

- 如 A000H、B001H、...、FFFFH 等，在书写中都是以字母开头的

而 **在汇编语言中，数据不能以字母开头，所以要在开头加上数字 0**

#### Debug 程序的命令

G 命令

- `g 0012` 将程序运行到CS:0012这个地方。

P 命令

- 在遇到 loop xxx 的 loop 指令语句时，使用P命令，debug就会自动将程序一直运行，直到(cx) == 0，然后指向loop的下一条指令。

### 5.4 Debug 和汇编编译器 masm 对指令的不同处理

- 在汇编程序中，指令 `mov ax, [0]` 被编译器当作指令 `mov ax, 0` 处理。
- Debug 将其解释为 [idata] 是一个内存单元，idata 是内存单元的偏移地址；
- 而编译器将 [idata] 解释为 idata。

那么怎么让写的程序，用汇编编译器也能使用相对寻址？

- 目前方法：将偏移地址送入bx（base 段寄存器）寄存器中，
- 再用[bx]的编写方式，就可以来访问DS:(bx)的内存单元。

更好的方法：这么写指令 `mov al **ds:**[0]`，显式地给出段地址所在的段寄存器

### 5.6 段前缀

出现在访问内存单元的指令中，用于显式地指明内存单元的段地址。

- 如：ds:、cs:、ss:、es:。

### 5.7 一段安全的空间

DOS 方式下，DOS 和其它合法的程序一般都不会使用

- 0:200~0:2ff（00200H~002ffH）的 256bytes 的空间。

### 实验4 [bx] 和 loop 的使用

- 编程，向内存 0:200~0:23F 依次传送 0~63（3FH）。
- 进阶要求：只能使用 9 条指令，包括 `mov ax, 4c00h` 和 `int 21h`

```nasm
assume cs:code

code segment
    mov ax, 20h
    mov ds, ax
    mov bx, 0
    mov cx, 40h
s:  mov ds:[bx], bx
    inc bx
    loop s
    mov ax, 4c00h
    int 21h
code ends

end
```

- 将程序 `mov ax, 4c00h` 之前的指令复制到内存 `0:200` 处。

```nasm
assume cs:code

code segment
     mov ax, cs
     mov ds, ax

     mov ax, 20h
     mov es, ax

     mov bx, 0
     mov cx, 22

s:   **mov al, ds:[bx]
     mov es:[bx], al**
     inc bx
     loop s

     mov ax, 4c00h
     int 21h
code ends

end
```
