# Install JDK

## macOS

Install [Java Development Kit](https://en.wikipedia.org/wiki/Java_Development_Kit) Version 8 ( [History](https://en.wikipedia.org/wiki/Java_version_history#Java_SE_8) )

- Recommended: Install by command line ( as follow )
- Optional: Download Binary Installation for Mac OS X x64  ( [Link](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html) )

Steps

- Configure Software Source

```bash
brew tap caskroom/versions
```

- Install JDK 8
    - Notice: You have to enter your mac password once.
    - If require Java 10+ (latest version), use `brew cask install java`

```bash
brew cask install java8
```

Get PATH to JDK

- If for Java 10+ (latest version), use `/usr/libexec/java_home`

```bash
/usr/libexec/java_home -v 1.8

# output e.g.
# /Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
```

Set Environment Variable JAVA_HOME

- Append the command below to config file `~/.bashrc`
    - If config file `~/.bashrc` doesn't exist, create it.
    - If you use other Shell other than Bash, i.e. Zsh, append to config file `~/.zshrc`

```bash
export JAVA_HOME=`/usr/libexec/java_home -v 1.8`
```

## CentOS

- Reference : https://www.digitalocean.com/community/tutorials/how-to-install-java-on-centos-and-fedora
- Download Java 8 - Binary Installation : https://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html

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
