title: Docker Note
---

[ ] 先根据羊生杰的配置，做好docker
https://gitlab.weibo.cn/sora/docker


# 第四步的命令行改为

docker run -itd --name web -p 80:80 -v /Users/IceHe/Coding/Work/sora:/var/www:rw hub.weibo.cn/mapi/v7-dev-mac


# 本地访问 http://mapi.app

碰到如下错误：

分析JSON文件时出错。文件格式可能不正确.
unexpected character at line 1 column 1
<br /> <b>Warning</b>: include(/var/www/public/../vendor/autoload.php): failed to open stream: No such file or directory in <b>/var/www/public/index.php</b> on line <b>3</b><br /> <br /> <b>Warning</b>: include(): Failed opening '/var/www/public/../vendor/autoload.php' for inclusion (include_path='.:/usr/lib64/php:/usr/lib64') in <b>/var/www/public/index.php</b> on line <b>3</b><br /> <br /> <b>Warning</b>: Class 'Request' not found in <b>/var/www/app/Bootstrap.php</b> on line <b>26</b><br /> ["exception catched."]

因为需要先给 Sora 项目下载依赖包！

composer install
(或 ./composer.phar install，
 或 php composer.phar install)

每次下载 PHP 项目，都该先安装依赖的！



`docker -h`

Usage: docker [OPTIONS] COMMAND [arg...]
       docker [ --help | -v | --version ]

A self-sufficient runtime for containers.

Options:

  --config=~/.docker              Location of client config files
  -D, --debug=false               Enable debug mode
  -H, --host=[]                   Daemon socket(s) to connect to
  -h, --help=false                Print usage
  -l, --log-level=info            Set the logging level
  --tls=false                     Use TLS; implied by --tlsverify
  --tlscacert=~/.docker/ca.pem    Trust certs signed only by this CA
  --tlscert=~/.docker/cert.pem    Path to TLS certificate file
  --tlskey=~/.docker/key.pem      Path to TLS key file
  --tlsverify=false               Use TLS and verify the remote
  -v, --version=false             Print version information and quit

Commands:
    attach    Attach to a running container
    build     Build an image from a Dockerfile
    commit    Create a new image from a container's changes
    cp        Copy files/folders between a container and the local filesystem
    create    Create a new container
    diff      Inspect changes on a container's filesystem
    events    Get real time events from the server
    exec      Run a command in a running container
    export    Export a container's filesystem as a tar archive
    history   Show the history of an image
    images    List images
    import    Import the contents from a tarball to create a filesystem image
    info      Display system-wide information
    inspect   Return low-level information on a container or image
    kill      Kill a running container
    load      Load an image from a tar archive or STDIN
    login     Register or log in to a Docker registry
    logout    Log out from a Docker registry
    logs      Fetch the logs of a container
    network   Manage Docker networks
    pause     Pause all processes within a container
    port      List port mappings or a specific mapping for the CONTAINER
    ps        List containers
    pull      Pull an image or a repository from a registry
    push      Push an image or a repository to a registry
    rename    Rename a container
    restart   Restart a container
    rm        Remove one or more containers
    rmi       Remove one or more images
    run       Run a command in a new container
    save      Save an image(s) to a tar archive
    search    Search the Docker Hub for images
    start     Start one or more stopped containers
    stats     Display a live stream of container(s) resource usage statistics
    stop      Stop a running container
    tag       Tag an image into a repository
    top       Display the running processes of a container
    unpause   Unpause all processes within a container
    version   Show the Docker version information
    volume    Manage Docker volumes
    wait      Block until a container stops, then print its exit code

Run 'docker COMMAND --help' for more information on a command.


docker-machine -h

Usage: docker-machine [OPTIONS] COMMAND [arg...]

Create and manage machines running Docker.

Version: 0.5.3, build 4d39a66

Author:
  Docker Machine Contributors - <https://github.com/docker/machine>

Options:
  --debug, -D                        Enable debug mode
  -s, --storage-path "/Users/IceHe/.docker/machine"    Configures storage path [$MACHINE_STORAGE_PATH]
  --tls-ca-cert                     CA to verify remotes against [$MACHINE_TLS_CA_CERT]
  --tls-ca-key                         Private key to generate certificates [$MACHINE_TLS_CA_KEY]
  --tls-client-cert                     Client cert to use for TLS [$MACHINE_TLS_CLIENT_CERT]
  --tls-client-key                     Private key used in client TLS auth [$MACHINE_TLS_CLIENT_KEY]
  --github-api-token                     Token to use for requests to the Github API [$MACHINE_GITHUB_API_TOKEN]
  --native-ssh                        Use the native (Go-based) SSH implementation. [$MACHINE_NATIVE_SSH]
  --bugsnag-api-token                     BugSnag API token for crash reporting [$MACHINE_BUGSNAG_API_TOKEN]
  --help, -h                        show help
  --version, -v                        print the version

Commands:
  active        Print which machine is active
  config        Print the connection config for machine
  create        Create a machine
  env            Display the commands to set up the environment for the Docker client
  inspect        Inspect information about a machine
  ip            Get the IP address of a machine
  kill            Kill a machine
  ls            List machines
  regenerate-certs    Regenerate TLS Certificates for a machine
  restart        Restart a machine
  rm            Remove a machine
  ssh            Log into or run a command on a machine with SSH.
  scp            Copy files between machines
  start            Start a machine
  status        Get the status of a machine
  stop            Stop a machine
  upgrade        Upgrade a machine to the latest version of Docker
  url            Get the URL of a machine
  version        Show the Docker Machine version or a machine docker version
  help            Shows a list of commands or help for one command

