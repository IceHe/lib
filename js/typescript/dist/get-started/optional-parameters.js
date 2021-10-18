function f(n) {
    console.log(n.toFixed(0));
    console.log(n.toFixed(3));
}
f(1);
function fWithOptionalParameter(x) {
    console.log(x);
}
fWithOptionalParameter();
fWithOptionalParameter(2);
function fWithDefaultParameter(x) {
    if (x === void 0) { x = 6; }
    console.log(x);
}
fWithDefaultParameter();
fWithDefaultParameter(3);
