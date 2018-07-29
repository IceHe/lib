title: 编写可读代码的艺术 - Note
---

# __Chapter 1__

## 准确的单词表达

    下面是一些例子，这些单词更有表现力，可能适合你的语境：

    单词 / 更多选择 send /
    deliver、dispatch、announce、distribute、route

    find /
    search、extract、locate、recover

    start /
    launch、create、begin、open

    make /
    create、set up、build、generate、compose、add、new

## 用具体的名字代替抽象的名字

    在这种情况下，使用更精确的名字可能会有帮助。
    如果不把循环索引命名为（i、j、k），
    另一个选择可以是（club_i、members_i、user_i）
    或者，更简化一点（ci、mi、ui）。

    这种方式会帮助把代码中的缺陷变得更明显：
    `if (clubs[ci].members[ui] == users[mi])`
    缺陷！第一个字母不匹配。

    如果用得正确，索引的第一个字母应该与数据的第一个字符匹配：
    `if (clubs[ci].members[mi] == users[ui])`
    OK。首字母匹配。

    `DISALLOW_EVIL_CONSTRUCTORS` 这个名字并不是很好。
    对于“邪恶”这个词的使用包含了对于一个有争议话题过于强烈的立场。
    更重要的是，这个宏到底禁止了什么这一点是不清楚的。
    它禁止了`operator=()`方法，但这个方法甚至根本就不是构造函数！
    这个名字使用了几年，但最终换成了一个不那么嚣张而且更具体的名字：
    `#define DISALLOW_COPY_AND_ASSIGN(ClassName) ...`

## 让计量单位明确

``` cpp
var start = (new Date()).getTime(); // top of the page
...
var elapsed = (new Date()).getTime() - start; // bottom of the page
document.writeln("Load time was: " + elapsed + " seconds");
```

    这段代码里没有明显的错误，但它不能正常运行，
    因为getTime()会返回毫秒而非秒。
    通过给变量结尾追加_ms，我们可以让所有的地方更明确：

``` cpp
var start_ms = (new Date()).getTime(); // top of the page
...
var elapsed_ms = (new Date()).getTime() - start_ms; // bottom of the page
document.writeln("Load time w
```

    函数参数 / 带单位的参数
    Start(int delay)
    delay → delay_secs
    CreateCache(int size)
    size → size_mb
    ThrottleDownload(float limit)
    limit → max_kbps
    Rotate(float angle)
    angle → degrees_cw

    让代码隐含的前提显而易见

    下表给出更多需要给名字附加上额外信息的例子：
    情形 / 量名 / 更好的名字
    一个“纯文本”格式的密码，需要加密后才能进一步使用
    password
    plaintext_password
    一条用户提供的注释，需要转义之后才能用于显示
    comment
    unescaped_comment
    已转化为UTF-8格式的html字节
    html
    html_utf8
    以“url方式编码”的输入数据
    data
    data_urlenc

    在小的作用域里可以使用短的名字
    当你去短期度假时，你带的行李通常会比长假少。
    同样，“作用域”小的标识符（对于多少行其他代码可见）也不用带上太多信息。
    也就是说，因为所有的信息（变量的类型、它的初值、如何析构等）都很容易看到，所以可以用很短的名字。

``` cpp
if (debug) {
 map<string,int> m;
 LookUpNamesNumbers(&m);
 Print(m);
}
```

    尽管m这个名字并没有包含很多信息，但这不是个问题。因为读者已经有了需要理解这段代码的所有信息。

    变量名太长，通过现代编辑器的自动补全功能，
    即可简单解决，让起长名没有了借口。

## 第一章小结

- 使用专业的单词——例如，不用Get，而用Fetch或者Download可能会更好，这由上下文决定。
- 避免空泛的名字，像tmp和retval，除非使用它们有特殊的理由。
- 使用具体的名字来更细致地描述事物——Server Can Start()这个名字就比CanListenOnPort更不清楚。
- 给变量名带上重要的细节——例如，在值为毫秒的变量后面加上_ms，或者在还需要转义的，未处理的变量前面加上raw_。
- 为作用域大的名字采用更长的名字——不要用让人费解的一个或两个字母的名字来命名在几屏之间都可见的变量。对于只存在于几行之间的变量用短一点的名字更好。
- 有目的地使用大小写、下划线等——例如，你可以在类成员和局部变量后面加上"_"来区分它们。

# __Chapter 2__

- 关键思想：要多问自己几遍：“这个名字会被别人解读成其他的含义吗？”要仔细审视这个名字。
- 推荐用min和max来表示（包含）极限
    建议：命名极限最清楚的方式是在要限制的东西前加上max_或者min_。
- 推荐用first和last来表示包含的范围
- 推荐用begin和end来表示包含/排除范围

## 布尔变量

    下面是个危险的例子：
    bool read_password = true;
    这会有两种截然不同的解释：
    我们需要读取密码。
    已经读取了密码。
    在本例中，最好避免用“read”这个词，用need_password或者user_is_authenticated这样的名字来代替。
    通常来讲，加上像is、has、can或should这样的词，可以把布尔值变得更明确。
    最好避免使用反义名字。例如，不要用：
    `bool disable_ssl = false;`
    而更简单易读（而且更紧凑）的表示方式是：
    `bool use_ssl = true;`

    getMean()的实现是要遍历所有经过的数据并同时计算中值。如果有大量的数据的话，这样的一步可能会有很大的代价！但一个容易轻信的程序员可能会随意地调用getMean()，还以为这是个没什么代价的调用。
    相反，这个方法应当重命名为像computeMean()这样的名字，后者听起来更像是有些代价的操作。（另一种做法是，用新的实现方法使它真的成为一个轻量级的操作。）

    下面是一个来自C++标准库中的例子。曾经有个很难发现的缺陷，使得我们的一台服务器慢得像蜗牛在爬，就是下面的代码造成的：

``` cpp
void ShrinkList(list<Node>& list, int max_size) {
    while (list.size() > max_size) {
        FreeNode(list.back());
        list.pop_back();
    }
}
```

    这里的“缺陷”是，作者不知道list.size()是一个O(n)操作——它要一个节点一个节点地历数列表，而不是只返回一个事先算好的个数，这就使得ShrinkList()成了一个O(n2)操作。

    假使size()的名字是countSize()或者countElements()，很可能就会避免相同的错误。C++标准库的作者可能是希望把它命名为size()以和所有其他的容器一致，就像vector和map。但是正因为他们的这个选择使得程序员很容易误把它当成一个快速的操作，就像其他的容器一样。

    将代码按照逻辑分块排序，使其清晰

    代码风格的一致性，比其风格正确性重要得多！
    宁可遵守，不要随便打破。

## 第二章小结

- 如果多个代码块做相似的事情，尝试让它们有同样的剪影。（让相似、同类的代码，看起来也相似！很有先见性的指导。例如将所有变量拥有相同的缩进之类的事，是有价值的。）

- 把代码按“列”对齐可以让代码更容易浏览。

- 如果在一段代码中提到A、B和C，那么不要在另一段中说B、C和A。选择一个有意义的顺序，并始终用这样的顺序。

- 用空行来把大块代码分成逻辑上的“段落”。</Node>))
