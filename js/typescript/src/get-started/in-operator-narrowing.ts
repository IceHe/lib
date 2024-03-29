type Fish = { swim: () => void };
type Bird = { fly: () => void };

function move(animal: Fish | Bird) {
  if ('swim' in animal) {
    animal.swim();
    return;
  }

  animal.fly();
}

move({
  swim: () => {
    console.log('swimming');
  },
});

move({
  fly: () => {
    console.log('flying');
  },
});
