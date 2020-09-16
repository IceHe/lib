# Karabiner-Elements

> Changes not only the shortcuts but also the keyboard key-remappings!

* [https://pqrs.org/osx/karabiner/index.html](https://pqrs.org/osx/karabiner/index.html)\)

## Remappings

### Common

Quit

* `⌘ q, ⌘ q` Double tap `⌘ q` to send one real keystroke `⌘ q`

Prefix Key `⌥ ⇥`

* It's used to prevent you from launching the unwanted App when pressing its shortcut by accident.
* Only when you pressed Pf Key at first and then the App shortcut, did it launch.

Change Modifier-Key-Remapping

* `⌘` Rg Cmd →  `⎋` Esc
* `⇪` Caps → `^` Lf Ctrl
* `^` Lf Ctrl → `⇪` Caps

Functional Keys

* `Functional Keys` → `F1` ~ `F12`
* `Fn + Functional Keys` → `Functional Keys`

### Input Sources

\( abbr : IS \)

`⇪` Caps \( current pos is Lf `^` \) → to Chinese Input Source

* How to implement:
  * App `Karabiner-Elements` : `⇪` Caps → `F19`
  * App `Keyboard Maestro` : `F19` → to Chinese IS \( [Ref](https://sspai.com/post/37962) \)

`⇧` Shf \| `⎋` Esc → English Input Source

* Press Shf or Esc alone to switch English IS, when using Chinese IS.
  * \( for the convenience of the Vim users when using Chinese IS. \)
* How to implement:
  * App `Karabiner` : Press Lf Rg `⇧`, Rg `⌘`, `⎋` alone will trigger `F18`
  * App `Keyboard Maestro` : `F18` → to US English IS

#### Switch Stably

> How to switch two input sources stably?

Requirements

* There must be only two active ISs on macOS.
* Keyboard Maestro \( abbr : KM \) gets current input source via shell command `inputsource` \( [Ref](https://github.com/hnakamur/inputsource) \).

Because

* I cannot find a stable method to switch IS if more than 2 ISs exist on macOS.
* Stable : Your operation always work. &gt;99%

For example, press `⇪` Caps \( current pos is Lf `^` \) :

* if result of command `inputsource` does not match `com.baidu.inputmethod.BaiduIM.pinyin`,
* KM will trigger keystroke `⌥ 凵` to switch to IS Baidu Input or else.

Press `⇧` Shf or `⎋` Esc alone when using Chinese Input :

* if result of command `inputsource` does not matches `com.apple.keylayout.US`,
* KM will trigger keystroke `⌥ 凵` to switch to IS English Layout or else.

