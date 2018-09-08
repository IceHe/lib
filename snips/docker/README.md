# Docker

- Home : https://www.docker.com/
- Docs : https://docs.docker.com/
- Hub : https://hub.docker.com/
- Train : https://training.docker.com/
    - Another Choice : [Docker — 从入门到实践](https://yeasy.gitbooks.io/docker_practice/) @ GitBook

## Build & Push

> Recommended : Managed your Docker images on [hub.docker.com](https://hub.docker.com)

1\. Register on [hub.docker.com](https://hub.docker.com)

2\. Login by your [username] registered

```bash
docker login
```

3\. Go to path/to/dir_with_dockerfile

```bash
cd path/to/Dockerfile
```

4\. Build Image

```bash
docker build --compress --squash -t [username]/[image_name] ./
```

5\. Push Image

```bash
docker push [username]/[image_name]
```

Example

- https://hub.docker.com/r/icehe/alpine
- https://hub.docker.com/r/icehe/markdownlint

## TODO

- `login`
- `pull`
- `run` / `stop`
- `ps` Show process status
- `rm` Remove Container
- `rmi` Remove Image
- `exec` Execute in image
- `docker-compose`