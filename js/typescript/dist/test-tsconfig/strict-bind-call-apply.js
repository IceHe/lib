"use strict";
function testStrictBindCallApply(x) {
    return Number.parseInt(x);
}
const n1 = testStrictBindCallApply.call(undefined, '10');
const n2 = testStrictBindCallApply.call(undefined, false);
//# sourceMappingURL=strict-bind-call-apply.js.map