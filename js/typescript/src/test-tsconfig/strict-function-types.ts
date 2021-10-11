function testStrictFunctionTypes(x: string) {
  console.log('Hello, ' + x.toLocaleLowerCase());
}

type StringOrNumberFunction = (ns: string | number) => void;

// Unsafe assignment
const testFunction: StringOrNumberFunction = testStrictFunctionTypes;
// Unsafe call - will crash
testFunction(10);
