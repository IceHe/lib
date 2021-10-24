interface IdLabel {
  id: number;
}

interface NameLabel {
  name: string;
}

type NameOrId<T extends string | number> = T extends string ? NameLabel : IdLabel;

function createLabel<T extends string | number>(idOrName: string | number): NameOrId<T> {
  // Throw 'unimplemented';
  if (typeof idOrName === string) {
    return { name: idOrName };
  }

  if (typeof idOrName === number) {
    return { id: idOrName };
  }
}

const a = createLabel('icehe');
console.log(a);

const b = createLabel(965);
console.log(b);

const c = createLabel(Math.random() ? 'Hello' : 123);
console.log(c);
