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

Functions in JavaScript often take a variable number of arguments.
_For example, the `toFixed` method of `number` takes an optional digit count:_

```ts
function f(n: number) {
  console.log(n.toFixed()); // 0 arguments
  console.log(n.toFixed(3)); // 1 argument
}
```

We can model this in TypeScript by **marking the parameter as optional with `?`**:

```ts
function f(x?: number) {
  // ...
}
f(); // OK
f(10); // OK
```

Although the parameter is specified as type `number`, the `x` parameter will actually have the type `number | undefined` because unspecified parameters in JavaScript get the value `undefined`.

You can also **provide a parameter _default_**:

```ts
function f(x = 10) {
  // ...
}
```

Now in the body of `f`, `x` will have type `number` because any `undefined` argument will be replaced with `10`.
Note that when a parameter is optional, callers can always pass `undefined`, as this simply simulates a "missing" argument:

```ts
declare function f(x?: number): void;
// cut
// All OK
f();
f(10);
f(undefined);
```

### Optional Parameters in Callbacks

Once you've learned about optional parameters and function type expressions, it's very easy to make the following mistakes when writing functions that invoke callbacks:

```ts
function myForEach(arr: any[], callback: (arg: any, index?: number) => void) {
  for (let i = 0; i < arr.length; i++) {
    callback(arr[i], i);
  }
}
```

What people usually intend when writing `index?` as an optional parameter is that they want both of these calls to be legal:

```ts
myForEach([1, 2, 3], (a) => console.log(a));
myForEach([1, 2, 3], (a, i) => console.log(a, i));
```

What this _actually_ means is that _callback_ might get invoked with one argument.
_In other words, the function definition says that the implementation might look like this:_

```ts
function myForEach(arr: any[], callback: (arg: any, index?: number) => void) {
  for (let i = 0; i < arr.length; i++) {
    // I don't feel like providing the index today
    callback(arr[i]);
  }
}
```

_In turn, TypeScript will enforce this meaning and issue errors that aren't really possible:_

```ts
myForEach([1, 2, 3], (a, i) => {
  console.log(i.toFixed());
  // Object is possibly 'undefined'.
});
```

_In JavaScript, if you call a function with more arguments than there are parameters, the extra arguments are simply ignored._
_TypeScript behaves the same way._
_Functions with fewer parameters (of the same types) can always take the place of functions with more parameters._

> **When writing a function type for a callback, never write an optional parameter unless you intend to call the function without passing that argument**

## Function Overloads

Some JavaScript functions can be called in a variety of argument counts and types.
_For example, you might write a function to produce a `Date` that takes either a timestamp (one argument) or a month/day/year specification (three arguments)._

In TypeScript, we can **specify a function that can be called in different ways by writing overload signatures**.
To do this, **write some number of function signatures (usually two or more), followed by the body of the function**:

```ts
function makeDate(timestamp: number): Date;
function makeDate(m: number, d: number, y: number): Date;
function makeDate(mOrTimestamp: number, d?: number, y?: number): Date {
  if (d !== undefined && y !== undefined) {
    return new Date(y, mOrTimestamp, d);
  } else {
    return new Date(mOrTimestamp);
  }
}
const d1 = makeDate(12345678);
const d2 = makeDate(5, 5, 5);
const d3 = makeDate(1, 3);
// No overload expects 2 arguments, but overloads do exist that expect either 1 or 3 arguments.
```

_In this example, we wrote two overloads: one accepting one argument, and another accepting three arguments._
_These first two signatures are called the overload signatures._

_Then, we wrote a function implementation with a compatible signature._
_Functions have an implementation signature, but this signature can't be called directly._
_Even though we wrote a function with two optional parameters after the required one, it can't be called with two parameters!_

### Overload Signatures and the Implementation Signature

_This is a common source of confusion._
_Often people will write code like this and not understand why there is an error:_

```ts
function fn(x: string): void;
function fn() {
  // ...
}
// Expected to be able to call with zero arguments
fn();
// Expected 1 arguments, but got 0.
```

Again, **the signature used to write the function body can't be "seen" from the outside.**

> **The signature of the implementation is not visible from the outside.**
> **When writing an overloaded function, you should always have two or more signatures above the implementation of the function.**

**The implementation signature must also be compatible with the overload signatures.**
_For example, these functions have errors because the implementation signature doesn't match the overloads in a correct way:_

```ts
function fn(x: boolean): void;
// Argument type isn't right
function fn(x: string): void;
// This overload signature is not compatible with its implementation signature.
function fn(x: boolean) {}
```

```ts
function fn(x: string): string;
// Return type isn't right
function fn(x: number): boolean;
This overload signature is not compatible with its implementation signature.
function fn(x: string | number) {
  return "oops";
}
```

### Writing Good Overloads

