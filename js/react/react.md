# React

A JavaScript library for building user interfaces

---

References

- [reactjs.org/](https://reactjs.org/)

## Intro

Reference : [reactjs.org/](https://reactjs.org/)

### Features

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

**In addition to taking input data (accessed via `this.props`), a component can maintain internal state data (accessed via `this.state`).**
When a component’s state data changes, the rendered markup will be updated by re-invoking `render()`.

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
