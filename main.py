from typing import List

class Solution:
    def row(self, ch):
        if ch in 'qwertyuiop':
            return 1
        if ch in 'asdfghjkl':
            return 2
        if ch in 'zxcvbnm':
            return 3

    def is_in_one_row(self, word):
        return all(self.row(word[0].lower()) == self.row(ch) for ch in word.lower())

    def findWords(self, words: List[str]) -> List[str]:
        return list(filter(self.is_in_one_row, words))

print(Solution().findWords(["Hello","Alaska","Dad","Peace"]))
