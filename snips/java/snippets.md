# Java Snippets

TODO

## cast

to String

- Object
- byte[]
- boolean
- char[]
- char
- int
- long
- float
- double

```java
String.valueOf(new Object());
// e.g. "java.lang.Object@3bd40a57"
```

format

```java
String.format("%s, %s!", "Hello", "world");
```

String to other types

```java
Integer intVar = Integer.parseInt("11");
Float floatVar = Float.parseFloat("1.2");
```

## conditional

Collection

```java
CollectionUtils.isEmpty(collection)
CollectionUtils.isNotEmpty(collection)
```

## enum

```java
package xyz.icehe.type;

import com.google.common.collect.ImmutableSet;
import org.apache.commons.lang.StringUtils;

import java.util.Set;

public enum Young {

    BOY("BOY"),
    GIRL("GIRL"),
    ;

    public static final Set<Young> VALUES
            = ImmutableSet.copyOf(values());

    private String value;

    Young(String value) {
        this.value = value;
    }

    public static Young parse(String value) {
        if (StringUtils.isBlank(value)) {
            return null;
        }

        for (Young young : values()) {
            if (young.equals(value)) {
                return young;
            }
        }

        return null;
    }

    public static boolean isValidYoung(String value) {
        return null != parse(value);
    }

    public String getValue() {
        return value;
    }

    public String toString() {
        return value;
    }

}

```

## new

### List

```java
import java.util.Arrays;
List<Integer> intList = Arrays.asList(1, 2, 3);
```

### Set

Set

```java
import com.google.common.collect.Sets;
Set<Integer> intSet = Sets.newHashSet(1, 2, 3);
```

Immutable Set

```java
import com.google.common.collect.ImmutableSet;
public static final Set<String> CONSTANTS = ImmutableSet.of(AAA, SSS);
```

### empty collections

```java
Collections.emptyList();
Collections.emptySet();
Collections.emptyMap();

// generic type
Collections.<String>emptySet();
……
```

## optinal

Optional.ofNullable(…).ifPresent(…);

```java
Optional.ofNullable(map.get("content"))
        .ifPresent(it -> doSomething.withContent((Map<String, Object>) content));
```

## sort

```java
Map<String, List<Long>> keyValuesMap = getKeyValuesMap();

// 返回结果是乱序的；
// 需要根据输入参数 valueList 中 value 的原始顺序，重新排列好
keyValuesMap.forEach((key, vals) -> Collections.
        sort(vals, Comparator.comparingInt(val -> valueList.indexOf(val))));
```

## split

List Partion

- https://stackoverflow.com/questions/2895342/java-how-can-i-split-an-arraylist-in-multiple-small-arraylists

```java
List<List<String>> listPartions = Lists.partition(list, 50);
```

## stream

### collect

```java
List<Long> longList = ……;
Map<Double, String> scoreValues = longList.stream()
        .collect(Collectors.toMap(val -> (double) val, val -> String.valueOf(val)));
```

### concat

concat integers with ","

```java
import java.util.stream.Collectors;
Set<Integer> intSet = Sets.newHashSet(1, 2, 3);
String str = intSet.stream()
        .map(elem -> String.valueOf(elem)) // cast Integer to String
        .collect(Collectors.joining(",")); // concat with charactor ","
```

### filter

filter blank string

```java
List<String> list0 = Arrays.asList("a", "", "b");
List<String> list1 = list0.stream()
        .filter(Objects::isnull)
        .filter(Objects::nonNull) // or
        .filter(StringUtils::isNotBlank) // or
        .collect(Collectors.toList());
```
