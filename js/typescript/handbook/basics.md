# Basics

References

- [The Basics - TypeScript Handbook](https://www.typescriptlang.org/docs/handbook/2/basic-types.html)

## Static Type-checking

Ideally, we could have a tool that helps us **find these bugs before our code runs**.
That's what a static type-checker like TypeScript does.

Static types systems describe the shapes and behaviors of what our values will be when we run our programs.
A type-checker like TypeScript uses that information and tells us when things might be going off the rails.

## Non-exception Failures

……

## Types for Tooling

……

## `tsc`, TypeScript Compiler

## Emitting with Errors

```bash
tsc --noEmitOnError hello.ts
```

## Explicit Types

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

## Erased Types

……

## Downleveling

**By default TypeScript targets ES3.**

The great majority of current browsers support ES2015.
Running with `--target es2015` changes TypeScript to target ECMAScript 2015, meaning code should be able to run wherever ECMAScript 2015 is supported.

_Most developers can therefore safely specify ES2015 or above as a target, …_

## Strictness

Some people are looking for a more loose opt-in <!-- 选择参加 --> experience which can help validate only some parts of their program, and still have decent <!-- 得体的 --> tooling.

… `"strict": true` in a `tsconfig.json` toggles …

### `noImplicitAny`

most lenient type `any`

### `strictNullChecks`

makes handling `null` and `undefined` more explicit, and spares us from worrying about whether we forgot to handle `null` and `undefined`.
