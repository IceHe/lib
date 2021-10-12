declare function testStrictFunctionTypes(x: string): void;
declare type StringOrNumberFunction = (ns: string | number) => void;
declare const testFunction: StringOrNumberFunction;
