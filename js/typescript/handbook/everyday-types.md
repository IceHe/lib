# Everyday Types

References

- [Everyday Types - TypeScript Handbook](https://www.typescriptlang.org/docs/handbook/2/everyday-types.html)

## Primitives

-   `string`

    represents string values like `"Hello, world"`

-   `number`

    is for numbers like `42`.

    JavaScript does not have a special runtime value for integers, so there’s no equivalent to `int` or `float` - everything is simply `number`

-   `boolean`

    is for the two values `true` and `false`

## Arrays

To specify the type of an array like `[1, 2, 3]`, you can use the syntax `number[]`;
this syntax works for any type (e.g. `string[]` is an array of strings, and so on).

You may also see this written as `Array<number>`, which means the same thing.
We'll learn more about the syntax `T<U>` when we cover generics.

_Note that `[number]` is a different thing; refer to the section on Tuples._

## any

_TypeScript also has a special type,_ `any`, that you can **use whenever you don't want a particular value to cause typechecking errors**.

Use the compiler flag `noImplicitAny` **to flag any implicit any as an error**.

## Type Annotations on Variables

When you declare a variable using const, var, or let, you can optionally add a type annotation to explicitly specify the type of the variable:

```ts
let myName: string = "Alice";
```

```ts
// No type annotation needed -- 'myName' inferred as type 'string'
let myName = "Alice";
```

## Functions

### Parameter Type Annotations

```ts
// Parameter type annotation
function greet(name: string) {
  console.log("Hello, " + name.toUpperCase() + "!!");
}
```

### Return Type Annotations

```ts
function getFavoriteNumber(): number {
  return 26;
}
```

### Anonymous Functions

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

## Object Types

```ts
// The parameter's type annotation is an object type
function printCoord(pt: { x: number; y: number }) {
  console.log("The coordinate's x value is " + pt.x);
  console.log("The coordinate's y value is " + pt.y);
}
printCoord({ x: 3, y: 7 });
```

### Optional Properties

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

### Union Types

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

### Type Aliases

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

### Interfaces

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

### Type Assertions

Sometimes you will have information about the type of a value that TypeScript can’t know about.

For example, if you’re using `document.getElementById`, TypeScript only knows that this will return some kind of `HTMLElement`, but you might know that your page will always have an `HTMLCanvasElement` with a given ID.

In this situation, you can use a type assertion to specify a more specific type:

```ts
const myCanvas = document.getElementById("main_canvas") as HTMLCanvasElement;
```

Reminder: Because type assertions are removed at compile-time, there is no runtime checking associated with a type assertion.
There won’t be an exception or null generated if the type assertion is wrong.

### Literal Types

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

### null and undefined

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

### Enums

Enums are a feature added to JavaScript by TypeScript which allows for describing a value which could be one of a set of possible named constants.

Unlike most TypeScript features, this is **not a type-level addition to JavaScript but something added to the language and runtime**.

- See [Enums](https://www.typescriptlang.org/docs/handbook/enums.html)

### Less Common Primitives

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
