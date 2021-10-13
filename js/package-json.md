# package.json

A lot of the behavior described in this document is affected by the config settings described in [config](https://docs.npmjs.com/cli/v7/using-npm/config).

---

References

- [package.json - npm Docs](https://docs.npmjs.com/cli/v7/configuring-npm/package-json)

## Description

It must be actual JSON, not just a JavaScript object literal.

A lot of the behavior described in this document is affected by the config settings described in [config](https://docs.npmjs.com/cli/v7/using-npm/config).

## name

If you plan to publish your package, the most important things in your `package.json` are the name and version fields as they will be required.
The name and version together form an identifier that is assumed to be completely unique.
Changes to the package should come along with changes to the version.
If you don't plan to publish your package, the name and version fields are optional.

**The name is what your thing is called.**

Some rules:

-   The name must be **less than or equal to 214 characters**.
    This includes the scope for scoped packages.
-   The names of scoped packages **can begin with a dot or an underscore**.
    This is not permitted without a scope.
-   New packages **must not have uppercase letters** in the name.
-   The name ends up being part of a URL, an argument on the command line, and a folder name.
    Therefore, the name **can't contain any non-URL-safe characters**.

_Some tips:_

- _Don't use the same name as a core Node module._
- _Don't put "js" or "node" in the name. It's assumed that it's js, since you're writing a package.json file, and you can specify the engine using the "engines" field. (See below.)_
- _The name will probably be passed as an argument to require(), so it should be something short, but also reasonably descriptive._
- _You may want to check the npm registry to see if there's something by that name already, before you get too attached to it. [www.npmjs.com](https://www.npmjs.com/)_

A name can be optionally prefixed by a scope, e.g. `@myorg/mypackage`.
See [scope](https://docs.npmjs.com/cli/v7/using-npm/scope/) for more detail.

## version

……
**The name and version together form an identifier that is assumed to be completely unique.**
……

Version must be parseable by [node-semver](https://github.com/npm/node-semver), which is bundled with npm as a dependency.
(`npm install semver` to use it yourself.)

## description

Put a description in it. It's a string.
This helps people discover your package, as **it's listed in `npm search`.**

## keywords

_Put keywords in it. It's an array of strings._
_This helps people discover your package as it's listed in `npm search`._

## homepage

**The url to the project homepage.**

## bugs

**The url to your project's issue tracker and / or the email address to which issues should be reported.**
These are helpful for people who encounter issues with your package.

_It should look like this:_

```json
{
  "url" : "https://github.com/owner/project/issues",
  "email" : "project@hostname.com"
}
```

……

_If a url is provided, it will be used by the `npm bugs` command._

## license

_You should specify a license for your package so that people know how they are permitted to use it, and any restrictions you're placing on it._

## people fields: author, contributors

The "author" is one person.
"contributors" is an array of people.

……

## _funding_

You can specify an object containing an URL that provides up-to-date information about ways to help fund development of your package, or a string URL, or an array of these: ……

## files

The optional `files` field is an array of file patterns that **describes the entries to be included when your package is installed as a dependency.**
_File patterns follow a similar syntax to `.gitignore`, but reversed: including a file, directory, or glob pattern (`*`, `**/*`, and such) will make it so that file is included in the tarball when it's packed._
**Omitting the field will make it default to `["*"]`, which means it will include all files.**

_Some special files and directories are also included or excluded regardless of whether they exist in the `files` array (see below)._

**You can also provide a `.npmignore` file in the root of your package or in subdirectories, which will keep files from being included.**
At the root of your package it will not override the "files" field, but in subdirectories it will.
The `.npmignore` file works just like a `.gitignore`.
If there is a `.gitignore` file, and `.npmignore` is missing, `.gitignore`'s contents will be used instead.

**Files included with the "package.json#files" field cannot be excluded through `.npmignore` or `.gitignore`.**

Certain files are **always included**, regardless of settings:

- **`package.json`**
- **`README`**
- **`LICENSE` / `LICENCE`**
- **The file in the "main" field**

`README` & `LICENSE` can have any case and extension.

_Conversely, some files are always ignored:_

- `.git`
- `CVS`
- `.svn`
- `.hg`
- `.lock-wscript`
- `.wafpickle-N`
- `.*.swp`
- `.DS_Store`
- `._*`
- `npm-debug.log`
- `.npmrc`
- `node_modules`
- `config.gypi`
- `*.orig`
- `package-lock.json` ( use `npm-shrinkwrap.json` if you wish it to be published )

## main

**The main field is a <u>module ID</u> that is the primary entry point to your program.**
That is, if your package is named `foo`, and a user installs it, and then does `require("foo")`, then your main module's exports object will be returned.

This **should be a module relative to the root of your package folder.**

For most modules, it makes the most sense to have a main script and often not much else.

**If `main` is not set it defaults to `index.js` in the packages root folder.**

## browser

If your module is meant to be used client-side the `browser` field should be used instead of the `main` field.
_This is helpful to hint users that it might rely on primitives that aren't available in Node.js modules. (e.g. `window`)_

## bin

A lot of packages have one or more executable files that they'd like to install into the `PATH`.
_npm makes this pretty easy (in fact, it uses this feature to install the "npm" executable.)_

To use this, **supply a `bin` field in your `package.json` which is a map of command name to local file name.**
When this package is installed globally, that file will be linked where global bins go so it is available to run by name.
When this package is installed as a dependency in another package, the file will be linked where it will be available to that package either directly by `npm exec` or by name in other scripts when invoking them via `npm run-script`.
