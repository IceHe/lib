package main

import (
	"fmt"
)

func main() {
	J := "aA"
	S := "aAAbbbb"
	fmt.Println(J)
	fmt.Println(S)
	fmt.Println(numJewelsInStones(J, S))
}

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
