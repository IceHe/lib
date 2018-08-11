title: ASM 汇编语言 9
date: 2015-04-10
noupdate: true
categories: [ASM]
tags: [ASM]
description: ASM - Note&#58; 内中断，中断处理程序，中断向量表，中断过程。安装、设置中断向量，单步中断。编写 0 号中断的处理程序。
---

<ul><li>Created on 2014-11</li></ul><br/>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;"><div>教材：《汇编语言》（第二版）王爽 著 清华大学出版社</div><div><br/></div><div><b>章十二、内中断</b></div><div><br/></div><div><b>中断</b>：CPU不再接着（刚执行完的指令）向下执行</div><div><br/></div><div>12.1 内中断的<b>产生</b></div><div>当8086 CPU发生以下情况时，将产生马上处理的中断信息：</div><div>&nbsp; &nbsp; &nbsp;*. 右边数字为<b>中断类型码</b></div><div>（1）<b>除法</b>错误（执行div时产生溢出） - 0</div><div>（2）<b>单步</b>执行 - 1</div><div>（3）执行<b>into</b>指令 - 4</div><div>（4）执行<b>int</b>指令 - 该指令的格式为 <b>int n</b></div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 指令中n为byte型立即数，是提供给CPU的中断类型码</div><div><br/></div><div>12.2&nbsp;<b>中断处理</b>程序</div><div>根据中断类型码，定位相应中断处理程序</div><div><br/></div><div>12.3&nbsp;<b>中断向量表</b></div><div>中断向量表，存储<b>256个</b>中断处理程序的&nbsp;<b>入口地址</b>（CS:IP）</div><div>它在内存中存放，对于8086PC机，<b>放在内存地址0处</b></div><div>（在0000:0000~0000:03FF，CS、IP地址分别都是dword，共占4B）</div><div><br/></div><div>12.4 <b>中断过程</b>：</div><div>（1）从中断信息中，取得<b>中断类型码 N</b></div><div>（2）<b>标志寄存器</b>的值<b>入栈</b>，pushf</div><div>&nbsp; &nbsp; &nbsp;（因为中断过程中要改变标志寄存器的值，要先将其保存在栈中）</div><div>（3）将标志寄存器的第8位 <b>TF</b> 和 第9位 <b>IF</b>&nbsp;的值 设<b>置为 0</b></div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TF = 0， IF = 0（目的日后详述）</div><div>（4）<b>CS</b> 的内容 <b>入栈</b>，push cs</div><div>（5）<b>IP</b>&nbsp;的内容&nbsp;<b>入栈</b>，push ip</div><div>（6）设置中断处理程序的入口地址</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; IP = (中断类型码 * 4) &nbsp; &nbsp; ; 用地址为&nbsp;中断类型码 * 4 的内存内容 设置IP</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CS = (中断类型码 * 4 + 2) &nbsp; &nbsp; ; 类上</div><div>然后执行中断处理程序</div><div><br/></div><div>12.5&nbsp;中断处理程序 使用 <b>iret</b> 指令返回</div><div><b>iret</b> 功能：<b>&nbsp;pop ip &nbsp; &nbsp;&nbsp;pop cs</b> &nbsp; &nbsp;&nbsp;<b>popf</b></div><div><br/></div><div><br/></div><div>12.6 除法错误中断的处理</div><div>12.7 编程处理 0 号（除法错误）中断</div><div>12.8 安装</div><div>12.9 do1</div><div>12.10设置中断向量</div><div><br/></div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset do0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;0000:0000~0000:03FF 为中断向量表<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;而0200~02FF还不被其它程序包括OS等使用<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;可以安全使用<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>;传输长度<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset do0end - offset do0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld&nbsp;&nbsp;&nbsp;&nbsp; ;设置传输方向为正<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb &nbsp; &nbsp; ;安装程序</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;设置中断向量表<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov word ptr es:[0 * 4], 200h&nbsp;&nbsp;&nbsp;&nbsp; ;ip<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[0 * 4 + 2], 0&nbsp;&nbsp;&nbsp;&nbsp; ;cs</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
do0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp short do0start<br/>
&nbsp;&nbsp;&nbsp;&nbsp; db &apos;Overflow!&apos;<br/>
do0start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;指向上面定义的那串字符<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 202h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;指向显示空间的中间位置<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 12 * 160 + 36 * 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 9<br/>
s:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, [si]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[di], al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add di, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop s<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
do0end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/><br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%209/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%8C%E7%AB%A0%E5%AE%89%E8%A3%85%E5%85%B3%E4%BA%8E%E9%99%A4%E6%B3%95%E6%BA%A2%E5%87%BA%E7%9A%84%E4%B8%AD%E6%96%AD%E7%A8%8B%E5%BA%8F%E7%9A%84%E5%AE%9E%E4%BE%8B.asm" target="_blank">汇编语言第十二章安装关于除法溢出的中断程序的实例.asm</a></div><div><br/></div><div><br/></div><div>12.11 单步中断</div><div>使&nbsp;<b>TF = 1</b>，<b>CPU</b>将工作于 <b>单步中断</b> 方式下，</div><div>执行完这条指令后，就引发单步中断</div><div><br/></div><div>当然，<b>进入中断</b>处理<b>程序前</b>，设<b>置TF = 0</b>，</div><div>避免在中断处理程序执行中发生单步中断</div><div><br/></div><div>12.12 响应中断的特殊情况</div><div>在执行完<b>向 ss</b> 寄存器<b>传送数据的指令后</b>，</div><div>即便<b>发生中断</b>，CPU<b>也不会响应</b></div><div><b><br/></b></div><div>主要原因：</div><div>ss:sp 联合指向栈顶，而对它们的设置应该连续完成。</div><div>因为假如<b>设置完ss后</b>被中断，需要压栈保存数据，</div><div>此时<b>后续设置sp的语句没有执行</b>，于是<b>中断处理保存了错误的sp</b>。</div><div>中断恢复后，会导致<b>sp没有指向正确的栈顶</b>！</div><div><br/></div><div>所以<b>设置sp的语句</b>，<b>紧跟设置ss的语句！</b></div><div><b><br/></b></div><div><b><br/></b></div><div><b>实验12 编写0号中断的处理程序</b></div><div>编写0号中断的处理程序，使得在出发溢出发生时，</div><div>在屏幕中间显示字符串“divide error！”，然后返回到DOS。</div><div><br/></div><div><b>类同12.10小节下的程序</b></div><div><b><br/></b></div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, cs&nbsp;&nbsp;&nbsp;&nbsp; ;cs 曾错写为 offset do<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset do&nbsp;&nbsp;&nbsp;&nbsp; ;offset do 曾错写为 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset do_end - offset do<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[0 * 4], 200h&nbsp;&nbsp;&nbsp;&nbsp; ;ip<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[0 * 4 + 2], 0&nbsp;&nbsp;&nbsp;&nbsp; ;cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 1000<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 1<br/>
&nbsp;&nbsp;&nbsp;&nbsp; div bh<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
do:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 200h + offset msg - offset do<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 12 * 160 + 2 * (40 - (offset do_end - offset msg) / 2)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset do_end - offset msg<br/>
s:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, ds:[si]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[di], al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add di, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop s<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
msg:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; db &quot;divide error!&quot;&nbsp;&nbsp;&nbsp;&nbsp; ;13字<br/>
do_end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
code ends<br/>
end start</div><div><br/></div><div>后记：</div><div>1. 趁着对12.10小节的中断处理程序的安装程序还有印象时，重写的。不够独立。</div><div>2.竟然对照12.10小节的程序来debug！不能容忍有下次！</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%209/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%8C%E7%AB%A0%E5%AE%9E%E9%AA%8C10.asm" target="_blank">汇编语言第十二章实验10.asm</a></div></div>
