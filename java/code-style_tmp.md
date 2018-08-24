# 代码风格要求

- 必须 must
- 禁止 must not
- 建议 suggest

## 可读性

### 命名

驼峰命名法 Camel Case

- 大驼峰命名法 `UpperCamelCase`
- 小驼峰命名法 `lowerCamelCase`

必须：变量、方法：遵循小驼峰命名法

```java
// Good
// - 变量 fooBar
String fooBar = "baz";
// - 方法 doNothing
private void doNothing() {}
```

不能以下划线 `_` 、美元符 `$` 开始或结束

```java
// Ugly
_foo_bar / $foobar / fooBar_ / fooBar$
```

禁止中英混合

```java
// Good
codingTutorial / getComment
// - 允许使用官方承认的拼音名
weibo / miaopai / taobao / beijing

// Ugly
// - 禁止使用拼音与英文混合的方式
_bianmaJiaocheng / getPinglun
// - 禁止直接使用中文
int 结果 = 0
```

类名：使用大驼峰命名法 UpperCamelCase 风格，必须遵从驼峰形式，但以下情形例外:DO / BO / DTO / VO / AO

```java
// Good
MarcoPolo / UserDO / XmlService / StoryController

// Ugly
macroPolo / UserDo / XMLService / TCPUDPDeal / STORYController
```

方法名、参数名、成员变量、局部变量、统一使用 lowerCamelCase 风格，必须遵从驼峰形式。

```java
// Good
localValue / someMethod()

// Ugly
LocalValue / some_method()
```

常量命名全部大写，单词间用下划线隔开，力求语义表达完整清楚，不要嫌名字长。Long 类型的常量，结尾需用大写的 L 标示，不能用小写 l 。

```java
// Good
MAX_THREAD_COUNT
Long WHITE_UID = 1111111111111111L

// Ugly
MAX_COUNT
Long WHITE_UID = 1111111111111111l // 最后的l 与1 在一些字体下很难区分。
```

抽象类命名使用 Abstract 或 Base 开头；异常类命名使用 Exception 结尾；测试类命名以它要测试的类的名称开始，以 Test 结尾。

包名统一使用小写，点分隔符之间有且仅有一个自然语义的英语单词。包名统一使用单数形式，但是类名如果有复数含义，类名可以使用复数形式。

```java
// Good
com.weibo.api.story.storage
com.weibo.api.story.util

// Ugly
com.weibo.api.story.Storage
```

类名、方法名、变量名、常量名等的命名，避免不规范的缩写，无意义的命名，避免望名不知义。接口中的方法定义要抽象，不要跟具体的资源进行绑定。

```java
// Good
AbstractClass // 类名
cacheResult // 局部变量
SegmentInfoService // 类名
loadProperties // 接口中的方法

// Ugly
AbsClass       // 随意的缩写，降低了代码的阅读性
result         // 局部变量
NewSegmentInfoService // 万恶的New 字，之后会不会还有 NewNew ...
loadPropertiesFromRedis // 接口中方法的定义尽量抽象，具体从哪里 load ，应该是实现类中进行确定的。而不是在接口定义时就规定死了。
```

如果使用到了设计模式，建议在类名中体现出具体模式。

```java
// Good
public class OrderFactory
public class LoginProxy
public class RsourceObserver
```

枚举类名建议带上 Enum 后缀，枚举成员名称需要全大写，单词间用下划线隔开。（枚举类其实就是特殊的常量类，且构造函数强制私有）

```java
// Good
public enum CensorEnum {

    SEND_BEFORE("sendBefore"), CENSOR_BEFORE("censorBefore");

    private String censorType;
    CensorEnum(String censorType) {
        this.censorType = censorType;
    }
}
```

接口类中的方法和属性不要加任何修饰符号（public 也不要加），保持代码的简洁性，并加上有效的 Javadoc 注释。尽量不要在接口里定义变量，如果一定要定义变量，肯定是与接口方法相关，并且是整个应用的基础常量。

JDK8 中接口允许有默认实现，那么这个 default 方法，是对所有实现类都有价值的默认实现。

```java
// Good
void someMethod(); // 接口方法签名
String COMPANY = "weibo"; // 接口基础常量表示

// Ugly
public void someMethod();
```

接口和实现类有两套命名规则：

