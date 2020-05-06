# jps

> Java Virtual Machine Process Status Tool

References

- `man jps`
- Understand the JVM - 2nd Edition - ZH Ver. - P141

## Quickstart

```bash
jps -l
# 56822 org.jetbrains.jps.cmdline.Launcher
# 58346 sun.tools.jps.Jps
# 37199
```

## Synopsis

LVMID - Local Virtual Machine Identifier

## Options

## Usage

Default

```bash
jps
# output
56822 Launcher
58326 Jps
37199
```

```bash
jps -l
# output
56822 org.jetbrains.jps.cmdline.Launcher
58346 sun.tools.jps.Jps
37199
```
