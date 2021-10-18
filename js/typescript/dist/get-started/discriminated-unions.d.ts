interface Shape {
    kind: 'circle' | 'square';
    radius?: number;
    sideLength?: number;
}
declare function handleShape(shape: Shape): void;
