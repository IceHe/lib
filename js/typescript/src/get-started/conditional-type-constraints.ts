// Type MessageOf<T extends { message: unknown }> = T['message'];
type MessageOf<T extends { message: string }> = T['message'];

interface Email {
  message: string;
}

type EmailMessageContents = MessageOf<Email>;

const emailMessageContents: EmailMessageContents = 'test';
console.log(emailMessageContents);
