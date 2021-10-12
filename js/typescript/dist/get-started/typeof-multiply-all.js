"use strict";
function multiplyAll(values, factor) {
    if (!values) {
        return values;
    }
    return values.map((x) => x * factor);
}
console.log(multiplyAll([1, 2, 3], 3));
console.log(multiplyAll(undefined, 3));
console.log(multiplyAll(null, 3));
console.log(multiplyAll([], 3));
//# sourceMappingURL=typeof-multiply-all.js.map