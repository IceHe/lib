function getLength(x: any[] | string) {
  return x.length;
}

console.log(getLength('')); // OK
console.log(getLength([0])); // OK
console.log(getLength(Math.random() > 0.5 ? 'hello' : [0]));
