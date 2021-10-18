function longest<Type extends { length: number }>(a: Type, b: Type) {
  if (a.length >= b.length) {
    return a;
  }

  return b;
}

console.log(longest([4, 5], [1, 2, 3]));
console.log(longest('apple', 'ice'));
// Console.log(longest(10, 1000));
