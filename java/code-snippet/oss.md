# OSS

Object Storage Service

---

## Download

```java
package xyz.icehe.service;

import com.aliyun.oss.OSSClient;
import com.aliyun.oss.model.OSSObject;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.io.IOUtils;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;

import java.io.InputStream;
import java.net.URI;
import java.net.URISyntaxException;

/**
 * @author icehe.life
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

    public byte[] fetchOssFileContent(@NotNull String fileUrl) {

        OSSClient ossClient = new OSSClient(endpoint, accessKeyId, accessKeySecret);
        OSSObject ossObject = ossClient.getObject(bucketName, parseOssObjectKey(fileUrl));
        if (ossObject == null) {
            throw new RuntimeException("文件不存在：" + fileUrl);
        }

        try (InputStream inputStream = ossObject.getObjectContent()) {
            return IOUtils.toByteArray(inputStream);

        } catch (Exception e) {
            log.error("read from file fail: " + fileUrl, e);
            throw new RuntimeException("下载文件失败：" + fileUrl, e);

        } finally {
            ossClient.shutdown();
        }
    }

    private String parseOssObjectKey(@NotNull String url) {
        try {
            URI uri = new URI(url);
            return uri.getPath().startsWith("/") ?
                    uri.getPath().substring("/".length()) : uri.getPath();
        } catch (URISyntaxException e) {
            throw new RuntimeException("无效的文件链接：" + url, e);
        }
    }
}

```
