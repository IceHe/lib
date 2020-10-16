# Java Snippets

## String

### To String

```java
String.valueOf(new Object());
// e.g. "java.lang.Object@3bd40a57"
```

- Object
- byte[]
- boolean
- char[]
- char
- int
- long
- float
- double

### To Number

```java
Integer intVar = Integer.parseInt("11");
Float floatVar = Float.parseFloat("1.2");
```

### Format

```java
String.format("%s, %s!", "Hello", "world");
```

### Split

```java
import java.util.List;
import java.util.Map;
import java.util.Optional;
import java.util.Set;
import java.util.function.Function;
import java.util.stream.Collectors;
import java.util.stream.StreamSupport;

import com.google.common.base.Splitter;
import lombok.experimental.UtilityClass;

/**
 * 字符串切割工具集
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@UtilityClass
public class StringSplitUtils {

    private static final Splitter COMMA_SPLITTER =
            Splitter.onPattern("[,，]").omitEmptyStrings().trimResults();

    /** 将用逗号分隔的字符串, 分割后转换为 Long 集合 */
    public Set<Long> splitCommaSeparatedLongs(String str) {
        return splitCommaSeparatedStrings(str).stream()
                .filter(StringParsers::isLong)
                .map(Long::parseLong)
                .collect(Collectors.toSet());
    }

    /** 将用逗号分隔的字符串, 分割为字符串列表 */
    public List<String> splitCommaSeparatedStrings(String str) {
        return StreamSupport.stream(COMMA_SPLITTER.split(str).spliterator(), false)
                .collect(Collectors.toList());
    }
}
```

### Join

```java
import lombok.experimental.UtilityClass;
import org.springframework.util.CollectionUtils;

import java.util.Collection;
import java.util.stream.Collectors;

/**
 * 字符串连接工具集
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@UtilityClass
public class StringJoinUtils {

    private static final String COMMA = ",";

    /** 用英文逗号将对象列表拼接为字符串 */
    public <T> String joinWithComma(Collection<T> objects) {
        return joinWithSeparator(objects, COMMA);
    }

    /** 用指定分隔符将对象列表拼接为字符串 */
    private <T> String joinWithSeparator(Collection<T> objects, String separator) {
        if (CollectionUtils.isEmpty(objects)) {
            return "";
        }
        return objects.stream().map(String::valueOf).collect(Collectors.joining(separator));
    }
}
```

### Parse

```java
package me.ele.lpd.cs.yunying.util.string;

import lombok.experimental.UtilityClass;

import java.text.NumberFormat;
import java.text.ParseException;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.Objects;
import java.util.function.Function;

/**
 * 字符串解析工具集
 *
 * <p>用途:
 *
 * <ul>
 *   <li>将字符串解析为特定类型的对象
 *   <li>判断字符串是否可解析为特定类型的对象
 * </ul>
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@UtilityClass
public class StringParseUtils {

    /** 将代表数字的字符串转换为数字对象 */
    public Number parseStrToNumber(String numberStr) {

        if (StrUtils.isBlank(numberStr)) {
            return null;
        }

        try {
            return NumberFormat.getInstance().parse(numberStr);
        } catch (ParseException e) {
            return null;
        }
    }

    /** 判断字符串是否可以表示一个 Number 值 */
    public boolean isNumber(String string) {
        return isStringParsable(string, StringParseUtils::parseStrToNumber);
    }

    /** 判断字符串是否可以表示一个 Integer 值 */
    public boolean isInteger(String string) {
        return isStringParsable(string, Integer::parseInt);
    }

    /** 判断字符串是否可以表示一个 Long 值 */
    public boolean isLong(String string) {
        return isStringParsable(string, Long::parseLong);
    }

    /** 判断字符串是否可以表示一个 Double 值 */
    public boolean isDouble(String string) {
        return isStringParsable(string, Double::parseDouble);
    }

    /** 判断字符串是否可以表示一个 LocalDate 日期 */
    public boolean isDate(String string) {
        return isStringParsable(string, LocalDate::parse);
    }

    /** 判断字符串是否可以表示一个 LocalDateTime 日期时间 */
    public boolean isDateTime(String string) {
        return isStringParsable(string, LocalDateTime::parse);
    }

    /**
     * 通过闭包, 是否能将将字符串解析为一个指定类型的对象值
     *
     * @param string {@link String}
     * @param parsingFunction {@link Function}
     * @param <T> 解析的目标对象类型
     * @return 字符串是否能被解析
     */
    private <T> boolean isStringParsable(
            String string, Function<? super String, T> parsingFunction) {
        return parseByFunction(string, parsingFunction) != null;
    }

    /**
     * 通过闭包, 将字符串解析为一个指定类型的对象值
     *
     * @param string {@link String}
     * @param parsingFunction {@link Function}
     * @param <T> 解析的目标对象类型
     * @return 目标类型的解析对象值
     */
    private <T> T parseByFunction(String string, Function<? super String, T> parsingFunction) {

        Objects.requireNonNull(parsingFunction, "parsingFunction" + " 不能为 null");

        if (StrUtils.isBlank(string)) {
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

## Stream

### collect toMap

```java
List<Long> longList = Arrays.asList(1L, 2L); // given
Map<Double, String> scoreValues = longList.stream()
    .collect(Collectors.toMap(Double::valueOf, String::valueOf));
