type MessageOf<T extends { message: unknown }> = T extends { message: unknown }
  ? Message['message']
  : never;

interface Dog {
  bark: void;
}

type DogMessageContents = MessageOf<Dog>;

const dogMessageContents: DogMessageContents = 'test';
// Type 'string' is not assignable to type 'never'.
