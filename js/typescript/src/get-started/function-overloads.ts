function makeDate(timestamp: number): Date;
function makeDate(month: number, day: number, year: number): Date;
function makeDate(monthOrTimestamp: number, day?: number, year?: number): Date {
  if (day !== undefined && year !== undefined) {
    return new Date(monthOrTimestamp, day, year);
  }

  if (day !== undefined) {
    return new Date(monthOrTimestamp, day);
  }

  return new Date(monthOrTimestamp);
}

const day1 = makeDate(12_345_678);
const day2 = makeDate(10, 7, 2021);
// Const day3 = makeDate(10, 7);
// No overload expects 2 arguments, but overloads do exist that expect either 1 or 3 arguments.

console.log(day1);
console.log(day2);
// Console.log(day3);
