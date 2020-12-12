# mvn

Maven : a tool used for building and managing any Java-based project

---

Maven is essentially a project management and comprehension tool and as such provides a way to help with managing:

- Builds
- Documentation
- Reporting
- Dependencies
- SCMs
- Releases
- Distribution

Synopsis

```bash
usage: mvn [options] [<goal(s)>] [<phase(s)>]
```

## Quickstart

```bash
mvn clean   # 清理
mvn compile # 编译
mvn test    # 单测
mvn package # 打包
mvn install # 安装 ( 到本地仓库 )
mvn deploy  # 部署 ( 到远端仓库 )

# 手动下载 jar 包后, 安装到本地仓库
mvn install:install-file \
    -Dfile=test-artifact-1.0.0.jar \
    -DgroupId=xyz.icehe \
    -DartifactId=test-artifact \
    -Dversion=1.0.0 \
    -Dpackaging=jar \
    -DgeneratePom=true

# 手动下载源码 jar 包, 安装到本地仓库
mvn install:install-file \
    -Dfile=test-artifact-1.0.0-sources.jar \
    -DgroupId=xyz.icehe \
    -DartifactId=test-artifact \
    -Dversion=1.0.0 \
    -Dclassifier=sources \
    -Dpackaging=jar \
    -DgeneratePom=true
```

## Options

<!--
Format Regex

```bash
# join text from `man command`
\n^ {2,}(.*$)
 $1

# rewrite headers of options
^ (\S*( <\S+>)?) +(.*)$
- `$1` $2
```
-->

References

- Maven Embedder - Maven CLI Options Reference : http://maven.apache.org/ref/3.6.1/maven-embedder/cli.html

Details

- `-am,--also-make` If project list is specified, also build projects required by the list
- `-amd,--also-make-dependents` If project list is specified, also build projects that depend on projects on the list
- **`-B,--batch-mode` Run in non-interactive (batch) mode (disables output color)**
- `-b,--builder <arg>` The id of the build strategy to use
- `-C,--strict-checksums` Fail the build if checksums don't match
- `-c,--lax-checksums` Warn if checksums don't match
- `-cpu,--check-plugin-updates` Ineffective, only kept for backward compatibility
- **`-D,--define <arg>` Define a system property**
- **`-e,--errors` Produce execution error messages**
- `-emp,--encrypt-master-password <arg>` Encrypt master security password
- `-ep,--encrypt-password <arg>` Encrypt server password
- **`-f,--file <arg>` Force the use of an alternate POM file (or directory with pom.xml)**
- **`-fae,--fail-at-end` Only fail the build afterwards; allow all non-impacted builds to continue**
- **`-ff,--fail-fast` Stop at first failure in reactorized builds**
- `-fn,--fail-never` NEVER fail the build, regardless of project result
- `-gs,--global-settings <arg>` Alternate path for the global settings file
- `-gt,--global-toolchains <arg>` Alternate path for the global toolchains file
- `-h,--help` Display help information
- **`-l,--log-file <arg>` Log file where all build output will go (disables output color)**
- `-llr,--legacy-local-repository` Use Maven 2 Legacy Local Repository behaviour, ie no use of _remote.repositories.
    - Can also be activated by using -Dmaven.legacyLocalRepo=true
- `-N,--non-recursive` Do not recurse into sub-projects
- `-npr,--no-plugin-registry` Ineffective, only kept for backward compatibility
- `-npu,--no-plugin-updates` Ineffective, only kept for backward compatibility
- `-nsu,--no-snapshot-updates` Suppress SNAPSHOT updates
- `-o,--offline` Work offline
- `-P,--activate-profiles <arg>` Comma-delimited list of profiles to activate
- `-pl,--projects <arg>` Comma-delimited list of specified reactor projects to build instead of all projects.
    - A project can be specified by [groupId]:artifactId or by its relative path
