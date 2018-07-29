title: ASM 汇编语言 14
date: 2015-04-15
noupdate: true
categories: [ASM]
tags: [ASM]
description: ASM - Note&#58; 使用 BIOS 进行键盘输入和磁盘读写。中断例程对键盘输入的处理。使用 int 16h 中断例程读取键盘缓冲区。字符串的输入。应用 int 13h 中断例程对磁盘进行读写。编写包含多个功能子程序的中断例程。
---

<ul><li>Created on 2014-11</li></ul><br/>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;"><div>教材：《汇编语言》（第二版）王爽 著 清华大学出版社</div><div><br/></div><div><b>章十七、使用BIOS进行键盘输入和磁盘读写</b></div><div><b><br/></b></div><div>键盘输入：最基本的输入</div><div>磁盘：最常用的储存设备</div><div>BIOS：为以上两种外设<b>提供了最基本的中断例程</b></div><div><b><br/></b></div><div><b><br/></b></div><div>17.1 int 9 中断例程对键盘输入的处理</div><div><br/></div><div>一般键盘输入，在CPU执行完int 9中断例程后，都放到键盘缓冲区中。</div><div><b>键盘缓冲区</b>有<b>16个字</b>单元，<b>可以存储15个</b>按键的<b>扫描码和对应</b>的<b>ASCII码</b>。</div><div>键盘缓冲区使用环形队列结构管理的内存区。</div><div><br/></div><div>int 9 中断例程对键盘输入的处理方法：</div><div><img width="1355px" height="743px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/Evernote%20Camera%20Roll%2020150117%20171602.png" /><img width="1334px" height="1302px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/Evernote%20Camera%20Roll%2020150117%20171602.png" /></div><div><br/></div><div><br/></div><div>17.2 使用 int 16h 中断例程读取键盘缓冲区</div><div><br/></div><div>BIOS 提供了 <b>int 16h</b> 中断例程，它包<b>含功能</b>：<br/><b>从键盘缓冲区中读取</b>一个键盘<b>输入</b>，功能<b>编号为0</b>。</div><div><br/></div><div>（例）</div><div>mov ah, 0</div><div>int 16h</div><div>结果：(ah)=扫描码，(al)=ASCII码。</div><div>功能：</div><div>（1）检测键盘缓冲区是否有数据；</div><div>（2）没有则重复第一步</div><div>（3）读取缓冲区第一个字单元的键盘输入；</div><div>（4）将读取的扫描码送入ah，ASCII码送入al；</div><div>（5）将已读取的键盘输入从缓冲区中删除。</div><div>*. 具体例子，请看原书P303</div><div><br/></div><div>可见，BIOS的<b>int 9</b> 和 <b>int 16h</b>中断例程是一对<b>相互配合</b>的程序。</div><div><b>int 9</b> 向缓冲区<b>写，int 16h</b> 从缓冲区<b>读，</b>但<b>调用时机不同</b>。</div><div>int 9 在键按下时，它就写入；int 16h 则是<b>被应用程序调用</b>时，它才去读。</div><div><br/></div><div><br/></div><div><b>编程：</b>接收用户的键盘输入，输入r，将屏幕字符设置为红色；</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; g则设为绿色； b则设为蓝色。</div><div>源码：</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 16h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 1</b><br/><b>&nbsp;&nbsp;&nbsp;&nbsp; cmp al, &apos;r&apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; je red<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp al, &apos;g&apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; je green<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp al, &apos;b&apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; je blue</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp short sret<br/><br/><b>red:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shl ah, 1<br/>
green:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shl ah, 1</b><br/><b>blue:</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 1<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 2000<br/>
c0:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; and byte ptr es:[bx], 11111000b<br/>
&nbsp;&nbsp;&nbsp;&nbsp; or es:[bx], ah</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
sret:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div>17.3 字符串的输入</div><div>最基本的字符串输入程序，需具备以下功能：</div><div>（1）在输入的同时需要显示这个字符串；</div><div>（2）一般在输入回车符后，字符串输入结束；</div><div>（3）能够删除已经输入的字符。</div><div><br/></div><div><b>编程：实现以上3个基本功能</b>，参数如下——</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (dh)、(dl)=字符串在屏幕上显示的行、列位置；</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ds:si指向字符串的储存空间，字符串以0为结束符。</div><div>实现思路：详看原书P304~305</div><div><br/></div><div><b>处理过程</b>：</div><div>（1）调用int 16h 读取键盘输入</div><div>（2）若是字符，入栈，显示栈中所有字符；继续执行（1）；</div><div>（3）若是退格键，一个字符出栈，显示栈中所有字符；继续执行（2）；</div><div>（4）若是Enter键，向栈压入0，返回。</div><div><br/></div><div>源码：</div><div>&nbsp; &nbsp; &nbsp;其中子程序charstack的子程序的参数说明：</div><div>&nbsp; &nbsp; &nbsp;(ah)=功能号，0表示入栈，1表示出栈，2表示显示；</div><div>&nbsp; &nbsp; &nbsp;<b>ds:si</b>指向字符<b>栈空间</b>；</div><div>&nbsp; &nbsp; &nbsp;入栈：(al)=入栈字符；</div><div>&nbsp; &nbsp; &nbsp;出站：(al)=出栈返回的字符；</div><div>&nbsp; &nbsp; &nbsp;显示：<b>(dh)、(dl)</b>=字符串在屏幕上显示的<b>行、列</b>位置。</div><div><br/></div><div>assume cs:code<br/>
stack segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; db 64 dup (0)<br/>
stack ends<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, stack<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0&nbsp;&nbsp;&nbsp;&nbsp; ;ds:si指向charstack的字符栈空间<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dh, 0&nbsp;&nbsp;&nbsp;&nbsp; ;显示在第0行<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dl, 0&nbsp;&nbsp;&nbsp;&nbsp; ;显示在第0列<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call getstr<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
getstr:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ax<br/>
getstrs:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; ;获取键盘输入<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 16h</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp al, 20h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jb not_char&nbsp;&nbsp;&nbsp;&nbsp; ;ASCII码小于20h，说明不是字符<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0&nbsp;&nbsp;&nbsp;&nbsp; ;调用charstack的0号子程序<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call charstack&nbsp;&nbsp;&nbsp;&nbsp; ;字符入栈<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 2&nbsp;&nbsp;&nbsp;&nbsp; ;调用charstack的2号子程序<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call charstack&nbsp;&nbsp;&nbsp;&nbsp; ;显示栈中的字符</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp getstrs<br/><br/>
not_char:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; cmp ah, 0eh&nbsp;&nbsp;&nbsp;&nbsp; ;退格键的扫描码<br/>
&nbsp;&nbsp;&nbsp;&nbsp; je backspace<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp ah, 1ch&nbsp;&nbsp;&nbsp;&nbsp; ;回车键的扫描码<br/>
&nbsp;&nbsp;&nbsp;&nbsp; je enter_btn</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp getstrs<br/><br/>
backspace:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 1&nbsp;&nbsp;&nbsp;&nbsp; ;调用charstack的1号子程序<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call charstack&nbsp;&nbsp;&nbsp;&nbsp; ;字符出栈<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 2&nbsp;&nbsp;&nbsp;&nbsp; ;类同上<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call charstack&nbsp;&nbsp;&nbsp;&nbsp; ;显示栈中的字符<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp getstrs<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
enter_btn:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call charstack&nbsp;&nbsp;&nbsp;&nbsp; ;0入栈<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call charstack&nbsp;&nbsp;&nbsp;&nbsp; ;显示栈中字符<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
charstack:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp short&nbsp; charstart<br/><b>table&nbsp;&nbsp;&nbsp;&nbsp; dw charpush, charpop, charshow<br/>
top&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dw 0&nbsp;&nbsp;&nbsp;&nbsp; ;栈顶</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
charstart:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push dx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp ah, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ja sret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bl, ah<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; add bx, bx</b><br/><b>&nbsp;&nbsp;&nbsp;&nbsp; jmp word ptr table[bx]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
charpush:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov bx, top<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds:[si][bx], al</b><br/><b>&nbsp;&nbsp;&nbsp;&nbsp; inc top</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp sret<br/><br/>
charpop:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp top, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; je sret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; dec top<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, top<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, ds:[si][bx]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp sret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
charshow:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 160<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mul dh&nbsp;&nbsp;&nbsp;&nbsp; ;dh：显示在第几行<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add dl, dl&nbsp;&nbsp;&nbsp;&nbsp; ;dl：显示在第几列<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dh, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add di, dx&nbsp;&nbsp;&nbsp;&nbsp; ;di：对应的显示缓冲区的偏移量</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
charshows:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp bx, top<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jne not_empty<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[di], &apos; &apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp sret<br/>
not_empty:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov al, ds:[si][bx]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[di], al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[di + 2], &apos; &apos;&nbsp;&nbsp;&nbsp;&nbsp; ;设置下一个显示位为空</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp charshows<br/><br/>
sret:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop dx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E4%B8%83%E7%AB%A017.3%E4%BE%8B.asm" target="_blank">汇编语言第十七章17.3例.asm</a><br/></div><div><br/></div><div><br/></div><div>17.4 应用 <b>int 13h 中断例程对磁盘进行读写</b></div><div><b>以3.5英寸软盘为例讲解</b>（无法测试，只能做简单的笔记）。</div><div>3.5英寸软盘：2面 * 80磁道 * 18扇区 * 512字节 = 1440KB ≈ 1.44MB</div><div><br/></div><div>int 13h 入口参数：</div><div>(ah)=int 13h的功能号</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2：读扇区；3：写扇区</div><div>(al)=读/写的扇区数</div><div>(ch)=磁道号</div><div>(cl)=扇区号</div><div>(dh)=磁头号（对于软盘即面号,因为一个面用一个磁头来读写）</div><div>(dl)=驱动器号 &nbsp; &nbsp; 软驱从0开始，0：软驱A，1：软驱B；</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;硬盘从80h开始，80h：硬盘C，81h：硬盘D</div><div>es:bx 指向接受从扇区读入数据的内存区。</div><div><br/></div><div>返回参数：</div><div>操作成功：(ah)=0，(al)=读/写的扇区数</div><div>操作失败：(ah)=出错代码</div><div><br/></div><div><br/></div><div><b>实验17 编写包含多个功能子程序的中断例程</b></div><div><b>以3.5英寸软盘为对象编写</b>（无法测试，只能简单描述题目）。</div><div><br/></div><div><img width="690px" height="237px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/1714006dae86aabe425b8e38249e2398.png" /></div><div><img width="497px" height="442px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/05dedeb0e9cfc789488adb730e26db81.png" /></div><div><img width="689px" height="181px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/e77389b70bb8aac0a6fe5832c80ec166.png" /></div><div><br/></div><div><br/></div><div><b>课程设计2</b></div><div><b>(完成并不现实：因为当前使用电脑CPU为64位，</b></div><div><b>&nbsp; &nbsp; &nbsp;而非16位的8086CPU，即使编写的汇编程序也无法测试)</b></div><div><img width="559px" height="575px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/e8dc941688cdf6097fa9a4cbd36cb199.png" /></div><div><img width="557px" height="169px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/ce9f20b2811d6aa5cdb98795b5d636d9.png" /></div><div><br/></div><div><br/></div><div><img width="555px" height="295px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2014/28a66282bd49010054d7c45bdf8e9087.png" /></div></div>
