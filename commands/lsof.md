# lsof

> list open files

## Options

- `-i [i]` Selects the listing of files any of whose Internet address matches the address specified in i.

```text
If no address is speci-
fied, this option selects the listing of all Internet and x.25
(HP-UX) network files.

If  -i4  or  -i6  is specified with no following address, only
files of the indicated IP version,  IPv4  or  IPv6,  are  dis-
played.   (An  IPv6  specification  may  be  used  only if the
dialects  supports  IPv6,  as  indicated   by   ``[46]''   and
``IPv[46]''  in lsof's -h or -?  output.)  Sequentially speci-
fying -i4, followed by -i6 is the same as specifying  -i,  and
vice-versa.   Specifying  -i4,  or -i6 after -i is the same as
specifying -i4 or -i6 by itself.

Multiple addresses (up to a limit of  100)  may  be  specified
with  multiple  -i  options.   (A  port number or service name
range is counted as one address.)  They are joined in a single
ORed set before participating in AND option selection.

An  Internet address is specified in the form (Items in square
brackets are optional.):


[46][protocol][@hostname|hostaddr][:service|port]

where:
    46 specifies the IP version, IPv4 or IPv6
        that applies to the following address.
        '6' may be be specified only if the UNIX
        dialect supports IPv6.  If neither '4' nor
        '6' is specified, the following address
        applies to all IP versions.
    protocol is a protocol name - TCP, UDP
    hostname is an Internet host name.  Unless a
        specific IP version is specified, open
        network files associated with host names
        of all versions will be selected.
    hostaddr is a numeric Internet IPv4 address in
        dot form; or an IPv6 numeric address in
        colon form, enclosed in brackets, if the
        UNIX dialect supports IPv6.  When an IP
        version is selected, only its numeric
        addresses may be specified.
    service is an /etc/services name - e.g., smtp -
        or a list of them.
    port is a port number, or a list of them.

IPv6 options may be used only if  the  UNIX  dialect  supports
IPv6.  To see if the dialect supports IPv6, run lsof and spec-
ify the -h or -?  (help) option.  If the displayed description
of  the  -i  option contains ``[46]'' and ``IPv[46]'', IPv6 is
supported.

IPv4 host names and addresses may not be specified if  network
file  selection is limited to IPv6 with -i 6.  IPv6 host names
and addresses may not be specified if network  file  selection
is  limited  to  IPv4  with  -i  4.  When an open IPv4 network
file's address is mapped in an IPv6 address, the  open  file's
type  will be IPv6, not IPv4, and its display will be selected
by '6', not '4'.

At least one address component -  4,  6,  protocol,  hostname,
hostaddr,  or  service - must be supplied.  The `@' character,
leading the host specification, is always required; as is  the
`:',  leading the port specification.  Specify either hostname
or hostaddr.  Specify either service name list or port  number
list.   If  a service name list is specified, the protocol may
also need to be specified if the TCP,  UDP  and  UDPLITE  port
numbers  for  the  service name are different.  Use any case -
lower or upper - for protocol.

Service names and port numbers may be combined in a list whose
entries  are  separated  by  commas  and  whose  numeric range
entries are separated by minus signs.  There may be no  embed-
ded spaces, and all service names must belong to the specified
protocol.  Since service  names  may  contain  embedded  minus
signs,  the starting entry of a range can't be a service name;
it can be a port number, however.

Here are some sample addresses:

    -i6 - IPv6 only
    TCP:25 - TCP and port 25
    @1.2.3.4 - Internet IPv4 host address 1.2.3.4
    @[3ffe:1ebc::1]:1234 - Internet IPv6 host address
        3ffe:1ebc::1, port 1234
    UDP:who - UDP who service port
    TCP@lsof.itap:513 - TCP, port 513 and host name lsof.itap
    tcp@foo:1-10,smtp,99 - TCP, ports 1 through 10,
        service name smtp, port 99, host name foo
    tcp@bar:1-smtp - TCP, ports 1 through smtp, host bar
    :time - either TCP, UDP or UDPLITE time service port
```

## Usage

15 examples (better, more practical)

https://www.thegeekstuff.com/2012/08/lsof-command-examples/

10 examples

https://www.tecmint.com/10-lsof-command-examples-in-linux/
