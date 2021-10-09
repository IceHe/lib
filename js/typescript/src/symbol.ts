const firstName = Symbol('name');
const secondName = Symbol('name');

if (firstName === secondName) {
  // Can't ever happen
} else {
  console.log('`firstName === secondName` is wrong.');
}
