# Java Snippets

## Number

### Generate Random Numbers

Reference

- How to generate random numbers in Java : https://www.educative.io/edpresso/how-to-generate-random-numbers-in-java

#### Random

Test

```java
package xyz.icehe.test;

import java.util.Arrays;
import java.util.Random;

public class RandomTest {

    public static int[] getTenRandomIntegers(int upperBoundExclusive) {
        int[] ints = new int[10];
        for (int i = 0; i < ints.length; i++) {
            ints[i] = new Random().nextInt(upperBoundExclusive);
        }
        return ints;
    }

    public static void main(String[] args) {
        int[] tenRandomIntegers = getTenRandomIntegers(25);
        System.out.println(Arrays.toString(tenRandomIntegers));

        Random random = new Random();
        int upperBoundExclusive = 100;
        int randomInt = random.nextInt(upperBoundExclusive);
        float randomFloat = random.nextFloat();
        double randomDouble = random.nextDouble();

        System.out.println("Random integer value from 0 to " + (upperBoundExclusive - 1) + " : " + randomInt);
        System.out.println("Random float value between 0.0 and 1.0 : " + randomFloat);
        System.out.println("Random double value between 0.0 and 1.0 : " + randomDouble);
    }
}
```

Output

```bash
[4, 19, 22, 14, 0, 13, 16, 16, 3, 8]
Random integer value from 0 to 99 : 80
Random float value between 0.0 and 1.0 : 0.18610674
Random double value between 0.0 and 1.0 : 0.24132468608975155
```

#### Math.random

Test

```java
package xyz.icehe.test;

public class MathRandomTest {
    public static void main(String[] args) {
        System.out.println("Random value in double from Math.random() :");
        System.out.println(Math.random());

        int min = 50;
        int max = 100;

        // Generate random double value from 50 to 100
        System.out.println("Random value in double from " + min + " to " + max + ":");
        double random_double = Math.random() * (max - min + 1) + min;
        System.out.println(random_double);

        // Generate random int value from 50 to 100
        System.out.println("Random value in int from " + min + " to " + max + ":");
        int random_int = (int)(Math.random() * (max - min + 1) + min);
        System.out.println(random_int);
    }
}
```

Output

```bash
Random value in double from Math.random() :
0.21037212499838986
Random value in double from 50 to 100:
86.11639990319368
Random value in int from 50 to 100:
77
```

#### ThreadLocalRandom

- How do I generate random integers within a specific range in Java? : https://stackoverflow.com/questions/363681/how-do-i-generate-random-integers-within-a-specific-range-in-java

```java
import java.util.concurrent.ThreadLocalRandom;

// nextInt is normally exclusive of the top value,
// so add 1 to make it inclusive
int randomNum = ThreadLocalRandom.current().nextInt(min, max + 1);
```

Test

```java
package xyz.icehe.test;

public class MathRandomTest {
    public static void main(String[] args) {
        // Generate random integer
        int randomInt = ThreadLocalRandom.current().nextInt();
        System.out.println("Random Integer: " + randomInt);

        // Generate Random double
        double randomDouble = ThreadLocalRandom.current().nextDouble();
        System.out.println("Random Double: " + randomDouble);

        // Generate random boolean
        boolean randBoolean = ThreadLocalRandom.current().nextBoolean();
        System.out.println("Random Boolean: " + randBoolean);
    }
}
```

Output

```java
Random Integer: 523210178
Random Double: 0.09568394748594111
Random Boolean: true
```

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
package xyz.icehe.utils;

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
package xyz.icehe.utils;

import java.util.Collection;
import java.util.stream.Collectors;

import lombok.experimental.UtilityClass;
import org.springframework.util.CollectionUtils;

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
package xyz.icehe.utils;

import java.text.NumberFormat;
import java.text.ParseException;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.Objects;
import java.util.function.Function;

