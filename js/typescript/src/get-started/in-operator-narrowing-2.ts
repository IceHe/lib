type Fish = { swim: () => void };
type Bird = { fly: () => void };
type Human = { swim?: () => void; fly?: () => void };

function move(animal: Fish | Bird | Human) {
  if ('swim' in animal) {
    animal.swim();
  } else if ('fly' in animal) {
    animal.fly();
  }
}

move({
  fly: () => {
    console.log('flying');
  },
});

move({
  swim: () => {
    console.log('swimming');
  },
});
