declare type MessageOf<T extends {
    message: unknown;
}> = T['message'];
interface Email {
    message: string;
}
declare type EmailMessageContents = MessageOf<Email>;
declare const emailMessageContents: EmailMessageContents;