- 对于 Service 和 DAO 类，基于 SOA 的理念，暴露出来的服务一定是接口，内部的实现类用 Impl 的后缀与接口区别

```java
// Good
SegmentInfoService   // 接口
SegemntInfoServiceImpl  // 实现类

// Ugly
ISegmentInfoService // 接口
SegmentInfoService // 实现类
```

- 如果是形容能力的接口名称，取对应的形容词做接口名（通常是 \*able 的形式）。

```java
// Good
Translatable // 接口
AbstractTranslator implements Translatable // 实现类
```

### 代码格式

所有人使用统一的代码格式化工具，对代码进行格式化。避免在 MR 中出现不必要的 diff ，或者出现不必要的冲突。

代码格式化工具配置如下：

- 统一使用 [IntelliJ IDEA](https://www.jetbrains.com/idea/) 作为工作中的 JAVA IDE
- 代码格式化的配置采用默认的即可
- 按照如上方式配置好后，可以使用如下快捷键对代码进行格式化 ⌘ ⌥ L 或 ⌘ ⌥ ⇪ L。

线上工程代码必须通过 GitLab CI 接入 sornarQube 。 MR 中如果存在 bad smell 的 comment ，必须修复后，才允许 merge 入 master 。设置 GitLab CI 的方法如下：

- 在由 Maven 的进行构建的项目的根目录下，添加文件 `.gitlab-ci.yml` 。

内容如下：

```java
review:
  script:
    - code_analyze --preview
  except:
    - master
analyze:
  script:
    - code_analyze
  only:
    - master
```

只有一行的 if 语句块，必须通过 {} 进行包裹，不能省略。

```java
// Good
if (publishResult) {
    System.out.println("success");
}

// Ugly
if (publishResult)
    System.out.println("success");
    // 这样看此简洁了。 但在修改代码的时候，容易出现异常
    // 例如把 if 那一行删除了，代码编译依然通过的
    // 但实际业务上，就出现异常了
```

IDE 的 text file encoding 设置为 UTF-8；IDE中文件的换行符使用 Unix 格式，不要使用 Windows 格式。

方法体内的执行语句组、变量的定义语句组、不同的业务逻辑之间或者不同的语义之间插入一个空行。相同业务逻辑和语义之间不需要插入空行。

```java
// Good
private Map<Long, SegmentInfo> getSegmentInfoByIdBatch(List<Long> segmentIds) {
    Map<Long, SegmentInfo> segmentInfoMapResult = Maps.newHashMapWithExpectedSize(segmentIds.size());

    Map<Long, SegmentInfo> segmentInfoFromCache = segmentInfoCacheService.getSegmentInfoBach(segmentIds);

    // 筛选并从 DB 取
    List<Long> needQueryDb = segmentIds.stream().filter(segmentId -> segmentInfoFromCache.get(segmentId) == null).collect(Collectors.toList());
    Map<Long, SegmentInfo> segmentInfoFormDb = segmentInfoDao.getSegmentInfoByIdBatch(needQueryDb);

    // 回种
    segmentInfoCacheService.saveSegmentInfoList(segmentInfoFormDb.values());

    segmentInfoMapResult.putAll(segmentInfoFromCache);
    segmentInfoMapResult.putAll(segmentInfoFormDb);

    if (segmentIds.size() > segmentInfoMapResult.values().size()) {
        Collection notExistIds = CollectionUtils.subtract(segmentIds, segmentInfoMapResult.values());
        logger.warn("getSegmentInfoByIdBatch get from storage fail. ids {}", notExistIds);
    }

    return segmentInfoMapResult;
}

// Ugly
private Map<Long, SegmentInfo> getSegmentInfoByIdBatch(List<Long> segmentIds) {
    Map<Long, SegmentInfo> segmentInfoMapResult = Maps.newHashMapWithExpectedSize(segmentIds.size());
    Map<Long, SegmentInfo> segmentInfoFromCache = segmentInfoCacheService.getSegmentInfoBach(segmentIds);
    // 筛选并从 DB 取
    List<Long> needQueryDb = segmentIds.stream().filter(segmentId -> segmentInfoFromCache.get(segmentId) == null).collect(Collectors.toList());
    Map<Long, SegmentInfo> segmentInfoFormDb = segmentInfoDao.getSegmentInfoByIdBatch(needQueryDb);
    // 回种
    segmentInfoCacheService.saveSegmentInfoList(segmentInfoFormDb.values());
    segmentInfoMapResult.putAll(segmentInfoFromCache);
    segmentInfoMapResult.putAll(segmentInfoFormDb);
    if (segmentIds.size() > segmentInfoMapResult.values().size()) {
        Collection notExistIds = CollectionUtils.subtract(segmentIds, segmentInfoMapResult.values());
        logger.warn("getSegmentInfoByIdBatch get from storage fail. ids {}", notExistIds);
    }
    return segmentInfoMapResult;
}
```

### OOP 规约

避免通过一个类的对象引用访问此类的静态变量或静态方法，无谓增加编译器解析成本，直接用类名来访问即可。

```java
// Good
public class OwnerFactory {
    public static Owner getOwner();
}

OwnerFactory.getOwner();

// Ugly
OwnerFactory ownerFactory = new OwnerFactory();
ownerFactory.getOwner();
```

所有的覆写方法，必须加 `@Override` 注解。当对接口或抽象类的方法签名进行变更时，如果有 `@Override` 标示，其类的实现会编译报错。

```java
// Good
public interface GrayService {
     boolean isInGrayScope(long uid, GrayType grayType);
}

public GrayServiceImpl implements GrayService {
    @Override
    public boolean isInGrayScope(long uid, GrayType grayType) {
        return false;
    }
}

// Ugly
public GrayServiceImpl implements GrayService {
    public boolean isInGrayScope(long uid, GrayType grayType) {
        return false;
    }
}
```

外部正在调用或者二方库依赖的接口，不允许修改方法签名，避免对接口调用方产生影响。接口过时必须加 `@Deprecated` 注解，并清晰地说明采用的新接口或者新服务是什么。

不能使用过时的类或方法。

`java.net.URLDecoder` 中的方法 `decode(StringencodeStr)` 这个方法已经过时，应该使用双参数 `decode(String source,String encode)`。接口提供方既然明确是过时接口，那么有义务同时提供新的接口；作为调用方来说，有义务去考证过时方法的新实现是什么。

Object的 equals 方法容易抛空指针异常，应使用常量或确定有值的对象来调用 `equals` 。

推荐使用 `java.util.Objects#equals` (JDK7引入的工具类)

```java
// Good
"test".equals(object);

// Ugly
object.equals("test");
```

所有的相同类型的包装类对象之间值的比较，全部使用 equals 方法比较。 说明：对于 Integervar=? 在 -128 至 127 范围内的赋值，Integer 对象是在 IntegerCache.cache 产生，会复用已有对象，这个区间内的 Integer 值可以直接使用 == 进行判断，但是这个区间之外的所有数据，都会在堆上产生，并不会复用已有对象，推荐使用 equals 方法进行判断。

序列化类新增属性时，请不要修改 `serialVersionUID` 字段，避免反序列失败；如果完全不兼容升级，避免反序列化混乱，那么请修改 `serialVersionUID` 值。

`serialVersionUID`不一致会抛出序列化运行时异常。

POJO 类必须写 `toString` 方法。使用 IDE (IntelliJ IDEA) 的中工具：`Code -> Generate -> toString` 时，如果继承了另一个 POJO 类，注意在前面加一下 `super.toString` 。

在方法执行抛出异常时，可以直接调用 POJO 的 `toString()` 方法打印其属性值，便于排查问题。

```java
// Good
public class OwnerState {
   private long latestSegmentId;
   private int state;
   private long expireTime;

   @Override
   public String toString() {
       return "OwnerState{" +
               "latestSegmentId=" + latestSegmentId +
               ", state=" + state +
               ", expireTime=" + expireTime +
               '}';
   }
}
```

final 可以声明类、成员变量、方法、以及本地变量，下列情况使用 final 关键字:

- 不允许被继承的类，如: String 类
- 不允许修改引用的域对象，如: POJO 类的域变量
- 不允许被重写的方法，如: POJO 类的 setter 方法
- 不允许运行过程中重新赋值的局部变量
- 避免上下文重复使用一个变量，使用 final描述述可以强制重新定义一个变量，方便更好地进行重构

**类成员与方法访问控制从严**。任何类、方法、参数、变量，严控访问范围。过于宽泛的访问范围，不利于模块解耦。 思考：如果是一个 private 的方法，想删除就删除，可是一个 public 的 service 方法，或者一个 public 的成员变量，删除一下，不得手心冒点汗吗？变量像自己的小孩，尽量在自己的视线内，变量作用域太大，如果无限制的到处跑，那么你会担心的。

- 如果不允许外部直接通过 new 来创建对象，那么构造方法必须是 private
- 工具类不允许有 public 或 default 构造方法。
- 类非 static 成员变量并且与子类共享，必须是 protected
- 类非 static 成员变量并且仅在本类使用，必须是 private
- 类 static 成员变量如果仅在本类使用，必须是 private
- 若是 static 成员变量，必须考虑是否为 final
- 类成员方法只供类内部调用，必须是 private
- 类成员方法只对继承类公开，那么限制为 protected

### 注释

代码中的注释不必面面俱到，更多的情况是通过清晰的代码结构，和命名规范来“说明”代码的功能。

类、类属性、类方法的注释必须遵循 Javadoc 规范，使用 `/**内容*/` 格式，不得使用 `//xxx` 方式

```java
// Good
// 看下 java.utilMap#put 的注释
/**
 * Associates the specified value with the specified key in this map
 * (optional operation).  If the map previously contained a mapping for
 * the key, the old value is replaced by the specified value.  (A map
 * <tt>m</tt> is said to contain a mapping for a key <tt>k</tt> if and only
 * if {@link #containsKey(Object) m.containsKey(k)} would return
 * <tt>true</tt>.)
 *
 * @param key key with which the specified value is to be associated
 * @param value value to be associated with the specified key
 * @return the previous value associated with <tt>key</tt>, or
 *         <tt>null</tt> if there was no mapping for <tt>key</tt>.
 *         (A <tt>null</tt> return can also indicate that the map
 *         previously associated <tt>null</tt> with <tt>key</tt>,
 *         if the implementation supports <tt>null</tt> values.)
 * @throws UnsupportedOperationException if the <tt>put</tt> operation
 *         is not supported by this map
 * @throws ClassCastException if the class of the specified key or value
 *         prevents it from being stored in this map
 * @throws NullPointerException if the specified key or value is null
 *         and this map does not permit null keys or values
 * @throws IllegalArgumentException if some property of the specified key
 *         or value prevents it from being stored in this map
 */
V put(K key, V value);

// Ugly
// 向 map 中 put 一个 key value 的键值对
V put(K key, V value);
```

所有的抽象方法（包括接口中的方法）必须要用 Javadoc 注释、除了返回值、参数、异常说明外，还必须指出该方法做什么事情，实现什么功能。
$1- 对子类的实现要求，或者调用注意事项，请一并说明。

```java
// Good
见上一个 case
```

方法内部单行注释，在被注释语句上方另起一行，使用 `//` 注释。方法内部多行注释 使用`/* */`注释，注意与代码对齐。

所有的类都必须添加创建者和创建日期。

```java
// Good

/**
 * Created by donghai on 2017/6/7.
 */
public class StoryReadState implements Serializable {
}
```

修改代码的同时，必须修改对应的注释。避免出现注释与业务逻辑不符合代码。尤其是参数、返回值、异常、核心逻辑等的修改。

代码中暂时未完成 or 留待以后完成，需要通过 `//TODO` 进行注释 (标记人，标记时间，[预计处理时间]，待完成的内容)

```java
// Good
public List<User> listAllUser () {
    // TODO (xxx，2017.8.17，预计 2017.9.18 完成，获取所有的用户信息)
    return null;
}

// Ugly
public List<User> listAllUser () {
    return null; // 方法是一个空实现，没有说明，让人莫名其妙
}
```

代码中存在不工作的（存在问题的）代码，需要添加 `//Fixme`注释，（标记人，标记时间，[预计处理时间]，需要被 fix 的内容描述)

