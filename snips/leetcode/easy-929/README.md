https://leetcode.com/problems/unique-email-addresses

```php
// 0
class Solution {
    function numUniqueEmails($emails) {
        $cnt = 0;
        $uniqueEmails = [];
        foreach ($emails as $email) {
            $names = explode('@', $email);
            $localName = $names[0] ?? '';
            $domainName = $names[1] ?? '';

            $parts = explode('+', $localName);
            $validPart = $parts[0] ?? '';
            $validPart = str_replace('.', '', $validPart);

            $validEmail = $validPart.$domainName;
            if ($uniqueEmails[$validEmail] ?? true) {
                $uniqueEmails[$validEmail] = false;
                $cnt++;
            }
        }
        return $cnt;
    }
}
```

```php
// 1
class Solution {
    function numUniqueEmails($emails) {
        $cnt = 0;
        $uniqueEmails = [];
        foreach ($emails as $email) {
            $atIndex = strpos($email, '@');
            $localName = substr($email, 0, $atIndex);
            $domainName = substr($email, $atIndex);

            $plusIndex = strpos($email, '+');
            $validPart = substr($localName, 0, $plusIndex);
            $validPart = str_replace('.', '', $validPart);

            $validEmail = $validPart.$domainName;
            if ($uniqueEmails[$validEmail] ?? true) {
                $uniqueEmails[$validEmail] = false;
                $cnt++;
            }
        }
        return $cnt;
    }
}
```
