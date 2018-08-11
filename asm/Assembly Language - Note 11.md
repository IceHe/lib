title: ASM 汇编语言 11
date: 2015-04-12
noupdate: true
categories: [ASM]
tags: [ASM]
description: ASM - Note&#58; 端口的读写，in / out 指令。shl 和 shr 指令。CMOS RAM 芯片，其中存储的时间信息。访问 CMOS RAM。
---

<ul><li>Created on 2014-11</li></ul><br/>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;"><div>教材：《汇编语言》（第二版）王爽 著 清华大学出版社</div><div><br/></div><div><b>章十四、端口</b></div><div><b><br/></b></div><div>PC系统中，和CPU通过总线项链的芯片除存储器外，还有：</div><div>（1）各种接口卡（如，网卡、显卡）上的接口芯片，它们控制接口卡进行工作</div><div>（2）主板上的接口芯片，CPU通过它们对部分外设进行访问</div><div>（3）其它芯片，用来存储相关的系统信息，或进行相关的IO处理</div><div><br/></div><div>这些芯片中，都有一组可以由CPU读写的寄存器。</div><div>物理上它们在不同芯片中，但在以下两点上相同：</div><div>（1）都和CPU的总线相连，当然这种连接是通过它们所在的芯片进行的</div><div>（2）CPU对它们进行读写时，都通过控制线向它们所在的芯片发出端口读写命令</div><div><br/></div><div>可见，CPU将这些寄存器当作端口，</div><div>对其统一编址，建立统一的地址端口空间。</div><div><br/></div><div>CPU可直接读写以下3个地方的数据：</div><div>（1）CPU内部的寄存器</div><div>（2）内存单元</div><div>（3）端口</div><div><br/></div><div><br/></div><div>14.1 <b>端口</b>的<b>读写</b></div><div>PC系统中，CPU最多可以定位<b>64K</b>个不同的<b>端口</b>，<b>0~65535</b></div><div>对<b>端口</b>的<b>读写指令</b>只有两条：<b>in</b>、<b>out</b></div><div>而无push、pop、mov等指令</div><div><br/></div><div><b>访问</b>端口：</div><div><b>in al, 60h</b></div><div>（1）CPU通过地址线将地址信息60h发出</div><div>（2）CPU通过控制线发出端口读命令，选中端口所在的芯片，</div><div>&nbsp; &nbsp; &nbsp;并通知它，将要从中读取数据</div><div>（3）端口所在的芯片将60h端口中的数据通过数据线送入CPU</div><div><br/></div><div><b>写入</b>端口：</div><div><b>out 20h, al</b></div><div>类同上一条</div><div><br/></div><div><br/></div><div>14.2 <b>CMOS &nbsp;RAM</b> 芯片</div><div><br/></div><div>CMOS &nbsp;RAM&nbsp;芯片 一般<b>简称 CMOS</b>。特征如下：</div><div>（1）包含一个实时钟，和一个128个存储单元的RAM存储器。</div><div>&nbsp; &nbsp; &nbsp;（早期计算机为64Bytes）</div><div>（2）靠电池供电，关机后其内部实时钟仍可正常工作，RAM中的信息不丢失。</div><div>（3）128个字节的RAM中，内部实时钟占用0~0dh单元来保存时间，</div><div>&nbsp; &nbsp; &nbsp;其余大部分单元用于保存系统配置信息，供系统启动时BIOS程序读取。</div><div>&nbsp; &nbsp; &nbsp;BIOS也提供了相关程序，使开机时可配置CMOS &nbsp;RAM中的系统信息。</div><div>（4）该芯片内部有两个端口，地址分别为70h、71h。通过它们读写CMOS RAM。</div><div>（5）70h为地址端口，存放要访问的CMOS RAM单元的地址；</div><div>&nbsp; &nbsp; &nbsp;71h为数据端口，存放从选定的CMOS RAM单元中读取的数据。</div><div>&nbsp; &nbsp; &nbsp;如读取CMOS的2号存储单元：</div><div>&nbsp; &nbsp; &nbsp;a. 将 2 送入端口 70h</div><div>&nbsp; &nbsp; &nbsp;b. 从端口 71h 读 2 号单元的内容</div><div><br/></div><div>检测点14.1</div><div>编程：读取CMOS RAM的2号单元的内容 / 将0写入该单元</div><div>assume cs:code<br/>
code segment<br/>
start:</div><div>&nbsp;&nbsp;&nbsp;&nbsp; ;read CMOS RAM unit2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; out 70h, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; in al, 71h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;write unit2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; out 70h, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp; out 71h, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><u>&nbsp; &nbsp; &nbsp;</u><b><u>;in/out指令，好像只能凭借al寄存器来做参数中转&nbsp; &nbsp;</u></b> &nbsp;</div><div><br/></div><div>&nbsp; &nbsp; &nbsp;;test operator&apos;s result<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; out 70h, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; in al, 71h</div><div><br/></div><div><b>&nbsp; &nbsp; &nbsp;;大概是CMOS的2单元一直在变</b></div><div><b>&nbsp; &nbsp; &nbsp;;从&nbsp;71h&nbsp;读到 al 的数据并不是预想中的 0</b></div><div>&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div>14.3 <b>shl</b> 和 <b>shr</b> 指令</div><div>它们是<b>逻辑移位指令</b></div><div><b><br/></b></div><div><b>shl</b> —— <b>逻辑左移</b>：</div><div>（1）将一个寄存器或内存单元中的数据向<b>左移</b>位</div><div>（2）将<b>最后移出</b>的一<b>位写入CF</b>中</div><div>（3）<b>低位</b>用<b>0补充</b></div><div>指令：</div><div>mov al, 10000001b</div><div><b>shl al, 1</b> &nbsp; &nbsp; ;左移一位</div><div><br/></div><div><b>shr</b> —— 逻辑右移：</div><div>（1）将一个寄存器或内存单元中的数据向<b>右移</b>位</div><div>（2）将<b>最后移出</b>的<b>一位写入CF</b>中</div><div>（3）<b>高位</b>用<b>0补充</b></div><div><b><br/></b></div><div><b><br/></b></div><div>检测点14.2</div><div>计算 (ax) = (ax) * 10</div><div>（1）第一版</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>shl ax, 1</b>&nbsp;&nbsp;&nbsp;&nbsp; <b>; ax * 2</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div><u>&nbsp; &nbsp; &nbsp;<b>;</b><b>shl/shr指令，若用</b><b>立即数作为参数时，</b></u></div><div><u>&nbsp; &nbsp; &nbsp;<b>;立即数必须为1（每次仅允许移一位！）</b></u></div><div>&nbsp;&nbsp;&nbsp;&nbsp; <b>shl ax, 1&nbsp;&nbsp;&nbsp;&nbsp; ; ax * 4<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shl ax, 1&nbsp;&nbsp;&nbsp;&nbsp; ; ax * 8</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add ax, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div>（2）第二版</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shl ax, 1&nbsp;&nbsp;&nbsp;&nbsp; ; ax * 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/><u>&nbsp;&nbsp;&nbsp;&nbsp;</u> <b><u>;当移位数大于1时，要先将移位数置于CL中，然后再用CL移位。<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;可以使用8位立即数指定范围从1到31的移位次数</u><br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cl, 2<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shl ax, cl&nbsp;&nbsp;&nbsp;&nbsp; ; ax * 8</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add ax, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div>14.4 CMOS &nbsp;RAM 中存储的时间信息</div><div><b>CMOS RAM</b> <b>存着</b>当前的时间：</div><div><b>年、月、日、时、分、秒</b>。</div><div><br/></div><div><b>信息</b>的<b>长度</b>均为 <b>1 Byte</b>。</div><div><b>存放单元</b>为：<b>秒0 分2 时4 日7 月8 年9</b></div><div>这些数据<b>以BCD码</b>的方式<b>存放。</b></div><div><b><br/></b></div><div><b>BCD码</b>：</div><div>以4位二进制数，表示十进制数码的编码方式，如下：</div><div>0-0000，1-0001，2-0010，3-0011，4-0100，</div><div>5-0101，6-0110，7-0111，8-1000，9-1001。</div><div><br/></div><div>1 Byte 可表示 2个BCD码，如 0001 0100b 表示 14。</div><div>（以上为BCD码中的8421版本，其它详情请看<a href="http://baike.baidu.com/link?url=jh2w0DfroFs6zztCYEmXpxVTIAWmpHaF7cJ6lWWxXLCniVWaxFs_tbJ_HwAMHl2_dOorIxg8MwsTTgJCg8xs7_">百度百科</a>）</div><div><br/></div><div>在屏幕中间显示当前‘分钟’：</div><div>assume cs:code<br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov al, 2&nbsp;&nbsp;&nbsp;&nbsp; ;如上文，单元2 存放着‘分钟’信息<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>out 70h, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; in al, 71h</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov ah, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cl, 4<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shr ah, cl&nbsp;&nbsp;&nbsp;&nbsp; ;右移4位，取高四位<br/>
&nbsp;&nbsp;&nbsp;&nbsp; and al, 00001111b</b>&nbsp;&nbsp;&nbsp;&nbsp; <b>;保留低四位</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>add ah, 30h&nbsp;&nbsp;&nbsp;&nbsp; ;+30h 转换为对应数字的ascii<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add al, 30h</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bx, 0b800h&nbsp;&nbsp;&nbsp;&nbsp; ;输出到屏幕<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, bx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr ds:[160 * 12 + 40 * 2], ah<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr ds:[160 * 12 + 40 * 2 + 2], al<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div><br/></div><div><br/></div><div><b>实验14 访问CMOS RAM</b></div><div>编程：以“年/月/日 时:分:秒”的格式，显示当前的日期、时间。</div><div>注意：CMOS RAM 中存储着系统的配置信息，除了保存时间信息的单元外，</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 不要向其它单元写内容，否则将引起一些系统错误。</div><div><br/></div><div>assume cs:code<br/>
time_pos segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>db 9, 8, 7, 4, 2, 0</b><br/>
time_pos ends</div><div><br/></div><div><img width="619px" height="69px" src="http://7vzp68.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2011/tmp.png" /><br/><b><br/></b></div><div><b>;上一个段不满 16 Bytes (8 Words)<br/>
;新起的段也只从 下一个 16Bytes * n 的内存位置开始（见上图）<br/>
;16Bytes * n 即 10h * n</b><br/>
time_delimiter segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>db &apos;/&apos;, &apos;/&apos;, &apos; &apos;, &apos;:&apos;, &apos;:&apos;, &apos;$&apos;</b><br/>
time_delimiter ends<br/><br/>
time_str segment<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>db 18 dup (0)</b><br/>
time_str ends<br/><br/>
code segment<br/>
start:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, time_pos<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov si, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, time_str<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es, ax<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov di, 0<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cx, 6<br/>
circle:<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;暂存寄存器<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;从端口获取当前时间<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov al, ds:[si]<br/>
&nbsp;&nbsp;&nbsp;&nbsp; out 70h, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; in al, 71h</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;切分当前时间的CBD码，存到不同的存储单元中<br/>
&nbsp;&nbsp;&nbsp;&nbsp; push cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov ah, al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov cl, 4<br/>
&nbsp;&nbsp;&nbsp;&nbsp; shr ah, cl<br/>
&nbsp;&nbsp;&nbsp;&nbsp; and al, 00001111b</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; pop cx<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;将BCD码转换为，对应数字的ASCII码<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add ah, 30h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; add al, 30h<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;将时间拼接成字符串，暂存到指定内存中<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[di], ah<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;es:[di]访问的是段time_str<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov es:[di], al<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;ds:16[si]访问的是段time_delimiter<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov bl, ds:16[si]</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>;为什么idata（直接数/常量）偏移量是16而非6？</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;答：段time_str只用db指令声明了6Bytes的数据，<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;&nbsp;&nbsp;&nbsp;&nbsp; 但紧邻的段time_delimiter并非从上一个段<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;&nbsp;&nbsp;&nbsp;&nbsp; time_str的第7字节开始的，而是从下一个<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;&nbsp;&nbsp;&nbsp;&nbsp; 16Bytes * n的内存位置开始的！<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov byte ptr es:[di], bl<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc di<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; inc si<br/>
&nbsp;&nbsp;&nbsp;&nbsp; loop circle<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;locate cursor<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov bh, 0&nbsp;&nbsp;&nbsp;&nbsp; ;第0页<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dh, 12&nbsp;&nbsp;&nbsp;&nbsp; ;第12行<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dl, 30&nbsp;&nbsp;&nbsp;&nbsp; ;第30列<br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov ah, 2&nbsp;&nbsp;&nbsp;&nbsp; ;设置光标位置，int 10h的2号子程序<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 10h</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; ;print time_str<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, time_str<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ds, ax&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov dx, 0&nbsp;&nbsp;&nbsp;&nbsp; <b>;ds:dx指向字符串，&apos;$&apos;作为结束符</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp; <b>mov ah, 9&nbsp;&nbsp;&nbsp;&nbsp; ;在光标位置处显示字符串，int 21h的9号子程序<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<br/>
&nbsp;&nbsp;&nbsp;&nbsp; mov ax, 4c00h<br/>
&nbsp;&nbsp;&nbsp;&nbsp; int 21h<br/>
code ends<br/>
end start</div><div><br/></div><div><strong>Att - </strong><a title="Attachment 附件" href="http://7vzp67.com1.z0.glb.clouddn.com/Assembly%20Language%20-%20Note%2011/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80%E7%AC%AC%E5%8D%81%E5%9B%9B%E7%AB%A0%E5%AE%9E%E9%AA%8C14.asm" target="_blank">汇编语言第十四章实验14.asm</a><br/></div></div>