```java
// Good
public List<User> listAllUser () {
    // Fixme (xxx，2017.8.17，预计 2017.9.18 修复，此方法在“某种条件下”会参数NPE)
    return null;
}
```

被 Deprecated 类或方法，需要在Java doc中说明原因，并通过 `@see` 或者 `@link` 给出建议使用类或方法。

```java
// Good
/**
 * An opinionated {@link WebApplicationInitializer} to run a {@link SpringApplication}
 * from a traditional WAR deployment. Binds {@link Servlet}, {@link Filter} and
 * {@link ServletContextInitializer} beans from the application context to the servlet
 * container.
 * <p>
 * To configure the application either override the
 * {@link #configure(SpringApplicationBuilder)} method (calling
 * {@link SpringApplicationBuilder#sources(Object...)}) or make the initializer itself a
 * {@code @Configuration}. If you are using {@link SpringBootServletInitializer} in
 * combination with other {@link WebApplicationInitializer WebApplicationInitializers} you
 * might also want to add an {@code @Ordered} annotation to configure a specific startup
 * order.
 * <p>
 * Note that a WebApplicationInitializer is only needed if you are building a war file and
 * deploying it. If you prefer to run an embedded container then you won't need this at
 * all.
 *
 * @author Dave Syer
 * @author Phillip Webb
 * @author Andy Wilkinson
 * @see #configure(SpringApplicationBuilder)
 * @deprecated as of 1.4 in favor of
 * {@link org.springframework.boot.web.support.SpringBootServletInitializer}  // 明确的说明从哪个版本被 deprecated 并提供了替代的方案
 */
@Deprecated
public abstract class SpringBootServletInitializer
        extends org.springframework.boot.web.support.SpringBootServletInitializer {
}

// Ugly
@Deprecated  // 没有任何说明，也没有给使用方替代的方案
public abstract class SpringBootServletInitializer
        extends org.springframework.boot.web.support.SpringBootServletInitializer {
}
```

