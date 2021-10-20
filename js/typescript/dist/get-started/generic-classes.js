var GenericNumber = (function () {
    function GenericNumber() {
    }
    return GenericNumber;
}());
var myGenericNumber = new GenericNumber();
myGenericNumber.zeroValue = 0;
myGenericNumber.add = function (x, y) {
    return x + y;
};
console.log(myGenericNumber.add(myGenericNumber.zeroValue, 123));
var stringNumeric = new GenericNumber();
stringNumeric.zeroValue = '';
stringNumeric.add = function (x, y) {
    return x + y;
};
console.log(stringNumeric.add(stringNumeric.zeroValue, 'test'));
