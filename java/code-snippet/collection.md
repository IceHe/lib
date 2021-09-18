# Collection

## Conditional

```java
import org.springframework.util.CollectionUtils;

CollectionUtils.isEmpty(collection)
CollectionUtils.isNotEmpty(collection)

```

## Create

### Common

```java
// Java built-in
import java.util.Arrays;
// Guava
import com.google.common.collect.Lists;
import com.google.common.collect.Maps;
import com.google.common.collect.Sets;
// ……

List<Integer> integerList = Arrays.asList(1, 2, 3);
List<Integer> integerList2 = Lists.newArrayList(4, 5, 6);
Set<Integer> integerSet = Sets.newHashSet(1, 2, 3);
// ……

```

### Empty

```java
import java.util.Collections;

Collections.emptyList();
Collections.emptySet();
Collections.emptyMap();

// generic type
Collections.<String>emptySet();

```

### Immutable

```java
import com.google.common.collect.ImmutableList;
import com.google.common.collect.ImmutableMap;
import com.google.common.collect.ImmutableSet;

public static final Set<String> STRING_SET = ImmutableSet.of("foo", "bar");
public static final List<Integer> INTEGER_LISTRS = ImmutableList.of(1, 2, 3);
public static final Map<String, String> NEXT_SUCCESS_STATUS_MAP =
    ImmutableMap.<String, String>builder()
        .put("INVALID", "INVALID")
        .put("CREATED", "RUNNING")
        .put("RUNNING", "SUCCEEDED")
        .put("ABORTED", "RETRYING")
        .put("RETRYING", "SUCCEEDED")
        .put("FAILED", "FAILED")
        .put("SUCCEEDED", "SUCCEEDED")
        .build();

```

## Manipulate

### split

List Partion

- https://stackoverflow.com/questions/2895342/java-how-can-i-split-an-arraylist-in-multiple-small-arraylists

```java
import com.google.common.collect.Lists;

List<String> stringList = Lists.newArrayList(4, 5, 6); // given
List<List<String>> stringListPartions = Lists.partition(stringList, 50);

```

### Array to List

```java
import java.util.Arrays;

int[] ints = {1, 2, 3}; // given
Arrays.copyOf(ints, ints.length);

```