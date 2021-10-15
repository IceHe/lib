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

### `npm install`

(in a package directory, no arguments):

**Install the dependencies in the local `node_modules` folder.**

In global mode (ie, with `-g` or `--global` appended to the command), it installs the current package context (ie, the current working directory) as a global package.

By default, `npm install` will install all modules listed as dependencies in `package.json`.

With the `--production` flag (or when the `NODE_ENV` environment variable is set to production), npm will not install modules listed in `devDependencies`.
To install all modules listed in both `dependencies` an`d` devDependencies when `NODE_ENV` environment variable is set to production, you can use `--production=false`.

_NOTE: The `--production` flag has no particular meaning when adding a dependency to a project._

### `npm install <folder>`

**Install the package in the directory as a symlink in the current project.**
Its dependencies will be installed before it's linked.
If `<folder>` sits inside the root of your project, its dependencies may be hoisted to the top-level node_modules as they would for other types of dependencies.

### `npm install <tarball file>`

**Install a package that is sitting on the filesystem.**
Note: if you just want to link a dev directory into your npm root, you can do this more easily by using `npm link`.

Tarball requirements:

-   The filename must use `.tar`, `.tar.gz`, or `.tgz` as the extension.

-   The package contents should reside in a subfolder inside the tarball (usually it is called `package/`).
    npm strips one directory layer when installing the package
    (an equivalent of `tar x --strip-components=1` is run).

-   The package must contain a `package.json` file with name and version properties.

Example: `npm install ./package.tgz`

### `npm install <tarball url>`

**Fetch the tarball url, and then install it.**
In order to distinguish between this and other options, the argument must start with "http://" or "https://"

Example: `npm install https://github.com/indexzero/forever/tarball/v0.5.6`

### npm install [\<@scope\>/]\<name\>

Do a `<name>@<tag>` install, where `<tag>` is the "tag" config.
(See [config](https://docs.npmjs.com/cli/v7/using-npm/config). The config's **default value is `latest`.**)

In most cases, this will install the version of the modules tagged as `latest` on the npm registry.

Example: `npm install sax`

`npm install` saves any specified packages into `dependencies` by default.**
Additionally, you can control where and how they get saved with some additional flags:

-   `-P, --save-prod`

    Package will appear in your `dependencies`.
    This is the default unless `-D` or `-O` are present.

-   `-D, --save-dev`

    Package will appear in your `devDependencies`.

-   `-O, --save-optional`

    Package will appear in your `optionalDependencies`.

-   `--no-save`

    Prevents saving to `dependencies`.

    When using any of the above options to save dependencies to your `package.json`, there are two additional, optional flags:

-   `-E, --save-exact`

    Saved dependencies will be configured with an exact version rather than using npm's default semver range operator.

-   `-B, --save-bundle`

    Saved dependencies will also be added to your `bundleDependencies` list.

    Further, if you have an `npm-shrinkwrap.json` or `package-lock.json` then it will be updated as well.

    `<scope>` is optional.
    The package will be downloaded from the registry associated with the specified scope.
    If no registry is associated with the given scope the default registry is assumed.
    See [scope](https://docs.npmjs.com/cli/v7/using-npm/scope).

    Note: if you do not include the @-symbol on your scope name, npm will interpret this as a GitHub repository instead, see below.
    Scopes names must also be followed by a slash.

    Examples:

    ```bash
    npm install sax
    npm install githubname/reponame
    npm install @myorg/privatepackage
    npm install node-tap --save-dev
    npm install dtrace-provider --save-optional
    npm install readable-stream --save-exact
    npm install ansi-regex --save-bundle
    ```

    _Note: If there is a file or folder named `<name>` in the current working directory, then it will try to install that, and only try to fetch the package by name if it is not valid._

### `npm install <alias>@npm:<name>`

**Install a package under a custom alias.**

……

### `npm install [<@scope>/]<name>@<tag>`

**Install the version of the package that is referenced by the specified tag.**

……

### `npm install [<@scope>/]<name>@<version>`

**Install the specified version of the package.**

……

### `npm install [<@scope>/]<name>@<version range>`

**Install a version of the package matching the specified version range.**

……

### `npm install <git remote url>`

**Installs the package from the hosted git provider, cloning it with git.** For a full git remote url, only that URL will be attempted.

## Configuration

## Algorithm
