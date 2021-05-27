# Welcome

好记性不如烂博客.

---

## What is my Lib?

[IceHe's Lib](https://icehe.xyz)

### Notebook

- 保存 个人笔记 的 Git 代码仓库 ( note repo )
- 或者说是 个人的维基百科 ( personal [Wiki](https://en.wikipedia.org/wiki/Wiki) )

### Blog

- 虽然从内容的组织方式上看并非通常意义上的 [Blog](https://en.wikipedia.org/wiki/Blog) —— 主要按照发布时间倒序排列展示
- 但我将这里视为自己新的的个人博客网站, 是对写博客习惯的一种延续

### Naming

- 比起 Notebook / Blog / Wiki 这些词, 个人更喜欢用 [Library](https://en.wikipedia.org/wiki/Library) 形容这里, 像是只属于自己的图书馆
- 然后 Lib 是 Library 的缩写, 更简洁有力, 更有 coder 的 style

## Why I Build?

### Note-taking

- 记录自己 "技术" 上的所学所做 —— **学习的知识 / 具体的实践**
- 记录自己 "生活" 上的所见所闻 / 所思所想, 还有所作所为 —— **见闻 / 想法 / 作为**

### Sharing

- 放在开放的互联网上, 最便于分享知识 —— 无论是给同事 / 朋友, 还是萍水相逢的访客

### Self-presentation

- 让别人看见自己 : 那一点一滴积累知识的过程以及收获, 还有曾经的快乐 / 失落与挣扎

### Self-disciplline

- 让懒惰又无能的自己尽量多做点积累

> Remember, misery is comfortable. It's why so many people prefer it. Happiness takes effort.
>
> 记住: 痛苦是会让人感到舒坦的。许多人选择拥抱痛苦, 是因为, 幸福是需要努力的。

## How to Build?

### Steps

1.  New git repository

    [GitHub](https://github.com) / [GitLab](https://gitlab.com)

2.  Write content

    以 [Markdown](https://en.wikipedia.org/wiki/Markdown) 格式为主, 辅以必要的图片和外链 ( [hyperlink](https://en.wikipedia.org/wiki/Hyperlink) ) 等

    - 尽可能以纯文本格式来描述和保存 —— 兼容性好, 易迁移, 易处理
    - GitHub / GitLab 以及常用的文本编辑器对 Markdown 内容的渲染和浏览都有着很不错的支持
        - GitLab 甚至支持在 Markdown 文件中对 [PlantUML](http://plantuml.com/) 代码块进行 UML 图渲染 ( 后来不默认支持了 )
        - 参考 [Github Flavored Markdown](https://github.github.com/gfm/)

3.  Arrange content

    具体方式可以参考本 Lib 的仓库
    - https://github.com/IceHe/lib
    - https://gitlab.com/IceHe/lib

4.  Deploy website

    基于代码仓库的原始内容, 使用 [docsify](https://docsify.js.org/) 构建出 [SPA](https://en.wikipedia.org/wiki/Single-page_application) 式的个人网站
    - 可以参考我的 [docsify](/_docsify/how-to-docsify.md) 建站参考文档

---

其实直接用 GitHub / GitLab 的代码仓库页面作为 "技术博客" 也是没问题的。不过个人更喜欢:

- 拥有一个有独立域名的个人网站 ( 例如 [icehe.xyz](https://icehe.xyz) | [icehe.me](https://icehe.me) )
- 使用 docsify 负责对内容进行渲染展示, 效果很不错！
    - 边栏能够根据文章的各级标题生成并显示 "目录" ( TOC : Table Of Content ) ！
    - 安装简单, 基本功能足够强大, 其添加和使用都很便捷, 还几乎没有副作用
        - 通常情况下, docsify 只需向代码仓库中添加少数几个文件即可生效
            - 最少只需添加一个 index.html 文件 (本站做了不少自定义的改造, 所以添加了较多文件)
        - 而且 docsify 无需做额外的适配工作, 承载内容的 markdown 文件就能得到恰到好处的展现
    - 还可以通过添加插件, 或者自己动手改写, 定制更多的功能
        - 例如: 站内搜索, 不同类型代码的语法高亮, UML 图的绘制, 数学公式的渲染……
        - 详情参考 [docsify 官网](https://docsify.js.org/), 或自行谷歌

## Trade-off

取舍 : 舍弃了什么, 得到了什么？

### Replace Evernote

使用 GitHub 和 GitLab 等代码仓库, 来替代印象笔记 / 有道云笔记等笔记类软件

缺点 :

- 移动端 (手机) 难以编辑 Lib 的内容
    - 移动端暂时没有便捷的方法直接对 GitHub / GitLab 代码仓库的内容进行修改和提交
    - 只能先使用 Notes (iOS) 等其他软件做笔记, 然后在 Mac 上操作将其转移到 Lib 上

优点 :

- 免费
- 通用 : 纯文本保存 —— 简单, 易编辑, 易处理, 易迁移, 兼容性好, 很自由！
    - 富文本的格式, 依赖具体软件的处理效果, 可能会乱码 / 格式错乱, 泛用性不佳

例如, 如果直接使用 "有道云笔记" 的 "导出" 功能导出文件, 其内容是经过私有方法加密过的格式, 难以便捷地导入 / 迁移到印象笔记等其他的平台 (吃相难看) , 也难以用一般文本的方式进行保存 / 编辑 / 查看

### No SEO

不为了改善搜索引擎对本网站的收录效果, 而特地对它进行 [SEO](https://en.wikipedia.org/wiki/Search_engine_optimization)

- 缺点: 网站内容难以被搜索引擎收录, 因而难以从搜索引擎中获得访客
    - 本来 [SPA](https://en.wikipedia.org/wiki/Single-page_application) 形式的网站 SEO 效果就不好
    - 个人站点也不可能像在 "博客园 / CSDN / 知乎专栏" 发文章那样相对容易获得曝光和推荐
- 优点: 更专心于学习和写作

我的想法

- 自己写的文章还很拙劣, 还没好到值得广泛分享
- 技术水平也不行, 还需要长久的积累, 我还没到值得介意知名度 / 传播效果的阶段

### No Site-Statistics & Analysis

没有接入任何网站统计与分析服务 (百度 & 谷歌等)

- 缺点: 无法获取 UV / PV, 访客特点 (地域 / 频率)
- 优点: 减少访问网站所需加载的资源, 加快访问速度
    - 特别是需要加载境外的网络资源时

这个是影响搜索引擎收录 (SEO) 的重要因素, 但正如上文所述, 个人暂时无意改变现状

### No Comments

没有添加评论模块, 访客无法评论

- 缺点: 访客与作者之间, 以及访客与访客之间, 难以便捷地沟通
    - 其实您可以直接去本网站的 Git Repo 的 Issues 那留言交流
- 优点: 减少访问网站所需加载的资源, 加快访问速度

我的想法

- 根据以往的经验, 评论的量不多, 真需要沟通联系的话, 访客发邮件就好
- 而且现在我并不在意评论的有无或数量多寡

## Requirements

### Pragmatism

实用主义 : 只记录有用的内容

- 经常碰到的问题, 经常用到的工具
- 用到的情况很少, 但是很重要 (能救命)

### Useful in Long Run

不记录时效太短的内容

- 例如, 不足一两年就有翻天覆地变化的软件技术

尽量记录原理 / 方法论 / 经验 / 思路, 不拘泥于过于具体的细节

- 例如, 重要的是安装 OS 的要点和原因, 而不在于过于具体的步骤

### Difficult to Search

不记录很容易获取到的 问题答案

- 例如, 一搜索就能轻易从前两三个链接中找到简单答案的内容

记录难以直接获取到的 问题答案

- 就算能被搜索到, 也得是不好筛选出的关键参考信息
- 例如, 需要经过认真思考, 多次改进关键字进行搜索后, 才能综合得出的答案

### Don't Repeat

不要对找到的内容进行简单的粘贴复制

- 而是要在自己读懂理解后, 进行实践验证
- 再按照自己的思维习惯, 重新组织, 然后编写, 并附上实例, 以及个人问题和想法
- 否则, 只摘录重点, 然后加上原文链接即可
