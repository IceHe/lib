function testOverloadSignature2(x: boolean): void;
// Argument type isn't right
function testOverloadSignature2(x: string): void;
// This overload signature is not compatible with its implementation signature.
function testOverloadSignature2(x: boolean) {}
