var writablePerson = {
    name: 'icehe',
    age: 29
};
var readonlyPerson = writablePerson;
console.log(readonlyPerson);
writablePerson.age++;
readonlyPersoN.age++;
console.log(readonlyPerson);
