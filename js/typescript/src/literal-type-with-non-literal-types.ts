interface Options {
    width: number;
}
function configure(x: Options | "auto") {
    console.log(x);
}

configure({ width: 100 });
configure("auto");
// configure("automatic");
