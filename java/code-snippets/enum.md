# Enum

## Transferable State Enum

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

## EnumParsers

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

## \*EnumsParser

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

## \*EnumsParses

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
