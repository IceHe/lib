interface NumberDictionary {
  [index: string]: number;

  length: number; // Ok
  name: string;
  // Property 'name' of type 'string' is not assignable to 'string' index type 'number'.
}

interface NumberOrStringDictionary {
  [index: string]: string | number;

  length: number; // Ok, length is a number
  name: string; // Ok, name is a string
}

// Interface ReadonlyStringArray {
//     readonly [index: number]: string;
// }
// above as same as below
type ReadonlyStringArray = Readonly<Record<number, string>>;

const myArray: ReadonlyStringArray = {
  name: 'icehe',
};

console.log(myArray);
