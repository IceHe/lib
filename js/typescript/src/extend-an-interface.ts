interface Animal {
    name: string
}

interface Bear extends Animal {
    honey: boolean
}

function getBear(): Bear {
    return { name: "IceHe", honey: true};
}

const bear = getBear()
console.log(bear.name)
console.log(bear.honey)
