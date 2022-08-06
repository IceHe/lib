# npm exec

Run a command from a local or remote npm package

---

References

-   [npm-exec - npm docs]
-   `man npm-exec`

## Synopsis

```bash
npm exec -- <pkg>[@<version>] [args...]
npm exec --package=<pkg>[@<version>] -- <cmd> [args...]
npm exec -c '<cmd> [args...]'
npm exec --package=foo -c '<cmd> [args...]'
npm exec [--ws] [-w <workspace-name] [args...]

npx <pkg>[@<specifier>] [args...]
npx -p <pkg>[@<specifier>] <cmd> [args...]
npx -c '<cmd> [args...]'
npx -p <pkg>[@<specifier>] -c '<cmd> [args...]'
Run without --call or positional args to open interactive subshell

alias: npm x, npx

common options:
--package=<pkg> (may be specified multiple times)
-p is a shorthand for --package only when using npx executable
-c <cmd> --call=<cmd> (may not be mixed with positional arguments)
```

## Description

**This command allows you to run an arbitrary command from an npm package (either one installed locally, or fetched remotely), in a similar context as running it via `npm run`.**

Run without positional arguments or `--call`, this allows you to interactively run commands in the same sort of shell environment that package.json scripts are run.
Interactive mode is not supported in CI environments when standard input is a TTY, to prevent hangs.

……

## npx vs npm exec

When run via the `npx` binary, all flags and options must be set prior to any positional arguments.
When run via `npm exec`, a double-hyphen `--` flag can be used to suppress npm's parsing of switches and options that should be sent to the executed command.

_For example:_

```bash
$ npx foo@latest bar --package=@npmcli/foo
```

_In this case, npm will resolve the foo package name, and run the following command:_

```bash
$ foo bar --package=@npmcli/foo
```

……

todo oneday
