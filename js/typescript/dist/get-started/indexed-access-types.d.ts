declare type Person = {
    age: number;
    name: string;
    alive: boolean;
};
declare type Age = Person['age'];
declare const age: Age;
declare type I1 = Person['age' | 'name'];
declare const i1a: I1;
declare const i1b: I1;
declare type I2 = Person[keyof Person];
declare const i2a: I2;
declare const i2b: I2;
declare const i2c: I2;
declare type AliveOrName = 'alive' | 'name';
declare type I3 = Person[AliveOrName];
declare const i3a: I3;
declare const i3b: I3;
