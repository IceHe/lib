declare function sum1({ a, b, c }: {
    a: any;
    b: any;
    c: any;
}): void;
declare function sum2({ a, b, c }: {
    a: number;
    b: number;
    c: number;
}): void;
declare type ABC = {
    a: number;
    b: number;
    c: number;
};
declare function sum3({ a, b, c }: ABC): void;
