# Debug Notes

---

## pnpm install extra packages in CI

> pnpm install extra packages without --no-frozen-lockfile option in CI environment

At first, see the summary of related PR:
[refactor(test): inline link-mock-connectors.sh by IceHe · Pull Request #1746 · logto-io/logto](https://github.com/logto-io/logto/pull/1746)

Lessons learned:

-   **`lerna` 、 `pnpm` 命令还是别的软件工具，通常都会提供辅助 debug 的功能，例如打印各种级别的 logs**

    _看了好久 lerna 的源码，注意到 `log.silly(…)` 这种代码，_
    _我才反应过来可以通过调整 `loglevel` option 来打印更多信息，以便调试。_

    _不过 [lerna 官方文档](https://lerna.js.org/docs/api-reference/commands)_
    _也没有提及 `loglevel` 这种全局适用（例如 `lerna add`、`lerna bootstrap` 都能用）的 option，_

    -   `lerna`：通过 `npx lerna -h`、
        [第三方中文文档](http://www.febeacon.com/lerna-docs-zh-cn/routes/basic/global_options.html#loglevel-silent-error-warn-success-info-verbose-silly)
        或 [源码](https://github.com/lerna/lerna/blob/3706b0fed15ef67849bb3c5eb7c9d304764195ce/core/command/index.js#L189)
        能找到了 `loglevel` option

    -   `pnpm`：通过改变 .npmrc 的 [`loglevel`](https://pnpm.io/npmrc#loglevel) option 来打印更多信息

-   **不能因为 _畏惧看源码_ 或者 _怕麻烦_ 就靠实践硬试出解决方案，没有原理、源码和文档的支持，结论太不够 solid、立不住脚**

    _原来的解决方案就是先 `pnpm link <package>` 再 `pnpm i --no-frozen-lockfile`，这就是通过尝试找出来的。_
    _无法得到 reviewers 的一致认同，导致反复改了数遍。_

    <!--
    _题外话：_
    _为什么当时不愿意付出更多 effort 去尽可能一次性找到的尽可能好的解决方案？_
    _因为“load connectors”的方式在紧接着的 refactor 后会改进，_
    _没必要的解决方案能起效果、不会太糟糕就行，没想到最后竟然要求这么尽善尽美，说实话还是比较折磨。_
    -->

-   _之前习惯先开个 (maybe draft) PR，push 一些可能导致 CI failed 的 commit 来测试。_
    _这样会让 PR 看起来有很多除了 debug 无其它意义的 commit，比较杂乱。_

    _实际上我想测试的 CI workflow 除了创建 PR 还有 push 一个名字以 `push-action/` 开头的 branch 也可以触发。_

    ```
    name: Integration Test

    on:
    push:
        branches:
        - master
        - 'push-action/**'
    pull_request:

    ```

## Other ways

-   Print logs
-   Breakpoints
-   Capture network packets
-   ……
