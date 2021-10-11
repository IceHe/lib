class UserAccount {
  name: string;
  accountType = 'user';

  email: string;
  // Property 'email' has no initializer and is not definitely assigned in the constructor.
  address: string | undefined;

  constructor(name: string) {
    this.name = name;
    // Note that this.email is not set
  }
}
