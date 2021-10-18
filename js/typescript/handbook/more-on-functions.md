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

_We've written some generic functions that can work on `any` kind of value._
_Sometimes we want to relate two values, but can only operate on a certain subset of values._
_In this case, we can use a constraint to limit the kinds of types that a type parameter can accept._

_Let's write a function that returns the longer of two values._
_To do this, we need a `length` property that's a `number`._
We **constrain the type parameter to that type by writing an `extends` clause**:

```ts
function longest<Type extends { length: number }>(a: Type, b: Type) {
  if (a.length >= b.length) {
    return a;
  } else {
    return b;
  }
}

// longerArray is of type 'number[]'
const longerArray = longest([1, 2], [1, 2, 3]);
// longerString is of type 'alice' | 'bob'
const longerString = longest("alice", "bob");
// Error! Numbers don't have a 'length' property
const notOK = longest(10, 100);
// Argument of type 'number' is not assignable to parameter of type '{ length: number; }'.
```

_There are few interesting things to note in this example._
_We allowed TypeScript to infer the return type of `longest`._
**Return type inference also works on generic functions.**

Because we constrained `Type` to `{ length: number }`, we were allowed to access the `.length` property of the `a` and `b` parameters.
Without the type constraint, we wouldn't be able to access those properties because the values might have been some other type without a length property.

_The types of `longerArray` and `longerString` were inferred based on the arguments._
_Remember, generics are all about relating two or more values with the same type!_

_Finally, just as we'd like, the call to `longest(10, 100)` is rejected because the number type doesn't have a `.length` property._

### _Working with Constrained Values_

_Here's a common error when working with generic constraints:_

```ts
function minimumLength<Type extends { length: number }>(
  obj: Type,
  minimum: number
): Type {
  if (obj.length >= minimum) {
    return obj;
  } else {
    return { length: minimum };
    // Type '{ length: number; }' is not assignable to type 'Type'.
    //   '{ length: number; }' is assignable to the constraint of type 'Type', but 'Type' could be instantiated with a different subtype of constraint '{ length: number; }'.
  }
}
```

_It might look like this function is OK - `Type` is constrained to `{ length: number }`, and the function either returns `Type` or a value matching that constraint._
_The problem is that the function promises to return the same kind of object as was passed in, not just some object matching the constraint._
_If this code were legal, you could write code that definitely wouldn't work:_

```ts
// 'arr' gets value { length: 6 }
const arr = minimumLength([1, 2, 3], 6);
// and crashes here because arrays have
// a 'slice' method, but not the returned object!
console.log(arr.slice(0));
```

### _Specifying Type Arguments_

TypeScript can usually infer the intended type arguments in a generic call, but not always.
_For example, let's say you wrote a function to combine two arrays:_

```ts
function combine<Type>(arr1: Type[], arr2: Type[]): Type[] {
  return arr1.concat(arr2);
}
```

_Normally it would be an error to call this function with mismatched arrays:_

```ts
const arr = combine([1, 2, 3], ["hello"]);
// Type 'string' is not assignable to type 'number'.
```

_If you intended to do this, however, you could manually specify Type:_

```ts
const arr = combine<string | number>([1, 2, 3], ["hello"]);
```

### Guidelines for Writing Good Generic Functions

Writing generic functions is fun, and it can be easy to get carried away with <!-- 被…冲昏头脑 --> type parameters.
Having too many type parameters or using constraints where they aren't needed can make inference less successful, frustrating callers of your function.

#### Push Type Parameters Down

_Here are two ways of writing a function that appear similar:_

```ts
function firstElement1<Type>(arr: Type[]) {
  return arr[0];
}

function firstElement2<Type extends any[]>(arr: Type) {
  return arr[0];
}

// a: number (good)
const a = firstElement1([1, 2, 3]);
// b: any (bad)
const b = firstElement2([1, 2, 3]);
```

**These might seem identical at first glance, but `firstElement1` is a much better way to write this function.**
Its inferred return type is `Type`, but `firstElement2`'s inferred return type is `any` because TypeScript has to resolve the `arr[0]` expression using the constraint type, rather than "waiting" to resolve the element during a call.

> **Rule**: When possible, use the type parameter itself rather than constraining it

#### Use Fewer Type Parameters

_Here's another pair of similar functions:_

```ts
function filter1<Type>(arr: Type[], func: (arg: Type) => boolean): Type[] {
  return arr.filter(func);
}

function filter2<Type, Func extends (arg: Type) => boolean>(
  arr: Type[],
  func: Func
): Type[] {
  return arr.filter(func);
}
```

We've created a type parameter `Func` that doesn't relate two values.
That's always a red flag<!-- 这总是一个危险信号 -->, because it means callers wanting to specify type arguments have to manually specify an extra type argument for no reason.
**`Func` doesn't do anything but make the function harder to read and reason about!**

> **Rule**: Always use as few type parameters as possible

#### Type Parameters Should Appear Twice

_Sometimes we forget that a function might not need to be generic:_

```ts
function greet<Str extends string>(s: Str) {
  console.log("Hello, " + s);
}

greet("world");
```

_We could just as easily have written a simpler version:_

```ts
function greet(s: string) {
  console.log("Hello, " + s);
}
```

Remember, type parameters are for relating the types of multiple values.
**If a type parameter is only used once in the function signature, it's not relating anything.**

> **Rule**: If a type parameter only appears in one location, strongly reconsider if you actually need it

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