```

### concat strings

concat integers with ","

```java
import java.util.stream.Collectors;

Set<Integer> integerSet = Sets.newHashSet(1, 2, 3); // given
String str = integerSet.stream()
    .map(String::valueOf) // cast Integer to String ( using method reference )
    .collect(Collectors.joining(",")); // concat with charactor ","
```

### filter

filter blank string

```java
import org.apache.commons.lang3.StringUtils;

List<String> strings = Arrays.asList("a", "", "b"); // given
List<String> notBlankStrings = strings.stream()
    .filter(StringUtils::isNotBlank)
    .collect(Collectors.toList());
```

### Collection toArray

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

### Create abstract Map.Entry

Create new Map.Entry(key, velue) using \*Utils

- How to create new Entry (key, value) - Stack Overflow : https://stackoverflow.com/questions/3110547/java-how-to-create-new-entry-key-value

```java
import java.util.AbstractMap;

Map.Entry<String,Integer> entry =
    new AbstractMap.SimpleEntry<String, Integer>("exmpleString", 42);
```

### Find Duplicate Objects

使用 Strean 找出重复的对象

- Find duplicates using Java 8 lambda : https://carsten-luxig.de/find-duplicated-items-in-2-collections-with-lambda-expressions

```java
Stream<Entry<String, List<Item>>> duplicates = merged
        .collect(Collectors.groupingBy(Item::getId)))
        .entrySet().stream()
        .filter(e -> e.getValue() > 1);

```

## Conditional

### CollectionUtils

```java
import org.springframework.util.CollectionUtils;

CollectionUtils.isEmpty(collection)
CollectionUtils.isNotEmpty(collection)
```

```java
import org.apache.commons.lang3.StringUtils;

StringUtils.join(stringIterator, ",")

// Consider blank charaters
StringUtils.isBlank(string)
StringUtils.isNotBlank(string)

// Just care about length
StringUtils.isEmpty(string)
StringUtils.isNotEmpty(string)
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

## Regex

- http://tutorials.jenkov.com/java-regex/matcher.html

```java
import java.util.regex.Matcher;
import java.util.regex.Pattern;

// 正则匹配模式 : 中英文混合内容
Pattern mixedZhEnParttern = Pattern.compile("^[\\s\\da-zA-Z\\u4E00-\\u9FA5]+");
Matcher mixedZhEnMatcher = mixedZhEnParttern.matcher(fuzzyKeyword);
boolean likeMixedZhEn = mixedZhEnMatcher.find();

```

## sql

### query count

```java
String sql = "SELECT count(*) FROM ? …";
int count = jdbcInfo.getJdbcTemplate().queryForInt(sql, params);
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

### Utils

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
public class JsonUtils {

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

### Serialize and Deserialize

Example

- CompanyDTO.java

```java
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class CompanyDTO {
    /** 公司 ID */
    @JsonSerialize(using = Long2StringSerializer.class)
    @JsonDeserialize(using = String2LongDeserializer.class)
    private Long companyId;
}
```

- Long2StringSerializer.java

```java
import java.io.IOException;

import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.databind.SerializerProvider;
import com.fasterxml.jackson.databind.ser.std.StdSerializer;

