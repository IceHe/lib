function getLength(x) {
    return x.length;
}
console.log(getLength(''));
console.log(getLength([0]));
console.log(getLength(Math.random() > 0.5 ? 'hello' : [0]));
