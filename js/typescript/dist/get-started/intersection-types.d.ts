interface Colorful {
    color: string;
}
interface Circle {
    radius: number;
}
declare type ColorfulCircle = Colorful & Circle;
declare function draw(colorfulCircle: Colorful & Circle): void;
