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
