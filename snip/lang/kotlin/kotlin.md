# Kotlin

a cross-platform, statically typed, general-purpose programming language with type inference

---

References

- [Kotlin (programming language)](https://en.wikipedia.org/wiki/Kotlin_(programming_language))
- [kotlinlang.org](https://kotlinlang.org/)
    - [Docs Home](https://kotlinlang.org/docs/home.html)

## Get Started

Kotlin is a modern but already mature programming language aimed to make developers happier.
It's **concise, safe, interoperable with Java and other languages**, and **provides many ways to reuse code between multiple platforms for productive programming**.

……

## Basics

### Basic syntax

References

- [Android Overview - Kotlin Docs](https://kotlinlang.org/docs/basic-syntax.html)

#### Package definition and imports

Package specification should be at the top of the source file.

```kt
package my.demo

import kotlin.text.*

// ...
```

**It is not required to match directories and packages: source files can be placed arbitrarily in the file system.**

See [Packages](https://kotlinlang.org/docs/packages.html).

#### Program entry point

```kt
fun main() {
    println("Hello world!")
}
```

or

```kt
fun main(args: Array<String>) {
    println(args.contentToString())
}
```

#### Print to the standard output﻿

```kt
print("Hello ")
print("world!")
println("Hello IceHe!")
println(42)
```

#### Functions

```kt
fun sum(a: Int, b: Int): Int {
    return a + b
}
```

**A function body can be an expression.**
Its return type is inferred.

```kt
fun sum(a: Int, b: Int) = a + b
```
