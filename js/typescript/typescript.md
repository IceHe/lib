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
- Notes
    - [tsconfig.json](tsconfig-json.md)

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

    ```ts
    function greet(person: string, date: Date) {
      console.log(`Hello ${person}, today is ${date.toDateString()}!`);
    }

    greet("Maddison", new Date());
    ```

    In many cases, TypeScript can even just infer (or "figure out") the types for us even if we omit them.

    ```ts
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

```ts
let myName: string = "Alice";
```

```ts
// No type annotation needed -- 'myName' inferred as type 'string'
let myName = "Alice";
```

#### Functions

##### Parameter Type Annotations

```ts
// Parameter type annotation
function greet(name: string) {
  console.log("Hello, " + name.toUpperCase() + "!!");
}
```

##### Return Type Annotations

```ts
function getFavoriteNumber(): number {
  return 26;
}
```

##### Anonymous Functions

```ts
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

```ts
// The parameter's type annotation is an object type
function printCoord(pt: { x: number; y: number }) {
  console.log("The coordinate's x value is " + pt.x);
  console.log("The coordinate's y value is " + pt.y);
}
printCoord({ x: 3, y: 7 });
```

##### Optional Properties

```ts
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

```ts
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

```ts
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

It’s common to want to use the same type more than once and refer to it by a single name.

```ts
type Point = {
    x: number;
    y: number;
}

// Exactly the same as the earlier example
function printCoordinate(point: Point) {
  console.log("The coordinate's x value is " + point.x);
  console.log("The coordinate's y value is " + point.y);
}

printCoordinate({ x: 100, y: 50 });
```

##### Interfaces

```ts
interface Point {
  x: number;
  y: number;
}

// Exactly the same as the earlier example
function printCoordinate(point: Point) {
  console.log("The coordinate's x value is " + point.x);
  console.log("The coordinate's y value is " + point.y);
}

printCoordinate({ x: 100, y: 50 });
```

**Differences Between Type Aliases and Interfaces**

Almost all features of an interface are available in type,
the key distinction is that **a type cannot be re-opened to add new properties** vs **an interface which is always extendable**.

-   Extend an interface

    ```ts
    interface Animal {
      name: string
    }

    interface Bear extends Animal {
      honey: boolean
    }

    function getBear(): Bear {
      return { name: "IceHe", honey: true};
    }

    const bear = getBear()
    console.log(bear.name)
    console.log(bear.honey)
    ```

-   Extend a type via intersection

    ```ts
    type Animal = {
      name: string
    }

    type Bear = Animal & {
      honey: boolean
    }

    function getBear(): Bear {
      return { name: "IceHe", honey: true};
    }

    const bear = getBear()
    console.log(bear.name)
    console.log(bear.honey)
    ```

-   ……

##### Type Assertions

Sometimes you will have information about the type of a value that TypeScript can’t know about.

For example, if you’re using `document.getElementById`, TypeScript only knows that this will return some kind of `HTMLElement`, but you might know that your page will always have an `HTMLCanvasElement` with a given ID.

In this situation, you can use a type assertion to specify a more specific type:

```ts
const myCanvas = document.getElementById("main_canvas") as HTMLCanvasElement;
```

Reminder: Because type assertions are removed at compile-time, there is no runtime checking associated with a type assertion.
There won’t be an exception or null generated if the type assertion is wrong.

##### Literal Types

It's not much use to have a variable that can only have one value!

But **by combining literals into unions**, you can express a much more useful concept - for example, **functions that only accept a certain set of known values ( on function parameters )**:

```ts
function print123(s: "one" | "two" | "three") {
  console.log(s);
}

print123("one");
print123("two");
print123("three");
// print123("four");
```

Numeric literal types work the same way ( using on function returning type ) :

```ts
function compare(a: string, b: string): -1 | 0 | 1 {
  return ((a === b) ? 0 : ((a > b) ? 1 : -1));
}

console.log(compare("a", "abc"));
console.log(compare("666", "666"));
console.log(compare("ice", "he"));
```

Combine these with non-literal types:

```ts
interface Options {
  width: number;
}
function configure(x: Options | "auto") {
  console.log(x);
}

