function move(animal) {
    if ('swim' in animal) {
        animal.swim();
        return;
    }
    animal.fly();
}
move({
    swim: function () {
        console.log('swimming');
    }
});
move({
    fly: function () {
        console.log('flying');
    }
});
