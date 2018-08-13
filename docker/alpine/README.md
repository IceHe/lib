# Alpine Linux

> Alpine is one of the minimal Linux distribution Docker image.

## Official Pages

- Home : https://alpinelinux.org/
- About : https://alpinelinux.org/about/
- Wiki : https://wiki.alpinelinux.org/wiki/Main_Page

## Package Manager

Command

- **Alpine : `apk`**
- Ubuntu : `apt`
- CentOS : `yum`

Usage

```bash
apk add bash
```

Reference

- https://wiki.alpinelinux.org/wiki/Alpine_Linux_package_management

## Build & Push

Register

- [hub.docker.com](https://hub.docker.com)

Login by your [username] registered

```bash
docker login
```

Go to path/to/dir_with_dockerfile

```bash
cd docker/alpine
```

Build Image

```bash
docker build --compress --squash -t [username]/alpine ./
```

Push Image

```bash
docker push [username]/alpine
```

Example

- https://hub.docker.com/r/icehe/alpine

## Dockerfile

[Dockerfile](Dockerfile ':include :type=code docker')
