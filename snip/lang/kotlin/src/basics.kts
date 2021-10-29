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
