interface Circle {
  kind: 'circle';
  radius: number;
}

interface Square {
  kind: 'square';
  sideLength: number;
}

type Shape = Circle | Square;

function getArea(shape: Shape) {
  return Math.PI * shape.radius ** 2;
  // Object is possibly 'undefined'.
}

function getArea2(shape: Shape) {
  if (shape.kind === 'circle') {
    return Math.PI * shape.radius ** 2;
    // (parameter) shape: Circle
  }
}

function getArea3(shape: Shape) {
  switch (shape.kind) {
    case 'circle':
      return Math.PI * shape.radius ** 2;
    case 'square':
      return shape.sideLength ** 2;
    default:
      const _exhaustiveCheck: never = shape;
      return _exhaustiveCheck;
  }
}

interface Triangle {
  kind: 'triangle';
  sideLength: number;
}

type Shape2 = Circle | Square | Triangle;
