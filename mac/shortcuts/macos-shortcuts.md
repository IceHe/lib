# macOS Shortcuts

IceHe's macOS Shortcuts

---

- Some are common & default in operating system.
- Some of the keys below can be modified in `System Preference → Keyboard`.

## Common

### Accessory

- `⌘ 凵` Spotlight
- _`⌥ ⇧ ?` Show Help Menu_ <sup>_custom_</sup>
- `⌘ ⌥ d` _Dock Hiding On/Off_

### Window

- <code>⌘ \`</code> Switch windows of the current App
    - It's enhanced by App [HyperSwitch](https://bahoom.com/hyperswitch) | Keyboard Maestro
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

### Tab

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

### Screenshot

- _`⌘ ⇧ 3` Capture Desktop_
- _`⌘ ⇧ 4` Capture the selected area_
    - The screenshots are saved in `~/Desktop`

### Built-in Emacs

- A few people know that it's supported in  by default in macOS.
- They may work, if you append some modifier keys to them.
- Reference : [Keyboard Shortcuts ( Emacs ) for Editing Text Fields in OS X](http://jblevins.org/log/kbd)

#### Default

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

#### Advanced

Moreover modified by `Keyboard Maestro`

- `^ p` = `⌥ ←` Move to Prev Word <sup>_custom_</sup>
- `^ n` = `⌥ ←` Move to Next Word <sup>_custom_</sup>
- `^ w` = `⌥ ⌫` Del Preceding Word <sup>_custom_</sup>
- `^ u` = [ `^ a`, `^ k` ] Del the Whole Line <sup>_custom_</sup>
- `^ j` = `↩` Return <sup>_custom_</sup>
- These modifications can be supported in `Karabiner-Elements` too.

## Editor

### Editor - File

- `⌘ n` New
- `⌘ o` Open
- `⌘ s` Save
- `⌘ p` Print
- `⌘ ⇧ S` Save as

### Editor - Edit

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

## Finder

### Finder - File

- `⌘ ↓` Open
- `⌘ d` Duplicate
- `⌘ e` Eject Disk
- _`⌘ l` New Alias for a file_
- _`⌘ r` to Origin File of Alias_

### Finder - Folder

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

### Finder - View

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
