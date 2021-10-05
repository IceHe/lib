function liveDangerously(x?: number | null) {
    // No error
    console.log(x!.toFixed());
}

liveDangerously(996);
// liveDangerously(null);
// liveDangerously(undefined);
