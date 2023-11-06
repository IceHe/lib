# CSV

Comma Separate Value

---

## Parse CSV File

```java

import lombok.SneakyThrows;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVParser;
import org.apache.commons.csv.CSVRecord;
import org.apache.commons.io.input.BOMInputStream;
import org.springframework.util.CollectionUtils;
import org.springframework.util.StringUtils;

import java.io.BufferedReader;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.List;

@Slf4j
public class CsvReader {
    public static List<CSVRecord> parseCsvRecordsFromCsvFileContent(byte[] data) {
        List<CSVRecord> csvRecords = parseCsvFileByCharset(data, StandardCharsets.UTF_8);
        if (CollectionUtils.isEmpty(csvRecords)) {
            csvRecords = parseCsvFileByCharset(data, Charset.forName("GBK"));
        }
        if (CollectionUtils.isEmpty(csvRecords)) {
            throw new RuntimeException("wrong format");
        }

        for (CSVRecord csvRecord : csvRecords) {
            String idStr = csvRecord.get(0);
            try {
                if (!StringUtils.hasText(idStr)) {
                    Integer.valueOf(idStr.trim());
                }
            } catch (NumberFormatException e) {
                throw new RuntimeException("idStr " + idStr + " must be integer", e);
            }
        }

        return csvRecords;
    }

    @SneakyThrows(IOException.class)
    protected static List<CSVRecord> parseCsvFileByCharset(byte[] data, Charset charset) {
        BufferedReader reader = new BufferedReader(new InputStreamReader(new BOMInputStream(new ByteArrayInputStream(data)), charset));
        CSVParser csvParser = CSVFormat.DEFAULT.builder().setIgnoreEmptyLines(true).build().parse(reader);
        return csvParser.getRecords();
    }
}

```

## Write CSV File

```java

import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVPrinter;
import org.springframework.util.StringUtils;

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

public class CsvWriter {
    public static <T> void write(
            Appendable appendable,
            List<T> csvRows,
            Class<T> csvRowClazz
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
                .filter(StringUtils::hasText)
                .toArray(String[]::new);


        CSVPrinter printer = new CSVPrinter(appendable, CSVFormat.EXCEL.builder().setHeader(csvHeaders).build());

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
