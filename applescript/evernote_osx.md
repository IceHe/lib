title: AppleScript 操作 Evernote 与 macOS
date: 2016-03-13
updated: 2016-09-22
categories: [AppleScript]
tags: [AppleScript]
description: AppleScript Advanced&#58; 检查控制 Wifi、蓝牙、硬盘、键盘输入，执行命令，操纵其它 App 等：如 Evernote 笔记的同步、检索、编辑、复制、删除、导入导出、重命名、移动笔记本、加标签…
-----------------------------------------------------------------------

- I supposed that you have learned AppleScript, so I will not introduce it in detail.
- You can learn AppleScript in practice or my [AppleScript Quick Start 快速入门](/applescript/applescript/).

# References

- [AppleScript Quick Start 快速入门](/applescript/applescript/) - My Blog Article
- [AppleScript Fundamentals](https://developer.apple.com/library/mac/documentation/AppleScript/Conceptual/AppleScriptLangGuide/conceptual/ASLR_fundamentals.html) - Apple Official Docs
- [Mac Wrangle Evernote with AppleScript](https://dev.evernote.com/doc/articles/applescript.php) / [通过 AppleScript 连接印象笔记](https://dev.yinxiang.com/doc/articles/applescript.php) - Evernote Official Docs
- [Evernote Search Grammar](https://dev.evernote.com/doc/articles/search_grammar.php) / [搜索语法](https://dev.yinxiang.com/doc/articles/search_grammar.php) - How to Search Notes
- __App's AppleScript Dictionary :__ Open App `Script Editor` → &nbsp;Enter `⌘ ⇧ o` → &nbsp;Choose `app_name.app` (if it supports AppleScript)
    __Evernote Dictionary :__ … → Choose `Evernote.app`
- My Github Repos:
    1. [AppleScript_for_Evernote](https://github.com/IceHe/AppleScript_for_Evernote)
    2. [AppleScript_for_me](https://github.com/IceHe/AppleScript_for_me)

# Evernote
---

- I just list the code that I use most frequently.
- If you want further use of manipulating Evernote by AppleScript, you can read the official documentations from [Apple and Evernote](/applescript/evernote/#References) and use other programming language to cooperate with AppleScript.
- There is only some sample code, so it cannot run successfully in this order.
But you can learn how to manipulate Evernote with AppleScript from it.<br/><br/>

## Evernote

- Launch, Sync, Wait, Quit

``` applescript
-- Launch Evernote
tell application "Evernote" to launch

-- Quit Evernote
tell application "Evernote" to quit

-- Wait for Synchronizing
if application "Evernote" is running then
    tell application "Evernote"

        -- Synchronize Evernote
        synchronize

        repeat with i from 0 to 300

            -- Is Evernote synchronizing or not?
            if not isSynchronizing then
                return i
            end if

            delay 0.01
        end repeat
    end tell
end if
```

## Notebook

- Exist, Create, Rename, Delete

``` applescript
tell application "Evernote"
    set notebook_name to "nb_1"

    -- Get Notebook
    notebook notebook_name
    -- The above is usually equal to the below.
    notebook named notebook_name
    -- But it's more clear when the keyword `notebook` with `named`.

    -- Notebook exists or not?
    notebook named notebook_name exists

    -- Create Notebook
    if not (notebook named notebook_name) exists then
        create notebook notebook_name
    end if

    -- Rename Notebook
    set new_notebook_name to "nb_2"
    if ((exists (notebook named notebook_name)) and not (exists (notebook named new_notebook_name))) then
        set name of (notebook named notebook_name) to new_notebook_name
    end if

    -- Delete notebook
    if (notebook named notebook_name) exists then

        -- Need confirmation
        set dialogReply to display alert ¬
            "Warning!" message ("Notebook named {" & notebook_name & "}") ¬
            as warning ¬
            buttons {"Cancel", "Delete"} ¬
            default button 1 ¬
            giving up after 9

        -- Get the Result of the Dialog
        if "Delete" = (button returned of result) then

            -- Delete notebook
            delete (notebook named notebook_name)

        end if
    end if

end tell
```

## Note

- Exist, Find, Create, Import, Export, Read, Rename, Move, Delete

``` applescript
tell application "Evernote"
    set notebook_name to "nb_1"
    set enex_path to "path_1" # as Unix dir path
    if (notebook named notebook_name) exists then

        -- Import Note
        import (enex_path as POSIX file) to notebook_name

    end if

    -- Find Notes (by a search expression)
    -- `find notes "search_expr"` returns a list that contains one or more notes.
    set note_found to find notes "intitle:\"" & note_name & "\""
    -- Search Grammar: https://dev.evernote.com/doc/articles/search_grammar.php

    -- Make sure that only one note specified by the search expression was found.
    -- Just manipulate the specified one for avoiding misoperations.
    if (count of note_found) = 1 then

        -- Read Note (as HTML)
        set html_cont to HTML content of (item 1 of note_found)

        -- Append Note (with plain text)
        append (item 1 of note_found) text text_append

        -- Export Note (as HTML)
        set html_path to "html_path"
        export note_found to (POSIX file html_path) format HTML

        -- Export Note (as ENEX)
        export note_found to (POSIX file enex_path)

        -- Move Notes
        set note_found to find notes "intitle:\"notebook_name\""
        repeat with each_note in note_found
            move each_note to notebook named "another_notebook_name"
        end repeat

        -- Delete Note
        delete item 1 of note_found

    end if

    set new_note_name to "note_b"
    set note_found to find notes "intitle:\"" & note_name & "\""

    if (note_name ≠ new_note_name) and (count of note_found) = 1 then

        -- Rename Note
        set title of item 1 of note_found to new_note_name

    end if
end tell
```

- Simplify Formating

``` applescript
tell application "Evernote"

    set t_note to (find notes ("intitle:\"" & note_name & "\""))
    set t_note to item 1 of t_note

    set note_win to open note window with t_note

    -- Wait for OS to react
    delay 0.2

    activate note_win

    -- Use "System Events" to imitate user's manipulation
    tell application "System Events"

        -- Put Cursor into Text Editor
        key code 48
        delay 0.1
        key code 48
        delay 0.1

        -- Select All
        keystroke "a" using command down
        delay 0.2

        -- Simplify Formatting
        keystroke "f" using {command down, shift down}
        delay 0.4

        -- Save
        keystroke "s" using command down
        delay 0.8

    end tell

    close note_win

end tell
```

- Write Note content to Clipboard

``` applescript
tell application "Evernote"

    set t_note to (find notes ("intitle:\"" & note_name & "\""))
    set t_note to item 1 of t_note

    set note_win to open note window with t_note
    activate note_win

end tell

-- Use "System Events" to imitate user's manipulation
tell application "System Events"
    delay 0.1

    -- Put Cursor into Text Editor
    key code 48
    delay 0.1
    key code 48
    delay 0.1

    -- Select All
    keystroke "a" using command down
    delay 0.2

    -- Copy Text to the Clipment
    keystroke "c" using command down
    delay 0.2

end tell

tell application "Evernote"
    close note_win
end tell

return the clipboard
```

# macOS

If your Mac does not have some commands as mentioned below, you can install them through `Homebrew`.

## Is Mac on AC Power?

``` applescript
set is_ac_power to do shell script "pmset -g batt | grep -q 'AC Power' && echo 1 || echo 0"

return ("1" = is_ac_power)
```

## Is application running?

``` applescript
set app_name to "app_x"

tell application "System Events"
    return (name of processes) contains app_name
end tell
```

## Is application on Dock?

``` applescript
set app_name to "app_x"

tell application "System Events"
    tell process "Dock"
        tell list 1

            try
                set dockItemTest to UI element app_name -- test if the application is in the Dock
            on error
                return false
            end try

            click UI element app_name -- Optional: Click it on Dock (Active the app)

            return true
        end tell
    end tell
end tell
```

## Is network available?

``` applescript
repeat with i from 1 to 5

    try
        do shell script "ping -c 4 baidu.com"
        exit repeat

    on error

        delay 0.2
        if i = 5 then return false

    end try

end repeat

return true
```

## Switch Wi-fi

You need to show Wi-Fi status in menu bar:
`System Preferences` → `Network` → Check `Show Wi-Fi status in menu bar`.

``` applescript
set flag to true

tell application "System Events" to tell process "SystemUIServer"

    set wifi_menu to (first menu bar item whose description contains "Wi-Fi") of menu bar 1
    try
        if flag = true then

            if description of wifi_menu contains "not enabled" then
                do shell script "networksetup -setairportpower en0 on"
            end if

        else if flag = false then

            if not (description of wifi_menu contains "not enabled") then
                do shell script "networksetup -setairportpower en0 off"
            end if

        else
            return "error"
        end if
    end try

end tell

return true
```

## Is Bluetooth ON?

You need to install the command `blueutil` (through `Homebrew`).

``` applescript
set is_bluetooth_on to do shell script "/usr/local/bin/blueutil power"

return ("1" = is_bluetooth_on)
```

## Swith Bluetooth

``` applescript
set flag to true

tell application "System Preferences"
    reveal pane id "com.apple.preferences.Bluetooth"
    delay 0.1

    tell application "System Events" to tell process "System Preferences"
        set bluetooth_switch to button 3 of window 1

        if flag = true then
            if "Turn Bluetooth Off" ≠ name of bluetooth_switch then
                click bluetooth_switch
            end if

        else if flag = false then
            if "Turn Bluetooth Off" = name of bluetooth_switch then
                click bluetooth_switch
            end if

        else
            return "error"
        end if

    end tell
    delay 0.1
    quit

end tell

return true
```

## Input Key Code / Keystroke

``` applescript
set app_name to "app_1"
set key_code to "key_1"
set using_btn to "btn_1"

tell application "System Events" to tell process app_name

    delay 0.3 # we have to wait for a while to make keystroke successful
    key code key_code using using_btn

end tell
```

``` applescript
set app_name to "app_1"
set key_char to "key_1"
set using_btn to "btn_1"

tell application "System Events" to tell process app_name

    delay 0.3 # we have to wait for a while to make keystroke successful
    keystroke key_char using using_btn

end tell
```

## Eject Disks

``` applescript
tell application "Finder"

    -- Specify a disk to eject
    set diskName to "IceHe_OSX_Bak"

    -- Check disk existence
    try
        disk diskName
    on error
        display alert ("Disk '" & diskName & "' does Not Exist!")
        return
    end try

    -- Eject specified one
    eject disk diskName

    -- Check & display operation result
    try
        disk diskName
        display alert "FAIL to eject disk '" & diskName & "'!"
    on error
        display alert "SUC to eject disk '" & diskName & "'!"
    end try


    -- Eject all disks
    eject the disks
    display dialog "Successfully ejected disks." buttons {"Close"} default button "Close"

end tell
```

## Execute Commands in iTerm

The version of iTerm is beta 3.0.

``` applescript
set cmds to {"cmd_1", "cmd_2", "cmd_3"}

set isOpenAlready to application "iTerm" is running

-- 启动终端，然后执行命令行
tell application "iTerm"

    activate

    -- macOS 下有可能：iTerm 在脚本执行前已经运行，但还没窗口
    set without_win to 0 = (count of windows)
    if without_win then
        create window with default profile
    end if


    tell current window

        -- iTerm 在脚本执行前已经运行，且也有窗口时，
        -- 新建一个 tab，避免影响其它 tab 的作业状态。
        if isOpenAlready and not without_win then
            create tab with default profile
        end if

        tell current session
            repeat with cmd in cmds
                write text cmd
            end repeat
        end tell

    end tell

end tell
```

## Get local IP address

``` applescript
-- Physical: 物理网口的 IP
set cur_ip to do shell script "/sbin/ifconfig en7|grep inet|grep -v 127.0.0.1|grep -v inet6|awk '{print $2}'|tr -d 'addr:'"

if cur_ip = "" then
    -- Wireless: 无线网络的 IP
    set cur_ip to do shell script "/sbin/ifconfig en0|grep inet|grep -v 127.0.0.1|grep -v inet6|awk '{print $2}'|tr -d 'addr:'"
end if

if cur_ip = "" then
    -- All: 全部网络的 IP
    set cur_ip to do shell script "/sbin/ifconfig -a|grep inet|grep -v 127.0.0.1|grep -v inet6|awk '{print $2}'|tr -d 'addr:'"
end if

if cur_ip ≠ "" then
    -- Copy the IP address to the macOS clipboard
    do shell script "echo '" & cur_ip & "' | tr -d \"\\n\" | pbcopy"

    display alert "IP: " & cur_ip
end if
```

## Startup Tasks

``` applescript
on run argv

    if script = class of argv then
        set is_startup to true
    else
        set is_startup to (item 1 of argv)
    end if

    -- Append the records to the list
    set apps to {}
    set apps to apps & {{name:"iStat Menus", ac_power:true}} # Slow
    set apps to apps & {{name:"Moom", ac_power:true}}
    set apps to apps & {{name:"ClipMenu", ac_power:true}}
    set apps to apps & {{name:"Bartender 2", ac_power:true}}
    set apps to apps & {{name:"HyperDock Helper", ac_power:true}}
    set apps to apps & {{name:"Amphetamine", ac_power:true}}
    set apps to apps & {{name:"Flux", ac_power:true}}
    set apps to apps & {{name:"HazeOver", ac_power:true}}
    set apps to apps & {{name:"ShadowsocksX", online:true}}
    set apps to apps & {{name:"Firefox", ac_power:true, online:true}} # Slow
    set apps to apps & {{name:"iHosts", ac_power:true, online:true}}
    set apps to apps & {{name:"Evernote", ac_power:true, online:true}}

    set is_ac_power to run script (POSIX file "/Users/IceHe/Documents/AppleScript/Lib/is_ac_power.scpt")
    set is_online to run script (POSIX file "/Users/IceHe/Documents/AppleScript/Lib/is_network_available.scpt")

    repeat with each_app in apps
        set is_allowed to true

        try
            if (online of each_app) ≠ is_online then
                set is_allowed to false
            end if
        on error -- -1728: undefined field 'online'
            -- do nothing
        end try

        try
            if (ac_power of each_app) ≠ is_ac_power then
                set is_allowed to false
            end if
        on error -- -1728: undefined field 'ac_power'
            -- do nothing
        end try

        if is_startup then
            if is_allowed and not (run script (POSIX file "/Users/IceHe/Documents/AppleScript/Lib/is_app_running.scpt") with parameters {name of each_app}) then
                tell application (name of each_app) to launch
            end if

        else
            if not is_allowed and (run script (POSIX file "/Users/IceHe/Documents/AppleScript/Lib/is_app_running.scpt") with parameters {name of each_app}) then
                tell application (name of each_app) to quit
            end if
        end if
    end repeat

    -- Romove iStatMenus from Dock
    if is_startup then
        set target_app to "iStat Menus"

        if (run script (POSIX file "/Users/IceHe/Documents/AppleScript/Lib/is_app_running.scpt") with parameters target_app) and (run script (POSIX file "/Users/IceHe/Documents/AppleScript/Lib/is_app_on_dock.scpt") with parameters target_app) then
            tell application target_app to quit
        end if
    end if

end run
```