## 可维护

### 集合操作

#### 构建

集合类除了构建过程中可以使用具体类，其它地方应该使用接口，而不是具体实现类。

```java
// Good
List<E> list = new ArrayList<E>();

// Ugly
ArrayList<E> list = new ArrayList<E>();
```

空集使用 `Collections.emptyXXX()` 等方法构建，不应该使用 `new ArrayList()` 这类的方式构建，除非后面可能会往这个集合中添加元素。

```java
// Good
List<E> empty = Collections.emptyList();
Set<E> empty = Collections.emptySet();
Map<K, V> empty = Collections.emptyMap();

List<E> possibleEmpty = new ArrayList<E>();
if (meetSomeCondition) {
   possibleEmpty.add(element);
}

// Bad
List<E> possibleEmpty = Collections.emptySet();
if (meetSomeCondition) {
   possibleEmpty.add(element); // exception
}

// Ugly
List<E> empty = new ArrayList<E>();
Set<E> empty = new HashSet<E>();
```

单例的集合使用 `Collections.singletonXXX(element)` 的方式表示，不应该使用构建一个普通集合，再往里面添加一个元素。

```java
// Good
List<E> singleton = Collections.singletonList(element);
Set<E> singleton = Collections.singleton(element);

// Ugly
List<E> singleton = new ArrayList<E>();
singleton.add(element);

Set<E> singleton = new HashSet<E>();
singleton.add(element);
```

