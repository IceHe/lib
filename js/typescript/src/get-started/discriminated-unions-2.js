function getArea(shape) {
    return Math.PI * Math.pow(shape.radius, 2);
    // Object is possibly 'undefined'.
}
function getArea2(shape) {
    if (shape.kind === 'circle') {
        return Math.PI * Math.pow(shape.radius, 2);
        // (parameter) shape: Circle
    }
}
function getArea3(shape) {
    switch (shape.kind) {
        case 'circle':
            return Math.PI * Math.pow(shape.radius, 2);
        case 'square':
            return Math.pow(shape.sideLength, 2);
        default:
            var _exhaustiveCheck = shape;
            return _exhaustiveCheck;
    }
}
