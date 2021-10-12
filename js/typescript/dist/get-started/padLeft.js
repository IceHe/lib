"use strict";
function padLeft(padding, input) {
    if (typeof padding === 'number') {
        return new Array(padding + 1).join(' ') + input;
    }
    return padding + input;
}
console.log(padLeft(3, 'IceHe'));
console.log(padLeft('Seen ', 'IceHe'));
//# sourceMappingURL=padLeft.js.map