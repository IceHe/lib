function map(array, converter) {
    return converter(array[0]);
}
console.log(map(['123', '456', '789'], function (numberString) { return Number.parseInt(numberString, 10); }));
