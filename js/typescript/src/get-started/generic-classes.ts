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
