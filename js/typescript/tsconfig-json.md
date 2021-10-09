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

Important: **`exclude` only changes which files are included as a result of the `include` setting.**
A file specified by `exclude` can still become part of your codebase due to an `import` statement in your code, a types inclusion, a `/// <reference` directive, or being specified in the `files` list.

It is not a mechanism that **prevents** a file from being included in the codebase - it simply changes what the `include` setting finds.

#### references

Project references are **a way to structure your TypeScript programs into smaller pieces.**
Using Project References can greatly improve build and editor interaction times, enforce logical separation between components, and organize your code in new and improved ways.

Further reading: [Project References - TypeScript Handbook](https://www.typescriptlang.org/docs/handbook/project-references.html)

### Compiler Options

#### Type Checking

##### allowUnreachableCode

When:

- `undefined` (default) provide suggestions as warnings to editors
- `true` unreachable code is ignored
- `false` raises compiler errors about unreachable code

These warnings are only about code which is provably unreachable due to the use of JavaScript syntax, for example:

With `"allowUnreachableCode": false`:

```js
function fn(n: number) {
  if (n > 5) {
    return true;
  } else {
    return false;
  }
  return true;
  // Unreachable code detected.
}
```

This does not affect errors on the basis of code which appears to be unreachable due to type analysis.

##### allowUnusedLabels

When:

- `undefined` (default) provide suggestions as warnings to editors
- `true` unused labels are ignored
- `false` raises compiler errors about unused labels

Labels are very rare in JavaScript and typically indicate an attempt to write an object literal:

```js
function verifyAge(age: number) {
  // Forgot 'return' statement
  if (age > 18) {
    verified: true;
    // Unused label.
  }
}
```

##### alwaysStrict

**Ensures that your files are parsed in the ECMAScript strict mode, and emit "use strict" for each source file.**

ECMAScript strict mode was introduced in ES5 and provides behavior tweaks to the runtime of the JavaScript engine to improve performance, and makes a set of errors throw instead of silently ignoring them.

##### exactOptionalPropertyTypes

With `exactOptionalPropertyTypes` enabled, TypeScript **applies stricter rules around how it handles properties on `type` or `interface`s which have a `?` prefix.**

For example, this interface declares that there is a property which can be one of two strings: "dark" or "light" or it should not be in the object.

```js
interface UserDefaults {
  // The absence of a value represents 'system'
  colorThemeOverride?: "dark" | "light";
}
```

Without this flag enabled, there are three values which you can set colorThemeOverride to be: "dark", "light" and `undefined`.

Setting the value to `undefined` will allow most JavaScript runtime checks for the existence to fail, which is effectively falsy.
However, this isn't quite accurate `colorThemeOverride: undefined` is not the same as `colorThemeOverride` not being defined.
For example `"colorThemeOverride" in settings` would have different behavior with `undefined` as the key compared to not being defined.

`exactOptionalPropertyTypes` makes TypeScript truly enforce the definition provided as an optional property:

```js
const settings = getUserSettings();
settings.colorThemeOverride = "dark";
settings.colorThemeOverride = "light";

// But not:
settings.colorThemeOverride = undefined;
// Type 'undefined' is not assignable to type '"dark" | "light"' with 'exactOptionalPropertyTypes: true'.
// Consider adding 'undefined' to the type of the target.
```

##### noFallthroughCasesInSwitch

**Report errors for fallthrough cases in switch statements.**
Ensures that any non-empty case inside a switch statement includes either `break` or `return`.
This means you won't accidentally ship a case fallthrough bug.

```js
const a: number = 6;

switch (a) {
  case 0:
Fallthrough case in switch.
    console.log("even");
  case 1:
    console.log("odd");
    break;
}
```

##### noImplicitAny

**In some cases where no type annotations are present, TypeScript will fall back to a type of any for a variable when it cannot infer the type.**

**This can cause some errors to be missed**, for example:

```js
function fn(s) {
  // No error?
  console.log(s.subtr(3));
}
fn(42);
```

Turning on `noImplicitAny` however TypeScript will issue an error whenever it would have inferred `any`:

```js
function fn(s) {
  // Parameter 's' implicitly has an 'any' type.
  console.log(s.subtr(3));
}
```

##### noImplicitOverride

**When working with classes which use inheritance, it's possible for a sub-class to get "out of sync" with the functions it overloads when they are renamed in the base class.**

Using `noImplicitOverride` you can ensure that the sub-classes never go out of sync, by **ensuring that functions which override include the keyword `override`.**

The following example has `noImplicitOverride` enabled, and you can see the error received when `override` is missing:

```js
class Album {
  setup() {}
}

class MLAlbum extends Album {
  override setup() {}
}

class SharedAlbum extends Album {
  setup() {}
  // This member must have an 'override' modifier because it overrides a member in the base class 'Album'.
}
```

##### noImplicitReturns

When enabled, TypeScript will **check all code paths in a function to ensure they return a value.**

```js
function lookupHeadphonesManufacturer(color: "blue" | "black"): string {
  // Function lacks ending return statement and return type does not include 'undefined'.
  if (color === "blue") {
    return "beats";
  } else {
    "bose";
  }
}
```

##### noImplicitThis

**Raise error on "this" expressions with an implied "any" type.**

For example, the class below returns a function which tries to access `this.width` and `this.height` – but the context for `this` inside the function inside `getAreaFunction` is not the instance of the Rectangle.

```js
class Rectangle {
  width: number;
  height: number;

  constructor(width: number, height: number) {
    this.width = width;
    this.height = height;
  }

  getAreaFunction() {
    return function () {
      return this.width * this.height;
      // 'this' implicitly has type 'any' because it does not have a type annotation.
      // 'this' implicitly has type 'any' because it does not have a type annotation.
    };
  }
}
```

##### noPropertyAccessFromIndexSignature

This setting **ensures consistency between accessing a field via the “dot” (`obj.key`) syntax, and "indexed" (`obj["key"]`) and the way which the property is declared in the type.**

Without this flag, TypeScript will allow you to use the dot syntax to access fields which are not defined:

```js
interface GameSettings {
  // Known up-front properties
  speed: "fast" | "medium" | "slow";
  quality: "high" | "low";

  // Assume anything unknown to the interface
  // is a string.
  [key: string]: string;
}

const settings = getSettings();
settings.speed;
// (property) GameSettings.speed: "fast" | "medium" | "slow"

settings.quality;
// (property) GameSettings.quality: "high" | "low"

// Unknown key accessors are allowed on
// this object, and are `string`
settings.username;
```

Turning the flag on will raise an error because the unknown field uses dot syntax instead of indexed syntax.

```js
const settings = getSettings();
settings.speed;
settings.quality;

// This would need to be settings["username"];
settings.username;
// Property 'username' comes from an index signature, so it must be accessed with ['username'].
```

The goal of this flag is to signal intent in your calling syntax about how certain you are this property exists.

##### noUncheckedIndexedAccess

##### noUnusedLocals

##### noUnusedParameters

##### strict

##### strictBindCallApply

##### strictFunctionTypes

##### strictNullChecks

##### strictPropertyInitialization

##### useUnknownInCatchVariables

#### Modules

##### allowUmdGlobalAccess

##### baseUrl

##### module

##### moduleResolution

##### noResolve

##### paths

##### resolveJsonModule

##### rootDir

##### rootDirs

##### typeRoots andtypes

#### Emit

##### declaration

##### declarationDir

##### declarationMap

##### downlevelIteration

##### emitBOM

##### emitDeclarationOnly

##### importHelpers

##### importsNotUsedAsValues

##### inlineSourceMap

##### inlineSources

##### mapRoot

##### newLine

##### noEmit

##### noEmitHelpers

##### noEmitOnError

##### outDir

##### outFile

##### preserveConstEnums

##### preserveValueImports

##### removeComments

##### sourceMap

##### sourceRoot

##### stripInternal

#### JavaScript Support

##### allowJs

##### checkJs

##### maxNodeModuleJsDepth

#### Editor Support

##### disableSizeLimit

##### plugins

#### Interop Constraints

##### allowSyntheticDefaultImports

##### esModuleInterop

##### forceConsistentCasingInFileNames

##### isolatedModules andpreserveSymlinks

#### Backwards Compatibility

##### charset

##### keyofStringsOnly

##### noImplicitUseStrict

##### noStrictGenericChecks

##### out

##### suppressExcessPropertyErrors

##### suppressImplicitAnyIndexErrors

#### Language and Environment

##### emitDecoratorMetadata

##### experimentalDecorators

##### jsx

##### jsxFactory

##### jsxFragmentFactory

##### jsxImportSource

##### lib

##### noLib

##### reactNamespace

##### target

##### useDefineForClassFields

#### Compiler Diagnostics

##### diagnostics

##### explainFiles

##### extendedDiagnostics

##### generateCpuProfile

##### listEmittedFiles

##### listFiles

##### traceResolution

#### Projects

##### composite

##### disableReferencedProjectLoad

##### disableSolutionSearching

##### disableSourceOfProjectReferenceRedirect

##### incremental

##### tsBuildInfoFile

#### Output Formatting

##### noErrorTruncation

##### preserveWatchOutput

##### pretty

#### Completeness

##### skipDefaultLibCheck

##### skipLibCheck

#### Command Line

TBD 暂无?

#### Watch Options

assumeChangesOnlyAffectDirectDependencies

### watchOptions

- watchFile
- watchDirectory
- fallbackPolling
- synchronousWatchDirectory
- excludeDirectories
- excludeFiles

### typeAcquisition

- enable
- include
- exclude
- disableFilenameBasedTypeAcquisition
