var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var Album = (function () {
    function Album() {
    }
    Album.prototype.setup = function () { };
    return Album;
}());
var MLAlbum = (function (_super) {
    __extends(MLAlbum, _super);
    function MLAlbum() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    MLAlbum.prototype.setup = function () { };
    return MLAlbum;
}(Album));
var SharedAlbum = (function (_super) {
    __extends(SharedAlbum, _super);
    function SharedAlbum() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    SharedAlbum.prototype.setup = function () { };
    return SharedAlbum;
}(Album));
