# More on Functions

References

- [More on Functions - TypeScript Handbook](https://www.typescriptlang.org/docs/handbook/2/functions.html)

Functions are the basic building block of any application, whether they're local functions, imported from another module, or methods on a class.
**They're also values, and just like other values, TypeScript has many ways to describe how functions can be called.**

---

## Function Type Expressions

_The simplest way to describe a function is with a function type expression._
_These types are syntactically similar to arrow functions:_

```ts
function greeter(fn: (a: string) => void) {
  fn("Hello, World");
}

function printToConsole(s: string) {
  console.log(s);
}

greeter(printToConsole);
```

The syntax `(a: string) => void` means "a function with one parameter, named `a`, of type string, that doesn't have a return value".
_Just like with function declarations, if a parameter type isn't specified, it's implicitly `any`._

_Of course, we can use a type alias to name a function type:_

```ts
type GreetFunction = (a: string) => void;
function greeter(fn: GreetFunction) {
  // ...
}
```

## Call Signatures

In JavaScript, functions can have properties in addition to being callable.
However, the function type expression syntax doesn't allow for declaring properties.
**If we want to describe something callable with properties, we can write a call signature in an object type**:

```ts
type DescribableFunction = {
  description: string;
  (someArg: number): boolean;
};

function doSomething(fn: DescribableFunction) {
  console.log(fn.description + " returned " + fn(6));
}
```

Note that the syntax is slightly different compared to a function type expression - use `:` between the parameter list and the return type rather than `=>`.

## Construct Signatures

**JavaScript functions can also be invoked with the `new` operator.**
TypeScript refers to these as _constructors_ because they usually create a new object.
You can write a construct signature by adding the `new` keyword in front of a call signature:

```ts
type SomeConstructor = {
  new (s: string): SomeObject;
};

function fn(ctor: SomeConstructor) {
  return new ctor("hello");
}
```

**Some objects, like JavaScript's `Date` object, can be called with or without new.**
You can combine call and construct signatures in the same type arbitrarily:

```ts
interface CallOrConstruct {
  new (s: string): Date;
  (n?: number): number;
}
```

## Generic Functions

_It's common to write a function where the types of the input relate to the type of the output, or where the types of two inputs are related in some way._
_Let's consider for a moment a function that returns the first element of an array:_

```ts
function firstElement(arr: any[]) {
  return arr[0];
}
```

_This function does its job, but unfortunately has the return type `any`._
_It'd be better if the function returned the type of the array element._

**In TypeScript, _generics_ are used when we want to describe a correspondence between two values.**
We do this by declaring a _type parameter_ in the function signature:

```ts
function firstElement<Type>(arr: Type[]): Type | undefined {
  return arr[0];
}
```

**By adding a type parameter `Type` to this function and using it in two places, we've created a link between the input of the function (the array) and the output (the return value).**
Now when we call it, a more specific type comes out:

```ts
// s is of type 'string'
const s = firstElement(["a", "b", "c"]);
// n is of type 'number'
const n = firstElement([1, 2, 3]);
// u is of type undefined
const u = firstElement([]);
```

### Inference

_Note that we didn't have to specify `Type` in this sample._
_The type was **inferred** - chosen automatically - by TypeScript._

_We can use multiple type parameters as well._
_For example, a standalone version of map would look like this:_

```ts
function map<Input, Output>(arr: Input[], func: (arg: Input) => Output): Output[] {
  return arr.map(func);
}

// Parameter 'n' is of type 'string'
// 'parsed' is of type 'number[]'
const parsed = map(["1", "2", "3"], (n) => parseInt(n));
```

Note that in this example, TypeScript could infer both the type of the `Input` type parameter (from the given `string` array), as well as the `Output` type parameter based on the return value of the function expression (`number`).

### Constraints

### Working with Constrained Values

### Specifying Type Arguments

### Guidelines for Writing Good Generic Functions

## Optional Parameters

### Optional Parameters in Callbacks

## Function Overloads

### Overload Signatures and the Implementation Signature

### Writing Good Overloads

### Declaring this in a Function

## Other Types to Know About

### void

### object

### unknown

### never

### Function

## Rest Parameters and Arguments

### Rest Parameters

### Rest Arguments

## Parameter Destructuring

## Assignability of Functions

### Return type void
