function testOverloadSignature(x: string): void;
function testOverloadSignature() {
  // ...
}

// Expected to be able to call with zero arguments
testOverloadSignature();
// Expected 1 arguments, but got 0.
