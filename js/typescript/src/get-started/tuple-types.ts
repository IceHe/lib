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

// Interface StringNumberPair {
//   // Specialized properties
//   length: 2;
//   0: string;
//   1: number;

//   // Other 'Array<string | number>' members...
//   slice(start?: number, end?: number): Array<string | number>;
// }

type Either2dOr3d = [number, number, number?];

function setCoordinate(coord: Either2dOr3d) {
  const [x, y, z] = coord;
  // Const z: number | undefined

  console.log(`Provided coordinates had ${coord.length} dimensions`);
  console.log(`x=${x}, y=${y}, z=${z}`);
  // (property) length: 2 | 3
}

setCoordinate([1, 2, 3]);
setCoordinate([4, 5]);

type StringNumberBooleans = [string, number, ...boolean[]];
type StringBooleansNumber = [string, ...boolean[], number];
type BooleansStringNumber = [...boolean[], string, number];

const a: StringNumberBooleans = ['ice', 1];
const b: StringNumberBooleans = ['he', 2, true, false];
const c: StringNumberBooleans = ['study', 2, false, true, false];

console.log(a);
console.log(b);
console.log(c);

function readButtonInput(...args: [string, number, ...boolean[]]) {
  const [name, version, ...input] = args;
  console.log(`name=${name}`);
  console.log(`version=${version}`);
  console.log(`input=${input}`);
}

readButtonInput('xyz', 4, false, true, false);

function readButtonInput2(name: string, version: number, ...input: boolean[]) {
  console.log(`name=${name}`);
  console.log(`version=${version}`);
  console.log(`input=${input}`);
}

readButtonInput2('opq', 8, true, false);
