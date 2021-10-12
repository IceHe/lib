function testStrictBindCallApply(x) {
    return Number.parseInt(x);
}
var n1 = testStrictBindCallApply.call(undefined, '10');
var n2 = testStrictBindCallApply.call(undefined, false);
//# sourceMappingURL=strict-bind-call-apply.js.map