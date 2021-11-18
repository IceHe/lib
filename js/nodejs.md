# Node.js

A JavaScript runtime built on Chrome's V8 JavaScript engine

---

References

- [nodejs.org](https://nodejs.org/en/)
    - Documentation
        - [API reference documentation](https://nodejs.org/api/) ( latest )
        - [ES6 features](https://nodejs.org/en/docs/es6/)
        - [Guides](https://nodejs.org/en/docs/guides/)

## About

As an **asynchronous event-driven JavaScript runtime**, Node.js is designed to build scalable network applications.
_In the following "hello world" example, many connections can be handled concurrently._
Upon each connection, the callback is fired, but **if there is no work to be done, Node.js will sleep**.

_This is in contrast to today's more common concurrency model, in which OS threads are employed._
_Thread-based networking is relatively inefficient and very difficult to use._

Furthermore, users of Node.js are **free from worries of dead-locking the process, since there are no locks**.
**Almost no function in Node.js directly performs I/O, so the process never blocks except when the I/O is performed using synchronous methods of Node.js standard library.**
Because nothing blocks, scalable systems are very reasonable to develop in Node.js.

_If some of this language is unfamiliar, there is a full article on [Blocking vs. Non-Blocking](https://nodejs.org/en/docs/guides/blocking-vs-non-blocking/)._

---

_Node.js is similar in design to, and influenced by, systems like Ruby's [Event Machine](https://github.com/eventmachine/eventmachine) and Python's [Twisted](https://twistedmatrix.com/trachttps://twistedmatrix.com/trac//)._

Node.js takes the event model a bit further.
It **presents an event loop as a runtime construct instead of as a library**.
_In other systems, there is always a blocking call to start the event-loop._
_Typically, behavior is defined through callbacks at the beginning of a script, and at the end a server is started through a blocking call like `EventMachine::run()`._
In Node.js, there is no such start-the-event-loop call.

- **Node.js simply enters the event loop after executing the input script.**
- **Node.js exits the event loop when there are no more callbacks to perform.**

_This behavior is like browser JavaScript —— the event loop is hidden from the user._

**HTTP is a first-class citizen in Node.js, designed with streaming and low latency in mind.**
This makes Node.js well suited for the foundation of a web library or framework.

Node.js being designed without threads doesn't mean you can't take advantage of multiple cores in your environment.
Child processes can be spawned by using our `child_process.fork()` API, and are designed to be easy to communicate with.
Built upon that same interface is the `cluster` module, which allows you to share sockets between processes to enable load balancing over your cores.

---

## Differences between Node.js and Browser

Both the browser and Node.js use JavaScript as their programming language.

……

What changes is the ecosystem.

-   In the browser, most of the time what you are doing is interacting with the DOM, or other Web Platform APIs like Cookies.

    _And in the browser, we don't have all the nice APIs that Node.js provides through its modules, like the filesystem access functionality._

-   Those do not exist in Node.js, of course.

    You don't have the `document`, `window` and all the other objects that are provided by the browser.

    Another big difference is that in Node.js you control the environment.
    Unless you are building an open source application that anyone can deploy anywhere, you know which version of Node.js you will run the application on.
    Compared to the browser environment, where you don't get the luxury to choose what browser your visitors will use, this is very convenient.
