interface Animal {
  name: string;
}
interface Bear extends Animal {
  honey: boolean;
}
declare const bear: Bear;
