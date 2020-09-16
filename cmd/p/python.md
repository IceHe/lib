# python

> an interpreted, interactive, object-oriented programming language

References

- `man python`

## Options

- `-m module-name` Searches sys.path for the named module and runs the corresponding .py file as a script.

## Usage

### HTTP Server

Server on directory

```bash
# /usr/home/icehe on 10.2.3.4:30233
$ cd /usr/home/icehe
$ python -m SimpleHTTPServer 30233
Serving HTTP on 0.0.0.0 port 30233 ...
```

Read from server

```bash
$ curl 10.77.120.249:30233/input1
abhishek
divyam
chitransh
naveen
harsh

# Download
$ curl -LO 10.2.3.4:30233/input1
```
