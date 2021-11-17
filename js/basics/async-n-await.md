# async & await

to simplify the syntax necessary to consume promise-based APIs

---

References

- [async function - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/async_function)
    - [async function expression - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/async_function)

## async funciton

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

Syntax

```js
async function [name]([param1[, param2[, ..., paramN]]]) {
  statements
}
```

-   Return value : **a `Promise`** which will be

    - **resolved with the value returned by the async function**, or
    - **rejected with an exception thrown** from, or uncaught within, the async function.

Simple example

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

### Description

- Async functions **can contain zero or more await expressions**.
- Await expressions make promise-returning functions behave as though they're synchronous by suspending execution until the returned promise is fulfilled or rejected.
- **The resolved value of the promise is treated as the return value of the `await` expression.**
- Use of `async` and `await` enables the use of ordinary `try` / `catch` blocks around asynchronous code.

Note :

-   **The `await` keyword is only valid inside async functions within regular JavaScript code.**

    If you use it outside of an async function's body, you will get a [`SyntaxError`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/SyntaxError).

-   `await` can be used on its own with [JavaScript modules](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules).

Note :

**The purpose of `async`/`await` is to simplify the syntax necessary to consume promise-based APIs.**
The behavior of `async`/`await` is similar to combining generators and promises.
