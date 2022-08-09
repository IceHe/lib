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

Identifying project structure

```bash
gradle projects
# or
./gradlew projects
```

### Creating Multi-project Builds

References

-   [Gradle / Docs / Running Gradle Builds / Executing Multi-Project Builds](https://docs.gradle.org/current/samples/sample_building_java_applications_multi_project.html)

Building Java Applications with libraries Sample

### Building Android applications

References

-   [Android Basics / Docs / Guides / Build your first app](https://developer.android.com/training/basics/firstapp)