Run 'docker-machine COMMAND --help' for more information on a command.


# Docker 与虚拟化的区别

* 虚拟化技术依赖物理CPU和内存，处于硬件级别；而 Docker 构建在 OS 上，利用 OS 的 containerization 技术，甚至可在虚拟机上运行。
* 虚拟化系统一般指操作系统镜像，较复杂，称为“系统”；而 Docker 开源而且轻量，称为“容器”，单个容器适合部署少量应用，比如部署一个 Redis、一个 Memcached。
* 传统虚拟化技术使用快照来保存状态；Docker 在保存状态上更轻便和低成本，且引入了类似源代码管理机制，记录容器的快照历史版本，切换成本低。
* 传统虚拟化技术在构建系统时较复杂；而 Docker 可通过 Dockfile 来构建整个容器，重启和构建速度快。Dockfile可手写，即可通过发布 Dockfile 来制定系统环境和依赖，利于持续交付。
* Dockerfile 可基于已构建好的容器镜像，创建新容器。Dockerfile 可分享，利于技术推广。

# Docker 主要特征

* 文件系统隔离：每个进程容器运行在完全独立的根文件系统里。
* 资源隔离：可用 cgroup 为每个进程容器分配不同的系统资源，如 CPU 和内存。
* 网络隔离：每个进程容器运行在各自的网络命名空间里，拥有各自的虚拟接口和IP地址。
* 写时复制：采用写时复制方式创建根文件系统，让部署变得极快捷，且节省内存和硬盘空间。
* 日志记录：Docker 会收集和记录每个进程容器的标准流（stdout/stderr/stdin），用于实时检索或批量检索。
* 变更管理：容器文件系统的变更可提交到新映像中，并可重复使用以创建更多的容器。无需使用模板或手动配置。
* 交互式Shell：Docker可以分配一个虚拟终端并关联到任何容器的标准输入上，如运行一个一次性交互shell。

# 仓库与镜像

* docker search 搜索所需镜像
* docker pull <image_name> 拉取镜像
* docker images 查看现有镜像

## 镜像名

* 一般仓库名应为username/repository 格式；若直接以 repository 作为仓库名，则指官方发布的仓库。
* 每个镜像都有一个唯一的 IMAGE ID，和一个易于记忆的 TAG；可通过 IMAGE ID 的前几位或者 repository:TAG 来标识一个镜像。

## Dockerfile

* 除了 pull，镜像也可通过"编译"得到，指的是一种构建行为。通过手动编写或者从 github 获取 Dockerfile 来构建一个镜像。可把 Dockerfile 看成是一个脚本，它会在容器每次启动时执行。一般在 Dockerfile 里面需编写基础软件的安装脚本和配置脚本。

Dockerfile 实例：
 
# Ubuntu Dockerfile
#
# https://github.com/dockerfile/ubuntu

# Pull base image.
FROM ubuntu:12.10

# Update OS.
RUN echo "deb http://archive.ubuntu.com/ubuntu quantal main universe multiverse" > /etc/apt/sources.list
RUN apt-get update
RUN apt-get upgrade -y

# Install basic packages.
RUN apt-get install -y software-properties-common
RUN apt-get install -y curl git htop unzip vim wget

# Add files.
ADD root/.bashrc /root/.bashrc
ADD root/.gitconfig /root/.gitconfig
ADD root/scripts /root/scripts

# Set working directory.
ENV HOME /root
WORKDIR /rootzz

* FROM 指令表示这次构建需要基于ubuntu仓库的12.10这个TAG的镜像，如果本地不存在这个镜像的话，会自动下载镜像。镜像实际上就是编译好的结果。向上面这个Dockerfile，在原始ubuntu的基础上安装了很多常用的软件。
* 官方 Dockerfile 教程

# 实践

* docker build -t="dockerfile/ubuntu" github.com/dockerfile/ubuntu 构建仓库
* docker build -t="dockerfile/nginx" github.com/dockerfile/nginx 同上
* docker run -d -p 80:80 dockerfile/nginx 运行容器（以daemon的方式）
* docker ps 查看运行的容器

访问主机的80端口，可见 nginx 的欢迎页面。此时，查看本机的进程 `ps -ef`，可见 nginx 的进程实际在本机上，意味着，容器中程序的执行仍然使用本机 OS，容器并不自己构建操作系统，而是以某种隔离的方式依赖本机操作系统工作。这就是Docker和虚拟机的本质区别。

# 原理

* 技术核心

    * 命名空间 (namespace?)
    * AUFS (advanced multi layered unification filesystem)
    * cgroup

* 参考

    * PaaS under the hood, episode 1: kernel namespaces
    * PaaS Under the Hood, Episode 2: cgroups
    * PAAS Under the Hood, Episode 3: AUFS
    * PaaS Under the Hood, Episode 4: GRSEC
    * PaaS under the hood, episode 5: Distributed routing with Hipache
    * Under the Hood系列
    * LXC （Linux 虚拟环境）简单介绍
    * docker原理简介

# 其它参考资料

* Docker官方
* Docker：具备一致性的自动化软件部署
* Dockerfile的教程

Docker 的有关社区资源：

* Segmentfault的Docker子站问答
* Docker中文社区
* Docker中文文档
