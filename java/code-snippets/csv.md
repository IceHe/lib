# CSV

Comma Separate Value

---

## Parse CSV File

```java
package xyz.icehe.service;

import lombok.extern.slf4j.Slf4j;
import org.apache.commons.collections4.CollectionUtils;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVParser;
import org.apache.commons.csv.CSVRecord;
import org.apache.commons.io.input.BOMInputStream;
import org.apache.commons.lang3.StringUtils;
import org.jetbrains.annotations.NotNull;
import org.springframework.stereotype.Service;

import java.io.BufferedReader;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.List;

/**
 * @author icehe.xyz
 */
@Service
@Slf4j
public class CsvService {

    public List<CSVRecord> getCsvRecordsFromCsvFileContent(@NotNull byte[] data) {
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
