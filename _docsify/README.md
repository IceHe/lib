# How to docsify

External links

- [docsify](https://docsify.js.org/)
    - [Quickstart](https://docsify.js.org/#/quickstart)
    - [Deploy](https://docsify.js.org/#/deploy)

## Preview

Require

- npm
- docsify

### Install

on macOS

```bash
brew install npm
```

```bash
npm i docsify-cli -g
```

### Run

Change directory

```bash
cd path/to/project
```

Run

```bash
docsify serve .
```

```bash
# Optional: sepcify port
docsify serve . [-p <port>]

# e.g.
docsify serve .
# or
docsify serve . -p 4000
```

### Visit

http://localhost:3000

Default port is 3000.

## Build

### Make files

```bash
# Rewrite links to resources
php path/to/download-n-rewrite-resources.php --rewrite # --download
# ( option `--download` : get or refresh resources in directory `_docsify/resources/*` )

# Generate Docs
mkdir .public
cp -r * .public
mv .public public

## Access Control
## ( Suggestion : 敏感内容只能在项目的代码仓库下查看，通过项目的访问权限来限制阅读 )
rm -rf public/path/to/SENSITIVE/FILEs

## Remove Useless Files
rm -rf public/path/to/USELESS/FILEs

# List Docs
find public | sed -e "s/[^-][^\/]*\//  |/g" -e "s/|\([^ ]\)/|── \1/"

# Deploy Docs
# - 1. Pages : Coding/GitHub/GitLab
# - 2. VPS : `rsync` or else
# - 3. Others : CDNs or website host services
```

Reference

- [.gitlab-ci.yml](https://github.com/IceHe/lib/blob/master/.gitlab-ci.yml)

### Speed Up

Target

- Speed Up Website Access

How-to

- Download remote resources
- Rewrite links to resources in index.html

Steps

```bash
cd path/to/project
```

```bash
php path/to/download-n-rewrite-resources.php --download --rewrite
# current path is scripts/php/download-n-rewrite-resources.php
```

Reference

- [download-n-rewrite-resources.php](https://github.com/IceHe/lib/blob/master/_ci/download-n-rewrite-resources.php)

## Deploy

### Pages

Configurated by

- GitLab : Config file `.gitlab-ci.yml`
- GitHub : Project Settings
- Coding.net : Project Settings

#### GitLab CI

File : .gitlab-ci.yml

- build job definition as follow

```yaml
# Deploy @ GitLab Pages
pages:
    stage: deploy
    script:
        # Build：temporary directory `.public/`
        - mkdir .public
        - cp -r * .public
        # Release：formal directory `public/`
        - mv .public public
    artifacts:
        paths:
            - public
    only:
        - master
```

Mine : [icehe/lib/.gitlab-ci.yml](https://github.com/IceHe/lib/blob/master/.gitlab-ci.yml)

### VPS

#### Rsync

At first, send website files to specified remote directory.

#### Nginx

Recommended method

[nginx/docsify.conf](deploy/nginx/docsify.conf ':include :type=code nginx')

#### Service

Optional method

[service/docsify](deploy/service/docsify ':include :type=code bash')
