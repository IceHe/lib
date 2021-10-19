var writablePerson = {
    name: 'icehe',
    age: 29
};
var readonlyPerson = writablePerson;
console.log(readonlyPerson);
writablePerson.age++;
readonlyPerson.age++;
console.log(readonlyPerson);
