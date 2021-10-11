function testStrictFunctionTypes(x) {
    console.log('Hello, ' + x.toLocaleLowerCase());
}
// Unsafe assignment
var testFunction = testStrictFunctionTypes;
// Unsafe call - will crash
testFunction(10);
