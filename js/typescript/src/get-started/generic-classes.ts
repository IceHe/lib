class GenericNumber<NumberType> {
  zeroValue: NumberType;
  add: (x: NumberType, y: NumberType) => NumberType;
}

const myGenericNumber = new GenericNumber<number>();
myGenericNumber.zeroValue = 0;
myGenericNumber.add = function (x: number, y: number) {
  return x + y;
};

console.log(myGenericNumber.add(myGenericNumber.zeroValue, 123));

const stringNumeric = new GenericNumber<string>();
stringNumeric.zeroValue = '';
stringNumeric.add = function (x, y) {
  return x + y;
};

console.log(stringNumeric.add(stringNumeric.zeroValue, 'test'));
