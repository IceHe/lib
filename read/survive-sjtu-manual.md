# Survive SJTU Manual

Snippets of《上海交通大学生存手册》

---

References

- GitBook : https://liankeqin.gitbook.io/survivesjtumanual

## 你想要做什么

- https://liankeqin.gitbook.io/survivesjtumanual/li-zhi-pian/ben-ke-si-nian-yao-zuo-shen-me

> 曾国藩曾说过：“**盖士人读书，第一要有志，第二要有识，第三要有恒。有志则不甘为下流；有识则知学问无尽，不敢以一得自足，如河伯之观海，如井蛙之窥天，皆无识者也；有恒则断无不成之事**。此三者缺一不可。”

## 区分上学与研究

- https://liankeqin.gitbook.io/survivesjtumanual/fang-tan-ji/zuo-zhen-zheng-de-yan-jiu/qu-fen-shang-xue-yu-yan-jiu

> 清醒的位置感和准确的方向感，是比雄厚的基础知识更为重要的成功要素。

## 知识积累

- https://liankeqin.gitbook.io/survivesjtumanual/fang-tan-ji/zuo-zhen-zheng-de-yan-jiu/zhi-shi-ji-lei

> **知识积累是一个很有技巧并且很注重效率的工作**。刚刚进入研究领域的同学们，最大的障碍往往是要面对浩如烟海的文献资料，不知从何处入手。在这个时候，我们首先应该为自己绘制一张关于知识的地图。在这张地图上，我们要标明自己所在领域的研究对象，主流研究方法，研究分支的结构，以及当前存在的最大问题和最新进展。只有搞明白这些事情之后，我们才能朦胧地知道自己是否适合这个学科，**自己最欠缺哪方面的知识，以及最重要的，应当按照什么样的顺序去获取知识**。

- _icehe : 我就太随缘了, 随便学点东西, 没有规划; 用学习来自我安慰/麻痹, 减轻焦虑而已; 而且人也懒, 就更不关心效率…_

> 我们 **在研究起步阶段，应该仔细阅读该领域的权威教科书。** 一般来讲，知识会随着时间而沉淀，在一代代人的努力下变得精炼而富有结构性。一本好的教科书则可以很好地总结记录这样的结构。较新的教科书可以涵盖上个世纪末到本个世纪初的绝大部分科学成果，对当今的研究热点一般也会有较好的介绍。负责任的教科书还会提供翔实的参考文献，并推荐进一步的参考读物。

- _icehe : 我最近心目中最好的权威教科书例子《数据密集型应用系统设计》 ( 虽然它还没成为教科书 )_

> 如果你因为语言问题，正在考虑选择影印版图书的中文译本，那要请你慎重。由于现在很多专业图书译者的水平低劣，职业道德缺失，我们经常可以碰到读得懂英文原文却搞不明白中文译文的情况。

## 御人先御己

- https://liankeqin.gitbook.io/survivesjtumanual/fang-tan-ji/guan-li-zhe-de-zhi-hui/yu-ren-xian-yu-ji

> 首先，无论你是在怎样的部门，担任什么样的职位，带领怎样的手下，第一步要做到的始终是使自己具备让人敬服的魅力。这魅力非是来自外表，而是管理者自身的一举一动。无论是在工作上还是生活习惯上，管理者的行为模式都必须是被团队整体的追求的精神所推崇和认可的。我们要切忌成为“喇叭式”的管理者——光说不练，总是在要求他人，自身却倦于行动。如果你不确定自己属于哪类，请扪心自问：如果同样的要求标准，换你被别人管，你有没有信心自己不挨骂？

## CS自救指北

- https://liankeqin.gitbook.io/survivesjtumanual/fu-lu/ben-ke-sheng-zhuan-ye-jie-shao-todo/cs-zi-jiu-zhi-bei
    - https://liankeqin.gitbook.io/survivesjtumanual/fu-lu/ben-ke-sheng-zhuan-ye-jie-shao-todo/cs-zi-jiu-zhi-bei#zi-jiu-zhi-bei

> **理解计算机系统**
>
> Matt Might 在 [What every computer science major should know](http://matt.might.net/articles/what-cs-majors-should-know) 中谈到如何学体系结构时，认为 “Computer scientists should understand a computer from the transistors up.” 然而，在我看来，CS 的专业课教学距离这个目标还有一定距离。之前也提到了 CS 一些专业课的现状。在此我给出不同阶段的建议。
>
> **基本认识计算机系统** 大一上学期可以尝试自学 [nand2tetris](https://www.nand2tetris.org)。这门课程难度不大，硬件部分不需要太多的前序知识，软件部分用基本的 C++ 也足够了。在这门课程中，学生需要从电路开始搭建各种硬件模块，组成 CPU；接着手写汇编器、VM 和编译器，在 CPU 上运行自己写的程序。在这一过程中，学生可以了解如何从晶体管一步步造出计算机，对计算机系统有基本的认识。
>
> **深入理解计算机系统** 大一下学期可以开始自学[《深入理解计算机系统》](http://csapp.cs.cmu.edu/) (CS:APP)。我推荐英文的第三版（写这篇文章时候的最新版）。书上的内容通俗易懂，辅以课后练习和 lab 可以达到更好的学习效果。CS:APP 涵盖了 CS 某三门专业课的基本内容。2, 3, 6 章的汇编语言、内存层级涵盖了计算机组成的一部分内容。第 4 章 Y86-64 处理器对应计算机系统结构的课程的前半部分。6, 9, 12 章关于虚拟内存和并发编程涵盖了操作系统课程的一部分内容。全书通过对 Intel x86(_64) 架构的案例分析，从底层硬件到上层软件，整体介绍了一个计算机系统。从这个角度来说，大一下开始学习这些内容，不仅可以了解 Intel x86 这一常用的计算机系统，也能弥补专业课和基础课之间的断层。
