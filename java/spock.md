# Spock - Unit Tests

## References

Spock

> - Spock is a testing and specification framework for Java and Groovy applications.
> - What makes it stand out from the crowd is its beautiful and highly expressive specification language.
> - Thanks to its JUnit runner, Spock is compatible with most IDEs, build tools, and continuous integration servers.

- Intro : 使用Spock框架进行单元测试 : http://blog.2baxb.me/archives/1398
- Home Page : http://spockframework.org/
- GitHub : https://github.com/spockframework/spock
- Docs Index : http://spockframework.org/spock/docs/1.1/index.html
    - Single Page Docs ( all in one ) : http://spockframework.org/spock/docs/1.1/all_in_one.html
    - **Primer** ( quickstart ) : http://spockframework.org/spock/docs/1.1/spock_primer.html
    - **Data Driven Testing** : http://spockframework.org/spock/docs/1.1/data_driven_testing.html
    - Interaction Based Testing : http://spockframework.org/spock/docs/1.1/interaction_based_testing.html
    - Extensions : http://spockframework.org/spock/docs/1.1/extensions.html
- IntelliJ IDEA : https://www.jetbrains.com/help/idea/getting-started-with-groovy.html

Groovy

- Testing with spock : http://groovy-lang.org/testing.html#_testing_with_spock

~~Mockito~~ ( deprecated! )

- Brief Intro
    - Tasty mocking framework for unit tests in Java
- **Reasons for Deprecation**
    - Spock is powerful enough.
    - It is too complicated to use Mockito when your code is complicated.
- References
    - Home Page : https://site.mockito.org/
    - How-to : https://site.mockito.org/#how
- Related Tool
    - TestMe - Plugin of IntelliJ IDEA : https://plugins.jetbrains.com/plugin/9471-testme

## Must READ

Quickstart

### Groovy

- Syntax : http://groovy-lang.org/syntax.html
- Operator : http://groovy-lang.org/operators.html
- Control Structure : http://groovy-lang.org/structure.html
- Closures : http://groovy-lang.org/closures.html

### Spock

- Primer : http://spockframework.org/spock/docs/1.1/spock_primer.html
- Data Driven Testing : http://spockframework.org/spock/docs/1.1/data_driven_testing.html

#### Blocks

- Ref : http://spockframework.org/spock/docs/1.1/all_in_one.html#_feature_methods

Unit Test

- setup / prepare
- stimulus / run
- response / judge
- cleanup / tear down
    - usually unnecessary in Java
    - unless open files or connect to network

Blocks to Phases

