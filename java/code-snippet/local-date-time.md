# LocalDateTime

将字符串转换为日期对象

-   Java 8 - How to convert String to LocalDate : https://www.mkyong.com/java8/java-8-how-to-convert-string-to-localdate/
    -   Java 应该用 LocalDate / LocalTime / LocalDateTime 保存时间
    -   禁止使用 java.util.Date & java.text.SimpleDateFormat !

## LocalDateTimeUtils

```java

import lombok.experimental.UtilityClass;
import org.springframework.util.StringUtils;

import java.time.Instant;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.ZoneId;
import java.time.temporal.ChronoUnit;
import java.util.Date;

@UtilityClass
public class LocalDateTimeUtil {

    public LocalDateTime fromString(String str) {
        if (!StringUtils.hasText(str)) return null;
        try {
            if (str.length() == TimeFormat.YYYY_MM_DD_HH_MM_SS_SSS.length()) {
                return LocalDateTime.parse(str, TimeFormat.FMT_YYYY_MM_DD_HH_MM_SS_SSS);
            } else if (str.length() == TimeFormat.YYYY_MM_DD_HH_MM_SS.length()) {
                return LocalDateTime.parse(str, TimeFormat.FMT_YYYY_MM_DD_HH_MM_SS);
            } else if (str.length() == TimeFormat.YYYY_M_D_HH_MM.length()) {
                return LocalDateTime.parse(str, TimeFormat.FMT_YYYY_M_D_HH_MM);
            } else {
                return null;
            }
        } catch (Exception ignored) {
            return null;
        }
    }

    public LocalDateTime fromDate(Date date) {
        if (null == date) return null;
        return fromMillis(date.getTime());
    }

    public LocalDateTime fromMillis(Long millis) {
        if (null == millis) return null;
        return LocalDateTime.ofInstant(Instant.ofEpochMilli(millis), ZoneId.systemDefault());
    }

    public LocalDateTime fromSeconds(Long seconds) {
        if (null == seconds) return null;
        return LocalDateTime.ofInstant(Instant.ofEpochSecond(seconds), ZoneId.systemDefault());
    }

    public String toString(LocalDateTime dt) {
        if (dt == null) return null;
        return TimeFormat.FMT_YYYY_MM_DD_HH_MM_SS.format(dt);
    }

    public Date toDate(LocalDateTime dt) {
        return Date.from(dt.atZone(ZoneId.systemDefault()).toInstant());
    }

    public Long toMillis(LocalDateTime dt) {
        if (null == dt) return null;
        return dt.atZone(ZoneId.systemDefault()).toInstant().toEpochMilli();
    }

    public Long toSeconds(LocalDateTime dt) {
        if (null == dt) return null;
        return dt.atZone(ZoneId.systemDefault()).toEpochSecond();
    }

    public Long millisBetween(LocalDateTime a, LocalDateTime b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.MILLIS);
    }

    public Long secondsBetween(LocalDateTime a, LocalDateTime b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.SECONDS);
    }

    public Long minutesBetween(LocalDateTime a, LocalDateTime b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.MINUTES);
    }

    public Long hoursBetween(LocalDateTime a, LocalDateTime b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.HOURS);
    }

    public Long daysBetween(LocalDateTime a, LocalDateTime b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.DAYS);
    }

    public Long weeksBetween(LocalDateTime a, LocalDateTime b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.WEEKS);
    }

    public Long monthsBetween(LocalDateTime a, LocalDateTime b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.MONTHS);
    }

    public Long yearsBetween(LocalDateTime a, LocalDateTime b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.YEARS);
    }

    public Long daysBetween(LocalDate a, LocalDate b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.DAYS);
    }

    public Long weeksBetween(LocalDate a, LocalDate b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.WEEKS);
    }

    public Long monthsBetween(LocalDate a, LocalDate b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.MONTHS);
    }

    public Long yearsBetween(LocalDate a, LocalDate b) {
        if (null == a || null == b) return null;
        return a.until(b, ChronoUnit.YEARS);
    }
}

```

## LocalDates

```java

import com.google.common.collect.Lists;
import lombok.experimental.UtilityClass;
import org.springframework.util.StringUtils;

import java.time.DayOfWeek;
import java.time.LocalDate;
import java.time.Period;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;
import java.util.stream.IntStream;

@UtilityClass
public class LocalDateUtil {

    private final Pattern DATE_REGEX_PATTERN = Pattern.compile("([0-9]{4})\\s*?[/\\-.年]\\s*?([0-9]{1,2})\\s*?[/\\-.月]\\s*?([0-9]{1,2})[日]?");

    /** From LocalDate to String "yyyy-MM-dd" */
    public String toString(LocalDate dt) {
        if (null == dt) return null;
        return TimeFormat.FMT_YYYY_MM_DD.format(dt);
    }

    /** Split String into "LocalDate"s */
    public List<LocalDate> splitDates(String datesStr) {
        if (!StringUtils.hasText(datesStr)) return List.of();
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

    public LocalDate thisMonday() {
        return LocalDate.now().with(DayOfWeek.MONDAY);
    }

    public LocalDate nextMonday() {
        return thisMonday().plusWeeks(1L);
    }

    public List<LocalDate> dateRange(LocalDate from, LocalDate to) {
        if (null == from || null == to || from.isAfter(to)) {
            return List.of();
        }
        int dayCount = Period.between(from, to).getDays() + 1;
        return IntStream.range(0, dayCount).boxed().map(from::plusDays).collect(Collectors.toList());
    }
}

```

