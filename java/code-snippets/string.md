# String

## To String

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

## To Number

```java
Integer intVar = Integer.parseInt("11");
Float floatVar = Float.parseFloat("1.2");

```

## Format

```java
String.format("%s, %s!", "Hello", "world");

```

## Split

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

## Join

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

## Parse

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

## MD5

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

## Regex

### Pattern and Matcher

- http://tutorials.jenkov.com/java-regex/matcher.html

```java
import java.util.regex.Matcher;
import java.util.regex.Pattern;

// 正则匹配模式 : 中英文混合内容
Pattern mixedZhEnParttern = Pattern.compile("^[\\s\\da-zA-Z\\u4E00-\\u9FA5]+");
Matcher mixedZhEnMatcher = mixedZhEnParttern.matcher(fuzzyKeyword);
boolean likeMixedZhEn = mixedZhEnMatcher.find();

```

## StringUtils

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
