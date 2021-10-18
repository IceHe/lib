declare type SomeObject = {
    num: number;
    str: string;
};
declare type SomeConstructor = {
    (n: number): SomeObject;
    new (s: string): SomeObject;
};