## TimeFormat

```java

import java.time.format.DateTimeFormatter;

public class TimeFormat {

    /** e.g. "2019-08-13 17:54:30.926" */
    public static final String YYYY_MM_DD_HH_MM_SS_SSS = "yyyy-MM-dd HH:mm:ss.SSS";
    public static final DateTimeFormatter FMT_YYYY_MM_DD_HH_MM_SS_SSS = DateTimeFormatter.ofPattern(YYYY_MM_DD_HH_MM_SS_SSS);

    /** e.g. "2019-08-13 17:54:30" */
    public static final String YYYY_MM_DD_HH_MM_SS = "yyyy-MM-dd HH:mm:ss";
    public static final DateTimeFormatter FMT_YYYY_MM_DD_HH_MM_SS = DateTimeFormatter.ofPattern(YYYY_MM_DD_HH_MM_SS);

    /** e.g. "2019-08-13 17:54" */
    public static final String YYYY_MM_DD_HH_MM = "yyyy-MM-dd HH:mm";
    public static final DateTimeFormatter FMT_YYYY_MM_DD_HH_MM = DateTimeFormatter.ofPattern(YYYY_MM_DD_HH_MM);

    /** e.g. "2019/08/13" */
    public static final String YYYY_MM_DD_SLASH = "yyyy/MM/dd";
    public static final DateTimeFormatter FMT_YYYY_MM_DD_SLASH = DateTimeFormatter.ofPattern(YYYY_MM_DD_SLASH);

    /** e.g. "2019-8-6 17:54" */
    public static final String YYYY_M_D_HH_MM = "yyyy/M/d HH:mm";
    public static final DateTimeFormatter FMT_YYYY_M_D_HH_MM = DateTimeFormatter.ofPattern(YYYY_M_D_HH_MM);

    /** e.g. "2021-07-18 Sunday" */
    public static final String YYYY_MM_DD_EEEE = "yyyy-MM-dd EEEE";
    public static final DateTimeFormatter FMT_YYYY_MM_DD_EEEE = DateTimeFormatter.ofPattern(YYYY_MM_DD_EEEE);

    /** e.g. "2020-10-15" */
    public static final String YYYY_MM_DD = "yyyy-MM-dd";
    public static final DateTimeFormatter FMT_YYYY_MM_DD = DateTimeFormatter.ofPattern(YYYY_MM_DD);

    /** e.g. "20201015" */
    public static final String YYYYMMDD = "yyyyMMdd";
    public static final DateTimeFormatter FMT_YYYYMMDD = DateTimeFormatter.ofPattern(YYYYMMDD);
}

```

## TimeUtil

