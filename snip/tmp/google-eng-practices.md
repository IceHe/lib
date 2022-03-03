# Google Engineering Practices

Digest

---

References

- [Google Engineering Practices Documentation](https://google.github.io/eng-practices/)
    - [How to do a code review](https://google.github.io/eng-practices/review/reviewer/)
        - [The Standard of Code Review](https://google.github.io/eng-practices/review/reviewer/standard.html)
        - [What to Look For In a Code Review](https://google.github.io/eng-practices/review/reviewer/looking-for.html)
        - [Navigating a CL in Review](https://google.github.io/eng-practices/review/reviewer/navigate.html)
        - [Speed of Code Reviews](https://google.github.io/eng-practices/review/reviewer/speed.html)
        - [How to Write Code Review Comments](https://google.github.io/eng-practices/review/reviewer/comments.html)
        - [Handling Pushback in Code Reviews](https://google.github.io/eng-practices/review/reviewer/pushback.html)
    - [The CL author's guide to getting through code review](https://google.github.io/eng-practices/review/developer/)
        - [Writing Good CL Descriptions](https://google.github.io/eng-practices/review/developer/cl-descriptions.html)
        - [Small CLs](https://google.github.io/eng-practices/review/developer/small-cls.html)
        - [How to Handle Reviewer Comments](https://google.github.io/eng-practices/review/developer/handling-comments.html)

Terminology

-   **CL**: Stands for “**changelist**”,
    which means one self-contained change that has been submitted to version control or which is undergoing code review.

    Other organizations often call this a “change”, “patch”, or “pull-request”.

-   **LGTM**: Means “**Looks Good to Me**”.

    It is what a code reviewer says when approving a CL.

## How to do code review

References

- [How to do a code review](https://google.github.io/eng-practices/review/reviewer/)

### The Standard of Code Review

- [The Standard of Code Review](https://google.github.io/eng-practices/review/reviewer/standard.html)

……

_First, developers must be able to make progress on their tasks._
_If you never submit an improvement to the codebase, then the codebase never improves._
_Also,_ if a reviewer makes it very difficult for any change to go in, then developers are disincentivized to make improvements in the future.

……

<u>**In general, reviewers should favor approving a CL once it is in a state where it definitely improves the overall code health of the system being worked on, even if the CL isn't perfect.**</u>

That is the senior principle among all of the code review guidelines.

_There are limitations to this, of course._
_For example,_ if a CL adds a feature that the reviewer doesn't want in their system, then the reviewer can certainly deny approval even if the code is well-designed.

A key point here is that there is no such thing as “perfect” code — there is only better code.
**Reviewers should not require the author to polish every tiny piece of a CL before granting approval.**
**Rather, the reviewer should balance out the need to make forward progress compared to the importance of the changes they are suggesting.**
**Instead of seeking perfection, what a reviewer should seek is continuous improvement.**
A CL that, as a whole, improves the maintainability, readability, and understandability of the system shouldn't be delayed for days or weeks because it isn't “perfect.”

Reviewers should always feel free to leave comments expressing that something could be better, but if it's not very important,
**prefix it with something like “Nit: ” to let the author know that it's just a point of polish that they could choose to ignore**.

……

#### Mentoring

Code review can have an important function of teaching developers something new about a language, a framework, or general software design principles.
**It's always fine to leave comments that help a developer learn something new.**
**Sharing knowledge is part of improving the code health of a system over time.**

Just keep in mind that if your comment is purely educational, but not critical to meeting the standards described in this document,
prefix it with “Nit: “ or otherwise indicate that it's not mandatory for the author to resolve it in this CL.

#### Principles

-   Technical facts and data overrule<!-- 否决/优于 --> opinions and personal preferences.

-   On matters of style, the style guide is the absolute authority.

    _Any purely style point (whitespace, etc.) that is not in the style guide is a matter of personal preference._
    The style should be consistent with what is there.
    If there is no previous style, accept the author's.

-   **Aspects of software design are almost never a pure style issue or just a personal preference.**

    They are based on underlying principles and should be weighed on those principles, not simply by personal opinion.
    Sometimes there are a few valid options.
    If the author can demonstrate (either through data or based on solid engineering principles) that several approaches are equally valid, then the reviewer should accept the preference of the author.
    Otherwise the choice is dictated by standard principles of software design.

-   _If no other rule applies, then the reviewer may ask the author to be consistent with what is in the current codebase, as long as that doesn't worsen the overall code health of the system._

#### Resolving Conflicts

In any conflict on a code review, the first step should always be for the developer and reviewer to try to come to consensus, _based on the contents of this document and the other documents in The CL Author's Guide and this Reviewer Guide._

**When coming to consensus becomes especially difficult, it can help to have a face-to-face meeting or a video conference between the reviewer and the author, instead of just trying to resolve the conflict through code review comments.**
**(If you do this, though, make sure to record the results of the discussion as a comment on the CL, for future readers.)**

**If that doesn't resolve the situation, the most common way to resolve it would be to escalate<!-- 逐步升级/扩大 -->.**
Often the escalation path is to a broader team discussion, having a Technical Lead weigh in, asking for a decision from a maintainer of the code, or asking an Eng Manager to help out.
**Don't let a CL sit around<!-- 干坐着; 无所事事 --> because the author and the reviewer can't come to an agreement.**

### What to Look For In a Code Review

- [What to Look For In a Code Review](https://google.github.io/eng-practices/review/reviewer/looking-for.html)

### Navigating a CL in Review

- [Navigating a CL in Review](https://google.github.io/eng-practices/review/reviewer/navigate.html)

### Speed of Code Reviews

- [Speed of Code Reviews](https://google.github.io/eng-practices/review/reviewer/speed.html)

### How to Write Code Review Comments

- [How to Write Code Review Comments](https://google.github.io/eng-practices/review/reviewer/comments.html)

### Handling Pushback in Code Reviews

- [Handling Pushback in Code Reviews](https://google.github.io/eng-practices/review/reviewer/pushback.html)

## How to get through code review

References

- [The CL author's guide to getting through code review](https://google.github.io/eng-practices/review/developer/)

### Writing Good CL Descriptions

- [Writing Good CL Descriptions](https://google.github.io/eng-practices/review/developer/cl-descriptions.html)

### Small CLs

- [Small CLs](https://google.github.io/eng-practices/review/developer/small-cls.html)

### How to Handle Reviewer Comments

- [How to Handle Reviewer Comments](https://google.github.io/eng-practices/review/developer/handling-comments.html)
