function multiply(n: number, ...m: number[]): number[] {
  return m.map((x) => x * n);
}

const a: number[] = multiply(10, 1, 2, 3, 4, 5);
console.log(a);
