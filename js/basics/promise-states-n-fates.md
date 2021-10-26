# Promise: States and Fates

This document helps clarify the different adjectives surrounding promises, by dividing them up into two categories: _states_ and _fates_.

---

References

- [promises-unwrapping/docs/states-and-fates.md - GitHub](https://github.com/domenic/promises-unwrapping/blob/master/docs/states-and-fates.md)

## Overview and Operational Definitions

### States

Promises have three possible mutually exclusive states: **fulfilled**, **rejected**, and **pending**.

- A promise is _fulfilled_ if `promise.then(f)` will call `f` "as soon as possible."
- A promise is _rejected_ if `promise.then(undefined, r)` will call `r` "as soon as possible."
- A promise is _pending_ if it is neither _fulfilled_ nor _rejected_.

### Fates

## Relation to the Spec

A promise's state is reflected in its PromiseState internal slot.

A promise's fate is stored implicitly as part of its "resolving functions".
