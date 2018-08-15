# Commands

## Ref

- [The Art of Command Line](https://github.com/jlevy/the-art-of-command-line/blob/master/README.md) / [中文版](https://github.com/jlevy/the-art-of-command-line/blob/master/README-zh.md)

```bash
man [command]

# e.g.: `man bash`
```

## Tmp

`npm` install globally

```bash
# NPM Install globally
npm i docsify-cli -g
```

List directory content like `tree`

```bash
find [directory_path] | sed -e "s/[^-][^\/]*\//  |/g" -e "s/|\([^ ]\)/|── \1/"
```
