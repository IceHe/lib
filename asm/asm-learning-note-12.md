title: ASM 汇编语言 12
date: 2015-04-13
noupdate: true
categories: [ASM]
tags: [ASM]
description: 外中断。接口芯片和端口，可屏蔽中断、不可屏蔽中断。PC 机键盘的处理过程。编写 int 9 中断例程，并将其安装。
---

<ul><li>Created on 2014-11</li></ul><br/>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;"><div>教材：《汇编语言》（第二版）王爽 著 清华大学出版社</div><div><br/></div><div><b>章十五、外中断</b></div><div><b><br/></b></div><div>15.1 接口芯片和端口</div><div>外设的输入不直接送入内存和CPU，</div><div>而是送入相关的接口芯片的端口中；</div><div>CPU向外设输出也不直接送入外设，</div><div>也是送入端口中。</div><div>CPU还可以向外设输出控制命令。</div><div><br/></div><div><b>CPU通过端口和外部设备进行联系。</b></div><div><br/></div><div><br/></div><div>15.2 外中断信息</div><div>例：外设输入到达时，相关芯片将向CPU发出相应的中断信息。</div><div>CPU在执行完当前指令后，可以检测到发送过来的中断信息，</div><div>引发中断，处理外设输入。</div><div><br/></div><div><br/></div><div><b>外中断源</b>，共有以下<b>两类</b>：<b>可屏蔽中断/不可屏蔽中断</b></div><div><b><br/></b></div><div>1.<b>可屏蔽中断</b></div><div>即，CPU可以不响应的外中断。</div><div><br/></div><div>CPU<b>是否响应可屏蔽中断</b>，<b>取决于标志</b>寄存器中<b>IF位</b>。</div><div>若<b>IF&nbsp;= 1</b>，<b>可屏蔽中断可引发</b>CPU的中断过程；</div><div>若<b>IF&nbsp;= 0</b>，则<b>不响应</b>可屏蔽中断。</div><div><br/></div><div>回忆<b>内中断引发过程</b>，</div><div>（1）取中断类型码n（2）标志寄存器入栈，<b>IF=0</b>，TF=0；</div><div>（3）CS、IP入栈（4）(ip) = (n * 4), (cs) = (n * 4 + 2)</div><div>然后转去执行中断处理程序（中断例程）。</div><div><br/></div><div>可屏蔽中断所引发的中断过程，除第（1）步的&nbsp;</div><div>实现与内中断有所不同外，</div><div>其它与内中断的中断过程基本上相同。</div><div>之所以<b>第（2）步 IF 置为0</b>，在<b>进入中断处理程序后</b>，<b>禁止其它的可屏蔽中断</b>！</div><div><br/></div><div><br/></div><div>2.<b>不可屏蔽中断</b></div><div><b>CPU必须响应的外中断</b>——检测到它的信息时，执行完当前指令后，立即响应。</div><div><br/></div><div>对于<b>8086CPU</b>，<b>不可屏蔽中断</b>的<b>中断类型码固定为2！</b></div><div>所以该中断过程中，不需要取中断类型码。</div><div>（1）标志寄存器入栈，<b>IF=0</b>，TF=0；</div><div>（2）CS、IP入栈（3）(ip) = (8), (cs) = (0AH)</div><div><br/></div><div><br/></div><div><br/></div><div>15.3 PC机<b>键盘的处理过程</b></div><div>PC机处理外设输入的基本方法：</div><div><br/></div><div>1. 键盘输入</div><div>键盘每个键相当于一个个开关，</div><div>键盘有一个芯片对每个键的开关状态进行扫描。</div><div><br/></div><div>（1）<b>按下</b>一个<b>键</b>，开关触发，芯片<b>产生</b>一个<b>扫描码</b>，</div><div>扫描码说明按下的键在键盘上的位置。</div><div><b>扫描码</b>被送入主板上的<b>相关</b>接口芯片的寄存器中，</div><div>该寄存器的<b>端口地址</b>为<b>60h</b>。</div><div><br/></div><div>（2）<b>松开</b>一个<b>键</b>，其它类同上。</div><div><br/></div><div><b>按下按键</b>产生的扫描码，称为<b>通码</b>；</div><div><b>松开</b>按键产生的扫描码，称为<b>断码</b>。</div><div>扫描码<b>长度</b>为 <b>1 Byte</b>，通码第七位为0，断码的第7位为1。</div><div><br/></div><div><b>断码 = 通码 + 80h</b>（部分键盘扫描码表见于文末）</div><div><br/></div><div><br/></div><div>2. 引发9号中断</div><div>键盘的<b>输入到达60h端口</b>时，相关芯片就会向CPU</div><div><b>发出</b><b>int 9</b>的<b>可屏蔽中断</b>信息。</div><div>此时若IF = 1，则响应中断。</div><div><br/></div><div>3. 执行 int 9 中断例程</div><div><b>BIOS提供</b>了 <b>int 9</b> 中断例程，处理基本的键盘输入处理。</div><div>主要工作如下：</div><div>（1）读出60h端口中的扫描码；</div><div>（2）a. 若是<b>字符键</b>的扫描码，则将对应的字符码（ASCII）</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 送入内存中的<b>BIOS键盘缓冲区</b>。</div><div>&nbsp; &nbsp; &nbsp; &nbsp; b. 若是控制键（如Ctrl）和切换键（如CapsLock）等的扫描码，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 则将其转为状态字节（用二进制位记录控制键和切换键的字节），</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 写入内存中储存状态字节的单元。</div><div>（3）对键盘系统进行相关的控制，如，向相关芯片发出应答信息。</div><div><br/></div><div>BIOS键盘缓冲区，是系统启动后，BIOS用于存放 int 9 中断例程所接收的</div><div>键盘输入的内存区。<b>可以存储15个键盘输入</b>。</div><div>除了接收扫描码外，<b>还要产生</b>和<b>扫描码对应</b>的<b>字符码</b>，</div><div><b>一个</b>键盘<b>输入</b>用 1 word（<b>2 Bytes</b>）存放，</div><div><b>高位</b>存放<b>扫描码</b>，<b>低位</b>存放<b>字符码</b>。</div><div><br/></div><div>0040:17单元存储键盘状态字节，记录了控制键和切换键的状态，</div><div>其中各位记录的信息如下：</div><div>bit &nbsp; &nbsp;键位 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;置为1表示？</div><div>0 &nbsp; &nbsp; 右shift &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;按下</div><div>1 &nbsp; &nbsp; 左shift &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;按下</div><div>2 &nbsp; &nbsp; Ctrl &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;按下</div><div>3 &nbsp; &nbsp; Alt &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 按下</div><div>4 &nbsp; &nbsp; ScrollLock &nbsp; &nbsp; Scroll指示灯亮</div><div>5 &nbsp; &nbsp; NumLock &nbsp; &nbsp; 小键盘输入的是数字</div><div>6 &nbsp; &nbsp; CapsLock &nbsp; &nbsp; 输入大写字母</div><div>7 &nbsp; &nbsp; Insert &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;处于删除状态（否则处于插入态）</div><div><br/></div><div><br/></div><div><br/></div><div>15.4 编写 int 9 中断例程</div><div>键盘输入处理过程：</div><div>（1）键盘产生扫描码；</div><div>（2）扫描码送入60h</div><div>（3）引发int 9（可屏蔽中断）</div><div>（9）CPU执行 int 9 中断例程，处理输入</div><div><br/></div><div>编程：在屏幕中间<b>依次显示&quot;a&quot;~&quot;z&quot;，</b>并可以<b>让人看清</b>。</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 在显示过程中，<b>按下Esc</b>键后，<b>改变</b>显示的<b>颜色</b>。</div><div><br/></div><div>assume cs:code<br/>
stack segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; db 128 dup (0)<br/>
stack ends<br/>
data segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; dw 0, 0<br/>
data ends<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, stack<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ss, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov sp, 128<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, data<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;int 9 键盘输入处理的中断例程<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;将它的入口地址保存在ds:0、ds:2单元中<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; push es:[9 * 4]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ds:[0]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es:[9 * 4 + 2]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ds:[2]</b><br/>
&nbsp; &nbsp; &nbsp;</div><div>&nbsp; &nbsp; &nbsp;<b>cli &nbsp; &nbsp; ;以防在设置新的中断例程入口地址时，发生中断</b></div><div><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ;以致于产生错误</b></div><div>&nbsp;&nbsp;&nbsp;&nbsp; <b>mov word ptr es:[9 * 4], offset int9<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[9 * 4 + 2], cs</b><br/>
&nbsp; &nbsp; &nbsp;<b>sti &nbsp; &nbsp; ;同上</b></div><div><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, &apos;a&apos;<br/><br/>
c0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov es:[160 * 12 + 40 * 2], ah</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; call delay<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>inc ah<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp ah, &apos;z&apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jna c0</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ds:[0]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es:[9 * 4]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ds:[2]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es:[9 * 4 + 2]<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
delay:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push dx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov dx, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
c1:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; sub ax, 1<br/>
&nbsp;&nbsp;&nbsp;&nbsp; sbb dx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jne c1<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp dx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jne c1</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop dx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;新的 int 9 中断例程<br/>
int9:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; in al, 60h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>pushf<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pushf<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx&nbsp;&nbsp;&nbsp;&nbsp; ;bx is flag<br/>
&nbsp;&nbsp;&nbsp;&nbsp; and bh, 11111100b<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; popf</b></div><div><br/><b>&nbsp;&nbsp;&nbsp;&nbsp; call dword ptr ds:[0]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;注意dword！<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;这条指令已经把ds:[0]和ds:[2]两个字都传送过去了</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp al, 1<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jne int9ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc byte ptr es:[160 * 12 + 40 * 2 + 1]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;将属性值加一，改变颜色<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
int9ret:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%94%E7%AB%A015.4%E4%BE%8B.asm" target="_blank">汇编语言第十五章15.4例.asm</a><br/></div><div><br/></div><div><br/></div><div>15.5 安装新的int 9中断例程</div><div>安装新的int 9，使得原有中断例程的功能得到拓展。</div><div><br/></div><div>功能：在DOS下，按F1键后，改变当前屏幕的显示颜色，其它键照常。</div><div><br/></div><div>assume cs:code<br/>
stack segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; db 128 dup (0)<br/>
stack ends<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, stack<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ss, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov sp, 128<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ds&nbsp;&nbsp;&nbsp;&nbsp; ;新int 9的源码地址<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax&nbsp;&nbsp;&nbsp;&nbsp; ;存放的目标地址<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset int9<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov di, 204h&nbsp;&nbsp;&nbsp;&nbsp; ;预留前四字节，放原来的int9的入口地址</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset int9end - offset int9<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>;将旧的int 9中断例程入口地址“偏移/段地址”暂存于0:200~0:203<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es:[9 * 4]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es:[200h]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es:[9 * 4 + 2]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es:[202h]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;安全设置新的int 9入口地址<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>cli<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[9 * 4], 204h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[9 * 4 + 2], 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; sti</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
int9:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;暂存寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; in al, 60h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pushf<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>call dword ptr cs:[200h]&nbsp;&nbsp;&nbsp;&nbsp; ;执行中断例程时，(CS)=0</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp al, 3bh<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jne int9ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov bx, 1</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 2000<br/>
r0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>inc byte ptr es:[bx]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; add bx, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop r0<br/><br/>
int9ret:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;恢复寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/><br/>
int9end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%94%E7%AB%A015.5%E4%BE%8B.asm" target="_blank">汇编语言第十五章15.5例.asm</a><br/></div><div><br/></div><div><br/></div><div><b>实验15 安装新的int 9 中断例程</b></div><div>功能：在DOS下，按下“A”键后，除非不再松开，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 如果松开，就显示满屏幕的“A”；</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 其它键照常处理。</div><div>提示：按下一个键产生的扫描码为通码，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 松开时产生的是断码，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 断码 = 通码 + 30h</div><div><br/></div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0&nbsp;&nbsp;&nbsp;&nbsp; <b>;无法将idata直接push到stack中</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 204h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>;0:200~203存储原有 int 9 中断例程的入口地址</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>push es:[9 * 4]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es:[200h]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>push es:[9 * 4 + 2]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es:[202h]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;install the new int 9 routine<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>push cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ds</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset fill_a<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset f_a_end - offset fill_a<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>;避免设置新中断程序中途，<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;可屏蔽中断导致入口地址的设置不正确</b><br/><b>&nbsp;&nbsp;&nbsp;&nbsp; cli</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[9 * 4], <b>204h</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[9 * 4 + 2], 0<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; sti</b><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
fill_a:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;暂存寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; in al, 60h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; pushf<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call <u>dword ptr</u> <u>cs</u>:[200h]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp al, 9eh&nbsp;&nbsp;&nbsp;&nbsp; ;A的断码<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jne ok<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, &apos;A&apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 2000<br/>
c0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[di], al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
ok:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;恢复寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/>
f_a_end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%BA%94%E7%AB%A0%E5%AE%9E%E9%AA%8C15.asm" target="_blank">汇编语言第十五章实验15.asm</a><br/></div><div><br/></div><div><br/></div><div><b>8086CPU指令系统总结</b>：</div><div>若想了解详情，自行查阅相关指令手册。</div><div><br/></div><div>提供以下几大类指令：</div><div><br/></div><div>1. <b>数据传输</b>指令：</div><div>如，mov、push、pop、pushf、popf、xchg等。</div><div>实现寄存器、内存等之间的<b>单个数据传送</b>。</div><div><br/></div><div>*.&nbsp;<b>XCHG交换</b>指令：</div><div>两个寄存器，寄存器和内存变量之间内容的交换指令，</div><div>两个操作数的<b>数据类型要相同</b>，</div><div>可以是一个<b>字节</b>，也可以是一个<b>字</b>，也可以是<b>双字</b>。</div><div><br/></div><div><br/></div><div>2. <b>算术运算</b>指令</div><div>如，add、sub、adc、sbb、inc、dec、cmp、imul、idiv、mul、div、aaa等。</div><div>执行<b>结果影响标志寄存器</b>。</div><div><br/></div><div>*. <b>aaa -&nbsp;</b>ASCII Adjust After Addition，<b>非压缩、非组合的BCD码调整指令</b>；</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;AAA指令将AL调整为一个非压缩BCD格式的数字，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;AL是两个非压缩BCD数字相加后的结果；</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;如果AL(3~0位)大于9或辅助进位AF=1<img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/b6b5791f2db37228982a7c2731c95a54.gif" />则AH=AH+01H<img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/b6b5791f2db37228982a7c2731c95a54.gif" />AL=AL+06H<img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/b6b5791f2db37228982a7c2731c95a54.gif" /></div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;且置AF和CF为1<img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/db8b8337372eb2429a3a4d8a0d11f2e0.gif" />否则置AF和CF为零<img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/6a8574a306d803c49e114f395e74cf23.gif" />AL(7~4位)=0<img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/6a8574a306d803c49e114f395e74cf23.gif" /></div><div><b>imul 有符号乘法</b>，将被乘数与乘数均作为有符号数。</div><div>mul 无符号乘法，将被乘数及乘数均作为无符号数。</div><div><b>idiv同理。</b></div><div><br/></div><div><br/></div><div>3. <b>逻辑</b>指令</div><div>如，and、or、not、xor、test、shl、shr、 rol、ror、rcl、rcr等。</div><div><b>除了not</b>外，其它指令的结果<b>影响标志寄存器</b>。</div><div><br/></div><div>*. <b>test</b> 指令，将两操作数作<b>与and</b>运算，仅<b>修改标志位</b>，<b>不回送结果</b>。</div><div><b>sal</b> / <b>sar</b> 指令，Shift Arithmetic Left / Right，</div><div><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;算术左/右移</b>，执行时将操作数看成带符号数进行移位；</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;算术右移时，最高位保持不变；算术左移和逻辑左移一致。</div><div><b>rol / ror</b> 指令，Rotate Left / Right ，<b>左/右循环移位</b>。&nbsp;</div><div><b>rcl / rcr</b> 指令，Rotate Left / Right <b>Through Carry</b>，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;带进位左/右循环移位，以右移为例：</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>标志位CF移入</b>操作数<b>最高位</b>，操作数<b>最低位进入</b>标志位<b>CF</b>。</div><div><br/></div><div><br/></div><div>4. <b>转移</b>指令</div><div>可以<b>修改</b>IP，或同时修改<b>CS和IP</b>的指令。</div><div>分以下几类：</div><div>（1）<b>无条件转移</b>指令，如jmp</div><div>（2）<b>条件转移</b>指令：如jcxz、je、jne、jb、jnb、ja、jna等</div><div>（3）<b>循环</b>指令：如loop</div><div>（4）<b>过程</b>，如call、ret、retf</div><div>（5）<b>中断</b>，如int、iret</div><div><br/></div><div><br/></div><div>5.&nbsp;<b>处理控制</b>指令</div><div>对标志寄存器，或其它处理机状态进行设置。</div><div>如cld / std、cli / sti、nop、clc / stc、<b>cmc、</b><b>hlt、wait、esc、lock</b>等。</div><div><br/></div><div>*. cmc&nbsp;(CoMplement Carry) <b>进位位求反</b>指令：</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 执行操作后<img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/b6b5791f2db37228982a7c2731c95a54.gif" />CF=!CF <img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/b6b5791f2db37228982a7c2731c95a54.gif" />即CF=1<img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2012/b6b5791f2db37228982a7c2731c95a54.gif" />执行CMC操作后 CF=0；反之相反。</div><div>wait/fwait 同步FPU与CPU：停止CPU的运行，直到FPU完成当前操作码。</div><div>hlt (halt) ：停止，无操作数。</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 使程序<b>停止</b>运行，处理器进入暂停状态，不执行任何操作，不影响标志。</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 当复位（外语：RESET）线上有复位信号、CPU响应非屏蔽中断、</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CPU响应可屏蔽中断3种情况之一时，CPU脱离暂停状态，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 执行HLT的下一条指令。</div><div>esc，指令助记符，交权给外部协处理器。（意义暂不明晰）</div><div>lock（意义暂不明晰）</div><div><br/></div><div><br/></div><div>6. <b>串处理</b>指令</div><div>对内存中的<b>批量数据</b>进行<b>处理</b>。</div><div>如movsb、movsw、<b>cmps、scas、lods、stos</b>等。</div><div>若要使用它们方便进行批量数据处理，</div><div>则需要<b>与rep、repe、repne</b>等<b>前缀指令配合</b>使用。</div><div><br/></div><div>*.&nbsp;<b>repe / repne</b>，即是&nbsp;repeat <b>equal</b> /&nbsp;repeat <b>not equal</b>，</div><div>意思是：<b>相等时重复 / 不相等时重复</b>。</div><div><br/></div><div><br/></div><div><br/></div><div><b>*.完整</b><b>键盘扫描码</b><b>表：</b><a href="evernote:///view/7264256/s33/57b177c1-a9e9-4727-a748-bd69042cc8e1/57b177c1-a9e9-4727-a748-bd69042cc8e1/" style="color: rgb(105, 170, 53);">键盘扫描码</a>。</div><div><b>部分</b>如下：</div><div>键位&nbsp;/ 通码 / 断码</div><div>ESC&nbsp;&nbsp;&nbsp;01H, 81H&nbsp;<br/>
!1&nbsp;&nbsp;&nbsp;02H, 82H<br/>
@2&nbsp;&nbsp;&nbsp;03H, 83H<br/>
#3&nbsp;&nbsp;&nbsp;04H, 84H<br/>
$4&nbsp;&nbsp;&nbsp;05H, 85H<br/>
%5&nbsp;&nbsp;&nbsp;06H, 86H<br/>
^6&nbsp;&nbsp;&nbsp;07H, 87H<br/>
&amp;7&nbsp;&nbsp;&nbsp;08H, 88H<br/>
*8&nbsp;&nbsp;&nbsp;09H, 89H<br/>
(9&nbsp;&nbsp;&nbsp;0AH, 8AH<br/>
)0&nbsp;&nbsp;&nbsp;0BH, 8BH<br/>
_-&nbsp;&nbsp;&nbsp;0CH, 8CH<br/>
+=&nbsp;&nbsp;&nbsp;0DH, 8DH<br/>
ERASE&nbsp;0EH, 8EH<br/>
TAB&nbsp;&nbsp;&nbsp;0FH, 8FH<br/>
Q&nbsp;&nbsp;&nbsp;10H, 90H<br/>
W&nbsp;&nbsp;&nbsp;11H, 91H<br/>
E&nbsp;&nbsp;&nbsp;12H, 92H<br/>
R&nbsp;&nbsp;&nbsp;13H, 93H<br/>
T&nbsp;&nbsp;&nbsp;14H, 94H<br/>
Y&nbsp;&nbsp;&nbsp;15H, 95H<br/>
U&nbsp;&nbsp;&nbsp;16H, 96H<br/>
I&nbsp;&nbsp;&nbsp;17H, 97H<br/>
O&nbsp;&nbsp;&nbsp;18H, 98H<br/>
P&nbsp;&nbsp;&nbsp;19H, 99H<br/>
{[&nbsp;&nbsp;&nbsp;1AH, 9AH<br/>
}]&nbsp;&nbsp;&nbsp;1BH, 9BH<br/>
ENTER&nbsp;1CH, 9CH<br/>
L_CTRL&nbsp;1DH, 9DH&nbsp;///左CTRL<br/>
A&nbsp;&nbsp;&nbsp;1EH, 9EH<br/>
S&nbsp;&nbsp;&nbsp;1FH, 9FH<br/>
D&nbsp;&nbsp;&nbsp;20H, A0H<br/>
F&nbsp;&nbsp;&nbsp;21H, A1H<br/>
G&nbsp;&nbsp;&nbsp;22H, A2H<br/>
H&nbsp;&nbsp;&nbsp;23H, A3H<br/>
J&nbsp;&nbsp;&nbsp;24H, A4H<br/>
K&nbsp;&nbsp;&nbsp;25H, A5H<br/>
L&nbsp;&nbsp;&nbsp;26H, A6H<br/>
:;&nbsp;&nbsp;&nbsp;27H, A7H<br/>
&quot;&apos;&nbsp;&nbsp;&nbsp;28H, A8H<br/>
~`&nbsp;&nbsp;&nbsp;29H, A9H<br/>
L_SHIFT&nbsp;2AH, AAH&nbsp;///左SHIFT<br/>
|\&nbsp;&nbsp;&nbsp;2BH, ABH<br/>
Z&nbsp;&nbsp;&nbsp;2CH, ACH<br/>
X&nbsp;&nbsp;&nbsp;2DH, ADH<br/>
C&nbsp;&nbsp;&nbsp;2EH, AEH<br/>
V&nbsp;&nbsp;&nbsp;2FH, AFH<br/>
B&nbsp;&nbsp;&nbsp;30H, B0H<br/>
N&nbsp;&nbsp;&nbsp;31H, B1H<br/>
M&nbsp;&nbsp;&nbsp;32H, B2H<br/>
&lt;,&nbsp;&nbsp;&nbsp;33H, B3H<br/>
&gt;.&nbsp;&nbsp;&nbsp;34H, B4H<br/>
?/&nbsp;&nbsp;&nbsp;35H, B5H<br/></div></div>
