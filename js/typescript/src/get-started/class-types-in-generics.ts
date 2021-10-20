class BeeKeeper {
  hasMask = true;
}

class ZooKeeper {
  nametag = 'Mikle';
}

class Animal {
  numLegs = 4;
}

class Bee extends Animal {
  keeper: BeeKeeper = new BeeKeeper();
}

class Lion extends Animal {
  keeper: ZooKeeper = new ZooKeeper();
}

function createInstance<A extends Animal>(c: new () => A): A {
  return new c();
}

console.log(createInstance(Bee).keeper.hasMask);
console.log(createInstance(Lion).keeper.nametag);
console.log(createInstance(Bee));
console.log(createInstance(Lion));
