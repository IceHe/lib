function doStuff(values: readonly string[]) {
  // We can read from 'values'...
  const copy = values.slice();
  console.log(copy);
  console.log(`The first value is ${copy[0]}.`);

  // ...but we can't mutate 'values'.
  // values.push('hello!');
  // Property 'push' does not exist on type 'readonly string[]'.
}

doStuff(['ice', 'he']);
