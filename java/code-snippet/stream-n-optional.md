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

## sort, max, min

### Collections.sort

Sort integer list

```java
Map<String, List<Long>> key2ValuesMap = getKey2ValuesMap();

// 返回结果是乱序的；
// 需要根据输入参数 valueList 中 value 的原始顺序，重新排列好
key2ValuesMap.forEach((key, vals) ->
    Collections.sort(vals, Comparator.comparingInt(val -> valueList.indexOf(val))));

```

### sorted

Sort by multiple comparators

```java
List<WarehouseEnum> recommendedWarehouses = warehouse2StockCheckResultMap.entrySet().stream()
        .sorted(Comparator.comparingInt(
                // 1. 库存充足的仓库 排在前面
                (Map.Entry<WarehouseEnum, StockCheckResult> entry) -> {
                    StockCheckResult stockCheckResult = entry.getValue();
                    boolean isInventoriesEnough = CollectionUtils.isEmpty(stockCheckResult.getNotEnoughInventories());
                    return isInventoriesEnough ? 0 : 1;
                })
                // 2. 库存不充足仓库中, 物料种类缺得最少的仓库 排在前面
                .thenComparing((Map.Entry<WarehouseEnum, StockCheckResult> entry) -> {
                    StockCheckResult stockCheckResult = entry.getValue();
                    return stockCheckResult.getNotEnoughInventories().size();
                })
                // 3. 库存不充足而且物料种类缺得一样多的仓库中, 物料数量缺得最少的仓库 排在前面
                .thenComparing((Map.Entry<WarehouseEnum, StockCheckResult> entry) -> {
                    WarehouseEnum warehouse = entry.getKey();
                    StockCheckResult stockCheckResult = entry.getValue();

                    Map<WarehouseEnum, Map<InventoryKey, Integer>> warehouse2Inventory2QuantityMap =
                            stockCheckResult.getWarehouse2Inventory2QuantityMap();
                    Map<InventoryKey, Integer> inventory2QuantityMap =
                            warehouse2Inventory2QuantityMap.getOrDefault(warehouse, Collections.emptyMap());

                    int quantityTotal = inventory2QuantityMap.values().stream()
                            .mapToInt(Integer::valueOf)
                            .sum();
                    return quantityTotal;
                })
                // 4. 以上的库存情况都相同的仓库, 编号(number)小的仓库 排在前面
                .thenComparing((Map.Entry<WarehouseEnum, StockCheckResult> entry) -> {
                    WarehouseEnum warehouse = entry.getKey();
                    return warehouse.getNumber();
                })
                // *. 如需逆序, 可调用 reversed()
                // .reversed()
        )
        .map(Map.Entry::getKey)
        .toList(Collectors.toList());
```

### max, min

```java
Obj maxObj = objs.stream().max(
    Comparator.comparing(keyExtractor, keyComparator)
             .thenComparing(antoherKeyExtractor));
```

## Array T[] to List

```java
Arrays.stream(SomeEnum.values()).collect(Collectors.toConcurrentMap(
        SomeEnum::getKey,
        SomeEnum::getVal));

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

-   How to create new Entry (key, value) - Stack Overflow : https://stackoverflow.com/questions/3110547/java-how-to-create-new-entry-key-value

```java
import java.util.AbstractMap;

Map.Entry<String,Integer> entry =
    new AbstractMap.SimpleEntry<String, Integer>("exmpleString", 42);

```

## Find duplicates

使用 Stream 找出重复的对象

-   Find duplicates using Java 8 lambda : https://carsten-luxig.de/find-duplicated-items-in-2-collections-with-lambda-expressions

```java
Stream<Entry<String, List<Item>>> duplicates = merged
        .collect(Collectors.groupingBy(Item::getId)))
        .entrySet().stream()
        .filter(e -> e.getValue() > 1);

```

# Optional

Optional.ofNullable(…).ifPresent(…);

```java
Optional.ofNullable(map.get("content"))
        .ifPresent(it -> doSomethingWith(content));

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
