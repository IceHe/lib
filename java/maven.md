# Maven

References

- Official Website : https://maven.apache.org/
    - **Maven in 5 Minutes** : http://maven.apache.org/guides/getting-started/maven-in-five-minutes.html
    - **POM Reference** : http://maven.apache.org/pom.html

Maven

- A software profject management & comprehension tool ( not Pacakge Management ! )
- based on a POM (project object model)
- including project's build, reporting & documentation

Book :

- 《Maven 实战》( Maven 3 in Action 中文版 )

Related tool :

- Gradle

## Temp Notes

### Add Dependecy

- IntelliJ: `⌘ n` in file `pom.xml` >> choose `dependency`
- Then, enable `Maven Auto Import`
- `Topbar` (taskbar) >> `Code` >> `Generate…`

#### Config File

- Config file : `.m2/settings.xml`
- One of mirrors : https://mvnrepository.com/artifact/org.springframework.boot/spring-boot-starter-parent/2.0.1.RELEASE

### Scope

#### provided

References

- Maven - Introduction to the Dependency Mechanism : https://maven.apache.org/guides/introduction/introduction-to-dependency-mechanism.html
- Difference between maven scope compile and provided for JAR packaging - Stack Overflow : https://stackoverflow.com/questions/6646959/difference-between-maven-scope-compile-and-provided-for-jar-packaging

Differ `provided` from `compile`

- dependencies are **not transitive** (as you mentioned)
- provided scope is **only available on the compilation and test classpath**, whereas compile scope is available in all classpaths.
- provided dependencies are **not packaged**

##### Differences

References

- difference between maven compile and provided scope (Other Build Tools forum at Coderanch) : https://coderanch.com/t/502091/build-tools/difference-maven-compile-scope

Compile means that you need the JAR for compiling and running the app. For a web application, as an example, the JAR will be placed in the WEB-INF/lib directory.

Provided means that you need the JAR for compiling, but at run time there is already a JAR provided by the environment so you don't need it packaged with your app. For a web app, this means that the JAR file will not be placed into the WEB-INF/lib directory.

For a web app, if the app server already provides the JAR (or its functionality), then use "provided" otherwise use "compile".

### Resolve Package Conflictions

References

- maven依赖jar包时版本冲突的解决 : https://blog.csdn.net/sinat_39789638/article/details/78005945

### Install an Artifact to Local Repository

References

- How to add local jar files to a Maven project? - Stack Overflow : https://stackoverflow.com/questions/4955635/how-to-add-local-jar-files-to-a-maven-project

```bash
mvn install:install-file \
   -Dfile=<path-to-file> \
   -DgroupId=<group-id> \
   -DartifactId=<artifact-id> \
   -Dversion=<version> \
   -Dpackaging=<packaging> \
   -DgeneratePom=true

# e.g.
mvn install:install-file \
    -Dfile=icehe-sdk-1.0.0-20200604.105923-1.jar \
    -DgroupId=xyz.icehe \
    -DartifactId=icehe-sdk \
    -Dversion=1.0.0-SNAPSHOT \
    -Dpackaging=jar \
    -DgeneratePom=true
```

### Others

试错经验

- 子模块不要写变量, 显式写明 version
- plugin 写 deply `<configuration><deploy>true</deploy></configuration>` 结果跳过了部署……
- 依赖排错命令 mvn dependency:list/tree/analyze
