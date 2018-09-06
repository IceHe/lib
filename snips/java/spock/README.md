# Spock

> Spock is a testing and specification framework for Java and Groovy applications.

- Home Page : http://spockframework.org/
- **GitHub** : https://github.com/spockframework/spock
    - Example : https://github.com/spockframework/spock-example
- Docs Index : http://spockframework.org/spock/docs/1.1/index.html
    - Single Page Docs ( all in one ) : http://spockframework.org/spock/docs/1.1/all_in_one.html
    - **Primer** ( quickstart ) : http://spockframework.org/spock/docs/1.1/spock_primer.html
    - **Data Driven Testing** : http://spockframework.org/spock/docs/1.1/data_driven_testing.html
    - Interaction Based Testing : http://spockframework.org/spock/docs/1.1/interaction_based_testing.html
    - Extensions : http://spockframework.org/spock/docs/1.1/extensions.html

Groovy

- Testing with spock : http://groovy-lang.org/testing.html#_testing_with_spock

> ~~Mockito~~ ( deprecated! )
>
> - Brief Intro
>     - Tasty mocking framework for unit tests in Java
> - Reasons for Deprecation
>     - Spock is powerful enough.
>     - It is too complicated to use Mockito when your code is complicated.
> - References
>     - Home Page : https://site.mockito.org/
>     - How-to : https://site.mockito.org/#how
> - Related Tool
>     - TestMe - Plugin of IntelliJ IDEA : https://plugins.jetbrains.com/plugin/9471-testme

## Dependency

- See modules : https://github.com/spockframework/spock#modules

Gradle

- Ad-Hoc Intermediate Releases : https://github.com/spockframework/spock#ad-hoc-intermediate-releases
- Building : https://github.com/spockframework/spock#building

Maven

- pom.xml ( for reference only )

```xml
……
<dependencies>
    ……
    <dependency>
        <groupId>org.spockframework</groupId>
        <artifactId>spock-core</artifactId>
        <version>1.0-groovy-2.4</version>
        <scope>test</scope>
    </dependency>
    <dependency>
        <groupId>org.spockframework</groupId>
        <artifactId>spock-spring</artifactId>
        <version>1.0-groovy-2.4</version>
        <scope>test</scope>
    </dependency>

    <dependency>
        <!-- use a specific Groovy version rather than the one specified by spock-core -->
        <groupId>org.codehaus.groovy</groupId>
        <artifactId>groovy-all</artifactId>
        <version>2.4.7</version>
        <scope>test</scope>
    </dependency>
    ……
</dependencies>
……
```

Auxiliary Tool

- Spock Framework Enhancements - plugins of IntelliJ IDEA :
    - https://plugins.jetbrains.com/plugin/7114-spock-framework-enhancements

## Usage

```java
package com.weibo.api.weibovideo.controller.inner;

import com.google.common.collect.ImmutableMap;
import com.weibo.api.weibovideo.constant.WebConstant;
import com.weibo.api.weibovideo.customtranscode.CustomTranscodeService;
import com.weibo.api.weibovideo.customtranscode.Task;
import com.weibo.api.weibovideo.model.AuthUser;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import java.util.Map;

/**
 * Created by zhiyuan16 on 2018/08/27.
 **/
@RestController
@RequestMapping(WebConstant.PROJECT_ROOT_CONTEXT)
public class CustomTranscodeTaskController {

    @Autowired
    private CustomTranscodeService tasksService;

    @RequestMapping(value = "/custom_transcode/task/add.json", method = RequestMethod.POST)
    public Map<String, Object> addTask(AuthUser authUser,
                              @RequestParam(name = "object_id") String objectId,
                              @RequestParam(name = "task_type") String taskType
    ) {
        Task task = tasksService.addTask(objectId, taskType);
        return ImmutableMap.of(WebConstant.RESPONSE_RESULT, task != null);
    }

    @RequestMapping(value = "/custom_transcode/task/do.json", method = RequestMethod.POST)
    public Map<String, Object> doTask(AuthUser authUser,
                                      @RequestParam(name = "object_id") String objectId,
                                      @RequestParam(name = "task_type") String taskType
    ) {
        Task task = Task.build(objectId, taskType);
        boolean result = tasksService.processTask(task);
        return ImmutableMap.of(WebConstant.RESPONSE_RESULT, result);
    }
}
```

```groovy
package com.weibo.api.weibovideo.controller.inner

import com.weibo.api.weibovideo.customtranscode.CustomTranscodeService
import com.weibo.api.weibovideo.customtranscode.Task
import com.weibo.api.weibovideo.model.AuthUser
import spock.lang.Specification
import spock.lang.Unroll

/**
 * Created by zhiyuan16 on 2018/9/5.
 */
class CustomTranscodeTaskControllerTest extends Specification {

    def tasksService = Mock(CustomTranscodeService.class)
    def customTranscodeTaskController = new CustomTranscodeTaskController(tasksService: tasksService)

    @Unroll // TODO: throw immediately
    def "addTask expectations"() {
        given: // alias of `setup`
        def authUser = Mock(AuthUser.class)
        def objectId = "123:456"
        def taskType = "test_type"
        def expectation = [result: result]

        when:
        def resp = customTranscodeTaskController.addTask(authUser, objectId, taskType)

        then:
        1 * tasksService.addTask(objectId, taskType) >> task
        resp == expectation

//        expect: // TODO: equal to `when` & `then`

        where: // TODO: compare to data table
        task << [new Task(), null]
        result << [true, false]
    }

    @Unroll
    def "do Task where taskType=#taskType and authUser=#authUser and objectId=#objectId then expect: #expectedResult"() {
        when:
        1 * tasksService.processTask(new Task(objectId, taskType)) >> expectation.result
        def response = customTranscodeTaskController.doTask(authUser, objectId, taskType)

        then:
        response == expectation

        where:
        // data table
        authUser             | taskType   | objectId  || expectation
        Mock(AuthUser.class) | "taskType" | "123:456" || ["result": true]
        Mock(AuthUser.class) | "taskType" | "123:456" || ["result": false]
    }
}
```