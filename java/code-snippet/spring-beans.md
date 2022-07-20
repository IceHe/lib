# Spring Beans

References

-   [How to get bean using application context in spring boot](https://stackoverflow.com/questions/34088780/how-to-get-bean-using-application-context-in-spring-boot)

## BeansUtil

```java
package xyz.icehe.utils;

import org.jetbrains.annotations.NotNull;
import org.springframework.beans.BeansException;
import org.springframework.context.ApplicationContext;
import org.springframework.context.ApplicationContextAware;
import org.springframework.stereotype.Component;

/**
 * @author icehe.life
 * @since 2021/08/10
 */
@Component
public class BeansUtil implements ApplicationContextAware {

    private static ApplicationContext APPLICATION_CONTEXT;

    @Override
    public void setApplicationContext(ApplicationContext applicationContext) throws BeansException {
        APPLICATION_CONTEXT = applicationContext;
    }

    public static ApplicationContext getApplicationContext() {
        return APPLICATION_CONTEXT;
    }

    public static <T> T getBeanByType(@NotNull Class<T> requiredType) {
        return getApplicationContext().getBean(requiredType);
    }

    public static <T> T getBeanByNameAndClass(@NotNull String qualifierName, @NotNull Class<T> requiredType) {
        return getApplicationContext().getBean(qualifierName, requiredType);
    }

    public static <T> T getBean(@NotNull Class<T> requiredType, Object... args) {
        return getApplicationContext().getBean(requiredType, args);
    }
}

```
