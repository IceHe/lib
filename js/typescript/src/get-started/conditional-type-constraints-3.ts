type Flatten<T> = T extends any[] ? T[number] : T;

type String_ = Flatten<string[]>;
type Number_ = Flatten<number>;

const s: String_ = 'icehe';
const n: Number_ = 666;

console.log(s);
console.log(n);
