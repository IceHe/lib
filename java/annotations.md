# Annotations

## Spring

Core Spring Framework Annotations

- https://springframework.guru/spring-framework-annotations/

### @Resource vs. @Autowired (@Inject)

- https://stackoverflow.com/a/10916767

### @Component vs. @Bean

- https://stackoverflow.com/a/10604537

### @Component vs. @Service

@Component 跟 @Service @Controller @Repository 有什么区别？

- 后三者基本都是 @Component 在不同层次的别名，服务层、接口层、持久层。
- Difference between @Component, @Service, @Controller, and @Repository in Spring : https://javarevisited.blogspot.com/2017/11/difference-between-component-service.html
- @Component vs @Repository and @Service in Spring | Baeldung : https://www.baeldung.com/spring-component-repository-service
- java - What&#39;s the difference between @Component, @Repository &amp; @Service annotations in Spring? - Stack Overflow : https://stackoverflow.com/questions/6827752/whats-the-difference-between-component-repository-service-annotations-in

@Bean 和 @Component 是不是同一种东西？是不同的概念！

- java - Spring: @Component versus @Bean - Stack Overflow : https://stackoverflow.com/questions/10604298/spring-component-versus-bean
- @Component 和 @Bean 的区别 : https://blog.csdn.net/qq_38534144/article/details/82414201

> Same is true for @Service and @Repository annotation, they are a specialization of @Component in service and persistence layer. A Spring bean in the service layer should be annotated using @Service instead of @Component annotation and a spring bean in the persistence layer should be annotated with @Repository annotation.
>
> By using a specialized annotation we hit two birds with one stone. First, they are treated as Spring bean and second you can put special behavior required by that layer.

### @Profile

References

- https://www.baeldung.com/spring-profiles

Example : @ActiveProfile in Tests

- SomeMessageReceiver.java

```java
import lombok.extern.slf4j.Slf4j;
import org.springframework.context.annotation.Profile;
import org.springframework.stereotype.Component;

@Profile("mq")
@Component
public class SomeMessageReceiver {
    // ……
}

```

- MqTest.java

```java
import lombok.extern.slf4j.Slf4j;
import org.junit.runner.RunWith;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import xyz.icehe.java.demo.main.Application;

@ActiveProfiles("maxq")
@RunWith(SpringJUnit4ClassRunner.class)
@SpringBootTest(classes = Application.class)
@Slf4j
public class MqTest {

    @Autowired
    private SomeMessageReceiver someMessageReceiver;

    @Test
    public void sendMsg() {
        // ……
    }
}

```

## Lombok

### @Data

总结：lombok 的 @Data 注释导致的问题 (详见微博)

- https://weibo.com/2181657940/HvqLW7XUr

### @Value

- 在@Value注解中为String类型的字段设置null值 | 鸟窝 : https://colobu.com/2015/09/09/set-null-for-a-string-property-by-Value/

## FastJson

### @JSONField

- fastJSON中@JSONField注解详解 - 明洋的专栏 - CSDN博客 : https://blog.csdn.net/yaomingyang/article/details/79861281
- _FastJson中@JSONField注解使用 - 奔跑的蜗牛的博客 - CSDN博客 : https://blog.csdn.net/u011425751/article/details/51219242_ (感觉写得不太好，费解)
- 有空自己写代码实验一下好了
- JSON.toJSONString中序列化空字符串遇到的坑 - 极客分享Geek-Share.com : https://www.geek-share.com/detail/2750512280.html
- fastjson SerializerFeature详解 - 孤天浪雨 - CSDN博客 : https://blog.csdn.net/u010246789/article/details/52539576

## Jackson

- Jackson Annotations : http://tutorials.jenkov.com/java-json/jackson-annotations.html#jsoncreator
- Jackson Annotation Examples : https://www.baeldung.com/jackson-annotations

### @JsonSerialize and @JsonDeserialize

- See [java/code-snippets/notes.md#serialize-and-deserialize](java/code-snippets/notes.md#serialize-and-deserialize)
