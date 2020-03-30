# Refactoring

References

- Book "Refactoring Improving the Design of Existing Code"
    - ZH Ver. :《 重构 改善既有代码的设计 》

## Preface

> "if it works, don't fix it" ?

代码被阅读和被修改的次数, 远远多于它被编写的次数

- 保持代码易读、易修改的关键 -- 重构

错误的想法?

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

---

It is essential for refactoring that you have good tests.

- I'm going to be relying on the tests to tell me whether I introduce a bug.

## Principles in Refactoring

What is Refactoring?

- A change made to the internal structure of software to make it easier to understand and cheaper to modify without changing its observable behavior.
- 对软件内部结构的一种调整, 目的是在不改变软件可观察行为的前提下, 提高其可理解性, 降低其修改成本

The Two Hats

- Adding function
    - When you add function, you shouldn't be changing existing code; you are just adding new capabilities.
    - You can measure your progress by adding tests and getting the tests to work.
- Refactoring
    - When you refactor, you make a point of not adding function; you only restructure the code.
    - You don't add any tests (unless you find a case you missed earlier); you only restructure the code.
- _You don't add any tests (unless you find a case you missed earlier); you only change tests when you absolutely need to in order to cope with a change in an interface._

Why Should You Refactor?

- **Improves Design** of Software
    - As people change code -- changes to realize short-term goals or changes made without a full comprehension of the design of the code -- the code loses its structure.
    - _It becomes harder to see the design by reading the code._
    - _The harder it is to see the design in the code, the harder it is to preserve it…_
    - Poorly designed code usually takes more code to do the same things, often because the code quite literally does the same thing in several places.
    - Thus an important aspect of improving design is to **eliminate duplicate code**.
    - By eliminating the duplicates, you ensure that the code says **everything once and only once**, which is the essence of good design.
- Makes Software **Easier to Understand**
    - _A little time spent refactoring can make the code better communicate its purpose._
    - Programming in this mode is all about **saying exactly what you mean**. ( 准确说出我所要的 )
    - _I use refactoring to help me understand unfamiliar code._
- Helps You **Find Bugs**
- Helps You **Program Faster**
    - A good design is essential for rapid software development.
    - _Without a good design, you can progress quickly for a while, but soon the poor design starts to slow you down._
    - _You spend time finding and fixing bugs instead of adding new function._
    - _Changes take longer as you try to understand the system and find the duplicate code._
    - _New features need more coding as you patch over a patch that patches a patch on the original code base._

When Should You Refactor?

- **The Rule of Three**
    - "**Three strikes and you refactor.**"
- When You Add Function
    - _Once I've refactored, adding the feature can go much more quickly and smoothly._
- When You Need to Fix a Bug
- As You Do a Code Review

Why Refactoring Works?

- Programs have two kinds of value:
    - what they can do for you today
    - and what they can do for you tomorrow.
- Notice
    - If you can get today's work done today, but you do it in such a way that you can't possibly get tomorrow's work done tomorrow, then you lose.

Indirection ( 间接层 ) and Refactoring

> Computer Science is the discipline that believes all problems can be solved with one more layer of indirection.
> —— Dennis DeBruler
>
> "计算机科学是这样一门科学: 它相信所有问题都可以通过增加一个间接层来解决. "

- To enable sharing of logic.
- To **explain intention ( 意图 ) and implementation ( 实现 ) separately.**
- To **isolate change ( 隔离变化 ) .**
- To **encode conditional logic ( 封装条件逻辑 ) .**

Problems with Refactoring

- Database
    - Object Model 和 DB Model 之间插入一个 separate layer 隔离两个模型各自的变化
    - 数据迁移 : 先运用访问方法, 造成 "数据已经转移" 的假象
- Changing Interfaces
    - "Don't publish interfaces prematurely. Modify your code ownership policies to smooth refactoring."
        - 不要过早发布接口. 请修改你的代码所有权政策, 使重构更顺畅.

Refactoring and Design

- You build the simplest thing that can possibly work. As for the flexible, complex design, most of the time you aren't going to need it.
    - 当下只管建造可运行的最简化系统, 至于灵活而复杂的设计, 唔, 多数时候你都不会需要它.
- The lesson is: Even if you know exactly what is going on in your system, measure performance, don't speculate. You'll learn something, and nine times out of ten, it won't be that you were right!
    - 教训 : 哪怕你完全了解系统, 也请实际度量它的性能, 不要臆测. 臆测会让你学到一些东西, 但十有八九你是错的.

Refactoring and Performance

- The interesting thing about performance is that if you analyze most programs, you find that they waste most of their time in a small fraction of the code. If you optimize all the code equally, you
end up with 90 percent of the optimizations wasted…
    - 大多数程序把大半时间耗费在一小半代码身上. 如果你一视同仁地优化所有代码, 90% 的优化工作都是白费劲的.

## Bad Smells in Code

> 代码的坏味道

Index

