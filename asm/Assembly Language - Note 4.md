title: ASM 汇编语言 4
date: 2015-04-04
noupdate: true
categories: [ASM]
tags: [ASM]
description: ASM - Note&#58; 使用栈，将数据、代码、栈放入不同的段，编写并调试具有多个段的程序，以字符形式给出数据，大小写转换问题，[idata] 直接寻址，[bx] 间接寻址，[bx + idata] 相对寻址，SI 和 DI 寄存器。
---

<ul><li>Created on 2014-10</li></ul><br/>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;"><div>教材：《汇编语言》（第二版）王爽 著 清华大学出版社</div><div><br/></div><div><b>章六、包含多个段的程序</b></div><div><br/></div><div>程序取得所需空间的方法：</div><div>（1）在加载程序的时候为程序分配。</div><div>（2）在执行过程中向系统申请。（本教材不讨论该方法）</div><div><br/></div>
6.1 在代码段中使用数据
<div>assume cs:code<br/>
code segment<br/>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; data<br/>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ...<br/><b>start:</b> &nbsp;program<br/>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ...<br/>
code ends<br/>
end <b>start</b></div><div>末尾指定程序入口——</div><div>加载者从程序的可执行文件的描述信息中读到程序的入口地址。<br/>
&nbsp;</div><div>指令：dw 0123h, 0456h, ..., 0987h</div><div>dw的含义——定义字型数据，即define word。</div><div>assume cs:code<br/>
code segment<br/>
&nbsp; &nbsp; &nbsp;dw 0123h, 0456h, ..., 0987h<br/>
&nbsp; &nbsp; &nbsp;...<br/>
code ends<br/>
end</div><div>这些数据现在存储于CS:0~CS:x。</div><div>以cs为基址，偏移得到。</div><div><br/></div><div>6.2 在代码段中使用栈</div><div>可以使用dw 0, 0, 0, ..., 0的方式，开辟内存空间，</div><div>然后可以用来存放数据，可以作为栈使用。</div><div>assume cs:code<br/>
code segment<br/>
&nbsp; &nbsp; &nbsp;dw 0123h, 0456h, ..., 0987h（8个字数据）<br/>
&nbsp; &nbsp; &nbsp;dw 0,0,0, ... , 0（16个字数据）</div><div>st: &nbsp;mov ax, cs</div><div>&nbsp; &nbsp; &nbsp;mov ss, ax</div><div>&nbsp; &nbsp; &nbsp;mov sp, 30h（前面dw使用了24words，共48bytes，即30H bytes）</div><div>&nbsp; &nbsp; &nbsp;// 这样栈就出现了~</div><div>&nbsp; &nbsp; &nbsp;...</div><div>code ends<br/>
end st</div><div><br/></div><div>6.3 将数据、代码、栈放入不同的段</div><div>把数据、代码、栈等放到一个段：</div><div>（1）程序显得杂乱</div><div>（2）如果它们所需的空间超过64KB（8086CPU的限制），就不能放到一个段里面了。</div><div><br/></div><div>通过定义数据来获取内存空间，定义多个段：</div><div>assume <b>cs:code, ds:data, ss:stack</b></div><div><b>data</b> segment</div><div>&nbsp; &nbsp; &nbsp;dw 0123h, 0456h, ..., 0987h</div><div>data ends</div><div><br/></div><div><b>stack</b> segment</div><div>&nbsp; &nbsp; &nbsp;dw 0,0,0, ... , 0</div><div>stack ends</div><div><br/></div><div>code segment</div><div>start: &nbsp; &nbsp; mov ax, <b>stack</b> ...</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;mov ax, <b>data</b></div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;...</div><div>code ends</div><div>end start</div><div><br/></div><div>实验6 编写、调试具有多个段的程序</div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%204/%E5%AE%9E%E9%AA%8C%E9%A2%985%285%29.asm" target="_blank">实验题5(5).asm</a><br/></div><div><br/></div><div><b>db 1, 2, 3, 4, 5, ... // define byte</b></div><div>dw 1ah, 2bh, 3ch, ... // define word</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%204/%E5%AE%9E%E9%AA%8C%E9%A2%985%286%29.asm" target="_blank">实验题5(6).asm</a></div><div><br/></div><div>例：mov ax, [bx + 200] 等于 mov ax, [si +200] 以及 mov ax, [di +200]。</div><div><br/></div><div><br/></div><div><b>章七、更灵活的定位内存地址的方法</b></div><div><br/></div><div>7.1 and 和 or 指令</div><div>（1）and指令：逻辑与，按位进行与运算。</div><div>（2）or指令：逻辑或，....。</div><div>mov al, 01100011B</div><div><b>and &nbsp;al, 00111011B</b>&nbsp;// 后缀B代表这是二进制串</div><div>or &nbsp; &nbsp; al, 00111011B</div><div><br/></div><div>7.2 ASCII</div><div>7.3 以字符形式给出的数据</div><div>可以在汇编程序中，<b>用&nbsp;&apos;xxxx&apos; 的方式指明</b>数据是<b>以字符的形式给出</b>的<b>，</b></div><div>编译器将把它们转化为相对应的ASCII码。例：</div><div>data segment</div><div>&nbsp; &nbsp; &nbsp;db &apos;unIX&apos;</div><div>&nbsp; &nbsp; &nbsp;db &apos;foRK&apos;</div><div>data ends</div><div>code segment</div><div>start:</div><div>&nbsp; &nbsp; &nbsp;mov al, &apos;a&apos;</div><div>&nbsp; &nbsp; &nbsp;mov bl, &apos;b&apos;</div><div>&nbsp; &nbsp; &nbsp;...</div><div>code ends</div><div>end start</div><div><br/></div><div>7.4 大小写转换问题</div><div>字母 &nbsp; &nbsp; 16进制 &nbsp; &nbsp; 10进制 &nbsp; &nbsp; 二进制</div><div>A &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;41 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;65 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;01000001</div><div>...</div><div>Z &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;5A &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;90 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;01011010</div><div><br/></div><div>a &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;61 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;97 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 01100001</div><div>...</div><div>z &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;7A &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;122 &nbsp; &nbsp; &nbsp; &nbsp; 01111010</div><div>看得出来大写字母的编码比小写字母小了</div><div>10000B，即十进制的32，十六进制的20H。</div><div><br/></div><div>那么大写字母转换成小写字母可以：</div><div>mov [bx], &apos;A&apos;</div><div>or [bx], 00100000B</div><div><br/></div><div>那么小写字母转换成大写字母可以：</div><div>mov [bx], &apos;a&apos;</div><div>and [bx], 11011111B</div><div><br/></div><div><b>[idata] 直接寻址</b></div><div><b>[bx] 间接寻址</b></div><div><b><br/></b></div><div>7.5&nbsp;<b>[bx + idata] 相对寻址</b></div><div>可以用[bx]指明一个内存单位，还有更为灵活的方式：</div><div>[bx + idata]。如，[bx + 200]，或 [200 + bx]。</div><div>7.6 用[bx + idata]的方式进行数组的处理</div><div><br/></div><div>7.7 SI 和 DI （寄存器）</div><div>si和di是8086CPU中和bx功能相近的寄存器，</div><div>si和di不能够分成两个8位寄存器来使用，但bx可以分为bl和bh。</div></div>
