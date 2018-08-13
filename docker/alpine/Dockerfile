# Usage
#
#   ```bash
#   # 1. Register on hub.docker.com
#   # 2. Login by your [username] registered
#   docker login
#
#   # 3. Go to path/to/dir_with_dockerfile
#   cd docker/alpine
#
#   # 4. Build Image
#   docker build --compress --squash -t [username]/alpine ./
#
#   # 5. Push Image
#   docker push [username]/alpine
#   ```
#
#   Example : https://hub.docker.com/r/icehe/alpine

FROM alpine
RUN apk add bash
RUN apk add curl
RUN apk add php
RUN apk add rsync
CMD ["/bin/sh"]
