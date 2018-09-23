# Bash

> GNU Bourne-Again SHell

Bash Cheatsheet https://devhints.io/bash

References

- [Bash脚本](https://github.com/ruanyf/articles/blob/master/dev/linux/script.md)
- <http://www.linux-sxs.org/programming/bashcheat.html>
- <http://ahei.info/chinese-bash-man.htm>
- <https://www.gnu.org/software/bash/manual/bashref.html>
- <http://tldp.org/LDP/Bash-Beginners-Guide/html/index.html>
- <http://www.linuxtopia.org/online_books/advanced_bash_scripting_guide/refcards.html>

## TEMP

confirm.sh

```bash
#!/bin/bash

read -r -p "Are You Sure? [Y/n]"
echo

if [[ $REPLY =~ ^[yY]$ ]]; then
    echo 'Yes'
elif [[ $REPLY =~ ^[nN]$ ]]; then
    echo 'No'
else
    echo 'Invalid Input!'
fi
```