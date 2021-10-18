declare type DescribableFunction = {
    description: string;
    (someArgument: number): boolean;
};
declare function doSomething(handle: DescribableFunction): void;
declare function function_(argument: number): boolean;
declare namespace function_ {
    var description: string;
}
