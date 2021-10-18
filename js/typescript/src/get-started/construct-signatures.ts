type SomeObject = {
  num: number;
  str: string;
};

type SomeConstructor = {
  (n: number): SomeObject;
  new (s: string): SomeObject;
};

// Console.log(SomeConstructor(123));
console.log(new SomeConstructor('test'));