_Like generics, there are a few guidelines you should follow when using function overloads._
_Following these principles will make your function easier to call, easier to understand, and easier to implement._

_Let's consider a function that returns the length of a string or an array:_

```ts
function len(s: string): number;
function len(arr: any[]): number;
function len(x: any) {
  return x.length;
}
```

This function is fine; we can invoke it with strings or arrays.
However, we can't invoke it with a value that might be a `string` or an `array`, because TypeScript can only resolve a function call to a single overload:

```ts
len(""); // OK
len([0]); // OK
len(Math.random() > 0.5 ? "hello" : [0]);
// No overload matches this call.
//   Overload 1 of 2, '(s: string): number', gave the following error.
//     Argument of type 'number[] | "hello"' is not assignable to parameter of type 'string'.
//       Type 'number[]' is not assignable to type 'string'.
//   Overload 2 of 2, '(arr: any[]): number', gave the following error.
//     Argument of type 'number[] | "hello"' is not assignable to parameter of type 'any[]'.
//       Type 'string' is not assignable to type 'any[]'.
```

Because both overloads have the same argument count and same return type, we can instead write a non-overloaded version of the function:

```ts
function len(x: any[] | string) {
  return x.length;
}
```

This is much better!
Callers can invoke this with either sort of value, and as an added bonus, we don't have to figure out a correct implementation signature.

> **Always prefer parameters with union types instead of overloads when possible**

### Declaring `this` in a Function

_TypeScript will infer what the `this` should be in a function via code flow analysis, for example in the following:_

```ts
const user = {
  id: 123,
  admin: false,
  becomeAdmin: function () {
    this.admin = true;
  },
};
```

TypeScript understands that the function `user.becomeAdmin` has a corresponding this which is the outer object `user`.
_`this`, heh, can be enough for a lot of cases, but there are a lot of cases where you need more control over what object this represents._
**The JavaScript specification states that you cannot have a parameter called `this`, and so TypeScript uses that syntax space to let you declare the type for `this` in the function body.**

```ts
interface DB {
  filterUsers(filter: (this: User) => boolean): User[];
}

const db = getDB();
const admins = db.filterUsers(function (this: User) {
  return this.admin;
});
```

This pattern is common with callback-style APIs, where another object typically controls when your function is called.
Note that you need to use function and not arrow functions to get this behavior:

```ts
interface DB {
  filterUsers(filter: (this: User) => boolean): User[];
}

const db = getDB();
const admins = db.filterUsers(() => this.admin);
// The containing arrow function captures the global value of 'this'.
// Element implicitly has an 'any' type because type 'typeof globalThis' has no index signature.
```

## Other Types to Know About

There are some additional types you'll want to recognize that appear often when working with function types.
Like all types, you can use them everywhere, but these are especially relevant in the context of functions.

### void

**`void` represents the return value of functions which don't return a value.**
It's the inferred type any time a function doesn't have any return statements, or doesn't return any explicit value from those return statements:

```ts
// The inferred return type is void
function noop() {
  return;
}
```

**In JavaScript, a function that doesn't return any value will implicitly return the value `undefined`.**
**However, `void` and `undefined` are not the same thing in TypeScript.**
_There are further details at the end of this chapter._

> **`void` is not the same as `undefined`.**

### object

**The special type `object` refers to any value that isn't a primitive (`string`, `number`, `bigint`, `boolean`, `symbol`, `null`, or `undefined`).**
**This is different from the empty _object type_ `{ }`, and also different from the global type `Object`.**
It's very likely you will never use Object.

> **`object` is not `Object`. Always use `object`!**

Note that in JavaScript, function values are objects:
They have properties, have `Object.prototype` in their prototype chain, are `instanceof Object`, you can call `Object.keys` on them, and so on.
For this reason, **function types are considered to be `object`s in TypeScript.**

### unknown

**The `unknown` type represents _any_ value.**
**This is similar to the `any` type, but is safer because it's not legal to do anything with an `unknown` value**:

```ts
function f1(a: any) {
  a.b(); // OK
}
function f2(a: unknown) {
  a.b();
  // Object is of type 'unknown'.
}
```

_This is useful when describing function types because you can describe functions that accept any value without having `any` values in your function body._

_Conversely, you can describe a function that returns a value of unknown type:_

```ts
function safeParse(s: string): unknown {
  return JSON.parse(s);
}

// Need to be careful with 'obj'!
const obj = safeParse(someRandomString);
```

### never

Some functions _never_ return a value:

```ts
function fail(msg: string): never {
  throw new Error(msg);
}
```

**The `never` type represents values which are never observed.**
**In a return type, this means that the function throws an exception or terminates execution of the program.**

**`never` also appears when TypeScript determines there's nothing left in a union.**
<!-- icehe : 暂时还不能够完全理解 2021/10/19 -->

