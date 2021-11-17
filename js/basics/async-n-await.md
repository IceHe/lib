# async & await

---

References

- [async function - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/async_function)
    - [async function expression - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/async_function)

## async funciton

An async function is a function declared with the `async` keyword, and the `await` keyword is permitted within them.

**The `async` and `await` keywords enable asynchronous, promise-based behavior to be written in a cleaner style, avoiding the need to explicitly configure promise chains.**

### expression

_The `async function` keyword can be used to define async functions inside expressions._

Syntax

```js
async function [name]([param1[, param2[, ..., paramN]]]) {
  statements
}
```

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
