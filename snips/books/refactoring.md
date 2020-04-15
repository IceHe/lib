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

- The interesting thing about performance is that if you analyze most programs, you find that they waste most of their time in a small fraction of the code. If you optimize all the code equally, you end up with 90 percent of the optimizations wasted…
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

---

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
    - 不熟悉面向对象技术的人, 常常觉得面向对象程序中只有无穷无尽的委托, 根本没有进行任何运算
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
- 使用 Replace Parameter with Method 手法
    - 向已有的对象发出一条请求取代一个参数

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

Data Clumps 数据泥团

- 例如, 两个类中相同的字段 / 许多方法签名中相同的参数
    - Extract Class 将这些数据提炼到独立对象中
- 优点
    - 可以减少字段和参数的个数 : _简化 / 封装_
    - 便于着手解决 Feature Envy : 将相关操作挪到合适的独立类对象中

Primitive Obsesion 基础类型偏执

- _对象技术的新手通常不愿意在小任务上运用小对象_

Switch Statements

- 面向对象 : 少用 switch 语句
    - 问题在于 "重复"
- 最好不要在另一个对象的字段基础上运用 switch 语句
    - 如果不得不使用, 也应该在对象自己的数据上使用
    - _即是应该将该 swtich 语句相关逻辑尽可能挪到操作数据的对象上_

Parallel Inheritance Hierarchies 平行继承体系

- 其实是 Shotgun Surgery 的特殊情况
    - 每当你为某个类增加一个子类, 必须为另一个类相应增加一个子类
    - _某个继承体系的类名称前缀, 跟另一个继承体系的类名称前缀完全相同, 那便是 "平行继承体系"_

Lazy Class 冗赘类

- 略

Speculative Generality 夸夸其谈未来性

- 有人说 : "我想我们总有一天需要做这事."
    - _并企图以各式各样的钩子和特殊情况来处理一些非必要的事情_
    - 造成系统更难理解和维护
    - _如果所有装置都会被用到, 那么就值得; 如果用不到, 就删掉_

Temporary Field 令人迷惑的暂时字段

- 某个实例变量仅为某种特定情况而设
    - 这样的代码让人不易理解, 因为你通常认为对象在所有时候都需要它的所有变量
- 可用 Extract Class 手法, 给这样的变量及其相关代码创造合适的居所
- 可用 Introduce Null Object 手法, 避免写出条件式代码 (?)

Message Chains 过度耦合的消息链

- You see **message chains** when a client asks one object for another object, which the client then asks for yet another object, which the client then asks for yet another another object, and so on.
    - 消息链 : 如果你看到用户向一个对象请求另一个对象, 然后再向后者请求另一个对象, 然后再请求另一个对象…
- 可以使用 Hide Delegate 手法
    - 把一系列对象 (intermediate object) 都变成 Middle Man
- 可以使用 Extract Method 手法
    - 先观察消息链最终得到的对象时用来干什么的, 然后决定是否把该对象的代码提炼到一个独立的方法上…
- _详见原文_

Middle Man 中间人

- Encapsulation often comes with delegation.
    - 封装往往伴随着委托
- 可能过度运用委托, 例如某个类接口有一半的函数都委托给其他类
- 可以使用 Remove Middle Man 手法 : 减少不干实事的类和方法

Inappropriate Intimacy 狎昵关系

- Sometimes classes become far too intimate and spend too much time delving in each others'private parts.
    - 有时看到两个类太过亲密, 花费太多时间去探究彼此的 private 成分
- 可以使用的手法
    - Move Method & Move Field : _尽可能减少(过于亲密/紧密的)相互访问和调用_
    - Change Bidirectional Association to Unidirectional : _让其中一个类对另一个类 "斩断情丝"_
    - Extract Class : _将两者共同点提取出来_
    - Hide Delegate : _让另一个类来代理访问 (?暂时想不到场景)_
    - Replace Inheritance with Delegation : _如果子类过于依赖超类的话…  (?暂时想不到场景)_

Alternative Classes with Different Interfaces 异曲同工的类

- 如果两个方法做同一件事…

Incomplete Library Class 不完美的库类

- 库的设计和实现难以一步到位, 完全符合使用者的需求
- 可以使用的改善手法
    - Introduce Foreign Method 引入外加方法
    - Introduce Local Extension 引入本地拓展

Data Class 纯稚的数据类

- These are classes that have fields, getting and setting methods for the fields, and nothing else.

Refused Bequest 被拒绝的遗赠

- 子类继承超类的方法和字段, 实际上该子类只需要其中的一些 (而不是全部)
    - 意味着, 继承体系设计的失误 ( The hierarchy is wrong. )
