interface Box<Type> {
    contents: Type;
}
declare const stringBox: Box<string>;
declare const numberBox: Box<number>;
