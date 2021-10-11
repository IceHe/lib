try {
    // ...
}
catch (error) {
    // We have to verify err is an
    // error before using it as one.
    if (error instanceof Error) {
        console.log(error.message);
    }
}