- 可以使用的手法
    - Push Down Medthod
    - Push Down Field
- 当然不必处处都这样做, 如果 bad smell 很淡, 那就没必要理睬
    - 如果子类复用了超类的行为 (实现), 却又不愿意支持超类的接口, 那就必须得审视了

Comments 过多的注释

- _如果单纯只是把注释当做 "除臭剂" 使用, 那就很糟糕_
    - _如果重构之后, 代码已经能自解释了, 注释自然会显得多余_
- 注释 应多用于说明 "为什么做某事" 而非 "做了什么 / 怎么做"

> When you feel the need to write a comment, first try to refactor the code so that any comment becomes superfluous
>
> 当你感觉需要撰写注释时, 请先尝试重构, 试着让所有注释都变得多余

## _*Building Tests_

Tips

- Make sure all tests are **fully automatic** and that they check their own results.
- _A suite of tests is a powerful bug detector that decapitates the time it takes to find bugs._
- Run your tests **frequently**. Localize tests whenever you compile -- every test at least every day.
- When you get a bug report, start by writing a unit test that **exposes the bug**.
- <u>**It is better to write and run incomplete tests than not to run complete tests.**</u>
- Think of the **boundary conditions** under which things might go wrong and concentrate your tests there.
- Don't forget to **test that exceptions** are raised when things are expected to go wrong.
- **Don't let the fear that testing can't catch all bugs stop you from writing the tests that will catch most bugs.**

There's always a risk that I'll miss something, but it is better to **spend a reasonable time to catch most bugs** than to spend ages trying to catch them all.

_A difference between test code and production code is that it is okay to copy and edit test code._

## _*Toward a Catalog of Refactorings_

重构列表

As I describe the refactorings in this and other chapters, I use a standard format. Each refactoring has five parts, as follows:

- 名称 : I begin with a **name**. The name is important to building a vocabulary of refactorings.
- 简短概要 : I follow the name with a short **summary** of the situation in which you need the refactoring and a summary of what the refactoring does.
- 动机 : The **motivation** describes why the refactoring should be done and describes circumstances in which it shouldn't be done.
- 做法 : The **mechanics** are a concise, step-by-step description of how to carry out the refactoring.
- 范例 : The **examples** show a very simple use of the refactoring to illustrate how it works.

## Composing Methods

> 重新组织方法

Extract Method 提炼方法

- 略

Inline Method 内联方法

- _I commonly use Inline Method when someone is using too much indirection and it seems that every method does simple delegation to another method, and I get lost in all the delegation._
    - 太多的间接层, 以及简单的委托, 需要简化…
- _内联成一个大方法, 以便重新组织合理的小方法_
- _移动一个方法比移动多个方法方便_

Inline Temp 内联临时变量

- _If the temp is getting in the way of other refactorings, such as Extract Method, it's time to inline it._
    - 当临时变量妨碍了其它重构手法, 例如 Extract Method 时, 应该内联化
- _Motivation : A method's body is just as clear as its name._
- _Mechanics : Put the method's body into the body of its callers and remove the method._

Replace Temp wtih Query 以查询取代临时变量

- _Because they can be seen only in the context of the method in which they are used, temps tend to encourage longer methods, because that's the only way you can reach the temp._
    - 临时变量只在所属方法中可见, 所以它们会驱使你写出更长的方法, _因为只有这样做才能访问到所需的临时变量_

Introduce Explaining Variable 引入解释性变量

- 适用的场景下, 尽量使用 Extract Method
    - 只有难以使用 Extract Method 时, 才退而求其次用 Introduce Eplaining Variable

Split Temporary Variable 分解临时变量

- 适用情况 : 当某个临时变量被赋值超过一次, 它既不是循环变量, 也不用于收集计算结果
- 做法 : 针对每次赋值, 创造一个独立、对应的临时变量

Remove Assignments to Parameters 移除对参数的赋值

- _It is much clearer if you use only the parameter to represent what has been passed in, because that is a consistent usage_
    - 只以参数表示 "被传递进来的东西", 代码会清晰得多 -- 因为这种用法在所有语言中都表现出相同语义

Replace Method with Method Ojbect 以方法对象取代方法

- 会将所有局部变量都变成方法对象的字段 (以 Constructor 构造方法方式传入)
- 然后就可以对这个新对象使用 Extract Method 创造出新方法, 从而将原本的大型函数拆解变短

Substitute Algorithm 替换算法

- 略

## Moving Features Between Objects

> 在对象之间搬移特性

Move Method 搬移方法

