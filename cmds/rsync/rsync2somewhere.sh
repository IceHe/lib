#!/bin/bash

chmod 600 path/to/rsyncd.secrets

rsync -avz --delete --exclude='.git' \
    --password-file=path/to/rsyncd.secrets \
    ./ username@[host]::module
