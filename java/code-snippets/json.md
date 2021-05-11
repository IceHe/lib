# JSON

## Jackson

### JsonUtils

```java
package xyz.icehe.utils;

import java.io.IOException;
import java.util.Collections;
import java.util.Map;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.core.JsonParser.Feature;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.DeserializationFeature;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.SerializationFeature;
import com.fasterxml.jackson.datatype.jsr310.JavaTimeModule;
import lombok.experimental.UtilityClass;
import org.apache.commons.lang3.StringUtils;

/**
 * JSON 序列化工具
 *
 * @author icehe.xyz
 * @see com.fasterxml.jackson.databind.ObjectMapper
 * @since 2020/10/19
 */
@UtilityClass
public class JsonUtils {

    public final TypeReference<Map<String, Object>> MAP_TYPE_REF = new TypeReference<Map<String, Object>>() {};

    private final ObjectMapper mapper = new ObjectMapper();

    static {
        // 解决实体未包含字段反序列化时抛出异常
        mapper.configure(DeserializationFeature.FAIL_ON_UNKNOWN_PROPERTIES, false);

        // 对于空的对象转json的时候不抛出错误
        mapper.disable(SerializationFeature.FAIL_ON_EMPTY_BEANS);

        // 允许属性名称没有引号
        mapper.configure(Feature.ALLOW_UNQUOTED_FIELD_NAMES, true);

        // 允许单引号
        mapper.configure(Feature.ALLOW_SINGLE_QUOTES, true);

        // Include.NON_EMPTY 属性为 空（""） 或者为 NULL 都不序列化, 则返回的 JSON 是没有这个字段的, 这样对移动端会更省流量
        mapper.setSerializationInclusion(JsonInclude.Include.NON_EMPTY);

        // LocalDateTime 的序列化
        mapper.registerModule(new JavaTimeModule());
        mapper.disable(SerializationFeature.WRITE_DATES_AS_TIMESTAMPS);
    }

    /**
     * Get internal Jackson ObjectMapper
     *
     * @return
     */
    public ObjectMapper mapper() {
        return mapper;
    }

    /**
     * Serialize Object into JSON String (without exceptions)
     *
     * @param object
     * @return
     */
    public String toJsonString(Object object) {
        if (null == object) {
            return null;
        }
        try {
            return mapper.writeValueAsString(object);
        } catch (Exception e) {
            return null;
        }
    }

    /**
     * Serialize Object into JSON String with exceptions
     *
     * @param object
     * @return
     * @throws JsonProcessingException
     */
    public String toJsonStringWithExceptions(Object object) throws JsonProcessingException {
        if (null == object) {
            return null;
        }
        return mapper.writeValueAsString(object);
    }

    /**
     * Deserialize Object from JSON String (without exceptions)
     *
     * @param content
     * @param valueType
     * @param <T>
     * @return
     */
    public <T> T fromJsonString(String content, Class<T> valueType) {
        if (StringUtils.isBlank(content)) {
            return null;
        }
        try {
            return mapper.readValue(content, valueType);
        } catch (IOException e) {
            return null;
        }
    }

    /**
     * Deserialize Object from JSON String (without exceptions)
     *
     * @param content
     * @param typeReference
     * @param <T>
     * @return
     */
    public <T> T fromJsonString(String content, TypeReference<T> typeReference) {
        if (StringUtils.isBlank(content)) {
            return null;
        }
        try {
            return mapper.readValue(content, typeReference);
        } catch (IOException e) {
            return null;
        }
    }

    /**
     * Deserialize Object from JSON String with exceptions
     *
     * @param content
     * @param valueType
     * @param <T>
     * @return
     * @throws IOException
     */
    public <T> T fromJsonStringWithExceptions(String content, Class<T> valueType) throws IOException {
        if (StringUtils.isBlank(content)) {
            return null;
        }
        return mapper.readValue(content, valueType);
    }

    /**
     * Deserialize Object from JSON String with exceptions
     *
     * @param content
     * @param typeReference
     * @param <T>
     * @return
     * @throws IOException
     */
    public <T> T fromJsonStringWithExceptions(String content, TypeReference<T> typeReference) throws IOException {
        if (StringUtils.isBlank(content)) {
            return null;
        }
        return mapper.readValue(content, typeReference);
    }

    /**
     * Convert Object to Map (without exceptions)
     *
     * @param object
     * @return
     */
    public Map<String, Object> toMap(Object object) {
        if (null == object) {
            return Collections.emptyMap();
        }
        try {
            return mapper.convertValue(object, MAP_TYPE_REF);
        } catch (Exception e) {
            return Collections.emptyMap();
        }
    }

    /**
     * Convert Object to Map with exceptions
     *
     * @param object
     * @return
     */
    public Map<String, Object> toMapWithExceptions(Object object) throws IllegalArgumentException {
        if (null == object) {
            return Collections.emptyMap();
        }
        return mapper.convertValue(object, MAP_TYPE_REF);
    }
}

```

