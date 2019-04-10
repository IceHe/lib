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

- Difference between maven scope compile and provided for JAR packaging - Stack Overflow : https://stackoverflow.com/questions/6646959/difference-between-maven-scope-compile-and-provided-for-jar-packaging

Differ `provided` from `compile`

- dependencies are **not transitive** (as you mentioned)
- provided scope is **only available on the compilation and test classpath**, whereas compile scope is available in all classpaths.
- provided dependencies are **not packaged**
