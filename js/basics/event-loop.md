# event loop

JavaScript has a concurrency model based on an event loop

---

References

- [Concurrency model and the event loop - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/EventLoop)

**JavaScript has a concurrency model based on an event loop**, which is responsible for executing the code, collecting and processing events, and executing queued sub-tasks.

_This model is quite different from models in other languages like C and Java._

## Runtime Concepts

The following sections explain a theoretical model.
Modern JavaScript engines implement and heavily optimize the described semantics.

### Visual representation**

![javascript-runtime-environment-example.svg](_image/javascript-runtime-environment-example.svg)

### Stack

**Function calls form a stack of _frames_.**

```js
function foo(b) {
  let a = 10
  return a + b + 11
}

function bar(x) {
  let y = 3
  return foo(x * y)
}

const baz = bar(7) // assigns 42 to baz
```

Order of operations:

1. When calling bar, a first frame is created containing references to bar's arguments and local variables.
2. When bar calls foo, a second frame is created and pushed on top of the first one, containing references to foo's arguments and local variables.
3. When foo returns, the top frame element is popped out of the stack (leaving only bar's call frame).
4. When bar returns, the stack is empty.

Note that the arguments and local variables may continue to exist, as they are stored outside the stack — so they can be accessed by any nested functions long after their outer function has returned.
