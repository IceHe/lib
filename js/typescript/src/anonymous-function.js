// No type annotations here, but TypeScript can spot the bug
const names = ['Alice', 'Bob', 'Eve'];
// Contextual typing for function
for (const s of names) {
  console.log(s.toUpperCase());
}

// Contextual typing also applies to arrow functions
for (const s of names) {
  console.log(s.toUpperCase());
}

const strs = ['Ice', 'He', 'Lib'];
for (const string of strs) {
  console.log(string.toLowerCase());
}
