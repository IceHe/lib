# npm install

install a package

---

References

- [npm-install - npm docs](https://docs.npmjs.com/cli/v7/commands/npm-install)
- `man npm-install`

## Synopsis

```bash
npm install (with no args, in package dir)
npm install [<@scope>/]<name>
npm install [<@scope>/]<name>@<tag>
npm install [<@scope>/]<name>@<version>
npm install [<@scope>/]<name>@<version range>
npm install <alias>@npm:<name>
npm install <git-host>:<git-user>/<repo-name>
npm install <git repo url>
npm install <tarball file>
npm install <tarball url>
npm install <folder>

aliases: npm i, npm add
common options: [-P|--save-prod|-D|--save-dev|-O|--save-optional|--save-peer] [-E|--save-exact] [-B|--save-bundle] [--no-save] [--dry-run]
```

## Description

**This command installs a package and any packages that it depends on.**
If the package has a package-lock, or an npm shrinkwrap file, or a yarn lock file, the installation of dependencies will be driven by that, respecting the following order of precedence:

- npm-shrinkwrap.json
- package-lock.json
- yarn.lock

See [package-lock.json](https://docs.npmjs.com/cli/v7/configuring-npm/package-lock-json) and [npm shrinkwrap](https://docs.npmjs.com/cli/v7/commands/npm-shrinkwrap).

**A `package` is:**

- a) a folder containing a program described by a `package.json` file
- b) a gzipped tarball containing (a)
- c) a url that resolves to (b)
- d) a `<name>@<version>` that is published on the registry (see [registry](https://docs.npmjs.com/cli/v7/using-npm/registry)) with (c)
- e) a `<name>@<tag>` (see [npm dist-tag](https://docs.npmjs.com/cli/v7/commands/npm-dist-tag)) that points to (d)
- f) a `<name>` that has a "latest" tag satisfying (e)
- g) a `<git remote url>` that resolves to (a)

Even if you never publish your package, you can still get a lot of benefits of using npm if you just want to write a node program (a), and perhaps if you also want to be able to easily install it elsewhere after packing it up into a tarball (b).

## Configuration

## Algorithm
