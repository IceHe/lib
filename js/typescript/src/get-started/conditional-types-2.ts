interface IdLabel {
  id: number;
}

interface NameLabel {
  name: string;
}

function createLabel(id: number): IdLabel;
function createLabel(name: string): NameLabel;
function createLabel(idOrName: number | string): IdLabel | NameLabel;
function createLabel(idOrName: number | string): IdLabel | NameLabel {
  throw 'unimplemented';
}
