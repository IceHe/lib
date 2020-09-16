# Vim

> terminal text editor

Purpose

- Only list the useful keys that I’m unfamiliar with here.

Offical Website

- `man vim`
- Home : http://www.vim.org/
- Docs : http://www.vim.org/docs.php
- Vim documentation: help : http://vimdoc.sourceforge.net/htmldoc/

Recommended

- [Vim Cheat Sheet](http://coolshell.cn//wp-content/uploads/2011/09/vim_cheat_sheet_for_programmers_print.png) - Image
- Vim cheatsheet : https://devhints.io/vim
    - Interactive Vim tutorial : https://openvim.com/
- SpaceVim : https://spacevim.org/ - Modern Vim Distribution

My config files

- [.vimrc](https://github.com/IceHe/mac-conf/blob/master/.vimrc) : for **Vim & NeoVim** in terminal
- [.cvimrc](https://github.com/IceHe/mac-conf/blob/master/.cvimrc) : for Chrome **'cVim'** Plugin
    - How to Use : https://droidrant.com/using-cvim
    - Source Code : https://github.com/1995eaton/chromium-vim
- [.ideavimrc](https://github.com/IceHe/mac-conf/blob/master/.ideavimrc) : for JetBrains **'IdeaVim'** Plugin

## Move Cursor

- _`^ o` | `^ i` [ Prev | Next ] Cursor Pos_
- `{` | `}` [ Prev | Next ] Blank Line
- `w` | `⇧ W` Head of Next [ Word / Str ]
- `e` | `⇧ E` Tail of Next [ Word / Str ]
- `b` | `⇧ B` Head of Prev [ Word / Str ]
- `ge` | `gE` Tail of Prev [ Word / Str ]
- `;` Repeat the last manipulation about `f` `t` `⇧ F` `⇧ T`
- `0` Head of Line
- `^` = `⇧ 6` Head of Line ( Non-Whitespace )
- `$` = `⇧ 4` End of Line
- `"` Switch to some Register
- _`-` Head of Prev Line_
- _`⇧ +` Head of Next Line_

### Emacs-like

Mimic Emacs in Insert Mode

- `^ b` = `←`
- `^ f` = `→`
- `^ p` = `↑`
- `^ n` = `↓`
- `^ a` = `Home`
- `^ e` = `End`
- `^ k` Del to End of Line
- `^ u` Del to Head of Line
- `^ t` Exchange Chars ( Before & After Cursor )

### CTags

Powered by plugin

- `^ ]` Find Declaration
- `^ t` Back from Declaration

### Marks

- <code>\`^</code> Last position of cursor in insert mode
    - `'^` Head of line of last position of cursor in insert mode
- <code>\`.</code> Last change
    - `'.` Head of line of last change
- <code>\`\`</code> Last jump
    - `''` Head of line of last jump

### _EasyMotion_

[EasyMotion](https://github.com/easymotion/vim-easymotion)

- It's a Vim plugin. [spf13-vim](http://vim.spf13.com/) makes it easier to use:
    - In normal mode `,`, `,` ( Twice ) then input a cursor motion instruction,
        - such as `w`, `e`, `b`, `f*`, `F*`, `t*`, `T*` or etc.
    - The screen will display some keycues.
    - If you input one of the keycues, then your cursor will get to the specified place.

## Edit Content

### Range

- `ciw` Del Word
- `caw` Del Word including the Following Spaces 凵
- `dw` Del until Head of Next Word
- `de` Del to End of Cur Word
- `ci*` Select & Manipulate the string surrounded by `*`.
- `ca*` Select & Manipulate the string surrounded by `*` including `*`.

Paragraph <!-- newly added on 2019-05-02 -->

- `vip` Select paragraph _( same as `⇧ V`, `⇧ }` ? )_
- `vipip` Select more paragraphs _( better : `⇧ V`, `⇧ }`, `⇧ }`, … )_
- _`yip` Yank inner paragraph_
- `yap` Yank paragraph (including newline) _( better than `yip` )_

### Delete

- `x` Del Char Forward ⌦
- _`⇧ X` Del Char Backward ⌫_
- `s` Del Char Forward & then Insert
- `⇧ S` Del Current Line & then Insert
- `⇧ C` Del to End of Line & then Insert
- `⇧ D` Del to End of Line

### Exchange

- `xp` Exchange the Current Char and the Next Char
- `ddp` Exchange the Current Line and the Next Line

### Copy & Join

- `⇧ Y` Copy from the cursor to the end of line
- `⇧ K` Join curren line and next line without breaking
- `]p` Paste under the current indentation level

### Lower or Upper Case

- `⇧ ~` Toggle Case & Mv Cursor to Next char
- `gu` to Lowercase
    - or `u` after selecting range
- `gU` to Uppercase
    - or `⇧ U` after selecting range
- `guu` | `gugu` Lowercase current line
- `gUU` | `gUgU` Lowercase current line

### Increase or Decrease Num

In Normal Mode

- `^ a` Increase Num
- `^ x` Decrease Num

### Column Mode

Example

1. In normal mode `^ v` then select a block area
2. `⇧ I` then type some string to insert
3. `⎋`, `⎋` ( Twice ) to apply the insertion at each line heading of the selected block area

## Files

- `gf` Open Path where cursor is

### Save & Quit

- `^ s` = `:w` Save ( valid in both Insert & Normal Mode )
- `⇧ ZZ` Save & Quit
- `⇧ ZQ` Quit without Saving

### Window

- `^w`, `n` = `:new<CR>` New Horizontal Split ( editing new empty buffer )
- `^w`, `s` = `:split<CR>` Split Window Horizontally ( editing current buffer )
- `^w`, `v` = `:vsplit<CR>` Split Window Vertically ( editing current buffer )
- `^w`, `c` = `:close<CR>` Close Window
- `^w`, `o` = `:only<CR>` Close All Windows But only the Current
- `^w`, `w` Go to Next window
- `^w`, `p` Go to Prev window
- `^w`, `↑` Go to window Above
- `^w`, `↓` Go to window Below
- `^w`, `←` Go to window on Left
- `^w`, `→` Go to window on Right

### Tab

- `:tabedit [path/to/file]<CR>` Open Existing File in New Tab
- `:edit [path/to/file]<CR>` Open Existing File in Current Tab
- `:tabnew<CR>` Open New Empty Tab
- `:tabc<CR>` Close Current Tab
- `:tabo<CR>` Close all Other Tabs But only the Current

Custom

- `,`, `t` = `:tabedit<space>`
- `,`, `e` = `:edit<space>`
- `L` = `gt` = `:tabn<CR>` Next Tab
- `H` = `gT` = `:tabp<CR>` Prev Tab
- `,`, `a` = `1gt` to Tab 1
- `,`, `s` = `2gt` to Tab 2
- … d f g h j k …
- `,`, `l` = `9gt` to Tab 9
- `,`, `;` = `10gt` to Tab 10
- `,`, `1` = `11gt` to Tab 11
- `,`, `2` = `12gt` to Tab 12
- …
- `,`, `9` = `19gt` to Tab 19
- `,`, `0` = `20gt` to Tab 20
- `,`, `W` = `:tabm<space>-1<CR>` Move Tab Left
- `,`, `E` = `:tabm<space>+1<CR>` Move Tab Right

## Advenced

### Repeat

- `.` Repeat Command
- `;` Repeat Movement : f / F / t / T

### Macro

- `q a~z|A~Z` Start Recording Macro marked as `a~z|A~Z`
- `q` Stop Recording
- `@ a~z|A~Z` Play Macro marked as `a~z|A~Z`
- `@@` Repeat Macro that you last used

### Search & Replace

- `:%s/search_str/replace_str/gci`
    - `:` switch to Command Mode
    - `%` find __each occurence__ of `search_str`
    - `s` replace operation
    - `g` replace __globally__
    - `c` ask for __confirmation__
    - `i` __case insensitive__ , `I` case __sensitive__
- `:s/foo/bar/`
    - On each line, **replace the first occurrence** of "foo" with "bar".
- `:'<,'>s/foo/bar/g`
    - `'<,'>` replace __within a visual selection__ (when compiled with +visual)
- `:5,12$/foo/bar/g`
    - `5` , `12` start from line 5 to the line 12
- `:.,$/foo/bar/g`
    - `.` , `$` start from the __current line__ to the __last line__
- `:.,+2s/foo/bar/g`
    - `.` , `+2` start from the current line to the __next two lines__
- `:'a,'bs/foo/bar/g`
    - `'a` , `'b` start from the __mark a__ to the __mark b__
- `:g/^baz/s/foo/bar/g`
    - Change each 'foo' to 'bar' in __each line starting with 'baz'__
- Reference : [__Search and replace__](http://vim.wikia.com/wiki/Search_and_replace) & [__Vim 字符串替换及小技巧__](http://xstarcd.github.io/wiki/vim/vim_replace_encodeing.html)

### Encoding Value

- `ga` Show ASCII of Char
- `g8` Goto UTF-8 of Char

### Toggle

Custom

- `,`, `h` = `:set noh<CR>` Deactivate Highlighted
- `,`, `n` = `:set nu!<CR>` Toggle Absolute Line Number
- `,`, `r` = `:set rnu!<CR>` Toggle Relative Line Number

### .vimrc

- Save all the current `:map` and `:set` settings to a file.
    - See `:help mkexrc` for details.

```bash
:mkvimrc
# or
:mkexrc
```