- `-q,--quiet` Quiet output - only show errors
- `-rf,--resume-from <arg>` Resume reactor from specified project
- **`-s,--settings <arg>` Alternate path for the user settings file***
- `-t,--toolchains <arg>` Alternate path for the user toolchains file
- **`-T,--threads <arg>` Thread count, for instance 2.0C where C is core multiplied**
- **`-U,--update-snapshots` Forces a check for missing releases and updated snapshots on remote repositories**
- `-up,--update-plugins` Ineffective, only kept for backward compatibility
- `-v,--version` Display version information
- `-V,--show-version` Display version information WITHOUT stopping build
- **`-X,--debug` Produce execution debug output**

## Referneces

Maven - Maven Documentation ( guides/index ) : https://maven.apache.org/guides/index.html

- Maven - Maven in 5 Minutes : https://maven.apache.org/guides/getting-started/maven-in-five-minutes.html
- Maven - Maven Getting Started Guide ( in 30 min ) : https://maven.apache.org/guides/getting-started/index.html

## Basics

### Project Layout

```text
my-app
|-- pom.xml
`-- src
    |-- main
    |   `-- java
    |       `-- com
    |           `-- mycompany
    |               `-- app
    |                   `-- App.java
    `-- test
        `-- java
            `-- com
                `-- mycompany
                    `-- app
                        `-- AppTest.java
```

- Application sources reside in `${basedir}/src/main/java`
- and test sources reside in `${basedir}/src/test/java`,
    - where `${basedir}` represents the directory containing `pom.xml`.

### Phases

These are the most common default lifecycle phases executed.

- `validate`: validate the project is correct and all necessary information is available
- **`compile`**: compile the source code of the project
- **`test`**: test the compiled source code using a suitable unit testing framework.
    - These tests should not require the code be packaged or deployed
- **`package`**: take the compiled code and **package it in its distributable format, such as a JAR**.
- `integration-test`: process and deploy the package if necessary into an environment where integration tests can be run
- `verify`: run any checks to verify the package is valid and meets quality criteria
- **`install`**: **install the package into the local repository**, for use as a dependency in other projects locally
- **`deploy`**: done in an integration or release environment, **copies the final package to the remote repository** for sharing with other developers and projects.

There are two other Maven lifecycles of note beyond the default list above. They are

- **`clean`**: cleans up artifacts created by prior builds
- `site`: generates site documentation for this project

Phases are actually mapped to underlying goals. The specific goals executed per phase is dependant upon the packaging type of the project. For example,

- package executes `jar:jar` if the project type is a JAR,
- and `war:war` if the project type is - you guessed it - a WAR.

## Usage

### archetype:generate

Create a Project via archetype mechanism

```bash
mvn archetype:generate \
    -DgroupId=com.mycompany.app \
    -DartifactId=my-app \
    -DarchetypeArtifactId=maven-archetype-quickstart \
    -DarchetypeVersion=1.4 \
    -DinteractiveMode=false
```

- The prefix `archetype` is the plugin that provides the goal.
- It created a simple project based upon a `maven-archetype-quickstart` archetype.
- Suffice it to say for now that **a plugin is a collection of goals** with a general common purpose.

#### pom.xml

Configuration file

```xml
<project xmlns="http://maven.apache.org/POM/4.0.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:schemaLocation="http://maven.apache.org/POM/4.0.0
                      http://maven.apache.org/xsd/maven-4.0.0.xsd">
  <modelVersion>4.0.0</modelVersion>
  <groupId>com.mycompany.app</groupId>
  <artifactId>my-app</artifactId>
  <packaging>jar</packaging>
  <version>1.0-SNAPSHOT</version>
  <name>Maven Quick Start Archetype</name>
  <url>http://maven.apache.org</url>
  <dependencies>
    <dependency>
      <groupId>junit</groupId>
      <artifactId>junit</artifactId>
      <version>4.11</version>
      <scope>test</scope>
    </dependency>
  </dependencies>
</project>
```

- `packaging` : …… The default value for the `packaging` element is **JAR** so you do not have to specify this for most projects.
- `version` …… you will often see the `SNAPSHOT` designator in a version, which indicates that a project is **in a state of development**.
    - The `SNAPSHOT` value refers to the '**latest**' code along a development branch, and provides no guarantee the code is stable or unchanging.
    - Conversely, the code in a '**release**' version (any version value without the suffix SNAPSHOT) is **unchanging.
    - In other words, a `SNAPSHOT` version is the 'development' version before the final 'release' version.

