# Solve Programming Problems

---

## Basics

### Sort Data & Binary Search

-   **Unsorted** data → **Sorted** data（无序 → 有序）

    可以先将 无序数据 转换为 有序数据！

    e.g. keyword **"subsequence"** (子序列) → sort the original array (因为顺序无关!)

-   **Sorted** data → **Binary Search**（有序数据 → 二分查找）

    Applicable for Sorted Array, **Binary Search Tree**（二叉搜索树）

    e.g. [378. 有序矩阵中第 K 小的元素](https://leetcode.cn/problems/kth-smallest-element-in-a-sorted-matrix/)

    区间写法：

    -   [L, R] 闭区间：`while (l <= r)`（惯用）
    -   (L, R) 开区间：`while (l + 1 < r)`（好记）
    -   [L, R) 左开右闭：`while (l < r)`

        记得根据具体情况确定边界（实现略）

-   **Monotonicity** → **Binary Search**（二分答案）

    如果答案范围有单调性，可以通过二分查找得出边界上的答案!

    单调性：简而言之，就是正确答案连成一片，错误答案也连成一片，区间范围连续没有中断。

    ```text
    L  M  R
    [OOOXXX]
    ```

    e.g. [274. H 指数](https://leetcode.cn/problems/h-index/) /
    [LCP 78. 城墙防线](https://leetcode.cn/problems/Nsibyl/description/)

### DFS & BFS

-   DFS（深度优先搜索）

    Usually use recursive implementation.

-   BFS（广度优先搜索）

    Use **queue** to do BFS.

    e.g. [剑指 Offer 27. 二叉树的镜像](https://leetcode.cn/problems/er-cha-shu-de-jing-xiang-lcof/)

    -   **Two-End BFS**（双向广度搜索）

        搜索空间（范围）比单向搜索更小，可以更快得出答案

        e.g. [127. 单词接龙](https://leetcode.cn/problems/word-ladder/)

### Divide & Conquer

-   **Divide and Conquer**（分治）

    Use Recursion or DP.

    e.g. [14. 最长公共前缀](https://leetcode.cn/problems/longest-common-prefix/)

-   **Recursive → Iterative**（用迭代替换递归）

    Use **stack** for iteration to simulate recursion.

    e.g. [剑指 Offer 24. 反转链表](https://leetcode.cn/problems/fan-zhuan-lian-biao-lcof/) (bad example)

-   **DP - Dynamic Programming（动态规划）**

    e.g. [10. 正则表达式匹配](https://leetcode.cn/problems/regular-expression-matching/)

    -   Recursion vs DP

        -   Recursion 的劣势：自上而下解决问题（将大问题分解为小问题）

        -   **DP 的优势：自下而上解决问题，可以消除重复的子问题**

            通过 iteration 实现，更不担心栈空间不足的问题。

    -   **DP 回溯答案！**

        例如，先找到最大的长度，再回溯找到最大长度的路径。

        e.g. [2901. 最长相邻不相等子序列 II](https://leetcode.cn/problems/longest-unequal-adjacent-groups-subsequence-ii/)

    -   **树形 DP**

        e.g. [100118. 在树上执行操作以后得到的最大分数](https://leetcode.cn/problems/maximum-score-after-applying-operations-on-a-tree/)

### Bits

-   **Low Bit**（最低位的 1）

    e.g. [307. 区域和检索 - 数组可修改](https://leetcode.cn/problems/range-sum-query-mutable/)

    -   GET：`lowbit = x & -x`
        -   原理：`x & ~(x - 1)` = `x & -x`
    -   REMOVE：`x &= x - 1`
        -   或者：`x -= lowbit`

-   Remove Low Bits（消除最右侧的连续二进制位 bit 1）

    -   -1：仅消除最右侧一个 bit 1
    -   +1：消除最右侧一连串 bit 1！

-   XOR（异或）：b = 0 or 1

    -   b ^ 0 = b
    -   b ^ 1 = ~b
    -   b & 1 = b
    -   b & 0 = 0

-   原码：`+0 = 000, -0 = 100`

-   补码：` 0 = 000, -1 = 111`

    -   `-x = ~x + 1` e.g.
        -   ` 0 = 000`
        -   ` 1 = 001`
        -   ` 2 = 010`
        -   ` 3 = 011`
        -   `-4 = 100`
        -   `-3 = 101`
        -   `-2 = 110`
        -   `-1 = 111`

### Binary Tree

-   Traverse Order（遍历顺序）

    -   Preorder（前序）
    -   Inorder（中序）
    -   Postorder（后序）

-   Traverse Implementation（遍历的实现方式）

    -   Recursive（递归）：简洁易懂，但消耗栈空间
    -   Iterative（迭代）：复杂易错
        -   Morris：仅 O(1) 空间复杂度
            -   NOTE: 后缀遍历麻烦，还需要翻转结果列表！
        -   Stack（栈）
            -   通常写法：
                -   NOTE: 后序遍历，还需记录 prev 前一个访问的节点，
                    以判断是否已经访问完当前节点的右子树！
            -   使用 null 作为哨兵（简洁易懂）
                -   NOTE: Java 的 Stack 或 Deque 需要允许保存 null 节点的结构如 LinkedList。

-   相关题型

    -   序列化 / 反序列化 二叉树
    -   根据 中序遍历顺序 和 前序或后序遍历顺序，重建二叉树

### Graph

-   保存方式

    e.g. [207. 课程表](https://leetcode.cn/problems/course-schedule/) /
    [1462. 课程表 IV](https://leetcode.cn/problems/course-schedule-iv/)

    -   Adjacent List（邻接表）

        适合稀疏的数据，简单易懂，推荐使用

        e.g. Java `List<Integer>[] edges = new List[n];`

    -   Adjacent Matrix（邻接矩阵）

        适合密集的数据

        e.g. `boolean[][] connected = new boolean[m][n];`

    -   Chain Forward Star（链式前向星）

        适合密集数据，节省空间（适合保存大量数据）

        属于邻接表的存图方式的其中一种

        e.g. [207. 课程表](https://leetcode.cn/problems/course-schedule/)

        ```java
        int nodeCount = 0;
        int[] edge, next, head;
        edge = new int[edgeCount];
        next = new int[edgeCount];
        head = new int[maxNodeCount];
        Arrays.fill(head, -1);
        ```

-   Flood Fill（洪泛算法）

    求连通的节点的数量，是否连通

    e.g. [695. 岛屿的最大面积](https://leetcode.cn/problems/max-area-of-island/)

-   **Topological Sort**（拓扑排序）

    -   确定优先级

        e.g. [210. 课程表 II](https://leetcode.cn/problems/course-schedule-ii/)

    -   剪枝

        e.g. [2876. 有向图访问计数](https://leetcode.cn/problems/count-visited-nodes-in-a-directed-graph/)

-   **Floyd**（弗洛伊德算法）

    配合邻接矩阵，求最短路，是否连通

    e.g. [2642. 设计可以求最短路径的图类](https://leetcode.cn/problems/design-graph-with-shortest-path-calculator/) /
    [1462. 课程表 IV](https://leetcode.cn/problems/course-schedule-iv/)

-   **Dijkstra**（迪杰特斯拉算法）

    适合背包问题，求最短路，是否连通

    e.g. [2642. 设计可以求最短路径的图类](https://leetcode.cn/problems/design-graph-with-shortest-path-calculator/)

-   统计节点 indegree 入度的作用

    可以找 root 节点，
    判若是否有环；
    配合 DFS + visited 标识，查询连通域（不连通的子图）的数量

    e.g. [1361. 验证二叉树](https://leetcode.cn/problems/validate-binary-tree-nodes/)

### Interval Boundary

-   Interval Length（区间长度）

    e.g. 排序算法 & [剑指 Offer II 016. 不含重复字符的最长子字符串](https://leetcode.cn/problems/wtcaE1/)

    -   A. **one inclusive and one exclusive → `length = right - left`**

        _e.g. [left inclusive, right exclusive)_

        _or (left exclusive, right inclusive]_

    -   B. **two inclusive → `length = right - left + 1`**

        _e.g. [left inclusive, right inclusive]_

    -   C. **two exclusive → `length = right - left - 1`**

        _e.g. (left exclusive, right exclusive)_

-   Half Length（半长） = `length / 2`

    -   **`(right inclusive - left inclusive + 1) / 2`**
    -   `(right inclusive - left exclusive) / 2`
    -   `(right exclusive - left inclusive) / 2`
    -   **`(right exclusive - left exclusive - 1) / 2`**

-   Mid Index（中点下标）

    -   **A. as start index of second half（作为后半区间的起始点）**

        -   mid index = `start + half length`

            **= `inclusive left + (inclusive right - inclusive left + 1) / 2`**

            = `(inclusive left + inclusive right + 1) / 2`

        -   前半区间:

            -   左闭右开：[start, start + half length)
            -   全闭区间：[start, start + half length - 1]

        -   后半区间:

            -   左闭右开：[start + half length, start + 2 \* half length)
            -   全闭区间：[start + half length, start + 2 * half length - 1]

    -   **B. as end index of first half（作为前半区间的结束点）**

        -   mid index = **`inclusive left + (inclusive right - inclusive left) / 2`**

            = `(inclusive left + inclusive right) / 2`

-   Array Boundary（数组边界）

    -   **`start = startPoint + xxx`**

        e.g. `int i = start; int j = start + interval;`

    -   **`end = min(xxx, array.length) - 1`**

        e.g. `int end = Math.min(i + interval * 2, array.length) - 1;`

    -   `min >= 0`

### Sort

-   种类

    -   Bubble 冒泡
    -   Select 选择
    -   Insert 插入
        -   简洁
    -   Merge 归并
        -   适合外排序、链表排序
    -   Quick 快速排序
        -   应用广泛
        -   e.g. 找中位数 / Top K：[347. 前 K 个高频元素](https://leetcode.cn/problems/top-k-frequent-elements/)
    -   Heap 堆排序
        -   适合数组，将输入数组直接 heapify 堆化，就无需额外空间
        -   找 Top K 个元素
        -   e.g. [2558. 从数量最多的堆取走礼物](https://leetcode.cn/problems/take-gifts-from-the-richest-pile/)
    -   Bucket 桶排
        -   e.g. [164. 最大间距](https://leetcode.cn/problems/maximum-gap/)
    -   Counting 计数
        -   空间换时间，适合数据范围小
        -   e.g. 统计小写字母数量 → 从小到大排列出现的字母
    -   shell 希尔
        -   即多路的插入排序
    -   Radix 基数

### Data Structures

-   Max Heap & Min Heap（最大堆最小堆）

    Java implementation: **PriorityQueue**

-   Sorted Set & Sorted Map

    Java implementation: **TreeSet / TreeMap**

-   **Doubly Linked List**（双向链表）

    Java implementation: **LinkedHashMap**

    e.g. [146. LRU 缓存](https://leetcode.cn/problems/lru-cache/) / [460. LFU 缓存](https://leetcode.cn/problems/lfu-cache/)

-   **Trie**（字典树）

    e.g. [208. 实现 Trie (前缀树)](https://leetcode.cn/problems/implement-trie-prefix-tree/) /
    [1233. 删除子文件夹](https://leetcode.cn/problems/remove-sub-folders-from-the-filesystem/)

    实现方式：

    -   OOP：简单易懂
    -   Array：节省空间，适合保存大量数据（这时访问速度较快）

-   **Disjoint Set Union**（并查集）

    适合 保存和查询节点的连通性、
    统计连通域（连通的一组节点）的节点数量、
    连通域的数量 等

    e.g. [128. 最长连续序列](https://leetcode.cn/problems/longest-consecutive-sequence/) /
    [2685. 统计完全连通分量的数量](https://leetcode.cn/problems/count-the-number-of-complete-components/)

-   **Fenwick Tree**（树状数组）

    适合保存、动态更新、查询 前缀和，时间复杂度 O(log(n))

    e.g. [307. 区域和检索 - 数组可修改](https://leetcode.cn/problems/range-sum-query-mutable/)

-   **Segment Tree**（线段树）

    适合保存、动态更新、查询 区间信息（例如前缀和），时间复杂度 O(log(n))

    e.g. [307. 区域和检索 - 数组可修改](https://leetcode.cn/problems/range-sum-query-mutable/)

    实现方式：

    -   用对象节点构建，链式存储
        -   实现简单易懂，适合一般情况，推荐使用
    -   用哈希表构建，堆式存储
        -   适合稀疏数据、较大的数据范围
    -   用数组构建，堆式存储
        -   适合密集数据、较小的数据范围
        -   堆式存储特征：用二叉树数组左右子节点公式计算节点 id

### Others

-   **如果遍历一个数组时需要交换元素等操作，建议使用 while 循环控制：**

    e.g. 双轴的三路快速排序：

    ```java
    int idx = 0;
    while (idx < nums.length) { ... }
    ```

    某些算法可能在遍历的过程中，不需要每个循环都递增 idx，此时不应该使用 for 循环：

    ```java
    for (int i = 0; i < nums.length; i++) { ... }
    ```

    如果遍历一个数组时不需要交换元素等操作，可以使用：

    ```java
    for (int num : nums) { ... }
    ```

-   for / while / do while 循环的下标边界处理

    -   for: 能够精确控制下标的起始和结束位置 [min, max]。

        -   但是下标值只在 for 语句块中生效，后续不能复用。

    -   while / do while: 可以在语句块之外复用被它操作过的下标位置。

        -   但是可能产生多余 ++ / -- 操作。

    -   for vs while:

        e.g. [剑指 Offer 29. 顺时针打印矩阵](https://leetcode.cn/problems/shun-shi-zhen-da-yin-ju-zhen-lcof/)

        如果想复用 row 和 col 的下标变量，
        while 循环后，要微调 row 或 col 的值：

        ```java
        while (col <= colMax && idx < len) {
            order[idx++] = matrix[row][col++];
        }
        col--;
        minRow++;
        ```

        改用 for 循环后就精确多了：

        ```java
        for (int col = minCol; col <= maxCol; col++) {
            order[idx++] = matrix[minRow][col];
        }
        if (++minRow > maxRow) {
            break;
        }
        ```

-   State Machine（状态机）

    e.g.
    [只出现一次的数字](https://leetcode.cn/problems/WGki4K/solution/jian-zhi-offer-ii-004-zhi-chu-xian-yi-ci-l3ud/) /
    [剑指 Offer 20. 表示数值的字符串](https://leetcode.cn/problems/biao-shi-shu-zhi-de-zi-fu-chuan-lcof/)

-   通过上下文保存中间结果？

    有时需要一些上下文来辅助解题，有多种上下文保存方式：

    1.  **object property** | closure：
        -   放在类实例的字段里，例如 `new Solution().result` 或 JS 的闭包里
    2.  **function stack**：通过递归或者函数式编程实现时，可以将上下文放到方法的入参里
        -   e.g. [机械人的运动范围](https://leetcode.cn/problems/ji-qi-ren-de-yun-dong-fan-wei-lcof/) 中的求和方式
    3.  pass by **reference**：即传引用，将引用作为方法的入参
        -   例如 C++ 可以通过 &variable 传递引用
        -   但是像 Java 没办法显式传递简单的上下文信息 &intVal，得将这些信息封装成对象再传
    4.  **return multiple values**：方法返回所有需要关注的上下文信息
        -   例如 Java 没法像 Go 那样直接返回多个值（元组），得将这些信息封装成对象再返回
        -   或者加入特殊值，例如数组下标的范围为 0~n，这时可以用 -1 下标代表某个数值不在数组内

## Tips

### SOP

Steps: 解题习惯！

1.  理解题目：题干、目标（返回值）、示例 cases、数据范围
    -   _低级失误：_
        -   _数据范围大，返回类型 long，计算时却用 int 类型计算，导致溢出！_
        -   _没看、没搞懂示例 cases，没能充分理解题意，就开始写！_
2.  理清思路：第一个想法通常不是最好的，稍微再想想；
    如果实在想不到…
    -   先解决：想出暴力破解的办法
    -   <tab>再优化：根据约束条件（例如数据特征）考虑是否能简化
    -   经验教训：如果想到的办法太复杂，要考虑的分支和边界情况太多，应该另觅它法！
3.  编写代码：最好先写出测试用例，注意边界情况
    1. 解决问题
    2. 代码简洁（易懂，用内置 OOP 数据结构，辅助变量尽可能少）
    3. 执行用时短
    4. 占用空间小
    5. 代码优雅
4.  脑内测试（检查思路和实现细节）
5.  运行测试
6.  尝试优化（回到第 2 或第 3 步）

Solution Levels:

0. 仅解决当前 case（不保证正确性）
1. 解决问题（保证正确性）
2. 代码简洁（易懂）
3. 执行用时短
4. 占用空间小
5. 代码优雅

### Done

-   没有好的思路，就先想 暴力破解 的方法！

-   别总想着 最优的 代码实现，先 简洁准确地 解决问题！

    别总想着直接用 迭代 解决，先 **用递归把思路搞清楚**

-   拓展思路

    -   画图具像化：从 抽象 到 可想像

    -   举例归纳：从 特例 到 一般情况

    -   分治：如何解决 简化的问题 或 拆解后的子问题

    -   枚举数据结构和算法：寻找匹配的方案，联系现实中的具体问题

    -   **正难则反！** 如果正向解决很复杂麻烦，考虑反向思考。

### Correct

-   每一个代码片段都要想清楚为什么要这么写！不要偷懒，不要想当然！

-   **实现算法时，最好列出 invariant（不变式）！**

    提醒自己：不要破坏前置条件！不然逻辑容易出错。

    前置条件或明或暗，具体的实现细节会产生更多隐含的条件约束。

-   Graph（图）的边界情况很多，边界情况应检尽检！

    通常需要 **统计 indegree（入度）& outdegree（出度）+ DFS** 来确定所有情况

    -   **有环**：可能导致 无限循环，找不到根节点，产生无法访问独立的连通域
    -   **孤立节点、多个连通域**：只从一个节点出发，可能无法访问到所有节点
    -   **菊花图**：可能导致 性能问题

### Concise

-   通过逻辑推导，**有的变量可以通过已有的数据推导出来。** 去掉多余的变量，简化逻辑

-   **匹配和处理字符串，用 Regular Expression 正则表达式**

-   可以用 `Math.max(…)`, `Math.min(…)` 简化条件语句；

    不过总是赋值会让耗时变长（可以先 if 判断，有必要再赋值）

-   **处理链表时，可以考虑添加一个 Dummy Head 来简化代码逻辑**

    e.g. [剑指 Offer 25. 合并两个排序的链表](https://leetcode.cn/problems/he-bing-liang-ge-pai-xu-de-lian-biao-lcof/)

### Faster

-   用 **哈希表** 用空间换时间

    由于复杂的数据结构自身有一定的性能消耗，不一定能让耗时变短

    e.g. [剑指 Offer II 006. 排序数组中两个数字之和](https://leetcode.cn/problems/kLl5u1/)

    -   优化：是否可以使用 **一般数组 代替 哈希表**？

-   用 **位运算** 压缩所需内存空间，甚至可以缩短耗时

    e.g. [剑指 Offer II 005. 单词长度的最大乘积](https://leetcode.cn/problems/aseY1I/)

-   Two-Pointer Method（双指针法）

    -   A. prev & cur pointers

        e.g. [142. 环形链表 II](https://leetcode.cn/problems/linked-list-cycle-ii/) (using both A and B methods)

    -   B. slow & fast pointers

        -   slow : usually move 1 step every time

        -   fast : e.g.

            -   A. move 2 steps every time

            -   B. move K steps ahead

                e.g. [160. 相交链表](https://leetcode.cn/problems/intersection-of-two-linked-lists/) /
                [剑指 Offer 22. 链表中倒数第 k 个节点](https://leetcode.cn/problems/lian-biao-zhong-dao-shu-di-kge-jie-dian-lcof/)

    -   C. left & right pointers

        -   从左边向右边逼近，根据情况调整 [lf, rg] 区间范围

            e.g. [剑指 Offer II 006. 排序数组中两个数字之和](https://leetcode.cn/problems/kLl5u1/)

        -   从左右两边向中间逼近

            e.g. [剑指 Offer 21. 调整数组顺序使奇数位于偶数前面](https://leetcode.cn/problems/diao-zheng-shu-zu-shun-xu-shi-qi-shu-wei-yu-ou-shu-qian-mian-lcof/)

### Tricks

-   如何判断 **区间重叠** ？

    e.g. [start1, end1], [start2, end2] [836. 矩形重叠](https://leetcode.cn/problems/rectangle-overlap/)

    -   A. **max start < min end**
        ```python
        max(start1, start2) < min(end1, end2)`
        ```
    -   B. **not (max end <= min start)**
        ```python
        !(end1 <= start2 || end2 <= start1)
        ```

-   **Sliding Window**（滑动窗口）

    e.g. [2730. 找到最长的半重复子字符串](https://leetcode.cn/problems/find-the-longest-semi-repetitive-substring/) /
    [424. 替换后的最长重复字符](https://leetcode.cn/problems/longest-repeating-character-replacement/)

-   括号配对

    记录 open（未闭合的）括号数量，当 --open == 0 时配对成功

    e.g. [22. 括号生成](https://leetcode.cn/problems/generate-parentheses/) /
    [20. 有效的括号](https://leetcode.cn/problems/valid-parentheses/) /
    [385. 迷你语法分析器](https://leetcode.cn/problems/mini-parser/)

-   **Monotonic Stack**（单调栈）

    e.g. [42. 接雨水](https://leetcode.cn/problems/trapping-rain-water/) /
    [84. 柱状图中最大的矩形](https://leetcode.cn/problems/largest-rectangle-in-histogram/) /
    [1124. 表现良好的最长时间段](https://leetcode.cn/problems/longest-well-performing-interval/) /
    [456. 132 模式](https://leetcode.cn/problems/132-pattern/)

-   **Prefix & Suffix pre-process**（前后缀分解，预处理）

    e.g. [238. 除自身以外数组的乘积](https://leetcode.cn/problems/product-of-array-except-self/)

-   **找符合条件的 3 个数** 时，可以 **枚举中间的数** 来找答案！

    利用 **前后缀分解**：符合要求的 前面的数 和 后面的数 可以通过 前缀｜后缀 预处理得到。

    e.g. [456. 132 模式](https://leetcode.cn/problems/132-pattern/)（枚举中间的数对这题来说并非最优解，但容易想到）

### Mistakes

-   成对的逻辑要同时添加或修改，避免后面忘了。

    ```java
    // e.g.
    int result = 0; // 添加 result 变量时，
    // do something
    return result; // 就把 `return result;` 先加上。
    ```

-   递归时记得缩小问题的规模（边界）

    e.g. 快速排序中的 `ltIdx - 1` 和 `ltIdx + 1`

    ```java
    private int[] quickSort(int[] ary, int start, int end) {
        if (start >= end) {
            return ary;
        }

        // for example, use first element as pivot
        int ltIdx = start; // less than index
        for (int i = start + 1; i <= end; i++) {
            if (ary[i] < ary[start]) {
                swap(ary, i, ++ltIdx);
            }
        }
        swap(ary, start, ltIdx);

        quickSort(ary, start, ltIdx - 1);
        quickSort(ary, ltIdx + 1, end);
        return ary;
    }
    ```

-   计算 “空间 | 时间” 范围的数据时，剔除超过有效距离、最后期限的数据

    使用辅助信息来“剪枝”，简化时间和空间的复杂度。

    e.g. [剑指 Offer 59 - I. 滑动窗口的最大值](https://leetcode.cn/problems/hua-dong-chuang-kou-de-zui-da-zhi-lcof/) /
    [剑指 Offer II 016. 不含重复字符的最长子字符串](https://leetcode.cn/problems/wtcaE1/)

    -   技巧：记录上一次目标出现时的 index。

-   **寻找极值时，记得初始化极值！**

    -   找最小值时，将 min 初始化为最大值，或者候选值之一

        ```java
        int min = Integer.MAX_VALUE;
        // or
        int min = nums[0];
        ```

    -   找最大值时，将 max 初始化为最小值，或者侯选值之一

        ```java
        int max = Integer.MIN_VALUE;
        // or
        int max = nums[0];
        ```

-   **记得最后一次处理！**

    ```java
    // e.g. 应该进行处理的时刻 [0, n]
    for (int i = 0; i < n; i++) {
        // do something
    }
    // NOTE: 经常会忘记最后一次处理！
    // do something
    ```
