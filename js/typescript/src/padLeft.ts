function padLeft(padding: number | string, input: string) {
    if (typeof padding === "number") {
        return new Array(padding + 1).join(" ") + input;
    }
    return padding + input;
}

console.log(padLeft(3, "IceHe"));
console.log(padLeft("Seen ", "IceHe"));
