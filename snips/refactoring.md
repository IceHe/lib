# Refactoring

References

- Book "Refactoring Improving the Design of Existing Code"
    - ZH Ver. :《 重构 改善既有代码的设计 》

## Introduction

> "if it works, don't fix it" ?

代码被阅读和被修改的次数, 远远多于它被编写的次数

- 保持代码易读、易修改的关键 -- 重构

现象

- _只要掌握重构的思想就够了, 没必要记住那些详细琐碎的重构手法_
- _高擎 "重构" 大旗, 刀劈斧砍进行着令人触目惊心的大胆修改 -- 有些干脆就是在重做整个系统_

重构 Refactoring : 在不改变软件可观察行为的前提下改善其内部结构

- 本质 : 在代码写好之后, 改进它的设计
    - _设计不再是一切动作的前提, 而是在整个开发过程中逐渐浮现出来_
- "不改变软件行为" 只是重构的最基本要求
- 如何发挥重构的威力 : 必须做到 "不需要了解软件行为"
    - _如果一段代码能让你容易了解其行为, 证明它还不是那么迫切需要被重构_

Refactoring is the process of changing a software system in such a way that it does not alter the external behavior of the code yet improves its internal structure.

- In essence when you refactor you are improving the design of the code after it has been written.
