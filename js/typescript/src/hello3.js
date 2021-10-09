// This is an industrial-grade general-purpose greeter function:
function greet(person, date) {
  console.log('Hello ' + person + ', today is ' + date.toDateString() + '!');
}

greet('Brendan', new Date());
