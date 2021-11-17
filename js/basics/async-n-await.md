# async & await

to simplify the syntax necessary to consume promise-based APIs

---

References

- [async function - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/async_function)
    - [async function expression - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/async_function)

## async function

### What is it

An async function is a function declared with the `async` keyword, and the `await` keyword is permitted within them.

**The `async` and `await` keywords enable asynchronous, promise-based behavior to be written in a cleaner style, avoiding the need to explicitly configure promise chains.**

```js
function resolveAfter2Seconds() {
  return new Promise(resolve => {
    setTimeout(() => {
      resolve('resolved');
    }, 2000);
  });
}

async function asyncCall() {
  console.log('calling');
  const result = await resolveAfter2Seconds();
  console.log(result);
  // expected output: "resolved"
}

asyncCall();
```

_Output_

```bash
> "calling"
> "resolved"
```

### Syntax

```js
async function [name]([param1[, param2[, ..., paramN]]]) {
  statements
}
```

-   Return value : **a `Promise`** which will be

    - **resolved with the value returned by the async function**, or
    - **rejected with an exception thrown** from, or uncaught within, the async function.

### Example

```js
function resolveAfter2Seconds(x) {
return new Promise(resolve => {
  setTimeout(() => {
  resolve(x);
  }, 2000);
});
};

const add = async function(x) { // async function expression assigned to a variable
  let a = await resolveAfter2Seconds(20);
  let b = await resolveAfter2Seconds(30);
  return x + a + b;
};

add(10).then(v => {
  console.log(v);  // prints 60 after 4 seconds.
});

(async function(x) { // async function expression used as an IIFE
  let p_a = resolveAfter2Seconds(20);
  let p_b = resolveAfter2Seconds(30);
  return x + await p_a + await p_b;
})(10).then(v => {
  console.log(v);  // prints 60 after 2 seconds.
});
```

## Description

### Basics

- **Async functions can contain zero or more await expressions**.
- **Await expressions make promise-returning functions behave as though they're synchronous by suspending execution until the returned promise is fulfilled or rejected**.
- **The resolved value of the promise is treated as the return value of the `await` expression.**
- Use of `async` and `await` enables the use of ordinary `try` / `catch` blocks around asynchronous code.

Note :

-   The `await` keyword is only valid inside async functions within regular JavaScript code.
    If you use it outside of an async function's body, you will get a [`SyntaxError`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/SyntaxError).
-   `await` can be used on its own with [JavaScript modules](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules).

Note :

- **The purpose of `async`/`await` is to simplify the syntax necessary to consume promise-based APIs.**
- The behavior of `async`/`await` is similar to combining generators and promises.

### Return Value

- **Async functions always return a promise.**
- **If the return value of an async function is not explicitly a promise, it will be implicitly wrapped in a promise.**

_For example, the following:_

```js
async function foo() {
   return 1
}
```

… is similar to:

```js
function foo() {
   return Promise.resolve(1)
}
```

_Note :_

_Even though the return value of an async function behaves as if it's wrapped in a `Promise.resolve`, they are not equivalent._

_An async function will return a different reference, whereas Promise.resolve returns the same reference if the given value is a promise._

_It can be a problem when you want to check the equality of a promise and a return value of an async function._

```js
const p = new Promise((res, rej) => {
  res(1);
})

async function asyncReturn() {
  return p;
}

function basicReturn() {
  return Promise.resolve(p);
}

console.log(p === basicReturn()); // true
console.log(p === asyncReturn()); // false
```

The body of an async function can be thought of as being split by zero or more await expressions.
**Top-level code, up to<!-- 直到 --> and including the first await expression (if there is one), is run synchronously.**
In this way, **an async function without an await expression will run synchronously**.
If there is an await expression inside the function body, however, the async function will always complete asynchronously.

<!-- icehe : 这段在明白之前, 不太好理解… 2021/11/17  -->

_For example :_

```js
async function foo() {
   await 1
}
```

_… is equivalent to:_

```js
function foo() {
   return Promise.resolve(1).then(() => undefined)
}
```

**Code after each await expression can be thought of as existing in a `.then` callback.**
In this way a promise chain is progressively constructed with each reentrant step through the function.
The return value forms the final link in the chain.

_In the following example, we successively `await` two promises._
_Progress moves through function `foo` in three stages._

1.  The first line of the body of function `foo` is executed synchronously, with the `await` expression configured with the pending promise.

    Progress through `foo` is then suspended and control is yielded back to the function that called foo.

2.  Some time later, when the first promise has either been fulfilled or rejected, control moves back into foo.

    The result of the first promise fulfillment (if it was not rejected) is returned from the await expression.
    Here 1 is assigned to result1.
    Progress continues, and the second await expression is evaluated.
    Again, progress through foo is suspended and control is yielded.

3.  Some time later, when the second promise has either been fulfilled or rejected, control re-enters foo.

    The result of the second promise resolution is returned from the second await expression.
    Here 2 is assigned to result2.
    Control moves to the return expression (if any).
    The default return value of undefined is returned as the resolution value of the current promise.
