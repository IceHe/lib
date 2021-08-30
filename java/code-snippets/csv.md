# OSS

Object Store Service

---

## Demo

```java
package xyz.icehe.service;

import com.aliyun.oss.OSSClient;
import com.aliyun.oss.model.OSSObject;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.collections4.CollectionUtils;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVParser;
import org.apache.commons.csv.CSVRecord;
import org.apache.commons.io.IOUtils;
import org.apache.commons.io.input.BOMInputStream;
import org.apache.commons.lang3.StringUtils;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;

import java.io.BufferedReader;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.URI;
import java.net.URISyntaxException;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.List;
import java.util.Objects;

/**
 * @author icehe.xyz
 */
@Service
@Slf4j
public class OssService {

    @Value("${oss.bucketName}")
    private String bucketName;

    @Value("${oss.endpoint}")
    private String endpoint;

    @Value("${oss.accessKeyId}")
    private String accessKeyId;

    @Value("${oss.accessKeySecret}")
    private String accessKeySecret;

    public String parseOssObjectKey(String url) {
        try {
            URI uri = new URI(url);
            return uri.getPath().startsWith("/") ?
                    uri.getPath().substring("/".length()) : uri.getPath();
        } catch (URISyntaxException e) {
            throw new RuntimeException("无效的文件链接：" + url, e);
        }
    }

    public byte[] fetchOssFile(String fileUrl) {
        OSSClient ossClient = new OSSClient(endpoint, accessKeyId, accessKeySecret);

        OSSObject ossObject = ossClient.getObject(bucketName, parseOssObjectKey(fileUrl));
        // 文件不存在
        if (Objects.isNull(ossObject)) {
            throw new RuntimeException("文件不存在：" + fileUrl);
        }

        try (InputStream inputStream = ossObject.getObjectContent()) {
            return IOUtils.toByteArray(inputStream);
        } catch (IOException e) {
            log.error("read from file fail: " + fileUrl, e);
            throw new RuntimeException("下载文件失败：" + fileUrl, e);
        } finally {
            ossClient.shutdown();
        }
    }

    /**
     * 解析出 CSV 记录
     */
    private List<CSVRecord> parseCsvRecords(@NotNull byte[] data) {
        List<CSVRecord> csvRecords = parseCustomDeliveryCsvFileByCharset(data, StandardCharsets.UTF_8);
        if (CollectionUtils.isEmpty(csvRecords)) {
            csvRecords = parseCustomDeliveryCsvFileByCharset(data, Charset.forName("GBK"));
        }
        if (CollectionUtils.isEmpty(csvRecords)) {
            throw new RuntimeException("文件格式有误");
        }

        csvRecords.forEach(csvRecord -> {
            String userIdStr = csvRecord.get(0);
            try {
                if (StringUtils.isNotBlank(userIdStr)) {
                    Integer.valueOf(userIdStr.trim());
                }
            } catch (NumberFormatException e) {
                throw new RuntimeException("userId=" + userIdStr + " 格式不合法", e);
            }
        });

        return csvRecords;
    }

    private List<CSVRecord> parseCustomDeliveryCsvFileByCharset(
            @NotNull byte[] data,
            @NotNull Charset charset
    ) {
        BufferedReader reader = new BufferedReader(new InputStreamReader(new BOMInputStream(new ByteArrayInputStream(data)), charset));
        try {
            CSVParser csvParser = CSVFormat.DEFAULT.withHeader().withIgnoreEmptyLines(true).parse(reader);
            return csvParser.getRecords();
        } catch (IOException e) {
            log.error("parse file error, charset={}", charset, e);
            throw new RuntimeException("解析文件失败", e);
        }
    }
}

```
