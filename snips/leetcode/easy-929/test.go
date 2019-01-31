package main

import (
	"fmt"
	"strings"
)

func main() {
	emails := []string{
		"test.email+alex@leetcode.com",
		"test.e.mail+bob.cathy@leetcode.com",
		"testemail+david@lee.tcode.com",
	}

	fmt.Println(emails)
	fmt.Println(numUniqueEmails(emails))
}

func numUniqueEmails(emails []string) int {
	cnt := 0
	mailMap := make(map[string]bool)
	for _, mail := range emails {
		atIndex := strings.Index(mail, "@")
		localName := mail[:atIndex]

		plusIndex := strings.Index(mail, "+")
		validLocalName := localName[:plusIndex]

		validLocalName = strings.Replace(validLocalName, ".", "", -1)
		validFullName := validLocalName + mail[atIndex:]

		if _, ok := mailMap[validFullName]; !ok {
			cnt++
			mailMap[validFullName] = true
		}
	}
	return cnt
}

