type Point = { x: number; y: number };
type P = keyof Point;

const point: Point = { x: 1, y: 1 };
const p: P = 'x';
// Const p2: P = 2;

console.log(point);
console.log(p);
// Console.log(p2);
