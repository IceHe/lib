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

# Get Started

## Read environment variables

**The `process` core module of Node.js provides the `env` property which hosts all the environment variables that were set at the moment the process was started.**

_The below code runs `app.js` and set `USER_ID` and `USER_KEY`._

```bash
USER_ID=239482 USER_KEY=foobar node app.js
```

> Note: `process` does not require a "require", it's automatically available.

_Here is an example that accesses the `USER_ID` and `USER_KEY` environment variables, which we set in above code._

```bash
process.env.USER_ID // "239482"
process.env.USER_KEY // "foobar"
```

_In the same way you can access any custom environment variable you set._

If you have multiple environment variables in your node project, you can also **create an `.env` file in the root directory of your project**, and then **use the [dotenv](https://www.npmjs.com/package/dotenv) package to load them during runtime**.

```bash
# .env file
USER_ID="239482"
USER_KEY="foobar"
NODE_ENV="development"
```

```js
require('dotenv').config();

process.env.USER_ID // "239482"
process.env.USER_KEY // "foobar"
process.env.NODE_ENV // "development"
```

> You can also run your js file with `node -r dotenv/config index.js` command if you don't want to import the package in your code.

## Command Line

### Accept arguments

_For example :_

```bash
$ node app.js joe
# or
$ node app.js name=joe
```

The way you retrieve it is **using the `process` object** built into Node.js.

It exposes an **`argv` property**, which is **an array that contains all the command line invocation arguments**.

- The first element is the full path of the `node` command.
- The second element is the full path of the file being executed.
- All the **additional arguments are present from the third position going forward**.

_You can iterate over all the arguments ( including the node path and the file path ) using a loop :_

```js
process.argv.forEach((val, index) => {
  console.log(`${index}: ${val}`)
})
```

_You can get only the additional arguments by creating a new array that excludes the first 2 params:_

```js
const args = process.argv.slice(2)
```

_If you have one argument without an index name, like this :_

```bash
node app.js joe
```

_you can access it using_

```js
const args = process.argv.slice(2)
args[0]
```

_In this case :_

```bash
node app.js name=joe
```

**`args[0]` is `name=joe`, and you need to parse it.**

---

The best way to do so is by using the [`minimist`](https://www.npmjs.com/package/minimist) library, which helps dealing with arguments:

```js
const args = require('minimist')(process.argv.slice(2))
args['name'] //joe
```

_Install the required `minimist` package using `npm`._

```bash
npm install minimist
```

_This time you need to use double dashes before each argument name:_

```bash
node app.js --name=joe
```

### Output

#### Basic output using the console module

Node.js provides a [`console` module](https://nodejs.org/api/console.html) which provides tons of very useful ways to interact with the command line.
It is basically the same as the `console` object you find in the browser.

The most basic and most used method is `console.log()`, which prints the string you pass to it to the console.
If you pass an object, it will render it as a string.

_You can pass multiple variables to console.log, for example :_

```js
const x = 'x'
const y = 'y'
console.log(x, y)
```

_and Node.js will print both._

We can also format pretty phrases by passing variables and a format specifier.
_For example :_

```js
console.log('My %s has %d years', 'cat', 2)
```

- `%s` format a variable as a string
- `%d` format a variable as a number
- `%i` format a variable as its integer part only
- `%o` format a variable as an object

**Clear the console**

`console.clear()` clears the console ( the behavior might depend on the console used ) .

#### Counting elements

`console.count()` is a handy method.

……

What happens is that `console.count()` will **count the number of times a string is printed, and print the count next to it**: ……

**Reset counting**

The `console.countReset()` method resets counter used with `console.count()`.

……

#### Print the stack trace

There might be cases where it's useful to print the call stack trace of a function, maybe to answer the question how did you reach that part of the code?

You can do so using `console.trace()` :

```js
const function2 = () => console.trace()
const function1 = () => function2()
function1()
```

This will print the stack trace.
_This is what's printed if we try this in the Node.js REPL :_

```bash
Trace
    at function2 (repl:1:33)
    at function1 (repl:1:25)
    at repl:1:1
    at ContextifyScript.Script.runInThisContext (vm.js:44:33)
    at REPLServer.defaultEval (repl.js:239:29)
    at bound (domain.js:301:14)
    at REPLServer.runBound [as eval] (domain.js:314:12)
    at REPLServer.onLine (repl.js:440:10)
    at emitOne (events.js:120:20)
    at REPLServer.emit (events.js:210:7)
```

#### Calculate the time spent

You can **easily calculate how much time a function takes to run, using `time()` and `timeEnd()`.**

```js
const doSomething = () => console.log('test')
const measureDoingSomething = () => {
  console.time('doSomething()')
  //do something, and measure the time it takes
  doSomething()
  console.timeEnd('doSomething()')
}
measureDoingSomething()
```

#### Others

**stdout and stderr**

As we saw

-   console.log is great for printing messages in the Console.
    This is what's called the standard output, or `stdout`.

-   console.error prints to the `stderr` stream.

    It will not appear in the console, but it will appear in the error log.

**Color the output**

You can color the output of your text in the console by using [escape sequences](https://gist.github.com/iamnewton/8754917).
An escape sequence is a set of characters that identifies a color.

```js
console.log('\x1b[33m%s\x1b[0m', 'hi!')
```

_You can try that in the Node.js REPL, and it will print "hi!" in yellow._

However, this is the low-level way to do this.
The simplest way to go about coloring the console output is by using a library.
[Chalk](https://github.com/chalk/chalk) is such a library, and in addition to coloring it also helps with other styling facilities, like making text bold, italic or underlined.

_You install it with `npm install chalk`, then you can use it:_

```js
const chalk = require('chalk')
console.log(chalk.yellow('hi!'))
```

_Using `chalk.yellow` is much more convenient than trying to remember the escape codes, and the code is much more readable._

**Create a progress bar**

[Progress](https://github.com/chalk/chalk) is an awesome package to create a progress bar in the console.
Install it using `npm install progress`

_This snippet creates a 10-step progress bar, and every 100ms one step is completed._
_When the bar completes we clear the interval :_

```js
const ProgressBar = require('progress')

const bar = new ProgressBar(':bar', { total: 10 })
const timer = setInterval(() => {
  bar.tick()
  if (bar.complete) {
    clearInterval(timer)
  }
}, 100)
```

### Accept input

Node.js since version 7 provides the [`readline` module](https://nodejs.org/api/readline.html) to perform exactly this :
**get input from a readable stream such as the `process.stdin` stream**, which during the execution of a Node.js program is the terminal input, one line at a time.

```js
const readline = require('readline').createInterface({
  input: process.stdin,
  output: process.stdout
})

readline.question(`What's your name?`, name => {
  console.log(`Hi ${name}!`)
  readline.close()
})
```

_This piece of code asks the username, and once the text is entered and the user presses enter, we send a greeting._

The **`question()` method shows the first parameter ( a question ) and waits for the user input**.
It calls the callback function once enter is pressed.
In this callback function, we close the readline interface.

……

The simplest way is to use the [`readline-sync` package](https://www.npmjs.com/package/readline-sync) which is very similar in terms of the API and handles this out of the box.

**A more complete and abstract solution is provided by the [Inquirer.js package](https://github.com/SBoudrias/Inquirer.js).**

```js
const inquirer = require('inquirer')

var questions = [
  {
    type: 'input',
    name: 'name',
    message: "What's your name?"
  }
]

inquirer.prompt(questions).then(answers => {
  console.log(`Hi ${answers['name']}!`)
})
```

Inquirer.js lets you do many things like **asking multiple choices**, having **radio buttons**, **confirmations**, and more.

It's worth knowing all the alternatives, especially the built-in ones provided by Node.js, but if you plan to take CLI input to the next level, Inquirer.js is an optimal choice.

## Expose functionality from file using exports

Node.js has a built-in module system.
A Node.js file can import functionality exposed by other Node.js files.

When you want to **import something you use**

```js
const library = require('./library')
```

**to import the functionality exposed in the `library.js` file that resides in the current file folder.**

In this file, functionality must be exposed before it can be imported by other files.
Any other object or variable defined in the file by default is private and not exposed to the outer world.

This is what the module.exports API offered by the [`module` system](https://nodejs.org/api/modules.html) allows us to do.

**When you assign an object or a function as a new exports property, that is the thing that's being exposed**, and as such, it can be imported in other parts of your app, or in other apps as well.

You can do so in 2 ways.

1.  The first is to **assign an object to `module.exports`**, which is an object provided out of the box by the module system, and this will **make your file export just that object**:

    ```js
    // car.js
    const car = {
    brand: 'Ford',
    model: 'Fiesta'
    }

    module.exports = car
    ```

    ```js
    // index.js
    const car = require('./car')
    ```

2.  The second way is to **add the exported object as a property of `exports`**.
    This way **allows you to export multiple objects, functions or data**:

    ```js
    const car = {
    brand: 'Ford',
    model: 'Fiesta'
    }

    exports.car = car
    ```

    or directly

    ```js
    exports.car = {
    brand: 'Ford',
    model: 'Fiesta'
    }
    ```

    And in the other file, you'll use it by referencing a property of your import:

    ```js
    const items = require('./items')
    const car = items.car
    ```

    or

    ```js
    const car = require('./items').car
    ```

    or you can use a destructuring assignment:

    ```js
    const { car } = require('./items')
    ```

What's the difference between `module.exports` and `exports`?

- **`module.exports` exposes the object it points to.**
- **`exports` exposes the properties of the object it points to.**

## npm package manager

### Introduction

`npm` is the standard package manager for Node.js.

……

It started as a way to download and manage dependencies of Node.js packages, but it has since become a tool used also in frontend JavaScript.

_There are many things that npm does._

> `Yarn` and `pnpm` are alternatives to npm cli. _You can check them out as well._

### Downloads

`npm` manages downloads of dependencies of your project.

#### Installing all dependencies

If a project has a `package.json` file, by running

```bash
npm install
```

it will install everything the project needs, in the `node_modules` folder, _creating it if it's not existing already._

#### Installing a single package

```bash
npm install <package-name>
```

……

_Often you'll see more flags added to this command:_

- `--save-dev` installs and adds the entry to the `package.json` file _devDependencies_
- `--no-save` installs but **does not** add the entry to the `package.json` file _dependencies_
- `--save-optional` installs and adds the entry to the `package.json` file _optionalDependencies_
- `--no-optional` will **prevent** optional dependencies from being installed

_Shorthands of the flags can also be used:_

- `-S`: `--save`
- `-D`: `--save-dev`
- `-O`: `--save-optional`

**The difference between `devDependencies` and `dependencies` is that the former contains development tools, like a testing library, while the latter is bundled with the app in production.**

_As for the `optionalDependencies` the difference is that build failure of the dependency will not cause installation to fail._
_But it is your program's responsibility to handle the lack of the dependency._
_Read more about [optional dependencies](https://docs.npmjs.com/cli/v7/configuring-npm/package-json#optionaldependencies)._

#### Updating packages

```bash
npm update
```

**`npm` will check all packages for a newer version that satisfies your versioning constraints.**

_You can specify a single package to update as well:_

```bash
npm update <package-name>
```

### Versioning

In addition to plain downloads, npm also manages versioning, so you can specify any specific version of a package, or require a version higher or lower than what you need.

Many times you'll find that a library is only compatible with a major release of another library.

Or a bug in the latest release of a lib, still unfixed, is causing an issue.

Specifying an explicit version of a library also helps to keep everyone on the same exact version of a package, so that the whole team runs the same version until the package.json file is updated.

In all those cases, versioning helps a lot, and npm follows the semantic versioning (semver) standard.
