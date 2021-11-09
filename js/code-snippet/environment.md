# Running under Node or not

References

- [How to check whether a script is running under Node.js? - Stack Overflow](https://stackoverflow.com/questions/4224606/how-to-check-whether-a-script-is-running-under-node-js/4224668)

Usage

```javascript
function isNodeEnvironment() {
  return typeof window === 'undefined';
}
```
