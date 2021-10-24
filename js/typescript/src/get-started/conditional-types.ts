interface Animal {
  live(): void;
}

interface Dog extends Animal {
  woof(): void;
}

type ExampleA = Dog extends Animal ? number : string;
type ExampleB = RegExp extends Animal ? number : string;
