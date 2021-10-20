declare class BeeKeeper {
    hasMask: boolean;
}
declare class ZooKeeper {
    nametag: string;
}
declare class Animal {
    numLegs: number;
}
declare class Bee extends Animal {
    keeper: BeeKeeper;
}
declare class Lion extends Animal {
    keeper: ZooKeeper;
}
declare function createInstance<A extends Animal>(c: new () => A): A;
