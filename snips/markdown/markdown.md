# Markdown Style Guide

> Markdown 风格指南

个人遵循的 Markdown 风格, 并非强制的标准

## References

### GFM

了解 GitLab 和 GitHub 原生支持的 Markdown 语法

- [GitLab Flavored Markdown](https://docs.gitlab.com/ee/user/markdown.html#details-and-summary)
- [GitHub Flavored Markdown Spec](https://github.github.com/gfm)
    - [Mastering Markdown - GitHub Guide](https://guides.github.com/features/mastering-markdown)

### Style Guide

> Highly recommend you to read these files below!

Markdown Style：**Readability > Writability**

- Markdown Style Guide : http://www.cirosantilli.com/markdown-style-guide
- Google Doc : https://github.com/google/styleguide/tree/gh-pages/docguide
    - Philosophy : https://github.com/google/styleguide/blob/gh-pages/docguide/philosophy.md
    - Sytle Guide : https://github.com/google/styleguide/blob/gh-pages/docguide/style.md
    - Best Practices : https://github.com/google/styleguide/blob/gh-pages/docguide/best_practices.md

### 中文排版

- [写给大家看的中文排版指南](https://zhuanlan.zhihu.com/p/20506092)
- [中文文案排版指南](https://github.com/mzlogin/chinese-copywriting-guidelines)

## 建议 Suggestions

**Readability > Writability** : 易阅读 > 易编写

### 标题 Heading

> 一级标题 `#` 必须位于文件第一行

- 即是一级标题前面不留空行，也不添加其它内容

> 必须按照准确级别顺序使用 `#` 标题

- 例如：上一个标题是一级标题 `#` ，下一个应严格使用二级标题 `##` 而非三级标题  `###`

正确示例

```markdown
# 一级标题

## 二级标题

正文内容

```

错误示例

```markdown

## 二级标题

#### 四级标题

正文内容
```

### 空行 Blank Line

> 使用空行分隔内容
>
> - 标题与标题之间留空行
> - 标题与内容之间留空行
> - 文件最后必须有且仅有一个空行

正确示例

```markdown
# 一级标题

## 二级标题

正文内容

```

错误示例

```markdown
# 一级标题
## 二级标题
正文内容
```

### 代码 Code

> 代码块使用 <code>\`\`\`</code> 语法围闭，并标明代码类型
>
> - 以一行 <code>\`\`\`[code_type]</code> 开始围闭，例如 <code>\`\`\`bash</code>
> - 以一行 <code>\`\`\`</code> 结束围闭
>     - code_type 包括但不限于 bash / properties / json / java 等（自行了解和尝试）
>
> 小段代码使用 <code>\`code\`</code> 语法围闭即可

正确示例的效果如下

- 代码块

    ```bash
    echo 'hello world'
    ```

- 小段代码
    - 列出目录内容 `ls`

### 列表 List

> 推荐使用 `-` 而非 `*` 输入列表

推荐的做法

```markdown
- item 1
- item 2
- item 3
```

不推荐的做法

```markdown
* item 1
* item 2
+ item 3
```

> 不混用「编号列表」和「顺序列表」，建议只使用「无序列表」

- 因为并非所有 Markdown 渲染引擎都支持

正确示例

```markdown
- item a
    - item aa
- item b
    - item bb
    - item bc
        - item cat
```

不推荐的做法

```markdown
1. item a
    1.1. item aa
2. item b
    2.1. item bb
    2.2. item bc
        - item cat
```

错误示例

```markdown
- 1. item a
    - item a
- 1. item b
    - 1. item bb
    - 2. item bc
        - item cat
```

### 缩进 Indent

> 尽量减少缩进
>
> - 能不用列表符 `-` 就能表达清楚层级结构的情况，就别用 `-`
> - 列表的层次最好控制在 2 层以内，最多 3 层

```markdown
计划

- 确认需求
    - 需求文档
    - 工作排期
- 开发
    - 编写代码
    - 代码审查
- 测试
    - 单元测试
    - 集成测试
    - 回归测试
- 上线
    - 预览上线
    - 正式上线
```

不推荐的做法

```markdown
- 计划
    - 确认需求
        - 需求文档
        - 工作排期
    - 开发
        - 编写代码
        - 代码审查
    - 测试
        - 单元测试
        - 集成测试
        - 回归测试
    - 上线
        - 预览上线
            - 预览测试
        - 正式上线
```

### 链接 Link

基于简单原则：尽量少地格式化，去表达同样的意思

> 不使用 `<link>` 语法来写 URL ，直接写即可

- GitHub 和 GitLab 等常用的 Markdown 语法渲染引擎基本都支持直接写 URL

```markdown
https://icehe.xyz
```

不推荐的做法

```markdown
<https://icehe.xyz>
```

> 如果 URL 链接不是太长，而且自身能准确表达其网页内容，就不要使用 `[link](url)` 语法了

```markdown
My image : https://hub.docker.com/r/icehe/alpine
```

不推荐的做法

```markdown
My image : [icehe/alpine](https://hub.docker.com/r/icehe/alpine) @ hub.docker.com
```

两种做法的效果

- `[link](url)` 语法：为链接添加标题，并隐去链接本体，如下
    - My image : [icehe/alpine](https://hub.docker.com/r/icehe/alpine) @ hub.docker.com
- 不如直接使用链接本体
    - My image : https://hub.docker.com/r/icehe/alpine

### 脚注 Footnotes

> 尽量不使用

- Available
    - GitLab : https://docs.gitlab.com/ee/user/markdown.html#footnotes
- Unavailable
    - GitHub
    - docsify _( 本网站 icehe.xyz 的 Markdown 内容依赖它来渲染 )_
- 如果使用, 标准是 :
    - https://cirosantilli.com/markdown-style-guide/#reference-style-links

### 其它 Others

> 一行内容不要太长

短句方便阅读.

> 文档撰写方面, 对 "必须 / 应该 / 建议" 的字眼的使用, 请参考 RFC 2119

- https://www.ietf.org/rfc/rfc2119.txt

## Tools

推荐使用

### VS Code & Plugins

[VS Code](https://code.visualstudio.com/)

- 「[markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint)」插件
- 「[Mardown Preview Enhanced](https://shd101wyy.github.io/markdown-preview-enhanced/#/zh-cn/)」插件
    - 免费，Markdown 效果预览，自动检测错误

### Mardown Lint

Markdown Lint Tool `mdl`

- [GitHub](https://github.com/markdownlint/markdownlint)
- [Rules](https://github.com/markdownlint/markdownlint/blob/master/docs/RULES.md)
- [Create styles](https://github.com/markdownlint/markdownlint/blob/master/docs/creating_styles.md)

当前规则

- 由 markdown/lint/style.rb 文件声明，详情如下

[mdl styles](./lint/style.rb ':include :type=code properties')

推荐通过 form 项目 CI 的 `mdl`（markdownlint）检查后，才允许合并 MR

### Remark Lint

[remark-lint](https://github.com/remarkjs/remark-lint)

- 错误输出比 markdownlint 可读性更好
