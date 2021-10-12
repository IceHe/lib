declare type Animal = {
    name: string;
};
declare type Bear = Animal & {
    honey: boolean;
};
declare const bear: Bear;
