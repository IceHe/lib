interface Animal {
    live(): void;
}
interface Dog extends Animal {
    woof(): void;
}
declare type ExampleA = Dog extends Animal ? number : string;
declare type ExampleB = RegExp extends Animal ? number : string;
