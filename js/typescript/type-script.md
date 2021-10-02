# TypeScript

JavaScript with syntax for types

---

References

- [typescriptlang.org](https://www.typescriptlang.org/)
    - Get Started
        - [Handbook](https://www.typescriptlang.org/docs/handbook/intro.html)
        - [Playgroud](https://www.typescriptlang.org/play?#code/PTAEHUFMBsGMHsC2lQBd5oBYoCoE8AHSAZVgCcBLA1UABWgEM8BzM+AVwDsATAGiwoBnUENANQAd0gAjQRVSQAUCEmYKsTKGYUAbpGF4OY0BoadYKdJMoL+gzAzIoz3UNEiPOofEVKVqAHSKymAAmkYI7NCuqGqcANag8ABmIjQUXrFOKBJMggBcISGgoAC0oACCoASMFmgY7p7ehCTkVOle4jUMdRLYTqCc8LEZzCZmoNJODPHFZZXVtZYYkAAeRJTInDQS8po+rf40gnjbDKv8LqD2jpbYoACqAEoAMsK7sUmxkGSCc+VVQQuaTwVb1UBrDYULY7PagbgUZLJH6QbYmJAECjuMigZEMVDsJzCFLNXxtajBBCcQQ0MwAUVWDEQNUgADVHBQGNJ3KAALygABEAAkYNAMOB4GRogLFFTBPB3AExcwABT0xnM9zsyhc9wASmCKhwDQ8ZC8iElzhB7Bo3zcZmY7AYzEg-Fg0HUiS58D0Ii8AoZTJZggFSRxAvADlQAHJhAA5SASAVBFQAeW+ZF2gldWkgx1QjgUrmkeFATgtOlGWH0KAQiBhwiudokkuiIgMHBx3RYbC43CCJSAA)
    - [Docs](https://www.typescriptlang.org/docs/)
    - [Tools](https://www.typescriptlang.org/tools)
        - Playgroud
        - [TS Config Reference](https://www.typescriptlang.org/tsconfig/)
            - An annotated reference to more than a hundred compiler options available in a `tsconfig.json` or `jsconfig.json`.
        - [Type Search](https://www.typescriptlang.org/dt/search?search=)
            - Search for npm modules with types from DefinitelyTyped or embedded in the module.

## Intro

TypeScript is a strongly typed programming language
which builds on JavaScript giving you better tooling at any scale.

What is TypeScript?

-   JavaScript and More

    TypeScript adds additional syntax to JavaScript
    to support a tighter integration with your editor.
    Catch errors early in your editor.

-   A Result You Can Trust

    TypeScript code converts to JavaScript
    which runs anywhere JavaScript runs:
    In a browser, on Node.js or Deno and in your apps.

-   Safety at Scale

    TypeScript understands JavaScript and
    uses type inference to give you great tooling
    without additional code.

## Get Started

## Handbook

The goal of TypeScript is to be a **static typechecker for JavaScript programs** - in other words, a tool that runs before your code runs (static) and ensures that the types of the program are correct (typechecked).

……

**How is this Handbook Structured**

The handbook is split into two sections:

-   The Handbook

    ……
    In the interests of clarity and brevity <!-- 简洁, 简短 -->, the main content of the Handbook will not explore every edge case or minutiae of the features being covered.
    ……

-   Reference Files

    The reference section below the handbook in the navigation is built to provide a richer understanding of how a particular part of TypeScript works.

    You can read it top-to-bottom, but each section aims to provide a deeper explanation of a single concept - meaning there is no aim for continuity.

### Basics

-   Static Type-checking

    Ideally, we could have a tool that helps us **find these bugs before our code runs**.
    That's what a static type-checker like TypeScript does.

    Static types systems describe the shapes and behaviors of what our values will be when we run our programs.
    A type-checker like TypeScript uses that information and tells us when things might be going off the rails.

-   Non-exception Failures

-   Types for Tooling

-   `tsc`, TypeScript Compiler

-   Emitting with Errors

    ```bash
    tsc --noEmitOnError hello.ts
    ```

-   Explicit Types

    ```js
    function greet(person: string, date: Date) {
      console.log(`Hello ${person}, today is ${date.toDateString()}!`);
    }

    greet("Maddison", new Date());
    ```

    In many cases, TypeScript can even just infer (or "figure out") the types for us even if we omit them.

    ```js
    let msg = "hello there!";
    ```

-   Erased Types

-   Downleveling

    **By default TypeScript targets ES3.**

    The great majority of current browsers support ES2015.
    Running with `--target es2015` changes TypeScript to target ECMAScript 2015, meaning code should be able to run wherever ECMAScript 2015 is supported.

    _Most developers can therefore safely specify ES2015 or above as a target, …_

-   Strictness

    Some people are looking for a more loose opt-in <!-- 选择参加 --> experience which can help validate only some parts of their program, and still have decent <!-- 得体的 --> tooling.

    … `"strict": true` in a `tsconfig.json` toggles …

    - `noImplicitAny` : most lenient type `any`
    - `strictNullChecks` : makes handling `null` and `undefined` more explicit, and spares us from worrying about whether we forgot to handle `null` and `undefined`.

### Everyday Types

#### Primitives

-   `string`

    represents string values like `"Hello, world"`

-   `number`

    is for numbers like `42`.

    JavaScript does not have a special runtime value for integers, so there’s no equivalent to `int` or `float` - everything is simply `number`

-   `boolean`

    is for the two values `true` and `false`

#### Arrays

To specify the type of an array like `[1, 2, 3]`, you can use the syntax `number[]`;
this syntax works for any type (e.g. `string[]` is an array of strings, and so on).

You may also see this written as `Array<number>`, which means the same thing.
We'll learn more about the syntax `T<U>` when we cover generics.

_Note that `[number]` is a different thing; refer to the section on Tuples._

#### any

_TypeScript also has a special type,_ `any`, that you can **use whenever you don't want a particular value to cause typechecking errors**.

Use the compiler flag `noImplicitAny` **to flag any implicit any as an error**.

#### Type Annotations on Variables

When you declare a variable using const, var, or let, you can optionally add a type annotation to explicitly specify the type of the variable:

```js
let myName: string = "Alice";
```

```js
// No type annotation needed -- 'myName' inferred as type 'string'
let myName = "Alice";
```

#### Functions

##### Parameter Type Annotations

```js
// Parameter type annotation
function greet(name: string) {
  console.log("Hello, " + name.toUpperCase() + "!!");
}
```

##### Return Type Annotations

```js
function getFavoriteNumber(): number {
  return 26;
}
```

##### Anonymous Functions

```js
// No type annotations here, but TypeScript can spot the bug
const names = ["Alice", "Bob", "Eve"];

// Contextual typing for function
names.forEach(function (s) {
  console.log(s.toUpperCase());
});

// Contextual typing also applies to arrow functions
names.forEach((s) => {
  console.log(s.toUpperCase());
});
```

#### Object Types

```js
// The parameter's type annotation is an object type
function printCoord(pt: { x: number; y: number }) {
  console.log("The coordinate's x value is " + pt.x);
  console.log("The coordinate's y value is " + pt.y);
}
printCoord({ x: 3, y: 7 });
```

##### Optional Properties

```js
function printName(obj: { first: string; last?: string }) {
  // Error - might crash if 'obj.last' wasn't provided!
  console.log(obj.last.toUpperCase());
  if (obj.last !== undefined) {
    // OK
    console.log(obj.last.toUpperCase());
  }

  // A safe alternative using modern JavaScript syntax:
  console.log(obj.last?.toUpperCase());
}
```

##### Union Types

**Defining a Union Type**

```js
function printId(id: number | string) {
  console.log("Your ID is: " + id);
}
// OK
printId(101);
// OK
printId("202");
// Error
printId({ myID: 22342 });
```

**Working with Union Types**

```js
function printId(id: number | string) {
  if (typeof id === "string") {
    // In this branch, id is of type 'string'
    console.log(id.toUpperCase());
  } else {
    // Here, id is of type 'number'
    console.log(id);
  }
}
```

##### Type Aliases

```js

```
