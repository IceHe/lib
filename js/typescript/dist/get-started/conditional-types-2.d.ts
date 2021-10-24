interface IdLabel {
    id: number;
}
interface NameLabel {
    name: string;
}
declare function createLabel(id: number): IdLabel;
declare function createLabel(name: string): NameLabel;
declare function createLabel(idOrName: number | string): IdLabel | NameLabel;
