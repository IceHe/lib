package main

// https://leetcode.com/problems/unique-email-addresses

import (
	"fmt"
	"strings"
)

// Runtime: 12 ms, faster than 89.83% of Go online submissions for Unique Email Addresses.
// Memory Usage: 4.7 MB, less than 94.59% of Go online submissions for Unique Email Addresses.

func numUniqueEmails(emails []string) int {
	cnt := 0
	mailMap := make(map[string]bool)
	for _, mail := range emails {
		atIndex := strings.Index(mail, "@")
		localName := mail[:atIndex]

        // 注意：若字符串中不含 `+` 符号，返回的下标是 -1 ！
		plusIndex := strings.Index(mail, "+")
		validLocalName := localName
		if plusIndex != -1 {
			validLocalName = localName[:plusIndex]
		}

		validLocalName = strings.Replace(validLocalName, ".", "", -1)
		validFullName := validLocalName + mail[atIndex:]

		if _, ok := mailMap[validFullName]; !ok {
			cnt++
			mailMap[validFullName] = true
		}
	}
	return cnt
}

func main() {
	emails := []string{
		"test.email+alex@leetcode.com",
		"test.e.mail+bob.cathy@leetcode.com",
		"testemail+david@lee.tcode.com",
	}

	fmt.Println(emails)
	fmt.Println(numUniqueEmails(emails))
}

