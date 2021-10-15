function example() {
    var x;
    x = Math.random() < 0.5;
    console.log(x);
    if (Math.random() < 0.5) {
        x = 'hello';
        console.log(x);
    }
    else {
        x = 100;
        console.log(x);
    }
    return x;
}
console.log(example());
