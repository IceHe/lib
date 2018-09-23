# sed

## TEMP

```bash
#!/bin/sh

for arg in $*
do
    grep -E '(?:class )(.*?)(?:Sniff)' $arg \
        | awk '{ print $2; }' \
        | awk -F 'Sniff' '{ print "    <!-- ## Squiz.Operators."$1" -->"; }' \
        >> ~/Desktop/tmp.txt

    sed -n '3p' $arg \
        | sed 's/^...//g; s/\.$//g' \
        | awk '{ print "    <!-- "$0" -->"; }' \
        >> ~/Desktop/tmp.txt

    echo >> ~/Desktop/tmp.txt
done
```