# Promise

The `Promise` object represents the eventual completion (or failure) of an asynchronous operation and its resulting value.

---

References

- [Promise - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise)
- [Using Promises - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Using_promises)
- [An Introduction to Understanding Javascript Promises - Medium](https://medium.com/@PangaraWorld/an-introduction-to-understanding-javascript-promises-37eff85b2b08)

## Description

### Basics

**A `Promise` is a proxy for a value not necessarily known when the promise is created.**
It allows you to **associate handlers with an asynchronous action's eventual success value or failure reason**

_This lets asynchronous methods return values like synchronous methods:_
instead of immediately returning the final value, the asynchronous method returns a promise to supply the value at some point in the future.

A Promise is in one of these states:

- `unsettled`
    - **`pending`**: **initial state**, neither fulfilled nor rejected.
- `settled`
    - **`fulfilled`**: meaning that the operation was **completed successfully**.
    - **`rejected`**: meaning that the operation **failed**.

**A pending promise can either be _fulfilled_ with a value or _rejected_ with a reason (error).**
**When either of these options happens, the associated handlers queued up by a promise's then method are called.**

If the promise has already been fulfilled or rejected when a corresponding handler is attached, the handler will be called, so there is no race condition between an asynchronous operation completing and its handlers being attached.

_As the `Promise.prototype.then()` and `Promise.prototype.catch()` methods return promises, they can be chained._

![promises.png](_image/promises.png)

> Note: _Several other languages have mechanisms for lazy evaluation and deferring a computation, which they also call "promises", e.g. Scheme ( and Future in Java ) ._
>
> **Promises in JavaScript represent processes that are already happening, which can be chained with callback functions.**
>
> If you are looking to lazily evaluate an expression, consider using a function with no arguments e.g. `f = () => expression` to create the lazily-evaluated expression, and `f()` to evaluate the expression immediately.

---

Note:

**A promise is said to be `settled` if it is either `fulfilled` or `rejected`, but not `pending` _( `unsettled`? )_ .**

You will also hear **the term `resolved` used with promises — this means that the promise is `settled` or `"locked-in"` to match the state of another promise.**
[States and fates](https://github.com/domenic/promises-unwrapping/blob/master/docs/states-and-fates.md) contain more details about promise terminology.

<!-- icehe: resolved 和 unresolved 概念没搞懂. -->

### Chained Promises

The methods

- `promise.then()`,
- `promise.catch()`, and
- `promise.finally()`

are used to associate further action with a promise that becomes settled.

---

The `.then()` method takes up to two arguments;

- the **first** argument is a **callback** function for the **resolved** case of the promise, and
- the **second** argument is a **callback** function for the **rejected** case.

**Each `.then()` returns a newly generated promise object**, which can optionally be used for chaining; for example:

```js
const myPromise = new Promise((resolve, reject) => {
  setTimeout(() => {
    resolve('foo');
  }, 300);
});

myPromise
  .then(handleResolvedA, handleRejectedA)
  .then(handleResolvedB, handleRejectedB)
  .then(handleResolvedC, handleRejectedC);
```

Processing continues to the next link of the chain even when a `.then()` lacks a callback function that returns a Promise object.
Therefore, **a chain can safely omit every rejection callback function until the final `.catch()` .**

Handling a rejected promise in each `.then()` has consequences further down the promise chain.
Sometimes there is no choice, because an error must be handled immediately.
In such cases we must throw an error of some type to maintain error state down the chain.
On the other hand, in the absence of an immediate need, it is simpler to leave out error handling until a final `.catch()` statement.
A `.catch()` is really just a `.then()` without a slot for a callback function for the case when the promise is resolved. <!-- icehe : 最后这句没看懂 2021/11/16 -->
