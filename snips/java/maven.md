# Maven

Maven : https://maven.apache.org/

- A software profject management & comprehension tool ( not Pacakge Management ! )
- based on a POM (project object model)
- including project's build, reporting & documentation

Related tool : Gradle

## Add Dependecy

- IntelliJ: `⌘ n` in file `pom.xml` >> choose `dependency`
- Then, enable `Maven Auto Import`
- `Topbar` (taskbar) >> `Code` >> `Generate…`

## Config

- config file : `.m2/settings.xml`
- one of mirrors : https://mvnrepository.com/artifact/org.springframework.boot/spring-boot-starter-parent/2.0.1.RELEASE

## provided

References

- Maven - Introduction to the Dependency Mechanism : https://maven.apache.org/guides/introduction/introduction-to-dependency-mechanism.html
- Difference between maven scope compile and provided for JAR packaging - Stack Overflow : https://stackoverflow.com/questions/6646959/difference-between-maven-scope-compile-and-provided-for-jar-packaging

Differ `provided` from `compile`

- dependencies are **not transitive** (as you mentioned)
- provided scope is **only available on the compilation and test classpath**, whereas compile scope is available in all classpaths.
- provided dependencies are **not packaged**

### Differences

Compile means that you need the JAR for compiling and running the app. For a web application, as an example, the JAR will be placed in the WEB-INF/lib directory.

Provided means that you need the JAR for compiling, but at run time there is already a JAR provided by the environment so you don't need it packaged with your app. For a web app, this means that the JAR file will not be placed into the WEB-INF/lib directory.

For a web app, if the app server already provides the JAR (or its functionality), then use "provided" otherwise use "compile".

References

- difference between maven compile and provided scope (Other Build Tools forum at Coderanch) : https://coderanch.com/t/502091/build-tools/difference-maven-compile-scope
