# React

A JavaScript library for building user interfaces

---

References

- Homepage : [reactjs.org/](https://reactjs.org/)

## Features

-   **Declarative**<!-- 声明式的 -->

    React makes it painless to create interactive UIs.
    Design simple views for each **state** in your application, and React will efficiently **update** and **render** just the right **components when** your **data changes**.

    _Declarative views make your code more predictable and easier to debug._

-   **Component-Based**

    Build **encapsulated components that manage their own state**, then **compose them** to make complex UIs.

    Since component logic is written in JavaScript instead of templates, you can easily pass rich data through your app and keep state out of the DOM.

-   **Learn Once, Write Anywhere**

    We don’t make assumptions about the rest of your technology stack, so you can develop new features in React without rewriting existing code.

    React can also render on the server using Node and power mobile apps using React Native.

## Examples

### A Simple Component

**React components implement a `render()` method that takes input data and returns what to display.**
This example uses an **XML-like** syntax called **JSX**.
**Input data that is passed into the component can be accessed by `render()` via `this.props`.**

JSX is optional and not required to use React.
Try the [Babel REPL](https://babeljs.io/repl/#?presets=react&code_lz=MYewdgzgLgBApgGzgWzmWBeGAeAFgRgD4AJRBEAGhgHcQAnBAEwEJsB6AwgbgChRJY_KAEMAlmDh0YWRiGABXVOgB0AczhQAokiVQAQgE8AkowAUAcjogQUcwEpeAJTjDgUACIB5ALLK6aRklTRBQ0KCohMQk6Bx4gA) to see the raw JavaScript code produced by the JSX compilation step.

```jsx
class HelloMessage extends React.Component {
  render() {
    return (
      <div>
        Hello {this.props.name}
      </div>
    );
  }
}

ReactDOM.render(
  <HelloMessage name="Taylor" />,
  document.getElementById('hello-example')
);
```

### A Stateful Component

In addition to taking input data (accessed via `this.props`), a component can maintain internal state data (accessed via `this.state`).
**When a component's state data changes, the rendered markup will be updated by re-invoking `render()`.**

<!-- icehe : 下面的示例, 第一次看还不能完全理解. 2021/12/12 -->

```jsx
class Timer extends React.Component {
  constructor(props) {
    super(props);
    this.state = { seconds: 0 };
  }

  tick() {
    this.setState(state => ({
      seconds: state.seconds + 1
    }));
  }

  componentDidMount() {
    this.interval = setInterval(() => this.tick(), 1000);
  }

  componentWillUnmount() {
    clearInterval(this.interval);
  }

  render() {
    return (
      <div>
        Seconds: {this.state.seconds}
      </div>
    );
  }
}

ReactDOM.render(
  <Timer />,
  document.getElementById('timer-example')
);
```

### An Application

Using `props` and `state`, we can put together a small Todo application.
This example **uses `state` to track the current list of items as well as the text that the user has entered**.
Although event handlers appear to be rendered inline, they will be collected and implemented using event delegation.

```jsx
class TodoApp extends React.Component {
  constructor(props) {
    super(props);
    this.state = { items: [], text: '' };
    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  render() {
    return (
      <div>
        <h3>TODO</h3>
        <TodoList items={this.state.items} />
        <form onSubmit={this.handleSubmit}>
          <label htmlFor="new-todo">
            What needs to be done?
          </label>
          <input
            id="new-todo"
            onChange={this.handleChange}
            value={this.state.text}
          />
          <button>
            Add #{this.state.items.length + 1}
          </button>
        </form>
      </div>
    );
  }

  handleChange(e) {
    this.setState({ text: e.target.value });
  }

  handleSubmit(e) {
    // icehe : 这句的用途又是什么? 待查. 2021/12/12
    e.preventDefault();
    if (this.state.text.length === 0) {
      return;
    }
    const newItem = {
      text: this.state.text,
      id: Date.now()
    };
    this.setState(state => ({
      items: state.items.concat(newItem),
      text: ''
    }));
  }
}

class TodoList extends React.Component {
  render() {
    return (
      <ul>
        {this.props.items.map(item => (
          <li key={item.id}>{item.text}</li>
        ))}
      </ul>
    );
  }
}

ReactDOM.render(
  <TodoApp />,
  document.getElementById('todos-example')
);
```

### A Component Using External Plugins

**React allows you to interface with other libraries and frameworks.**
This example uses **remarkable**, an external Markdown library, to convert the `<textarea>`’s value in real time.

```jsx
class MarkdownEditor extends React.Component {
  constructor(props) {
    super(props);
    this.md = new Remarkable();
    this.handleChange = this.handleChange.bind(this);
    this.state = { value: 'Hello, **world**!' };
  }

  handleChange(e) {
    this.setState({ value: e.target.value });
  }

  getRawMarkup() {
    return { __html: this.md.render(this.state.value) };
  }

  render() {
    return (
      <div className="MarkdownEditor">
        <h3>Input</h3>
        <label htmlFor="markdown-content">
          Enter some markdown
        </label>
        <textarea
          id="markdown-content"
          onChange={this.handleChange}
          defaultValue={this.state.value}
        />
        <h3>Output</h3>
        <div
          className="content"
          dangerouslySetInnerHTML={this.getRawMarkup()}
        />
      </div>
    );
  }
}

ReactDOM.render(
  <MarkdownEditor />,
  document.getElementById('markdown-example')
);
```

## Glossary of React Terms

Reference : [Glossary of React Terms - React Docs](https://reactjs.org/docs/glossary.html)

### Single-page Application

**A single-page application is an application that loads a single HTML page and all the necessary assets (such as JavaScript and CSS) required for the application to run.**

**Any interactions with the page or subsequent pages do not require a round trip to the server which means the page is not reloaded.**

Though you may build a single-page application in React, it is not a requirement.
React can also be used for enhancing small parts of existing websites with additional interactivity.
Code written in React can coexist peacefully with markup rendered on the server by something like PHP, or with other client-side libraries.
_In fact, this is exactly how React is being used at Facebook._

### Compilers

**A JavaScript compiler takes JavaScript code, transforms it and returns JavaScript code in a different format.**

The most common use case is to **take ES6 syntax and transform it into syntax that older browsers are capable of interpreting**.
[Babel](https://babeljs.io/) is the compiler most commonly used with React.

### Bundlers

**Bundlers take JavaScript and CSS code written as separate modules (often hundreds of them), and combine them together into a few files better optimized for the browsers.**

Some bundlers commonly used in React applications include [Webpack](https://webpack.js.org/) and [Browserify](http://browserify.org/).

### JSX

JSX is a syntax extension to JavaScript.
It is similar to a template language, but it has full power of JavaScript.

**JSX gets compiled to `React.createElement()` calls which return plain JavaScript objects called "React elements".**

_To get a basic introduction to JSX see the docs [here](https://reactjs.org/docs/introducing-jsx.html) and find a more in-depth tutorial on JSX [here](https://reactjs.org/docs/jsx-in-depth.html)._

React DOM uses camelCase property naming convention instead of HTML attribute names.
_For example, `tabindex` becomes `tabIndex` in JSX._
_The attribute class is also written as className since class is a reserved word in JavaScript:_

```jsx
const name = 'Clementine';
ReactDOM.render(
  <h1 className="hello">My name is {name}!</h1>,
  document.getElementById('root')
);
```

### Elements

React elements are **the building blocks of React applications.**

One might confuse elements with a more widely known concept of "components".
**An element describes what you want to see on the screen.**
React elements are **immutable**.

```jsx
const element = <h1>Hello, world</h1>;
```

**Typically, elements are not used directly, but get returned from components.**

### Components

Reference : [Components and Props - React Docs](https://reactjs.org/docs/components-and-props.html)

React components are **small, reusable pieces of code that return a React element to be rendered to the page**.

The simplest version of React component is a plain JavaScript function that returns a React element:

```jsx
function Welcome(props) {
  return <h1>Hello, {props.name}</h1>;
}
```

Components can also be ES6 classes:

```jsx
class Welcome extends React.Component {
  render() {
    return <h1>Hello, {this.props.name}</h1>;
  }
}
```

**Components can be broken down into distinct pieces of functionality and used within other components.**
Components can return other components, arrays, strings and numbers.

A good rule of thumb is that if a part of your UI is used several times (Button, Panel, Avatar), or is complex enough on its own (App, FeedStory, Comment), it is a good candidate to be a reusable component.

Component names should also always start with a capital letter (`<Wrapper/>` not `<wrapper/>`).

_See [this documentation](https://reactjs.org/docs/components-and-props.html#rendering-a-component) for more information on rendering components._

### props

Reference : [Components and Props - React Docs](https://reactjs.org/docs/components-and-props.html)

`props` are **inputs to a React component**.
They are **data passed down from a parent component to a child component**.

Remember that `props` are **readonly**.
_They should not be modified in any way: …_

If you need to modify some value in response to user input or a network response, use `state` instead.

### props.children

props.children is available on every component.
**It contains the content between the opening and closing tags of a component.**
_For example:_

```jsx
<Welcome>Hello world!</Welcome>
```

The string `Hello world!` is available in `props.children` in the `Welcome` component:

```jsx
function Welcome(props) {
  return <p>{props.children}</p>;
}
```

For components defined as classes, use `this.props.children`:

```jsx
class Welcome extends React.Component {
  render() {
    return <p>{this.props.children}</p>;
  }
}
```

### state

Reference : [Adding Local State to a Class](https://reactjs.org/docs/state-and-lifecycle.html#adding-local-state-to-a-class)

**A component needs `state` when some data associated with it changes over time.**

_For example, a Checkbox component might need `isChecked` in its state, and a `NewsFeed` component might want to keep track of `fetchedPosts` in its state._

The most important difference between `state` and `props` is that **`props` are passed from a parent component, but `state` is managed by the component itself**.
A component cannot change its `props`, but it can change its `state`.

For each particular piece of changing data, there should be just one component that "owns" it in its state.
Don't try to synchronize states of two different components.
Instead, [lift it up](https://reactjs.org/docs/lifting-state-up.html) to their closest shared ancestor, and pass it down as props to both of them.

### Lifecycle Methods

Reference : [Adding Lifecycle Methods to a Class - React Docs](https://reactjs.org/docs/state-and-lifecycle.html#adding-lifecycle-methods-to-a-class)

Lifecycle methods are custom functionality that gets executed during the different phases of a component.
There are methods available when the component gets created and inserted into the DOM ([mounting](https://reactjs.org/docs/react-component.html#mounting)), when the component updates, and when the component gets unmounted or removed from the DOM.

### Controlled vs. Uncontrolled Components

References

- [Controlled Components - React Docs](https://reactjs.org/docs/forms.html#controlled-components)
- [Uncontrolled Components - React Docs](https://reactjs.org/docs/uncontrolled-components.html)

React has two different approaches to dealing with form inputs.

An input form element whose value is controlled by React is called a controlled component.
When a user enters data into a controlled component a change event handler is triggered and your code decides whether the input is valid (by re-rendering with the updated value).
If you do not re-render then the form element will remain unchanged.

An uncontrolled component works like form elements do outside of React.
When a user inputs data into a form field (an input box, dropdown, etc) the updated information is reflected without React needing to do anything.
However, this also means that you can't force the field to have a certain value.

In most cases you should use controlled components.

### Keys

Reference : [Lists and Keys - React Docs](https://reactjs.org/docs/lists-and-keys.html)

A "key" is a special string attribute you need to include when creating arrays of elements.
Keys help React identify which items have changed, are added, or are removed.
Keys should be given to the elements inside an array to give the elements a stable identity.

Keys only need to be unique among sibling elements in the same array.
They don't need to be unique across the whole application or even a single component.

_Don't pass something like `Math.random()` to keys._
It is important that keys have a "stable identity" across re-renders so that React can determine when items are added, removed, or re-ordered.
Ideally, keys should correspond to unique and stable identifiers coming from your data, such as `post.id`.

### Refs

Reference : [Refs and the DOM](https://reactjs.org/docs/refs-and-the-dom.html)

**React supports a special attribute that you can attach to any component.**
The ref attribute can be an object created by [`React.createRef()`](https://reactjs.org/docs/react-api.html#reactcreateref) function or a callback function, or a string (in legacy API).
When the `ref` attribute is a callback function, the function receives the underlying DOM element or class instance (depending on the type of element) as its argument.
This allows you to have direct access to the DOM element or component instance.

Use refs sparingly<!-- 节俭地; 爱惜地 -->.
If you find yourself often using refs to "make things happen" in your app, consider getting more familiar with [top-down data flow](https://reactjs.org/docs/lifting-state-up.html).

### Events

Reference : [Handling Events - React Docs](https://reactjs.org/docs/handling-events.html)

Handling events with React elements has some syntactic differences:

- React event handlers are named using camelCase, rather than lowercase.
- With JSX you pass a function as the event handler, rather than a string.

### Reconciliation

<!-- 一致 -->

Reference : [Reconciliation - React Docs](https://reactjs.org/docs/reconciliation.html)

When a component's props or state change, React decides whether an actual DOM update is necessary by comparing the newly returned element with the previously rendered one.
When they are not equal, React will update the DOM.
This process is called "reconciliation".
