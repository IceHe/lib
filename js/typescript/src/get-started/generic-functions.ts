function firstElement<Type>(array: Type[]): Type | undefined {
  return array[0];
}

console.log(firstElement([]));
console.log(firstElement([1, 2, 3]));
console.log(firstElement(['a', 'b', 'c']));
