# Base64 Encoding

a group of binary-to-text encoding schemes that represent binary data in an ASCII string format

---

References

- [Base64 - Wikipedia](https://en.wikipedia.org/wiki/Base64)

## Intro

**In programming, Base64 is a group of binary-to-text encoding schemes that represent binary data**
**(more specifically, a sequence of 8-bit bytes)**
**in an ASCII string format by translating the data into a radix-64 representation.**

The term Base64 originates from a specific MIME content transfer encoding.
**Each non-final Base64 digit represents exactly 6 bits of data.**
**Three bytes (i.e., a total of 24 bits) can therefore be represented by four 6-bit Base64 digits.**

```bash
2 ^ 6 = 64
```

**Common to all binary-to-text encoding schemes, Base64 is designed to carry data stored in binary formats across channels that only reliably support text content.**
Base64 is particularly prevalent<!-- 普遍的, 盛行的, 流行的 --> on the World Wide Web where its uses include the **ability to embed image files or other binary assets inside textual assets such as HTML and CSS files**.

_Base64 is also widely used for sending e-mail attachments._
_This is required because SMTP — in its original form — was designed to transport 7-bit ASCII characters only._
This encoding causes an **overhead of 33–36% (33% by the encoding itself; up to 3% more by the inserted line breaks)**.

## Design

## Base64 Table

## Examples

### Output padding

### Decoding Base64 with padding

### Decoding Base64 without padding

## Implementations and history

### Variants summary table
