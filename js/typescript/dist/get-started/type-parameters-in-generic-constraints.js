function getProperty(object, key) {
    return object[key];
}
var x = { a: 1, b: 2, c: 3, d: 4 };
console.log(getProperty(x, 'a'));
console.log(getProperty(x, 'z'));
