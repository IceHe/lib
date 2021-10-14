# scripts

How npm handles the "scripts" field

---

References

- [scripts - npm docs](https://docs.npmjs.com/cli/v7/using-npm/scripts)

## Description

**The "scripts" property of your `package.json` file supports a number of built-in scripts and their preset life cycle events as well as arbitrary scripts.**
These all can be executed by running `npm run-script <stage>` or `npm run <stage>` for short.

Pre and post commands with matching names will be run for those as well
_( e.g. `premyscript`, `myscript`, `postmyscript` )_ .
Scripts from dependencies can be run with `npm explore <pkg> -- npm run <stage>`.

## Pre & Post Scripts

To create "pre" or "post" scripts for any scripts defined in the `"scripts"` section of the `package.json`, simply create another script with a matching name and add "pre" or "post" to the beginning of them.

```json
{
  "scripts": {
    "precompress": "{{ executes BEFORE the `compress` script }}",
    "compress": "{{ run command to compress files }}",
    "postcompress": "{{ executes AFTER `compress` script }}"
  }
}
```

In this example `npm run compress` would execute these scripts as described.

## Life Cycle Scripts

There are some special life cycle scripts that happen only in certain situations.
These scripts happen in addition to the `pre<event>`, `post<event>`, and `<event>` scripts.

- `prepare`, `prepublish`, `prepublishOnly`, `prepack`, `postpack`

---

-   **prepare** (since npm@4.0.0)

    - Runs any time before the package is packed, i.e. during npm publish and npm pack
    - Runs BEFORE the package is packed
    - Runs BEFORE the package is published
    - Runs on local npm install without any arguments
    - Run AFTER prepublish, but BEFORE prepublishOnly
    - NOTE: If a package being installed through git contains a prepare script, its dependencies and devDependencies will be installed, and the prepare script will be run, before the package is packaged and installed.
    - As of npm@7 these scripts run in the background. To see the output, run with: --foreground-scripts.

-   ~~prepublish (DEPRECATED)~~

    -   Does not run during npm publish, but does run during npm ci and npm install.
        See below for more info.

-   **prepublishOnly**

    -   Runs BEFORE the package is prepared and packed, ONLY on npm publish.

-   **prepack**

    -   Runs BEFORE a tarball is packed (on "npm pack", "npm publish", and when installing a git dependencies).
    -   NOTE: "npm run pack" is NOT the same as "npm pack". "npm run pack" is an arbitrary user defined script name, where as, "npm pack" is a CLI defined command.

-   **postpack**

    - Runs AFTER the tarball has been generated but before it is moved to its final destination (if at all, publish does not save the tarball locally)

### Prepare and Prepublish

#### Deprecation Note: ~~prepublish~~

#### Use Cases

## Life Cycle Operation Order

### npm cache add

### npm ci

### npm diff

### npm install

### npm pack

### npm publish

### npm rebuild

### npm restart

### npm run <user defined>

### npm start

### npm stop

### npm test

### A Note on a lack of npm uninstall scripts

## User

## Environment

### path

### package.json vars

### current lifecycle event

## Examples

## Exiting

## Best Practices

## See Also
