# Markdown Lint

* Source : [https://github.com/markdownlint/markdownlint](https://github.com/markdownlint/markdownlint)
* Usage : [https://github.com/markdownlint/markdownlint/issues/67\#issuecomment-75839369](https://github.com/markdownlint/markdownlint/issues/67#issuecomment-75839369)

## Usage

```bash
# List MDL Rules
mdl --style path/to/style.rb --list-rules

# Check Mardown Style
mdl --style path/to/style.rb . -g && echo 'All is well.'
```

## Style

File : style.rb

* My style definitions as follow

[markdown/lint/style.rb](https://github.com/IceHe/lib/tree/4e6b7c73229e0e23ff9d6acf7f2ba61d9dacec30/snips/markdown/lint/style.rb)

## GitLab CI

### Config

File : .gitlab-ci.yml

* Mine : [https://github.com/IceHe/lib/blob/master/.gitlab-ci.yml](https://github.com/IceHe/lib/blob/master/.gitlab-ci.yml)
* `mdl` job definition as follow

```yaml
mdl:
    stage: check
    image: icehe/markdownlint
    script:
        - mdl --style path/to/style.rb --list-rules
        - mdl --style path/to/style.rb . -g && echo 'All is well.'
```

### Image

`icehe/markdownlint`

* Mime : [https://hub.docker.com/r/icehe/markdownlint](https://hub.docker.com/r/icehe/markdownlint)
* Built by : markdown/lint/Dockerfile

```bash
cd markdownlint
docker build --compress --squash -t icehe/markdownlint ./
docker push icehe/markdownlint
```

#### Dockerfile

File : markdown/lint/Dockerfile

[markdown/lint/Dockerfile](https://github.com/IceHe/lib/tree/4e6b7c73229e0e23ff9d6acf7f2ba61d9dacec30/snips/markdown/lint/Dockerfile/README.md)

