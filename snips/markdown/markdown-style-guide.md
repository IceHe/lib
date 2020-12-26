# Markdown Style Guide

Markdown 风格指北

---

- Here is the Markdown style I follow.
- It's not a mandatory standard.

---

- [ ] Escape newlines
- [ ] Nest codeblocks within lists
- [ ] Use informative Markdown link titles
- [ ] Prefer lists to tables
- [ ] Strongly prefer Markdown to HTML

Documentation Best Practices

- [ ] Minimum viable documentation
- [ ] Delete dead documentation
- [ ] Prefer the good over the perfect

## References

<!-- 参考资料 -->

### Markdown Specification

<!-- Markdown 标准 -->

_All skippable to read_

- Daring Fireball - Projects - Markdown
    - [Main](https://daringfireball.net/projects/markdown) , [Basics](https://daringfireball.net/projects/markdown/basics) , [Syntax](https://daringfireball.net/projects/markdown/syntax) , [Dingus](https://daringfireball.net/projects/markdown/dingus)
- [CommonMark Spec](https://spec.commonmark.org)
    - [Version 0.29](https://spec.commonmark.org/0.29) on 2019-04-06
- [GitHub Flavored Markdown Spec](https://github.github.com/gfm)

### GFM Basic Syntax

<!-- GitHub 或 GitLab 风格的 Markdown 基础语法 -->

_You should know_

( GFM - GitHub or GitLab Flavored Markdown )

- [Mastering Markdown - GitHub Guide](https://guides.github.com/features/mastering-markdown) <sup>_concise_</sup>
- [Basic writing and formatting syntax](https://docs.github.com/en/free-pro-team@latest/github/writing-on-github/basic-writing-and-formatting-syntax)
- [Working with advanced formatting](https://docs.github.com/en/free-pro-team@latest/github/writing-on-github/working-with-advanced-formatting)
    - Organizing information with tables
    - Creating and highlighting code blocks
    - Autolinked references and URLs
- [GitLab Flavored Markdown](https://docs.gitlab.com/ee/user/markdown.html#details-and-summary)

### Style Guide

<!-- Markdown 风格指南 -->

_All recommended to read!_

- [Markdown Style Guide](http://www.cirosantilli.com/markdown-style-guide)
- [Google documentation guide](https://github.com/google/styleguide/tree/gh-pages/docguide)
    - [Markdown style guide](https://github.com/google/styleguide/blob/gh-pages/docguide/style.md)
    - [Documentation Best Practices](https://github.com/google/styleguide/blob/gh-pages/docguide/best_practices.md)
    - [README.md files](https://github.com/google/styleguide/blob/gh-pages/docguide/READMEs.md) - a simple example
    - [Philosophy](https://github.com/google/styleguide/blob/gh-pages/docguide/philosophy.md)

### Chinese Text Layout

<!-- Markdown 中文排版 -->

_All recommended to read!_

- [写给大家看的中文排版指南](https://zhuanlan.zhihu.com/p/20506092)
- [中文文案排版指南](https://github.com/mzlogin/chinese-copywriting-guidelines)

## Suggestions

<!-- 建议 -->

- Highly recommend to read the links in section "References → Style Guide" above.
    - _I made my Markdown style guide below according to them._
    - _You can make your own guide as well._

### Design Goals

<!-- 设计目标 -->

- **Readable** ( icehe : clean and tidy )
- _Easy to write and modify later_
- _Diff friendly_
- _Easy to remember and implement on editors_
- _Provide rationale behind difficult choices_

_Many design choices come down to:_

- _do you want to write fast ( writability )_
- _or do you want people to read fast ( readability )_

**Guideline : Readability > Writability**

<!-- 易阅读 > 易编写 -->

### General Rules

#### File

> File Extention : **Use `.md`**

_Rationale : Why not .mkd or .markdown?_

- _Shorter_
- _More popular_
- _Does not have important conflicts_

> File Name : **Prefer to base the file name on the top-header level**
>
> - Replace upper case letters with **lower case**
> - Strip articles the, a, an from the start
> - **Replace punctuation and white space characters by hyphens**
> - _Replace consecutive hyphens by a single hyphen_
> - _Strip surrounding hyphens_

_Good_

```bash
file-name.md
```

_Bad, multiple consecutive hyphens_

```bash
file-name.md
```

_Bad, surrounding hyphens_

```bash
-file-name-.md
```

_Rationale : why not underscore or camel case?_

- Hyphens are the most popular URL separator today,
- _and markdown files are most often used in contexts where:_
    - _There are hyphen separated HTML files in the same project, possibly the same directory as the markdown files._
    - _Filenames will be used directly on URLs. E.g.: GitHub blobs._

#### Whitespaces

<!-- 空白 -->

##### New Lines

<!-- 新行 -->

> - **Don't use 2 or more consecutive empty lines**,
>     - _that is, more than two consecutive newline characters, except where they must appear literally such as in code blocks._
> - ~~End files with a newline character, and don't leave empty lines at the end of the file.~~
> - **Don't use trailing whitespace** _unless it has a function such as indicating a line break._

_Good_

```markdown
- list
- list

## Header
```

_Good, code block_

```markdown
The markup language X requires you to use triple newlines to separate paragraphs:

    p1


    p2
```

_Bad_

```markdown
- list
- list


# Header
```

_Rationale : multiple empty lines occupy more vertical screen space, and do not significantly improve readability._

##### Spaces after sentences

<!-- 句子之后的空格数量 -->

> **Use a single space after sentences.**

_Bad, 2 spaces_

```bash
First sentence.  Second sentence.
```

_Good_

```bash
First sentence. Second sentence.
```

_Rationale : advantages over `space-sentence:2` :_

- _Easier to edit_
- _Usually not necessary if you use `wrap:inner-sentence` or `wrap:sentence`_
- _`space-sentence:2` gives a false sense of readability as it is ignored on the HTML output_
- _More popular_

_Advantages of `space-sentence:2` :_

- _Easier to see where sentences end_

#### Line wrapping

<!-- 折行 -->

> **Wrap Inner-Sentence**

_Try to keep lines under 80 characters by breaking large paragraphs logically at points such as :_

- _Sentences : after a period `.`, question `?` or exclamation mark `!`_
- _[Clauses](https://www.lexico.com/grammar/clauses) : after words like `and`, `which`, `if ... then`, commas `,`_
- _Large [phrases](https://www.lexico.com/grammar/phrases)_

_Good_

```markdown
This is a very very very very very very very very very very very very very long not wrapped sentence.
Second sentence of of the paragraph,
third sentence of a paragraph
and the fourth one.
```

_Rationale :_

- _Diffs look better,_
    - _since a change to a clause shows up as a single diff line._
- _Occasional visual wrapping does not significantly reduce the readability of Markdown,_
    - _since the only language feature that can be indented to indicate hierarchy are nested lists._
- _At some point GitHub translated single newlines to line breaks in READMEs, and still does so on comments._
    - _Currently there is no major engine which does it, so it is safe to use newlines._
- _Some tools are not well adapted for long lines,_
    - _e.g. Vim and `git diff` will not wrap lines by default._
    - _This can be configured however via `git config --global core.pager 'less -r'` for Git and `set wrap` for Vim._

_Downsides :_

- _Requires considerable writer effort,_
    - _specially when modifying code._
- _Markdown does not look like the rendered output,_
    - _in which there are no line breaks._
- _Manual line breaking can make the Markdown more readable than the rendered output,_
    - _which is bad because it gives a false sense of readability encouraging less readable long paragraphs._
- _Requires users of programming text editors like Vim,_
    - _which are usually configured to not wrap, to toggle visual wrapping on._
    - _This can be automated, but [EditorConfig gave it WONTFIX](https://github.com/editorconfig/editorconfig/issues/168)_
- _Breaks some email systems, which always break a line on a single newline._

_Other alternates :_

- ~~Don't wrap lines.~~
    - _Rationale : very easy to edit._
    - _But diffs on huge lines are hard to read._
- ~~Always wrap at the end of the first word that exceeds 80 characters.~~
    - _Rationale : source code becomes is very readable and text editors support it automatically._
    - _But diffs will look bad, and changing lines will be hard._
- ~~Wrap Sentence~~
    - _Rationale: similar advantages as `wrap:inner-sentence`,_
        - _but easier for people to follow since the rule is simple : break after the period._
    - _But may produce long lines with hard to read diffs._
    - _Notable occurrence: [ProGit 2](https://raw.githubusercontent.com/progit/progit2/5c285553c0605342339284981a9bb8a6c4e7c18e/book/01-introduction/1-introduction.asc)._

#### Code

##### Dollar Signs in Shell Code

<!-- Shell 代码中的美元符 `$` -->

> **Don't prefix shell code with dollar signs `$` unless you will be showing the command output on the same code block.**

If the goal is to clarify what the language is, do it on the preceding paragraph.

_Rationale : harder to copy paste, noisier to read._

_Good_

```bash
echo a
echo a > file
```

_Bad_

```bash
$ echo a
$ echo a > file
```

_Good, shows output_

```bash
$ echo a
a
$ echo a > file
```

_Good, language specified on preceding paragraph_

```markdown
Use the following Bash code:

echo a
echo a > file
```

##### What to Mark as Code

<!-- 如何标识代码 -->

> **Use code blocks or inline code for :**
>
> - **Executables**. _E.g.:_
>     ```markdown
>     `gcc` is the best compiler available.
>     ```
>     - Differentiate between tool and the name of related projects. _E.g.: `gcc` vs GCC._
> - **File paths**
> - **Version numbers**
> - **Capitalized explanation of abbreviations** :
>     ```markdown
>     xinetd stands for `eXtended Internet daemon`
>     ```
> - **Other terms related to computers** that you don't want to add to your dictionary
>
> **Don't mark as code :**
>
> - **Names of projects**. _E.g.: GCC_
> - **Names of libraries**. _E.g.: libc, glibc_

##### Spelling and Grammar

<!-- 拼写与语法 -->

> **Use correct spelling and grammar.**

Prefer writing in English, and in particular American English.

_Rationale : American English speakers have the largest GDP, specially in the computing industry._

_Use markup like URL or code on words which you do not want to add to your dictionary so that spell checkers can ignore them automatically._

Beware of case sensitive spelling errors, in particular for project, brand names or abbreviations :

- _Good : URL, LinkedIn, DoS attack_
- _Bad : url, Linkedin, dos attack_
- _When in doubt, prefer the same abbreviation as used on Wikipedia._

Avoid informal contractions :

- _Good : biography, repository, directory_
- _Bad : bio, repo, dir_

### Block elements

<!-- 块元素 -->

#### Line breaks

<!-- 换行符 -->

> **Avoid line breaks**, as they don't have generally accepted semantic meaning.

In the rare case you absolutely need them, end a lines with exactly two spaces.

#### Header

<!-- 标题 -->

##### Header Syntax

<!-- 标题的语法 -->

> Use ATX-style headers

_Bad_

```bash
Header 1
========

Header 2
--------

### Header 3
```

_Good_

```bash
# Header 1

## Header 2

### Header 3
```

_Rationale :_

- _Advantages of Setex :_
    - _more visible. Not very important if you have syntax highlighting._
- _ATX advantages over Setex :_
    - _Easier to write because in Setex you have to match the number of characters in both lines for it to look good_
    - _Works for all levels, while Setex only goes up to level 2_
    - _Occupy only one screen line, while Setex occupies 2_

> Include a single space between the `#` and the text of the header.

_Good_

```markdown
# Header
```

_Bad_

```markdown
#Header

#  Header
```

> Don't use the closing `#` character.

_Bad_

```markdown
# Header #
```

> Don't add spaces before the number sign `#`.

_Bad_

```markdown
 # Header
```

> **Don't skip header levels.**

_Bad_

```markdown
# Header 1

### Header 3
```

_Good_

```markdown
# Header 1

## Header 2
```

> **Surround headers by a single empty line except at the beginning of the file.**

_Bad_

```markdown
Before 1.
# Header 1

Before 2.
## Header 2
After 2.
```

_Good_

```markdown
# Header 1

After 1.

## Header 2

After 2.
```

> **Avoid using two headers with the same content in the same markdown file.**

_Rationale : many markdown engines generate IDs for headers based on the header content._

_Bad_

```markdown
## Dogs

### Anatomy

## Cats

### Anatomy
```

_Good_

```markdown
## Dogs

### Anatomy of the dog

## Cats

### Anatomy of the cat
```

##### Top-Level Header

<!-- 一级标题 -->

> **Exactly one top-level header in a markdown file.**

_Bad_

```markdown
# Dogs

# Cats
```

_Good_

```markdown
# Animal

## Dogs

## Cats
```

_If you target HTML output, write your documents so that it will have one and only one `h1` element as the first thing in it that serves as the title of the document. This is the HTML top-level header._

_How this `h1` is produced may vary depending on your exact technology stack: some stacks may generate it from metadata, for example Jekyll through the front-matter._

_Storing the top-level header as metadata has the advantage that it can be reused elsewhere more easily, e.g. on a global index, but the downside of lower portability._

_If your target stack does not generate the top-level header in another way, include it in your markdown file. E.g., GitHub._

_Top-level headers on index-like files such as `README.md` or `index.md` should serve as a title for their parent directory._

_Downsides of top-level headers :_

- Take up one header level.
    - This means that there are only 5 header levels left, _and each new header will have one extra `#`, which looks worse and is harder to write._
- _Duplicate filename information,_
    - _which most often can already be seen on a URL._
    - _In most cases, the filename can be trivially converted to a top-level, e.g.: `some-filename.md` to `Some filename`._

_Advantages of top-level headers :_

- _More readable than URL's, especially for non-technically inclined users._

##### Header Case

<!-- 标题的大小写 -->

> **Use an upper case letter as the first letter of a header**, unless it is a word that always starts with lowercase letters, _e.g. computer code._

_Good_

```markdown
# Header
```

_Good, **computer code that always starts with lower case**_

```markdown
# int main
```

_Bad_

```markdown
# header
```

> ~~The other letters have the same case they would have in the middle of a sentence.~~
>
> _According to the Chicago Manual of Style (15th edition), **the following rules should be applied to headers** :_
>
> - **Always capitalize the first and last words of titles and subtitles.**
> - **Always capitalize "major" words** (nouns, pronouns, verbs, adjectives, adverbs, and some conjunctions).
> - **Lowercase the conjunctions and, but, for, or, and nor**.
> - **Lowercase the articles the, a, and an**.
> - **Lowercase prepositions, regardless of length**,
>     - except when they are stressed, are used adverbially or adjectivally, or are used as conjunctions.
> - **Lowercase the words to and as**.
> - Lowercase the second part of Latin species names.

_~~Good~~ Bad_

```markdown
# The header of the example
```

_~~Bad~~ Good_

```markdown
# The Header of the Example
```

_As an exception, [title case](https://en.wikipedia.org/wiki/Title_case#Title_case) may be optionally used for the top-level header._

- _( icehe : I prefer "Chicago Manual of Style" to "AP Stylebook". )_
- _Use this exception sparingly ( 保守地 ) , in cases where typographical ( 排字上的 ) perfection is important, e.g.: `README` of a project._

_Rationale : why not Title case for all headers?_

- _It requires too much effort to decide if edge-case words should be upper case or not._

##### End of a Header

<!-- 标题的后面 -->

> Indicate the end of a header's content that is not followed by a new header by an horizontal rule.

```markdown
# Header

Content

---

Outside header.
```

##### Header Length

<!-- 标题长度 -->

> Keep headers as short as possible.
>
> Instead of using a huge sentence, make the header a summary to the huge sentence, and write the huge sentence as the first paragraph beneath the header.

_Rationale : if automatic IDs are generated by the implementation, it is:_

- _Easier to refer to the header later while editing_
- _Less likely that the IDs will break due to rephrasing_
- _Easier to distinguish between different IDs_

_Good_

```markdown
# Huge header

Huge header that talks about a complex subject.

---

Content
```

_Bad_

```markdown
# Huge header that talks about a complex subject

Content
```

##### Punctuation at the End of Headers

<!-- 标题末尾的标点符号 -->

> Don't add a trailing colon `:` to headers.

_Rationale : every header is an introduction to what is about to come next, which is exactly the function of the colon._

> Don't add a trailing period `.` to headers.

_Rationale : every header consists of a single short sentence, so there is not need to add a sentence separator to it._

_Good_

```markdown
# How to do make omelet
```

_Bad_

```markdown
# How to do make omelet:
```

_Bad_

```markdown
# How to do make omelet.
```

##### _Header Synonyms_

<!-- 多个同义的标题 -->

> Headers serve as an index for users searching for keywords.

_For this reason, you may want to give multiple keyword possibilities for a given header._

_To do so, simply create a synonym header with empty content just before its main header._

_E.g.:_

```markdown
# Purchase

# Buy

You give money and get something in return.
```

_Every empty header with the same level as the following one is assumed to be a synonym. This is not the case if levels are different:_

```markdown
# Animals

## Dog
```

#### Blockquotes

<!-- 引用块 -->

> **Follow the greater than marker `>` by one space.**

_Good_

```markdown
> a
```

_Bad_

```markdown
>a
```

_Bad, 2 spaces_

```markdown
>  a
```

> **Use a greater than sign `>` for every line, including wrapped.**

_Bad_

```markdown
> Long line
that was wrapped.
Good:
```

_Good_

```markdown
> Long line
> that was wrapped.
```

> **Don't use empty lines inside a single block quote.**

_Good_

```markdown
> a
>
> b
```

_Bad_

```markdown
> a

> b
```

#### Lists

<!-- 列表 -->

##### Marker

###### Unordered

<!-- 无序列表  -->

> **Use the hyphen marker `-`.**

_Good_

```markdown
- a
- b
```

_Bad_

```markdown
* a
* b
+ a
+ b
```

_Rationale :_

- Asterisk `*` can be confused with bold or italic markers.
- _Plus sign `+` is not popular_

_Downsides :_

- _`*` and `+` are more visible._
- _`*` is more visible_

###### Ordered

<!-- 有序列表 -->

> ~~Prefer lists only with the marker `1.` for ordered lists, unless you intend to refer to items by their number in the same markdown file or externally.~~
>
> **Prefer lists with the marker `1.`, `2.`, `3.` and etc. for ordered lists.**
>
> **Prefer unordered lists unless you intent to refer to items by their number.**

_Best, we will never refer to the items of this list by their number_

```markdown
- a
- c
- b
```

_~~Better~~ Bad, only `1.`_

```markdown
1. a
1. c
1. b
```

_~~Worse, we will never refer to the items of this list by their number~~_

```markdown
1. a
2. c
3. b
```

Acceptable, refer to them in the text:

The output of the `ls` command is of the form:

```markdown
    drwx------  2 ciro ciro        4096 Jul  5  2013 dir0
    drwx------  4 ciro ciro        4096 Apr 27 08:00 dir1
    1           2

Where:

1. permissions
2. number of files directory contains
```

Acceptable, meant to be referred by number from outside of the markdown file:

```markdown
Terms of use.

1. I will not do anything illegal.
2. I will not do anything that can harm the website.
```

Rationale:

- If you want to change a list item in the middle of the list, you don’t have to modify all items that follow it.
- Diffs will show only the significant line which was modified.
- Content stays aligned without extra effort if the numbers reach 2 digits. E.g.: the following is not aligned:
    ```markdown
    9. a
    10. b
    ```
- References break when a new list item is added. To reduce this problem :
    - Keep references close to the list so authors are less likely to forget to update them
    - When referring from an external document, always refer to an specific version of the markdown file

### TOC

TOC - Table Of Contents

**尽量添加目录到文档**

- Available
    - GitLab : https://docs.gitlab.com/ee/user/markdown.html#table-of-contents
- Unavailable
    - GitHub
    - docsify _( 本网站 icehe.xyz 的 Markdown 内容依赖它来渲染 )_
- 如果使用, 标准是 :
    - https://cirosantilli.com/markdown-style-guide/#reference-style-links

### Heading

**使用 ATX Header**

**一级标题 `#` 必须位于文件第一行**

- 即是一级标题前面不留空行, 也不添加其它内容

**必须按照准确级别顺序使用 `#` 标题**

- 例如：上一个标题是一级标题 `#` , 下一个应严格使用二级标题 `##` 而非三级标题  `###`

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

**使用空行分隔内容**

- 标题与标题之间留空行
- 标题与内容之间留空行
- 文件最后必须有且仅有一个空行

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

**代码块使用 <code>\`\`\`</code> 语法围闭, 并标明代码类型**

- 以一行 <code>\`\`\`[code_type]</code> 开始围闭, 例如 <code>\`\`\`bash</code>
- 以一行 <code>\`\`\`</code> 结束围闭
    - code_type 包括但不限于 bash / properties / json / java 等（自行了解和尝试）

小段代码使用 <code>\`code\`</code> 语法围闭即可

正确示例的效果如下

- 代码块

    ```bash
    echo 'hello world'
    ```

- 小段代码
    - 列出目录内容 `ls`

### 列表 List

**推荐使用 `-` 而非 `*` 输入列表**

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

**不混用「编号列表」和「顺序列表」, 建议只使用「无序列表」**

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

**尽量减少缩进**

- 能不用列表符 `-` 就能表达清楚层级结构的情况, 就别用 `-`
- 列表的层次最好控制在 2 层以内, 最多 3 层

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

基于简单原则：尽量少地格式化, 去表达同样的意思

**不使用 `<link>` 语法来写 URL , 直接写即可**

- GitHub 和 GitLab 等常用的 Markdown 语法渲染引擎基本都支持直接写 URL

```markdown
https://icehe.xyz
```

不推荐的做法

```markdown
<https://icehe.xyz>
```

**如果 URL 链接不是太长, 而且自身能准确表达其网页内容, 就不要使用 `[link](url)` 语法了**

```markdown
My image : https://hub.docker.com/r/icehe/alpine
```

不推荐的做法

```markdown
My image : [icehe/alpine](https://hub.docker.com/r/icehe/alpine) @ hub.docker.com
```

两种做法的效果

- `[link](url)` 语法：为链接添加标题, 并隐去链接本体, 如下
    - My image : [icehe/alpine](https://hub.docker.com/r/icehe/alpine) @ hub.docker.com
- 不如直接使用链接本体
    - My image : https://hub.docker.com/r/icehe/alpine

### 脚注 Footnotes

**尽量不使用**

- Available
    - GitLab : https://docs.gitlab.com/ee/user/markdown.html#footnotes
- Unavailable
    - GitHub
    - docsify _( 本网站 icehe.xyz 的 Markdown 内容依赖它来渲染 )_
- 如果使用, 标准是 :
    - https://cirosantilli.com/markdown-style-guide/#reference-style-links

### 表情 Emoji

**尽量不支持**

- Available
    - GitLab : https://docs.gitlab.com/ee/user/markdown.html#footnotes
    - Visual Studio Code : Markdown Preview Enhanced
- Unavailable
    - GitHub
    - docsify _( 本网站 icehe.xyz 的 Markdown 内容依赖它来渲染 )_
- 如果使用, 标准是 :
    - https://cirosantilli.com/markdown-style-guide/#reference-style-links

### 其它 Others

**一行内容不要太长**

短句方便阅读.

**文档撰写方面, 对 "必须 / 应该 / 建议" 的字眼的使用, 请参考 RFC 2119**

- https://www.ietf.org/rfc/rfc2119.txt

## Tools

<!-- 推荐使用 -->

Highly recommended to use

### VS Code & Plugins

[VS Code](https://code.visualstudio.com)

- 「[markdownlint](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint)」插件
- 「[Mardown Preview Enhanced](https://shd101wyy.github.io/markdown-preview-enhanced/#/zh-cn)」插件
    - 免费, Markdown 效果预览, 自动检测错误

### Mardown Lint

Markdown Lint Tool `mdl`

- [GitHub](https://github.com/markdownlint/markdownlint)
- [Rules](https://github.com/markdownlint/markdownlint/blob/master/docs/RULES.md)
- [Create styles](https://github.com/markdownlint/markdownlint/blob/master/docs/creating_styles.md)

当前规则

- 由 markdown/lint/style.rb 文件声明, 详情如下

[mdl styles](./lint/style.rb ':include :type=code properties')

推荐通过 form 项目 CI 的 `mdl`（markdownlint）检查后, 才允许合并 MR

### Remark Lint

[remark-lint](https://github.com/remarkjs/remark-lint)

- 错误输出比 markdownlint 可读性更好

### Other Lints

Asked on Stack Exchange: http://softwarerecs.stackexchange.com/questions/7138/markdown-lint-tool

- https://github.com/wooorm/mdast-lint
- https://github.com/mivok/markdownlint
- https://github.com/slang800/tidy-markdown
- https://github.com/DavidAnson/markdownlint
    - Documentation has some links back to this style: https://github.com/DavidAnson/markdownlint/blob/v0.14.2/doc/Rules.md
