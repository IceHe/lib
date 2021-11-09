# Base64 Encoding

## Browser: btoa/atob

References

- [JavaScript uses BTOA and ATOB to perform Base64 transcoding and decoding](https://www.programmerall.com/article/48861656231/)
- [btoa - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/API/btoa)
- [atob - MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/API/atob)
- _[Failed to execute 'btoa' on 'Window': The string to be encoded contains characters outside of the Latin1 range. - Stack Overflow](https://stackoverflow.com/questions/23223718/failed-to-execute-btoa-on-window-the-string-to-be-encoded-contains-characte)_

```javascript
> btoa('编码测试')
VM7507:1 Uncaught DOMException: Failed to execute 'btoa' on 'Window': The string to be encoded contains characters outside of the Latin1 range.
    at <anonymous>:1:1
```

It means that **`btoa`/`atob` can only encode/decode the characters inside of the Latin1 range.**

## Node: Buffer

References

- [Buffer.from - Node.js documentation](https://nodejs.org/api/buffer.html#static-method-bufferfromarray)

Common

```ts
// encode
Buffer.from(str).toString('base64');
// decode
Buffer.from(str, 'base64').toString();
```

Same as btoa/atob

```ts
// encode as same as btoa
Buffer.from(str, "latin1").toString('base64');
// decode as same as atob
Buffer.from(str, 'base64').toString("latin1");
```

## For Both

The behaviors of `encode`/`decode` are the same under both Node and browser-like environments.

```ts
// encode
const encodedString = isNodeEnvironment
  ? Buffer.from(rawString, "latin1").toString('base64');
  : btoa(rawString);
// decode
const decodedString = isNodeEnvironment
  ? Buffer.from(encodedString, "latin1").toString('base64');
  : btoa(encodedString);
```
