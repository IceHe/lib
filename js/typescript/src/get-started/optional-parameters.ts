function f(n: number) {
  console.log(n.toFixed(0)); // 0 arguments
  console.log(n.toFixed(3)); // 1 argument
}

f(1);

function fWithOptionalParameter(x?: number) {
  console.log(x);
}

fWithOptionalParameter();
fWithOptionalParameter(2);

function fWithDefaultParameter(x = 6) {
  console.log(x);
}

fWithDefaultParameter();
fWithDefaultParameter(3);
