# CSV

Comma Separate Value

---

## Parse CSV File

```java
package xyz.icehe.utils;

import lombok.experimental.UtilityClass;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.collections4.CollectionUtils;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVParser;
import org.apache.commons.csv.CSVRecord;
import org.apache.commons.io.input.BOMInputStream;
import org.apache.commons.lang3.StringUtils;
import org.jetbrains.annotations.NotNull;

import java.io.BufferedReader;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.List;

/**
 * @author icehe.life
 */
@Slf4j
@UtilityClass
public class CsvReader {

    public List<CSVRecord> parseCsvRecordsFromCsvFileContent(@NotNull byte[] data) {
        List<CSVRecord> csvRecords = parseCsvFileByCharset(data, StandardCharsets.UTF_8);
        if (CollectionUtils.isEmpty(csvRecords)) {
            csvRecords = parseCsvFileByCharset(data, Charset.forName("GBK"));
        }
        if (CollectionUtils.isEmpty(csvRecords)) {
            throw new RuntimeException("wrong format");
        }

        csvRecords.forEach(csvRecord -> {
            String idStr = csvRecord.get(0);
            try {
                if (StringUtils.isNotBlank(idStr)) {
                    Integer.valueOf(idStr.trim());
                }
            } catch (NumberFormatException e) {
                throw new RuntimeException("idStr " + idStr + " must be integer", e);
            }
        });

        return csvRecords;
    }

    private List<CSVRecord> parseCsvFileByCharset(
            @NotNull byte[] data,
            @NotNull Charset charset
    ) {
        try {
            BufferedReader reader = new BufferedReader(new InputStreamReader(new BOMInputStream(new ByteArrayInputStream(data)), charset));
            CSVParser csvParser = CSVFormat.DEFAULT.withHeader().withIgnoreEmptyLines(true).parse(reader);
            return csvParser.getRecords();
        } catch (IOException e) {
            log.error("failed to parse csv file, data.length={}, charset={}", data.length, charset, e);
            throw new RuntimeException("failed to parse csv file", e);
        }
    }
}

```

## Write CSV File

```java
package xyz.icehe.utils;

import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVPrinter;
import org.apache.commons.lang3.StringUtils;
import org.jetbrains.annotations.NotNull;

import java.io.IOException;
import java.lang.annotation.ElementType;
import java.lang.annotation.Retention;
import java.lang.annotation.RetentionPolicy;
import java.lang.annotation.Target;
import java.lang.reflect.Field;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.stream.Collectors;

/**
 * @author icehe.life
 */
public class CsvWriter {

    public static <T> void write(
            @NotNull Appendable appendable,
            @NotNull List<T> csvRows,
            @NotNull Class<T> csvRowClazz
    ) throws IOException {
        appendable.append('\uFEFF');

        Field[] columnFields = csvRowClazz.getDeclaredFields();
        List<Field> validFields = new ArrayList<>();

        String[] csvHeaders = Arrays.stream(columnFields)
                .map(columnField -> {
                    CsvColumn annotation = columnField.getDeclaredAnnotation(CsvColumn.class);
                    if (annotation == null) {
                        return null;
                    }
                    columnField.setAccessible(true);
                    validFields.add(columnField);

                    return annotation.value();
                })
                .filter(StringUtils::isNotBlank)
                .toArray(String[]::new);

        CSVPrinter printer = new CSVPrinter(appendable, CSVFormat.EXCEL.withHeader(csvHeaders));

        for (T csvRow : csvRows) {
            List<Object> columns = validFields.stream().map(f -> {
                try {
                    return f.get(csvRow);
                } catch (IllegalAccessException e) {
                    throw new RuntimeException(e);
                }
            }).collect(Collectors.toList());

            printer.printRecord(columns);
        }
        printer.close();
    }

    @Target(ElementType.FIELD)
    @Retention(RetentionPolicy.RUNTIME)
    public @interface CsvColumn {
        String value() default "";
    }
}
```
