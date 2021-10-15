function example() {
  let x: string | number | boolean;

  x = Math.random() < 0.5;
  console.log(x);
  // Let x: boolean

  if (Math.random() < 0.5) {
    x = 'hello';
    console.log(x);
    // Let x: string
  } else {
    x = 100;
    console.log(x);
    // Let x: number
  }

  return x;
  // Let x: string | number
}

console.log(example());
