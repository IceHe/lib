/**
 * pakcage definition
 */
package xyz.icehe.kotlin.basics

/**
 * pakcage imports
 */
import kotlin.text.*

/**
 * program entry point
 */
fun main(args: Array<String>) {
    println(args.contentToString());
    print("testing print ")
    print(1234567890)
    println()
}

main(arrayOf("ice", "he"));

/**
 * functions
 */
fun sum1(x: Int, y: Int): Int {
    return x + y
}

fun sum2(x: Int, y: Int): Int = x + y

println("sum1(1, 2) = " + sum1(1, 2))
println("sum2(3, 4) = " + sum1(3, 4))

/**
 * variables
 */
val valA: Int = 11
println("valA = " + valA)

val valB = 22
println("valB = " + valB)

// defferred assignment
//val valC: Int
//valC = 33
// error: captured member values initialization is forbidden due to possible reassignment (basics.kts:41:1)
// basics.kts:41:1: error: captured member values initialization is forbidden due to possible reassignment
//println("valC = " + valC)

var varD: Int = 44;
println("varD = " + varD + " before adding")
varD += 55;
println("varD = " + varD + " after adding")

// declare variables at the top level
var x = 0
fun incrX(): Int {
    return ++x
}

println("x = " + incrX())
println("x = " + incrX())

/**
 * creating classes and instances
 */
open class Shape

class Rectangle(var height: Double, var length: Double) : Shape() {
    var perimeter = (height + length) * 2
}

val rectangle = Rectangle(6.0, 7.0)
println("rectangle.perimeter = " + rectangle.perimeter)

/**
 * string templates
 */
var a = 1
val s1 = "a is $a"
val s2 = "a is ${a}"
println("s1 = " + s1)
println("s2 = " + s2)

a = 2
val s3 = "${s1.replace("is", "was")}, but now is $a"
println(s3)

/**
 * conditional expressions
 */
fun maxOf1(x: Int, y: Int): Int {
    if (x > y) {
        return x
    } else {
        return y
    }
}

fun maxOf2(x: Int, y: Int): Int = if (x > y) x else y

println("maxOf1(9, 8) = " + maxOf1(9, 8))
println("maxOf2(99, 100) = " + maxOf2(99, 100))

/**
 * for loop
 */
val items = listOf("app", "boy", "cat")
for (item in items) {
    println(item)
}

for (index in items.indices) {
    println("item at $index is ${items[index]}")
}

/**
 * while loop
 */
var index = 0
while (index < items.size) {
    println("item at $index is ${items[index]}")
    index++
}

/**
 * when expression
 */
fun describe(obj: Any): String =
        when (obj) {
            0 -> "Zero"
            1 -> "One"
            "Ice" -> "He"
            is Long -> "Long"
            !is String -> "Not String"
            else -> "unknown"
        }

println(describe(0))
println(describe(1))
println(describe(2))
println(describe("Ice"))
println(describe("Will"))
println(describe(9999999999999))
println(describe(java.util.Date()))

/**
 * ranges
 */
val xx = 10
val yy = 9
if (xx in 1..yy + 1) {
    println("fits in range")
}

val list = listOf("a", "b", "c")
if (-1 !in 0..list.lastIndex) {
    println("-1 is out of range")
}
if (list.size !in list.indices) {
    println("list size is out of valid list indices range, too")
}

for (x in 1..5) {
    println(x)
}

for (x in 11..15 step 2) {
    println(x)
}

for (x in 9 downTo 0 step 3) {
    println(x)
}

for (x in 9..0 step 3) {
    println(x)
}

/**
 * collections
 */
when {
    "boy" in items -> println("girl")
    "app" in items -> println("application")
}

val fruits = listOf("apple", "banana", "avocado", "kiwifruit")
fruits
        .filter { it.startsWith("a") }
        .sortedBy { it }
        .map { it.uppercase() }
        .forEach { println(it) }

/**
 * nullable values and null checks
 */