title: ASM 汇编语言 13
date: 2015-04-14
noupdate: true
categories: [ASM]
tags: [ASM]
description: ASM - Note&#58; 直接定址表。数据标号、地址标号。在其它段中，使用数据标号。写子程序计算 sin(x)。实现子程序 setscreen，为显示输出提供指定功能。
---

<ul><li>Created on 2014-11</li></ul><br/>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;"><div>教材：《汇编语言》（第二版）王爽 著 清华大学出版社</div><div><br/></div><div><b>章十六、直接定址表</b></div><div><b><br/></b></div><div>16.1 描述了单元长度的标号——<b>数据标号</b></div><div><br/></div><div>（1）以下程序中，code、a、b、start、s（后面带冒号“:”）</div><div>都是<b><u>地址标号</u>，仅表示</b><b>内存单元</b>的<b>地址</b>。</div><div><br/></div><div>assume cs:code<br/>
code segment<br/><b>a:</b>&nbsp;&nbsp;&nbsp;&nbsp; db 1, 2, 3, 4, 5, 6, 7, 8<br/><b>b:</b>&nbsp;&nbsp;&nbsp;&nbsp; dw 0<br/><b>start:</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, <b>offset</b> <b>a</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, <b>offset</b> <b>b</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 8<br/><b>c0:</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, cs:[si]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add cs:[bx], ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop <b>c0</b><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/><br/>
code ends<br/>
end <b>start</b></div><div><br/></div><div><br/></div><div>（2）另一种——<b>数据标号</b></div><div>不但<b>表示内存单元</b>的<b>地址</b>，还表示其<b>长度</b>，</div><div>无论是byte/word/dword。</div><div>如以下程序中的a、b标号，<b>后面没跟“:”冒号</b>。</div><div><br/></div><div>assume cs:code<br/>
code segment<br/><b>a</b>&nbsp;&nbsp;&nbsp;&nbsp; db 1, 2, 3, 4, 5, 6, 7, 8<br/><b>b</b>&nbsp;&nbsp;&nbsp;&nbsp; dw 0<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 8<br/>
c0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, cs:[si]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add <b>b</b>, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop c0<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/><br/>
code ends<br/>
end start</div><div><br/></div><div>以上a、b这种标号的使用示例如下：</div><div>mov ax, b &nbsp; &nbsp; = &nbsp; &nbsp; mov ax, cs:[8]</div><div>mov <b>b, 2</b> &nbsp; &nbsp; &nbsp;= &nbsp; &nbsp; mov word ptr cs:[8]</div><div>inc <b>b</b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; &nbsp; inc word ptr cs:[8]</div><div><br/></div><div>mov al, <b>a[si] &nbsp; &nbsp; = &nbsp; &nbsp;</b> mov al, cs:0[si]</div><div>mov al, a[3] &nbsp; &nbsp; &nbsp;= &nbsp; &nbsp; mov al, cs:0[3]</div><div><br/></div><div>这句会引发编译错误！—— mov al, b 或 mov b, al</div><div><br/></div><div><br/></div><div><br/></div><div><b>检测点1.6</b></div><div>将a处的8个数据累加，结果存储到b处的双字中，补全程序。</div><div><br/></div><div>assume cs:code<br/>
code segment<br/>
a&nbsp;&nbsp;&nbsp;&nbsp; dw 0fff1h, 0fff2h, 0fff3h, 0fff4h, 0fff5h, 0fff6h, 0fff7h, 0fff8h<br/>
b&nbsp;&nbsp;&nbsp;&nbsp; dd 0<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 8<br/>
c0:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov ax, a:[si]</b></div><div><b>&nbsp; &nbsp; &nbsp;</b>;下一句可简化为<b>&nbsp;</b>add word ptr <b>b</b>, ax<b><br/></b><b>&nbsp;&nbsp;&nbsp;&nbsp; add word ptr b[0], ax &nbsp; &nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; adc word ptr b[2], 0</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop c0<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/><br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div><br/></div><div>16.2 在其它段中，使用数据标号</div><div><br/></div><div><b>地址标号</b>（带冒号后缀）：</div><div><b>只能在代码段中使用</b>，不能在其它段使用。</div><div><br/></div><div><b>&nbsp; &nbsp; &nbsp;&gt;&gt;assume的作用：</b></div><div><u>若想<b>在代码段中直接用数据标号</b>访问数据，</u></div><div><u>则<b>需</b>要用<b>伪指令assume</b>，</u></div><div><u><b>将标号</b>所在的<b>段和段寄存器联系</b>起来。</u></div><div>否则编译时，无法确定标号的段地址在哪一个寄存器中。</div><div>（下文实例详细说明）</div><div><br/></div><div>此种联系是编译器需要的，</div><div>但段寄存器实际上不一定会真的存放该段的地址。</div><div>还要用指令对段寄存器进行设置。</div><div><br/></div><div>（例）</div><div>assume cs:code, ds:data<br/>
data segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; a db 1, 2, 3, 4, 5, 6, 7, 8<br/>
&nbsp;&nbsp;&nbsp;&nbsp; b dw 0<br/>
data ends<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, data<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 8<br/>
c0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, a[si]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add b, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div>已有<b>assume ..., ds:data</b></div><div>但是还要</div><div>mov ax, data</div><div>mov ds, ax</div><div>然后以下就是<b>assume ds:data</b>对<b>编译</b>实际的<b>影响</b>：</div><div>mov al, a[si] 编译为 mov al, [si+0]</div><div><img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2013/e8c800492bf9619ab7e61184592c770c.png" /></div><div>add b, ax 编译为 add [8], ax</div><div><img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2013/488a2b294983eb6c4dc88d71380790e8.png" /></div><div><br/></div><div>当<b>删除</b>以上源程序中assume ..., <b>ds:data</b>中的ds:data后，</div><div>用masm<b>编译</b>时，会<b>产生</b><b>错误</b>，报错信息如下：</div><div><img width="px" height="px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2013/18512c4d794b8a6c2c7ed46b68c9bcf7.png" /></div><div>t.asm(14)是这一句：mov al, <b>a</b>[si]</div><div>编译程序不知道标号在哪里了！</div><div><br/></div><div>当然可将以下语句移到 code segment（段）中，</div><div>就可顺利编译，但原理必须明白！：</div><div>&nbsp; &nbsp; &nbsp;a db 1, 2, 3, 4, 5, 6, 7, 8<br/>
&nbsp;&nbsp;&nbsp;&nbsp; b dw 0</div><div><br/></div><div><br/></div><div><u><b>标号可以作为</b><b>数据</b>来<b>定义</b>！</u></div><div>data segment</div><div>&nbsp; &nbsp; &nbsp;<b>a</b> db 1, 2, 3, 4, 5, 6, 7, 8</div>
&nbsp;&nbsp;&nbsp;&nbsp; <b>b</b> dw 0
<div>&nbsp; &nbsp; &nbsp;<u>c <b>dw a, b</b> &nbsp; &nbsp; ;相当于 c <b>dw offset a, offset b</b></u></div><div>&nbsp; &nbsp; &nbsp;<u>d <b>dd a, b</b> &nbsp; &nbsp; ;相当于 <b>d dw offset a, seg a, offset b, seg b</b></u><br/><div>data ends</div><div><br/></div><div><br/></div><div><br/></div><div>16.3 <b>直接定址表</b></div><div><br/></div><div>根据我的理解，就像<b>数组</b>。</div><div>实例如下：</div><div><br/></div><div>assume cs:code<br/>
code segment<br/>
start:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 2bh</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; call showbyte<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
showbyte:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp short show<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; <u>table</u> db &apos;0123456890ABCDEF&apos;&nbsp;&nbsp;&nbsp;&nbsp; ;字符表</b><br/>
show:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, al;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cl, 4<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shr ah, cl&nbsp;&nbsp;&nbsp;&nbsp; ;ah得到原al的高4位<br/>
&nbsp;&nbsp;&nbsp;&nbsp; and al, 00001111b&nbsp;&nbsp;&nbsp;&nbsp; ;al得到原al的低4位<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bl, ah<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov ah, table[bx]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[160 * 12 + 40 * 2], ah<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bl, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov al, table[bx]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[160 * 12 + 40 * 2 + 2], al<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
code ends<br/>
end start</div><div><br/></div><div>在以上程序中，我们在（1byte大小的）<b>数值&nbsp;0~15</b></div><div>和 <b>字符 “0” ~ “F”</b>（16进制表示法）之间建立的<b>映射关系</b>为：</div><div>以<b>数值N为table表</b>中的<b>偏移</b>，可以<b>找到对应字符</b>。</div><div><br/></div><div><br/></div><div>利用表，建立两个数据集之间的一种映射关系，</div><div>根据给出的数据，得到另一数据集对应的数据，目的是：</div><div>（1）为了算法的清晰和简洁；</div><div>（2）加快运算速度；</div><div>（3）使程序易于扩充。</div><div><br/></div><div><br/></div><div><b>编程：写一个子程序，计算sin(x)，</b></div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; x属于{0, 30, 60, 90, 120, 150, 180}集合（单位：度）。</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 如，sin(30)结果显示为“0.5”。</div><div><br/></div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 255<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call showsin<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
showsin:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp short show<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; ;字符串偏移地址表<br/>
&nbsp;&nbsp;&nbsp;&nbsp; table dw s0, s30, s60, s90, s120, s150, s180</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; s0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; db &apos;0&apos;, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; s30&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; db &apos;0.5&apos;, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; s60&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; db &apos;0.866&apos;, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; s90&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; db &apos;1&apos;, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; s120&nbsp;&nbsp;&nbsp;&nbsp; db &apos;0,866&apos;, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; s150&nbsp;&nbsp;&nbsp;&nbsp; db &apos;0.5&apos;, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; s180&nbsp;&nbsp;&nbsp;&nbsp; db &apos;0&apos;, 0<br/>
show:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push si<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; ;以下用“角度值/30”作为table的偏移，</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;取得对应字符串的偏移地址，置于bx中<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bl, 30<br/>
&nbsp;&nbsp;&nbsp;&nbsp; div bl<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov bl, al&nbsp;&nbsp;&nbsp;&nbsp; ;高字节ah存余，低字节al存商</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; add bx, bx&nbsp;&nbsp;&nbsp;&nbsp; ;偏移地址为word型，以bx * 2以对应地址</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, table[bx]<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;以下显示sin(x)对应的字符串<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 160 * 12 + 40 * 2<br/>
shows:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, cs:[bx]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp ah, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; je ok<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[si], ah<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp short shows<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
ok:&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
code ends<br/>
end start</div><div><br/></div><div>角度值没有检测，可能超范围（0~180），</div><div>真实编程需要检测。</div></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2013/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%85%AD%E7%AB%A016.3%E4%BE%8B.asm" target="_blank">汇编语言第十六章16.3例.asm</a><br/></div><div><br/></div><div><br/></div><div>16.4 程序入口地址的直接定址表</div><div><br/></div><div>可以<b>在直接定址表</b>中<b>存储子程序</b>的<b>地址</b>，</div><div>从而方便地<b>实现不同子程序的调用</b>。</div><div><br/></div><div><b>编程：</b></div><div><b>实现一个子程序setscreen，为显示输出提供如下功能：</b></div><div>（1）清屏；</div><div>（2）设置前景色；</div><div>（3）设置背景色；</div><div>（4）向上滚动一行。</div><div><br/></div><div>入口参数说明如下：</div><div>a. 用ah寄存器传递功能号：</div><div>&nbsp; &nbsp; &nbsp;0表示以上功能（1）清屏，</div><div>&nbsp; &nbsp; &nbsp;1表示（2），2表示（3），3表示（4）。</div><div>b. 对于功能（2）、（3），用al传递颜色值，</div><div>&nbsp; &nbsp; &nbsp;(al)属于{0, 1, 2, 3, 4, 5, 6, 7}范围。</div><div><br/></div><div>下面是实现思路：</div><div>（1）清屏：将屏幕字符设置为空格；</div><div>（2）前景色：设置屏幕字符属性字节的第0、1、2位；</div><div>（3）背景色：设置屏幕字符属性字节的第4、5、6位；</div><div>（4）向上滚一行：依次将第n + 1行复制到第n行处，最后一行置空。</div><div><br/></div><div>源代码：</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 3<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 3<br/>
&nbsp;&nbsp;&nbsp;&nbsp; call setscreen<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
setscreen:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp short set<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; table dw sub1, sub2, sub3, sub4</b><br/>
set:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp ah, 3<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ja sret</div><div><br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov bl, ah<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add bx, bx</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; call word ptr table[bx]&nbsp;&nbsp;&nbsp;&nbsp; ;调用对应的功能子程序</b><br/>
sret:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
sub1:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 2000<br/>
sub1c0:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[bx], &apos; &apos;</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub1c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
sub2:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 1<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 2000<br/>
sub2c0:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; and byte ptr es:[bx], 11111000b</b><br/><b>&nbsp;&nbsp;&nbsp;&nbsp; or es:[bx], al</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub2c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
sub3:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov cl, 4<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shl al, cl</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 1<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 2000<br/>
sub3c0:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; and byte ptr es:[bx], 10001111b<br/>
&nbsp;&nbsp;&nbsp;&nbsp; or es:[bx], al</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub3c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
sub4:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ds<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push di<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, si<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 160<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 24</b><br/>
sub4c0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 160<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub4c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 80<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0<br/>
sub4c1:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[160 * 24 + si], &apos; &apos;</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub4c1<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ds<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2013/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%85%AD%E7%AB%A016.4%E4%BE%8B.asm" target="_blank">汇编语言第十六章16.4例.asm</a><br/></div><div><br/></div><div><br/></div><div><b>实验16 编写包含多个功能子程序的中断例程</b></div><div>功能：安装一个新的int 7ch 中断例程，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 为显示输出提供如下功能子程序：</div><div>（1）清屏；</div><div>（2）设置前景色；</div><div>（3）设置背景色；</div><div>（4）向上滚动一行。</div><div><br/></div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 入口参数说明如下：</div><div>（1）用ah寄存器传递功能号：0表示清屏，</div><div>&nbsp; &nbsp; &nbsp;1表示设置前景色，2表示设置背景色，</div><div>&nbsp; &nbsp; &nbsp;3表示向上滚动一行；</div><div>（2）对于2、3号功能，用al传送颜色值，</div><div>&nbsp; &nbsp; &nbsp;(al)属于{0,1,2,3,4,5,6,7}</div><div><br/></div><div><b>代码：</b></div><div>;安装int 7ch中断例程</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;install int 7ch<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cs<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ds<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, offset set_screen<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, offset s_s_end - offset set_screen<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cld<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cli<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[7ch * 4], 200h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov word ptr es:[7ch * 4 + 2], 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; sti<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
set_screen:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; jmp short sel_sub<br/><b>table:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; dw offset sub0 - offset set_screen + 200h, offset sub1 - offset set_screen + 200h, offset sub2 - offset set_screen + 200h, offset sub3 - offset set_screen + 200h</b><br/>
sel_sub:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cmp ah, 3<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ja end_sub<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bl, ah<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; add bx, bx&nbsp;&nbsp;&nbsp;&nbsp; ;千万记得将bx加倍！<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ;以对应table中储存子程序入口地址的偏移量</b><br/>
cal_add:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; call word ptr es:[bx]<u>[offset table - offset set_screen + 200h]</u></b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
end_sub:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; iret<br/><br/>
sub0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 25 * 80<br/>
sub0c0:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[bx], &apos; &apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub0c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/><br/>
sub1:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; cmp al, 7&nbsp;&nbsp;&nbsp;&nbsp; ;对于输入的(al)颜色参数，<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ja sub1_ok&nbsp;&nbsp;&nbsp;&nbsp; ;第一种处理方式，检测范围</b><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 1</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 25 * 80<br/>
sub1c0:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; and byte ptr es:[bx], 11111000b<br/>
&nbsp;&nbsp;&nbsp;&nbsp; or byte ptr es:[bx], al</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub1c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
sub1_ok:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/><br/>
sub2:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; and al, 00000111b&nbsp;&nbsp;&nbsp;&nbsp; ;对于输入的(al)颜色参数，<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ;第二种处理方式，清除超过范围的部分</b><br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov cl, 4<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shl al, cl</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 1</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 25 * 80<br/>
sub2c0:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; and byte ptr es:[bx], 10001111b<br/>
&nbsp;&nbsp;&nbsp;&nbsp; or byte ptr es:[bx], al</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub2c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/><br/>
sub3:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ds<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b80ah&nbsp;&nbsp;&nbsp;&nbsp; ;之前错写成0b8a0h了！仔细领悟一下！<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ;之所以偏移的行数过多，因为ds:[bx] = ds * 16 + bx！</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 24 * 80<br/>
sub3c0:<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; push ds:[bx]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es:[bx]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub3c0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 80<br/>
sub3c1:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[bx], &apos; &apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub3c1<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ds<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
s_s_end:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; nop<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2013/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%85%AD%E7%AB%A0%E5%AE%9E%E9%AA%8C16.asm" target="_blank">汇编语言第十六章实验16.asm</a><br/></div><div><br/></div><div><br/></div><div>;测试程序</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;test<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ah, 0<br/>
&nbsp; &nbsp; &nbsp;;mov al, 3<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 7ch<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2013/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%85%AD%E7%AB%A0%E5%AE%9E%E9%AA%8C16%E6%B5%8B%E8%AF%95%E7%A8%8B%E5%BA%8F.asm" target="_blank">汇编语言第十六章实验16测试程序.asm</a><br/></div><div><br/></div><div><br/></div><div><b>;sub3的更优写法：</b></div><div>sub3:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push ds<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push si<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0b800h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, si</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov si, 160<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 0</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><b>&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 24 * 160<br/>
&nbsp;&nbsp;&nbsp;&nbsp; cli<br/>
&nbsp;&nbsp;&nbsp;&nbsp; rep movsb</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 80<br/>
sub3c1:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[di], &apos; &apos;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop sub3c1<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop es<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop ds<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ret</div></div>
