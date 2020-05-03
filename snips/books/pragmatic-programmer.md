# Pragmatic Programmer

References

- Book "The Pragmatic Programmer : your journey to mastery, 2nd Edition"
    - ZH Ver. :《 程序员修炼之道：通往务实的最高境界（第二版）》

第一版前言

- Tip 1 : 关注你的技艺 _( Care About Your Craft )_
    - 如果你不关心怎么做好, 为什么还要花时间去开发软件呢?
- Tip 2 : 思考! 思考你的工作 _( Think! About Your Work )_
    - 关掉辅助驾驶, 有自己掌控, 持续不断地评估所做的工作

## A Pragmatic Philosophy

章 1 : 务实的哲学 ( A Pragmatic Philosophy )

_1\. 人生是你的 ( It's Your Life )_

- Tip 3 : 你有权选择 _( You Have Agency )_
    - **人生是自己的. 把握住人生, 让它如你所愿**
        - _工作内容无聊没有意思? 团队一团糟? "改变这个组织, 或者换一个组织"_
            - _Does your work environment suck? Is your job boring? Try to fix it. But don’t try forever. As Martin Fowler says, "you can change your organization or change your organization."_
        - _担心自己掌握的技术过时? 安排时间学习看起来有趣的新技术_
            - _这是一种自我投资, **只有为此加班才是合理的**_
            - _If technology seems to be passing you by, make time (in your own time) to study new stuff that looks interesting._
                - _You’re investing in yourself, so doing it while you’re off-the-clock is only reasonable._
        - _不要期待事情自己变好, 而是考虑一下 : 自己行动起来_
            - _Be proactive and take them._

_2\. 我的源码被猫吃了 ( The Cat Ate My Source Code )_

- Tip 4 : 提供选择, 别找借口 _( Provide Options, Don't Make Lame Excuses )_
    - **提供选择而不是去找理由. 不要只说做不到; 解释一下都能做到些什么**
        - _英文原文 :_
            - _Don’t blame someone or something else, or make up an excuse._
            - _Don’t blame all the problems on a vendor, a programming language, management, or your coworkers._
            - _Any and all of these may play a role, but it is up to you to provide solutions, not excuses._

_3\. 软件的熵 ( Software Entropy )_

- Tip 5 : 不要放任破窗 _( Don't Live with Broken Windows )_
    - 只要看到 不好的设计 / 错误的决策 / 糟糕的代码, 就赶紧去纠正

_4\. 石头做的汤和煮熟的青蛙 ( Stone Soup and Boiled Frogs )_

- Tip 6 : 做推动变更的催化剂 _( Be Catalyst for Change )_
    - 你无法强迫人们去改变, 但可以展示美好未来, 并帮助他们参与创造
- Tip 7 : 牢记全景 _( Remember the Big Picture )_
    - 不要过度沉浸于细枝末节, 一面觉察不到周围正在发生的事情

_5\. 够用即可的软件 ( Good-Enough Software )_

- Tip 8 : 将质量要求视为需求问题 _( Make Quality a Requirements Issue )_
    - 让用户参与对项目真实质量的确定

_6\. 知识组合 ( Knowledge Portfolio )_

- Tip 9 : **对知识组合做定期投资** _( Invest Regularly in Your Knownledge Portfolio )_
    - 养成学习的习惯
- Tip 10 : 批判性地分析你读到和听到东西 _( Critically Analyze What You Read and Hear )_
    - 不要受供应商、媒体炒作或教条的影响, 根据自身和项目的实际情况来分析信息

_7\. 交流! ( Communicate )_

- Tip 11 : 英语就是另一门编程语言 _( English is Just Another Programming Language )_
    - 将英语是做一门编程语言. 写文档和变成一样要遵守 DRY 原则、ETC、自动化等
        - _让它看起来不错_
            - _想法很重要. 但听众还希望有个好看的包装_
            - _太多的开发人员 ( 包括他们的经理 ) 在编写书面文档时, 只关注内容, 我们认为这不对_
            - _随便一个厨师 ( 或者是美食频道的主持人 ) 都会告诉你, 仅仅是糟糕的外观就能回调你在厨房里埋头苦干几小时的成果_
        - _回应别人_
            - _当你问别人一个问题时, 如果他们不回答, 你会觉得他们不礼貌_
            - _那么当别人发电子邮件或备忘录给你, 问你一些信息, 请你做一些事情时, 你有多少次没有回应? 日常生活忙忙碌碌, 忘点事情太常见了_
            - _一定要记得回复邮件, 就算简单地度偶依据 "我稍后答复你" 都好_
            - _**随时知会别人, 能让人更容易原谅你偶然的疏忽**, 让人觉得你并没有忘记他们_
- Tip 12 : 说什么和怎么说同样重要 _( It's Both What You Say and the Way You Say It )_
    - 如果无法有效交流, 任何伟大的想法都是没有意义的
- Tip 13 : 把文档嵌进去, 而不要拴在表面 _( Build Documentation In, Bon't Bolt It On )_
    - 与代码隔离的文档, 很难保持正确并及时更新

## A Pragmatic Approach

章 2 : 务实的方法 ( A Pragmatic Approach )

_8\. 优秀设计的精髓 ( The Essence of Good Design )_

- Tip 14 : 优秀的设计比糟糕的设计更容易变更 _( Good Design Is Easier to Change than Bad Design )_
    - 适合使用者的事物, 都已经过良好设计. 对代码来说, 这意味着必须适应变化
    - _ETC 原则 : Easier To Change 更容易变更_
        - _它是一种价值观念, 不是一条规则_

_9\. DRY -- 邪恶的重复 ( The Evils of Duplication )_

- Tip 15 : DRY -- 不要重复自己 _( Don't Repeat Yourself )_
    - 系统中的每一条知识, 都必须有单一且无歧义的权威陈述
        - _注释中的重复_
            - _不要用注释来解释代码做了什么, 因为这样的话, 变化的代码迟早会跟注释的解释不一致_
            - _将命名和排版做好即可, 注释只用来解释做什么/为什么. 如果需要了解细节, 源码里应有尽有!_
        - _数据中的重复_
            - _一个对象既有 start 也有 end 还有 length 字段, 这没必要! 因为 length 可以根据 start 和 end 计算出来_
            - _如果以后有性能要求, 必须缓存 length, 那时才这么做, 不必过早优化_
            - _经验 : **一个模块提供的所有服务都应该通过统一的约定来提供, 该约定不应表露出其内部实现是基于存储还是基于计算的**_
        - _表征的重复_
- Tip 16 : 让复用变得更容易 _( Make It Easier to Reuse )_
    - 只要复用方便, 人们就会去做. 创建一个支持复用的环境

_10\. 正交性 ( Orthogonality )_

- Tip 17 : 消除不相关事物之间的影响 _( Eliminate Effects Between Unreleated Things )_
    - 设计的组件, 需要自成一体、独立自主, 有单一的清晰定义的意图
        - _正交性 : 象征着 独立性 或 解耦性 ( 从几何学中借用来的术语 )_
            - _对于两个或多个事物, 其中一个的改变不影响其他任何一个, 则这些事物是正交的_
        - _测试正交性的方法 : 如果一个特别功能背后的需求发生显著改变, 有多少模块会受影响?_
        - _**不要依赖那些你无法控制的东西**_
        - _**当耦合是好的时, 我们称之为内聚**_

_11\. 可逆性 ( Reversibility )_

- Tip 18 : 不设最终决定 _( There Are No Final Decisions )_
    - 不要把决定刻在石头上, 而要将其视为写在沙滩上的东西, 时刻准备应变
- Tip 19 : 放弃追逐时尚 _( Forgo Following Fads )_
    - 尼尔·福特说过 : "昨日之最佳实践, 即明日之反模式." 要基于基本原则去选择架构, 而不应盲从于流行

_12\. 曳光弹 ( Tracker Bullets )_

- Tip 20 : **使用曳光弹找到目标** _( Use Tracer Bullets to Find the Target )_
    - 通过不断尝试并看清着弹点, 曳光弹可确保你最终击中目标
        - _曳光弹式开发 -- 在真是条件下针对 "移动目标" (多变的需求) 进行即时反馈_
            - _创建一个简单的工程, 加一行 "hello world!", 并确保其能编译和运行_
            - _然后, 我们再去找整个应用程序中不确定的部分, 添加上让他们跑起来的骨架_
        - _曳光弹式开发 的 **特点 -- 能跑起来**_

_13\. 原型与便签 ( Prototype and Post-it Notes )_

- Tip 21 : **用原型学习** _( Prototype to Learn )_
    - 制作原型旨在学习经验,其价值不在于过程中产生的代码, 而在于得到的教训
        - _汽车制造商可能会为一款新城的设计制造许多不同的 "原型"_
        - _每个原型都是为了测试一个特定的方面 -- 空气动力学、造型、结构特征等_
        - _原型开发 **特点 -- 不必制作真正 (能运行) 的东西**_
        - _原型开发 **目标 -- 找出有风险或不确定的因素**_
            - _原型的意义  : 为了学习经验 -- 不在于产生的代码, 而在于吸取的教训_
        - _如果发现自己处在不能放弃细节的环境中, 可能不是在 "制作原型", 而是进行 "曳光弹式开发"_
            - _可以忽略的细节 : 正确性 / 完整性 / 健壮性 / 格式_
        - _开始任何基于代码的原型开发前, 确保每个人都理解, 正在编写的是一次性代码_
            - _原型可能有着欺骗性的外表, 对哪些不知道这只是原型的人产生吸引力_
            - _必须非常清楚地表明改代码是用完即弃的, 它并不完整也不可能做到完整_
            - _( 明确目的, 别做多余的无用功 )_

_14\. 领域语言 ( Domain Languages )_

- Tip 22 : 靠近问题域编程 _( Program Close to Problem Domain )_
    - 用问题领域的语言来做设计和编程
        - _这里说的不是 "面向领域编程", 详情见原书_

_15\. 估算 ( Estinmating )_

- Tip 23 : **通过估算来避免意外** _( Estimate to Avoid Surprises )_
    - 开始之前做估算, 能提前发现潜在问题
        - _例如, 对内存/硬盘/带宽/耗时/项目排期的估算_
        - _计划评审技术 PERT -- Program Evaluation Review Techininque_
            - _每个 PERT 任务都有一个乐观的、一个最可能的、一个悲观的估算_
- Tip 24 : 根据代码不断迭代进度表 _( Iterate the Schedule with the Code )_
    - 利用实施过程中获得的经验来精细化项目的时间尺度

## The Basic Tools

章 3 : 基础工具 ( The Basic Tools )

_16\. 纯文本的威力 ( The Power of Plain Text )_

- Tip 25 : 将知识用纯文本保存 _( Keep Knowledge in Plain Text )_
    - 纯文本不会过时. 它能够让你的工作事半功倍, 并能简化调试和测试工作
        - _GUI 工具的好处在于 WYSIWYG -- What you see is what you get._
        - _GUI 工具的弱势在于 WYSIAYG -- What you see is all you get._

_17\. Shell 游戏 ( Shell Games )_

- Tip 26 : **发挥 Shell 命令的威力** _( Use the Power of Command Lines )_
    - 当图形化界面无法胜任时, 使用 Shell

_18\. 加强编辑能力 ( Power Editing )_

- Tip 27 : 游刃有余地使用编辑器 _( Achieve Editor Fluency )_
    - 既然编辑器是至关重要的工具, 不妨了解一下如何用它更快更准确地实现需求

_19\. 版本控制 ( Version Control )_

- Tip 28 : 永远使用版本控制 _( Always Use Version Control )_
    - 版本控制为你的工作创造了一个时间机器, 可以用它重返过去

_20\. 调试 ( Debugging )_

- Tip 29 : **去解决问题, 而不是责备** _( Fix the Problem, Not the Blame )_
    - Bug 到底来自你的失误还是别人的失误真的不重要 -- 它终究是你的问题, 需要你来修复
- Tip 30 : **不要恐慌** _( Don't Panic )_
    - 不管是对银河系搭车客, 还是对开发者来说, 都应这样
        - _不要在 "但那不可能发生" 的思路上浪费哪怕一个神经元, 因为很明显它会发生, 而且已经发生了!_
        - _注意不要短视, 不要仅仅去纠正你所看到的症状, 永远要去发掘问题的 **根本原因**_
- Tip 31 : **修代码前先让代码在测试中失败** _( Failing Test Before Fixing Code )_
    - 在你修 Bug 前, 先创建一个聚焦于该 Bug 的测试
- Tip 32 : **读一下那些该死的出错信息** _( Read the Damn Error Messages )_
    - 大多数异常都能告诉失败之物与失败之处. 如果足够幸运, 你甚至能得到具体的参数值
- Tip 33 : "select" 没出问题 _( "select" Isn't Broken )_
    - **在操作系统或编译器中发现 Bug 非常罕见**, 甚至在第三方产品或库中也是如此. Bug 大多出现在应用程序中
        - _怀疑操作系统/编译器/第三方库/中间件/数据库有问题? 还不如怀疑自己的应用程序有问题…_
- Tip 34 : **不要假设, 要证明** _( Don't Assume It, Prove It )_
    - 在真实环境中证实你的假设 -- 要依赖真实的数据及边界条件
        - _除了 bugfix, 还需要 **确认为什么没有更早地发现这个错误?**_
            - _是否需要修改单元测试或其它测试, 以让这些测试能够捕获到它_

_21\. 文本处理 ( Text Manipulation )_

- Tip 35 : 学习一门文本处理语言 _( Learn a Text Manipulation Language )_
    - 既然每天都要花大量的时间与文本打交道, 何不让计算机帮你分担一二?

_22\. 工程日记 ( Engineering Daybooks )_

- _就是 工作日志/备忘录/想法速记/……_
- _好处_
    - _备忘录 : 比记忆可靠_
    - _TODO List : 保存与当前任务无关的内容, 继续专注手头上的事_
    - _反观诸己 : 作用像是橡皮鸭, 换旁观者的角度来观察自己, 反省_

## Pragmatic Paranoia

章 4 : 务实的偏执 ( Pragmatic Paranoia )

- Tip 36 : 你无法写出完美的软件 _( You Can't Write Perfect Software )_
    - 软件不可能是完美的. 对于在所难免的错误, 要保护代码和用户免受其影响
        - _务实的程序员更进一步, 他们连自己也不相信_

_23\. 契约式设计 ( **DBC -- Design By Contract** )_

- Tip 37 : 通过契约进行设计 _( Design By Contracts )_
    - 代码是否不多不少刚好完成它宣称要做的事情, 可以使用契约加以校验和文档化
        - _Design By Contract_
            - _前置条件 : 一个例程永远不应该在前置条件被违反的时候被调用_
            - _后置条件 : 保证例程完成时世界的状态 ( 例如不允许无线循环 )_
            - _类的不变式 : 从调用者角度来看, 类会确保该条件始终为真_
        - _强调编写 "懒惰" 的代码 ( 相关 : 正交性 建议编写 "害羞" 的代码 )_
            - _开始之前, 对要接收的东西要求严格一点, 并且尽可能少地对回报做出承诺_
            - _如果你定的契约是可以接受任何东西, 并且承诺回报整个世界, 那么你就有很多代码要写_

_24\. 死掉的程序不会说谎 ( Dead Programs Tell No Lies )_

- Tip 38 : 尽早崩溃 _( Crash Early )_
    - 彻底死掉的程序通常比有缺陷的程序造成的损害要小
        - _与其 try-catch 之后 ( 可能会记一下日志, 再包装成别的异常 ) 重新抛出, 可能不如直接让异常抛出来_
        - _"防御式编程是在浪费时间, 让它崩溃!"_

_25\. 断言式编程 ( Assertive Programming )_

- Tip 39 : 使用断言去预防不可能的事情 _( User Assertions to Prevent the Impossible )_
    - 如果一件事情不可能发生, 那么就用断言来确保其的确不会发生. 断言在校验你的假设, 要使用断言在不确定的世界中将你的代码保护起来

_26\. 如何保持资源的平衡 ( How to Balance Resources )_

- Tip 40 : 有始有终 _( Finish What You Start )_
    - 只要有可能, 对资源进行分配的函数或对象就有责任去释放该资源
- Tip 41 : 在局部行动 _( Act Locally )_
    - 将易变的变量维持在一个范围内, 打开资源的过程要短暂且明显可见

_27\. 不要冲出前灯范围 ( Don't Outrun Your Headlights )_

- Tip 42 : 小步前进 -- 由始至终 _( Take Small Steps -- Always )_
    - 永远小步前进, 不断检查反馈, 并且在推进前先做调整
        - _我们不是应该为将来的维护做设计吗? 没错, 不过要适可而止: **别超过你能看见的范围**_
        - _越是必须预测未来会怎样, 就越有可能犯错. 与其浪费精力为不确定的未来设计, 还不如将代码设计成可替换的_
        - _当你想要丢弃你的代码, 或将其换成更合适的时, 要让这一切无比容易, 这有助于提高内聚性、解耦和 DRY, 从而实现更好的总体设计_
- Tip 43 : 避免占卜 _( Avoid Fortune-Telling )_
    - 只在你能看到的范围内做计划

## Bend, or Break

章 5 : 宁弯不折 ( Bend, or Break )

_28\. 解耦 ( Decoupling )_

- Tip 44 : 解耦代码让改变更容易 _( Decoupled Code Is Easier to Change )_
    - 耦合使事物紧紧绑定在一起, 以至于很难只改变其中之一
        - _注意留心一些耦合的 "症状"_
            - _…… ( 没深刻感受的前两条略过 )_
            - _开发人员害怕修改代码, 因为他们不确定会造成什么影响_
            - _会议要求每个人都必须参加, 因为没有人能确定谁会受到变化的影响_
- Tip 45 : 只管命令不要询问 _( TDA -- Tell, Don't Ask )_
    - 不要从对象中取出值, 在加以变换后再塞回去, 让对象自己来完成这些工作
        - _直接向 "服务" 要我们想要的_
        - _[得墨忒耳定律](https://zh.wikipedia.org/wiki/%E5%BE%97%E5%A2%A8%E5%BF%92%E8%80%B3%E5%AE%9A%E5%BE%8B) ( LoD - Law of Demeter ) :_
            - _亦被称作 "最少知识原则" ( Principle of Least Knowledge )_
            - _定义在 C 类中的方法只应该调用 :_
                - _C 类其它实例的方法_
                - _它的参数_
                - _他所创建出来的对象的方法, 包括在栈上和堆上的对象_
                - _~~全局变量~~_
- Tip 46 : 不要链式调用方法 _( Don't Chain Method Calls )_
    - 当访问某事物时, 使用的点号不要超过一个
        - _例外 : 如果你链式调用的东西真的不太可能改变_
        - _实践中, 应用程序中的任何内容, 都应该被认为是可能发生改变的_
- Tip 47 : 避免全局数据 _( Avoid Global Data )_
    - 最好给每个方法增加一个额外的参数
        - _全局可访问数据是应用程序组件之间耦合的潜在来源_
            - _**每一块全局数据就好像让应用程序中的每个方法都突然获得了一个额外的参数**_
        - _全局变量带来耦合的最明显原因 : **可能会潜在地影响到系统中的所有代码**_
            - _当然, 在实践中影响相当有限; 问题在于你必须找到每一处需要修改的地方_
        - _**当然 "重用" 可能不总是创建代码时主要考虑的问题**; 但它仍然是一个可以探求的目标_
        - _全局数据包括外部资源 : DB / 数据存储 / File System / 服务 API_
            - _确保始终将这些资源包装在你所控制的代码之中_
- Tip 48 : 如果全局唯一非常重要, 那么将它包装到 API 中 _( If It's Important Enough to Be Global, Wrap It in an API )_
    - …… 但是, 仅限于你真的非常希望它是全局的
        - _耦合的代码很难变更, 所以要避免一个地方的修改对其它地方产生副作用_
        - _**让代码害羞一点 : 让它只处理直接知道的事情**_

_29\. 在现实世界中抛球杂耍 ( Juggling the Real World )_

- _事件 : 响应事件的应用程序, 使用 4 种策略来帮助来避免紧密耦合_
    - _1\. **有限状态机** ( FSM - Finite State Machine )_
        - _其实并不困难_
    - _2\. **观察者模式** ( Observer Pattern )_
        - _观察者根据其兴趣被注册到观察对象上, 这通常由传递一个带调用的函数引用来实现_
            - _当事件发生时, 被观察对象遍历它的观察者列表, 并调用每个传递给它的函数; 事件作为调用参数提供给函数_
        - _因为每个观察者都必须与被观察对象注册在一起, 所以引入了耦合_
        - _在经典的实现中, 回调是由被观察对象以同步的方式内联处理的, 因此可能造成性能瓶颈_
    - _3\. **发布/订阅** ( Pubsub - Publish / Subscribe )_
        - _推广了观察者模式, 同时解决了耦合和性能问题_
    - _4\. **响应式编程与流** ( Responsive Programming & Stream )_
        - _事件流 : 例如, 生成一个包含用户 ID 的被观察事件, 用它来取代那个被观察的对象_

_30\. 变换式编程 ( Tramsforming Programming )_

- Tip 49 : 编程讲的是代码, 而程序谈的是数据 _( Programming Is About Code, But Programs Is About Data )_
    - 所有的程序都在变换数据 -- 将输入转换为输出. 开始用变换式方法来设计吧!
        - _举例 : 列出目录树中拥有行数最多的 5 个文件_
            - _使用命令和管道来实现 `find . -type f | xargs wc -l | sort -n | tail -5`_
        - _除了命令行或编程语言中的管道特性, 还有 Java 的 Stream 等_
- Tip 50 : 不要国积状态, 传递下去 _( Don't Hoard State; Pass It Around )_
    - 不要把数据保持在函数或模块的内部, 拿出来传递下去
        - _详见原书程序例子_
            - _stream / pipe 的错误处理怎么做 : 在变换的内部或外部做_
        - _变换到 "**变换式编程**"_
            - _将代码看作一系列 (嵌套的) 变换, 可以为编程打开思路_
            - _这需要一段时间来适应, 但是一旦你养成这个习惯, 将发现代码变得更简洁, 函数变得更短, 而而删除也变得更平顺_

_31\. 继承税 ( Inheritance Tax )_

- Tip 51 : 不要付继承税 _( Don't Pay Inheritance Tax )_
    - 考虑一下能更好满足需求的替代方案, 比如接口、委托或 mixin
        - _使用继承的两个 (荒谬的) 原因:_
            - _1\. 不喜欢拍键盘 -- 通过继承, 将基类的公共功能添加待子类中_
            - _2\. 喜欢类型 -- 表达类之间的关系_
        - _其实这两种形式的继承都有问题!_
            - _1\. 继承 就是 耦合 -- 不仅子类耦合到祖先类, 而且使用子类的代码也耦合到所有祖先类_
            - _2\. 继承 定义 新类型 -- 像科学家一样, 将事物分门别类_
                - _类之间的细微差别逐层叠加, 复杂性增加, 程序更脆弱, 因为一个变化影响太多代码层_
        - _更好的替代方案_
            - _接口与协议 ( interface & agreement )_
            - _委托 ( delegate )_
            - _mixin 与特征 ( mixin & trait? )_
- Tip 52 : 尽量用接口来表达多态 _( Prefer Interfaces to Express Polymorphism )_
    - 无需继承引入的藕合, 接口就能明确描述多态性
        - _接口与协议之所以如此强大, 是因为可以将它们用作类型, 而实现适当的接口的任何类都将与该类型兼容 ( 例如 List\<Locatable\> )_
- Tip 53 : 用委托提供服务 : "有一个" 胜过 "是一个" _( Delegate to Services: Has-A trumps Is-A )_
    - 不要从服务中继承, 应该包含服务
- TIp 54 : 利用 mixin 共享功能 _( Use Mixins to Share Functionality )_
    - mixin 不必承担继承税就可以给类添加功能, 而与接口结合可以让多态不再令人痛苦
        - _感觉 PHP 的 trait 特征 (特性) 就是一种 mixin_

_32\. 配置 ( Configuraion )_

- Tip 55 : 使用外部配置参数化应用程序 _( Parameterize Your App Using External Configuration )_
    - 如果代码对一些在应用程序发布后还有可能改变的值有所依赖, 那么就在应用外部维护这些值
        - _如果没有外部配置, 代码的适应性和灵活性就会大打折扣, 这是一件坏事吗?_
            - _在现实世界中, 不适应环境的物种会死亡_
        - _不要做得太过 ( 走极端 ), 保持灵活性, 根据实际情况的反馈来不断调整_

## Concurrency

章 6 : 并发 ( Concurrency )

_33\. 打破时域耦合 ( Break Temporal Coupling )_

- Tip 56 : 通过分析工作流来提高并发性 _( Analyze Workflows to Improve Concurrency )_
    - 利用用户工作流中的并发性
        - _如果代码给几件事情强加一个顺序进来, 而这个顺序对解决手头问题而言并非必需, 就会发生 **时序耦合** ( Temporal Coupling )_

_34\. 共享状态是不正确的状态 ( Shared State is Incorrect State )_

- Tip 57 : 共享状态是不正确的状态 _( Shared State is Incorrect State )_
    - 共享状态会带来无穷的麻烦, 而且往往只有重启才能解决
        - _不单单指全局变量; 任何时候, 只要两个或多个代码块持有对同一个可变数据块的引用, 就已经共享了状态 -- **共享状态是不正确的状态**_
        - _**信号量** 是一个在同一时间只能让一个人持有的东西_
- Tip 58 : 随机故障通常是并发问题 _( Random Failures Are Often Concurrency Issues )_
    - 或许时间和上下文的变化能暴露并发 Bug, 但并发 Bug 无法始终保持一致, 也很难重现
        - _时间 有两个重要的方面 : 并发性 ( 在同一时刻发生的多件事情 ) 以及次序 ( 事情在时间轴上的相对位置 )_

_35\. 角色与进程 ( Actors and Processes )_

- Tip 59 : 用角色实现并发性时不必共享状态 _( Use Actors For Concurrency Without Shared State )_
    - **使用角色来管理并发状态, 可以避免显式的同步**
        - _角色模型_
            - _角色 : 一个独立的虚拟处理单元, 具有自己的本地 (且私有的) 状态._
                - _每个角色都有一个信箱, 当消息出现在信箱中且角色处于空闲状态时, 角色被激活并开始处理消息_
                - _处理完该条消息后, 它将继续处理信箱中的其他消息, 如果信箱是空的, 则返回休眠状态_
                - _在处理消息的过程中, 一个角色可以创建其他角色, 可以向其他认识的角色发送消息_
                    - _也可以创建一个新的状态, 用来在处理下一条消息时作为当前状态_
            - _进程 : 通常代表一种更通用的虚拟处理机, 它一般由操作系统实现, 可以让并发处理更容易_
                - _进程也能 ( 根据约定 ) 被约束为以角色的形式运转, 我们再这里说的就是这类进程_
            - _在角色模型中, 不需要为处理并发性编写任何特定代码, 因为没有共享状态_
                - _对于业务从头到尾的逻辑, 也没有必要以 "做这个, 做那个" 的方式, 将其显式地写在代码里, 因为角色会给予收到的消息自己处理这些事情_
        - _Erlang 把角色称为进程, 但不是常规的操作系统进程_
            - _Erlang 的进程是轻量级的 ( 可以在一台机器上运行数百万个进程 ), 其通过发送消息进行通信_
            - _每一个进程都与其他进程相互隔离, 进程之间没有状态共享_
        - _此外 Erlang 的运行时实现了一个监督形同, 管理者进程的生命期, 在出现故障时能重启一个进程或一组进程_
            - _还提供热加载机制 : 可以在不停止正在运行的系统的情况下, 替换该系统中的代码, 号称有 9 个 9 的可用性_

_36\. 黑板 ( Blackborads )_

- Tip 60 : 使用黑板来协调工作流 _( Use Blackboards to Coordinate Workflow )_
    - 使用黑板来协调不相关的事实和代理人, 能同时保持参与者之间的独立性和孤立性
        - _**消息传递系统 就是一种黑板** ( 例如 Kafka / NATS (?) )_
            - _不但能传递消息, 还能持久化 ( 以时间日志的形式 )_

## While You Are Coding

章 7 : 当你编码时 ( While You Are Coding )

_37\. 听从蜥蜴脑 ( Listen to Your Lizard Brain )_

- Tip 61 : 倾听你内心的蜥蜴 _( Listen to Your Inner Lizard )_
    - 当编程举步维艰时, 其实是潜意识在告诉你有什么地方不对劲
        - _害怕空白页_
            - _开始一个新项目 ( 甚至是现有项目中的一个新模块 ) 有可能让人不安, 因此我们中的许多人宁愿推迟迈出第一步_
        - _造成这种情况的两个原因 :_
            - _1\. 直觉试图告诉你在感知面下潜藏着某种形式的疑虑_
                - _你已经尝试过很多东西, 并已了解哪些是有效的, 哪些是无效的_
                - _一直积累的经验和智慧, 是否在试图告诉些什么?_
            - _2\. 可能只是担心自己会犯错 : "冒名顶替症候群"_
                - _( 症状是怀疑自身能力, 以为自己的成功都来自外界因素 )_
                - _认为这个项目超出了能力范围 -- 看不到通往终点的路, 只好继续远行, 直到最后被迫承认自己迷路_
        - _注意你对代码的疑虑 -- 这可能超过了本应具有的难度_
            - _也许结构或设计是错误的, 也许你解决了错误的问题_
            - _也许你只是创造了一个只会招来 bug 的蚂蚁农场_
        - _( 这部分 "软技能" 内容, 详见原书, 不再摘录了 )_

_38\. 巧合式编程 ( Programming by Coincidence )_

- Tip 62 : 不要依赖巧合编程 _( Don't Program by Coincidence )_
    - 只能依赖可靠的事物. 注意偶然事件的复杂性, 不要混淆快乐的巧合与有目的的计划
        - _因为靠运气和意外来获得成功是行不通的, 编程应该深思熟虑_
        - _人类天生就善于发现模式和归咎原因, 即使那些东西只是巧合_
        - _不要假设, 要证明 ( Don't assume it, prove it. )_
        - _找到恰好能用的答案和找到正确的答案不是一回事_
            - _( 但是为了应付工期紧迫的任务, 可能敷衍了事 )_

_39\. 算法速度 ( Algorithm Speed )_

- Tip 63 : 评估算法的级别 _( Estimate the Order of Your Algorithms )_
    - 在开始编程前, 对这件事情大概会花多长时间要有概念
        - _Estimate the resources that algorithms use : time, processor, memory and so on._
        - _如果你有一个 O(n^2) 的算法, 试试寻找一个分治的方法把它降到 O(n*lg(n))_
- Tip 64 : 对估算做测试 _( Test Your Estimates )_
    - 针对算法的数学分析无法说明所有问题, 尝试在目标环境中测试一下执行代码的耗时
        - _最好的不会永远最好 ( Best isn't always best. )_

_40\. 重构 ( Refactoring )_

- Tip 65 : 尽早重构, 经常重构 _( Refactor Early, Refactor Often )_
    - 像除草和翻整花园那样, 只要有需要就对代码进行重新编写、修订和架构, 以便找到问题的根源并加以修复
        - _软件开发最常见的隐喻是 "建筑的构建"_
            - _建筑师绘制蓝图 -> 承包商施工装修 -> 住户搬来居住_
        - _但是, **"园艺" 的隐喻更接近于现实的软件开发 ( 真正恰当的隐喻 )**_
            - _软件开发更像是园艺而非建筑, 它更像一个有机体而非砖石堆砌_
            - _根据最初的计划和条件, 在花园里种植很多花木, 有些茁壮成长, 另一些注定要成为堆肥_
            - _你会改变植物相对的位置, 利用光和影、风和雨的相互作用_
            - _过度生长的植物会被分栽或修剪, 不协调的颜色会转移到更美观的地方_
            - _你拔除杂草, 给需要额外帮助的植物施肥_
            - _不断地检测花园的健康状况, 并根据需要 ( 对土壤、植物、布局 ) 做出调整_
        - _商务人士对建筑的隐喻感到很舒服 : 它比园艺更科学, 是可重复的, 管理上有严格汇报层次结构, 等等_
            - _但是编程并不是在建造摩天大楼 -- 也没有受到物理和现实世界的限制_
            - _也许某个例程日渐庞大, 或许是它想要完成的事情太多, 所以需要一分为二_
                - _无法得到计划中结果的东西需要被删除或修剪_
        - _**重构** ：重组现有代码实体、改变内部结构而不改变其外部行为的规范式技术_
            - _"Discilined technique for restructuring an existing body of code, altering its internal structure without changing its external behavior."_
            - _重构不是一种特殊的、隆重的、偶尔进行的活动_
                - _为了重新种植而在整个花园中翻耕, 重构不是这样的活动_
            - _重构是一项日复一日的工作, 需要采取低风险的小步骤进行, 更像是耙松和除草这类活动_
            - _这是有针对性的、精确的方法, 有助于保持代码易于更改, 而不是对代码库进行自由的、大规模的重写_
        - _**时间压力 常常被用作不重构的借口**, 但是这个借口根本站不住脚_
            - _如果现在不进行重构, 那么以后就需要投入更多的时间来解决问题 -- 因为需要处理更多的依赖关系_
            - _到时会有更多的时间吗? 不可能有_

_41\. 为编码测试 ( Test to Code )_

- Tip 66 : 测试与找 Bug 无关 _( Testing Is Not About Finding Bugs )_
    - 测试是观察代码的一个视角, 可以从中得到针对设计、接口和耦合度的反馈
        - _**测试不是关于找 bug 的工作, 而是一个从代码中获取反馈的过程, 涉及设计的方方面面, 以及 API、耦合度等**_
            - _这意味着, 测试的主要收益来自于你的思考和编写测试期间, 而不是运行测试那一刻_
        - _为方法写一个测试的考虑过程, 使我们得以从外部看待这个方法, 这让我们看起来是代码的客户, 而不是代码的作者_
- Tip 67 : 测试是代码的第一个用户 _( Test Is the First User of Your Code )_
    - 用测试的反馈来引导工作
        - _与其他代码紧密耦合的函数或方法很难进行测试_
            - _因为你必须在运行方法之前设置好所有环境, 所以让你的东西可测试也减少了它的耦合_
        - _在你能对一个东西做测试之前, 必须先理解它_
            - _虽然听起来很傻, 但现实中我们开始编写代码, 都只能基于对必须要做的事情的模糊理解_
        - _我们打算边干边解决, 过程中不断解决各种新的问题, 代码变得比应有的长度长数倍_
            - _如果用测试先探照一下代码, 事情就会变得清楚 -- 在开始编码之前, 就考虑过测试边界条件及其工作方式, 就更可能发现简化函数的逻辑模式_
        - _**TDD - Test Driven Development** : "既然预先考虑测试有那么多好处, 为什么不先把它们先写出来呢?"_
            - _TDD 的设计倾向于 "自底向上" ( Bottom Up ). 务必实践一下 TDD, 但过程中不要忘记时不时停下来看看大局_
            - _**人们很容易被 "测试通过" 的绿色消息所诱惑, 从而编写大量的代码, 但实际上这些代码并不能让你离解决方案更近**_
        - _自上而下 V.S.自下而上_
            - _**自上而下** : 应该从试图解决的整个问题开始, 把它分解成几块 ( **分治** )_
                - _然后逐步拆分成更小的快, 以此类推, 知道最后得到小到可以用代码表示的块为止_
            - _**自下而上** : 主张构建代码就像 **构造房子**_
                - _从底层开始, 生成一层代码, 为这些代码提供一些更接近目标问题的抽象, 然后添加一层具有更高层次的抽象_
                - _整个过程会持续下去, 直到所要解决的问题的抽象出现_
            - _实际上这两派都没有成功, 因为它们都忽略了软件开发中最重要的一个方面 : **我们不知道开始时在做什么**_
                - _自上而下学派认为 : 可以提前表达整个需求, 然而实际做不到_
                - _自下而上学派假设 : 能构建出一系列抽象, 这串抽象最终会将他们带到一个单一的顶层觉接方案, 但是当不知道方向时, 如何决定每一层的功能呢?_
        - _( 讨论过程详见原书, 这里就不摘录更多了 )_
- Tip 68 : 既非自上而下, 也不自下而上, 基于端对端构建 _( Build End-to-End, Not Top-Down or Bottom Up )_
    - 创建一小块端到端的功能, 从中获悉问题之所在
        - _我们坚信 : 构建软件的唯一方法是增量式的_
            - _构建端到端功能的小块, 一边工作一边了解问题_
            - _应用学到的知识持续充实代码, 让客户参与每一个步骤并让他们知道这个过程_
        - _测试对开发的驱动绝对能有帮助, 但是就像每次驱动骑汽车一样, 除非心里有一个目的地, 否则就可能会兜圈子_
- Tip 69 : 为测试做设计 _( Design to Test )_
    - 写下代码之前先从测试角度思考
        - _需要从一开始就在软件中构建可测试性, 并在尝试将每个部分连接在一起之前, 对它们进行彻底的测试_
        - _**回归测试** : 与相同测试的前一次运行结果比较_
- Tip 70 : 要对软件做测试, 否则只能留给用户去做 _( Test Your Software, or Your Users Will )_
    - 无情地测试, 不要等用户来帮你找 Bug

_42\. 基于特性测试 ( Property-Based Testing )_

- Tip 71 : 使用基于特性的测试来校验假设 _( Use Property-Based Tests to Validate Your Assumptions )_
    - 基于特性的测试将会进行你从未想过的尝试, 并会以你不曾打算采用的方式操练你的代码.

_43\. 出门在外注意安全 ( Stay Safe Out There )_

- Tip 72 : 保持代码简洁, 让攻击面最小 _( Keep It Simple and Minimize Attack Surfaces )_
    - 复杂的代码给 Bug 以滋生之沃土, 给攻击者以可趁之机
- Tip 73 : 尽早打上安全补丁 _( Apply Security Patches Quickly )_
    - 攻击者会尽可能快地部署攻击, 你必须快上加快

_44\. 事物命名 ( Naming Things )_

- Tip 74 : 好好取名; 需要时更名 _( Name Well; Rename When Needed )_
    - 用名字向读者表达你的意图, 并且在意图改变时及时更名
        - _命名是软件开发中最困难的事情之一_
            - _不得不给很多东西起名字, 而我们的选择的名字在很多方面决定了所创造的最终是什么_
            - _在编写代码时, 需要注意任何潜在的语义偏移_

章 8 : 项目启动之前 ( Before the Project )

_45\. 需求之坑 ( The Requirements Pit )_

- Tip 75 : 无人确切知道自己想要什么 _( No One Knows Exactly What The Want )_
    - 他们或许知道大概的方向, 但不会了解过程的曲折
- Tip 76 : 程序员帮助人们理解他们想要什么 _( Programers Help People Understand What They Want )_
    - 软件开发更像是一种由用户和程序员协同创造的行为
- Tip 77 : 需求是从反馈循环中学到的 _( Requirements Are Learned in a Feedback Loop )_
    - 理解需求需要探索和反馈, 因此决策的结果可以用来完善最初的想法
- Tip 78 : 和用户一起工作以便从用户角度思考 _( Work with a User to Think Like a User )_
    - 这是看透系统将如何被真正使用的最佳方法
- Tip 79 : 策略即元数据 _( Policy Is Metadata )_
    - 不要将策略硬编码进系统, 而应该将其表达为系统的一组元数据
- Tip 80 : 使用项目术语表 _( Use a Project Glossary )_
    - 为项目的所有特定词汇创建一张术语表, 并且在单一源头维护

_46\. 处理无法解决的难题 ( Solving Impossible Puzzles )_

- Tip 81 : 不要跳出框框思考 -- 找到框框 _( Don't Think Outside the Box -- Find the Box )_
    - 在面对无法解决的难题时, 识别出真正的约束. 可以问自己 : "必须 这样做才能搞定吗? 必须搞定它吗?"

_47\. 携手共建 ( Working Together )_

- Tip 82 : 不要一个人埋头钻进代码中 _( Don't Go into the Code Alone )_
    - 编程往往困难又费力, 找个朋友和你一起干
- Tip 83 : 敏捷不是一个名词; 敏捷有关你如何做事 _( Agile is Not A Noun; Agile Is How You Do Things )_
    - 敏捷是一个形容词, 有关如何做事情

_48\. 敏捷的本质 ( The Essence of Agility )_

章 9 : 务实的项目 ( Pragmatic Projects )

_49\. 务实的团队 ( Pragmatic Teams )_

- Tip 84 : 维持小而稳定的团队 _( Maintain Small, Stable Teams )_
    - 团队应保持稳定、小巧, 团队中的每个人都应相互信任、互相依赖
- Tip 85 : 排上日程以待其成 _( Schedule It to Make It Happen )_
    - 如果你不把事情纳入日程表, 它们就不会发生. 反思、实验、学习、提高技能, 这些事都应放入日程表
- Tip 86 : 组织全功能的团队 _( Orgaize Fully Functional Teams )_
    - 围绕功能而不是工作职能组织团队. 不要将 UI/UX 设计者从程序员中分离出去, 也不要分开前端和后端; 不要区分数据建模者和测试人员, 以及开发和设计. 构建一个团队, 这样你就可以渐进地不断迭代端到端的代码

_50\. 椰子派不上用场 ( Coconuts Don't Cut It )_

- Tip 87 : 做能起作用的事, 别赶时髦 _( Do What Works, Not What's Fashionable )_
    - 不要仅仅因为别的公司正在那么干就采纳一项技术或采用一个开发方法, 而是要采用自己所处环境中对团队有效的东西
- Tip 88 : 在用户需要时交付 _( Deliver When Users Need It )_
    - 不要卡着流程要求, 刻意等到几周甚至几个月后才交付

_51\. 务实的入门套件 ( Pragmatic Starter Kit )_

- Tip 89 : 使用版本控制来驱动构建、测试和发布 _( User Version Control to Drive Builds, Tests and Releases )_
    - 利用提交或推送来触发构建、测试、发布, 利用版本控制的标签来进行生产部署
- Tip 90 : 尽早测试, 经常测试, 自动测试 _( Test Early, Test Often, Test Automatically )_
    - 每次构建都跑一下的测试, 要比束之高阁的测试计划有效得多
- Tip 91 : 直到所有的测试都已运行, 编码才算完成 _( Coding Ain't Done 'till All the Tests Run )_
    - 无须多言
- Tip 92 : 使用破坏者检测你的测试 _( Use Saboteurs to Test Your Testing )_
    - 在一个单独的源码副本中特意引入 Bug, 验证测试能否将其捕获
- Tip 93 : 测试状态覆盖率, 而非代码覆盖率 _( Test Your State Coverage, Not Code Converage )_
    - 要识别并测试重要的程序状态, 只测试一行行的代码是不够的
- Tip 94 : 每个 Bug 只找一次 _( Find Bugs Once )_
    - 只要人类测试者找到一个 Bug, 就应该是该 Bug 最后一次被人类发现. 从此之后, 自动化测试完全可以发现它
- Tip 95 : 不要使用手动程序 _( Don't Use Manual Procedures )_
    - 计算机能一次又一次, 按照同样的次序, 执行相同的指令

_52\. 取悦用户 ( Delight Your Users )_

- Tip 96 : 取悦用户, 而不要只是交付代码 _( Delight Users, Don't Just Deliver Code )_
    - 为用户开发能够带来商业价值的解决方案, 并让他们每天都感到愉快
- Tip 97 : 在作品上签名 _( Sign Your Work )_
    - 过去的工匠在为他们的作品签名时非常自豪, 你也应该这样

_53\. 傲慢与偏见 ( Pride and Prejudice )_

跋

- Tip 98 : 先勿伤害 _( First, Do No Harm )_
    - 犯错在所难免, 确保犯错后没人会因此受难.
- Tip 99 : 不要助纣为虐 _( Don't Enable Scumbags )_
    - 因为这样做你也有变成纣王的风险
