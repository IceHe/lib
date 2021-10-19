interface Box<Type> {
  contents: Type;
}

const stringBox: Box<string> = {
  contents: 'icehe',
};
console.log(stringBox);

const numberBox: Box<number> = {
  contents: 123,
};
console.log(numberBox);
