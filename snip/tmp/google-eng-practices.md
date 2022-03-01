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
    - [The CL author’s guide to getting through code review](https://google.github.io/eng-practices/review/developer/)
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

<u>**In general, reviewers should favor approving a CL once it is in a state where it definitely improves the overall code health of the system being worked on, even if the CL isn’t perfect.**</u>

That is the senior principle among all of the code review guidelines.

_There are limitations to this, of course._
_For example,_ if a CL adds a feature that the reviewer doesn’t want in their system, then the reviewer can certainly deny approval even if the code is well-designed.

A key point here is that there is no such thing as “perfect” code — there is only better code.
**Reviewers should not require the author to polish every tiny piece of a CL before granting approval.**
**Rather, the reviewer should balance out the need to make forward progress compared to the importance of the changes they are suggesting.**
**Instead of seeking perfection, what a reviewer should seek is continuous improvement.**
A CL that, as a whole, improves the maintainability, readability, and understandability of the system shouldn’t be delayed for days or weeks because it isn’t “perfect.”

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

- [The CL author’s guide to getting through code review](https://google.github.io/eng-practices/review/developer/)

### Writing Good CL Descriptions

- [Writing Good CL Descriptions](https://google.github.io/eng-practices/review/developer/cl-descriptions.html)

### Small CLs

- [Small CLs](https://google.github.io/eng-practices/review/developer/small-cls.html)

### How to Handle Reviewer Comments

- [How to Handle Reviewer Comments](https://google.github.io/eng-practices/review/developer/handling-comments.html)
