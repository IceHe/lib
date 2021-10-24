declare type NameOrId<T extends string | number> = T extends string ? NameLabel : IdLabel;
declare const a: IdLabel | NameLabel;
declare const b: IdLabel | NameLabel;
declare const c: IdLabel | NameLabel;
