# JavaScript

aka. ECMAScript

---

References

- [JavaScript - Wikipedia](https://en.wikipedia.org/wiki/JavaScript)
    - aka. [ECMAScript](https://en.wikipedia.org/wiki/ECMAScript)
- [create-project.js.org](https://create-project.js.org/)

## dependencies vs devDependencies vs peerDependencies

References

- [What is the difference between .js, .tsx and .jsx in React? - stack overflow](https://stackoverflow.com/questions/64343698/what-is-the-difference-between-js-tsx-and-jsx-in-react)

TL;DR:

- **`dependencies` and `devDependencies` are used to make a difference between the libraries that will be (or won't be) in your final bundle.**
- **`peerDependencies` are useful only if you want to create and publish your own library.**

### dependencies

The libraries under dependencies are those that your project really needs to **be able to work in production**.
_Usually, these libraries have all or part of their code in your final bundle(s)._

_The libraries you can find under dependencies include utility libraries such as lodash, classnames etc and also the "main" libraries of your project._

### devDependencies

As we can guess thanks to its name, the libraries under devDependencies are those that **you need during development**.

_So you'll find here different types of libraries such as:_

- **formatting libraries**: **eslint**, **prettier**, ...
- **bundlers**: webpack, gulp, **parceljs**, ...
- babel and all its plugins
- everything related to tests: enzyme, jest, ...
- a bunch of other libraries: storybook, react-styleguidist, **husky**, ...

### peerDependencies

95% of the time, you'll use only dependencies and devDependencies.
But if you want to create and publish your own library so that it can be used as a dependency, you may also need the peerDependencies.
Under this section, **you can indicate which versions of some of your important libraries are required**.

Let's imagine that **your project (ProjectA) uses an important library (peer-lib) and you know or at least guess that the project (MainProject) which will use your library will also use this peer-lib library.**
If you want to **make sure that the version of peer-lib used in MainProject works with your version in ProjectA, you should use peerDependencies.**

## TODO
