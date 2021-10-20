console.log(typeof 'abc');

const s = 'hello';
// Const a: typeof s = 'def';
// Type '"def"' is not assignable to type '"hello"'.
// console.log(a);

type Predicate = (x: unknown) => boolean;
// Type K = ReturnType<Predicate>;

function f() {
  return { x: 10, y: 3 };
}

type P = ReturnType<typeof f>;

const p: P = {
  x: 12,
  y: 34,
};
console.log(p);
