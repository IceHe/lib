declare class GenericNumber<NumberType> {
    zeroValue: NumberType;
    add: (x: NumberType, y: NumberType) => NumberType;
}
declare const myGenericNumber: GenericNumber<number>;
declare const stringNumeric: GenericNumber<string>;
