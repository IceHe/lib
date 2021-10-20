function logIdentity<Type>(argument: Type): Type {
  console.log(argument.length);
  // Property 'length' does not exist on type 'Type'.
  return argument;
}

function logIdentity2<Type>(argument: Type[]): Type[] {
  console.log(argument.length);
  // Property 'length' does not exist on type 'Type'.
  return argument;
}

function identity<Type>(argument: Type): Type {
  return argument;
}

const myIdentity: <Type>(argument: Type) => Type = identity;
// Const myIdentity3: { <Type>(argument: Type): Type } = identity;
// Above as same as below
const myIdentity2: <Input>(argument: Input) => Input = identity;

// Interface GenericIdentityFunction {
//   <Type>(arg: Type): Type;
// }
// Above as same as below
type GenericIdentityFunction = <Type>(argument: Type) => Type;
const myIdentity4: GenericIdentityFunction = identity;

// Interface GenericIdentityFunction2<Type> {
//   (arg: Type): Type;
// }
// Above as same as below
type GenericIdentityFunction2<Type> = (argument: Type) => Type;
const myIdentity5: GenericIdentityFunction2 = identity;
