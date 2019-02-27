package easy.e884;

import java.util.*;

class Solution {
    public String[] uncommonFromSentences(String A, String B) {
        if (A == null || A.isEmpty() || B == null || B.isEmpty()) {
            return null;
        }

        List<String> words = new ArrayList<>();
        words.addAll(Arrays.asList(A.split(" ")));
        words.addAll(Arrays.asList(B.split(" ")));

        Map<String, Integer> cntMap = new HashMap<>();

        for (String word : words) {
            cntMap.put(word, cntMap.getOrDefault(word, 0) + 1);
        }

        List<String> uniqueWordList = new ArrayList();
        for (Map.Entry entry : cntMap.entrySet()) {
            if ((Integer)entry.getValue() == 1) {
                uniqueWordList.add((String)entry.getKey());
            }
        }

        return uniqueWordList.toArray(new String[uniqueWordList.size()]);

//        String[] uniqueWordAry = (String[])cntMap.entrySet().stream()
//                .filter(entry -> entry.getValue() == 1)
//                .map(Map.Entry::getKey)
//                .toArray();
//
//        return uniqueWordAry;
    }

    public static void main(String[] args) {
        String A = "this apple is sweet";
        String B = "this apple is sour";

        for (String word : (new Solution().uncommonFromSentences(A, B))) {
            System.out.println(word);
        }
    }
}


