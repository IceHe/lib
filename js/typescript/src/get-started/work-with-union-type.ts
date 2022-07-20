function printId(id: number | string) {
  if (typeof id === 'string') {
    // In this branch, id is of type 'string'
    console.log(id.toUpperCase());
  } else {
    // Here, id is of type 'number'
    console.log(id);
  }
}

// OK
printId(101);
// OK
printId('202');
// Error
// printId({ myID: 22342 });

function printNumberOrString(numberOrString: number | string) {
  if (typeof numberOrString === 'string') {
    // In this branch, id is of type 'string'
    console.log(numberOrString.toUpperCase());
  } else {
    // Here, id is of type 'number'
    console.log(numberOrString);
  }
}

printNumberOrString(666);
printNumberOrString('icehe.life');

function welcomePeople(people: string[] | string) {
  if (Array.isArray(people)) {
    // Here: 'x' is 'string[]'
    console.log('Hello, ' + people.join(' and '));
  } else {
    // Here: 'x' is 'string'
    console.log('Welcom lone traveler ' + people);
  }
}

welcomePeople(['IceHe', 'Alice', 'Bob']);
welcomePeople('IceHe');