- _A method is, or will be, using or used by more features of another class than the class on which it is defined._
    - 适用情况 : 一个方法与其所驻类之外的另一个类进行更多交流, 调用后者, 或者被后者调用

Move Field 搬移字段

- _A field is, or will be, used by another class more than the class on which it is defined._
    - 适用情况 : 一个字段被其所驻类之外的另一个类更多地用到

Extract Class 提炼类

- _You have one class doing work that should be done by two._
    - 适用情况 : 一个类做了应该由两个类做得事情
    - _例如 一个类其中有两个字段, 它们其实应该单独抽象存放到一个新的类, 这样内聚性会更好_

Inline Class 将类内联化

- 略

Hide Delegate 隐藏 "委托关系"

- _A client is calling a delegate class of an object._
    - 适用情况 : 客户需要通过一个委托类来调用另一个类
- _Create methods on the server to hide the delegate._
    - 做法 : 在服务类上建立客户所需的所有方法, 用以隐藏委托关系
- _You can remove this dependency by placing a simple delegating method on the server, which hides the delegate. Changes become limited to the server and don't propagate to the client._
    - 优点 : 即便将来发生委托关系上的变化, 变化也将被限制在服务对象中, 不会波及客户

Remove Middle Man 移除中间人

- _Hide Delegate 的反向操作_
- _A class is doing too much simple delegation._
    - 适用情况 : 一个类做了过多的简单委托动作

Introduce Foreign Method 引入外加方法

- _A server class you are using needs an additional method, but you can't modify the class._
    - 适用情况 : 需要为提供服务的类增加一个方法, 但你无法修改这个类 _( 例如 Date )_
- _Create a method in the client class with an instance of the server class as its first argument._
    - _做法 : 建立一个方法, 传入该类的对象, 并在新方法内对其执行你所需要的额外处理_

Introduce Local Extension 引入本地拓展

- _A server class you are using needs several additional methods, but you can't modify the class._
    - 适用情况 : 需要为提供服务的类增加多个方法, 但你无法修改这个类 _( 例如 Date )_
- _Create a new class that contains these extra methods. Make this extension class a subclass or a wrapper of the original._
    - 做法 : 建立一个新类, 使它包含这些额外方法, 让这个拓展品成为源类的子类或包装类

## Organizing Data

> 重新组织数据

Self Encapsulate Field 自封装字段

- 例如 getter / setter
- _You are accessing a field directly, but the coupling to the field is becoming awkward._
    - 适用情况 : 你直接访问一个字段, 但与字段之间的耦合关系逐渐变得笨拙
- _Create getting and setting methods for the field and use only those to access the field_
    - 做法 : 为这个字段建立取值/设值方法, 并且 **只以这些函数访问字段**
- _一开始写的时候, 可以先使用直接访问的方式, 直到需要使用取值/设值方法封装一些操作为止_
- 在 constructor 中使用 setter ?
    - 一般来说, setter 被认为应该在对象创建后使用, 所以初始化过程中的行为有可能与 setter 的行为不同
    - 这种情况下, 也许在 constructor 中直接访问字段, 要不是就单独另建一个初始化方法

Replace Data Value with Object 以对象取代数据值

- _You have a data item that needs additional data or behavior._
    - 适用情况 : 你有一个数据项, 需要与其它数据和行为一起使用才有意义 _(这种描述有点让人摸不着头脑…)_
- _Turn the data item into an object._
    - 做法 : 将类中的字段, 抽象到新的类对象中
- _原来它们可能只是简单的数据项, 但是后来类中相关数据项和特殊行为变多_
- _这时最好将它们封装到单独的类对象中, 以避免 Duplicate Code 和 Feature Envy 等 Bad Smells_

Change Value to Reference 将值对象改为引用对象

- _You have a class with many equal instances that you want to replace with a single object._
    - 适用情况 : 从一个类衍生出许多彼此相等的实例, 希望它们替换为同一个对象
- _Turn the object into a reference object._
    - 做法 : 将这个值对象变成引用对象
        - 具体手法 : Replace Constructor with Factory Method
        - _详情见原书样例_

Change Reference to Value 将引用对象改为值对象

- _You have a reference object that is small, immutable, and awkward to manage._
    - 适用情况 : 你有一个引用对象, 很小且不可变, 而且不易管理
- _Turn it into a value object._
    - 将它变成一个值对象
- Value Object 值对象
    - 特点 : immutable 不可变
    - 改造方式 : 声明 final class/field 并 Remove Setting Method
        - 注意建立 equals() 和 hashCode() 方法
        - _( 通常可以使用 lombok 的 @Data 注解来简单解决 )_
