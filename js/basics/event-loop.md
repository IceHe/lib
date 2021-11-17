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

1. _When calling `bar`, a first frame is created containing references to `bar`'s arguments and local variables._
2. _When `bar` calls `foo`, a second frame is created and pushed on top of the first one, containing references to `foo`'s arguments and local variables._
3. _When `foo` returns, the top frame element is popped out of the stack (leaving only `bar`'s call frame)._
4. _When `bar` returns, the stack is empty._

Note that the arguments and local variables may continue to exist, as they are stored outside the stack — so they can be accessed by any [nested functions](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Functions#nested_functions_and_closures) long after their outer function has returned.

### Heap

Objects are allocated in a heap which is just a name to denote a large ( mostly unstructured ) region of memory.

### Queue

**A JavaScript runtime uses a message queue, which is a list of messages to be processed.**
Each message has an associated function which gets called in order to handle the message.

**At some point during the event loop, the runtime starts handling the messages on the queue, starting with the oldest one.**
To do so, the message is removed from the queue and its corresponding function is called with the message as an input parameter.
As always, calling a function creates a new stack frame for that function's use.

**The processing of functions continues until the stack is once again empty.**
Then, the event loop will process the next message in the queue ( if there is one ).

## Event Loop

The **event loop** got its name because of how it's usually implemented, which usually resembles:

```js
while (queue.waitForMessage()) {
  queue.processNextMessage()
}
```

`queue.waitForMessage()` waits synchronously for a message to arrive ( if one is not already available and waiting to be handled ) .
