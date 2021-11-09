# Code Snippet - JavaScript

## Running under Node or not

References

- [How to check whether a script is running under Node.js? - Stack Overflow](https://stackoverflow.com/questions/4224606/how-to-check-whether-a-script-is-running-under-node-js/4224668)

```javascript
function isNodeEnvironment() {
  return typeof window === 'undefined';
}
```

## Jest for unit tests

### Mock Environment

References

- [testEnvironment - Configuration Jest](https://jestjs.io/docs/configuration#testenvironment-string)

**Default: `node`**

_The test environment that will be used for testing._
The default environment in Jest is a Node.js environment.
**If you are building a web app, you can use a browser-like environment through `jsdom` instead.**

**By adding a `@jest-environment` docblock at the top of the file, you can specify another environment to be used for all tests in that file:**

```ts
/**
 * @jest-environment jsdom
 */

// ……

test('use jsdom in this test file', () => {
  const element = document.createElement('div');
  expect(element).not.toBeNull();
});
```

_See the references above for more._
