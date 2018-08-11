title: ASM 汇编语言 3
date: 2015-04-03
noupdate: true
categories: [ASM]
tags: [ASM]
description: ASM - Note&#58; 汇编指令，伪指令，segment … ends，end，assume，编译和连接，执行过程的跟踪，单步调试，[BX] 和 loop 指令，Debug 程序的各种命令，段前缀，一段安全的空间。
---

<ul><li>Created on 2014-10</li></ul><br/>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;"><div>教材：《汇编语言》（第二版）王爽 著 清华大学出版社</div><div><br/></div><div><b>章四、第一个程序</b></div><div><br/></div>
4.2 源程序 例：
<div><br/><div>assume cs:codesg</div><div>codesg <b>segment</b></div><div>&nbsp; &nbsp; &nbsp;</div><div>&nbsp; &nbsp; &nbsp;mov ax, 0123H</div><div>&nbsp; &nbsp; &nbsp;...</div><div>&nbsp; &nbsp; &nbsp;add ax, bx</div><div>&nbsp; &nbsp; &nbsp;int 21H</div><div><br/></div><div>codesg <b>ends</b></div></div><div>end</div><div><b><br/></b></div><div>汇编指令：有对应机器码的指令，可以被译为机器指令，被CPU执行。</div><div>伪指令：没有对应机器码的指令，是由编译器来执行的指令，编译器根据它来进行相关编译工作。</div><div><br/></div><div>伪指令，如：</div><div><br/></div><div>（1） segment ... ends</div><div>成对使用，用于定义一个段。</div><div>xxx <b>segment</b></div><div>&nbsp; &nbsp; &nbsp;...</div><div>xxx <b>ends</b></div><div>一个汇编程序，由多个段组成。</div><div>这些段，用于存放代码、数据、或当作栈空间使用。</div><div><br/></div><div>（2）end</div><div>汇编程序的结束标记。</div><div>编译程序碰到伪指令end就会停止对源程序的编译。</div><div><br/></div><div>（3）assume</div><div>含义为：“假设”。</div><div>假设某一段寄存器和程序中某一个用segment...ends定义的段相关联。</div><div><br/></div><div>4.4 编译源文件</div><div>后缀：“.asm”</div><div>masm：微软的masm5.0汇编编译器。</div><div>（下载链接：<a href="http://download.pchome.net/development/linetools/down-9028-1.html">http://download.pchome.net/development/linetools/down-9028-1.html</a>）</div><div><br/></div><div>编译过程中，我们提供源程序文件，最多可以得到3个输出：</div><div>目标文件.obj、列表文件.lst、交叉引用文件.crf。</div><div>（后两个是中间结果，在汇编语言课程中，不讨论它们）</div><div><br/></div><div>4.5 连接</div><div>使用微软的Overlay Linker3.60连接器。</div><div>连接过程中，需要目标文件.obj、库文件.lib（可能没有），</div><div>产生exe，还有中间结果映像文件.map。</div><div><br/></div><div>4.6 以简化的方式进行编译和连接</div><div>输入以下指令，进行编译、连接、运行：</div><div>masm path\src_file_name<b>;</b></div><div>link path\obj_file_name<b>:</b></div><div>exe_name</div><div><br/></div><div>*. <b>重点</b>：masm、link指令后面加上<b>分号</b>“ <b>;</b> ”</div><div>就可以跳过中间输入参数的过程</div><div><br/></div><div>4.8 谁将exe中的program装载入内存并使它运行？</div><div>任何通用的操作系统，都要提供一个称为<b>shell</b>（外壳）的程序，</div><div>用户使用此程序来操作计算机系统进行工作。</div><div><br/></div><div>DOS中有一个程序<b>command.com</b>，称为<b>命令解释器</b>，就是<b>DOS的Shell程序</b>。</div><div><br/></div><div>用户要执行一个程序：</div><div>command.com根据输入的文件名找到exe；</div><div>将exe中的program加载入memory；</div><div>设置CS:IP（两个寄存器）指向程序的入口；</div><div>command.com停止运行，CPU运行被调用的程序；</div><div>运行结束后，返回到command中，等待用户再次输入。</div><div><br/></div><div>4.9程序执行过程的跟踪</div><div>debug.exe可以将程序加载入内存，设置CS:IP指向程序的入口，</div><div>但并不放弃对CPU的控制，所以可以单步执行程序，查看每条指令的执行结果。</div><div><br/></div><div>单步的时候，使用T指令，</div><div>但到了最后一条指令 int 21时，使用P指令。（暂时不要理会that&apos;s why）</div><div><br/></div><div>Q指令：退出debug.exe。</div><div><br/></div><div><br/></div><div><b>章五、[BX]和loop指令</b></div><div><br/></div><div>[offset]——指一个内存单元的地址，</div><div>段地址在DS（data segment）段寄存器中，偏移量是&quot;[ ]&quot;中的数字，</div><div>地址实际是 DS * 16 + offset，即DS * 10H + offset，</div><div>即DS内的数（16进制）左移一位再与offset相加。</div><div><br/></div><div>(pos)——表示一个寄存器或一个内存单元中的内容。</div><div>(ax)表示ax中的内容，(al）表示al里的内容。</div><div><br/></div><div>“( )”中的元素有三种：1.寄存器名；2.段寄存器名；3.内存单元物理地址（一个20bits的数据）</div><div><br/></div><div>“( )”所表示的数据有两种类型：1.字节；2.字。</div><div>属于哪一种类型由寄存器名或具体的运算决定。</div><div><br/></div><div>约定<b>idata</b>表示<b>常量</b>。mov ax, [idata] 就代表 mov ax, [3]... 等。</div><div><br/></div><div>5.2 <b>loop指令</b>，例</div><div>&nbsp; &nbsp; &nbsp;mov ax, 2</div><div>&nbsp; &nbsp; &nbsp;mov cx, 11</div><div>s: &nbsp; add ax, ax</div><div>&nbsp; &nbsp; &nbsp;loop s &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;// s是标号</div><div>&nbsp; &nbsp; &nbsp;...</div><div>（1）标号，在汇编语言中，代表一个地址（标识了一个地址）。</div><div>（2）CPU执行<b>loop</b> s，要进行两步操作：</div><div>&nbsp; &nbsp; &nbsp;a. (cx) = (cx) - 1</div><div>&nbsp; &nbsp; &nbsp;b. 判断(cx) 的值，不为0，则转至标号s所标识的地址处执行，即add ax, ax。</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 若为0，则执行吓一跳指令，即loop s之后的指令。</div><div><br/></div><div>5.3 在Debug中跟踪用loop指令实现的循环程序</div><div>大于9FFFH（最后一位H，表示该数为16进制数）的十六进制数，</div><div>如A000H、B001H、...、FFFFH等，在书写中都是以字母开头的。</div><div>而<b>在汇编语言中，数据不能以字母开头，所以要在开头加上数字0。</b></div><div><br/></div><div><b>Debug</b>程序的</div><div><b>G命令：</b></div><div>g 0012 ：将程序运行到CS:0012这个地方。</div><div><b>P命令：</b></div><div>在遇到 loop xxx 的loop指令语句时，使用P命令，</div><div>debug就会自动将程序一直运行，直到(cx) == 0，</div><div>然后，指向loop的下一条指令。</div><div><br/></div><div>5.4 Debug和汇编编译器masm对指令的不同处理</div><div>在汇编程序中，指令“mov ax, [0]”被编译器当作指令“mov ax, 0”处理。</div><div>Debug将其解释为[idata]是一个内存单元，“idata”是内存单元的偏移地址；</div><div>而编译器将[idata]解释为idata。</div><div><br/></div><div>那么怎么让写的程序，用汇编编译器也能使用相对寻址？</div><div>目前方法：将偏移地址送入bx（base 段寄存器）寄存器中，</div><div>再用[bx]的编写方式，就可以来访问DS:(bx)的内存单元。</div><div>更好的方法：这么写指令“mov al&nbsp;<b>ds:</b>[0]”，</div><div>显式地给出段地址所在的段寄存器</div><div><br/></div><div>5.6 段前缀</div><div>出现在访问内存单元的指令中，用于显式地指明内存单元的段地址。</div><div>如：ds:、cs:、ss:、es:。</div><div><br/></div><div>5.7 一段安全的空间</div><div>DOS方式下，DOS和其它合法的程序一般都不会使用</div><div>0:200~0:2ff（00200H~002ffH）的256bytes的空间。</div><div><br/></div><div>实验4 [bx]和loop的使用</div><div>（1）编程，向内存0:200~0:23F依次传送0~63（3FH）。</div><div>（2）进阶要求：只能使用9条指令，包括mov ax, 4c00h 和 int 21h。</div><div>assume cs:code<br/>
code segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 20h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 40h<br/>
s: &nbsp; mov ds:[bx], bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop s<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end</div><div><br/></div><div>（3）将程序mov ax, 4c00h之前的指令复制到内存0:200处。</div><div>assume cs:code<br/>
code segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 20h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 22<br/><br/>
s:&nbsp;&nbsp;&nbsp;<b>mov al, ds:[bx]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[bx], al</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop s<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end</div></div>
