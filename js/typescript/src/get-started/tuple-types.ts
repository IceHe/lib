function f1(pair: [string, number]) {
  console.log(pair);

  const a = pair[0];
  console.log(`a=${a}`);

  const b = pair[1];
  console.log(`b=${b}`);

  // Const c = pair[2];
  // Tuple type '[string, number]' of length '2' has no element at index '2'.
}

f1(['icehe', 123]);

function f2(stringHash: [string, number]) {
  const [inputString, hash] = stringHash;

  console.log(`inputString=${inputString}`);
  // Const inputString: string

  console.log(`hash=${hash}`);
  // Const hash: number
}

f2(['abc', 789]);
