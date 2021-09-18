# JetBrains Shortcuts

The shortcuts in other IDEs from JetBrains are same as IntelliJ IDEA,
such as CLion , PhpStorm , RubyMine , PyCharm and so on.

---

References

- [JetBrains](https://www.jetbrains.com)
    - [IntelliJ IDEA](https://www.jetbrains.com/idea)
    - [PhpStorm](https://www.jetbrains.com/phpstorm)
    - …

## Preferences

- Quick Guide: `IntelliJ IDEA` → `Help` → `Keymap Reference`
- Advance Settings: `IntelliJ IDEA` → `Preferences…` → `Keymap`

## Refactor

- `^ ⌥ t` Refactor This
- `^ ⌥ o` Optimize Imports
- `⌘ ⌥ l` Reformat Code
    - The rules for reformation can be modified in:
    - `Preferences` → `Editor` → `Code Style` → Select the programming language.
- `⌘ ⌥ e` Rename `$variableName`, `ClassName`, `functionName`
    - Auto rename other related code
- `⌘ ⌥ n` Inline Variable
- `⌘ ⌥ v` Extract Variable
- `⌘ ⌥ m` Extract Method
- `⌘ ⌥ f` Extract Field
- `⌘ ⌥ c` Extract Constant
- _`F5` Copy File_
- _`F6` Move File_

## Code

<!-- - _`^ 凵` Auto Complete_ -->

- **`⌘ /` Line Comment**
- _`⌘ ⌥ /` Block Comment_
- _`⌥ ↑` Extend Selection_
- _`⌥ ↓` Shrink Selection_
- **`⌥ ↩` Show Intention Actions**
- _`⌘ ⇧ ↩` Complete Current Statement_
- _`^ ⌥ h` Toggle Parameter Name_
- _`^ ⌘ g` Select All Occurrences_
- _`^ ⇧ I` Inspect Code_
- _`⌘ ⇧ V` Copy from History_

## Debug

- `^ ⇧ B` Toggle Line BreakPoint
- `^ ⇧ E` Edit BreakPoint ( Break if conditional is true)
- `^ ⇧ V` View BreakPoints
- `^ ⇧ W` Add to Watches
- `^ ⌥ w` Add to Watches
- `^ ⇧ R` Run…
- `^ ⇧ A` Rerun
- `^ ⇧ D` Debug
- `^ ⇧ S` Stop
- `^ ⇧ I` Step Into
- `^ ⇧ O` Step Out
- `^ ⇧ N` Resume Program ( Next BreakPoint )
- `^ ⇧ J` Step Over ( Next Line )

## File

- `⌘ ⇧ C` Copy Path
- `^ ⌥ r` Copy Reference ( `File:Line` | `Class::method()` )
- _`⇧ ↩` Open in a new Editor Window_ ( in Project View)

## Find

- `⌘ f` Find
- `⌘ ⇧ F` Find in Paths
- `⌘ r` Replace
- `⌘ ⇧ R` Replace in Paths
- `⌘ g` Find Next
- `⌘ ⇧ G` Find Prev
- `^ ⌥ g` Toggle Regex
- _`^ ⌥ c` Toggle Case Sensitive_
- `^ g` Find Usage
- `^ s` Find Complementation
- `⌘ o` Find Class
- `⌘ ⇧ O` Find File
- `⌘ ⌥ o` Find Symbols ( Class, Files, Methods, Functions )
- _`⇧, ⇧` Search (Everything) Everywhere_
- _`⌘ ⇧ A` Find Actions_

## Navigate

- `F2` Next Highlighted Error
- `⇧ F2` Prev Highlighted Error
- `⌥ F1` Select current file or symbol in any view
- `⌘ j` Next Method
- `⌘ k` Prev Method
- `⌘ e` Recent Files
- `⌘ ⇧ E` Recently Edited Files
- `⌘ ⇧ T` Test Subject: Jump to Test for current file | Create Test for it
- _`⌘ u` Super Class or Interface_
- _`⌘ ↑` Navigation Bar_
- `⌘ 1~9` Jump to the specified Tool Window | Hide it
- `⌘ 1` Project
- _`⌘ 2` Favorites ( Projects, Bookmarks, Breakpoints )_
- `⌘ 3` Find
- `⌘ 4` Debug
- …
- _`⌘ 9` Version Control_
- `^ m` Toggle Bookmark
- `^ ⌥ m` View Bookmarks
- `^ ⌥ j` Next Bookmark
- `^ ⌥ k` Prev Bookmark
- `⌘ 6` Todo
- `⌘ 7` Structure

VCS: History & Compare

- `^ ⌥ l` Local History -> Show History
- `^ ⌥ a` Git -> Annotate
- `^ ⌥ v` Git -> Compare with the Same Repository Version
- `^ ⌥ b` Git -> Compare with Branch …
- `^ ⌥ .` Git -> Compare with …
- `^ ⌥ c` Git -> Resolve Conflicts
- _`⌘ t` Update Porject from VCS_
- _`^ ⇧ C` Commit Project to VCS_
- _`⌘ ⌥ g` 'VCS' Operations Quick Popup_

## Tools

- `⌘ ^ h` Hide All Tool Windows
- `^ ⌥ q` Terminal
- _`^ ⌥ s` Test RESTful Web Service_
- `⌘ ⇧ ↑↓←→` Extend | Shrink Tool Window

## IdeaVim

IdeaVim: https://plugins.jetbrains.com/plugin/164?pr=idea

- It is the best Vim-Emulator plugin for IDEs from [JetBrains](https://www.jetbrains.com/).
- Its most keys are the same as Vim, so I just list my custom keys.
- My config file: [.ideavimrc](https://github.com/IceHe/macos-home-conf/blob/master/.ideavimrc)

### Ctags Like

- `^ ]` Find Declaration
- `^ t` Back from Declaration

### Tab

- `H` Prev Tab
- `L` Next Tab
- `,` Leader Key
- `,` `a` = `1gt`
- `,` `s` = `2gt`
- … d f g h j k …
- `,` `l` = `9gt`
- `,` `;` = `10gt`
- `,` `1` = `11gt`
- `,` `2` = `12gt`
- …
- `,` `9` = `19gt`
- `,` `0` = `20gt`

### Emacs

Mimic Emacs in Insert Mode:

- `^ b` = `←`
- `^ f` = `→`
- `^ p` Forward Word
- `^ n` Backward Word
- `^ a` = `Home`
- `^ e` = `End`
- `^ k` Del to End of Line
- `^ u` Del to Head of Line
- `^ t` Exchange Chars ( Before & After Cursor )

### Vim-Surround

- `ds*` Delete Surround
    - such as `ds'` `ds"` `ds[` `ds{` <code>ds\`</code> `dst` ( `t` for HTML Tag ) …
- `ys**` Add Surround:
    - 1st `*` for Postion ( Start or Stop )
    - 2rd `*` for Surround Char (or HTML Tag)
    - such as `yse'` `ysW"` `ysfb[` `ysTh{` …
- `cs**` Change Surround
    - 1st `*` for Current Surround Char
    - 2rd `*` for New Surround Char
    - such as `cs'"` `cs[{` `cst<p>`…

### Ace-Jump

- `^ ;`

### Others

- `^ r` = `:redo<CR>` Redo
- `⇧ K` = `Jx` Join curren line and next line without breaking concated spacing
