var users = [
    { name: 'Oby', age: 12 },
    { name: 'Heera', age: 32 },
];
var loggedInUser = users.find(function (u) { return u.name === loggedInUsername; });
console.log(loggedInUser.age);
