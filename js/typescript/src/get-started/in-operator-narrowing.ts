type Fish = { swim: () => void };
type Bird = { fly: () => void };

function move(animal: Fish | Bird) {
  if ('swim' in animal) {
    animal.swim();
    return;
  }

  animal.fly();
}

function getSwimmingAnimal() {
  return {
    swim: () => {
      console.log('swimming');
    },
  };
}

move(getSwimmingAnimal());
