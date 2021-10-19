function multiply(n) {
    var m = [];
    for (var _i = 1; _i < arguments.length; _i++) {
        m[_i - 1] = arguments[_i];
    }
    return m.map(function (x) { return x * n; });
}
var a = multiply(10, 1, 2, 3, 4, 5);
console.log(a);
