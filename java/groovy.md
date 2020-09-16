# Groovy

TODO

> A multi-faceted language for the Java platform
>
> - Apache Groovy is a powerful, optionally typed and dynamic language, with static-typing and static compilation capabilities, for the Java platform aimed at improving developer productivity thanks to a concise, familiar and easy to learn syntax.
> - It integrates smoothly with any Java program, and immediately delivers to your application powerful features, including scripting capabilities, Domain-Specific Language authoring, runtime and compile-time meta-programming and functional programming.

- Home Page : http://groovy-lang.org/
- Documentation : http://groovy-lang.org/documentation.html
    - **Syntax** : http://groovy-lang.org/syntax.html
    - **Operators** : http://groovy-lang.org/operators.html
    - **Program Structure** http://groovy-lang.org/structure.html
    - Object Orientation : http://groovy-lang.org/objectorientation.html
    - **Closure** : http://groovy-lang.org/closures.html
    - _Semantics_ : http://groovy-lang.org/semantics.html
- Style Guide : http://groovy-lang.org/style-guide.html
- Testing with spock : http://groovy-lang.org/testing.html#_testing_with_spock

## Quickstart

Shebang line

```bash
#!/usr/bin/env groovy
println "Hello from the shebang line"
```

Map

```groovy
def map = [foo: "bar", num: 110, is_good: true]
```

List

```groovy
def list = [1, "2", 3.3, false]
```

Clousure

```groovy
retry(3) {
    doSomething()
}
```
