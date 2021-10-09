# tsconfig.json

---

References

- TypeScript Handbook
    - [What is a tsconfig.json](https://www.typescriptlang.org/docs/handbook/tsconfig-json.html)
    - [TSCOnfig Reference](https://www.typescriptlang.org/tsconfig)

## Overview

**The presence of a `tsconfig.json` file in a directory indicates that the directory is the root of a TypeScript project.**
**The `tsconfig.json` file specifies the root files and the compiler options required to compile the project.**

_A project is compiled in one of the following ways:_

## Using tsconfig.json

or jsconfig.json

- By invoking tsc with no input files, in which case the compiler searches for the `tsconfig.json` file starting in the current directory and continuing up the parent directory chain.
- By invoking tsc with no input files and a `--project` (or just `-p`) command line option that specifies the path of a directory containing a `tsconfig.json` file, or a path to a valid `.json` file containing the configurations.

When input files are specified on the command line, `tsconfig.json` files are ignored.

Example `tsconfig.json` files:

-   Using the **`files`** property

    ```json
    {
        "compilerOptions": {
            "module": "commonjs",
            "noImplicitAny": true,
            "removeComments": true,
            "preserveConstEnums": true,
            "sourceMap": true
        },
        "files": [
            "core.ts",
            "sys.ts",
            "types.ts",
            "scanner.ts",
            "parser.ts",
            "utilities.ts",
            "binder.ts",
            "checker.ts",
            "emitter.ts",
            "program.ts",
            "commandLineParser.ts",
            "tsc.ts",
            "diagnosticInformationMap.generated.ts"
        ]
    }
    ```

-   Using the **`include`** and **`exclude`** properties

    ```json
    {
        "compilerOptions": {
            "module": "system",
            "noImplicitAny": true,
            "removeComments": true,
            "preserveConstEnums": true,
            "outFile": "../../built/local/tsc.js",
            "sourceMap": true
        },
        "include": ["src/**/*"],
        "exclude": ["node_modules", "**/*.spec.ts"]
    }
    ```

## TSConfig Bases

Depending on the JavaScript runtime environment which you intend to run your code in, there may be a base configuration which you can use at [github.com/tsconfig/bases](https://github.com/tsconfig/bases/).
_These are `tsconfig.json` files which your project extends from which simplifies your `tsconfig.json` by handling the runtime support._

_For example, if you were writing a project which uses Node.js version 16 and above, then you could use the npm module `@tsconfig/node16`:_

- Using the **`extends`** property

    ```json
    {
        "extends": "@tsconfig/node16/tsconfig.json",
        "compilerOptions": {
            "preserveConstEnums": true
        },
        "include": ["src/**/*"],
        "exclude": ["node_modules", "**/*.spec.ts"]
    }
    ```

## TSConfig Reference

### Category

Top Level ( Root Field )

- files
- extends
- include
- exclude
- references

`"compilerOptions"`

-   Type Checking

    - allowUnreachableCode
    - allowUnusedLabels
    - alwaysStrict
    - exactOptionalPropertyTypes
    - noFallthroughCasesInSwitch
    - noImplicitAny
    - noImplicitOverride
    - noImplicitReturns
    - noImplicitThis
    - noPropertyAccessFromIndexSignature
    - noUncheckedIndexedAccess
    - noUnusedLocals
    - noUnusedParameters
    - strict
    - strictBindCallApply
    - strictFunctionTypes
    - strictNullChecks
    - strictPropertyInitialization
    - useUnknownInCatchVariables

-   Modules

    - allowUmdGlobalAccess
    - baseUrl
    - module
    - moduleResolution
    - noResolve
    - paths
    - resolveJsonModule
    - rootDir
    - rootDirs
    - typeRoots andtypes

-   Emit

    - declaration
    - declarationDir
    - declarationMap
    - downlevelIteration
    - emitBOM
    - emitDeclarationOnly
    - importHelpers
    - importsNotUsedAsValues
    - inlineSourceMap
    - inlineSources
    - mapRoot
    - newLine
    - noEmit
    - noEmitHelpers
    - noEmitOnError
    - outDir
    - outFile
    - preserveConstEnums
    - preserveValueImports
    - removeComments
    - sourceMap
    - sourceRoot
    - stripInternal

-   JavaScript Support

    - allowJs
    - checkJs
    - maxNodeModuleJsDepth

-   Editor Support

    - disableSizeLimit
    - plugins

-   Interop Constraints

    - allowSyntheticDefaultImports
    - esModuleInterop
    - forceConsistentCasingInFileNames
    - isolatedModules andpreserveSymlinks

-   Backwards Compatibility

    - charset
    - keyofStringsOnly
    - noImplicitUseStrict
    - noStrictGenericChecks
    - out
    - suppressExcessPropertyErrors
    - suppressImplicitAnyIndexErrors

-   Language and Environment

    - emitDecoratorMetadata
    - experimentalDecorators
    - jsx
    - jsxFactory
    - jsxFragmentFactory
    - jsxImportSource
    - lib
    - noLib
    - reactNamespace
    - target
    - useDefineForClassFields

-   Compiler Diagnostics

    - diagnostics
    - explainFiles
    - extendedDiagnostics
    - generateCpuProfile
    - listEmittedFiles
    - listFiles
    - traceResolution

-   Projects

    - composite
    - disableReferencedProjectLoad
    - disableSolutionSearching
    - disableSourceOfProjectReferenceRedirect
    - incremental
    - tsBuildInfoFile

-   Output Formatting

    - noErrorTruncation
    - preserveWatchOutput
    - pretty

-   Completeness

    - skipDefaultLibCheck
    - skipLibCheck

-   Command Line

-   Watch Options

    - assumeChangesOnlyAffectDirectDependencies

`"watchOptions"`

- watchFile
- watchDirectory
- fallbackPolling
- synchronousWatchDirectory
- excludeDirectories
- excludeFiles

`"typeAcquisition"`

- enable
- include
- exclude
- disableFilenameBasedTypeAcquisition

### Root Field

#### files

**Specifies an allowlist of files to include in the program.**
_An error occurs if any of the files can't be found._

```json
{
  "compilerOptions": {},
  "files": [
    "core.ts",
    "sys.ts",
    "types.ts",
    "scanner.ts",
    "parser.ts",
    "utilities.ts",
    "binder.ts",
    "checker.ts",
    "tsc.ts"
  ]
}
```

#### extends

**The value of `extends` is a string which contains a path to another configuration file to inherit from.**
_The path may use Node.js style resolution._

The configuration from the base file are loaded first, then overridden by those in the inheriting config file.
_All relative paths found in the configuration file will be resolved relative to the configuration file they originated in._

It's worth noting that <!-- 值得注意的是 -->

- **`files`, `include` and `exclude` from the inheriting config file overwrite those from the base config file,**
- **and that circularity between configuration files is not allowed.**

Example

`configs/base.json`:

```json
{
  "compilerOptions": {
    "noImplicitAny": true,
    "strictNullChecks": true
  }
}
```

`tsconfig.json`:

```json
{
  "extends": "./configs/base",
  "files": ["main.ts", "supplemental.ts"]
}
```

`tsconfig.nostrictnull.json`:

```json
{
  "extends": "./tsconfig",
  "compilerOptions": {
    "strictNullChecks": false
  }
}
```

Properties with relative paths found in the configuration file, which aren't excluded from inheritance, will be resolved relative to the configuration file they originated in.

#### include

**Specifies an array of filenames or patterns to include in the program.**
These filenames are resolved relative to the directory containing the `tsconfig.json` file.

```json
{
  "include": ["src/**/*", "tests/**/*"]
}
```

`include` and `exclude` support wildcard characters to make glob patterns:

- `*` matches zero or more characters (excluding directory separators)
- `?` matches any one character (excluding directory separators)
- **`**/` matches any directory nested to any level**

**If a glob pattern doesn't include a file extension, then only files with supported extensions are included** (e.g. `.ts`, `.tsx`, and `.d.ts` by default, with `.js` and `.jsx` if `allowJs` is set to true).

#### exclude

**Specifies an array of filenames or patterns that should be skipped when resolving `include`.**

#### references

### Compiler Options

#### Top Level

#### Type Checking

### Watch Options

### Type Acquisition

TODO
