#!/bin/sh

# References
# - Changing author info - GitHub Help : https://help.github.com/en/articles/changing-author-info

git filter-branch --env-filter '

CORRECT_NAME="IceHe.xyz"
CORRECT_EMAIL="icehe.xyz@qq.com"

OLD_EMAILS=(
    "example@example.com"
    "icehe.xyz@qq.com"
)

for OLD_EMAIL in ${OLD_EMAILS[@]}; do
    if [ "$GIT_COMMITTER_EMAIL" = "$OLD_EMAIL" ]
    then
        export GIT_COMMITTER_NAME="$CORRECT_NAME"
        export GIT_COMMITTER_EMAIL="$CORRECT_EMAIL"
    fi
    if [ "$GIT_AUTHOR_EMAIL" = "$OLD_EMAIL" ]
    then
        export GIT_AUTHOR_NAME="$CORRECT_NAME"
        export GIT_AUTHOR_EMAIL="$CORRECT_EMAIL"
    fi
done

' -f --tag-name-filter cat -- --branches --tags

# After finishing, execute the following command to check
#
# ```bash
# git log | grep -E '^Author' | sort | uniq
# ```