/**
 * 转换 Long 类型变量为字符串的序列化器
 *
 * @author icehe
 * @since 2020/10/14
 */
public class Long2StringSerializer extends StdSerializer<Long> {

    public Long2StringSerializer() {
        this(null);
    }

    public Long2StringSerializer(Class<Long> t) {
        super(t);
    }

    @Override
    public void serialize(
        Long longValue, JsonGenerator gen, SerializerProvider provider)
        throws IOException {
        if (null == longValue) {
            gen.writeNull();
            return;
        }
        gen.writeString(longValue.toString());
    }
}
```

- String2LongDeserializer.java

```java
import java.io.IOException;

import com.fasterxml.jackson.core.JsonParser;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.DeserializationContext;
import com.fasterxml.jackson.databind.deser.std.StdDeserializer;

/**
 * 转换毫秒数或字符串为 LocalDateTime 的反序列化器
 *
 * @author icehe
 * @since 2020/10/14
 */
public class String2LongDeserializer extends StdDeserializer<Object> {

    public String2LongDeserializer() {
        this(null);
    }

    public String2LongDeserializer(Class<Object> t) {
        super(t);
    }

    @Override
    public Object deserialize(JsonParser p, DeserializationContext ctxt)
        throws IOException, JsonProcessingException {
        try {
            return p.readValueAs(Long.class);
        } catch (IOException e) {
            // do nothing
        }

        return null;
    }
}

```

## LocalDateTime

### Serializer

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

### Deserializer

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

### Utils

#### LocalDateTime

```java
import java.time.*;
import java.time.format.DateTimeFormatter;
import java.util.Date;

import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;

/**
 * LocalDateUtils
 *
 * @author icehe.xyz
 * @since 2020/10/15
 */
@UtilityClass
public class LocalDateTimeUtils {

    public final String YYYY_MM_DD_HH_MM_SS_SSS = "yyyy-MM-dd HH:mm:ss.SSS";
    public final String YYYY_MM_DD_HH_MM_SS = "yyyy-MM-dd HH:mm:ss";
    public final String YYYY_M_D_HH_MM = "yyyy/M/d HH:mm";

    /** 日期时间的格式化器 */

    /** e.g. "2019-08-13 17:54:30.926" */
    public final DateTimeFormatter FMT_YYYY_MM_DD_HH_MM_SS_SSS =
        DateTimeFormatter.ofPattern(YYYY_MM_DD_HH_MM_SS_SSS);
    /** e.g. "2019-08-13 17:54:30" */
    public final DateTimeFormatter FMT_YYYY_MM_DD_HH_MM_SS =
        DateTimeFormatter.ofPattern(YYYY_MM_DD_HH_MM_SS);
    /** e.g. "2019-8-6 17:54" */
    public final DateTimeFormatter FMT_YYYY_M_D_HH_MM =
        DateTimeFormatter.ofPattern(YYYY_M_D_HH_MM);

    /** From String to LocalDateTime */
    public LocalDateTime fromString(String str) {
        if (StringUtils.isBlank(str)) {
            return null;
        }
        try {
            if (str.length() == YYYY_MM_DD_HH_MM_SS_SSS.length()) {
                return LocalDateTime.parse(str, FMT_YYYY_MM_DD_HH_MM_SS_SSS);
            } else if (str.length() == YYYY_MM_DD_HH_MM_SS.length()) {
                return LocalDateTime.parse(str, FMT_YYYY_MM_DD_HH_MM_SS);
            } else if (str.length() == YYYY_M_D_HH_MM.length()) {
                return LocalDateTime.parse(str, FMT_YYYY_M_D_HH_MM);
            } else {
                return null;
            }
        } catch (Exception e) {
            return null;
        }
    }

    /** From Date to LocalDateTime */
    public LocalDateTime fromDate(Date date) {
        if (null == date) {
            return null;
        }
        return fromMillis(date.getTime());
    }

    /** From Long millis to LocalDateTime */
    public LocalDateTime fromMillis(Long millis) {
        if (null == millis) {
            return null;
        }
        return LocalDateTime.ofInstant(Instant.ofEpochMilli(millis), ZoneId.systemDefault());
    }

