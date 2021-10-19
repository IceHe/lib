# Object Types

References

- [Object Types - TypeScript Handbook](https://www.typescriptlang.org/docs/handbook/2/objects.html)

In JavaScript, the fundamental way that we **group and pass around data is through objects**.
In TypeScript, we represent those through _object types_.

_As we've seen, they can be anonymous:_

```ts
function greet(person: { name: string; age: number }) {
  return "Hello " + person.name;
}
```

_or they can be named by using either an interface_

```ts
interface Person {
  name: string;
  age: number;
}

function greet(person: Person) {
  return "Hello " + person.name;
}
```

_or a type alias._

```ts
type Person = {
  name: string;
  age: number;
};

function greet(person: Person) {
  return "Hello " + person.name;
}
```

In all three examples above, we've written functions that take objects that contain the property `name` (which must be a `string`) and `age` (which must be a `number`).

## Property Modifiers

Each property in an object type can specify a couple of things:

- **the type**,
- **whether the property is optional**, and
- **whether the property can be written to**.

### Optional Properties

_Much of the time, we'll find ourselves dealing with objects that might have a property set._
In those cases, we can **mark those properties as _optional_ by adding a question mark (`?`) to the end of their names.**

```ts
interface PaintOptions {
  shape: Shape;
  xPos?: number;
  yPos?: number;
}

function paintShape(opts: PaintOptions) {
  // ...
}

const shape = getShape();
paintShape({ shape });
paintShape({ shape, xPos: 100 });
paintShape({ shape, yPos: 100 });
paintShape({ shape, xPos: 100, yPos: 100 });
```

_In this example, both `xPos` and `yPos` are considered optional._
_We can choose to provide either of them, so every call above to `paintShape` is valid._
_All optionality really says is that if the property is set, it better have a specific type._

_We can also read from those properties - but when we do under `strictNullChecks`, TypeScript will tell us they're potentially `undefined`._

```ts
function paintShape(opts: PaintOptions) {
  let xPos = opts.xPos;
  // (property) PaintOptions.xPos?: number | undefined
  let yPos = opts.yPos;
  // (property) PaintOptions.yPos?: number | undefined
  // ...
}
```

In JavaScript, even if the property has never been set, we can still access it - it's just going to give us the value `undefined`.
_We can just handle `undefined` specially._

```ts
function paintShape(opts: PaintOptions) {
  let xPos = opts.xPos === undefined ? 0 : opts.xPos;
  // let xPos: number
  let yPos = opts.yPos === undefined ? 0 : opts.yPos;
  // let yPos: number
  // ...
}
```

_Note that this pattern of setting defaults for unspecified values is so common that JavaScript has syntax to support it._

```ts
function paintShape({ shape, xPos = 0, yPos = 0 }: PaintOptions) {
  console.log("x coordinate at", xPos);

(parameter) xPos: number
  console.log("y coordinate at", yPos);

(parameter) yPos: number
  // ...
}
```

Here we used [a destructuring pattern](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring_assignment) for `paintShape`'s parameter, and provided default values for `xPos` and `yPos`.
Now `xPos` and `yPos` are both definitely present within the body of `paintShape`, but optional for any callers to `paintShape`.

> Note that there is currently no way to place type annotations within destructuring patterns.
> This is because the following syntax already means something different in JavaScript.

```ts
function draw({ shape: Shape, xPos: number = 100 /*...*/ }) {
  render(shape);
  // Cannot find name 'shape'. Did you mean 'Shape'?
  render(xPos);
  // Cannot find name 'xPos'.
}
```

In an object destructuring pattern, `shape: Shape` means “grab the property `shape` and redefine it locally as a variable named `Shape`.
Likewise `xPos: number` creates a variable named `number` whose value is based on the parameter's `xPos`.
<!-- icehe : 这段看不太懂 2021/10/19 -->

_Using [mapping modifiers](https://www.typescriptlang.org/docs/handbook/2/mapped-types.html#mapping-modifiers), you can remove `optional` attributes._

### `readonly` Properties

Properties can also be **marked as `readonly` for TypeScript.**
**While it won't change any behavior at runtime, a property marked as `readonly` can't be written to during type-checking.**

```ts
interface SomeType {
  readonly prop: string;
}

function doSomething(obj: SomeType) {
  // We can read from 'obj.prop'.
  console.log(`prop has the value '${obj.prop}'.`);

  // But we can't re-assign it.
  obj.prop = "hello";
  // Cannot assign to 'prop' because it is a read-only property.
}
```

Using the `readonly` modifier doesn't necessarily imply that a value is totally immutable - or in other words, that its internal contents can't be changed.
It just means the property itself can't be re-written to.

```ts
interface Home {
  readonly resident: { name: string; age: number };
}

function visitForBirthday(home: Home) {
  // We can read and update properties from 'home.resident'.
  console.log(`Happy birthday ${home.resident.name}!`);
  home.resident.age++;
}

function evict(home: Home) {
  // But we can't write to the 'resident' property itself on a 'Home'.
  home.resident = {
    // Cannot assign to 'resident' because it is a read-only property.
    name: "Victor the Evictor",
    age: 42,
  };
}
```

_It's important to manage expectations of what `readonly` implies._
It's useful to signal intent during development time for TypeScript on how an object should be used.
TypeScript doesn't factor in whether properties on two types are `readonly` when checking whether those types are compatible, so `readonly` properties can also change via aliasing.

```ts
interface Person {
  name: string;
  age: number;
}

interface ReadonlyPerson {
  readonly name: string;
  readonly age: number;
}

let writablePerson: Person = {
  name: "Person McPersonface",
  age: 42,
};

// works
let readonlyPerson: ReadonlyPerson = writablePerson;

console.log(readonlyPerson.age); // prints '42'
writablePerson.age++;
console.log(readonlyPerson.age); // prints '43'
```

_Using [mapping modifiers](https://www.typescriptlang.org/docs/handbook/2/mapped-types.html#mapping-modifiers), you can remove `readonly` attributes._

### Index Signatures

Sometimes you don't know all the names of a type's properties ahead of time, but you do know the shape of the values.

_In those cases you can use an index signature to describe the types of possible values, for example:_

```ts
interface StringArray {
  [index: number]: string;
}

const myArray: StringArray = getStringArray();
const secondItem = myArray[1];
// const secondItem: string
```

Above, we have a `StringArray` interface which has an index signature.
This index signature states that when a `StringArray` is indexed with a `number`, it will return a `string`.

An index signature property type must be either ‘string' or ‘number'.

It is possible to support both types of indexers, but the type returned from a numeric indexer must be a subtype of the type returned from the string indexer.
This is because **when indexing with a `number`, JavaScript will actually convert that to a `string` before indexing into an object.**
**That means that indexing with `100` (a `number`) is the same thing as indexing with `"100"` (a `string`), so the two need to be consistent.**

```ts
interface Animal {
  name: string;
}

interface Dog extends Animal {
  breed: string;
}

// Error: indexing with a numeric string might get you a completely separate type of Animal!
interface NotOkay {
  [x: number]: Animal;
  // 'number' index type 'Animal' is not assignable to 'string' index type 'Dog'.
  [x: string]: Dog;
}
```

While string index signatures are a powerful way to describe the “dictionary” pattern, they also enforce that all properties match their return type.
This is because a string index declares that `obj.property` is also available as `obj["property"]`.
_In the following example, name's type does not match the string index's type, and the type checker gives an error:_

```ts
interface NumberDictionary {
  [index: string]: number;

  length: number; // ok
  name: string;
  // Property 'name' of type 'string' is not assignable to 'string' index type 'number'.
}
```

_However, properties of different types are acceptable if the index signature is a union of the property types:_

```ts
interface NumberOrStringDictionary {
  [index: string]: number | string;
  length: number; // ok, length is a number
  name: string; // ok, name is a string
}
```

Finally, you can make index signatures `readonly` in order to prevent assignment to their indices:

```ts
interface ReadonlyStringArray {
  readonly [index: number]: string;
}

let myArray: ReadonlyStringArray = getReadOnlyStringArray();
myArray[2] = "Mallory";
// Index signature in type 'ReadonlyStringArray' only permits reading.
```

_You can't set `myArray[2]` because the index signature is `readonly`._

## Extending Types

_It's pretty common to have types that might be more specific versions of other types._
_For example, we might have a `BasicAddress` type that describes the fields necessary for sending letters and packages in the U.S._

```ts
interface BasicAddress {
  name?: string;
  street: string;
  city: string;
  country: string;
  postalCode: string;
}
```

_In some situations that's enough, but addresses often have a unit number associated with them if the building at an address has multiple units._
_We can then describe an AddressWithUnit._

```ts
interface AddressWithUnit {
  name?: string;
  unit: string;
  street: string;
  city: string;
  country: string;
  postalCode: string;
}
```

_This does the job, but the downside here is that we had to repeat all the other fields from `BasicAddress` when our changes were purely additive._
_Instead, we can extend the original `BasicAddress` type and just add the new fields that are unique to `AddressWithUnit`._

```ts
interface BasicAddress {
  name?: string;
  street: string;
  city: string;
  country: string;
  postalCode: string;
}

interface AddressWithUnit extends BasicAddress {
  unit: string;
}
```

**The `extends` keyword on an `interface` allows us to effectively copy members from other named types, and add whatever new members we want.**
_This can be useful for cutting down the amount of type declaration boilerplate we have to write, and for signaling intent that several different declarations of the same property might be related._
_For example, AddressWithUnit didn't need to repeat the street property, and because street originates from BasicAddress, a reader will know that those two types are related in some way._

**`interfaces` can also extend from multiple types.**

```ts
interface Colorful {
  color: string;
}

interface Circle {
  radius: number;
}

interface ColorfulCircle extends Colorful, Circle {}

const cc: ColorfulCircle = {
  color: "red",
  radius: 42,
};
```

## Intersection Types

`interface`s allowed us to build up new types from other types by extending them.
**TypeScript provides another construct called _intersection_ types that is mainly used to combine existing object types.**

**An intersection type is defined using the `&` operator.**

```ts
interface Colorful {
  color: string;
}
interface Circle {
  radius: number;
}

type ColorfulCircle = Colorful & Circle;
```

_Here, we've intersected `Colorful` and `Circle` to produce a new type that has all the members of `Colorful` and `Circle`._

```ts
function draw(circle: Colorful & Circle) {
  console.log(`Color was ${circle.color}`);
  console.log(`Radius was ${circle.radius}`);
}

// okay
draw({ color: "blue", radius: 42 });

// oops
draw({ color: "red", raidus: 42 });
// Argument of type '{ color: string; raidus: number; }' is not assignable to parameter of type 'Colorful & Circle'.
//   Object literal may only specify known properties, but 'raidus' does not exist in type 'Colorful & Circle'. Did you mean to write 'radius'?
```

## Interfaces vs. Intersections

We just looked at two ways to combine types which are similar, but are actually subtly different.
With interfaces, we could use an `extends` clause to extend from other types, and we were able to do something similar with intersections and name the result with a type alias.
The principle difference between the two is how conflicts are handled, and that difference is typically one of the main reasons why you'd pick one over the other between an interface and a type alias of an intersection type.

## Generic Object Types

_Let's imagine a `Box` type that can contain any value - `string`s, `number`s, `Giraffe`s, whatever._

```ts
interface Box {
  contents: any;
}
```

_Right now, the `contents` property is typed as `any`, which works, but can lead to accidents down the line._

We could instead use `unknown`, but that would mean that in cases where we already know the type of `contents`, we'd need to do precautionary checks, or use error-prone type assertions.

```ts
interface Box {
  contents: unknown;
}

let x: Box = {
  contents: "hello world",
};

// we could check 'x.contents'
if (typeof x.contents === "string") {
  console.log(x.contents.toLowerCase());
}

// or we could use a type assertion
console.log((x.contents as string).toLowerCase());
```

_One type safe approach would be to instead scaffold out different `Box` types for every type of `contents`._

```ts
interface NumberBox {
  contents: number;
}

interface StringBox {
  contents: string;
}

interface BooleanBox {
  contents: boolean;
}
```

_But that means we'll have to create different functions, or overloads of functions, to operate on these types._

```ts
function setContents(box: StringBox, newContents: string): void;
function setContents(box: NumberBox, newContents: number): void;
function setContents(box: BooleanBox, newContents: boolean): void;
function setContents(box: { contents: any }, newContents: any) {
  box.contents = newContents;
}
```

_That's a lot of boilerplate._
_Moreover, we might later need to introduce new types and overloads._
_This is frustrating, since our box types and overloads are all effectively the same._

_Instead, we can make a generic `Box` type which declares a type parameter._

```ts
interface Box<Type> {
  contents: Type;
}
```

You might read this as **"A `Box` of `Type` is something whose `contents` have type `Type`"**.
Later on, when we refer to `Box`, we have to give a type argument in place of `Type`.

```ts
let box: Box<string>;
```

_Think of `Box` as a template for a real type, where `Type` is a placeholder that will get replaced with some other type._
_When TypeScript sees `Box<string>`, it will replace every instance of `Type` in `Box<Type>` with string, and end up working with something like `{ contents: string }`._
_In other words, `Box<string>` and our earlier `StringBox` work identically._

```ts
interface Box<Type> {
  contents: Type;
}
interface StringBox {
  contents: string;
}

let boxA: Box<string> = { contents: "hello" };
boxA.contents;
// (property) Box<string>.contents: string

let boxB: StringBox = { contents: "world" };
boxB.contents;
// (property) StringBox.contents: string
```

**`Box` is reusable in that `Type` can be substituted with anything.**
_That means that when we need a box for a new type, we don't need to declare a new `Box` type at all (though we certainly could if we wanted to)._

```ts
interface Box<Type> {
  contents: Type;
}

interface Apple {
  // ....
}

// Same as '{ contents: Apple }'.
type AppleBox = Box<Apple>;
```

This also means that we can avoid overloads entirely by instead using [generic functions](https://www.typescriptlang.org/docs/handbook/2/functions.html#generic-functions).

```ts
function setContents<Type>(box: Box<Type>, newContents: Type) {
  box.contents = newContents;
}
```

It is worth noting that<!-- 值得注意的是 --> **type aliases can also be generic.**
We could have defined our new `Box<Type>` interface, which was:

```ts
interface Box<Type> {
  contents: Type;
}
```

by using a type alias instead:

```ts
type Box<Type> = {
  contents: Type;
};
```

**Since type aliases, unlike interfaces, can describe more than just object types, we can also use them to write other kinds of generic helper types.**

```ts
type OrNull<Type> = Type | null;

type OneOrMany<Type> = Type | Type[];

type OneOrManyOrNull<Type> = OrNull<OneOrMany<Type>>;
// type OneOrManyOrNull<Type> = OneOrMany<Type> | null

type OneOrManyOrNullStrings = OneOrManyOrNull<string>;
// type OneOrManyOrNullStrings = OneOrMany<string> | null
```

_We'll circle back to type aliases in just a little bit._

### `Array` Type

Generic object types are often some sort of container type that work independently of the type of elements they contain.
It's ideal for data structures to work this way so that they're re-usable across different data types.

It turns out we've been working with a type just like that throughout this handbook: the `Array` type.
**Whenever we write out types like `number[]` or `string[]`, that's really just a shorthand for `Array<number>` and `Array<string>`.**

```ts
function doSomething(value: Array<string>) {
  // ...
}

let myArray: string[] = ["hello", "world"];

// either of these work!
doSomething(myArray);
doSomething(new Array("hello", "world"));
```

_Much like the `Box` type above, `Array` itself is a generic type._

```ts
interface Array<Type> {
  /**
   * Gets or sets the length of the array.
   */
  length: number;

  /**
   * Removes the last element from an array and returns it.
   */
  pop(): Type | undefined;

  /**
   * Appends new elements to an array, and returns the new length of the array.
   */
  push(...items: Type[]): number;

  // ...
}
```

Modern JavaScript also provides other data structures which are generic, like `Map<K, V>`, `Set<T>`, and `Promise<T>`.
All this really means is that because of how `Map`, `Set`, and `Promise` behave, they can work with any sets of types.

### `ReadonlyArray` Type

**The `ReadonlyArray` is a special type that describes arrays that shouldn't be changed.**

```ts
function doStuff(values: ReadonlyArray<string>) {
  // We can read from 'values'...
  const copy = values.slice();
  console.log(`The first value is ${values[0]}`);

  // ...but we can't mutate 'values'.
  values.push("hello!");
    // Property 'push' does not exist on type 'readonly string[]'.
}
```

Much like the `readonly` modifier for properties, it's mainly a tool we can use for intent.
**When we see a function that returns `ReadonlyArrays`, it tells us we're not meant to change the contents at all, and when we see a function that consumes `ReadonlyArrays`, it tells us that we can pass any array into that function without worrying that it will change its contents.**

Unlike `Array`, there isn't a `ReadonlyArray` constructor that we can use.

```ts
new ReadonlyArray("red", "green", "blue");
// 'ReadonlyArray' only refers to a type, but is being used as a value here.
```

Instead, we can assign regular `Array`s to `ReadonlyArray`s.

```ts
const roArray: ReadonlyArray<string> = ["red", "green", "blue"];
```

Just as TypeScript provides a shorthand syntax for `Array<Type>` with `Type[]`, it also provides a shorthand syntax for `ReadonlyArray<Type>` with `readonly Type[]`.

```ts
function doStuff(values: readonly string[]) {
  // We can read from 'values'...
  const copy = values.slice();
  console.log(`The first value is ${values[0]}`);

  // ...but we can't mutate 'values'.
  values.push("hello!");
  // Property 'push' does not exist on type 'readonly string[]'.
}
```

One last thing to note is that unlike the `readonly` property modifier, assignability isn’t bidirectional between regular `Array`s and `ReadonlyArray`s.

```ts
let x: readonly string[] = [];
let y: string[] = [];

x = y;
y = x;
// The type 'readonly string[]' is 'readonly' and cannot be assigned to the mutable type 'string[]'.
```

### Tuple Types

### `readonly` Tuple Types
