# yes

be repetitively affirmative

---

References

- `man yes`
- [Automatically accept all SDK licences - Stack Overflow](https://stackoverflow.com/questions/38096225/automatically-accept-all-sdk-licences)

## Synopsis

```bash
yes [expletive]
```

## Description

yes outputs expletive, or, by default, “y”, forever.

## Usage

e.g. automatically accept all SDK licences

```bash
yes | ~/Library/Android/sdk/tools/bin/sdkmanager --licenses
```
