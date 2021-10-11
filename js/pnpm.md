# pnpm

Fast, disk space efficient package manager

---

References

- [pnpm.io](https://pnpm.io/)

## Intro

Characteristics

-   **Fast**:
    pnpm is up to 2x faster than the alternatives

-   **Efficient**:
    Files inside node_modules are linked from a single content-addressable storage

-   **Supports monorepos**:
    pnpm has built-in support for multiple packages in a repository

-   **Strict**:
    pnpm creates a non-flat node_modules, so code has no access to arbitrary packages

Get Started

- [Motivation](https://pnpm.io/motivation)
- [Installation](https://pnpm.io/installation)
    - Upgrade: `pnpm add -g pnpm`
    - ……

| npm command     | pnpm equivalent  |
| --------------- | ---------------- |
| `npm install`   | `pnpm install`   |
| `npm i <pkg>`   | `pnpm add <pkg>` |
| `npm run <cmd>` | `pnpm <cmd>`     |

## Manage Dependencies

### add

`Command` Meaning

- `pnpm add sax` Save to dependencies.
- `pnpm add -D sax` Save to devDependencies.
    - `-D, --save-dev`
- `pnpm add -O sax` Save to optionalDependencies.
    - `-O, --save-optional`
- `pnpm add --save-peer sax` Save to  peerDependencies and devDependencies.
- `pnpm add sax@next` Install from the next tag.
- `pnpm add sax@3.0.0` Specify version 3.0.0 .

### install

`Command` Meaning

- `pnpm i --offline` Install offline from the store only.
- `pnpm i --frozen-lockfile` `pnpm-lock.yaml` is not updated.
- `pnpm i --lockfile-only` Only `pnpm-lock.yaml` is updated.

### update

`Command` Meaning

- `pnpm up` Updates all dependencies, adhering to ranges specified in `package.json`.
- `pnpm up --latest` Updates all dependencies, ignoring ranges specified in `package.json`.
- `pnpm up foo@2` Updates foo to the latest version on v2.
- `pnpm up "@babel/*"` Updates all dependencies under the @babel scope.

### others

- `remove`, `rm` `uninstall` `un`
- `link`, `ln`
- `unlink` …
- `import` generates a `pnpm-lock.yaml` from another package manager's lockfile.
- `rebuild`, `rb`
- `install-test`, `it`
- ……

## Review Dependencies

- `audit` Checks for known security issues with the installed packages.
- `list`, `ls` Output all the versions of packages that are installed,
    as well as their dependencies, in a tree-structure.
- `outdated` Checks for outdated packages.
- `why` Shows all packages that depend on the specified package.

## Run Scripts

- `run`, `run-script` Runs a script defined in the package's manifest file
- `test`, `run test`, `t`, `tst` Runs an arbitrary command specified in the package's test property of its `scripts` object
- `exec` Execute a shell command in scope of a project
    - `node_modules/.bin` is added to the `PATH`, so pnpm exec allows executing commands of dependencies.
- `dlx` Fetches a package from the registry without installing it as a dependency, hotloads it, and runs whatever default command binary it exposes.
- `start`, `run start` Runs an arbitrary command specified in the package's start property of its `scripts` object.
    - If no start property is specified on the scripts object, it will attempt to run node `server.js` as a default, failing if neither are present.

### npx, pnpx

WARNING: This command is deprecated! Use `pnpm exec` and `pnpm dlx` instead.

## Other Commands

- `env` Manages the Node.js environment.
- `publish` Publishes a package to the registry.
- `pack` Create a tarball from a package.
- `recursive`, `m`, `multi`, `<command> -r` Runs a pnpm command recursively on all subdirectories in the package or every available workspace.
    - Currently, only the following commands can be used recursively:
        - `add`, `exec`, `install`, `list`, `outdated`, `publish`, `rebuild`, `remove`, `run`, `test`, `unlink`, `update`, `why`
- `server` Manage a store server.
    - `server start`
    - `server stop`
    - `server status`
- `store` Managing the package store.

## Configuration

……

## Workspace

pnpm has built-in support for monorepositories
(AKA **multi-package repositories**, **multi-project repositories**, or **monolithic repositories**).
You can create a workspace to unite multiple projects inside a single repository.

## Receipes

- Using Changesets
- Continuous Integration
- Only allow pnpm
- Working with Git

### Only allow pnpm

When you use pnpm on a project,
you don't want others to accidentally run `npm install` or `yarn`.

To prevent devs from using other package managers,
you can add the following preinstall script to your `package.json` :

```json
{
    "scripts": {
        "preinstall": "npx only-allow pnpm"
    }
}
```

_Now, whenever someone runs `npm install` or `yarn,,_
_they'll get an error instead and installation will not proceed._
