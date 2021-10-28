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

#### String templates

```kt
var a = 1
// simple name in template:
val s1 = "a is $a"

a = 2
// arbitrary expression in template:
val s2 = "${s1.replace("is", "was")}, but now is $a"
```

See [String templates](https://kotlinlang.org/docs/basic-types.html#string-templates) for details.

#### Conditional expressions

```kt
fun maxOf(a: Int, b: Int): Int {
    if (a > b) {
        return a
    } else {
        return b
    }
}
```

In Kotlin, `if` can also be used as an expression.

```kt
fun maxOf(a: Int, b: Int) = if (a > b) a else b
```

See [`if`-expressions](https://kotlinlang.org/docs/control-flow.html#if-expression).

#### for loop

```kt
val items = listOf("apple", "banana", "kiwifruit")
for (item in items) {
    println(item)
}
```

or

```kt
val items = listOf("apple", "banana", "kiwifruit")
for (index in items.indices) {
    println("item at $index is ${items[index]}")
}
```

See [for loop](https://kotlinlang.org/docs/control-flow.html#while-loops).

#### while loop

```kt
val items = listOf("apple", "banana", "kiwifruit")
var index = 0
while (index < items.size) {
    println("item at $index is ${items[index]}")
    index++
}
```

See [while loop](https://kotlinlang.org/docs/control-flow.html#while-loops).

#### when expression

```kt
fun describe(obj: Any): String =
    when (obj) {
        1          -> "One"
        "Hello"    -> "Greeting"
        is Long    -> "Long"
        !is String -> "Not a string"
        else       -> "Unknown"
    }
```

See [when expression](https://kotlinlang.org/docs/control-flow.html#when-expression).

#### Ranges

**Check if a number is within a range using `in` operator.**

```kt
val x = 10
val y = 9
if (x in 1..y+1) {
    println("fits in range")
}
```

**Check if a number is out of range.**

```kt
val list = listOf("a", "b", "c")

if (-1 !in 0..list.lastIndex) {
    println("-1 is out of range")
}
if (list.size !in list.indices) {
    println("list size is out of valid list indices range, too")
}
```

**Iterate over a range.**

```kt
for (x in 1..5) {
    print(x)
}
```

**Or over a progression.**

```kt
for (x in 1..10 step 2) {
    print(x)
}
println()
for (x in 9 downTo 0 step 3) {
    print(x)
}
```

See [Ranges and progression](https://kotlinlang.org/docs/ranges.html)

#### Collections

Iterate over a collection.

```kt
for (item in items) {
    println(item)
}
```

**Check if a collection contains an object using `in` operator.**

```kt
when {
    "orange" in items -> println("juicy")
    "apple" in items -> println("apple is fine too")
}
```

**Using lambda expressions to filter and map collections:**

```kt
val fruits = listOf("banana", "avocado", "apple", "kiwifruit")
fruits
    .filter { it.startsWith("a") }
    .sortedBy { it }
    .map { it.uppercase() }
    .forEach { println(it) }
```

See [Collections overview](https://kotlinlang.org/docs/collections-overview.html)

#### Nullable values and null checks

**A reference must be explicitly marked as nullable when `null` value is possible.**
**Nullable type names have `?` at the end.**

Return `null` if `str` does not hold an integer:

```kt
fun parseInt(str: String): Int? {
    // ...
}
```

#### Use a function returning nullable value:

```kt
fun printProduct(arg1: String, arg2: String) {
    val x = parseInt(arg1)
    val y = parseInt(arg2)

    // Using `x * y` yields error because they may hold nulls.
    if (x != null && y != null) {
        // x and y are automatically cast to non-nullable after null check
        println(x * y)
    }
    else {
        println("'$arg1' or '$arg2' is not a number")
    }
}
```

or

```kt
// ...
if (x == null) {
    println("Wrong number format in arg1: '$arg1'")
    return
}
if (y == null) {
    println("Wrong number format in arg2: '$arg2'")
    return
}

// x and y are automatically cast to non-nullable after null check
println(x * y)
```

See [Null-safety](https://kotlinlang.org/docs/null-safety.html).

#### Type checks and automatic casts﻿

**The `is` operator checks if an expression is an instance of a type.**
If an immutable local variable or property is checked for a specific type, there's no need to cast it explicitly:

```kt
fun getStringLength(obj: Any): Int? {
    if (obj is String) {
        // `obj` is automatically cast to `String` in this branch
        return obj.length
    }

    // `obj` is still of type `Any` outside of the type-checked branch
    return null
}
```

or

```kt
fun getStringLength(obj: Any): Int? {
    if (obj !is String) return null

    // `obj` is automatically cast to `String` in this branch
    return obj.length
}
```

or even

```kt
fun getStringLength(obj: Any): Int? {
    // `obj` is automatically cast to `String` on the right-hand side of `&&`
    if (obj is String && obj.length > 0) {
        return obj.length
    }

    return null
}
```

See [Classes](https://kotlinlang.org/docs/classes.html) and Type casts.

## Idioms

```kt
data class Customer(val name: String, val email: String)
```
