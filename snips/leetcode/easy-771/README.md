https://leetcode.com/problems/jewels-and-stones/

```php
class Solution {
    function numJewelsInStones($J, $S) {
        $map = [];
        $jLen = count($J);
        for ($i = 0; $i < $jLen; ++$i) {
            $map[$J[$i]] = true;
        }

        $matchCount = 0;
        $sLen = count($S);
        for ($i = 0; $i < $sLen; ++$i) {
            if ($map[$S[$i]] === true) {
                ++$matchCount;
            }
        }
        return $matchCount;
    }
}
```

```go
func numJewelsInStones(J string, S string) int {
    chMap := make(map[int32]bool)
    for _, ch := range J {
        chMap[ch] = true
    }

    cnt := 0
    for _, ch := range S {
        //if val, ok := chMap[ch]; ok {
        //    fmt.Println(val)
        if chMap[ch] {
            cnt++
        }
    }

    return cnt
}
```

to fix

```python
class Solution:
    def numJewelsInStones(self, J, S):
        """
        :type J: str
        :type S: str
        :rtype: int
        """
        map = {}
        for c in J:
            map[c] = True

        cnt = 0
        for c in S:
            if map[c] == True:
                cnt++

        return cnt
```