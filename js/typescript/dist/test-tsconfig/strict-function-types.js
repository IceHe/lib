function testStrictFunctionTypes(x) {
    console.log('Hello, ' + x.toLocaleLowerCase());
}
var testFunction = testStrictFunctionTypes;
testFunction(10);
