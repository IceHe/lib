package main

// https://leetcode.com/problems/n-repeated-element-in-size-2n-array/

import (
	"fmt"
)

// Runtime: 36 ms, faster than 97.67% of Go online submissions for N-Repeated Element in Size 2N Array.
// Memory Usage: 5.2 MB, less than 100.00% of Go online submissions for N-Repeated Element in Size 2N Array.

func repeatedNTimes(A []int) int {
	set := make(map[int]int)
	for _, v := range A {
		if _, ok := set[v]; ok {
			return v
		} else {
			set[v] = 1
		}
	}
	return 0
}

func main() {
	A := []int{1, 2, 3, 3}
	fmt.Println(A)
	fmt.Println(repeatedNTimes(A))
}
