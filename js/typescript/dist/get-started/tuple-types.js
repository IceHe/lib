function f1(pair) {
    console.log(pair);
    var a = pair[0];
    console.log("a=" + a);
    var b = pair[1];
    console.log("b=" + b);
}
f1(['icehe', 123]);
function f2(stringHash) {
    var inputString = stringHash[0], hash = stringHash[1];
    console.log("inputString=" + inputString);
    console.log("hash=" + hash);
}
f2(['abc', 789]);
function setCoordinate(coord) {
    var x = coord[0], y = coord[1], z = coord[2];
    console.log("Provided coordinates had " + coord.length + " dimensions");
    console.log("x=" + x + ", y=" + y + ", z=" + z);
}
setCoordinate([1, 2, 3]);
setCoordinate([4, 5]);
var a = ['ice', 1];
var b = ['he', 2, true, false];
var c = ['study', 2, false, true, false];
console.log(a);
console.log(b);
console.log(c);
function readButtonInput() {
    var args = [];
    for (var _i = 0; _i < arguments.length; _i++) {
        args[_i] = arguments[_i];
    }
    var name = args[0], version = args[1], input = args.slice(2);
    console.log("name=" + name);
    console.log("version=" + version);
    console.log("input=" + input);
}
readButtonInput('xyz', 4, false, true, false);
function readButtonInput2(name, version) {
    var input = [];
    for (var _i = 2; _i < arguments.length; _i++) {
        input[_i - 2] = arguments[_i];
    }
    console.log("name=" + name);
    console.log("version=" + version);
    console.log("input=" + input);
}
readButtonInput2('opq', 8, true, false);
