# JMH

> Java Microbenchmark Harness
>
> JMH is developed by the same people who implement the Java virtual machine, so these guys know what they are doing.

References

- Java Performace - JMH : http://tutorials.jenkov.com/java-performance/jmh.html
- Code Tools - jmh : http://openjdk.java.net/projects/code-tools/jmh/
- 使用JMH实现性能测试 : https://xnslong.github.io/blog/#/tools/java/JMH-benchmarking

Others

- 接口性能测试方案 白皮书 V1.0 : https://blog.csdn.net/hexieshangwang/article/details/47186507

## Usage

```bash
# Create Project
 mvn archetype:generate \
    -DinteractiveMode=false \
    -DarchetypeGroupId=org.openjdk.jmh \
    -DarchetypeArtifactId=jmh-java-benchmark-archetype \
    -DgroupId=xyz.icehe \
    -DartifactId=first-benchmark \
    -Dversion=1.0

# Compile
mvn clean package
# or ?
mvn clean install

# Run
java -jar target/benchmarks.jar
```