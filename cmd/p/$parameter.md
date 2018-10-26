# $parameter

> The `$' character introduces parameter expansion, command substitution, or arithmetic expansion.

References

- shell 脚本之变量、数组、扩展 : http://opus.konghy.cn/shell-tutorial/chapter2.html
- shell 变量替换与扩展 : http://www.huangdc.com/78

## Basic

Assgin

```bash
param_name=<param_value>

# e.g.
ab='apache benchmark'
# or
ab="apache benchmark"
# or
ab=apache\ benchmark
```

Output

```bash
$ab

# e.g.
$ echo $ab
apache benchmark
```

Unset

```bash
unset <param_name>

# e.g.
$ unset ab
# check
$ echo ${ab:-NULL}
NULL
```

## Shell Variables

- `$HOME` : Home directory of current user
    - Default argument for the cd builtin command.
    - Value of this variable is also used when performing tilde expansion ( i.e. `~` ).
- `$HOSTNAME` : Automatically set to name of current host.
- `$PATH` : The search path for commands
    - It is a colon-separated list of directories in which the shell looks for commands.
    - The default path is system-dependent, and is set by the administrator who installs bash.
    - A common value is ``/usr/gnu/bin:/usr/local/bin:/usr/ucb:/bin:/usr/bin''.
- `$OLDPWD` : Previous working directory as set by the cd command
- `$PWD` : Current working directory as set by the cd command
- **`$RANDOM`** : Each time this parameter is referenced, a random integer between 0 and 32767 is generated. ( 2^15 = 32768 )
    - The sequence of random numbers may be initialized by assigning a value to RANDOM.
    - If RANDOM is unset, it loses its special properties, even if it is subsequently reset.
- **`$UID`** : Expands to the user ID of the current user, initialized at shell startup.
    - It's readonly.
- `IFS` : The **Internal Field Separator** that is used for word splitting after expansion and to split lines into words with the read builtin command.
    - The default value is `<space><tab><newline>`.

## Special Params

The shell treats several parameters specially.

These parameters may only be referenced; assignment to them is not allowed.

- **`$*`** : **Positional parameters**, starting from one
    - When the expansion occurs within double quotes, it expands to a single word with the value of each parameter separated by the first character of the IFS special variable.
    - That is, "\$*" is equivalent to "\$1c\$2c...", where c is the first character of the value of the IFS variable.
    - If IFS is unset, the parameters are separated by spaces.
    - If IFS is null, the parameters are joined without intervening separators.
- **`$@`** : **Positional parameters**, starting from one
    - When the expansion occurs within double quotes, each parameter expands to a separate word.
    - That is, "\$@" is equivalent to "$1" "$2" ...
    - If the double-quoted expansion occurs within a word, the expansion of the first parameter is joined with the beginning part of the original word, and the expansion of the last parameter is joined with the last part of the original word.
    - When there are no positional parameters, "\$@" and \$@ expand to nothing (i.e., they are removed).
- **`$#`** : **Number of positional parameters** in decimal
- **`$?`** : **Exit status of the most recently executed foreground pipeline**
- `$-` : Expands to **current option flags** as specified upon invocation, by the set builtin command, or those set by the shell itself (such as the -i option).
- `$$` : **Process ID of the shell**
    - In a () subshell, it expands to the process ID of the current shell, not the subshell.
- `$!` : **Process ID of the most recently executed background (asynchronous) command**.
- **`$0`** : **Name of the shell or shell script**.
    - This is set at shell initialization.
    - If bash is invoked with a file of commands, $0 is set to the name of that file.
    - If bash is started with the -c option, then $0 is set to the first argument after the string to be executed, if one is present.
    - Otherwise, it is set to the file name used to invoke bash, as given by argument zero.
- `$_` : At shell startup, set to the **Absolute Pathname used to invoke the shell** or shell script being executed as passed in the environment or argument list.
    - Subsequently, expands to the **Last Argument to Previous Command**, after expansion.
    - Also set to the full pathname used to invoke each command executed and placed in the environment exported to that command.

Demo Script : t.sh

```bash
#!/bin/bash
echo \$_=$_
echo \$*=$*
echo \$@=$@
echo \$#=$#
echo \$?=$?
echo \$-=$-
echo \$\$=$$
echo \$!=$!
echo \$0=$0
echo \$1=$1
echo \$2=$2
echo \$3=$3
echo \$_=$_
for param in $*; do echo \$*[]=$param; done
for param in $@; do echo \$@[]=$param; done
```

Run Script

```bash
$ bash t.sh a b c

# output
$_=/bin/bash
$*=a b c
$@=a b c
$#=3
$?=0
$-=hB
$$=10195
$!=
$0=t.sh
$1=a
$2=b
$3=c
$_=$3=c
$*[]=a
$*[]=b
$*[]=c
$@[]=a
$@[]=b
$@[]=c
```

## Param Expansion

### $\{param\}

The value of parameter is substituted.

