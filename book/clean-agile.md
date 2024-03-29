# Clean Agile: Back to Basics

敏捷整洁知道 : 回归本源

---

## Snippets

推荐序二

> 当管理者介绍敏捷时, 只强调了敏捷可以让软件成本更低, 交付更快, 质量更高, 但没有强调它需要严格的几率, 这种纪律纪要约束雇员, 也要约束老板.

敏捷宣言第五句

> Craftmanship over Crap
>
> 匠心雕琢高于瞎写垃圾

### 第一章 介绍敏捷

[敏捷宣言](https://agilemanifesto.org)

- **个体和互动** 高于 ~~流程和工具~~
- **可用的软件** 高于 ~~详尽的文档~~
- **客户合作** 高于 ~~合同谈判~~
- **响应变化** 高于 ~~遵循计划~~

> **Manifesto for Agile Software Development**
>
> We are uncovering better ways of developing
> software by doing it and helping others do it.
> Through this work we have come to value:
>
> - **Individuals and interactions** over ~~processes and tools~~
> - **Working software** over ~~comprehensive documentation~~
> - **Customer collaboration** over ~~contract negotiation~~
> - **Responding to change** over ~~following a plan~~
>
> That is, while there is value in the items on
> the right, we value the items on the left more.

（项目管理的）铁十字

> 质量 (好)、速度 (快)、成本 (低)、完成, 你只能任选 3 个, 没法 4 个全要.
>
> 可以要求高质量、快速、低成本, 这样的话项目就做不完.
> 也可以要求低成本、快速地完成项目.

_icehe：感觉 ByteDance 选择放弃 "成本(低)" ，选择高质量、快速地完成项目。"成本高" 的 "成本" 指的是 "人力成本"_

更好的方式

> 瀑布这个想法最大的问题在于 : 它听上去特别有道理. 我们首先分析问题, 然后设计解决方案, 接着按照设计实现.
>
> 简单、直接、明显，但却是错的.

幻想与管理

> **戳破幻想是敏捷的主要目的之一. 我们实践敏捷, 正是为了在幻想杀死项目之前, 先把幻想摧毁.**
>
> _幻想是项目的杀手. 幻想促使软件团队误导管理人员, 使管理人员无法了解实际进展._ **有人认为 "敏捷" 就等于 "快". 不是的, 它从来就与 "快" 无关. "敏捷" 就是要帮助我们尽早了解我们到底做得有多糟糕.** _我们想尽早知道这一点的原因是我们可以管理这种情况._
>
> _你看, "管理" 是管理者的工作. 管理者通过收集数据来管理软件项目, 然后根据这些数据做出最佳决策. 敏捷产生数据, 产生大量的数据. 管理者们使用这些数据来推动项目达到尽可能好的结果._
>
> "尽可能好的结果" 往往不是最初期望的结果, 它可能会使当初委托该项目的利益相关者感到非常失望. 但是, 按照字面意思, "尽可能好的结果" 就是他们所能获得的最好结果.

### 第二章 敏捷的理由

稳定的生产率

> 随着时间的推移, 混乱开始在代码中积累. 如果代码没有保持干净和有序, 就阻碍团队前行. 杂乱代码越多, 阻碍越大, 进展越慢. 团队进展越慢, 项目日程压力就更大, 这养着带来更多的混乱. 这个正反馈循环可以使团队趋于停滞.

_icehe：例如一个人没多久就会 "跳槽" 离开，那么就容易开始得过且过地工作，将就生产杂乱的代码，糊弄式地完成任务……_

> 更糟糕的事, 存量代码是更强大的 "导师" ( 对于新人来说 ) . 新员工将学习旧代码并推测该团队的工作方式, 并继续进行哪些智造杂乱的实践. 因此, 尽管增加了新员工, 但生产率仍继续下降.

划算的适应性

> 软件 software 是一个组合词. "软" soft 的意思是容易修改, "件" ware 的意思是产品. 因此, "软件" software 就是 "容易修改的产品" . 我们之所以发明软件, 就是想要一种快速而且简单的方式来改变机器的行为. 如果希望它的行为很难被改变, 那可能我们就把它起名为 "硬件" hardware 了.
>
> 开发团队经常抱怨需求变更. 我经常能听到类似说法 : "这个需求变更完全不符合我们的架构." 我有一些事情要告诉你, 小伙子 : 如果需求变更破坏了你的软件架构, 那说明你的架构太糟糕了.
>
> 我们开发人员应该歌颂需求变更, 因为这才是我们存在的原因. 软件开发这个游戏的名字就叫 "需求变更". 有了这些变更, 我们的事业和薪水全拜变更所赐. 接受和实现变更, 让变更成本相对划算, 这种能力使我们的工作之本.

_icehe：基本同意. 需求变更实属正常, 实际工作中, 俺更多抱怨的是——管理者过分压缩工期，然后不得不加班……_

无畏之力

> 为什么大部分的软件系统不会随着时间的推移而变好? 是因为恐惧, 更具体地说, 因为害怕改变.
>
> 想象你正在电脑屏幕前看着一些旧代码. 你的第一个念头是 : "这段代码写得太差劲了, 我应该清理一下." 但是下一个念头是 : "我不想碰它!" 因为你知道, 如果碰了这段代码, 你会把软件搞坏, 然后这段代码就变成了你的代码. 所以你退缩了, 尽管清理代码有可能对旧代码有所改善.

_icehe：如果我改动的代码出了 bug, 那就是我的锅了, 谁也不想做吃力不讨好的事情. 特别是觉得自己在这个公司/团队不会长待的时候, 新代码也不会尽心尽力地写好, 更别说把坏代码改好了…_

你需要说 "不"

> 尽管努力去寻找问题的解决方案十分重要, 但是在找不到方案的时候, 我期望你能够直接说 "不". 你需要意识到, **相比编码的能力, 你被聘用的原因更多是说 "不" 的能力.** 你, 作为一个程序员, 知道某件事情是否可能. …… 无论你面临多大的日程压力, 无论多少经理强烈要求结果, 当答案确实是 "不" 的时候, 我期望你能够说出 "不".

_icehe：标粗的这句话恐怕会产生一些争议. 不过我觉得作者想强调的是开发者心里要有 "B数", 明白一件事/需求/方案是否可行. 当然这个判断力来之不易, 需要技术人持续不断的学习, 以拓宽技术视野, 也要达到一定的技术深度._

客户权利详讨

> "客户有权制订总体计划, 并且知道完成的时间和成本."
>
> ……
>
> 计划要尽可能地确切和精准这句话经常让我们陷入麻烦, 因为能够做到既确切又精准的唯一方法就是实际去开发这个项目. 什么都没干是不可能做到既确切又精准的. 因此, 要想保证客户的这项权利, 程序员必须确保计划、估算以及日程都恰当地描述了不确定程度, 并且要定义出减少不确定性的手段.
>
> **简单来说, 我们无法同意在固定时间期限内交付固定的项目范围. 要么范围, 要么日期, 必须有一个是弹性的.** 我们利用概率曲线来表示这种弹性. 例如, 我们估算在截止日期前完成前 10 个故事的概率是 95% , 额外多完成 5 个故事的概率是 50% , 再多完成 5 个故事的概率是 5% .

开发人员权利详讨

> "开发人员有权保持高质量的工作输出"
>
> 这可能是所有权利中嘴强的一个. 开发人员有权做好工作. **业务人员无权要求开发人员走捷径或降低质量. 或者换句话说, 业务部门无权强迫开发人员破坏自己的职业声誉或者违反职业道德.**

_icehe：这个真的很不容易, 要是哪里允许, 那里就是技术人的 "理想乡". 业务/产品/运营优先的地方, 你不得不满足 "能用就行, 赶紧上线" 的要求._

> "开发人员有权决定是否承接某种职责, 而不接受指派."
>
> 专业人士承接工作, 而非被指派工作. 专业开发人员有权针对某个具体工作或任务说 "不" . 拒绝任务可能是因为开发人员对自己完成任务的能力没有信息, 或者他们认为该任务更适合其他人, 又或者有个人或到的方面的原因.
>
> ( 想想大众汽车公司的开发人员, 他们 "接受" 了在加州欺骗 EPA 试验台的任务 ( 识别汽车是否处于被检测状态，继而调控所排放的尾气 )

_icehe：在一般公司里这么干, 恐怕会被解雇…_

### 第三章 业务实践

三元分析

> 一种非常适合用于大型任务的技术是 **三元估算**. 这种估算由 3 个数组成, 这 3 个数分别对应 最佳情况、正常情况和最坏情况.
>
> 这些都是对信心的估计 : 最差情况是指你有 95% 的信心认为能完成该任务的时间, 正常情况仅具有 50% 的信心, 最佳情况仅具有 5% 的信心.
>
> _例如, 我有 95% 的把我在 3 周内完成该任务, 50% 的抱我在 2 周内完成, 5% 的把握在 1 周内完成._

故事

> 用户故事是软件功能的简单描述, 以备将来查阅. **写故事时尽量不要记录太多细节, 因为我们知道这些细节很有可能会改变**. 细节随后还是会被记录下来, 不过是以 **验收测试** 的形式
>
> 故事遵循一组简单的指导原则, 这组原则的首字母缩写是 **INVEST**.
>
> - **I : Independent 独立.** 用户故事之间互相独立. 这意味着在实现它们时不必遵循特定的顺序. _例如登录不是必须在退出之前实现._
> - **N : Negotiable 可协商.** 这是我们不在卡片上写下所有细节的另一个原因 : 我们希望开发人员和业务人员之间可以就这些细节进行协商.
> - **V : Valuable 有价值.** 用户故事必须对业务具有明确且可量化的价值.
>     - **重构永远不可能是故事. 架构设计永远不可能是故事. 代码清理也永远不可能是故事. 故事永远是有业务价值的东西.** _不用担心, 我们会处理重构、架构设计和代码清理的事情, 但不会以故事的形式._
> - **E : Estimable 可估算.** 用户故事必须足够具体, 以允许开发人员进行估算.
>     - 诸如 "系统必须快" 之类 的故事是无法估算的, 因为它没完没了 : 性能要求是所有故事背后都必须实现的需求.
> - **S : Samll 小.** 用户故事不应大于一到两个开发人员可以在一个迭代中实现的工作量.
>     - 不希望这个团队整个迭代就做一个故事. 一个迭代包含的故事数量应该与团队中开发人员的数量大致相当 : 如果团队有 8 个开发人员, 则每个迭代应包含大约 6 到 12 个故事.
> - **T : Testable 可测试.** 业务部门应该能够提出用户故事的测试标准, 通过这些测试就能表明用户故事已经完成.

对迭代进行管理

> **QA 与验收测试**
>
> "完成" 的定义就是 : 验收测试通过.
>
> **我们追求的不是速度快, 而是要取得具体、可度量的进展**, 要取得可靠的数据.

速率

> 迭代的最后一步是更新速率图和燃尽图. …… 经过几次迭代后, 这两张图都将开始呈现出一条斜线. 燃尽斜线可以用于预测下一个主要里程碑的日期, 速率斜线则告诉我们团队管理得如何.
>
> ……
>
> 我们期望在最初的几个迭代之后, 速率斜线的斜率将变成零, 也就是速率斜线主键趋向水平. **长期来看, 我们不希望团队加速或放缓.**
>
> **速率上升**
>
> 如果我们看到速率斜线呈现正的斜率, 未必表示团队正在更快地前进也可能是因为项目经理正在向团队施加压力, 要求其加快开发速度. 随着压力的增加, 团队会在不知道不觉中改变估算值, 使得项目从数据上开起来前进得更快.
>
> 这就是简单的通过膨胀. 故事点就是一种货币, 团队正在外部压力下令其贬值. 明年你再回来看看这个团队, 他们每次迭代恐怕能完成数百万故事点. 这里的教训是, 速率是 "度量" 而不是 "目标". 这是控制论基础 : 不要给度量对象施加压力.
>
> 在 IPM 中估计迭代的容量只是为了让利益相关者的值可能完成多少故事, 这有助于利益相关者选择故事和做计划. _但这个估计值不是承诺, 即使实际速率较低, 团队也并非失败._

### 第四章 团队实践

隐喻

> "隐喻" 的概念是这样的 : 为了有效地进行沟通, 团队需要一个受限制的、有纪律的词汇表, 其中包含项目中的术语及概念. 肯特·贝克之所以称其为隐喻, 是因为它能将项目与团队具备的共同知识关联到一起.

领域驱动设计

> 统一语言 Ubiquitous Language 一词, 才是 "隐喻" 实践该有的名字

可持续节奏

> 20 世纪 70 年代初期, 我年仅 18 岁, 和高中伙伴一起, 受聘为某个 "极度重要的" 项目的程序员. 我们的 "经理" 设定了 "截止日期" . 截止日期是 "绝对不能变" 的. 我们的努力"很重要" ! 如果说组织是台机器的话, 我们就是其中的关键齿轮. 我们很重要
>
> 18 岁很美好, 不是吗?
>
> 作为刚从高中毕业的年轻人, 我们马力全开. 我们夜以继日地工作了好几个月, 每周平均工作超过 60 小时, 有几个星秀场甚至达到 80 小时以上. 我们甚至干了几十个通宵!
>
> 我们为所有的加班 "感到自豪" ! 我们是 "真正的程序员" ! 我们 "全力投入" ! 我们 "有价值" ! 因为我们一手 "拯救" 了一个重要的项目, 我们! 是! 程序员!
>
> 然后, 我们筋疲力竭 —— 太辛苦了. 辛苦到 "集体辞职" 了. 我们骤然里去, 公司只留下了一个几乎无法工作的分时系统, 没有任何有能力的程序员来支持它. "走着瞧" !
>
> 愤怒的 18 岁很美好, 不是吗?
>
> 别担心, 公司渡过了困境. 事实证明我们并不是唯一可以胜任的程序员. 哪里有一批人每周认真地工作 40 小时. 在私密的编程狂欢夜中, 我们鄙视那些既不投入又懒惰的人. 然而正是这些人悄悄地收拾好烂摊子, 并维持系统正常运行. 我敢说, 他们很高兴摆脱我们这些愤怒、吵闹的孩子.

加班

> 你可能以为我从那次经验中学到了教训. 显然, 并没有. 在接下来的 20 年中, 我继续为雇主加班工作, 也继续被 "重要项目" 诱惑. ……
>
> 随着长大并逐渐成熟, 我意识到自己最糟糕的技术错误都是在狂热熬夜时犯下的. 我意识到, 那些错误给工作造成了巨大的阻碍, 然后我在清醒时又不得不想办法绕开它们.

马拉松

> 那一刻, 我学到了软件项目是一场马拉松, 不是冲刺, 更不是一系列连续冲刺. 为了获胜, 你必须均匀配速. 如果你全速越过障碍物奔跑, 那么在抵达终点之前就将耗尽力气.
>
> 因此, **你的奔跑步伐必须能长时间维持. 你必须以 "可持续节奏" 来奔跑. 如果尝试以超过自己可持续的速度奔跑, 那么就必须减速和休息才能到达终点, 这样一来, 你的平均速度将慢于 "可持续节奏". 当接近终点线时, 如果还剩有能量, 你可以冲刺. 但是在那之前不能冲刺.**
>
> **经理可能会要求你比配速跑得再快点儿. 你一定不能遵从这样的想法. 你有义务节约自己的资源以确保坚持到最后.**

_icehe：长久的职业生涯和日常生活也是一样的吧? 需要张弛有度, 保证坚持到 "人生" 最后._

奉献精神

> **加班工作并不能向雇主展现你的风险精神. 这只能表明你的计划做的糟糕, 你答应了不该答应的截止日期, 承诺了不该承诺的事情, 你只是一个可被操纵的劳工而非专业人士.**

_icehe：不想再被 "价值观" PUA 了._

> 这并不是说所有的加班都是坏事, 也不是说永远都不要加班. 某些情况下的确只能加班, 但它们不应该成为常态. 而且你必须非常 "清醒地意识到" **加班的成本可能远远超过省下的时间.**
>

_icehe：感受到一些经理就是觉得底下的程序员就是一堆 "码农" 而已, 分派的都是些 "搬砖" 一类简单可重复的任务, 而不是繁重的脑力劳动, 所以可以随意操纵员工完成任务. 虽然他们可能不那么说, 甚至他们的理性也不这么想, 但神奇的是他们实际上习惯性地那么做…_

- _"**加班的成本可能远远超过省下的时间.**" 没错, 不少熟练有经验的高级工程师, 被所谓的 "重要项目" 的连续不断的高强度加班逼得跳槽, 甚至宁可裸辞 ( True Story ) ._
- _就这样, 一个好不容易经过两三年招人组建的小团队, 事实上崩了 —— 一个 "重要项目" 长期损害了一些稳定团队/部门的长期利益, 以至于将其摧毁, 导致这些团队/部门从领导到基层工程师对公司离心离德._

睡觉

> **程序员最宝贵的养生之道就是充足的睡眠.** 我一天睡 7 小时就够了, 偶尔有一两天只睡 6 小时也可能承受. 再减少睡眠的话, 我的生产力就会直线下降. 充分了解你自己的身体需要多少小时的睡眠, 然后留出足够的时间, 这些时间将会加倍回报你. **我的经验法则是, 少睡 1 小时会废掉白天的 2 小时的工作时间, 少睡 2 小时会废掉 4 小时的生产力. 显然如果少睡 3 小时, 那就根本不会有任何产出.**

_icehe：不能同意更多! 早睡早起, 把最重要的事情放在早上做, 真的感觉很棒! "要事第一" 的原则, 我最近终于做到了, 希望再接再厉!_

代码集体所有

> _"代码集体所有" 并非说你不能有所专长. 随着系统复杂性的增长,专业化绝对有必要. 有些系统如此庞大, 任何个人都不可能既完整又详细地全面理解它. 但是, 即使你有所专长, 同事也必须是通才. 你既要在自己专长的领域工作, 又要与其他领域的代码打交道. 你要保持在专长领域之外工作的能力._
>
> 当团队采用 "代码集体所有" 时, 知识就会分散在团队中. 每个退队成员都能够更好地理解模块之间的界限, 以及系统的整体工作方式. 这极大地提高了团队沟通和决策的能力.
>
> 在我相对较长的职业生涯中, 我见过一些与 "代码集体所有" 背道而驰的公司. 每个程序员都独占自己的模块, 其他人不可以触碰. 这种技能严重失调的团队经常陷入互相指责和无效沟通中. 如果一个模块的作者没有来工作, 进展就会陷入停滞. 没有人敢碰别人占有的东西.

_icehe：有时负责别的服务的同事说我的接口行为有误, 我怎么找都找不着 bug; 后来只能 review 和测试提出问题的那个同事的项目代码, 才找到原因, bug 就在他那里…_

站会

> 多年来, 人们对 "每日 Scrum" ( Daily Scrum ) 或 "站会" 有很多困惑. 现在让我来消除所有的困惑.
>
> 以下内容对于站会都是成立的.
>
> - 该会议是可选的. 许多团队不开这个会也会过得挺好.
> - 不一定每天都开. 选择合理的时间间隔.
> - 即使是大型团队, 也只花 10 分钟左右.
> - 改会议遵循一个简单的议程.
>
> 基本思路是团队成员站成一圈, 并回答 3 个问题 :
>
> - 1\. **上次会议之后我做了什么?**
> - 2\. **下次会议之前我将做什么?**
> - 3\. **什么阻碍了我?**
>
> **就这么多. 不要讨论, 不要装腔作势, 不要深入解释, 不要藏着掖着或带着情绪的表达, 也不要发牢骚或八卦. 每个人都有 30 秒左右的时间来回答这 3 个问题. 然后会议结束, 大家都回去干活.** 就这样结束了. 完事了. 懂了吗?
>
> 沃德的维基页面上的 ["Stand Up Meeting"](https://en.wikipedia.org/wiki/Stand-up_meeting) 词条可能是对站会的最佳描述

- https://en.wikipedia.org/wiki/Stand-up_meeting

> A **stand-up meeting** (or simply "stand-up") is a meeting in which attendees typically participate while standing. The **discomfort of standing for long periods is intended to <u>keep the meetings short</u>**.

猪和鸡?

> _我就不在这里重复火腿与鸡蛋的故事了, 有兴趣的读者可以查一下维基百科 "The Chicken and the Pig" 词条._ 故事的中心思想是 : 只有开发人员才能在站会上讲话, 经理和其他人可以旁听, 但不应插话.
>
> 在我看来只要每个人都遵循 3 个问题的格式, 并且会议保持在大约 10 分钟, 我其实不在乎谁讲话.

- https://en.wikipedia.org/wiki/The_Chicken_and_the_Pig

### 第五章 技术实践

测试驱动开发

> _程序员是一个独特的职业. 我们制造了大量文档, 其中包含深奥的技术性神秘符号. 文档中的每个符号都必须正确, 否则就会发生非常可怕的事情. 一个符号错误可能造成财产和生命损失. 还有什么行业是这样的?_
>
> _会计. 会计师也制造了大量文档, 其中也包含深奥的技术性神秘符号. 而且文档中的每个符号都必须正确, 否则就可能造成财产甚至声明损失. 那么会计师是如何确保每个符号都正确的呢?_

复式记账

> _会计师们在 1000 年前发明了一条法则, 并将其成为 **复式记账**. 每笔交易会写入账本两次 : 在一组账户中记一笔贷项, 然后相应在另一组账户中记为结项. 这些账户最终汇总到 "收支平衡表" 文件中, 用总资产减去总负债和权益. 差额必须为零. 如果不为零, 肯定就出错了. ( 只是粗略的简化描述, 并不够准确 )_
>
> _从一开始学习会计师就被教会一笔笔地记录交易并在每一笔交易记录后立即平衡余额. 这使他们能够快速地发现错误. 他们被教会避免在两次余额检查之间记录多笔交易, 因为那样会难以定位错误. 这种做法对于正确地核算资金至关重要, 以至于它基本上在全世界都成了 "法规"._
>
> **测试驱动开发** 是程序员的 ( 跟会计 ) 相应的实践. 每个必要的行为都输入两次 : 一次作为测试, 另一次作为使测试通过的生产代码. 两次输入相辅相成, 正如负债与资产的互补. 当测试代码与生产代码一起执行时, 两次输入产生的结果为零 —— 失败的测试数量为零.

_icehe：当然用会计这种传统的变化小的行当, 这种做法比较容易做到; 但对于软件业来说, 变化太大了, 这么做 (时间) 成本比较高, 为了快速推进业务出业绩, "测试" 通常会被首先牺牲掉; 所以不具备完全放在一起比较._

TDD 三规则

> TDD 可以描述为一下 3 条简单的规则.
>
> - 先编写一个因为缺乏生产代码而失败的测试, 然后才能编写生产代码.
> - 只允许编写一个刚好失败的测试 —— 编译失败也算.
> - 只允许编写一个刚好能使当前失败测试通过的生产代码.

乐趣

> _如果你曾事后补写测试, 你就应该知道, 那不太好玩. 因为你已经知道代码可以g工作, 你已经手工测试过. 你之所以还要编写这些测试, 只是因为有人要求你必须这样做, 这你平添了很多工作量, 而且很无聊._
>
> _当你遵循三规则先写测试时, 这个过程就变得很有趣. 每个新的测试都是一次挑战, 每次让一个测试通过，你就赢得了一次小的成功. 遵循三规则, 你的工作就变成了一些小挑战和小成功. 这个过程不再无聊, 它让人有达成目标的成就感._

_icehe：得亲自实践一下才知道, 等自己适应这种做法之后的想法…_

完备性

> **警告**
>
> **测试覆盖率** 是团队的指标, 而不是管理的指标. 管理者不太可能理解这个指标的实际含义. **管理人员不应将此指标当作目标.** 团队应仅将其用于观察测试策略是否合理.
>
> **再次警告**
>
> **不要因为覆盖率不足而使构建失败.** 如果这样做, 程序员将被迫从测试中删除断言, 以达到高覆盖率. 代码覆盖是一个复杂的话题, 只有在对代码和测试有深入了解的情下才能理解. 不要让它成为管理的指标.

_icehe：这个说法真好, 技术人才足够懂技术人的想法… 真想给某个前领导看看._

勇气

_icehe：简单地说, "勇气" 指的是 TDD 能够给予修改代码的勇气._

_因为测试是完备的, 所以我们可以随时重构, 然后重新运行测试, 测试通过可以保证自己没有破坏功能 ( 绝大多数情况下 ) ._

简单设计

> 肯特·贝克的简单设计规则如下.
>
> - 1\. 所有测试通过.
> - 2\. 揭示意图.
> - 3\. 相处重复.
> - 4\. 减少元素.
>
> 序号既是执行顺序, 有时优先级.

### 第六章 成就敏捷

> **敏捷的 4 个价值观 : 勇气、沟通、反馈和简单**

勇气

> 第一个价值观是 **勇气** —— 换句话说, 就是 **在合理范围内敢于冒险**. 敏捷团队的成员并不太关注公司政治意义上的 "安全", 那会导致牺牲质量和机会. 他们意识到, 长期来看, 管理软件项目的最佳方法是具备一定程度的侵略性.
>
> **勇气和鲁葬是有区别的.** **部署最小的功能集需要勇气. 维护高质量的代码和高质量的纪律需要勇气. 但是, 部署你自己都没有信心的代码, 或者设计不具可持续性的代码, 这就是鲁莽. 通过牺牲质量来遵守时间表就是鲁莽.**
>
> **质量和纪律会提高速度, 这是一种信念, 强势但幼稚的人们在面对时间压力时会不断挑战这种信念, 因此坚持正确的信念需要勇气.**

沟通

> 我们重视直接、频繁、跨渠道的沟通. 敏捷团队成员希望彼此交谈. …… ( 略 )

反馈

> 我们所研究的各种敏捷纪律, 实际上都是为了向重大决策的制定者提供快速反馈. **计划游戏、重构、测试驱动开发、持续集成、小步发布、代码集体所有、完整团队** 等实践最大化反馈的频率和数量. 当出现问题时, 我们能够及早识别、及时纠正. _这些实践让人们看到此前决策的效果并从中学习经验教训. 敏捷团队因反馈而健壮. 反馈使团队高效工作, 而且促使项目取得有益成果._

简单

> 敏捷的下一个价值观是 **简单** —— 换句话说, 就是 **直裁了当**.
>
> **经常有人说, 软件中的每个问题都可以通过添加间接层来解决**. 但是勇气、沟通和反馈的价值观会确保问题的数量被加减到最小. 因此, 间接也可以保持在最少. 解决方案可以保持简单.
>
> 这不仅适用于软件, 同时也适用于团队. 被动攻击型行为就是不直接的表现. 如果你发现了问题但一声不叽地将问题传给了别人, 你就采取了不直接的行为. **如果你明知后果严重却仍然同意经理或客户的要求, 你就采取了不直接的行为.**
>
> 简单就是直接 —— **代码写得直截了当, 沟通和行为也直截了当**. 在代码中, 一定数量的间接访问是必要的. 间接机制可以减少相互依赖带来的复杂性. 在团队中, 几乎不需要间接. 大多数时候, 你希望尽可能直接.
>
> 保持代码简单. 保持团队更简单.

_icehe：想起有一段时间不想打搅忙碌的同事, 与他们关系也一般, 就不好意思问, 尽可能自己解决问题. 结果自己当时能力有限, 处理不好工作任务, 又不敢说, 把信任和关系都搞坏了, 陷入了恶性循环…_

转型

> 从非敏捷到敏捷的转型是一场价值观的转变. **敏捷开发的价值观包括 敢于冒险、快速反馈、热情、人与人之间跨越障碍和指挥结构的频密沟通**. 它们 **还专注于直奔目标前进, 而不是划地盘、争权夺利**. 这些价值观与大型组织的价值观截然相反, 很多大型组织重金投入的中层管理结构更重视安全性、一致性、命令与控制以及遵循计划。
>
> _是否有可能将这样的组织转型为敏捷组织? 坦率地说, 我在这方面并不是很成功, 我也没有从其他人那里看到太多成功. 我看到了大量的努力和金钱投入, 但很少看到组织真正实现了转型. 价值观结构差异太大, 以至于中层管理者很难接受._
>
> _我看到的是团队和个人的转变, 因为指导团队和个人的价值观经常与敏捷相一致._
> _识刺的是, 高管们经常也被冒险、直接、沟通等敏捷价值观所驱动. 这是他们试图转变其组织的原因之一._
>
> **障碍是位于中间的管理层. 这些人的工作就是不冒险、避免直接、以最低限度的沟通来服从和执行指挥链.** 这就是组织上的两难境地. 组织的顶层和底层都认同敏捷思维, 但中间层却反对它. 我没有见过中间层做出改变. 事实上，他们怎么可能改变呢? 他们的工作就是抵制这类改变.

耍花招

> …… 问题出在技术主管和架构师们身上. 这些人错误地推测 : 他们的角色将被削弱. ……

大型组织中的敏捷

> 大型团队怎么办? 大规模的敏捷怎么办?
>
> 多年来, 很多人试图回答这个问题. _早先, Scrum 的作者提出了所谓 "Scrum-of-Scrums" 技术. 后来, 我们开始看到打上商业品牌的方法, 如 SAFe和LeSS. 关于这个主题的几本书也相继出版._
>
> _我相信这些方法没有什么错. 我也相信这些书写得挺好. 不过, 我既没有读过这些书, 总没有尝试过这些方法._ 你可能认为我对一个没有研究过的话题发表评论是不负责任的. 也许你是对的, 不过, 我自有我的看法.
>
> **敏捷是为中小型团队服务的**, 就这样. **对于中小型团队, 敏捷很有效. 敏捷从来不是为大型团队设计的.**
>
> 为什么我们不尝试去解决大型团队的问题呢? 很简单, 因为 5000 多年来, 无数专家放力于解决大型团队的问题. 大型团队的问题是所有社会、所有文明共同的问题. 并且, 我们现在的文明来看, 这个问题我们似乎解决得不错.
>
> _怎么建造金字塔? 你需要解决大型团队的问题. 如何打赢第二次世界大战? 你需要解决大型团队的问题. 如何把人送到月球上, 并把他们安全带回地球? 你需要解决大型团队的问题._
>
> _大型团队的成就还不止这些, 对吧? 如何建立电话网、高速公路网、互联网? 如何生产 iPhone 或者制造汽车? 所有这些都和大型团队有关. 我们庞大的、海布全球文明的基地设施和国防工程, 证明我们已经解决了大型团队的问题._
>
> **大团队是一个已解决的问题。**
>
> ……
>
> 大规模的敏捷呢? **我不认为有大规模敏捷这种事.** 如何组织大型团队? 这个问题的答就是将其拆分成小团队. 敏捷解决了小型软件团队的问题: 而 "如何将多个小型团队组织成大型团队" 的问题是一个已经解决的问题. 因此, 我对 "大型敏捷" 这个问题的回答是将开发人员组织成小型敏捷团队, 然后使用标准的管理和运筹学技术来管理这些团队. 你不需要任何其他的特殊规则.
>
> _现在可以问的问题是, 既然面向小团队的软件如此独特, 以至于需要我们发明敏捷, 为什么这种独特性不适用于将小型软件团队组织成更大的软件团队呢? 软件在某些方面能特性是否不止影响小型团队, 还会影响大型团队的组织方式?_
>
> 我对此表示怀疑, 因为 **5000 多年前我们已解决的大型团队问题, 恰好是让多种不同类型的团队合作的问题. 敏捷团队只是在大型项目中需要协调的众多团队之一. 多元化团队的整合是一个已经解决的问题. 我看不出有迹象表明软件团队的独特性会过分地影响他加照合成更大型的团队.**
>
> 所以, 再说一遍, 我的观点可以简单总结成一句话 : **根本没有所谓的大规模敏捷.** 敏捷是一种必要的创新, 专门用于组织小型软件团队. 一旦组织起来, 这些团队可以融入大型组织几千年来一直使用的结构中.
>
> 再次强调, 这不是我致力研究的主题. 你刚刚读到的只是我的意见, **我可能会错得离谱. 也许我只是一个坏脾气的老头, 告诉那些玩大规模敏捷的小孩离开我的草坪, 时间会证明一切的.** 但现在你知道我看好哪条路了.

敏捷工具

> 不管他们使用的是手动工具还是电动工具, 木匠总是努力精通自己选入工具箱的每一件工具. 这种精通使他们能够专注于工艺本身 ( 例如一件高质量家具的精致造型 ) , **而不是一边工作一边操心工具**. **没有精通, 工具就成为交付的障碍, 使用不当的工具甚至会对项目及工具的使用者造成损害.**

软件工具

> 软件开发人员必须掌握一些核心工具 :
>
> - 至少一门编程语言, 通常会是多门
> - 一个集成开发环境 ( IDE ) 或者程序员使用的编辑器 ( Vim、Emacs 等 )
> - 各种数据格式 ( JSON、XML、YAML等 ) 和标记语言 ( 包括 HTML )
> - 基于命令行和脚本与操作系统进行交互
> - 源代码仓库工具 ( Git. 除此之外还有其他选项吗? )
> - 持续集成 / 持续构建工具 ( Jenkins、TeamCity、GoCD 等 )
> - 部署 / 服务器管理工具 ( Docker、Kubernetes、Ansible、Chef、Puppet等 )
> - 沟通工具 —— 电子邮件、Slack、英语
> - 测试工具 ( 单元测试框架、Cucumber、Selenium 等 )
>
> _这几类工具对于开发软件至关重要. 没有它们, 就不可能在当今世界交付任何有用的软件._ 从这个意义上说, 它们代表了程序员的 "手动工具" 箱.
>
> _这些工具大多需要努力获得相关专业知识才能有效使用. 同时, 环境在不断变化, 这使得精通工具更具挑战性._ 有经验的开发人员会找出阻力最小、价值最高的路径来串起涉及的所有工具. ……

什么才是有效的工具

> 好工具应该会让你上手时感到舒适, 而不会让你因不得不使用它而感到恐惧和恶心.

_icehe：我已经足够熟悉 Git, 当然觉得它真的足够好用了. 但当年我不懂它原理, 用起来还是觉得挺别扭的._

> 优秀的工具可以做到以下几点 :
>
> - 帮助人们实现目标
> - 可以很快学到 "足够好" 的程度
> - 对用户透明
> - 允许适配和拓展
> - 经济上负担得起

<!--

敏捷导入的成长

> …… 既然团队应该始终在产生最高价值的事项上工作 ……

_icehe：作为个人, 也应该这样! ( 要事第一 )_

-->

### 第七章 匠艺

> 敏捷席卷了整个软件行业. 但是 **就如耳旁传话游戏那样, 最初的敏捷思想被扭曲和简化, 最终到公司里变成了承诺 <u>可以更快交付软件</u> 的一个流程.** 对使用瀑布或者 RUP 的公司和管理者来说, 这无疑是动听的音乐.

敏捷的宿醉

> **战略性的技术工作在他们的敏捷流程中是没有位置的. 不需要架构或设计, 他们要求只管聚集在产品待办列表中最高优先级的事项上, 然后一个接一个尽可能快完成. 这种方式导致团队不断重复着短视的、战术性的工作, 从而积累了技术债务.** 脆弱的软件、著名的单体应用 ( 或者一些尝试微服务的团队得到的分布式单体应用 ) 比比皆是. bug 与运营问题变成了每日站会和敏捷回顾会议的热点话题. 向生产环境的发布也不如业务部门期望的那么频繁, 手动测试依然要花费好几天甚至好几周才能完成. 引入敏捷就能够避免所有这些问题的希望也破灭了. **管理者们责怪开发人员前进得不够快. 开发人员责怪管理者们不允许他们做必要的技术和战略性工作, 产品负责人不认为自己是团队的一部分, 当事情出问题时也不承担责任. 井水不犯河水的文化开始占据主导.**
>
> 我们称这种现象为敏捷的宿醉. 在敏捷转型上投入了几年时间与资源之后, 这些公司意识到 : 他们以前存在的问题如今仍然存在. 当然, 他们把责任全都推到敏捷头上.

渐行渐远

> …… 几年过去, 开发人员开始把敏捷教练当成新的一层管理者 : _这群人告诉他们该做什么, 而不是帮助他们更好地完成工作._
>
> ……
>
> **公司仍然不够成熟, 没有足够理解技术问题实际上是业务问题.**

软件匠艺

> 为了提高软件开发的水准, 并重新明确敏捷最初的目标, 一群开发人员于 2008 年 11 月聚集到芝加哥, 发起了一个新的运动 : 软件匠艺 ( Software Craftsmanship ) . 类似于 2001 年的敏捷峰会, 2008 年的会议达成了一套核心价值观, 并在《敏捷宣言》的基础上提出一个新的宣言.
>
> > 作为有理想的软件工匠, 我们一直身体力行提升专业软件开发的标准, 并帮助他人学习此技艺. 通过这些工作, 我们建立了如下价值观 :
> >
> >     - 不仅要让软件工作起来, 更要精雕细琢
> >     - 不仅要响应变化, 更要稳步增加价值
> >     - 不仅要有个体与交互, 更要形成专业人员的社区
> >     - 不仅要与客户合作，更要建立卓有成效的伙伴关系.
> >
> > 在追求左项的过程中, 我们发现右项是不可成缺的.
>
> 软件匠艺宣言描述了一种思想体系、一种观念. 它强调从几个角度来提升职业水准.
>
> "精雕细琢" 意味着代码经过精心设计和完整测试, 同时兼顾灵活性和健壮性. 我们不害怕修改这样的代码, 这样的代码能允许业务快速做出反应.
>
> "稳步增加价值" 意味着不论我们做什么, 都应始终致力于不断为客户和雇主增加价值.
>
> "形成专业人员的社区" 意味着我们期望彼此共享和学习, 从而提高我们行业的水平. 我们有责任培养好下一代开发人员.
>
> "建立卓有成效的伙伴关系" 意味着我们将与客户和雇主建立专业的关系. 我们将始终秉承职业道德和以尊重的态度行事, 以最佳方式为客户和雇主提供建议并与他们合作. 我们期望相互尊重和职业化的关系, 为此我们愿意采取主动, 并以身作则.
>
> 我们不再把工作看作上班打卡而己, 而是提供专业服务. 我们将掌控自己的职业生涯, 投入自己的时间和金钱来改善自己的工作. 这些不仅是专业价值观, 也是个人价值观. 匠人们努力做到最好, 不是因为有人支付工资, 而是基于把事情做好的渴望.

_icehe : 有一个自己热爱的职业不容易, 进入热爱的企业/部门, 有一个好领导, 分到有意思的任务, 都不容易…_

聚焦于价值而非实践

> 单纯地拒绝实践却不提供更好的替代方案, 这才是唯一不能被接受的.

_icehe : 在想混日子的时候, 确实不想增加任何工作量去思考怎样做得更好, 而是短期内尽快完成工作._

## 读者跋

icehe : 有冲动想用 "敏捷" 的方式来管理个人生活. 不过欲速则不达, 就一步步优化自己的生活. 2020-09-20
