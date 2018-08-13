# Markdown Lint

## Refs

- Source : https://github.com/markdownlint/markdownlint
- Usage : https://github.com/markdownlint/markdownlint/issues/67#issuecomment-75839369

## Usage

```bash
# List MDL Rules
mdl --style path/to/style.rb --list-rules

# Check Mardown Style
mdl --style path/to/style.rb . -g && echo 'All is well.'
```

## GitLab CI

### Config

File : .gitlab-ci.yml

- mdl job definition as follow

```yaml
mdl:
    stage: check
    image: icehe/markdownlint
    script:
        - mdl --style path/to/style.rb --list-rules
        - mdl --style path/to/style.rb . -g && echo 'All is well.'
```

Mine : [icehe/lib/.gitlab-ci.yml](https://github.com/IceHe/lib/blob/master/.gitlab-ci.yml)

### Image

`icehe/markdownlint`

- Built by : markdown/lint/Dockerfile
- Hub : https://hub.docker.com/r/icehe/markdownlint

```bash
cd markdownlint
docker build --compress --squash -t icehe/markdownlint ./
docker push icehe/markdownlint
```

#### Dockerfile

File : markdown/lint/Dockerfile

[markdown/lint/Dockerfile](../markdown/lint/Dockerfile ':include :type=code docker')

My image : [icehe/markdownlint](https://hub.docker.com/r/icehe/markdownlint) @ hub.docker.com
