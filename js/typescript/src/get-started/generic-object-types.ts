interface Box {
  contents: any;
}

function f1(box: Box) {
  // We could check 'x.contents'
  if (typeof box.contents === 'string') {
    console.log(box.contents.toLowerCase());
    return;
  }

  // Or we could use a type assertion
  console.log((box.contents as string).toLowerCase());
}

f1({ contents: 'hello world' });
f1({ contents: new Date() });