- Reference Object 引用对象
    - 特点 : 必须被某种方式控制, 你必须向其控制者请求适当的引用对象
    - 缺点 : 可能造成内存区域之前的错综复杂的关联
- 在分布式和并发系统中, 如果使用 不可变的值对象, 则无需考虑它们同步的问题
    - _( 因为它们是存在不同内存区域的多个独立副本 )_

Replace Array with Object 以对象取代数组

- _You have an array in which certain elements mean different things._
    - 适用情况 : 你有一个数组, 其中的元素各自代表不同的东西
    - _例如, ary[0] 代表姓名, ary[1] 代表年龄…_
- _Replace the array with an object that has a field for each element._
    - 做法 : 以对象替换数组, 对于数组中的每个元素, 都以一个字段来表示

Duplicate Observed Data 复制 "被监视数据"

- _You have domain data available only in a GUI control, and domain methods need access._
    - 适用情况 : 例如, 有一些领域数据置身于 GUI 控件中, 而领域方法需要访问这些数据
- _Copy the data to a domain object. Set up an observer to synchronize the two pieces of data._
    - 做法 : 将该数据复制到一个领域对象中; **建立一个 Observer 模式, 用以同步领域对象和 GUI 对象内的重复数据**
- _不好解释清楚, 示例也较复杂, 详情见原书_
    - _简而言之, 就是将存储层的领域对象 (数据及其处理), 跟展示层的 GUI 控件 (数据及其处理), 隔离开来/解耦_
        - _( 以下尝试用自己的话来梳理思路 )_
        - _有多个控件都关联同一个领域对象时, 这么做就特别有有意义_
        - _领域对象 封装好以此为准的一份数据 (一致性) 及其处理_
        - _控件只需要通过 Observer 模式订阅领域对象; 当领域对象发生变化时, 它会通知控件_
        - _这时控件以领域对象的数据为准, 根据控件自身的情况, 作出相应处理_

Change Unidirectional Association to Bidirectional 将单向关联改为双向关联

- _You have two classes that need to use each other's features, but there is only a one-way link._
    - 适用情况 : 两个类都需要使用对方特性, 但其间只有一条单向连接
- _Add back pointers, and change modifiers to update both sets._
    - 做法 : 添加一个反向指针, 并使修改方法能够同时更新两条连接

Change Bidirectional Association to Unidirectional 将双向关联改为单向关联

- _Change Unidirectional Association to Bidirectional 的反向操作_
- _You have a two-way association but one class no longer needs features from the other._
    - 适用情况 : 两个类之间有双向关联, 但其中一个类如今不需要另一个类的特性
- _Drop the unneeded end of the association._
    - 做法 : 去除不必要的关联

Replace Magic Number with Symbolic Constant 以字面常量取代魔法数

- 适用情况 : _You have a literal number with a particular meaning._
- 做法 : _Create a constant, name it after the meaning, and replace the number with it._

Encapsulate Field 封装字段

- 适用情况 : _There is a public field._
- 做法 : _Make it private and provide accessors._

Encapsulate Collection 封装集合

- _A method returns a collection._
    - 适用情况 : 有个方法返回一个集合
- _Make it return a read-only view and provide add/remove methods._
    - 做法 : 让这个方法返回该集合的一个只读副本, 并在这个类中提供添加/移除集合元素的方法

Replace Record with Data Class 以数据类取代记录

- _You need to interface with a record structure in a traditional programming environment._
    - 适用情况 : 需要面对传统变成环境中的结构数据
- _Make a dumb data object for the record._
    - 做法 : 为该记录创建一个 "哑" 数据对象
        - 具体手法 : Replace Array with Object

~~Replace Type Code with Class 以类取代类型码~~

- _原书处于 Java 1.2 时代, 还没 enum 可用, 所以这里采用 class_

Replace Type Code with Enum 以枚举常量取代类型码

- _A class has a numeric type code that does not affect its behavior._
    - 适用情况 : 类之中有一个数值类型码, 但它并 **不影响类的行为**
- _Replace the number with a new Enum._
    - 做法 : 以一个新的枚举常量替换该数值类型码

Replace Type Code with SubClass 以子类取代类型码

- _You have an immutable type code that affects the behavior of a class._
    - 适用情况 : 有一个不可变的类型码, 它会 **影响类的行为**
- _Replace the type code with subclasses._
    - 做法 : 以子类取代这个类型码
    - 例如 switch 和 if-elseif-else 语句, 可使用 Replace Conditional with Polymorphism 重构
        - **避免使用 switch 语句, 但是如果只有 Factory 工厂一处用到 (只用于决定创建何种对象), 就可以接受!**
