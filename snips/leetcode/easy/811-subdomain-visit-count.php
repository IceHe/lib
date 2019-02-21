<?php

// https://leetcode.com/problems/subdomain-visit-count/

//Runtime: 24 ms, faster than 50.00% of PHP online submissions for Subdomain Visit Count.
//Memory Usage: 14.8 MB, less than 100.00% of PHP online submissions for Subdomain Visit Count.

class Solution {

    /**
     * @param String[] $cpdomains
     * @return String[]
     */
    function subdomainVisits($cpdomains) {
        $cntAry = [];
        foreach ($cpdomains as $cpdomain) {
            [$cnt, $fullDomain] = explode(' ', $cpdomain);

            $slices = explode('.', $fullDomain);
            $len = count($slices);
            for ($i = 0; $i < $len; $i++) {
                $subDomain = join('.', array_slice($slices, $i));
                $cntAry[$subDomain] = ($cntAry[$subDomain] ?? 0) + $cnt;
            }
        }

        foreach ($cntAry as $domain => $cnt) {
            $cntAry[$domain] = "${cnt} ${domain}";
        }

        return array_values($cntAry);
    }
}

$solution = new Solution();

$cpdomains = ["9001 discuss.leetcode.com"];
echo var_export($solution->subdomainVisits($cpdomains), true)."\n";

$cpdomains = ["900 google.mail.com", "50 yahoo.com", "1 intel.mail.com", "5 wiki.org"];
echo var_export($solution->subdomainVisits($cpdomains), true)."\n";
