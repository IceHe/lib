function doStuff(values) {
    var copy = values.slice();
    console.log(copy);
    console.log("The first value is " + copy[0] + ".");
}
doStuff(['ice', 'he']);
