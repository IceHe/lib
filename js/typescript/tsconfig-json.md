# tsconfig.json

specifies the root files and the compiler options required to compile the project

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

```ts
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

```ts
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

_For example, this interface declares that there is a property which can be one of two strings: "dark" or "light" or it should not be in the object._

```ts
interface UserDefaults {
  // The absence of a value represents 'system'
  colorThemeOverride?: "dark" | "light";
}
```

Without this flag enabled, there are three values which you can set colorThemeOverride to be: "dark", "light" and `undefined`.

Setting the value to `undefined` will allow most JavaScript runtime checks for the existence to fail, which is effectively falsy.
However, this isn't quite accurate `colorThemeOverride: undefined` is not the same as `colorThemeOverride` not being defined.
For example `"colorThemeOverride" in settings` would have different behavior with `undefined` as the key compared to not being defined.

_`exactOptionalPropertyTypes` makes TypeScript truly enforce the definition provided as an optional property:_

```ts
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

```ts
const a: number = 6;

switch (a) {
  case 0:
    // Fallthrough case in switch.
    console.log("even");
  case 1:
    console.log("odd");
    break;
}
```

##### noImplicitAny

**In some cases where no type annotations are present, TypeScript will fall back to a type of any for a variable when it cannot infer the type.**

**This can cause some errors to be missed**, _for example:_

```ts
function fn(s) {
  // No error?
  console.log(s.subtr(3));
}
fn(42);
```

_Turning on `noImplicitAny` however TypeScript will issue an error whenever it would have inferred `any`:_

```ts
function fn(s) {
  // Parameter 's' implicitly has an 'any' type.
  console.log(s.subtr(3));
}
```

##### noImplicitOverride

**When working with classes which use inheritance, it's possible for a sub-class to get "out of sync" with the functions it overloads when they are renamed in the base class.**

Using `noImplicitOverride` you can ensure that the sub-classes never go out of sync, by **ensuring that functions which override include the keyword `override`.**

The following example has `noImplicitOverride` enabled, and you can see the error received when `override` is missing:

```ts
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

```ts
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

```ts
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

```ts
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

```ts
const settings = getSettings();
settings.speed;
settings.quality;

// This would need to be settings["username"];
settings.username;
// Property 'username' comes from an index signature, so it must be accessed with ['username'].
```

The goal of this flag is to signal intent in your calling syntax about how certain you are this property exists.

##### noUncheckedIndexedAccess

TypeScript has a way to describe objects which have unknown keys but known values on an object, via index signatures.

```ts
interface EnvironmentVars {
  NAME: string;
  OS: string;

  // Unknown properties are covered by this index signature.
  [propName: string]: string;
}

declare const env: EnvironmentVars;

// Declared as existing
const sysName = env.NAME;
const os = env.OS;

// Not declared, but because of the index
// signature, then it is considered a string
const nodeEnv = env.NODE_ENV;
// const nodeEnv: string
```

Turning on `noUncheckedIndexedAccess` will add `undefined` to any un-declared field in the type.

```ts
declare const env: EnvironmentVars;

// Declared as existing
const sysName = env.NAME;
const os = env.OS;

const os: string

// Not declared, but because of the index
// signature, then it is considered a string
const nodeEnv = env.NODE_ENV;
// const nodeEnv: string | undefined
```

##### noUnusedLocals

**Report errors on unused local variables.**

```ts
const createKeyboard = (modelID: number) => {
  const defaultModelID = 23;
  // 'defaultModelID' is declared but its value is never read.
  return { type: "keyboard", modelID };
};
```

##### noUnusedParameters

**Report errors on unused parameters in functions.**

```ts
const createDefaultKeyboard = (modelID: number) => {
  // 'modelID' is declared but its value is never read.
  const defaultModelID = 23;
  return { type: "keyboard", modelID: defaultModelID };
};
```

##### strict

The `strict` flag **enables a wide range of type checking behavior that results in stronger guarantees of program correctness.**
Turning this on is equivalent to enabling all of the strict mode family options, which are outlined below.
You can then turn off individual strict mode family checks as needed.

Future versions of TypeScript may introduce additional stricter checking under this flag, so upgrades of TypeScript might result in new type errors in your program.
When appropriate and possible, a corresponding flag will be added to disable that behavior.

##### strictBindCallApply

When set, TypeScript will **check that the built-in methods of functions call, bind, and apply are invoked with correct argument for the underlying function**:

```ts
// With strictBindCallApply on
function fn(x: string) {
  return parseInt(x);
}

const n1 = fn.call(undefined, "10");

const n2 = fn.call(undefined, false);
// Argument of type 'boolean' is not assignable to parameter of type 'string'.
```

Otherwise, these functions accept any arguments and will return `any`:

```ts
// With strictBindCallApply off
function fn(x: string) {
  return parseInt(x);
}

// Note: No error; return type is 'any'
const n = fn.call(undefined, false);
```

##### strictFunctionTypes

When enabled, this flag **causes functions parameters to be checked more correctly.**

_Here's a basic example with `strictFunctionTypes` off:_

```ts
function fn(x: string) {
  console.log("Hello, " + x.toLowerCase());
}

type StringOrNumberFunc = (ns: string | number) => void;