- Deplicated Code 重复代码
- Long Method 过长的方法
- Large Class 过大的类
- Long Parameter List 过长参数列
- Divergent Change 发散式变化
- Shotgun Surgery 霰弹式修改
- Feature Envy 依恋情结
- Data Clumps 数据泥团
- Primitive Obsesion 基础类型偏执
- Switch Statements
- Parallel Inheritance Hierarchies 平行继承体系
- Lazy Class 冗赘类
- Speculative Generality 夸夸其谈未来性
- Temporary Field 令人迷惑的暂时字段
- Message Chains 过度耦合的消息链
- Middle Man 中间人
- Inappropriate Intimacy 狎昵关系
- Alternative Classes with Different Interfaces 异曲同工的类
- Incomplete Library Class 不完美的库类
- Data Class 纯稚的数据类
- Refused Bequest 被拒绝的遗赠
- Comments 过多的注释


Deplicated Code 重复代码

- 个人见解 : 如果一个代码片段 比较短促 / 原子性比较强 ( 例如由数个库方法组合而成 ) / 还不难理解
    - 那么保持原状
        - 没必要勉为其难、强行使用不合适的 "锤子" ( extract / pull up ) 来复用这些代码片段
    - 如果强行复用代码片段, 可能膨胀比率很高
        - 本来就没几行代码, 结果又 pull up new class / extract new method, 基本的结构语法又花了好几行代码 …
    - 如果复用场景实际没那么多, 而且复用性也没那么明显的话
        - 其他开发人员很可能没能发现到你封装好的方法, 导致他们又重新自己写了一遍 …

Long Method 过长的方法

- Programmers new to objects often feel that no computation ever takes place, that object programs are endless sequences of delegation.
    - 不熟悉面向对象技术的人, 常常觉得面向对象程序中只有无穷无尽的委托, 根本没有进行任何计划
- All of the payoffs of indirection -- explanation, sharing, and choosing—are supported by little methods
    - … "间接层" 所能带来的全部利益 -- 解释能力、共享能力、选择能力 …
- Modern OO languages have pretty much eliminated that overhead for in-process calls.
    - 现代面向对象语言几乎已经完全免除了进程内的方法调用开销.
- A heuristic we follow is that whenever we feel the need to comment something, we write a method instead.
    - **每当感觉需要以注释来说明点什么的时候, 我们就把需要说明的东西写进一个独立函数中, 并以其用途 (而非实现手法) 命名.**
- We do this even if the method call is longer than the code it replaces, provided the method name explains the purpose of the code
    - 哪怕替换后的方法调用动作比方法自身还长, 只要方法名称能够解释其用途, 我们也该毫不犹豫地这么做.
- The key here is not method length but the semantic distance between what the method does and how it does it.
    - 关键不在于方法的长度, 而在于方法 "做什么" 和 "如何做" 之间的语义距离.

Large Class 过大的类

- 略

Long Parameter List 过长参数列

- 面向对象 : 方法需要的东西多半应该放在方法的宿主类中, 以缩减参数列
- Replace Parameter with Method : 向已有的对象发出一条请求取代一个参数

Divergent Change 发散式变化

- 使用 Extract Class 手法
    - Any change to handle a variation should change a single class, and all the typing in the new class should express the variation.
    - 针对某一外界变化的所有相应修改, 都只应该发生在单一类中, 而这个新类内的所有内容都应该反应此变化.

Shotgun Surgery 霰弹式修改

- _Shotgun Surgery 类似 Divergent Change_
    - Divergent Change : one class that suffers many kinds of changes
        - 一个类受多种变化的影响
    - Shotgun Surgery :  one change that alters many classes
        - 一种变化引发多个类的相应修改
    - Either way you want to arrange things so that, ideally, there is **a one-to-one link between common changes and classes.
        - 两种情况下, _都希望整理代码,_ 使 "外界变化" 与 "需要修改的类" 趋于一一对应.

Feature Envy 依恋情结

- The whole point of objects is that they are a technique to **package data with the processes used on that data**.
    - 要点 : 将数据和对数据的操作行为包装在一起
- A classic smell is a method that seems more interested in a class other than the one it actually is in.
    - … 方法对某个类的兴趣高过对自己所处类的兴趣.
        - _从另一个对象那调用过多不同的取值方法, 那么是不是该将这个方法直接移至该对象类?_
- 一个方法往往会用到几个类的功能, 那么它究竟该被置于何处?
    - 原则 : 判断哪个类拥有最多被此方法使用的数据

---

- Data Clumps 数据泥团 (?)
- Primitive Obsesion 基础类型偏执 (?)
- Switch Statements (?)
    - 最好不要在另一个对象的字段基础上运用 switch 语句
        - 如果不得不使用, 也应该在对象自己的数据上使用
        - _即是应该将该 swtich 语句相关逻辑尽可能挪到操作数据的对象上_
