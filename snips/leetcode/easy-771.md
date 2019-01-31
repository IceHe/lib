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
