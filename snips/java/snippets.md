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

## new

### List

List

```java
import java.util.Arrays;
List<Integer> intList = Arrays.asList(1, 2, 3);
```

Empty List

```java
Collections.emptyList();
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

## conditional

Collection

```java
CollectionUtils.isEmpty(collection)
CollectionUtils.isNotEmpty(collection)
```

## split

List Partion

- https://stackoverflow.com/questions/2895342/java-how-can-i-split-an-arraylist-in-multiple-small-arraylists

```java
List<List<String>> listPartions = Lists.partition(list, 50);
```

## stream

concat integers with ","

```java
import java.util.stream.Collectors;
Set<Integer> intSet = Sets.newHashSet(1, 2, 3);
String str = intSet.stream()
        .map(elem -> String.valueOf(elem)) // cast Integer to String
        .collect(Collectors.joining(",")); // concat with charactor ","
```

filter blank string

```java
List<String> list0 = Arrays.asList("a", "", "b");
List<String> list1 = list0.stream()
        .filter(Objects::isNull)
        .filter(Objects::nonNull) // or
        .filter(StringUtils::isNotBlank) // or
        .collect(Collectors.toList());
```

## optinal

Optional.ofNullable(…).ifPresent(…);

```java
Optional.ofNullable(map.get("content"))
        .ifPresent(it -> doSomething.withContent((Map<String, Object>) content));
```
