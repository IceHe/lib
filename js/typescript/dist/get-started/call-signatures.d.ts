declare type DescribableFunction = {
    description: string;
    (someArgument: number): boolean;
};
declare function doSomething(handle: DescribableFunction): void;
