function printAll(strs) {
    if (typeof strs === 'object') {
        for (var _i = 0, strs_1 = strs; _i < strs_1.length; _i++) {
            var s = strs_1[_i];
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