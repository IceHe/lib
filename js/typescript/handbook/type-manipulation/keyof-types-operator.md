# Keyof Types Operator

References

- [Keyof Type Operator](https://www.typescriptlang.org/docs/handbook/2/keyof-types.html)

## `keyof` type operator

**The `keyof` operator takes an object type and produces a string or numeric literal union of its keys.**
_The following type P is the same type as “x” | “y”:_

```ts
type Point = { x: number; y: number };
type P = keyof Point;
// type P = keyof Point
```

If the type has a `string` or `number` index signature, keyof will return those types instead:

```ts
type Arrayish = { [n: number]: unknown };
type A = keyof Arrayish;
// type A = number

type Mapish = { [k: string]: boolean };
type M = keyof Mapish;
// type M = string | number
```

**Note that in this example, M is `string | number` — this is because JavaScript object keys are always coerced to a string, so `obj[0]` is always the same as `obj["0"]`.**

_`keyof` types become especially useful when combined with mapped types, which we'll learn more about later._
