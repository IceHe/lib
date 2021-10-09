function printAll(strs) {
  if (typeof strs === 'object') {
    for (let _i = 0, strs_1 = strs; _i < strs_1.length; _i++) {
      const s = strs_1[_i];
      console.log(s);
    }
  } else if (typeof strs === 'string') {
    console.log(strs);
  } else {
    // Do nothing
  }
}

printAll('ice');
printAll(['ice', 'he']);
printAll('null');
printAll(['abc', null]);
