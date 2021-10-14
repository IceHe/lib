# workspaces

Working with workspaces

---

References

- [workspaces - npm docs](https://docs.npmjs.com/cli/v7/using-npm/workspaces)

## Description

**Workspaces** is a generic term that refers to the set of features in the npm cli that provides support to managing multiple packages from your local files system from within a singular top-level, root package.

This set of features makes up for a much more streamlined workflow handling linked packages from the local file system.
Automating the linking process as part of `npm install` and avoiding manually having to use `npm link` in order to add references to packages that should be symlinked into the current `node_modules` folder.

We also refer to these packages being auto-symlinked during `npm install` as a single **workspace**, meaning it's a nested package within the current local file system that is explicitly defined in the `package.json` `workspaces` configuration.

## Defining workspaces

Workspaces are usually defined via the workspaces property of the `package.json` file, e.g:

```json
{
  "name": "my-workspaces-powered-project",
  "workspaces": [
    "workspace-a"
  ]
}
```

Given the above `package.json` example living at a current working directory `.` that contains a folder named `workspace-a` that itself contains a `package.json` inside it, defining a Node.js package, e.g:

```bash
.
+-- package.json
`-- workspace-a
   `-- package.json
```

The expected result once running `npm install` in this current working directory `.` is that the folder `workspace-a` will get symlinked to the `node_modules` folder of the current working dir.

Below is a post `npm install` example, given that same previous example structure of files and folders:

```bash
.
+-- node_modules
|  `-- workspace-a -> ../workspace-a
+-- package-lock.json
+-- package.json
`-- workspace-a
   `-- package.json
```

## Getting started with workspaces

You may automate the required steps to define a new workspace using [`npm init`](https://docs.npmjs.com/cli/v7/commands/npm-init).
For example in a project that already has a `package.json` defined you can run:

```bash
npm init -w ./packages/a
```

This command will create the missing folders and a new `package.json` file (if needed) while also making sure to properly configure the `"workspaces"` property of your root project `package.json`.

## Adding dependencies to a workspace

It's possible to directly add/remove/update dependencies of your workspaces using the [`workspace` config](https://docs.npmjs.com/cli/v7/using-npm/config#workspace).

For example, assuming the following structure:

```bash
.
+-- package.json
`-- packages
   +-- a
   |   `-- package.json
   `-- b
       `-- package.json
```

If you want to add a dependency named `abbrev` from the registry as a dependency of your workspace **a**, you may use the workspace config to tell the npm installer that package should be added as a dependency of the provided workspace:

```bash
npm install abbrev -w a
```

Note: other installing commands such as `uninstall`, `ci`, etc will also respect the provided `workspace` configuration.

## Using workspaces

## Running commands in the context of workspaces

## Ignoring missing scripts
