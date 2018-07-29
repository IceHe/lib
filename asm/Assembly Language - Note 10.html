title: ASM 汇编语言 10
date: 2015-04-11
noupdate: true
categories: [ASM]
tags: [ASM]
description: ASM - Note&#58; int 指令，中断例程。实现 2*2456^2 。将一个全是字母，以 0 结尾的字符串，转化为大写。用 7ch 中断例程实现 loop 指令的功能。BIOS 和 DOS 所提供的中断例程，及其中断例程的安装过程及其应用。
---

<ul><li>Created on 2014-11</li></ul><br/>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;"><div>教材：《汇编语言》（第二版）王爽 著 清华大学出版社</div><div><br/></div><div><b>章十三、int 指令</b></div><div><b><br/></b></div><div>本章介绍 由int指令引发的中断</div><div><b><br/></b></div><div>13.1 int 指令</div><div>没有做除法，也可以直接使用&nbsp;<b>int 0</b>&nbsp;指令<b>引发除法溢出中断</b>。</div><div><br/></div><div><b>中断处理程序</b>&nbsp;—— 简称：<b>中断例程</b></div><div><b><br/></b></div><div>13.2 编写供应用程序调用的中断例程</div><div><br/></div><div><b>实例1：</b>实现2 * 2456^2</div><div>使用中断处理程序实现平方</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset sqr<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset sqrend - offset sqr<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch], 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch + 2], 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;test sqr<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 3456<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 7ch<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add ax, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; adc dx, dx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
sqr:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mul ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/>
sqrend:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/><br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div><b>实例2</b>：将一个全是字母，以0结尾的字符串，转化为大写。</div><div>把终端程序当作子程序来使用。</div><div>assume cs:code, ds:data<br/>
data segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; db &apos;conversion&apos;, 0<br/>
data ends<br/><br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;install int 7ch<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset capital<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset cap_end - offset capital<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;set int 7ch<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch], 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch + 2], 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;test int 7ch<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, data<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 7ch<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
capital:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;暂存寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pushf<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ch, 0<br/>
r0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cl, ds:[si]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jcxz ok<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp cl, 61h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jb next<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp cl, 7ah<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ja next<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; and byte ptr ds:[si], 11011111b<br/><br/>
next:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp r0<br/><br/>
ok:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;恢复寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; popf<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
cap_end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div>13.3 对int、iret 和 栈的深入理解</div><div>目的：用7ch<b>中断例程实现loop</b>指令的<b>功能</b></div><div>实例：在屏幕中间显示80个感叹号“<b>！</b>”。</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;install<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset lop<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset lop_end - offset lop<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch], 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch + 2], 0<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;test<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 12 * 160<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, offset s - offset se<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 80<br/>
s:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[di], &apos;!&apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 7ch<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;loop s<br/>
se:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/><br/>
lop:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; dec cx&nbsp;&nbsp;&nbsp;&nbsp; ;想想这句可置于jcxz后吗？<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jcxz ed<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;暂存寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bp<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bp, sp<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add ss:[bp + 2], bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;恢复寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bp<br/><br/>
ed:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
lop_end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/><br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div>13.14&nbsp;<b>BIOS</b>&nbsp;和&nbsp;<b>DOS</b>&nbsp;所提供的<b>中断例程</b></div><div>在系统板的ROM中存放着一套程序，</div><div>称为&nbsp;<b>BIOS</b>（基础输入输出系统），</div><div>主要包含以下几部分内容：</div><div>（1）硬件系统的监测和初始化程序</div><div>（2）外部中断（15章中详解）和内部中断的中断例程</div><div>（3）用于对硬件设备进行I/O操作的中断例程</div><div>（4）其它和硬件系统相关的中断例程</div><div><br/></div><div>从OS（操作系统）的角度看，</div><div>DOS的中断例程 就是 OS向coder提供的编程资源。</div><div><br/></div><div><b>BIOS和DOS</b>在所提供的<b>中断例程</b>中<b>提供了</b></div><div>许多实现了程序员在<b>编程时所需功能的子程序</b>。</div><div>可以用&nbsp;<b>int 指令</b>可<b>直接调用</b>它们。</div><div><br/></div><div>和硬件设备相关的DOS中断例程中，</div><div>一般都调用了BIOS的中断例程。</div><div><br/></div><div><br/></div><div>13.5&nbsp;<b>BIOS</b>&nbsp;和&nbsp;<b>DOS 中断例程</b>的<b>安装</b>过程：</div><div>（1）开机，CPU加电，初始化(CS)=0FFFFH，(IP)=0。</div><div>自动从<b>FFFF:0</b>单元执行程序，此处有一条跳转指令，</div><div>然后将<b>跳转</b>到<b>BIOS中</b>的<b>硬件系统检测</b>和<b>初始化程序</b>。</div><div><br/></div><div>（2）初始化程序建立BIOS所支持的中断变量，</div><div>即将<b>BIOS</b>提供的<b>中断例程的入口地址登记</b>在中断向量表中。</div><div>*. 注意：对于BIOS所提供的中断例程，</div><div>只需将入口地址登记入中断向量表即可，</div><div>因为它们具体程序已被固化在ROM中，在内存中一直存在。</div><div><br/></div><div>（3）硬件系统检测和初始化完成后，</div><div>调用&nbsp;<b>int 19h</b>&nbsp;进行<b>操作系统</b>的<b>引导</b>。</div><div>自此计算机交给操作系统控制。</div><div><br/></div><div>（4）DOS启动后，除完成其它工作外，</div><div>还将它所提供的中断例程装入内存，并建立相应的中断向量。</div><div><br/></div><div><br/></div><div><br/></div><div>13.6 BIOS 中断例程应用（例子）</div><div>&nbsp;<b>int 10h 中断例程是 BIOS 提供的</b>，</div><div>其中<b>包含</b>多个和<b>屏幕输出相关</b>的<b>子程序</b>。</div><div><br/></div><div>一般，供程序员调用的中断例程往往包括多个子程序，</div><div>其内部用传递进来的<b>参数决定执行哪个子程序</b>。</div><div><b>都用 ah</b> 来传递<b>内部子程序</b>的<b>编号</b>。</div><div><br/></div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;指使用 int 10h 中断例程的2号子程序——<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;置光标<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov ah, 2</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0&nbsp;&nbsp;&nbsp;&nbsp; ;第0页，bh：页号<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dh, 5&nbsp;&nbsp;&nbsp;&nbsp; ;第5行，dh：行号<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dl, 12&nbsp;&nbsp;&nbsp;&nbsp; ;第12列，dl：列号<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>int 10h&nbsp;</b>&nbsp;&nbsp;&nbsp; ;调用10h号中断例程<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;int 10h 9号子程序——<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;在光标位置显示字符<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov ah, 9</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, &apos;a&apos;&nbsp;&nbsp;&nbsp;&nbsp; ;al：显示的字符<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bl, 7&nbsp;&nbsp;&nbsp;&nbsp; ;bl：颜色属性<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0&nbsp;&nbsp;&nbsp;&nbsp; ;bh：第0页<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 3&nbsp;&nbsp;&nbsp;&nbsp; ;cx：字符重复个数<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>int 10h</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/><br/>
code ends<br/>
end start</div><div><br/></div><div>显示缓冲区分为8页，每页4KB，显示器可以显示任一页内容。</div><div>一般，显示第0页，即是内存B8000H~B8F9FH的内容。</div><div><br/></div><div>关于显示缓冲区，详细参考：<a href="evernote:///view/7264256/s33/396fabf7-1451-4af9-8409-c75e0a2d404f/396fabf7-1451-4af9-8409-c75e0a2d404f/" style="color: rgb(105, 170, 53);">Assembly Language - Note 6</a>&nbsp;文末的图</div><div><br/></div><div><br/></div><div><br/></div><div>13.7 DOS 中断例程的应用</div><div><b>int 21h 中断例程是 DOS 提供的</b>，其中包含了供程序员编程时调用的子程序。</div><div><br/></div><div>之前的程序一直以以下语句结尾：</div><div><b>mov ax, 4c00h</b></div><div><b>int 21h</b></div><div>使用的是 <b>int 21h 中断例程</b>的 <b>4ch 号子程序</b>，</div><div><b>功能</b>为 <b>程序返回</b>，可提供返回值作为参数。</div><div><br/></div><div>mov ah, 4ch &nbsp; &nbsp; ;4ch号子程序，功能：程序返回</div><div>mov al, 0 &nbsp; &nbsp; ;al——返回值</div><div>int 21h</div><div><br/></div><div>int 21h 的 9 号子程序　——　在光标位置显示字符串</div><div>ds:dx　;指向字符串，要显示的字符串需用“$”作为结束符</div><div>mov ah, 9</div><div>int 21h</div><div><br/></div><div>（完整程序）</div><div>assume cs:code<br/>
data segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; db &apos;Welcome to masm!&apos;, &apos;$&apos;<br/>
data ends<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 2&nbsp;&nbsp;&nbsp;&nbsp; ;置光标<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0&nbsp;&nbsp;&nbsp;&nbsp; ;第0页<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dh, 5&nbsp;&nbsp;&nbsp;&nbsp; ;第5行<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dl, 12&nbsp;&nbsp;&nbsp;&nbsp; ;第12列<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 10h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, data<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 9<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div><br/></div><div><b>实验13 编写、应用中断例程</b></div><div><b><br/></b></div><div>（1）编写并安装 int 7ch中断例程，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 功能为显示一个用0结束的字符串，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 中断例程安装在0:200处。</div><div>参数：(dh)=行号，(dl)=列号，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (cl)=颜色，ds:si指向字符串首地址</div><div><br/></div><div>assume cs:code<br/>
data segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; db &apos;Welcome to masm!&apos;, 0<br/>
data ends<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;install<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset show_str<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset show_end - offset show_str<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch], 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch + 2], 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;test<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dh, 10&nbsp;&nbsp;&nbsp;&nbsp; ;row<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dl, 10&nbsp; ;col<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cl, 15&nbsp;&nbsp;&nbsp;&nbsp; ;color<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, data<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 7ch<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
show_str:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;暂存寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 80 * 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mul dh<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add al, dl&nbsp;&nbsp;&nbsp;&nbsp; ;ax + dl * 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; adc ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add al, dl<br/>
&nbsp;&nbsp;&nbsp;&nbsp; adc ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ch, cl<br/>
r0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp byte ptr ds:[si], 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; je ok<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cl, ds:[si]&nbsp;&nbsp;&nbsp;&nbsp; ;此时 ch &amp; cl = color &amp; char<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[di], cx&nbsp;&nbsp;&nbsp;&nbsp; ;此时 es:[di] 内存 为 char &amp; color<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;在寄存器cx中，低字节的char，放在了内存的低地址中<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;即8086CPU是小端模式的<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc&nbsp;&nbsp;&nbsp;&nbsp; si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp r0<br/><br/>
ok:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;恢复寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/>
show_end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2010/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%89%E7%AB%A0%E5%AE%9E%E9%AA%8C13%20%281%29.asm" target="_blank">汇编语言第十三章实验13 (1).asm</a></div><div><br/></div><div><br/></div><div>（2）编写并安装 int 7ch 中断例程，功能为完成loop指令的功能</div><div>参数：(cx)=循环次数，(bx)=位移</div><div>实现：在屏幕中间显示80个 “<b>！</b>”感叹号。</div><div><br/></div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;install<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset lop<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset lop_end - offset lop<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch], 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[4 * 7ch + 2], 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;test<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 12 * 160<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, offset r0 - offset r0_end<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 80<br/>
r0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[di], &apos;!&apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 7ch<br/>
r0_end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
lop:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; dec cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jcxz ok<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bp<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; ;因为sp不是基址寄存器之一，<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;不能靠直接写ss:[sp]来操作它<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;才让sp传值给bp，用ss:[bp + n]……</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bp, sp<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, ss:4[bp]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add ax, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ss:4[bp], ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bp<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
ok:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/>
lop_end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/><br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2010/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%89%E7%AB%A0%E5%AE%9E%E9%AA%8C13%20%282%29.asm" target="_blank">汇编语言第十三章实验13 (2).asm</a><br/></div><div><br/></div><div><br/></div><div>（3）下面的程序，分别在屏幕的第2、4、6、8行</div><div>&nbsp; &nbsp; &nbsp;显示4句英文诗，补全程序：</div><div><br/></div><div>assume cs:code<br/>
code segment<br/>
s1:&nbsp;&nbsp;&nbsp;&nbsp; db &apos;Good,better,bset,&apos;, &apos;$&apos;<br/>
s2:&nbsp;&nbsp;&nbsp;&nbsp; db &apos;Never let it rest,&apos;, &apos;$&apos;<br/>
s3:&nbsp;&nbsp;&nbsp;&nbsp; db &apos;Till good is better,&apos;, &apos;$&apos;<br/>
s4: db &apos;And better,best.&apos;, &apos;$&apos;<br/>
s:&nbsp;&nbsp;&nbsp;&nbsp; dw offset s1, offset s2, offset s3, offset s4<br/>
row:&nbsp;&nbsp;&nbsp;&nbsp; db 2, 4, 6, 8<br/><br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, offset s<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset row<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 4<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
ok:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;int 10h中断例程的2号子程序，置光标<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;bh：页号<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;dh：行号<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;dl：列号<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dh, <b>ds:[si]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dl, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 10h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;int 21h的9号子程序，在光标位置显示字符串<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;ds:dx 指向字符串，要显示的字符串需用“$”作为结束符<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dx, <b>ds:[bx]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 9<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add bx, 2</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop ok<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2010/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%89%E7%AB%A0%E5%AE%9E%E9%AA%8C13%20%283%29.asm" target="_blank">汇编语言第十三章实验13 (3).asm</a><br/></div></div>
