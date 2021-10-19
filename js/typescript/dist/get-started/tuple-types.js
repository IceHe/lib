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
