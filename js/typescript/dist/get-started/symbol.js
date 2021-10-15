var firstName = Symbol('name');
var secondName = Symbol('name');
if (firstName === secondName) {
}
else {
    console.log('`firstName === secondName` is wrong.');
}
