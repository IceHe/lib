# Refactoring

References

- Book "Refactoring Improving the Design of Existing Code"
    - ZH Ver. :《 重构 改善既有代码的设计 》

## Preface

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

---

It is essential for refactoring that you have good tests.

- I'm going to be relying on the tests to tell me whether I introduce a bug.

## Bad Smell in Code

代码的坏味道

- Deplicated Code 重复代码
- Long Method
- Large Class
- Long Parameter List 过长参数列
- Deivergent Change 发散式变化 (?)
- Shotgun Surgery 霰弹式修改
- Feature Envy 依恋情节 (?!)
- Data Clumps 数据泥团 (?)
- Primitive Obsesion 基础类型偏执 (?)
- Switch Statements (?)
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

- Self Encapsulate Field 自封装字段
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
