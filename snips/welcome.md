# Welcome (draft)

> 一件事要想清楚为什么而做？然后是怎么去做？不忘初心，方得始终（不至于南辕北辙）。

## What is my Lib?

我的「[IceHe's Lib](https://icehe.xyz)」是什么？

### "Notebook"

“笔记本”

- 电子化的「笔记仓库」( note repo ) —— 是相对于纸质笔记本和笔的概念；
- 或者说是「个人的维基百科」( personal [Wiki](https://en.wikipedia.org/wiki/Wiki) ) 。

### "Blog"

“博客”

- 虽然从内容的组织方式上看并非通常意义上的 [Blog](https://en.wikipedia.org/wiki/Blog) —— 按照发布时间倒序排列；
- 但是我个人把这里视作是自己过去博客网站的继承，是对写博客习惯的一种延续。

### Naming

命名

- 比起 Notebook、Blog、Wiki 这些词，个人更喜欢用 [Library](https://en.wikipedia.org/wiki/Library) 来形容这里，像是「只属于自己的图书馆」！~
- 所以这里被命名为 Lib。

## Why I Build?

我为什么要创建 Lib？

### Note-taking

记笔记

- 记录自己「技术」上的所学所做 —— **学习的知识、具体的实践**
- 记录自己「生活」上的所见所闻、所思所想，还有所作所为 —— **见闻、想法、作为**

### Sharing

分享

- 放在开放的互联网上，最便于分享知识 —— 无论是给同事、朋友，还是萍水相逢的访客。

### Self-presentation

自我展示

- 让别人看见自己：那一点一滴积累知识的过程与收获，还有曾经的快乐、失落与挣扎……
- 激励懒惰又无能的自己「更进一步」，不要再重蹈覆辙、松懈停歇。

> - Remember, misery is comfortable. It's why so many people prefer it. Happiness takes effort.
> - 记住：痛苦是会让人感到舒坦的。许多人选择拥抱痛苦，是因为，幸福是需要努力的。

## How to Build?

> 我如何创建 Lib？

### Steps

1\. 创建代码仓库

- [GitHub](https://github.com) / [GitLab](https://gitlab.com)

2\. 编写内容

- 以 [Markdown](https://en.wikipedia.org/wiki/Markdown) 格式为主，辅以必要的图片和外链 ( [hyperlink](https://en.wikipedia.org/wiki/Hyperlink) ) 等
    - 尽可能以纯文本格式来描述和保存 —— 兼容性好，易迁移，易处理
    - GitHub、GitLab 以及常用的文本编辑器对 Markdown 内容的渲染和浏览都有着很不错的支持
        - GitLab 甚至支持在 Markdown 文件中对 PlantUML 代码块进行 UML 图渲染
        - 参考 [Github Flavored Markdown](https://github.github.com/gfm/)

3\. 组织内容

- 具体方式可以参考本 Lib 的仓库
    - https://github.com/IceHe/lib
    - https://gitlab.com/IceHe/lib

4\. 搭建网站

- 基于代码仓库的原始内容，使用 [docsify](https://docsify.js.org/) 构建出 [SPA](https://en.wikipedia.org/wiki/Single-page_application) 式的个人网站
    - 可以参考个人编写的 [docsify](/_docsify/README.md) 建站参考文档

---

其实直接用 GitHub / GitLab 的代码仓库页面作为「技术博客」也是没问题的。不过个人更喜欢：

- 拥有一个有独立域名的个人网站（例如 [icehe.xyz](https://icehe.xyz) | [icehe.me](https://icehe.me) ）。
- 使用 docsify 负责对内容进行渲染展示，效果很不错！
    - 边栏能够根据文章的各级标题生成并显示「目录」( TOC : Table Of Content ) ！
    - 安装简单，基本功能足够强大，其添加和使用都很便捷，还几乎没有副作用。
        - 通常情况下，docsify 只需向代码仓库中添加少数几个文件即可生效；
            - 最少只需添加一个 index.html 文件（本站做了不少自定义的改造，所以添加了较多文件）
        - 而且还无需为了适配 docsify 对承载内容的 markdown 文件进行额外的修改。
    - 还可以通过添加插件，或者自己动手改写，定制更多的功能
        - 例如：站内搜索，不同类型代码的语法高亮，UML 图的绘制，数学公式的渲染……
        - 详情参考 [docsify 官网](https://docsify.js.org/)，或自行谷歌。

## Trade-off

取舍：舍弃了什么，得到了什么

### Replace Evernote

使用 GitHub 和 GitLab 等代码仓库，来替代印象笔记、有道云笔记等笔记类软件

**Disadvantages** 缺点

- 移动端（手机）难以编辑 Lib 的内容。
    - 移动端暂时没有便捷的方法直接对 GitHub / GitLab 代码仓库的内容进行修改和提交；
    - 只能先使用 Notes（iOS）等其他软件做笔记，过后再在 Mac 上操作将其转移到 Lib 上。

**Advantages** 优点

- 免费
- 通用：纯文本保存 —— 简单，易编辑，易处理，易迁移，兼容性好，很自由！
    - 富文本的格式，依赖具体软件的处理效果，可能会乱码、格式错乱，泛用性不佳。

例如，如果直接使用「有道云笔记」的「导出」功能导出文件，其内容是经过私有方法加密过的格式，难以便捷地导入、迁移到印象笔记等其他的平台（吃相难看），也难以用一般文本的方式进行保存、编辑、查看。

### No SEO

**Disadvantages** 缺点

- 难以推广：SPA 的 SEO 效果不佳
        - 因为本博客的内容大多数是中文的，主要面对中文访客
            - 也没有兴趣让谷歌收录（虽然它对收录比较好）
            - 影响访问速度
        - 难以被搜索引擎收录，特别是百度

### No Comments

没有添加评论模块，访客无法评论。

- 缺点：访客与作者之间，以及访客与访客之间，难以便捷地沟通。
- 优点：减少访问网站所需加载的资源，加快访问速度。

我的想法

- 根据以往的经验，评论的量不多，真需要沟通联系的话，访客发邮件就好。
- 而且我并不在意评论

### No Site-Statistics & Analysis

没有任何网站统计与分析（百度 & 谷歌等）

- 缺点：无法获取 UV / PV，访客特点（地域、频率）
- 优点：减少访问网站所需加载的资源，加快访问速度
    - 特别是需要加载境外网站的资源时

## Targets

<!-- ## Standards -->

目标：先明确目标

收录标准
