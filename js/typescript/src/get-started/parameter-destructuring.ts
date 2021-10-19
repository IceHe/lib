function sum1({ a, b, c }) {
  console.log(a + b + c);
}

sum1({ a: 1, b: 2, c: 3 });

function sum2({ a, b, c }: { a: number; b: number; c: number }) {
  console.log(a + b + c);
}

sum2({ a: 1, b: 3, c: 5 });

type ABC = { a: number; b: number; c: number };
function sum3({ a, b, c }: ABC) {
  console.log(a + b + c);
}

sum3({ a: 2, b: 4, c: 6 });
