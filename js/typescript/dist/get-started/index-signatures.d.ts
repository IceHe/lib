interface NumberDictionary {
    [index: string]: number;
    length: number;
    name: string;
}
interface NumberOrStringDictionary {
    [index: string]: string | number;
    length: number;
    name: string;
}
declare type ReadonlyStringArray = Readonly<Record<number, string>>;
declare const myArray: ReadonlyStringArray;