需要指定容量的类型，在可以预知容量的时候，必需指定初始容量，避免添加元素的时候有扩容导致的开销。

```java
// Good
Collection<E> collection = new ArrayList<E>(expectedCapacity);
```

可能会被多个线程同时更新和查询的集合需要使用有并发支持的实现。不然并发访问的时候可能会出现意外的业务逻辑错误，死锁，抛异常等情况。

```java
// Good
Map<K, V> concurrentMap = new ConcurrentHashMap<>();
Map<K, V> concurrentMap = Collections.synchronizedMap(new HashMap<K, V>());
List<E> concurrentList = new Vector<>();
List<E> concurrentList = Collections.synchronizedList(new ArrayList<E>());
Set<E> concurrentSet = Collections.newSetFromMap(new Map<E,Boolean>());
Set<E> concurrentSet = Collections.synchronizedSet(new HashSet<E>());

// Bad
Map<K, V> concurrentMap = new HashMap<>();
List<E> concurrentMap = new ArrayList<>();
Set<E> concurrentSet = new HashSet<>());
```

#### 元素

集合中的元素如果是自定义的类型，该类需要同时实现 `hashCode()` 和 `equals(Object)` 方法，定义业务级两个对象判断相同的条件。如果没有定义这两个方法，则会以是否为同一个 Java 对象作为判断是否相同的条件，大多数情况下它们都与期望的业务逻辑不同。

