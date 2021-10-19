interface Person {
  name: string;
  age: number;
}

interface ReadonlyPerson {
  readonly name: string;
  readonly age: number;
}

const writablePerson: Person = {
  name: 'icehe',
  age: 29,
};

const readonlyPerson: ReadonlyPerson = writablePerson;

console.log(readonlyPerson);
writablePerson.age++;
readonlyPersoN.age++;
console.log(readonlyPerson);
