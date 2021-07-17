# LocalDateTime

将字符串转换为日期对象

- Java 8 - How to convert String to LocalDate : https://www.mkyong.com/java8/java-8-how-to-convert-string-to-localdate/
    - Java 应该用 LocalDate / LocalTime / LocalDateTime 保存时间
    - 禁止使用 java.util.Date & java.text.SimpleDateFormat !

## Serializer

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

## Deserializer

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

## LocalDateTimeUtils

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

    /** Calculates minutes until another date-time */
    public Long minutesBetween(LocalDateTime localDateTimeA, LocalDateTime localDateTimeB) {
        if (null == localDateTimeA || null == localDateTimeB) {
            return null;
        }
        return localDateTimeA.until(localDateTimeB, ChronoUnit.MINUTES);
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

## LocalDates

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
