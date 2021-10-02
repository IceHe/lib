function printId(id: number | string) {
    if (typeof id === "string") {
      // In this branch, id is of type 'string'
      console.log(id.toUpperCase());
    } else {
      // Here, id is of type 'number'
      console.log(id);
    }
}

// OK
printId(101);
// OK
printId("202");
// Error
//printId({ myID: 22342 });

function printNumOrStr(numOrStr: number | string) {
    if (typeof numOrStr === "string") {
      // In this branch, id is of type 'string'
      console.log(numOrStr.toUpperCase());
    } else {
      // Here, id is of type 'number'
      console.log(numOrStr);
    }
}

printNumOrStr(666);
printNumOrStr("icehe.xyz");

function welcomePeople(people: string[] | string) {
    if (Array.isArray(people)) {
        // Here: 'x' is 'string[]'
        console.log("Hello, " + people.join(" and "));
    } else {
        // Here: 'x' is 'string'
        console.log("Welcom lone traveler " + people);
    }
}

welcomePeople(["IceHe", "Alice", "Bob"]);
welcomePeople("IceHe");