configure({ width: 100 });
configure("auto");
// configure("automatic");
```

**Literal Inference**

- [See details](https://www.typescriptlang.org/docs/handbook/2/everyday-types.html#literal-inference)

##### null and undefined

JavaScript has two primitive values used to **signal absent or uninitialized value: `null` and `undefined`**.

---

**`strictNullChecks`**

-   **off**

    With `strictNullChecks` off, values that might be **null or undefined can still be accessed normally, and the values null and undefined can be assigned to a property of any type**.

    _The lack of checking for these values tends to be a major source of bugs; we always recommend people turn `strictNullChecks` on if it’s practical to do so in their codebase._

-   **on**

    With `strictNullChecks` on, **when a value is null or undefined, you will need to test for those values before using methods or properties on that value**.

**Non-null Assertion Operator (Postfix `!`)**

TypeScript also has a special syntax for removing `null` and `undefined` from a type without doing any explicit checking.

Writing `!` after any expression is effectively a type assertion that the value isn’t **null** or **undefined**:

```ts
function liveDangerously(x?: number | null) {
  // No error
  console.log(x!.toFixed());
}
```

##### Enums

Enums are a feature added to JavaScript by TypeScript which allows for describing a value which could be one of a set of possible named constants.

Unlike most TypeScript features, this is **not a type-level addition to JavaScript but something added to the language and runtime**.

- See [Enums](https://www.typescriptlang.org/docs/handbook/enums.html)

##### Less Common Primitives

**bigint**

From ES2020 onwards, there is a primitive in JavaScript used for very large integers, BigInt:

```ts
// Creating a bigint via the BigInt function
const oneHundred: bigint = BigInt(100);
// Creating a BigInt via the literal syntax
const anotherHundred: bigint = 100n;
```

```bash
$ tsc --target es2020 bigint.ts && node bigint.js
100n
100n
```

**symbol**

There is a primitive in JavaScript used to create a globally unique reference via the function `Symbol()`:

```ts
const firstName = Symbol("name");
const secondName = Symbol("name");

if (firstName === secondName) {
  // Can't ever happen
} else {
  console.log("`firstName === secondName` is wrong.");
}
```

#### Narrowing

```ts
function padLeft(padding: number | string, input: string) {
  if (typeof padding === "number") {
    return new Array(padding + 1).join(" ") + input;
  }
  return padding + input;
}

console.log(padLeft(3, "IceHe"));
console.log(padLeft("Seen ", "IceHe"));
```

##### `typeof` type guards

JavaScript supports a typeof operator which can give very basic information about the type of values we have at runtime.

TypeScript expects this to return a certain set of strings:

- `string`
- `number`
- `bigint`
- `boolean`
- `symbol`
- `undefined`
- `object`
- `function`

It turns out that **in JavaScript, `typeof null` is actually "object"**! This is one of those unfortunate accidents of history.

##### Truthiness Narrowing

In JavaScript, **constructs like `if` first "coerce" their conditions to booleans to make sense of them, and then choose their branches depending on whether the result is true or false**.

Values like

- `0`
- `NaN`
- `""` (the empty string)
- `0n` (the bigint version of zero)
- `null`
- `undefined`

all coerce to `false`, and other values get coerced `true`.

You can always **coerce values to booleans by running them through the `Boolean` function, or by using the shorter double-Boolean negation.**
( **The latter has the advantage that TypeScript infers a narrow literal boolean type true, while inferring the first as type boolean.** )

```ts
// both of these result in 'true'
Boolean("hello");   // type: boolean, value: true
!!"world";          // type: true,    value: true
```

_Exmaple_

```ts
function multiplyAll(
  values: number[] | undefined,
  factor: number
): number[] | undefined {
  if (!values) {
    return values;
  } else {
    return values.map((x) => x * factor);
  }
}

console.log(multiplyAll([1, 2, 3], 3));
console.log(multiplyAll(undefined, 3));
console.log(multiplyAll(null, 3));
console.log(multiplyAll([], 3));
```

##### Equality Narrowing

TypeScript also uses switch statements and equality checks like `===`, `!==`, `==`, and `!=` to narrow types.

For example:

```ts
function example(x: string | number, y: string | boolean) {
  if (x === y) {
    // We can now call any 'string' method on 'x' or 'y'.
    x.toUpperCase();
    y.toLowerCase();
  } else {
    console.log(x);
    console.log(y);
  }
}
```

When we checked that x and y are both equal in the above example, TypeScript knew their types also had to be equal.
Since `string` is the only common type that both x and y could take on, TypeScript knows that x and y must be a `string` in the first branch.

……

Checking whether something `== null` actually not only checks whether it is specifically the value `null` - it also checks whether it's potentially `undefined`. The same applies to `== undefined`: it checks whether a value is either `null` or `undefined`.

See [Equality Narrowing](https://www.typescriptlang.org/docs/handbook/2/narrowing.html#equality-narrowing) for details

##### `in` Operator Narrowing

JavaScript has an operator for determining if an object has a property with a name: the `in` operator.
_TypeScript takes this into account as a way to narrow down potential types._

_( icehe : `typeof` 用于推断基本类型, `in` 用来推断自定义类型 )_

_For example, with the code: `"value" in x`._
_where `"value"` is a string literal and x is a union type._
_The “true” branch narrows `x`’s types which have either an optional or required property value, and the “false” branch narrows to types which have an optional or missing property `value`._

```ts
type Fish = { swim: () => void };
type Bird = { fly: () => void };

function move(animal: Fish | Bird) {
  if ("swim" in animal) {
    return animal.swim();
  }

  return animal.fly();
}
```

_To reiterate optional properties will exist in both sides for narrowing, for example a human could both swim and fly (with the right equipment) and thus should show up in both sides of the `in` check:_

```bash
type Fish = { swim: () => void };
type Bird = { fly: () => void };
type Human = { swim?: () => void; fly?: () => void };

function move(animal: Fish | Bird | Human) {
  if ("swim" in animal) {
    animal;

(parameter) animal: Fish | Human
  } else {
    animal;

(parameter) animal: Bird | Human
  }
}
```

`instanceof` narrowing
