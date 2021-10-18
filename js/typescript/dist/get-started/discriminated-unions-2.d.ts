interface Circle {
    kind: 'circle';
    radius: number;
}
interface Square {
    kind: 'square';
    sideLength: number;
}
declare type Shape = Circle | Square;
declare function getArea3(shape: Shape): number;
interface Triangle {
    kind: 'triangle';
    sideLength: number;
}
declare type Shape2 = Circle | Square | Triangle;
