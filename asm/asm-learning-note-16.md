# ASM 汇编语言 15

> ASM - Note&#58; Intel 系列微处理器的 3 种工作模式。汇编编译器（masm.exe）对jmp的相关处理，编译器中的地址计数器（AC），对伪操作指令的处理。用栈传递参数。无溢出除法的公式证明。

- Created on 2014-11
- 教材：《汇编语言》（第二版）王爽 著 清华大学出版社

 
教材：《汇编语言》（第二版）王爽 著 清华大学出版社
 

 

**附注1 **Intel**系列**微处理器**的**3种工作模式**** 

 
重要版本8086/8088、80386。
 

 
80386具备了80286对多任务系统的支持，
 
又对8086/8088兼容。
 

 
它可以在以下3个模式下工作：
 
- **实模式**：工作方式相当于一个8086
 
- **保护**模式：提供支持多任务环境的工作方式，
 
     建立爆出机制（这与VAX等小型机类似）。
 
- **模拟8086**模式：可从保护模式切换至其中的一种8086工作方式。
 
     这种方式的提供使用户可以方便地在保护模式下运行一个或多个原8086程序。
 

 
PC**一开机**，处于**实模式**。**DOS**处于实模式。
 
**Windows**系统在加载后，会将CPU切换到**保护模式**。
 
在**Windows下**运行一个**DOS**下的**程序**，CPU切换至
 
**模拟8086**模式下运行该程序。
 

 

 

 
**附注2 补码**
 

 
特别注意点：1000 0000b = -128
 

 

 

 
**附注3 **汇编编译**器（masm.exe）对**jmp的相关处理****
 

 
1. 向前转移
 
先读到标号，后读到jmp指令
 
s:     ...
 
       ...
 
     jmp s（jmp short s / jmp near ptr s / jmp far ptr s）
 

 
**编译器**中**有**一个**地址计数器（AC）**，
 
编译过程中，每读到一字节，AC+=1。
 
当编译器遇到一些伪操作时，如db / dw等，
 
会根据实际情况使AC增加。
 

 
向前转移时，complier读到 **标号s** 后，
 
记下此时**AC的值**为 **as**（annotation start？），
 
在读到 **jmp  ... s** 后，记下此时AC的值为 **aj**（annotation jmp？）。
 
那么可以通过 **as - aj** 算出**位移值 disp**。
 

 
- 若**disp**属于**[-128, 127]**，这不管汇编指令格式是：
 
          jmp s / jmp short s / jmp near ptr s / jmp far ptr s
 
          **都**会转变**为 jmp short s** 所对应的**机器码：**
 
**               EB disp**（占 2 Bytes）；
 

 
- 若disp属于**[-32768, 32767]**，则：
 
          对于 **jmp short** 将产生编译**错误**；
 
          对于 **jmp s、jmp near ptr s**，
 
               将产生**jmp near ptr s** 所对应的**机器码：**
 
**               E9 disp**（占 3 Bytes）；
 
          对于 **jmp far ptr s**，将产生对应的机器码：
 
               **EA 偏移地址 段地址**（占 5 Bytes）。
 

 

 
2.向后转移：
 
先读到jmp指令，后读到标号
 
     jmp s（jmp short s / jmp near ptr s / jmp far ptr s）
 
       ...
 
s:     ...
 

 
在此情况下，complier先读到 jmp ... s 指令，
 
由于还没读到 标号s，所以不能确定 其位置的AC值，
 
即不能确定 disp 值。
 

 
此时，complier将 jmp ... s 都当作 jmp short s 来读取，
 
记下jmp指令的位置和AC的值作为 aj（annotation jmp？），
 
并作以下处理：
 

 
a. 对于 jmp **short** s，complier生成 **EB** 和 **一个** **nop** 指令，
 
     即用 nop **预留 1 Byte **空间，存放 **8 bits** 的**disp**。
 

 
b. 对于 **jmp s** 和 jmp **near ptr** s，生成 **E9 **和 **两个 nop** 指令，
 
     即 预留 **2** Bytes，放 **16** bits 的disp。
 

 
c. 对于 jmp **far ptr** s， 生成 **EA** 和 **四个** nop 指令，
 
     即 预留 **4 Bytes**，放 **段地址** 和 **段地址**。
 

 
以上处理完后，当向后读到 标号s 时，
 
记下此时AC的值作为 as（annotation start？），
 
并计算出转移的位移量：**disp = as - aj**（公式与向前转移相同）。
 

 
- 若**disp**属于**[-128, 127]**，这不管汇编指令格式是：
 
          jmp s / jmp short s / jmp near ptr s / jmp far ptr s
 
               **都**在前面记下的 jmp ... s 指令位置处添上
 
               jmp short s对应的机器码：**EB disp**
 
          *注意：此时，对于 jmp s 和 jmp near ptr s 格式，
 
               在机器码 EB disp 后还有 1 条 nop 指令（空着）；
 
               对于jmp far ptr s，在机器码EB disp后还有3条nop指令（空着）。
 

 
