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
_The “true” branch narrows `x`'s types which have either an optional or required property value, and the “false” branch narrows to types which have an optional or missing property `value`._

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

## Assignments

_As we mentioned earlier, when we assign to any variable, TypeScript looks at the right side of the assignment and narrows the left side appropriately._

```ts
let x = Math.random() < 0.5 ? 10 : "hello world!";
// let x: string | number

x = 1;
console.log(x);
// let x: number

x = "goodbye!";
console.log(x);
// let x: string
```

Notice that each of these assignments is valid.
**Even though the observed type of `x` changed to `number` after our first assignment, we were still able to assign a string to `x`.**
**This is because the declared type of `x` - the type that `x` started with - is `string | number`, and assignability is always checked against the declared type.**

_If we'd assigned a boolean to `x`, we'd have seen an error since that wasn't part of the declared type._

```ts
let x = Math.random() < 0.5 ? 10 : "hello world!";
// let x: string | number

x = 1;
console.log(x);
// let x: number

x = true;
// Type 'boolean' is not assignable to type 'string | number'.
console.log(x);
// let x: string | number
```

## Control Flow Analysis

_Up until this point, we've gone through some basic examples of how TypeScript narrows within specific branches._
_But there's a bit more going on than just walking up from every variable and looking for type guards in `if`s, `while`s, conditionals, etc. For example_

```ts
function padLeft(padding: number | string, input: string) {
  if (typeof padding === "number") {
    return new Array(padding + 1).join(" ") + input;
  }
  return padding + input;
}
```

**`padLeft` returns from within its first `if` block.**
**TypeScript was able to analyze this code and see that the rest of the body (`return padding + input;`) is unreachable in the case where padding is a number.**
**As a result, it was able to remove number from the type of padding (narrowing from `string | number` to `string`) for the rest of the function.**

This analysis of code based on reachability is called **control flow analysis**, and TypeScript uses this flow analysis to narrow types as it encounters type guards and assignments.
When a variable is analyzed, control flow can split off and re-merge over and over again, and that variable can be observed to have a different type at each point.

```ts
function example() {
  let x: string | number | boolean;

  x = Math.random() < 0.5;
  console.log(x);
    // let x: boolean

  if (Math.random() < 0.5) {
    x = "hello";
    console.log(x);
    // let x: string
  } else {
    x = 100;
    console.log(x);
    // let x: number
  }

  return x;
  // let x: string | number
}
```

## Using Type Predicates

_We've worked with existing JavaScript constructs to handle narrowing so far, however sometimes you want more direct control over how types change throughout your code._

_To define a user-defined type guard, we simply need to define a function whose return type is a type predicate:_

```ts
function isFish(pet: Fish | Bird): pet is Fish {
  return (pet as Fish).swim !== undefined;
}
```

**`pet is Fish` is our type predicate** in this example.
**A predicate takes the form parameterName is Type, where parameterName must be the name of a parameter from the current function signature.**

Any time `isFish` is called with some variable, TypeScript will narrow that variable to that specific type if the original type is compatible.

```ts
// Both calls to 'swim' and 'fly' are now okay.
let pet = getSmallPet();

if (isFish(pet)) {
  pet.swim();
} else {
  pet.fly();
}
```

_Notice that TypeScript not only knows that `pet` is a `Fish` in the `if` branch; it also knows that in the `else` branch, you don't have a Fish, so you must have a Bird._

You may use the type guard `isFish` to filter an array of `Fish | Bird` and obtain an array of `Fish`:

```ts
const zoo: (Fish | Bird)[] = [getSmallPet(), getSmallPet(), getSmallPet()];
const underWater1: Fish[] = zoo.filter(isFish);
// or, equivalently
const underWater2: Fish[] = zoo.filter(isFish) as Fish[];

// The predicate may need repeating for more complex examples
const underWater3: Fish[] = zoo.filter((pet): pet is Fish => {
  if (pet.name === "sharkey") return false;
  return isFish(pet);
});
```

_In addition, classes can [use this is Type](https://www.typescriptlang.org/docs/handbook/2/classes.html#this-based-type-guards) to narrow their type._

<!-- icehe : 暂时看得不是很明白 2021/10/15 -->

## Discriminated Unions

## The never Type

## Exhaustiveness Checking
