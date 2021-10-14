# npm package-lock.json

A manifestation of the manifest

---

References

- [package-lock.json - npm Docs](https://docs.npmjs.com/cli/v7/configuring-npm/package-lock-json)

## Description

`package-lock.json` is **automatically generated for any operations where npm modifies either the `node_modules` tree, or `package.json`.**
It **describes the exact tree that was generated**, such that subsequent installs are able to generate identical trees, regardless of intermediate dependency updates.

This file is **intended to be committed into source repositories**, and serves various purposes:

- **Describe a single representation of a dependency tree** such that teammates, deployments, and continuous integration **are guaranteed to install exactly the same dependencies.**
- **Provide a facility for users to "time-travel" to previous states of `node_modules`** without having to commit the directory itself.
- **Facilitate greater visibility of tree changes** through readable source control diffs.
- **Optimize the installation process by allowing npm to skip repeated metadata resolutions** for previously-installed packages.
- As of npm v7, lockfiles include enough information to **gain a complete picture of the package tree, reducing the need to read `package.json` files, and allowing for significant performance improvements.**

## package-lock.json vs npm-shrinkwrap.json

Both of these files have the same format, and perform similar functions in the root of a project.

The difference is that `package-lock.json` cannot be published, and it will be ignored if found in any place other than the root project.

_In contrast, [`npm-shrinkwrap.json`](https://docs.npmjs.com/cli/v7/configuring-npm/npm-shrinkwrap-json) allows publication, and defines the dependency tree from the point encountered._
_This is not recommended unless deploying a CLI tool or otherwise using the publication process for producing production packages._

_If both `package-lock.json` and `npm-shrinkwrap.json` are present in the root of a project, `npm-shrinkwrap.json` will take precedence and `package-lock.json` will be ignored._

## Hidden Lockfiles
