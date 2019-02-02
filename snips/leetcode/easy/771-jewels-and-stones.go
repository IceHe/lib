package main

// https://leetcode.com/problems/jewels-and-stones/

import (
	"fmt"
)

// Runtime: 0 ms, faster than 100.00% of Go online submissions for Jewels and Stones.
// Memory Usage: 1.1 MB, less than 62.50% of Go online submissions for Jewels and Stones.

func numJewelsInStones(J string, S string) int {
	chMap := make(map[int32]bool)
	for _, ch := range J {
		chMap[ch] = true
	}

	cnt := 0
	for _, ch := range S {
		//if val, ok := chMap[ch]; ok {
		//	fmt.Println(val)
		if chMap[ch] {
			cnt++
		}
	}

	return cnt
}

func main() {
	J := "aA"
	S := "aAAbbbb"
	fmt.Println(J)
	fmt.Println(S)
	fmt.Println(numJewelsInStones(J, S))
}
