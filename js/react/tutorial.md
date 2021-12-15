# Tutorial

This tutorial doesn't assume any existing React knowledge

---

TBD : uncessary? to remove?

References

- [Tutorial: Intro to React](https://reactjs.org/tutorial/tutorial.html)

## Overview

**What Is React?**

React is a declarative, efficient, and flexible JavaScript library for building user interfaces.
It lets you compose complex UIs from small and isolated pieces of code called "**components**".

React has a few different kinds of components, but we'll start with `React.Component` subclasses:

```jsx
class ShoppingList extends React.Component {
  render() {
    return (
      <div className="shopping-list">
        <h1>Shopping List for {this.props.name}</h1>
        <ul>
          <li>Instagram</li>
          <li>WhatsApp</li>
          <li>Oculus</li>
        </ul>
      </div>
    );
  }
}
// Example usage: <ShoppingList name="Mark" />
```

We'll get to the funny XML-like tags soon.
We use components to tell React what we want to see on the screen.
When our data changes, React will efficiently update and re-render our components.

Here, ShoppingList is a **React component class**, or **React component type**.
A component takes in parameters, called `props` (short for "properties"), and returns a hierarchy of views to display via the `render` method.

The `render` method returns a description of what you want to see on the screen.
React takes the description and displays the result.
In particular, `render` returns a **React element**, which is a lightweight description of what to render.
Most React developers use a special syntax called "JSX" which makes these structures easier to write.
The `<div />` syntax is transformed at build time to `React.createElement('div')`.
_The example above is equivalent to:_

```jsx
return React.createElement('div', {className: 'shopping-list'},
  React.createElement('h1', /* ... h1 children ... */),
  React.createElement('ul', /* ... ul children ... */)
);
```

If you’re curious, `createElement()` is described in more detail in the API reference, but we won’t be using it in this tutorial.
Instead, we will keep using JSX.

JSX comes with the full power of JavaScript.
You can put any JavaScript expressions within braces inside JSX.
Each React element is a JavaScript object that you can store in a variable or pass around in your program.

The ShoppingList component above only renders built-in DOM components like `<div />` and `<li />`.
But you can compose and render custom React components too.
For example, we can now refer to the whole shopping list by writing `<ShoppingList />`.
Each React component is encapsulated and can operate independently; this allows you to build complex UIs from simple components.
