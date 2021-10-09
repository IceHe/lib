function compare(a: string, b: string): -1 | 0 | 1 {
  return a === b ? 0 : a > b ? 1 : -1;
}

console.log(compare('a', 'abc'));
console.log(compare('666', '666'));
console.log(compare('ice', 'he'));
