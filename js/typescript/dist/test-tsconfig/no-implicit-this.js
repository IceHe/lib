var Rectangle = (function () {
    function Rectangle(width, height) {
        this.width = width;
        this.height = height;
    }
    Rectangle.prototype.getAreaFunction = function () {
        return function () {
            return this.width * this.height;
        };
    };
    return Rectangle;
}());
//# sourceMappingURL=no-implicit-this.js.map