# Type Manipulation

-   [Creating Type from Types - Type Manipulation](https://www.typescriptlang.org/docs/handbook/2/types-from-types.html)

## Creating Type from Types

References

-   [Creating Type from Types](https://www.typescriptlang.org/docs/handbook/2/types-from-types.html)

TypeScript's type system is very powerful because it allows expressing types _in terms of other types_.

The simplest form of this idea is generics, we actually have a wide variety of _type operators_ available to use.
It's also possible to express types in terms of _values_ that we already have.

**By combining various type operators, we can express complex operations and values in a succinct<!-- 简明的 -->, maintainable way.**
_In this section we'll cover ways to express a new type in terms of an existing type or value._

-   [Generics](https://www.typescriptlang.org/docs/handbook/2/generics.html) - Types which take parameters
-   [Keyof Type Operator](https://www.typescriptlang.org/docs/handbook/2/keyof-types.html) - Using the `keyof` operator to create new types
-   [Typeof Type Operator](https://www.typescriptlang.org/docs/handbook/2/typeof-types.html) - Using the `typeof` operator to create new types
-   [Indexed Access Types](https://www.typescriptlang.org/docs/handbook/2/indexed-access-types.html) - Using `Type['a']` syntax to access a subset of a type
-   [Conditional Types](https://www.typescriptlang.org/docs/handbook/2/conditional-types.html) - Types which act like if statements in the type system
-   [Mapped Types](https://www.typescriptlang.org/docs/handbook/2/mapped-types.html) - Creating types by mapping each property in an existing type
-   [Template Literal Types](https://www.typescriptlang.org/docs/handbook/2/template-literal-types.html) - Mapped types which change properties via template literal strings

## Generics

References

-   [Generics](https://www.typescriptlang.org/docs/handbook/2/generics.html)

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

-   [Keyof Type Operator](https://www.typescriptlang.org/docs/handbook/2/keyof-types.html)

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

We can use an _indexed access type_ to look up a specific property on another type:

```ts
type Person = { age: number; name: string; alive: boolean };
type Age = Person["age"];
// type Age = number
```

The indexing type is itself a type, so we can use unions, `keyof`, or other types entirely:

```ts
type I1 = Person["age" | "name"];
// type I1 = string | number

type I2 = Person[keyof Person];
// type I2 = string | number | boolean

type AliveOrName = "alive" | "name";
type I3 = Person[AliveOrName];
// type I3 = string | boolean
```

_You'll even see an error if you try to index a property that doesn't exist:_

```ts
type I1 = Person["alve"];
// Property 'alve' does not exist on type 'Person'.
```

_Another example of indexing with an arbitrary type is using `number` to get the type of an array's elements._
_We can combine this with `typeof` to conveniently capture the element type of an array literal:_

```ts
const MyArray = [
    { name: "Alice", age: 15 },
    { name: "Bob", age: 23 },
    { name: "Eve", age: 38 },
];

type Person = typeof MyArray[number];

type Person = {
    name: string;
    age: number;
};
type Age = typeof MyArray[number]["age"];

type Age = number;
// Or
type Age2 = Person["age"];

type Age2 = number;
```

_You can only use types when indexing, meaning you can't use a const to make a variable reference:_

```ts
const key = "age";
type Age = Person[key];
// Type 'key' cannot be used as an index type.
// 'key' refers to a value, but is being used as a type here. Did you mean 'typeof key'?
```

_However, you can use a type alias for a similar style of refactor:_

```ts
type key = "age";
type Age = Person[key];
```

<!-- icehe : 这里还是有点迷糊… -->

## Conditional Types

_At the heart of most useful programs<!-- 位于…的中心 -->, we have to make decisions based on input._
JavaScript programs are no different, but given the fact that values can be easily introspected<!-- 内省 -->, those decisions are also based on the types of the inputs.
**Conditional types help describe the relation between the types of inputs and outputs.**

```ts
interface Animal {
    live(): void;
}
interface Dog extends Animal {
    woof(): void;
}

type Example1 = Dog extends Animal ? number : string;
// type Example1 = number

type Example2 = RegExp extends Animal ? number : string;
// type Example2 = string
```

Conditional types take a form that looks a little like conditional expressions (`condition ? trueExpression : falseExpression`) in JavaScript:

```ts
SomeType extends OtherType ? TrueType : FalseType;
```

_When the type on the left of the `extends` is assignable to the one on the right, then you'll get the type in the first branch (the “true” branch); otherwise you'll get the type in the latter branch (the “false” branch)._

From the examples above, conditional types might not immediately seem useful - we can tell ourselves whether or not `Dog extends Animal` and pick `number` or `string`!
But **the power of conditional types comes from using them with generics.**

_For example, let's take the following `createLabel` function:_

```ts
interface IdLabel {
    id: number /* some fields */;
}
interface NameLabel {
    name: string /* other fields */;
}

function createLabel(id: number): IdLabel;
function createLabel(name: string): NameLabel;
function createLabel(nameOrId: string | number): IdLabel | NameLabel;
function createLabel(nameOrId: string | number): IdLabel | NameLabel {
    throw "unimplemented";
}
```

These overloads for createLabel describe a single JavaScript function that makes a choice based on the types of its inputs.
_Note a few things:_

1.  If a library has to make the same sort of choice over and over throughout its API, this becomes cumbersome<!-- 笨重的 -->.
2.  We have to create three overloads:
    one for each case when we're sure of the type (one for `string` and one for `number`), and one for the most general case (taking a `string | number`).
    For every new type `createLabel` can handle, the number of overloads grows exponentially.

_Instead, we can encode that logic in a conditional type:_

```ts
type NameOrId<T extends number | string> = T extends number
    ? IdLabel
    : NameLabel;
```

_We can then use that conditional type to simplify our overloads down to a single function with no overloads._

```ts
function createLabel<T extends number | string>(idOrName: T): NameOrId<T> {
    throw "unimplemented";
}

let a = createLabel("typescript");
// let a: NameLabel

let b = createLabel(2.8);
// let b: IdLabel

let c = createLabel(Math.random() ? "hello" : 42);
// let c: NameLabel | IdLabel
```

### Conditional Type Constraints

_Often, the checks in a conditional type will provide us with some new information._
Just like with narrowing with type guards can give us a more specific type, the true branch of a conditional type will further constrain generics by the type we check against.

_For example, let's take the following:_

```ts
type MessageOf<T> = T["message"];
// Type '"message"' cannot be used to index type 'T'.
```

In this example, TypeScript errors because `T` isn't known to have a property called `message`.
We could constrain `T`, and TypeScript would no longer complain:

```ts
type MessageOf<T extends { message: unknown }> = T["message"];

interface Email {
    message: string;
}

type EmailMessageContents = MessageOf<Email>;
// type EmailMessageContents = string
```

However, what if we wanted `MessageOf` to take any type, and default to something like `never` if a `message` property isn't available?
We can do this by moving the constraint out and introducing a conditional type:

```ts
type MessageOf<T> = T extends { message: unknown } ? T["message"] : never;

interface Email {
    message: string;
}

interface Dog {
    bark(): void;
}

type EmailMessageContents = MessageOf<Email>;
// type EmailMessageContents = string

type DogMessageContents = MessageOf<Dog>;
// type DogMessageContents = never
```

Within the true branch, TypeScript knows that `T` will have a `message` property.

As another example, we could also write a type called `Flatten` that flattens array types to their element types, but leaves them alone otherwise:

```ts
type Flatten<T> = T extends any[] ? T[number] : T;

// Extracts out the element type.
type Str = Flatten<string[]>;
// type Str = string

// Leaves the type alone.
type Num = Flatten<number>;
// type Num = number
```

<!-- icehe : 这段没看懂… -->

When `Flatten` is given an array type, it uses an indexed access with number to fetch out `string[]`'s element type.
Otherwise, it just returns the type it was given.

### Inferring Within Conditional Types

We just found ourselves **using conditional types to apply constraints and then extract out types.**
This ends up being such a common operation that conditional types make it easier.

Conditional types provide us with a way to infer from types we compare against in the true branch using the `infer` keyword.
_For example, we could have inferred the element type in `Flatten` instead of fetching it out “manually” with an indexed access type:_

```ts
type Flatten<Type> = Type extends Array<infer Item> ? Item : Type;
```

Here, we **used the `infer` keyword to declaratively introduce a new generic type variable named `Item` instead of specifying how to retrieve the element type of `T` within the true branch**.
This frees us from having to think about how to dig through and probing apart the structure of the types we're interested in.

We can write some useful helper type aliases using the `infer` keyword.
_For example, for simple cases, we can extract the return type out from function types:_

```ts
type GetReturnType<Type> = Type extends (...args: never[]) => infer Return
    ? Return
    : never;

type Num = GetReturnType<() => number>;
// type Num = number

type Str = GetReturnType<(x: string) => string>;
// type Str = string

type Bools = GetReturnType<(a: boolean, b: boolean) => boolean[]>;
// type Bools = boolean[]
```

When inferring from a type with multiple call signatures (such as the type of an overloaded function), inferences are made from the last signature (which, presumably, is the most permissive catch-all case).
It is not possible to perform overload resolution based on a list of argument types.

```ts
declare function stringOrNum(x: string): number;
declare function stringOrNum(x: number): string;
declare function stringOrNum(x: string | number): string | number;

type T1 = ReturnType<typeof stringOrNum>;
// type T1 = string | number
```

<!-- icehe : 这段看懵了… 睡得不够, 不太清醒. 2021/10/20 -->

### Distributive Conditional Types

When conditional types act on a generic type, they become distributive when given a union type.
_For example, take the following:_

```ts
type ToArray<Type> = Type extends any ? Type[] : never;
```

If we plug a union type into `ToArray`, then the conditional type will be applied to each member of that union.

```ts
type ToArray<Type> = Type extends any ? Type[] : never;

type StrArrOrNumArr = ToArray<string | number>;
// type StrArrOrNumArr = string[] | number[]
```

What happens here is that `StrArrOrNumArr` distributes on:

```ts
string | number;
```

and maps over each member type of the union, to what is effectively:

```ts
ToArray<string> | ToArray<number>;
```

which leaves us with:

```ts
string[] | number[];
```

Typically, distributivity is the desired behavior.
To avoid that behavior, you can surround each side of the extends keyword with square brackets.

```ts
type ToArrayNonDist<Type> = [Type] extends [any] ? Type[] : never;

// 'StrArrOrNumArr' is no longer a union.
type StrArrOrNumArr = ToArrayNonDist<string | number>;
// type StrArrOrNumArr = (string | number)[]
```

## Mapped Types

When you don't want to repeat yourself, sometimes a type needs to be based on another type.

Mapped types build on the syntax for index signatures, which are used to declare the types of properties which have not been declared ahead of time:

```ts
type OnlyBoolsAndHorses = {
    [key: string]: boolean | Horse;
};

const conforms: OnlyBoolsAndHorses = {
    del: true,
    rodney: false,
};
```

_A mapped type is a generic type which uses a union of PropertyKeys (frequently created via a keyof) to iterate through keys to create a type:_

todo oneday

### Mapping Modifiers

### Key Remapping via `as`

### Further Exploration

## Template Literal Types

### String Unions in Types

### Inference with Template Literals

### Intrinsic String Manipulation Types

#### `Uppercase<StringType>`

#### `Lowercase<StringType>`

#### `Capitalize<StringType>`

#### `Uncapitalize<StringType>`

## Classes

### Class Members

#### Fields

##### `readonly`

#### Constructors

#### Methods

##### Getters / Setters

##### Index Signatures

### Class Heritage

#### `implements` Clauses

#### `extends` Clauses

### Member Visibility

#### `public`

#### `protected`

#### `private`

### Static Members

#### Special Static Names

#### Why No Static Classes?

#### `static` Blocks in Classes

### Generic Classes

#### Type Parameters in Static Members

### `this` at Runtime in Classes

#### Arrow Functions

#### `this` parameters

### `this` Types

#### `this`-based type guards

### Parameter Properties

### Class Expressions

### `abstract` Classes and Members

#### Abstract Construct Signatures

### Relationships Between Classes

## Modules

### How JavaScript Modules are Defined

### Non-modules

### Modules in TypeScript

#### Additional Import Syntax

### CommonJS Syntax

#### CommonJS and ES Modules interop

### TypeScript’s Module Resolution Options

### TypeScript’s Module Output Options

### TypeScript namespaces
