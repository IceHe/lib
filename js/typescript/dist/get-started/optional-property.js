function printName(object) {
    console.log(object.first.toUpperCase());
    if (object.last !== undefined) {
        console.log(object.last.toUpperCase());
    }
}
printName({ first: 'Bob' });
printName({ first: 'Ice', last: 'He' });
//# sourceMappingURL=optional-property.js.map