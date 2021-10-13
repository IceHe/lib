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