foreach 循环的时候，不做元素删除的操作，这样会导致 `ConcurrentModificationException` 。需要使用显示的迭代器删除，或者使用 Java8 中的 `removeIf(Predicate)` 方法。

```java
// Good
for (Iterator<E> it = collection.iterator; it.hasNext();) {
    E element = it.next();
    if (notExpected(element)) {
        it.delete();
    }
}

// correct in java 8
collection.removeIf(element -> notExpected(element));

// Bad
for (E element: collection) { // exception
    if (notExpected(element)) {
        collection.delete(condition);
    }
}
```

使用 `collection.isEmpty()` 方法判断集合为空，不应该用 `collection.size() == 0` 判断，因为 `size()` 方法对某些实现类可能是有较大开销的。

```java
// Good
if (collection.isEmpty()) ...

// Bad
if (collection.size() == 0) ...
```

不能向方法参数中传递进来的集合中添加元素，或从中删除元素。因为传进来的集合可能是不支持更改的。除非方法有明确的文档说明，规定入参的集合必需是可更改的。

```java
// Bad
void method(List<E> list) {
   // ...
   list.add(element);
   list.remove(anotherElement);
   // ...
}
```

尽量不添加 `null` 。有些集合实现不支持将 `null` 作为元素或 key 或 value 的，当尝试加入的时候，则会抛出 `NullPointerException` 。需要放 `null` 的时候，需要上下文中能推断出来相应的集合支持 `null` （这种方式不推荐，因为我们希望使用时基于接口，而不基于实现）。

### 并发

#### 线程

同类线程需要不止一个时，不允许手动创建线程，应该使用线程池。线程池可以控制线程的数量，避免创建了过多的线程。

```java
// Good
executorService.submit(task);

// Ugly
new Thread(task).start();
```

创建线程的时候需要给一个合适的名称，方便日志中查看。建议使用 `commons-lang` 包中的 `BasicThreadFactory` 类生成线程。

```java
// Good
ThreadFactory baseThreadFactory;
ThreadFactory factory = new BasicThreadFactory.Builder()
    .wrappedFactory(baseThreadFactory)
    .namingPattern("xxx-pool-%d") // set a custom name for thread
    .build();
```

定时任务使用 `ScheduledExecutorService` 来设置，不使用 `sleep` 的方式来实现，因为 `sleep` 会使占用线程。

```java
// Good
scheduledExecutorService.schedule(task, delay, timeUnit);

// Ugly
Thread.sleep(timeUnit.toMillis(delay), delay);
task.run();
```

#### 竞争

尽量减小竞争资源的使用，无法避免时，应该将减小临界区的粒度。能用无锁数据结构，就不要用锁；能锁区块，就不要锁整个方法体；能用对象锁，就不要用类锁；能用共享锁，就不要用互斥锁。

```java
// Good
ElemType[] snapshot;
synchronized (collection) {
    elemArray = collection.toArray(new ElemType[collection.size()]);
}
for (ElemType elem: snapshot) {
    heavyProcess(elem);
}

// Bad
synchronized (collection) {
    for (ElemType elem: collection) {
        heavyProcess(elem);
    }
}
```

使用锁的时候，锁必须在 `finally` 块中释放，确保释放成功。

```java
// Good
Lock lock = myLock();
lock.acquire();
try {
    // do something
} finally {
    lock.release();
}

// Bad
Lock lock = myLock();
lock.acquire();
// do something
// ...
// when codes here throws exception, then the lock may be not released.
lock.release();
```

单例或者类似单例的对象，可能会被多个线程同时访问时，如果方法执行过程会改变对象的内部状态，那么这些方法需要加上 `synchronized` 关键字。

```java
// Good
public synchronized void someMethod() {
    // ....
    this.list.add(element)
    // ....
}

// Bad
public void someMethod() {
    // ....
    this.list.add(element)
    // ....
}
```

`SimpleDateFormat` 是没有线程安全保证的，当需要使用 `SimpleDateFormat` 格式化日期或者解析日期的时候，最好使用 `ThreadLocal` 的方式提供。

```java
// Good
// field declare
ThreadLocal<DateFormat> localDateFormat = ThreadLocal.init(() -> new SimpleDateFormat("yyyy-MM-dd"));

// Bad
DateFormat format = new SimpleDateFormat("yyyy-MM-dd");
```

