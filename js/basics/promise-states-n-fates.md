# Promise: States and Fates

This document helps clarify the different adjectives surrounding promises, by dividing them up into two categories: _states_ and _fates_.

---

References

- [promises-unwrapping/docs/states-and-fates.md - GitHub](https://github.com/domenic/promises-unwrapping/blob/master/docs/states-and-fates.md)

## Operational Definitions

### States

Promises have three possible mutually exclusive states: **fulfilled**, **rejected**, and **pending**.

- A promise is _fulfilled_ if `promise.then(f)` will call `f` "as soon as possible."
- A promise is _rejected_ if `promise.then(undefined, r)` will call `r` "as soon as possible."
- A promise is _pending_ if it is neither _fulfilled_ nor _rejected_.

### Fates

Promises have two possible mutually exclusive fates: _resolved_, and _unresolved_.

-   A promise is _resolved_ if trying to resolve or reject it has no effect,

    i.e. the promise has been "locked in" to either follow another promise, or has been fulfilled or rejected.

-   A promise is _unresolved_ if it is not resolved,

    i.e. if trying to resolve or reject it will have an impact on the promise.

A promise can be "resolved to" either a promise or thenable, in which case it will store the promise or thenable for later unwrapping;
or it can be resolved to a non-promise value, in which case it is fulfilled with that value.

### Relating States and Fates

A promise whose fate is resolved can be in any of the three states:

-   Fulfilled,

    if it has been resolved to a non-promise value, or resolved to a thenable which will call any passed fulfillment handler back as soon as possible, or resolved to another promise that is fulfilled.

-   Rejected,

    if it has been rejected directly, or resolved to a thenable which will call any passed rejection handler back as soon as possible, or resolved to another promise that is rejected.

-   Pending,

    if it has been resolved to a thenable which will call neither handler back as soon as possible, or resolved to another promise that is pending.

A promise whose fate is unresolved is necessarily pending.

Note that these relations are recursive, e.g. a promise that has been resolved to a thenable which will call its fulfillment handler with a promise that has been rejected is itself rejected.

## Relation to the Spec

A promise's state is reflected in its PromiseState internal slot.

A promise's fate is stored implicitly as part of its "resolving functions".

_( icehe : 看得云里雾里, 暂时还是理解不了 resolved 和 unresolved 的含义. 2021/11/15 )_