// Unsafe assignment
let func: StringOrNumberFunc = fn;
// Unsafe call - will crash
func(10);
```

_With `strictFunctionTypes` on, the error is correctly detected:_

```ts
function fn(x: string) {
  console.log("Hello, " + x.toLowerCase());
}

type StringOrNumberFunc = (ns: string | number) => void;

// Unsafe assignment is prevented
let func: StringOrNumberFunc = fn;
// Type '(x: string) => void' is not assignable to type 'StringOrNumberFunc'.
//   Types of parameters 'x' and 'ns' are incompatible.
//     Type 'string | number' is not assignable to type 'string'.
//       Type 'number' is not assignable to type 'string'.
```

_During development of this feature, we discovered a large number of inherently unsafe class hierarchies, including some in the DOM._
_Because of this, the setting only applies to functions written in function syntax, not to those in method syntax:_

```ts
type Methodish = {
  func(x: string | number): void;
};

function fn(x: string) {
  console.log("Hello, " + x.toLowerCase());
}

// Ultimately an unsafe assignment, but not detected
const m: Methodish = {
  func: fn,
};
m.func(10);
```

##### strictNullChecks

When `strictNullChecks` is `false`, `null` and `undefined` are effectively ignored by the language.
This can lead to unexpected errors at runtime.

**When `strictNullChecks` is `true`, `null` and `undefined` have their own distinct types and you'll get a type error if you try to use them where a concrete value is expected.**

_For example with this TypeScript code, `users.find` has no guarantee that it will actually find a user, but you can write code as though it will:_

```ts
declare const loggedInUsername: string;

const users = [
  { name: "Oby", age: 12 },
  { name: "Heera", age: 32 },
];

const loggedInUser = users.find((u) => u.name === loggedInUsername);
console.log(loggedInUser.age);
```

_Setting `strictNullChecks` to `true` will raise an error that you have not made a guarantee that the `loggedInUser` exists before trying to use it._

```ts
declare const loggedInUsername: string;

const users = [
  { name: "Oby", age: 12 },
  { name: "Heera", age: 32 },
];

const loggedInUser = users.find((u) => u.name === loggedInUsername);
console.log(loggedInUser.age);
// Object is possibly 'undefined'.
```

_The second example failed because the array's `find` function looks a bit like this simplification:_

```ts
// When strictNullChecks: true
type Array = {
  find(predicate: (value: any, index: number) => boolean): S | undefined;
};
// When strictNullChecks: false the undefined is removed from the type system,
// allowing you to write code which assumes it always found a result
type Array = {
  find(predicate: (value: any, index: number) => boolean): S;
};
```

##### strictPropertyInitialization

**When set to true, TypeScript will raise an error when a class property was declared but not set in the constructor.**

```ts
class UserAccount {
  name: string;
  accountType = "user";

  email: string;
  // Property 'email' has no initializer and is not definitely assigned in the constructor.
  address: string | undefined;

  constructor(name: string) {
    this.name = name;
    // Note that this.email is not set
  }
}
```

##### useUnknownInCatchVariables

In TypeScript 4.0, support was added to allow changing the type of the variable in a catch clause from `any` to `unknown`.
Allowing for code like:

```ts
try {
  // ...
} catch (err) {
  // We have to verify err is an
  // error before using it as one.
  if (err instanceof Error) {
    console.log(err.message);
  }
}
```

This pattern ensures that error handling code becomes more comprehensive because you cannot guarantee that the object being thrown is a Error subclass ahead of time.
With the flag `useUnknownInCatchVariables` enabled, then you do not need the additional syntax (`: unknown`) nor a linter rule to try enforce this behavior.

#### Modules

##### allowUmdGlobalAccess

When set to true, `allowUmdGlobalAccess` lets you **access UMD exports as globals from inside module files.**
A module file is a file that has imports and/or exports.
Without this flag, using an export from a UMD module requires an import declaration.

An example use case for this flag would be a web project where you know the particular library (like jQuery or Lodash) will always be available at runtime, but you can't access it with an import.

( icehe : What is UMD module? )

##### baseUrl

Lets you set **a base directory to resolve non-absolute module names**.

_You can define a root folder where you can do absolute file resolution. E.g._

```bash
baseUrl
├── ex.ts
├── hello
│   └── world.ts
└── tsconfig.json
```

_With `"baseUrl": "./"` inside this project TypeScript will look for files starting at the same folder as the `tsconfig.json`._

```ts
import { helloWorld } from "hello/world";
console.log(helloWorld);
```

_If you get tired of imports always looking like `"../"` or `"./"`, or needing to change them as you move files, this is a great way to fix that._

##### module

**Sets the module system for the program.**

See the [Modules](https://www.typescriptlang.org/docs/handbook/modules.html) reference page for more information.
You very likely want `"CommonJS"` for node projects.

Changing module affects [moduleResolution](https://www.typescriptlang.org/tsconfig#moduleResolution) which also has a [reference page](https://www.typescriptlang.org/docs/handbook/module-resolution.html).

_Here's some example output for this file:_

```ts
// @filename: index.ts
import { valueOfPi } from "./constants";

