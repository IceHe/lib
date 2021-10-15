function move(animal) {
    if ('swim' in animal) {
        animal.swim();
        return;
    }
    animal.fly();
}
function getSwimmingAnimal() {
    return {
        swim: function () {
            console.log('swimming');
        }
    };
}
move(getSwimmingAnimal());
