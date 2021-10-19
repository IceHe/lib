function f1(u: unknown) {
  return u.length;
}

console.log(f1([1, 2, 3]));
console.log(f1('icehe'));
console.log(f1(45));
