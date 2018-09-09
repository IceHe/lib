
# init.d/service

## Usage

- Put config file in directory `/etc/init.d/`.
    - Ref 1 : https://askubuntu.com/questions/5039/what-is-the-difference-between-etc-init-and-etc-init-d
    - Ref 2 : https://en.wikipedia.org/wiki/Init#Research_Unix-style/BSD-style
- Replace `/path/to/website` with real path.
- Replace `HOST` with available domain or IP you want (e.g., 127.0.0.1).
- Replace `PORT` with available port you want (e.g., 80).
    - Tip : Run `lsof -i :PORT` to check port availability.
- Run `service start simple_http_service` in terminal.
- Visit `http://HOST:PORT/` in browser.

Reference : [How do I create a service for a shell script so I can start and stop it like a daemon?]( https://unix.stackexchange.com/questions/236084/how-do-i-create-a-service-for-a-shell-script-so-i-can-start-and-stop-it-like-a-d)

## HTTP Service

File : simple-http-service

[simple-http-service](simple-http-service ':include :type=code bash')
