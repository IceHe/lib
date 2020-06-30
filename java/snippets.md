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

## primitive types

long & double

```java
……
    public static void main(String[] args) {
        long midL = 4305912891445794L; // 16 位数
        double midD = (double) midL;
        // long 范围 -9,223,372,036,854,775,808 ~ 9,223,372,036,854,775,807

        double flags = 12;
        while (flags > 1) {
            flags /= 10;
        }
        double midWithFlagsD = midD + flags;
        // 4305912891445794.12

        System.out.println(midWithFlagsD);
        // output 4.305912891445794E15
        // double 有效位数为 15 位
        // 新添加小数部分，被截断了
        // 还是 4305912891445794
    }
……
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

## sql

### query count

```java
String sql = "SELECT count(*) FROM ? …";
int count = jdbcInfo.getJdbcTemplate().queryForInt(sql, params);
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

### toArray

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

## Executor

References

- https://blog.csdn.net/chzphoenix/article/details/78968075
- Java并发编程：线程池的使用 - Matrix海子 - 博客园 : https://www.cnblogs.com/dolphin0520/p/3932921.html
- https://blog.csdn.net/wqh8522/article/details/79224290

TODO : 暂时没有找到合适的样例

### Future

References : JFGI

TODO : 暂时没有找到合适的样例

## FastJson

```java
import java.util.Map;
import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.TypeReference;

public class Test {
    public static void main(String[] args) {
        String jsonString =
                "{\"aInt\":1,\"bStr\":\"boy\",\"cBool\":true,\"dNull\":null,\"eDouble\":3.14}";
        Map<String, Object> map =
                JSON.parseObject(jsonString, new TypeReference<Map<String, Object>>() {});
        System.out.println(map);
    }
}

```

## Jackson

### JsonUtil

```java
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import com.alibaba.common.lang.StringUtil;
import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.core.JsonParser.Feature;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.*;
import com.fasterxml.jackson.datatype.jsr310.JavaTimeModule;
import lombok.experimental.UtilityClass;

@UtilityClass
public class JsonUtil {

    private final ObjectMapper mapper = new ObjectMapper();

    static {
        // 如果实体包含了意料之外的字段, 反序列化时不抛出异常
        mapper.configure(DeserializationFeature.FAIL_ON_UNKNOWN_PROPERTIES, false);

        // 空的对象转换为 JSON 时不抛出错误
        mapper.disable(SerializationFeature.FAIL_ON_EMPTY_BEANS);

        // 允许属性名称没有引号
        mapper.configure(Feature.ALLOW_UNQUOTED_FIELD_NAMES, true);

        // 允许单引号
        mapper.configure(Feature.ALLOW_SINGLE_QUOTES, true);

        // JsonInclude.Include.NON_EMPTY 属性为 空 ("") 或者为 null 时都不序列化，即返回的 json 没这个字段 ( 数据大小更小 )
        mapper.setSerializationInclusion(JsonInclude.Include.NON_EMPTY);

        // LocalDateTime 的序列化 : 效果如 "2020-06-30T11:51:00.666"
        mapper.registerModule(new JavaTimeModule());
        mapper.disable(SerializationFeature.WRITE_DATES_AS_TIMESTAMPS);
    }

    public String toStr(Object object) {
        try {
            return mapper.writeValueAsString(object);
        } catch (JsonProcessingException e) {
            return null;
        }
    }

    public <T> T parse(String content, Class<T> valueType) {
        if (StringUtil.isEmpty(content)) {
            return null;
        }
        try {
            return mapper.readValue(content, valueType);
        } catch (IOException e) {
            return null;
        }
    }

    public <T> List<T> parseList(String content, Class<T> valueType) throws IOException {
        return mapper.readValue(content, new TypeReference<ArrayList<T>>() {});
    }
}
```

### LocalDateTime Serializer

References

- Jackson Date | Baeldung : https://www.baeldung.com/jackson-serialize-dates#custom-serializer

```java
import java.io.IOException;
import java.time.LocalDateTime;
import java.time.ZoneId;

import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.databind.SerializerProvider;
import com.fasterxml.jackson.databind.ser.std.StdSerializer;

/**
 * 转换 LocalDateTime 为毫秒数的序列化器
 */
public class LocalDateTime2MillisSerializer extends StdSerializer<LocalDateTime> {

    public LocalDateTime2MillisSerializer() {
        this(null);
    }

    public LocalDateTime2MillisSerializer(Class<LocalDateTime> t) {
        super(t);
    }

    @Override
    public void serialize(
            LocalDateTime localDateTime, JsonGenerator gen, SerializerProvider provider)
            throws IOException {
        if (null == localDateTime) {
            gen.writeNull();
            return;
        }
        ZoneId zoneId = ZoneId.systemDefault();
        long millis = localDateTime.atZone(zoneId).toInstant().toEpochMilli();
        gen.writeNumber(millis);
    }
}
```

```java
public class TestDTO {
    @JsonSerialize(using = LocalDateTime2MillisSerializer.class)
    private LocalDateTime createdAt;
}
```

