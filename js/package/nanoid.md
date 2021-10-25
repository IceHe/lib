# nanoid

A tiny, secure, URL-friendly, unique string ID generator for JavaScript.

---

References

- [ai/nanoid - GitHub](https://github.com/ai/nanoid)
- [Nano ID Collision Calculator](https://zelark.github.io/nano-id-cc/)

## Intro

> "An amazing level of senseless perfectionism, which is simply impossible not to respect."

-   **Small**

    130 bytes (minified and gzipped).
    **No dependencies.**
    _[Size Limit](https://github.com/ai/size-limit) controls the size._

-   **Fast**

    It is **2 times faster than UUID.**

-   **Safe**

    It uses **hardware random generator**. _Can be used in clusters._

-   **Short IDs**

    It uses a **larger alphabet than UUID (`A-Za-z0-9_-`).**
    So **ID size was reduced from 36 to <u>21 symbols</u>**.

-   **Portable**

    Nano ID was **ported to [19 programming languages](https://github.com/ai/nanoid#other-programming-languages).**

```js
import { nanoid } from 'nanoid'
model.id = nanoid() //=> "V1StGXR8_Z5jdHi6B-myT"
```

Supports modern browsers, _IE with Babel,_ Node.js and React Native.

## Comparison with UUID

_Nano ID is quite comparable to UUID v4 (random-based)._
It has a similar **number of random bits** in the ID (**126 in Nano ID and 122 in UUID**), so it has a similar collision probability:

> For there to be **a one in a billion chance of duplication**, 103 trillion version 4 IDs must be generated.

There are three main differences between Nano ID and UUID v4:

1. **Nano ID uses a bigger alphabet, so a similar number of random bits are packed in just 21 symbols instead of 36.**
2. Nano ID code is 4 times less than uuid/v4 package: 130 bytes instead of 483.
3. **Because of memory allocation tricks, Nano ID is 2 times faster than UUID.**

## Benchmark

[github.com/ai/nanoid/blob/main/test/benchmark.js](https://github.com/ai/nanoid/blob/main/test/benchmark.js)

```bash
$ node ./test/benchmark.js
crypto.randomUUID         28,387,114 ops/sec
uid/secure                 8,633,795 ops/sec
@lukeed/uuid               6,888,704 ops/sec
nanoid                     6,166,399 ops/sec
customAlphabet             3,290,342 ops/sec
uuid v4                    1,662,373 ops/sec
secure-random-string         415,340 ops/sec
uid-safe.sync                400,875 ops/sec
cuid                         212,669 ops/sec
shortid                       53,453 ops/sec

Async:
nanoid/async                 102,823 ops/sec
async customAlphabet         101,574 ops/sec
async secure-random-string    96,540 ops/sec
uid-safe                      93,395 ops/sec

Non-secure:
uid                       70,055,975 ops/sec
nanoid/non-secure          2,985,368 ops/sec
rndm                       2,800,961 ops/sec
```

_Test configuration: ThinkPad X1 Carbon Gen 9, Fedora 34, Node.js 16.10._

---

icehe: [`uid`](https://github.com/lukeed/uid) seems to be better than `nanoid`.
But `uid` can only output strings of fixed length lowercase alphanumberic characters (`a-z0-9`).
_( To produce IDs in UUID.V4 format, please see `@lukeed/uuid`. )_

## Security

See a good article about random generators theory:
[Secure random values (in Node.js)](https://gist.github.com/joepie91/7105003c3b26e65efcea63f3db82dfba)

-   **Unpredictability**.

    Instead of using the unsafe `Math.random()`, Nano ID **uses the crypto module in Node.js and the Web Crypto API in browsers.**
    These modules **use unpredictable hardware random generator.**

-   **Uniformity**.

    **`random % alphabet` is a popular mistake to make when coding an ID generator.**
    The distribution will not be even; there will be a lower chance for some symbols to appear compared to others.
    So, it will reduce the number of tries when brute-forcing.
    Nano ID **uses a better algorithm and is tested for uniformity.**

-   **Well-documented**:

    all Nano ID hacks are documented.
    See comments in [the source](https://gist.github.com/joepie91/7105003c3b26e65efcea63f3db82dfba).

-   **Vulnerabilities**

    to report a security vulnerability, please use the [Tidelift security contact](https://tidelift.com/security).
    Tidelift will coordinate the fix and disclosure.

## Install

## API

### Blocking

### Async

### Non-Secure

### Custom Alphabet or Size

### Custom Random Bytes Generator

## Usage

### IE

### React

### HTML ID

### React Native

### Rollup

### PouchDB and CouchDB

### Mongoose

### Web Workers

### CLI

### Other Programming Languages

## Tools
