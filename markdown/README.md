# Markdown Style

> 推荐参考，但并非强制执行的 Markdown 风格标准！

## 建议 Suggestions

> **Readability > Writability** : 易阅读 > 易编写

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

### 其它 Others

> 一行内容不要太长

to be continue …

## Tools

推荐使用

### VS Code & Plugins

[VS Code](https://code.visualstudio.com/)

- 「markdownlint」插件
- 「Mardown Preview Enhanced」插件
    - 免费，Markdown 效果预览，自动检测错误

### Mardown Lint

Markdown Lint Tool `mdl`

- [GitHub](https://github.com/markdownlint/markdownlint)
- [Rules](https://github.com/markdownlint/markdownlint/blob/master/docs/RULES.md)
- [Create styles](https://github.com/markdownlint/markdownlint/blob/master/docs/creating_styles.md)

当前规则

- 由 markdown/lint/style.rb 文件声明，详情如下

[mdl styles](../markdown/lint/style.rb ':include :type=code properties')

推荐通过 form 项目 CI 的 `mdl`（markdownlint）检查后，才允许合并 MR

### Remark Lint

[remark-lint](https://github.com/remarkjs/remark-lint)

- 错误输出比 markdownlint 可读性更好

## Refs

### GFM

[GitLab Flavored Markdown](https://docs.gitlab.com/ee/user/markdown.html#details-and-summary)

- 了解 GitLab 原生支持的 Markdown 语法

### Style Guide

Markdown Style：**Readability > Writability**

- [Markdown Style Guide](http://www.cirosantilli.com/markdown-style-guide/)
- [Google](https://github.com/google/styleguide/tree/gh-pages/docguide)
    - [Philosophy](https://github.com/google/styleguide/blob/gh-pages/docguide/philosophy.md)
    - [Sytle Guide](https://github.com/google/styleguide/blob/gh-pages/docguide/style.md)
    - [Best Practices](https://github.com/google/styleguide/blob/gh-pages/docguide/best_practices.md)

### 中文排版

- [写给大家看的中文排版指南](https://zhuanlan.zhihu.com/p/20506092)
- [中文文案排版指南](https://github.com/mzlogin/chinese-copywriting-guidelines)
