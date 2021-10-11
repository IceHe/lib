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

### stack overflow

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

## TODO