export const twoPi = valueOfPi * 2;
```

-   **CommonJS**

    ```ts
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.twoPi = void 0;
    const constants_1 = require("./constants");
    exports.twoPi = constants_1.valueOfPi * 2;
    ```

-   **UMD**

    ```ts
    (function (factory) {
    if (typeof module === "object" && typeof module.exports === "object") {
        var v = factory(require, exports);
        if (v !== undefined) module.exports = v;
    }
    else if (typeof define === "function" && define.amd) {
        define(["require", "exports", "./constants"], factory);
    }
    })(function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.twoPi = void 0;
    const constants_1 = require("./constants");
    exports.twoPi = constants_1.valueOfPi * 2;
    });
    ```

-   **AMD**

    ```ts
    define(["require", "exports", "./constants"], function (require, exports, constants_1) {
        "use strict";
        Object.defineProperty(exports, "__esModule", { value: true });
        exports.twoPi = void 0;
        exports.twoPi = constants_1.valueOfPi * 2;
    });
    ```

-   **System**

    ```ts
    System.register(["./constants"], function (exports_1, context_1) {
        "use strict";
        var constants_1, twoPi;
        var __moduleName = context_1 && context_1.id;
        return {
            setters: [
                function (constants_1_1) {
                    constants_1 = constants_1_1;
                }
            ],
            execute: function () {
                exports_1("twoPi", twoPi = constants_1.valueOfPi * 2);
            }
        };
    });
    ```

-   **ESNext**

    ```ts
    import { valueOfPi } from "./constants";
    export const twoPi = valueOfPi * 2;
    ```

-   **ES2020**

    ```ts
    import { valueOfPi } from "./constants";
    export const twoPi = valueOfPi * 2;
    ```

-   **ES2015/ES6**

    ```ts
    import { valueOfPi } from "./constants";
    export const twoPi = valueOfPi * 2;
    ```

    If you are wondering about the difference between `ES2015` (aka `ES6`) and `ES2020`, `ES2020` adds support for dynamic `import`s, and `import.meta`.

-   **node12/nodenext**

    ```ts
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.twoPi = void 0;
    const constants_js_1 = require("./constants.js");
    exports.twoPi = constants_js_1.valueOfPi * 2;
    ```

    Introduced in TypeScript 4.5, `node12` and `nodenext` declare support for Node’s ECMAScript Module Support.
    The emitted JavaScript is the same as `ES2020` which is the same `import/export` syntax in the TypeScript file.
    _You can learn more in the [4.5 release notes](https://devblogs.microsoft.com/typescript/announcing-typescript-4-5-beta/)._

-   **None**

    ```ts
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.twoPi = void 0;
    const constants_1 = require("./constants");
    exports.twoPi = constants_1.valueOfPi * 2;
    ```

##### moduleResolution

**Specify the module resolution strategy**:

-   `'node'` for Node.js' CommonJS implementation
-   `'node12'` or `'nodenext'` for Node.js' ECMAScript Module Support [from TypeScript 4.5 onwards](https://devblogs.microsoft.com/typescript/announcing-typescript-4-5-beta/)
-   `'classic'` used in TypeScript before the release of 1.6.
    You probably won’t need to use classic in modern code

##### noResolve

**By default, TypeScript will examine the initial set of files for `import` and `<reference` directives and add these resolved files to your program.**

**If `noResolve` is set, this process doesn't happen.**
However, `import` statements are still checked to see if they resolve to a valid module, so you'll need to make sure this is satisfied by some other means.

##### paths

**A series of entries which re-map imports to lookup locations relative to the `baseUrl`**, there is a larger coverage of `paths` in the handbook.

`paths` lets you declare how TypeScript should resolve an import in your `require/import`s.

```ts
{
  "compilerOptions": {
    "baseUrl": ".", // this must be specified if "paths" is specified.
    "paths": {
      "jquery": ["node_modules/jquery/dist/jquery"] // this mapping is relative to "baseUrl"
    }
  }
}
```

This would allow you to be able to write `import "jquery"`, and get all of the correct typing locally.

```ts
{
  "compilerOptions": {
    "baseUrl": "src",
    "paths": {
        "app/*": ["app/*"],
        "config/*": ["app/_config/*"],
        "environment/*": ["environments/*"],
        "shared/*": ["app/_shared/*"],
        "helpers/*": ["helpers/*"],
        "tests/*": ["tests/*"]
    },
}
```

In this case, you can tell the TypeScript file resolver to support a number of custom prefixes to find code.
This pattern can be used to avoid long relative paths within your codebase.

##### resolveJsonModule

**Allows importing modules with a ".json" extension, which is a common practice in node projects.**
This includes generating a type for the import based on the static JSON shape.

TypeScript does not support resolving JSON files by default:

```ts
// @filename: settings.json
// Cannot find module './settings.json'. Consider using '--resolveJsonModule' to import module with '.json' extension.
{
    "repo": "TypeScript",
    "dry": false,
    "debug": false
}
// @filename: index.ts
import settings from "./settings.json";

settings.debug === true;
settings.dry === 2;
```

_Enabling the option allows importing JSON, and validating the types in that JSON file._

```ts
// @filename: settings.json
{
    "repo": "TypeScript",
    "dry": false,
    // This condition will always return 'false' since the types 'boolean' and 'number' have no overlap.
    "debug": false
}
// @filename: index.ts
import settings from "./settings.json";

settings.debug === true;
settings.dry === 2;
```

##### rootDir

**Default**: The longest common path of all non-declaration input files.
**If `composite` is set, the default is instead the directory containing the `tsconfig.json` file.**

_For example, let’s say you have some input files:_

```ts
MyProj
├── tsconfig.json
├── core
│   ├── a.ts
│   ├── b.ts
│   ├── sub
│   │   ├── c.ts
├── types.d.ts
```

_The inferred value for `rootDir` is the longest common path of all non-declaration input files, which in this case is `core/`._

_If your `outDir` was dist, TypeScript would write this tree:_

```ts
MyProj
├── dist
│   ├── a.js
│   ├── b.js
│   ├── sub
│   │   ├── c.js
```

_However, you may have intended for core to be part of the output directory structure._
_By setting `rootDir: "."` in `tsconfig.json`, TypeScript would write this tree:_

```ts
MyProj
├── dist
│   ├── core
│   │   ├── a.js
│   │   ├── b.js
│   │   ├── sub
│   │   │   ├── c.js
```

Importantly, **`rootDir` does not affect which files become part of the compilation.**
It has no interaction with the `include`, `exclude`, or `files` `tsconfig.json` settings.

Note that TypeScript will never write an output file to a directory outside of `outDir`, and will never skip emitting a file.
For this reason, `rootDir` also enforces that all files which need to be emitted are underneath the `rootDir` path.

_For example, let’s say you had this tree:_ <!-- icehe : 暂时不够理解这个例子 2021/10/12 -->

```ts
MyProj
├── tsconfig.json
├── core
│   ├── a.ts
│   ├── b.ts
├── helpers.ts
```

_It would be an error to specify `rootDir` as `core` and `include` as `*` because it creates a file (`helpers.ts`) that would need to be emitted outside the `outDir` (i.e. `../helpers.js`)._

##### rootDirs

Using `rootDirs`, you can inform the compiler that there are many "virtual" directories acting as a single root.
This allows the compiler to resolve relative module imports within these "virtual" directories, as if they were merged in to one directory.

……

<!-- icehe : TODO if necessary someday 2021/10/12 -->

##### typeRoots

**By default all visible `"@types"` packages are included in your compilation.**
**Packages in `node_modules/@types` of any enclosing folder are considered visible.**
For example, that means packages within `./node_modules/@types/`, `../node_modules/@types/`, `../../node_modules/@types/`, and so on.

**If `typeRoots` is specified, only packages under `typeRoots` will be included.** For example:

```ts
{
  "compilerOptions": {
    "typeRoots": ["./typings", "./vendor/types"]
  }
}
```

This config file will include all packages under `./typings` and `./vendor/types`, and no packages from `./node_modules/@types`.
All paths are relative to the `tsconfig.json`.

##### types

……

**If `types` is specified, only packages listed will be included in the global scope.** For instance:

```ts
{
  "compilerOptions": {
    "types": ["node", "jest", "express"]
  }
}
```

……

#### Emit

##### declaration

**Generate `.d.ts` files for every TypeScript or JavaScript file inside your project.**

**These `.d.ts` files are type definition files which describe the external API of your module.**
With `.d.ts` files, tools like TypeScript can provide intellisense <!-- 知识界 --> and accurate types for un-typed code.

_When `declaration` is set to `true`, running the compiler with this TypeScript code:_

```ts
export let helloWorld = "hi";
```

_Will generate an `index.js` file like this:_

```ts
export let helloWorld = "hi";
```

_With a corresponding `helloWorld.d.ts`:_

```ts
export declare let helloWorld: string;
```

When working with `.d.ts` files for JavaScript files you may want to use `emitDeclarationOnly` or use `outDir` to ensure that the JavaScript files are not overwritten.

##### declarationDir

Offers a way to configure the root directory for where declaration files are emitted.

```bash
example
├── index.ts
├── package.json
└── tsconfig.json
```

_with this `tsconfig.json`:_

```json
{
  "compilerOptions": {
    "declaration": true,
    "declarationDir": "./types"
  }
}
```

_Would place the d.ts for the `index.ts` in a `types` folder:_

```bash
example
├── index.js
├── index.ts
├── package.json
├── tsconfig.json
└── types
    └── index.d.ts
```

##### declarationMap

**Generates a source map for `.d.ts` files which map back to the original `.ts` source file.**
_This will allow editors such as VS Code to go to the original `.ts` file when using features like Go to Definition._

You should strongly consider turning this on if you're using project references.

<!-- icehe : 主要 frontend 需要使用, backend 的 Node.js 项目没必要生成 `*.map.js` 文件 -->

##### downlevelIteration

**Downleveling is TypeScript’s term for transpiling to an older version of JavaScript.**
This flag is to enable support for a more accurate implementation of how modern JavaScript iterates through new concepts in older JavaScript runtimes.

……

##### emitBOM

**Controls whether TypeScript will emit a [byte order mark (BOM)](https://en.wikipedia.org/wiki/Byte_order_mark) when writing output files.**
_Some runtime environments require a BOM to correctly interpret a JavaScript files; others require that it is not present._
The default value of false is generally best unless you have a reason to change it.

##### emitDeclarationOnly

**Only emit `.d.ts` files; do not emit `.js` files.**

This setting is useful in two cases:

- You are using a transpiler other than TypeScript to generate your JavaScript.
- You are using TypeScript to only generate `d.ts` files for your consumers.

##### importHelpers

**For certain downleveling operations, TypeScript uses some helper code for operations like extending class, spreading arrays or objects, and async operations.**
**By default, these helpers are inserted into files which use them.**
This can result in code duplication if the same helper is used in many different modules.

**If the `importHelpers` flag is on, these helper functions are instead imported from the [`tslib`](https://www.npmjs.com/package/tslib) module.**
You will need to ensure that the `tslib` module is able to be imported at runtime.
This only affects modules; global script files will not attempt to import modules.

……

##### importsNotUsedAsValues

**This flag controls how `import` works, there are 3 different options**:

-   `remove` : The default behavior of dropping `import` statements which only reference types.
-   `preserve` : Preserves all import statements whose values or types are never used.
    This can cause imports/side-effects to be preserved.
-   `error` : This preserves all imports (the same as the preserve option), but will error when a value import is only used as a type.
    This might be useful if you want to ensure no values are being accidentally imported, but still make side-effect imports explicit.

This flag works because you can use `import type` to explicitly create an `import` statement which should never be emitted into JavaScript.

##### inlineSourceMap

**When set, instead of writing out a `.js.map` file to provide source maps, TypeScript will embed the source map content in the `.js` files.**
Although this results in larger JS files, it can be convenient in some scenarios.
For example, you might want to debug JS files on a webserver that doesn’t allow `.map` files to be served.

……

##### inlineSources

**When set, TypeScript will include the original content of the `.ts` file as an embedded string in the source map.**
This is often useful in the same cases as `inlineSourceMap`.

Requires either `sourceMap` or `inlineSourceMap` to be set.

……

##### mapRoot

Specify the location where debugger should locate map files instead of generated locations.

……

##### newLine

Specify the end of line sequence to be used when emitting files: ‘CRLF’ (dos) or ‘LF’ (unix).

##### noEmit

**Do not emit compiler output files like JavaScript source code, source-maps or declarations.**

_This makes room for another tool like [Babel](https://babeljs.io/), or [swc](https://github.com/swc-project/swc) to handle converting the TypeScript file to a file which can run inside a JavaScript environment._

_You can then use TypeScript as a tool for providing editor integration, and as a source code type-checker._

##### noEmitHelpers

Instead of importing helpers with [importHelpers](https://www.typescriptlang.org/tsconfig#importHelpers), you can provide implementations in the global scope for the helpers you use and completely turn off emitting of helper functions.

……

##### noEmitOnError

**Do not emit compiler output files like JavaScript source code, source-maps or declarations if any errors were reported.**

This defaults to `false`, making it easier to work with TypeScript in a watch-like environment where you may want to see results of changes to your code in another environment before making sure all errors are resolved.

##### outDir

**If specified, `.js` (as well as `.d.ts`, `.js.map`, etc.) files will be emitted into this directory.**
The directory structure of the original source files is preserved; see `rootDir` if the computed root is not what you intended.

_If not specified, `.js` files will be emitted in the same directory as the `.ts` files they were generated from:_

```bash
$ tsc

example
├── index.js
└── index.ts
```

_With a `tsconfig.json` like this:_

```json
{
  "compilerOptions": {
    "outDir": "dist"
  }
}
```

_Running `tsc` with these settings moves the files into the specified `dist` folder:_

```bash
$ tsc

example
├── dist
│   └── index.js
├── index.ts
└── tsconfig.json
```

##### outFile

**If specified, all _global_ (non-module) files will be concatenated into the single output file specified.**

If `module` is `system` or `amd`, all module files will also be concatenated into this file after all global content.

Note: `outFile` cannot be used unless `module` is `None`, `System`, or `AMD`.
**This option cannot be used to bundle CommonJS or ES6 modules.**

##### preserveConstEnums

**Do not `erase const` enum declarations in generated code.**
`const enum`s provide a way to reduce the overall memory footprint of your application at runtime by emitting the enum value instead of a reference.

_For example with this TypeScript:_

```ts
const enum Album {
  JimmyEatWorldFutures = 1,
  TubRingZooHypothesis = 2,
  DogFashionDiscoAdultery = 3,
}

const selectedAlbum = Album.JimmyEatWorldFutures;
if (selectedAlbum === Album.JimmyEatWorldFutures) {
  console.log("That is a great choice.");
}
```

_The default `const enum` behavior is to convert any `Album.Something` to the corresponding number literal, and to remove a reference to the enum from the JavaScript completely._

```ts
"use strict";
const selectedAlbum = 1 /* JimmyEatWorldFutures */;
if (selectedAlbum === 1 /* JimmyEatWorldFutures */) {
    console.log("That is a great choice.");
}
```

_With `preserveConstEnums` set to `true`, the `enum` exists at runtime and the numbers are still emitted._

```ts
"use strict";
var Album;
(function (Album) {
    Album[Album["JimmyEatWorldFutures"] = 1] = "JimmyEatWorldFutures";
    Album[Album["TubRingZooHypothesis"] = 2] = "TubRingZooHypothesis";
    Album[Album["DogFashionDiscoAdultery"] = 3] = "DogFashionDiscoAdultery";
})(Album || (Album = {}));
const selectedAlbum = 1 /* JimmyEatWorldFutures */;
if (selectedAlbum === 1 /* JimmyEatWorldFutures */) {
    console.log("That is a great choice.");
}
```

**This essentially makes such const enums a source-code feature only, with no runtime traces.**

##### preserveValueImports

There are some cases where TypeScript can't detect that you're using an import.
_For example, take the following code:_

```ts
import { Animal } from "./animal.js";
eval("console.log(new Animal().isDangerous())");
```

_or code using 'Compiles to HTML' languages like Svelte or Vue._

When combined with [`isolatedModules`](https://www.typescriptlang.org/tsconfig#isolatedModules):
imported types must be marked as type-only because compilers that process single files at a time have no way of knowing whether imports are values that appear unused, or a type that must be removed in order to avoid a runtime crash.

……

##### removeComments

**Strips all comments from TypeScript files when converting into JavaScript.**
Defaults to `false`.

……

##### sourceMap

**Enables the generation of sourcemap files.**
These files allow debuggers and other tools to display the original TypeScript source code when actually working with the emitted JavaScript files.
Source map files are emitted as `.js.map` (or `.jsx.map`) files next to the corresponding `.js` output file.

The `.js` files will in turn contain a sourcemap comment to indicate where the files are to external tools, _for example:_

```ts
// helloWorld.ts
export declare const helloWorld = "hi";
```

_Compiling with `sourceMap` set to `true` creates the following JavaScript file:_

```ts
// helloWorld.js
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.helloWorld = "hi";
//# sourceMappingURL=// helloWorld.js.map
```

_And this also generates this json map:_

```json
// helloWorld.js.map
{
  "version": 3,
  "file": "ex.js",
  "sourceRoot": "",
  "sources": ["../ex.ts"],
  "names": [],
  "mappings": ";;AAAa,QAAA,UAAU,GAAG,IAAI,CAAA"
}
```

##### sourceRoot

**Specify the location where a debugger should locate TypeScript files instead of relative source locations.**
_This string is treated verbatim inside the source-map where you can use a path or a URL:_

```json
{
  "compilerOptions": {
    "sourceMap": true,
    "sourceRoot": "https://my-website.com/debug/source/"
  }
}
```

_Would declare that `index.js` will have a source file at `https://my-website.com/debug/source/index.ts`._

##### stripInternal

Do not emit declarations for code that has an `@internal` annotation in its JSDoc comment.

……

#### JavaScript Support

##### allowJs

**Allow JavaScript files to be imported inside your project, instead of just `.ts` and `.tsx` files.**
This defaults to `false`.

_For example, this JS file:_

```js
// @filename: card.js
export const defaultCardDeck = "Heart";
```

_Imported into a TypeScript file:_

```ts
// @filename: index.ts
import { defaultCardDeck } from "./card";

console.log(defaultCardDeck);
```

This flag can be used as a way to incrementally add TypeScript files into JS projects by allowing the `.ts` and `.tsx` files to live along-side existing JavaScript files.

##### checkJs

Works in tandem with allowJs.
**When checkJs is enabled then errors are reported in JavaScript files.**
This is the equivalent of including `// @ts-check` at the top of all JavaScript files which are included in your project.

……

##### maxNodeModuleJsDepth

**The maximum dependency depth to search under `node_modules` and load JavaScript files.**

This flag is can only be used when `allowJs` is enabled, and is used if you want to have TypeScript infer types for all of the JavaScript inside your `node_modules`.

**Ideally this should stay at 0 (the default)**, and `d.ts` files should be used to explicitly define the shape of modules.
However, there are cases where you may want to turn this on at the expense of speed and potential accuracy.

#### Editor Support

##### disableSizeLimit

**To avoid a possible memory bloat issues when working with very large JavaScript projects, there is an upper limit to the amount of memory TypeScript will allocate.**
Turning this flag on will remove the limit.
This defaults to `false`.

##### plugins

**List of language service plugins to run inside the editor.**

Language service plugins are a way to provide additional information to a user based on existing TypeScript files.
They can enhance existing messages between TypeScript and an editor, or to provide their own error messages.

#### Interop Constraints

##### allowSyntheticDefaultImports

When set to `true`, `allowSyntheticDefaultImports` allows you to write an import like:

```ts
import React from "react";
```

instead of:

```ts
import * as React from "react";
```

When the module **does not** explicitly specify a default export.

……

This defaults to `true`.

##### esModuleInterop

……

##### forceConsistentCasingInFileNames

**TypeScript follows the case sensitivity rules of the file system it's running on.**
This can be problematic if some developers are working in a case-sensitive file system and others aren’t. ……

When this option is set, TypeScript will issue an error if a program tries to include a file by a casing different from the casing on disk.

This defaults to `false`.

##### isolatedModules

This defaults to `false`.

……

##### preserveSymlinks

This is to reflect the same flag in Node.js; which **does not resolve the real path of symlinks.**

……

#### Backwards Compatibility

##### charset

This defaults to `utf8`

_In prior versions of TypeScript, this controlled what encoding was used when reading text files from disk._
Today, **TypeScript assumes UTF-8 encoding, but will correctly detect UTF-16 (BE and LE) or UTF-8 BOMs.**

##### keyofStringsOnly

This flag **changes the `keyof` type operator to return `string` instead of `string | number` when applied to a type with a string index signature.**

This defaults to `false`.

##### noImplicitUseStrict

You shouldn't need this.
_By default, when emitting a module file to a non-ES6 target, TypeScript emits a "use strict"; prologue at the top of the file._
_This setting disables the prologue._

……

This defaults to `false`.

##### noStrictGenericChecks

This defaults to `false`.

TypeScript will **unify type parameters when comparing two generic functions**.

##### out

Use `outFile` instead.

……

##### suppressExcessPropertyErrors

This **disables reporting of excess property errors**,  ……

This defaults to `false`.

##### suppressImplicitAnyIndexErrors

Turning `suppressImplicitAnyIndexErrors` on **suppresses reporting the error about implicit anys when indexing into objects**, ……

This defaults to `false`.

#### Language and Environment

##### emitDecoratorMetadata

Enables experimental support for emitting type metadata for decorators which works with the module [reflect-metadata](https://www.npmjs.com/package/reflect-metadata).

……

##### experimentalDecorators

**Enables [experimental support for decorators](https://github.com/tc39/proposal-decorators)**, which is in stage 2 of the TC39 standardization process.

……

##### jsx

Controls how JSX constructs are emitted in JavaScript files.
This only affects output of JS files that started in `.tsx` files.

……

_( Related to React. )_

##### jsxFactory

……

##### jsxFragmentFactory

……

##### jsxImportSource

……

##### lib

**TypeScript includes a default set of type definitions for built-in JS APIs** (like `Math`), as well as type definitions for things found in browser environments (like `document`).
TypeScript also includes APIs for newer JS features matching the target you specify; for example the definition for `Map` is available if target is ES6 or newer.

You may want to change these for a few reasons:

- Your program doesn't run in a browser, so you don't want the "dom" type definitions
- Your runtime platform provides certain JavaScript API objects (maybe through [polyfill](https://en.wikipedia.org/wiki/Polyfill_(programming))s), but doesn't yet support the full syntax of a given ECMAScript version
- You have polyfills or native implementations for some, but not all, of a higher level ECMAScript version

In TypeScript 4.5, lib files can be overriden by npm modules, find out more [in the blog](https://devblogs.microsoft.com/typescript/announcing-typescript-4-5-beta/#supporting-lib-from-node_modules).

**High Level libraries**

Name and Contents:

-   ES5

    Core definitions for all ES3 and ES5 functionality

-   ES2015

    Additional APIs available in ES2015 (also known as ES6) -
    array.find, Promise, Proxy, Symbol, Map, Set, Reflect, etc.

-   ES6

    Alias for “ES2015”

-   ES2016

    Additional APIs available in ES2016 -
    array.include, etc.

-   ES7

    Alias for “ES2016”

-   ES2017

    Additional APIs available in ES2017 -
    Object.entries, Object.values, Atomics, SharedArrayBuffer, date.formatToParts, typed arrays, etc.

-   ES2018

    Additional APIs available in ES2018 -
    async iterables, promise.finally, Intl.PluralRules, regexp.groups, etc.

-   ES2019

    Additional APIs available in ES2019 -
    array.flat, array.flatMap, Object.fromEntries, string.trimStart, string.trimEnd, etc.

-   ES2020

    Additional APIs available in ES2020 - string.matchAll, etc.

-   ES2021

    Additional APIs available in ES2021 - promise.any, string.replaceAll etc.

-   ESNext

    Additional APIs available in ESNext -
    This changes as the JavaScript specification evolves

-   DOM

    DOM definitions - window, document, etc.

-   WebWorker

    APIs available in WebWorker contexts

-   ScriptHost

    APIs for the Windows Script Hosting System

**Individual library components**

Name:

- DOM.Iterable
- ES2015.Core
- ES2015.Collection
- ES2015.Generator
- ES2015.Iterable
- ES2015.Promise
- ES2015.Proxy
- ES2015.Reflect
- ES2015.Symbol
- ES2015.Symbol.WellKnown
- ES2016.Array.Include
- ES2017.object
- ES2017.Intl
- ES2017.SharedMemory
- ES2017.String
- ES2017.TypedArrays
- ES2018.Intl
- ES2018.Promise
- ES2018.RegExp
- ES2019.Array
- ES2019.Object
- ES2019.String
- ES2019.Symbol
- ES2020.String
- ES2020.Symbol.wellknown
- ES2021.Promise
- ES2021.String
- ES2021.Weakref
- ESNext.AsyncIterable
- ESNext.Array
- ESNext.Intl
- ESNext.Symbol

This list may be out of date, you can see the full list in the [TypeScript source code](https://github.com/microsoft/TypeScript/tree/main/lib).

##### noLib

**Disables the automatic inclusion of any library files.**
If this option is set, `lib` is ignored.

TypeScript cannot compile anything without a set of interfaces for key primitives like:
`Array`, `Boolean`, `Function`, `IArguments`, `Number`, `Object`, `RegExp`, and `String`.
It is expected that if you use `noLib` you will be including your own type definitions for these.

##### reactNamespace

Use `jsxFactory` instead.

……

##### target

_Modern browsers support all `ES6` features, so ES6 is a good choice._
You might choose to set a lower target if your code is deployed to older environments, or a higher target if your code is guaranteed to run in newer environments.

……

##### useDefineForClassFields

This flag is used as part of migrating to the upcoming standard version of class fields.

……

#### Compiler Diagnostics

##### _diagnostics_

Deprecated. This defaults to `false`.

**Used to output diagnostic information for debugging.**
_This command is a subset of `extendedDiagnostics` which are more user-facing results, and easier to interpret._

_If you have been asked by a TypeScript compiler engineer to give the results using this flag in a compile, in which there is no harm in using `extendedDiagnostics` instead._

##### explainFiles

**Print names of files which TypeScript sees as a part of your project and the reason they are part of the compilation.**

……

##### extendedDiagnostics

You can use this flag to **discover where TypeScript is spending its time when compiling.**
This is a tool **used for understanding the performance characteristics of your codebase overall.**

You can learn more about how to measure and understand the output in the performance [section of the wiki](https://github.com/microsoft/TypeScript/wiki/Performance).

This defaults to `false`.

##### generateCpuProfile

This option gives you the chance **to have TypeScript emit a v8 CPU profile during the compiler run.**
The CPU profile can provide insight into why your builds may be slow.

This option can only be used from the CLI via: `--generateCpuProfile tsc-output.cpuprofile`.

This defaults to `profile.cpuprofile`.

```bash
npm run tsc --generateCpuProfile tsc-output.cpuprofile
```

This file can be opened in a chromium based browser like Chrome or Edge Developer in [the CPU profiler section](https://developer.chrome.com/docs/devtools/evaluate-performance/).
_You can learn more about understanding the compilers performance in the TypeScript wiki [section on performance](https://github.com/microsoft/TypeScript/wiki/Performance)._

##### listEmittedFiles

**Print names of generated files part of the compilation to the terminal.**

This flag is useful in two cases:

- You want to transpile TypeScript as a part of a build chain in the terminal where the filenames are processed in the next command.
- You are not sure that TypeScript has included a file you expected, as a part of debugging the file inclusion settings.

……

##### listFiles

**Print names of files part of the compilation.**
_This is useful when you are not sure that TypeScript has included a file you expected._

……

##### traceResolution

When you are trying to debug why a module isn't being included.
You can set `traceResolutions` to `true` to have TypeScript print information about its resolution process for each processed file.

#### Projects

##### composite

The `composite` option **enforces certain constraints which make it possible for build tools (including TypeScript itself, under `--build` mode) to quickly determine if a project has been built yet.**

……

##### disableReferencedProjectLoad

In multi-project TypeScript programs, TypeScript will load all of the available projects into memory in order to provide accurate results for editor responses which require a full knowledge graph like 'Find All References'.

If your project is large, you can use the flag disableReferencedProjectLoad to **disable the automatic loading of all projects**.
**Instead, projects are loaded dynamically as you open files through your editor.**

##### disableSolutionSearching

When working with composite TypeScript projects, this option provides a way to **declare that you do not want a project to be included when using features like find all references or jump to definition in an editor.**

……

##### disableSourceOfProjectReferenceRedirect

……

##### incremental

Tells TypeScript to **save information about the project graph from the last compilation to files stored on disk.**

……

##### tsBuildInfoFile

This setting lets you specify a file for storing incremental compilation information as a part of composite projects which enables faster building of larger TypeScript codebases.

……

#### Output Formatting

##### noErrorTruncation

**Do not truncate error messages.**

This defaults to `false`.

……

##### preserveWatchOutput

Whether to **keep outdated console output in watch mode instead of clearing the screen every time a change happened.**

This defaults to `false`.

##### pretty

**Stylize errors and messages using color and context**, this is on by default — offers you a chance to have less terse, single colored messages from the compiler.

#### Completeness

##### skipDefaultLibCheck

Use `skipLibCheck` instead.
Skip type checking of default library declaration files.

……

##### skipLibCheck

……

#### Command Line

……

#### Watch Options

TypeScript 3.8 shipped a new strategy for watching directories, which is crucial for efficiently picking up changes to `node_modules`.

……

##### assumeChangesOnlyAffectDirectDependencies

When this option is enabled, TypeScript will **avoid rechecking/rebuilding all truly possibly-affected files, and only recheck/rebuild files that have changed as well as files that directly import them.**

This can be considered a ‘fast & loose’ implementation of the watching algorithm, which can drastically reduce incremental rebuild times at the expense of having to run the full build occasionally to get all compiler error messages.

### watchOptions

You can configure the how TypeScript `--watch` works.
This section is mainly for handling case where `fs.watch` and `fs.watchFile` have additional constraints like on Linux.
You can read more at [Configuring Watch](https://www.typescriptlang.org/docs/handbook/configuring-watch.html).

#### watchFile

The strategy for how individual files are watched.

- `fixedPollingInterval`: Check every file for changes several times a second at a fixed interval.
- `priorityPollingInterval`: Check every file for changes several times a second, but use heuristics to check certain types of files less frequently than others.
- `dynamicPriorityPolling`: Use a dynamic queue where less-frequently modified files will be checked less often.
- `useFsEvents` (the default): Attempt to use the operating system/file system’s native events for file changes.
- `useFsEventsOnParentDirectory`: Attempt to use the operating system/file system’s native events to listen for changes on a file’s parent directory

……

#### watchDirectory

_The strategy for how entire directory trees are watched under systems that lack recursive file-watching functionality._

……

#### fallbackPolling

_When using file system events, this option specifies the polling strategy that gets used when the system runs out of native file watchers and/or doesn't support native file watchers._

……

#### synchronousWatchDirectory

_Synchronously call callbacks and update the state of directory watchers on platforms that don't support recursive watching natively. ……_

#### excludeDirectories

You can use `excludeFiles` to drastically reduce the number of files which are watched during `--watch`.

……

#### excludeFiles

You can use `excludeFiles` to remove a set of specific files from the files which are watched.

……

### typeAcquisition

- enable
- include
- exclude
- disableFilenameBasedTypeAcquisition
