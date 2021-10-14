# npm

npm is the world's largest software registry.
_Open source developers from every continent use npm to share and borrow packages,_
_and many organizations use npm to manage private development as well._

---

References

- [npmjs.com](https://www.npmjs.com/)
    - [About npm](https://docs.npmjs.com/about-npm)
    - [Get Started](https://docs.npmjs.com/getting-started)

Others

- 全局安装:
    - 建议不要在全局安装 `npm i -g [pakcage_name]`
    - 只在对应项目安装所需要的包 `npm i [pakcage_name]` 然后使用 `npx [package_command]`

## About

npm consists of three distinct components:

- the website
- the Command Line Interface (CLI)
- the registry

Use the website to discover packages, set up profiles, and manage other aspects of your npm experience.
_For example, you can set up organizations to manage access to public or private packages._

The CLI runs from a terminal, and is how most developers interact with `npm`.

The registry is a large public database of JavaScript software and the meta-information surrounding it.

## Packages

**A package is a file or directory that is described by a `package.json` file.**
A package must contain a `package.json` file in order to be published to the npm registry.

Packages can be unscoped or scoped to a user or organization, and scoped packages can be private or public.

### Package Formats

A package is any of the following:

- (a) A folder containing a program described by a package.json file.
- (b) A gzipped tarball containing (a).
- (c) A URL that resolves to (b).
- (d) A `<name>@<version>` that is published on the registry with (c).
- (e) A `<name>@<tag>` that points to (d).
- (f) A `<name>` that has a latest tag satisfying (e).
- (g) A git url that, when cloned, results in (a).

### npm package git URL formats

Git URLs used for npm packages can be formatted in the following ways:

```bash
git://github.com/user/project.git#commit-ish
git+ssh://user@hostname:project.git#commit-ish
git+http://user@hostname/project/blah.git#commit-ish
git+https://user@hostname/project/blah.git#commit-ish
```

The commit-ish can be any tag, sha, or branch that can be supplied as an argument to git checkout.
The default commit-ish is master.

## Modules

A module is any file or directory in the node_modules directory that can be loaded by the Node.js `require()` function.

To be loaded by the Node.js `require()` function, a module must be one of the following:

- A folder with a `package.json` file containing a "main" field.
- A JavaScript file.

Note: Since modules are not required to have a `package.json` file, not all modules are packages.

Only modules that have a `package.json` file are also packages.

_In the context of a Node program, the module is also the thing that was loaded from a file._
_For example, in the following program:_

```js
var req = require('request')
```

_we might say that "The variable req refers to the request module"._

### Scopes

When you sign up for an npm user account or create an organization,
you are granted a scope that matches your user or organization name.
You can use this scope as a namespace for related packages.

A scope allows you to create a package with the same name as a package
created by another user or organization without conflict.

When listed as a dependent in a `package.json` file,
**scoped packages are preceded by their scope name.**
The scope name is everything between the @ and the slash:

- "npm" scope: `@npm/package-name`
- "npmcorp" scope: `@npmcorp/package-name`

### Scopes and package visibility

- Unscoped packages are always public.
- Private packages are always scoped.

Scoped packages are private by default;
you must pass a command-line flag when publishing to make them public.

## Contribute Packages to the Registry

### Creating package.json

You can add a `package.json` file to your package to make it easy for others to manage and install.
Packages published to the registry must contain a package.json file.

A package.json file:

- lists the packages your project depends on
- specifies versions of a package that your project can use using semantic versioning rules
- makes your build reproducible, and therefore easier to share with other developers

**Required name and version fields**

A package.json file must contain `name` and `version` fields.

- The `name` field contains your package's name, and must be lowercase and one word, and may contain hyphens and underscores.
- The `version` field must be in the form `x.x.x` and follow the semantic versioning guidelines.

**Author field**

If you want to include package author information in `author` field,
use the following format (email and website are both optional):

```bash
Your Name <email@example.com> (http://example.com)
```

Example

```json
{
  "name": "my-awesome-package",
  "version": "1.0.0"
}
```

## Using npm

TODO

### Registry

### Config

### Scope

### Scripts

### Workspaces

### Organizations

### Developers

### Removal

## Others

- Temporarily omitted
