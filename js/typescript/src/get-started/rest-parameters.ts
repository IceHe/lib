function multiply(n: number, ...m: number[]): number[] {
  return m.map((x) => x * n);
}

const a: number[] = multiply(10, 1, 2, 3, 4, 5);
console.log(a);

const b: number[] = multiply(6, ...[1, 3, 5, 7, 9]);
console.log(b);
