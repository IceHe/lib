# Type Manipulation

- [Creating Type from Types - Type Manipulation](https://www.typescriptlang.org/docs/handbook/2/types-from-types.html)

## Creating Type from Types

References

- [Creating Type from Types](https://www.typescriptlang.org/docs/handbook/2/types-from-types.html)

TypeScript's type system is very powerful because it allows expressing types _in terms of other types_.

The simplest form of this idea is generics, we actually have a wide variety of _type operators_ available to use.
It's also possible to express types in terms of _values_ that we already have.

**By combining various type operators, we can express complex operations and values in a succinct<!-- 简明的 -->, maintainable way.**
_In this section we'll cover ways to express a new type in terms of an existing type or value._

- [Generics](https://www.typescriptlang.org/docs/handbook/2/generics.html) - Types which take parameters
- [Keyof Type Operator](https://www.typescriptlang.org/docs/handbook/2/keyof-types.html) - Using the `keyof` operator to create new types
- [Typeof Type Operator](https://www.typescriptlang.org/docs/handbook/2/typeof-types.html) - Using the `typeof` operator to create new types
- [Indexed Access Types](https://www.typescriptlang.org/docs/handbook/2/indexed-access-types.html) - Using `Type['a']` syntax to access a subset of a type
- [Conditional Types](https://www.typescriptlang.org/docs/handbook/2/conditional-types.html) - Types which act like if statements in the type system
- [Mapped Types](https://www.typescriptlang.org/docs/handbook/2/mapped-types.html) - Creating types by mapping each property in an existing type
- [Template Literal Types](https://www.typescriptlang.org/docs/handbook/2/template-literal-types.html) - Mapped types which change properties via template literal strings

## Generics

References

- [Generics](https://www.typescriptlang.org/docs/handbook/2/generics.html)

_A major part of software engineering is building components that not only have well-defined and consistent APIs, but are also reusable._
_Components that are capable of working on the data of today as well as the data of tomorrow will give you the most flexible capabilities for building up large software systems._

_In languages like C# and Java, one of the main tools in the toolbox for creating reusable components is generics, that is, being able to create a component that can work over a variety of types rather than a single one._
_This allows users to consume these components and use their own types._

### Hello World of Generics

… skipped …

### Working with Generic Type Variables

```ts
function loggingIdentity<Type>(arg: Type): Type {
  console.log(arg.length);
  // Property 'length' does not exist on type 'Type'.
  return arg;
}
```

```ts
function loggingIdentity<Type>(arg: Array<Type>): Array<Type> {
  console.log(arg.length); // Array has a .length, so no more error
  return arg;
}
```

……

### Generic Types

```ts
function identity<Type>(arg: Type): Type {
  return arg;
}

let myIdentity: <Type>(arg: Type) => Type = identity;
```

```ts
function identity<Type>(arg: Type): Type {
  return arg;
}

let myIdentity: <Input>(arg: Input) => Input = identity;
```

```ts
interface GenericIdentityFn {
  <Type>(arg: Type): Type;
}

function identity<Type>(arg: Type): Type {
  return arg;
}

let myIdentity: GenericIdentityFn = identity;
```

```ts
interface GenericIdentityFn<Type> {
  (arg: Type): Type;
}

function identity<Type>(arg: Type): Type {
  return arg;
}

let myIdentity: GenericIdentityFn<number> = identity;
```

……

### Generic Classes

```ts
class GenericNumber<NumType> {
  zeroValue: NumType;
  add: (x: NumType, y: NumType) => NumType;
}

let myGenericNumber = new GenericNumber<number>();
myGenericNumber.zeroValue = 0;
myGenericNumber.add = function (x, y) {
  return x + y;
};
```

```ts
let stringNumeric = new GenericNumber<string>();
stringNumeric.zeroValue = "";
stringNumeric.add = function (x, y) {
  return x + y;
};

console.log(stringNumeric.add(stringNumeric.zeroValue, "test"));
```

……

### Generic Constraints

```ts
interface Lengthwise {
  length: number;
}

function loggingIdentity<Type extends Lengthwise>(arg: Type): Type {
  console.log(arg.length); // Now we know it has a .length property, so no more error
  return arg;
}
```

……

### Using Type Parameters in Generic Constraints

**You can declare a type parameter that is constrained by another type parameter.**
For example, here we'd like to get a property from an object given its name.
We'd like to ensure that we're not accidentally grabbing a property that does not exist on the `obj`, so we'll place a constraint between the two types:

```ts
function getProperty<Type, Key extends keyof Type>(obj: Type, key: Key) {
  return obj[key];
}

let x = { a: 1, b: 2, c: 3, d: 4 };

getProperty(x, "a");
getProperty(x, "m");
// Argument of type '"m"' is not assignable to parameter of type '"a" | "b" | "c" | "d"'.
```

### Using Class Types in Generics

```ts
class BeeKeeper {
  hasMask: boolean = true;
}

class ZooKeeper {
  nametag: string = "Mikle";
}

class Animal {
  numLegs: number = 4;
}

class Bee extends Animal {
  keeper: BeeKeeper = new BeeKeeper();
}

class Lion extends Animal {
  keeper: ZooKeeper = new ZooKeeper();
}

function createInstance<A extends Animal>(c: new () => A): A {
  return new c();
}

createInstance(Lion).keeper.nametag;
createInstance(Bee).keeper.hasMask;
```

……

## Keyof Types Operator

References

- [Keyof Type Operator](https://www.typescriptlang.org/docs/handbook/2/keyof-types.html)

### `keyof` type operator

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

## Typeof Types Operator

### `typeof` type operator

JavaScript already has a `typeof` operator you can use in an expression context:

```ts
// Prints "string"
console.log(typeof "Hello world");
```

TypeScript adds a `typeof` operator you can use in a _type_ context to refer to the _type_ of a variable or property:

```ts
let s = "hello";
let n: typeof s;
// let n: string
```

This isn't very useful for basic types, but combined with other type operators, you can use `typeof` to conveniently express many patterns.
For an example, let's start by looking at the predefined type `ReturnType<T>`.
_It takes a function type and produces its return type:_

```ts
type Predicate = (x: unknown) => boolean;
type K = ReturnType<Predicate>;
// type K = boolean
```

_If we try to use `ReturnType` on a function name, we see an instructive error:_

```ts
function f() {
  return { x: 10, y: 3 };
}
type P = ReturnType<f>;
// 'f' refers to a value, but is being used as a type here. Did you mean 'typeof f'?
```

**Remember that _values_ and _types_ aren't the same thing.**
_To refer to the type that the value f has, we use `typeof`:_

```ts
function f() {
  return { x: 10, y: 3 };
}

type P = ReturnType<typeof f>;
// type P = {
//     x: number;
//     y: number;
// }
```

### Limitations

TypeScript intentionally limits the sorts of expressions you can use `typeof` on.

**Specifically, it's only legal to use `typeof` on identifiers (i.e. variable names) or their properties.**
This helps avoid the confusing trap of writing code you think is executing, but isn't:

```ts
// Meant to use = ReturnType<typeof msgbox>
let shouldContinue: typeof msgbox("Are you sure you want to continue?");
// ',' expected.
```

## Indexed Access Types

## Conditional Types

## Mapped Types

## Template Literal Types

## Classes

## Modules
