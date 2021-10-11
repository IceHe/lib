// Optional Properties
function printName(object) {
  console.log(object.first.toUpperCase());
  // Error - might crash if 'obj.last' wasn't provided!
  if (object.last !== undefined) {
    // OK
    console.log(object.last.toUpperCase());
  }
  // A safe alternative using modern JavaScript syntax:
  // console.log(obj.last?.toUpperCase());
}

printName({ first: 'Bob' });
printName({ first: 'Ice', last: 'He' });
