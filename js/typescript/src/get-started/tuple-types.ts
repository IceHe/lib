function doSomething(pair: [string, number]) {
  console.log(pair);

  const a = pair[0];
  console.log(`a=${a}`);

  const b = pair[1];
  console.log(`b=${b}`);

  // Const c = pair[2];
  // Tuple type '[string, number]' of length '2' has no element at index '2'.
}

doSomething(['icehe', 123]);
