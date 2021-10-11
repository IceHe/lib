function testStrictBindCallApply(x: string) {
  return Number.parseInt(x);
}

const n1 = testStrictBindCallApply.call(undefined, '10');

const n2 = testStrictBindCallApply.call(undefined, false);
// Argument of type 'boolean' is not assignable to parameter of type 'string'.
