"use strict";
function printAll(strs) {
    if (typeof strs === 'object') {
        for (const s of strs) {
            console.log(s);
        }
    }
    else if (typeof strs === 'string') {
        console.log(strs);
    }
    else {
    }
}
printAll('ice');
printAll(['ice', 'he']);
printAll('null');
printAll(['abc', null]);
//# sourceMappingURL=typeof-print-all.js.map