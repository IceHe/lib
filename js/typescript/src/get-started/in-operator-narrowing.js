function move(animal) {
    if ('swim' in animal) {
        animal.swim();
        return;
    }
    animal.fly();
}
