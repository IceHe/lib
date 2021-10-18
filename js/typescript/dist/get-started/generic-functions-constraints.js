function longest(a, b) {
    if (a.length >= b.length) {
        return a;
    }
    return b;
}
console.log(longest([4, 5], [1, 2, 3]));
console.log(longest('apple', 'ice'));
