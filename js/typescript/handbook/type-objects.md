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

## Intersection Types

## Interfaces vs. Intersections

## Generic Object Types

### `Array` Type

### `ReadonlyArray` Type

### Tuple Types

### `readonly` Tuple Types
