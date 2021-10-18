function map<Input, Output>(array: Input[], converter: (i: Input) => Output) {
  return converter(array[0]);
}

console.log(
  map(['123', '456', '789'], (numberString: string) => Number.parseInt(numberString, 10))
);
