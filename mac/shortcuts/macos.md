# macOS

- Some are common & default in operating system.
- Some of the keys below can be modified in `System Preference → Keyboard`.
- Some are modified by Apps [Karabiner-Elements](#Karabiner-Elements) & [Keyboard Maestro](#Keyboard-Maestro).

## System

Power

- `` Wake Up
- `⌘ ⌥ ` Sleep
- `^ ⇧ ` Display Sleep
- `⌘ ^ q` Lock Screen
    - Display doesn't sleep
- `^ ` Shut Down
    - Then you can choose to Sleep or Restart in the prompt dialog box.
- _`⌘ ^ ` Force Restart_
- _`⌘ ^ ⌥ ` Force Shutdown_

Accessory

- `F1` Desktop <sup>_custom_</sup>
- `⌘ 凵` Spotlight
- _`⌥ ⇧ F` Search in All Files_ <sup>_custom_</sup>
- _`⌥ ⇧ ?` Show Help Menu_ <sup>_custom_</sup>

Dock & Menubar & Sidebar

- `F12` Open Notification Center <sup>_custom_</sup>
- `^ F12` Do Not Disturb On/Off <sup>_custom_</sup>
- `⌘ ⌥ d` Dock Hiding On/Off

Screenshot

- _`⌘ ⇧ 3` Capture Desktop_
- _`⌘ ⇧ 4` Capture the selected area_
    - The screenshots are saved in `~/Desktop`.

## Finder

File

- `⌘ ↓` Open
- `⌘ d` Duplicate
- `⌘ e` Eject Disk
- _`⌘ l` New Alias for a file_
- _`⌘ r` to Origin File of Alias_

Folder

- `⌘ ⇧ A` Application
- `⌘ ⇧ D` Desktop
- _`⌘ ⇧ F` All My Files_
- _`⌘ ⇧ G` to Folder_
- `⌘ ⇧ I` iCloud
- `⌘ ⇧ O` Documents
- `⌘ ⇧ R` AirDrop
- `⌘ ⌥ l` Downloads
- `⌘ ⇧ N` New Folder
- `⌘ ↑` to Parent Dir
- _`⌘ ^ ↑` Open Parent Dir in New Window_
- _`⌘ ⇧ C` Computer_
- _`⌘ ⇧ H` Home_
- _`⌘ ⇧ K` Network_
- _`⌘ ⇧ U` Utilities_

View

- `凵` Quick Look
- `⌘ i` Get Info
- `⌘ ⇧ .` Show Hidden Files
- `⌘  1` View the files in way of Icon
- `⌘  2` View as a List
- `⌘  3` View as columns
- `⌘  4` View as a cover flow
- `⌘ ⇧ ⌫` Empty Trash
- _`⌘ ⇧ ⌥ ⌫` Empty Trash without Confirmation_
- _`⌘ ⇧ P` Show | Hide Preview_
- _`⌘ ⌥ p` Show | Hide Path Bar_
- _`⌘ ⌥ s` Show | Hide Sidebar_
- _`⌘ ⌥ t` Show | Hide Tool Bar_
- _`⌘ /` Show | Hide Status Bar_

## File & Edit

File

- `⌘ n` New
- `⌘ o` Open
- `⌘ s` Save
- `⌘ p` Print
- `⌘ ⇧ S` Save as

Edit

- `⌘ z` Undo
- `⌘ ⇧ Z` Redo
- `⌘ a` Select All
- `⌘ c` Copy
- _`⌘ ⌥ c` Copy Path_
- `⌘ v` Paste
- `⌘ ⌥ v` Move ( After `⌘ c` )
- `⌘ f` Search
- `⌘ g` Next Match
- `⌘ ⇧ G` Prev Match
- `⌥ ←` Prev Word
- `⌥ →` Next Word
- After text selection, then input:
    - `⌘ b` Bold
    - `⌘ u` Underline
    - `⌘ i` Italic
    - `⌘ +` Bigger | Zoom In
    - `⌘ -` Smaller | Zoom Out

## Window & Tab

Window

- <code>⌘ \`</code> Switch windows of the current App
- It's enhanced by App [HyperSwitch](https://bahoom.com/hyperswitch) | [Keyboard Maestro](#Keyboard-Maestro)

Details

- `⌘ ^ f` Toggle Full Screen
- `⌘ ,` Preferences
- `⌘ q` Exit
- `⌘ w` Close
- `⌘ h` Hide
- `⌘ ⌥ h` Hide All Apps But the Front-most
    - The manipulation `Hide` is much better than `Minimize` in macOS!
    - So I prefer `Hide` to `Minimize`.
- _`⌘ m` Minimize to Dock_
- _`⌘ ⌥ m` Minimize All Windows of the Front-most App_

Tab

- `⌘ r` Refresh
- `⌘ t` New Tab
- `⌘ 0~9` Select Tab
    - If there are more than 9 tabs, `⌘ 9` will select the last one.
- `^ ⇥` Next Tab
- `^ ⇧ ⇥` Prev Tab
- `⌘ ⇥` Next App
- `⌘ ⇧ ⇥` Prev App
- `⌘ [` Backward
- `⌘ ]` Forward

## Input Sources

Select

- `⌥ 凵` Switch Input Sources <sup>custom</sup>
- `⌘ ^ 凵` Emoji & Symbols
- `⇪` Caps : Switch Chinese Input Source <sup>_custom_</sup>
- `⇧` Shf | `⎋` Esc : Press Shf or Esc to Switch English Input Source, when using Chinese input source <sup>_custom_</sup>
    - for the convenience of the Vim users when using Chinese input sources.

Pinyin - Simplified (macOS built-in)

- `[` Page Up
- `]` Page Down
- `⇥` Sort By
- `0~9` Select
- _`^ ⇧ 凵` Trackpad Handwriting_

Sogou Input <sup>__Now I use__</sup>

- Right `⇧` Switch to Smart English Input Mode (when using Chinese Input Mode)
- All else low-frequency shortcuts are disabled.

~~Baidu Input~~

- _`^ t` [ Simple | Traditional ] Chinese Characters_
- _`^ .` [ Chinese | English ] Punctuation Marks_
- _`⇧ 凵` [ 全角 | 半角 ] Punctuation Mark Types_
- _`^ p` [ 全拼 | 双拼 ] Chinese Input Modes_
- _`⌥ ⇧ B` Emoji & Symbols_
- _`⌥ ⇧ 凵` Add a space between Chinese & English_

## Emacs Mode

- A few people know that it's supported in  by default in macOS.
- They may work, if you append some modifier keys to them.

Default

- `^ f` = `←`
- `^ b` = `→`
- `^ p` = `↑`
- `^ n` = `↓`
- `^ a` = `⌘ ←` Home
- `^ e` = `⌘ →` End
- `^ h` = `⌫` Del
- _`^ d` = `Fn ⌫` Forward Del_
- `^ k` Del to the End of the Line
- `^ t` Exchange the Charactors before & after the cursor
- `^ o` Insert a Blank Line `'\n'` after the cursor

They are also enabled by `Zsh` ( in `.zshrc` ) and `Vim` ( in `.vimrc` ) in iTerm 2 ( Terminal ).

Moreover modified by `Keyboard Maestro`

- `^ p` = `⌥ ←` Move to Prev Word <sup>_custom_</sup>
- `^ n` = `⌥ ←` Move to Next Word <sup>_custom_</sup>
- `^ w` = `⌥ ⌫` Del Preceding Word <sup>_custom_</sup>
- `^ u` = [ `^ a`, `^ k` ] Del the Whole Line <sup>_custom_</sup>
- `^ j` = `↩` Return <sup>_custom_</sup>
- These modifications can be supported in `Karabiner-Elements` too.

Ref : [Keyboard Shortcuts ( Emacs ) for Editing Text Fields in OS X](http://jblevins.org/log/kbd)

## Activity Monitor

- `⌘ ⌥ f` Filter Processes
- `⌘ ⌥ q` Quit the selected Process

## Mail

- `⌘ ^ s` <sup>_custom_</sup> | `⌘ ⇧ N` <sup>default</sup> Get All New Mail
- `⌘ r` Reply
- `⌘ ⇧ r` Reply All
- `⌘ ⇧ f` Forward
- `⌘ ⇧ L` Red Flag_
- `⌘ ⌥ f` Mailbox Search
- _`⌘ 1` Inbox_
- _`⌘ 2` Sent_
- _`⌘ 3` Drafts_