- 若disp属于**[-32768, 32767]**，则：
 
          对于 **jmp short** 将产生编译**错误**；
 
          对于 **jmp s、jmp near ptr s**，
 
               在前面记下的 jmp ... s 指令位置处添上
 
               jmp near ptr s对应的机器码：**E9 disp**（占 3 Bytes）；
 
          对于 **jmp far ptr s**，在前面记下的 jmp ... s 指令位置处添上
 
               **EA 偏移地址 段地址**（占 5 Bytes）。
 

 

 

 
**附注4 用栈传递参数**
 

 
此技术和高级语言编译器的工作原理密切相关，
 
结合C语言的函数调用来描述。
 

 
栈传递参数原理：
 
由调用者将需要传递给子程序的参数压入栈中，
 
子程序从栈中去取得参数。
 

 
（例）
 
;说明：计算(a-b)^3，a、b为字型数据
 
;参数：进入子程序时，栈顶存放IP，后面依次存放a、b
 
;结果：**(dx:ax)=(a-b)^3**
 
dif_cube:
 
**     push bp**
 
     mov bp, sp
 
**     mov ax, [bp + 4]     ;后入栈的是a**
 
**     sub ax, [bp + 6]     ;先入栈的是b**
 
     mov bp, ax
 
     mul bp
 
     mul bp
 
     pop bp
 
     ret 4
 

 
一个子程序结尾有：**ret n**
 
n为整数，意思是，将**栈顶**指针修**改为调用前的值**。
 
**ret n** 功能等于 **pop ip     add sp, n**
 

 
调用dif_cube程序的代码如下：
 
mov ax, 1     ;b
 
push ax
 
mov ax, 3     ;a
 
push ax
 
call diff_cube     ;注意参数压栈的顺序
 

 

 
1.语句call diff_cube后，栈的情况：                      IP      a        b
 
1000:0000     00 00 00 00 00 00 00 00 | 00 00 XX XX 03 00 01 00
 
                                                                     **↑ ss:sp**
 
2.dif_cube执行第1句push bp后：               bp      IP       a       b
 
1000:0000     00 00 00 00 00 00 00 00 | ZZ ZZ XX XX 03 00 01 00
 
                                                            **↑ ss:sp**
 
3.所以，dif_cube 子程序以下语句中的 **[bp + 4]指 a**，**[bp + 6]指 b**。
 
mov ax, [bp + 4]     ;后入栈的是a
 
sub ax, [bp + 6]     ;先入栈的是b
 

 

 
利用**C程序，**了解**栈**在**参数传递**中的应用：
 
*.注意：在**C**语言中，**局部变量**也在**栈中存储**。
 

 
void add(int, int, int);
 
main(){
 
     int a = 1;
 
     int b = 2;
 
     int c = 0;
 
     add(a, b, c);
 
     c++;
 
}
 
void add(int a, int b, int c){
 
     c = a + b;
 
}
 

 
编译后的汇编程序：
 

 
mov bp, sp     ;bp = 原栈顶位置 sp
 
**sub sp, 6**     **;栈顶sp - 6，留出空间存放数据段？**
 

 
mov word ptr [bp - 6], 0001     ;int a
 
mov word ptr [bp - 4], 0002     ;int b
 
mov word ptr [bp - 2], 0000     ;int c
 

 
push [bp - 2]     ;push c
 
push [bp - 4]     ;push b
 
push [bp - 6]     ;push a
 
call ADDR
 

 
**add sp, 6     ;sp恢复回原栈顶top的位置？**
 
inc word ptr [bp - 2]
 

 
ADDR:
 
     push bp
 

 
     mov bp, sp     ;这里的bp = 新栈顶位置 sp
 
     mov ax, [bp + 4]     ;b
 
     add ax, [bp + 6]     ;a?    **（有点蒙？这里我画图理解，放的应该是c？淡忘之后再分析一次）**
 
     mov [bp + 8], ax
 
     mov sp, bp
 
     
 
     ;栈的情况：a b c | a b c
 
     ;                ↑top=bp
 
     ;左边abc是压入的参数，右边abc是其源
 

 
     pop bp
 
     ret
 

 

 

 
**附注5 （****无溢出除法****）公式证明**
 

 
**无溢出除法**公式：
 

 
H：x的高16位
 
L：x的低16位
 
int()：取商
 
rem()：取余
 

 
H = int( x / 65536)     ; 即 H = x / 0FFFFH
 
L = rem( x / 65536)     ; 即 L = x % 0FFFFH
 

 
**X / n = int(H / n) * 65536 + [rem(H / n) * 65536 + L] / n**
 

 
     ;乘以65536，等于左移16位
 
     ;1.被除数x的高16位，除以除数n得到，x/n的商的高16位；
 
     ;2.被除数x的高16位，除以除数n得到的余， 加上被除数x的低16位，
 
     ;   除以除数n得到，x/n的商的低16位。
 

 

 
**综合研究**
 
（因为寻找适用的tc.exe无果，此部分暂且放弃）
 
研究实验1 **搭建一个精简的C语言开发环境**
 
研究实验2 **使用寄存器**
 
研究实验3 **使用内存空间**
 
研究实验4 **不用main函数编程**
 
研究实验5 **函数如何接收**

