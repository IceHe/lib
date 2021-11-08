# Code Snippets - JavaScript

## Running under Node?

References

- [How to check whether a script is running under Node.js? - Stack Overflow](https://stackoverflow.com/questions/4224606/how-to-check-whether-a-script-is-running-under-node-js/4224668)

```javascript
function isNode() {
  return typeof window === 'undefined';
}
```
