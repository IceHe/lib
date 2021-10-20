function f1(pair: readonly [string, number]) {
  console.log(pair[0]);
  console.log(pair[1]);
}

f1(['icehe', 666]);

function distanceFromOrigin([x, y]: [number, number]) {
  return Math.sqrt(x ** 2 + y ** 2);
}

// Const point = [3, 4] as const;
// distanceFromOrigin(point);
// Argument of type 'readonly [3, 4]' is not assignable to parameter of type '[number, number]'.
//   The type 'readonly [3, 4]' is 'readonly' and cannot be assigned to the mutable type '[number, number]'.

distanceFromOrigin([3, 4]);
