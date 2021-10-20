type Person = { age: number; name: string; alive: boolean };
type Age = Person['age'];
// Type Age = number
const age: Age = 29;
console.log(age);

type I1 = Person['age' | 'name'];
// Type I1 = number | string
const i1a: I1 = 12;
const i1b: I1 = '34';
// Const i1c: I1 = new Date();
console.log(i1a);
console.log(i1b);
// Console.log(i1c);

type I2 = Person[keyof Person];
// Type I2 = number | string | boolean
const i2a: I2 = 12;
const i2b: I2 = '34';
const i2c: I2 = false;
// Const i2d: I2 = new Date();
console.log(i2a);
console.log(i2b);
console.log(i2c);
// Console.log(i2d);

type AliveOrName = 'alive' | 'name';
type I3 = Person[AliveOrName];
const i3a: I3 = true;
const i3b: I3 = '90';
// Const i3c: I3 = 78;
console.log(i3a);
console.log(i3b);
// Console.log(i3c);
