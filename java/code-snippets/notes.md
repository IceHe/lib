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

## Common DTO

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

## Aspect

### JoinPointUtils

```java
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

## Jackson

### Utils

```java
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.core.JsonParser.Feature;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.*;
import com.fasterxml.jackson.datatype.jsr310.JavaTimeModule;
import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;

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
        if (StringUtils.isBlank(content)) {
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

### TODO

- ServiceInterceptor and its Helpers

## Utils

### HTTP

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
     * 是否为有效的 URI
     *
     * @param originalUrl
     * @return
     */
    public boolean isValidUri(String originalUrl) {
        if (StringUtils.isBlank(originalUrl)) {
            return false;
        }
        try {
            URI uri = new URI(originalUrl);
            return true;
        } catch (URISyntaxException e) {
            return false;
        }
    }
}

```
