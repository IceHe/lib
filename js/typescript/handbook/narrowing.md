# Narrowing

References

- [Narrowing - TypeScript Handbook](https://www.typescriptlang.org/docs/handbook/2/narrowing.html)

---

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

## `typeof` type guards

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

## Truthiness Narrowing

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

## Equality Narrowing

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

## `in` Operator Narrowing

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

```ts
type Fish = { swim: () => void };
type Bird = { fly: () => void };
type Human = { swim?: () => void; fly?: () => void };

function move(animal: Fish | Bird | Human) {
  if ("swim" in animal) {
    animal;
    // (parameter) animal: Fish | Human
  } else {
    animal;
    // (parameter) animal: Bird | Human
  }
}
```

## `instanceof` narrowing

JavaScript has an operator for checking whether or not a value is an “instance” of another value.
**More specifically, in JavaScript `x instanceof Foo` checks whether the prototype chain of `x` contains `Foo.prototype`.**
_While we won't dive deep here, and you'll see more of this when we get into classes, they can still be useful for most values that can be constructed with `new`._
As you might have guessed, `instanceof` is also a type guard, and TypeScript narrows in branches guarded by `instanceof`s.

```ts
function logValue(x: Date | string) {
  if (x instanceof Date) {
    console.log(x.toUTCString());
    // (parameter) x: Date
  } else {
    console.log(x.toUpperCase());
    // (parameter) x: string
  }
}
```
