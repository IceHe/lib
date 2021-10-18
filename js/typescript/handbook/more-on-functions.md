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

## Call Signatures

## Construct Signatures

## Generic Functions

## Inference

## Constraints

## Working with Constrained Values

## Specifying Type Arguments

## Guidelines for Writing Good Generic Functions

## Optional Parameters

## Optional Parameters in Callbacks

## Function Overloads

## Overload Signatures and the Implementation Signature

## Writing Good Overloads

## Declaring this in a Function

## Other Types to Know About

## void

## object

## unknown

## never

## Function

## Rest Parameters and Arguments

## Rest Parameters

## Rest Arguments

## Parameter Destructuring

## Assignability of Functions

## Return type void
