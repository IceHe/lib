# JSON

## Jackson

References

-   [How to enable pretty print JSON output](https://mkyong.com/java/how-to-enable-pretty-print-json-output-jackson/)

### JsonUtil

```java

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.DeserializationFeature;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.SerializationFeature;
import com.fasterxml.jackson.datatype.jsr310.JavaTimeModule;
import lombok.SneakyThrows;
import lombok.experimental.UtilityClass;
import org.springframework.util.StringUtils;

import java.io.IOException;
import java.util.Map;

import static template.example.json.JsonTypes.MAP_STR_2_OBJ;

/**
 * JSON 序列化工具
 * @link https://www.baeldung.com/jackson
 * @link https://github.com/FasterXML/jackson
 * @link https://github.com/fabienrenaud/java-json-benchmark
 * @link https://stackoverflow.com/questions/2591098/how-to-parse-json-in-java
 * @see com.fasterxml.jackson.databind.ObjectMapper
 * @see template.example.json.JsonTypes
 */
@UtilityClass
public class JsonUtil {

    private final ObjectMapper mapper = new ObjectMapper();

    /* 全局生效的序列化配置 */
    static {
        // 解决实体未包含字段反序列化时抛出异常
        mapper.configure(DeserializationFeature.FAIL_ON_UNKNOWN_PROPERTIES, false);

        // 对于空的对象转 JSON 的时候不抛出错误
        mapper.disable(SerializationFeature.FAIL_ON_EMPTY_BEANS);

        // // 允许属性名称没有引号
        // mapper.configure(Feature.ALLOW_UNQUOTED_FIELD_NAMES, true);

        // // 允许单引号
        // mapper.configure(Feature.ALLOW_SINGLE_QUOTES, true);

        // // Include.NON_EMPTY 属性为 空 ("") 或者为 NULL 都不序列化, 则返回的 JSON 是没有这个字段的, 节省空间
        // mapper.setSerializationInclusion(JsonInclude.Include.NON_EMPTY);

        // LocalDateTime 的序列化
        mapper.registerModule(new JavaTimeModule());
        mapper.disable(SerializationFeature.WRITE_DATES_AS_TIMESTAMPS);

        // Pretty Print
        // mapper.enable(SerializationFeature.INDENT_OUTPUT);
    }

    /** Get Internal mapper */
    public ObjectMapper mapper() {
        return mapper;
    }

    public String writeValue(Object o) {
        if (null == o) return null;
        try {
            return mapper.writeValueAsString(o);
        } catch (Exception e) {
            return null;
        }
    }

    public String writePrettyValue(Object o) {
        if (null == o) return null;
        try {
            return mapper.writerWithDefaultPrettyPrinter().writeValueAsString(o);
        } catch (Exception e) {
            return null;
        }
    }

    @SneakyThrows(JsonProcessingException.class)
    public String writeValueOrThrow(Object o) {
        if (null == o) return null;
        return mapper.writeValueAsString(o);
    }

    public <T> T readValue(String json, Class<T> valueType) {
        if (!StringUtils.hasText(json)) return null;
        try {
            return mapper.readValue(json, valueType);
        } catch (IOException e) {
            return null;
        }
    }

    public <T> T readValue(String json, TypeReference<T> typeRef) {
        if (!StringUtils.hasText(json)) return null;
        try {
            return mapper.readValue(json, typeRef);
        } catch (IOException e) {
            return null;
        }
    }

    @SneakyThrows(IOException.class)
    public <T> T readValueOrThrow(String json, Class<T> valueType) {
        if (!StringUtils.hasText(json)) return null;
        return mapper.readValue(json, valueType);
    }

    @SneakyThrows(IOException.class)
    public <T> T readValueOrThrow(String json, TypeReference<T> typeRef) {
        if (!StringUtils.hasText(json)) return null;
        return mapper.readValue(json, typeRef);
    }

    public Map<String, Object> toMap(Object o) {
        if (null == o) return Map.of();
        try {
            return mapper.convertValue(o, MAP_STR_2_OBJ);
        } catch (Exception e) {
            return Map.of();
        }
    }

    @SneakyThrows(IllegalArgumentException.class)
    public Map<String, Object> toMapOrThrow(Object o) {
        if (null == o) return Map.of();
        return mapper.convertValue(o, MAP_STR_2_OBJ);
    }
}

```

JsonTypes

```java

public class JsonTypes {
    public static final TypeReference<Map<String, Object>> MAP_STR_2_OBJ = new TypeReference<>() {};
    public static final TypeReference<List<Integer>> LIST_INT = new TypeReference<>() {};
    public static final TypeReference<List<String>> LIST_STR = new TypeReference<>() {};
    public static final TypeReference<Set<Integer>> SET_INT = new TypeReference<>() {};
    public static final TypeReference<Set<String>> SET_STR = new TypeReference<>() {};
}

```

### Serialize and Deserialize

Example

-   Long2StringSerializer.java

```java

import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.databind.SerializerProvider;
import com.fasterxml.jackson.databind.ser.std.StdSerializer;

import java.io.IOException;

/**
 * 将 Long 类型变量转换为字符串的 JSON 序列化器
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
            Long value,
            JsonGenerator gen,
            SerializerProvider provider
    ) throws IOException {
        if (null == value) {
            gen.writeNull();
            return;
        }
        gen.writeString(value.toString());
    }
}

```

-   String2LongDeserializer.java

```java

import com.fasterxml.jackson.core.JsonParser;
import com.fasterxml.jackson.databind.DeserializationContext;
import com.fasterxml.jackson.databind.deser.std.StdDeserializer;

import java.io.IOException;

/**
 * 将数字字符串转换为 Long 类型变量的 JSON 反序列化器
 */
public class String2LongDeserializer extends StdDeserializer<Object> {

    public String2LongDeserializer() {
        this(null);
    }

    public String2LongDeserializer(Class<Object> t) {
        super(t);
    }

    @Override
    public Object deserialize(
            JsonParser p,
            DeserializationContext ctxt
    ) throws IOException {
        try {
            return p.readValueAs(Long.class);
        } catch (IOException ignored) {
            return null;
        }
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

import static org.junit.jupiter.api.Assertions.assertEquals;

class Long2StringSerializerTest {

    @Data
    @Accessors(chain = true)
    static class CompanyDTO {
        @JsonSerialize(using = Long2StringSerializer.class)
        @JsonDeserialize(using = String2LongDeserializer.class)
        private Long companyId;
    }

    @Test
    void test() {
        final String json = """
                {"companyId":"666"}""";
        CompanyDTO companyDTO = new CompanyDTO().setCompanyId(666L);
        System.out.println(companyDTO);
        assertEquals(json, JsonUtil.writeValue(companyDTO));
        assertEquals(companyDTO, JsonUtil.readValue(JsonUtil.writeValue(companyDTO), CompanyDTO.class));
    }
}

```

## Gson

### GsonUtil

```java

import com.google.gson.Gson;
import lombok.experimental.UtilityClass;

import java.lang.reflect.Type;

/**
 * JSON 序列化工具
 * @link https://www.baeldung.com/gson-serialization-guide
 * @link https://www.baeldung.com/gson-deserialization-guide
 * @link https://github.com/google/gson
 * @link https://github.com/fabienrenaud/java-json-benchmark
 * @link https://stackoverflow.com/questions/2591098/how-to-parse-json-in-java
 * @see com.google.gson.Gson
 * @see template.example.json.GsonTypes
 */
@UtilityClass
public class GsonUtil {

    private final Gson gson = new Gson();

    /** Get internal Gson */
    public Gson gson() {
        return gson;
    }

    public String toJson(Object o) {
        return gson.toJson(o);
    }

    public String toJson(Object o, Class<?> clazz) {
        return gson.toJson(o, clazz);
    }

    public String toJson(Object o, Type type) {
        return gson.toJson(o, type);
    }

    public <T> T fromJson(String json, Class<T> classOfT) {
        return gson.fromJson(json, classOfT);
    }

    /** @see template.example.json.GsonTypes */
    public <T> T fromJson(String json, Type typeOfT) {
        return gson.fromJson(json, typeOfT);
    }
}

```

GsonTypes

```java

public class GsonTypes {
    public static final Type MAP_STR_2_OBJ = new TypeToken<Map<String, Object>>() {}.getType();
    public static final Type LIST_INT = new TypeToken<List<Integer>>() {}.getType();
    public static final Type LIST_STR = new TypeToken<List<String>>() {}.getType();
    public static final Type SET_INT = new TypeToken<Set<Integer>>() {}.getType();
    public static final Type SET_STR = new TypeToken<Set<String>>() {}.getType();
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
        String jsonString = "{\"aInt\":1,\"bStr\":\"boy\",\"cBool\":true,\"dNull\":null,\"eDouble\":3.14}";
        Map<String, Object> map = JSON.parseObject(jsonString, new TypeReference<Map<String, Object>>() {});
        System.out.println(map);
    }
}

```