![](http://spockframework.org/spock/docs/1.1/images/Blocks2Phases.png)

##### setup

`setup` is an alias of `given`.

```groovy
def 'SampleController.addJob()'() {
    given:
    def id = '123:456'
    def type = 'test_type'
    def job = new Job(id, type)

    when:
    def resp = controller.addJob(auth, id, type)

    then:
    1 * sampleService.addJob(id, type) >> jobObj
    resp == [result: result]

    where:
    jobObj | result
    job    | true
    null    | false
}
```

##### expect

when & then & expect

```groovy
def 'unit test'() {
    when: // stimulus
    def resp = controller.doSomething()

    then: // response
    resp == [result: exceptedResult]

    where:
    exceptedResult << [true, false]
}
```

`when & then` blocks above is equal to `expect` as follow.

```groovy
def 'unit test'() {
    expect:
    controller.doSomething() == [result: exceptedResult]

    where:
    exceptedResult << [true, false]
}
```

##### where

- Usually use with Data Tables or Data Pipes.
- Simplify duplicated code.

## Usage

### Auxiliary Tool

Spock Framework Enhancements

- IntelliJ IDEA ( IDE ) 插件
- https://plugins.jetbrains.com/plugin/7114-spock-framework-enhancements

### Samples

#### Controller

```java
……
public class SampleController {

    @Autowired
    private SampleService sampleService;

    @RequestMapping(value = "/job/add.json", method = RequestMethod.POST)
    public Map<String, Object> addJob(Auth auth,
                              @RequestParam(name = "id") String id,
                              @RequestParam(name = "type") String type
    ) {
        Job job = sampleService.addJob(id, type);
        return ImmutableMap.of(WebConstant.RESPONSE_RESULT, job != null);
    }

    @RequestMapping(value = "/job/do.json", method = RequestMethod.POST)
    public Map<String, Object> doJob(Auth auth,
                                      @RequestParam(name = "id") String id,
                                      @RequestParam(name = "type") String type
    ) {
        Job job = Job.build(id, type);
        boolean result = sampleService.processJob(job);
        return ImmutableMap.of(WebConstant.RESPONSE_RESULT, result);
    }
}
```

#### ControllerTest

```groovy
……
import spock.lang.Specification
import spock.lang.Unroll

class SampleControllerTest extends Specification {

    static id = '123:456'
    static type = 'test_type'
    static job = new Job(id, type)
    // static 变量才能在 Data Tables（见后文）中直接使用

    // 被 mock 的对象
    def auth = Mock(Auth)
    def sampleService = Mock(SampleService)
    // 将依赖注入到要测试的 Controller 中，这里注入的是 jobService（构造器注入）
    def controller = new SampleController(sampleService: sampleService)

    @Unroll
    // @Unroll 参考 http://spockframework.org/spock/docs/1.1/all_in_one.html#_reporting_of_failures
    def 'SampleController.addJob()'() {
        when:
        def resp = controller.addJob(auth, id, type)

        then:
        1 * sampleService.addJob(id, type) >> jobObj
        // `1 *` 表示 sampleService.addJob() 只被调用一次
        //     参考 http://spockframework.org/spock/docs/1.1/all_in_one.html#_cardinality
        // `>> jobObj` 表示 sampleService.addJob() 被调用时，返回 jobObj
        //     参考 http://spockframework.org/spock/docs/1.1/all_in_one.html#_stubbing
        resp == [result: exceptedResult]
        // 判断结果是否符合要求

        where:
        jobObj | exceptedResult
        job    | true
        null    | false
        // Data Tables 参考 http://spockframework.org/spock/docs/1.1/all_in_one.html#data-tables
    }

    @Unroll
    def 'SampleController.doJob()'() {
        when:
        def resp = controller.doJob(auth, id, type)

        then:
        1 * sampleService.processJob(job) >> result
        resp == [result: result]

        where:
        result << [true, false]
        // `<< […]` 参考 http://spockframework.org/spock/docs/1.1/interaction_based_testing.html
    }
}
```

#### Service

- Omit part of code

```java
……
public class SampleServiceImpl implements SampleService {
    private static final String REDIS_JOB_TYPE_PREFIX = "JOB_TYPE_";

    @Autowired
    private JobQueue jobQueue;

    @Autowired
    @Qualifier("customTranscodeJedisClient")
    private JedisClient jedisClient;

    @Autowired
    private AnotherService anotherService;

    @Autowired
    private Configer configer;

    @Autowired
    private Executer executer;

    @Override
    public Job addJob(String id, String type) {
        Job job = Job.build(id, type);
        boolean result = jobQueue.enqueueJob(job);
        return result ? job : null;
    }

    @Override
    public boolean processJob(Job job) {
        String typeName = job.getJobType();
        String typeJsonStr = jedisClient.get(REDIS_JOB_TYPE_PREFIX + typeName);
        if (StringUtils.isBlank(typeJsonStr)) {
            throw new SomeException(SomeError.ERROR_DATA_FORMAT, "type cannot be found");
        }

        JobType type = null;
        try {
            type = JsonUtil.parseObject(typeJsonStr, JobType.class);
        } catch (IOException e) {
            throw new SomeException(SomeError.ERROR_INTERNAL, e);
        }

        Params params = anotherService.getParams(Arrays.asList(id));
        Map<String, Object> config = getConfig(params);
        String jobResult = executer.execute(params, config);

        return StringUtils.isNotEmpty(jobResult);
    }
}
```

#### ServiceTest

```groovy
……
import groovy.json.JsonBuilder
import spock.lang.Specification
import spock.lang.Unroll

class SampleServiceImplTest extends Specification {

    static id = '110:666'
    static type = 'type'
    static job = new Job(id, type)

    def params = new Params(
        id: "666",
        type: 0,
        extension: "{}"
    )

    def jobQueue = Mock(JobQueue)
    def jedisClient = Mock(JedisClient)
    def anotherService = Mock(AnotherService)
    def configer = Mock(Configer)
    def executer = Mock(Executer)

    def SampleService = new SampleServiceImpl(
            jobQueue: jobQueue,
            jedisClient: jedisClient,
            anotherService: anotherService,
            configer: configer,
            executer: executer)

    @Unroll
    def 'SampleService.addJob()'() {
        when:
        def resp = SampleService.addJob(id, type)

        then:
        1 * jobQueue.enqueueJob(_) >> result
        // `(_)` 参考 http://spockframework.org/spock/docs/1.1/all_in_one.html#_argument_constraints
        resp == exceptedResp

        where:
        result || exceptedResp
        true   || job
        false  || null
    }

    @Unroll
    def 'SampleService.processJob() succeed'() {
        given:
        def typeJson = new JsonBuilder([
                type: 'nothing',
                commands: ['ls', 'touch foo.bar.txt']
                extension: [is_icehe: '1'],
        ]).toString()

        def jobJson = new JsonBuilder([data: [id: "not empty"]])

        when:
        1 * jedisClient.get(_) >> typeJson
        1 * anotherService.getParams(_) >> params
        1 * configer.getConfig(_) >> [foo: 'bar']
        1 * executer.execute(_, _, _) >> jobJson

        then:
        SampleService.processJob(job) == true
    }

    @Unroll
    def 'SampleService.processJob() throw exception'() {
        when:
        SampleService.processJob(job)

        then:
        1 * jedisClient.get(_) >> typeJsonStr
        anotherService.getParams(_) >> params
        configer.getConfig(_) >> [foo: 'bar']
        thrown(SomeException.class)
        // `thrown()` 参考 Exception Conditions 小节
        // http://spockframework.org/spock/docs/1.1/spock_primer.html

        // 如果要判断抛出异常的详细信息，可以如下
        // e = thrown(SomeException.class)
        // e.cause == "expcetedCause"

        where:
        typeJsonStr << ['', 'not json']
    }
}
```

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
