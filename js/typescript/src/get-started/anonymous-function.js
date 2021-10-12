// No type annotations here, but TypeScript can spot the bug
const names = ['Alice', 'Bob', 'Eve'];
// Contextual typing for function
for (let _i = 0, names_1 = names; _i < names_1.length; _i++) {
  var s = names_1[_i];
  console.log(s.toUpperCase());
}

// Contextual typing also applies to arrow functions
for (let _a = 0, names_2 = names; _a < names_2.length; _a++) {
  var s = names_2[_a];
  console.log(s.toUpperCase());
}

// Testing
const strs = ['Ice', 'He', 'Lib'];
for (let _b = 0, strs_1 = strs; _b < strs_1.length; _b++) {
  const string = strs_1[_b];
  console.log(string.toLowerCase());
}
