# Markdown Style Guide

Markdown 风格指北

---

Here is the Markdown style guide I follow.
It's not a mandatory standard.

## References

<!-- 参考资料 -->

### Markdown Specification

<!-- Markdown 标准 -->

_All skippable to read_

-   Daring Fireball - Projects - Markdown

    [Main](https://daringfireball.net/projects/markdown) , [Basics](https://daringfireball.net/projects/markdown/basics) , [Syntax](https://daringfireball.net/projects/markdown/syntax) , [Dingus](https://daringfireball.net/projects/markdown/dingus)

-   [CommonMark Spec](https://spec.commonmark.org)

    [Version 0.29](https://spec.commonmark.org/0.29) on 2019-04-06

-   [GitHub Flavored Markdown Spec](https://github.github.com/gfm)

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

Highly recommend to read the links in section "References → Style Guide" above.

_I made my Markdown style guide below according to them._
_You can make your own guide as well._

### Design Goals

<!-- 设计目标 -->

- **Readable** _( icehe: clean and tidy )_
- _Easy to write and modify later_
- _Diff friendly_
- _Easy to remember and implement on editors ( icehe : not easy )_
- **Provide rationale behind difficult choices**

_Many design choices come down to:_

- _do you want to write fast ( writability )_
- _or do you want people to read fast ( readability )_

**Guideline: Readability > Writability**

<!-- 易阅读 > 易编写 -->

### General Rules

#### File

> **File Extention: Use `.md`**

_Rationale: Why not .mkd or .markdown?_

- _Shorter_
- _More popular_
- _Does not have important conflicts_

> **File Name: Prefer to base the file name on the top-header level**
>
> - **Replace upper case letters with <u>lower case</u>**
> - **Strip articles the, a, an from the start**
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

_Rationale: why not underscore or camel case?_

-   _Hyphens are the most popular URL separator today,_
    _and markdown files are most often used in contexts where:_

    -   _There are hyphen separated HTML files in the same project,_
        _possibly the same directory as the markdown files._

    -   _Filenames will be used directly on URLs._
        _E.g.: GitHub blobs._

#### Whitespaces

<!-- 空白 -->

##### New Lines

<!-- 新行 -->

> -   **Don't use 2 or more consecutive empty lines**,
>
>     _that is, more than two consecutive newline characters,_
>     _except where they must appear literally such as in code blocks._
>
> -   ~~End files with a newline character,~~
>     _and don't leave empty lines at the end of the file.~~
>
> -   **Don't use trailing whitespace**
>     _unless it has a function such as indicating a line break._

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


## Header
```

_Rationale: multiple empty lines occupy more vertical screen space,_
_and do not significantly improve readability._

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

_Rationale: advantages over `space-sentence:2`:_

-   _Easier to edit_
-   _Usually not necessary if you use_
    _`wrap:inner-sentence` or `wrap:sentence`_
-   _`space-sentence:2` gives a false sense of readability_
    _as it is ignored on the HTML output_
-   _More popular_

_Advantages of `space-sentence:2`:_

- _Easier to see where sentences end_

#### Line wrapping

<!-- 折行 -->

> **Wrap Inner-Sentence**
>
> Try to keep lines under 80 characters
> by breaking large paragraphs logically at points such as:
>
> -   Sentences:
      after a period `.`, question `?` or exclamation mark `!`
> -   [Clauses](https://www.lexico.com/grammar/clauses):
      after words like `and`, `which`, `if ... then`, commas `,`
> -   Large [phrases](https://www.lexico.com/grammar/phrases)

_Good_

```markdown
This is a very very very very very very very very very very very very very long not wrapped sentence.
Second sentence of of the paragraph,
third sentence of a paragraph
and the fourth one.
```

_Rationale:_

-   _Diffs look better,_
    _since a change to a clause shows up as a single diff line._

-   _Occasional visual wrapping_
    _does not significantly reduce the readability of Markdown,_
    _since the only language feature_
    _that can be indented to indicate hierarchy are nested lists._

-   _At some point GitHub translated single newlines to line breaks in READMEs,_
    _and still does so on comments._
    _Currently there is no major engine which does it,_
    _so it is safe to use newlines._

-   _Some tools are not well adapted for long lines,_
    _e.g. Vim and `git diff` will not wrap lines by default._

    _This can be configured however via_
    _`git config --global core.pager 'less -r'`_
    _for Git and `set wrap` for Vim._

_Downsides:_

-   _Requires considerable writer effort,_
    _specially when modifying code._

-   _Markdown does not look like the rendered output,_
    _in which there are no line breaks._

    _Manual line breaking can make the Markdown more readable_
    _than the rendered output,_
    _which is bad because it gives a false sense of readability_
    _encouraging less readable long paragraphs._

-   _Requires users of programming text editors like Vim,_
    _which are usually configured to not wrap,_
    _to toggle visual wrapping on._
    _This can be automated, but_
    _[EditorConfig gave it WONTFIX](https://github.com/editorconfig/editorconfig/issues/168)_

-   _Breaks some email systems,_
    _which always break a line on a single newline._

_Other alternates:_

-   ~~Don't wrap lines.~~

    _Rationale: very easy to edit._
    _But diffs on huge lines are hard to read._

-   ~~Always wrap at the end of the first word that exceeds 80 characters.~~

    _Rationale: source code becomes is very readable_
    _and text editors support it automatically._
    _But diffs will look bad, and changing lines will be hard._

- ~~Wrap Sentence~~

    _Rationale: similar advantages as `wrap:inner-sentence`,_
    _but easier for people to follow since the rule is simple:_
    _break after the period._
    _But may produce long lines with hard to read diffs._

    _Notable occurrence:_
    _[ProGit 2](https://raw.githubusercontent.com/progit/progit2/5c285553c0605342339284981a9bb8a6c4e7c18e/book/01-introduction/1-introduction.asc)._

#### Code

##### Dollar Signs in Shell Code

<!-- Shell 代码中的美元符 `$` -->

> **Don't prefix shell code with dollar signs `$`**
> **unless you will be showing the command output**
> **on the same code block.**

If the goal is to clarify what the language is,
do it on the preceding paragraph.

_Rationale: harder to copy paste, noisier to read._

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

> **Use code blocks or inline code for:**
>
> -   **Executables**. _E.g.:_
>
>     ```markdown
>     `gcc` is the best compiler available.
>     ```
>
>     Differentiate between tool and the name of related projects.
>     _E.g.: `gcc` vs GCC._
>
> -   **File paths**
>
> -   **Version numbers**
>
> -   **Capitalized explanation of abbreviations**:
>
>     ```markdown
>     xinetd stands for `eXtended Internet daemon`
>     ```
>
> -   **Other terms related to computers**
>     that you don't want to add to your dictionary
>
> **Don't mark as code:**
>
> - **Names of projects**. _E.g.: GCC_
> - **Names of libraries**. _E.g.: libc, glibc_

##### Spelling and Grammar

<!-- 拼写与语法 -->

> **Use correct spelling and grammar.**

_Prefer writing in English, and in particular American English._

_Rationale: American English speakers have the largest GDP,_
_specially in the computing industry._

_Use markup like URL or code on words_
_which you do not want to add to your dictionary_
_so that spell checkers can ignore them automatically._

Beware of case sensitive spelling errors,
in particular for project, brand names or abbreviations:

- _Good: URL, LinkedIn, DoS attack_
- _Bad: url, Linkedin, dos attack_
- _When in doubt, prefer the same abbreviation as used on Wikipedia._

> **Avoid informal contractions**

- _Good: biography, repository, directory_
- _Bad: bio, repo, dir_

##### Escape Newlines

<!-- 转义换行符 -->

_( from Google Markdown style guide )_

> **Escape any newlines in code blocks :**
> **Use a single backslash at the end of the line.**

```bash
bazel run :target -- --flag \
    --foo=longlonglonglonglongvalue \
    --bar=anotherlonglonglonglonglonglonglonglonglonglongvalue
```

_Rationale: Because most commandline snippets_
_are intended to be copied and pasted directly into a terminal,_
_it's best practice to escape any newlines._

### Block elements

<!-- 块元素 -->

#### Line breaks

<!-- 换行符 -->

> **Avoid line breaks**,
> as they don't have generally accepted semantic meaning.

In the rare case you absolutely need them,
end a lines with exactly two spaces.

#### Header

<!-- 标题 -->

##### Header Syntax

<!-- 标题的语法 -->

> Use ATX-style headers

_Bad, Setex-style headers_

```bash
Header 1
========

Header 2
--------
```

_Bad, both Setex-style and ATX-style headers_

```bash
Header 1
========

Header 2
--------

### Header 3
```

_Good, ATX-style headers_

```bash
# Header 1

## Header 2

### Header 3
```

_Rationale:_

-   _Advantages of Setex:_

    -   _More visible._

        _Not very important if you have syntax highlighting._

-   _ATX advantages over Setex:_

    -   _Easier to write_
        _because in Setex you have to match the number of characters_
        _in both lines for it to look good_

    -   _Works for all levels, while Setex only goes up to level 2_

    -   _Occupy only one screen line, while Setex occupies 2_

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

> **Surround headers by a single empty line**
> **except at the beginning of the file.**

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

> **Avoid using two headers with the same content**
> **in the same markdown file.**

_Rationale: many markdown engines generate IDs for headers_
_based on the header content._

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

### Anatomy of the Dog

## Cats

### Anatomy of the Cat
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

_If you target HTML output, write your documents_
_so that it will have one and only one `h1` element as the first thing in it_
_that serves as the title of the document._
_This is the HTML top-level header._

_How this `h1` is produced may vary depending on your exact technology stack:_
_some stacks may generate it from metadata,_
_for example Jekyll through the front-matter._

_Storing the top-level header as metadata has the advantage_
_that it can be reused elsewhere more easily,_
_e.g. on a global index, but the downside of lower portability._

_If your target stack does not generate the top-level header in another way,_
_include it in your markdown file._
_E.g., GitHub._

_Top-level headers on index-like files_
_such as `README.md` or `index.md`_
_should serve as a title for their parent directory._

_Downsides of top-level headers:_

-   Take up one header level.
    This means that there are only 5 header levels left,
    _and each new header will have one extra `#`,_
    _which looks worse and is harder to write._

-   _Duplicate filename information,_
    _which most often can already be seen on a URL._
    _In most cases, the filename can be trivially converted to a top-level,_
    _e.g.: `some-filename.md` to `Some Filename`._

_Advantages of top-level headers:_

- _More readable than URL's, especially for non-technically inclined users._

##### Header Case

<!-- 标题的大小写 -->

> **Use an upper case letter as the first letter of a header**,
> unless it is a word that always starts with lowercase letters,
> _e.g. computer code._

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

> ~~The other letters have the same case~~
> ~~they would have in the middle of a sentence.~~
>
> _According to the Chicago Manual of Style (15th edition),_
> **the following rules should be applied to headers**:_
>
> -   **Always capitalize the first and last words**
>     **of titles and subtitles.**
>
> -   **Always capitalize "major" words**
>     (nouns, pronouns, verbs, adjectives,
>     adverbs, and some conjunctions).
>
> -   **Lowercase the conjunctions**
>     **and, but, for, or, and nor**.
>
> -   **Lowercase the articles the, a, and an**.
>
> -   **Lowercase prepositions, regardless of length**,
>     except when they are stressed,
>     are used adverbially or adjectivally,
>     or are used as conjunctions.
>
> - **Lowercase the words to and as**.
>
> - Lowercase the second part of Latin species names.

_~~Good~~ Bad_

```markdown
# The header of the example
```

_~~Bad~~ Good_

```markdown
# The Header of the Example
```

_As an exception,_
_[title case](https://en.wikipedia.org/wiki/Title_case#Title_case) may be optionally used for the top-level header._
_Use this exception sparingly ( 保守地 ) ,_
_in cases where typographical ( 排字上的 ) perfection is important,_
_e.g.: `README` of a project._
_( icehe: I prefer "Chicago Manual of Style" to "AP Stylebook". )_

_Rationale: why not Title case for all headers?_
_It requires too much effort to decide_
_if edge-case words should be upper case or not._

##### End of a Header

<!-- 标题的后面 -->

> Indicate the end of a header's content
> that is not followed by a new header by an horizontal rule.

```markdown
# Header

Content

---

Outside header.
```

##### Header Length

<!-- 标题长度 -->

> **Keep headers as short as possible.**
>
> Instead of using a huge sentence,
> make the header a summary to the huge sentence,
> and write the huge sentence
> as the first paragraph beneath the header.

_Rationale: if automatic IDs are generated by the implementation, it is:_

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

_Rationale: every header is an introduction to what is about to come next,_
_which is exactly the function of the colon._

> **Don't add a trailing period `.` to headers.**

_Rationale: every header consists of a single short sentence,_
_so there is not need to add a sentence separator to it._

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

_For this reason,_
_you may want to give multiple keyword possibilities for a given header._

_To do so,_
_simply create a synonym header with empty content just before its main header._

_E.g.:_

```markdown
# Purchase

# Buy

You give money and get something in return.
```

_Every empty header with the same level as the following one_
_is assumed to be a synonym._
_This is not the case if levels are different:_

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

_Rationale:_

- Asterisk `*` can be confused with bold or italic markers.
- _Plus sign `+` is not popular_

_Downsides:_

- _`*` and `+` are more visible._
- _`*` is more visible_

###### Ordered

<!-- 有序列表 -->

> **Prefer lists only with the marker `1.` for ordered lists,**
> **unless you intend to refer to items by their number**
> **in the same markdown file or externally.**
>
> ~~Prefer lists with the marker `1.`, `2.`, `3.` and etc. for ordered lists.~~
>
> **Prefer unordered lists**
> **unless you intent to refer to items by their number.**

_Best, we will never refer to the items of this list by their number_

```markdown
- a
- c
- b
```

_Better, only `1.`_

```markdown
1. a
1. c
1. b
```

_Worse, we will never refer to the items of this list by their number_

```markdown
1. a
2. c
3. b
```

_Acceptable, refer to them in the text_

```markdown
The output of the `ls` command is of the form:

    drwx------  2 ciro ciro        4096 Jul  5  2013 dir0
    drwx------  4 ciro ciro        4096 Apr 27 08:00 dir1
    1           2

Where:

1. permissions
2. number of files directory contains
```

_Acceptable, meant to be referred by number from outside of the markdown file_

```markdown
Terms of use.

1. I will not do anything illegal.
2. I will not do anything that can harm the website.
```

_Rationale:_

-   _If you want to change a list item in the middle of the list,_
    _you don't have to modify all items that follow it._

    _Diffs will show only the significant line which was modified._

-   _Content stays aligned without extra effort_
    _if the numbers reach 2 digits._
    _E.g.: the following is not aligned:_

    ```markdown
    9. a
    10. b
    ```

-   _References break when a new list item is added._
    _To reduce this problem:_

    -   _Keep references close to the list so authors_
        _are less likely to forget to update them_

    -   _When referring from an external document,_
        _always refer to an specific version of the markdown file_

##### Spaces Before List Marker

<!-- 列表标识前的空格 -->

> Do not add any space before list markers,
> except to obey the current level of indentation.

_Bad_

```markdown
  - a
  - b
```

_Good_

```markdown
- a
- b
```

_Good, c is just following the indentation of b_

```markdown
-   a
-   b
    - c
```

_Bad, c modified the indentation of b_

```markdown
-   a
-   b
      - c
```

_Rationale:_

- _Easier to type_
- _Easier to reason about levels_

##### Spaces After List Marker

<!-- 列表标识后的空格 -->

_list-space:mixed_

> **If the content of every item of the list is fits in a single paragraph,**
> **use 1 space.**
>
> Otherwise, for every item of the list:
>
> -   Use **3** spaces for unordered lists.
>
> -   Use **2** spaces for ordered lists.
>
>     _One less than for unordered because the marker is 2 chars long._

_( icehe : It's controversial. )_

_Bad, every item is one line long_

```markdown
-   a
-   b
```

_Good_

```markdown
- a
- b
```

_Bad, every item is one line long_

```markdown
1.  a
1.  b
```

_Good_

```markdown
1. a
1. b
```

_Bad, item is longer than one line_

```markdown
- item that
  is wrapped

- item 2
```

_Good_

```markdown
-   item that
    is wrapped

-   item 2
```

_Bad, item is longer than one line_

```markdown
- a

  par

- b
```

_Good_

```markdown
-   a

    par

-   b
```

###### _Rationale: list-space mixed vs 1_

_The advantages of `list-space:1` are that_

-   _It removes the decision of how many spaces_
    _you should put after the list marker: it is always one._

    _We could choose to always have list content indented as:_

    ```markdown
    -   a
    -   b
    ```

    _but that is ugly._

-   _You never need to change the indentation of the entire list_
    _because of a new item._

    _This may happen in `list-space:mixed` if you have:_

    ```markdown
    - a
    - b
    ```

    _and will add a multi-line item:_

    ```markdown
    -   a

    -   b

    -   c

        d
    ```

    _Note how `a` and `b` were changed because of `c`._

_The disadvantages of `list-space:1`_

-   _Creates three indentation levels for the language:_

    - _4 for indented code blocks_
    - _3 for ordered lists_
    - _2 for unordered lists_

    _That means that you cannot easily configure_
    _your editor indent level to deal with all cases_
    _when you want to change the indentation level of multiple list item lines._

-   _Is not implemented consistently across editors._

    _In particular what should happen at:_

    ```markdown
    - a

            code
    ```

    _This ( 2 spaces ):_

    ```markdown
    <pre><code>  code</code></pre>
    ```

    _Or no spaces:_

    ```markdown
    <pre><code>code</code></pre>
    ```

    _Likely the original markdown said no spaces:_

    _"To put a code block within a list item,_
    _the code block needs to be indented twice_
    _— 8 spaces or two tabs"_

    _But many implementations did otherwise._

    _CommonMark_
    _[adds the 2 spaces](https://spec.commonmark.org/0.12/#example-176)._

##### Indentation of Content Inside Lists

<!-- 列表中的内容的缩进 -->

> **The indentation level**
> **of what comes inside list and of further list items**
> **must be the same as the first list item.**

_Bad_

```markdown
-   item that
  is wrapped

-   item 2
```

_Good_

```markdown
-   item that
    is wrapped

-   item 2
```

_Bad_

```markdown
-   item 1

  Content 1

-   item 2

      Content 2
```

_Good, if it matches your spaces after list marker style_

```markdown
-   item 1

    Content 1

-   item 2

    Content 2
```

_Bad_

```markdown
- item 1

    Content 1

- item 2

    Content 2
```

_Good, if it matches your spaces after list marker style_

```markdown
- item 1

  Content 1

- item 2

  Content 2
```

_Avoid starting a list item directly with indented code blocks_
_because that is not consistently implemented._
_[CommonMark states](http://spec.commonmark.org/0.12/#example-176)_
_that a single space is assumed in that case:_

```markdown
-     code

  a
```

##### Empty Lines Inside Lists

<!-- 列表中的空白行 -->

> **If every item of a list is a single line long,**
> **don't add empty lines between items.**
> **Otherwise, add empty lines between every item.**

_Bad, single lines_

```markdown
- item 1

- item 2

- item 3
```

_Good_

```markdown
- item 1
- item 2
- item 3
```

_Bad, multiple lines_

```markdown
-   item that
    is wrapped
-   item 2
-   item 3
```

_Good_

```markdown
-   item that
    is wrapped

-   item 2

-   item 3
```

_Bad, multiple lines_

```markdown
-   item 1

    Paragraph.

-   item 2
-   item 3
```

_Good_

```markdown
-   item 1.

    Paragraph.

-   item 2

-   item 3
```

_Bad, multiple lines_

```markdown
-   item 1

    - item 11
    - item 12
    - item 13

-   item 2
-   item 3
```

_Good_

```markdown
-   item 1

    - item 11
    - item 12
    - item 13

-   item 2

-   item 3
```

_Rationale: it is hard to tell_
_where multi-line list items start and end without empty lines._

##### Empty Lines Around Lists

<!-- 列表前后的空行 -->

> **Surround lists by one empty line.**

_Bad_

```markdown
Before.
- item
- item
After.
```

_Good_

```markdown
Before.

- list
- list

After.
```

##### Case of First Letter of List Item

<!-- 列表项的第一个字母的大小写 -->

> **Each list item has the same case**
> **as it would have if it were concatenated with the sentence**
> **that comes before the list.**

_Good_

```markdown
I want to eat:

- apples
- bananas
- grapes
```

_because it could be replaced with_

```markdown
I want to eat apples
I want to eat bananas
I want to eat grapes
```

_Good_

```markdown
To ride a bike you have to:

- get on top of the bike. This step is easy.
- put your foot on the pedal.
- push the pedal. This is the most fun part.
```

_because it could be replaced with_

```markdown
To ride a bike you have to get on top of the bike. This step is easy.
To ride a bike you have to put your foot on the pedal.
To ride a bike you have to push the pedal. This is the most fun part.
```

_Good_

```markdown
# How to ride a bike

- Get on top of the bike.
- Put your feet on the pedal.
- Make the pedal turn.
```

_because it could be replaced with_

```markdown
# How to ride a bike

Get on top of the bike.
Put your feet on the pedal.
Push the pedal.
```

##### Punctuation at the End of List Items

<!-- 列表项结尾的标点符号 -->

> **Punctuate at the end of list items if either it:**
>
> - **contains multiple sentences or paragraphs**
> - **starts with an upper case letter**
>
> **Otherwise, omit the punctuation if it would be a period `.`.**

_Bad, single sentences_

```markdown
- apple.
- banana.
- orange.
```

_Good_

```markdown
- apple
- banana
- orange
```

_Idem_

```markdown
- go to the market
- then buy some fruit
- finally eat the fruit
```

_Good, not terminated by period but by other punctuation_

```markdown
- go to the marked
- then buy fruit?
- of course!
```

_Bad, multiple sentences_

```markdown
- go to the market
- then buy some fruit. Bad for wallet
- finally eat the fruit. Good for tummy
```

_Good_

```markdown
- go to the market
- then buy some fruit. Bad for wallet.
- finally eat the fruit. Good for tummy.
```

_Note: nothing forbids one list item from ending in period_
_while another in the same list does not._

_Bad, multiple paragraphs_

```markdown
-   go to the market

-   then buy some fruit

    Bad for wallet

-   finally eat the fruit

    Good for tummy
```

_Good_

```markdown
-   go to the market

-   then buy some fruit.

    Bad for wallet.

-   finally eat the fruit.

    Good for tummy.
```

_Bad, starts with upper case_

```markdown
- Go to the market
- Then buy some fruit
- Finally eat the fruit
```

_Good_

```markdown
- Go to the market.
- Then buy some fruit.
- Finally eat the fruit.
```

#### Definition Lists

<!-- 定义词汇的列表 -->

> **Avoid the definition list extension since it is not present**
> **in many implementations nor in CommonMark.**
>
> Instead, use either:
>
> -   Formatted lists:
>
>     -   format the item be defined as either of bold, link or code
>     -   separate the item from the definition with a colon and a space `:` .
>     -   don't align definitions
>         as it is harder to maintain and does not show on the HTML output

_Good_

```markdown
- **apple**: red fruit
- **dog**: noisy animal
```

_Good_

```markdown
-   **apple**: red fruit.

    Very tasty.

-   **dog**: noisy animal.

    Not tasty.
```

_Good_

```markdown
- [apple](http://apple.com): red fruit
- [dot](http://dog.com): red fruit
```

_Good_

```markdown
- `-f`: force
- `-r`: recursive
```

_Bad, no colon_

```markdown
- **apple** red fruit
- **dog** noisy animal
```

_Bad, space between term and colon_

```markdown
- **apple** : red fruit
- **dog** : noisy animal
```

_Bad, definitions aligned_

```markdown
- **apple**: red fruit
- **dog**:   noisy animal
```

- headers

_Good_

```markdown
# Apple

Red fruit

# Dog

Noisy animal
```

#### Code Blocks

<!-- 代码块 -->

> **Only use fenced code blocks.**

_Comparison to indented code blocks:_

-   _Disadvantage: not part of the original markdown,_
    _thus less portable, but added to CommonMark._
-   _Advantage: many implementations,_
    _including GitHub's, allow to specify the code language with it_

> **Don't indent fenced code blocks.**
>
> **Always specify the language of the code is applicable.**

_Good_

<pre><code class="lang-markdown">```ruby
a = 1
```</code></pre>

_Bad_

<pre><code class="lang-markdown">```
a = 1
```</code></pre>

#### Horizontal Rules

<!-- 水平线 -->

> **Don't use horizontal rules except to indicate the [end of a header](#End-of-a-Header).**

_Rationale:_

-   _Headers are better section separators_
    _since they say what a section is about._
-   _Horizontal rules don't have a generally accepted semantic meaning._
    _This guide gives them one._

> **Use 3 hyphens without spaces**

```markdown
---
```

#### Tables

<!-- 表格 -->

> **Prefer lists to tables.**
> **Any tables in your Markdown should be small.**

_( from Google Markdown style guide )_

_Bad_

```markdown
Fruit | Attribute | Notes
--- | --- | --- | ---
Apple | [Juicy](https://example.com/SomeReallyReallyReallyReallyReallyReallyReallyReallyLongQuery), Firm, Sweet | Apples keep doctors away.
Banana | [Convenient](https://example.com/SomeDifferentReallyReallyReallyReallyReallyReallyReallyReallyLongQuery), Soft, Sweet | Contrary to popular belief, most apes prefer mangoes.
```

_Good_

_Lists and subheadings usually suffice to present the same information in a slightly less compact,_
_though much more edit-friendly way:_

```markdown
## Fruits

### Apple

- [Juicy](https://SomeReallyReallyReallyReallyReallyReallyReallyReallyReallyReallyReallyReallyReallyReallyReallyReallyLongURL)
- Firm
- Sweet

Apples keep doctors away.

### Banana

- [Convenient](https://example.com/SomeDifferentReallyReallyReallyReallyReallyReallyReallyReallyLongQuery)
- Soft
- Sweet

Contrary to popular belief, most apes prefer mangoes.
```

_Good_

_There are times when a small table is called for_

```markdown
|Transport       |Favored by    |Advantages                   |
|----------------|--------------|-----------------------------|
|Swallow         |Coconuts      |Otherwise unladen            |
|Bicycle         |Miss Gulch    |Weatherproof                 |
|X-34 landspeeder|Whiny farmboys|Cheap since the X-38 came out|
```

_Rationale: Complex,_
_large tables are difficult to read in source and most importantly,_
_a pain to modify later._

---

Extension.

> -   **Surround tables by one empty line.**
> -   **Don't indent tables.**
> -   **Surround every line of the table by pipes.**
> -   Align all border pipes vertically.
> -   **Separate header from body by hyphens except at the aligned pipes `|`.**
> -   ~~Pipes `|` must be surrounded by a space,~~
>     ~~except for outer pipes which only get one space internally,~~
>     ~~and pipes of the hyphen separator line.~~
> -   Column width is determined by the longest cell in the column.

_Good table_

```markdown
Before.

|h   |Long header|
|----|-----------|
|abc |def        |
|abc2|def2       |

After.
```

_Rationale:_

-   _Unaligned tables tables are easier to write,_
    _but aligned tables are more readable,_
    _and people read code much more often than they edit it._

-   _Preceding pipes make it easier to determine_
    _where a table starts and ends._
    _Trailing pipes make it look better because of symmetry._

-   _There exist tools which help keeping the table aligned._
    _For example, Vim has the_
    _[Tabular plugin](https://github.com/godlygeek/tabular)_
    _which allows to align the entire table with `:Tabular /|`._

-   _Why no spaces around pipes of the hyphen separator line,_
    _i.e.: `|---|` instead of `| - |`?_
    _No spaces looks better, works on GitHub._

    _Downside: harder to implement automatic alignment in editors,_
    _as it requires a special rule for the separator line._

#### Separate Consecutive Elements

<!-- 分隔连续的元素 -->

> **Separate consecutive:**
>
> - **lists**
> - **indented code blocks**
> - **blockquotes**
> - **list followed by external code block**
>
> **with an empty HTML comment `<!-- -->`.**

```markdown
- list 1
- list 1

<!-- -->

- list 2
- list 2
```

```markdown
    code 1
    code 1

<!-- -->

    code 2
    code 2
```

```markdown
> blockquote 1
> blockquote 1

<!-- -->

> blockquote 2
> blockquote 2
```

```markdown
- list
- list

<!-- -->

    code outside list
    code outside list
```

### Span elements

<!-- Span 元素 -->

> **Don't use inner spaces.**

_Good_

```markdown
**bold**
`code`
[link](http://a.com)
[text][name]
```

_Bad_

```markdown
** bold **
` code `
[ link ]( http://a.com )
[text] [name]
```

_For inline code in which the space is crucial:_

- _explain in writing that the spaces must be there_
- _add something after the space if possible_

_Good_

```markdown
Use the hyphen marker followed by one space `- a`  for unordered lists.
```

_Rationale: most browsers don't render the surrounding spaces_
_nor add them to the clipboard on copy._

#### Links

<!-- 链接 -->

##### Reference-style Links

<!-- 引用风格的链接 -->

> ~~Links: use the trailing `[]` on implicit links.~~
>
> **Links: avoid using reference-style links.**

_Good_

```markdown
[a][]
```

_Bad_

```markdown
[a]
```

_Rationale: while omitting `[]` works on most major implementations,_
_it is not specified in the documentation_
_and not implemented in the original markdown._

> **Definitions:**
>
> -   must be the last thing on the file
> -   must be sorted alphabetically by the ID
> -   don't enclose URLs by angle brackets
> -   align URLs and link names as in a table
> -   link IDs use only lowercase letters.
>     _Rationale: they are case insensitive,_
> -   lowercase only is easier to write,
>     and the readability gain of mixed case is not very big.

_Good_

```markdown
[id2]:     http://long-url.com
[long id]: http://a.com        "name 1"
```

_Bad, not ordered by id_

```markdown
[b]: http://a.com
[a]: http://b.com
```

_Bad, not aligned_

```markdown
[id]: http://id.com
[long id]: http://long-id.com
```

##### Single or Double Quote Titles

<!-- 带单个或两个的引用符号的标题 -->

> Use double quotes, not single quotes.

```markdown
# Class `Integer`
```

_Rationale: single quotes do not work in all major implementations,_
_double quotes do._

##### Short Link Titles

<!-- 简短的链接标题 -->

_( from Google Markdown style guide )_

> **Use informative Markdown link titles**
>
> Write the sentence naturally,
> then go back and wrap the most appropriate phrase with the link.

_Bad_

```markdown
See the syntax guide for more info: [link](syntax_guide.md).
Or, check out the style guide [here](style_guide.md).
DO NOT DO THIS.
```

_Good_

```markdown
See the [syntax guide](syntax_guide.md) for more info.
Or, check out the [style guide](style_guide.md).
```

_Rationale:_

-   _Markdown link syntax allows you to set a link title, just as HTML does._
    _Use it wisely._
-   _Titling your links as "link" or "here" tells the reader precisely nothing_
    _when quickly scanning your doc and is a waste of space:_

#### Emphasis

<!-- 强调 -->

##### Bold

<!-- 加粗 -->

> **Use double asterisk format: `**bold**`.**

_Bad_

```markdown
__Bold content__
```

_Good_

```markdown
**Bold content**
```

_Rationale: more common and readable than the double underline `__bold__` form._

##### Italic

<!-- 斜体 -->

> ~~**Use single asterisk format: `*italic*`.**~~
>
> **Use single underscore format: `_italic_`.**

_Bad_

```markdown
*Italic content*
```

_Good_

```markdown
_Italic content_
```

_Rationale:_

- _more common and readable than the underscore form_
- _consistent with the bold format, which also uses asterisks_

##### Uppercase for Emphasis

<!-- 用大写字母来表达强调 -->

> **Don't use uppercase for emphasis:**
> **use emphasis constructs like bold or italic instead.**

_Bad_

```markdown
EMPHASIS
```

_Good_

```markdown
**Emphasis**
```

_Rationale: CSS has `text-transform:uppercase`_
_which can easily achieve the same effect consistently_
_across the entire website if you really want uppercase letters._

##### Emphasis vs Headers

<!-- 强调 vs 标题 -->

> **Don't use emphasis elements ( bold or italics )**
> **to introduce a multi line named section: use headers instead.**

-   _Rationale: that is exactly the semantic meaning of headers,_
    _and not necessarily that of emphasis elements._

    _As a consequence,_
    _many implementations add useful behaviors to headers_
    _and not to emphasis elements,_
    _such as automatic id to make it easier to refer to the header later on._

_Good_

```markdown
# How to make omelets

Break an egg.

...

# How to bake bread

Open the flour sack.

...
```

_Bad_

```markdown
**How to make omelets:**

Break an egg.

...

**How to bake bread:**

Open the flour sack.

...
```

#### Automatic Links

<!-- 自动链接 -->

##### Automatic Links without Angle Brackets

<!-- 不带尖角括号的自动链接 -->

> ~~**Don't use automatic links without angle brackets.**~~
>
> **Don't use automatic links with angle brackets.**

_~~Good~~ Bad_

```markdown
<http://a.com>
```

_~~Bad~~ Good_

```markdown
http://a.com
```

_Rationale: it is an extension, `<>` is easy to type and saner._

> If you want literal links which are not autolinks, enclose them in code blocks.

_E.g.:_

```markdown
`http://not-a-link.com`
```

_Rationale: many tools automatically interpret any word starting with http as a link._

##### Content of Automatic Links

<!-- 自动链接的内容 -->

> **All automatic links must start with the string `http`.**
>
> **In particular, don't use relative automatic links. Use bracket links instead for that purpose.**

_Good_

```markdown
[file.html](file.html)
```

_Bad_

```markdown
<file.html>
```

_Good_

```markdown
https://github.com
```

_~~Good~~ Bad_

```markdown
<https://github.com>
```

_Bad_

```markdown
<github.com>
```

_Rationale: it is hard to differentiate automatic links from HTML tags._
_What if you want a relative link to a file called `script`?_

##### Email Automatic Links

<!-- 邮箱自动链接 -->

> **Don't use email autolinks `<address@example.com>`.**
> **Use raw HTML instead.**

_Rationale: the original markdown specification states it:_

```text
"performs a bit of randomized decimal
and hex entity-encoding
to help obscure your address
from address-harvesting spambots."
```

_Therefore, the output is random, ugly, and as the spec itself mentions:_

```text
"but an address published in this way
will probably eventually start receiving spam"
```

_Bad_

```markdown
<icehe.me@qq.com>
```

_Good, e.g._

```markdown
icehe.me#qq.com ( replace `#` with `@` )
```

### Content

<!-- 内容 -->

#### Document Layout

<!-- 文档 ( 内容 ) 布局 -->

_( from Google Markdown style guide )_

_In general, most documents benefit from_
_some variation of the following layout:_

```markdown
# Document Title

Short introduction.

---

<!-- [TOC] -->

## Topic

Content.

## See also

- https://link-to-more-info
```

-   _`# Document Title`: The first heading should be a level one heading,_
    _and should ideally be the same or nearly the same as the filename._
    _The first level one heading is used as the page `<title>`._

-   _`author`: Optional._
    _If you'd like to claim ownership of the document_
    _or if you are very proud of it, add yourself under the title._
    _However, revision history generally suffices._

-   _`Short introduction`._
    _1 ~ 3 sentences providing a high-level overview of the topic._
    _Imagine yourself as a complete newbie,_
    _who landed on your "Extending Foo" doc_
    _and needs to know the most basic assumptions you take for granted._
    _"What is Foo? Why would I extend it?"_

-   ~~_`[TOC]`: if you use hosting that supports table of contents,~~
    ~~_such as Gitiles, put [TOC] after the short introduction._~~
    ~~_See `[TOC]` documentation._~~~~

-   _`## Topic`: The rest of your headings should start from level 2._

-   _`## See also`: Put miscellaneous links at the bottom for the user_
    _who wants to know more or didn't find what she needed._

#### Character Line Limit

<!-- 每行字符数量的限制 -->

_( from Google Markdown style guide )_

_Obey projects' character line limit wherever possible._
_Long URLs and tables are the usual suspects when breaking the rule._
_( Headings also can't be wrapped, but we encourage keeping them short )._
_Otherwise, wrap your text:_

```markdown
Lorem ipsum dolor sit amet, nec eius volumus patrioque cu, nec et commodo
hendrerit, id nobis saperet fuisset ius.

*   Malorum moderatius vim eu. In vix dico persecuti. Te nam saperet percipitur
    interesset. See the [foo docs](https://gerrit.googlesource.com/gitiles/+/master/Documentation/markdown.md).
```

_Often, inserting a newline before a long link preserves readability_
_while minimizing the overflow:_

```markdown
Lorem ipsum dolor sit amet. See the
[foo docs](https://gerrit.googlesource.com/gitiles/+/master/Documentation/markdown.md)
for details.
```

#### Trailing Whitespace

<!-- 结尾的空格 -->

_( from Google Markdown style guide )_

_Don't use trailing whitespace, use a trailing backslash._

_The [CommonMark spec](https://spec.commonmark.org/0.20/#hard-line-breaks)_
_decrees that two spaces at the end of a line should insert a `<br/>` tag._
_However, many directories have a trailing whitespace presubmit check in place,_
_and many IDEs will clean it up anyway._

_Best practice is to avoid the need for a `<br/>` altogether._
_Markdown creates paragraph tags for you simply with newlines:_
_get used to that._

#### Images

<!-- 图片 -->

> **Use images sparingly, and prefer simple screenshots.**

_( from Google Markdown style guide )_

_Rationale:_

-   _This guide is designed around the idea_
    _that plain text gets users down to the business of communication faster_
    _with less reader distraction and author procrastination._

- However, it's sometimes very helpful to show what you mean.

_See [image syntax](https://gerrit.googlesource.com/gitiles/+/master/Documentation/markdown.md#Images)._

#### HTML

> **Strongly prefer Markdown to HTML**

_( from Google Markdown style guide )_

_Rationale:_

-   _Please prefer standard Markdown syntax wherever possible_
    _and avoid HTML hacks._
    _If you can't seem to accomplish what you want,_
    _reconsider whether you really need it._
    _Except for big tables, Markdown meets almost all needs already._

-   _Every bit of HTML or Javascript hacking_
    _reduces the readability and portability._
    _This in turn limits the usefulness of integrations with other tools,_
    _which may either present the source as plain text or render it._
    _See [Philosophy](https://github.com/google/styleguide/blob/gh-pages/docguide/philosophy.md)._

    _Gitiles does not render HTML._

### Documentation Best Practices

<!-- 文档的最佳实践 -->

_( from Google Markdown style guide )_

"Say what you mean, simply and directly." - [Brian Kernighan](https://en.wikipedia.org/wiki/The_Elements_of_Programming_Style)

_Contents:_

- Minimum viable documentation
- Update docs with code
- Delete dead documentation
- Documentation is the story of your code

#### Minimum Viable Documentation

A small set of fresh and accurate docs are better than a sprawling,
loose assembly of "documentation" in various states of disrepair.

**Write short and useful documents. Cut out everything unnecessary**,
while also making a habit of continually massaging
and improving every doc to suit your changing needs.
**Docs work best when they are alive but frequently trimmed,**
**like a bonsai tree.**

This guide _( Google Markdown style guide )_
encourages engineers to take ownership of their docs
and keep them up to date with the same zeal we keep our tests in good order.
Strive for this.

- Identify what you really need: release docs, API docs, testing guidelines.
- Delete cruft frequently and in small batches.

#### Update Docs with Code

**Change your documentation**
**in the same CL _( Commit Log )_ as the code change.**
This keeps your docs fresh,
and is also a good place to explain to your reviewer what you're doing.

A good reviewer can at least insist that
docstrings, header files, README.md files,
and any other docs get updated alongside the CL.

#### Delete Dead Documentation

**Dead docs are bad.**
**They misinform, they slow down,**
**they incite despair in engineers and laziness in team leads.**
**They set a precedent for leaving behind messes in a code base.**
**If your home is clean, most guests will be clean without being asked.**

Just like any big cleaning project, it's easy to be overwhelmed.
If your docs are in bad shape:

-   Take it slow, doc health is a gradual accumulation.
-   **First delete what you're certain is wrong, ignore what's unclear.**
-   Get your whole team involved.
    Devote time to quickly scan every doc and make a simple decision:
    Keep or delete?
-   Default to delete or leave behind if migrating.
    Stragglers can always be recovered.
-   Iterate.

#### Prefer the Good Over the Perfect

**Your documentation should be**
**as good as possible within a reasonable time frame.**

The standards for a documentation review
are different from the standards for code reviews.
Reviewers can and should ask for improvements,
but in general, the author should always be able to invoke the
"**Good Over Perfect Rule**".

**It's preferable to allow authors to quickly submit changes**
**that improve the document,**
**instead of forcing rounds of review until it's "perfect".**
**Docs are never perfect,**
**and tend to gradually improve as the team learns**
**what they really need to write down.**

#### Documentation is the Story of your Code

Writing excellent code doesn't end
when your code compiles or even if your test coverage reaches 100%.
It's easy to write something a computer understands,
it's much harder to write something both a human and a computer understand.
**Your mission as a Code Health-conscious engineer**
**is to write for humans first, computers second.**
Documentation is an important part of this skill.

_There's a spectrum of engineering documentation_
_that ranges from terse comments to detailed prose:_

1.  _**Inline comments**:
    The primary purpose of inline comments is
    to provide information that the code itself cannot contain,
    such as why the code is there._

1.  **Method and class comments**:

    -   **Method API documentation**:

        _The header / Javadoc / docstring comments that say_
        _what methods do and how to use them.
        _This documentation is the contract of how your code must behave._
        _The intended audience is future programmers_
        _who will use and modify your code._

        _It is often reasonable to say_
        _that any behavior documented here should have a test verifying it._
        _This documentation details what arguments the method takes,_
        _what it returns, any "gotchas" or restrictions,_
        _and what exceptions it can throw or errors it can return._
        _It does not usually explain why code behaves a particular way_
        _unless that's relevant to a developer's understanding of_
        _how to use the method._
        _"Why" explanations are for inline comments._
        _Think in practical terms when writing method documentation:_
        _"This is a hammer. You use it to pound nails."_

    -   _**Class / Module API documentation**:_
        _The header / Javadoc / docstring comments for a class or a whole file._
        _This documentation gives a brief overview of_
        _what the class / file does_
        _and often gives a few short examples of_
        _how you might use the class / file._

        _Examples are particularly relevant_
        _when there's several distinct ways to use the class_
        _(some advanced, some simple)._
        _Always list the simplest use case first._

1.  _**README.md**:_

    _A good README.md orients the new user to the directory_
    _and points to more detailed explanation and user guides:_

    -   _What is this directory intended to hold?_
    -   _Which files should the developer look at first?_
        _Are some files an API?_
    -   _Who maintains this directory and where I can learn more?_

    _See the [README.md guidelines](https://github.com/google/styleguide/blob/gh-pages/docguide/READMEs.md)._

### README.md Files

<!-- README.md 文件 ( 示例? ) -->

_( from Google Markdown style guide )_

_About README.md files._

1. Overview
1. Guidelines
1. Filename
1. Contents
1. Example

#### _Overview_

`README.md` files are Markdown files that describe a directory.
_GitHub and Gitiles renders it when you browse the directory._

_For example, the file /README.md is rendered_
_when you view the contents of the containing directory:_

https://github.com/google/styleguide/tree/gh-pages

_Also `README.md` at `HEAD` ref is rendered by Gitiles_
_when displaying repository index:_

https://gerrit.googlesource.com/gitiles/

#### Guidelines

**`README.md` files are intended to provide orientation**
**for engineers browsing your code, especially first-time users.**
The README.md is likely the first file a reader encounters
when they browse a directory that contains your code.
In this way, it acts as a landing page for the directory.

_We recommend that top-level directories for your code_
_have an up-to-date README.md file._
_This is especially important for package directories_
_that provide interfaces for other teams._

#### _Filename_

Use `README.md`.

_Files named `README` are not displayed in the directory view in Gitiles._

#### Contents

_At minimum, every package-level `README.md`_
_should include or point to the following information:_

1.  **What** is in this package/library and what's it used for.
1.  **Who** to contact.
1.  **Status**: whether this package/library is deprecated,
    or not for general release, etc.
1.  **More info**: where to go for more detailed documentation, such as:
    - _An overview.md file for more detailed conceptual information._
    - _Any API documentation for using this package/library._

#### Example

```markdown
# APIs

This is the top-level directory for all externally-visible APIs,
plus some private APIs under `internal/` directories.
See [API Style Guide](docs/apistyle.md) for more information.

*TL;DR*: API definitions and configurations should be defined in `.proto` files,
checked into `apis/`.

...
```

### Philosophy

<!-- 哲学 -->

_( from Google Markdown style guide )_

> 埏埴以為器，當其無，有器之用.
>
> Clay becomes pottery through craft, but it's the emptiness that makes a pot useful.
>
> \- [Laozi](http://ctext.org/dictionary.pl?if=en&id=11602)

_Contents:_

- Radical simplicity
- Readable source text
- Minimum viable documentation
- Better is better than perfect

#### Radical Simplicity

-   **Scalability and interoperability** are more important than a menagerie
    _( 动物展览 )_ of unessential features.
    Scale comes from simplicity, speed, and ease.
    Interoperability _( 互操作性 )_ comes from
    unadorned _( 朴素的 )_, digestible content _( 容易消化的 )_ .

-   **Fewer distractions** make for better writing and more productive reading.
-   **New features should never interfere with the simplest use case**
    and should remain invisible to users who don't need them.

-   **This guide is designed for the average engineer** --
    the busy, just-want-to-go-back-to-coding engineer.
    Large and complex documentation is possible but not the primary focus.

-   **Minimizing context switching makes people happier**.
    Engineers should be able to interact with documentation
    using the same tools they use to read and write code.

#### Readable Source Text

-   **Plain text not only suffices, it is superior**.
    Markdown itself is not essential to this formula,
    but it is the best and most widely supported solution right now.
    HTML is generally not encouraged.

-   **Content and presentation should not mingle** _( 混合 )_ .
    It should always be possible to ditch the renderer
    and read the essential information at source.
    Users should never have to touch the presentation layer
    if they don't want to.

-   **Portability and future-proofing leave room**
    **for the unimagined integrations to come**,
    and are best achieved by keeping the source as human-readable as possible.

-   **Static content is better than dynamic**,
    because content should not depend on the features of any one server.
    However, fresh is better than stale. We strive to balance these needs.

#### Minimum Viable Documentation

-   **Docs thrive when they're treated like tests**:
    a necessary chore one learns to savor because it rewards over time.
    See [Best Practices](https://github.com/google/styleguide/blob/gh-pages/docguide/best_practices.md).

-   **Brief and utilitarian is better than long and exhaustive**.
    The vast majority of users need
    only a small fraction of the author's total knowledge,
    but they need it quickly and often.

#### Better Is Better Than Perfect

-   **Incremental improvement is better than prolonged _( 长时间的 )_ debate**.
    Patience and tolerance of imperfection
    allow projects to evolve organically _( 有机地 )_ .

-   **Don't lick the cookie, pass the plate**.
    We're drowning in _( 溺死在 )_ potentially impactful projects.
    Choose only those you can really handle and release those you can't.

### 补充 Mine

#### 列表 Lists

> **不混用「编号列表」和「顺序列表」, 建议只使用「无序列表」**

_因为并非所有 Markdown 渲染引擎都支持_

_Good_

```markdown
- item a
    - item aa
- item b
    - item bb
    - item bc
        - item cat
```

_Not recommended_

```markdown
1. item a
    1.1. item aa
2. item b
    2.1. item bb
    2.2. item bc
        - item cat
```

_Bad_

```markdown
- 1. item a
    - item a
- 1. item b
    - 1. item bb
    - 2. item bc
        - item cat
```

#### 缩进 Indent

> **尽量减少缩进**
>
> - 能不用列表符 `-` 就能表达清楚层级结构的情况, 就别用 `-`
> - 列表的层次最好控制在 2 层以内, 最多 3 层

_Bad_

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

_Good_

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

_Better_

```markdown

# 计划

确认需求

- 需求文档
- 工作排期

开发

- 编写代码
- 代码审查

测试

- 单元测试
- 集成测试
- 回归测试

上线

- 预览上线
- 正式上线
```

#### 链接 Link

_基于简单原则: 尽量少地格式化, 去表达同样的意思_

> **如果 URL 链接不是太长, 而且自身能准确表达其网页内容, 就不要使用 `[link](url)` 语法了**

_Good_

```markdown
My image: https://hub.docker.com/r/icehe/alpine
```

_Bad_

```markdown
My image: [icehe/alpine](https://hub.docker.com/r/icehe/alpine) @ hub.docker.com
```

#### 脚注 Footnotes

> **尽量不使用脚注**

- Available
    - GitLab: https://docs.gitlab.com/ee/user/markdown.html#footnotes
- Unavailable
    - GitHub
    - docsify _( 本网站 icehe.xyz 的 Markdown 内容依赖它来渲染 )_
- 如果使用, 标准是:
    - https://cirosantilli.com/markdown-style-guide/#reference-style-links

#### 表情 Emoji

> **尽量不使用表情符号**

- Available
    - GitLab: https://docs.gitlab.com/ee/user/markdown.html#footnotes
    - Visual Studio Code: Markdown Preview Enhanced
- Unavailable
    - GitHub
    - docsify _( 本网站 icehe.xyz 的 Markdown 内容依赖它来渲染 )_
- 如果使用, 标准是:
    - https://cirosantilli.com/markdown-style-guide/#reference-style-links

#### 其它 Others

> **一行内容不要太长**

短句方便阅读.

> **文档撰写方面, 对 "必须 / 应该 / 建议" 的字眼的使用, 请参考 RFC 2119**

https://www.ietf.org/rfc/rfc2119.txt

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

[mdl styles](./lint/style.rb ':include: type=code properties')

推荐通过 form 项目 CI 的 `mdl`（markdownlint）检查后, 才允许合并 MR

### Remark Lint

[remark-lint](https://github.com/remarkjs/remark-lint)

- 错误输出比 markdownlint 可读性更好

### Other Lints

Asked on Stack Exchange:
http://softwarerecs.stackexchange.com/questions/7138/markdown-lint-tool

- https://github.com/wooorm/mdast-lint
- https://github.com/mivok/markdownlint
- https://github.com/slang800/tidy-markdown
- https://github.com/DavidAnson/markdownlint
    -   Documentation has some links back to this style:
        https://github.com/DavidAnson/markdownlint/blob/v0.14.2/doc/Rules.md
