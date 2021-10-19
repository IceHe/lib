const user = {
  id: 114,
  admin: false,
  becomeAdmin() {
    this.admin = true;
  },
};

console.log(user);
user.becomeAdmin();
console.log(user);
