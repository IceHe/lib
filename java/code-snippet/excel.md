# Excel

-   [Busy Developers' Guide to HSSF and XSSF Features](https://poi.apache.org/components/spreadsheet/quick-guide.html) ( new )
-   ~~[How to Write to an Excel file in Java using Apache POI | CalliCoder](https://www.callicoder.com/java-write-excel-file-apache-poi/)~~ ( archived )

## Maven

```xml
<!-- Used to work with the older excel file format - `.xls` -->
<!-- https://mvnrepository.com/artifact/org.apache.poi/poi -->
<dependency>
    <groupId>org.apache.poi</groupId>
    <artifactId>poi</artifactId>
    <version>5.0.0</version>
</dependency>

<!-- Used to work with the newer excel file format - `.xlsx` -->
<!-- https://mvnrepository.com/artifact/org.apache.poi/poi-ooxml -->
<dependency>
    <groupId>org.apache.poi</groupId>
    <artifactId>poi-ooxml</artifactId>
    <version>5.0.0</version>
</dependency>

```

## Read from bytes

```java

import lombok.experimental.UtilityClass;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

import java.io.BufferedInputStream;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.util.List;
import java.util.stream.Collectors;
import java.util.stream.StreamSupport;

/**
 * Excel 文件读取
 */
@UtilityClass
public class ExcelReader {
    /**
     * 将 Excel 文件数据 (字节数组) 转换为二维表格
     * @return sheet => [ row => [cell] ]
     */
    public List<List<String>> convertExcelData2Table(byte[] excelData) {
        List<List<String>> table;
        try (
                ByteArrayInputStream byteInputStream = new ByteArrayInputStream(excelData);
                BufferedInputStream bufferedInputStream = new BufferedInputStream(byteInputStream);
                Workbook workbook = new XSSFWorkbook(bufferedInputStream)
        ) {
            Sheet sheet = extractFirstSheetFromWorkbook(workbook);
            table = convertExcelSheet2Table(sheet);
        } catch (IOException e) {
            String msg = String.format("cannot read or parse excel file, errorMsg=%s", e.getMessage());
            throw new RuntimeException(msg);
        }
        return table;
    }

    /**
     * 提取 Excel 工作簿 {@link Workbook} 的第一个表单 {@link Sheet}
     */
    private Sheet extractFirstSheetFromWorkbook(Workbook workbook) {
        Sheet sheet = workbook.getSheetAt(0);
        if (null == sheet) {
            throw new RuntimeException("Excel 文件中没有包含表单 (Sheet)");
        }
        return sheet;
    }

    /**
     * 将 Excel 表格 {@link Sheet} 转换为二维表格
     */
    private List<List<String>> convertExcelSheet2Table(Sheet sheet) {
        return StreamSupport.stream(sheet.spliterator(), false)
                .map(ExcelReader::convertSheetRowToTableRow)
                .collect(Collectors.toList());
    }

    /**
     * 将 Excel 表格的一行 {@link Row}, 转换为二维表格的一行
     */
    private List<String> convertSheetRowToTableRow(Row row) {
        return StreamSupport.stream(row.spliterator(), false)
                .map(ExcelReader::convertRowCellToString)
                .collect(Collectors.toList());
    }

    /**
     * 将 Excel 表格行的一个单元格 {@link Cell}, 转换为字符串
     */
    private String convertRowCellToString(Cell cell) {
        if (null == cell) {
            return "";
        }
        return switch (cell.getCellType()) {
            case NUMERIC -> String.valueOf(cell.getNumericCellValue());
            case STRING -> cell.getStringCellValue();
            default -> cell.getStringCellValue();
        };
    }
}

```

## Write to bytes

```java

import lombok.SneakyThrows;
import lombok.experimental.UtilityClass;
import lombok.extern.slf4j.Slf4j;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.springframework.util.CollectionUtils;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

/**
 * Excel 文件写入
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
     * @param table 二维表格
     * @return {@link ByteArrayOutputStream}
     * @see <a href="https://www.callicoder.com/java-write-excel-file-apache-poi">
     * How to Write to an Excel file in Java using Apache POI</a>
     */
    @SneakyThrows(IOException.class)
    public ByteArrayOutputStream writeExcelIntoOutputStream(List<? extends ArrayList<String>> table) {
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
        } catch (IOException e) {
            log.error("ExcelWriter.writeExcel()", e);
            throw e;
        }
    }

    /**
     * 写入表格内容
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
     * @param sheet {@link Sheet} Excel 表单
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
     * @param workbook {@link Workbook} Excel Workbook
     * @return {@link ByteArrayOutputStream}
     */
    private ByteArrayOutputStream toOutputStream(Workbook workbook) throws IOException {
        ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
        workbook.write(outputStream);
        return outputStream;
    }
}

```
