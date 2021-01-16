package easy.e884;

import java.util.HashMap;
import java.util.Map;
import java.util.stream.Collectors;

// 884-uncommon-words-from-two-sentences
// https://leetcode.com/problems/uncommon-words-from-two-sentences

//Runtime: 5 ms, faster than 98.98% of Java online submissions for Uncommon Words from Two Sentences.
//Memory Usage: 37.4 MB, less than 37.85% of Java online submissions for Uncommon Words from Two Sentences.

//class Solution {
//    public String[] uncommonFromSentences(String A, String B) {
//        if (A == null || A.isEmpty() || B == null || B.isEmpty()) {
//            return null;
//        }
//
//        List<String> words = new ArrayList<>();
//        words.addAll(Arrays.asList(A.split(" ")));
//        words.addAll(Arrays.asList(B.split(" ")));
//
//        Map<String, Integer> cntMap = new HashMap<>();
//
//        for (String word : words) {
//            cntMap.put(word, cntMap.getOrDefault(word, 0) + 1);
//        }
//
//        List<String> uniqueWordList = new ArrayList<>();
//        for (Map.Entry entry : cntMap.entrySet()) {
//            if ((Integer)entry.getValue() == 1) {
//                uniqueWordList.add((String)entry.getKey());
//            }
//        }
//
//        return uniqueWordList.toArray(new String[uniqueWordList.size()]);
//    }

//Runtime: 4 ms, faster than 100.00% of Java online submissions for Uncommon Words from Two Sentences.
//Memory Usage: 37.3 MB, less than 74.58% of Java online submissions for Uncommon Words from Two Sentences.

//class Solution {
//    public String[] uncommonFromSentences(String A, String B) {
//        Map<String, Integer> wordCountMap = new HashMap<>();
//        for (String word : (A + " " + B).split(" ")) {
//            wordCountMap.put(word, wordCountMap.getOrDefault(word, 0) + 1);
//        }
//
//        List<String> uniqueWords = new ArrayList<>();
//        for (Map.Entry entry : wordCountMap.entrySet()) {
//            if ((Integer)entry.getValue() == 1) {
//                uniqueWords.add((String)entry.getKey());
//            }
//        }
//
//        return uniqueWords.toArray(new String[uniqueWords.size()]);
//    }

class Solution {
    public String[] uncommonFromSentences(String A, String B) {
        Map<String, Integer> wordCountMap = new HashMap<>();
        for (String word : (A + " " + B).split(" ")) {
            wordCountMap.put(word, wordCountMap.getOrDefault(word, 0) + 1);
        }

        return wordCountMap.entrySet().stream()
                .filter(entry -> entry.getValue() == 1)
                .map(Map.Entry::getKey)
                .collect(Collectors.toList())
                .toArray(new String[0]);
    }

    public static void main(String[] args) {
        String A = "this apple is sweet";
        String B = "this apple is sour";

        for (String word : (new Solution().uncommonFromSentences(A, B))) {
            System.out.println(word);
        }
    }
}