- Parallel Inheritance Hierarchies 平行继承体系 (?)
- Lazy Class 冗赘类 (?)
- Speculative Generality 夸夸其谈未来性 (?!)
- Temporary Field 令人迷惑的暂时字段 (?)
- Message Chains 过度耦合的消息链 (?)
- Middle Man 中间人 (?)
- Inappropriate Intimacy 狎昵关系 (?)
- Alternative Classes with Different Interfaces 异曲同工的类 (?!)
- Incomplete Library Class 不完美的库类 (?)
- Data Class 纯稚的数据类 (?)
- Refused Bequest 被拒绝的遗赠 (?)
- Comments 过多的注释

## Composing Methods

重新组织方法

- Extract Method 提炼方法
- Inline Method 内联方法
- Inline Temp 内联临时变量
- Replace Temp wtih Query 以查询取代临时变量
- Introduce Explaining Variable 引入解释性变量
- Split Temporary Variable 分解临时变量 (?)
- Remove Assignments to Parameters 移除对参数的赋值
- Substitute Algorithm 替换算法 (?)

## Moving Features Between Objects

在对象之间搬移特性

- Move Method 搬移方法
- Move Field 搬移字段
- Extract Class 提炼类
- Inline Class 将类内联化
- Hide Delegate 隐藏 "委托关系" (?)
- Remove Middle Man 移除中间人 (?!)
- Introduce Foreign Method 引入外加方法 (?)
- Introduce Local Extension 引入本地拓展 (?)

## Organizing Data

重新组织数据

- Self Encapsulate Field 自封装字段 (?)
- Replace Data Value with Object 以对象取代数据值
- Change Value to Reference 将值对象改为引用对象 (?)
- Change Reference to Value 将引用对象改为值对象 (?)
- Replace Array with Object 已对象取代数组
- Duplicate Observed Data 复制 "被监视数据" (?)
- Change Unidirectional Association to Bidirectional 将单向关联改为双向关联 (?)
- Change Bidirectional Association to Unidirectional 将双向关联改为单向关联 (?)
- Replace Magic Number with Symbolic Constant 以字面常量取代魔法数
- Encapsulate Field 封装字段 (?)
- Encapsulate Collection 封装集合 (?)
- Replace Record with Data Class 以数据类取代记录 (?)
- Replace Type Code with Class 以类取代类型码
- Replace Type Code with SubClass 以子类取代类型码
- Replace Type Code with State/Strategy 以 状态/策略 取代类型码
    - _是 State 还是 Strategy? 设计时, 对于模式(与其名称)的选择, 取决于你结构的看法_
- Replace Type Code with Fields 以字段取代类型码

## Simplify Conditional Expressions

简化条件表达式

- Decompose Conditional 分解条件表达式
- Consolidate Conditional Expression 合并条件表达式
- Remove Control Flag 移除控制标记 (?)
- Replace Nested Conditional with Guard Clauses 以卫语句取代嵌套条件表达式 (?)
- Replace Condtional with Polymorphism 以多台取代条件表达式 (?)
- Introduce Null Object 引入 Null 对象 (?)
- Introduce Assertion 引入断言

## Make Method Calls Simpler

简化方法调用

- Rename Method 方法改名
- Add Parameter 添加参数
- Remove Parameter 移除参数
- Separate Query from Modifier 将查询方法和修改方法分离 (?)
- Parameterize Method 令方法携带参数 (?)
- Replace Parameter with Explicit Methods 以明确方法取代参数
- Preserve Whole Object 保持对象完整 (?)
- Remove Setting Method 移除设值方法 (?)
- Hide Method 隐藏方法 (?!)
- Replace Constructor with Factory Method 以工厂方法取代构造方法
- Encapsulate Downcast 封装向下转型 (?)
- Replace Error Code with Exception 以异常取代错误码
- Replace Exception with Test 以测试取代异常 (?)

## Dealing with Generalization

处理概括(泛化?)关系

- Pull Up Field 字段上移
- Pull Up Method 方法上移
- Pull Up Constructor Body 构造方法本地上移 (?)
- Push Down Method 方法下移
- Push Down Field 字段下移
- Extact Subclass 提炼子类 (?)
- Extract Superclass 提炼超类
- Extract Interface 提炼接口
- Collapse Hierarchy 折叠继承体系 (?)
- Form Template Method 塑造模板方法 (?)
- Replace Inheritance with Delegation 以委托取代继承 (?)
- Replace Delegation with Inheritance 以继承取代委托 (?)

## Big Refactoring

大型重构

- Tease Apart Inheritance 梳理并分解继承体系 (?)
- Convert Procedural Design to Objects 将过程化设计转化为对象设计 (?)
- Separate Domain from Presentation 将领域和表述/显示分离 (?)
- Extract Hierarchy 提炼继承体系

## Refactoring, Reuse, and Reality

重构, 复用和现实

- 为什么开发者不愿意重构他们的程序

## Refatoring Tools

重构工具

## Putting It All Together

总结
