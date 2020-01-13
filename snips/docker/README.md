# Docker

- Home : https://www.docker.com/
- Docs : https://docs.docker.com/
- Hub : https://hub.docker.com/
- Train : https://training.docker.com/
    - Another Choice : [Docker — 从入门到实践](https://yeasy.gitbooks.io/docker_practice/) @ GitBook

## Login Registry

> Recommended : Managed your Docker images on [hub.docker.com](https://hub.docker.com)

`login` to a Docker registry

- Register on [hub.docker.com](https://hub.docker.com)
- Login by your [username] registered

```bash
docker login [OPTIONS] [SERVER]
# e.g.
docker login
# if without [SERVER], default is `hub.docker.com`.
```

`logout` from a Docker registry

```bash
docker logout [SERVER]
# e.g.
docker logout
# if without [SERVER], default is `hub.docker.com`.
```

## Build & Push Image

### Manual

`build` an image from a Dockerfile

```bash
docker build [OPTIONS] PATH | URL | -
```

`push` an image to a registry

```bash
docker push NAME[:TAG]
```

### Quickstart

1\. Go to path/to/dir_with_dockerfile

```bash
cd path/to/Dockerfile
# e.g.
cd alpine
```

2\. Build Image

```bash
docker build --compress --squash -t USERNAME/IMAGE_NAME ./
# e.g.
docker build --compress --squash -t icehe/alpine ./
```

3\. Push Image

```bash
docker push USERNAME/IMAGE_NAME
# e.g.
docker push icehe/alpine
```

Examples

- https://hub.docker.com/r/icehe/alpine
- https://hub.docker.com/r/icehe/markdownlint

## Pull Image

`pull` an image or a repository from a registry

- if without optional `:TAG`, pull default tag `:latest`

```bash
docker pull IMAGE_NAME[:TAG]
# e.g.
docker pull icehe/alpine:latest
```

## Run Container

`run` a command in a new container

- Options
    - `-d` | `--detach` Run container background & print container ID
    - `-i` | `--interactive` Keep STDIN open even if not attached
    - `-t` | `--tty` Allocate a pseudo-TTY
    - `--name NAME` Assign a name to the container
    - `-p, --publish list` Publish a continer's port(s) to the host
        - `-p [HOST_PORT]:[CONTAINER_PORT]` e.g. `-p 8080:80`

```bash
docker run [OPTIONS] IMAGE [COMMAND]
# e.g.
docker run -dit \
    --name icehe_alpine \
    -p 30080:80 \
    icehe/alpine:latest
```

## Stop & Start Container

`stop` one or more containers

```bash
docker stop CONTAINER [CONTAINER...]
# e.g.
docker stop icehe_alpine
```

`start` one or more stoped containers

```bash
docker start CONTAINER [CONTAINER...]
# e.g.
docker start icehe_alpine
```

## Exec CMD in Container

**exec** : Run a command in a running container

```bash
docker exec -it CONTAINER COMMAND

# e.g.: run shell in container
docker exec -it icehe_alpine bash
# Run `bash` for executing more commands in it
```

## List

### Containers

`ps` : process status

- Options
    - `-a` | `--all` Show all containers ( default shows just running ones )
    - `-n, --last int` Show n last created containers ( includes all status )

```bash
docker ps [OPTIONS]

# e.g.
$ docker ps -a
CONTAINER ID        IMAGE                 COMMAND             CREATED             STATUS              PORTS                   NAMES
3a9d01a3969b        icehe/alpine:latest   "/bin/sh"           10 minutes ago      Up 9 minutes        0.0.0.0:30080->80/tcp   icehe_alpine
```

`top` : Display the running processes of a container

```bash
docker top CONTAINER

# e.g.
$ docker top icehe_alpine
PID                 USER                TIME                COMMAND
2431                root                0:00                /bin/sh
```

### Images

- Options
    - `-a` | `--all` Show all images ( default hides intermediate images )

```bash
$ docker images

REPOSITORY           TAG                 IMAGE ID            CREATED             SIZE
icehe/markdownlint   latest              34b32c8ea585        3 weeks ago         79.2MB
icehe/alpine         latest              e535b10e6f55        5 weeks ago         18.1MB
ruby                 alpine              c3f3338e8929        7 weeks ago         62MB
```

### Others

System-wide information

```bash
docker info
```

Show version

```bash
docker version
```

Help : Docker commands

```bash
docker help
```

## Remove

### Container

`rm` : Remove one or more **containers**

- Options : `-f` | `--force` Force the removal of a running container ( uses SIGKILL )

```bash
docker rm CONTAINER [CONTAINER...]
# e.g.
docker rm icehe_alpine
```

### Image

`rmi` : Remove one or more **images**

- Options : `-f` | `--force` Force removal of the images

```bash
docker rm [OPTIONS] IMAGE [IMAGE...]
# e.g.
docker rmi icehe/markdownlint icehe/alpine ruby
```

## Kill Container

`kill` one or more running containers

- Options : `-s, --signal string` Signal to send to the container ( default "KILL" )

```bash
docker kill CONTAINER [CONTAINER...]
# e.g.
docker kill icehe_alpine
```

# Docker Compose (TBD)

> Define and run multi-container applications with Docker.

- Docs
    - Overview : https://docs.docker.com/compose/overview/
    - Install : https://docs.docker.com/compose/install/
    - Get started : https://docs.docker.com/compose/gettingstarted/
    - Compose file : https://docs.docker.com/compose/compose-file/
    - Environment Variables : https://docs.docker.com/compose/environment-variables/

```bash
docker-compose help
```