### Serialize and Deserialize

Example

- CompanyDTO.java

```java
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class CompanyDTO {
    /** 公司 ID */
    @JsonSerialize(using = Long2StringSerializer.class)
    @JsonDeserialize(using = String2LongDeserializer.class)
    private Long companyId;
}

```

- Long2StringSerializer.java

```java
import java.io.IOException;

import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.databind.SerializerProvider;
import com.fasterxml.jackson.databind.ser.std.StdSerializer;

/**
 * 转换 Long 类型变量为字符串的序列化器
 *
 * @author icehe
 * @since 2020/10/14
 */
public class Long2StringSerializer extends StdSerializer<Long> {

    public Long2StringSerializer() {
        this(null);
    }

    public Long2StringSerializer(Class<Long> t) {
        super(t);
    }

    @Override
    public void serialize(
        Long longValue, JsonGenerator gen, SerializerProvider provider)
        throws IOException {
        if (null == longValue) {
            gen.writeNull();
            return;
        }
        gen.writeString(longValue.toString());
    }
}

```

- String2LongDeserializer.java

```java
import java.io.IOException;

import com.fasterxml.jackson.core.JsonParser;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.DeserializationContext;
import com.fasterxml.jackson.databind.deser.std.StdDeserializer;

/**
 * 转换毫秒数或字符串为 LocalDateTime 的反序列化器
 *
 * @author icehe
 * @since 2020/10/14
 */
public class String2LongDeserializer extends StdDeserializer<Object> {

    public String2LongDeserializer() {
        this(null);
    }

    public String2LongDeserializer(Class<Object> t) {
        super(t);
    }

    @Override
    public Object deserialize(JsonParser p, DeserializationContext ctxt)
        throws IOException, JsonProcessingException {
        try {
            return p.readValueAs(Long.class);
        } catch (IOException e) {
            // do nothing
        }

        return null;
    }
}

```

## FastJson

### JSON String to Map

```java
import java.util.Map;
import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.TypeReference;

public class Test {
    public static void main(String[] args) {
        String jsonString =
                "{\"aInt\":1,\"bStr\":\"boy\",\"cBool\":true,\"dNull\":null,\"eDouble\":3.14}";
        Map<String, Object> map =
                JSON.parseObject(jsonString, new TypeReference<Map<String, Object>>() {});
        System.out.println(map);
    }
}

```

## Gson

### Gson Utils

```java
package xyz.icehe.utils;

import java.lang.reflect.Type;

import com.google.gson.Gson;
import lombok.experimental.UtilityClass;

/**
 * Gson 序列化工具
 *
 * @author icehe.xyz
 * @see com.google.gson.Gson
 * @since 2020/10/19
 */
@UtilityClass
public class GsonUtils {

    private final Gson gson = new Gson();

    /**
     * Get internal Gson
     *
     * @return
     */
    public Gson gson() {
        return gson;
    }

    /**
     * Serialize Object into JSON String
     *
     * @param o
     * @return
     */
    public String toJsonString(Object o) {
        return gson.toJson(o);
    }

    /**
     * Deserialize Object from JSON String
     *
     * @param json
     * @param classOfT
     * @param <T>
     * @return
     */
    public <T> T fromJsonString(String json, Class<T> classOfT) {
        return gson.fromJson(json, classOfT);
    }

    /**
     * Deserialize Object from JSON String
     *
     * @param json
     * @param typeOfT
     * @param <T>
     * @return
     */
    public <T> T fromJsonString(String json, Type typeOfT) {
        return gson.fromJson(json, typeOfT);
    }
}

```
