# expr

> evaluate expressions

## Quickstart

```bash
expr 1 + 2      # 3
expr 11 \* 12   # 132
expr 192 / 11   # 17
expr 192 % 11   # 5
expr 5 \| 10    #
……
# 没怎么用过的命令, 不知道什么场景下比较有用.
```

## Synopsis

```bash
expr EXPRESSION
expr OPTION
```

- Beware that many operators need to be escaped or quoted for shells.
- Comparisons are arithmetic if both ARGsarenumbers,else lexicographical.
- Pattern matches return the string matched between `\(` and `\)` or null;
    - if `\(` and `\)` are not used, they return the number of characters matched or 0.

Options

- `--help` display this help and exit
- ……

## Exit Codes

- `0` if EXPRESSION is neither null nor 0,
- `1` if EXPRESSION is null or 0,
- `2` if EXPRESSION is syntactically invalid,
- `3` if an error occurred.

## Expressions

       Print  the value of EXPRESSION to standard output.  A blank line below separates increasing precedence groups.  EXPRESSION may be:

- `ARG1 | ARG2` ARG1 if it is neither null nor 0, otherwise ARG2
- `ARG1 & ARG2` ARG1 if neither argument is null or 0, otherwise 0
- `ARG1 < ARG2` ARG1 is less than ARG2
- `ARG1 <= ARG2` ARG1 is less than or equal to ARG2
- `ARG1 = ARG2` ARG1 is equal to ARG2
- `ARG1 != ARG2` ARG1 is unequal to ARG2
- `ARG1 >= ARG2` ARG1 is greater than or equal to ARG2
- `ARG1 > ARG2` ARG1 is greater than ARG2
- `ARG1 + ARG2` arithmetic sum of ARG1 and ARG2
- `ARG1 - ARG2` arithmetic difference of ARG1 and ARG2
- `ARG1 * ARG2` arithmetic product of ARG1 and ARG2
- `ARG1 / ARG2` arithmetic quotient of ARG1 divided by ARG2
- `ARG1 % ARG2` arithmetic remainder of ARG1 divided by ARG2
- `STRING : REGEXP` anchored pattern match of REGEXP in STRING
- `match STRING REGEXP` same as STRING : REGEXP
- `substr STRING POS LENGTH` substring of STRING, POS counted from 1
- `index STRING CHARS` index in STRING where any CHARS is found, or 0
- `length STRING` length of STRING
- `+ TOKEN` interpret TOKEN as a string, even if it is a keyword like 'match' or an operator like '/'
- `( EXPRESSION )` value of EXPRESSION

## Usage

### Logic Calculus

#### OR

`|`

```bash
$ expr a \| b
a

$ expr 0 \| b
b

$ expr '' \| b
b
```

#### AND

`&`

```bash
$ expr a \& b
a

$ expr 0 \& b
0

$ expr '' \& b
0
```

### Num Comparison

`<`

```bash
expr ARG1 \< ARG2

# e.g.
$ expr 1 \< 2
1

$ expr 1 \< 1
0

$ expr 1 \< 0
0
```

`<=`

```bash
expr ARG1 \<= ARG2
```

`=`

```bash
expr ARG1 = ARG2
```

`!=`

```bash
expr ARG1 != ARG2
```

`>`

```bash
expr ARG1 \> ARG2
```

`>=`

```bash
expr ARG1 \>= ARG2
```

### Arithemetic

`+`

```bash
expr ARG1 + ARG2

# e.g.
$ expr 1 + 2
3
```

`-`

```bash
expr ARG1 - ARG2

# e.g.
$ expr 1 - 2
-1

# error
$ expr 1.1 - 2.2
expr: non-integer argument
```

`*`

```bash
expr ARG1 \* ARG2

# e.g.
$ expr 2 \* 3
6

# error
$ expr 2.2 \* 3.3
expr: non-integer argument
```

`/`

- …

`%`

- …

### String Operation

#### Regex Match

`:`

```bash
expr STR : REGEXP

# e.g.
$ expr ab : ^[a-c]*$
# ouput length of STR 'ab'
2

$ expr abc : ^[a-c]*$
# ouput length of STR 'abc'
3

$ expr abcd : ^[a-c]*$
0
```

`match`

```bash
expr match STR REGEXP
# same as
expr STR : REGEXP

# e.g.
$ expr match abc ^[a-c]*$
3
```

#### Substring

`substr`

- POS counted from 1

```bash
expr substr STR POS LENGTH

# e.g.
$ expr substr abcde 0 3
# output nothing

$ expr substr abcde 1 3
abc

$ expr substr abcde 3 5
cde

$ expr substr abcde 3 6
cde

$ expr substr abcde 3
expr: syntax error
```

#### Charactor At

`index`

- index in STRING where any CHARS is first found, or 0 ( not exist )

```bash
expr index STR CHARS

# e.g.
$ expr index abcde a
1

$ expr index abcde zc
3

$ expr index abcde f
# not exist
0
```

#### Length

`length`

```bash
$ expr length 12345
5
```
