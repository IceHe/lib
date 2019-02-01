package main

import (
	"fmt"
)

func main() {
	A := []int{1, 2, 3, 3}
	fmt.Println(A)
	fmt.Println(repeatedNTimes(A))
}

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
