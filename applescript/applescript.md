title: AppleScript 快速入门
date: 2016-03-11
updated: 2016-03-13
noupdate: true
categories: [AppleScript]
tags: [AppleScript]
description: AppleScript Quick Start&#58; 在有编程基础的情况下，通过快速浏览示例代码，即可熟悉语法，快速入门。
-----------------------------------------------------------

# References

- [AppleScript Fundamentals](https://developer.apple.com/library/mac/documentation/AppleScript/Conceptual/AppleScriptLangGuide/conceptual/ASLR_fundamentals.html) - Apple Official Docs
- __App's AppleScript Dictionary :__
    Open App `Script Editor` → &nbsp;Enter `⌘ ⇧ o` → &nbsp;Choose `app_name.app` (if it supports AppleScript)
- My Github Repos:
    1. [AppleScript_for_Evernote](https://github.com/IceHe/AppleScript_for_Evernote)
    2. [AppleScript_for_me](https://github.com/IceHe/AppleScript_for_me)

# Fundamentals

- Export `*.scpt` as a runable Application（导出为可运行程序）:
    Menu Bar `File` → `Export` → Choose Format `Application` → Click `Save`

``` applescript
-- Comment

    -- line comment
    # line comment
    (*
        block comment
        ...
    *)
```

## Types

Types and their related operations.

``` applescript
-- String

    "string"
    # The string must not be surrounded with single quotes!
    # It's wrong like this 'string'.

-- Join String

    "abc" & "123"  # "abc123"


-- List

    {1, 7, "Beethoven", 4.5}
    {}  # Empty List

-- Length of List

    set a_list to {"foo", "bar"}
    count of a_list  # 2

-- Get a item from a list

    # item <number> of <list>
    item 1 of a_list  # "foo"


-- Record

    {product:"pen", price:1.45}
    product of rec  # "pen"

-- Number

    123  # integer
    -94596  # negative integer
    3.1415  # real
    9.9999999999E+10  # scientific

-- Class & Other Objects

    # Ommited

```

## Basic Operations

``` applescript
-- Assign Variable

    set myName to "John"
    copy 33 to myAge

-- Reference

    a ref to something
    ref to something

-- & Operator

    # It can be used on Text, Class, Object...
    "hello" & ", " & "world"  # Text

-- as Operator

    # Converts, or coerces, a value of one class to a value of another class.
    123 as string  # "123"
    "45" as integer  # "45"
    "/Users/IceHe/.vimrc" as POSIX file  # file

    # integer, string or real
    set num to "12306" as integer

-- Calculate

    1 + 2  # 3
    2 - 3  # -1
    3 * 4.5  # 9.0  # real
    3 / 6  # 0.5

    2 ^ 3  # 8.0  # 2 to the power of 3
    9 div 4  # 2  # Divide Exactly
    9 mod 4  # 1  # Remainer


-- 获取变量的类型

    class of <variable_name>
    class in <variable_name>

    # 包括 integer、real、text等

-- 逻辑运算

    not variable
    class of variable
```

### Date

Src Code :
``` applescript
set today to current date
log today

log year of today
log month of today
log day of today
log time of today

log date string of today
log time string of today
log short date string of today

set year of today to 2008
set month of today to 12
set day of today to 24
set time of today to 3 * hours + 12 * minutes + 12
—- hours & minutes & days & months & years are built-in
log today

set curDate to current date
set doomDate to date "Friday, December 21, 2012 at 06:00:00"
set btwDate to curDate - doomDate

log doomDate
log btwDate

set y to btwDate div (days * 365)
set d to (btwDate - y * 365 * days) div days
set h to (btwDate - y * 365 * days - d * days) div hours
set m to (btwDate - y * 365 * days - d * days - h * hours) div minutes
set s to (btwDate - y * 365 * days - d * days - h * hours - m * minutes)

log "Countdown:" & y & " " & m & " " & d & " " & h & ":" & m & ":" & s
```

Result :
``` applescript
(*date Saturday, September 19, 2015 at 16:50:34*)
(*2015*)
(*September*)
(*19*)
(*60634*)

(*Saturday, September 19, 2015*)
(*16:50:34*)
(*9/19/15*)
(*date Wednesday, December 24, 2008 at 03:12:12*)

(*date Friday, December 21, 2012 at 06:00:00*)
(*86613240*)
(*Countdown: 2years 14months 272days 11:14:0*)
```

## Conditional

``` applescript
-- contains, is contained by

    { "this", "is", 1 + 1, "cool" } contains { "is", 2 }  # true
    { "this", "is", 2, "cool" } contains 2  # true
    2 is contained by { "this", "is", 2, "cool" }  # true

-- equal to

    ("1" as integer) is equal to 1  # true
    ("1" as integer) is not equal to 1  # false

    # Same as = and ≠
    1 = 1  # true
    1 ≠ 1  # false

-- greater than, less than

    3 is greater than 1  # true
    2 is less than 1  # false

    # Same as > and <
    3 > 1  # true
    2 < 1  # false

-- starts with, ends with

    # Work with text objects and lists.

    "icehe" starts with "ice"  # true
    "icehe" ends with "he"  # true

    {"foo", "bar"} starts with "foo"  # true
    {"foo", "bar"} ends with "bar"  # true
```

## Control Statements

``` applescript
-- Conditional 逻辑语句

    # if <expr> then
    #     ...
    # else if <expr> then
    #     ...
    # else
    #     ...
    # end if

    display alert "Hello, world!" buttons {"Rudely decline", "Happily accept"}
    set theAnswer to button returned of the result

    if theAnswer is "Rudely decline" then
        beep 5
    else if theAnswer is "Happily accept" then
        say "Hello."
    else
        say "Piffle!"
    end if

-- Loop 循环语句

    # Repeat forever
    repeat
         -- commands to be repeated
    end repeat

    # Repeat a given number of times
    repeat 10 times
         -- commands to be repeated
    end repeat

-- Conditional Loop

    set x to 5
    repeat while x > 0
        set x to x - 1
    end repeat

    set x to 5
    repeat until x ≤ 0
        set x to x - 1
    end repeat

    # Loop with variable
    repeat with i from 1 to 2000
         -- commands to be repeated
    end repeat

    # Enumerate a list
    set total to 0
    repeat with x in {1, 2, 3, 4, 5}
        set total to total + x
    end repeat


-- Tell 命令块

    tell application "Finder"
        quit
    end tell


    # or express in one line

    tell application "Microsoft Word" to quit


    # For events in the "Core Suite",
    # (activate, open, reopen, close, print, and quit)
    # the application may be supplied as the direct object to transitive commands:

    quit application "Microsoft Word"


    # The concept of an object hierarchy can be expressed using nested blocks:

    tell application "QuarkXPress"
        tell document 1
            tell page 2
                tell text box 1
                    set word 5 to "Apple"
                end tell
            end tell
        end tell
    end tell


    # It can also be expressed using nested prepositional phrases:

    pixel 7 of row 3 of TIFF image "my bitmap"


-- Handler

    on func_name(params...)
         -- subroutine commands
    end func_name

    on run
         -- commands
    end run

    on rock around the clock
            display dialog (clock as string)
    end rock
    -- called with:
    rock around the current date

    to check for yourNumber from bottom thru top
        if bottom ≤ yourNumber and yourNumber ≤ top then
            display dialog "Congratulations! You scored."
        end if
    end check
    -- called with:
    check for 8 from 7 thru 10


-- Catch Error 捕获错误

    try
         -- commands to be tested
    on error
         -- error commands
    end try


-- Script

    script scriptName
         -- commands and handlers specific to the script
    end script

    # Script objects can use the same 'tell' structures that are used for application objects, and can be loaded from and saved to files.
    # Runtime execution time can be reduced in some cases by using script objects.


-- Execute AppleScript Scripts as Shell Commands

    #!/usr/bin/osascript
    -- Beginning it with the following line and giving it execute permission

```

## Components

``` applescript
-- log 历史记录

log pi
log test

# log result
(*3.14159265359*)
(*test*)


-- Execute Shell Commands

    set fileInfo to do shell script "cd ~; ls"


-- An audio message using a synthesized computer voice

    say "Hello, world!"

-- Beep 5 times

    beep 5

-- Delay for 9.8 seconds

    delay 9.8


-- A modal window with “OK” and “Cancel” buttons

    display dialog "info_text"

-- A modal window with a single “OK” button and an icon representing the app displaying the alert

    display alert "warning_text"


-- ¬ character & Dialog Samples

    # It can be produced by typing option-return in the Script Editor,
    # It denotes continuation of a single statement across multiple lines.)

    # For example:

    -- Dialog
    set dialogReply to display dialog "Dialog Text" ¬
        default answer "Text Answer" ¬
        hidden answer false ¬
        buttons {"Skip", "Okay", "Cancel"} ¬
        default button "Okay" ¬
        cancel button "Skip" ¬
        with title "Dialog Window Title" ¬
        with icon note ¬
        giving up after 15

    -- Choose from list
    set chosenListItem to choose from list {"A", "B", "3"} ¬
        with title  "List Title" ¬
        with prompt "Prompt Text" ¬
        default items "B" ¬
        OK button name "Looks Good!" ¬
        cancel button name "Nope, try again" ¬
        multiple selections allowed false ¬
        with empty selection allowed

    -- Alert
    set resultAlertReply to display alert "Alert Text" ¬
        as warning ¬
        buttons {"Skip", "Okay", "Cancel"} ¬
        default button 2 ¬
        cancel button 1 ¬
        giving up after 2


-- Get Input 获取输入的数据

    display dialog "please input" default answer ""
    log text returned of result
```

## Advanced

It is not the whole AppleScript above.
If you want know more in detail, please read [official documentations](https://developer.apple.com/library/mac/documentation/AppleScript/Conceptual/AppleScriptLangGuide/conceptual/ASLR_fundamentals.html).

- Further use:

    1. [用 AppleScript 操作 Evernote / macOS](/applescript/evernote/)
    2. [A service to log Dictionary lookups ](http://hints.macworld.com/article.php?story=20121106085330476)

