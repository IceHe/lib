# Event Loop

JavaScript has a concurrency model based on an event loop

---

References

- [Concurrency model and the event loop - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript/EventLoop)
- [The Node.js Event Loop, Timers, and process.nextTick() - Node Docs](https://nodejs.org/en/docs/guides/event-loop-timers-and-nexttick/#what-is-the-event-loop)

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

### "Run-to-completion"

Each message is processed completely before any other message is processed.

This offers some nice properties when reasoning about<!-- 理解 --> your program, including the fact that **whenever a function runs, it cannot be pre-empted and will run entirely before any other code runs** ( and can modify data the function manipulates ) .

_This differs from C, for instance, where if a function runs in a thread, it may be stopped at any point by the runtime system to run some other code in another thread._

**A downside<!-- 负面 --> of this model is that if a message takes too long to complete, the web application is unable to process user interactions like click or scroll.**
The browser mitigates<!-- 使减轻 --> this with the "a script is taking too long to run" dialog.
A good practice to follow is to make message processing short and if possible cut down one message into several messages.

### Adding messages

In web browsers, messages are added anytime an event occurs and there is an event listener attached to it.
If there is no listener, the event is lost.
So a click on an element with a click event handler will add a message —— likewise with any other event.

The function `setTimeout` is called with 2 arguments: a message to add to the queue, and a time value (optional; defaults to 0).
The time value represents the (minimum) delay after which the message will actually be pushed into the queue.
If there is no other message in the queue, and the stack is empty, the message is processed right after the delay.
However, if there are messages, the `setTimeout` message will have to wait for other messages to be processed.
For this reason, the second argument indicates a minimum time —— not a guaranteed time.

_Here is an example that demonstrates this concept ( `setTimeout` does not run immediately after its timer expires ) :_

```js
const s = new Date().getSeconds();

setTimeout(function() {
  // prints out "2", meaning that the callback is not called immediately after 500 milliseconds.
  console.log("Ran after " + (new Date().getSeconds() - s) + " seconds");
}, 500)

while (true) {
  if (new Date().getSeconds() - s >= 2) {
    console.log("Good, looped for 2 seconds")
    break;
  }
}
```

### Zero delays

Zero delay doesn't actually mean the call back will fire-off after zero milliseconds.
Calling `setTimeout` with a delay of 0 (zero) milliseconds doesn't execute the callback function after the given interval.

**The execution depends on the number of waiting tasks in the queue.**
In the example below, the message `'this is just a message'` will be written to the console before the message in the callback gets processed, because the delay is the minimum time required for the runtime to process the request ( not a guaranteed time ) .

**Basically, the `setTimeout` needs to wait for all the code for queued messages to complete** even though you specified a particular time limit for your `setTimeout`.

```js
(function() {

  console.log('this is the start');

  setTimeout(function cb() {
    console.log('Callback 1: this is a msg from call back');
  }); // has a default time value of 0

  console.log('this is just a message');

  setTimeout(function cb1() {
    console.log('Callback 2: this is a msg from call back');
  }, 0);

  console.log('this is the end');

})();

// "this is the start"
// "this is just a message"
// "this is the end"
// "Callback 1: this is a msg from call back"
// "Callback 2: this is a msg from call back"
```

### Several runtimes communicating together

A web worker or a cross-origin `iframe` has its own stack, heap, and message queue.
**Two distinct runtimes can only communicate through sending messages via the [`postMessage`](https://developer.mozilla.org/en-US/docs/Web/API/Window/postMessage) method.**
This method adds a message to the other runtime if the latter listens to message events.

## Never blocking

A very interesting **property of the event loop model is that JavaScript, unlike a lot of other languages, <u>never blocks</u>**.
Handling I/O is typically performed via events and callbacks, so when the application is waiting for an [IndexedDB](https://developer.mozilla.org/en-US/docs/Web/API/IndexedDB_API) query to return or an [XHR](https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest) request to return, it can still process other things like user input.

_Legacy exceptions exist like `alert` or synchronous XHR, but it is considered a good practice to avoid them._
Beware: [exceptions to the exception do exist](https://stackoverflow.com/questions/2734025/is-javascript-guaranteed-to-be-single-threaded/2734311#2734311) ( but are usually implementation bugs, rather than anything else ) .

_icehe : 最后这一段没看懂, 以后再回顾 2021/11/17_

## Node.js Event Loop

Node.js Event Loop, Timers and process.nextTick()

---

### What is?

The event loop is what **allows Node.js to perform non-blocking I/O operations**
—— **despite the fact that JavaScript is single-threaded**
—— **by offloading operations to the system kernel whenever possible**.

Since most modern kernels are multi-threaded, they can handle multiple operations executing in the background.
When one of these operations completes, the kernel tells Node.js so that the **appropriate callback may be added to the poll queue to eventually be executed**.

### Explained

When Node.js starts, it initializes the event loop, processes the provided input script (or drops into the REPL, which is not covered in this document) which may make async API calls, schedule timers, or call `process.nextTick()`, then begins processing the event loop.

The following diagram shows a simplified overview of the event loop's order of operations.

```txt
   ┌───────────────────────────┐
┌─>│           timers          │
│  └─────────────┬─────────────┘
│  ┌─────────────┴─────────────┐
│  │     pending callbacks     │
│  └─────────────┬─────────────┘
│  ┌─────────────┴─────────────┐
│  │       idle, prepare       │
│  └─────────────┬─────────────┘      ┌───────────────┐
│  ┌─────────────┴─────────────┐      │   incoming:   │
│  │           poll            │<─────┤  connections, │
│  └─────────────┬─────────────┘      │   data, etc.  │
│  ┌─────────────┴─────────────┐      └───────────────┘
│  │           check           │
│  └─────────────┬─────────────┘
│  ┌─────────────┴─────────────┐
└──┤      close callbacks      │
   └───────────────────────────┘
```

> Each box will be referred to as a "phase" of the event loop.

**Each phase has a FIFO queue of callbacks to execute.**
While each phase is special in its own way, generally, **when the event loop enters a given phase, it will perform any operations specific to that phase, then execute callbacks in that phase's queue until the queue has been exhausted or the maximum number of callbacks has executed**.
**When the queue has been exhausted or the callback limit is reached, the event loop will move to the next phase, and so on**.

Since any of these operations may schedule more operations and new events processed in the **poll** phase are queued by the kernel, poll events can be queued while polling events are being processed.
As a result, long running callbacks can allow the poll phase to run much longer than a timer's threshold.

<!-- icehe : 上面这段话要表达什么, 暂时没看懂 2021/11/18 -->

……
