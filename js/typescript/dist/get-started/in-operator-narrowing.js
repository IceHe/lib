"use strict";
function move(animal) {
    if ('swim' in animal) {
        animal.swim();
        return;
    }
    animal.fly();
}
//# sourceMappingURL=in-operator-narrowing.js.map