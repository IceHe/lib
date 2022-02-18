# *.d.ts

declaration file that functions as an interface to the components compiled in JavaScript

---

References

- [Modules .d.ts - TypeScript Docs](https://www.typescriptlang.org/docs/handbook/declaration-files/templates/module-d-ts.html)
- [About "*.d.ts" in TypeScript - stack overflow](https://stackoverflow.com/questions/21247278/about-d-ts-in-typescript)

## Concept

```ts
interface Body {
  json<T>(): Promise<T>;
}
```

这样能够支持以下写法:

```ts
const something = response.json<Something>();
```

比用 as 强转类型的写法 “优雅” (说实话，有时我宁愿直接 as Type)

```ts
const something = response.json() as Something;
```
