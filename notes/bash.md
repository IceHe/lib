title: Bash - Note
---

[Bash脚本](https://github.com/ruanyf/articles/blob/master/dev/linux/script.md)

<https://github.com/ruanyf/articles/tree/master/dev/bash>

<http://www.linux-sxs.org/programming/bashcheat.html>

上一阶段学Bash的参考资料：
≈
<http://www.mediacollege.com/cgi-bin/man/page.cgi?topic=bash>
<http://ahei.info/chinese-bash-man.htm>
<https://www.gnu.org/software/bash/manual/bashref.html>
<http://tldp.org/LDP/Bash-Beginners-Guide/html/index.html>

<http://alvinalexander.com/blog/post/linux-unix/unix-linux-shell-script-reference-cheat-sheet>

<http://www.linuxtopia.org/online_books/advanced_bash_scripting_guide/refcards.html>

If  bash is invoked in this fashion, $0 is set to the name of the file, and the positional parameters are set to the remaining arguments.  Bash reads and  executes commands from this file, then exits.  Bash's exit status is the exit status of the last command executed in the script. If no commands are executed, the exit status is 0.

When   a   login   shell  exits,  bash  reads  and  executes  commands  from  the  file ~/.bash_logout, if it exists.

login shell 读取 ~/.bash_profile, ~/.bash_login,  and ~/.profile
not login shell 读取 ~/.bashrc

non-interactive shell: to run a shell script

# DEFINITIONS

blank  A space or tab.

word   A sequence of characters considered as a single unit by the shell.   Also  known as a token.

name   A word consisting only of alphanumeric characters and underscores, and beginning with an alphabetic character or an underscore.  Also referred to as  an  identifier.

metacharacter   A character that, when unquoted, separates words.  One of the following:  |  & ; ( ) < > space tab

control operator   A token that performs a control function.  It is one of the following symbols: || & && ; ;; ( ) | <newline>

# RESERVED WORDS

Reserved words are words that have a special meaning to the shell.  The following words are recognized as reserved when unquoted and either the first word of a simple  command (see SHELL GRAMMAR below) or the third word of a case or for command:

     !  case   do done elif else esac fi for function if in select then until while { } time [[ ]]

# Pipelines

A pipeline is a sequence of one or more commands separated by the character |.  The format for a pipeline is:

     [time [-p]] [ ! ] command [ | command2 ... ]

If  the  time reserved word precedes a pipeline, the elapsed as well as user and system time consumed by its execution are reported  when  the  pipeline  terminates.   The -p option  changes  the output format to that specified by POSIX.  The TIMEFORMAT variable may be set to a format string that specifies how the timing information should be  displayed; see the description of TIMEFORMAT under Shell Variables below.

Each command in a pipeline is executed as a separate process (i.e., in a subshell).

# List 序列

If a command is terminated by the control operator &, the shell executes the command in the  background  in a subshell.  The shell does not wait for the command to finish, and the return status is 0.  Commands separated by a ; are executed sequentially; the shell waits  for  each command to terminate in turn.  The return status is the exit status of the last command executed

＃ Compound Commands

(list)

list  is  executed  in a subshell environment (see COMMAND EXECUTION ENVIRONMENT below).  Variable assignments and builtin commands that affect the shell's environment  do not remain in effect after the command completes.  The return status is the exit status of list.

{ list; }

list is simply executed in the current shell environment.  list must  be  terminated  with  a  newline  or  semicolon.   This is known as a group command.  The return status is the exit status of list.  Note that unlike the metacharacters ( and ),  { and } are reserved words and must occur where a reserved word is permitted to be recognized.  Since they do not cause a word  break,  they  must  be separated from list by whitespace.

((expression))
The  expression is evaluated according to the rules described below under ARITHMETIC EVALUATION.  If the value of the expression is non-zero, the return status is  0;  otherwise  the  return  status  is 1.  This is exactly equivalent to let "expression".

[[ expression ]]
Return a status of 0 or 1 depending on the evaluation of the conditional expresMETIC EVALUATION.  If the value of the expression is non-zero, the return status is  0;  otherwise  the  return  status  is 1.  This is exactly equivalent to let "expression".

[[ expression ]]
Return a status of 0 or 1 depending on the evaluation of the conditional expression  expression.   Expressions  are  composed  of the primaries described below under CONDITIONAL EXPRESSIONS.  Word splitting and pathname  expansion  are  not performed  on  the  words  between the [[ and ]]; tilde expansion, parameter and variable expansion, arithmetic expansion, command substitution, process  substitution,  and quote removal are performed.  Conditional operators such as -f must be unquoted to be recognized as primaries.

When the == and != operators are used, the string to the right of  the  operator is considered a pattern and matched according to the rules described below under Pattern Matching.  If the shell option nocasematch is enabled, the match is performed without regard to the case of alphabetic characters.  The return value is 0 if the string matches (==) or does not match (!=) the pattern,  and  1  otherwise.   Any  part  of  the  pattern may be quoted to force it to be matched as a string.

An additional binary operator, =~, is available, with the same precedence as  == and  !=.  When it is used, the string to the right of the operator is considered an extended regular expression and matched accordingly (as  in  regex(3)).   The return  value  is  0 if the string matches the pattern, and 1 otherwise.  If the regular expression is  syntactically  incorrect,  the  conditional  expression’s return  value  is  2.   If the shell option nocasematch is enabled, the match is performed without regard to  the  case  of  alphabetic  characters.   Substrings matched  by parenthesized subexpressions within the regular expression are saved in the array variable BASH_REMATCH.  The element of BASH_REMATCH with index 0 is the  portion  of the string matching the entire regular expression.  The element of BASH_REMATCH with index n is the portion  of  the  string  matching  the  nth parenthesized subexpression.

Expressions  may be combined using the following operators, listed in decreasing order of precedence:

( expression )     Returns the value of expression.  This may be used to override the normal precedence of operators

for name [ in word ] ; do list ; done

The  list  of  words  following in is expanded, generating a list of items. The variable name is set to each element of this list in turn, and list is  executed each  time.   If  the in word is omitted, the for command executes list once for each positional parameter that is set (see PARAMETERS below).  The return status is  the  exit status of the last command that executes.  If the expansion of the items following in results in an empty list, no commands are executed,  and  the return status is 0.

for (( expr1 ; expr2 ; expr3 )) ; do list ; done

First,  the  arithmetic  expression  expr1  is  evaluated according to the rules described below under ARITHMETIC EVALUATION.  The arithmetic expression expr2 is then evaluated repeatedly until it evaluates to zero.  Each time expr2 evaluates to a non-zero value, list is executed and the  arithmetic  expression  expr3  is evaluated.   If  any  expression is omitted, it behaves as if it evaluates to 1. The return value is the exit status of the last command in  list  that  is  executed, or false if any of the expressions is invalid.

select name [ in word ] ; do list ; done

case word in [ [(] pattern [ | pattern ] ... ) list ;; ] ... esac

if list; then list; [ elif list; then list; ] ... [ else list; ] fi

while list; do list; done
until list; do list; done

[ function ] name () compound-command [redirection]

This defines a function named name.  The reserved word function is optional.  If the function reserved word is supplied, the parentheses are optional.  The  body of  the function is the compound command compound-command (see Compound Commands above).  That command is usually a list of commands between { and }, but may  be any  command listed under Compound Commands above.  compound-command is executed whenever name is specified as the name of a simple  command.   Any  redirections (see  REDIRECTION below) specified when a function is defined are performed when the function is executed.  The exit status of  a  function  definition  is  zero unless  a  syntax error occurs or a readonly function with the same name already exists.  When executed, the exit status of a function is the exit status of  the last command executed in the body.  (See FUNCTIONS below.)

# Comments

A  word beginning  with  #  causes  that  word  and all remaining characters on that line to be ignored.

# Quotes

A non-quoted backslash (\) is the escape character.  It preserves the literal value of the next character that follows, with the exception of <newline>.  If a \<newline> pair appears,  and  the  backslash is not itself quoted, the \<newline> is treated as a line continuation (that is, it is removed from the input stream and effectively ignored).

Enclosing characters in single quotes preserves the literal  value  of  each  character within  the quotes.  A single quote may not occur between single quotes, even when preceded by a backslash.

Enclosing characters in double quotes preserves the literal  value  of  all  characters within  the  quotes,  with  the  exception  of  $, `, \, and, when history expansion is enabled, !.  The characters $ and ` retain their special meaning within double  quotes. The  backslash  retains  its special meaning only when followed by one of the following characters: $, `, ", \, or <newline>.  A double  quote  may  be  quoted  within  double quotes  by  preceding  it with a backslash.  If enabled, history expansion will be performed unless an !  appearing in double quotes is escaped using a backslash.  The backslash preceding the !  is not removed.

 Words of the form $'string' are treated specially.  The word expands  to  string,  with backslash-escaped  characters  replaced as specified by the ANSI C standard.  Backslash escape sequences, if present, are decoded as follows:
     \a     alert (bell)
     \b     backspace
     \e     an escape character
\f     form feed
\n     new line
     \r     carriage return
     \t     horizontal tab
\v     vertical tab
     \\     backslash
     \'     single quote
     \nnn   the eight-bit character whose value is the octal value nnn (one to  three digits)
     \xHH   the  eight-bit  character whose value is the hexadecimal value HH (one or two hex digits)
     \cx    a control-x character

# Parameters

A variable has a value and zero or more attributes.  Attributes are assigned using the declare builtin command (see declare below  in  SHELL  BUILTIN  COMMANDS).

A  parameter is set if it has been assigned a value.  The null string is a valid value. Once a variable is set, it may be unset only by using the unset  builtin command.

A variable may be assigned to by a statement of the form

     name=[value]

If  value  is  not given, the variable is assigned the null string.  All values undergo tilde expansion, parameter and variable  expansion,  command  substitution,  arithmetic expansion,  and  quote  removal (see EXPANSION below).  If the variable has its integer attribute set, then value is evaluated as an arithmetic expression even if the $((…)) expansion  is  not  used  (see Arithmetic Expansion below).  Word splitting is not performed, with the exception of "$@" as explained below under Special Parameters.   Pathname expansion is not performed.  Assignment statements may also appear as arguments to the alias, declare, typeset, export, readonly, and local builtin commands.

# Positional Parameters

A positional parameter is a parameter denoted by one or more  digits,  other  than  the single  digit 0.  Positional parameters are assigned from the shell's arguments when it is invoked, and may be reassigned using the set builtin command.  Positional parameters may  not be assigned to with assignment statements.  The positional parameters are temporarily replaced when a shell function is executed (see FUNCTIONS below).

When a positional parameter consisting of more than a single digit is expanded, it must be enclosed in braces

# Arrays

Bash provides one-dimensional array variables.  Any variable may be used as  an  array; the declare builtin will explicitly declare an array.  There is no maximum limit on the size of an array, nor any requirement that members be indexed or assigned contiguously. Arrays are indexed using integers and are zero-based.

＃ Tilde Expansion

~+     PWD
~-     OLDPWD
~-2     ……

# Rd Mark

Parameter Expansion