### LocalDateTime Deserializer

```java
import java.io.IOException;
import java.time.*;
import java.time.format.DateTimeFormatter;

import com.fasterxml.jackson.core.JsonParser;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.DeserializationContext;
import com.fasterxml.jackson.databind.deser.std.StdDeserializer;

/**
 * 转换毫秒数或字符串类型的时间戳转换为 LocalDateTime 的反序列化器
 */
public class MillisOrString2LocalDateTimeDeserializer extends StdDeserializer<Object> {

    public MillisOrString2LocalDateTimeDeserializer() {
        this(null);
    }

    public MillisOrString2LocalDateTimeDeserializer(Class<Object> t) {
        super(t);
    }

    @Override
    public Object deserialize(JsonParser p, DeserializationContext ctxt)
            throws IOException, JsonProcessingException {

        // 兼容毫秒数
        try {
            Long millis = p.readValueAs(Long.class);
            LocalDateTime localDateTime =
                    LocalDateTime.ofInstant(Instant.ofEpochMilli(millis), ZoneId.systemDefault());
            return localDateTime;
        } catch (IOException e) {
            // do nothing
        }

        // 兼容毫秒数
        try {
            String dateTimeStr = p.readValueAs(String.class);
            LocalDateTime localDateTime =
                    LocalDateTime.parse(dateTimeStr, DateTimeFormatter.ISO_LOCAL_DATE_TIME);
            return localDateTime;
        } catch (IOException e) {
            // do nothing
        }

        return null;
    }
}
```

```java
public class TestDTO {
    @JsonSerialize(using = LocalDateTime2MillisSerializer.class)
    @JsonDeserialize(using = MillisOrString2LocalDateTimeDeserializer.class)
    private LocalDateTime createdAt;
}
```

Reference

- Custom JSON Deserialization with Jackson - Stack Overflow : https://stackoverflow.com/questions/19158345/custom-json-deserialization-with-jackson

### LocalDateTime

```java
import java.time.*;
import java.time.format.DateTimeFormatter;
import java.util.Date;

import lombok.experimental.UtilityClass;
import me.ele.jarch.gzs.util.StringUtil;

@UtilityClass
public class LocalDateTimeUtils {

    /** 默认的日期时间的格式化器 : 例如 "2019-08-13 17:54:30" */
    public final DateTimeFormatter DEFAULT_DATETIME_FMT =
            DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");

    public Date toDate(LocalDateTime localDateTime) {
        return Date.from(localDateTime.atZone(ZoneId.systemDefault()).toInstant());
    }

    public Long toMillis(LocalDateTime localDateTime) {
        if (null == localDateTime) {
            return null;
        }
        return localDateTime.atZone(ZoneId.systemDefault()).toInstant().toEpochMilli();
    }

    public Long toSeconds(LocalDateTime localDateTime) {
        if (null == localDateTime) {
            return null;
        }
        return localDateTime.atZone(ZoneId.systemDefault()).toEpochSecond();
    }

    public LocalDateTime fromString(String str) {
        if (StringUtil.isBlank(str)) {
            return null;
        }
        try {
            return LocalDateTime.parse(str, DEFAULT_DATETIME_FMT);
        } catch (Exception e) {
            return null;
        }
    }

    public LocalDateTime fromDate(Date date) {
        if (null == date) {
            return null;
        }
        return fromMillis(date.getTime());
    }

    public LocalDateTime fromMillis(Long millis) {
        if (null == millis) {
            return null;
        }
        return LocalDateTime.ofInstant(Instant.ofEpochMilli(millis), ZoneId.systemDefault());
    }

    public LocalDateTime fromSeconds(Long seconds) {
        if (null == seconds) {
            return null;
        }
        return LocalDateTime.ofInstant(Instant.ofEpochSecond(seconds), ZoneId.systemDefault());
    }
}
```

# StringParsableUtils

```java

package xyz.icehe.response;

import com.alibaba.common.lang.StringUtil;
import lombok.experimental.UtilityClass;

import java.time.LocalDateTime;
import java.util.Objects;
import java.util.function.Function;

@UtilityClass
public class StringParsableUtils {

    public boolean isInteger(String string) {
        return isStringParsable(string, Integer::parseInt);
    }

    public boolean isLong(String string) {
        return isStringParsable(string, Long::parseLong);
    }

    public boolean isDouble(String string) {
        return isStringParsable(string, Double::parseDouble);
    }

    public boolean isDateTime(String string) {
        return isStringParsable(string, LocalDateTime::parse);
    }

    private <T> Boolean isStringParsable(
            String string, Function<? super String, T> parsingFunction) {
        return parseByFunction(string, parsingFunction) != null;
    }

    private <T> T parseByFunction(
            String string, Function<? super String, T> parsingFunction) {

        Objects.requireNonNull(parsingFunction, "parsingFunction must not be null";

        if (StringUtil.isBlank(string)) {
            return null;
        }

        try {
            return parsingFunction.apply(string);
        } catch (Exception e) {
            return null;
        }
    }
}

```