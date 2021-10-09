function printAll(strs: string | string[] | null) {
  if (typeof strs === 'object') {
    for (const s of strs) {
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
