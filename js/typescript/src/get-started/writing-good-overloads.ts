function getLength(s: string): number;
function getLength(array: any[]): number;
function getLength(x: any) {
  return x.length;
}

getLength(''); // OK
getLength([0]); // OK
getLength(Math.random() > 0.5 ? 'hello' : [0]);
