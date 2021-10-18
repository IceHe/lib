interface Shape {
  kind: 'circle' | 'square';
  radius?: number;
  sideLength?: number;
}

function handleShape(shape: Shape) {
  // Oops!
  if (shape.kind === 'rect') {
    // This condition will always return 'false' since the types '"circle" | "square"' and '"rect"' have no overlap.
    // ...
  }
}

function getArea(shape: Shape) {
  return Math.PI * shape.radius ** 2;
  // Object is possibly 'undefined'.
}

function getArea2(shape: Shape) {
  if (shape.kind === 'circle') {
    return Math.PI * shape.radius ** 2;
    // Object is possibly 'undefined'.
  }
}
