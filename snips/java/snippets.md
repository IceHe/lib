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

List

```java
import java.util.Arrays;
List<Integer> intList = Arrays.asList(1, 2, 3);
```

Empty List

```java
Collections.emptyList();
```

Set

```java
import com.google.common.collect.Sets;
Set<Integer> intSet = Sets.newHashSet(1, 2, 3);
```

## conditional

Collection

```bash
CollectionUtils.isEmpty(collection)
CollectionUtils.isNotEmpty(collection)
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
        .filter(StringUtils::isNotBlank)
        .collect(Collectors.toList());
```

## optinal

Optional.ofNullable(…).ifPresent(…);

```java
Optional.ofNullable(map.get("content"))
        .ifPresent(it -> doSomething.withContent((Map<String, Object>) content));
```