- The braces are required when parameter is a positional parameter with more than one digit,
    - or when parameter is followed by a character which is not to be interpreted as part of its name.

```bash
$param
# equels
${param}

# e.g.
$ param=123
$ param4=456
$ echo "${param}4"
1234
$ echo "$param4"
456
```

### $\{param:-word\}

Use Default Values.

- If parameter is unset or null, the expansion of word is substituted.
- Otherwise, the value of parameter is substituted.

```bash
$ unset param
$ echo ${param:-NULL}
NULL

$ param=
$ echo ${param:-NULL}
NULL

$ param=123
$ echo ${param:-NULL}
123
```

### $\{parameter:+word\}

Use Alternate Value.

- If parameter is null or unset, nothing is substituted.
- Otherwise, the expansion of word is substituted.

```bash
$ unset param
$ echo ${param:+set}

$ param=aha
$ echo ${param:+set}
set
```

### $\{param:=word\}

Assign Default Values.

- If parameter is unset or null, the expansion of word is assigned to parameter.
- The value of parameter is then substituted.
- Positional parameters and special parameters may not be assigned to in this way.

```bash
$ unset param
$ echo ${param:=default}
default
```

### $\{param:?word\}

Display Error if Null or Unset.

- If parameter is null or unset, the expansion of word (or a message to that effect if word is not present) is written to the standard error and the shell.
- If it is not interactive, exits.
- Otherwise, the value of parameter is substituted.

```bash
$ unset param
$ echo ${param:?error}
-bash: param: error
```

### $\{parameter:offset\}

### $\{param:offset:length\}

Substring Expansion.

- Expands to up to length characters of parameter starting at the character specified by offset.
- If length is omitted, expands to the substring of parameter starting at the character specified by offset.
- Length and Offset can be arithmetic expressions.
- If offset evaluates to a number **less than zero**, the value is used as an offset **from the end of the value of parameter**.
- If length evaluates to a number less than zero, and parameter is not @ and not an indexed or associative array, it is interpreted as an offset from the end of the value of parameter rather than a number of characters, and the expansion is the characters between the two offsets.
- _If parameter is @, the result is length positional parameters beginning at offset._
- _If parameter is an indexed array name subscripted by @ or *, the result is the length members of the array beginning with ${parameter[offset]}._
- A negative offset is taken relative to one greater than the maximum index of the specified array.
- Substring expansion applied to an associative array produces undefined results.
- **Note that a negative offset must be separated from the colon by at least one space to avoid being confused with the :- expansion.**
- Substring indexing is zero-based unless the positional parameters are used, in which case the indexing starts at 1 by default.
- If offset is 0, and the positional parameters are used, $0 is prefixed to the list.

```bash
# string
$ param=12345

$ echo ${param:1}
2345
$ echo ${param:1:2}
23
$ echo "${param: -2}"
45
$ echo "${param: -2:1}"
4
$ echo "${param:0:2}"
12
$ echo "${param::-3}"
12
$ echo "${param:0:-3}"
12
$ echo "${param:1:-3}"
2

# array
$ ary=(`seq 5 9`)

$ echo ${!ary[*]}
0 1 2 3 4
$ echo ${ary[*]}
5 6 7 8 9

$ echo ${ary[*]:2}
7 8 9
$ echo ${ary[*]:2:1}
7
$ echo ${ary[*]: -3:2}
7 8
```

### $\{!prefix*\}

### $\{!prefix@\}

Names matching prefix.

- Expands to the names of variables whose names begin with prefix, separated by the first character of the IFS special variable.
- _When @ is used and the expansion appears within double quotes, each variable name expands to a separate word._

```bash
$ a1=
$ a2=
$ a3=
$ echo ${!a*}
a1 a2 a3
$ echo ${!a@}
a1 a2 a3
```

### $\{!name[*]\}

### $\{!name[@]\}

List of array keys.

- If name is an array variable, expands to the list of array indices (keys) assigned in name.
- If name is not an array, expands to 0 if name is set and null otherwise.
- When @ is used and the expansion appears within double quotes, each key expands to a separate word.

```bash
$ a[1]=4
$ a[2]=5
$ a[3]=6

# key
$ echo ${!a[*]}
1 2 3
# value
$ echo ${a[*]}
4 5 6
```

### $\{#parameter\}

**Parameter length**.

- The length in characters of the value of parameter is substituted.
- If parameter is * or @, the value substituted is the number of positional parameters.
- If parameter is an array name subscripted by * or @, the value substituted is the number of elements in the array.

```bash
$ param=12345
$ echo ${#a[*]}
5

$ a[0]=4
$ a[1]=5
$ a[2]=6
# or
$ a=(4 5 6)

$ echo ${#a[*]}
3
```

### $\{parameter#word\}

### $\{parameter##word\}

Remove matching prefix pattern.

