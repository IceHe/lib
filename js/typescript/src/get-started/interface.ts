interface Point {
  x: number;
  y: number;
}

// Exactly the same as the earlier example
function printCoordinate(point: Point) {
  console.log("The coordinate's x value is " + point.x);
  console.log("The coordinate's y value is " + point.y);
}

printCoordinate({ x: 100, y: 50 });
