function printId(id) {
    console.log("Your ID is: " + id);
}
// OK
printId(101);
// OK
printId("202");
// Error
//printId({ myID: 22342 });
function printNumOrStr(numOrStr) {
    console.log("The content is: " + numOrStr);
}
printNumOrStr(666);
printNumOrStr("icehe.xyz");