当多线程都需要使用 `Random` 的时候，使用 `ThreadLocalRandom` 的实现。 `Random` 的每次调用都会竞争该对象持有的 `seed` ，导致性能下降。

#### 资源

当数据写进 `db`、`redis` 之后，不要立即从从库中读取值。建议直接使用内存用于更新的值。如果一定需要从 `db` 或者 `redis` 中读取一个值，则考虑从主库中读取。

在主从结构中，数据写到主库以后，从库中的数据不会立即更新，而是有一个同步延迟。如果更新完，立马尝试从从库中读取数据的时候，则可能会读到老的数据，而不是刚更新的数据。这样就会发生主从同步问题。

有缓存的系统中，将 `db` 设置新值后，建议缓存中设置一个短缓存（有效期只有几秒钟）。

只是删除缓存的话，如果更新过程中，有别的线程尝试读数据时，则可能会从从库中的读到老数据，并回种到缓存中，造成脏数据。

直接将新值作为一个长缓存设置到缓存中的话，如果有两个并发的更新同时发生的时候，有可能缓存中最后保留的不是最终的更新结果。

### 模块划分

1. 按层次分：`web` / `service` / `storage`，各自组织成一个模块。
2. 有些实用类，包括业务逻辑，需要在项目内共用，要提出来做为单独的模块。
3. 避免重复的模块，比如同时有 `util` 和 `tool` 模块。

### 单元测试

#### 概论

单元测试的作用是测试被测单元的逻辑。即当某些条件发生时的外在表现，不关心如果内部实现的机制。所以写测试用例的时候，需要明确被测方法的边界，然后才能明确验证点。

测试用例需要达到以下目标

- 覆盖了被测单元的主要逻辑和一些边界条件
- 错误信息容易理解，方便辅助排查被测代码中问题
- 测试逻辑易读易理解

测试用例一般的书写套路（三段式）

- `Mock`：设定各种前提条件
- `Invoke`：调用被测方法
- `Verify`：验证

测试工具：

- JUnit, TestNG, Spock
- Mock 工具：EasyMock, Mockito, PowerMock, Spock

#### 范围

私有方法不写单元测试，私有方法的逻辑需要通过公有方法的单测覆盖。因为私有方法可以理解为是非私有方法的实现机制的一部分，而不是外在表现的一部分

```groovy
public String greeting(String name) {
    return "hello, " + getNickname(name);
}

private String getNickname(String fullname) {
    int index = fullname.indexOf(" ");
    if (index > 0)
        return fullname.subString(0, index);
    else
        return fullname;
}

// only test greeting method
// logic of getNickname method should be included in the greeting case.
def "greeting should say hello with nickname"() {
    expect:
    greeting(fullname) == words

    where:
    fullname       | words
    "Jim Cook"     | "hello, Jim"
    "Tom"          | "hello, Tom"
    "Isaac Newton" | "hello, Isaac"
}
```

测试用例的范围只包含当前类中，当前方法会调用到的代码。不包含当前类之外的代码（使用到 `HashMap` 这类的工具的情况除外）

```java
class Observable {
    public void notify(Object msg) {
        getListeners().foreach(listener -> listener.accept(this, msg));
    }
}

class Listener {
    public void accept(Observable obs, Object msg) {
        mcClient.set("xxx", msg);
    }
}
```

比如对于上面的代码，应该分别为它们各自写单元测试：

1. 对于 `Observable` ，单元测试验证 `notify` 消息的时候，每个 `listener` 都能收到该消息。
2. 对于 `Listener` ，应该验证收到消息的时候，会将消息种到 MC 中。

但是不能它们只写一个单元测试，验证 `Observable` 上 `notify` 消息的时候，该消息会被写到 MC 中。这不是 `单元测试` ，而是 `集成测试`！

单元测试对外的依赖，应该使用 Mock 来完成，不依赖于具体实现。

```groovy
def "test XxxService"() {
   setup:
   def xxxStorage = Mock(XxxStorage)
   def xxxService = new XxxService(storage: xxxStorage)
   // ...
}
```

单元测试不应该依赖外部资源，需要做到能在任何地方执行。

