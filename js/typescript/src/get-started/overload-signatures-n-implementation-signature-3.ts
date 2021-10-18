function testOverloadSignature3(x: string): string;
// Return type isn't right
function testOverloadSignature3(x: number): boolean;
// This overload signature is not compatible with its implementation signature.
function testOverloadSignature3(x: string | number) {
  return 'oops';
}
