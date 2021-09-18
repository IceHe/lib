# Spring ConstraintValidator

约束校验器

- JavaBean Validation - Object Association validation with @Valid
  : https://www.logicbig.com/tutorials/java-ee-tutorial/bean-validation/cascaded-validation.html

## AbstractValidator

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

## Double Percent

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

### @ValidePercent

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

### DoublePercentValidator

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

## Enum Range

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

### @WithinEnum

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

### WithinEnumValidator

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

## Interceptor

- ServiceInterceptor and its Helpers

### Helpers

#### JoinPointHelper

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

#### ParameterValidator

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

####

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

### Aspect

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
