# Stream

## collect toMap

```java
List<Long> longList = Arrays.asList(1L, 2L); // given
Map<Double, String> scoreValues = longList.stream()
    .collect(Collectors.toMap(Double::valueOf, String::valueOf));

```

## concat strings

concat integers with ","

```java
import java.util.stream.Collectors;

Set<Integer> integerSet = Sets.newHashSet(1, 2, 3); // given
String str = integerSet.stream()
    .map(String::valueOf) // cast Integer to String ( using method reference )
    .collect(Collectors.joining(",")); // concat with charactor ","

```

## filter

Filter Blank Strings

```java
import org.apache.commons.lang3.StringUtils;

List<String> strings = Arrays.asList("a", "", "b"); // given
List<String> notBlankStrings = strings.stream()
    .filter(StringUtils::isNotBlank)
    .collect(Collectors.toList());

```

## sort

Sort Integer List

```java
Map<String, List<Long>> keyValuesMap = getKeyValuesMap();

// 返回结果是乱序的；
// 需要根据输入参数 valueList 中 value 的原始顺序，重新排列好
keyValuesMap.forEach((key, vals) ->
    Collections.sort(vals, Comparator.comparingInt(val -> valueList.indexOf(val))));

```

## Array T[] to List

```java
// e.g.
Arrays.stream(values()).collect(Collectors.toConcurrentMap(
        SomeEnum::getKey,
        SomeEnum::getVal)));
```

## Collection toArray

```java
return wordCountMap.entrySet().stream()
    .filter(entry -> entry.getValue() == 1)
    .map(Map.Entry::getKey)
    .collect(Collectors.toList())
    .toArray(new String[0]);
    // 关键点 new String[0]
    // 实际长度比较大，也会适应到指定的长度（震惊）！

    /**
        * 解释摘要：<T> T[] toArray(T[] a);
        * ……
        * Otherwise, a new
        * array is allocated with the runtime type of the specified array and
        * the size of this list.
        * ……
        */

```

## Create abstract Map.Entry

Create new Map.Entry(key, velue) using \*Utils

- How to create new Entry (key, value) - Stack Overflow : https://stackoverflow.com/questions/3110547/java-how-to-create-new-entry-key-value

```java
import java.util.AbstractMap;

Map.Entry<String,Integer> entry =
    new AbstractMap.SimpleEntry<String, Integer>("exmpleString", 42);

```

## Find Duplicate Objects

使用 Strean 找出重复的对象

- Find duplicates using Java 8 lambda : https://carsten-luxig.de/find-duplicated-items-in-2-collections-with-lambda-expressions

```java
Stream<Entry<String, List<Item>>> duplicates = merged
        .collect(Collectors.groupingBy(Item::getId)))
        .entrySet().stream()
        .filter(e -> e.getValue() > 1);

```

# Optinal

Optional.ofNullable(…).ifPresent(…);

```java
Optional.ofNullable(map.get("content"))
        .ifPresent(it -> doSomething.withContent((Map<String, Object>) content));

```

Optional.ofNullable(…).orElseThrow(() -> new Exception());

```java
Optional.ofNullable(someObject)
    .orElseThrow(() -> new NullPointerException("null object"));

```

Optional.ofNullable(…).filter(…).map(…).orElse(…)

```java
Optional.ofNullable(someObject)
    .filter(Objects::nonNull)
    // or
    // .filter(t -> null != t)
    .map(JsonUtil::toJsonString)
    // or
    // .map(t -> JsonUtil.toJsonString(t))
    .orElse("");

```

Optional.of(…).….get()

```java
// if someObject must not be null
Optional.of(someObject).map(t -> t.getSomeField()).get()

```
