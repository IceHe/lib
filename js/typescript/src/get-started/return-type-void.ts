type voidFunction = () => void;

const f1: voidFunction = () => {
  return true;
};

const f2: voidFunction = () => false;

const f3: voidFunction = function () {
  return 3;
};

console.log(f1());
console.log(f2());
console.log(f3());
