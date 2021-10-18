function doSomething(handle) {
    console.log(handle.description + ' returned ' + handle(6));
}
function testOverloadSignature(argument) {
    return true;
}
testOverloadSignature.description = 'test';
doSomething(testOverloadSignature);
