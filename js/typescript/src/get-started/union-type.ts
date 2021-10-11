function printId(id: number | string) {
  console.log('Your ID is: ' + id);
}

// OK
printId(101);
// OK
printId('202');
// Error
// printId({ myID: 22342 });

function printNumberOrString(numberOrString: number | string) {
  console.log(`The content is: ${numberOrString}`);
}

printNumberOrString(666);
printNumberOrString('icehe.xyz');
