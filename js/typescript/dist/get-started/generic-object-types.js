function f1(box) {
    if (typeof box.contents === 'string') {
        console.log(box.contents.toLowerCase());
        return;
    }
    console.log(box.contents.toLowerCase());
}
f1({ contents: 'hello world' });
f1({ contents: new Date() });