```groovy
// Good
def "test storage"() {
    setup:
    def jdbc = Mock(Jedis)
    // ...
}

// Bad
def "test storage"() {
    setup:
    def redis = new Jedis("localhost")
    // ...
}
```

#### 测试内容

测试用例的方法名需要能表达测试的意图

```groovy
// Bad
def "test myMethod"() {}

// Good, tell the condition and the corresponding action
def "myMethod will ... when ..."() {}

// Good, specification style
// list cases of this condition, and specify each action
def "myMethod when ..."() {}
```

测试用例不打印日志，测试是否通过使用 `assert` 来验证。但是允许业务代码打日志；当日志中有异常栈，但 `assert` 没有报异常的时候，认为单测没有问题。

`assert` 验证可以实现用例的自动化回归。打印的日志必须肉眼才能看明白。

```groovy
// Good
def "test sum"() {
    expect:
    2 == 1 + 1
}

// Bad
def "test sum"() {
    def sum

    when:
    sum = 1 + 1

    then:
    print sum
}
```

测试用例之间不要相互影响，避免并发执行的时候不必要的错误。

比如两个用例共享了同一个变量，一个用例做了一系列操作之后要验证该变量值的时候，并发跑的另一个用例可能会改了这个变量的值，从而导致验证失败。

```groovy
// Bad. the following test1 and test2 will affect each other
class MyTest extends Specification {
    static List list = [] // the same list for each test case

    def test1() {
        when:
        list << new Object()

        then:
        !list.empty // this line may fail
    }

    def test2() {
        when:
        list.clear()
        // ...
    }
}
```

## 可发布

### 日志

统一使用 SLF4J 框架获得 logger ，代码里不应该直接依赖 log4j、commons-logging 等日志框架。

```java
// Good
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
private static final Logger logger = LoggerFactory.getLogger(Abc.class);
```

在代码中合理使用日志级别：

- debug : 所有详细信息，用于 VIP 用户的问题排查
- info : 提示一切正常，不需要干预
- warn : 记录一下某事又发生了，warn 日志量突增需要立刻排查
- error : 可能有 bug，需要立刻排查

使用占位符方式打印日志，代码可读性更强，并且能够避免字符串拼接造成无谓的性能损耗。

```java
// Good
logger.debug("handleMessage with id: {}", id);

// Ugly
logger.debug("handleMessage with id: " + id);
```

日志中不同数据之间使用符号分隔（建议逗号），方便后续使用脚本进行日志统计精确匹配字段。

```java
// Good
logger.debug("handleMessage with id: {}, symbol : {} ", id, symbol);

// Ugly
logger.debug("handleMessage: {} {}", id, symbol);
```

日志中需要打印上下文信息，如 uid ，业务 id ，其他参数等，无上下文的日志对于问题分析来说没有意义。

```java
// Good
logger.debug("handleMessage with uid:{}, messageId: {} ", uid, id);

// Ugly
logger.debug("handleMessage success");
```

捕获非预期异常后需要打 error 级别日志并打出异常栈，方便后续排查问题。

```java
// Good
catch(Exception e){
  logger.error("handleMessage exception uid:{}",uid, e);
}

// Ugly
catch(Exception e){
  logger.error("handleMessage exception uid:{}",uid);
}
```

捕获预期异常（如参数校验错误、业务处理失败等有明确抛出异常的位置，不需要进一步排查）时，不需要打出异常栈，避免异常日志刷屏。

```java
// Good
catch(WeiboMessageException e){
    logger.warn("handleMessage exception uid:{}, errorType:{}, message:{}",uid, e.getClass().getSimpleName(), e.getMessage());
}

// Ugly
catch(WeiboMessageException e){
    logger.warn("handleMessage exception uid:{}", uid, e);
}
```

所有外部调用的请求及返回应当打印 info 或 debug 日志，避免出现异常后无法排查问题。

### 异常处理

执行长期任务的线程（如队列处理线程）需要在最外围捕获 Throwable，避免线程崩溃后无法排查原因。

```java
// Good
while (true) {
    try {
        // do something
    } catch (Throwable t) {
        logger.error("handle message throws throwable", t);
    }
}

// Bad
while(true){
    try {
        // do something
    } catch(Exception t) { // 出现 Stack Overflow 等特殊情况时线程会崩溃，难以排查问题
        logger.error("handle message throws exception", e);
    }
}
```

## 可扩展

### 结构设计
