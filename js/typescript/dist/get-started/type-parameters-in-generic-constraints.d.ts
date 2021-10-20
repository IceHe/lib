declare function getProperty<Type, Key extends keyof Type>(object: Type, key: Key): Type[Key];
declare const x: {
    a: number;
    b: number;
    c: number;
    d: number;
};
