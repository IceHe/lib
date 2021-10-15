declare type Fish = {
    swim: () => void;
};
declare type Bird = {
    fly: () => void;
};
declare function move(animal: Fish | Bird): void;
