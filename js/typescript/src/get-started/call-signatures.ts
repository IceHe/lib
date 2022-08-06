type DescribableFunction = {
  description: string;
  (someArgument: number): boolean;
};

function fun1(handle: DescribableFunction) {
  console.log(handle.description + ' returned ' + handle(6));
}

function testOverloadSignature1(argument: number) {
  return true;
}

testOverloadSignature1.description = 'test';

fun1(testOverloadSignature1);