- The word is expanded to produce a pattern just as in pathname expansion.
- If the pattern matches the beginning of the value of parameter, then the result of the expansion is the expanded value of parameter with the shortest matching pattern (the # case) or the longest matching pattern (the ## case) deleted.
- _If parameter is @ or *, the pattern removal operation is applied to each positional parameter in turn, and the expansion is the resultant list._
- _If parameter is an array variable subscripted with @ or *, the pattern removal operation is applied to each member of the array in turn, and the expansion is the resultant list._

```bash
# string
$ str=abcde
$ echo ${str#a}
bcde
$ echo ${str#abc}
de

# array
$ ary=(1 2 3 4 5)
$ echo ${ary[*]#[1-3]}
4 5
$ echo ${ary[*]#[135]}
2 4

# string wildcard
$ abc2=abcabc
$ echo ${abc2#*b}
cabc
$ echo ${abc2##*b}
c

# file suffix wildcard
$ path=/usr/home/icehe/bash/t.ba.sh
$ echo ${path#/*/}
home/icehe/bash/t.ba.sh
$ echo ${path##/*/}
t.ba.sh
$ echo ${path%.*}
/usr/home/icehe/bash/t.ba
$ echo ${path%%.*}
/usr/home/icehe/bash/t
```

### $\{parameter%word\}

### $\{parameter%%word\}

Remove matching suffix pattern.

- The word is expanded to produce a pattern just as in pathname expansion.
- If the pattern matches a trailing portion of the expanded value of parameter, then the result of the expansion is the expanded value of parameter with the shortest matching pattern (the % case) or the longest matching pattern (the %% case) deleted.
- _If parameter is @ or *, the pattern removal operation is applied to each positional parameter in turn, and the expansion is the resultant list._
- _If parameter is an array variable subscripted with @ or *, the pattern removal operation is applied to each member of the array in turn, and the expansion is the resultant list._

```bash
# #
$ str=abcde
$ echo ${str#e}
abcd
$ echo ${str#de}
abc

# %
$ ary=(a0 b1 c2 d3 e4)
$ echo ${ary[*]%[13]}
4 5
$ echo ${ary[*]%[0-3]}
a b c d e4

# %…*
$ abc2=abcabc
$ echo ${abc2%b*}
abca
$ echo ${abc2%%b*}
a
```

### $\{parameter/pattern/string\}

**Pattern substitution.**

- **The `//` below means replacing all matches.**

### $\{parameter//pattern/string\}

- The pattern is expanded to produce a pattern just as in pathname expansion.
- Parameter is expanded and the longest match of pattern against its value is replaced with string.
- If pattern begins with /, all matches of pattern are replaced with string.
- Normally only the first match is replaced.
- If pattern begins with #, it must match at the beginning of the expanded value of parameter.
- If pattern begins with %, it must match at the end of the expanded value of parameter.
- If string is null, matches of pattern are deleted and the / following pattern may be omitted.
- _If parameter is @ or *, the substitution operation is applied to each positional parameter in turn, and the expansion is the resultant list._
- _If parameter is an array variable subscripted with @ or *, the substitution operation is applied to each member of the array in turn, and the expansion is the resultant list._

```bash
# /
$ str=abcde
$ echo ${str/c/x}
abxde
$ echo ${str/bc/ }
a de

# //
$ abc2=abcabc
$ echo ${abc2//bc/x}
axax
$ echo ${abc2//bc/}
aa
```

### $\{parameter^pattern\}

### $\{parameter^^pattern\}

### $\{parameter,pattern\}

### $\{parameter,,pattern\}

### $\{parameter~~pattern\}

Case modification.

- This expansion modifies the case of alphabetic characters in parameter.
- The pattern is expanded to produce a pattern just as in pathname expansion.
- The ^ operator converts lowercase letters matching pattern to uppercase; the , operator converts matching uppercase letters to lowercase.
- The ^^ and ,, expansions convert each matched character in the expanded value; the ^ and , expansions match and convert only the first character in the expanded value.
- If pattern is omitted, it is treated like a ?, which matches every character.
- _If parameter is @ or *, the case modification operation is applied to each positional parameter in turn, and the expansion is the resultant list._
- _If parameter is an array variable subscripted with @ or *, the case modification operation is applied to each member of the array in turn, and the expansion is the resultant list._

```bash
# ^
$ str=abcde
$ echo ${str^}
Abcde
$ echo ${str^^}
ABCDE
$ echo ${str^[ace]}
Abcde
$ echo ${str^^[ace]}
AbCdE
echo ${str^^[c-e]}
abCDE

# ,
$ STR=ABCDE
$ echo ${STR,}
aBCDE
$ echo ${STR,,}
abcde
$ echo ${STR,[A-C]}
aBCDE
$ echo ${STR,,[A-C]}
abcDE
echo ${STR,,[BD]}
AbCdE
echo ${STR,,[B-D]}
AbcdE

# ~~
$ rev=Hello
$ echo ${rev~~}
hELLO
$ echo ${rev~~[Hl]}
heLLo
$ echo ${rev~~[l-o]}
HeLLO
```
