# Commit Signature Verification

---

References

-   [Managing commit signature verification - GitHub Docs](https://docs.github.com/en/authentication/managing-commit-signature-verification)
    -   [Checking for existing GPG keys](https://docs.github.com/en/authentication/managing-commit-signature-verification/checking-for-existing-gpg-keys)
    -   [Generating a new GPG key](https://docs.github.com/en/authentication/managing-commit-signature-verification/generating-a-new-gpg-key)
    -   [Adding a new GPG key to your GitHub account](https://docs.github.com/en/authentication/managing-commit-signature-verification/adding-a-new-gpg-key-to-your-github-account)
    -   [Telling Git about your signing key](https://docs.github.com/en/authentication/managing-commit-signature-verification/telling-git-about-your-signing-key)
    -   ……

## Intro

You can sign your work locally using GPG or S/MIME. GitHub will verify these signatures so other people will know that your commits come from a trusted source.

_使用 GPG ( 或 S/MIME ) 可以对 tags 和 commits 进行本地的签名, 然后 GitHub 会验证这些签名, 以便其他人确信这些代码变更出自可信的来源._

-   A: "好像打官司的时候, GPG 的 commit 才算数. 而且好像是有时间戳的. 不能伪造."
-   B: "不要用公司电脑写个人项目, 不要在上班时间写个人项目. 参见美剧《硅谷》."
-   ……
