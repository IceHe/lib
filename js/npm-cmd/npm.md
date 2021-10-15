# npm

javascript package manager

---

References

- [npm -npm docs](https://docs.npmjs.com/cli/v7/commands/npm)
- `man npm`

## Synopsis

```bash
npm <command> [args]
```

## Description

npm is the package manager for the Node JavaScript platform.
**It puts modules in place so that node can find them, and manages dependency conflicts intelligently.**

It is extremely configurable to support a variety of use cases.
Most commonly, you use it to publish, discover, install, and develop node programs.

## Important

……

## Introduction

……

The very first thing you will most likely want to run in any node program is `npm install` to install its dependencies.

……

Use the `npm search` command to show everything that's available in the public registry.
Use `npm ls` to show everything you've installed.

## Dependencies

If a package lists a dependency using a git URL, npm will install that dependency using the `git` command and will generate an error if it is not installed.

If one of the packages npm tries to install is a native node module and requires compiling of C++ Code, npm will use `node-gyp` for that task.

- For a Unix system, `node-gyp` needs Python, make and a buildchain like GCC.
- On Windows, Python and Microsoft Visual Studio C++ are needed.

_For more information visit the [node-gyp](https://github.com/nodejs/node-gyp) repository and the [node-gyp docs](https://github.com/nodejs/node-gyp/tree/master/docs)._

## Directories

See [folders](https://docs.npmjs.com/cli/v7/configuring-npm/folders) to learn about where npm puts stuff.

In particular, npm has two modes of operation:

-   **local mode: npm installs packages into the current project directory,** which defaults to the current working directory.
    **Packages install to `./node_modules`, and bins to `./node_modules/.bin`.**
-   **global mode: npm installs packages into the install prefix at `$npm_config_prefix/lib/node_modules` and bins to `$npm_config_prefix/bin`.**

Local mode is the default.
Use `-g` or `--global` on any command to run in global mode instead.

## Developer Usage

If you're using npm to develop and publish your code, check out the following help topics:

-   json: Make a package.json file.
    See [package.json](https://docs.npmjs.com/cli/v7/configuring-npm/package-json).
-   **link: Links your current working code into Node's path, so that you don't have to reinstall every time you make a change.**
    Use [`npm link`](https://docs.npmjs.com/cli/v7/commands/npm-link) to do this.**
-   install: It's a good idea to install things if you don't need the symbolic link.
    Especially, installing other peoples code from the registry is done via [`npm install`](https://docs.npmjs.com/cli/v7/commands/npm-install)
-   adduser: Create an account or log in.
    When you do this, npm will store credentials in the user config file config file.
-   **publish: Use the [`npm publish`](https://docs.npmjs.com/cli/v7/commands/npm-publish) command to upload your code to the registry.**

### Configuration

npm is extremely configurable.
It reads its configuration options from 5 places.

-   **Command line switches**:

    **Set a config with `--key val`.**
    All keys take a value, even if they are booleans (the config parser doesn't know what the options are at the time of parsing).
    If you do not provide a value (`--key`) then the option is set to boolean `true`.

-   **Environment Variables**:

    **Set any config by prefixing the name in an environment variable with `npm_config_`.**
    _For example, `export npm_config_key=val`._

-   **User Configs**:

    **The file at `$HOME/.npmrc` is an ini-formatted list of configs.**
    If present, it is parsed.
    If the userconfig option is set in the cli or env, that file will be used instead.

-   **Global Configs**:

    **The file found at `./etc/npmrc` (relative to the global prefix will be parsed if it is found).**
    See [npm prefix](https://docs.npmjs.com/cli/v7/commands/npm-prefix) for more info on the global prefix.
    If the `globalconfig` option is set in the cli, env, or user config, then that file is parsed instead.

-   **Defaults**:

    **npm's default configuration options are defined in `lib/utils/config-defs.js`.**
    These must not be changed.

See [config](https://docs.npmjs.com/cli/v7/using-npm/config) for much much more information.
