function geeter(welcome: (a: string) => void) {
  welcome('IceHe');
}

function hello(string: string) {
  console.log('Hello, ' + string + '!');
}

geeter(hello);
