# init.d/service

## Simple HTTP Service

### Usage

* Put config file in directory `/etc/init.d/`.
  * Ref 1 : [https://askubuntu.com/questions/5039/what-is-the-difference-between-etc-init-and-etc-init-d](https://askubuntu.com/questions/5039/what-is-the-difference-between-etc-init-and-etc-init-d)
  * Ref 2 : [https://en.wikipedia.org/wiki/Init\#Research\_Unix-style/BSD-style](https://en.wikipedia.org/wiki/Init#Research_Unix-style/BSD-style)
* Replace `/path/to/website` with real path.
* Replace `<host>` with available domain or IP you want \(e.g., 127.0.0.1\).
* Replace `<port>` with available port you want \(e.g., 80\).
  * Tip : Run `lsof -i :<port>` to check port availability.
* Run `service start simple_http_service` in terminal.
* Visit `http://<host>:<port>/` in browser.

Reference : [How do I create a service for a shell script so I can start and stop it like a daemon?](https://unix.stackexchange.com/questions/236084/how-do-i-create-a-service-for-a-shell-script-so-i-can-start-and-stop-it-like-a-d)

### HTTP Service

[File : simple-http-service](https://github.com/IceHe/lib/tree/4e6b7c73229e0e23ff9d6acf7f2ba61d9dacec30/snips/init.d/simple-http-service/README.md)