```java

import lombok.experimental.UtilityClass;
import org.springframework.util.StringUtils;

import java.time.DayOfWeek;
import java.time.Instant;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.Period;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;
import java.time.temporal.ChronoUnit;

@UtilityClass
public class TimeUtil {

    /** Default Time-Zone ID */
    public final ZoneId SHANGHAI_ZONE_ID = ZoneId.of("Asia/Shanghai");

    public final Long MINUTE_IN_MILLIS = 1000L * 60;

    public final Long HOUR_IN_MILLIS = MINUTE_IN_MILLIS * 60;

    public final Long DAY_IN_MILLIS = HOUR_IN_MILLIS * 24;

    public LocalDateTime now() {
        return LocalDateTime.now(SHANGHAI_ZONE_ID);
    }

    public LocalDateTime nowMillis() {
        return now().truncatedTo(ChronoUnit.MILLIS);
    }

    public LocalDateTime nowSeconds() {
        return now().truncatedTo(ChronoUnit.SECONDS);
    }

    public LocalDate today() {
        return now().toLocalDate();
    }

    public LocalDate yesterday() {
        return today().plusDays(-1);
    }

    public LocalDateTime fromMillis(Long millis) {
        if (null == millis) return null;
        return LocalDateTime.ofInstant(Instant.ofEpochMilli(millis), SHANGHAI_ZONE_ID);
    }

    public LocalDateTime fromString(String s) {
        if (!StringUtils.hasText(s)) {
            return null;
        }
        String trimmedStr = s.trim();
        try {
            if (TimeFormat.YYYY_MM_DD_HH_MM_SS_SSS.length() == trimmedStr.length()) {
                return LocalDateTime.parse(trimmedStr, TimeFormat.FMT_YYYY_MM_DD_HH_MM_SS_SSS);
            } else if (TimeFormat.YYYY_MM_DD_HH_MM_SS.length() == trimmedStr.length()) {
                return LocalDateTime.parse(trimmedStr, TimeFormat.FMT_YYYY_MM_DD_HH_MM_SS);
            } else if (TimeFormat.YYYY_MM_DD_HH_MM.length() == trimmedStr.length()) {
                return LocalDateTime.parse(trimmedStr, TimeFormat.FMT_YYYY_MM_DD_HH_MM);
            } else if (TimeFormat.YYYY_MM_DD.length() == trimmedStr.length()) {
                return LocalDateTime.parse(trimmedStr, TimeFormat.FMT_YYYY_MM_DD);
            } else {
                return null;
            }
        } catch (Exception e) {
            return null;
        }
    }

    public String fromMillisToString(long millis) {
        return TimeFormat.FMT_YYYY_MM_DD_HH_MM_SS_SSS.format(fromMillis(millis));
    }

    public String toString(LocalDateTime localDateTime) {
        return TimeFormat.FMT_YYYY_MM_DD_HH_MM_SS_SSS.format(localDateTime);
    }

    public long toMillis(LocalDateTime localDateTime) {
        return localDateTime.atZone(SHANGHAI_ZONE_ID).toInstant().toEpochMilli();
    }

    public long toMillis(LocalDate localDate) {
        return toMillis(localDate.atStartOfDay());
    }

    /**
     * e.g. truncate epoch millis 1626574627489 ( "2021-07-18 10:17:07.489" ) to epoch millis 1626573600000 (
     * "2021-07-18 10:00:00.000" ) using param {@link ChronoUnit#HOURS}
     */
    public long millisTruncatedTo(long millis, ChronoUnit chronoUnit) {
        return toMillis(fromMillis(millis).truncatedTo(chronoUnit));
    }

    public String format(LocalDateTime localDateTime, String format) {
        return localDateTime.format(DateTimeFormatter.ofPattern(format));
    }

    public String formatNow(DateTimeFormatter formatter) {
        return now().format(formatter);
    }

    public String formatMillis(long millis, String format) {
        return fromMillis(millis).format(DateTimeFormatter.ofPattern(format));
    }

    public String formatMillis(long millis, DateTimeFormatter formatter) {
        return fromMillis(millis).format(formatter);
    }

    /**
     * 获取当前时间与给定时间的天数差（自然天）
     *
     * <p>For example:
     * <ul>
     *     <li>1)  input: target: 6月7日10点
     *             now: 6月8日9点
     *             output: 1
     *     <li>2)  input: target: 6月7日10点
     *             now: 6月8日11点
     *             output: 1
     * </ul>
     */
    public long daysBetweenMillisAndToday(long millis) {
        LocalDate cmpDate = fromMillis(millis).toLocalDate();
        Period period = Period.between(cmpDate, today());
        return period.getDays();
    }

    private boolean isDayOfWeekEpoch(long millis, DayOfWeek dayOfWeek) {
        LocalDateTime localDateTime = fromMillis(millis);
        if (localDateTime.getDayOfWeek() != dayOfWeek) return false;
        return localDateTime.truncatedTo(ChronoUnit.DAYS).equals(localDateTime);
    }

    /** 判断一个时间戳是否处于 "周一 00:00:00.000" */
    public boolean isMondayFirstMillis(long millis) {
        return isDayOfWeekEpoch(millis, DayOfWeek.MONDAY);
    }

    public long epochMillisOfGivenHourToday(int hour) {
        return toMillis(today().atTime(hour, 0));
    }
}

```

## Serializer

References

-   Jackson Date | Baeldung : https://www.baeldung.com/jackson-serialize-dates#custom-serializer

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

## Deserializer

Reference

-   Custom JSON Deserialization with Jackson - Stack Overflow : https://stackoverflow.com/questions/19158345/custom-json-deserialization-with-jackson

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

Test

```java

import com.fasterxml.jackson.databind.annotation.JsonDeserialize;
import com.fasterxml.jackson.databind.annotation.JsonSerialize;
import lombok.Data;
import lombok.experimental.Accessors;
import org.junit.jupiter.api.Test;
import template.example.json.JsonUtil;

import java.time.LocalDateTime;
import java.time.temporal.ChronoUnit;

import static org.junit.jupiter.api.Assertions.assertEquals;

class LocalDateTime2MillisSerializerTest {

    @Data
    @Accessors(chain = true)
    static class TimeDTO {
        @JsonSerialize(using = LocalDateTime2MillisSerializer.class)
        @JsonDeserialize(using = MillisOrString2LocalDateTimeDeserializer.class)
        private LocalDateTime createdAt;
    }

    @Test
    void test() {
        LocalDateTime now = LocalDateTime.now().truncatedTo(ChronoUnit.MILLIS);
        System.out.println(now);

        TimeDTO timeDTO = new TimeDTO().setCreatedAt(now);
        System.out.println(timeDTO);

        String json = JsonUtil.writeValue(timeDTO);
        System.out.println(json);

        TimeDTO obj = JsonUtil.readValue(json, TimeDTO.class);
        assertEquals(timeDTO, obj);
    }
}

```
