# macOS Emacs Built-in

* A few people know that it's supported in  by default in macOS.
* They may work, if you append some modifier keys to them.
* Reference : [Keyboard Shortcuts \( Emacs \) for Editing Text Fields in OS X](http://jblevins.org/log/kbd)

## Default

* `^ f` = `←`
* `^ b` = `→`
* `^ p` = `↑`
* `^ n` = `↓`
* `^ a` = `⌘ ←` Home
* `^ e` = `⌘ →` End
* `^ h` = `⌫` Del
* _`^ d` = `Fn ⌫` Forward Del_
* `^ k` Del to the End of the Line
* `^ t` Exchange the Charactors before & after the cursor
* `^ o` Insert a Blank Line `'\n'` after the cursor

They are also enabled by `Zsh` \( in `.zshrc` \) and `Vim` \( in `.vimrc` \) in iTerm 2 \( Terminal \).

## Advanced

Moreover modified by `Keyboard Maestro`

* `^ p` = `⌥ ←` Move to Prev Word _custom_
* `^ n` = `⌥ ←` Move to Next Word _custom_
* `^ w` = `⌥ ⌫` Del Preceding Word _custom_
* `^ u` = \[ `^ a`, `^ k` \] Del the Whole Line _custom_
* `^ j` = `↩` Return _custom_
* These modifications can be supported in `Karabiner-Elements` too.

