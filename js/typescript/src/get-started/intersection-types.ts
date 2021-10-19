interface Colorful {
  color: string;
}

interface Circle {
  radius: number;
}

type ColorfulCircle = Colorful & Circle;

function draw(colorfulCircle: Colorful & Circle) {
  console.log(`Color was ${colorfulCircle.color}`);
  console.log(`Radius was ${colorfulCircle.radius}`);
}

draw({ color: 'green', radius: 7 });
draw({ color: 'red', radiux: 7 });