```ts
function fn(x: string | number) {
  if (typeof x === "string") {
    // do something
  } else if (typeof x === "number") {
    // do something else
  } else {
    x; // has type 'never'!
  }
}
```

### Function

**The global type `Function` describes properties like `bind`, `call`, `apply`, and others present on all function values in JavaScript.**
**It also has the special property that values of type `Function` can always be called; these calls return `any`:**
<!-- icehe : 暂时还不能够完全理解 2021/10/19 -->

```ts
function doSomething(f: Function) {
  f(1, 2, 3);
}
```

**This is an _untyped function call_ and is generally best avoided because of the unsafe `any` return type.**

**If you need to accept an arbitrary function but don't intend to call it, the type `() => void` is generally safer.**

## Rest Parameters and Arguments

### Rest Parameters

In addition to using optional parameters or overloads to make functions that can accept a variety of fixed argument counts, we can also **define functions that take an unbounded number of arguments using rest parameters.**

A rest parameter appears after all other parameters, and **uses the `...` syntax**:

```ts
function multiply(n: number, ...m: number[]) {
  return m.map((x) => n * x);
}
// 'a' gets value [10, 20, 30, 40]
const a = multiply(10, 1, 2, 3, 4);
```

In TypeScript, the type annotation on these parameters is implicitly `any[]` instead of `any`, and any type annotation given must be of the form `Array<T>` or `T[]`, or a tuple type (which we'll learn about later).

### Rest Arguments

Conversely, we can **provide a variable number of arguments from an array using the spread syntax.**
_For example, the push method of arrays takes any number of arguments:_

```ts
const arr1 = [1, 2, 3];
const arr2 = [4, 5, 6];
arr1.push(...arr2);
```

Note that in general, **TypeScript does not assume that arrays are immutable.**
_This can lead to some surprising behavior:_

```ts
// Inferred type is number[] -- "an array with zero or more numbers",
// not specifically two numbers
const args = [8, 5];
const angle = Math.atan2(...args);
// A spread argument must either have a tuple type or be passed to a rest parameter.
```

The best fix for this situation depends a bit on your code, but in general a `const` context is the most straightforward solution:

```ts
// Inferred as 2-length tuple
const args = [8, 5] as const;
// OK
const angle = Math.atan2(...args);
```

Using rest arguments may require turning on [downlevelIteration](https://www.typescriptlang.org/tsconfig#downlevelIteration) when targeting older runtimes.

## Parameter Destructuring

You can **use parameter destructuring to conveniently unpack objects provided as an argument into one or more local variables in the function body.**
_In JavaScript, it looks like this:_

```ts
function sum({ a, b, c }) {
  console.log(a + b + c);
}
sum({ a: 10, b: 3, c: 9 });
```

Background Reading: [Destructuring Assignment](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring_assignment)

**The type annotation for the object goes after the destructuring syntax**:

```ts
function sum({ a, b, c }: { a: number; b: number; c: number }) {
  console.log(a + b + c);
}
```

This can look a bit verbose, but you can use a named type here as well:

```ts
// Same as prior example
type ABC = { a: number; b: number; c: number };
function sum({ a, b, c }: ABC) {
  console.log(a + b + c);
}
```

## Assignability of Functions

### Return type void

**The `void` return type for functions can produce some unusual, but expected behavior.**

**Contextual typing with a return type of `void` does not force functions to not return something.**
**Another way to say this is a contextual function type with a `void` return type `(type vf = () => void)`, when implemented, can return any other value, but it will be ignored.**

_Thus, the following implementations of the `type () => void` are valid:_

```ts
type voidFunc = () => void;

const f1: voidFunc = () => {
  return true;
};

const f2: voidFunc = () => true;

const f3: voidFunc = function () {
  return true;
};
```

**And when the return value of one of these functions is assigned to another variable, it will retain the type of `void`:**

```ts
const v1 = f1();

const v2 = f2();

const v3 = f3();
```

_This behavior exists so that the following code is valid even though `Array.prototype.push` returns a number and the `Array.prototype.forEach` method expects a function with a return type of `void`._

```ts
const src = [1, 2, 3];
const dst = [0];

src.forEach((el) => dst.push(el));
```

There is one other special case to be aware of, when a literal function definition has a `void` return type, that function must not return anything.

```ts
function f2(): void {
  // @ts-expect-error
  return true;
}

const f3 = function (): void {
  // @ts-expect-error
  return true;
};
```

_For more on `void` please refer to these other documentation entries:_

- [v1 handbook](https://www.typescriptlang.org/docs/handbook/basic-types.html#void)
- [v2 handbook](https://www.typescriptlang.org/docs/handbook/2/functions.html#void)
- [FAQ - “Why are functions returning non-void assignable to function returning void?”](https://github.com/Microsoft/TypeScript/wiki/FAQ#why-are-functions-returning-non-void-assignable-to-function-returning-void)
