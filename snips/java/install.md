# Install JDK

## macOS

安装 [Java Development Kit](https://en.wikipedia.org/wiki/Java_Development_Kit) 版本 8（ [历史](https://en.wikipedia.org/wiki/Java_version_history#Java_SE_8) ）

- 推荐：命令行安装（如下）
- 备选：官网下载使用「Mac OS X x64」版本的 [最新安装包](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html)

命令行安装步骤

- 配置软件源

```bash
brew tap caskroom/versions
```

- 安装 JDK 8
    - 注意：中途需要输入当前 macOS 登入用户的密码！
    - 若需最新版本 Java 10+ ，则用命令 `brew cask install java`

```bash
brew cask install java8
```

获取 JDK 路径

- 若是了解最新版本，则用命令 `/usr/libexec/java_home`

```bash
/usr/libexec/java_home -v 1.8

# 输出（以当前最新版本为准）
# /Library/Java/JavaVirtualMachines/jdk1.8.0_172.jdk
```

配置环境变量 JAVA_HOME

- 在 ~/.bashrc 文件中（的合适位置）添加如下命令
    - 若文件 ~/.bashrc 不存在，则创建之
    - 若使用的 Shell 并非默认的 Bash ，而是 Zsh 则在 ~/.zshrc 文件中添加
        - 其它 Shell 操作类似

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
