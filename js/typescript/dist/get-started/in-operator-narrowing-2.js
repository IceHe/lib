function move(animal) {
    if ('swim' in animal) {
        animal.swim();
    }
    else if ('fly' in animal) {
        animal.fly();
    }
}
move({
    fly: function () {
        console.log('flying');
    }
});
move({
    swim: function () {
        console.log('swimming');
    }
});
