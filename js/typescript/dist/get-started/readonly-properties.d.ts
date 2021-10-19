interface Person {
    name: string;
    age: number;
}
interface ReadonlyPerson {
    readonly name: string;
    readonly age: number;
}
declare const writablePerson: Person;
declare const readonlyPerson: ReadonlyPerson;
