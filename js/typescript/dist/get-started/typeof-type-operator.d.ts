declare const s = "hello";
declare type Predicate = (x: unknown) => boolean;
declare type P = ReturnType<typeof f>;
declare const p: P;
