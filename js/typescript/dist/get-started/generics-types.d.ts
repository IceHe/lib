declare function logIdentity<Type>(argument: Type): Type;
declare function logIdentity2<Type>(argument: Type[]): Type[];
declare function identity<Type>(argument: Type): Type;
declare const myIdentity: <Type>(argument: Type) => Type;
declare const myIdentity2: <Input>(argument: Input) => Input;
declare type GenericIdentityFunction = <Type>(argument: Type) => Type;
declare const myIdentity4: GenericIdentityFunction;
declare type GenericIdentityFunction2<Type> = (argument: Type) => Type;
declare const myIdentity5: GenericIdentityFunction2;