- 可用 Replace Type Code with SubClass 除非
    - 1\. 类型码值在对象创建之后, 会发生改变
    - 2\. 由于某些原因, 类型码宿主类已经有了子类
- 这时适用 Replace Type Code with State/Strategy

Replace Type Code with State/Strategy 以 状态/策略 取代类型码

- _You have a type code that affects the behavior of a class, but you cannot use subclassing._
    - 适用条件 : 有一个类型码, 它会影响类的行为, 但你无法通过集成手法消除它
        - _具体什么情况下无法消除, 详见原书实例_
- _Replace the type code with a state object (e.g. Enum)._
    - 做法 : 以状态对象 (例如, 枚举常量) 取代类型码
- _是 State 还是 Strategy? 设计时, 对于模式 (与其名称) 的选择, 取决于你结构的看法_

Replace Type Code with Fields 以字段取代类型码

- _You have subclasses that vary only in methods that return constant data._
    - 适用情况 : 各个子类的唯一区别只在 "返回常量数据" 的方法上
- _Change the methods to superclass fields and eliminate the subclasses._
    - 做法 : 修改这些方法, 使它们返回超类中的某个 (新增) 字段, 然后销毁子类

## Simplify Conditional Expressions

> 简化条件表达式

Decompose Conditional 分解条件表达式

- _You have a complicated conditional (if-then-else) statement._
    - 适用情况 : 有一个复杂的条件 (if-then-else) 语句
- _Extract methods from the condition, then part, and else parts._
    - 做法 : 从 if、then、else 三个段落中分别提炼出独立方法
        - _用适当的方法名来表达代码的目的, 清晰而明白, 可读性好_

Consolidate Conditional Expression 合并条件表达式

- _You have a sequence of conditional tests with the same result._
    - 适用情况 : 有一系列条件测试, 都得到相同结果
- _Combine them into a single conditional expression and extract it._
    - 做法 : 将这些测试合并为一个条件表达式, 并将这个条件表达式提炼为一个独立方法
- _当然存在不宜合并的情况_
    - _这些测试虽然返回相同结果, 但实际上相互独立, 只是恰好同时发生, 不应视为同一次检查, 就不要合并_
    - _某种情况下, 虽然返回相同的结果, 但是需要做额外的日志记录?_
        - _还是可以合并, 只是分支中得再内嵌一层检查, 然后在该种情况下进行记录日志_

Remove Control Flag 移除控制标记 (?)

Replace Nested Conditional with Guard Clauses 以卫语句取代嵌套条件表达式 (?)

Replace Condtional with Polymorphism 以多台取代条件表达式 (?)

Introduce Null Object 引入 Null 对象 (?)

Introduce Assertion 引入断言

## Make Method Calls Simpler

> 简化方法调用

Rename Method 方法改名

Add Parameter 添加参数

Remove Parameter 移除参数

Separate Query from Modifier 将查询方法和修改方法分离 (?)

Parameterize Method 令方法携带参数 (?)

Replace Parameter with Explicit Methods 以明确方法取代参数

Preserve Whole Object 保持对象完整 (?)

Remove Setting Method 移除设值方法 (?)

Hide Method 隐藏方法 (?!)

Replace Constructor with Factory Method 以工厂方法取代构造方法

Encapsulate Downcast 封装向下转型 (?)

Replace Error Code with Exception 以异常取代错误码

Replace Exception with Test 以测试取代异常 (?)

## Dealing with Generalization

> 处理概括(泛化?)关系

Pull Up Field 字段上移

Pull Up Method 方法上移

Pull Up Constructor Body 构造方法本地上移 (?)

Push Down Method 方法下移

Push Down Field 字段下移

Extact Subclass 提炼子类 (?)

Extract Superclass 提炼超类

Extract Interface 提炼接口

Collapse Hierarchy 折叠继承体系 (?)

Form Template Method 塑造模板方法 (?)

Replace Inheritance with Delegation 以委托取代继承 (?)

Replace Delegation with Inheritance 以继承取代委托 (?)

## Big Refactoring

> 大型重构

Tease Apart Inheritance 梳理并分解继承体系 (?)

Convert Procedural Design to Objects 将过程化设计转化为对象设计 (?)

Separate Domain from Presentation 将领域和表述/显示分离 (?)

Extract Hierarchy 提炼继承体系

## Refactoring, Reuse, and Reality

重构, 复用和现实

- 为什么开发者不愿意重构他们的程序

## Refatoring Tools

重构工具

## Putting It All Together

总结
