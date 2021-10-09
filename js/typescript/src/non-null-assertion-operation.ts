function liveDangerously(x?: number | null) {
  // No error
  console.log(x.toFixed(0));
}

liveDangerously(996);
// LiveDangerously(null);
// liveDangerously(undefined);
