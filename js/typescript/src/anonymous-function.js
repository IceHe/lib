// No type annotations here, but TypeScript can spot the bug
var names = ["Alice", "Bob", "Eve"];
// Contextual typing for function
names.forEach(function(s) {
  console.log(s.toUpperCase());
});
// Contextual typing also applies to arrow functions
names.forEach(function(s) {
  console.log(s.toUpperCase());
});
var strs = ["Ice", "He", "Lib"];
strs.forEach(function(str) {
  console.log(str.toLowerCase());
});