    /** From Long seconds to LocalDateTime */
    public LocalDateTime fromSeconds(Long seconds) {
        if (null == seconds) {
            return null;
        }
        return LocalDateTime.ofInstant(Instant.ofEpochSecond(seconds), ZoneId.systemDefault());
    }

    /** From LocalDateTime to String "yyyy-MM-dd HH:mm:ss" */
    public String toString(LocalDateTime localDateTime) {
        if (localDateTime == null) {
            return null;
        }
        return FMT_YYYY_MM_DD_HH_MM_SS.format(localDateTime);
    }

    /** From LocalDateTime to Date */
    public Date toDate(LocalDateTime localDateTime) {
        return Date.from(localDateTime.atZone(ZoneId.systemDefault()).toInstant());
    }

    /** From LocalDateTime to Long millis */
    public Long toMillis(LocalDateTime localDateTime) {
        if (null == localDateTime) {
            return null;
        }
        return localDateTime.atZone(ZoneId.systemDefault()).toInstant().toEpochMilli();
    }

    /** From LocalDateTime to Long seconds */
    public Long toSeconds(LocalDateTime localDateTime) {
        if (null == localDateTime) {
            return null;
        }
        return localDateTime.atZone(ZoneId.systemDefault()).toEpochSecond();
    }
}
```

### LocalDate

```java
import java.time.DayOfWeek;
import java.time.LocalDate;
import java.time.Period;
import java.time.format.DateTimeFormatter;
import java.util.Collections;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;
import java.util.stream.IntStream;

import com.google.common.collect.Lists;
import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;

/**
 * LocalDateUtils
 *
 * @author icehe.xyz
 * @since 2020/10/15
 */
@UtilityClass
public class LocalDates {

    /** 默认的日期的格式化器 : e.g. "2020-10-15" */
    public final DateTimeFormatter DEFAULT_DATE_FMT = DateTimeFormatter.ofPattern("yyyy-MM-dd");
    /** 紧凑的的日期的格式化器 : e.g. "20201015" */
    public final DateTimeFormatter CONDENSED_DATE_FMT = DateTimeFormatter.ofPattern("yyyyMMdd");

    private final Pattern DATE_REGEX_PATTERN =
            Pattern.compile(
                    "([0-9]{4})\\s*?[/\\-.年]\\s*?([0-9]{1,2})\\s*?[/\\-.月]\\s*?([0-9]{1,2})[日]?");

    /** From LocalDate to String "yyyy-MM-dd" */
    public String toString(LocalDate localDate) {
        if (null == localDate) {
            return null;
        }
        return DEFAULT_DATE_FMT.format(localDate);
    }

    /** Split String to "LocalDate"s */
    public List<LocalDate> splitDates(String datesStr) {

        if (StringUtils.isBlank(datesStr)) {
            return Collections.emptyList();
        }

        Matcher matcher = DATE_REGEX_PATTERN.matcher(datesStr.trim());

        List<LocalDate> dates = Lists.newArrayList();

        while (matcher.find()) {
            int year = Integer.parseInt(matcher.group(1));
            int month = Integer.parseInt(matcher.group(2));
            int day = Integer.parseInt(matcher.group(3));
            dates.add(LocalDate.of(year, month, day));
        }

        return dates;
    }

    /** This Monday */
    public LocalDate thisMondayDate() {
        return LocalDate.now().with(DayOfWeek.MONDAY);
    }

    /** Next Monday */
    public LocalDate nextMondayDate() {
        return thisMondayDate().plusWeeks(1L);
    }

    /** Generate "LocalDate"s */
    public List<LocalDate> dateRange(LocalDate dateFrom, LocalDate dateTo) {
        if (null == dateFrom || null == dateTo || dateFrom.isAfter(dateTo)) {
            return Collections.emptyList();
        }

        int dayCount = Period.between(dateFrom, dateTo).getDays() + 1;
        return IntStream.range(0, dayCount)
                .boxed()
                .map(dateFrom::plusDays)
                .collect(Collectors.toList());
    }
}

```

## Other Utils

### String Parse

```java
package xyz.icehe.response;

import lombok.experimental.UtilityClass;

import java.time.LocalDateTime;
import java.util.Objects;
import java.util.function.Function;
import org.apache.commons.lang3.StringUtils;

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

        if (StringUtils.isBlank(string)) {
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
