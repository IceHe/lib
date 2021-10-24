declare type Flatten<T> = T extends any[] ? T[number] : T;
declare type String_ = Flatten<string[]>;
declare type Number_ = Flatten<number>;
declare const s: String_;
declare const n: Number_;
