package main

// https://leetcode.com/problems/robot-return-to-origin/

import (
	"fmt"
)

func judgeCircle(moves string) bool {
	x := 0
	y := 0

	for _, v := range moves {
		if v == 'U' {
			y++
		} else if v == 'D' {
			y--
		} else if v == 'L' {
			x--
		} else if v == 'R' {
			x++
		} else {
			return false
		}
	}

	return x == 0 && y == 0
}

func main() {
	moves := "UDLR"
	fmt.Println(moves)
	fmt.Println(judgeCircle(moves))
}
