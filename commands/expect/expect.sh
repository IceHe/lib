#!/usr/bin/expect

set timeout 180

# creates a new process running program args
spawn ssh [username]@[host_or_ip]

# waits until one of the patterns matches the output of a spawned process
expect {

    "password:" {
        # sends string to the current process
        send "[password]\r"
        # allows expect itself to continue executing rather than returning as it normally would
        exp_continue

    } "Enter:" {
        # [interact according to output from remote server]
        send "1\r"
        exp_continue

    } "server ip or domain name ( 'q' to exit ):" {
        # [interact according to output from remote server]
        send "[ip]\r"

        # gives control of the current process to the user, so that keystrokes are sent to the current process, and the stdout and stderr of the current process are returned
        interact

        # Testing
        #set CTRLZ \032
        #interact $CTRLZ {
            #send "exit\r"
            #expect "server ip or domain name ( 'q' to exit ):" {
                #send "q\r"
                #exp_continue
            #} "Enter:" {
                #send "q\r"
            #}
        #}
    }
}