import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;

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

        if (StringUtils.isBlank(numberStr)) {
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

### MD5

```java
package xyz.icehe.utils;

import java.security.MessageDigest;

import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;

/**
 * MD5 工具
 *
 * @author icehe.xyz
 * @since 2020/10/29
 */
@UtilityClass
public class MD5Utils {

    /**
     * 十六进制的字符
     */
    private final char[] HEX_CHARS = new char[]
        {'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'};

    public String md5(String string) throws Exception {
        if (StringUtils.isBlank(string)) {
            return "";
        }

        // 加密
        MessageDigest md5 = MessageDigest.getInstance("md5");
        byte[] digest = md5.digest(string.getBytes());

        StringBuilder stringBuilder = new StringBuilder();
        // 转换为十六进制的字符串
        for (byte bb : digest) {
            stringBuilder.append(HEX_CHARS[(bb >> 4) & 15]);
            stringBuilder.append(HEX_CHARS[bb & 15]);
        }

        // 加密后的字符串
        return stringBuilder.toString();
    }
}

```

### Regex

#### Pattern and Matcher

- http://tutorials.jenkov.com/java-regex/matcher.html

```java
import java.util.regex.Matcher;
import java.util.regex.Pattern;

// 正则匹配模式 : 中英文混合内容
Pattern mixedZhEnParttern = Pattern.compile("^[\\s\\da-zA-Z\\u4E00-\\u9FA5]+");
Matcher mixedZhEnMatcher = mixedZhEnParttern.matcher(fuzzyKeyword);
boolean likeMixedZhEn = mixedZhEnMatcher.find();

```

## Collection

### Conditional

```java
import org.springframework.util.CollectionUtils;

CollectionUtils.isEmpty(collection)
CollectionUtils.isNotEmpty(collection)

```

### Create

#### Common

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

#### Empty

```java
import java.util.Collections;

Collections.emptyList();
Collections.emptySet();
Collections.emptyMap();

// generic type
Collections.<String>emptySet();

```

#### Immutable

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

### Manipulate

#### split

List Partion

- https://stackoverflow.com/questions/2895342/java-how-can-i-split-an-arraylist-in-multiple-small-arraylists

```java
import com.google.common.collect.Lists;

List<String> stringList = Lists.newArrayList(4, 5, 6); // given
List<List<String>> stringListPartions = Lists.partition(stringList, 50);

```

#### Array to List

```java
import java.util.Arrays;

int[] ints = {1, 2, 3}; // given
Arrays.copyOf(ints, ints.length);

```

## Enum

### Transferable State Enum

ReviewState

```java
package xyz.icehe.enums;

import java.util.EnumSet;
import java.util.Set;
import java.util.stream.Stream;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.google.common.collect.ImmutableSet;
import lombok.AccessLevel;
import lombok.AllArgsConstructor;
import lombok.Getter;

/**
 * 审核状态
 *
 * @author icehey.xyz
 * @since 2020/10/16
 */
@Getter
@AllArgsConstructor(access = AccessLevel.PRIVATE)
public enum ReviewState {

    /** 未申请 / 未被正确地初始化 */
    NOT_APPLIED(0, "未申请"),
    /** 已申请 */
    APPLIED(1, "待审核"),
    /** 最终审核结果 */
    APPROVED(2, "通过"),
    REJECTED(3, "驳回"),
    /** 自动审核结果 * */
    EXPIRE_REJECTED(4, "超时未通过，自动驳回"),
    ;

    /** 驳回状态的集合 */
    private static final Set<ReviewState> REJECTED_STATES =
            ImmutableSet.of(REJECTED, EXPIRE_REJECTED);

    /** 不可修改 (正常情况下) 的状态的集合 */
    private static final Set<ReviewState> UNMODIFIABLE_STATES =
            ImmutableSet.of(REJECTED, EXPIRE_REJECTED);

    /** 可修改的状态的集合 */
    private static final Set<ReviewState> MODIFIABLE_STATES = ImmutableSet.of(APPLIED, APPROVED);

    /** 码值 */
    private final Integer code;

    /** 说明 */
    private final String desc;

    /** 将码值转换为枚举常量 */
    @JSONCreator
    public static ReviewState codeOf(Integer code) {
        return Stream.of(values()).filter(it -> it.equalsCode(code)).findFirst().orElse(null);
    }

    /** 将名称转换为枚举常量 */
    @JSONCreator
    public static ReviewState nameOf(String name) {
        return Stream.of(values()).filter(it -> it.name().equals(name)).findFirst().orElse(null);
    }

    /** 全状态的集合 */
    public static EnumSet<ReviewState> allStates() {
        return EnumSet.allOf(ReviewState.class);
    }

    /** 除 "审核通过" 状态之外的集合 */
    public static EnumSet<ReviewState> nonApprovedStates() {
        return EnumSet.complementOf(EnumSet.of(ReviewState.APPROVED));
    }

    /** 驳回状态的集合 */
    public static EnumSet<ReviewState> rejectedStates() {
        return EnumSet.copyOf(REJECTED_STATES);
    }

    /** 驳回状态之外的集合 */
    public static EnumSet<ReviewState> nonRejectedStates() {
        return EnumSet.complementOf(EnumSet.copyOf(REJECTED_STATES));
    }

    /** 不可修改 (正常情况下) 的状态的集合 */
    public static EnumSet<ReviewState> unmodifiableStates() {
        return EnumSet.copyOf(UNMODIFIABLE_STATES);
    }

    /** 可修改的状态的集合 */
    public static EnumSet<ReviewState> modifiableStates() {
        return EnumSet.copyOf(MODIFIABLE_STATES);
    }

    /** 判断处理状态 (码值) 是否相等 */
    public boolean equalsCode(Integer value) {
        return getCode().equals(value);
    }

    /** 是否属于一种驳回状态 */
    public boolean isRejection() {
        return REJECTED_STATES.contains(this);
    }
}

```

ReviewOperationType

```java
package xyz.icehe.enums;

import java.util.Arrays;
import java.util.Map;
import java.util.Set;
import java.util.stream.Collectors;
import java.util.stream.Stream;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.google.common.collect.ImmutableMap;
import lombok.AccessLevel;
import lombok.AllArgsConstructor;
import lombok.Getter;

import static xyz.icehe.enums.ReviewState.*;

/**
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Getter
@AllArgsConstructor(access = AccessLevel.PRIVATE)
public enum ReviewOperationType {

    /** 审核操作类型 */
    REJECT("驳回", true,
        ImmutableMap.<ReviewState, ReviewState>builder().put(APPLIED, REJECTED).build()),

    EXPIRE_REJECT("过期自动驳回", true,
        ImmutableMap.<ReviewState, ReviewState>builder().put(APPLIED, EXPIRE_REJECTED).build()),

    FORCE_REJECT("强制驳回", true,
        ImmutableMap.<ReviewState, ReviewState>builder().put(APPROVED, REJECTED).build()),

    APPROVE("通过审核", true,
        ImmutableMap.<ReviewState, ReviewState>builder().put(APPLIED, APPROVED).build()),
    ;

    /** 批量的更新操作类型 */
    private static final Set<ReviewOperationType> BATCH_OPERATION_TYPE =
        Stream.of(values())
            .filter(ReviewOperationType::isBatchable)
            .collect(Collectors.toSet());

    /** 说明 */
    private final String desc;

    /** 是否支持批量操作 */
    private final boolean batchable;

    /** 状态转换表 */
    private final Map<ReviewState, ReviewState> stateTransferMap;

    /** 将名称转换为枚举常量 */
    @JSONCreator
    public static ReviewOperationType nameOf(String name) {
        return Arrays.stream(values())
            .filter(type -> type.name().equals(name))
            .findFirst()
            .orElse(null);
    }

    /** 允许对处于哪些状态的对象进行更新操作 */
    public Set<ReviewState> fromStates() {
        return stateTransferMap.keySet();
    }

    /** 更新操作的目标状态 */
    public ReviewState toState(ReviewState fromState) {
        return stateTransferMap.get(fromState);
    }
}

```

### EnumParsers

Usage

```java
package xyz.icehe.enums;

import lombok.AccessLevel;
import lombok.AllArgsConstructor;
import lombok.Getter;
import xyz.icehe.utils.EnumParsers;

/**
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Getter
@AllArgsConstructor(access = AccessLevel.PRIVATE)
public enum BoolState {

    /** "是/否" 状态 */
    UNDEF(-1, "未知"),
    NO(0, "否"),
    YES(1, "是"),
    ;

    /** 码值 */
    private final Integer code;

    /** 描述 */
    private final String desc;

    /**
     * 根据数值，获取对应枚举常量
     *
     * @param code {@link Integer}
     * @return 枚举常量
     */
    public static BoolState of(Integer code) {
        return EnumParsers.parserOf(BoolState.class, "getCode").apply(code);
    }

    /**
     * 判断是否相等
     *
     * <p>兼容了对 Integer 类型变量的判断
     *
     * @param integer Integer
     * @return boolean
     */
    public boolean equals(Integer integer) {
        return getCode().equals(integer);
    }
}

```

Source Code

```java
package xyz.icehe.utils;

import java.lang.reflect.Method;
import java.util.EnumSet;
import java.util.Map;
import java.util.Objects;
import java.util.concurrent.ConcurrentMap;
import java.util.function.Function;

import com.google.common.collect.Maps;
import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;

/**
 * 枚举常量解析器的静态工厂
 *
 * <p>枚举常量解析器: 将值转换为枚举常量
 *
 * <p>JAVA 中, 把基本类型转化为对象类型的方法, 通常命名为 {@code valueOf()}, 所以这里采用 {@code parserOf()} 方法命名.
 *
 * <p>不能用于解析可能值为 null 的 Enum 类型对象, 因为类内部实现使用了 {@link ConcurrentMap}, 所以无论键还是值都不能写入 null!
 *
 * <p>标准: 返回 null 用于表示 "解析失败" 的情况!
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@UtilityClass
public class EnumParsers {

    public final String ENUM_TYPE = "enumType";

    /**
     * 解析映射的 Key 的分隔符
     */
    private final String MAP_KEY_SEPARATOR = "#";

    /**
     * 保存各个枚举常量解析器的映射
     *
     * <p>用空间换时间, 用映射来提高枚举常量的解析速度.
     *
     * <p>映射 Key 通常为枚举类型的名称（包含包名）加上获取被解析对象的方法的名称.
     *
     * <p>每个枚举类可以拥有多个枚举常量解析器, 多个枚举常量解析器根据获取被解析对象的方法的名称来区分, 即是 {@link EnumParsers#parserOf} 方法的
     * objGetterName 参数.
     */
    private final Map<String, Function<?, ? extends Enum<?>>> parserMap = Maps.newConcurrentMap();

    /**
     * 根据枚举类型以及获取解析值的方法的名称, 获取的枚举常量解析器
     *
     * @param targetEnumType   {@link Enum} 目标枚举类型
     * @param srcObjGetterName 获取被解析对象的方法的名称
     * @param <T>              {@link Class} 需要解析的对象的类型
     * @param <E>              {@link Enum} 枚举常量的类型
     * @return {@link Enum} 枚举常量
     */
    @SuppressWarnings("unchecked")
    public <T, E extends Enum<E>> Function<T, E> parserOf(Class<E> targetEnumType, String srcObjGetterName) {

        Objects.requireNonNull(targetEnumType, ENUM_TYPE + " 不能为 null");

        if (StringUtils.isBlank(srcObjGetterName)) {
            throw new RuntimeException("parsedValueGetterName" + " 不能为空字符串");
        }

        String parserKey = targetEnumType.getName() + MAP_KEY_SEPARATOR + srcObjGetterName;
        Function<T, E> enumParser = (Function<T, E>)parserMap.get(parserKey);

        if (null == enumParser) {
            enumParser = generateEnumParser(targetEnumType, srcObjGetterName);
            parserMap.put(parserKey, enumParser);
        }

        return enumParser;
    }

    /**
     * 生成新的枚举常量解析器
     *
     * @param targetEnumType   {@link Enum} 目标枚举类型
     * @param srcObjGetterName 获取被解析对象的方法名
     * @param <T>              {@link Class} 需要解析的对象的类型
     * @param <E>              {@link Enum} 枚举常量的类型
     * @return {@link Function}
     */
    private static <T, E extends Enum<E>> Function<T, E> generateEnumParser(
        Class<E> targetEnumType, String srcObjGetterName) {

        EnumSet<E> allEnumSet = EnumSet.allOf(targetEnumType);
        Function<E, T> sourceObjGetter = getSourceObjGetter(targetEnumType, srcObjGetterName);
        Map<T, E> parsedValue2EnumMap = MapBuilders.buildMap(allEnumSet, sourceObjGetter);

        return value -> (null == value) ? null : parsedValue2EnumMap.get(value);
    }

    /**
     * 获取用于获取被解析对象的闭包
     *
     * @param targetEnumType   目标枚举类型
     * @param srcObjGetterName 获取被解析对象的方法的名称
     * @param <T>              {@link Class} 需要解析的对象的类型
     * @param <E>              {@link Enum} 枚举常量的类型
     * @return 获取被解析值的闭包 {@link Function}
     */
    @SuppressWarnings("unchecked")
    private <T, E extends Enum<E>> Function<E, T> getSourceObjGetter(
        Class<? extends E> targetEnumType, String srcObjGetterName) {

        Method valueGetterMethod = getSourceObjGetterMethod(targetEnumType, srcObjGetterName);

        return (E anEnum) -> {
            try {
                return (T)valueGetterMethod.invoke(anEnum);
            } catch (Exception e) {
                String format = "valueGetter not work : 获取枚举常量的解析值时, 出现异常, anEnum=%s, valueGetter=%s";
                throw new RuntimeException(String.format(format, anEnum, valueGetterMethod), e);
            }
        };
    }

    /**
     * 获取用于获取被解析对象的方法
     *
     * @param targetEnumType   {@link Class} 目标枚举类型
     * @param srcObjGetterName 获取被解析对象的方法的名称
     * @return {@link Method}
     */
    private Method getSourceObjGetterMethod(Class<? extends Enum<?>> targetEnumType, String srcObjGetterName) {

        Method parsedValueGetter;
        try {
            // Get the method without parameters
            parsedValueGetter = targetEnumType.getDeclaredMethod(srcObjGetterName);
        } catch (NoSuchMethodException e) {
            throw new RuntimeException(e);
        }

        if (0 != parsedValueGetter.getParameterCount()) {
            String format = "找到了指定名称的方法, 但参数数量不匹配 (必须没有参数), targetEnumType=%s, parsedValueGetter=%s";
            throw new RuntimeException(String.format(format, targetEnumType, parsedValueGetter));
        }

        return parsedValueGetter;
    }
}

```

### \*EnumsParser

```java
package xyz.icehe.utils.parser;

import java.lang.reflect.InvocationTargetException;
import java.lang.reflect.Method;
import java.lang.reflect.Modifier;
import java.util.Collection;
import java.util.Collections;
import java.util.Map;
import java.util.Objects;
import java.util.Optional;
import java.util.function.Function;
import java.util.stream.Collectors;
import java.util.stream.Stream;

import lombok.Getter;
import org.springframework.util.CollectionUtils;

/**
 * 枚举常量集合的解析器
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Getter
public class EnumsParser implements Function<Collection<?>, Map<?, Optional<Enum<?>>>> {

    /**
     * 目标枚举类型
     */
    private final Class<? extends Enum<?>> targetEnumClass;

    /**
     * 被解析对象的类型
     */
    private final Class<?> sourceObjType;

    /**
     * 将对象解析为枚举常量的静态方法
     *
     * <p>该方法必须为静态而且属于枚举类 {@link Method}
     */
    private Method parseMethod;

    /**
     * Constructor
     *
     * @param targetEnumClass {@link Class} 目标枚举类型
     * @param sourceObjType   {@link Class} 被解析对象的类型
     */
    public EnumsParser(Class<? extends Enum<?>> targetEnumClass, Class<?> sourceObjType) {
        this(targetEnumClass, sourceObjType, findParseMethodByType(targetEnumClass, sourceObjType));
    }

    /**
     * Constructor
     *
     * @param targetEnumClass {@link Class} 目标枚举类型
     * @param sourceObjType   {@link Class} 被解析对象的类型
     * @param parseMethodName 解析方法的名称
     */
    public EnumsParser(Class<? extends Enum<?>> targetEnumClass, Class<?> sourceObjType, String parseMethodName) {
        this(targetEnumClass, sourceObjType, findParseMethodByName(targetEnumClass, sourceObjType, parseMethodName));
    }

    /**
     * Constructor
     *
     * @param targetEnumClass {@link Class} 目标枚举类型
     * @param sourceObjType   {@link Class} 被解析对象的类型
     * @param parseMethod     {@link Method} 将对象解析为枚举常量的静态方法
     */
    private EnumsParser(Class<? extends Enum<?>> targetEnumClass, Class<?> sourceObjType, Method parseMethod) {
        this.targetEnumClass = targetEnumClass;
        this.sourceObjType = sourceObjType;
        this.parseMethod = parseMethod;
    }

    /**
     * 获取用于将对象解析为枚举常量的静态方法
     *
     * @param targetEnumType {@link Class} 目标枚举类型
     * @param sourceObjType  {@link Class} 被解析对象的类型
     * @return {@link Method} 将对象解析为枚举常量的静态方法
     */
    private static Method findParseMethodByType(Class<? extends Enum<?>> targetEnumType, Class<?> sourceObjType) {
        requireNonNull(targetEnumType, sourceObjType);
        return Stream.of(targetEnumType.getDeclaredMethods())
            .filter(method -> method.getReturnType().equals(targetEnumType))
            .filter(method -> method.getParameterCount() == 1)
            .filter(method -> method.getParameterTypes()[0].equals(sourceObjType))
            .filter(method -> Modifier.isStatic(method.getModifiers()))
            .filter(method -> Modifier.isPublic(method.getModifiers()))
            .findFirst()
            .orElseThrow(() -> {
                String format = "找不到将值解析为枚举常量的静态公有方法, targetEnumType=%s, sourceObjType=%s";
                return new RuntimeException(String.format(format, targetEnumType, sourceObjType));
            });
    }

    /**
     * 获取用于将对象解析为枚举常量的静态方法
     *
     * @param targetEnumType  {@link Class} 目标枚举类型
     * @param sourceObjType   {@link Class} 被解析对象的类型
     * @param parseMethodName {@link Class} 解析方法的名称
     * @return {@link Method} 将对象解析为枚举常量的静态方法
     */
    private static Method findParseMethodByName(
        Class<? extends Enum<?>> targetEnumType, Class<?> sourceObjType, String parseMethodName) {

        requireNonNull(targetEnumType, sourceObjType);
        Method parseMethod;
        try {
            parseMethod = targetEnumType.getDeclaredMethod(parseMethodName, String.class);
        } catch (NoSuchMethodException e) {
            String format = "找不到将值解析为枚举常量的方法, parseMethodName=%s";
            throw new RuntimeException(String.format(format, parseMethodName), e);
        }

        checkParseMethod(targetEnumType, sourceObjType, parseMethod);
        return parseMethod;
    }

    /**
     * 检查目标枚举类型和被解析对象的类型是否非 null，否则抛出异常
     *
     * @param targetEnumType {@link Class} 目标枚举类型
     * @param sourceObjType  {@link Class} 被解析对象的类型
     * @throws NullPointerException 空指针错误
     */
    private static void requireNonNull(Class<? extends Enum<?>> targetEnumType, Class<?> sourceObjType) {
        Objects.requireNonNull(targetEnumType, "targetEnumType" + " 不能为 null");
        Objects.requireNonNull(sourceObjType, "sourceObjType" + " 不能为 null");
    }

    /**
     * 检查用于将对象解析为枚举常量的静态方法
     *
     * @param returnType  {@link Class} 目标枚举类型
     * @param paramType   {@link Class} 被解析对象的类型
     * @param parseMethod {@link Method} 解析方法的名称
     */
    private static void checkParseMethod(Class<? extends Enum<?>> returnType, Class<?> paramType, Method parseMethod) {
        Objects.requireNonNull(parseMethod, "parseMethod" + " 不能为 null");
        String errorMsgFormat;

        if (parseMethod.getParameterCount() != 1) {
            errorMsgFormat = "找到可将值解析为枚举常量的方法, 但参数数量不匹配 (要求有且仅有一个), returnType=%s, parseMethod=%s";
            throw new RuntimeException(String.format(errorMsgFormat, returnType, parseMethod));
        }

        if (!parseMethod.getParameterTypes()[0].equals(paramType)) {
            errorMsgFormat = "找到可将值解析为枚举常量的方法, 但参数值类型不匹配, paramType=%s, parseMethod=%s";
            throw new RuntimeException(String.format(errorMsgFormat, paramType, parseMethod));
        }

        if (!parseMethod.getReturnType().equals(returnType)) {
            errorMsgFormat = "找到可将值解析为枚举常量的方法, 但返回值类型不匹配, returnType=%s, parseMethod=%s";
            throw new RuntimeException(String.format(errorMsgFormat, returnType, parseMethod));
        }

        int modifiers = parseMethod.getModifiers();

        if (!Modifier.isStatic(modifiers)) {
            errorMsgFormat = "找到可将值解析为枚举常量的方法, 但不是静态方法 (static), parseMethod=%s";
            throw new RuntimeException(String.format(errorMsgFormat, parseMethod));
        }

        if (!Modifier.isPublic(modifiers)) {
            errorMsgFormat = "找到可将值解析为枚举常量的方法, 但不是公有方法 (public), parseMethod=%s";
            throw new RuntimeException(String.format(errorMsgFormat, parseMethod));
        }
    }

    /**
     * 将值转换为值到枚举常量的映射
     *
     * @param values 值的集合
     * @return 值到枚举常量的映射
     */
    @Override
    public Map<?, Optional<Enum<?>>> apply(Collection<?> values) {
        if (CollectionUtils.isEmpty(values)) {
            return Collections.emptyMap();
        }

        return values.stream().collect(Collectors.toConcurrentMap(
            Function.identity(),
            val -> Optional.ofNullable(parseAnEnum(val))));
    }

    /**
     * 将值解析为枚举常量
     *
     * @param value 被解析的值
     * @return {@link Enum} 值对应的枚举常量
     */
    private Enum<?> parseAnEnum(Object value) {
        try {
            return (Enum<?>)parseMethod.invoke(null, value);

        } catch (IllegalAccessException | IllegalArgumentException | InvocationTargetException e) {
            String format = "parseMethod not work : 调用将值转换为枚举常量时, 出现异常, value=%s, parseMethod=%s";
            throw new RuntimeException(String.format(format, value, parseMethod), e);
        }
    }
}

```

### \*EnumsParses

```java
package xyz.icehe.utils;

import java.util.Map;

import com.google.common.collect.Maps;
import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;
import xyz.icehe.utils.parser.EnumsParser;

/**
 * 枚举常量集合的解析器的静态工厂
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@UtilityClass
public class EnumsParsers {

    /**
     * key 为 "枚举类名#转换对象类名"，value 为枚举常量集合解析器的映射
     */
    private final Map<String, EnumsParser> ENUM_VAL_2_PARSER_MAP = Maps.newConcurrentMap();

    /**
     * key 为 "枚举类名#转换对象类名#方法名"，value 为枚举常量集合解析器的映射
     */
    private final Map<String, EnumsParser> ENUM_VAL_GETTER_2_PARSER_MAP = Maps.newConcurrentMap();

    /**
     * 获取枚举常量解析器
     *
     * @param targetEnumType  {@link Class} 目标枚举类型
     * @param sourceObjType   {@link Class} 被解析对象的类型
     * @param parseMethodName 将对象解析为枚举常量的方法的名称
     * @return {@link EnumsParser}
     */
    public EnumsParser parserOf(
        Class<? extends Enum<?>> targetEnumType,
        Class<?> sourceObjType,
        String parseMethodName) {

        if (StringUtils.isBlank(parseMethodName)) {
            return parserOf(targetEnumType, sourceObjType);
        }

        String key = String.format("%s#%s#%s",
                targetEnumType.getName(), sourceObjType.getName(), parseMethodName);
        EnumsParser enumsParser = ENUM_VAL_GETTER_2_PARSER_MAP.get(key);

        if (null == enumsParser) {
            enumsParser = new EnumsParser(targetEnumType, sourceObjType, parseMethodName);
            ENUM_VAL_GETTER_2_PARSER_MAP.put(key, enumsParser);
        }

        return enumsParser;
    }

    /**
     * 获取枚举常量解析器
     *
     * @param targetEnumType {@link Class} 目标枚举类型
     * @param sourceObjType  {@link Class} 被解析对象的类型
     * @return {@link EnumsParser}
     */
    public EnumsParser parserOf(Class<? extends Enum<?>> targetEnumType, Class<?> sourceObjType) {

        String key = String.format("%s#%s", targetEnumType.getName(), sourceObjType.getName());
        EnumsParser enumsParser = ENUM_VAL_2_PARSER_MAP.get(key);

        if (null == enumsParser) {
            enumsParser = new EnumsParser(targetEnumType, sourceObjType);
            ENUM_VAL_2_PARSER_MAP.put(key, enumsParser);
        }

        return enumsParser;
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

Filter Blank Strings

```java
import org.apache.commons.lang3.StringUtils;

List<String> strings = Arrays.asList("a", "", "b"); // given
List<String> notBlankStrings = strings.stream()
    .filter(StringUtils::isNotBlank)
    .collect(Collectors.toList());

```

### sort

Sort Integer List

```java
Map<String, List<Long>> keyValuesMap = getKeyValuesMap();

// 返回结果是乱序的；
// 需要根据输入参数 valueList 中 value 的原始顺序，重新排列好
keyValuesMap.forEach((key, vals) ->
    Collections.sort(vals, Comparator.comparingInt(val -> valueList.indexOf(val))));

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

### StringUtils

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

## Optinal

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

## JSON

### Jackson

#### JsonUtils

```java
package xyz.icehe.utils;

import java.io.IOException;
import java.util.Collections;
import java.util.Map;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.core.JsonParser.Feature;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.DeserializationFeature;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.SerializationFeature;
import com.fasterxml.jackson.datatype.jsr310.JavaTimeModule;
import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;

/**
 * JSON 序列化工具
 *
 * @author icehe.xyz
 * @see com.fasterxml.jackson.databind.ObjectMapper
 * @since 2020/10/19
 */
@UtilityClass
public class JsonUtils {

    public final TypeReference<Map<String, Object>> MAP_TYPE_REF = new TypeReference<Map<String, Object>>() {};

    private final ObjectMapper mapper = new ObjectMapper();

    static {
        // 解决实体未包含字段反序列化时抛出异常
        mapper.configure(DeserializationFeature.FAIL_ON_UNKNOWN_PROPERTIES, false);

        // 对于空的对象转json的时候不抛出错误
        mapper.disable(SerializationFeature.FAIL_ON_EMPTY_BEANS);

        // 允许属性名称没有引号
        mapper.configure(Feature.ALLOW_UNQUOTED_FIELD_NAMES, true);

        // 允许单引号
        mapper.configure(Feature.ALLOW_SINGLE_QUOTES, true);

        // Include.NON_EMPTY 属性为 空（""） 或者为 NULL 都不序列化, 则返回的 JSON 是没有这个字段的, 这样对移动端会更省流量
        mapper.setSerializationInclusion(JsonInclude.Include.NON_EMPTY);

        // LocalDateTime 的序列化
        mapper.registerModule(new JavaTimeModule());
        mapper.disable(SerializationFeature.WRITE_DATES_AS_TIMESTAMPS);
    }

    /**
     * Get internal Jackson ObjectMapper
     *
     * @return
     */
    public ObjectMapper mapper() {
        return mapper;
    }

    /**
     * Serialize Object into JSON String (without exceptions)
     *
     * @param object
     * @return
     */
    public String toJsonString(Object object) {
        if (null == object) {
            return null;
        }
        try {
            return mapper.writeValueAsString(object);
        } catch (Exception e) {
            return null;
        }
    }

    /**
     * Serialize Object into JSON String with exceptions
     *
     * @param object
     * @return
     * @throws JsonProcessingException
     */
    public String toJsonStringWithExceptions(Object object) throws JsonProcessingException {
        if (null == object) {
            return null;
        }
        return mapper.writeValueAsString(object);
    }

    /**
     * Deserialize Object from JSON String (without exceptions)
     *
     * @param content
     * @param valueType
     * @param <T>
     * @return
     */
    public <T> T fromJsonString(String content, Class<T> valueType) {
        if (StringUtils.isBlank(content)) {
            return null;
        }
        try {
            return mapper.readValue(content, valueType);
        } catch (IOException e) {
            return null;
        }
    }

    /**
     * Deserialize Object from JSON String (without exceptions)
     *
     * @param content
     * @param typeReference
     * @param <T>
     * @return
     */
    public <T> T fromJsonString(String content, TypeReference<T> typeReference) {
        if (StringUtils.isBlank(content)) {
            return null;
        }
        try {
            return mapper.readValue(content, typeReference);
        } catch (IOException e) {
            return null;
        }
    }

    /**
     * Deserialize Object from JSON String with exceptions
     *
     * @param content
     * @param valueType
     * @param <T>
     * @return
     * @throws IOException
     */
    public <T> T fromJsonStringWithExceptions(String content, Class<T> valueType) throws IOException {
        if (StringUtils.isBlank(content)) {
            return null;
        }
        return mapper.readValue(content, valueType);
    }

    /**
     * Deserialize Object from JSON String with exceptions
     *
     * @param content
     * @param typeReference
     * @param <T>
     * @return
     * @throws IOException
     */
    public <T> T fromJsonStringWithExceptions(String content, TypeReference<T> typeReference) throws IOException {
        if (StringUtils.isBlank(content)) {
            return null;
        }
        return mapper.readValue(content, typeReference);
    }

    /**
     * Convert Object to Map (without exceptions)
     *
     * @param object
     * @return
     */
    public Map<String, Object> toMap(Object object) {
        if (null == object) {
            return Collections.emptyMap();
        }
        try {
            return mapper.convertValue(object, MAP_TYPE_REF);
        } catch (Exception e) {
            return Collections.emptyMap();
        }
    }

    /**
     * Convert Object to Map with exceptions
     *
     * @param object
     * @return
     */
    public Map<String, Object> toMapWithExceptions(Object object) throws IllegalArgumentException {
        if (null == object) {
            return Collections.emptyMap();
        }
        return mapper.convertValue(object, MAP_TYPE_REF);
    }
}

```

#### Serialize and Deserialize

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

### FastJson

#### JSON String to Map

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

### Gson

#### Gson Utils

```java
package xyz.icehe.utils;

import java.lang.reflect.Type;

import com.google.gson.Gson;
import lombok.experimental.UtilityClass;

/**
 * Gson 序列化工具
 *
 * @author icehe.xyz
 * @see com.google.gson.Gson
 * @since 2020/10/19
 */
@UtilityClass
public class GsonUtils {

    private final Gson gson = new Gson();

    /**
     * Get internal Gson
     *
     * @return
     */
    public Gson gson() {
        return gson;
    }

    /**
     * Serialize Object into JSON String
     *
     * @param o
     * @return
     */
    public String toJsonString(Object o) {
        return gson.toJson(o);
    }

    /**
     * Deserialize Object from JSON String
     *
     * @param json
     * @param classOfT
     * @param <T>
     * @return
     */
    public <T> T fromJsonString(String json, Class<T> classOfT) {
        return gson.fromJson(json, classOfT);
    }

    /**
     * Deserialize Object from JSON String
     *
     * @param json
     * @param typeOfT
     * @param <T>
     * @return
     */
    public <T> T fromJsonString(String json, Type typeOfT) {
        return gson.fromJson(json, typeOfT);
    }
}

```

## LocalDateTime

将字符串转换为日期对象

- Java 8 - How to convert String to LocalDate : https://www.mkyong.com/java8/java-8-how-to-convert-string-to-localdate/
    - Java 应该用 LocalDate / LocalTime / LocalDateTime 保存时间
    - 禁止使用 java.util.Date & java.text.SimpleDateFormat !

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
import java.time.Instant;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;
import java.time.temporal.ChronoUnit;
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

    /** Calculates milliseconds until another date-time */
    public Long millisBetween(LocalDateTime localDateTimeA, LocalDateTime localDateTimeB) {
        if (null == localDateTimeA || null == localDateTimeB) {
            return null;
        }
        return localDateTimeA.until(localDateTimeB, ChronoUnit.MILLIS);
    }

    /** Calculates seconds until another date-time */
    public Long secondsBetween(LocalDateTime localDateTimeA, LocalDateTime localDateTimeB) {
        if (null == localDateTimeA || null == localDateTimeB) {
            return null;
        }
        return localDateTimeA.until(localDateTimeB, ChronoUnit.SECONDS);
    }

    /** Calculates hours until another date-time */
    public Long hoursBetween(LocalDateTime localDateTimeA, LocalDateTime localDateTimeB) {
        if (null == localDateTimeA || null == localDateTimeB) {
            return null;
        }
        return localDateTimeA.until(localDateTimeB, ChronoUnit.HOURS);
    }

    /** Calculates days until another date-time */
    public Long daysBetween(LocalDateTime localDateTimeA, LocalDateTime localDateTimeB) {
        if (null == localDateTimeA || null == localDateTimeB) {
            return null;
        }
        return localDateTimeA.until(localDateTimeB, ChronoUnit.DAYS);
    }

    /** Calculates weeks until another date-time */
    public Long weeksBetween(LocalDateTime localDateTimeA, LocalDateTime localDateTimeB) {
        if (null == localDateTimeA || null == localDateTimeB) {
            return null;
        }
        return localDateTimeA.until(localDateTimeB, ChronoUnit.WEEKS);
    }

    /** Calculates months until another date-time */
    public Long monthsBetween(LocalDateTime localDateTimeA, LocalDateTime localDateTimeB) {
        if (null == localDateTimeA || null == localDateTimeB) {
            return null;
        }
        return localDateTimeA.until(localDateTimeB, ChronoUnit.MONTHS);
    }

    /** Calculates years until another date-time */
    public Long yearsBetween(LocalDateTime localDateTimeA, LocalDateTime localDateTimeB) {
        if (null == localDateTimeA || null == localDateTimeB) {
            return null;
        }
        return localDateTimeA.until(localDateTimeB, ChronoUnit.YEARS);
    }

    /** Calculates days until another date */
    public Long daysBetween(LocalDate localDateA, LocalDate localDateB) {
        if (null == localDateA || null == localDateB) {
            return null;
        }
        return localDateA.until(localDateB, ChronoUnit.DAYS);
    }

    /** Calculates weeks until another date */
    public Long weeksBetween(LocalDate localDateA, LocalDate localDateB) {
        if (null == localDateA || null == localDateB) {
            return null;
        }
        return localDateA.until(localDateB, ChronoUnit.WEEKS);
    }

    /** Calculates months until another date */
    public Long monthsBetween(LocalDate localDateA, LocalDate localDateB) {
        if (null == localDateA || null == localDateB) {
            return null;
        }
        return localDateA.until(localDateB, ChronoUnit.MONTHS);
    }

    /** Calculates years until another date */
    public Long yearsBetween(LocalDate localDateA, LocalDate localDateB) {
        if (null == localDateA || null == localDateB) {
            return null;
        }
        return localDateA.until(localDateB, ChronoUnit.YEARS);
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

## Spring ConstraintValidator

约束校验器

- JavaBean Validation - Object Association validation with @Valid
  : https://www.logicbig.com/tutorials/java-ee-tutorial/bean-validation/cascaded-validation.html

### AbstractValidator

```java
package xyz.icehe.validate.validator;

import java.lang.annotation.Annotation;

import javax.validation.ConstraintValidator;
import javax.validation.ConstraintValidatorContext;

import lombok.Getter;
import lombok.Setter;
import org.apache.commons.lang3.StringUtils;

/**
 * 抽象校验器
 *
 * <p>校验器：用于校验方法返回值、字段、参数
 *
 * @author icehe.xyz
 * @see ConstraintValidator
 * @see <a href="https://zhuanlan.zhihu.com/p/27643133">秒懂，Java 注解 （Annotation）你可以这样学 - 知乎</a>
 * @see <a href="https://docs.jboss.org/hibernate/validator/4.2/reference/zh-CN/html/validator-customconstraints.html#validator-customconstraints-constraintannotation">创建自己的约束规则</a>
 * @since 2020/10/16
 */
@Getter
@Setter
public abstract class AbstractValidator<A extends Annotation, T> implements ConstraintValidator<A, T> {

    protected A annotation;

    /**
     * 追加约束违反的信息
     *
     * @param violationMessage 默认的约束违反信息
     * @param context          {@link ConstraintValidatorContext}
     * @return 是否成功追加约束违反
     */
    public static boolean appendViolation(
        String violationMessage, ConstraintValidatorContext context) {

        if (StringUtils.isBlank(violationMessage)) {
            return false;
        }

        context.disableDefaultConstraintViolation();
        context.buildConstraintViolationWithTemplate(violationMessage.trim())
            .addConstraintViolation();
        return true;
    }

    /**
     * Initializes the validator in preparation for calls.
     *
     * <p>Just once
     *
     * @param constraintAnnotation annotation instance for a given constraint declaration
     */
    @Override
    public void initialize(A constraintAnnotation) {
        annotation = constraintAnnotation;
    }
}

```

### Double Percent

Usage

```java
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class SomeDTO {
    @ValidPercent(maxScale = 2, message = "percent 参数必须为 0.00 ~ 100.00 的百分比数字, 或传空"
    private Double percent;
}

```

#### @ValidePercent

```java
package xyz.icehe.validate.annotation;

import java.lang.annotation.Documented;
import java.lang.annotation.Retention;
import java.lang.annotation.RetentionPolicy;
import java.lang.annotation.Target;

import javax.validation.Constraint;
import javax.validation.Payload;

import xyz.icehe.validate.validator.impl.DoublePercentValidator;

import static java.lang.annotation.ElementType.FIELD;
import static java.lang.annotation.ElementType.METHOD;
import static java.lang.annotation.ElementType.PARAMETER;

/**
 * 校验是否指定了正确的百分比 0~100
 *
 * <p>支持浮点数 Double
 *
 * <p>考虑添加对 Integer 和 String 等类型的校验支持, 有空或有必要时写.
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Documented
@Target({FIELD, METHOD, PARAMETER})
@Retention(RetentionPolicy.RUNTIME)
@Constraint(validatedBy = DoublePercentValidator.class)
public @interface ValidPercent {

    /**
     * @return 保留小数点后数字的最大位数
     */
    int maxScale() default -1;

    /**
     * @return 百分数下限
     */
    double minPercent() default 0.0D;

    /**
     * @return 百分数上限
     */
    double maxPercent() default 100.0D;

    /**
     * @return 错误信息
     */
    String message() default "必须表示正确的百分比 0 ~ 100";

    /**
     * @return 所属的校验组
     */
    Class<?>[] groups() default {};

    /**
     * @return 约束条件的严重级别
     */
    Class<? extends Payload>[] payload() default {};
}

```

#### DoublePercentValidator

```java
package xyz.icehe.validate.validator.impl;

import java.math.BigDecimal;

import javax.validation.ConstraintValidatorContext;

import xyz.icehe.validate.annotation.ValidPercent;
import xyz.icehe.validate.validator.AbstractValidator;

/**
 * 校验 Double 类型的值是否指定了正确的百分比
 *
 * <p>只精确到两位小数，后面的部分舍弃掉
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
public class DoublePercentValidator extends AbstractValidator<ValidPercent, Double> {

    /**
     * 校验值是否符合约束
     *
     * <p>意图：找出所有的错误，而不是只返回发现的第一个错误，以便调试（特别是参数较多的情况）
     *
     * @param percent 校验值
     * @param context {@link ConstraintValidatorContext} context in which the constraint is
     *     evaluated
     * @return {@code false} if {@code value} does not pass the constraint
     */
    @Override
    @SuppressWarnings("FeatureEnvy")
    public boolean isValid(Double percent, ConstraintValidatorContext context) {

        if (null == percent) {
            return true;
        }

        String defaultMessage = annotation.message();

        double minPercent = annotation.minPercent();
        if (percent < minPercent) {
            appendViolation(String.format("%s : 不能低于 %s!", defaultMessage, minPercent), context);
            return false;
        }

        double maxPercent = annotation.maxPercent();
        if (percent > maxPercent) {
            appendViolation(String.format("%s : 不能超过 %s!", defaultMessage, maxPercent), context);
            return false;
        }

        BigDecimal bigDecimal = new BigDecimal(String.valueOf(percent));

        int maxScale = annotation.maxScale();
        if (bigDecimal.scale() > maxScale) {
            appendViolation(
                    String.format("%s : 只能保留小数点后 %s 位!", defaultMessage, maxScale), context);
            return false;
        }

        return true;
    }
}

```

### Enum Range

Usage

```java
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class SomeDTO {
    @WithinEnum(
            enumType = ReviewState.class,
            objType = Integer.class,
            message = "状态 只能为指定范围内的值, 或传空")
    private Set<ReviewState> states;
}

```

#### @WithinEnum

```java
package xyz.icehe.validate.annotation;

import java.lang.annotation.Documented;
import java.lang.annotation.Retention;
import java.lang.annotation.RetentionPolicy;
import java.lang.annotation.Target;

import javax.validation.Constraint;
import javax.validation.Payload;

import xyz.icehe.utils.parser.EnumsParser;
import xyz.icehe.utils.EnumsParsers;
import xyz.icehe.validate.validator.impl.WithinEnumValidator;

import static java.lang.annotation.ElementType.FIELD;
import static java.lang.annotation.ElementType.METHOD;
import static java.lang.annotation.ElementType.PARAMETER;

/**
 * 校验值是否在枚举常量型指定的范围内
 *
 * <p>支持单个值或集合
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Documented
@Target({FIELD, METHOD, PARAMETER})
@Retention(RetentionPolicy.RUNTIME)
@Constraint(validatedBy = WithinEnumValidator.class)
public @interface WithinEnum {

    /** @return 枚举类型 */
    Class<? extends Enum<?>> enumType();

    /**
     * 通常枚举类型原生自带一个解析方法 {@link Enum#valueOf(Class, String)}
     *
     * <p>实际调用时，该静态方法的签名为 {@code valueOf(String)} ; 其唯一的参数的类型为 {@link String} ; 该参数的有效值范围为 枚举常量的名称
     * {@link Enum#name()} ; 即这个默认的静态解析方法，可以将枚举常量的名称转换为枚举常量.
     *
     * <p>所以这里默认的校验对象的类型是 {@link String} ; {@link WithinEnumValidator} 用 {@link EnumsParsers} 获取
     * {@link EnumsParser} 时, 若未指定 {@link WithinEnum#parseMethod()} , 就会用 {@link Enum#valueOf(Class,
     * String)} 来解析校验对象.
     *
     * @return 校验对象的类型
     */
    Class<?> objType() default String.class;

    /**
     * @return 将校验值转换为枚举常量的静态方法的名称
     *     <p>必须为枚举类拥有的静态方法
     *     <p>不主动提供转换方法的名称时， 校验器会自动寻找枚举类中可用于将校验值转换枚举常量的方法。
     */
    String parseMethod() default "";

    /** @return 错误信息 */
    String message() default "集合中的值必须在枚举常量的范围内";

    /** @return 所属的校验组 */
    Class<?>[] groups() default {};

    /** @return 约束条件的严重级别 */
    Class<? extends Payload>[] payload() default {};
}

```

#### WithinEnumValidator

```java
package xyz.icehe.validate.validator.impl;

import java.util.Collection;
import java.util.Collections;
import java.util.EnumSet;
import java.util.Map;
import java.util.Optional;
import java.util.Set;
import java.util.function.Function;
import java.util.stream.Collectors;

import javax.validation.ConstraintValidatorContext;

import com.google.common.collect.Sets;
import xyz.icehe.parser.EnumsParser;
import xyz.icehe.utils.EnumsParsers;
import xyz.icehe.validate.annotation.WithinEnum;
import xyz.icehe.validate.validator.AbstractValidator;
import xyz.icehe.validate.violation.ViolationBuilder;
import org.springframework.util.CollectionUtils;

/**
 * 校验一个集合的值是否在枚举类指定的范围内
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
public class WithinEnumValidator extends AbstractValidator<WithinEnum, Object> {

    /**
     * 校验对象是否符合约束
     *
     * <p>意图：找出所有的错误，而不是只返回发现的第一个错误，以便调试（特别是参数较多的情况）
     *
     * @param obj     校验对象
     * @param context context in which the constraint is evaluated
     * @return {@code false} if {@code obj} does not pass the constraint
     */
    @Override
    @SuppressWarnings("FeatureEnvy")
    public boolean isValid(Object obj, ConstraintValidatorContext context) {

        if (null == obj) {
            return true;
        }

        Collection<?> objs = convertSingleton2Collection(obj);

        if (CollectionUtils.isEmpty(objs)) {
            return true;
        }

        EnumsParser enumsParser =
            EnumsParsers.parserOf(
                annotation.enumType(), annotation.objType(), annotation.parseMethod());

        Map<?, Optional<Enum<?>>> obj2EnumMap = enumsParser.parse(objs);

        Set<?> invalidObjs = findInvalidObjects(obj2EnumMap);

        Set<Enum<?>> duplicateEnums =
            (objs instanceof Set) ? Collections.emptySet() : findDuplicateEnums(obj2EnumMap);

        ViolationBuilder violationBuilder = new ViolationBuilder(annotation.message(), context);

        if (!invalidObjs.isEmpty()) {
            violationBuilder
                .append("{ 不能包含无效值 : 无效值为 ")
                .append(invalidObjs)
                .append(" ; 可选有效值为 ")
                .append(getOptionalEnums())
                .append(" } ");
            ;
        }

        if (!duplicateEnums.isEmpty()) {
            violationBuilder.append("{ 不能包含重复值 : 重复值为 ").append(duplicateEnums).append(" } ");
        }

        return !violationBuilder.build();
    }

    /**
     * 将单个对象转换到对象的集合
     *
     * <p>如果 obj 本身不是 Collection，就将它包装为 Collection.
     *
     * @param obj {@link Object}
     * @return {@link Collection}
     */
    private Collection<?> convertSingleton2Collection(Object obj) {
        return (obj instanceof Collection) ? (Collection<?>)obj : Sets.newHashSet(obj);
    }

    /**
     * 找出无法转换为枚举常量的无效对象
     *
     * @param objEnumMap 值到枚举常量的映射
     * @return 无效对象的集合
     */
    private Set<?> findInvalidObjects(Map<?, Optional<Enum<?>>> objEnumMap) {

        return objEnumMap.entrySet().stream()
            .filter(entry -> !entry.getValue().isPresent())
            .map(Map.Entry::getKey)
            .collect(Collectors.toSet());
    }

    /**
     * 找出重复的枚举常量
     *
     * @param objEnumMap 对象到枚举常量的映射
     * @return 重复枚举常量的集合
     */
    private Set<Enum<?>> findDuplicateEnums(Map<?, Optional<Enum<?>>> objEnumMap) {

        return objEnumMap.values().stream()
            .filter(Optional::isPresent)
            .map(Optional::get)
            .collect(Collectors.groupingByConcurrent(Function.identity(), Collectors.counting()))
            .entrySet()
            .stream()
            .filter(enumCount -> 1 < enumCount.getValue())
            .map(Map.Entry::getKey)
            .collect(Collectors.toSet());
    }

    /**
     * 获取枚举类所有的枚举常量
     *
     * @return 枚举常量的集合
     */
    @SuppressWarnings("unchecked")
    private EnumSet<?> getOptionalEnums() {
        return EnumSet.allOf((Class<? extends Enum>)annotation.enumType());
    }
}

```

### Interceptor

- ServiceInterceptor and its Helpers

#### Helpers

##### JoinPointHelper

```java
package xyz.icehe.intercept;

import java.util.Map;
import java.util.Objects;
import java.util.stream.IntStream;
import java.util.stream.Stream;

import com.google.common.collect.Maps;
import lombok.experimental.UtilityClass;
import xyz.icehe.transport.UserAuthentication;
import org.aspectj.lang.JoinPoint;
import org.aspectj.lang.reflect.MethodSignature;

/**
 * 连接点操作的辅助组件
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@UtilityClass
public class JoinPointHelper {

    private final String JOIN_POINT = "joinPoint";

    /**
     * 根据连接点提取出参数映射
     *
     * @param joinPoint {@link JoinPoint} 连接点
     * @return 参数映射
     */
    public Map<String, Object> extractParamMap(JoinPoint joinPoint) {

        Objects.requireNonNull(joinPoint, JOIN_POINT + " 不能为 null");

        MethodSignature signature = (MethodSignature) joinPoint.getSignature();

        String[] argNames = signature.getParameterNames();
        Object[] args = joinPoint.getArgs();

        /*
         * 通过 stream 调用 .collect(Collectors.toMap(i -> argNames[i], i -> args[i])) 转换为 map 的方式，
         * 并不允许 value 为 null，所以这里只好使用迭代的写法。
         * 原因参考：https://stackoverflow.com/questions/698638/why-does-concurrenthashmap-prevent-null-keys-and-values
         */
        Map<String, Object> argMap = Maps.newHashMap();
        IntStream.range(0, args.length).forEach(i -> argMap.put(argNames[i], args[i]));

        return argMap;
    }

    /**
     * 根据连接点提取出用户身份认证信息
     *
     * @param joinPoint {@link JoinPoint}
     * @return {@link UserAuthentication}
     */
    public UserAuthentication extractUserAuth(JoinPoint joinPoint) {

        Objects.requireNonNull(joinPoint, JOIN_POINT + " 不能为 null");

        return (UserAuthentication) Stream.of(joinPoint.getArgs())
            .filter(UserAuthentication.class::isInstance)
            .findFirst()
            .orElse(null);
    }
}

```

##### ParameterValidator

```java
package xyz.icehe.intercept;

import java.lang.reflect.Method;
import java.util.List;
import java.util.Map;
import java.util.Objects;
import java.util.Set;
import java.util.stream.Collectors;

import javax.validation.ConstraintValidator;
import javax.validation.ConstraintViolation;
import javax.validation.Validator;
import javax.validation.executable.ExecutableValidator;
import javax.validation.groups.Default;

import com.google.common.collect.Lists;
import org.apache.commons.lang3.StringUtils;
import org.aspectj.lang.JoinPoint;
import org.aspectj.lang.reflect.MethodSignature;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.util.CollectionUtils;
import org.springframework.validation.beanvalidation.LocalValidatorFactoryBean;

/**
 * 参数校验器
 *
 * @author icehe.xyz
 * @since 2020/11/04
 */
@Component
public class ParameterValidator {

    private static final String PARAMS_ERROR_MSG = "参数不符合要求";

    private final LocalValidatorFactoryBean localValidatorFactoryBean;

    /**
     * 校验 bean 实例的校验器
     *
     * <p>通常通过 {@code Validation.buildDefaultValidatorFactory().getValidator()} 获得.
     *
     * <p>但是这样创建的 Validator 有个缺点, 它创建并调用的实现了接口 {@link ConstraintValidator} 的约束校验器, 无法直接使用注解 {@link
     * Autowired} 注入 Spring 管理下的 bean.
     *
     * <p>因此采取 {@link LocalValidatorFactoryBean} 集中管理的方式.
     */
    private final Validator validator;

    /**
     * @see LocalValidatorFactoryBean class javadoc comments
     */
    private final ExecutableValidator executableValidator;

    /**
     * Constructor
     *
     * @param localValidatorFactoryBean {@link LocalValidatorFactoryBean}
     */
    @Autowired
    public ParameterValidator(LocalValidatorFactoryBean localValidatorFactoryBean) {
        this.localValidatorFactoryBean = localValidatorFactoryBean;
        validator = localValidatorFactoryBean.getValidator();
        executableValidator = validator.forExecutables();
    }

    /**
     * 校验参数 (方法级别)
     *
     * <p>这里会将所有的参数异常都列出，而不是只返回发现的第一个错误，以便调试（特别是参数较多的情况）。
     *
     * <p>可能有多个参数违反约束，一个参数又可能违反多种约束， 所以设计通过 Throwable 的 suppressedExceptions 嵌套多个层次的异常。
     *
     * @param joinPoint {@link JoinPoint}
     * @throws Exception 服务异常 参数违反约束的异常
     */
    public void validateParams(JoinPoint joinPoint) throws Exception {

        Object target = joinPoint.getTarget();
        Method method = ((MethodSignature)joinPoint.getSignature()).getMethod();
        Object[] args = joinPoint.getArgs();

        Set<ConstraintViolation<Object>> constraintViolations =
            executableValidator.validateParameters(target, method, args);

        List<Exception> paramExceptions =
            constraintViolations.stream()
                .map(this::violation2Exception)
                .collect(Collectors.toList());

        if (!paramExceptions.isEmpty()) {
            throw buildParamsException(PARAMS_ERROR_MSG, paramExceptions);
        }

        validateParams(JoinPointHelper.extractParamMap(joinPoint));
    }

    /**
     * 校验参数 (参数级别)
     *
     * <p>这里会将所有的参数异常都列出，而不是只返回发现的第一个错误，以便调试（特别是参数较多的情况）。
     *
     * <p>可能有多个参数违反约束，一个参数又可能违反多种约束， 所以设计通过 Throwable 的 suppressedExceptions 嵌套多个层次的异常。
     *
     * @param paramMap 参数的映射
     * @throws Exception 服务异常 参数违反约束的异常
     */
    public void validateParams(Map<String, Object> paramMap) throws Exception {
        // 校验参数
        List<Throwable> throwables = paramMap.entrySet().stream()
            .map(param -> validateParam(param.getKey(), param.getValue()))
            .filter(Objects::nonNull)
            .collect(Collectors.toList());

        if (CollectionUtils.isEmpty(throwables)) {
            return;
        }

        // 减少异常的嵌套层次：如果某个层次，只有一个异常，那么这时就没必要嵌套那么深了
        while (1 == throwables.size()) {
            Throwable exception = throwables.get(0);

            if (null == exception) {
                break;
            }

            if (0 == exception.getSuppressed().length) {
                throw (Exception)exception;
            }

            throwables = Lists.newArrayList(exception.getSuppressed());
        }

        throw buildParamsException(PARAMS_ERROR_MSG, throwables);
    }

    /**
     * 验证单个参数
     *
     * @param argName 参数名称
     * @param arg     参数值
     * @return {@link Exception} 参数正常时，返回 null
     */
    private Exception validateParam(String argName, Object arg) {
        if (null == arg) {
            return new Exception(String.format("[ 参数 %s%s ]", argName, " 不能为 null"));
        }

        Set<ConstraintViolation<Object>> constraintViolations = validator.validate(arg, Default.class);
        if (constraintViolations.isEmpty()) {
            return null;
        }

        List<Exception> paramExceptions = constraintViolations.stream()
            .map(this::violation2Exception)
            .collect(Collectors.toList());
        if (paramExceptions.isEmpty()) {
            return null;
        }

        String errorMsg = String.format("参数 %s 不符合要求", argName);
        return buildParamsException(errorMsg, paramExceptions);
    }

    /**
     * 将参数违反的约束转换为参数异常
     *
     * @param violation {@link ConstraintViolation}
     * @return {@link Exception}
     */
    private Exception violation2Exception(ConstraintViolation<Object> violation) {

        String invalidField = violation.getPropertyPath().toString();
        String invalidValue = Objects.toString(violation.getInvalidValue());
        String violationMsg = violation.getMessage();

        String errorMsg = String.format("[ %s : %s=%s ]", violationMsg, invalidField, invalidValue);
        return new Exception(errorMsg);
    }

    /**
     * 构建参数错误
     *
     * @param errorMsg        初始的错误信息
     * @param paramThrowables 参数异常列表
     * @return {@link Exception}
     */
    private Exception buildParamsException(
        String errorMsg, List<? extends Throwable> paramThrowables) {

        Object[] errorMsgArray = paramThrowables.stream().map(Throwable::getMessage).toArray();
        String completeMsg = String.format("[ %s : %s ]", errorMsg, StringUtils.join(errorMsgArray, ", "));

        Exception paramException = new Exception(completeMsg);
        paramThrowables.forEach(paramException::addSuppressed);

        return paramException;
    }
}

```

#####

```java
package xyz.icehe.transport;

import com.alibaba.fastjson.annotation.JSONField;
import com.alibaba.fastjson.serializer.SerializerFeature;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

/**
 * Response 响应结果
 *
 * <p>Should use static factory methods {@link Responses#of} and so on instead of {@code new}
 * constructor to of a response.
 *
 * @author icehe.xyz
 * @since 2020/11/04
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class Response<T> {

    private static final long serialVersionUID = -2021643570873555043L;

    /**
     * Error Code 错误码
     *
     * <p>SerializerFeature.WriteNullStringAsEmpty : 当值为 null 时，输出空字符串 ""
     */
    @JSONField(serialzeFeatures = SerializerFeature.WriteNullStringAsEmpty)
    protected String code;

    /**
     * Error Message 错误信息
     */
    @JSONField(serialzeFeatures = SerializerFeature.WriteNullStringAsEmpty)
    protected String message;

    /**
     * Data 响应数据
     *
     * <p>T could be any jsonable object.
     */
    protected T data;
}

```

#### Aspect

```java
package xyz.icehe.intercept;

import java.util.Map;

import lombok.extern.slf4j.Slf4j;
import xyz.icehe.intercept.JoinPointHelper;
import xyz.icehe.intercept.ParameterValidator;
import xyz.icehe.transport.Response;
import org.aspectj.lang.ProceedingJoinPoint;
import org.aspectj.lang.annotation.Around;
import org.aspectj.lang.annotation.Aspect;
import org.aspectj.lang.reflect.MethodSignature;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.core.annotation.Order;
import org.springframework.stereotype.Component;

/**
 * 服务统一切面拦截处理器
 *
 * <p><a href="https://www.mekau.com/4880.html">AspectJ切入点@Pointcut语法详解 &#8211; 不静之心</a>
 *
 * @author icehe.xyzj
 * @since 2020/11/04
 */
@Slf4j
@Aspect
@Component
@Order(10000)
public class ServiceInterceptor {

    @Autowired
    private final ParameterValidator parameterValidator;

    /**
     * 轩辕服务统一切面
     *
     * <p>用户身份认证，请求参数校验，处理异常，记录日志
     *
     * @param joinPoint {@link ProceedingJoinPoint} 连接点
     * @return 响应结果
     * @throws Exception
     */
    @Around("execution(* xyz.icehe.service.*Service.*(..)) || execution(* xyz.icehe.api.task.*Service.*(..))")
    public Object monitorXyService(ProceedingJoinPoint joinPoint) throws Exception {

        long startTime = System.currentTimeMillis();
        MethodSignature methodSignature = (MethodSignature)joinPoint.getSignature();
        String methodName = getMethodName(methodSignature);

        Object response;
        try {
            Map<String, Object> argMap = JoinPointHelper.extractParamMap(joinPoint);
            log.info("{} 请求参数 request={}", methodName, JsonUtil.toJsonString(argMap));

            validateUserAuthAndParams(joinPoint, argMap);

            response = joinPoint.proceed();
            log.info("{} 响应结果 response={}", methodName, JsonUtil.toJsonString(response));

        } catch (RuntimeException e) {
            log.error("{} 服务异常", methodName, e);
            if (Response.class.isAssignableFrom(methodSignature.getReturnType())) {
                return new Response<>("code", "message", null);
            }
            throw e;

        } catch (Throwable e) {
            log.error("{} 异常", methodName, e);
            if (Response.class.isAssignableFrom(methodSignature.getReturnType())) {
                return new Response<>("code", "message", null);
            }
            throw (Exception)e;

        } finally {
            long endTime = System.currentTimeMillis();
            log.info("业务处理耗时 method={}, duration={}", methodName, (endTime - startTime) + "ms");
        }

        return response;
    }

    /**
     * 根据连接点获取调用的方法名
     *
     * @param methodSignature {@link MethodSignature}
     * @return String 调用的方法名
     */
    private String getMethodName(MethodSignature methodSignature) {
        return String.format("%s.%s(…)",
            methodSignature.getDeclaringType().getSimpleName(),
            methodSignature.getMethod().getName());
    }

    /**
     * @param joinPoint {@link ProceedingJoinPoint}
     * @param argMap    参数映射
     * @throws Exception
     */
    private void validateUserAuthAndParams(ProceedingJoinPoint joinPoint, Map<String, Object> argMap)
        throws Exception {
        parameterValidator.validateParams(argMap);
    }
}
```

## Common DTOs

### PageCondition

```java
import com.fasterxml.jackson.annotation.JsonIgnore;
import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

/**
 * 翻页条件
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class PageCondition {

    /**
     * 页码: 至少为 1
     */
    private Integer pageIndex;

    /**
     * 每页数据条数: 至少为 1
     */
    private Integer pageSize;

    /**
     * @return 获取查询偏移量
     */
    @JsonIgnore
    public Integer getOffset() {
        return (getPageIndex() - 1) * getPageSize();
    }

    /**
     * @return 获取查询数量
     */
    @JsonIgnore
    public Integer getLimit() {
        return getPageSize();
    }
}

```

### PageDTO

```java
import java.util.List;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

/**
 * 可翻页数据
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class PageDTO<T> {

    /**
     * 总页数
     */
    private Integer pageTotal;

    /**
     * 页码
     */
    private Integer pageIndex;

    /**
     * 每页数据条数
     */
    private Integer pageSize;

    /**
     * 数据总条数
     */
    private Integer itemTotal;

    /**
     * 数据
     */
    private List<T> items;
}

```

## Excel

- How to Write to an Excel file in Java using Apache POI | CalliCoder : https://www.callicoder.com/java-write-excel-file-apache-poi/

### Read from bytes

```java
package xyz.icehe.utils;

import java.io.BufferedInputStream;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.util.List;
import java.util.stream.Collectors;

import lombok.experimental.UtilityClass;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.springframework.data.util.StreamUtils;

/**
 * @author icehe.xyz
 * @since 2020/10/16
 */
@UtilityClass
public class ExcelUtils {

    /**
     * 将 Excel 文件数据 (字节数组) 转换为二维表格
     *
     * @param excelData
     * @return sheet => [ row => [cell] ]
     * @throws Exception
     */
    public List<List<String>> convertExcelData2Table(byte[] excelData) throws Exception {

        List<List<String>> table;

        try (ByteArrayInputStream byteInputStream = new ByteArrayInputStream(excelData);
             BufferedInputStream bufferedInputStream = new BufferedInputStream(byteInputStream);
             Workbook workbook = new XSSFWorkbook(bufferedInputStream)) {

            Sheet sheet = extractFirstSheetFromWorkbook(workbook);
            table = convertExcelSheet2Table(sheet);

        } catch (IOException e) {
            String msg =
                String.format("cannot read or parse excel file, errorMsg=%s", e.getMessage());
            throw new Exception(msg);
        }

        return table;
    }

    /**
     * 提取 Excel 工作簿 {@link Workbook} 的第一个表单 {@link Sheet}
     */
    private Sheet extractFirstSheetFromWorkbook(Workbook workbook) throws Exception {
        Sheet sheet = workbook.getSheetAt(0);
        if (null == sheet) {
            throw new Exception("Excel 文件中没有包含表单 (Sheet)");
        }
        return sheet;
    }

    /**
     * 将 Excel 表格 {@link Sheet} 转换为二维表格
     */
    private List<List<String>> convertExcelSheet2Table(Sheet sheet) {
        return StreamUtils.createStreamFromIterator(sheet.rowIterator())
            .map(ExcelUtils::convertSheetRowToTableRow)
            .collect(Collectors.toList());
    }

    /**
     * 将 Excel 表格的一行 {@link Row}, 转换为二维表格的一行
     */
    private List<String> convertSheetRowToTableRow(Row row) {
        return StreamUtils.createStreamFromIterator(row.cellIterator())
            .map(ExcelUtils::convertRowCellToString)
            .collect(Collectors.toList());
    }

    /**
     * 将 Excel 表格行的一个单元格 {@link Cell}, 转换为字符串
     */
    private String convertRowCellToString(Cell cell) {
        if (null == cell) {
            return "";
        }

        switch (cell.getCellTypeEnum()) {
            case NUMERIC:
                return String.valueOf(cell.getNumericCellValue());
            case STRING:
                // fall through
            default:
                return cell.getStringCellValue();
        }
    }
}

```

### Write to bytes

```java
package xyz.icehe.utils;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import lombok.experimental.UtilityClass;
import lombok.extern.slf4j.Slf4j;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.springframework.util.CollectionUtils;

/**
 * Excel 文件写入器
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Slf4j
@UtilityClass
public class ExcelWriter {

    private final String EMPTY_TABLE_ERROR_MSG =
        "ExcelWriter.writeExcel(), table must be non-empty";

    /**
     * 将表格写入到 Excel 文件的输出流中
     *
     * <p>第一行为表头
     *
     * @param table 二维表格
     * @return {@link ByteArrayOutputStream}
     * @throws Exception
     * @see <a href="https://www.callicoder.com/java-write-excel-file-apache-poi">How to Write to an
     * Excel file in Java using Apache POI</a>
     */
    public ByteArrayOutputStream writeExcelIntoOutputStream(List<? extends ArrayList<String>> table) throws Exception {

        if (CollectionUtils.isEmpty(table)) {
            log.warn(EMPTY_TABLE_ERROR_MSG);
            throw new IllegalArgumentException(EMPTY_TABLE_ERROR_MSG);
        }

        // HSSFWorkbook for generating `.xls` file
        try (Workbook workbook = new XSSFWorkbook()) {

            Sheet sheet = workbook.createSheet("table");

            // 去掉表头
            List<String> headers = table.remove(0);

            writeTableBody(sheet, table);

            if (!CollectionUtils.isEmpty(headers)) {
                writeTableHeaders(sheet, headers);

                // Resize all columns to fit the content size
                for (int i = 0; i < headers.size(); i++) {
                    sheet.autoSizeColumn(i);
                }
            }

            return toOutputStream(workbook);
        } catch (Exception e) {
            log.error("ExcelWriter.writeExcel()", e);
            throw new Exception(e);
        }
    }

    /**
     * 写入表格内容
     *
     * @param sheet {@link Sheet} Excel 表单
     * @param table 二维表格
     */
    private void writeTableBody(Sheet sheet, List<? extends ArrayList<String>> table) {
        // 从第 1 行而非第 0 行开始，跳过了表头的初始化（由另一方法做）
        int rowNum = 1;
        for (List<String> rowFields : table) {
            Row row = sheet.createRow(rowNum++);

            if (CollectionUtils.isEmpty(rowFields)) {
                continue;
            }

            int colNum = 0;
            for (String field : rowFields) {
                row.createCell(colNum++).setCellValue(field);
            }
        }
    }

    /**
     * 写入表头
     *
     * @param sheet   {@link Sheet} Excel 表单
     * @param headers 表头
     */
    private void writeTableHeaders(Sheet sheet, List<String> headers) {
        Row headerRow = sheet.createRow(0);
        int i = 0;
        for (String columnName : headers) {
            Cell cell = headerRow.createCell(i++);
            cell.setCellValue(columnName);
        }
    }

    /**
     * 将表格写入到输出流中
     *
     * @param workbook {@link Workbook} Excel Workbook
     * @return {@link ByteArrayOutputStream}
     * @throws Exception
     */
    private ByteArrayOutputStream toOutputStream(Workbook workbook) throws Exception {
        try {
            ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
            workbook.write(outputStream);
            return outputStream;
        } catch (IOException e) {
            log.error("ExcelWriter.saveFile()", e);
            throw new Exception(e);
        }
    }
}

```

## JDBC

### Query Count

```java
String sql = "SELECT count(*) FROM ? …";
int count = jdbcInfo.getJdbcTemplate().queryForInt(sql, params);

```

## MyBatis

Reference

- MyBatis 3
    - https://mybatis.org/mybatis-3/zh/index.html
- MyBatis-Plus ( TO TRY )
    - https://mybatis.plus | https://mybatis.plus/en

### Generate

- generatorConfig.xml

```json
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE generatorConfiguration
        PUBLIC "-//mybatis.org//DTD MyBatis Generator Configuration 1.0//EN"
        "http://mybatis.org/dtd/mybatis-generator-config_1_0.dtd">

<generatorConfiguration>

    <properties resource="jdbc.properties"/>

    <context id="default" targetRuntime="MyBatis3" defaultModelType="flat">

        <!--格式化 XML 代码-->
        <property name="xmlFormatter" value="org.mybatis.generator.api.dom.DefaultXmlFormatter"/>

        <plugin type="org.mybatis.generator.plugins.RowBoundsPlugin"/>


        <!-- optional，旨在创建class时，对注释进行控制 -->
        <commentGenerator>
            <property name="addRemarkComments" value="true"/>
            <!--  关闭自动生成的注释  -->
            <property name="suppressAllComments" value="true"/>
            <property name="suppressDate" value="true"/>
        </commentGenerator>


        <!--jdbc的数据库连接：驱动类、链接地址、用户名、密码-->
        <jdbcConnection driverClass="${jdbc.driverClassName}"
                        connectionURL="${jdbc.service_url}" userId="${jdbc.service_username}"
                        password="${jdbc.service_password}"/>


        <!--
             默认false，把JDBC DECIMAL和NUMERIC类型解析为 Integer，
             为true时把JDBC DECIMAL和NUMERIC类型解析为java.math.BigDecimal
        -->
        <javaTypeResolver>
            <property name="forceBigDecimals" value="false"/>
            <property name="useJSR310Types" value="true"/>
        </javaTypeResolver>


        <!-- Model模型生成器,用来生成含有主键key的类，记录类 以及查询Example类
            targetPackage     指定生成的model生成所在的包名
            targetProject     指定在该项目下所在的路径
        -->
        <javaModelGenerator targetPackage="me.ele.lpd.fnpt.buyermall.repository.po"
                            targetProject="src/main/java">
            <!-- 是否允许子包，即targetPackage.schemaName.tableName -->
            <property name="enableSubPackages" value="false"/>
            <!-- 是否对model添加 构造函数 -->
            <property name="constructorBased" value="false"/>
            <!-- 是否对类CHAR类型的列的数据进行trim操作 -->
            <property name="trimStrings" value="true"/>
            <!-- 建立的Model对象是否不可改变  即生成的Model对象不会有setter方法，只有构造方法 -->
            <property name="immutable" value="false"/>
        </javaModelGenerator>


        <!--Mapper映射文件生成所在的目录 为每一个数据库的表生成对应的SqlMap文件 -->
        <sqlMapGenerator targetPackage="xyz.icehe.orm.mapper"
                         targetProject="src/main/java">
            <property name="enableSubPackages" value="false"/>
        </sqlMapGenerator>


        <!-- 客户端代码，生成易于使用的针对Model对象和XML配置文件 的代码
                type="ANNOTATEDMAPPER",生成Java Model 和基于注解的Mapper对象
                type="MIXEDMAPPER",生成基于注解的Java Model 和相应的Mapper对象
                type="XMLMAPPER",生成SQLMap XML文件和独立的Mapper接口
        -->
        <javaClientGenerator targetPackage="xyz.icehe.orm.mapper"
                             targetProject="src/main/java" type="XMLMAPPER">
            <property name="enableSubPackages" value="false"/>
        </javaClientGenerator>

        <table tableName="account" domainObjectName="AccountPO">
            <columnOverride column="role" javaType="java.lang.Integer"/>
            <columnOverride column="status" javaType="java.lang.Integer"/>
            <columnOverride column="is_deleted" javaType="java.lang.Integer"/>
        </table>

    </context>
</generatorConfiguration>

```

- jdbc.properties

```java
jdbc.driverClassName=com.mysql.jdbc.Driver
jdbc.service_url=jdbc:mysql://10.234.56.78:9000/db_name?characterEncoding=UTF-8&useSSL=false
jdbc.service_username=username
jdbc.service_password=password
jdbc.service_initialSize=8
jdbc.service_minIdle=8
jdbc.service_maxActive=16

```

### Handwrite

#### ConfigMapper.java

```java
package xyz.icehe.orm.mapper;

import xyz.icehe.enums.ConfigState;
import xyz.icehe.condition.ConfigCondition;
import xyz.icehe.orm.po.ConfigPO;
import org.apache.ibatis.annotations.Param;
import org.apache.ibatis.session.RowBounds;
import org.springframework.stereotype.Component;

import java.util.EnumSet;
import java.util.List;
import java.util.Set;

/**
 * 配置 Persistent Object 的 Mapper
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Component
public interface ConfigMapper {

    /**
     * 插入配置
     *
     * @param record 配置
     * @return 插入的数据行数
     */
    int insert(ConfigPO record);

    /**
     * 批量插入配置
     *
     * @param configs 配置列表
     * @return 插入的数据行数
     */
    int batchInsert(@Param("configs") List<ConfigPO> configs);

    /**
     * 删除配置
     *
     * @param id 配置记录 ID
     * @return 删除的数据行数
     */
    int deleteById(Long id);

    /**
     * 更新配置
     *
     * @param record {@link ConfigPO}
     * @return 更新的数据行数
     */
    int update(ConfigPO record);

    /**
     * 批量更新配置的状态
     *
     * @param ids ID 集合
     * @param fromStates 允许从哪些状态
     * @param toState 修改到哪个状态
     * @return 更新的数据行数
     */
    int batchUpdateStates(
            @Param("ids") Set<Long> ids,
            @Param("fromStates") EnumSet<ConfigState> fromStates,
            @Param("toState") ConfigState toState);

    /**
     * 根据配置 ID 集合, 将配置标识为 "已被删除" 的状态
     *
     * @param ids 配置 ID 集合
     * @return 更新的数据行数
     */
    int markDeletedByIds(@Param("ids") Set<Long> ids);

    /**
     * 获取配置的数量
     *
     * @param conditions {@link ConfigCondition}
     * @return 配置的数量
     */
    int countByConditions(ConfigCondition conditions);

    /**
     * 获取配置 (不分页)
     *
     * @param conditions {@link ConfigCondition}
     * @return {@link ConfigPO} {@link List} 按创建时间倒序排列
     */
    List<ConfigPO> selectByConditions(ConfigCondition conditions);

    /**
     * 获取配置 (分页查询)
     *
     * @param conditions {@link ConfigCondition}
     * @param rowBounds {@link RowBounds} 行限制：包括查询偏移量、获取行数
     * @return {@link ConfigPO} {@link List} 按创建时间倒序排列
     */
    List<ConfigPO> selectByConditions(ConfigCondition conditions, RowBounds rowBounds);
}

```

#### ConfigMapper.xml

```java
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE mapper PUBLIC "-//mybatis.org//DTD Mapper 3.0//EN" "http://mybatis.org/dtd/mybatis-3-mapper.dtd">
<mapper namespace="xyz.icehe.orm.mapper.ConfigMapper">

    <resultMap id="BaseResultMap" type="xyz.icehe.orm.po.ConfigPO">
        <constructor>
            <idArg column="id" javaType="java.lang.Long" jdbcType="BIGINT"/>
            <arg column="name" javaType="java.lang.String" jdbcType="VARCHAR"/>
            <arg column="start_time" javaType="java.time.LocalDateTime" jdbcType="TIMESTAMP"/>
            <arg column="end_time" javaType="java.time.LocalDateTime" jdbcType="TIMESTAMP"/>
            <arg column="state" javaType="java.lang.Integer" jdbcType="INTEGER"/>
            <arg column="is_deleted" javaType="java.lang.Boolean" jdbcType="INTEGER"/>
            <arg column="created_at" javaType="java.time.LocalDateTime" jdbcType="TIMESTAMP"/>
            <arg column="updated_at" javaType="java.time.LocalDateTime" jdbcType="TIMESTAMP"/>
        </constructor>
    </resultMap>

    <sql id="TableName">
        optimal_rider_config
    </sql>

    <sql id="BaseColumnList">
        id,
        name,
        start_time,
        end_time,
        state,
        is_deleted,
        created_at,
        updated_at
    </sql>

    <sql id="InsertColumnList">
        name,
        start_time,
        end_time,
        state,
    </sql>

    <sql id="WhereConditions">
        <where>
            <if test="ids != null and !ids.isEmpty()">
                and id in
                <foreach collection="ids" item="id" separator="," open="(" close=")">
                    #{id}
                </foreach>
            </if>
            <if test="name != null">
                and name like "%"#{name}"%"
            </if>
            <if test="startTimes != null and !startTimes.isEmpty()">
                and start_time in
                <foreach collection="startTimes" item="startTime" separator="," open="(" close=")">
                    #{startTime}
                </foreach>
            </if>
            <if test="period != null">
                <if test="period.startTime != null">
                    and start_time <![CDATA[ >= ]]> #{period.startTime}
                </if>
                <if test="period.endTime != null">
                    and end_time <![CDATA[ <= ]]> #{period.endTime}
                </if>
            </if>
            <if test="periodIncluded != null">
                <if test="periodIncluded.startTime != null">
                    and start_time <![CDATA[ <= ]]> #{periodIncluded.startTime}
                </if>
                <if test="periodIncluded.endTime != null">
                    and end_time <![CDATA[ >= ]]> #{periodIncluded.endTime}
                </if>
            </if>
            <if test="states != null and !states.isEmpty()">
                and state in
                <foreach collection="states" item="state" separator="," open="(" close=")">
                    #{state.code}
                </foreach>
            </if>
            <if test="isDeleted != null">
                and is_deleted = #{isDeleted,jdbcType=INTEGER}
            </if>
            <if test="createdAtDateFrom != null">
                and created_at <![CDATA[ >= ]]> CONCAT(#{createdAtDateFrom}, ' 00:00:00')
            </if>
            <if test="createdAtDateTo != null">
                and created_at <![CDATA[ <= ]]> CONCAT(#{createdAtDateTo}, ' 23:59:59')
            </if>
        </where>
    </sql>

    <insert id="insert" parameterType="xyz.icehe.orm.entity.ConfigDO">

        <selectKey keyProperty="id" order="AFTER" resultType="java.lang.Long">
            SELECT LAST_INSERT_ID()
        </selectKey>

        insert into
        <include refid="TableName"/>
        <trim prefix="(" suffix=")" suffixOverrides=",">
            <include refid="InsertColumnList"/>
        </trim>
        <trim prefix="values (" suffix=")" suffixOverrides=",">
            #{name},
            #{startTime},
            #{endTime},
            #{state}
        </trim>
    </insert>

    <insert id="batchInsert">
        insert into
        <include refid="TableName"/>
        <trim prefix="(" suffix=")" suffixOverrides=",">
            <include refid="InsertColumnList"/>
        </trim>
        values
        <foreach collection="configs" item="config" separator=",">
            <trim prefix="(" suffix=")" suffixOverrides=",">
                #{config.name},
                #{config.startTime},
                #{config.endTime},
                #{config.state},
            </trim>
        </foreach>
    </insert>

    <delete id="deleteById" parameterType="java.lang.Long">
        delete from
        <include refid="TableName"/>
        where id = #{id}
    </delete>

    <update id="update"
            parameterType="xyz.icehe.orm.entity.ConfigDO">
        update
        <include refid="TableName"/>
        <set>
            <if test="name != null">
                name = #{name},
            </if>
            <if test="startTime != null">
                start_time = #{startTime},
            </if>
            <if test="endTime != null">
                end_time = #{endTime},
            </if>
            <if test="state != null">
                state = #{state},
            </if>
            <if test="isDeleted != null">
                is_deleted = #{isDeleted},
            </if>
        </set>
        where id = #{id}
    </update>

    <insert id="batchUpdateStates">
        update
        <include refid="TableName"/>
        <set>
            state = #{toState.code}
        </set>
        <where>
            is_deleted = 0
            and id in
            <foreach collection="ids" item="id" open="(" close=")" separator=",">
                #{id}
            </foreach>
            and state in
            <foreach collection="fromStates" item="fromState" open="(" close=")" separator=",">
                #{fromState.code}
            </foreach>
        </where>
    </insert>

    <update id="markDeletedByIds">
        update
        <include refid="TableName"/>
        set is_deleted = 1
        <where>
            is_deleted = 0
            and id in
            <foreach collection="ids" item="id" separator="," open="(" close=")">
                #{id}
            </foreach>
        </where>
    </update>

    <select id="countByConditions"
            parameterType="xyz.icehe.orm.condition.ConfigCondition"
            resultType="java.lang.Integer">
        select count(*)
        from
        <include refid="TableName"/>
        <include refid="WhereConditions"/>
    </select>

    <select id="selectByConditions"
            parameterType="xyz.icehe.orm.condition.ConfigCondition"
            resultMap="BaseResultMap">
        select
        <include refid="BaseColumnList"/>
        from
        <include refid="TableName"/>
        <include refid="WhereConditions"/>
        order by id desc, type desc
    </select>
</mapper>

```

#### ConfigPO.java

```java
package xyz.icehe.orm.po;

import java.time.LocalDateTime;

import com.alibaba.fastjson.annotation.JSONType;

import com.fasterxml.jackson.databind.PropertyNamingStrategy;
import com.fasterxml.jackson.databind.annotation.JsonNaming;
import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;
import xyz.icehe.enums.ConfigState;

/**
 * 配置 Persistent Object
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
@JsonNaming(PropertyNamingStrategy.SnakeCaseStrategy.class)
@JSONType(naming = com.alibaba.fastjson.PropertyNamingStrategy.SnakeCase)
public class ConfigPO {

    /**
     * 配置ID
     */
    private Long id;

    /**
     * 姓名
     */
    private String name;

    /**
     * 生效周期的起始时间 ( 时间部分应为: "00:00:00" )
     */
    private LocalDateTime startTime;

    /**
     * 生效周期的结束时间 ( 时间部分应为: "23:59:59" )
     */
    private LocalDateTime endTime;

    /**
     * 配置状态
     *
     * @see ConfigState
     */
    private Integer state;

    /**
     * 是否已被删除
     */
    private Boolean isDeleted;

    /**
     * 创建时间
     */
    private LocalDateTime createdAt;

    /**
     * 修改时间
     */
    private LocalDateTime updatedAt;
}

```

#### ConfigReposity.java

```java
package xyz.icehe.orm.repository;

import java.util.EnumSet;
import java.util.List;
import java.util.Set;

import lombok.NonNull;
import lombok.extern.slf4j.Slf4j;
import xyz.icehe.enums.ConfigState;
import xyz.icehe.condition.ConfigCondition;
import xyz.icehe.orm.po.ConfigPO;
import xyz.icehe.orm.mapper.ConfigMapper;
import org.apache.ibatis.session.RowBounds;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;
import org.springframework.util.CollectionUtils;

/**
 * 配置的存储仓库
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Slf4j
@Repository
public class ConfigRepository {

    @Autowired
    private ConfigMapper configMapper;

    /**
     * 插入配置
     */
    public void insert(ConfigPO configPO) throws Exception {
        if (configMapper.insert(configPO) == 0) {
            String errorMsg =
                String.format("ConfigRepository.insert failed, configPO=%s", configPO);
            log.error(errorMsg);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 批量插入配置
     */
    public void batchInsert(List<ConfigPO> configDos) throws Exception {
        if (CollectionUtils.isEmpty(configDos)) {
            log.warn("OptimalRiderConfigRepository.batchInsert, configDos={}", configDos);
            return;
        }
        if (configMapper.batchInsert(configDos) == 0) {
            String errorMsg = String.format("cannot insert rider config records, configDos=%s", configDos);
            log.error(errorMsg);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 根据 ID, 删除配置
     */
    public void deleteById(Long id) throws Exception {
        if (configMapper.deleteById(id) == 0) {
            String errorMsg = String.format("ConfigRepository.deleteById failed, id=%s", id);
            log.error(errorMsg);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 根据 ID, 更新配置
     */
    public void update(ConfigPO configPO) throws Exception {
        if (configMapper.update(configPO) == 0) {
            String errorMsg = String.format("ConfigRepository.update failed, configPO=%s", configPO);
            log.error(errorMsg);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 根据 ID 和状态, 批量更新配置的状态
     *
     * @param ids        ID 集合
     * @param fromStates 允许从哪些状态
     * @param toState    修改到哪个状态
     * @throws Exception
     */
    public void batchUpdateStates(@NonNull Set<Long> ids, EnumSet<ConfigState> fromStates, ConfigState toState)
        throws Exception {

        if (CollectionUtils.isEmpty(ids)) {
            return;
        }
        int effectedRowCount = configMapper.batchUpdateStates(ids, fromStates, toState);
        if (effectedRowCount != ids.size()) {
            log.warn(String.format("存在更新失败的配置, 可能该更新违反了约束条件, ids=%s, fromStates=%s, toState=%s",
                ids, fromStates, toState));
            throw new Exception("更新操作失败, 请重新查询以确认结果, 根据实际情况重试");
        }
    }

    /**
     * 根据配置 ID 集合, 将配置标识为 "已被删除" 的状态
     */
    public void markDeletedByIds(Set<Long> ids) throws Exception {
        if (CollectionUtils.isEmpty(ids)) {
            return;
        }
        try {
            configMapper.markDeletedByIds(ids);
        } catch (Exception e) {
            String errorMsg = String.format("ConfigRepository.markDeletedByIds failed, ids=%s", ids);
            log.error(errorMsg, e);
            throw new Exception(errorMsg);
        }
    }

    /**
     * 列举配置 (不分页)
     *
     * @param conditions {@link ConfigCondition}
     * @return {@link ConfigPO} {@link List} 按照 ID (近似于创建时间) 倒序排列
     */
    public List<ConfigPO> listByConditions(ConfigCondition conditions) {
        return configMapper.selectByConditions(conditions);
    }

    /**
     * 列举配置 (分页查询)
     *
     * @param conditions {@link ConfigCondition}
     * @param rowBounds  {@link RowBounds} 行限制：包括查询偏移量、获取行数
     * @return {@link ConfigPO} {@link List} 按照 ID (近似于创建时间) 倒序排列
     */
    public List<ConfigPO> listByConditions(
        ConfigCondition conditions, RowBounds rowBounds) {
        return configMapper.selectByConditions(conditions, rowBounds);
    }

    /**
     * 获取符合条件的第一个配置
     *
     * @param conditions {@link ConfigCondition}
     * @return {@link ConfigPO} {@link List} 按照 ID (近似于创建时间) 倒序排列, 获取 ID 最大的第一个
     */
    public ConfigPO getFirstByConditions(ConfigCondition conditions) {
        List<ConfigPO> configDos = configMapper.selectByConditions(conditions, new RowBounds(0, 1));
        return CollectionUtils.isEmpty(configDos) ? null : configDos.get(0);
    }

    /**
     * 获取配置的数量
     *
     * @param conditions {@link ConfigCondition}
     * @return 配置的数量
     */
    public int countByConditions(ConfigCondition conditions) {
        return configMapper.countByConditions(conditions);
    }
}

```

#### ConfigCondition.java

```java
package xyz.icehe.condition;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.EnumSet;
import java.util.Set;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;
import xyz.icehe.enums.ConfigState;

/**
 * 配置的查询条件
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class ConfigCondition {

    /**
     * 配置ID集合
     */
    private Set<Long> ids;

    /**
     * 姓名
     */
    private String name;

    /**
     * 生效周期的 起始时间 集合
     */
    private Set<LocalDateTime> startTimes;

    /**
     * 生效周期: 起始时间 & 结束时间; 扩大时间范围后, 可查出多个生效周期的数据
     */
    private OptimalRiderPeriodDTO period;

    /**
     * 配置的状态
     */
    @Builder.Default
    private Set<ConfigState> states = EnumSet.of(ConfigState.APPROVED);

    /**
     * 是否已被(软)删除
     */
    @Builder.Default
    private Boolean isDeleted = false;

    /**
     * 创建时间的 查询范围的 起始日期 (闭区间)
     */
    private LocalDate createdAtDateFrom;

    /**
     * 创建时间的 查询范围的 结束日期 (闭区间)
     */
    private LocalDate createdAtDateTo;
}

```

#### ConfigState.java

```java
package xyz.icehe.enums;

import java.util.EnumSet;
import java.util.Set;
import java.util.stream.Stream;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonValue;
import com.google.common.collect.ImmutableSet;
import lombok.AccessLevel;
import lombok.AllArgsConstructor;
import lombok.Getter;

/**
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Getter
@AllArgsConstructor(access = AccessLevel.PRIVATE)
public enum ConfigState {

    /**
     * 配置的状态
     */
    NOT_APPLIED(0, "未申请"),
    APPLIED(1, "待培训"),
    REJECTED(2, "审核驳回"),
    APPROVED(3, "审核通过"),
    EXPIRE_REJECTED(7, "超时未审核通过，自动驳回"),
    ;

    /**
     * 驳回状态的集合
     */
    private static final Set<ConfigState> REJECTED_STATES =
        ImmutableSet.of(REJECTED, EXPIRE_REJECTED);

    /**
     * 不可修改 (正常情况下) 的状态的集合
     */
    private static final Set<ConfigState> UNMODIFIABLE_STATES =
        ImmutableSet.of(REJECTED, EXPIRE_REJECTED);

    /**
     * 可修改的状态的集合
     */
    private static final Set<ConfigState> MODIFIABLE_STATES =
        ImmutableSet.of(NOT_APPLIED, APPLIED, APPROVED);

    /**
     * 码值
     */
    private final Integer code;

    /**
     * 说明
     */
    private final String desc;

    /**
     * 将码值转换为枚举常量
     */
    @JsonCreator
    public static ConfigState codeOf(Integer code) {
        return Stream.of(values()).filter(it -> it.equalsCode(code)).findFirst().orElse(null);
    }

    /**
     * 将名称转换为枚举常量
     */
    @JsonCreator
    public static ConfigState nameOf(String name) {
        return Stream.of(values()).filter(it -> it.name().equals(name)).findFirst().orElse(null);
    }

    /**
     * 全状态的集合
     */
    public static EnumSet<ConfigState> allStates() {
        return EnumSet.allOf(ConfigState.class);
    }

    /**
     * 除 "审核通过" 状态之外的集合
     */
    public static EnumSet<ConfigState> nonApprovedStates() {
        return EnumSet.complementOf(EnumSet.of(ConfigState.APPROVED));
    }

    /**
     * 驳回状态的集合
     */
    public static EnumSet<ConfigState> rejectedStates() {
        return EnumSet.copyOf(REJECTED_STATES);
    }

    /**
     * 驳回状态之外的集合
     */
    public static EnumSet<ConfigState> nonRejectedStates() {
        return EnumSet.complementOf(EnumSet.copyOf(REJECTED_STATES));
    }

    /**
     * 不可修改 (正常情况下) 的状态的集合
     */
    public static EnumSet<ConfigState> unmodifiableStates() {
        return EnumSet.copyOf(UNMODIFIABLE_STATES);
    }

    /**
     * 可修改的状态的集合
     */
    public static EnumSet<ConfigState> modifiableStates() {
        return EnumSet.copyOf(MODIFIABLE_STATES);
    }

    /**
     * 判断处理状态 (码值) 是否相等
     */
    public boolean equalsCode(Integer value) {
        return getCode().equals(value);
    }

    /**
     * 是否属于一种驳回状态
     */
    public boolean isRejection() {
        return REJECTED_STATES.contains(this);
    }

    /**
     * 获取码值
     *
     * @return
     */
    @JsonValue
    public Integer getCode() {
        return code;
    }
}

```

### PageHelper

Reference

- https://pagehelper.github.io/docs
- 在系统中发现了多个分页插件, 请检查系统配置 : https://www.cnblogs.com/imdeveloper/p/13529827.html

#### Utils

```java
package xyz.icehe.utils;

import java.util.List;

import com.github.pagehelper.*;
import lombok.experimental.UtilityClass;
import lombok.extern.slf4j.Slf4j;

/**
 * PageHelper 的工具集
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Slf4j
@UtilityClass
public class PageHelperUtils {

    /**
     * 根据页码和每页数据条数, 获取翻页结果
     *
     * @param <T>
     * @param pageIndex
     * @param pageSize
     * @param iSelect
     * @return
     */
    public <T> Page<T> getPage(Integer pageIndex, Integer pageSize, ISelect iSelect) {
        return getPage(pageIndex, pageSize, iSelect, true);
    }

    /**
     * 根据偏移量和限制数量, 获取分页结果
     *
     * @param <T>
     * @param offset
     * @param limit
     * @param iSelect
     * @return
     */
    public <T> Page<T> getOffsetPage(Integer offset, Integer limit, ISelect iSelect) {
        return getOffsetPage(offset, limit, iSelect, true);
    }

    /**
     * 根据页码和每页数据条数, 获取翻页结果列表
     *
     * @param pageIndex
     * @param pageSize
     * @param iSelect
     * @param <T>
     * @return
     */
    public <T> List<T> getList(Integer pageIndex, Integer pageSize, ISelect iSelect) {
        return (List<T>)getPage(pageIndex, pageSize, iSelect, false);
    }

    /**
     * 根据偏移量和限制数量, 获取分页结果
     *
     * @param offset
     * @param limit
     * @param iSelect
     * @param <T>
     * @return
     */
    public <T> List<T> getOffsetList(Integer offset, Integer limit, ISelect iSelect) {
        return (List<T>)getOffsetPage(offset, limit, iSelect, false);
    }

    /**
     * 根据页码和每页数据条数, 获取翻页结果
     *
     * @param <T>
     * @param pageIndex
     * @param pageSize
     * @param iSelect
     * @param needCount
     * @return
     */
    private <T> Page<T> getPage(Integer pageIndex, Integer pageSize, ISelect iSelect, boolean needCount) {
        if (null == pageIndex || null == pageSize || pageIndex <= 0 || pageSize <= 0) {
            log.error("PageUtils.getPage failed, invalid page condition, pageIndex={}, pageSize={}",
                pageIndex, pageSize);
            return new Page<>();
        }

        Page<T> page = PageHelper.startPage(pageIndex, pageSize, needCount).doSelectPage(iSelect);
        if (null == page) {
            return new Page<>();
        }
        return page;
    }

    /**
     * 根据偏移量和限制数量, 获取分页结果
     *
     * @param <T>
     * @param offset
     * @param limit
     * @param iSelect
     * @param needCount
     * @return
     */
    private <T> Page<T> getOffsetPage(Integer offset, Integer limit, ISelect iSelect, boolean needCount) {
        if (null == offset || null == limit || offset < 0 || limit <= 0) {
            log.error("PageUtils.getOffsetPage failed, invalid offset condition, offset={}, limit={}",
                offset, limit);
            return new Page<>();
        }

        Page<T> page = PageHelper.offsetPage(offset, limit, needCount).doSelectPage(iSelect);
        if (null == page) {
            return new Page<>();
        }
        return page;
    }
}

```

#### RecordRepository

```java
package xyz.icehe.repository;

import java.time.LocalDateTime;

import com.github.pagehelper.Page;
import lombok.NonNull;
import lombok.extern.slf4j.Slf4j;
import xyz.icehe.utils.JsonUtil;
import xyz.icehe.utils.PageHelperUtils;
import xyz.icehe.orm.condition.RecordCondition;
import xyz.icehe.orm.mapper.RecordMapper;
import xyz.icehe.orm.po.RecordExample;
import xyz.icehe.orm.po.RecordExample.Criteria;
import xyz.icehe.orm.po.RecordPO;
import org.apache.commons.collections.CollectionUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

/**
 * 记录的仓库
 *
 * @author icehe.xyz
 * @since 2020/11/03
 */
@Slf4j
@Repository
public class RecordRepository {

    @Autowired
    private RecordMapper recordMapper;

    /**
     * 添加记录
     *
     * @param recordPO
     */
    public void insert(RecordPO recordPO) {
        if (null == recordPO) {
            return;
        }
        try {
            recordMapper.insertSelective(recordPO);
        } catch (Exception e) {
            log.error("RecordRepository.insert.recordMapper.insertSelective failed, recordPO={}",
                JsonUtil.toJsonString(recordPO));
        }
    }

    /**
     * 根据查询条件, 获取记录的分页结果
     *
     * @param condition
     * @return
     */
    public Page<RecordPO> getRecordPage(RecordCondition condition) throws Exception {
        if (null == condition) {
            return new Page<>();
        }

        RecordExample example = buildExampleByCondition(condition);
        example.setOrderByClause("id DESC");
        try {
            // 如果 DB 表中的有 text 类型的字段, 需要使用 *WithBLOBs 的获取方法
            Page<RecordPO> recordLogs = PageHelperUtils.getPage(
                condition.getPageIndex(), condition.getPageSize(),
                () -> recordMapper.selectByExampleWithBLOBs(example));
            if (CollectionUtils.isEmpty(recordLogs)) {
                return new Page<>();
            }
            return recordLogs;
        } catch (Exception e) {
            log.error(
                "RecordRepository.getRecords.recordMapper.selectByExample failed, condition={}, example={}",
                JsonUtil.toJsonString(condition), JsonUtil.toJsonString(example), e);
            throw new Exception("RecordRepository.getRecords failed", e);
        }
    }

    /**
     * 根据查询条件, 获取接口请求日志记录的数量
     *
     * @param condition
     * @return
     */
    public Integer countRecord(RecordCondition condition) throws Exception {
        if (null == condition) {
            return 0;
        }

        RecordExample example = buildExampleByCondition(condition);
        try {
            long count = recordMapper.countByExample(example);
            return (int)count;
        } catch (Exception e) {
            log.error(
                "RecordRepository.countRecord.recordMapper.countByExample failed, condition={}, example={}",
                JsonUtil.toJsonString(condition), JsonUtil.toJsonString(example), e);
            throw new Exception("RecordRepository.countRecord failed", e);
        }
    }

    private RecordExample buildExampleByCondition(@NonNull RecordCondition query) {
        RecordExample example = new RecordExample();
        Criteria criteria = example.createCriteria();

        Long id = query.getId();
        if (null != id && id >= 0) {
            criteria.andDevIdEqualTo(id);
        }

        LocalDateTime createdAtFromInclusive = query.getCreatedAtFromInclusive();
        if (null != createdAtFromInclusive) {
            criteria.andCreatedAtGreaterThanOrEqualTo(createdAtFromInclusive);
        }

        LocalDateTime createdAtToExclusive = query.getCreatedAtToExclusive();
        if (null != createdAtToExclusive) {
            criteria.andCreatedAtLessThan(createdAtToExclusive);
        }

        return example;
    }
}

```

## Elasticsearch

Maven

```xml
<dependency>
    <groupId>org.elasticsearch</groupId>
    <artifactId>elasticsearch</artifactId>
    <version>5.4.3</version>
</dependency>
```

### Accessor

```java
package xyz.icehe.storage;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Map;
import java.util.function.Supplier;

import lombok.Getter;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.collections.CollectionUtils;
import org.elasticsearch.action.admin.indices.exists.indices.IndicesExistsRequest;
import org.elasticsearch.action.admin.indices.exists.indices.IndicesExistsResponse;
import org.elasticsearch.action.delete.DeleteResponse;
import org.elasticsearch.action.get.GetRequestBuilder;
import org.elasticsearch.action.get.GetResponse;
import org.elasticsearch.action.index.IndexResponse;
import org.elasticsearch.action.search.SearchRequestBuilder;
import org.elasticsearch.action.search.SearchResponse;
import org.elasticsearch.action.search.SearchType;
import org.elasticsearch.action.update.UpdateResponse;
import org.elasticsearch.client.transport.TransportClient;
import org.elasticsearch.common.unit.TimeValue;
import org.elasticsearch.index.query.QueryBuilder;
import org.elasticsearch.rest.RestStatus;
import org.elasticsearch.search.SearchHits;
import org.elasticsearch.search.sort.SortBuilder;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import xyz.icehe.utils.JsonUtils;

/**
 * Elasticsearch 服务
 *
 * @author st
 * @since 2020/05/01
 */
@Slf4j
@Getter
@Service
public class ElasticsearchAccessor {

    /**
     * 请求 ES 服务的超时时间 (单位: 毫秒)
     */
    private static final int ES_TIMEOUT_MILLIS = 500;

    /**
     * 1 分钟的毫秒数
     */
    private static final int MILLIS_IN_1_MIN = 60 * 1000;

    /**
     * ES Scroll 查询的 KeepAlive 时间
     */
    private static final TimeValue ES_SCROLL_KEEP_ALIVE = new TimeValue(MILLIS_IN_1_MIN);

    /**
     * ES Scroll 查询的最大出错重试次数
     */
    private static final int ES_SCROLL_MAX_TRIES = 5;

    @Autowired
    private TransportClient esClient;

    /**
     * 判断索引是否存在
     *
     * @param index
     * @return
     */
    public boolean existIndex(String index) {
        IndicesExistsResponse inExistsResponse =
            this.getEsClient()
                .admin()
                .indices()
                .exists(new IndicesExistsRequest(index))
                .actionGet(ES_TIMEOUT_MILLIS);
        return inExistsResponse.isExists();
    }

    /**
     * 指定 ID 添加文档数据, 如果已存在则完全替换原数据
     *
     * <p>To fully replace an existing document, use the index API.
     *
     * @param index 索引 (类似数据库)
     * @param type  类型 (类似表)
     * @param id    数据 ID
     * @param map   数据
     * @return
     */
    public void addOrReplaceData(String index, String type, String id, Map<String, ?> map) {
        IndexResponse indexResponse = this.getEsClient()
            .prepareIndex(index, type, id)
            .setSource(map)
            .get(TimeValue.timeValueMillis(ES_TIMEOUT_MILLIS));
        log.info("ElasticsearchAccessor.addOrReplaceData, indexResponse.status={}, indexResponse.id={}",
            indexResponse.status().getStatus(), indexResponse.getId());
    }

    /**
     * 根据 ID 更新文档数据, 合并文档的原有数据
     *
     * <p>Support passing a partial document, which will be merged into the existing document
     * (simple recursive merge, inner merging of objects, replacing core "keys/values" and arrays).
     *
     * @param index 索引 (类似数据库)
     * @param type  类型 (类似表)
     * @param id    数据 ID
     * @param map   数据
     * @return
     */
    public void updateDataById(String index, String type, String id, Map<String, ?> map) {
        UpdateResponse updateResponse = this.getEsClient()
            .prepareUpdate(index, type, id)
            .setDoc(map)
            .setRetryOnConflict(2)
            .execute()
            .actionGet(ES_TIMEOUT_MILLIS);
        log.info("ElasticsearchAccessor.updateDataById, updateResponse.status={}, updateResponse.id={}",
            updateResponse.status().getStatus(), updateResponse.getId());
    }

    /**
     * 根据 ID 删除数据
     *
     * @param index 索引 (类似数据库)
     * @param type  类型 (类似表)
     * @param id    数据 ID
     */
    public void deleteDataById(String index, String type, String id) {
        DeleteResponse deleteResponse = this.getEsClient()
            .prepareDelete(index, type, id)
            .execute()
            .actionGet(ES_TIMEOUT_MILLIS);
        log.info("ElasticsearchAccessor.deleteDataById, deleteResponse.status={}, deleteResponse.id={}",
            deleteResponse.status().getStatus(), deleteResponse.getId());
    }

    /**
     * 通过 ID 获取数据
     *
     * @param index 索引 (类似数据库)
     * @param type  类型 (类似表)
     * @param id    数据 ID
     * @return
     */
    public GetResponse searchDataById(String index, String type, String id) throws Exception {
        return searchDataById(index, type, id, null);
    }

    /**
     * 通过 ID 获取数据
     *
     * @param index  索引 (类似数据库)
     * @param type   类型 (类似表)
     * @param id     数据 ID
     * @param fields 需要显示的字段 (缺省时, 指全部字段)
     * @return
     */
    public GetResponse searchDataById(String index, String type, String id, List<String> fields) throws Exception {
        GetRequestBuilder getRequestBuilder = this.getEsClient().prepareGet(index, type, id);
        if (CollectionUtils.isNotEmpty(fields)) {
            getRequestBuilder.setFetchSource(fields.toArray(new String[0]), null);
        }
        try {
            return getRequestBuilder.execute().actionGet(ES_TIMEOUT_MILLIS);
        } catch (Exception e) {
            log.error("ElasticsearchAccessor.searchDataById failed", e);
            throw e;
        }
    }

    /**
     * 分页查询数据
     *
     * @param index                索引 (类似数据库)
     * @param type                 类型 (类似表)
     * @param offset               查询偏移
     * @param limit                查询数量
     * @param sortBuilderSupplier  排序方式
     * @param queryBuilderSupplier 查询条件
     * @return
     */
    public SearchHits searchPageData(
        String index,
        String type,
        int offset,
        int limit,
        List<? extends Supplier<? extends SortBuilder<?>>> sortBuilderSupplier,
        Supplier<QueryBuilder> queryBuilderSupplier) {

        // 依据查询索引库名称创建查询索引
        SearchRequestBuilder searchRequestBuilder = this.getEsClient().prepareSearch(index);
        // 设置查询文档, 文档类型
        searchRequestBuilder.setTypes(type);
        // 设置查询类型
        searchRequestBuilder.setSearchType(SearchType.QUERY_THEN_FETCH);
        // 设置分页信息
        searchRequestBuilder.setFrom(offset).setSize(limit);
        if (null != queryBuilderSupplier) {
            searchRequestBuilder.setQuery(queryBuilderSupplier.get());
        }
        if (CollectionUtils.isNotEmpty(sortBuilderSupplier)) {
            sortBuilderSupplier.forEach(supplier -> searchRequestBuilder.addSort(supplier.get()));
        }
        // 要求获取源内容
        searchRequestBuilder.setFetchSource(true);
        log.info("ElasticsearchAccessor.searchPageData before request, searchRequestBuilder={}",
            JsonUtils.toJsonString(searchRequestBuilder.toString()));
        SearchResponse searchResponse;
        try {
            searchResponse = searchRequestBuilder.execute().actionGet(ES_TIMEOUT_MILLIS);
            if (RestStatus.OK.getStatus() == searchResponse.status().getStatus()) {
                SearchHits searchHits = searchResponse.getHits();
                log.info("ElasticsearchAccessor.searchPageData found {} documents and processed {} documents",
                    searchHits.getTotalHits(), searchHits.getHits().length);
                return searchHits;
            } else {
                log.error("ElasticsearchAccessor.searchPageData wrong response, searchResponse={}",
                    searchResponse);
                return null;
            }
        } catch (Exception e) {
            log.error("ElasticsearchAccessor.searchPageData failed", e);
            throw e;
        }
    }

    /**
     * 滚动查询所有数据
     *
     * @param index                索引 (类似数据库)
     * @param type                 类型 (类似表)
     * @param pageSize             分页大小
     * @param totalSize            数据总条数
     * @param sortBuilderSupplier  排序方式
     * @param queryBuilderSupplier 查询条件
     * @return
     */
    public List<SearchHits> searchAllData(
        String index,
        String type,
        int pageSize,
        int totalSize,
        List<? extends Supplier<? extends SortBuilder<?>>> sortBuilderSupplier,
        Supplier<QueryBuilder> queryBuilderSupplier)
        throws Exception {

        // 依据查询索引库名称创建查询索引
        SearchRequestBuilder searchRequestBuilder = this.getEsClient().prepareSearch(index);
        // 设置滚动查询的超时时间
        searchRequestBuilder.setScroll(ES_SCROLL_KEEP_ALIVE);
        // 设置查询文档, 文档类型
        searchRequestBuilder.setTypes(type);
        // 设置查询类型
        searchRequestBuilder.setSearchType(SearchType.QUERY_THEN_FETCH);
        // 设置分页信息
        searchRequestBuilder.setSize(pageSize);
        if (null != queryBuilderSupplier) {
            searchRequestBuilder.setQuery(queryBuilderSupplier.get());
        }
        if (CollectionUtils.isNotEmpty(sortBuilderSupplier)) {
            sortBuilderSupplier.forEach(supplier -> searchRequestBuilder.addSort(supplier.get()));
        }
        // 要求获取源内容
        searchRequestBuilder.setFetchSource(true);
        log.info("ElasticsearchAccessor.searchAllData before request, searchRequestBuilder={}",
            JsonUtils.toJsonString(searchRequestBuilder.toString()));

        List<SearchHits> searchHitsList = new ArrayList<>(totalSize);

        // Prefetch
        SearchResponse searchResponse;
        try {
            searchResponse = searchRequestBuilder.get();
            if (RestStatus.OK.getStatus() == searchResponse.status().getStatus()) {
                SearchHits searchHits = searchResponse.getHits();
                log.info("ElasticsearchAccessor.searchAllData found {} documents, processed {} documents",
                    searchHits.getTotalHits(), searchHits.getHits().length);
                searchHitsList.add(searchHits);
            } else {
                log.error("ElasticsearchAccessor.searchAllData wrong response, searchResponse={}",
                    JsonUtils.toJsonString(searchResponse));
                return Collections.emptyList();
            }
        } catch (Exception e) {
            log.error("ElasticsearchAccessor.searchAllData failed, searchRequestBuilder={}",
                JsonUtils.toJsonString(searchRequestBuilder), e);
            throw e;
        }

        int maxTries = ES_SCROLL_MAX_TRIES;
        // Scroll until no hits are returned
        do {
            try {
                searchResponse = this.getEsClient()
                    .prepareSearchScroll(searchResponse.getScrollId())
                    .setScroll(ES_SCROLL_KEEP_ALIVE)
                    .get();
                if (RestStatus.OK.getStatus() == searchResponse.status().getStatus()) {
                    SearchHits searchHits = searchResponse.getHits();
                    log.info("ElasticsearchAccessor.searchAllData found {} documents, processed {} documents",
                        searchHits.getTotalHits(), searchHits.getHits().length);
                    searchHitsList.add(searchHits);
                } else {
                    log.error("ElasticsearchAccessor.searchAllData wrong response, searchResponse={}",
                        JsonUtils.toJsonString(searchResponse));
                }
            } catch (Exception e) {
                if (maxTries > 0) {
                    maxTries--;
                    log.error("ElasticsearchAccessor.searchAllData ignored es exception (allow to ignore next {} ones)",
                        maxTries, e);
                } else {
                    log.error("ElasticsearchAccessor.searchAllData failed, searchResponse={}",
                        JsonUtils.toJsonString(searchResponse), e);
                    throw e;
                }
            }
        } while (0 != searchResponse.getHits().getHits().length);
        // Zero hits mark the end of the scroll and the while loop.

        return searchHitsList;
    }
}

```

## HTTP

### URI Checker

```java
package xyz.icehe.utils;

import java.net.URI;
import java.net.URISyntaxException;

import org.apache.commons.lang3.StringUtils;
import lombok.experimental.UtilityClass;

/**
 * HTTP 工具集
 *
 * @author icehe.xyz
 * @since 2020/10/19
 */
@UtilityClass
public class HttpUtils {

    /**
     * 获取有效的 URI
     *
     * @param originalUri
     * @return
     */
    public URI getCheckedURI(String originalUri) {
        if (StringUtil.isBlank(originalUri)) {
            return null;
        }
        try {
            return new URI(originalUri);
        } catch (URISyntaxException e) {
            return null;
        }
    }

    /**
     * 是否为有效的 URI
     *
     * @param originalUri
     * @return
     * @throws ServiceException
     */
    public boolean iaValidUri(String originalUri) throws ServiceException {
        return Objects.nonNull(getCheckedURI(originalUri));
    }
}

```

### IP Getter

```java
package xyz.icehe.utils;

import java.net.Inet4Address;
import java.net.InetAddress;
import java.net.NetworkInterface;
import java.net.SocketException;
import java.net.UnknownHostException;
import java.util.Collections;
import java.util.List;
import java.util.stream.Collectors;

import lombok.experimental.UtilityClass;

/**
 * IP 工具集
 *
 * @author icehe.xyz
 * @since 2020/10/19
 */
@UtilityClass
public class IpUtils {

    public List<String> getLocalIPs() {
        try {
            return Collections.list(NetworkInterface.getNetworkInterfaces())
                .stream()
                .map(tNetworkInterface -> Collections.list(tNetworkInterface.getInetAddresses()))
                .flatMap(List::stream)
                .filter(tInetAddress -> tInetAddress instanceof Inet4Address)
                .map(InetAddress::getHostAddress)
                .collect(Collectors.toList());
        } catch (SocketException e) {
            return Collections.emptyList();
        }
    }

    public String getLocalIP() {
        try {
            return InetAddress.getLocalHost().getHostAddress();
        } catch (UnknownHostException e) {
            return null;
        }
    }
}

```

## Executor

References

- https://blog.csdn.net/chzphoenix/article/details/78968075
- Java并发编程：线程池的使用 - Matrix海子 - 博客园 : https://www.cnblogs.com/dolphin0520/p/3932921.html
- https://blog.csdn.net/wqh8522/article/details/79224290

### default ThreadPoolTaskExcecutor

```java
package xyz.icehe.service;

import java.util.concurrent.ThreadPoolExecutor;

import lombok.extern.slf4j.Slf4j;
import org.springframework.context.annotation.*;
import org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor;

/**
 * 标记类
 *
 * <p>在本类所处包之内的（包括子包）所有的 @Service 均会自动初始化为 Bean
 *
 * <p>另外，此类在META-INF/spring.factories中定义
 *
 * @author icehe.xyz
 * @since 2020/11/06
 */
@Slf4j
@Configuration
@ComponentScan
public class IceHeServiceAutoConfiguration {

    /**
     * 默认的线程池任务执行器
     *
     * @return {@link ThreadPoolTaskExecutor}
     * @see <a href="https://blog.csdn.net/chzphoenix/article/details/78968075">
     * java中四种线程池及poolSize、corePoolSize、maximumPoolSize
     * </a>
     */
    @Bean
    public ThreadPoolTaskExecutor defaultThreadPool() {

        ThreadPoolTaskExecutor executor = new ThreadPoolTaskExecutor();

        executor.setCorePoolSize(1);
        executor.setMaxPoolSize(2);
        executor.setQueueCapacity(1);

        // 线程名称前缀
        executor.setThreadNamePrefix("defaultThreadPool_");

        // 线程空闲后的最大存活时间 (系统默认 60 sec, 通常不必设置)
        executor.setKeepAliveSeconds(60);

        // Policy : 当 pool 已经达到 max size 的时候, task 被拒绝, 这时如何处理新任务?
        // CallerRunsPolicy : 不在新线程中执行任务，而是由调用者所在的线程来执行
        executor.setRejectedExecutionHandler(new ThreadPoolExecutor.CallerRunsPolicy());

        // 初始化
        executor.initialize();

        return executor;
    }
}

```

### Async Execute

```java
defaultExecutor.execute(() -> {
    // do something
    System.out.println("async executed");
});

```

### Future Submit

References : JFGI

```java
import org.apache.commons.lang3.concurrent.ConcurrentUtils;
ConcurrentUtils.constantFuture(Collections.emptyMap());

Future<String> stringFuture = executor.submit(() -> {
    String stringResult = "foobar";
    return stringResult;
});
String stringResult;
try {
    //stringResult = stringFuture.get();
    long timeout = 2000L;
    stringResult = stringFuture.get(timeout, TimeUnit.MILLISECONDS);
} catch (TimeoutException e) {
    stringResult = "TimeoutException";
} catch (InterruptedException e) {
    stringResult = "InterruptedException";
} catch (ExecutionException e) {
    stringResult = "ExecutionException";
}

```
