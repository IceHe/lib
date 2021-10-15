var x = Math.random() < 0.5 ? 10 : 'hello world!';
// Let x: string | number
x = 1;
console.log(x);
// Let x: number
x = true;
// Type 'boolean' is not assignable to type 'string | number'.
console.log(x);
// Let x: string | number
