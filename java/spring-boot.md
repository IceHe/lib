# Spring Boot

- <https://projects.spring.io/spring-boot/>
- <https://spring.io/guides/gs/rest-service>
- <https://spring.io/guides/gs/relational-data-access/>
- <https://spring.io/guides/gs/accessing-data-mysql/>
- <https://spring.io/guides/gs/messaging-redis/>
    (dizzy: I don't realize how it works.)
- <https://spring.io/guides/gs/spring-boot-docker/>
    (undone: Target is irrelevant.)

Others: [Getting Started Guides](https://spring.io/guides)

## Keywords

Tomcat : HTTP Server ?
Jetty ?
Undertow ?

Maven : A software profject management & comprehension tool ( not Pacakge Management ! )
    based on a POM (project object model)
    including project's build, reporting & documentation

Gradle ?

starts.spring.io ?

## Links (Refs)

- Ref Guide: https://docs.spring.io/spring-boot/docs/current-SNAPSHOT/reference/htmlsingle/
    - How To: https://docs.spring.io/spring-boot/docs/current-SNAPSHOT/reference/htmlsingle/#howto
    - Get Started: https://docs.spring.io/spring-boot/docs/current-SNAPSHOT/reference/htmlsingle/#getting-started

Spring Initializer: https://start.spring.io/

## Maven

Project Structure:

- src/main/java/hello/HelloWorld.java
- target
    - classes/hello/HelloWorld.class
    - maven-status
        - `*.jar`
        - `original-*.jar`
        - ...
- pom.xml

``` sh
brew install maven
mvn -v

# after creating pom.xml
mvn compile
mvn package

TODO: <https://spring.io/guides/gs/maven/#_declare_dependencies>
```

## Install JDK

- Download JDK from Oracle official site.
    <http://www.oracle.com/technetwork/java/javase/downloads/jdk10-downloads-4416644.html>
- Install by `*.dmg`
- Find it in `/Library/Java/JavaVirtualMachines/jdk*.jdk/*`

## Write a Test

TODO

## Add Dependecy

IntelliJ: `⌘ n` in file 'pom.xml' -> choose 'dependency'
( Then, enable 'Maven Auto Import' )
( Topbar(taskbar) -> Code -> Generate… )

### Command Line

It isn't a good idea.
<https://maven.apache.org/guides/mini/guide-3rd-party-jars-local.html>

### Maven

- path `.m2/settings.xml`
- mirrors: <https://mvnrepository.com/artifact/org.springframework.boot/spring-boot-starter-parent/2.0.1.RELEASE>

## Run Spring Boot Project

- install mvnw <http://www.baeldung.com/maven-wrapper>
- `./mvnw clean package` then `java -jar target/*.jar`
    - or `./mvnw spring-boot:run`

## Manipulate DB

### MySQL

- MySQL Create User
    - `mysql -u root -p`
    - `GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' IDENTIFIED BY 'password';`
    - `create user 'springuser'@'localhost' identified by 'ThePassword';`
    - IF 'Cannot load from mysql.procs_priv. The table is probably corrupted': `mysql_upgrade -u root -p`

## Redis

TODO
