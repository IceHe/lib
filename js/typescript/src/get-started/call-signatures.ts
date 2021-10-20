type DescribableFunction = {
  description: string;
  (someArgument: number): boolean;
};

function f1(handle: DescribableFunction) {
  console.log(handle.description + ' returned ' + handle(6));
}

// TODO / FIXME : 还是没有成功声明出一个可以调用的函数
function testOverloadSignature(argument: number) {
  return true;
}

testOverloadSignature.description = 'test';

f1(testOverloadSignature);
