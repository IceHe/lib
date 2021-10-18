function handleShape(shape) {
    if (shape.kind === 'rect') {
    }
}
function getArea(shape) {
    return Math.PI * Math.pow(shape.radius, 2);
}
function getArea2(shape) {
    if (shape.kind === 'circle') {
        return Math.PI * Math.pow(shape.radius, 2);
    }
}
