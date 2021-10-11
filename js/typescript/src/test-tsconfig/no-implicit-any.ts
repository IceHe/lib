function testNoExplicitAny(s) {
  console.log(s.subtr(3));
  // Unsafe call of an `any` typed value.
}

testNoExplicitAny(42);
