## Development

### iTerm2

[Official Reference](https://www.iterm2.com/)

- Due to the help from `tmux` and `Zsh`, I don't need much support from `iTerm` as follows.
- `⌘ 0~9` Switch Tab

### PhpStorm

[Official Reference](https://www.jetbrains.com/phpstorm/)

References

- Quick Guide : `PhpStorm` → `Help` → `Keymap Reference`
- Advance Settings : `PhpStorm` → `Preferences…` → `Keymap`

Refactor

- `^ ⌥ t` Refactor This
- `^ ⌥ o` Optimize Imports
- `⌘ ⌥ l` Reformat Code
    - The rules for reformation can be modified in :
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

Code

- _`^ 凵` Auto Complete_
- `⌘ /` Line Comment
- _`⌘ ⌥ /` Block Comment_
- _`⌥ ↑` Extend Selection_
- _`⌥ ↓` Shrink Selection_
- `⌥ ↩` Show Intention Actions
- _`⌘ ⇧ ↩` Complete Current Statement_
- _`^ ⌥ h` Toggle Parameter Name_
- _`^ ⌘ g` Select All Occurrences_
- _`^ ⇧ I` Inspect Code_
- _`⌘ ⇧ V` Copy from History_

Debug

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

File

- `⌘ ⇧ C` Copy Path
- `^ ⌥ r` Copy Reference ( `File:Line` | `Class::method()` )
- _`⇧ ↩` Open in a new Editor Window_ ( in Project View)

Find

- `⌘ f` Find
- `⌘ ⇧ F` Find in Paths
- `⌘ r` Replace
- `⌘ ⇧ R` Replace in Paths
- `⌘ g` Find Next
- `⌘ ⇧ G` Find Prev
- `^ ⌥ g` Toggle Regex
- _`^ ⌥ c` Toggle Case Sensitive_
- `^ g` Find Usage
- `⌘ o` Find Class
- `⌘ ⇧ O` Find File
- `⌘ ⌥ o` Find Symbols ( Class, Files, Methods, Functions )
- _`⇧, ⇧` Search (Everything) Everywhere_
- _`⌘ ⇧ A` Find Actions_

Navigate

- `F2` Next Highlighted Error
- `⇧ F2` Prev Highlighted Error
- `⌥ F1` Select current file or symbol in any view
- `⌘ j` Next Method
- `⌘ k` Prev Method
- `⌘ e` Recent Files
- `⌘ ⇧ E` Recently Edited Files
- `⌘ ⇧ T` Test Subject : Jump to Test for current file | Create Test for it
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

Tools

- `⌘ ^ h` Hide All Tool Windows
- _`^ ⌥ q` Terminal_
- _`^ ⌥ s` Test RESTful Web Service_
- `⌘ ⇧ ↑↓←→` Extend | Shrink Tool Window

#### IdeaVim

[Official Reference](https://plugins.jetbrains.com/plugin/164?pr=idea)

- It is the best Vim-Emulator plugin for IDEs from [JetBrains](https://www.jetbrains.com/).
- Its most keys are the same as Vim, so I just list my custom keys.
- My config file [__.ideavimrc__](https://github.com/IceHe/mac-conf/blob/master/.ideavimrc)

Ctags Like

- `^ ]` Find Declaration
- `^ t` Back from Declaration

Tab

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

Vim-Surround

- `ds*` Delete Surround
    - such as `ds'` `ds"` `ds[` `ds{` <code>ds\`</code> `dst` ( `t` for HTML Tag ) …
- `ys**` Add Surround :
    - 1st `*` for Postion ( Start or Stop )
    - 2rd `*` for Surround Char (or HTML Tag)
    - such as `yse'` `ysW"` `ysfb[` `ysTh{` …
- `cs**` Change Surround
    - 1st `*` for Current Surround Char
    - 2rd `*` for New Surround Char
    - such as `cs'"` `cs[{` `cst<p>`…

Others

- `^ r` = `:redo<CR>` Redo
- `⇧ K` = `Jx` Join curren line and next line without breaking concated spacing

#### JetBrains

[Official Reference](https://www.jetbrains.com/)

- The shortcuts in other IDEs from JetBrains are same as PhpStorm,
- such as CLion , IntelliJ IDEA , RubyMine , PyCharm and so on.
- All the shortcuts can be modified in `Preferences` → `Keymap`!

### Sublime Text

[Official Reference](https://www.sublimetext.com/)

Cursor Position

- `^ i` Jump Forward
- `^ o` Jump Backword

Find & Replace

- `⌘ f` Find
- `⌥ ↩` Find All
- `⌘ r` Find Files
- `⌘ ⌥ f` Replace
- `⌘ ⌥ e` Replace one by one
- `^ ⌥ ↩` Replace All
- `⌘ ⌥ r` Toggle Regular Expression
- `⌘ ⌥ c` Toggle Case Sensitive

Selection

- `⌘ d` Expand Selection to Word
- `^ ⇧ M` Expand Selection to Brackets
- `⌘ ⇧ L` Split into Lines
- _`^ l` Scroll to the Selection_

Bookmarks

- `⌘ F2` Toggle Bookmark
- `F2` Next Bookmark
- `⇧ F2` Prev Bookmark
- `⌘ ⇧ F2` Clear All Bookmarks

Layout

- `⌘ ⌥ 1~4` 1~4 Columns
- _`⌘ ⌥ 5` Grid_
- _`⌘ ⌥ ⇧ 2~3` 2~3 Rows_

Command Palette…

- `⌘ p` Quick Open File
- `⌘ ⇧ P` Command Palette…
- `⌘ ⇧ C` Copy File Path
- `^ s` Trim Trailing Whitespace

Sidebar

- `⌘ k` `⌘ b` Toggle Sidebar

### Charles

[Official Reference](https://www.charlesproxy.com/)

Proxy

- `⌘ r` [ Start | Stop ] Recording
- _`⌘ t` Start | Stop Throttling_
- _`⌘ k` Enable | Disable Breakpoints_
- _`⌘ ⇧ t` Throttle Settings_
- _`⌘ ⇧ k` Breakpoint Settings_
- _`⌘ ⇧ p` macOS Proxy_

Session

- `⌘ ⌫` Clear
- _`⌘ o` Open_
- _`⌘ n` New_
- _`⌘ s` Save Request_
- _`⌘ ⇧ s` Save As …_
- _`⌘ l` Error Log_

View

- `⌘ 1` Overview
- `⌘ 2` Request
- `⌘ 3` Response
- _`⌘ 0` Sequence_
- _`⌘ 9` Structure_
- _`⌘ ⇧ H` Focused Hosts_
- _`⌘ 4` Summary_
- _`⌘ 5` Chart_
- _`⌘ 6` Note_
- _`⌘ ⇧ V` Viewer Mappings_

Tools

- `⌘ ⇧ R` Repeat
- `⌘ ⇧ D` DNS Spoofing Settings <sup>_custom_</sup>
- `⌘ ⌥ m` Map Remote
- `⌘ m` Compose ( Modify )
- _`⌘ ⇧ M` Compose New_
- _`⌘ ⌥ l` Map Local_
- _`⌘ ⌥ d` No Caching_
- _`⌘ ⌥ c` Block Cookies_
- _`⌘ ⌥ r` Rewrite_
- _`⌘ ⌥ b` Black List_
- _`⌘ ⌥ w` White List_
- _`⌘ ⌥ i` Mirror_
- _`⌘ ⌥ a` Rewrite_

### Script Editor

- `⌘ ⇧ O` Open Dictionary
- `⌘ r` Run the script
- `⌘ .` Stop the script
