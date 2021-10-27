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

#### Print to the standard output

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

See [Functions](https://kotlinlang.org/docs/functions.html)

#### Variables

**Read-only local variables are defined using the keyword `val`.**
**They can be assigned a value only once.**

```kt
val a: Int = 1  // immediate assignment
val b = 2   // `Int` type is inferred
val c: Int  // Type required when no initializer is provided
c = 3       // deferred assignment
```

**Variables that can be reassigned use the `var` keyword.**

```kt
var x = 5 // `Int` type is inferred
x += 1
```

You **can declare variables at the top level.**

```kt
val PI = 3.14
var x = 0

fun incrementX() {
    x += 1
}
```

See [Properties](https://kotlinlang.org/docs/properties.html)

#### Creating classes and instances

Properties of a class can be listed in its declaration or body.

```kt
class Rectangle(var height: Double, var length: Double) {
    var perimeter = (height + length) * 2
}
```

**The default constructor with parameters listed in the class declaration is available automatically.**

```kt
val rectangle = Rectangle(5.0, 2.0)
println("The perimeter is ${rectangle.perimeter}")
```

**Inheritance between classes is declared by a colon (`:`).**
**Classes are final by default; to make a class inheritable, mark it as `open`.**

```kt
open class Shape

class Rectangle(var height: Double, var length: Double): Shape() {
    var perimeter = (height + length) * 2
}
```

See [Classes](https://kotlinlang.org/docs/classes.html) and [Objects and instances](https://kotlinlang.org/docs/object-declarations.html).

#### Comments

```kt
// This is an end-of-line comment

/* This is a block comment
   on multiple lines. */
```

**Block comments in Kotlin can be nested.**

```kt
/* The comment starts here
/* contains a nested comment *⁠/
and ends here. */
```

_See [Documenting Kotlin Code](https://kotlinlang.org/docs/kotlin-doc.html) for information on the documentation comment syntax._
