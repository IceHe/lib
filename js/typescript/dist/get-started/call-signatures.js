function doSomething(handle) {
    console.log(handle.description + ' returned ' + handle(6));
}
function function_(argument) {
    return true;
}
function_.description = 'test';
doSomething(function_);
