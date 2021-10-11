# JavaScript

aka. ECMAScript

---

References

- [JavaScript - Wikipedia](https://en.wikipedia.org/wiki/JavaScript)
    - aka. [ECMAScript](https://en.wikipedia.org/wiki/ECMAScript)
- [create-project.js.org](https://create-project.js.org/)

## peerDependencies

References

- [What is the difference between .js, .tsx and .jsx in React? - stack overflow](https://stackoverflow.com/questions/64343698/what-is-the-difference-between-js-tsx-and-jsx-in-react)

TL;DR:

- **`dependencies` and `devDependencies` are used to make a difference between the libraries that will be (or won't be) in your final bundle.**
- **`peerDependencies` are useful only if you want to create and publish your own library.**

### dependencies

The libraries under dependencies are those that your project really needs to **be able to work in production**.
_Usually, these libraries have all or part of their code in your final bundle(s)._

_The libraries you can find under dependencies include utility libraries such as lodash, classnames etc and also the "main" libraries of your project._

### devDependencies

As we can guess thanks to its name, the libraries under devDependencies are those that **you need during development**.

_So you'll find here different types of libraries such as:_

- **formatting libraries**: **eslint**, **prettier**, ...
- **bundlers**: webpack, gulp, **parceljs**, ...
- babel and all its plugins
- everything related to tests: enzyme, jest, ...
- a bunch of other libraries: storybook, react-styleguidist, **husky**, ...

### peerDependencies

95% of the time, you'll use only dependencies and devDependencies.
But if you want to create and publish your own library so that it can be used as a dependency, you may also need the peerDependencies.
Under this section, **you can indicate which versions of some of your important libraries are required**.

Let's imagine that **your project (ProjectA) uses an important library (peer-lib) and you know or at least guess that the project (MainProject) which will use your library will also use this peer-lib library.**
If you want to **make sure that the version of peer-lib used in MainProject works with your version in ProjectA, you should use peerDependencies.**

## require vs import

References

- [The difference between "require(x)" and "import x" - stack overflow](https://stackoverflow.com/questions/46677752/the-difference-between-requirex-and-import-x)
- [Require vs Import - EDUCBA](https://www.educba.com/require-vs-import)

<!-- - [JavaScript require() vs import()](https://flexiple.com/javascript-require-vs-import) -->

### Stack Overflow

Reference : [The difference between "require(x)" and "import x" - stack overflow](https://stackoverflow.com/questions/46677752/the-difference-between-requirex-and-import-x)

![require-vs-import.png](_image/require-vs-import.png)

- You can't selectively load only the pieces you need with `require` but with **`import`**, you can **selectively load only the pieces you need**, which can save memory.
- **Loading is synchronous(step by step) for `require`** on the other hand **`import` can be asynchronous (without waiting for previous import)** so it can perform a little better than require.

### DDUCBA

Reference : [Require vs Import - EDUCBA](https://www.educba.com/require-vs-import)

#### Key Differences

Both are popular choices in the market; let us discuss some of the major differences:

-   `require` is more of dynamic analysis, and `import` is more of static analysis.
-   `require` Throws error at runtime and `import` throws error while parsing
-   `require` is Nonlexical and `import` is Lexical
-   `require`s to stay where they have put the file, and `import`s get sorted to the top of the file.
-   `import` is always run at the very beginning of the file and can't be run conditionally.
    On the other hand, `require` can be used inline, conditionally, …

#### Comparison Table

Syntax:

-   `require`

    ```js
    var dep = require(“dep”);
    console.log(dep.bar);
    dep.foo();
    ```

-   `import`

    ```js
    import {foo, bar} from “dep”;
    console.log(bar);
    foo();
    ```

Browsers support natively?

-   `require`

    As import remains in stage three and not enforced by browsers natively, we're unable to run any performance take a look at.

-   `import`

    Presently once you use import in your code, your transpilers it back to require the commonJS modeling system.
    Therefore for nowadays, each is the same.

Performance

-   `require`

    Though there aren't any performance profit at the instant,
    however, I'll still counsel to use import over require
    because it's about to be native in JS and will (just as a result of its native) perform higher than require.

-   `import`

    As a result of import is native; therefore, require doesn't perform higher as compare to import

Synchronous or Asynchronous?

-   `require`

    You will have dynamic loading wherever the loaded module name is not predefined.
    Loading is synchronous. Meaning if you have got multiple requires, they’re loaded and processed one by one. ES6

-   `import`

    You can use named imports to by selection load solely the items you would like.
    Which will save memory? **Import is asynchronous** (and in the current ES6 Module Loader, it, of course, is) and may perform a touch higher.
    Also, the require module system is not customarily based mostly.
    It's is extremely unlikely to become customary currently that ES6 modules exist.

<!--

### _require(x) vs import(x)_

Reference : [JavaScript require() vs import()](https://flexiple.com/javascript-require-vs-import)

_( icehe : `import()` 很少使用, 所以可以忽略. )_

Syntax and Explanation

#### _require()_

In Node.jS, `require()` is a built-in function to include external modules that exist in separate files.

- `require()` statement basically reads a JavaScript file, executes it, and then proceeds to return the export object.
- `require()` statement not only allows to add built-in core Node.js modules but also community-based and local modules.

Syntax:

- To include a module, the `require()` function is used with the name of the module:

```js
var myVar = require('http'); // to use built-in modules
Var myVar2 = require('./myLocaModule'); // to use local modules
```

#### _import()_

`import()` & `export()` statements are used to refer to an ES module.
Other modules with file types such as `.json` cannot be imported with these statements.
They are permitted to be used only in ES modules and the specifier of this statement can either be a URL-style relative path or a package name.
Also, the `import` statement cannot be used in embedded scripts unless such script has a `type="module"`.
A dynamic import can be used for scripts whose type is not "module"

Syntax:

```js
var myVac = import("module-name");
```

#### _Differences_

One of the major differences between `require()` and `import()` is that

- `require()` can be called from anywhere inside the program
- whereas `import()` cannot be called conditionally, it always runs at the beginning of the file.

To use the `require()` statement, a module must be saved with `.js` extension as opposed to `.mjs` when the `import()` statement is used.

ES modules can be loaded dynamically via the `import()` function unlike `require()`.

-->

## CJS, AMD, UMD, ESM

References

- [What are CJS, AMD, UMD, and ESM in Javascript? - dev.to](https://dev.to/iggredible/what-the-heck-are-cjs-amd-umd-and-esm-ikm)

In the beginning, Javascript did not have a way to import/export modules. This is a problem.
Then, people much, much smarter than me attempted to add modularity to Javascript.
Some of them are CJS, AMD, UMD, and ESM.

### CJS

References

- [CommonJS - Wikipedia](https://en.wikipedia.org/wiki/CommonJS)

CJS is short for **CommonJS**. _Here is what it looks like:_

```js
// importing
const doSomething = require('./doSomething.js');

// exporting
module.exports = function doSomething(n) {
  // do something
}
```

-   [CJS module format](https://blog.risingstack.com/node-js-at-scale-module-system-commonjs-require/).
-   CJS **imports module synchronously.**
-   You can **import from a library `node_modules` or local dir.**

    Either by `const myLocalModule = require('./some/local/file.js')` or `var React = require('react');` works.

-   When CJS imports, it will **give you a copy of the imported object.**

    CJS will **not work in the browser.**
    It will **have to be transpiled and bundled.**

### AMD

References:

- [Asynchronous Module Definition - Wikipedia](https://en.wikipedia.org/wiki/Asynchronous_module_definition)

AMD stands for **Asynchronous Module Definition**. _Here is a sample code:_

```js
define(['dep1', 'dep2'], function (dep1, dep2) {
  // Define the module value by returning a value.
  return function () {};
});
```

or

```js
// "simplified CommonJS wrapping" https://requirejs.org/docs/whyamd.html
define(function (require) {
    var dep1 = require('dep1'),
        dep2 = require('dep2');
    return function () {};
});
```

- AMD **imports modules asynchronously** (hence the name).
- AMD is **made for frontend (when it was proposed) (while CJS backend)**.
- AMD syntax is **less intuitive than CJS**. _I think of AMD as the exact opposite sibling of CJS._

### UMD

Reference:

- [UMD (Universal Module Definition) - github.com/umdjs/umd](https://github.com/umdjs/umd#:~:text=These%20are%20modules%20which%20are,(e.g%20RequireJS%20amongst%20others).)

UMD stands for **Universal Module Definition**. _Here is what it may look like:_

```js
(function (root, factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery", "underscore"], factory);
    } else if (typeof exports === "object") {
        module.exports = factory(require("jquery"), require("underscore"));
    } else {
        root.Requester = factory(root.$, root._);
    }
}(this, function ($, _) {
    // this is where I defined my module implementation

    var Requester = { // ... };

    return Requester;
}));
```

- Works on **front and back end** (hence the name universal).
- Unlike CJS or AMD, UMD is **more like a pattern to configure several module systems**.
- UMD is usually used as a fallback module when using bundler like Rollup/Webpack _( icehe : 暂时不太懂什么意思 2021/10/11 )_

### ESM

References:

- [Modules: ECMAScript modules - nodjs.org](https://nodejs.org/api/esm.html)
- [ES modules: A cartoon deep-dive - hacks.mozilla.org](https://hacks.mozilla.org/2018/03/es-modules-a-cartoon-deep-dive/) TBD?
- [Introduction to ES Modules - flaviocopes.com](https://flaviocopes.com/es-modules/) TBD?

ESM stands for **ES Modules**.  It is **Javascript's proposal to implement a standard module system**.

_I am sure many of you have seen this:_

```js
import React from 'react';
```

_Other sightings in the wild:_

```js
export default function() {
  // your Function
};
export const function1() {...};
export const function2() {...};
```

- Works in many modern browsers
- It has the best of both worlds: **CJS-like simple syntax and AMD's async**
- **[Tree-shakeable](https://developers.google.com/web/fundamentals/performance/optimizing-javascript/tree-shaking), due to ES6's [static module structure](https://exploringjs.com/es6/ch_modules.html#static-module-structure)**
- ESM allows bundlers like Rollup to [remove unnecessary code](https://dev.to/bennypowers/you-should-be-using-esm-kn3), allowing sites to ship less codes to get faster load.
- Can be called in HTML, just do:

### Summary

TODO

## export const vs export default

### TODO

## Transpilers

> What They Are & Why We Need Them

References

- [JavaScript Transpilers: What They Are & Why We Need Them - scotch.io](https://scotch.io/tutorials/javascript-transpilers-what-they-are-why-we-need-them)

### Introduction

### TODO

## TODO
