# tmux

> terminal multiplexer

- Home : https://tmux.github.io/
- Manual : http://man.openbsd.org/OpenBSD-current/man1/tmux.1
- My config file : [.tmux.conf](https://github.com/IceHe/mac-conf/blob/master/.tmux.conf)

## Shortcuts

`^ q` Prefix Key ( aka `Pf` )

- The description `Pf, *` implies that tap `Pf` at first and then tap the key `*`.
- `Pf, ⇧ ?` List Keys
- `Pf, d` Detach Client
- `Pf, c` New Window
- `Pf, s` Reload config file `.tmux.conf`
- `Pf, \` Split Window Horizontally
- `Pf, -` Split Window Vertically
- `Pf, ^ y` Resize Pane Lf
- `Pf, ^ u` Resize Pane Dn
- `Pf, ^ i` Resize Pane Up
- `Pf, ^ o` Resize Pane Rg
- `Pf, h` Select Lf Pane
- `Pf, j` Select Dn Pane
- `Pf, k` Select Up Pane
- `Pf, l` Select Rg Pane
- `Pf, ↑` Maximize Current Pane in New Window
- `Pf, ↓` Put Current Pane back to its Parent Window
- `Pf, [` Use Vim-like keys to copy str at Copy Mode

In Copy Mode:

- `v` Begin Selection
- `y` Copy Selection
- `u` Copy Selection & Exit Copy Mode
- `⇧ L` Copy Line ( & Exit Copy Mode )