#### compile

Compile application sources

```bash
mvn compile
```

- The compiled classes were placed in `${basedir}/target/classes`.

Phase

- Rather than a goal, `compile` is a phase.
- **A phase is a step in the build lifecycle**, which is an ordered sequence of phases.

If we execute the `compile` phase, the phases that actually get executed are:

- validate
- generate-sources
- process-sources
- generate-resources
- process-resources
- compile

#### test

Compile test sources & Run unit tests

```bash
mvn test

# just compile test sources (do not executes tests)
mvn test-compile
```

#### package

Build the Project : Create JAR & Install in local repository

```bash
mvn package
```

- Install the artifact you've generated (the JAR file by default)
    - in local repository `${user.home}/.m2/repository` (the default location)

_Test the newly compiled and packaged JAR_ ~

```bash
# e.g.
java -cp target/my-app-1.0-SNAPSHOT.jar com.mycompany.app.App
```

#### Execute in sequence

An interesting thing to note is that phases and goals may be executed in sequence.

```bash
mvn clean dependency:copy-dependencies package
```

This command will clean the project, copy dependencies, and package the project (executing all phases up to package, of course).

## Resources

### Add

Maven relies on the **Standard Directory Layout** for adding resources. ( standard Maven conventions )

 <!-- which means by using standard Maven conventions you can package resources within JARs simply by placing those resources in a standard directory structure. -->

<!-- We have added the directory `${basedir}/src/main/resources` into which we place any resources we wish to package in our JAR. -->

The simple rule :

- any directories or files placed within the `${basedir}/src/main/resources` directory are packaged in your JAR with the exact same structure starting at the base of the JAR.

Project Layout with resources

```text
my-app
|-- pom.xml
`-- src
    |-- main
    |   |-- java
    |   |   `-- com
    |   |       `-- mycompany
    |   |           `-- app
    |   |               `-- App.java
    |   `-- resources
    |       `-- META-INF
    |           `-- application.properties
    `-- test
        `-- java
            `-- com
                `-- mycompany
                    `-- app
                        `-- AppTest.java
```

File Layout in JAR ( unpacked )

```text
my-app.jar
|-- META-INF
|   |-- MANIFEST.MF
|   |-- application.properties
|   `-- maven
|       `-- com.mycompany.app
|           `-- my-app
|               |-- pom.properties
|               `-- pom.xml
`-- com
    `-- mycompany
        `-- app
            `-- App.class
```

### Filter

References

- Maven - Maven Getting Started Guide : https://maven.apache.org/guides/getting-started/index.html#How_do_I_filter_resource_files

> **Important** : Please RTFM carefully!

- RTFM : READ The Fucking Manual

#### Define properties

Where to define :

- In external file
    - The `filters` filter the `resources` ( **filtring** ) :
        - replacing strings `${property_name}` with the real **values that can only be supplied at build time**.

```xml
<!-- pom.xml -->
<project …>
  ……

  <build>
    <filters>
      <filter>src/main/filters/filter.properties</filter>
    </filters>
    <resources>
      <resource>
        <directory>src/main/resources</directory>
        <filtering>true</filtering>
      </resource>
    </resources>
  </build>
</project>
```

- In the properties section of your pom.xml

```xml
<project …>
  ……

  <properties>
    <my.filter.value>hello</my.filter.value>
  </properties>
</project>
```

- From the system properties
    - either system properties built into Java
    - like `java.version` or `user.home`
- From the command line using the standard Java -D parameter

```bash
mvn process-resources "-Dmy.filter.value=hello"
```

#### Replace properties

Source

- file "src/main/resources/application.properties"

```properties
# application.properties
application.name=${project.name}
application.version=${project.version}
message=${my.filter.value}
```

After executing :

```bash
mvn process-resources
```

Target will be :

- file "*.jar/META-INF/application.properties"

```properties
# application.properties
application.name=Maven Quick Start Archetype
application.version=1.0-SNAPSHOT
message=hello
```

## Dependencis

TODO

- Maven - Maven Getting Started Guide : https://maven.apache.org/guides/getting-started/index.html#How_do_I_use_external_dependencies

## Deploy in Remote Repo

TODO
