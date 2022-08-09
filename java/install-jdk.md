# Install JDK

JDK - Java Development Kit

---

## macOS

RECOMMEND to install the JDKs of the common used version **11** and the latest LTS version **17**

LTS - Long-Term Support

-   A. via Homebrew - recommended

    ```bash
    brew install openjdk@11
    java --version
    brew install openjdk
    java --version
    ```

-   B. via SDKMAN!

    1.  Install SDKMAN!

        Reference : [Installation - SDKMAN!](https://sdkman.io/install)

    2.  Install JDK via SDKMAN!

        Reference : [JDKs - SDKMAN!](https://sdkman.io/jdks)

        ```bash
        sdk install java [VERSION]
        ```

-   C. via the installation downloaded from the websites

    Reference : [Java Downloads - Oracle](https://www.oracle.com/java/technologies/downloads/)

### JAVA_HOME

Set the environment variable `JAVA_HOME` - automatically

e.g. via the dotfiles downloaded above

I can do it manually : append the command below to the ZSH configuration file `~/.zshrc` :

```bash
export JAVA_HOME=`/usr/libexec/java_home -v 17`
```

-   If use `bash` instead of `zsh`, append to the BASH configuration file `~/.bashrc`

Note : The tilde symbol `~` equals the path of the current user home directory, e.g. for me `/Users/icehe`

Note : Get the path to JDK via `/usr/libexec/java_home`, e.g. JDK 8

```bash
$ /usr/libexec/java_home -v 1.8
/Library/Java/JavaVirtualMachines/zulu-8.jdk/Contents/Home
```

## CentOS

-   Reference : https://www.digitalocean.com/community/tutorials/how-to-install-java-on-centos-and-fedora
-   Download Java 8 - Binary Installation : https://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html

```bash
# 下载
curl -L -b "oraclelicense=a" -O <official_jdk_download_url>
# e.g.
curl -L -b "oraclelicense=a" -O
https://download.oracle.com/otn-pub/java/jdk/8u191-b12/2787e4a523244c269598db4e85c51e0c/jdk-8u191-linux-x64.rpm

# 本地二进制安装
yum localinstall jdk-8u161-linux-x64.rpm

# 更换使用的 Java 版本
alternatives --config java
```
