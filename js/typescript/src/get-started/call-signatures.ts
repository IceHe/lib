type DescribableFunction = {
  description: string;
  (someArgument: number): boolean;
};

function doSomething(handle: DescribableFunction) {
  console.log(handle.description + ' returned ' + handle(6));
}

// TODO / FIXME : 还是没有成功声明出一个可以调用的函数
function function_(argument: number) {
  return true;
}

function_.description = 'test';

doSomething(function_);
