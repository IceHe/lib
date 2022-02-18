# *.d.ts

Declaration files that functions as an interface to the components compiled in JavaScript

---

References

- [About "*.d.ts" in TypeScript - Stack Overflow](https://stackoverflow.com/questions/21247278/about-d-ts-in-typescript)
- [Declaration files - TypeScript - Wikipedia](https://en.wikipedia.org/wiki/TypeScript#Declaration_files)
- [*.d.ts vs *.ts - thisthat.dev](https://thisthat.dev/d-ts-vs-ts/)
- [Modules .d.ts - TypeScript Docs](https://www.typescriptlang.org/docs/handbook/declaration-files/templates/module-d-ts.html)

## Concepts

### Type definition files

(Easier to understand)

Reference: [*.d.ts vs *.ts - thisthat.dev](https://thisthat.dev/d-ts-vs-ts/)

-   **`*.ts` is the standard TypeScript files.**
    - The content then will be compiled to JavaScript.
-   **`*.d.ts` is the type definition files that allow to use existing JavaScript code in TypeScript.**

_For example, we have a simple JavaScript function that calculates the sum of two numbers:_

```js
// math.js
const sum = (a, b) => a + b;

export { sum };
```

TypeScript doesn't have any information about the function including the name, the type of parameters.
In order to use the function in a TypeScript file, we provide its definition in a `d.ts` file:

```ts
// math.d.ts
declare function sum(a: number, b: number): number;
```
From now on, we can use the function in TypeScript without any compile errors.
The `d.ts` file doesn't contain any implementation, and isn't compiled to JavaScript at all.

### Declaration files

(With a better metaphor)

Reference: [Declaration files - TypeScript - Wikipedia](https://en.wikipedia.org/wiki/TypeScript#Declaration_files)

When a TypeScript script gets compiled there is an option to generate a **declaration file (with the extension `.d.ts`) that functions as an interface to the components in the compiled JavaScript.**

In the process the compiler strips away all function and method bodies and preserves only the signatures of the types that are exported.
The resulting declaration file can then be used to describe the exported virtual TypeScript types of a JavaScript library or module when a third-party developer consumes it from TypeScript.

The concept of declaration files is **analogous to the concept of header file found in C/C++.**

```ts
// example.d.ts
declare namespace arithmetics {
    add(left: number, right: number): number;
    subtract(left: number, right: number): number;
    multiply(left: number, right: number): number;
    divide(left: number, right: number): number;
}
```

_Type declaration files can be written by hand for existing JavaScript libraries, as has been done for jQuery and Node.js._

Large collections of declaration files for popular JavaScript libraries are hosted on GitHub in [DefinitelyTyped](https://github.com/DefinitelyTyped/DefinitelyTyped).

## Usage

### Body.json()

Original interface:

```ts
// node_modules/typescript/lib/lib.dom.d.ts
interface Body {
  ……
  json(): Promise<any>;
  ……
}
```

Overwrite the interface method `Body.json`:

```ts
// e.g. path/to/project/src/include.d/dom.d.ts
interface Body {
  json<T>(): Promise<T>;
}
```

So that I can:

```ts
const something = response.json<Something>();
```

It looks better and more elegant than using `as Something`:

```ts
const something = response.json() as Something;
```

But actually their effects are the same: force to cast the variable to specific type.

### JSON.parse()

Similar to `Body.json()`.

Original interface:

```ts
// e.g. node_modules/typescript/lib/lib.es5.d.ts:1059
interface JSON {
    /**
     * Converts a JavaScript Object Notation (JSON) string into an object.
     * @param text A valid JSON string.
     * @param reviver A function that transforms the results. This function is called for each member of the object.
     * If a member contains nested objects, the nested objects are transformed before the parent object is.
     */
    parse(text: string, reviver?: (this: any, key: string, value: any) => any): any;
    ……
}
```

Overwrite the interface method `Body.json`:

```ts
// e.g. path/to/project/src/include.d/es.d.ts
type JsonParseParameter = Parameters<typeof JSON.parse>;

interface JSON {
  parse<T>(JsonParseParameter): T;
}
```

So that I can:

```ts
const something = JSON.parse<Something>(somethingJson);
```

……
