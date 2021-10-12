function printId(id) {
    if (typeof id === 'string') {
        console.log(id.toUpperCase());
    }
    else {
        console.log(id);
    }
}
printId(101);
printId('202');
function printNumberOrString(numberOrString) {
    if (typeof numberOrString === 'string') {
        console.log(numberOrString.toUpperCase());
    }
    else {
        console.log(numberOrString);
    }
}
printNumberOrString(666);
printNumberOrString('icehe.xyz');
function welcomePeople(people) {
    if (Array.isArray(people)) {
        console.log('Hello, ' + people.join(' and '));
    }
    else {
        console.log('Welcom lone traveler ' + people);
    }
}
welcomePeople(['IceHe', 'Alice', 'Bob']);
welcomePeople('IceHe');
//# sourceMappingURL=work-with-union-type.js.map