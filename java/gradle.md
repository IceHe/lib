# Gradle

From mobile apps to microservices, from small startups to big enterprises, Gradle helps teams build, automate and deliver better software, faster.

---

References

-   [gradle.org](https://gradle.org/)
-   [docs.gradle.org](https://docs.gradle.org/)

## What is Gradle

Reference: [What is Gradle?](https://docs.gradle.org/current/userguide/what_is_gradle.html)

Tasks themselves consist of:

-   Actions — pieces of work that do something, like copy files or compile source
-   Inputs — values, files and directories that the actions use or operate on
-   Outputs — files and directories that the actions modify or generate

In fact, all of the above are optional depending on what the task needs to do.
Some tasks — such as the standard lifecycle tasks — don’t even have any actions.
They simply aggregate multiple tasks together as a convenience.

……

One last thing: Gradle's incremental build support is robust and reliable,
so keep your builds running fast by avoiding the `clean` task unless you actually do want to perform a `clean`.

## Get Started

References:

-   [Get started](https://docs.gradle.org/current/userguide/getting_started.html)
    -   [The Gradle Wrapper](https://docs.gradle.org/current/userguide/gradle_wrapper.html#sec:using_wrapper):
        It is recommended to always execute a build with the Wrapper to ensure a reliable, controlled and standardized execution of the build.

### Identifying project structure

```bash
gradle projects
# or
./gradlew projects
```

### Executing tasks by fully qualified name

```bash
gradle :services:webservice:build
```

### Know what tasks are in a particular subproject

```bash
gradle :services:webservice:tasks
```

### Structuring and Building a Software Component with Gradle

Reference: [Structuring and Building a Software Component with Gradle](https://docs.gradle.org/current/userguide/multi_project_builds.html#multi_project_builds)

Basic multi-project build

```text
.
├── app
│   ...
│   └── build.gradle.kts
└── settings.gradle.kts
```

settings.gradle.kts

```kts
rootProject.name = "basic-multiproject"
include("app")
```

View the structure of a multi-project build

```bash
$ gradle -q projects

------------------------------------------------------------
Root project 'basic-multiproject'
------------------------------------------------------------

Root project 'basic-multiproject'
\--- Project ':app'

To see a list of the tasks of a project, run gradle <project-path>:tasks
For example, try running gradle :app:tasks
```

app/build.gradle.kts

```kts
plugins {
    id("application")
}

application {
    mainClass.set("com.example.Hello")
}
```

app/src/main/java/com/example/Hello.java

```java
package com.example;

public class Hello {
    public static void main(String[] args) {
        System.out.println("Hello, world!");
    }
}
```

Run the application by executing the run task from the application plugin

```bash
$ gradle -q run
Hello, world!
```

### Learn more about the tasks

```bash
gradle help --task <taskname>.
```

### The Basic Plugins

Reference: [The Base Plugin](https://docs.gradle.org/current/userguide/base_plugin.html)

Applying the Base Plugin

```kts
plugins {
    base
}
```

### Command Line Interface

Reference: [Command-Line Interface](https://docs.gradle.org/current/userguide/command_line_interface.html#command_line_interface)

List project properties

```bash
$ gradle -q properties
# more detailed
$ gradle -q api:properties

------------------------------------------------------------
Project ':api' - The shared API for the application
------------------------------------------------------------

allprojects: [project ':api']
ant: org.gradle.api.internal.project.DefaultAntBuilder@12345
antBuilderFactory: org.gradle.api.internal.project.DefaultAntBuilderFactory@12345
artifacts: org.gradle.api.internal.artifacts.dsl.DefaultArtifactHandler_Decorated@12345
asDynamicObject: DynamicObject for project ':api'
baseClassLoaderScope: org.gradle.api.internal.initialization.DefaultClassLoaderScope@12345
```

## Build Script Basics

Reference: [Build Script Basics](https://docs.gradle.org/current/userguide/tutorial_using_tasks.html)

…… We call **`build.gradle.kts` file a build script**, although strictly speaking it is a build configuration script.

```kts
tasks.register("hello") {
    doLast {
        println("Hello world!")
    }
}
```

_Test the build script above_

```bash
$ gradle -q hello
Hello world!
```

### Build scripts are code

build.gradle.kts

```kts
tasks.register("upper") {
    doLast {
        val someString = "mY_nAmE"
        println("Original: $someString")
        println("Upper case: ${someString.toUpperCase()}")
    }
}
```

_Test the build script above_

```bash
$ gradle -q upper
Original: mY_nAmE
Upper case: MY_NAME
```

### Task dependencies

build.gradle.kts

```kts
tasks.register("hello") {
    doLast {
        println("Hello world!")
    }
}
tasks.register("intro") {
    dependsOn("hello")
    doLast {
        println("I'm Gradle")
    }
}
```

_Test build script above_

```bash
$ gradle -q intro
Hello world!
I'm Gradle
```

### Flexible task registration

build.gradle.kts

```kts
repeat(4) { counter ->
    tasks.register("task$counter") {
        doLast {
            println("I'm task number $counter")
        }
    }
}
```

_Test build script above_

```bash
$ gradle -q task1
I'm task number 1
```

……

## Using Gradle Plugins

Reference: [Using Gradle Plugins](https://docs.gradle.org/current/userguide/plugins.html)

---

## Archived

### Creating Multi-project Builds

References

-   [Gradle / Docs / Running Gradle Builds / Executing Multi-Project Builds](https://docs.gradle.org/current/samples/sample_building_java_applications_multi_project.html)

Building Java Applications with libraries Sample

### Building Android applications

References

-   [Android Basics / Docs / Guides / Build your first app](https://developer.android.com/training/basics/firstapp)
