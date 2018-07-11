#!/bin/bash

list_rules="mdl --style _ci/markdownlint.style.rb --list-rules"
echo
echo \$ $list_rules
eval $list_rules

mdl_proj="mdl --style _ci/markdownlint.style.rb . -g"
echo
echo \$ $mdl_proj
eval $mdl_proj

echo No problem.
echo
