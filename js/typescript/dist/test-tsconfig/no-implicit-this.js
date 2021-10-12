"use strict";
class Rectangle {
    constructor(width, height) {
        this.width = width;
        this.height = height;
    }
    getAreaFunction() {
        return function () {
            return this.width * this.height;
        };
    }
}
//# sourceMappingURL=no-implicit-this.js.map