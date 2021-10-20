function getProperty<Type, Key extends keyof Type>(object: Type, key: Key) {
  return object[key];
}

const x = { a: 1, b: 2, c: 3, d: 4 };

console.log(getProperty(x, 'a'));
console.log(getProperty(x, 'z'));
