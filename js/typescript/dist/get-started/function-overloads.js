function makeDate(monthOrTimestamp, day, year) {
    if (day !== undefined && year !== undefined) {
        return new Date(monthOrTimestamp, day, year);
    }
    if (day !== undefined) {
        return new Date(monthOrTimestamp, day);
    }
    return new Date(monthOrTimestamp);
}
var day1 = makeDate(12345678);
var day2 = makeDate(10, 7, 2021);
console.log(day1);
console.log(day2);
